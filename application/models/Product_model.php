<?php
Class Product_model extends MY_Model
{
  var $table = 'products';


  function join_shop($input = array())
  {

    $this->get_list_set_input($input);
//nếu có join tới bảng khác
    if(isset($input['join']))
    {
      $this->db->from($this->table);
      foreach ($input['join'] as $table)
      {
        $this->db->join($table, "$this->table.shop_id = $table.id",'join');
      }
      $query = $this->db->get();
    }else{
      $query = $this->db->get($this->table);
    }
//tra ve du lieu
    return $query->result(); 

  }
  function join_shop_imp($input = array())
  {

    $this->get_list_set_input_impression($input);
//nếu có join tới bảng khác
    if(isset($input['join']))
    {
      $this->db->from($this->table);
      foreach ($input['join'] as $table)
      {
        $this->db->join($table, "$this->table.shop_id = $table.id",'join');
      }
      $query = $this->db->get();
    }else{
      $query = $this->db->get($this->table);
    }
//tra ve du lieu
    return $query->result(); 

  }
  


  function search_listpost($input= array(),$shop_id){
    $this->get_list_set_input($input);
    $this->db->select('id,product_name,created ,quantity,image_link,image_list,description');
    $this->db->from('products');
    $this->db->where('products.shop_id',$shop_id);
    $query = $this->db->get();
    return $query->result();


  }


  function join_detail ($id){


    $this->db->select('products.id as product_id,product_name,shop_name,products.created as product_created, quantity,image_link,image_list,address,phone,description,shops.id as shop_id,category_id,market_id');
    $this->db->from('products');
    $this->db->join('shops', 'products.shop_id = shops.id','left');
    $this->db->join('accounts', 'accounts.id = shops.account_id','left');
    $this->db->where('products.id', $id);

    $query = $this->db->get();
    return $query->row();

  }

  function list_product_shop($id,$page){

    $query = $this->db->get('products', $id, $page);
    return $query->result();

  }


  function category_list($category_id,$limit,$offset){

    $this->db->select('products.id as product_id,product_name,shop_name,products.created as product_created, quantity,image_link,image_list,image_shop,shops.id as shop_id,shops.created as shop_created');
    $this->db->from('products');
    $this->db->join('shops', 'products.shop_id = shops.id','left');

    $this->db->where('products.category_id', $category_id);
    $this->db->limit($limit, $offset);
    $query = $this->db->get();
    return $query->result();
  }

}