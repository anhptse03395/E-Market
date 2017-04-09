<?php
Class Cart extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('cart');
        
        
    }
    
    /*
     * Phuoc thuc them san pham vao gio hang
     */
    function add()
    {
        //lay ra san pham muon them vao gio hang
        $this->load->model('product_model');
        $id = $this->uri->rsegment(3);
        $product = $this->product_model->get_info($id);

        if(!$product)
        {
            redirect();
        }
        //tong so san pham
        $qty = 1;
        $price = 0;

        //thong tin them vao gio hang
        $data = array();
        $data['id'] = $product->id;
        $data['qty'] = $qty;
        $data['name'] = url_title($product->product_name);
        $data['image_link']  = $product->image_link;
        $data['price'] = $price;
        $data['shop_id']= $product->shop_id;
        $this->cart->insert($data);

        //chuyen sang trang danh sach san pham trong gio hang
        redirect(user_url('cart'));
    }
    
    /*
     * Hien thị ra danh sách sản phẩm trong gio hàng
     */
    function index()
    {
        //thong gio hang

        $carts = $this->cart->contents();
      
      
      
        //tong so san pham co trong gio hang
        $total_items = $this->cart->total_items();
        
        $this->data['carts'] = $carts;

        $this->data['total_items']  =$total_items;
        

        $this->load->view('site/cart/index', $this->data);
    }
    
    /*
     * Cập nhật giỏ hàng
     */
    function update()
    {
        //thong gio hang
        $carts = $this->cart->contents();
        
        foreach ($carts as $key => $row)
        {
            //tong so luong san pham
            $total_qty = $this->input->post('qty_'.$row['id']);
       /*     $price =  $this->input->post('price_'.$row['id']);*/
             $price = 0;
            $data = array();
            $data['rowid'] = $key;
            $data['qty'] = $total_qty;
            $data['price'] = $price;
            $this->cart->update($data);
        }
        
        //chuyen sang trang danh sach san pham trong gio hang
        redirect(user_url('cart'));
    }
    
    /*
     * Xoa sản phẩm trong gio hang
     */
    function del()
    {
        $id = $this->uri->rsegment(3);
        $id = intval($id);
        //trường hợp xóa 1 sản phẩm nào đó trong giỏ hàng
        if($id > 0)
        {
            //thong gio hang
            $carts = $this->cart->contents();
            foreach ($carts as $key => $row)
            {
                if($row['id'] == $id)
                {
                    //tong so luong san pham
                    $data = array();
                    $data['rowid'] = $key;
                    $data['qty'] = 0;
                    $this->cart->update($data);
                }
            }
        }else{
            //xóa toàn bô giỏ hang
            $this->cart->destroy();
        }
        
        //chuyen sang trang danh sach san pham trong gio hang
        redirect(user_url('cart'));
    }
}


