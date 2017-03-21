<?php
Class Product_model extends MY_Model
{
    var $table = 'product';


    function join1($input = array())
    {

      $this->get_list_set_input($input);
//nếu có join tới bảng khác
      if(isset($input['join']))
      {
        $this->db->from($this->table);
        foreach ($input['join'] as $table)
        {
          $this->db->join($table, "$this->table.user_id = $table.id",'join');
        }
        $query = $this->db->get();
      }else{
        $query = $this->db->get($this->table);
      }
//tra ve du lieu
      return $query->result(); 

    }

}