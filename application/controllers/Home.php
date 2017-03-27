<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {


	public function index()
	{


		
	
		$this->load->view('site/layout');

		
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
