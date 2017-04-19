<?php
Class Contact extends MY_controller{

    function __construct()
    {


        parent::__construct();
        $this->load->model('account_model');
    }

    function index()
    {
        $this->load->view('site/contact-us/index');
    }

    function feedback_guess(){
        $this->load->library('form_validation');
        $this->load->helper('form');
        if($this->input->post())
        {
            $this->form_validation->set_rules('description', 'Tên', 'required|min_length[8]');



            //nhập liệu chính xác
            if($this->form_validation->run())
            {
                //them vao csdl

                $description     = $this->input->post('description');
                $first_name     = $this->input->post('first_name');
                $last_name     = $this->input->post('last_name');
                $address     = $this->input->post('address');
                $phone     = $this->input->post('phone');



                $data = array(

                    'description' =>  $description,
                    'first_name'=> $first_name,
                    'last_name'=> $last_name,
                    'address'=> $address,
                    'phone'=>    $phone,

                );
                $this->load->model("feedback_model");
                if($this->feedback_model->create($data))
                {
                    //tạo ra nội dung thông báo
                    $this->session->set_flashdata('message', 'Bài đăng thành công');
                }else{
                    $this->session->set_flashdata('message', 'Không đăng bài được ');
                }
                //chuyen tới trang danh sách quản trị viên
                redirect(base_url('home'));
            }



        }




    }


}