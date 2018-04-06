<?php

class Controller_Auth extends Controller
{
    function __construct()
    {
        $this->model = new Model_Auth();
        $this->parseVote = new ParseVote();
        $this->view = new View();
        $this->statusSystem();
        $this->checkAuthorization();
        $this->generateCsrfToken($this->data['username']);
        $this->systemBonus();
    }


    function action_index()
    {
        Controller::createTitle('lk');
        $this->eleAdd('info_account', $this->model->infoAccount($this->data['username']));
        $this->view->generate('main_view', 'template_view', $this->data);
    }

    function action_logout()
    {
        setcookie('lang', '', time() - 86400 * 20, '/');
        setcookie('realm', '', time() - 86400 * 20, '/');
        setcookie('key', '', time() - 86400 * 20, '/');
        setcookie('char', '', time() - 86400 * 20, '/');
        header("Location: /login");
    }

    function action_change_mail()
    {
        Controller::createTitle('changeEmail');
        if (isset($_POST['change_mail'])) {
            $this->checkCsrfToken($this->data['username'], $_POST['CSRF']);
            if (!empty($_POST['mail'])) {
                $this->model->changeMail($_POST['mail'], $this->data['username']);
                Controller::createMessage('succes', 'succesLang');
            } else {
                Controller::createMessage('error', 'errorFill');
            }
        }
        $this->view->generate('change_mail_view', 'template_view', $this->data);
    }

    function action_change_pass()
    {
        Controller::createTitle('changePass');
        if (isset($_POST['change_pass'])) {
            $this->checkCsrfToken($this->data['username'], $_POST['CSRF']);
            if (!empty($_POST['password']) && !empty($_POST['password_2']) && $_POST['password'] == $_POST['password_2']) {
                $password = sha1((strtoupper($this->data['username'])) . ':' . (strtoupper($_POST['password'])));
                $this->model->changePassword($this->data['username'], $password);
                Controller::createMessage('succes', 'succesLang');
            } else {
                Controller::createMessage('error', 'errorFill');
            }
        }
        $this->view->generate('change_pass_view', 'template_view', $this->data);
    }


