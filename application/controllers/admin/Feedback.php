<?php 
Class Feedback extends MY_Controller
{

	function __construct()
    {
        parent::__construct();
        $this->load->model('feedback_model');
    }

	function index()
    {
        // $input = array();

        // $list = $this->feedback_model->get_info();
    
        
        // $this->data['list'] = $list;
        // //pre($list);

        // $total = count($list);
        // $this->data['total'] = $total;
        // //pre($total);
        
        // //lay nội dung của biến message
        // $message = $this->session->flashdata('message');
        // $this->data['message'] = $message;
        
        $this->data['temp'] = 'admin/feedback/index';
        $this->load->view('admin/main', $this->data);
    }

}


 ?>