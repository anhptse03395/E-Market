<?php 
Class Orders_model extends MY_Model{

	var $table ='orders';


	function join_count_total ($buyer_id){


		$this->db->select('shop_name,orders.date_order as date_order,orders.description as description,order_details.quantity as quantity,
			order_details.status as status,products.product_name as product_name
			');
		$this->db->from('orders');

		$this->db->join('order_details', 'order_details.order_id=orders.id','left');
		$this->db->join('products', 'products.id=order_details.product_id','left');

		$this->db->join('shops', 'order_details.shop_id=shops.id','left');
		$this->db->join('accounts', 'accounts.id=shops.account_id','left');



		$this->db->where('orders.buyer_id', $buyer_id);

		$query = $this->db->get();
		return $query->result();
	}

	function join_buyer_order ($buyer_id,$limit,$offset){


		$this->db->select('shop_name,orders.date_order as date_order,orders.description as description,order_details.quantity as quantity,
			order_details.status as status,products.product_name as product_name
			');
		$this->db->from('orders');

		$this->db->join('order_details', 'order_details.order_id=orders.id','left');
		$this->db->join('products', 'products.id=order_details.product_id','left');

		$this->db->join('shops', 'order_details.shop_id=shops.id','left');
		$this->db->join('accounts', 'accounts.id=shops.account_id','left');



		$this->db->where('orders.buyer_id', $buyer_id);

		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query->result();
	}

}


?>
