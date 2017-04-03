<?php
Class Test extends MY_controller{


	


	function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		

	}

	function index() {  
  
    // configure the paginator  
    $this->load->library('pagination');  
    $config['base_url'] = base_url() . 'blog/index/';  
    $config['per_page'] = 5;  
    $config['total_rows'] = $this->db->count_all('entries');  
    $this->pagination->initialize($config);  
  
    // load the model and get the query results  
    $this->load->model('Blog_model', 'blog');  
    $data['entries'] = $this->blog->select_entries($config['per_page'], $this->uri->segment(3));  
  
    // load the view  
    $this->load->view('entry_view', $data);  
} 

function select_entries($conditions = NULL, $limit = NULL, $offset = NULL) {  
    $this->db->select("SQL_CALC_FOUND_ROWS *");  
  
    if(isset($conditions)) {  
        $this->db->where($conditions, NULL, FALSE);  
    }  
  
    $query = $this->db->get('entries', $limit, $offset);  
  
    if($query->num_rows() > 0) {  
  
        // let's see how many rows would have been returned without the limit  
        $count_query = $this->db->query('SELECT FOUND_ROWS() AS row_count');  
        $found_rows = $count_query->row();  
  
        // load all of the returned results into a single array ($rows).  
        // this is handy if you need to execute other SQL statements or bring  
        // in additional model data that might be useful to have in this array.  
        // alternatively, you could return $query object if you prefer that.  
        $rows = array();  
        foreach($query->result() as $row) {  
  
            // to build on my comment above about returning an array instead of  
            // the raw $query object, as an example, this would be a good spot  
            // to retrieve the comment count for each entry and append that to  
            // the current row before we push the row data into the $rows array.  
            $row->comment_count = $this->_comment_count($row->entry_id);  
  
            array_push($rows, $row);  
        }  
  
        // after the foreach loop above, we should now have all of the combined  
        // entry data in a single array. let's return a two-element array: the  
        // first element contains the result set in array form, and the second  
        // element is the number of rows in the full result set without the limit  
        return array('rows' => $rows, 'found_rows' => (int) $found_rows->row_count);  
    } else {  
        return FALSE;  
    }  
}



}
	