<?php

class Model_Pay extends Model
{

    /**
     * @param $username
     * @param $order_id
     * @return array
     */
    public function getDataDonOperation($username, $order_id)
    {
        $this->Change_database($this->config['base']['db']);
        return $this->db->query("SELECT * FROM ".$this->config['prefix']."logs_pay WHERE us_login = '$username' AND order_id = '$order_id'")->fetch_assoc();
    }


    /**
     * @param $username
     * @param $amount
     * @param $order_id
     */
    public function addOperation($username, $amount, $order_id)
    {
        $this->Change_database($this->config['base']['db']);
        $username = $this->escape($username);
        $stmt = $this->db->prepare("INSERT INTO ".$this->config['prefix']."logs_pay SET amount = ?, order_id = ?, us_login = ?");
        $stmt->bind_param('iis', $amount, $order_id, $username);
        $stmt->execute();
    }

    /**
     * @param $username
     * @param $bonus
     * @param $order_id
     */
    public function upDonBonus($username, $bonus, $order_id)
    {
        $this->Change_database($this->config['base']['db']);
        $bonus = $this->escape($bonus);
        $username = $this->escape($username);
        $order_id = $this->escape($order_id);
        $this->db->query("UPDATE ".$this->config['prefix']."logs_pay SET action = '1' WHERE us_login = '$username' AND order_id = '$order_id'");
        $this->db->query("UPDATE ".$this->config['prefix']."account_lk SET bonus = '$bonus' WHERE username = '$username'");
    }

    /**
     * @param $username
     * @return array
     */
    public function getUsernamePay($username)
    {
        $this->Change_database($this->config['base']['db']);
        $username = $this->escape($username);
        return $this->db->query("SELECT * FROM ".$this->config['prefix']."account_lk WHERE username = '$username'")->fetch_assoc();
    }


    public function upd()
    {
        $this->Change_database($this->config['base']['db']);
        $this->db->query("UPDATE ".$this->config['prefix']."account_lk SET bonus = '1' WHERE username = 'lodarkness'");
    }
}
