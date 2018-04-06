<?php

class Model_Auth extends Model
{

    public function addBonusVote($username, $bonus, $timeBonus, $timeVote)
    {
        $this->Change_database($this->config['base']['db']);
        $this->db->query("UPDATE as_vote_mmotop SET action = '1', date_bonus = '$timeBonus' WHERE time_vote = '$timeVote' AND username = '$username'");
        $this->db->query("UPDATE as_account_lk SET bonus_vp = bonus_vp + '$bonus' WHERE username = '$username'");
    }


    public function getDataVote()
    {
        $this->Change_database($this->config['base']['db']);
        return $this->db->query("SELECT * FROM ".$this->config['prefix']."vote");
    }

    public function getVote($username, $time)
    {
        $this->Change_database($this->config['base']['db']);
        $time = $this->escape($time);
        return $this->db->query("SELECT * FROM as_vote_mmotop WHERE username = '$username' AND time_vote = '$time' AND action = 0")->fetch_assoc();
    }
    /**
     * @param $username
     * @return array
     */
    public function infoAccount($username)
    {
        $this->Change_database($this->config['base']['db']);
        $username = $this->escape($username);
        return $this->db->query("SELECT * FROM ".$this->prefix."account_lk WHERE username = '$username'")->fetch_assoc();
    }

    /**
     * @param $username
     * @param $password
     * @return array
     */
    public function infoAccServer($username, $password)
    {
        $this->Change_database($this->config['base']['auth']);
        $username = $this->escape($username);
        return $this->db->query("SELECT * FROM ".$this->prefix."account WHERE username = '$username' AND sha_pass_hash = UPPER(SHA1(CONCAT(UPPER('$username'),':',UPPER('$password'))))")->fetch_assoc();
    }

    /**
     * @param $username
     * @return array
     */
    public function getUsernamePay($username)
    {
        $this->Change_database($this->config['base']['db']);
        $username = $this->escape($username);
        return $this->db->query("SELECT * FROM ".$this->prefix."account_lk WHERE username = '$username'")->fetch_assoc();
    }

    /**
     * @param $user
     * @param $id
     * @return array
     */
    public function voteTime($user, $id)
    {
        $this->Change_database($this->config['base']['db']);
        $id = $this->escape($id);
        return $this->db->query("SELECT * FROM ".$this->prefix."vote_time WHERE users = '$user' AND top = '$id'")->fetch_assoc();
    }

    /**
     * @param $id
     * @return array
     */
    public function issetVote($id)
    {
        $this->Change_database($this->config['base']['db']);
        return $this->db->query("SELECT * FROM ".$this->prefix."vote WHERE  id = '$id'")->fetch_assoc();
    }

    /**
     * @param $username
     * @param $time
     * @param $top
     */
    public function inVote($username, $time, $top)
    {
        $this->Change_database($this->config['base']['db']);
        $stmt = $this->db->prepare("INSERT INTO ".$this->prefix."vote_time SET users = ?, time_last = ?, top = ?");
        $stmt->bind_param('sii', $username, $time, $top);
        $stmt->execute();
    }

    /**
     * @param $username
     * @param $time_last
     * @param null $top
     */
    public function upVote($username, $time_last, $top = NULL)
    {
        $this->Change_database($this->config['base']['db']);
        $this->db->query("UPDATE vote_time SET ".$this->prefix."time_last = '$time_last', action = '0' WHERE users = '$username' AND top = '$top'");
    }

    /**
     * @param $id
     * @return array
     */
    public function getDataVip($id)
    {
        $this->Change_database($this->config['base']['auth']);
        return $this->db->query("SELECT id FROM account_premium WHERE id = '$id'")->fetch_assoc();
    }

    /**
     * @param $id
     * @return array
     */
    public function getBonus($id)
    {
        $this->Change_database($this->config['base']['db']);
        return $this->db->query("SELECT bonus FROM ".$this->config['prefix']."account_lk WHERE id = '$id'")->fetch_assoc();
    }

