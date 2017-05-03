<?php $this ->load->view('admin/provinces/head',$this->data) ?>
<div class="line"></div>

<div class="wrapper">

	<div class="widget">

		<div class="title">
			
			<h6>Chinh sua tên chợ</h6>

		</div>

		<form class="form" id="form" action="" method="post" enctype="multipart/form-data">
			<fieldset>
				<div class="formRow">
					<label for="param_cat" class="formLeft">Tên Tỉnh:<span class="req">*</span></label>
					<div class="formRight">
					    <select name="province_id"  class="left" >
							<option value=""></option>
									<!-- kiem tra danh muc co danh muc con hay khong -->
								<?php foreach ($province as $row):?>
                               		<option value="<?php echo $row->id?>" <?php echo ($row->id == $info->province_id) ? 'selected' : '';?>><?php echo $row->local_name?></option>
                             	<?php endforeach;?> 

						</select>
						<span class="autocheck" name="cat_autocheck"></span>
						<div class="clear error" name="cat_error"></div>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
                	<label for="param_name" class="formLeft">Tên Chợ:<span class="req">*</span></label>
                	<div class="formRight">
                		<span class="oneTwo"><input style="border: 2px ridge" type="text" _autocheck="true" id="param_name" value="<?php echo $info->market_name?>" name ="market_name"></span>
                		<span class="autocheck" name="name_autocheck"></span>
                		<div class="clear error" name="name_error"><?php echo form_error('market_name')?></div>
                	</div>
                	<div class="clear"></div>
                </div>
				
		
				<div class="formSubmit">
					<input type="submit" value="Cap nhat" class="redB">

				</div>

			</fieldset>
		</form>
	</div>

</div>