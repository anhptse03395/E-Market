<?php 
Class Buyer_model extends MY_Model{

	var $table ='buyers';

	function  join_role(){

		$this->db->select('accounts.id as account_id, role_name,buyer_name,phone,address');
		$this->db->from('buyers');
		$this->db->join('accounts', 'accounts.id = buyers.account_id');
		$this->db->join('roles', 'accounts.role_id = roles.id');
		$this->db->where('roles.id = 2');

		$query = $this->db->get();
		return $query->result();
	}

	function join_edit_buyer($account_id)
	{

		$this->db->select('accounts.id as account_id,buyer_name,phone,address,buyers.id as buyer_id');
		$this->db->from('buyers');
		$this->db->join('accounts', 'accounts.id = buyers.account_id');
		$this->db->where('account_id',$account_id);
		$query = $this->db->get();
		return $query->row();
	}

	function join_delete_buyer($account_id)
	{

		$this->db->select('accounts.id,buyer_name,phone,address,buyers.id as buyer_id,role_id,password,created');
		$this->db->from('buyers');
		$this->db->join('accounts', 'accounts.id = buyers.account_id');
		$this->db->where('account_id',$account_id);
		$query = $this->db->get();
		return $query->row();
	}
	function join_buyer($input = array())
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
	function join_buyer_admin($input = array())
	{

		$this->get_list_set_input_asc($input);
		//nếu có join tới bảng khác
		$this->db->select('accounts.id as account_id,buyer_name,phone,buyers.id as buyer_id,active,address,created');
		$this->db->from('buyers');
		$this->db->join('accounts', 'accounts.id = buyers.account_id');
		$this->db->where('accounts.role_id = 2');
		$query = $this->db->get();
	//tra ve du lieu
		return $query->result(); 

	}
}	
?>
