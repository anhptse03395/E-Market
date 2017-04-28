  <?php 
  Class Account_model extends MY_Model{

   var $table ='accounts';


   function join_permission ($phone){


    $this->db->select('permissions,role_name,roles.id as role_id,accounts.id as account_id,shops.id as shop_id,buyers.id as buyer_id,active,expiration_date');
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


  $this->db->select('accounts.id as account_id,buyers.id as buyer_id,buyer_name,phone,address, phone as buyer_phone,name_receiver,phone_receiver,address_receiver');
  $this->db->from('accounts');

  $this->db->join('buyers', 'buyers.account_id=accounts.id','left');
  $this->db->where('accounts.id', $id);

  $query = $this->db->get();
  return $query->row();

}
function join_shopsname($id){
  $this->db->select('role_id,accounts.id as account_id,shops.id as shop_id,shops.shop_name as shop_name ,accounts.email as email,shops.phone as phone,shops.address as address ');
  $this->db->from('accounts');
  $this->db->join('shops ', 'shops.account_id=accounts.id','left');
  $this->db->where('accounts.id', $id);
  $query = $this->db->get();
  return $query->row();
}

function join_buyername($id){
  $this->db->select('role_id,accounts.id as account_id,buyers.id as id,buyers.buyer_name as buyer_name ,accounts.email as email,buyers.phone as phone,buyers.address as address ');
  $this->db->from('accounts');
  $this->db->join('buyers ', 'buyers.account_id=accounts.id','left');
  $this->db->where('accounts.id', $id);
  $query = $this->db->get();
  return $query->row();
}




function join_shop_order ($id){


  $this->db->select('accounts.id as account_id,shops.id as shop_id,orders.date_order as date_order,orders.description as description,order_details.quantity as quantity,
   order_details.status as status,products.product_name as product_name,orders.id as id
   ');
  $this->db->from('accounts');

  $this->db->join('shops', 'shops.account_id=accounts.id','left');
  $this->db->join('order_details', 'order_details.shop_id=shops.id','left');
  $this->db->join('order_details', 'order_details.order_id=orders.id','left');
  $this->db->join('products', 'products.id=order_details.product_id','left');

  $this->db->where('accounts.id', $id);

  $query = $this->db->get();
  return $query->row();

}


function join_buyer_feedback($id)
{
  $this->db->select('accounts.id as account_id,buyers.id as buyer_id,buyer_name,buyers.address as address, accounts.phone as phone,feedback.reason as reason,feedback.description as description');
  $this->db->from('accounts');

  $this->db->join('buyers', 'buyers.account_id=accounts.id', 'left');
  $this->db->join('feedback', 'feedback.account_id=accounts.id', 'left');

  $this->db->where('accounts.id', $id);

  $query = $this->db->get();
  return $query->row();
}

      function join_shop_feedback($id)
      {
          $this->db->select('accounts.id as account_id,shops.id as shop_id,shop_name,shops.address as address,accounts.phone as phone,feedback.reason as reason,feedback.description as description');
          $this->db->from('accounts');

          $this->db->join('shops', 'shops.account_id=accounts.id', 'left');
          $this->db->join('feedback', 'feedback.account_id=accounts.id', 'left');

          $this->db->where('accounts.id', $id);

          $query = $this->db->get();
          return $query->row();
      }


      /*hàm của đức*/
      function  join_role(){

        $this->db->select('accounts.id as account_id, role_name,accounts.phone as phone,address,name');
        $this->db->from('accounts');
        $this->db->join('roles', 'accounts.role_id = roles.id');
        $this->db->join('admin', 'accounts.id = admin.account_id');
        $this->db->where('roles.id <> 2 and roles.id <> 3');

        $query = $this->db->get();
        return $query->result();
      } 

}	
?>
