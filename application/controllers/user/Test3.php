<?php
Class Test3 extends MY_controller{


	


	function __construct()
	{
		parent::__construct();
		$this->load->model('product_model');
		

	}


/*	$object = new StdClass;
	$object=$this->user_model->get_info_rule($data) ;
	$arraylist	= (array) $object ;


	var_dump( (array) $object )
*/
	function index()




	{		

	
		$input['like'] = array();

		$name = $this->input->post('name');
		if($name)
		{
			$input['like'] = array('name','samsung');

		}
		$list=$this->product_model->get_list($input);
		echo $this->db->last_query();

		pre($list);
		
 

	}
}