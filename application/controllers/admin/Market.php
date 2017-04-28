<?php
Class Market extends MY_Controller
{
    function __construct()
    {
         

        parent::__construct();
        $this->load->model('market_place_model');
    }

    function removeURL($strTitle)
    {

       $strTitle=trim($strTitle);
       $strTitle= preg_replace("/ {2,}/", " ", $strTitle);
       return $strTitle;
   }
    
    /*
     * Lay danh sach admin
     */
    function index()
    {
        $input = array();
        $input['select']="provinces.id as province_id,local_name,market_name,country_id,market_places.id as market_id";
        $input['join'] = array('provinces');

        $total_rows = count($this->market_place_model->join_market_page($input));
        
        //load ra thu vien phan trang
        $this->load->library('pagination');
        $config = array();
        $config['total_rows'] = $total_rows;//tong tat ca cac san pham tren website
        $config['base_url']   = admin_url('market/index'); //link hien thi ra danh sach san pham
        $config['per_page']   = 10;//so luong san pham hien thi tren 1 trang
        $config['uri_segment'] = 4;//phan doan hien thi ra so trang tren url
        $config['next_link']   = 'Trang kế tiếp';
        $config['prev_link']   = 'Trang trước';
        //khoi tao cac cau hinh phan trang
        $this->pagination->initialize($config);
        
        $segment = $this->uri->segment(4);
        $segment = intval($segment);
        
        $input['limit'] = array($config['per_page'], $segment);

        $list = $this->market_place_model->join_market_page($input);
    
        
        $this->data['list'] = $list;

        $total = count($list);
        $this->data['total'] = $total;
        
        //lay nội dung của biến message
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        
        $this->data['temp'] = 'admin/market/index';
        $this->load->view('admin/main', $this->data);
    }

        function search()
    {
         $input = array();
        $this->load->library('form_validation');
        $this->load->helper('form');
        //neu co gui form tim kiem
         $input['where'] = array();
        if ($this->input->post()) {
            $this->session->unset_userdata('local_name');
            $this->session->unset_userdata('market_name');
           
            

            $local_name= $this->input->post('local_name');

            $this->session->set_userdata('local_name',$this->removeURL($local_name));
            if ($this->session->userdata('local_name')) {
                $input['like'] = array('local_name', $this->session->userdata('local_name'));
            }


            $market_name= $this->input->post('market_name');

            $this->session->set_userdata('market_name',$this->removeURL($market_name));
            if ($this->session->userdata('market_name')) {
                $input['like'] = array('market_name', $this->session->userdata('market_name'));
            }

            
        }
        // cu tim theo session da gui trc do
        if (($this->session->userdata('local_name') || $this->session->userdata('market_name'))) {
            $input['where'] = array();
            
                $local_name =$this->session->userdata('local_name');
            if ($this->session->userdata('local_name')) {
                $input['like'] = array('local_name', $this->removeURL($local_name));
            }
                  
                $name=$this->session->userdata('market_name');
                if ($this->session->userdata('market_name')) {
                    $input['like'] = array('market_name', $this->removeURL($market_name));
                    //pre($input);                     
                }
            }
          
        
        
        // phân trang sau search
        //$input = array();
        $input['select']="provinces.id as province_id,local_name,market_name,country_id,market_places.id as market_id";
        $input['join'] = array('provinces');
        $total_rows = count($this->market_place_model->join_market_page($input));
        //pre($total_rows);

                    // thu vien phan trang
        $this->load->library('pagination');
        $config = array();
        $config['total_rows'] = $total_rows;
        // neu ko search thi de link phan trang nhu binh thuong
        //if(!isset($id) || !isset($name) )
        //{
            $config['base_url'] = admin_url('market/search'); // link hien thi du lieu
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

            $list = $this->market_place_model->join_market_page($input);
            //pre($info);
            $this->data['list'] =$list;
            //pre($list);
           

            

        // load filter list
    
        
        // gan thong bao loi de truyen vao view
        $this->data['message'] = $this->session->flashdata('message');
        $this->data['temp'] = 'admin/market/index';
        $this->load->view('admin/main', $this->data);
    }
    
    /*
     * Kiểm tra username đã tồn tại chưa
     */
    // function check_username()
    // {
    //     $action = $this->uri->rsegment(2);
    //     $email = $this->input->post('username');
    //     $where = array('username' => $username);

        
    //     $check = 'true';
    //     if($action == 'edit'){
    //         $info = $this->data['info']; //lay thong tin quan tri vien muon sua
    //         if($info->username == $username){
    //             $check = false;
    //         }
    //     }
        

    //     //kiêm tra xem username đã tồn tại chưa
    //     if($check && $this->accounts_model->check_exists($where))
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
            $this->form_validation->set_rules('province_id', 'Tên Tỉnh', 'required');
            $this->form_validation->set_rules('market_name', 'Tên Chợ', 'required');
            
            //nhập liệu chính xác
            if($this->form_validation->run())
            {
                //them vao csdl
                $province_id     = $this->input->post('province_id');
                $market_name     = $this->input->post('market_name');
                
                $data = array(
                    'province_id'     => $province_id,
                    'market_name' => $market_name,
                );
                if($this->market_place_model->create($data))
                { 
                    //tạo ra nội dung thông báo
                    $this->session->set_flashdata('message', 'Thêm mới dữ liệu thành công');
                }else{
                    $this->session->set_flashdata('message', 'Không thêm được');
                }
                //chuyen tới trang danh sách quản trị viên
                redirect(admin_url('market'));
            }
        }
        $this->load->model('province_model');
      
        $province = $this->province_model->get_list();
        
        $this->data['province'] = $province;
        
        $this->data['temp'] = 'admin/market/add';
        $this->load->view('admin/main', $this->data);
    }
    
    /*
     * Ham chinh sua thong tin quan tri vien
     */
    function edit()
    {
        //lay id cua quan tri vien can chinh sua
        $market_id = $this->uri->rsegment('3');
        
        $market_id = intval($market_id);

        // pre($id);
        
        $this->load->library('form_validation');
        $this->load->helper('form');
        
        //lay thong cua quan trị viên
        $info  = $this->market_place_model->get_info($market_id);
        
        //pre($info);
        if(!$info)
        {
            $this->session->set_flashdata('message', 'Không tồn tại quản trị viên');
            redirect(admin_url('market'));
        }
        //pre($info);
        $this->data['info'] = $info;
        //pre($info);
        $this->load->model('province_model');
        //$input = array();

        $province = $this->province_model->get_list();


        $this->data['province'] = $province;
        
        
        if($this->input->post())
        {
            $this->form_validation->set_rules('market_name', 'Tên Chợ', 'required');
            

            if($this->form_validation->run())
            {
                //them vao csdl
                $market_name     = $this->input->post('market_name');
                $province_id     = $this->input->post('province_id');
                $data = array(
                    'province_id'   => $province_id,
                    'market_name'     => $market_name

                );

              
                
                if($this->market_place_model->update($market_id, $data))
                {
                    //tạo ra nội dung thông báo
                    $this->session->set_flashdata('message', 'Cập nhật dữ liệu thành công');
                    //pre($local_name);
                }else{
                    $this->session->set_flashdata('message', 'Không cập nhật được');
                }
                //chuyen tới trang danh sách quản trị viên
                redirect(admin_url('market'));
            }
        }
        // $this->load->model('province_model');
      
        // $province = $this->province_model->get_list();
        
        // $this->data['province'] = $province;

        
        $this->data['temp'] = 'admin/market/edit';
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
        $info = $this->market_place_model->get_info($id);
        if(!$info)
        {
            $this->session->set_flashdata('message', 'Không tồn tại quản trị viên');
            redirect(admin_url('admin'));
        }
        //thuc hiện xóa
        $this->market_place_model->delete($id);
        
        $this->session->set_flashdata('message', 'Xóa dữ liệu thành công');
        redirect(admin_url('market'));
    }

    
    
    
}

?>