   function action_shop()
    {
        Controller::createTitle('shop');
        if (isset($_POST['buy'])) {
            if (isset($_COOKIE['char'])) {
                $check_char = $this->model->infoChar($_COOKIE['char'], $this->data['id']);
                if ($check_char['account'] == $this->data['id']) {
                    $sql = $this->model->issetItem($_POST['id'], $_POST['id_t']);
                    if ($sql['id_item'] == $_POST['id']) {
                        if ($check_char['online'] == 0) {
                            if ($_POST['bonus'] == 'dp') {
                                $bonus = $this->data['bonus'] - $sql['price'];
                                $coll = 'bonus';
                                $collLogs = 'price';
                            } else {
                                $bonus = $this->data['bonus_vp'] - $sql['price_vp'];
                                $coll = 'bonus_vp';
                                $collLogs = 'price_vp';
                            }
                            if ($bonus >= 0) {
                                $this->model->bonusUser($this->data['id'], $bonus, $coll);
                                $max = $this->model->mailMax();
                                $max = $max['id'] + 15;
                                $subject = '2';
                                $body = '1';
                                $time = time();
                                $expire_time = $time + 2592000;
                                $deliver_time = $time - 36000;
                                $item_guid = $this->model->itemGuid();
                                $item_guid = $item_guid['guid'] + 20;
                                $enchantments = "0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 ";
                                $owner_guid = $_COOKIE['char'];
                                $id_item = $_POST['id'];
                                if ($sql['charge'] == 1) {
                                    $charge = '-1 0 0 0 0';
                                } else {
                                    $charge = '0 0 0 0 0';
                                }
                                $count = $sql['number'];
                                $this->model->itemCreate($item_guid, $id_item, $owner_guid, $count, $enchantments, $charge);
                                $stationery = 61;
                                $has_items = 1;
                                $money = 0;
                                $this->model->mailCreate($max, $stationery, $owner_guid, $subject, $body, $has_items, $expire_time, $deliver_time, $money);
                                $this->model->mailItemsCreate($max, $item_guid, $owner_guid);
                                $log_item = $sql[$collLogs] . "/" . $coll;
                                file_put_contents('logs/logs_shop.txt', $this->data['username'] . ':' . $_SERVER['REMOTE_ADDR'] . ':' . $_SERVER['REQUEST_URI'] . ':' . $log_item . ':' . $id_item . ':' . $sql['name_item'] . ':' . $time . "\n", FILE_APPEND);
                                $this->eleAdd("succes", $this->data['lang']->thingBeenSentYouMail);
                                Controller::createMessage('succes', 'thingBeenSentYouMail');
                            } else {
                                Controller::createMessage('error', 'noyEboughBonus');
                            }
                        } else {
                            Controller::createMessage('error', 'charOnline');
                        }
                    } else {
                        Controller::createMessage('error', 'subjectNotPresent');
                    }
                } else {
                    Controller::createMessage('error', 'chooseYouChar');
                }
            } else {
                Controller::createMessage('error', 'chooseYouChar');
            }
        }
        $get = explode('/', $_SERVER['REQUEST_URI']);
        //$realmid = $this->model->selectRealmId($_COOKIE['realm']);
        if (isset($_POST['search'])) {
            $this->checkCsrfToken($this->data['username'], $_POST['CSRF']);
            if (!empty($_POST['id'])) {
                $item = $this->model->issetItems($_POST['id'], 1);
                if ($item['id_item'] == $_POST['id']) {
                    $this->eleAdd("data", $item);
                } else {
                    Controller::createMessage('error', 'objectNotFound');
                }
                $this->view->generate('search_view.tpl', 'template_view.tpl', $this->data);
            } else {
                $this->eleAdd("error", $this->data['lang']->errorFill);
            }
        } else {
            $this->eleAdd("data", $this->model->getDataShop($get[4], $get[3], 1));
            $this->eleAdd("pages", $this->model->pages());
            $this->view->generate('shop_view', 'template_view', $this->data);
        }
    }
    function action_vip()
    {
        Controller::createTitle('titleVip');
        if (isset($_POST['vip'])) {
            //$this->checkCsrfToken($this->data['username'], $_POST['CSRF']);
            $sql = $this->model->getDataVip($this->data['id']);
            $sql_bonus = $this->model->getBonus($this->data['id']);
            $bonus = $sql_bonus['bonus'] - $this->data['system']['price_vip'];
            if ($bonus >= 0) {
                $time = time();
                if (!$sql) {
                    $time_new = $time + 84600 * 30;
                    $this->model->updateBonus($this->data['id'], $bonus);
                    $this->model->insertVip($this->data['id'], $time, $time_new);
                    $this->eleAdd("succes", $this->data['lang']->vipBuy);
                    header("Refresh: 1; /auth/vip");

                }else if($sql['unsetdate'] == $sql['setdate']) {
                    $this->eleAdd("error", $this->data['lang']->vipOk);
                    header("Refresh: 1; /auth/vip");
                } else if($sql['unsetdate']>=$time) {
                    $time_prod = $sql['unsetdate'] + (84600 * 30);
                    $this->model->updateVip($this->data['id'], $time_prod);
                    $this->model->updateBonus($this->data['id'], $bonus);
                    $this->eleAdd("succes", $this->data['lang']->vipExtend);
                    header("Refresh: 1; /auth/vip");
                }else{
                    $time_prod = $time + 84600;
                    $this->model->updateVip($this->data['id'], $time_prod);
                    $this->model->updateBonus($this->data['id'], $bonus);
                    $this->eleAdd("succes", $this->data['lang']->vipExtend); 
                    header("Refresh: 1; /auth/vip");
                }
            } else {
                $this->eleAdd("error", $this->data['lang']->noyEboughBonus);
                header("Refresh: 1; /auth/vip");
            }
        }
        if (isset($_POST['vip_all'])) {
            $sql = $this->model->getDataVip($this->data['id']);
            $sql_bonus = $this->model->getBonus($this->data['id']);
            $bonus = $sql_bonus['bonus'] - $this->data['system']['price_vip_all'];
            if (!$sql) {
                if ($bonus >= 0) {
                    $time = time();
                    $this->model->updateBonus($this->data['id'], $bonus);
                    $this->model->insertVipAll($this->data['id'], $time, $time);
                    $this->eleAdd("succes", $this->data['lang']->vipBuy);
                    header("Refresh: 1; /auth/vip");
                }else{
                    $this->eleAdd("error", $this->data['lang']->noyEboughBonus);
                    header("Refresh: 1; /auth/vip");  
                }
            }else if ($sql['unsetdate'] == $sql['setdate']) {
                $this->eleAdd("error", $this->data['lang']->vipOk);
                    header("Refresh: 1; /auth/vip");  
            }else{
                if($bonus >= 0) {
                    if($sql['unsetdate']>=$time) {
                                    $time = time();
                                    $this->model->updateVipAll($this->data['id'], $time, $time);
                                    $this->model->updateBonus($this->data['id'], $bonus);
                                    $this->eleAdd("succes", $this->data['lang']->vipExtend);
                                    header("Refresh: 1; /auth/vip");
                    }else if($sql['unsetdate']<=$time) {
                                    $time = time();
                                    $this->model->updateVipAll($this->data['id'], $time, $time);
                                    $this->model->updateBonus($this->data['id'], $bonus);
                                    $this->eleAdd("succes", $this->data['lang']->vipExtend);
                                    header("Refresh: 1; /auth/vip");
                    }         
                }else{
                    $this->eleAdd("error", $this->data['lang']->noyEboughBonus);
                    header("Refresh: 1; /auth/vip");  
            }
            }  
        }

        $datevip = $this->model->getViptime($this->data['id']);
        if($datevip){
            if($datevip['unsetdate']==$datevip['setdate']){
            echo "У вас неограниченный VIP";   
            }else{
            $datevip = $datevip['unsetdate'];
            $time = time();
            $datevip = date("d.m.Y",$datevip);
            $slogan = 'Вип действителен до  ';
            echo $slogan;echo $datevip;
            }
        }else{
            echo "У вас нет VIP";  
        }

        if (isset($_POST['vip_vp'])) {
            //$this->checkCsrfToken($this->data['username'], $_POST['CSRF']);
            $sql = $this->model->getDataVip($this->data['id']);
            $sql_bonus = $this->model->getBonusvp($this->data['id']);
            $bonus = $sql_bonus['bonus_vp'] - $this->data['system']['price_vip_vp'];
            if($sql['unsetdate'] == $sql['setdate']) {
                    $this->eleAdd("error", $this->data['lang']->vipOk);
                    header("Refresh: 1; /auth/vip");
                }else if ($bonus >= 0) {
                $time = time();
                if (!$sql) {
                    $time_new = $time + 84600 * 1;
                    $this->model->updateBonusVP($this->data['id'], $bonus);
                    $this->model->insertVip($this->data['id'], $time, $time_new);
                    $this->eleAdd("succes", $this->data['lang']->vipBuy);
                    header("Refresh: 1; /auth/vip");

                }else if($sql['unsetdate']>$time) {
                    $time_prod = $sql['unsetdate'] + 84600 * 1;
                    $this->model->updateVip($this->data['id'], $time_prod);
                    $this->model->updateBonusVP($this->data['id'], $bonus);
                    $this->eleAdd("succes", $this->data['lang']->vipExtend);
                    header("Refresh: 1; /auth/vip");
                }else{
                    $time_prod = $time + 84600;
                    $this->model->updateVip($this->data['id'], $time_prod);
                    $this->model->updateBonusVP($this->data['id'], $bonus);
                    $this->eleAdd("succes", $this->data['lang']->vipExtend);
                    header("Refresh: 1; /auth/vip");
                }
            } else {
                $this->eleAdd("error", $this->data['lang']->noyEboughBonus);
                header("Refresh: 1; /auth/vip");
            }
        }
        $this->view->generate('vip_view', 'template_view', $this->data); 
    }

