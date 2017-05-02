<?php 
Class Shop_model extends MY_Model{

	var $table ='shops';

	function  join_role(){

		$this->db->select('accounts.id as account_id, role_name,shop_name,phone,address,market_name,active,created,role_id');
		$this->db->from('shops');
		$this->db->join('accounts', 'accounts.id = shops.account_id','left');
		$this->db->join('roles', 'accounts.role_id = roles.id','left');
		$this->db->join('market_places','shops.market_id = market_places.id','left');
		$this->db->where('roles.id = 3 or role_id = 4'); 
		$this->db->order_by('account_id','asc');
		$query = $this->db->get();
		return $query->result();
	}
	function  paging_shop($limit,$offset){

		$this->db->select('accounts.id as account_id, shops.id as shop_id,role_name,shop_name,phone,address,market_name,active,created,expiration_date,role_id');
		$this->db->from('shops');
		$this->db->join('accounts', 'accounts.id = shops.account_id','left');
		$this->db->join('fees', 'shops.id = fees.shop_id','left');
		$this->db->join('roles', 'accounts.role_id = roles.id','left');
		$this->db->join('market_places','shops.market_id = market_places.id','left');
		$this->db->where('roles.id = 3 or role_id = 4'); 
		$this->db->order_by('account_id',"asc");
		$this->db->limit($limit,$offset);

		$query = $this->db->get();
		return $query->result();
	}

	function search_listshop($input= array(),$shop_id){
		$this->get_list_set_input($input);
		$this->db->select('id,product_name,created ,image_link,image_list,description');
		$this->db->from('products');
		$this->db->where('products.shop_id',$shop_id);
		$query = $this->db->get();
		return $query->result();


	}
	function join_edit_seller($account_id)
	{

		$this->db->select('accounts.id as account_id,shop_name,phone,address,shops.id as shop_id,market_id,role_id');
		$this->db->from('shops');
		$this->db->join('accounts', 'accounts.id = shops.account_id');
		$this->db->where('account_id',$account_id);
		$query = $this->db->get();
		return $query->row();
	}

	function join_delete_seller($account_id)
	{

		$this->db->select('accounts.id,shop_name,phone,address,shops.id as seller_id,role_id,password,created');
		$this->db->from('shops');
		$this->db->join('accounts', 'accounts.id = shops.account_id');
		$this->db->where('account_id',$account_id);
		$query = $this->db->get();
		return $query->row();
	}

	function join_shop($input = array())
	{

		$this->get_list_set_input_asc($input);
	//nếu có join tới bảng khác
		if(isset($input['join']))
		{
			$this->db->from($this->table);
			foreach ($input['join'] as $table)
			{
				$this->db->join($table, "$this->table.account_id = $table.id",'join');
          //$this->db->join($table, "$this->table.market_id = $table.id",'join');
			}
			$query = $this->db->get();
		}else{
			$query = $this->db->get($this->table);
		}
//tra ve du lieu
		return $query->result(); 

	}

	function  join_page($account_id){

		$this->db->select('accounts.id as account_id, role_name,shop_name,phone,address,market_name,active,market_id,shops.id as shop_id');
		$this->db->from('shops');
		$this->db->join('accounts', 'accounts.id = shops.account_id');
		$this->db->join('roles', 'accounts.role_id = roles.id');
		$this->db->join('market_places','shops.market_id = market_places.id');
		$this->db->where('roles.id = 3 and account_id',$account_id);
		$this->db->order_by('account_id',"asc");

		$query = $this->db->get();
		return $query->result();
	}

	function join_shops_admin($input = array())
	{
			$role_id =array(3,4);
		$this->get_list_set_input_asc($input);
		//nếu có join tới bảng khác
		$this->db->select('accounts.id as account_id, role_name,shop_name,phone,address,market_name,active,created,shops.id as shop_id,expiration_date,role_id');
		$this->db->from('shops');
		$this->db->join('accounts', 'accounts.id = shops.account_id');
		$this->db->join('fees', 'shops.id = fees.shop_id','left');
		$this->db->join('roles', 'accounts.role_id = roles.id','left');
		$this->db->join('market_places','shops.market_id = market_places.id','left');
		$this->db->where_in('role_id',$role_id); 
		$this->db->order_by('account_id','asc');
		$query = $this->db->get();
	//tra ve du lieu
		return $query->result(); 

	}

	function  join_fee(){
		
		$date_now = now();
		$this->db->select('accounts.id as account_id, role_name,shop_name,phone,address,market_name,active,created,expiration_date,(expiration_date - '.$date_now.')/86400 as remain_date');
		$this->db->from('shops');
		$this->db->join('accounts', 'accounts.id = shops.account_id','left');
		$this->db->join('fees', 'shops.id = fees.shop_id','left');
		$this->db->join('roles', 'accounts.role_id = roles.id','left');
		$this->db->join('market_places','shops.market_id = market_places.id','left');
		$this->db->where('roles.id = 3');
		$this->db->where('(expiration_date - '.$date_now.')/86400 <=10');  
		$this->db->order_by('account_id','asc');
		$query = $this->db->get();
		return $query->result();
	}
	function  join_fee_paging($limit,$offset){
		
		$date_now = now();
		$this->db->select('accounts.id as account_id, role_name,shop_name,phone,address,market_name,active,created,expiration_date,(expiration_date - '.$date_now.')/86400 as remain_date,shops.id as shop_id');
		$this->db->from('shops');
		$this->db->join('accounts', 'accounts.id = shops.account_id','left');
		$this->db->join('fees', 'shops.id = fees.shop_id','left');
		$this->db->join('roles', 'accounts.role_id = roles.id','left');
		$this->db->join('market_places','shops.market_id = market_places.id','left');
		$this->db->where('roles.id = 3');
		$this->db->where('(expiration_date - '.$date_now.')/86400 <=10');
		$this->db->order_by('remain_date','asc');
		$this->db->limit($limit,$offset);  
		$query = $this->db->get();
		return $query->result();
	}

		function join_shops_admin_fee($input = array())
	{
		$date_now = now();

		$this->get_list_set_input_asc($input);
		$this->db->select('accounts.id as account_id, role_name,shop_name,phone,address,market_name,active,created,expiration_date,(expiration_date - '.$date_now.')/86400 as remain_date,shops.id as shop_id');
		$this->db->from('shops');
		$this->db->join('accounts', 'accounts.id = shops.account_id');
		$this->db->join('fees', 'shops.id = fees.shop_id','left');
		$this->db->join('roles', 'accounts.role_id = roles.id','left');
		$this->db->join('market_places','shops.market_id = market_places.id','left');
		$this->db->where('roles.id = 3');
		$this->db->where('(expiration_date - '.$date_now.')/86400 <=10'); 
		$this->db->order_by('account_id','asc');
		$query = $this->db->get();
		return $query->result(); 

	}

	function add_fee_admin($shop_id)
	{
		$date_now = now();
		$this->db->select('accounts.id as account_id, shop_name,phone,active,created,expiration_date,(expiration_date - '.$date_now.')/86400 as remain_date,shops.id as shop_id');
		$this->db->from('shops');
		$this->db->join('accounts', 'accounts.id = shops.account_id');
		$this->db->join('fees', 'shops.id = fees.shop_id','left');
		$this->db->where('shops.id',$shop_id);
		$query = $this->db->get();
		return $query->row();
	}

	







}	



?>
