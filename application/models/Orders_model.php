<!-- 
$this->db->select('shop_name,orders.date_order as date_order,orders.description as description,order_details.quantity as quantity,
			order_details.status as status,products.product_name as product_name
			');
		$this->db->from('orders');

		$this->db->join('order_details', 'order_details.order_id=orders.id','left');
		$this->db->join('products', 'products.id=order_details.product_id','left');

		$this->db->join('shops', 'order_details.shop_id=shops.id','left');
		$this->db->join('accounts', 'accounts.id=shops.account_id','left');
 -->


<?php 


Class Orders_model extends MY_Model{

	var $table ='orders';


	function join_count_total ($buyer_id){


		$this->db->select('sum(price) as total_price,orders.id,orders.date_order as date_order,orders.description as description,count(order_id) as total');
		$this->db->from('orders');
		$this->db->join('order_details', 'order_details.order_id=orders.id','left');
		$this->db->where('orders.buyer_id', $buyer_id);
		$this->db->group_by('orders.id');
		$query = $this->db->get();
		return $query->result();
	}

	function join_buyer_order ($buyer_id,$limit,$offset){


		$this->db->select('sum(price) as total_price,orders.id as order_id,orders.date_order as date_order,orders.description as description,count(order_id) as total,address_receiver,name_receiver,date_receive');
		$this->db->from('orders');
		$this->db->join('order_details', 'order_details.order_id=orders.id','left');
		$this->db->where('orders.buyer_id', $buyer_id);
		$this->db->group_by('orders.id');
		$this->db->order_by('orders.id', 'desc');
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query->result();
	}
/*	function join_buyer_search ($buyer_id,$status){


		$this->db->select('shop_name,orders.date_order as date_order,orders.description as description,order_details.quantity as quantity,
			order_details.status as status,products.product_name as product_name
			');
		$this->db->from('orders');

		$this->db->join('order_details', 'order_details.order_id=orders.id','left');
		$this->db->join('products', 'products.id=order_details.product_id','left');

		$this->db->join('shops', 'order_details.shop_id=shops.id','left');
		$this->db->join('accounts', 'accounts.id=shops.account_id','left');
		$where =array();
		if(!empty($status)){

			$where = array(
				'orders.buyer_id' =>$buyer_id,
				'order_details.status' =>$status

				);
		}if(!empty($from_date)&&!empty($end_date)){

			$where = array(
				'orders.buyer_id' =>$buyer_id,
				'date_order <=', $end_date,
				'date_order <=', $from_date
				);
			}

			$this->db->where($where);
			$query = $this->db->get();
			return $query->result();
		}*/

	/*	function search_buyer_order ($buyer_id,$status,$limit,$offset){


			$this->db->select('shop_name,orders.date_order as date_order,orders.description as description,order_details.quantity as quantity,
				order_details.status as status,products.product_name as product_name
				');
			$this->db->from('orders');

			$this->db->join('order_details', 'order_details.order_id=orders.id','left');
			$this->db->join('products', 'products.id=order_details.product_id','left');

			$this->db->join('shops', 'order_details.shop_id=shops.id','left');
			$this->db->join('accounts', 'accounts.id=shops.account_id','left');


			$where =array();
			if(!empty($status)){

				$where = array(
					'orders.buyer_id' =>$buyer_id,
					'order_details.status' =>$status

					);
		}if(!empty($from_date)&&!empty($end_date)){

			$where = array(
				'orders.buyer_id' =>$buyer_id,
				'date_order <=', $end_date,
				'date_order <=', $from_date
				);
			}

			$this->db->where($where);
			$this->db->limit($limit, $offset);
			$query = $this->db->get();
			return $query->result();
		}*/


		function join_muti($input = array(),$buyer_id)
		{

			$this->get_list_set_input($input);
			$this->db->select('sum(price) as total_price,orders.id as order_id,orders.date_order as date_order,orders.description as description,address_receiver,name_receiver,date_receive');
			$this->db->from('orders');
			$this->db->join('order_details', 'order_details.order_id=orders.id','left');
			$this->db->where('orders.buyer_id', $buyer_id);
			$this->db->group_by('orders.id');
			$query = $this->db->get();
			return $query->result();



		}


	}


	?>
