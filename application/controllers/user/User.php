<?php
Class User extends MY_Controller
{
    function __construct()
    {
    	 

        parent::__construct();
        $this->load->model('account_model');
    }
	public function index()
	{


		

		$this->load->view('site/layout');

		
	}

	function logout()
	{
		if($this->session->userdata('account_id'))
		{	
			if($this->session->userdata('shop_id'))
			{

				$this->session->unset_userdata('shop_id');

			}
			if($this->session->userdata('buyer_id'))
			{

				$this->session->unset_userdata('buyer_id');

			}

			$this->session->unset_userdata('account_id');
			$this->cart->destroy();


		}
		redirect(user_url('login'));
	}

    
    
   }



