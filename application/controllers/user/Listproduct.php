<?php
Class Listproduct extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        //load ra file model
        $this->load->model('product_model');
    }
    
    /*
     * Hien thi danh sach san pham
     */

    function removeURL($strTitle)
    {

       $strTitle=trim($strTitle);
       $strTitle= preg_replace("/ {2,}/", " ", $strTitle);
       return $strTitle;
   }



   function index()
   {


    $input = array() ;
    $input['join'] =  array('shops');
    $input['select']= "products.id as product_id,product_name,shop_name,products.created as product_created, image_link,image_list,image_shop,shops.id as shop_id,shops.created as shop_created";


    $total_rows = count($this->product_model->join_shop($input));


        //load ra thu vien phan trang
    $this->load->library('pagination');
    $config = array();
        $config['total_rows'] = $total_rows;//tong tat ca cac san pham tren website
        $config['base_url']   = user_url('listproduct/index'); //link hien thi ra danh sach san pham
        $config['per_page']   = 20;//so luong san pham hien thi tren 1 trang
        $config['uri_segment'] = 4;//phan doan hien thi ra so trang tren url
        $config['next_link']   = 'Trang kế tiếp';
        $config['prev_link']   = 'Trang trước';
        $config['first_link'] = 'Trang đầu';
        $config['last_link'] = 'Trang cuối';
        //khoi tao cac cau hinh phan trang
        $this->pagination->initialize($config);
        
        $segment = $this->uri->segment(4);
        $segment = intval($segment);
        

        $input['limit'] = array($config['per_page'], $segment);

        $info = $this->product_model->join_shop($input);


        $this->data['info'] =$info;


        
        //lay danh sach san pha

        //lay danh sach danh muc san pham
        $this->load->model('categories_model');
        $input = array();
        $input['where'] = array('parent_id' => 0);
        $catalogs = $this->categories_model->get_list($input);
        foreach ($catalogs as $row)
        {
            $input['where'] = array('parent_id' => $row->id);
            $subs = $this->categories_model->get_list($input);
            $row->subs = $subs;
        }
        $this->data['catalogs'] = $catalogs;
        
        //lay nội dung của biến message
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $this->data['temp'] ='site/listproduct/empty';
        $this->load->view('site/listproduct/index',$this->data);

        
    }

    function search()
    {




       $input = array();
       $this->load->library('form_validation');
       $this->load->helper('form');
        //neu co gui form tim kiem
       if ($this->input->post()) {
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('name');
        $this->session->unset_userdata('catalog');
        $input['where'] = array();

        $this->session->set_userdata('id', $this->input->post('id'));
        if ($this->session->userdata('id')) {
            $input['where']['id'] = $this->session->userdata('id');

        }
        $name= $this->input->post('name');

        $this->session->set_userdata('name',$this->removeURL($name));
        if ($this->session->userdata('name')) {
            $input['like'] = array('product_name', $this->session->userdata('name'));
            $product= $this->product_model->get_list($input);

            foreach ($product as $row) {

              $data['impression'] = $row->impression + 1;

              $this->product_model->update($row->id,$data);  

          }

      }
      $this->session->set_userdata('catalog', $this->input->post('catalog'));
      if ($this->session->userdata('catalog')) {
        $input['where']['category_id'] = $this->session->userdata('catalog');
        $product= $this->product_model->get_list($input);
        foreach ($product as $row) {
          $data['impression'] = $row->impression + 1;
          $this->product_model->update($row->id,$data);    
      }

  }
}
        // cu tim theo session da gui trc do
if (($this->session->userdata('id') || $this->session->userdata('name') || $this->session->userdata('catalog'))) {
    $input['where'] = array();
    if ($this->session->userdata('id')) {
        $input['where']['id'] = $this->session->userdata('id');

    }
    $name=$this->session->userdata('name');
    if ($this->session->userdata('name')) {
        $input['like'] = array('product_name', $this->removeURL($name));


    }
    if ($this->session->userdata('catalog')) {
        $input['where']['category_id'] = $this->session->userdata('catalog');
    }
}


////////////////////////////////
$input['join'] =  array('shops');
$input['select']= "products.id as product_id,product_name,shop_name,products.created as product_created, image_link,image_list,image_shop,shops.id as shop_id,shops.created as shop_created";

$total_rows = count($this->product_model->join_shop($input));

$this->data['total_rows'] = $total_rows;
                    // thu vien phan trang
$this->load->library('pagination');
$config = array();
$config['total_rows'] = $total_rows;
        // neu ko search thi de link phan trang nhu binh thuong
        // if(!isset($id) || !isset($name) || !isset($catalog_id) )
        //{
            $config['base_url'] = user_url('listproduct/search'); // link hien thi du lieu
            // }
            $config['per_page'] = 20;
            $config['uri_segment'] = 4;
           // $config['use_page_numbers'] = TRUE;
            $config['next_link']   = 'Trang kế tiếp';
            $config['prev_link']   = 'Trang trước';
            $config['first_link'] = 'Trang đầu';
            $config['last_link'] = 'Trang cuối';
                //khoi tao cac cau hinh phan trang
            $this->pagination->initialize($config);

            $segment = intval($this->uri->segment(4));

            $input['limit'] = array($config['per_page'], $segment);

            $info = $this->product_model->join_shop_imp($input);
            $this->data['info'] =$info;
         
            $this->load->model('categories_model');

            // dat la input_catalog de tranh bi trung voi input cua product
            $input_catalog['where'] = array('parent_id' => 0);
            $catalogs = $this->categories_model->get_list($input_catalog);
            foreach ($catalogs as $row) {
                $input_catalog['where'] = array('parent_id' => $row->id);
                $subs = $this->categories_model->get_list($input_catalog);
                $row->subs = $subs;
            }
            $this->data['catalogs'] = $catalogs;
            $this->data['message'] = $this->session->flashdata('message');
            $this->data['temp'] ='site/listproduct/table';
            $this->load->view('site/listproduct/index',$this->data);
        }






        function product_detail()
        {
        //lay id san pham muon xem
            $id = $this->uri->rsegment(3);

            $this->load->model('categories_model');
            $this->load->model('market_place_model');
            $this->load->model('province_model');

            $product= $this->product_model->join_detail($id);

            $market_id = $product->market_id;

            $market = $this->market_place_model->get_info($market_id);

            $this->data['market'] = $market;
            $province_id = $market->province_id;

            $province = $this->province_model->get_info($province_id);
            $this->data['province'] = $province;

            $this->data['product'] = $product;
            $category = $this->categories_model->get_info($product->category_id);
            $this->data['category'] = $category;

            $image_list = @json_decode($product->image_list);
            $this->data['image_list'] = $image_list;



            $this->load->view('site/product_detail/index',$this->data);

        }

        function product_detail_shop($offset = NULL)
        {



            $shop_id = $this->uri->segment(4);
            $input = array();
            $input['where'] = array('shop_id'=>$shop_id);
     
            $total_rows= $this->product_model->get_total($input);
            $limit =10;

            if(!is_null($offset))
            {
                $offset = $this->uri->segment(5);
            }
            $this->load->library('pagination');
            $config = array();
            $config['total_rows'] = $total_rows;

            $config['base_url'] = user_url('listproduct/product_detail_shop/'.$shop_id); // link hien th
            $config['per_page'] = $limit;
            $config['next_link']   = 'Trang kế tiếp';
            $config['prev_link']   = 'Trang trước';
            $config['first_link'] = 'Trang đầu';
            $config['last_link'] = 'Trang cuối';

            $this->pagination->initialize($config);
            $result = $this->product_model->list_product_shop($shop_id,$limit,$offset);

            $this->data['product'] = $result;

            $this->load->view('site/product_detail/shop',$this->data);

        }



        function list_category($offset = NULL)
        {


            $category_id = $this->uri->segment(4);
            $input = array();
            $input['where'] = array('category_id'=>$category_id);
      
            $total_rows= $this->product_model->get_total($input);
             $limit = 20;

            if(!is_null($offset))
            {
                $offset = $this->uri->segment(5);
            }

            $this->load->library('pagination');
            $config = array();
            $config['total_rows'] = $total_rows;
            $config['base_url'] = user_url('listproduct/list_category/'.$category_id); // link hien thi d
            $config['per_page'] = $limit;

            $config['next_link']   = 'Trang kế tiếp';
            $config['prev_link']   = 'Trang trước';
            $config['first_link'] = 'Trang đầu';
            $config['last_link'] = 'Trang cuối';
            $this->pagination->initialize($config);
            $info = $this->product_model->category_list($category_id,$limit,$offset);
            $this->data['info'] =$info;
            $this->load->model('categories_model');
            // dat la input_catalog de tranh bi trung voi input cua product
            $input_catalog['where'] = array('parent_id' => 0);
            $catalogs = $this->categories_model->get_list($input_catalog);
            foreach ($catalogs as $row) {
                $input_catalog['where'] = array('parent_id' => $row->id);
                $subs = $this->categories_model->get_list($input_catalog);
                $row->subs = $subs;
            }
            $this->data['catalogs'] = $catalogs;

            $this->data['temp'] ='site/listproduct/table';
            $this->load->view('site/listproduct/index',$this->data);

        }







    }

