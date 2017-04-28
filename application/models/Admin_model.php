<?php 
Class Admin_model extends MY_Model{

	var $table ='admin';


	function  join_role(){

		  $this->db->select('accounts.id as account_id, role_name,accounts.phone as phone,address');
		  $this->db->from('accounts');
		  $this->db->join('roles', 'accounts.role_id = roles.id');
		  $this->db->join('admin', 'accounts.id = admin.account_id');
		  $this->db->where('roles.id <> 2 and roles.id <> 3 and roles.id <> 1');

		  $query = $this->db->get();
		  return $query->result();
	} 

	function edit_permissions($account_id){
		$this->db->select('address, accounts.id as account_id,role_name,permissions,roles.id as role_id');
		$this->db->from('admin');
		$this->db->join('accounts','accounts.id = admin.account_id');
		$this->db->join('roles','roles.id = accounts.role_id');
		$this->db->where('accounts.id',$account_id);
		$query = $this->db->get();
		return $query->row();
	}


	function edit_admin($account_id){
		$this->db->select('*');
		$this->db->from('admin');
		$this->db->where('admin.account_id',$account_id);
		$query = $this->db->get();
		return $query->row();
	}

	function join_delete_admin($account_id)
	{

	$this->db->select('accounts.id,phone,address,admin.id as admin_id,role_id,password,created,permissions,role_name');
	$this->db->from('admin');
	$this->db->join('accounts', 'accounts.id = admin.account_id');
	$this->db->join('roles','roles.id = accounts.role_id');
	$this->db->where('account_id',$account_id);
	$query = $this->db->get();
	return $query->row();
	}
}	
 ?>