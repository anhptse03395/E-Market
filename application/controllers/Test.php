
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends MY_Controller {

    function __construct()
    {


        parent::__construct();
    }
    public function index()
    {
        $this->load->library('form_validation');
        $this->load->helper('form');

        $this->load->model('province_model');

        $this->load->model('shop_model');


        $provinces = $this->province_model->get_list();
        $this->data['provinces'] = $provinces;




        $this->load->view('test',$this->data);

    }

    function get_view(){

        $this->load->model('market_place_model');
        $province_id = $this->input->post('id');
        $input =array('province_id'=>$province_id);
        $market=    $this->market_place_model->get_list($input);
        if(count($market >0)){

            $pro_select_box = '';
            $pro_select_box .='<option value=""> chon   </option>';
            foreach ($market as $row ) {
                $pro_select_box .='<option value="'.$row->market_id.'">'.$row->market_name.'</option>';
            }
            echo json_encode($pro_select_box);
        }

    }


    

}

 function product_detail_shop($shop_id=0, $page=1,$offset = NULL)
        {



            $shop_id = $this->uri->segment(4);
            $input = array();
            $input['where'] = array('shop_id'=>$shop_id);
        //phan trang
            $total_rows= $this->product_model->get_total($input);
            //pre($total_rows);

            $this->load->library('pagination');
            $config = array();
            $config['total_rows'] = $total_rows;
      
            $config['base_url'] = user_url('listproduct/product_detail_shop/'.$shop_id); // link hien thi du lieu
            // }
            $config['per_page'] = 10;
            $config['uri_segment'] = 5;
           // $config['use_page_numbers'] = TRUE;
            $config['next_link']   = 'Trang kế tiếp';
            $config['prev_link']   = 'Trang trước';
            $config['first_link'] = 'Trang đầu';
            $config['last_link'] = 'Trang cuối';

            if(!is_null($offset))
            {
                $offset = ($page-1)*$config['per_page'];
            }
                //khoi tao cac cau hinh phan trang
            $this->pagination->initialize($config);


            $limit =  $config['per_page'];

            $result = $this->product_model->list_product_shop($shop_id,$limit,$offset);

            $this->data['product'] = $result;

            $this->load->view('site/product_detail/shop',$this->data);

        }

