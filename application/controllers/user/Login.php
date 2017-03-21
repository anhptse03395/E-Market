<?php
Class Login extends MY_controller{

 function __construct()
 {


  parent::__construct();
  $this->load->model('user_model');
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
      $this->session->set_userdata('user_login', true);
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


    	$this->load->model('user_model');
    	$where = array('email' => $email , 'password' => $password);
    	if($this->user_model->check_exists($where))
    	{

        $data_user =  array('email' => $email);
        $object = new StdClass;
        $object = $this->user_model->get_info_rule($data_user) ;
        $arraylist  = (array) $object ;
        $user_id= $arraylist['id'];

        $this ->session ->set_userdata('user_id',$user_id) ;
        $this ->session ->set_userdata('userInfo',$email) ;


        return true;
      }
      $this->form_validation->set_message(__FUNCTION__,'Sai tên tài khoản hoặc mật khẩu');
      return false;
    }


  }