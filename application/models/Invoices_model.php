<?php 




/*$sql = "select * from products where shop_id=$id limit ".$config['per_page']." offset ".(($page-1)*$config['per_page']);*/


Class Invoices_model extends MY_Model{

	var $table ='invoices';


	function count_debt_shop($shop_id){

		$query =	$this->db->query('SELECT t1.order_id, t1.status, t1.buyer_name,t1.shop_id, t1.total_price, t2.total_paid, t1.total_price - t2.total_paid AS debt
			FROM (SELECT o.id as order_id,o.shop_id,o.status ,COUNT(od.order_id) AS OrderDetail,b.buyer_name ,SUM(od.price * od.quantity) AS total_price
			FROM orders o
			JOIN order_details od ON o.id = od.order_id 
			LEFT JOIN buyers b on o.buyer_id =b.id
			GROUP BY o.id
			) AS t1
			LEFT JOIN 
			(SELECT iv.order_id AS Id2, 
			SUM(iv.amount) AS total_paid FROM invoices iv 
			JOIN orders o2 ON o2.id = iv.order_id 
			GROUP BY O2.id) AS t2 

			ON t1.order_id = t2.Id2
			where t1.status in (4,5)	 
			and t1.shop_id ='.$shop_id.'
			');


		return $query->result();

	}


	function list_debt_shop($shop_id,$limit=0,$offset=0){


		$query =	$this->db->query('SELECT * from (SELECT t1.status, t1.order_id, t1.buyer_name,t1.shop_id, t1.total_price, t2.total_paid, t1.total_price - t2.total_paid AS debt
			FROM (SELECT o.id as order_id, o.status,o.shop_id ,COUNT(od.order_id) AS OrderDetail,b.buyer_name ,SUM(od.price * od.quantity) AS total_price
			FROM orders o
			JOIN order_details od ON o.id = od.order_id 
			JOIN buyers b on o.buyer_id =b.id
			GROUP BY o.id

			) AS t1
			LEFT JOIN 
			(SELECT iv.order_id AS Id2, 
			SUM(iv.amount) AS total_paid FROM invoices iv 
			JOIN orders o2 ON o2.id = iv.order_id 
			GROUP BY O2.id) AS t2 
			ON t1.order_id = t2.Id2

			WHERE  t1.status in (4,5)
			and t1.shop_id ='.$shop_id.
			
			') as T3
			order by T3.status
			limit '.$offset.','.$limit.'
		
			');



		return $query->result();

	}

	function count_search_debt_shop($shop_id,$order_id,$buyer_name,$status){

		$sql ="SELECT * from (SELECT t1.status, t1.order_id, t1.buyer_name,t1.shop_id, t1.total_price, t2.total_paid, t1.total_price - t2.total_paid AS debt
		FROM (SELECT o.id as order_id, o.status,o.shop_id ,COUNT(od.order_id) AS OrderDetail,b.buyer_name ,SUM(od.price * od.quantity) AS total_price
		FROM orders o
		JOIN order_details od ON o.id = od.order_id 
		JOIN buyers b on o.buyer_id =b.id
		GROUP BY o.id

		) AS t1
		LEFT JOIN 
		(SELECT iv.order_id AS Id2, 
		SUM(iv.amount) AS total_paid FROM invoices iv 
		JOIN orders o2 ON o2.id = iv.order_id 
		GROUP BY O2.id) AS t2 
		ON t1.order_id = t2.Id2

		where  t1.status in (4,5,6)
		and t1.shop_id =".$shop_id."
		) as T3 ";

		if(isset($order_id)&&$order_id && empty($buyer_name)&&empty($status)){
			$string = $sql."where T3.order_id = ".$order_id."";
		}
		if(isset($status)&&$status && empty($buyer_name)&&empty($order_id)){
			$string = $sql."where T3.status = ".$status."";
		}

		if(isset($buyer_name)&&$buyer_name &&empty($order_id)&&empty($status)){
			$string = $sql."WHERE T3.buyer_name like '%".$buyer_name."%' " ;
		}

		if(isset($order_id)&&$order_id &&isset($buyer_name)&&$buyer_name ){

			$string = $sql."where T3.order_id = ".$order_id." and T3.buyer_name like '%".$buyer_name."%' ";
			
		}
		if(isset($order_id)&&$order_id &&isset($status)&&$status ){

			$string = $sql."where T3.order_id = ".$order_id." and T3.status =".$status."  ";
			
		}
		if(isset($status)&&$status &&isset($buyer_name)&&$buyer_name ){

			$string = $sql."where T3.status = ".$status." and T3.buyer_name like '%".$buyer_name."%' ";
			
		}

		if(isset($order_id)&&$order_id &&isset($buyer_name)&&$buyer_name&&isset($status)&&$status ){

			$string = $sql."where T3.order_id = ".$order_id." and T3.buyer_name like '%".$buyer_name."%' and T3.status =".$status." ";
			
		}

		if(empty($order_id) && empty($buyer_name)&&empty($status)){
			$string = $sql;
		}

		$query = $this->db->query($string);

		return $query->result();
	}

	function search_debt_shop($shop_id,$order_id,$buyer_name,$status,$limit=0,$offset=0){

		$sql ="SELECT * from (SELECT t1.status, t1.order_id, t1.buyer_name,t1.shop_id, t1.total_price, t2.total_paid, t1.total_price - t2.total_paid AS debt
		FROM (SELECT o.id as order_id, o.status,o.shop_id ,COUNT(od.order_id) AS OrderDetail,b.buyer_name ,SUM(od.price * od.quantity) AS total_price
		FROM orders o
		JOIN order_details od ON o.id = od.order_id 
		JOIN buyers b on o.buyer_id =b.id
		GROUP BY o.id

		) AS t1
		LEFT JOIN 
		(SELECT iv.order_id AS Id2, 
		SUM(iv.amount) AS total_paid FROM invoices iv 
		JOIN orders o2 ON o2.id = iv.order_id 
		GROUP BY O2.id) AS t2 
		ON t1.order_id = t2.Id2

		where  t1.status in (4,5,6)
		and t1.shop_id =".$shop_id."
		) as T3 ";

		if(isset($order_id)&&$order_id && empty($buyer_name)&&empty($status)){
			$string = $sql."where T3.order_id = ".$order_id."";
		}
		if(isset($status)&&$status && empty($buyer_name)&&empty($order_id)){
			$string = $sql."where T3.status = ".$status."";
		}

		if(isset($buyer_name)&&$buyer_name &&empty($order_id)&&empty($status)){
			$string = $sql."WHERE T3.buyer_name like '%".$buyer_name."%' " ;
		}

		if(isset($order_id)&&$order_id &&isset($buyer_name)&&$buyer_name ){

			$string = $sql."where T3.order_id = ".$order_id." and T3.buyer_name like '%".$buyer_name."%' ";
			
		}
		if(isset($order_id)&&$order_id &&isset($status)&&$status ){

			$string = $sql."where T3.order_id = ".$order_id." and T3.status like '%".$status."%' ";
			
		}
		if(isset($status)&&$status &&isset($buyer_name)&&$buyer_name ){

			$string = $sql."where T3.status = ".$status." and T3.buyer_name like '%".$buyer_name."%' ";
			
		}


		if(isset($order_id)&&$order_id &&isset($buyer_name)&&$buyer_name&&isset($status)&&$status ){

			$string = $sql."where T3.order_id = ".$order_id." and T3.buyer_name like '%".$buyer_name."%' and T3.status =".$status." ";
			
		}

		if(empty($order_id) && empty($buyer_name)&&empty($status)){
			$string = $sql;
		}


		$search = $string." limit ".$offset.",".$limit." "	;
		$query= $this->db->query($search);

		return $query->result();

	}

	function total_info_shop($shop_id){

		$query =	$this->db->query('SELECT sum(IFNull(T3.debt,0)) as sum_debt,sum(IFNull(T3.total_paid,0)) as sum_paid  from (SELECT t1.status, t1.order_id, t1.buyer_name,t1.shop_id, t1.total_price, t2.total_paid, t1.total_price - t2.total_paid AS debt
			FROM (SELECT o.id as order_id, o.status,o.shop_id ,COUNT(od.order_id) AS OrderDetail,b.buyer_name ,SUM(od.price * od.quantity) AS total_price
			FROM orders o
			JOIN order_details od ON o.id = od.order_id 
			JOIN buyers b on o.buyer_id =b.id
			GROUP BY o.id

			) AS t1
			LEFT JOIN 
			(SELECT iv.order_id AS Id2, 
			SUM(iv.amount) AS total_paid FROM invoices iv 
			JOIN orders o2 ON o2.id = iv.order_id 
			GROUP BY O2.id) AS t2 
			ON t1.order_id = t2.Id2

			WHERE  t1.status in (4,5)
			and t1.shop_id ='.$shop_id.
			') as T3	
			');

		return $query->row();

	}
	function total_info_ashop($shop_id,$order_id){

		$query =	$this->db->query('SELECT  t1.order_id, t1.shop_id, t1.total_price, t2.total_paid, t1.total_price - t2.total_paid AS debt
			FROM (SELECT o.id as order_id, o.status,o.shop_id ,COUNT(od.order_id) AS OrderDetail,b.buyer_name ,SUM(od.price * od.quantity) AS total_price
			FROM orders o
			JOIN order_details od ON o.id = od.order_id 
			JOIN buyers b on o.buyer_id =b.id
			GROUP BY o.id

			) AS t1
			LEFT JOIN 
			(SELECT iv.order_id AS Id2, 
			SUM(iv.amount) AS total_paid FROM invoices iv 
			JOIN orders o2 ON o2.id = iv.order_id 
			GROUP BY O2.id) AS t2 
			ON t1.order_id = t2.Id2

			WHERE  t1.shop_id ='.$shop_id.'
			and t1.order_id='.$order_id.'
			');

		return $query->row();

	}



	function add_debt_shop($order_id,$shop_id){

		$query =	$this->db->query('SELECT t1.status, t1.order_id, t1.buyer_name,t1.shop_id, t1.total_price, t2.total_paid, t1.total_price - t2.total_paid AS debt
			FROM (SELECT o.id as order_id, o.status,o.shop_id ,COUNT(od.order_id) AS OrderDetail,b.buyer_name ,SUM(od.price * od.quantity) AS total_price
			FROM orders o
			JOIN order_details od ON o.id = od.order_id 
			JOIN buyers b on o.buyer_id =b.id
			GROUP BY o.id

			) AS t1
			LEFT JOIN 
			(SELECT iv.order_id AS Id2, 
			SUM(iv.amount) AS total_paid FROM invoices iv 
			JOIN orders o2 ON o2.id = iv.order_id 
			GROUP BY O2.id) AS t2 
			ON t1.order_id = t2.Id2
			WHERE t1.shop_id ='.$shop_id.'
			and t1.order_id='.$order_id.'     
			') ;

		return $query->row();
	}

	function detail_debt_shop($order_id){

		$query=	$this->db->query('SELECT  o.id as order_id ,o.status,iv.amount,iv.date_pay,b.buyer_name,a.phone from 
			orders o LEFT JOIN invoices iv on o.id = iv.order_id 
			LEFT join buyers b on o.buyer_id = b.id
			LEFT join accounts a on b.account_id = a.id
			where o.id ='.$order_id.'
			');

		return $query->result();

	}


	function count_debt_buyer($buyer_id){

		$query =	$this->db->query('SELECT t1.order_id,t1.buyer_id ,t1.shop_name,t1.shop_id, t1.total_price, t2.total_paid, t1.total_price - t2.total_paid AS debt  
			FROM (SELECT o.id as order_id,o.buyer_id,o.shop_id ,COUNT(od.order_id) AS OrderDetail,s.shop_name ,SUM(od.price * od.quantity) AS total_price
			FROM orders o
			JOIN order_details od ON o.id = od.order_id 
			LEFT JOIN shops s on o.shop_id =s.id
			GROUP BY o.id
			) AS t1
			JOIN 
			(SELECT iv.order_id AS Id2, 
			SUM(iv.amount) AS total_paid FROM invoices iv 
			JOIN orders o2 ON o2.id = iv.order_id 
			GROUP BY O2.id) AS t2 

			ON t1.order_id = t2.Id2
			where t1.buyer_id=' .$buyer_id.'
			');


		return $query->result();

	}
	function list_debt_buyer($buyer_id,$limit=0,$offset=0){

		$query =	$this->db->query('SELECT * from ((SELECT t1.status,t1.order_id, t1.shop_name,t1.buyer_id, t1.total_price, t2.total_paid, t1.total_price - t2.total_paid AS debt 
			FROM (SELECT o.id as order_id,o.buyer_id ,o.status, COUNT(od.order_id) AS OrderDetail,s.shop_name ,SUM(od.price * od.quantity) AS total_price
			FROM orders o
			JOIN order_details od ON o.id = od.order_id 
			LEFT JOIN shops s on o.shop_id =s.id
			GROUP BY o.id
			) AS t1
			JOIN 
			(SELECT iv.order_id AS Id2, 
			SUM(iv.amount) AS total_paid FROM invoices iv 
			JOIN orders o2 ON o2.id = iv.order_id 
			GROUP BY O2.id) AS t2
			ON t1.order_id = t2.Id2
			WHERE t1.buyer_id ='.$buyer_id. 

			') as T3)

			limit '.$offset.','.$limit.'
			');
		return $query->result();
	}

	function count_search_debt_buyer($buyer_id,$order_id,$shop_name,$status){


		$sql =	"SELECT * from (SELECT t1.status,t1.order_id, t1.shop_name,t1.buyer_id, t1.total_price, t2.total_paid, t1.total_price - t2.total_paid AS debt 
		FROM (SELECT o.id as order_id,o.buyer_id ,o.status, COUNT(od.order_id) AS OrderDetail,s.shop_name ,SUM(od.price * od.quantity) AS total_price
		FROM orders o  
		JOIN order_details od ON o.id = od.order_id 
		LEFT JOIN shops s on o.shop_id =s.id
		GROUP BY o.id
		) AS t1
		JOIN 
		(SELECT iv.order_id AS Id2, 
		SUM(iv.amount) AS total_paid FROM invoices iv 
		JOIN orders o2 ON o2.id = iv.order_id 
		GROUP BY O2.id) AS t2
		ON t1.order_id = t2.Id2
		WHERE t1.buyer_id =".$buyer_id.") as T3
		";

		if(isset($order_id)&&$order_id && empty($shop_name)&&empty($status)){
			$string = $sql."where T3.order_id = ".$order_id."";
		}
		if(isset($status)&&$status && empty($shop_name)&&empty($order_id)){
			$string = $sql."where T3.status = ".$status."";
		}

		if(isset($shop_name)&&$shop_name &&empty($order_id)&&empty($status)){
			$string = $sql."WHERE T3.shop_name like '%".$shop_name."%' " ;
		}

		if(isset($order_id)&&$order_id &&isset($shop_name)&&$shop_name ){

			$string = $sql."where T3.order_id = ".$order_id." and T3.shop_name like '%".$shop_name."%' ";
			
		}
		if(isset($order_id)&&$order_id &&isset($status)&&$status ){

			$string = $sql."where T3.order_id = ".$order_id." and T3.status = ".$status."";
			
		}
		if(isset($status)&&$status &&isset($shop_name)&&$shop_name ){

			$string = $sql."where T3.status = ".$status." and T3.shop_name like '%".$shop_name."%' ";
			
		}

		if(isset($order_id)&&$order_id &&isset($shop_name)&&$shop_name&&isset($status)&&$status ){

			$string = $sql."where T3.order_id = ".$order_id." and T3.shop_name like '%".$shop_name."%' and T3.status =".$status." ";
			
		}

		if(empty($order_id) && empty($shop_name)&&empty($status)){
			$string = $sql;
		}


		$query= $this->db->query($string);


		return $query->result();
	}

	function search_debt_buyer($buyer_id,$order_id,$shop_name,$status,$limit=0,$offset=0){


		$sql =	"SELECT * from (SELECT t1.status,t1.order_id, t1.shop_name,t1.buyer_id, t1.total_price, t2.total_paid, t1.total_price - t2.total_paid AS debt 
		FROM (SELECT o.id as order_id,o.buyer_id ,o.status, COUNT(od.order_id) AS OrderDetail,s.shop_name ,SUM(od.price * od.quantity) AS total_price
		FROM orders o  
		JOIN order_details od ON o.id = od.order_id 
		LEFT JOIN shops s on o.shop_id =s.id
		GROUP BY o.id
		) AS t1
		JOIN 
		(SELECT iv.order_id AS Id2, 
		SUM(iv.amount) AS total_paid FROM invoices iv 
		JOIN orders o2 ON o2.id = iv.order_id 
		GROUP BY O2.id) AS t2
		ON t1.order_id = t2.Id2
		WHERE t1.buyer_id =".$buyer_id.") as T3
		";

		if(isset($order_id)&&$order_id && empty($shop_name)&&empty($status)){
			$string = $sql."where T3.order_id = ".$order_id."";
		}
		if(isset($status)&&$status && empty($shop_name)&&empty($order_id)){
			$string = $sql."where T3.status = ".$status."";
		}

		if(isset($shop_name)&&$shop_name &&empty($order_id)&&empty($status)){
			$string = $sql."WHERE T3.shop_name like '%".$shop_name."%' " ;
		}

		if(isset($order_id)&&$order_id &&isset($shop_name)&&$shop_name ){

			$string = $sql."where T3.order_id = ".$order_id." and T3.shop_name like '%".$shop_name."%' ";
			
		}
		if(isset($order_id)&&$order_id &&isset($status)&&$status ){

			$string = $sql."where T3.order_id = ".$order_id." and T3.status = ".$status."";
			
		}
		if(isset($status)&&$status &&isset($shop_name)&&$shop_name ){

			$string = $sql."where T3.status = ".$status." and T3.shop_name like '%".$shop_name."%' ";
			
		}

		if(isset($order_id)&&$order_id &&isset($shop_name)&&$shop_name&&isset($status)&&$status ){

			$string = $sql."where T3.order_id = ".$order_id." and T3.shop_name like '%".$shop_name."%' and T3.status =".$status." ";
			
		}

		if(empty($order_id) && empty($shop_name)&&empty($status)){
			$string = $sql;
		}


		$search = $string." limit ".$offset.",".$limit." "	;
		$query= $this->db->query($search);


		return $query->result();


	}
	function total_info_buyer($buyer_id){

		
		$query =	$this->db->query('SELECT sum(IFNull(T3.debt,0)) as sum_debt,sum(IFNull(T3.total_paid,0)) as sum_paid from (SELECT t1.status,t1.order_id, t1.shop_name,t1.buyer_id, t1.total_price, t2.total_paid, t1.total_price - t2.total_paid AS debt 
			FROM (SELECT o.id as order_id,o.buyer_id ,o.status, COUNT(od.order_id) AS OrderDetail,s.shop_name ,SUM(od.price * od.quantity) AS total_price
			FROM orders o
			JOIN order_details od ON o.id = od.order_id 
			LEFT JOIN shops s on o.shop_id =s.id
			GROUP BY o.id
			) AS t1
			JOIN 
			(SELECT iv.order_id AS Id2, 
			SUM(iv.amount) AS total_paid FROM invoices iv 
			JOIN orders o2 ON o2.id = iv.order_id 
			GROUP BY O2.id) AS t2
			ON t1.order_id = t2.Id2
			WHERE t1.buyer_id ='.$buyer_id. 

			') as T3 ');
		return $query->row();

	}




	function detail_debt_buyer($order_id){

		$query=	$this->db->query('SELECT * from 
			orders o left JOIN invoices iv on o.id = iv.order_id 
			LEFT join shops s on o.shop_id = s.id
			LEFT join accounts a on s.account_id = a.id
			where o.id ='.$order_id.'
			');

		return $query->result();

	}
	function shop_put_paid($order_id,$paid){

		$data = array(
			'amount' => $paid,
			'date_pay'=>now(),
			'order_id'=>$order_id
			);
		//$this->db->where('order_details.shop_id', $shop_id);
		$this->db->insert('invoices', $data); 
	}


	/*Thông tin công nợ của shop*/

}
?>