    function action_levelup()
    {
        Controller::createTitle('titleLevelup');
        if (isset($_POST['levelup'])) {
            $this->checkCsrfToken($this->data['username'], $_POST['CSRF']);
            if (isset($this->data['char'])) {
                if (!empty($_POST['level'])) {
                    if($this->data['char']['online'] == 0){
                    $levelsum = $this->data['char']['level'] + $_POST['level'];
                    if($levelsum > $this->data['char']['level']){
                    if ($levelsum < 81) {
                                $data = $this->model->getBonusvp($this->data['id']);
                                $bonus = $this->data['bonus'] - $this->data['system']['price_levelup'] * $_POST['level'];
                                if ($bonus >= 0) {
                                    $name = $this->data['char'];
                                    $this->model->updateLevel($this->data['char']['name'], $levelsum);
                                    $this->model->updateBonus($this->data['id'], $bonus);
                                    Controller::createMessage('succes', 'levelSuccess');
                                    header("Refresh: 1; /auth/levelup/");
                                } else {
                                    Controller::createMessage('error', 'noyEnoughBonusPrice', '5 VP за уровень');
                                }
                    } else {
                        Controller::createMessage('error', 'levelLevelUp');
                    }
                   } else {
                        Controller::createMessage('error', 'notNum');
                    }
                  } else {
                    Controller::createMessage('error', 'charOnline');
                }
                } else {
                    Controller::createMessage('error', 'emptyLevelUp');
                }
            } else {
                Controller::createMessage('error', 'chooseYouChar');
            }
        }
        $this->view->generate('levelup_view', 'template_view', $this->data); 
    }

