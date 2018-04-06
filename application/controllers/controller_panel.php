<?php

class Controller_Panel extends Controller
{
    function __construct()
    {
        $this->model = new Model_Panel();
        $this->view = new View();
        $this->statusSystem();
        $this->issetLevel($_COOKIE['key']);
        $this->checkAuthorization();
        $this->generateCsrfToken($this->data['username']);
    }

    function action_index()
    {
        Controller::createTitle('adminPanel');
        $this->view->generate('admin_view', 'template_view', $this->data);
    }

    function action_add_bonus()
    {
        Controller::createTitle('panelAddBonus');
        $this->view->generate('add_bonus_panel_view', 'template_view', $this->data);
    }
}