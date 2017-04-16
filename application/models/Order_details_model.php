<?php 
Class Order_details_model extends MY_Model{

	var $table ='order_details';



	function list_order_detail($order_id){

		$this->db->select('price,shops.id as shop_id,shop_name,orders.date_order as date_order,orders.description as description,order_details.quantity as quantity,
			orders.status as status,products.product_name as product_name
			');
		$this->db->from('order_details');
		$this->db->join('orders','order_details.order_id=orders.id');
		$this->db->join('products', 'products.id=order_details.product_id','left');
		$this->db->join('shops', 'order_details.shop_id=shops.id','left');
		$this->db->join('accounts', 'accounts.id=shops.account_id','left');
		$this->db->where('order_details.order_id', $order_id);
		$query = $this->db->get();
		return $query->result();
	}
	function join_list_order_detail ($buyer_id,$limit,$offset){


		$this->db->select('sum(price) as total_price,orders.id as order_id,orders.date_order as date_order,orders.description as description,count(order_id) as total');
		$this->db->from('orders');
		$this->db->join('order_details', 'order_details.order_id=orders.id','left');
		$this->db->where('orders.buyer_id', $buyer_id);
		$this->db->group_by('orders.id');
		$this->db->order_by('price', 'desc');

		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query->result();
	}

	function list_shop_order($shop_id){
		$this->db->select('sum(price) as total_price,orders.id as order_id,orders.date_order as date_order,orders.description as description,buyer_name,phone,count(order_id) as total');
		$this->db->from('order_details');
		$this->db->join('orders','order_details.order_id=orders.id','left');
		$this->db->join('products', 'products.id=order_details.product_id','left');
		$this->db->join('buyers', 'orders.buyer_id=buyers.id','left');
		$this->db->join('accounts', 'accounts.id=buyers.account_id','left');
		$this->db->where('order_details.shop_id', $shop_id);
		$this->db->group_by('orders.id');
		$this->db->order_by('orders.id', 'desc');
		$query = $this->db->get();
		return $query->result();

	}
	function join_list_shop_order($shop_id,$limit,$offset){
		$this->db->select('sum(price) as total_price,status,price,orders.id as order_id,orders.date_order as date_order,orders.description as description,buyer_name,phone,count(order_id) as total');
		$this->db->from('order_details');
		$this->db->join('orders','order_details.order_id=orders.id');
		$this->db->join('products', 'products.id=order_details.product_id','left');
		$this->db->join('buyers', 'orders.buyer_id=buyers.id','left');
		$this->db->join('accounts', 'accounts.id=buyers.account_id','left');
		$this->db->where('order_details.shop_id', $shop_id);
		$this->db->group_by('orders.id');
		$this->db->order_by('orders.id', 'desc');
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query->result();

	}
	function join_search($input = array(),$shop_id)
	{

		$this->get_list_set_input_orderdetail($input);
		$this->db->select('sum(price) as total_price,status,price,orders.id as order_id,orders.date_order as date_order,orders.description as description,product_name,buyer_name,phone');
		$this->db->from('order_details');
		$this->db->join('orders','order_details.order_id=orders.id','left');
		$this->db->join('products', 'products.id=order_details.product_id','left');
		$this->db->join('buyers', 'orders.buyer_id=buyers.id','left');
		$this->db->join('accounts', 'accounts.id=buyers.account_id','left');
		$this->db->where('order_details.shop_id', $shop_id);
		$this->db->group_by('orders.id');
		$this->db->order_by('orders.id', 'desc');

		$query = $this->db->get();
		return $query->result();



	}

	function shop_detail_order($shop_id,$order_id){
		$this->db->select('price ,orders.id as order_id,orders.date_order as date_order,orders.description as description,buyer_name,phone,status,product_name,products.id as product_id,order_details.quantity as quantity,date_receive');
		$this->db->from('order_details');
		$this->db->join('orders','order_details.order_id=orders.id','left');
		$this->db->join('products', 'products.id=order_details.product_id','left');
		$this->db->join('buyers', 'orders.buyer_id=buyers.id','left');
		$this->db->join('accounts', 'accounts.id=buyers.account_id','left');
		$this->db->where('order_details.shop_id', $shop_id);
		$this->db->where('order_details.order_id', $order_id);
		$query = $this->db->get();
		return $query->result();

	}

	function shop_put_price($order_id,$product_id,$price){

		$data = array(
			'price' => $price,
			
			);
		$this->db->where('order_details.order_id', $order_id);
		$this->db->where('order_details.product_id', $product_id);
		$this->db->update('order_details', $data); 
	}




}	
?>
