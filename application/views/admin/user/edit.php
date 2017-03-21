<?php $this ->load->view('admin/admin/head',$this->data) ?>
<div class="line"></div>

<div class="wrapper">

	<div class="widget">

		<div class="title">
			
			<h6>Them moi thanh vien</h6>

		</div>

		<form class="form" id="form" action="" method="post" enctype="multipart/form-data">
			<fieldset>
				<div class="formRow">
                	<label for="param_name" class="formLeft">Tên:<span class="req">*</span></label>
                	<div class="formRight">
                		<span class="oneTwo"><input type="text" _autocheck="true" id="param_name" value="<?php echo $info->name?>" name ="name"></span>
                		<span class="autocheck" name="name_autocheck"></span>
                		<div class="clear error" name="name_error"><?php echo form_error('name')?></div>
                	</div>
                	<div class="clear"></div>
                </div>
				<div class="formRow">
					<label for="param_email" class="formLeft">Email:<span class="req">*</span></label>
					<div class="formRight">
						<span class="oneTwo"><input type="text" _autocheck="true" value="<?php echo $info->email ?>" id="param_email" name="email"></span>
						<span class="autocheck" name="email_autocheck"></span>
						<div class="clear error" name="email_error"><?php echo form_error('email')?></div>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
                	<label for="param_phone" class="formLeft">Phone:<span class="req">*</span></label>
                	<div class="formRight">
                		<span class="oneTwo"><input type="text" _autocheck="true" id="param_phone" value="<?php echo $info->phone?>" name ="phone"></span>
                		<span class="autocheck" name="phone_autocheck"></span>
                		<div class="clear error" name="phone_error"><?php echo form_error('phone')?></div>
                	</div>
                	<div class="clear"></div>
                </div>
                <div class="formRow">
                	<label for="param_address" class="formLeft">Address:<span class="req">*</span></label>
                	<div class="formRight">
                		<span class="oneTwo"><input type="text" _autocheck="true" id="param_address" value="<?php echo $info->address?>" name ="address"></span>
                		<span class="autocheck" name="address_autocheck"></span>
                		<div class="clear error" name="address_error"><?php echo form_error('address')?></div>
                	</div>
                	<div class="clear"></div>
                </div>




				<div class="formRow">
					<label for="param_name" class="formLeft" >PassWord:<span class="req">*</span></label>
					<p> neu thay doi mat khau thi moi dien vao</p>
					<div class="formRight">
						<span class="oneTwo"><input type="password" _autocheck="true" id="param_password"  name="password"></span>
						<span name="name_autocheck" class="autocheck"></span>
						<div class="clear error" name="name_error" ><?php echo form_error('password') ?></div>
					</div>
					<div class="clear"></div>
				</div>

				<div class="formRow">
					<label class="formLeft" for="param_name">Nhap lai mk:<span class="req">*</span></label>
					<div class="formRight">
						<span class="oneTwo"><input name="re_password" id="param_re_password" _autocheck="true" type="password"></span>
						<span name="name_autocheck" class="autocheck"></span>
						<div class="clear error" name="name_error"> <?php echo form_error('re_password'); ?> </div>
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