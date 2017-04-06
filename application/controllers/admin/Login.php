<?php
Class Login extends MY_controller{

	function index()
	{


		$this->load->library('form_validation');
		$this->load->helper('form');
		if($this->input->post())
		{
			$this->form_validation->set_rules('login' ,'login', 'callback_check_login');
			if($this->form_validation->run())
			{
				$this->session->set_userdata('login', true);


				redirect(admin_url('home'));
			}
		}

		$this->load->view('admin/login/index');
	}

    /*
     * Kiem tra username va password co chinh xac khong
     */
    function check_login()
    {
        $phone = $this->input->post('username');
        
        $password = $this->input->post('password');



        $password = md5($password);


        $this->load->model('account_model');
        $where = array('phone' => $phone , 'password' => $password);
        if($this->account_model->check_exists($where))
        {

        $row = $this->account_model->join_permission($phone);

            if(intval($row->role_id)!=2||intval($row->role_id)!=3){
                $this ->session ->set_userdata('account_role',$row->role_id);
              $this ->session ->set_userdata('admin_id',$row->account_id) ;
              $this ->session ->set_userdata('permissions',json_decode($row->permissions)) ;
          }
          if(intval($row->role_id)==2||intval($row->role_id)==3){
            $this->form_validation->set_message(__FUNCTION__,'Sai tên tài khoản hoặc mật khẩu');
            return false;

        }


        return true;
    }
    $this->form_validation->set_message(__FUNCTION__,'Sai tên tài khoản hoặc mật khẩu');
    return false;
}

}