<?php
Class User extends MY_Controller
{
    function __construct()
    {
         

        parent::__construct();
        $this->load->model('buyer_model');
    }

    function removeURL($strTitle)
    {

       $strTitle=trim($strTitle);
       $strTitle= preg_replace("/ {2,}/", " ", $strTitle);
       return $strTitle;
   }


    function check_phone()
    {
        $phone = $this->input->post('phone');
        $where = array('phone' => $phone);
        $this->load->model('account_model');
        //kiêm tra xem username đã tồn tại chưa
        if($this->account_model->check_exists($where))
        {
            //trả về thông báo lỗi
            $this->form_validation->set_message(__FUNCTION__, 'Số điện thoại đã được đăng kí');
            return false;
        }
        return true;
    }
    
    
    /*
     * Lay danh sach admin
     */
    function index()
    {

        $input = array();
        $input['select']="accounts.id as account_id,buyer_name,phone,buyers.id as buyer_id,active,address,created";
        $input['join'] = array('accounts');
        //$input['where']="buyer_name like '%Linh%' ";

        $total_rows = count($this->buyer_model->join_buyer($input));
        $this->data['total_rows'] =$total_rows;


        //load ra thu vien phan trang 
        $this->load->library('pagination');
        $config = array();
        $config['total_rows'] = $total_rows;//tong tat ca cac san pham tren website
        $config['base_url']   = admin_url('user/index'); //link hien thi ra danh sach san pham
        $config['per_page']   = 10;//so luong san pham hien thi tren 1 trang
        $config['uri_segment'] = 4;//phan doan hien thi ra so trang tren url
        $config['next_link']   = 'Trang kế tiếp';
        $config['prev_link']   = 'Trang trước';
        //khoi tao cac cau hinh phan trang
        $this->pagination->initialize($config);
        
        $segment = $this->uri->segment(4);
        $segment = intval($segment);
        

        $input['limit'] = array($config['per_page'], $segment);

        //$input = array();

        $list = $this->buyer_model->join_buyer($input);
        
        $this->data['list'] = $list;

        $total = count($list);
        $this->data['total'] = $total;
        
        //lay nội dung của biến message
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        
        $this->data['temp'] = 'admin/user/index';
        $this->load->view('admin/main', $this->data);
    }
    
        function search()
    {
         $input = array();
        $this->load->library('form_validation');
        $this->load->helper('form');
        //neu co gui form tim kiem
           
         $where =array();
        if ($this->input->post()) {
            $this->session->unset_userdata('phone');
            $this->session->unset_userdata('from_date');
            $this->session->unset_userdata('end_date');
            $this->session->unset_userdata('status');

           
              $this->session->set_userdata('phone', $this->input->post('phone'));

            if ($this->session->userdata('phone')) {
                $where['accounts.phone'] = $this->session->userdata('phone');

            }
              $this->session->set_userdata('status', $this->input->post('status'));

            if ($this->session->userdata('status')) {
                $where['accounts.active'] = $this->session->userdata('status');

            }

            $this->session->set_userdata('from_date', $this->input->post('from_date'));
            $from_date =  $this->session->userdata('from_date');
            $this->session->set_userdata('end_date', $this->input->post('end_date'));
            $end_date= $this->session->userdata('end_date');
            if ($from_date &&$end_date='') {
                $time = get_time_between_day_admin($from_date,$end_date);
            //nếu dữ liệu trả về hợp lệ
                if(is_array($time))
                {   
                    $where['buyers.created >='] = $time['start'];

                }

            }
            if ($end_date &&$from_date='') {
                $time = get_time_between_day_admin($end_date,$from_date);
            //nếu dữ liệu trả về hợp lệ
                if(is_array($time))
                {   

                    $where['buyers.created <='] = $time['end'];
                }

            }


            if ($from_date && $end_date) {
                $time = get_time_between_day($from_date,$end_date);
            //nếu dữ liệu trả về hợp lệ
                if(is_array($time))
                {   
                    $where['buyers.created >='] = $time['start'];
                    $where['buyers.created <='] = $time['end'];
                }

            }
                        
        }

         if ($this->session->userdata('phone')) {
                $where['accounts.phone'] = $this->session->userdata('phone');

            }


        if ($this->session->userdata('status')) {
                $where['accounts.active'] = $this->session->userdata('status');

        }


       if ($this->session->userdata('from_date') && ($this->session->userdata('end_date'))) {

        $from_date= $this->session->userdata('from_date');
        $end_date= $this->session->userdata('end_date');
        $time = get_time_between_day_admin($from_date,$end_date);
        if(is_array($time))
        {   
            $where['buyers.created >='] = $time['start'];
            $where['buyers.created <='] = $time['end'];
        }

    }

    if ($this->session->userdata('from_date') && ($this->session->userdata('end_date'))=='') {

        $from_date= $this->session->userdata('from_date');
        $end_date= $this->session->userdata('end_date');
        $time = get_time_between_day_admin($from_date,$end_date);
        if(is_array($time))
        {   
            $where['buyers.created  >='] = $time['start'];

        }

    }
    if ($this->session->userdata('from_date')=='' && ($this->session->userdata('end_date'))) {

        $from_date= $this->session->userdata('from_date');
        $end_date= $this->session->userdata('end_date');
        $time = get_time_between_day_admin($end_date,$from_date);
        if(is_array($time))
        {   

            $where['buyers.created <='] = $time['end'];
        }

    }

        // cu tim theo session da gui trc do
      
        $input['where'] = $where;
        
        $total_rows = count($this->buyer_model->join_buyer_admin($input));
        $this->data['total_rows'] =$total_rows;

        //pre($total_rows);

                    // thu vien phan trang
        $this->load->library('pagination');
        $config = array();
        $config['total_rows'] = $total_rows;
        // neu ko search thi de link phan trang nhu binh thuong
        //if(!isset($id) || !isset($name) )
        //{
            $config['base_url'] = admin_url('user/search'); // link hien thi du lieu
            // }
            $config['per_page'] = 20;
            $config['uri_segment'] = 4;
           // $config['use_page_numbers'] = TRUE;
            $config['next_link']   = 'Trang kế tiếp';
            $config['prev_link']   = 'Trang trước';
            $config['first_link'] = 'Trang đầu';
            $config['last_link'] = 'Trang cuối';
                //khoi tao cac cau hinh phan trang
            $this->pagination->initialize($config);

            $segment = intval($this->uri->segment(4));

            $input['limit'] = array($config['per_page'], $segment);

            $list = $this->buyer_model->join_buyer_admin($input);
            //pre($info);
            $this->data['list'] =$list;
        
        $this->data['temp'] = 'admin/user/index';
        $this->load->view('admin/main', $this->data);
    }
    /*
     * Kiểm tra username đã tồn tại chưa
     */
    // function check_username()
    // {
    //     $name = $this->input->post('name');
    //     $where = array('user_name' => $name);
    //     //kiêm tra xem username đã tồn tại chưa
    //     if($this->buyer_model->check_exists($where))
    //     {
    //         //trả về thông báo lỗi
    //         $this->form_validation->set_message(__FUNCTION__, 'Tài khoản đã tồn tại');
    //         return false;
    //     }
    //     return true;
    // }
    
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
           $this->form_validation->set_rules('phone', 'Phone', 'required|min_length[10]|numeric|callback_check_phone|regex_match[/^[0-9]{10}$/]');
            $this->form_validation->set_rules('buyer_name', 'Tên', 'required|min_length[2]');
            $this->form_validation->set_rules('address', 'Địa Chỉ', 'required|min_length[5]');
            $this->form_validation->set_rules('password', 'Mật khẩu', 'required|min_length[6]');
            $this->form_validation->set_rules('re_password', 'Nhập lại mật khẩu', 'matches[password]');
            
            //nhập liệu chính xác
            if($this->form_validation->run())
            {
                $role_id     = $this->input->post('role_id');
                $phone = $this->input->post('phone');
                $active     = $this->input->post('acitve');
                $password = $this->input->post('password');
                
                $data = array(

                    'role_id' => 2,
                    'phone' => $phone,
                    'password' => md5($password),
                    'active' => 1
                );
                $this->load->model('account_model');
                $this->account_model->create($data);


                $account_id = $this->db->insert_id();


                $this->load->model('buyer_model');

                $buyer_name     = $this->input->post('buyer_name');
                $address     = $this->input->post('address');
                $created        = $this->input->post('created');
                $data_buyer = array(
                        'account_id' => $this->db->insert_id(),
                        'buyer_name'     => $buyer_name,
                        'address'    => $address,
                        'created'   => now()
                        );

                if($this->buyer_model->create($data_buyer))
                { 
                    //tạo ra nội dung thông báo
                    $this->session->set_flashdata('message', 'Thêm mới dữ liệu thành công');
                    
                    //them vao bang buyer
                    //$this->buyer_model->create($data);
                    
                }
                else{
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
    function view()
    {
        //lay id cua quan tri vien can chinh sua
        $account_id = $this->uri->rsegment('3');
        
        $account_id = intval($account_id);

        // pre($id);
        
        $this->load->library('form_validation');
        $this->load->helper('form');
        
        //lay thong cua quan trị viên
        $info  = $this->buyer_model->join_edit_buyer($account_id);
        
        $buyer_id = $info->buyer_id;
        if(!$info)
        {
            $this->session->set_flashdata('message', 'Không tồn tại quản trị viên');
            redirect(admin_url('user'));
        }
        $this->data['info'] = $info;
        
        
        if($this->input->post())
        {
            $this->form_validation->set_rules('buyer_name', 'Tên', 'required|min_length[6]');
            $this->form_validation->set_rules('address', 'Address', 'required|min_length[6]');
            
            // $password = $this->input->post('password');
            // if($password)
            // {
            //     $this->form_validation->set_rules('password', 'Mật khẩu', 'required|min_length[6]');
            //     $this->form_validation->set_rules('re_password', 'Nhập lại mật khẩu', 'matches[password]');
            // }
            if($this->form_validation->run())
            {
                //them vao csdl
                $buyer_name     = $this->input->post('buyer_name');
                $address = $this->input->post('address');
                $data = array(
                    'buyer_name'     => $buyer_name,
                    'address' => $address,
                );

                //neu ma thay doi mat khau thi moi gan du lieu
                // if($password)
                // {
                //     $data['password'] = md5($password);
                // }
                
                if($this->buyer_model->update($buyer_id, $data))
                {
                    //tạo ra nội dung thông báo
                    $this->session->set_flashdata('message', 'Cập nhật dữ liệu thành công');
                }else{
                    $this->session->set_flashdata('message', 'Không cập nhật được');
                }
                //chuyen tới trang danh sách quản trị viên
                redirect(admin_url('user'));
            }
        }
        
        $this->data['temp'] = 'admin/user/view';
        $this->load->view('admin/main', $this->data);
    }
    
    /*
     * Hàm xóa dữ liệu
     */
    function delete()
    {
        $buyer_id = $this->uri->rsegment('3');
        $buyer_id = intval($buyer_id);


        $this->_del($buyer_id);


        
        $this->session->set_flashdata('message', 'Xóa dữ liệu thành công');
        redirect(admin_url('user'));
    }



       private function _del($id, $rediect = true)
    {   

          $this->load->model('account_model');
        $info = $this->buyer_model->get_info($id);

        $account = $this->account_model->get_info($info->account_id);
        if(!$info)
        {
            //tạo ra nội dung thông báo
            $this->session->set_flashdata('message', 'không tồn tại cửa hàng  này');
            if($rediect)
            {
                redirect(admin_url('user'));
            }else{
                return false;
            }
        }
        
        //kiem tra xem danh muc nay co san pham khong
        $this->load->model('orders_model');
        $order = $this->orders_model->get_info_rule(array('buyer_id' => $id), 'id');
        if($order)
        {
            //tạo ra nội dung thông báo
            $this->session->set_flashdata('message', 'người dùng '.$info->buyer_name.' có chứa đơn hàng,bạn cần xóa các đơn hàng trước khi xóa người dùng này');
            if($rediect)
            {
                redirect(admin_url('user'));
            }else{
                return false;
            }
        }
        
      $this->account_model->delete($account->id);
        $this->buyer_model->delete($id);
        
    }

    
}



