<?php
Class Order extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('cart');
    }
    

    /*
     * Lấy thông tin của khách hàng
     */
/*
    function unique_multidim_array($array, $key) { 
        $temp_array = array(); 
        $i = 0; 
        $key_array = array(); 

        foreach($array as $val) { 
            if (!in_array($val[$key], $key_array)) { 
                $key_array[$i] = $val[$key]; 
                $temp_array[$i] = $val; 
            } 
            $i++; 
        } 
        return $temp_array; 
    }*/ 


    function checkout()
    {
        //thong gio hang
     $carts= $this->cart->contents();

/*
 $data = $this->unique_multidim_array($carts,'shop_id');
 pre($data);*/


        //tong so san pham co trong gio hang
 $total_items = $this->cart->total_items();


 if($total_items <= 0)
 {
    redirect();
}
        //tong so tien can thanh toan
$total_amount = 0;
foreach ($carts as $row)
{
    $total_amount = $total_amount + $row['subtotal'];  
}
$this->data['total_amount'] = $total_amount;

        //neu thanh vien da dang nhap thì lay thong tin cua thanh vien
$account = 0;
$buyer = '';
if($this->session->userdata('account_id'))
{
            //lay thong tin cua thanh vien
    $account = $this->session->userdata('account_id');
    $this->load->model('account_model');
    $buyer=$this->account_model->join_buyer($account);

}
$this->data['buyer']  = $buyer;


$this->load->library('form_validation');
$this->load->helper('form');

        //neu ma co du lieu post len thi kiem tra
$buyer_id= $this->session->userdata('buyer_id');
if($this->input->post())
{

    $this->form_validation->set_rules('message', 'Ghi chú', 'required');
          //  $this->form_validation->set_rules('payment', 'Cổng thanh toán', 'required');

            //nhập liệu chính xác
    if($this->form_validation->run())
    {

        // $rows = count($this->cart->contents());
/*
        $duplicate=count($this->unique_multidim_array($carts,'shop_id'));

        if($duplicate<$rows){
            $data = $this->unique_multidim_array($carts,'shop_id');
            foreach ($data as $row) {
               $data_order = array(
                                'status'   => 1, //trang thai dang cho su ly
                                'shop_id'    => $row['shop_id'],
                                'buyer_id'     => $buyer_id,
                                'address'       => $this->input->post('message'), //ghi chú khi mua hàn
                                'date_order'       => now(),
                                );

               $this->load->model('orders_model');
               $this->orders_model->create($data_order);
               $order_id = $this->db->insert_id();  
               $this->load->model('order_details_model');


               foreach ($carts as $row) {
                $data_detail = array(
                'order_id' => $order_id,
                'product_id'     => $row['id'],
                'quantity'            => $row['qty'],
                'price'         => $row['subtotal'],
                );
               $this->order_details_model->create($data_detail);
           }

           }
           $this->cart->destroy();
                    //tạo ra nội dung thông báo
           $this->session->set_flashdata('message', 'Bạn đã đặt hàng thành công, chúng tôi sẽ kiểm tra và gửi hàng cho bạn');

                    //chuyen tới trang danh sách quản trị viên
           redirect(site_url());


       }*/



       $data_order = array(
                         
                        'buyer_id'     => $buyer_id,
                        'description'       => $this->input->post('message'), //ghi chú khi mua hàn
                        'date_order'       => now(),
                        );


       $this->load->model('orders_model');
       $this->orders_model->create($data_order);
       $order_id = $this->db->insert_id();  
       $this->load->model('order_details_model');


       foreach ($carts as $row)
       {
        $data_detail = array(
            'order_id' => $order_id,
            'product_id'     => $row['id'],
            'shop_id'    => $row['shop_id'],
            'quantity'            => $row['qty'],
            'price'         => $row['subtotal'],
            'status'   => 1,
            );
        $this->order_details_model->create($data_detail);
    }
                    //xóa toàn bô giỏ hang
    $this->cart->destroy();
                    //tạo ra nội dung thông báo
    $this->session->set_flashdata('message', 'Bạn đã đặt hàng thành công, chúng tôi sẽ kiểm tra và gửi hàng cho bạn');

                    //chuyen tới trang danh sách quản trị viên
    redirect(site_url());

}


}

        $this->load->view('site/order/index',$this->data);
}

}