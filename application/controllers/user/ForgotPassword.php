<?php
Class ForgotPassword extends MY_controller{


	function __construct()
	{


		parent::__construct();
		$this->load->model('account_model');
		
	}


	/*function check_email()
	{
		$email = $this->input->post('forgot_email');
		$where = array('email' => $email);
        //kiêm tra xem username đã tồn tại chưa
		if($this->account_model->check_exists($where))
		{
            //trả về thông báo lỗi
			return true;
		}else{
			$this->form_validation->set_message(__FUNCTION__, 'Tài khoản Không tồn tại');
			return false;
		}


	}*/

	function check_phone()
	{
		$phone = $this->input->post('r_phone');
		$where = array('phone' => $phone);
        //kiêm tra xem username đã tồn tại chưa
		if($this->account_model->check_exists($where))
		{
            //trả về thông báo lỗi
			
			return true;
		}
		$this->form_validation->set_message(__FUNCTION__, 'Số điện thoại chưa được đăng ký');
		return false;
	}



	function index(){


		$this->load->library('form_validation');
		$this->load->helper('form');

		if($this->input->post())
		{

			$this->form_validation->set_rules('forgot_phone', 'Số điện thoại', 'required|callback_check_phone');
            //nhập liệu chính xác
			if($this->form_validation->run())
			{
                //them vao csdl

				$phone  = $this->input->post('forgot_phone');

				$data = array(
					'phone' => $phone
					);


				$object = new StdClass;
				$object=$this->account_model->get_info_rule($data) ;
				$arraylist	= (array) $object ;
				$id=	$arraylist['id'];

				$new_password=  rand(100000,999999);
				$this->send_sms($phone,$new_password);
				$new_input['password'] = md5($new_password);            
				$this->account_model->update($id,$new_input);
				$this->session->set_flashdata('message', 'Chúng tôi đã gửi password vào số điện thoại của bạn!');

				redirect(user_url('forgotpassword'));
			}



		}


		$this->load->view('site/forgotpassword/index');

	}


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



/*	function sendmail($email,$new_password)
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

	    }*/






	}
