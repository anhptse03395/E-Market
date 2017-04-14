<?php
Class MY_Controller extends CI_Controller
{
    //bien gui du lieu sang ben view
    public $data = array();
    
    function __construct()
    {
        //ke thua tu CI_Controller
        parent::__construct();
        
        $controller = $this->uri->segment(1);
        switch ($controller)
        {
            case 'admin' :
            {
                    //xu ly cac du lieu khi truy cap vao trang admin
                $this->load->helper('admin');
                $this->admin_check_login();
                break;
            }
            
            default:
            {

                    //xu ly cac du lieu khi truy cap vao trang admin
               $this->load->helper('user');
               $this->user_check_login();

               $this->load->library('cart');
               $this->data['total_items']  = $this->cart->total_items();

               $this->load->model('account_model');
               $account_id = $this->session->userdata('account_id');
               
               $shop_info= $this->account_model->join_shops($account_id);
               $this->data['shop_info']=$shop_info;

               $buyer_info= $this->account_model->join_buyer($account_id);
               $this->data['buyer_info']=$buyer_info;

           }

       }
   }

    /*
     * Kiem tra trang thai dang nhap cua admin
     */
    private function admin_check_login()
    {
        $controller = $this->uri->rsegment('1');
        $controller = strtolower($controller);

        // controller la cai can truoc khi lam gi 
        
        $login = $this->session->userdata('login');
        //neu ma chua dang nhap,ma truy cap 1 controller khac login
        if(!$login && $controller != 'login')
        {
            redirect(admin_url('login'));
        }
        //neu ma admin da dang nhap thi khong cho phep vao trang login nua.
        if($login && $controller == 'login')

        {

            redirect(admin_url('home'));
        }

        
        elseif (!in_array($controller, array('login', 'home'))) {
            $admin_role = $this->session->userdata('admin_role');
            $admin_root = $this->config->item('root_admin');
            if($admin_role != $admin_root){
                $permissions_admin = $this->session->userdata('permissions');
                
                $controller = $this->uri->rsegment(1);
                $action     = $this->uri->rsegment(2);
                $check = true;
                if(!isset($permissions_admin->{$controller})){
                    $check = false;
                }
                $permissions_action = $permissions_admin->{$controller};
                if(!in_array($action, $permissions_action)){
                    $check = false;
                }
                if(!$check){
                    $this->session->set_flashdata('message', 'Ban khong co quyen truy cap trang nay');
                    redirect(base_url('admin'));
                }
            }
            //kiem tra quyen admin
            

        }
    }
    private function user_check_login()
    {
        $controller = $this->uri->rsegment('1');
        $controller = strtolower($controller);
        
        $login = $this->session->userdata('account_id');
        //neu ma chua dang nhap,ma truy cap 1 controller khac login
        if(!$login && $controller == 'post')

        {
         $this->session->set_flashdata('message', 'Ban phải đăng nhập mới thực hiện chức năng này');
         redirect(user_url('login'));
     }
        //neu ma admin da dang nhap thi khong cho phep vao trang login nua.
     if(!$login && $controller == 'cart')

     {
         $this->session->set_flashdata('message', 'Ban phải đăng nhập mới thực hiện chức năng này'); 
         redirect(user_url('login'));
     }
      if(!$login && $controller == 'profile')

        {
         $this->session->set_flashdata('message', 'Ban phải đăng nhập mới thực hiện chức năng này');
         redirect(user_url('login'));
     }
     elseif (!in_array($controller, array('login','register','listproduct', 'home','user','contact','rule','Test'))) {
        $account_id = $this->session->userdata('account_id');
        $shop_id = $this->session->userdata('shop_id');
        $buyer_id =  $this->session->userdata('buyer_id');
        if($account_id){
            $permissions_user = $this->session->userdata('permissions_ac');
            
            $controller = $this->uri->rsegment(1);
            $action     = $this->uri->rsegment(2);
            $check = true;
            if(!isset($permissions_user->{$controller})){
                $check = false;
            }
            $permissions_action = $permissions_user->{$controller};
            if(!in_array($action, $permissions_action)){
                $check = false;
            }
            if(!$check){
                $this->session->set_flashdata('message', 'Tài khoản của bạn không thể thực hiện chức năng này');
                redirect(user_url('login'));
            }
        }
            //kiem tra quyen admin
        

    }


}

}


