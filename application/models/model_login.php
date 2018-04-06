<?php

class Model_Login extends Model
{

    /**
     * @param $account
     * @param $password
     * @return array
     */
    public function getData($account, $password)
    {
        $this->Change_database($this->config['base']['auth']);
        $account = $this->escape($account);
        $password = $this->escape($password);
        return $this->db->query("SELECT * FROM account WHERE sha_pass_hash = UPPER(SHA1(CONCAT(UPPER('$account'),':',UPPER('$password'))))")->fetch_assoc();

    }

    /**
     * @param $account
     * @return array
     */
    public function getDataLk($account)
    {
        $this->Change_database($this->config['base']['db']);
        $account = $this->escape($account);
        return $this->db->query("SELECT * FROM ".$this->config['prefix']."account_lk WHERE username = '$account'")->fetch_assoc();
    }

    /**
     * @param $id
     * @param $username
     * @param $cookie_key
     * @param $ip
     * @param $link_ref
     */
    public function insertData($id, $username, $cookie_key, $ip, $link_ref)
    {
        $this->Change_database($this->config['base']['db']);
        $stmt = $this->db->prepare("INSERT INTO ".$this->config['prefix']."account_lk SET id = ?, username = ?, cookie_key = ?, ip = ?, link_ref = ?");
        $stmt->bind_param('sssss', $id, $username, $cookie_key, $ip, $link_ref);
        $stmt->execute();
    }

    /**
     * @param $username
     * @param $cookie_key
     * @param $ip
     */
    public function updateData($username, $cookie_key, $ip)
    {
        $this->Change_database($this->config['base']['db']);
        $username = $this->escape($username);
        $this->db->query("UPDATE ".$this->config['prefix']."account_lk SET cookie_key = '$cookie_key', ip = '$ip' WHERE username = '$username'");
    }

    /**
     * @return array
     */
    public function selectLimitOne()
    {
        $this->Change_database($this->config['base']['db']);
        return $this->db->query("SELECT * FROM ".$this->config['prefix']."realm ORDER BY id LIMIT 1")->fetch_assoc();
    }
}
