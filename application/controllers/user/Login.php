<?php
Class Login extends MY_controller{

 function __construct()
 {


  parent::__construct();
  $this->load->model('account_model');
}

function index()
{


  $this->load->library('form_validation');
  $this->load->helper('form');
  if($this->input->post())
  {
    $this->form_validation->set_rules('login' ,'login', 'callback_check_login');
    if($this->form_validation->run())
    {
      $this->session->set_userdata('account_login', true);
      redirect(user_url('profile/listpost'));
      
    }
  }

  $this->load->view('site/login/index1');
}

    /*
     * Kiem tra username va password co chinh xac khong
     */
    function check_login()
    {
    	$email = $this->input->post('email');
    	
    	$password = $this->input->post('password');

    	$password = md5($password);


    	$this->load->model('account_model');
    	$where = array('email' => $email , 'password' => $password);

    	if($this->account_model->check_exists($where))
    	{

        $row = $this->account_model->join_permission($email);

        if(intval($row->role_id)==2){

          $this ->session ->set_userdata('account_id',$row->account_id) ;
          $this ->session ->set_userdata('permissions',json_decode($row->permissions)) ;

          $this ->session ->set_userdata('buyer_id',$row->buyer_id) ;
          redirect(user_url('home'));

        }
        if(intval($row->role_id)==3){
          $this ->session ->set_userdata('account_id',$row->account_id) ;
         
          $this ->session ->set_userdata('permissions',json_decode($row->permissions)) ;

          $this ->session ->set_userdata('shop_id',$row->shop_id) ;
            redirect(user_url('profile/listpost'));

        }

        return true;
      }
      $this->form_validation->set_message(__FUNCTION__,'Sai tên tài khoản hoặc mật khẩu');
      return false;
    }


  }