    function action_vote()
    {
        Controller::addUserVote();
        Controller::createTitle('voteSystem');
        $this->eleAdd("data", $this->model->getVote($this->data['username']));
        $this->view->generate('vote_view', 'template_view', $this->data);
    }


    function action_change_realm()
    {
        Controller::createTitle('changeRealm');
        if (isset($_POST['change_realm'])) {
            $realm_key = md5($_POST['realm'] . "./5$@#%6./");
            setcookie('realm', $realm_key, time() + 87200, '/');
            Controller::createMessage('succes', 'realmReplace', $_POST['realm']);
        }
        $this->eleAdd("data", $this->model->selectRealm());
        $this->view->generate('realm_view', 'template_view', $this->data);
    }

    function action_change_genged()
    {
        Controller::createTitle('changeGenged');
        if (isset($_POST['change_gender'])) {
            $this->checkCsrfToken($this->data['username'], $_POST['CSRF']);
            $char = $this->model->infoCharName($_POST['name']);
            if ($char['account'] == $this->data['id']) {
            } else {
                Controller::createMessage('error', 'errorCharDoesNotBelongYou');
            }
            if ($char['gender'] == $_POST['gender_char']) {
                Controller::createMessage('error', 'youAlreadFloor');
            } else {
                $bonus = $this->data['bonus_vp'] - $this->data['system']['price_genger'];
                if ($bonus >= 0) {
                    $this->model->updateBonusVp($this->data['id'], $bonus);
                    $this->model->updateGender($this->data['id'], $_POST['gender_char'], $_POST['name']);
                    Controller::createMessage('succes', 'floorReplaced');
                    header("Refresh: 2; /auth");
                } else {
                    Controller::createMessage('error', 'noyEnoughBonusPrice', $this->data['system']['price_genger'] . " Vp )");
                }
            }
        }
        $this->eleAdd("data", $this->model->infoChars($this->data['id']));
        $this->view->generate('genger_view', 'template_view', $this->data);
    }

    function action_change_char()
    {
        Controller::createTitle('changeChar');
        if (isset($_POST['change_char'])) {
            $sql = $this->model->getCharName($_POST['name']);
            if ($sql['account'] == $this->data['id']) {
                setcookie('char', $sql['guid'], time() + 37200 * 20, '/');
                Controller::createMessage('succes', 'changeSucces');
                header("Refresh: 1; /auth");
            } else {
                Controller::createMessage('error', 'errorCharDoesNotBelongYou');
            }
        }
        $this->eleAdd("data", $this->model->getChars($this->data['id']));
        $this->view->generate('change_char_view', 'template_view', $this->data);
    }

