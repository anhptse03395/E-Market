<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {


	function __construct()
	{


		parent::__construct();
	}
	public function index()
	{
		$this->load->library('form_validation');
		$this->load->helper('form');

		$this->load->model('province_model');
		$this->load->model('market_place_model');
		$this->load->model('shop_model');


		$provinces = $this->province_model->get_list();
		$this->data['provinces'] = $provinces;

		$province_id = $this->input->post('province');
		if($province_id){

			$input['where']  = array('province_id' => $province_id);
			$market_places = $this->market_place_model->get_list($input);

			$this->data['market_places'] = $market_places;

		}


		if ($this->input->post()) {


			$this->session->unset_userdata('market_place');
			$input['where'] = array();

			$this->session->set_userdata('market_place', $this->input->post('market_place'));
			if ($this->session->userdata('market_place')) {
				$input['where']['market_id'] = $this->session->userdata('market_place');

			}
		}

		if ($this->session->userdata('market_place')) {
			$input['where'] = array();
			$input['where']['market_id'] = $this->session->userdata('market_place');

			$total_rows= $this->shop_model->get_total($input);
			

        //load ra thu vien phan trang
			$this->load->library('pagination');
			$config = array();
			$config['total_rows'] = $total_rows;
        // neu ko search thi de link phan trang nhu binh thuong
        // if(!isset($id) || !isset($name) || !isset($catalog_id) )
        //{
            $config['base_url'] = base_url('home/index'); // link hien thi du lieu
            // }
            $config['per_page'] = 10;
            $config['uri_segment'] = 3;
           // $config['use_page_numbers'] = TRUE;
            $config['next_link']   = 'Trang kế tiếp';
            $config['prev_link']   = 'Trang trước';
                //khoi tao cac cau hinh phan trang
            $this->pagination->initialize($config);
            $segment = intval($this->uri->segment(3));

            $input['limit'] = array($config['per_page'], $segment);

            $shops = $this->shop_model->get_list($input);
            $this->data['shops'] = $shops;

            

        }
        $this->load->view('site/home/index',$this->data);

    }


    

}
