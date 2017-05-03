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

      return true;
      
    }
  }

  $this->load->view('site/login/index');
}

    /*
     * Kiem tra username va password co chinh xac khong
     */
    function check_login()
    {
    	$phone = $this->input->post('phone');
    	
    	$password = $this->input->post('password');

    	$password = md5($password);

      $url = $this->session->userdata('current_url');

      if($this->session->userdata('account_id')&&$this->input->post('password')&&$this->input->post('phone')){

         $this->session->set_flashdata('message', 'Ban đã đăng nhập vui lòng thoát ra');
                redirect(user_url('login'));
      }

      $this->load->model('account_model');
      $where = array('phone' => $phone , 'password' => $password);

      if($this->account_model->check_exists($where))
      {

        $row = $this->account_model->join_permission($phone);
        
        if(intval($row->role_id)==2&&intval($row->active)==1){

          $this ->session ->set_userdata('account_id',$row->account_id) ;
          $this ->session ->set_userdata('permissions_ac',json_decode($row->permissions)) ;
          $this ->session ->set_userdata('buyer_id',$row->buyer_id) ;
          if(isset($url)){
            redirect(user_url('listproduct/product_detail/'.$url));
          }
          redirect(base_url('user/profile/list_order_buyer'));

        }
        if(intval($row->role_id)==3&&intval($row->active)==1){
         $expiration = $row->expiration_date-now();
         if($expiration <=0){
          $data =array('role_id'=>13);
          $this->account_model->update($row->account_id,$data);
        }

        $this ->session ->set_userdata('account_id',$row->account_id) ;
        $this ->session ->set_userdata('permissions_ac',json_decode($row->permissions)) ;
        $this ->session ->set_userdata('shop_id',$row->shop_id) ;
        redirect(user_url('profile/list_order_shop'));

      }
      if(intval($row->role_id)==4&&intval($row->active)==1){
        $this->session->set_userdata('expire','Tài khoản của bạn đã bị cấm ');
         $this ->session ->set_userdata('account_id',$row->account_id) ;
        $this ->session ->set_userdata('permissions_ac',json_decode($row->permissions)) ;
        $this ->session ->set_userdata('shop_id',$row->shop_id);
        redirect(user_url('profile/shop'));

     }
     if(intval($row->role_id)==13&&intval($row->active)==1){
       $this->session->set_userdata('expire','Tài khoản của bạn đã bị khóa do hết hạn sử dụng');
         $this ->session ->set_userdata('account_id',$row->account_id) ;
        $this ->session ->set_userdata('permissions_ac',json_decode($row->permissions)) ;
        $this ->session ->set_userdata('shop_id',$row->shop_id);
        redirect(user_url('profile/shop'));


     }
     if(intval($row->role_id)!=3||intval($row->role_id)!=2||intval($row->role_id)!=5){
       $this->form_validation->set_message(__FUNCTION__,'Sai tên tài khoản hoặc mật khẩu');
       return false;

     }


     return true;
   }
   $this->form_validation->set_message(__FUNCTION__,'Sai tên tài khoản hoặc mật khẩu');
   return false;
 }


}