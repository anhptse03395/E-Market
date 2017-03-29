<?php 
Class Account_model extends MY_Model{

	var $table ='accounts';


	   function join_permission ($phone){


    $this->db->select('permissions,role_name,roles.id as role_id,accounts.id as account_id,shops.id as shop_id,buyers.id as buyer_id');
    $this->db->from('accounts');
    $this->db->join('roles', 'accounts.role_id = roles.id','left');

    $this->db->join('shops ', 'shops.account_id=accounts.id','left');

    $this->db->join('buyers', 'buyers.account_id=accounts.id','left');
    $this->db->where('accounts.phone', $phone);

     $query = $this->db->get();
      return $query->row();

    }

    function join_shops($id){
    	    $this->db->select('role_id,accounts.id as account_id,shops.id as shop_id,image_shop,shop_name,phone,address,phone');
    $this->db->from('accounts');
    $this->db->join('shops ', 'shops.account_id=accounts.id','left');
    $this->db->where('accounts.id', $id);
       $query = $this->db->get();
      return $query->row();


    }

     function join_buyer ($id){


    $this->db->select('accounts.id as account_id,buyers.id as buyer_id,buyer_name,phone,address, phone as buyer_phone');
    $this->db->from('accounts');

    $this->db->join('buyers', 'buyers.account_id=accounts.id','left');
    $this->db->where('accounts.id', $id);

     $query = $this->db->get();
      return $query->row();

    }



}	
 ?>
