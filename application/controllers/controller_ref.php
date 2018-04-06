<?php

class Controller_Ref extends Controller
{
    function __construct()
    {
        $this->model = new Model_Ref();
        $this->view = new View();
        $this->statusSystem();
    }

    function action_index()
    {
        $this->checkAuthorization();
        Controller::createTitle('ref');
        $this->generateCsrfToken($this->data['username']);
        if (isset($_POST['ref'])) {
            $sql = $this->model->getDataRefs($this->data['link_ref'], $_POST['username']);
            if ($sql['username'] == $_POST['username']) {
                $sql_acc = $this->model->getAcc($sql['username']);
                $sql_get = $this->model->getCharRef($sql_acc['id']);
                $time = $sql['time_reg'] + $this->data['system']['time_ref'];
                if ($sql_get['max(totaltime)'] >= $time) {
                    if ($sql['usings'] == 0) {
                        $accIpRef = $this->model->getAccIp($_POST['username']);
                        if ($this->data['ip'] != $accIpRef['last_ip']) {
                            $this->model->updateRef($sql['link_ref'], $sql_acc['username'], $this->data['system']['price_ref']);
                            Controller::createMessage('succes', 'regeralBeenTested');
                        } else {
                            Controller::createMessage('error', 'gleichIp');
                        }
                    } else {
                        Controller::createMessage('error', 'youAlreadReceivBonusForIt');
                    }
                } else {
                    Controller::createMessage('error', 'playerDidNotLoseDay');
                }
            } else {
                Controller::createMessage('error', 'accountDoesNotBelongYou');
            }
        }
        $this->eleAdd('data', $this->model->getDataRef($this->data['link_ref']));
        $this->view->generate('ref_view', 'template_view', $this->data);
    }

    function action_reg()
    {
        Controller::createTitle('checkIn');
        if (isset($_POST['reg'])) {
            if (empty($_POST['account']) && empty($_POST['mail']) && empty($_POST['password']) && empty($_POST['password_2']) && empty($_POST['what'])) {
                Controller::createMessage('error', 'filAllFields');
            } else {
                $user_sql = $this->model->getData($_POST['account'], $_POST['mail']);
                if ($user_sql == false) {
                    if ($_POST['password'] == $_POST['password_2']) {
                        if (!class_exists('KeyCAPTCHA_CLASS')) {
                            include('./application/captcha/keycaptcha.php');
                        }
                        $kc_o = new KeyCAPTCHA_CLASS();
                        if ($kc_o->check_result($_POST['capcode'])) {
                            $get = explode('/', $_SERVER['REQUEST_URI']);
                            $link_ref = $get['3'];
                            $this->model->enterData($_POST['account'], $_POST['password'], $_POST['mail']);
                            $this->model->enterRef($_POST['account'], $link_ref);
                            Controller::createMessage('succes', 'youAccBeenRegist');
                            header("Refresh: 1; /login/");
                        } else {
                            Controller::createMessage('error', 'captchaNoyValid');
                        }
                    } else {
                        Controller::createMessage('error', 'passNotMatch');
                    }
                } else {
                    Controller::createMessage('error', 'mailOrUserAlreadyUse');
                }
            }
        }
        $this->view->generateExtrnalPage('reg_view', 'template_login_view', $this->data);
    }

} 