    function action_lang()
    {
        Controller::createTitle('changeLang');
        $get = explode('/', $_SERVER['REQUEST_URI']);
        if (!empty($get[3])) {
            if (file_exists("./application/langs/" . $get[3] . ".xml")) {
                setcookie('lang', $get[3], time() + 7200, '/');
                $url = getenv("HTTP_REFERER");
                header("Location: " . $url);
            } else {

            }
        }
        $this->view->generate('main_view', 'template_view', $this->data);
    }

    function action_tele()
    {
        Controller::createTitle('teleCharHome');
        if (isset($_POST['tele'])) {
            $this->checkCsrfToken($this->data['username'], $_POST['CSRF']);
            $check_char = $this->model->infoChar($_COOKIE['char'], $this->data['id']);
            if (isset($_COOKIE['char']) AND $check_char['account'] == $this->data['id']) {
                if ($check_char['online'] == 0) {
                    $positionMap = $this->model->getPosition($check_char['guid']);
                    $this->model->savePosition($positionMap['posX'], $positionMap['posY'], $positionMap['posZ'], $positionMap['mapId'], $positionMap['zoneId'], $check_char['guid']);
                    Controller::createMessage('succes', 'succesLang');
                } else {
                    $this->eleAdd("error", 'Выйдите из игры!');
                }
            } else {
                Controller::createMessage('error', 'chooseYouChar');
            }
        }
        $this->view->generate('tele_view', 'template_view', $this->data);
    }

    function action_change_name()
    {
        Controller::createTitle('changeName');
        if (isset($_POST['change_name'])) {
            $this->checkCsrfToken($this->data['username'], $_POST['CSRF']);
            if (isset($this->data['char'])) {
                if (!empty($_POST['name'])) {
                    if ($this->data['name'] != $_POST['name']) {
                        if (preg_match('|^[A-Z0-9]+$|i', $_POST['name'])) {
                            $name_char = ucfirst($_POST['name']);
                            $infoCharname = $this->model->infoCharName($name_char);
                            if ($infoCharname['name'] != $name_char) {
                                $bonus = $this->data['bonus_vp'] - $this->data['system']['price_change_name'];
                                if ($bonus >= 0) {
                                    $this->model->upCharName($name_char, $this->data['id'], $_COOKIE['char']);
                                    $this->model->updateBonusVp($this->data['id'], $bonus);
                                    Controller::createMessage('succes', 'changeSucces');
                                    header("Refresh: 1; /auth/change_name/");
                                } else {
                                    Controller::createMessage('error', 'noyEnoughBonusPrice', '50 VP)');
                                }
                            } else {
                                Controller::createMessage('error', 'nameOccepied');
                            }
                        } else {
                            Controller::createMessage('error', 'useOnlyEnglish');
                        }
                    } else {
                        Controller::createMessage('error', 'characterAlreadName');
                    }
                } else {
                    Controller::createMessage('error', 'filAllFields');
                }
            } else {
                Controller::createMessage('error', 'chooseYouChar');
            }
        }
        $this->view->generate('change_name_view', 'template_view', $this->data);

    }

    function action_ticket()
    {
        Controller::createTitle('ticket');
        if (isset($_POST['ticket'])) {
            $this->checkCsrfToken($this->data['username'], $_POST['CSRF']);
            if (!empty($_POST['name']) && !empty($_POST['text']) && !empty($_POST['primany'])) {
                $ticket = $this->model->getDataTicket($_POST['name'], $this->data['id']);
                if ($ticket['name'] != $_POST['name']) {
                    $name = $this->strip($_POST['name']);
                    $text = $this->strip($_POST['text']);
                    $primany = $this->strip($_POST['primany']);
                    $this->model->addDataTicket($name, $text, $primany, $this->data['id'], time(), $_SERVER['REMOTE_ADDR']);
                    $this->eleAdd("succes", 'Вопрос задан ожидайте ответа!');
                } else {
                    $this->eleAdd("error", 'Данный вопрос уже задан вами!');
                }
            } else {
                Controller::createMessage('error', 'filAllFields');
            }

        }

        $this->view->generate('ticket_view', 'template_view', $this->data);
    }

