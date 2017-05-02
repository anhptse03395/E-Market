<?php 
Class Fee_model extends MY_Model{

	var $table ='fees';


	function update_fee($shop_id,$data =array()){

		$this->db->where('fees.shop_id', $shop_id);
		$this->db->update('fees', $data); 
	}
}	
 ?>
