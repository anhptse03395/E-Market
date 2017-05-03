<?php 
Class Feedback_model extends MY_Model{

	var $table ='feedback';

	function feedback($input = array())
	{

		$this->get_list_set_input_asc($input);
		//nếu có join tới bảng khác
		if(isset($input['join']))
		{
			$this->db->from($this->table);
			foreach ($input['join'] as $table)
			{
				$this->db->join($table, "$this->table.account_id = $table.id",'join');
	          //$this->db->join($table, "$this->table.market_id = $table.id",'join');
			}
			$query = $this->db->get();
		}else{
			$query = $this->db->get($this->table);
		}
	//tra ve du lieu
		return $query->result(); 

	}

	function feedback_info($feedback_id)
	{

		$this->db->select('accounts.id as account_id,feedback.id as feedback_id,description,reason,created,phone');
		$this->db->from('feedback');
		$this->db->join('accounts', 'accounts.id = feedback.account_id');
		$this->db->where('feedback.id',$feedback_id);
		$query = $this->db->get();
		return $query->row();
	}
		function search_feedback($input=array())
	{
		$this->get_list_set_input_asc($input);
		$this->db->select('accounts.id as account_id,feedback.id as feedback_id,description,reason,created,phone');
		$this->db->from('feedback');
		$this->db->join('accounts', 'accounts.id = feedback.account_id');
		$query = $this->db->get();
		return $query->result();
	}

}	
 ?>
