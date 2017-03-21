<?php
Class Test extends MY_controller{


	


	function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		

	}


/*	$object = new StdClass;
	$object=$this->user_model->get_info_rule($data) ;
	$arraylist	= (array) $object ;


	var_dump( (array) $object )
*/
	function index()


	{		

		/*$object = new StdClass;


			
		$input = array();
		$input['select']= "user.id as id,user.name as name" ;
			$input['join'] = array('dangtin');

		$object= $this->user_model->join($input);
			$arraylist=		var_dump((array) $object );
			
			echo $arraylist;*/


			$input = array();
			$input['select']= "user.id as id,user.name as name" ;
			$input['join'] = array('dangtin');
			$list=$this->user_model->join($input);
		 	$data['list'] = $list;
		 foreach ($list as $row) {
		 	echo $row->id;
		 	echo $row->name;
		 }
		 echo $this->db->last_query();

				/*$user = $this->session->userdata('user_id');
				echo  $user ;
*/






		}
	}

			<form class="form-horizontal" role="form" method="get" action="<?php echo user_url('listproduct')?>"  >
							<div class="form-group">
								<label class="col-md-4 control-label">Keyword</label>
								<div class="col-md-8">
									<input type="text" class="form-control" placeholder="Keyword" name="name" value="<?php $this->input->get('name') ?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">Category</label>
								<div class="col-md-8">
								<select class="form-control" placeholder="Category" name="catalog">
								<option value=""></option>

										<?php foreach ($catalogs as $row):?>
											<?php if(count($row->subs) > 1):?>
												<optgroup label="<?php echo $row->name?>">
													<?php foreach ($row->subs as $sub):?>
														<option value="<?php echo $sub->id?>" <?php echo ($this->input->get('catalog') == $sub->id) ? 'selected' : ''?>> <?php echo $sub->name?> </option>
													<?php endforeach;?>
												</optgroup>
											<?php else:?>
												<option value="<?php echo $row->id?>" <?php echo ($this->input->get('catalog') == $row->id) ? 'selected' : ''?>><?php echo $row->name?></option>
											<?php endif;?>
										<?php endforeach;?>

									</select>
								</div>
							</div>
							<div class="col-sm-offset-4 col-sm-5">
								<button type="submit" style="float: left;">Search</button>
								
							</div>
						</form>