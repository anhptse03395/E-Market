<?php
Class Contact extends MY_controller{

    function __construct()
    {


        parent::__construct();
        $this->load->model('account_model');
    }

    function index()
    {
        $this->load->view('site/contact-us/index');
    }




}