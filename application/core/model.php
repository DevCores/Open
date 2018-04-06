<?php
/*

████─█───█───────███─████─███─███
█──█─█───█───────█───█──█─█───█
████─█───█───███─███─████─███─███
█──█─█───█─────────█─█──█─█───█
█──█─███─███─────███─█──█─█───███

*/

/**
 * @property mysqli db
 * @property array config
 */
class Model
{

    public $logsQuery = [];

    public $config = array(
        "host" => "127.0.0.1", // хост базы данных сайта и сервера
        "user" => "", // пользователь базы данных
        "pass" => "", // пароль от пользователя базы данных
        "port" => "3306", // порт для подключения (не обезательно)
        "mmotop" => 'https://mmotop.ru/votes/96eaa593ef2371856f6f1de30cb2ce95d928a872.txt?19a27b2b91f4371fc75a46504a29797a',
        "prefix" => 'as_',
        "charset" => 'utf8',
        "base" => array(
            "db" => "personal_area", // база сайта personal_area
            "auth" => "auth", // база аккаунтов auth
            "char" => "char"
        )
    );

    function __construct()
    {
        $this->db = new mysqli($this->config['host'], $this->config['user'], $this->config['pass'], $this->config['base']['db'],
            $this->config['port']);
        if ($this->db->connect_error) {
            die('Error connect base.');
        }
        date_default_timezone_set('Europe/Moscow');
        $this->db->set_charset($this->config['charset']);
    }

    function __destruct()
    {
        $this->db = null;
    }

    /**
     * @param $key
     * @return array
     */
    public function checkLogin($key)
    {
        $this->Change_database($this->config['base']['db']);
        $key = $this->escape($key);
        return $this->db->query("SELECT * FROM " . $this->config['prefix'] . "account_lk WHERE cookie_key = '$key'")->fetch_assoc();
    }

    /**
     * @param $key
     * @return array
     */
    public function infoUserAuth($key)
    {
        $this->Change_database($this->config['base']['db']);
        $key = $this->escape($key);
        return $this->db->query("SELECT * FROM " . $this->config['prefix'] . "account_lk WHERE cookie_key = '$key'")->fetch_assoc();
    }

    /**
     * @return array
     */
    public function infoSystem()
    {
        $this->Change_database($this->config['base']['db']);
        return $this->db->query("SELECT * FROM " . $this->config['prefix'] . "system_setup")->fetch_assoc();
    }

    /**
     * @param $username
     * @param $idTop
     * @return array
     */
    public function infoTimeVote($username, $idTop)
    {
        $this->Change_database($this->config['base']['db']);
        return $this->db->query("SELECT * FROM " . $this->config['prefix'] . "vote_time WHERE users = '$username' AND top = '$idTop'")->fetch_assoc();
    }

    /**
     * @param $idTop
     * @return array
     */
    public function issetVote($idTop)
    {
        $this->Change_database($this->config['base']['db']);
        return $this->db->query("SELECT id_vote, bonus FROM vote WHERE  id_vote = '$idTop'")->fetch_assoc();
    }

    /**
     * @param $username
     * @return array
     */
    public function infoBonus($username)
    {
        $this->Change_database($this->config['base']['db']);
        return $this->db->query("SELECT username, bonus_vp FROM account_lk WHERE username = '$username'")->fetch_assoc();
    }

    /**
     * @param $hash
     * @param $time
     */
    public function upHashCss($hash, $time)
    {
        $this->Change_database($this->config['base']['db']);
        $this->db->query("UPDATE system_setup SET hashCss = '$hash', timeHash = '$time'");
    }

    /**
     * @param $arg
     * @return string
     */
    public function escape($arg)
    {
        return $this->db->real_escape_string($arg);
    }

    /**
     * @param $name
     */
    public function Change_database($name)
    {
        $this->db->select_db($name);
    }

    /**
     * @param $id
     * @param $account
     * @return array
     */
    public function infoChar($id, $account)
    {
        $this->Change_database($this->config['base']['char']);
        $id = (int)$id;
        return $this->db->query("SELECT * FROM characters WHERE guid = '$id' AND account = '$account'")->fetch_assoc();
    }

    /**
     * @param $account
     * @return array
     */
    public function getAllTimeChar($account)
    {
        $this->Change_database($this->config['base']['char']);
        return $this->db->query("SELECT SUM(totaltime) FROM characters WHERE account = '$account'")->fetch_assoc();
    }

    /**
     * @param $account
     * @return array
     */
    public function getActionLevel($account)
    {
        $this->Change_database($this->config['base']['db']);
        return $this->db->query("SELECT MAX(id) FROM account_bonus_level WHERE account = '$account'")->fetch_assoc();
    }

    /**
     * @param $time
     * @param $id
     * @return bool|mysqli_result
     */
    public function getLevelsBonus($time, $id)
    {
        $this->Change_database($this->config['base']['db']);
        return $this->db->query("SELECT * FROM " . $this->config['prefix'] . "bonus_levels WHERE  game_time <= '$time' AND id > '$id'");
    }

    /**
     * @return int
     */
    public function getMaxLevels()
    {
        $this->Change_database($this->config['base']['db']);
        return $this->db->query("SELECT id FROM " . $this->config['prefix'] . "bonus_levels")->num_rows;
    }

    /**
     * @param $id
     * @return array
     */
    public function getBonusAcc($id)
    {
        $this->Change_database($this->config['base']['db']);
        return $this->db->query("SELECT id, bonus_vp FROM " . $this->config['prefix'] . "account_lk WHERE id = '$id'")->fetch_assoc();
    }

    /**
     * @param $bonus
     * @param $id
     */
    public function addBonus($bonus, $id)
    {
        $this->Change_database($this->config['base']['db']);
        $this->db->query("UPDATE " . $this->config['prefix'] . "account_lk SET bonus_vp = '$bonus' WHERE id = '$id'");
    }

    /**
     * @param $id
     * @param $account
     * @param $game_time
     */
    public function addLevelAcc($id, $account, $game_time)
    {
        $this->Change_database($this->config['base']['db']);
        $stmt = $this->db->prepare("INSERT INTO " . $this->config['prefix'] . "account_bonus_level SET id = ?, account = ?, totaltime = ?");
        $stmt->bind_param('iii', $id, $account, $game_time);
        $stmt->execute();
    }

    public function get_data()
    {

    }


    public function addVote($username, $time, $ip)
    {
        $this->Change_database($this->config['base']['db']);
        $stmt = $this->db->prepare("INSERT INTO as_vote_mmotop SET username = ?, time_vote = ?, ip = ?");
        $stmt->bind_param('sss', $username, $time, $ip);
        $stmt->execute();
    }

    public function getVoteLastDate($date)
    {
        $this->Change_database($this->config['base']['db']);
        return $this->db->query("SELECT * FROM as_vote_mmotop WHERE time_vote = '$date'")->fetch_assoc();
    }

} 
 