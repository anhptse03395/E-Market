
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
