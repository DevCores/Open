<?php

class Controller
{

    public $model;
    public $view;
    public $data = array();

    function __construct()
    {
        $this->view = new View();
        $this->model = new Model();
        $this->parseVote = new ParseVote();
    }

    /**
     * @param $key
     * @param $value
     */
    public function eleAdd($key, $value)
    {
        $this->data[$key] = $value;
    }

    /**
     * @param $key
     */
    public function eleRemove($key)
    {
        unset($this->data[$key]);
    }

    /**
     * @param $dataArray
     */
    public function addArray($dataArray)
    {
        foreach ($dataArray as $key => $value) {
            $this->data[$key] = $value;
        }
    }

    /**
     * @param $str
     * @return string
     */
    public function strip($str)
    {
        return strip_tags($str);
    }

    public function statusSystem()
    {
        $this->eleAdd('system', include_once './application/configs/config_global.php');
        $this->lang();
        if ($this->data['system']['operation'] == 0) {
            die($this->data['system']['systemOff']);
        }
        if ($this->data['system']['lang'] == null) {
            die($this->data['lang']->errorLang);
        }
    }

    public function checkAuthorization()
    {
        if (isset($_COOKIE['key'])) {
            $sql = $this->model->checkLogin($_COOKIE['key']);
            if ($sql['cookie_key'] == $_COOKIE['key']) {
                if ($sql['binding_ip'] == 1) {
                    if ($sql['ip'] != $this->getClientIp()) {
                        setcookie('key', '', -1, '/');
                        header("Location: /login");
                    }
                }
                $this->addArray($sql);
                file_put_contents('logs/logs_links.txt', $this->getClientIp() . ':' . $sql['username'] . ':' . $_SERVER['REQUEST_URI'] . ':' . time() . ':' . $sql['level'] . ':' . $sql['bonus'] . ':' . $sql['bonus_vp'] . "\n", FILE_APPEND);
                if (isset($_COOKIE['char'])) {
                    $this->eleAdd('char', $this->model->infoChar($_COOKIE['char'], $this->data['id']));
                }

                if (isset($_COOKIE['char'])) {
                    $this->eleAdd('char', $this->model->infoChar($_COOKIE['char'], $this->data['id']));
                }
            } else {
                header("Location: /login");
            }
        } else {
            header("Location: /login");
        }
    }

    /* update 4.0 */
    public function lang()
    {
        if (isset($_COOKIE['lang'])) {
            $lang = $_COOKIE['lang'];
        } else {
            $lang = $this->data['system']['lang'];
            setcookie('lang', $lang, time() + 37200, '/');
        }
        $lang = simplexml_load_file('./application/langs/' . $lang . '.xml');
        $this->eleAdd('lang', $lang);
    }

    /**
     * @param $key
     */
    public function issetLevel($key)
    {
        $sql_assec = $this->model->checkLogin($_COOKIE['key']);
        if ($sql_assec['level'] != 1) {
            header("Location: /404");
        }
    }

    public function addUserVote()
    {
        $this->parseVote->parseMmotop($this->data['username'], $this->model->config['mmotop'], 2);
    }

    public function hashCss()
    {
        $time = time();
        if ($time >= $this->data['system']['timeHash'] + 90000) {
            $hashCss = strtoupper(md5($time));
            $this->model->upHashCss($hashCss, $time);
        }
    }

    /**
     * @param $username
     */
    public function generateCsrfToken($username)
    {
        $this->eleADD('csrfToken', strtoupper('Ft4S90IK' . hash('sha256', '$&*#%($#)@' . $username . $this->data['cookie_key'])));
    }

    /**
     * @param $username
     * @param null $CSRF
     */
    public function checkCsrfToken($username, $CSRF = NULL)
    {
        if (!empty($CSRF)) {
            $token = strtoupper('Ft4S90IK' . hash('sha256', '$&*#%($#)@' . $username . $this->data['cookie_key']));
            if ($token != $CSRF) {
                die('[ERROR] - #00002');
            }
        } else {
            die('[ERROR] - #00001');
        }
    }

    public function systemBonus()
    {
        if ($this->data['system']['action_system_bonus'] == true) {
            $gameTimeAcc = $this->model->getAllTimeChar($this->data['id']);
            if ($gameTimeAcc['SUM(totaltime)'] > 0) {
                $actionLevel = $this->model->getActionLevel($this->data['id']);
                $level = $this->model->getLevelsBonus($gameTimeAcc['SUM(totaltime)'], $actionLevel['MAX(id)']);
                while ($bonus = $level->fetch_assoc()) {
                    $this->model->addLevelAcc($bonus['id'], $this->data['id'], $bonus['game_time']);
                    $bonusAcc = $this->model->getBonusAcc($this->data['id']);
                    $bonus = $bonus['bonus_vp'] + $bonusAcc['bonus_vp'];
                    $this->model->addBonus($bonus, $this->data['id']);
                }
            }
        }
    }

    public function createTitle($title)
    {
        if (empty($title)) {
            $title = 'erorDev';
        }
        $this->eleAdd('title', $this->data['lang']->$title);
    }

    public function createMessage($type, $message, $after = NULL)
    {
        if (empty($message)) {
            exit($this->data['lang']->erorMessageDev);
        }
        $this->eleAdd($type, $this->data['lang']->$message . $after);
    }

    function getServer($key = null, $default = null)
    {
        if (null === $key) {
            return $_SERVER;
        }
        return (isset($_SERVER[$key])) ? $_SERVER[$key] : $default;
    }

    function getClientIp($proxy = true)
    {
        if ($proxy && $this->getServer('HTTP_CLIENT_IP') != null) {
            $ip = $this->getServer('HTTP_CLIENT_IP');
        } else if ($proxy && $this->getServer('HTTP_X_FORWARDED_FOR') != null) {
            $ip = $this->getServer('HTTP_X_FORWARDED_FOR');
        } else {
            $ip = $this->getServer('REMOTE_ADDR');
        }
        return $ip;
    }

    function getValue($typeBonus, $cost)
    {
        if ($typeBonus == 'dp') {
            $bonus = 'bonus_dp';
        } elseif ($typeBonus == 'vp') {
            $bonus = 'bonus_vp';
        } else {

        }
    }

}
