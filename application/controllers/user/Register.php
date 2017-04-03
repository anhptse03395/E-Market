<?php
Class Register extends MY_controller{


	function __construct()
	{


		parent::__construct();
		$this->load->model('account_model');
		$this->load->helper('cookie');
	}


	function kind_account(){

		$this->load->view('site/register/index');
	}


	function check_phone()
	{
		$phone = $this->input->post('r_phone');
		$where = array('phone' => $phone);
        //kiêm tra xem username đã tồn tại chưa
		if($this->account_model->check_exists($where))
		{
            //trả về thông báo lỗi
			$this->form_validation->set_message(__FUNCTION__, 'Số điện thoại đã được đăng kí');
			return false;
		}
		return true;
	}



/*	function sendmail($email)
	{


		$config = Array(
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_port' => 465,
			'smtp_user' => 'anhptse03395@gmail.com',
			//'smtp_pass' => 'vuotxcgoyxxzhoqz',
			'smtp_pass' => 'vuotxcgoyxxzhoqz',
			//'smtp_pass' => 'change123!@#',
			'mailtype'  => 'html', 
			'charset'   => 'iso-8859-1'
			);



		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");

		$message = 'ban da dang ki thanh cong';
		$this->load->library('email', $config);
		//	$this->email->initialize($config);
		$this->email->set_newline("\r\n");
	    	$this->email->from('anhptse03395@gmail.com'); // change it to yours
	    	$this->email->to($email);// change it to yours
	    	$this->email->subject('Day la thu dang ki tai khoan cua ban');
	    	$this->email->message($message);
	    	if($this->email->send())
	    	{
	    		echo 'Email sent.';
	    	}
	    	else
	    	{
	    		show_error($this->email->print_debugger());
	    	}

	    }*/

	 function send_sms($phone,$sms){

	    $this->load->library('nexmo');
        // set response format: xml or json, default json
        $this->nexmo->set_format('json');
        $phone= intval($phone);
      
        $from = '+84982803436';
        $to = '+84'.$phone;
       
        $message = array(
            'text' =>  $sms,
        );
     	 $this->nexmo->send_message($from, $to, $message);


	    }




	    function shop()

	    {

	    	$this->load->library('form_validation');
	    	$this->load->helper('form');
	    	$this->load->model('shop_model');
	    	$this->load->model('buyer_model');

	    	$this->load->model('country_model');
	    	$this->load->model('province_model');
	    	$this->load->model('market_place_model');

	    	$countries =$this->country_model->get_list();
	    	$this->data['countries'] =$countries;



	    	$provinces = $this->province_model->get_list();
	    	$this->data['provinces'] = $provinces;


	    /*	$market_places = $this->market_place_model->get_list();
	    $this ->data['market_places'] = $market_places;*/




	    $province_id = $this->input->post('province');
	    if($province_id){
	    	$input['where']  = array('province_id' => $province_id);
	    	$market_places = $this->market_place_model->get_list($input);

	    	$this->data['market_places'] = $market_places;

	    }


        //neu ma co du lieu post len thi kiem tra
	    if($this->input->post())
	    {
	    	$this->form_validation->set_rules('r_name', 'Tên', 'required|min_length[2]');
	    	$this->form_validation->set_rules('r_phone', 'Số điện thoại', 'required|min_length[8]|numeric|callback_check_phone');

	    	$this->form_validation->set_rules('r_address', 'Địa chỉ', 'required|min_length[5]');		
	    	$this->form_validation->set_rules('r_password', 'Mật khẩu', 'required|min_length[6]');
	    	$this->form_validation->set_rules('r_confirm', 'Nhập lại mật khẩu', 'matches[r_password]');

            //nhập liệu chính xác
	    	if($this->form_validation->run())
	    	{
                //them vao csdl




	    		$name     = $this->input->post('r_name');
	    		$phone     = $this->input->post('r_phone');
	    		$address = $this->input->post('r_address');
	    		$password = $this->input->post('r_password');
	    		$market_id	= $this->input->post('market_place');

	    		$this->load->library('upload_library');
	    		$upload_path = './upload/shop';
	    		$upload_data = $this->upload_library->upload($upload_path, 'image');  
	    		$image_link = '';
	    		if(isset($upload_data['file_name']))
	    		{
	    			$image_link = $upload_data['file_name'];
	    		}
	    			mt_rand();
				$signup = rand(100000,999999);
	    		
	    		$data_account = array(
	    			'phone' => $phone,
	    			'password' => md5($password),
	    			'role_id' =>3,
	    			'activation'=>$signup,
					'active' =>0,

	    			);

	    		if($this->account_model->create($data_account)){
					$this->send_sms($phone,$signup);
				set_cookie('signed', $this->db->insert_id(), 86500 );
							
				}

	    		$account_id = $this->db->insert_id(); 
	    		$data_shop = array(
	    			'shop_name' => $name,
	    			'address'=>$address,
	    			'market_id' =>$market_id,
	    			'image_shop' => $image_link,
	    			'created' => now(),
	    			'account_id'=> $account_id,

	    			);


	    		if($this->shop_model->create($data_shop))
	    		{ 
	    			
	    			redirect(user_url('register/activate')); 
	    		
	    		}else{
	    			$this->session->set_flashdata('message', 'Không đăng kí được ');
	    		}




	    		
	    		redirect(user_url('register/shop'));
	    	}
	    }
	    $this->load->view('site/register/shop/index',$this->data);


	}

	function buyer(){

		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->load->model('buyer_model');





		if($this->input->post())
		{
			$this->form_validation->set_rules('r_name', 'Tên', 'required|min_length[2]');
			$this->form_validation->set_rules('r_phone', 'Số điện thoại', 'required|min_length[8]|numeric|callback_check_phone');
			$this->form_validation->set_rules('r_address', 'Địa chỉ', 'required|min_length[5]');		
			$this->form_validation->set_rules('r_password', 'Mật khẩu', 'required|min_length[6]');
			$this->form_validation->set_rules('r_confirm', 'Nhập lại mật khẩu', 'matches[r_password]');

            //nhập liệu chính xác
			if($this->form_validation->run())
			{
                //them vao csdl




				$name     = $this->input->post('r_name');
				$phone     = $this->input->post('r_phone');
				$address = $this->input->post('r_address');
				$password = $this->input->post('r_password');

					mt_rand();
				$signup = rand(100000,999999);


				$data_account = array(
					'phone' => $phone,
					'password' => md5($password),
					'role_id' =>2,
					'activation'=>$signup,
					'active' =>0,
					);


				if($this->account_model->create($data_account)){
					$this->send_sms($phone,$signup);
				set_cookie('signed', $this->db->insert_id(), 86500 );
							
				}

				$account_id = $this->db->insert_id(); 
			

				$data_buyer = array(
					'buyer_name' => $name,
					'address'=>$address,
					'account_id'=>$account_id,
					'created' => now(),

					);
				

				if($this->buyer_model->create($data_buyer))
				{ 

					redirect(user_url('register/activate')); 
				}else{
					$this->session->set_flashdata('message', 'Không đăng kí được ');
				}

				redirect(user_url('register/buyer'));
			}
		}
		$this->load->view('site/register/buyer/index',$this->data);


	}
	function activate(){
		if( !get_cookie('signed') ){
			redirect('register/activate');
		}


		$data['error'] = '';

		if( $this->input->post() ){
            //if sent
			$where =  array('id'=>get_cookie('signed'),'activation'=>$this->input->post('code') );
			$result = $this->db->where( $where )->count_all_results('accounts');
			if( $result < 1 ){
				$data['error'] = '<div class="error">The authorization code is not correct!</div>';
			} else {
				delete_cookie('signed');
				$this->db->set( array('active'=>1, 'activation'=>'') )->where('id', get_cookie('signed') )->update('accounts');
				$this->session->set_flashdata('message', 'bạn đã đăng kí thành công');

				redirect(user_url('login'));
			}           
		}

		$this->load->view('site/register/active',$data);



	}





}

