<?php $this ->load->view('admin/market/head',$this->data) ?>
<div class="line"></div>

<div class="wrapper">

	<div class="widget">

		<div class="title">
			
			<h6>Thêm mới chợ</h6>

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

											<option value="<?php echo $row->id?>" <?php echo ($this->input->get('province') == $row->id) ? 'selected' : ''?>><?php echo $row->local_name?></option>
									<?php endforeach;?>
						</select>
						<span class="autocheck" name="cat_autocheck"></span>
						<div class="clear error" name="cat_error"></div>
					</div>
					<div class="clear"></div>
				</div>		
				<div class="formRow">
					<label for="param_email" class="formLeft">Tên chợ:<span class="req">*</span></label>
					<div class="formRight">
						<span class="oneTwo"><input style="border: 2px ridge" type="text" _autocheck="true" value="<?php echo set_value('market_name')?>" id="param_email" name="market_name"></span>
						<span class="autocheck" name="email_autocheck"></span>
						<div class="clear error" name="email_error"><?php echo form_error('market_name')?></div>
					</div>
					<div class="clear"></div>
				</div>

					

				<div class="formSubmit">
					<input type="submit" value="Thêm mới" class="redB">

				</div>

			</fieldset>
		</form>
	</div>

</div>