<?php 
Class Province_model extends MY_Model{

	var $table ='provinces';

	function join_country($country_id){

	$this->db->select('province.id as province_id, country_id, province_name ');
    $this->db->from('province');
    $this->db->join('country', 'country.id = province.country_id');
    $this->db->where('province.country_id',$country_id);

      $query = $this->db->get();
      return $query->result();
	}

}	
 ?>
