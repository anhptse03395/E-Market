<?php $this ->load->view('admin/provinces/head',$this->data) ?>
<div class="line"></div>

<div class="wrapper">

	<div class="widget">

		<div class="title">
			
			<h6>Thêm mới tỉnh</h6>

		</div>

		<form class="form" id="form" action="" method="post" enctype="multipart/form-data">
			<fieldset>	
				<div class="formRow">
					<label for="param_email" class="formLeft">Tên Nước:<span class="req">*</span></label>
					<div class="formRight">
						<span class="oneTwo"><input style="border: 2px ridge" type="text" readonly='true' _autocheck="true" value="Việt Nam" id="param_email" name="country_id"></span>
						<span class="autocheck" name="email_autocheck"></span>
						<div class="clear error" name="email_error"><?php echo form_error('country_id')?></div>
					</div>
					<div class="clear"></div>
				</div>			
				<div class="formRow">
					<label for="param_email" class="formLeft">Tên tỉnh:<span class="req">*</span></label>
					<div class="formRight">
						<span class="oneTwo"><input style="border: 2px ridge" type="text" _autocheck="true" value="<?php echo set_value('local_name')?>" id="param_email" name="local_name"></span>
						<span class="autocheck" name="email_autocheck"></span>
						<div class="clear error" name="email_error"><?php echo form_error('local_name')?></div>
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