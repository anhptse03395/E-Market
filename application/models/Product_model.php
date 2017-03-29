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
  



    function join_detail ($id){


    $this->db->select('products.id as product_id,product_name,shop_name,products.created as product_created, quantity,image_link,image_list,address,phone,description');
    $this->db->from('products');
    $this->db->join('shops', 'products.shop_id = shops.id');
    $this->db->where('products.id', $id);

      $query = $this->db->get();
      return $query->row();

    }

}