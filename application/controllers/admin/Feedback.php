<?php 
Class Feedback extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('feedback_model');
    }

    function index()
    {

        $input = array();
        $input['select']="accounts.id as account_id,feedback.id as feedback_id,description,reason,created,phone";
        $input['join'] = array('accounts');
        //$input['where']="buyer_name like '%Linh%' ";

        $total_rows = count($this->feedback_model->feedback($input));
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

        $list = $this->feedback_model->feedback($input);
        
        $this->data['list'] = $list;

        $total = count($list);
        $this->data['total'] = $total;
        
        //lay nội dung của biến message
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        
        $this->data['temp'] = 'admin/feedback/index';
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
           
              $this->session->set_userdata('phone', $this->input->post('phone'));

            if ($this->session->userdata('phone')) {
                $where['accounts.phone'] = $this->session->userdata('phone');

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
                    $where['feedback.created >='] = $time['start'];

                }

            }
            if ($end_date &&$from_date='') {
                $time = get_time_between_day_admin($end_date,$from_date);
            //nếu dữ liệu trả về hợp lệ
                if(is_array($time))
                {   

                    $where['feedback.created <='] = $time['end'];
                }

            }


            if ($from_date && $end_date) {
                $time = get_time_between_day($from_date,$end_date);
            //nếu dữ liệu trả về hợp lệ
                if(is_array($time))
                {   
                    $where['feedback.created >='] = $time['start'];
                    $where['feedback.created <='] = $time['end'];
                }

            }
                        
        }

         if ($this->session->userdata('phone')) {
                $where['accounts.phone'] = $this->session->userdata('phone');

            }

       if ($this->session->userdata('from_date') && ($this->session->userdata('end_date'))) {

        $from_date= $this->session->userdata('from_date');
        $end_date= $this->session->userdata('end_date');
        $time = get_time_between_day_admin($from_date,$end_date);
        if(is_array($time))
        {   
            $where['feedback.created >='] = $time['start'];
            $where['feedback.created <='] = $time['end'];
        }

    }

    if ($this->session->userdata('from_date') && ($this->session->userdata('end_date'))=='') {

        $from_date= $this->session->userdata('from_date');
        $end_date= $this->session->userdata('end_date');
        $time = get_time_between_day_admin($from_date,$end_date);
        if(is_array($time))
        {   
            $where['feedback.created  >='] = $time['start'];

        }

    }
    if ($this->session->userdata('from_date')=='' && ($this->session->userdata('end_date'))) {

        $from_date= $this->session->userdata('from_date');
        $end_date= $this->session->userdata('end_date');
        $time = get_time_between_day_admin($end_date,$from_date);
        if(is_array($time))
        {   

            $where['feedback.created <='] = $time['end'];
        }

    }

        // cu tim theo session da gui trc do
      
        $input['where'] = $where;
        
        
        //pre($from_date);
        // phân trang sau search
        $total_rows = count($this->feedback_model->search_feedback($input));
        $this->data['total_rows'] =$total_rows;
        //pre($total_rows);

                    // thu vien phan trang
        $this->load->library('pagination');
        $config = array();
        $config['total_rows'] = $total_rows;
        // neu ko search thi de link phan trang nhu binh thuong
        //if(!isset($id) || !isset($name) )
        //{
            $config['base_url'] = admin_url('feedback/search'); // link hien thi du lieu
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
            $list = $this->feedback_model->search_feedback($input);
            $this->data['list'] =$list;


            

        // load filter list
    
        
        // gan thong bao loi de truyen vao view
        $this->data['message'] = $this->session->flashdata('message');
        $this->data['temp'] = 'admin/feedback/index';
        $this->load->view('admin/main', $this->data);
    }


    function edit()
    {
        //lay id cua quan tri vien can chinh sua
        $feedback_id = $this->uri->rsegment('3');
        
        $feedback_id = intval($feedback_id);

        
        $this->load->library('form_validation');
        $this->load->helper('form');
        
        //lay thong cua quan trị viên
        $info  = $this->feedback_model->feedback_info($feedback_id);
        
        $feedback_id = $info->feedback_id;
        if(!$info)
        {
            $this->session->set_flashdata('message', 'Không tồn tại quản trị viên');
            redirect(admin_url('user'));
        }
        $this->data['info'] = $info;
        
        
        
        
        $this->data['temp'] = 'admin/feedback/edit';
        $this->load->view('admin/main', $this->data);
    }

      function delete()
    {
        $feedback_id = $this->uri->rsegment('3');
        $feedback_id = intval($feedback_id);


        //lay thong tin cua quan tri vien
        $info = $this->feedback_model->feedback_info($feedback_id);
        //$feedback_id = $info->feedback_id;

        
        pre($info);
        
        if(!$info)
        {
            $this->session->set_flashdata('message', 'Không tồn tại người dùng');
            redirect(admin_url('feedback'));
        }
        //pre($info);
        //thuc hiện xóa

        $this->feedback_model->delete($feedback_id);
        
        $this->session->set_flashdata('message', 'Xóa dữ liệu thành công');
        redirect(admin_url('feedback'));
    }
    
}


 ?>