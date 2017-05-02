[ơ<?php
Class Admin extends MY_Controller
{
    function __construct()
    {
         

        parent::__construct();
        $this->load->model('admin_model');
    }
    
    /*
     * Lay danh sach admin
     */
    function index()
    {
        $input = array();

        $list = $this->admin_model->join_role();
        
        
        $this->data['list'] = $list;

        $total = count($list);
        $this->data['total'] = $total;
        
        //lay nội dung của biến message
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        
        $this->data['temp'] = 'admin/admin/index';
        $this->load->view('admin/main', $this->data);
    }
    
    /*
     * Kiểm tra username đã tồn tại chưa
     */
    function check_phone()
    {
        $action = $this->uri->rsegment(2);
        $phone = $this->input->post('phone');
        $where = array('phone' => $phone);

        
        $check = 'true';
        if($action == 'edit'){
            $info = $this->data['info']; //lay thong tin quan tri vien muon sua
            if($info->phone == $phone){
                $check = false;
            }
        }
        

        //kiêm tra xem username đã tồn tại chưa
        if($check && $this->account_model->check_exists($where))
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
            $this->form_validation->set_rules('address', 'Địa Chỉ', 'required');
            $this->form_validation->set_rules('role_name', 'Chức vụ', 'required');
            $this->form_validation->set_rules('phone', 'Tài khoản đăng nhập', 'required');
            $this->form_validation->set_rules('password', 'Mật khẩu', 'required|min_length[6]');
            $this->form_validation->set_rules('re_password', 'Nhập lại mật khẩu', 'matches[password]');
            
            //nhập liệu chính xác
            if($this->form_validation->run())
            {
                //them vao csdl
                $role_name = $this->input->post('role_name');

                
                $data = array(
                    'role_name' => $role_name

                );
                $permissions = $this->input->post('permissions');
                $data['permissions'] = json_encode($permissions);
                $this->load->model('role_model');
                $this->role_model->create($data);

                // them vao bang account theo role_id

                $this->load->model('account_model');
                $phone = $this->input->post('phone');
                $password = $this->input->post('password');
                $active     = $this->input->post('acitve');
                $data_account = array(
                        'role_id' => $this->db->insert_id(),
                        'phone' => $phone,
                        'password' => md5($password),
                        'active' => 1
                        );

                $this->account_model->create($data_account);


                //$account_id = $this->db->insert_id();
                $this->load->model('admin_model');
                $address     = $this->input->post('address');
                $data_admin = array(
                        'account_id' => $this->db->insert_id(),
                        'address'    => $address,
                        );


                if($this->admin_model->create($data_admin))
                { 
                    //tạo ra nội dung thông báo
                    $this->session->set_flashdata('message', 'Thêm mới dữ liệu thành công');
                    //pre($data_admin);
                }else{
                    $this->session->set_flashdata('message', 'Không thêm được');
                }
                //chuyen tới trang danh sách quản trị viên
                redirect(admin_url('admin'));
            }
        }

        $this->config->load('permissions', true);
        $config_permissions = $this->config->item('permissions');
        $this->data['config_permissions'] = $config_permissions;
        
        $this->data['temp'] = 'admin/admin/add';
        $this->load->view('admin/main', $this->data);
    }
    
    /*
     * Ham chinh sua thong tin quan tri vien
     */
    function edit()
    {
        //lay id cua quan tri vien can chinh sua
        $account_id = $this->uri->rsegment('3');
        $account_id = intval($account_id);
        
        $this->load->library('form_validation');
        $this->load->helper('form');
        
        //lay thong cua quan trị viên
        $this->load->model('admin_model');
        $info  = $this->admin_model->edit_permissions($account_id);
        //pre($info);
        //pre($info);
        if(!$info)
        {
            $this->session->set_flashdata('message', 'Không tồn tại quản trị viên');
            redirect(admin_url('admin'));
        }
        $info->permissions = json_decode($info->permissions);
        //pre($info);


        $this->data['info'] = $info;
        $accounts_id = $info->account_id;
        $this->load->model('admin_model');
        $info2 = $this->admin_model->edit_admin($accounts_id);
        $id = $info2->id;
        //pre($info2);
        
        if($this->input->post())
        {
            $this->form_validation->set_rules('address', 'Địa Chỉ', 'required');
            
            $password = $this->input->post('password');
            if($password)
            {
                $this->form_validation->set_rules('password', 'Mật khẩu', 'required|min_length[6]');
                $this->form_validation->set_rules('re_password', 'Nhập lại mật khẩu', 'matches[password]');
            }
            if($this->form_validation->run())
            {
                //them vao csdl
                $role_id = $info->role_id;
                $permissions = $this->input->post('permissions');
                $data['permissions'] = json_encode($permissions);
                $this->load->model('role_model');
                $this->role_model->update($role_id, $data);

                $address = $this->input->post('address');
               
                $data = array(
                    
                    'address'   => $address
                );
                //neu ma thay doi mat khau thi moi gan du lieu
                if($password)
                {
                    $data['password'] = md5($password);
                }

                

                if($this->admin_model->update($id, $data))
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
        
        $this->config->load('permissions', true);
        $config_permissions = $this->config->item('permissions');
        $this->data['config_permissions'] = $config_permissions;

        $this->data['temp'] = 'admin/admin/edit';
        $this->load->view('admin/main', $this->data);
    }
    
    /*
     * Hàm xóa dữ liệu
     */
    function delete()
    {
        $account_id = $this->uri->rsegment('3');
        $account_id = intval($account_id);


        //lay thong tin cua quan tri vien
        $info = $this->admin_model->join_delete_admin($account_id);
        $accounts_id = $info->id;

        
        //pre($info);
        $this->load->model('account_model');
        
        if(!$info)
        {
            $this->session->set_flashdata('message', 'Không tồn tại quản người dùng');
            redirect(admin_url('admin'));
        }
        //pre($info);
        //thuc hiện xóa

        $this->account_model->delete($accounts_id);

        $admin_id = $info->admin_id;

        if(!$info)
        {
            $this->session->set_flashdata('message', 'Không tồn tại quản người dùng');
            redirect(admin_url('admin'));
        }

        $this->admin_model->delete($admin_id);

        $this->load->model('role_model');
        $role_id = $info->role_id;
        
        if(!$info)
        {
            $this->session->set_flashdata('message', 'Không tồn tại quản người dùng');
            redirect(admin_url('admin'));
        }
        //pre($info);
        //thuc hiện xóa

        $this->role_model->delete($role_id);




        
        $this->session->set_flashdata('message', 'Xóa dữ liệu thành công');
        redirect(admin_url('admin'));
    }

    
}
?>


