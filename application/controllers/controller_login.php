<?php

class Controller_Login extends Controller
{
    function __construct()
    {
        $this->model = new Model_Login();
        $this->view = new View();
        $this->statusSystem();
    }

    function action_index()
    {
        Controller::createTitle('enterPersonalArea');
        if (isset($_POST['enter'])) {
            if (!empty($_POST['account']) && !empty($_POST['password'])) {
                $account = $_POST['account'];
                $sql = $this->model->getData($account, $_POST['password']);
                if ($account == $sql['username']) {
                   if (!class_exists('KeyCAPTCHA_CLASS')) {
                       include('./application/captcha/keycaptcha.php');
                   }
                   $kc_o = new KeyCAPTCHA_CLASS();
                    if ($kc_o->check_result($_POST['capcode'])) {
                        $get = $this->model->getDataLk($_POST['account']);
                        $ip = $_SERVER['REMOTE_ADDR'];
                        $cookie = hash('sha256', $ip . ":lk:" . time());
                        if ($get['username'] == $_POST['account']) {
                            $this->model->updateData($_POST['account'], $cookie, $ip);
                        } else {
                            $link_ref = md5($account . $ip . time());
                            $this->model->insertData($sql['id'], $_POST['account'], $cookie, $ip, $link_ref);
                        }
                        setcookie('key', $cookie, time() + 7200, '/');
                        //$sql_realm = $this->model->selectLimitOne();
                        //setcookie('realm', $sql_realm['realm_key'], time() + 87200 * 32, '/');
                        header("Location: /auth/");
                    } else {
                        Controller::createMessage('error', 'captchaNoyValid');
                   }
                } else {
                    Controller::createMessage('error', 'logOrPassIncorrect');
                }
            } else {
                Controller::createMessage('error', 'filAllFields');
            }
        }
        $this->view->generateExtrnalPage('login_view', 'template_login_view', $this->data);
    }
} 
