<?php

class Controller_Ajax extends Ajax
{
    function __construct()
    {
        $this->model = new Model_Auth();
        $this->statusSystem();
        $this->checkAuthorization();
    }

    function action_change_mail()
    {
        $data = json_decode($_POST['jsonData']);
        if (isset($_POST['jsonData'])) {
            $this->checkCsrfToken($this->data['username'], $data->{'CSRF'});
            $dataNewEmail = $this->model->getEmail($data->{'mail'});
            if ($dataNewEmail['email'] != $data->{'mail'}) {
                if (!empty($data->{'mail'})) {
                    $this->model->changeMail($data->{'mail'}, $this->data['username']);
                    $this->ourResultS($this->data['lang']->succesLang);
                } else {
                    $this->ourResultE($this->data['lang']->errorFill);
                }
            } else {
                $this->ourResultE($this->data['lang']->mailBusy);
            }
        }
    }

    function action_change_race()
    {
        $data = json_decode($_POST['jsonData']);
        if (isset($_POST['jsonData'])) {
            $this->checkCsrfToken($this->data['username'], $data->{'CSRF'});
            if (isset($this->data['char'])) {
                $bonus = $this->data['bonus'] - $this->data['system']['price_change_race'];
                if ($bonus >= 0) {
                    $this->model->updateBonus($this->data['id'], $bonus);
                    $this->model->changeRace($this->data['char']['guid']);
                    $this->ourResultS($this->data['lang']->succesLang);
                } else {
                    $this->ourResultE($this->data['lang']->noyEboughBonus);
                }
            } else {
                $this->ourResultE($this->data['lang']->chooseYouChar);
            }
        }
    }

    function  action_receipt_bonus()
    {
        $data = json_decode($_POST['jsonData']);
        if (isset($_POST['jsonData'])) {
            $this->checkCsrfToken($this->data['username'], $data->{'CSRF'});
            $vote = $this->model->getVote($this->data['username'], $data->{'time'});
            if ($vote['time_vote'] == $data->{'time'}) {
               $this->model->addBonusVote($this->data['username'], $this->data['system']['bonus_vote'], time(), $data->{'time'});
                $this->ourResultS($this->data['lang']->bonusesCreditInAcc);
            } else {
                $this->ourResultE($this->data['lang']->alreadyVoteBonusDay);
            }
        }
    }

    function action_change_fraction()
    {
        $data = json_decode($_POST['jsonData']);
        if (isset($_POST['jsonData'])) {
            $this->checkCsrfToken($this->data['username'], $data->{'CSRF'});
            if (isset($this->data['char'])) {
                $bonus = $this->data['bonus'] - $this->data['system']['price_change_fraction'];
                if ($bonus >= 0) {
                    $this->model->updateBonus($this->data['id'], $bonus);
                    $this->model->changeFraction($this->data['char']['guid']);
                    $this->ourResultS($this->data['lang']->succesLang);
                } else {
                    $this->ourResultE($this->data['lang']->noyEboughBonus);
                }
            } else {
                $this->ourResultE($this->data['lang']->chooseYouChar);
            }
        }
    }

    function action_change_pass()
    {
        $data = json_decode($_POST['jsonData']);
        if (isset($_POST['jsonData'])) {
            $this->checkCsrfToken($this->data['username'], $data->{'CSRF'});
            if (!empty($data->{'password'}) && !empty($data->{'password_2'}) && !empty($data->{'password_old'}) && $data->{'password'} == $data->{'password_2'}) {
                $password_acc = $this->model->infoAccServer($this->data['username'], $data->{'password_old'});
                if ($password_acc) {
                    $this->model->changePassword($this->data['username'], $data->{'password'});
                    $this->ourResultS($this->data['lang']->succesLang);
                } else {
                    $this->ourResultE($this->data['lang']->oldPassIncorrect);
                }
            } else {
                $this->ourResultE($this->data['lang']->errorFill);
            }
        }
    }

    function action_binding_ip()
    {
        $data = json_decode($_POST['jsonData']);
        if (isset($_POST['jsonData'])) {
            $this->checkCsrfToken($this->data['username'], $data->{'CSRF'});
            if ($this->data['binding_ip'] != 1) {
                $this->model->bindingIp($this->data['username'], $this->data['guid']);
                $this->ourResultS($this->data['lang']->bindingIpSucces);
            } else {
                $this->ourResultE($this->data['lang']->bindingIpFalse);
            }
        }
    }