    function action_view_ticket()
    {
        Controller::createTitle('ticketAll');
        $get = explode('/', $_SERVER['REQUEST_URI']);
        $this->eleAdd("data", $this->model->getDataTickets($get[3], $this->data['id']));
        $this->eleAdd("pages", $this->model->page());
        $this->view->generate('ticket_print_view', 'template_view', $this->data);
    }

    function action_reply_ticket()
    {
        Controller::createTitle('ticketReply');
        $get = explode('/', $_SERVER['REQUEST_URI']);

        if (isset($_POST['ticket'])) {
            $this->checkCsrfToken($this->data['username'], $_POST['CSRF']);
            if (!empty($_POST['text'])) {
                $text = $this->strip($_POST['text']);
                $this->model->addDataTicketReply($get[3], $text, time(), $this->data['id'], $this->data['id']);
                $this->eleAdd("succes", 'Ваш ответ добавлен!');
            } else {
                Controller::createMessage('error', 'filAllFields');
            }
        }
        $this->eleAdd("ticket_one", $this->model->getDataTicketIdOne($get[3], $this->data['id']));
        $this->eleAdd("data", $this->model->getDataTicketId($get[3], $this->data['id']));
        $this->view->generate('ticket_reply_view', 'template_view', $this->data);
    }

    function action_pay()
    {
        Controller::createTitle('payBonus');
        if (isset($_POST['donat'])) {
            $this->checkCsrfToken($this->data['username'], $_POST['CSRF']);
            $order_id = $this->data['id'] . time();
            $summa = (int)$_POST['summa'];
            $order_amount = $summa . '.00';
            $this->model->addOperation($this->data['username'], $order_amount, $order_id);
            $this->eleAdd("merchant_id", $this->data['system']['merchantId']);
            $this->eleAdd("secret_word", $this->data['system']['merchantSecretOne']);
            $this->eleAdd("order_id", $order_id);
            $this->eleAdd("order_amount", $order_amount);
            $this->eleAdd("sign", md5($this->data['system']['merchantId'] . ':' . $order_amount . ':' . $this->data['system']['merchantSecretOne'] . ':' . $order_id));
            $this->view->generate('donat_view', 'template_view', $this->data);
        } else {
            $this->view->generate('pay_view', 'template_view', $this->data);
        }
    }

    function action_false()
    {
        $this->eleAdd("title", 'Не удачная попытка.');
        $this->view->generate('pay_view', 'template_view', $this->data);
    }

    function action_succes()
    {
        $this->eleAdd("title", 'Оплата прошла успешно.');
        if (!isset($_POST)) {
            die('hacking attempt!');
        }
        $this->view->generate('pay_view', 'template_view', $this->data);
    }


    function action_binding_ip()
    {
        Controller::createTitle('bindingIp');
        if (isset($_POST['bingind'])) {
            $this->checkCsrfToken($this->data['username'], $_POST['CSRF']);
            if ($this->data['binding_ip'] != 1) {
                $this->model->bindingIp($this->data['username'], $this->data['guid']);
                Controller::createMessage('succes', 'bindingIpSucces');
            } else {
                Controller::createMessage('error', 'bindingIpFalse');
            }
        }
        $this->view->generate('binding_ip_view', 'template_view', $this->data);
    }

    function action_get_bonuses()
    {
        Controller::createTitle('getBonuses');
        $this->view->generate('get_bonuses_view', 'template_view', $this->data);
    }

    function action_change_race()
    {
        Controller::createTitle('changeRace');
        $this->view->generate('change_race_view', 'template_view', $this->data);
    }

    function action_change_fraction()
    {
        Controller::createTitle('changeFraction');
        $this->view->generate('change_fraction_view', 'template_view', $this->data);
    }

