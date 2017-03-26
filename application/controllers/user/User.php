<?php
Class User extends MY_Controller
{
    function __construct()
    {
    	 

        parent::__construct();
        $this->load->model('account_model');
    }
    
    
    function logout()
    {
        if($this->session->userdata('account_id'))
        {
            $this->session->unset_userdata('account_id');
        }
        redirect(base_url('home'));
    }
}



