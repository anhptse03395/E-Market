<?php
Class User extends MY_Controller
{
    function __construct()
    {
    	 

        parent::__construct();
        $this->load->model('user_model');
    }
    
    /*
     * Lay danh sach admin
     */
    function index()
    {
        $input = array();
        $list = $this->user_model->get_list($input);
        $this->data['list'] = $list;
    
        $total = $this->user_model->get_total();
        $this->data['total'] = $total;
        
        //lay nội dung của biến message
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        
        $this->data['temp'] = 'admin/user/index';
        $this->load->view('admin/main', $this->data);
    }
    
    /*
     * Kiểm tra username đã tồn tại chưa
     */
    function check_username()
    {
        $name = $this->input->post('name');
        $where = array('user_name' => $name);
        //kiêm tra xem username đã tồn tại chưa
        if($this->user_model->check_exists($where))
        {
            //trả về thông báo lỗi
            $this->form_validation->set_message(__FUNCTION__, 'Tài khoản đã tồn tại');
            return false;
        }
        return true;
    }
    
    /*
     * Thêm mới quản trị viên
     */
    function add()
    {
        $this->load->library('form_validation');
        $this->load->helper('form');
        
        //neu ma co du lieu post len thi kiem tra
        if($this->input->post())
        {
            $this->form_validation->set_rules('name', 'Tên', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('phone', 'Phone', 'required');
            $this->form_validation->set_rules('address', 'Address', 'required');
            $this->form_validation->set_rules('password', 'Mật khẩu', 'required|min_length[6]');
            $this->form_validation->set_rules('re_password', 'Nhập lại mật khẩu', 'matches[password]');
            
            //nhập liệu chính xác
            if($this->form_validation->run())
            {
                //them vao csdl
                $name     = $this->input->post('name');
                $email     = $this->input->post('email');
                $phone = $this->input->post('phone');
                $address     = $this->input->post('address');
                $password = $this->input->post('password');
                
                $data = array(
                    'user_name'     => $name,
                    'email' => $email,
                    'phone' => $phone,
                    'address' => $address,
                    'password' => md5($password)
                );
                if($this->user_model->create($data))
                { 
                    //tạo ra nội dung thông báo
                    $this->session->set_flashdata('message', 'Thêm mới dữ liệu thành công');
                }else{
                    $this->session->set_flashdata('message', 'Không thêm được');
                }
                //chuyen tới trang danh sách quản trị viên
                redirect(admin_url('user'));
            }
        }
        
        $this->data['temp'] = 'admin/user/add';
        $this->load->view('admin/main', $this->data);
    }
    
    /*
     * Ham chinh sua thong tin nguoi dung
     */
    function edit()
    {
        //lay id cua quan tri vien can chinh sua
        $id = $this->uri->rsegment('3');
        $id = intval($id);
        
        $this->load->library('form_validation');
        $this->load->helper('form');
        
        //lay thong cua quan trị viên
        $info  = $this->user_model->get_info($id);
        if(!$info)
        {
            $this->session->set_flashdata('message', 'Không tồn tại quản trị viên');
            redirect(admin_url('admin'));
        }
        $this->data['info'] = $info;
        
        if($this->input->post())
        {
            $this->form_validation->set_rules('name', 'Tên', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('phone', 'Phone', 'required');
            $this->form_validation->set_rules('address', 'Address', 'required');
            
            $password = $this->input->post('password');
            if($password)
            {
                $this->form_validation->set_rules('password', 'Mật khẩu', 'required|min_length[6]');
                $this->form_validation->set_rules('re_password', 'Nhập lại mật khẩu', 'matches[password]');
            }
            if($this->form_validation->run())
            {
                //them vao csdl
                $name     = $this->input->post('name');
                $email = $this->input->post('email');
                $phone = $this->input->post('phone');
                $address = $this->input->post('address');
                $data = array(
                    'user_name'     => $name,
                    'email' => $email,
                    'phone' => $phone,
                    'address' => $address,
                );
                //neu ma thay doi mat khau thi moi gan du lieu
                if($password)
                {
                    $data['password'] = md5($password);
                }
                
                if($this->user_model->update($id, $data))
                {
                    //tạo ra nội dung thông báo
                    $this->session->set_flashdata('message', 'Cập nhật dữ liệu thành công');
                }else{
                    $this->session->set_flashdata('message', 'Không cập nhật được');
                }
                //chuyen tới trang danh sách quản trị viên
                redirect(admin_url('admin'));
            }
        }
        
        $this->data['temp'] = 'admin/admin/edit';
        $this->load->view('admin/main', $this->data);
    }
    
    /*
     * Hàm xóa dữ liệu
     */
    function delete()
    {
        $id = $this->uri->rsegment('3');
        $id = intval($id);
        //lay thong tin cua quan tri vien
        $info = $this->user_model->get_info($id);
        if(!$info)
        {
            $this->session->set_flashdata('message', 'Không tồn tại quản trị viên');
            redirect(admin_url('admin'));
        }
        //thuc hiện xóa
        $this->user_model->delete($id);
        
        $this->session->set_flashdata('message', 'Xóa dữ liệu thành công');
        redirect(admin_url('admin'));
    }
    
    // /*
    //  * Thuc hien dang xuat
    //  */
    
    // function logout()
    // {
    //     if($this->session->userdata('login'))
    //     {
    //         $this->session->unset_userdata('login');
    //     }
    //     redirect(admin_url('login'));
    // }
}



