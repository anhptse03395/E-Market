<?php
Class Post extends MY_controller{

	function __construct()
	{
		parent::__construct();
		$this->load->model('product_model');
	}


	function index()

	{

		$this->load->model('catalog_model');
		$input_catalog['where'] = array('parent_id' => 0);
		$catalogs = $this->catalog_model->get_list($input_catalog);
		foreach ($catalogs as $row) {
			$input_catalog['where'] = array('parent_id' => $row->id);
			$subs = $this->catalog_model->get_list($input_catalog);
			$row->subs = $subs;
		}
		$this->data['catalogs'] = $catalogs;



		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->load->model('user_model');
		$user_id = $this->session->userdata('user_id');
		$input['where'] =  array('id' => $user_id );
		$info= $this->user_model->get_list($input);
		$this ->data['info']=$info;



        //neu ma co du lieu post len thi kiem tra
		if($this->input->post())

		{

			$this->form_validation->set_rules('p_name', 'Tên', 'required|min_length[8]');
			$this->form_validation->set_rules('p_email', 'Email đăng nhập', 'required|min_length[8]');
			$this->form_validation->set_rules('p_phone', 'Số điện thoại', 'required|min_length[8]|numeric');
			$this->form_validation->set_rules('p_number', 'Số lượng', 'required|numeric');
			$this->form_validation->set_rules('catalog', 'Danh Mục', 'required');
			$this->form_validation->set_rules('p_address', 'Địa chỉ', 'required|min_length[8]');
			$this->form_validation->set_rules('p_product_name', 'Tên sản phẩm', 'required|min_length[8]');
			$this->form_validation->set_rules('p_content', 'Nội dung', 'required|min_length[8]');

            //nhập liệu chính xác
			if($this->form_validation->run())
			{
                //them vao csdl
               
				$name     = $this->input->post('p_name');
				$email    = $this->input->post('p_email');
				$address = $this->input->post('p_address');
				$phone = $this->input->post('p_phone');
				$number = $this->input->post('p_number');
				$product_name = $this->input->post('p_product_name');
				$content =$this->input->post('p_content');
				$catalog_id = $this->input->post('catalog');

				$user_id = $this->session->userdata('user_id');
			


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
					'user_name'  =>  $name,
					'email' =>  $email,
					'catalog_id'=>$catalog_id,
					'image_link' => $image_link,
					'image_list' => $image_list,
					'address'=> $address,
					'phone' =>  $phone,
					'number'=> $number,
					'product_name' =>  $product_name,
					'content'=> $content,
					'user_id'=>	$user_id,
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
				redirect(user_url('post'));
			}

			
		}
		

		$this->load->view('site/post/index',$this->data);


	}
}
?>