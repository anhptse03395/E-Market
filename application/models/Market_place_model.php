<?php 
Class Market_place_model extends MY_Model{

	var $table ='market_places';

	function  join_market(){

	$this->db->select('provinces.id as province_id,local_name,market_name,country_id,market_places.id as market_id');
	$this->db->from('provinces');
	$this->db->join('market_places', 'market_places.province_id = provinces.id');

	$query = $this->db->get();
	return $query->result();
}


	function join_market_page($input = array())
    {

      $this->get_list_set_input_asc($input);
	//nếu có join tới bảng khác
      if(isset($input['join']))
      {
        $this->db->from($this->table);
        foreach ($input['join'] as $table)
        {
          $this->db->join($table, "$this->table.province_id = $table.id",'join');
          //$this->db->join($table, "$this->table.market_id = $table.id",'join');
        }
        $query = $this->db->get();
      }else{
        $query = $this->db->get($this->table);
      }
//tra ve du lieu
      return $query->result(); 

    }
}	
 ?>
