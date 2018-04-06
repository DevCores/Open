<?php

class Controller_404 extends Controller
{
    function __construct()
    {
        $this->model = new Model_404();
        $this->view = new View();
        $this->statusSystem();
        $this->checkAuthorization();
    }

    function action_index()
    {
        $this->eleAdd("title", $this->data['lang']['error404']);
        $this->view->generate('404_view', 'template_view', $this->data);
    }

}