    function action_buy_valut()
    {
        Controller::createTitle('buyValut');
        if (isset($_POST['gold'])) {
            if (isset($this->data['char'])) {
                if (!empty($_POST['num'])) {
                    if ($_POST['num'] > 0) {
                        $num = (int)$_POST['num'];
                        $charMoney = $this->data['char']['money'] / 10000 + $num;
                        if ($charMoney <= 214000) {
                            $bonus = $this->data['system']['price_gold'] * $num;
                            echo $bonus;
                            $bonusAcc = $this->data['bonus'] - $bonus;
                            if($this->data['char']['online'] == 0){
                            if ($bonusAcc >= 0) {
                                $gold = $num * 10000;
                                $this->model->upBonus($this->data['id'], $bonus);
                                $this->model->addGoldChar($this->data['char']['guid'], $gold);
                                Controller::createMessage('succes', 'addValutAcc');
                                header("Refresh: 1; /auth/buy_valut");
                            } else {
                                Controller::createMessage('error', 'noyEnoughBonusPrice', $bonus . $this->data['lang']->dp);
                                header("Refresh: 1; /auth/buy_valut");
                            }
                            } else {
                            Controller::createMessage('error', 'charOnline');
                         }
                        } else {
                            Controller::createMessage('error', 'goldMax');
                        }
                    } else {
                        Controller::createMessage('error', 'minValut');
                    }
                } else {
                    Controller::createMessage('error', 'filAllFields');
                }
            } else {
                Controller::createMessage('error', 'chooseYouChar');
            }
        }
        if (isset($_POST['arena'])) {
            if (isset($this->data['char'])) {
                if (!empty($_POST['num'])) {
                    if ($_POST['num'] > 0) {
                        $num = (int)$_POST['num'];
                        $charArena = $this->data['char']['arenaPoints'] + $num;
                        if ($charArena <= $this->data['system']['max_num_arena']) {
                            $bonus = $this->data['system']['price_arena'] * $num;
                            $bonusAcc = $this->data['bonus'] - $bonus;
                            if($this->data['char']['online'] == 0){
                            if ($bonusAcc >= 0) {
                                $this->model->upBonus($this->data['id'], $bonus);
                                $this->model->addArenaChar($this->data['char']['guid'], $num);
                                Controller::createMessage('succes', 'addValutAcc');
                                header("Refresh: 1; /auth/buy_valut");
                            } else {
                                Controller::createMessage('error', 'noyEnoughBonusPrice', $bonus . $this->data['lang']->dp);
                                header("Refresh: 1; /auth/buy_valut");
                            }
                            } else {
                            Controller::createMessage('error', 'charOnline');
                         }
                        } else {
                            Controller::createMessage('error', 'exceedNumValut');
                        }
                    } else {
                        Controller::createMessage('error', 'minValut');
                    }
                } else {
                    Controller::createMessage('error', 'filAllFields');
                }
            } else {
                Controller::createMessage('error', 'chooseYouChar');
            }
        }
        if (isset($_POST['honor'])) {
            if (isset($this->data['char'])) {
                if (!empty($_POST['num'])) {
                    if ($_POST['num'] > 0) {
                        $num = (int)$_POST['num'];
                        $charHonor = $this->data['char']['totalHonorPoints'] + $num;
                        if ($charHonor <= $this->data['system']['max_num_honor']) {
                            $bonus = $this->data['system']['price_honor'] * $num;
                            $bonusAcc = $this->data['bonus'] - $bonus;
                            if($this->data['char']['online'] == 0){
                            if ($bonusAcc >= 0) {
                                $this->model->upBonus($this->data['id'], $bonus);
                                $this->model->addHonorChar($this->data['char']['guid'], $num);
                                Controller::createMessage('succes', 'addValutAcc');
                                header("Refresh: 1; /auth/buy_valut");
                            } else {
                                Controller::createMessage('error', 'noyEnoughBonusPrice', $bonus . $this->data['lang']->dp);
                                header("Refresh: 1; /auth/buy_valut");
                            }
                            } else {
                            Controller::createMessage('error', 'charOnline');
                         }
                        } else {
                            Controller::createMessage('error', 'exceedNumValut');
                        }
                    } else {
                        Controller::createMessage('error', 'minValut');
                    }
                } else {
                    Controller::createMessage('error', 'filAllFields');
                }
            } else {
                Controller::createMessage('error', 'chooseYouChar');
            }
        }
        $this->view->generate('buy_valuts_view', 'template_view', $this->data);
    }

}

