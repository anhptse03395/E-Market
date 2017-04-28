<?php 
class Home extends MY_Controller{
	function index(){
        $this->load->model('shop_model');
        $this->load->model('admin_model');
        $this->load->model('buyer_model');
        $this->load->model('product_model');
        $this->data['total_shop'] = $this->shop_model->get_total();
        $this->data['total_buyer'] = $this->buyer_model->get_total();
        $this->data['total_admin'] = $this->admin_model->get_total();
        $this->data['total_product'] = $this->product_model->get_total();

		$this ->data['temp'] ='admin/home/index';

		$this ->load->view('admin/main', $this ->data);
	}

	 
    function logout()
    {
        if($this->session->userdata('login'))
        {
            $this->session->unset_userdata('login');
        }
        redirect(admin_url('login'));
    }

}
?>
