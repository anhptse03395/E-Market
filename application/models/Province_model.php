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

	/*hàm của đức*/
	function  join_role(){

	$this->db->select('id,local_name,country_id');
	$this->db->from('provinces');

	$query = $this->db->get();
	return $query->result();
}
	function join_country_admin($input = array())
	    {

	      $this->get_list_set_input_asc($input);
		//nếu có join tới bảng khác
	      if(isset($input['join']))
	      {
	        $this->db->from($this->table);
	        foreach ($input['join'] as $table)
	        {
	          $this->db->join($table, "$this->table.country_id = $table.id",'join');
	        }
	        $query = $this->db->get();
	      }else{
	        $query = $this->db->get($this->table);
	      }
	//tra ve du lieu
	      return $query->result(); 

	    }

	    function update_province($province_id){
		$this->db->update('provinces');
		$this->db->set('local_name = ',$local_name);
		$this->db->where('$id', $province_id);

		$query = $this->db->get();
		return $query->result();
		}


}	
 ?>