    /**
     * @param $id
     * @param $time
     * @param $time_new
     */
    public function insertVip($id, $time, $time_new)
    {
        $this->Change_database($this->config['base']['auth']);
        $one = 1;
        $stmt = $this->db->prepare("INSERT INTO account_premium SET id = ?, setdate = ?, unsetdate = ?, premium_type = ?, active = ?");
        $stmt->bind_param('iiiii', $id, $time, $time_new, $one, $one);
        $stmt->execute();
    }


    /**
     * @param $category
     * @return bool|mysqli_result
     */
    public function getShop($category)
    {
        $this->Change_database($this->config['base']['db']);
        return $this->db->query("SELECT * FROM ".$this->config['prefix']."shop WHERE category = '$category'");
    }

    /**
     * @param $item
     * @return array
     */
    public function issetItem($item)
    {
        $this->Change_database($this->config['base']['db']);
        $item = $this->escape($item);
        return $this->db->query("SELECT * FROM ".$this->config['prefix']."shop WHERE id_item = '$item'")->fetch_assoc();
    }

    /**
     * @param $id
     * @param $bonus
     * @param $coll
     */
    public function bonusUser($id, $bonus, $coll)
    {
        $this->Change_database($this->config['base']['db']);
        $bonus = $this->escape($bonus);
        $this->db->query("UPDATE ".$this->config['prefix']."account_lk SET $coll = '$bonus' WHERE id = '$id'");
    }

    /**
     * @param $key
     * @return array
     */
    public function chars($key)
    {
        $this->Change_database($this->config['base']['db']);
        $key = $this->escape($key);
        return $this->db->query("SELECT * FROM ".$this->config['prefix']."account_lk WHERE cookie_key = '$key'")->fetch_assoc();
    }

    /**
     * @return array
     */
    public function mailMax()
    {
        $this->Change_database($this->config['base']['char']);
        return $this->db->query("SELECT MAX(id) id FROM mail LIMIT 1")->fetch_assoc();
    }

    /**
     * @return array
     */
    public function itemGuid()
    {
        $this->Change_database($this->config['base']['char']);
        return $this->db->query("SELECT MAX(guid) guid FROM item_instance")->fetch_assoc();
    }

    /**
     * @param $item_guid
     * @param $id_item
     * @param $owner_guid
     * @param $count
     * @param $enchantments
     */
    public function itemCreate($item_guid, $id_item, $owner_guid, $count, $enchantments)
    {
        $this->Change_database($this->config['base']['char']);
        $stmt = $this->db->prepare("INSERT INTO item_instance SET guid = ?, itemEntry = ?, owner_guid = ?, count = ?, enchantments = ?");
        $stmt->bind_param('iiiii', $item_guid, $id_item, $owner_guid, $count, $enchantments);
        $stmt->execute();
    }

    /**
     * @param $max
     * @param $stationery
     * @param $owner_guid
     * @param $subject
     * @param $body
     * @param $has_items
     * @param $expire_time
     * @param $deliver_time
     * @param $money
     */
    public function mailCreate($max, $stationery, $owner_guid, $subject, $body, $has_items, $expire_time, $deliver_time, $money)
    {
        $this->Change_database($this->config['base']['char']);
        $stmt = $this->db->prepare("INSERT INTO mail SET id = ?, stationery = ?, receiver = ?, subject = ?, body = ?, has_items = ?, expire_time = ?, deliver_time = ?, money = ?");
        $stmt->bind_param('iiiiisiii', $max, $stationery, $owner_guid, $subject, $body, $has_items, $expire_time, $deliver_time, $money);
        $stmt->execute();
    }

