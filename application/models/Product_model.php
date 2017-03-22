<?php
Class Product_model extends MY_Model
{
    var $table = 'product';


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

    function join_detail ($id){


    $this->db->select('product.id as product_id,product_name,shop_name,product.created as product_created, number,image_link,image_list,address,phone,content');
    $this->db->from('product');
    $this->db->join('shop', 'product.shop_id = shop.id');
    $this->db->where('product.id', $id);

      $query = $this->db->get();
      return $query->row();

    }

}