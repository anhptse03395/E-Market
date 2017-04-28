<?php

Class Profile extends MY_controller{

    function __construct()
    {
        parent::__construct();

        $this->load->model('product_model');
    }

    /*thông tin cá nhân người bán*/
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
                        redirect(user_url('profile/shop'));
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

    /*thông tin cá nhân người mua*/
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
                        redirect(user_url('profile/byer'));
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

     $this->load->library('form_validation');
     $this->load->helper('form');

     $this->data['temp1'] = 'site/profile/profile_shop/listpost/empty';
     $this->data['temp'] = 'site/profile/profile_shop/listpost/main';
     $this->load->view('site/profile/profile_shop/main', $this->data);

 }

 function list_shop_post(){
    $this->load->library('form_validation');
    $this->load->helper('form');


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
            $config['base_url']   = user_url('profile/list_shop_post'); //link hien thi ra danh sach san pham
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

            $this->data['temp1'] = 'site/profile/profile_shop/listpost/table';
            $this->data['temp'] = 'site/profile/profile_shop/listpost/main';
            $this->load->view('site/profile/profile_shop/main', $this->data);

        }



        function search_post(){

           $this->load->library('form_validation');
           $this->load->helper('form');

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
            if ($from_date &&$end_date='') {
                $time = get_time_between_day($from_date,$end_date);
            //nếu dữ liệu trả về hợp lệ
                if(is_array($time))
                {   
                    $where['products.created >='] = $time['start'];

                }

            }
            if ($end_date &&$from_date='') {
                $time = get_time_between_day($end_date,$from_date);
            //nếu dữ liệu trả về hợp lệ
                if(is_array($time))
                {   

                    $where['products.created <='] = $time['end'];
                }

            }


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

    if ($this->session->userdata('from_date') && ($this->session->userdata('end_date'))=='') {

        $from_date= $this->session->userdata('from_date');
        $end_date= $this->session->userdata('end_date');
        $time = get_time_between_day($from_date,$end_date);
        if(is_array($time))
        {   
            $where['products.created  >='] = $time['start'];

        }

    }
    if ($this->session->userdata('from_date')=='' && ($this->session->userdata('end_date'))) {

        $from_date= $this->session->userdata('from_date');
        $end_date= $this->session->userdata('end_date');
        $time = get_time_between_day($end_date,$from_date);
        if(is_array($time))
        {   

            $where['products.created  <='] = $time['end'];
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

            $this->data['temp1'] = 'site/profile/profile_shop/listpost/table';
            $this->data['temp'] = 'site/profile/profile_shop/listpost/main';
            $this->load->view('site/profile/profile_shop/main', $this->data);

        }

        /*Kiểm tra sự tồn tại của tên sản phẩm*/

        function check_name_product(){
          $product_name = $this->input->post('p_product_name');
          $where = array('product_name'=>$product_name);
          if($this->product_model->check_exists($where)){
              $this->form_validation->set_message(__FUNCTION__,'Tên sản phẩm trùng với tên sản phẩm mà bạn đã đăng');
              return false;
          }
          return true;
      } 
      /*người mua thêm sản phẩm*/
      function addproduct(){

        $this->load->model('account_model');

        $this->load->model('categories_model');
        $input_catalog['where'] = array('parent_id' => 0);
        $catalogs = $this->categories_model->get_list($input_catalog);
        foreach ($catalogs as $row) {
            $input_catalog['where'] = array('parent_id' => $row->id);
            $subs = $this->categories_model->get_list($input_catalog);
            $row->subs = $subs;
        }
        $this->data['catalogs'] = $catalogs;


        $this->load->model('supplier_model');

        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->model('shop_model');

        if($this->session->userdata('account_id')){

            $account_id = $this->session->userdata('account_id');
            $info= $this->account_model->join_shops($account_id);
            $this ->data['info']=$info;
        }




                //neu ma co du lieu post len thi kiem tra
        if($this->input->post())

        {

             /*   $this->form_validation->set_rules('p_name', 'Tên', 'required|min_length[8]');
             $this->form_validation->set_rules('p_phone', 'Số điện thoại', 'required|min_length[8]|numeric');*/
             $this->form_validation->set_rules('catalog', 'Danh Mục', 'required');
             /* $this->form_validation->set_rules('p_address', 'Địa chỉ', 'required|min_length[8]');*/
             $this->form_validation->set_rules('p_product_name', 'Tên sản phẩm', 'required|min_length[2]|callback_check_name_product');
             $this->form_validation->set_rules('p_content', 'Nội dung', 'required|min_length[8]');

                    //nhập liệu chính xác
             if($this->form_validation->run())
             {
                        //them vao csdl

                $name     = $this->input->post('p_name');
                $address = $this->input->post('p_address');
                $phone = $this->input->post('p_phone');
                $number = $this->input->post('p_number');
                $product_name = $this->input->post('p_product_name');
                $content =$this->input->post('p_content');
                $catalog_id = $this->input->post('catalog');

                $shop_id = $this->session->userdata('shop_id');



                $this->load->library('upload_library');
                $upload_path = './upload/product';
                $upload_data = $this->upload_library->upload($upload_path, 'image');
                $image_link = '';
                if(isset($upload_data['file_name']))
                {
                    $image_link = $upload_data['file_name'];
                }


                $image_list = array();
                $image_list = $this->upload_library->upload_file($upload_path, 'image_list');
                $image_list = json_encode($image_list);

                $data = array(

                    'product_name' =>  $product_name,
                    'supplier_id' =>1,
                    'category_id'=>$catalog_id,
                    'shop_id'=> $shop_id,
                    'image_link' => $image_link,
                    'image_list' => $image_list,
                    'description'=> $content,
                    'impression' => 1,
                    'created' => now(),
                    );

                if($this->product_model->create($data))
                {
                            //tạo ra nội dung thông báo
                    $this->session->set_flashdata('message', 'Bài đăng thành công');
                }else{
                    $this->session->set_flashdata('message', 'Không đăng bài được ');
                }
                        //chuyen tới trang danh sách quản trị viên
                redirect(user_url('profile/listpost'));
            }


        }
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $this->data['temp1'] = 'site/profile/profile_shop/listpost/add';
        $this->data['temp'] = 'site/profile/profile_shop/listpost/main';
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
            $this->form_validation->set_rules('catalog', 'Thể loại', 'required');
            $this->form_validation->set_rules('description', 'Miêu tả', 'required');

            if($this->form_validation->run())
            {
                //them vao csdl
                $name        = $this->input->post('product_name');
                $catalog_id  = $this->input->post('catalog');
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
                redirect(user_url('profile/list_shop_post'));
            }
        }

        $this->data['temp'] = 'site/profile/profile_shop/edit_post/index';
        $this->load->view('site/profile/profile_shop/main', $this->data);

    }


    /*nguoi mua xem đơn hàng*/
    function  list_order_buyer($offset = NULL){

       $this->load->library('form_validation');

       $this->load->helper('form');

       $buyer_id = $this->session->userdata('buyer_id');

       $this->load->model('orders_model');

       $total_rows= count($this->orders_model->join_count_total($buyer_id));
       $limit = 7;
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

    function compareDate() {
      $startDate = strtotime($this->input->post('from_date'));
      $endDate = strtotime($this->input->post('end_date'));

      if ($endDate >= $startDate)
        return True;
    else {
       $this->form_validation->set_message(__FUNCTION__,'Ngày bắt đầu phải nhỏ hơn ngày kết thúc');
       return False;
   }
}

/*người mua search đơn hàng*/

function  search_order_buyer(){
   $this->load->library('form_validation');
   $this->load->helper('form');


   $this->load->model('orders_model'); 


   $buyer_id = $this->session->userdata('buyer_id');
   $input = array();
   $where =array();
   if($this->input->post()){



    $this->session->unset_userdata('order_id');
    $this->session->unset_userdata('from_date');
    $this->session->unset_userdata('end_date');
    $this->session->unset_userdata('status');


    $this->session->set_userdata('order_id', $this->input->post('order_id'));

    if ($this->session->userdata('order_id')) {
        $where['orders.id'] = $this->session->userdata('order_id');

    }
    $this->session->set_userdata('status', $this->input->post('status'));

    if  ($this->session->userdata('status') !='') {
        $where['orders.status'] = $this->session->userdata('status');

    }


    $this->session->set_userdata('from_date', $this->input->post('from_date'));
    $from_date =  $this->session->userdata('from_date');
    $this->session->set_userdata('end_date', $this->input->post('end_date'));
    $end_date= $this->session->userdata('end_date');
    if ($from_date &&$end_date='') {
        $time = get_time_between_day($from_date,$end_date);
            //nếu dữ liệu trả về hợp lệ
        if(is_array($time))
        {   
            $where['orders.date_order >='] = $time['start'];

        }

    }
    if ($end_date &&$from_date='') {
        $time = get_time_between_day($end_date,$from_date);
            //nếu dữ liệu trả về hợp lệ
        if(is_array($time))
        {   

            $where['orders.date_order <='] = $time['end'];
        }

    }


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
if ($this->session->userdata('status')!='') {
    $where['orders.status'] = $this->session->userdata('status');

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
if ($this->session->userdata('from_date') && ($this->session->userdata('end_date'))=='') {

    $from_date= $this->session->userdata('from_date');
    $end_date= $this->session->userdata('end_date');
    $time = get_time_between_day($from_date,$end_date);
    if(is_array($time))
    {   
        $where['orders.date_order >='] = $time['start'];

    }

}
if ($this->session->userdata('from_date')=='' && ($this->session->userdata('end_date'))) {

    $from_date= $this->session->userdata('from_date');
    $end_date= $this->session->userdata('end_date');
    $time = get_time_between_day($end_date,$from_date);
    if(is_array($time))
    {   

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
            $config['per_page'] = 7;
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
        function  list_order_details(){
            $order_id = intval($this->uri->segment(4));

            $this->load->model('order_details_model');
            $this->load->model('orders_model');
            $list= $this->order_details_model->list_order_detail($order_id);
            $this->data['list']=$list;

            if($this->input->post()){

                $review_price = $this->input->post('review_price');
                if($review_price!=''&& $review_price==1){
                  $status =3;
                  $this->orders_model->shop_put_status($order_id,$status);
                  $this->session->set_flashdata('message', 'Bạn đã đồng ý với thỏa thuận giá');
              }
              if($review_price!=''&& $review_price==2){
                  $status =6;
                  $this->orders_model->shop_put_status($order_id,$status);
                  $this->session->set_flashdata('message', 'Bạn đã hủy đơn hàng');    
              }
              redirect(user_url('profile/list_order_details/'.$order_id));
          }

          $this->data['temp'] = 'site/profile/profile_buyer/list_order/order_details';
          $this->load->view('site/profile/profile_buyer/main', $this->data);



      }


      /*người bán xem đơn hàng*/
      function  list_order_shop($offset=null){

         $this->load->library('form_validation');
         $this->load->helper('form');


         $shop_id = $this->session->userdata('shop_id');
         $this->load->model('order_details_model');


         $total_rows=  count($this->order_details_model->list_shop_order($shop_id));

        //load ra thu vien phan trang
         $limit = 7;
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
        $list= $this->order_details_model->join_list_shop_order($shop_id,$limit,$offset);
        $this->data['list']=$list;


        $this->data['temp'] = 'site/profile/profile_shop/list_order/index';
        $this->load->view('site/profile/profile_shop/main', $this->data);
    }

    /*người bán search đơn hàng*/
    function  search_order_shop(){

       $this->load->library('form_validation');
       $this->load->helper('form');


       $this->load->model('order_details_model'); 


       $shop_id = $this->session->userdata('shop_id');
       $input = array();
       $where =array();
       if($this->input->post()){



        $this->session->unset_userdata('order_id');
        $this->session->unset_userdata('from_date');
        $this->session->unset_userdata('end_date');
        $this->session->unset_userdata('status');


        $this->session->set_userdata('order_id', $this->input->post('order_id'));

        if ($this->session->userdata('order_id')) {
            $where['orders.id'] = $this->session->userdata('order_id');

        }
        $this->session->set_userdata('status', $this->input->post('status'));

        if  ($this->session->userdata('status') !='') {
            $where['orders.status'] = $this->session->userdata('status');

        }
        $this->session->set_userdata('from_date', $this->input->post('from_date'));
        $from_date =  $this->session->userdata('from_date');
        $this->session->set_userdata('end_date', $this->input->post('end_date'));
        $end_date= $this->session->userdata('end_date');

        if ($from_date &&$end_date='') {
            $time = get_time_between_day($from_date,$end_date);
            //nếu dữ liệu trả về hợp lệ
            if(is_array($time))
            {   
                $where['orders.date_order >='] = $time['start'];

            }

        }
        if ($end_date &&$from_date='') {
            $time = get_time_between_day($end_date,$from_date);
            //nếu dữ liệu trả về hợp lệ
            if(is_array($time))
            {   

                $where['orders.date_order <='] = $time['end'];
            }

        }

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


    if ($this->session->userdata('status')!='') {
        $where['orders.status'] = $this->session->userdata('status');

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
if ($this->session->userdata('from_date') && ($this->session->userdata('end_date'))=='') {

    $from_date= $this->session->userdata('from_date');
    $end_date= $this->session->userdata('end_date');
    $time = get_time_between_day($from_date,$end_date);
    if(is_array($time))
    {   
        $where['orders.date_order >='] = $time['start'];

    }

}
if ($this->session->userdata('from_date')=='' && ($this->session->userdata('end_date'))) {

    $from_date= $this->session->userdata('from_date');
    $end_date= $this->session->userdata('end_date');
    $time = get_time_between_day($end_date,$from_date);
    if(is_array($time))
    {   

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
            $config['per_page'] = 6;
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

        /*người bán xem đơn hàng chi tiết*/

        function check_price(){
            $shop_id = $this->session->userdata('shop_id');
            $order_id =$this->uri->segment(4);
            $list = $this->order_details_model->shop_detail_order($shop_id,$order_id);
            foreach ($list as $row) {
             $price =  $this->input->post('price_'.$row->product_id);
             if($price<=0){
                $this->form_validation->set_message(__FUNCTION__, 'Giá điền phải lớn hơn 0');
                return false;
            }

        }
        return true;
    }

    function detail_order_shop(){

       $this->load->library('form_validation');
       $this->load->helper('form');

       $this->load->model('order_details_model');
       $this->load->model('orders_model');

       $shop_id = $this->session->userdata('shop_id');
       $order_id =$this->uri->segment(4);
       $this->data['order_id'] =$order_id;
       $orders = $this->orders_model->get_info($order_id);
       $this->data['orders'] =$orders;

       $list = $this->order_details_model->shop_detail_order($shop_id,$order_id);
       $this->data['list'] = $list;

       if($this->input->post())

       {
         //$this->form_validation->set_rules('test','ma don hang','min_length[6]');
         foreach ($list as $row) {

             $this->form_validation->set_rules('price_'. $row->product_id , 'giá', 'required|numeric|callback_check_price');

             if($this->form_validation->run()){

                $product_id =$this->input->post('product_'.$row->product_id);


                $price =  $this->input->post('price_'.$row->product_id);
               // $total_price = $quantity*$price;
                $this->order_details_model-> shop_put_price($order_id,$product_id,$price);                
                $status =2;
                $this->orders_model->shop_put_status($order_id,$status);
                $this->session->set_flashdata('message', 'Bạn đã gửi giá vui lòng chờ xác nhận người mua');
            }

        }
               //chuyen tới trang danh sách quản trị viên
   // redirect(user_url('profile/detail_order_shop/'.$order_id));
    }

    $this->data['temp'] = 'site/profile/profile_shop/list_order/detail';
    $this->load->view('site/profile/profile_shop/main', $this->data);



}
/*người bán đặt giá*/
function send_order(){
  $this->load->library('form_validation');
  $this->load->helper('form');
  $this->load->model('buyer_model');
  $this->load->model('orders_model');

  $order_id = $this->uri->segment(4);
  $orders = $this->orders_model->get_info($order_id);
  $this->data['orders'] =$orders;
  $buyers = $this->buyer_model->get_info($orders->buyer_id);
  $this->data['buyers'] =$buyers;

  $list_order = $this->orders_model->invoice_shop($order_id);
  $this->data['list_order'] =$list_order;
  if($this->input->post()){
    $status = $this->input->post('status');
    $data = array('status'=>$status);
    $this->orders_model->update($order_id,$data);

    $this->session->set_flashdata('message', 'Bạn đã gửi hàng cho người mua');
    redirect(user_url('profile/detail_order_shop/'.$order_id));


}


$this->data['temp'] = 'site/profile/profile_shop/list_order/send_invoice';
$this->load->view('site/profile/profile_shop/main', $this->data);

}




/*phản hồi của người mua*/
function feedback_buyer(){

    $this->load->model('account_model');

    $account_id = $this->session->userdata('account_id');

    $info= $this->account_model->join_buyer_feedback($account_id);
    $this->data['info']=$info;
    $this->load->library('form_validation');
    $this->load->helper('form');
    if($this->input->post())
    {
        $this->form_validation->set_rules('description', 'Tên', 'required|min_length[8]');
        $this->form_validation->set_rules('p_phone', 'Số điện thoại', 'required|min_length[8]|numeric');


            //nhập liệu chính xác
        if($this->form_validation->run())
        {
                //them vao csdl

            $description     = $this->input->post('description');
            $reason = $this->input->post('reason');

            $data = array(
                'account_id'=>$account_id,
                'description' =>  $description,
                'reason' =>$reason,

                );
            $this->load->model('feedback_model');
            if($this->feedback_model->create($data))
            {
                    //tạo ra nội dung thông báo
                $this->session->set_flashdata('message', 'Bài đăng thành công');
            }else{
                $this->session->set_flashdata('message', 'Không đăng bài được ');
            }
                //chuyen tới trang danh sách quản trị viên
            redirect(user_url('profile/list_order_buyer'));
        }



    }


    $this->data['temp'] = 'site/profile/profile_buyer/feedback/index';
    $this->load->view('site/profile/profile_buyer/main', $this->data);

}



function del_order(){

    $order_id = intval($this->uri->segment(4));
    $product_id =intval($this->uri->segment(5));
    $this->load->model('orders_model');
    $this->load->model('order_details_model');
    
    $count_list=  count($this->order_details_model-> get_list_order_detail($order_id));

    if($count_list==1){

        $this->order_details_model->del_order_detail($order_id,$product_id);
        $this->orders_model-> del_order($order_id);
        redirect(user_url('profile/list_order_shop'));
    }else{
        $this->order_details_model->del_order_detail($order_id,$product_id);
        redirect(user_url('profile/detail_order_shop/'.$order_id));
    }

}


function del()
{
    $id = intval($this->uri->segment(4));
    $this->__delete($id);
    $this->session->set_flashdata('message', 'Bạn đã xóa sản phẩm thành công');
    redirect(user_url('profile/list_shop_post'));
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


/* 18/4 feedback shop*/
function feedback_shop(){

    $this->load->model('account_model');

    $account_id = $this->session->userdata('account_id');

    $info= $this->account_model->join_shop_feedback($account_id);
    $this->data['info']=$info;
    $this->load->library('form_validation');
    $this->load->helper('form');
    if($this->input->post())
    {
        $this->form_validation->set_rules('description', 'Tên', 'required|min_length[8]');
        $this->form_validation->set_rules('p_phone', 'Số điện thoại', 'required|min_length[8]|numeric');


            //nhập liệu chính xác
        if($this->form_validation->run())
        {
                //them vao csdl

            $description     = $this->input->post('description');
            $reason = $this->input->post('reason');

            $data = array(
               'account_id'=>$account_id,
               'description' =>  $description,
               'reason' =>$reason,

               );
            $this->load->model('feedback_model');
            if($this->feedback_model->create($data))
            {
                    //tạo ra nội dung thông báo
                $this->session->set_flashdata('message', 'Bài đăng thành công');
            }else{
                $this->session->set_flashdata('message', 'Không đăng bài được ');
            }
                //chuyen tới trang danh sách quản trị viên
            redirect(user_url('profile/list_order_shop'));
        }



    }


    $this->data['temp'] = 'site/profile/profile_shop/feedback/index';
    $this->load->view('site/profile/profile_shop/main', $this->data);

}

/*công nợ của buyer*/
function  manage_debt_buyer($offset = 0){


 $this->load->library('form_validation');
 $this->load->helper('form');
 $this->load->model('invoices_model');
 $buyer_id = $this->session->userdata('buyer_id');
 $total_info =$this->invoices_model->total_info_buyer($buyer_id);
 $this->data['total_info'] =$total_info;

 $total_rows= count($this->invoices_model->count_debt_buyer($buyer_id));
 $limit = 6;

 $this->load->library('pagination');
 $config = array();
        $config['total_rows'] =$total_rows;//tong tat ca cac san pham tren website
        $config['base_url']   = user_url('profile/manage_debt_buyer'); //link hien thi ra danh sach san pham
        $config['per_page']   = $limit;//so luong san pham hien thi tren 1 trang
        // $config['uri_segment'] = 4;//phan doan hien thi ra so trang tren url
        $config['next_link']   = 'Trang kế tiếp';
        $config['prev_link']   = 'Trang trước';
        $config['first_link'] = 'Trang đầu';
        $config['last_link'] = 'Trang cuối';
        //khoi tao cac cau hinh phan trang
        $this->pagination->initialize($config);     
        $list= $this->invoices_model->list_debt_buyer($buyer_id,$limit,$offset);
        $this->data['list']=$list;

        $this->data['temp'] = 'site/profile/profile_buyer/manage_debt/index';
        $this->load->view('site/profile/profile_buyer/main', $this->data);


    }


    function search_debt_buyer($offset = 0){

      $this->load->library('form_validation');
      $this->load->helper('form');
      $this->load->model('invoices_model');
      $buyer_id = $this->session->userdata('buyer_id');
      //pre($buyer_id);
      $total_info =$this->invoices_model->total_info_buyer($buyer_id);
      $this->data['total_info'] =$total_info;
      $order_id='';
      $shop_name='';
      $status ='';
      if($this->input->post()){

          $this->session->unset_userdata('shop_name');
          $this->session->unset_userdata('order_id');

          $this->session->set_userdata('shop_name', $this->input->post('shop_name'));

          if ($this->session->userdata('shop_name')) {

             $shop_name =$this->session->userdata('shop_name');
         }

         $this->session->set_userdata('status', $this->input->post('status'));

         if ($this->session->userdata('status')) {

             $status =$this->session->userdata('status');
         }

         $this->session->set_userdata('order_id', $this->input->post('order_id'));

         if ($this->session->userdata('order_id')) {

             $order_id =$this->session->userdata('order_id');
         }

     }
     if ($this->session->userdata('status')) {

         $status =$this->session->userdata('status');
     }

     if ($this->session->userdata('shop_name')) {

         $shop_name =$this->session->userdata('shop_name');
     }
     if ($this->session->userdata('order_id')) {

         $order_id =$this->session->userdata('order_id');
     }

     $total_rows = count($this->invoices_model->count_search_debt_buyer($buyer_id,$order_id,$shop_name,$status));
     $limit = 7;
   /*  echo $this->db->last_query();
   pre($total_rows);*/
   $this->load->library('pagination');
   $config = array();
        $config['total_rows'] =$total_rows;//tong tat ca cac san pham tren website
        $config['base_url']   = user_url('profile/search_debt_buyer'); //link hien thi ra danh sach san pham
        $config['per_page']   = $limit;//so luong san pham hien thi tren 1 trang
        // $config['uri_segment'] = 4;//phan doan hien thi ra so trang tren url
        $config['next_link']   = 'Trang kế tiếp';
        $config['prev_link']   = 'Trang trước';
        $config['first_link'] = 'Trang đầu';
        $config['last_link'] = 'Trang cuối';
        //khoi tao cac cau hinh phan trang
        $this->pagination->initialize($config);

        $list = $this->invoices_model->search_debt_buyer($buyer_id,$order_id,$shop_name,$status,$limit,$offset);
        $this->data['list']=$list;
        $this->data['temp'] = 'site/profile/profile_buyer/manage_debt/index';
        $this->load->view('site/profile/profile_buyer/main', $this->data);


    }
    /*chi tiết công nợ cua buyer*/
    function  detail_debt_buyer(){

        $order_id = intval($this->uri->segment(4));

        $this->load->model('invoices_model');
        $list= $this->invoices_model->detail_debt_buyer($order_id);
        $this->data['list']=$list;
        $this->data['temp'] = 'site/profile/profile_buyer/manage_debt/debt';
        $this->load->view('site/profile/profile_buyer/main', $this->data);


    }
    /*côn nợ của shop*/
    function  manage_debt_shop($offset = 0){



     $this->load->library('form_validation');
     $this->load->helper('form');
     $this->load->model('invoices_model');
     $shop_id = $this->session->userdata('shop_id');

     $total_rows= count($this->invoices_model->count_debt_shop($shop_id));
     $limit = 7;

     $total_info =$this->invoices_model->total_info_shop($shop_id);
     $this->data['total_info'] =$total_info;

     $this->load->library('pagination');
     $config = array();
        $config['total_rows'] =$total_rows;//tong tat ca cac san pham tren website
        $config['base_url']   = user_url('profile/manage_debt_shop'); //link hien thi ra danh sach san pham
        $config['per_page']   = $limit;//so luong san pham hien thi tren 1 trang
        // $config['uri_segment'] = 4;//phan doan hien thi ra so trang tren url
        $config['next_link']   = 'Trang kế tiếp';
        $config['prev_link']   = 'Trang trước';
        $config['first_link'] = 'Trang đầu';
        $config['last_link'] = 'Trang cuối';
        //khoi tao cac cau hinh phan trang
        $this->pagination->initialize($config);
        $list= $this->invoices_model->list_debt_shop($shop_id,$limit,$offset);     
        $this->data['list']=$list;
        $this->data['temp'] = 'site/profile/profile_shop/manage_debt/index';
        $this->load->view('site/profile/profile_shop/main', $this->data);


    }

    /*người bán tìm kiếm công nợ*/

    function search_debt_shop($offset = 0){

      $this->load->library('form_validation');
      $this->load->helper('form');
      $this->load->model('invoices_model');
      $shop_id = $this->session->userdata('shop_id');

      $total_info =$this->invoices_model->total_info_shop($shop_id);
      $this->data['total_info'] =$total_info;
      //pre($buyer_id);
      $order_id='';
      $buyer_name='';
      $status='';
      if($this->input->post()){

          $this->session->unset_userdata('buyer_name');
          $this->session->unset_userdata('order_id');
          $this->session->unset_userdata('status');

          $this->session->set_userdata('buyer_name', $this->input->post('buyer_name'));

          if ($this->session->userdata('buyer_name')) {

             $buyer_name =$this->session->userdata('buyer_name');
         }

         $this->session->set_userdata('status', $this->input->post('status'));

         if ($this->session->userdata('status')) {

             $status =$this->session->userdata('status');
         }
         $this->session->set_userdata('order_id', $this->input->post('order_id'));

         if ($this->session->userdata('order_id')) {

             $order_id =$this->session->userdata('order_id');
         }

     }
     if ($this->session->userdata('buyer_name')) {

         $buyer_name =$this->session->userdata('buyer_name');
     }
     if ($this->session->userdata('order_id')) {

         $order_id =$this->session->userdata('order_id');
     }

     if ($this->session->userdata('status')) {

         $status =$this->session->userdata('status');
     }

     $total_rows = count($this->invoices_model->count_search_debt_shop($shop_id,$order_id,$buyer_name,$status));
     $limit = 7;

   /*  echo $this->db->last_query();
   pre($total_rows);*/
   $this->load->library('pagination');
   $config = array();
        $config['total_rows'] =$total_rows;//tong tat ca cac san pham tren website
        $config['base_url']   = user_url('profile/search_debt_shop'); //link hien thi ra danh sach san pham
        $config['per_page']   = $limit;//so luong san pham hien thi tren 1 trang
        // $config['uri_segment'] = 4;//phan doan hien thi ra so trang tren url
        $config['next_link']   = 'Trang kế tiếp';
        $config['prev_link']   = 'Trang trước';
        $config['first_link'] = 'Trang đầu';
        $config['last_link'] = 'Trang cuối';
        //khoi tao cac cau hinh phan trang
        $this->pagination->initialize($config);

        $list = $this->invoices_model->search_debt_shop($shop_id,$order_id,$buyer_name,$status,$limit,$offset);
        $this->data['list']=$list;
        $this->data['temp'] = 'site/profile/profile_shop/manage_debt/index';
        $this->load->view('site/profile/profile_shop/main', $this->data);


    }









    /*chi tiết công nợ của shop*/
    function  detail_debt_shop(){

        $order_id = intval($this->uri->segment(4));
        $this->data['order_id'] =$order_id;

        $this->load->model('invoices_model');
        $list= $this->invoices_model->detail_debt_shop($order_id);
       // pre($list);
        $this->data['list']=$list;
        $this->data['temp'] = 'site/profile/profile_shop/manage_debt/detail_debt';
        $this->load->view('site/profile/profile_shop/main', $this->data);


    }

    function check_price_paid(){

        $this->load->model('invoices_model');
        $shop_id = $this->session->userdata('shop_id');
        $order_id = intval($this->uri->segment(4));
        $debt_info =$this->invoices_model->total_info_ashop($shop_id,$order_id);
        $paid = $this->input->post('paid');

        $debt = $debt_info->total_price-($paid+$debt_info->total_paid);
        if($paid<=0){
            $this->form_validation->set_message(__FUNCTION__, 'số tiền điền phải lớn hơn 0');
            return false;
        }if($debt<0){
           $this->form_validation->set_message(__FUNCTION__, 'Số tiền trả vượt quá số tiền đơn hàng');
           return false;
       }
       return true;
   }

   function  add_debt_shop(){
    $this->load->library('form_validation');
    $this->load->helper('form');

    $this->load->model('invoices_model');
    $this->load->model('orders_model');
    $this->load->model('buyer_model');
    $this->load->model('account_model');
    $shop_id = $this->session->userdata('shop_id');

    $order_id = intval($this->uri->segment(4));
    $orders = $this->orders_model->get_info($order_id);
    $this->data['orders']=$orders;

    $buyers = $this->buyer_model->get_info($orders->buyer_id);
    $this->data['buyers']=$buyers;

    $accounts = $this->account_model->get_info($buyers->account_id);
    $this->data['accounts']=$accounts;


    $debts =   $this->invoices_model->add_debt_shop($order_id,$shop_id);
    $this->data['debts']=$debts;


    $list= $this->invoices_model->detail_debt_shop($order_id);
    $this->data['list']=$list;

    $debt_info =$this->invoices_model->total_info_ashop($shop_id,$order_id);

    if($this->input->post()){

        $this->form_validation->set_rules('paid', 'Số tiền', 'required|numeric|callback_check_price_paid');

        if($this->form_validation->run()){
         $paid = $this->input->post('paid');
         $debt = $debt_info->total_price-($paid+$debt_info->total_paid);
         if($debt >0){
           $status =5;
       }else{
        $status =6;
    }

    $this->invoices_model->shop_put_paid($order_id,$paid);
    $this->orders_model->shop_put_status($order_id,$status);
    $this->session->set_flashdata('message', 'Số tiền của khách hàng trả đã thêm vào thành công');
    redirect(user_url('profile/detail_debt_shop/'.$order_id));
}

}

$this->data['temp'] = 'site/profile/profile_shop/manage_debt/add';
$this->load->view('site/profile/profile_shop/main', $this->data);


}

}



?>