    function action_change_realm()
    {
        $data = json_decode($_POST['jsonData']);
        if (isset($_POST['jsonData'])) {
            $realm_key = md5($data->{'realm'} . "./5$@#%6./");
            setcookie('realm', $realm_key, time() + 87200, '/');
            $this->ourResultS("succes", $this->data['lang']->realmReplace . $data->{'realm'});
        }

    }


    function action_tele()
    {
        $data = json_decode($_POST['jsonData']);
        $this->generateCsrfToken($this->data['username']);
        if (isset($_POST['jsonData'])) {
            $this->checkCsrfToken($this->data['username'], $data->{'CSRF'});
            $check_char = $this->model->infoChar($_COOKIE['char'], $this->data['id']);
            if (isset($_COOKIE['char']) AND $check_char['account'] == $this->data['id']) {
                if ($check_char['online'] == 0) {
                    $positionMap = $this->model->getPosition($check_char['guid']);
                    $this->model->savePosition($positionMap['posX'], $positionMap['posY'], $positionMap['posZ'], $positionMap['mapId'], $positionMap['zoneId'], $check_char['guid']);
                    $this->ourResultS($this->data['lang']->succesLang);
                } else {
                    $this->ourResultE('Выйдите из игры!');
                }
            } else {
                $this->ourResultE($this->data['lang']->chooseYouChar);
            }
        }
    }

    function action_change_name()
    {
        $this->eleAdd("title", $this->data['lang']->changeName);
        $this->generateCsrfToken($this->data['username']);
        if (isset($_COOKIE['char'])) {
            $char = $this->model->infoChar($_COOKIE['char'], $this->data['id']);
            if (isset($_POST['change_name'])) {
                $this->checkCsrfToken($this->data['username'], $_POST['CSRF']);
                if (!empty($_POST['name'])) {
                    if ($char['name'] != $_POST['name']) {
                        if (preg_match('|^[A-Z0-9]+$|i', $_POST['name'])) {
                            $name_char = ucfirst($_POST['name']);
                            $infoCharname = $this->model->infoCharName($name_char);
                            if ($infoCharname['name'] != $name_char) {
                                $bonus = $this->data['bonus_vp'] - 50;
                                if ($bonus >= 0) {
                                    $this->model->upCharName($name_char, $this->data['id'], $_COOKIE['char']);
                                    $this->model->updateBonusVp($this->data['id'], $bonus);
                                    $this->eleAdd("succes", $this->data['changeSucces']);
                                    header("Refresh: 1; /auth/change_name/");
                                } else {
                                    $this->eleAdd("error", $this->data['noyEnoughBonusPrice'] . "50 VP)");
                                }
                            } else {
                                $this->eleAdd("error", $this->data['nameOccepied']);
                            }
                        } else {
                            $this->eleAdd("error", $this->data['useOnlyEnglish']);
                        }
                    } else {
                        $this->eleAdd("error", $this->data['characterAlreadName']);
                    }
                } else {
                    $this->eleAdd("error", $this->data['filAllFields']);
                }
            }
            $this->eleAdd("data", $char);
        } else {
            $this->eleAdd("error", $this->data['chooseYouChar']);
        }
        $this->view->generate('change_name_view.tpl', 'template_view.tpl', $this->data);

    }

