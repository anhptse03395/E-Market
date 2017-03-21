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
                 case 'user' :
                {
                    //xu ly cac du lieu khi truy cap vao trang admin
                   $this->load->helper('user');
                    $this->user_check_login();
                    break;
                }
            default:
                {
                    //xu ly du lieu o trang ngoai
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
            $admin_id = $this->session->userdata('admin_id');
            $admin_root = $this->config->item('root_admin');
            if($admin_id != $admin_root){
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
        
        $login = $this->session->userdata('user_login');
        //neu ma chua dang nhap,ma truy cap 1 controller khac login
        if(!$login && $controller == 'post')
        {
            redirect(user_url('login'));
        }
        //neu ma admin da dang nhap thi khong cho phep vao trang login nua.
        if($login && $controller == 'login')

        {
            
            redirect(user_url('profile/listpost'));
        }
    }

}


