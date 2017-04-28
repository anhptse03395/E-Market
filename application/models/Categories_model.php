<?php 
Class Categories_model extends MY_Model{

	var $table ='categories';

	function join_category (){
		$this->db->select('id as category_id,category_name,parent_id');
		$this->db->from('categories');
		$query = $this->db->get();
		return $query->result();
		}
}	
 ?>
