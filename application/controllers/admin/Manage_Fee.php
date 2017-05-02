<?php
Class Manage_Fee extends MY_Controller
{
    function __construct()
    {
    	 

        parent::__construct();
        $this->load->model('fee_model');
         $this->load->model('shop_model');
    }
    
    /*
     * Lay danh sach admin
     */
    function index($offset = null) 
    {

        $total_rows= count($this->shop_model->join_fee());
       
        $this->data['total_rows'] = $total_rows;
        if($offset != null){
            $offset = $this->uri->segment(4);

        }
        $limit = 10;
        //load ra thu vien phan trang 
        $this->load->library('pagination');
        $config = array();
        $config['total_rows'] = $total_rows;//tong tat ca cac san pham tren website
        $config['base_url']   = admin_url('manage_fee/index'); //link hien thi ra danh sach san pham
        $config['per_page']   = $limit;//so luong san pham hien thi tren 1 trang
        //$config['uri_segment'] = 4;//phan doan hien thi ra so trang tren url
        $config['next_link']   = 'Trang kế tiếp';
        $config['prev_link']   = 'Trang trước';
        //khoi tao cac cau hinh phan trang
        $this->pagination->initialize($config);
        
        $list = $this->shop_model->join_fee_paging($limit,$offset);
     
        $this->data['list'] = $list;
        
        $total = count($list);
        $this->data['total'] = $total;
        
        //lay nội dung của biến message
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        
        $this->data['temp'] = 'admin/expired/index';
        $this->load->view('admin/main', $this->data);
    }
    
    function search()
    {
         $total_rows= count($this->shop_model->join_shops_admin_fee());


        $this->data['total_rows'] = $total_rows;
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
                    $where['shops.created >='] = $time['start'];

                }

            }
            if ($end_date &&$from_date='') {
                $time = get_time_between_day_admin($end_date,$from_date);
            //nếu dữ liệu trả về hợp lệ
                if(is_array($time))
                {   

                    $where['shops.created <='] = $time['end'];
                }

            }


            if ($from_date && $end_date) {
                $time = get_time_between_day($from_date,$end_date);
            //nếu dữ liệu trả về hợp lệ
                if(is_array($time))
                {   
                    $where['shops.created >='] = $time['start'];
                    $where['shops.created <='] = $time['end'];
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
            $where['shops.created >='] = $time['start'];
            $where['shops.created <='] = $time['end'];
        }

    }

    if ($this->session->userdata('from_date') && ($this->session->userdata('end_date'))=='') {

        $from_date= $this->session->userdata('from_date');
        $end_date= $this->session->userdata('end_date');
        $time = get_time_between_day_admin($from_date,$end_date);
        if(is_array($time))
        {   
            $where['shops.created  >='] = $time['start'];

        }

    }
    if ($this->session->userdata('from_date')=='' && ($this->session->userdata('end_date'))) {

        $from_date= $this->session->userdata('from_date');
        $end_date= $this->session->userdata('end_date');
        $time = get_time_between_day_admin($end_date,$from_date);
        if(is_array($time))
        {   

            $where['shops.created <='] = $time['end'];
        }

    }

        // cu tim theo session da gui trc do
      
        $input['where'] = $where;
        
        
        //pre($from_date);
        // phân trang sau search
        $total_row = count($this->shop_model->join_shops_admin_fee($input));
        //pre($total_rows);

                    // thu vien phan trang
        $this->load->library('pagination');
        $config = array();
        $config['total_rows'] = $total_row;
        // neu ko search thi de link phan trang nhu binh thuong
        //if(!isset($id) || !isset($name) )
        //{
            $config['base_url'] = admin_url('manage_fee/search'); // link hien thi du lieu
            // }
            $config['per_page'] = 10;
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

            $list = $this->shop_model->join_shops_admin_fee($input);
            //pre($info);
            $this->data['list'] =$list;
            //pre($list);
            //echo $this->db->last_query();

            

        // load filter list
    
        
        // gan thong bao loi de truyen vao view
        $this->data['message'] = $this->session->flashdata('message');
        $this->data['temp'] = 'admin/expired/index';
        $this->load->view('admin/main', $this->data);
    }




    function add_fee()
    {
        //lay id cua quan tri vien can chinh sua
        $shop_id = $this->uri->rsegment('3');
        
        $shop_id = intval($shop_id);

        $this->load->model('account_model');
        $this->load->library('form_validation');
        $this->load->helper('form');
        
        //lay thong cua quan trị viên
        $info  = $this->shop_model->get_info($shop_id);
        $account = $this->account_model->get_info($info->account_id);
        
        if(!$info)
        {
            $this->session->set_flashdata('message', 'Không tồn tại quản trị viên');
            redirect(admin_url('manage_fee'));
        }
        $this->data['info'] = $info;
           $this->data['account'] = $account;
    

        if($this->input->post())
        {
            $this->form_validation->set_rules('filing_date', 'Ngày thanh toán', 'required');
            $this->form_validation->set_rules('number_month', 'Số ngày', 'required|numeric');

            if($this->form_validation->run())
            {

                $date_rec = $this->input->post('filing_date');
                $number_month     = $this->input->post('number_month');

                $date =DateTime::createFromFormat('d-m-Y', $date_rec);     
                $date= $date->format('Y-m-d');
                $filing_date = strtotime($date);


                $value = $this->shop_model->add_fee_admin($shop_id);
                $remain_date    =$value->remain_date;
                if($remain_date<0){

                    $expiration_date = now()+$number_month*86400;
                }else{
                    $expiration_date = $value->expiration_date+ $number_month*86400;
                } 


                $data = array();
                $data = array(
                    'filing_date' => $filing_date,
                    'number_month'     => $number_month,
                    'shop_id' => $shop_id,
                    'expiration_date'=>$expiration_date
                );

                //neu ma thay doi mat khau thi moi gan du lieu
                // if($password)
                // {
                //     $data['password'] = md5($password);
                // }
                
                $this->fee_model->update_fee($shop_id, $data);

                $this->session->set_flashdata('message', 'Cập nhật dữ liệu thành công');

                
                    //tạo ra nội dung thông báo
               
                                //chuyen tới trang danh sách quản trị viên
                redirect(admin_url('manage_fee'));
            }
        }
        
        $this->data['temp'] = 'admin/expired/add_fee';
        $this->load->view('admin/main', $this->data);
    }
    
    /*
     * Hàm xóa dữ liệu
     */
    function delete()
    {
        $shop_id = $this->uri->rsegment('3');
        $shop_id = intval($shop_id);
        $this->_del($shop_id);
        $this->session->set_flashdata('message', 'Xóa dữ liệu thành công');
        redirect(admin_url('seller'));
    }



       private function _del($id, $rediect = true)
    {   

          $this->load->model('account_model');
        $info = $this->shop_model->get_info($id);

        $account = $this->account_model->get_info($info->account_id);
        if(!$info)
        {
            //tạo ra nội dung thông báo
            $this->session->set_flashdata('message', 'không tồn tại cửa hàng  này');
            if($rediect)
            {
                redirect(admin_url('seller'));
            }else{
                return false;
            }
        }
        
        //kiem tra xem danh muc nay co san pham khong
        $this->load->model('orders_model');
        $order = $this->orders_model->get_info_rule(array('shop_id' => $id), 'id');
        if($order)
        {
            //tạo ra nội dung thông báo
            $this->session->set_flashdata('message', 'cửa hàng '.$info->shop_name.' có chứa đơn hàng,bạn cần xóa các đơn hàng trước khi xóa cửa hàng này');
            if($rediect)
            {
                redirect(admin_url('seller'));
            }else{
                return false;
            }
        }
        
      $this->account_model->delete($account->id);
        $this->shop_model->delete($id);
        
    }


    
}



