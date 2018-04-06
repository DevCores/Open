<?php

class Ajax extends Controller
{

    public $model;
    public $data = array();

    function __construct()
    {
        $this->model = new Model();
        $this->controller = new Controller();
    }

    /**
     * @param $result
     */
    function ourResultS($result)
    {
        echo '<div class="alert alert-success">' . $result . '</div>';
    }

    /**
     * @param $result
     */
    function ourResultE($result)
    {
        echo '<div class="alert alert-danger">' . $result . '</div>';
    }

    function action_index()
    {

    }


}
