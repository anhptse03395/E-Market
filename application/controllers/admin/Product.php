<?php

/**
 * Created by PhpStorm.
 * flash: Administrator
 * Date: 29-Dec-16
 * Time: 8:08 PM
 */
class Product extends MY_Controller
{


    function __construct()
    {
        parent::__construct();
        $this->load->model('product_model');

    }

    function removeURL($strTitle)
    {

     $strTitle=trim($strTitle);
     return $strTitle;
 }



 function index($offset = null)
 {
        //kiem tra co loc du lieu hay ko
    $input = array();
    $id = intval($this->input->post('id'));
    $input['where'] = array();
    if ($id > 0) {
        $input_temp['where']['id'] = $id;
    }
    $name = $this->input->post('name');
    if ($name) {
        $input['like'] = array('product_name', $name);
    }
    $category_id = intval($this->input->post('catalog'));
    if ($category_id) {
        $input['where']['category_id'] = $category_id; 
    }
        //sau khi loc thi tong so du lieu thay doi, dan toi so trang bi thay doi theo

    $total_rows= count($this->product_model->view_product());


        $this->data['total_rows'] = $total_rows;
        if($offset != null){
            $offset = $this->uri->segment(4);

        }
        $limit = 10;
        // thu vien phan trang
        $this->load->library('pagination');
        $config = array();
        $config['total_rows'] = $this->data['total_rows'];
        // neu ko search thi de link phan trang nhu binh thuong
        // if(!isset($id) || !isset($name) || !isset($catalog_id) )
        //{
        $config['base_url'] = admin_url('product/index'); // link hien thi du lieu  
        // }
        $config['per_page'] = $limit;
        //$config['uri_segment'] = 4;
       
        $config['next_link']   = 'Trang kế tiếp';
        $config['prev_link']   = 'Trang trước';
        //khoi tao cac cau hinh phan trang
        $this->pagination->initialize($config);

        //$segment = intval($this->uri->segment(4));

        //$input['limit'] = array($config['per_page'], $segment);
        $list = $this->product_model->paging_product($limit,$offset);

        $this->data['list'] = $list;

        // load filter list
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
        // gan thong bao loi de truyen vao view
        $this->data['message'] = $this->session->flashdata('message');
        $this->data['temp'] = 'admin/product/index';
        $this->load->view('admin/main', $this->data);
    }

    function search($offset = null)
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

            }
            $this->session->set_userdata('catalog', $this->input->post('catalog'));
            if ($this->session->userdata('catalog')) {
                $input['where']['category_id'] = $this->session->userdata('catalog');
                    
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
        $total_rows = $this->product_model->view_product();
        $this->data['total_rows'] = $total_rows;
        if($offset != null){
            $offset = $this->uri->segment(4);

        }
        $limit = 10;
        // thu vien phan trang
        $this->load->library('pagination');
        $config = array();
        $config['total_rows'] = $this->data['total_rows'];
        // neu ko search thi de link phan trang nhu binh thuong
        // if(!isset($id) || !isset($name) || !isset($catalog_id) )
        //{
        $config['base_url'] = admin_url('product/search'); // link hien thi du lieu
        // }
        $config['per_page'] = 6;
        $config['uri_segment'] = 4;
       // $config['use_page_numbers'] = TRUE;
        $config['next_link']   = 'Trang kế tiếp';
        $config['prev_link']   = 'Trang trước';
        //khoi tao cac cau hinh phan trang
        $this->pagination->initialize($config);

        $segment = intval($this->uri->segment(4));

        $input['limit'] = array($config['per_page'], $segment);

        $this->data['list'] = $this->product_model->paging_product($limit,$offset);

        // load filter list
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
        // gan thong bao loi de truyen vao view
        $this->data['message'] = $this->session->flashdata('message');
        $this->data['temp'] = 'admin/product/index';
        $this->load->view('admin/main', $this->data);
    }

    

    function del()
    {
        $id = intval($this->uri->rsegment(3));
        $this->__delete($id);
        //pre($id);
        $this->session->set_flashdata('message', 'Successs delete');
        redirect(admin_url('product'));
    }

    // xoa nhieu san pham
    function del_all()
    {
        $ids = $this->input->post('ids');
        foreach ($ids as $id)
            $this->__delete($id);

    }

    // ham ho tro xoa nhieu
    private
    function __delete($id)
    {
        $product = $this->product_model->get_info($id);
        if (!$product) {
            $this->session->set_flashdata('message', 'Can not edited');
            redirect(admin_url('product'));
        }
        // xoa
        $this->product_model->delete($id);
        // xoa anh
        $image_link = './upload/product/' . $product->image_link;
        if (file_exists($image_link)) {
            unlink($image_link);
        }
        //xoa anh kem theo
        $image_list = json_decode($product->image_list);
        if (is_array($image_list)) {
            foreach ($image_list as $img) {
                $image_link = './upload/product/' . $img;
                if (file_exists($image_link)) {
                    unlink($image_link);
                }
            }
        }
    }
}