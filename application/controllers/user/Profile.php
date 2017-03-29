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
        $email = $info->email;



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

                $where = array('password' => md5($old_password),'email'=>$email);
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
            $config['per_page']   = 2;//so luong san pham hien thi tren 1 trang
            $config['uri_segment'] = 4;//phan doan hien thi ra so trang tren url
            $config['next_link']   = 'Trang kế tiếp';
            $config['prev_link']   = 'Trang trước';
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

        $this->load->model('shop_model');
        $shop_id = $this->session->userdata('shop_id');
        $input['where'] =  array('id' => $shop_id );
        $info= $this->shop_model->get_list($input);
        $this ->data['info']=$info;



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
        $this->load->model('product_model');


        //load thư viện validate dữ liệu
        $this->load->library('form_validation');
        $this->load->helper('form');

        //neu ma co du lieu post len thi kiem tra
        if($this->input->post())
        {
            $this->form_validation->set_rules('p_product_name', 'Tên', 'required');
            $this->form_validation->set_rules('p_number', 'so luong', 'required');
            $this->form_validation->set_rules('catalog', 'Thể loại', 'required');
            if($this->form_validation->run())
            {
                //them vao csdl
                $name        = $this->input->post('product_name');
                $catalog_id  = $this->input->post('catalog');
                $number = $this->input->post('quantity');
                //lay ten file anh minh hoa duoc update len
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
                    'category_id' => $catalog_id,
                    'description'    => $this->input->post('description'),
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