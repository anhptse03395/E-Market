<?php 
Class Account_model extends MY_Model{

	var $table ='account';


	   function join_permission ($email){


    $this->db->select('permissions,role_name,role.id as role_id,account.id as account_id,shop_id,buyer_id');
    $this->db->from('account');
    $this->db->join('role', 'account.role_id = role.id');
    $this->db->where('account.email', $email);

      $query = $this->db->get();
      return $query->row();

    }


}	
 ?>
