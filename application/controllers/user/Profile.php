<?php

Class Profile extends MY_controller{

    function __construct()
    {
        parent::__construct();

        $this->load->model('product_model');
    }


    function shop(){


        //lay id cua quan tri vien can chinh sua
        $this->load->model('account_model');

        $account_id = $this->session->userdata('account_id');
        $info= $this->account_model->join_shops($account_id);
        $this->data['info']=$info;
        $phone = $info->phone;



        $this->load->library('form_validation');
        $this->load->helper('form');



        if($this->input->post())
        {
            $old_password = $this->input->post('old_password');
            $repassword = $this->input->post('repassword');

            $new_password = $this->input->post('new_password');
            if($new_password)
            {
                $this->form_validation->set_rules('new_password', 'Mật khẩu moi', 'required|min_length[6]');
                $this->form_validation->set_rules('repassword', 'Nhập lại mật khẩu', 'matches[new_password]');
            }
            if($this->form_validation->run())
            {

                $where = array('password' => md5($old_password),'phone'=>$phone);
                if($this->account_model->check_exists($where)) {


                    //neu ma thay doi mat khau thi moi gan du lieu
                    if ($new_password) {
                        $data['password'] = md5($new_password);
                    }

                    if ($this->account_model->update($account_id, $data)) {
                        //tạo ra nội dung thông báo
                        $this->session->set_flashdata('message', 'Cập nhật dữ liệu thành công');
                        redirect(user_url('profile'));
                    } else {
                        $this->session->set_flashdata('message', 'Không cập nhật được');
                    }
                }
                $this->form_validation->set_message(__FUNCTION__,'Sai  mật khẩu');
                return false;
                

            }

        }
        $this->data['temp'] = 'site/profile/profile_shop/info/index';
        $this->load->view('site/profile/profile_shop/main', $this->data);


    }

    function buyer(){


        //lay id cua quan tri vien can chinh sua
        $this->load->model('account_model');

        $account_id = $this->session->userdata('account_id');
        $info= $this->account_model->join_buyer($account_id);
        $this->data['info']=$info;
        $phone = $info->phone;



        $this->load->library('form_validation');
        $this->load->helper('form');



        if($this->input->post())
        {
            $old_password = $this->input->post('old_password');
            $repassword = $this->input->post('repassword');

            $new_password = $this->input->post('new_password');
            if($new_password)
            {
                $this->form_validation->set_rules('new_password', 'Mật khẩu moi', 'required|min_length[6]');
                $this->form_validation->set_rules('repassword', 'Nhập lại mật khẩu', 'matches[new_password]');
            }
            if($this->form_validation->run())
            {

                $where = array('password' => md5($old_password),'phone'=>$phone);
                if($this->account_model->check_exists($where)) {


                    //neu ma thay doi mat khau thi moi gan du lieu
                    if ($new_password) {
                        $data['password'] = md5($new_password);
                    }

                    if ($this->account_model->update($account_id, $data)) {
                        //tạo ra nội dung thông báo
                        $this->session->set_flashdata('message', 'Cập nhật dữ liệu thành công');
                        redirect(user_url('profile'));
                    } else {
                        $this->session->set_flashdata('message', 'Không cập nhật được');
                    }
                }
                $this->form_validation->set_message(__FUNCTION__,'Sai  mật khẩu');
                return false;
                

            }

        }
        $this->data['temp'] = 'site/profile/profile_buyer/info/index';
        $this->load->view('site/profile/profile_buyer/main', $this->data);


    }



    function listpost(){


        $id = $this->session->userdata('account_id');
        $this->load->model('account_model');
        $info= $this->account_model->join_shops($id);

        if(intval($info->role_id)==3){

            $shop_id= $info->shop_id;
            $input = array();
            if($id > 0)
            {
                $input['where']['shop_id'] = $shop_id;
            }
            $name = $this->input->get('name');
            if($name)
            {
                $input['like'] = array('name', $name);
            }


        }


        $total_rows= $this->product_model->get_total($input);

            //load ra thu vien phan trang
        $this->load->library('pagination');
        $config = array();
            $config['total_rows'] =$total_rows;//tong tat ca cac san pham tren website
            $config['base_url']   = user_url('profile/listpost'); //link hien thi ra danh sach san pham
            $config['per_page']   = 5;//so luong san pham hien thi tren 1 trang
            $config['uri_segment'] = 4;//phan doan hien thi ra so trang tren url
            $config['next_link']   = 'Trang kế tiếp';
            $config['prev_link']   = 'Trang trước';
            $config['first_link'] = 'Trang đầu';
            $config['last_link'] = 'Trang cuối';
            //khoi tao cac cau hinh phan trang
            $this->pagination->initialize($config);

            $segment = $this->uri->segment(4);
            $segment = intval($segment);


            $input['limit'] = array($config['per_page'], $segment);
          //lay danh sach san pha
            $list = $this->product_model->get_list($input);
            $this->data['list'] = $list;

            $message = $this->session->flashdata('message');
            $this->data['message'] = $message;


            $this->data['temp'] = 'site/profile/profile_shop/listpost/index';
            $this->load->view('site/profile/profile_shop/main', $this->data);

        }


        function search_post(){


        $shop_id = $this->session->userdata('shop_id');
        $this->load->model('product_model');
        
         $input = array();
        $where =array();
        if($this->input->post()){



            $this->session->unset_userdata('product_name');
            $this->session->unset_userdata('from_date');
            $this->session->unset_userdata('end_date');


            $this->session->set_userdata('product_name', $this->input->post('product_name'));

            if ($this->session->userdata('product_name')) {
                $where['products.product_name like'] = $this->session->userdata('product_name');

            }
            $this->session->set_userdata('from_date', $this->input->post('from_date'));
            $from_date =  $this->session->userdata('from_date');
            $this->session->set_userdata('end_date', $this->input->post('end_date'));
            $end_date= $this->session->userdata('end_date');
            if ($from_date && $end_date) {
                $time = get_time_between_day($from_date,$end_date);
            //nếu dữ liệu trả về hợp lệ
                if(is_array($time))
                {   
                    $where['products.created >='] = $time['start'];
                    $where['products.created <='] = $time['end'];
                }

            }

        }

        if ($this->session->userdata('product_name')) {
         $where['products.product_name like']= $this->session->userdata('product_name'); ;

     }

     if ($this->session->userdata('from_date') && ($this->session->userdata('end_date'))) {

        $from_date= $this->session->userdata('from_date');
        $end_date= $this->session->userdata('end_date');
        $time = get_time_between_day($from_date,$end_date);
        if(is_array($time))
        {   
            $where['products.created >='] = $time['start'];
            $where['products.created <='] = $time['end'];
        }

    }

        $input['where'] = $where;

        $total_rows= count($this->product_model->search_listpost($input,$shop_id));
      
            //load ra thu vien phan trang
        $this->load->library('pagination');
        $config = array();
            $config['total_rows'] =$total_rows;//tong tat ca cac san pham tren website
            $config['base_url']   = user_url('profile/search_post'); //link hien thi ra danh sach san pham
            $config['per_page']   = 5;//so luong san pham hien thi tren 1 trang
            $config['uri_segment'] = 4;//phan doan hien thi ra so trang tren url
            $config['next_link']   = 'Trang kế tiếp';
            $config['prev_link']   = 'Trang trước';
            $config['first_link'] = 'Trang đầu';
            $config['last_link'] = 'Trang cuối';
            //khoi tao cac cau hinh phan trang
            $this->pagination->initialize($config);

             $segment = intval($this->uri->segment(4));


            $input['limit'] = array($config['per_page'], $segment);

            $list = $this->product_model->search_listpost($input,$shop_id);
            $this->data['list'] = $list;

            $message = $this->session->flashdata('message');
            $this->data['message'] = $message;


            $this->data['temp'] = 'site/profile/profile_shop/listpost/index';
            $this->load->view('site/profile/profile_shop/main', $this->data);

        }



        function edit_post()
        {
            $id = $this->uri->rsegment('3');
            $product = $this->product_model->get_info($id);
            if(!$product)
            {
            //tạo ra nội dung thông báo
                $this->session->set_flashdata('message', 'Không tồn tại sản phẩm này');
            }
            $this->data['product'] = $product;




            $this->load->model('categories_model');
            $input = array();
            $input['where'] = array('parent_id' => 0);
            $catalogs = $this->categories_model->get_list($input);
            foreach ($catalogs as $row)
            {
                $input['where'] = array('parent_id' => $row->id);
                $subs = $this->categories_model->get_list($input);
                $row->subs = $subs;
            }
            $this->data['catalogs'] = $catalogs;

        //lay danh sach danh muc san pham


        //load thư viện validate dữ liệu
            $this->load->library('form_validation');
            $this->load->helper('form');

        //neu ma co du lieu post len thi kiem tra
            if($this->input->post())
            {

                $this->form_validation->set_rules('product_name', 'Tên', 'required');
                $this->form_validation->set_rules('quantity', 'Số  lượng', 'required');
                $this->form_validation->set_rules('catalog', 'Thể loại', 'required');
                $this->form_validation->set_rules('description', 'Miêu tả', 'required');

                if($this->form_validation->run())
                {
                //them vao csdl
                    $name        = $this->input->post('product_name');
                    $catalog_id  = $this->input->post('catalog');
                    $number = $this->input->post('quantity');
                    $description        = $this->input->post('description');

                    $this->load->library('upload_library');
                    $upload_path = './upload/product';
                    $upload_data = $this->upload_library->upload($upload_path, 'image');
                    $image_link = '';
                    if(isset($upload_data['file_name']))
                    {
                        $image_link = $upload_data['file_name'];
                    }

                //upload cac anh kem theo
                    $image_list = array();
                    $image_list = $this->upload_library->upload_file($upload_path, 'image_list');
                    $image_list_json = json_encode($image_list);

                //luu du lieu can them
                    $data = array(
                        'product_name'=> $name,
                        'quantity'=>$number,
                        'category_id ' => $catalog_id,
                        'description'    =>$description,
                        );

                    if($image_link != '')
                    {
                        $data['image_link'] = $image_link;
                    }

                    if(!empty($image_list))
                    {
                        $data['image_list'] = $image_list_json;
                    }

                //them moi vao csdl
                    if($this->product_model->update($product->id, $data))
                    {
                    //tạo ra nội dung thông báo
                        $this->session->set_flashdata('message', 'Cập nhật dữ liệu thành công');
                    }else{
                        $this->session->set_flashdata('message', 'Không cập nhật được');
                    }
                    redirect(user_url('profile/listpost'));
                }
            }
            $this->data['temp'] = 'site/profile/profile_shop/edit_post/index';
            $this->load->view('site/profile/profile_shop/main', $this->data);

        }


        /*nguoi mua xem đơn hàng*/
        function  list_order_buyer($offset = NULL){
            $buyer_id = $this->session->userdata('buyer_id');

            $this->load->model('orders_model');

            $total_rows= count($this->orders_model->join_count_total($buyer_id));
            $limit = 2;
            if(!is_null($offset))
            {
                $offset = $this->uri->segment(4);
            }


            $this->load->library('pagination');
            $config = array();
        $config['total_rows'] =$total_rows;//tong tat ca cac san pham tren website
        $config['base_url']   = user_url('profile/list_order_buyer'); //link hien thi ra danh sach san pham
        $config['per_page']   = $limit;//so luong san pham hien thi tren 1 trang
       // $config['uri_segment'] = 4;//phan doan hien thi ra so trang tren url
        $config['next_link']   = 'Trang kế tiếp';
        $config['prev_link']   = 'Trang trước';
        $config['first_link'] = 'Trang đầu';
        $config['last_link'] = 'Trang cuối';
        //khoi tao cac cau hinh phan trang
        $this->pagination->initialize($config);


        //lay danh sach san pha
   //    $list = $this->orders_model->get_list($input);
        $list= $this->orders_model->join_buyer_order($buyer_id,$limit,$offset);
        $this->data['list']=$list;

        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;


        $this->data['temp'] = 'site/profile/profile_buyer/list_order/orders';
        $this->load->view('site/profile/profile_buyer/main', $this->data);


    }

    /*người mua search đơn hàng*/
    function  search_order_buyer(){

        $this->load->model('orders_model'); 


        $buyer_id = $this->session->userdata('buyer_id');
        $input = array();
        $where =array();
        if($this->input->post()){



            $this->session->unset_userdata('order_id');
            $this->session->unset_userdata('from_date');
            $this->session->unset_userdata('end_date');


            $this->session->set_userdata('order_id', $this->input->post('order_id'));

            if ($this->session->userdata('order_id')) {
                $where['orders.id'] = $this->session->userdata('order_id');

            }
            $this->session->set_userdata('from_date', $this->input->post('from_date'));
            $from_date =  $this->session->userdata('from_date');
            $this->session->set_userdata('end_date', $this->input->post('end_date'));
            $end_date= $this->session->userdata('end_date');
            if ($from_date && $end_date) {
                $time = get_time_between_day($from_date,$end_date);
            //nếu dữ liệu trả về hợp lệ
                if(is_array($time))
                {   
                    $where['orders.date_order >='] = $time['start'];
                    $where['orders.date_order <='] = $time['end'];
                }

            }




        }


        if ($this->session->userdata('order_id')) {
         $where['orders.id']= $this->session->userdata('order_id'); ;

     }

     if ($this->session->userdata('from_date') && ($this->session->userdata('end_date'))) {

        $from_date= $this->session->userdata('from_date');
        $end_date= $this->session->userdata('end_date');
        $time = get_time_between_day($from_date,$end_date);
        if(is_array($time))
        {   
            $where['orders.date_order >='] = $time['start'];
            $where['orders.date_order <='] = $time['end'];
        }

    }

    $input['where'] = $where;
    $total_rows = count($this->orders_model->join_muti($input,$buyer_id));

    
                    // thu vien phan trang
    $this->load->library('pagination');
    $config = array();
    $config['total_rows'] = $total_rows;
        // neu ko search thi de link phan trang nhu binh thuong
        // if(!isset($id) || !isset($name) || !isset($catalog_id) )
        //{
            $config['base_url'] = user_url('profile/search_order_buyer'); // link hien thi du lieu
            // }
            $config['per_page'] = 2;
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

            $list = $this->orders_model->join_muti($input,$buyer_id);
            $this->data['list'] =$list;
            $this->data['temp'] = 'site/profile/profile_buyer/list_order/orders';
            $this->load->view('site/profile/profile_buyer/main', $this->data);


        }
        /*người mua xem đơn hàng chi tiết*/
        function  list_order_details($offset = NULL){
            $order_id = intval($this->uri->segment(4));

            $this->load->model('order_details_model');
            $list= $this->order_details_model->list_order_detail($order_id);
            $this->data['list']=$list;

       /*     $total_rows= count($this->orders_model->join_count_total($buyer_id));
            $limit = 3;
            if(!is_null($offset))
            {
                $offset = $this->uri->segment(4);
            }


            $this->load->library('pagination');
            $config = array();
        $config['total_rows'] =$total_rows;//tong tat ca cac san pham tren website
        $config['base_url']   = user_url('profile/list_order_buyer'); //link hien thi ra danh sach san pham
        $config['per_page']   = $limit;//so luong san pham hien thi tren 1 trang
       // $config['uri_segment'] = 4;//phan doan hien thi ra so trang tren url
        $config['next_link']   = 'Trang kế tiếp';
        $config['prev_link']   = 'Trang trước';
        $config['first_link'] = 'Trang đầu';
        $config['last_link'] = 'Trang cuối';
        //khoi tao cac cau hinh phan trang
        $this->pagination->initialize($config);
*/

        //lay danh sach san pha
   //    $list = $this->orders_model->get_list($input);
   /*     $list= $this->orders_model->join_buyer_order($buyer_id,$limit,$offset);
   $this->data['list']=$list;*/

   $message = $this->session->flashdata('message');
   $this->data['message'] = $message;


   $this->data['temp'] = 'site/profile/profile_buyer/list_order/order_details';
   $this->load->view('site/profile/profile_buyer/main', $this->data);


}



function  list_order_shop($offset=null){
    $shop_id = $this->session->userdata('shop_id');
    $this->load->model('order_details_model');

    $total_rows=  count($this->order_details_model->list_shop_order($shop_id));

        //load ra thu vien phan trang
    $limit = 2;
    if(!is_null($offset))
    {
        $offset = $this->uri->segment(4);
    }


    $this->load->library('pagination');
    $config = array();
        $config['total_rows'] =$total_rows;//tong tat ca cac san pham tren website
        $config['base_url']   = user_url('profile/list_order_shop'); //link hien thi ra danh sach san pham
        $config['per_page']   = $limit;//so luong san pham hien thi tren 1 trang
       // $config['uri_segment'] = 4;//phan doan hien thi ra so trang tren url
        $config['next_link']   = 'Trang kế tiếp';
        $config['prev_link']   = 'Trang trước';
        $config['first_link'] = 'Trang đầu';
        $config['last_link'] = 'Trang cuối';
        //khoi tao cac cau hinh phan trang
        $this->pagination->initialize($config);


        //lay danh sach san pha
   //    $list = $this->orders_model->get_list($input);
        $list= $this->order_details_model->join_list_shop_order($shop_id,$limit,$offset);
        $this->data['list']=$list;

        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;


        $this->data['temp'] = 'site/profile/profile_shop/list_order/index';
        $this->load->view('site/profile/profile_shop/main', $this->data);
    }


    function  search_order_shop(){

        $this->load->model('order_details_model'); 


        $shop_id = $this->session->userdata('shop_id');
        $input = array();
        $where =array();
        if($this->input->post()){



            $this->session->unset_userdata('order_id');
            $this->session->unset_userdata('from_date');
            $this->session->unset_userdata('end_date');


            $this->session->set_userdata('order_id', $this->input->post('order_id'));

            if ($this->session->userdata('order_id')) {
                $where['orders.id'] = $this->session->userdata('order_id');

            }
            $this->session->set_userdata('from_date', $this->input->post('from_date'));
            $from_date =  $this->session->userdata('from_date');
            $this->session->set_userdata('end_date', $this->input->post('end_date'));
            $end_date= $this->session->userdata('end_date');
            if ($from_date && $end_date) {
                $time = get_time_between_day($from_date,$end_date);
            //nếu dữ liệu trả về hợp lệ
                if(is_array($time))
                {   
                    $where['orders.date_order >='] = $time['start'];
                    $where['orders.date_order <='] = $time['end'];
                }

            }




        }


        if ($this->session->userdata('order_id')) {
         $where['orders.id']= $this->session->userdata('order_id'); ;

     }

     if ($this->session->userdata('from_date') && ($this->session->userdata('end_date'))) {

        $from_date= $this->session->userdata('from_date');
        $end_date= $this->session->userdata('end_date');
        $time = get_time_between_day($from_date,$end_date);
        if(is_array($time))
        {   
            $where['orders.date_order >='] = $time['start'];
            $where['orders.date_order <='] = $time['end'];
        }

    }

    $input['where'] = $where;
    $total_rows = count($this->order_details_model->join_search($input,$shop_id));

    
                    // thu vien phan trang
    $this->load->library('pagination');
    $config = array();
    $config['total_rows'] = $total_rows;
        // neu ko search thi de link phan trang nhu binh thuong
        // if(!isset($id) || !isset($name) || !isset($catalog_id) )
        //{
            $config['base_url'] = user_url('profile/search_order_shop'); // link hien thi du lieu
            // }
            $config['per_page'] = 2;
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

            $list = $this->order_details_model->join_search($input,$shop_id);
            $this->data['list'] =$list;
            $this->data['temp'] = 'site/profile/profile_shop/list_order/index';
            $this->load->view('site/profile/profile_shop/main', $this->data);

        }

        function edit_order_shop(){




            $id = $this->uri->rsegment('3');
            $order = $this->order_model->get_info($id);
            $this->data['order'] = $order;
            $this->load->model('categories_model');


            //lay danh sach danh muc san pham
            $this->load->model('order_model');


            //load thư viện validate dữ liệu
            $this->load->library('form_validation');
            $this->load->helper('form');

            //neu ma co du lieu post len thi kiem tra
            if($this->input->post())
            {
                $this->form_validation->set_rules('status', 'Trạng Thái', 'required');
                if($this->form_validation->run())
                {
                    //them vao csdl
                    $product_name        = $this->input->post('product_name');
                    $status  = $this->input->post('status');
                    $number = $this->input->post('quantity');
                    $address =$this->input->post("address");
                    $date_order=$this->input->post("date_order");
                    //lay ten file anh minh hoa duoc update len

                    //luu du lieu can them
                    $data = array(
                        'product_name'=> $product_name,
                        'quantity'=>$number,
                        'status' => $status,
                        'address'    => $address,
                        'date_order'=>$date_order,
                        );

                    //them moi vao csdl
                    if($this->order_model->update($order->id, $data))
                    {
                        //tạo ra nội dung thông báo
                        $this->session->set_flashdata('message', 'Cập nhật dữ liệu thành công');
                    }else{
                        $this->session->set_flashdata('message', 'Không cập nhật được');
                    }
                    redirect(user_url('profile/list_shop_order'));
                }
            }
            $this->data['temp'] = 'site/profile/profile_shop/listorder/edit';
            $this->load->view('site/profile/profile_shop/main', $this->data);
        }


        function del()
        {
            $id = intval($this->uri->segment(4));
            $this->__delete($id);
            $this->session->set_flashdata('message', 'Successs delete');
            redirect(user_url('profile/listpost'));
        }

    // xoa nhieu san pham
        function del_all()
        {
            $ids = $this->input->post('ids');
            foreach ($ids as $id)
                $this->__delete($id);

        }

    // ham ho tro xoa nhieu
        private
        function __delete($id)
        {
            $product = $this->product_model->get_info($id);
            if (!$product) {
                $this->session->set_flashdata('message', 'Can not edited');
                redirect(user_url('profile/listpost'));
            }
        // xoa
            $this->product_model->delete($id);
        // xoa anh
            $image_link = './upload/product/' . $product->image_link;
            if (file_exists($image_link)) {
                unlink($image_link);
            }
        //xoa anh kem theo
            $image_list = json_decode($product->image_list);
            if (is_array($image_list)) {
                foreach ($image_list as $img) {
                    $image_link = './upload/product/' . $img;
                    if (file_exists($image_link)) {
                        unlink($image_link);
                    }
                }
            }
        }



    }



    ?>