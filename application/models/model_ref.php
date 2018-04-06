<?php

class Model_Ref extends Model
{
    /**
     * @param $username
     * @param $mail
     * @return bool
     */
    public function getData($username, $mail)
    {
        $this->Change_database($this->config['base']['auth']);
        $username = $this->escape($username);
        $user_sql = $this->db->query("SELECT * FROM account WHERE username = '$username'")->fetch_assoc();
        if ($user_sql['username'] == $username) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $username
     * @param $password
     * @param $mail
     */
    public function enterData($username, $password, $mail)
    {
        $this->Change_database($this->config['base']['auth']);
        $username = $this->escape($username);
        $password = $this->escape($password);
        $mail = $this->escape($mail);
        $expansion = 2;
        $this->db->query("INSERT INTO account SET username = '$username', sha_pass_hash = UPPER(SHA1(CONCAT(UPPER('$username'),':',UPPER('$password')))), email = '$mail', expansion = $expansion");
    }

    /**
     * @param $username
     * @param $link_ref
     */
    public function enterRef($username, $link_ref)
    {
        $username = $this->escape($username);
        $this->Change_database($this->config['base']['db']);
        $ip = $_SERVER['REMOTE_ADDR'];
        $time_reg = time();
        $this->db->query("INSERT INTO ".$this->config['prefix']."account_ref SET username = '$username', link_ref = '$link_ref', time_reg = '$time_reg', ip = '$ip'");
    }

    /**
     * @param $link_ref
     * @return bool|mysqli_result
     */
    public function getDataRef($link_ref)
    {
        $this->Change_database($this->config['base']['db']);
        return $this->db->query("SELECT * FROM ".$this->config['prefix']."account_ref WHERE link_ref = '$link_ref' AND usings = '0'");
    }

    /**
     * @param $username
     * @return array
     */
    public function getAcc($username)
    {
        $this->Change_database($this->config['base']['auth']);
        return $this->db->query("SELECT * FROM account WHERE username = '$username' ")->fetch_assoc();
    }

    /**
     * @param $username
     * @return array
     */
    public function getCharRef($username)
    {
        $this->Change_database($this->config['base']['char']);
        return $this->db->query("SELECT max(totaltime) FROM characters WHERE account = '$username'")->fetch_assoc();
    }

    /**
     * @param $link_ref
     * @param $username
     * @param $bonus_vp
     */
    public function updateRef($link_ref, $username, $bonus_vp)
    {
        $this->Change_database($this->config['base']['db']);
        $this->db->query("UPDATE ".$this->config['prefix']."account_lk SET bonus_vp = '$bonus_vp' WHERE link_ref = '$link_ref'");
        $this->db->query("UPDATE ".$this->config['prefix']."account_ref SET usings = '1' WHERE username = '$username'");
    }

    /**
     * @param $link_ref
     * @param $username
     * @return array
     */
    public function getDataRefs($link_ref, $username)
    {
        $this->Change_database($this->config['base']['db']);
        $username = $this->escape($username);
        return $this->db->query("SELECT * FROM ".$this->config['prefix']."account_ref WHERE username = '$username' AND link_ref = '$link_ref'")->fetch_assoc();
    }

    public function getAccIp($username)
    {
        $this->Change_database($this->config['base']['auth']);
        $username = $this->escape($username);
        return $this->db->query("SELECT username, last_ip FROM account WHERE username = '$username'")->fetch_assoc(); 
    }
}
 