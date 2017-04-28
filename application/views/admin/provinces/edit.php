<?php $this ->load->view('admin/provinces/head',$this->data) ?>
<div class="line"></div>

<div class="wrapper">

	<div class="widget">

		<div class="title">
			
			<h6>Chinh sua tên tỉnh</h6>

		</div>

		<form class="form" id="form" action="" method="post" enctype="multipart/form-data">
			<fieldset>
				<div class="formRow">
                	<label for="param_name" class="formLeft">Tên Nước:<span class="req"></span></label>
                	<div class="formRight">
                		<div class="">Việt Nam</div>
                	</div>
                	<div class="clear"></div>
                </div>
				<div class="formRow">
                	<label for="param_name" class="formLeft">Tên Tỉnh:<span class="req">*</span></label>
                	<div class="formRight">
                		<span class="oneTwo"><input type="text" _autocheck="true" id="param_name" value="<?php echo $info->local_name?>" name ="local_name"></span>
                		<span class="autocheck" name="name_autocheck"></span>
                		<div class="clear error" name="name_error"><?php echo form_error('local_name')?></div>
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