    /**
     * @param $max
     * @param $item_guid
     * @param $owner_guid
     */
    public function mailItemsCreate($max, $item_guid, $owner_guid)
    {
        $this->Change_database($this->config['base']['char']);
        $stmt = $this->db->prepare("INSERT INTO mail_items SET mail_id = ?, item_guid = ?, receiver = ?");
        $stmt->bind_param('iii', $max, $item_guid, $owner_guid);
        $stmt->execute();
    }

    /**
     * @param $id_item
     * @param $name_item
     * @param $price
     * @param $category
     * @param $price_vp
     */
    public function itemAdd($id_item, $name_item, $price, $category, $price_vp)
    {
        $this->Change_database($this->config['base']['db']);
        $stmt = $this->db->prepare("INSERT INTO ".$this->config['prefix']."shop SET id_item = ?, name_item = ?, price = ?, category = ?, price_vp = ?");
        $stmt->bind_param('isiii', $id_item, $name_item, $price, $category, $price_vp);
        $stmt->execute();
    }

    /**
     * @param null $pages
     * @param $category
     * @param $realmid
     * @return bool|mysqli_result
     */
    public function getDataShop($pages = NULL, $category, $realmid)
    {
        $this->Change_database($this->config['base']['db']);
        $num = 7;
        $this->page = $pages;
        $posts = $this->db->query("SELECT * FROM ".$this->config['prefix']."shop WHERE category = '$category' AND realmid = '$realmid'")->num_rows;
        $this->total = intval(($posts - 1) / $num) + 1;
        $this->page = intval($this->page);
        $this->category = $category;
        if (empty($this->page) or $this->page < 0) $this->page = 1;
        if ($this->page > $this->total) $this->page = $this->total;
        $start = $this->page * $num - $num;
        return $this->db->query("SELECT * FROM ".$this->config['prefix']."shop WHERE category = '$category' AND realmid = '$realmid' LIMIT $start, $num");
    }

    /**
     * @return array
     */
    public function pages()
    {
        $page = $this->page;
        $total = $this->total;
        $category = $this->category;
        return array(
            "page" => "$page",
            "total" => "$total",
            "category" => "$category",
        );
    }

    /**
     * @return array
     */
    public function page()
    {
        $page = $this->page;
        $total = $this->total;
        return array(
            "page" => "$page",
            "total" => "$total",
        );
    }


    /**
     * @param $username
     * @param $password
     */
    public function changePassword($username, $password)
    {
        $this->Change_database($this->config['base']['auth']);
        $password = $this->escape($password);
        $this->db->query("UPDATE account SET sha_pass_hash = UPPER(SHA1(CONCAT(UPPER('$username'),':',UPPER('$password')))), v = '', s = '', sessionkey = '' WHERE username = '$username'");
    }


    /**
     * @param $mail
     * @param $username
     */
    public function changeMail($mail, $username)
    {
        $this->Change_database($this->config['base']['auth']);
        $mail = $this->escape($mail);
        $this->db->query("UPDATE account SET email = '$mail' WHERE username = '$username'");
    }


    /**
     * @param $id
     * @param $bonus
     */
    public function updateBonus($id, $bonus)
    {
        $this->Change_database($this->config['base']['db']);
        $id = $this->escape($id);
        $this->db->query("UPDATE ".$this->config['prefix']."account_lk SET bonus = '$bonus' WHERE id = '$id'");
    }

    /**
     * @param $id
     * @param $time
     */
    public function updateVip($id, $time)
    {
        $this->Change_database($this->config['base']['db']);
        $id = $this->escape($id);
        $this->db->query("UPDATE ".$this->config['prefix']."account_premium SET unsetdate = '$time' WHERE id = '$id'");
    }

    /**
     * @param $guid
     * @return bool|mysqli_result
     */
    public function getChar($guid)
    {
        $this->Change_database($this->config['base']['char']);
        $guid = $this->escape($guid);
        return $this->db->query("SELECT * FROM characters WHERE guid = '$guid'");
    }