    function action_ticket()
    {
        $this->eleAdd("title", $this->data['lang']->ticket);
        $this->generateCsrfToken($this->data['username']);

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
                $this->eleAdd("error", $this->data['filAllFields']);
            }

        }

        $this->view->generate('ticket_view.tpl', 'template_view.tpl', $this->data);
    }

    function action_view_ticket()
    {
        $this->eleAdd("title", $this->data['lang']->ticketAll);
        $get = explode('/', $_SERVER['REQUEST_URI']);
        $this->eleAdd("data", $this->model->getDataTickets($get[3], $this->data['id']));
        $this->eleAdd("pages", $this->model->page());
        $this->view->generate('ticket_print_view.tpl', 'template_view.tpl', $this->data);
    }

    /**
     *
     */
    function action_reply_ticket()
    {
        $this->eleAdd("title", $this->data['lang']->ticketReply);
        $this->generateCsrfToken($this->data['username']);
        $get = explode('/', $_SERVER['REQUEST_URI']);

        if (isset($_POST['ticket'])) {
            $this->checkCsrfToken($this->data['username'], $_POST['CSRF']);
            if (!empty($_POST['text'])) {
                $text = $this->strip($_POST['text']);
                $this->model->addDataTicketReply($get[3], $text, time(), $this->data['id'], $this->data['id']);
                $this->eleAdd("succes", 'Ваш ответ добавлен!');
            } else {
                $this->eleAdd("error", $this->data['filAllFields']);
            }
        }
        $this->eleAdd("ticket_one", $this->model->getDataTicketIdOne($get[3], $this->data['id']));
        $this->eleAdd("data", $this->model->getDataTicketId($get[3], $this->data['id']));
        $this->view->generate('ticket_reply_view.tpl', 'template_view.tpl', $this->data);
    }

    /**
     *
     */
    function action_pay()
    {
        $this->eleAdd("title", $this->data['lang']->payBonus);
        if (isset($_POST['donat'])) {
            $merchant_id = '34828';
            $secret_word = 'vxu8r529';
            $order_id = $this->data['id'] . time();
            $summa = (int)$_POST['summa'];
            $order_amount = $summa . '.00';
            $sign = md5($merchant_id . ':' . $order_amount . ':' . $secret_word . ':' . $order_id);
            $this->model->addOperation($this->data['username'], $order_amount, $order_id);
            $this->eleAdd("merchant_id", $merchant_id);
            $this->eleAdd("secret_word", $secret_word);
            $this->eleAdd("order_id", $order_id);
            $this->eleAdd("order_amount", $order_amount);
            $this->eleAdd("sign", $sign);
            $this->view->generate('donat_view.tpl', 'template_view.tpl', $this->data);
        } else {
            $this->view->generate('pay_view.tpl', 'template_view.tpl', $this->data);
        }
    }

    function action_false()
    {
        $this->eleAdd("title", 'Не удачная попытка.');
        $this->view->generate('pay_view.tpl', 'template_view.tpl', $this->data);
    }

    function action_succes()
    {
        $this->eleAdd("title", 'Оплата прошла успешно.');
        if (!isset($_POST)) {
            die('hacking attempt!');
        }
        $this->view->generate('pay_view.tpl', 'template_view.tpl', $this->data);
    }


    function action_get_bonuses()
    {
        $data = json_decode($_POST['jsonData']);
        if (isset($_POST['jsonData'])) {
            $this->checkCsrfToken($this->data['username'], $data->{'CSRF'});
            if (!empty($data->{'key'})) {
                $key = $this->model->getKey($data->{'key'});
                if ($key['code'] == $data->{'key'}) {
                    $bonus_vp = $key['bonus_vp'] + $this->data['bonus_vp'];
                    $bonus_dp = $key['bonus_dp'] + $this->data['bonus'];
                    $this->model->addBonusesKey($this->data['username'], $bonus_vp, $bonus_dp);
                    $this->model->validKey($data->{'key'});
                    $this->ourResultS($this->data['lang']->bonusesCreditInAcc);
                } else {
                    $this->ourResultE($this->data['lang']->codeNotValid);
                }
            } else {
                $this->ourResultE($this->data['lang']->filAllFields);
            }
        }
    }


    function action_add_bonus()
    {
        $data = json_decode($_POST['jsonData']);
        if (isset($_POST['jsonData'])) {
            $this->checkCsrfToken($this->data['username'], $data->{'CSRF'});
            $AccPass = $this->model->getDataPassAcc($this->data['username'], $data->{'password'});
            if ($AccPass['username'] == $this->data['username']) {
                if (!empty($data->{'bonus'}) || !empty($data->{'bonus_vp'}) || !empty($data->{'password'})) {
                    if (!empty($data->{'account'}) AND $data->{'rule'} == 0) {
                        $account = $this->model->getAccount($data->{'account'});
                        if ($account['username'] == $data->{'account'}) {
                            $this->model->addBonusPanel($data->{'account'}, $data->{'bonus'}, $data->{'bonus_vp'});
                            $this->ourResultS($this->data['lang']->addBonusAcc);
                        } else {
                            $this->ourResultE($this->data['lang']->wrongAccount);
                        }
                    } elseif ($data->{'rule'} == 1) {
                        $this->model->addAllAccountBonus($data->{'bonus'}, $data->{'bonus_vp'});
                        $this->ourResultS($this->data['lang']->addBonusAllAcc);
                    } else {
                        $this->ourResultE($this->data['lang']->errorfilling);
                    }
                } else {
                    $this->ourResultE($this->data['lang']->filAllFields);
                }
            } else {
                $this->ourResultE($this->data['lang']->notValidPassword);
            }
        }
    }
}
