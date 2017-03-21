<?php
Class ForgotPassword extends MY_controller{


	function __construct()
	{


		parent::__construct();
		$this->load->model('user_model');
		
	}


	function check_email()
	{
		$email = $this->input->post('forgot_email');
		$where = array('email' => $email);
        //kiêm tra xem username đã tồn tại chưa
		if($this->user_model->check_exists($where))
		{
            //trả về thông báo lỗi
			return true;
		}else{
			$this->form_validation->set_message(__FUNCTION__, 'Tài khoản Không tồn tại');
			return false;
		}


	}



	function index(){


		$this->load->library('form_validation');
		$this->load->helper('form');

		if($this->input->post())
		{

			$this->form_validation->set_rules('forgot_email', 'Email đăng nhập', 'required|callback_check_email');
            //nhập liệu chính xác
			if($this->form_validation->run())
			{
                //them vao csdl

				$email  = $this->input->post('forgot_email');

				$data = array(
					'email' => $email
					);


				$object = new StdClass;
				$object=$this->user_model->get_info_rule($data) ;
				$arraylist	= (array) $object ;
				$id=	$arraylist['id'];

				$new_password=  rand(100000,999999);
				$this->sendmail($email,$new_password);
				$new_input['password'] = md5($new_password);            
				$this->user_model->update($id,$new_input);
				$this->session->set_flashdata('message', 'Chúng tôi đã gửi password vào hòm thư bạn vừa nhập!');

				redirect(user_url('forgotpassword'));
			}



		}


		$this->load->view('site/forgotpassword/index');

	}



	function sendmail($email,$new_password)
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

		
		$this->load->library('email', $config);
		//	$this->email->initialize($config);
		$this->email->set_newline("\r\n");
	    	$this->email->from('anhptse03395@gmail.com'); // change it to yours
	    	$this->email->to($email);// change it to yours
	    	$this->email->subject('Day password cua ban');
	    	$this->email->message('password moi cua ban la :'.$new_password);
	    	if($this->email->send())
	    	{
	    		echo 'Email sent.';
	    	}
	    	else
	    	{
	    		show_error($this->email->print_debugger());
	    	}

	    }






	}