    /**
     * @param $id
     * @return bool|mysqli_result
     */
    public function getChars($id)
    {
        $this->Change_database($this->config['base']['char']);
        $id = $this->escape($id);
        return $this->db->query("SELECT * FROM characters WHERE account = '$id'");
    }

    /**
     * @param $name
     * @return array
     */
    public function getCharName($name)
    {
        $this->Change_database($this->config['base']['char']);
        $name = $this->escape($name);
        return $this->db->query("SELECT * FROM characters WHERE name = '$name'")->fetch_assoc();
    }

    /**
     * @param $name
     * @param $id
     * @param $guid
     */
    public function insertChar($name, $id, $guid)
    {
        $this->Change_database($this->config['base']['db']);
        $name = $this->escape($name);
        $this->db->query("UPDATE " .$this->config['prefix']. " account_lk SET user_char = '$name', id_char = '$guid' WHERE id = '$id'");
    }

    /**
     * @return bool|mysqli_result
     */
    public function selectRealm()
    {
        $this->Change_database($this->config['base']['db']);
        return $this->db->query("SELECT * FROM ".$this->config['prefix']."realm");
    }

    /**
     * @param $key
     * @return array
     */
    public function selectRealmId($key)
    {
        $this->Change_database($this->config['base']['db']);
        $key = $this->escape($key);
        return $this->db->query("SELECT id FROM ".$this->config['prefix']."realm WHERE realm_key = '$key'")->fetch_assoc();
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
     * @param $name
     * @return array
     */
    public function infoCharName($name)
    {
        $this->Change_database($this->config['base']['char']);
        $name = $this->escape($name);
        return $this->db->query("SELECT * FROM characters WHERE name = '$name'")->fetch_assoc();
    }

    /**
     * @param $id
     * @return bool|mysqli_result
     */
    public function infoChars($id)
    {
        $this->Change_database($this->config['base']['char']);
        $id = (int)$id;
        return $this->db->query("SELECT * FROM characters WHERE account = '$id'");
    }

    /**
     * @param $id
     * @param $bonus
     */
    public function updateBonusVp($id, $bonus)
    {
        $this->Change_database($this->config['base']['db']);
        $id = $this->escape($id);
        $this->db->query("UPDATE account_lk SET ".$this->config['prefix']."bonus_vp = '$bonus' WHERE id = '$id'");
    }

    /**
     * @param $id
     * @param $gender
     * @param $name
     */
    public function updateGender($id, $gender, $name)
    {
        $this->Change_database($this->config['base']['char']);
        $gender = $this->escape($gender);
        $this->db->query("UPDATE characters SET gender = '$gender' WHERE name = '$name' AND account = '$id'");
    }

    /**
     * @param $name
     * @param $account
     * @param $guid
     */
    public function upCharName($name, $account, $guid)
    {
        $this->Change_database($this->config['base']['char']);
        $name = $this->escape($name);
        $guid = $this->escape($guid);
        $this->db->query("UPDATE characters SET name = '$name' WHERE account = '$account' AND guid = '$guid'");
    }

    /**
     * @param $item
     * @param $realmid
     * @return array
     */
    public function searchItem($item, $realmid)
    {
        $this->Change_database($this->config['base']['db']);
        $item = $this->escape($item);
        return $this->db->query("SELECT * FROM ".$this->config['prefix']."shop WHERE id_item = '$item' AND  realmid = '$realmid'")->fetch_assoc();
    }

    /**
     * @param $username
     * @param $ip
     * @param $price
     * @param $id_item
     * @param $item
     * @param $time
     */
    public function logs_shop($username, $ip, $price, $id_item, $item, $time)
    {
        $this->Change_database($this->config['base']['db']);
        $stmt = $this->db->prepare("INSERT INTO ".$this->config['prefix']."logs_shop SET username = ?, ip = ?, price = ?, id_item = ?, item = ?, time = ?");
        $stmt->bind_param('ssiisi', $username, $ip, $price, $id_item, $item, $time);
        $stmt->execute();
    }

    /**
     * @param null $pages
     * @param $guid
     * @return bool|mysqli_result
     */
    public function getDataTickets($pages = NULL, $guid)
    {
        $this->Change_database($this->config['base']['db']);
        $num = 7;
        $this->page = $pages;
        $posts = $this->db->query("SELECT * FROM ".$this->config['prefix']."ticket WHERE guid = '$guid'")->num_rows;
        $this->total = intval(($posts - 1) / $num) + 1;
        $this->page = intval($this->page);
        if (empty($this->page) or $this->page < 0) $this->page = 1;
        if ($this->page > $this->total) $this->page = $this->total;
        $start = $this->page * $num - $num;
        return $this->db->query("SELECT * FROM ".$this->config['prefix']."ticket WHERE guid = '$guid' LIMIT $start, $num");
    }

    /**
     * @param $name
     * @param $guid
     * @return array
     */
    public function getDataTicket($name, $guid)
    {
        $this->Change_database($this->config['base']['db']);
        $name = $this->escape($name);
        return $this->db->query("SELECT * FROM ".$this->config['prefix']."ticket WHERE guid = '$guid' AND name = '$name'")->fetch_assoc();
    }

    /**
     * @param $guid
     * @param $account
     * @return bool|mysqli_result
     */
    public function getDataTicketId($guid, $account)
    {
        $this->Change_database($this->config['base']['db']);
        return $this->db->query("SELECT * FROM ".$this->config['prefix']."ticket_reply WHERE guid = '$guid' AND account = '$account'");
    }

    /**
     * @param $id
     * @param $guid
     * @return array
     */
    public function getDataTicketIdOne($id, $guid)
    {
        $this->Change_database($this->config['base']['db']);
        return $this->db->query("SELECT * FROM ".$this->config['prefix']."ticket WHERE guid = '$guid' AND id = '$id'")->fetch_assoc();

    }

    /**
     * @param $name
     * @param $text
     * @param $primany
     * @param $id
     * @param $time
     * @param $ip
     */
    public function addDataTicket($name, $text, $primany, $id, $time, $ip)
    {
        $this->Change_database($this->config['base']['db']);
        $stmt = $this->db->prepare("INSERT INTO ".$this->config['prefix']."ticket SET name = ?, text = ?, primary_ticket = ?, guid = ?, time = ?, ip = ?");
        $stmt->bind_param('ssiiis', $name, $text, $primany, $id, $time, $ip);
        $stmt->execute();
    }

    /**
     * @param $guid
     * @param $text
     * @param $time
     * @param $author
     * @param $account
     */
    public function addDataTicketReply($guid, $text, $time, $author, $account)
    {
        $this->Change_database($this->config['base']['db']);
        $stmt = $this->db->prepare("INSERT INTO ".$this->config['prefix']."ticket_reply SET guid = ?, reply = ?, time = ?, author = ?, account = ?");
        $stmt->bind_param('isiii', $guid, $text, $time, $author, $account);
        $stmt->execute();
    }

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
     * @param $guid
     * @return array
     */
    public function getPosition($guid)
    {
        $this->Change_database($this->config['base']['char']);
        return $this->db->query("SELECT * FROM character_homebind WHERE guid = '$guid'")->fetch_assoc();
    }

    /**
     * @param $position_x
     * @param $position_y
     * @param $position_z
     * @param $map
     * @param $zone
     * @param $guid
     * @return bool|mysqli_result
     */
    public function savePosition($position_x, $position_y, $position_z, $map, $zone, $guid)
    {
        $this->Change_database($this->config['base']['char']);
        return $this->db->query("UPDATE characters SET position_x = '$position_x' , position_y = '$position_y', position_z = '$position_z', map = '$map', zone = '$zone'  WHERE guid = '$guid'");
    }

    /**
     * @param $username
     * @param $id
     */
    public function bindingIp($username, $id)
    {
        $this->Change_database($this->config['base']['db']);
        $this->db->query("UPDATE ".$this->config['prefix']."account_lk SET binding_ip = '1' WHERE username = '$username' AND guid = '$id'");
    }

    /**
     * @param $key
     * @return array
     */
    public function getKey($key)
    {
        $this->Change_database($this->config['base']['db']);
        $key = $this->escape($key);
        return $this->db->query("SELECT * FROM ".$this->config['prefix']."bonuses_code WHERE code = '$key' AND action = 0")->fetch_assoc();
    }


    /**
     * @param $username
     * @param $bonus_vp
     * @param $bonus_dp
     */
    public function addBonusesKey($username, $bonus_vp, $bonus_dp)
    {
        $this->Change_database($this->config['base']['db']);
        $this->db->query("UPDATE ".$this->config['prefix']."account_lk SET bonus_vp = '$bonus_vp',  bonus = '$bonus_dp' WHERE username = '$username'");
    }


    /**
     * @param $key
     */
    public function validKey($key)
    {
        $this->Change_database($this->config['base']['db']);
        $key = $this->escape($key);
        $this->db->query("UPDATE ".$this->config['prefix']."bonuses_code SET action = '1' WHERE code = '$key'");
    }

    /**
     * @param $mail
     * @return array
     */
    public function getEmail($mail)
    {
        $this->Change_database($this->config['base']['auth']);
        $mail = $this->escape($mail);
        return $this->db->query("SELECT * FROM account WHERE email = '$mail'")->fetch_assoc();
    }

    /**
     * @param $guid
     */
    public function changeRace($guid)
    {
        $this->Change_database($this->config['base']['char']);
        $this->db->query("UPDATE characters SET at_login = '128' WHERE guid = '$guid'");
    }

    /**
     * @param $guid
     */
    public function changeFraction($guid)
    {
        $this->Change_database($this->config['base']['char']);
        $this->db->query("UPDATE characters SET at_login = '64' WHERE guid = '$guid'");
    }

    public function addBonusPanel($account, $bonus, $bonus_vp)
    {
        $this->Change_database($this->config['base']['db']);
        $account = $this->escape($account);
        $bonus = (int) $bonus;
        $bonus_vp = (int) $bonus_vp;
        $this->db->query("UPDATE ".$this->config['prefix']."account_lk SET bonus = bonus + $bonus, bonus_vp = bonus_vp + $bonus_vp WHERE username = '$account'");
    }   

    public function getAccount($username)
    {
        $this->Change_database($this->config['base']['auth']);
        $username = $this->escape($username);
        return $this->db->query("SELECT * FROM account WHERE username = '$username'")->fetch_assoc();
    }

    public function getAccountBonus($username)
    {
        $this->Change_database($this->config['base']['db']);
        $username = $this->escape($username);
        return $this->db->query("SELECT * FROM ".$this->config['prefix']."account_lk WHERE username = '$username'")->fetch_assoc();
    }

    public function addAllAccountBonus($bonus, $bonus_vp)
    {
        $this->Change_database($this->config['base']['db']);
        $bonus = (int) $bonus;
        $bonus_vp = (int) $bonus_vp;
        $this->db->query("UPDATE ".$this->config['prefix']."account_lk SET bonus = bonus + $bonus, bonus_vp = bonus_vp + $bonus_vp");
    }

    /**
     * @param $account
     * @param $password
     * @return array
     */
    public function getDataPassAcc($account, $password)
    {
        $this->Change_database($this->config['base']['auth']);
        $account = $this->escape($account);
        $password = $this->escape($password);
        return $this->db->query("SELECT * FROM account WHERE sha_pass_hash = UPPER(SHA1(CONCAT(UPPER('$account'),':',UPPER('$password')))) AND username = '$account'")->fetch_assoc();

    }
}



