<?php

class Controller_Pay extends Controller
{
    function __construct()
    {
        $this->model = new Model_Pay();
        $this->statusSystem();
    }

    function action_index()
    {
        Controller::createTitle('error404');
        $this->view->generate('404_view', 'template_view', $this->data);
    }

    function action_message()
    {
         function getIP() {
             if(isset($_SERVER['HTTP_X_REAL_IP'])) return $_SERVER['HTTP_X_REAL_IP'];
             return $_SERVER['REMOTE_ADDR'];
         }
         if (!in_array(getIP(), array('136.243.38.147', '136.243.38.149', '136.243.38.150', '136.243.38.151', '136.243.38.189'))) {
             die("hacking attempt!");
        } 
        $sign = md5($this->data['system']['merchantId'] . ':' . $_REQUEST['AMOUNT'] . ':' . $this->data['system']['merchantSecretTwo'] . ':' . $_REQUEST['MERCHANT_ORDER_ID']);
        if ($sign != $_REQUEST['SIGN']) {
            die('wrong sign');
        }
        $data = $this->model->getDataDonOperation($_REQUEST['us_login'], $_REQUEST['MERCHANT_ORDER_ID']);
        if ($data['order_id'] == $_REQUEST['MERCHANT_ORDER_ID'] AND $data['action'] == 0) {
            $userData = $this->model->getUsernamePay($data['us_login']);
            $bonus = $userData['bonus'] + $_REQUEST['AMOUNT'];
            $this->model->upDonBonus($data['us_login'], $bonus, $data['order_id']);
            die('YES');
        }


    }

}
