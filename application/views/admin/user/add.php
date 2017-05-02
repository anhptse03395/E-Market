<?php $this ->load->view('admin/user/head',$this->data) ?>
<div class="line"></div>

<div class="wrapper">

	<div class="widget">

		<div class="title">
			
			<h6>Thêm mới người mua</h6>

		</div>

		<form class="form" id="form" action="" method="post" enctype="multipart/form-data">
			<fieldset>

				<div class="formRow">
					<label for="param_phone" class="formLeft">Tên người mua:<span class="req"></span></label>
					<div class="formRight">
						<span class="oneTwo"><input type="text" _autocheck="true" id="param_phone" value="<?php echo set_value('buyer_name')?>" name="buyer_name"></span>
						<span class="autocheck" name="phone_autocheck"></span>
						<div class="clear error" name="phone_error"><?php echo form_error('buyer_name')?></div>
					</div>
					<div class="clear"></div>
				</div>					
				<div class="formRow">
					<label for="param_phone" class="formLeft">Chức năng:<span class="req"></span></label>
					<div class="formRight">
						<span class="oneTwo"><input type="text" readonly="true" _autocheck="true" id="param_phone" value="Người Mua" name="role_id"></span>
						<span class="autocheck" name="phone_autocheck"></span>
						<div class="clear error" name="phone_error"><?php echo form_error('role_id')?></div>
					</div>
					<div class="clear"></div>
				</div>								
				<div class="formRow">
					<label for="param_phone" class="formLeft">Số điện thoại:<span class="req"></span></label>
					<div class="formRight">
						<span class="oneTwo"><input type="text" _autocheck="true" id="param_phone" value="<?php echo set_value('phone')?>" name="phone"></span>
						<span class="autocheck" name="phone_autocheck"></span>
						<div class="clear error" name="phone_error"><?php echo form_error('phone')?></div>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<label for="param_phone" class="formLeft">Địa Chỉ:<span class="req"></span></label>
					<div class="formRight">
						<span class="oneTwo"><input type="text" _autocheck="true" id="param_phone" value="<?php echo set_value('address')?>" name="address"></span>
						<span class="autocheck" name="phone_autocheck"></span>
						<div class="clear error" name="phone_error"><?php echo form_error('address')?></div>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<label for="param_address" class="formLeft">Trạng Thái:<span class="req"></span></label>
					<div class="formRight">
						<span class="oneTwo"><input type="text" readonly="true" _autocheck="true" id="param_address" value="Đã Hoạt Động" name="active"></span>
						<span class="autocheck" name="address_autocheck"></span>
						<div class="clear error" name="address_error"><?php echo form_error('active')?></div>
					</div>
					<div class="clear"></div>
				</div>
		


				<div class="formRow">
					<label for="param_name" class="formLeft" >Mật khẩu:<span class="req"></span></label>
					<div class="formRight">
						<span class="oneTwo"><input type="password" _autocheck="true" id="param_password"  name="password"></span>
						<span name="name_autocheck" class="autocheck"></span>
						<div class="clear error" name="name_error" ><?php echo form_error('password') ?></div>
					</div>
					<div class="clear"></div>
				</div>

				<div class="formRow">
					<label class="formLeft" for="param_name">Nhập lại mật khẩu:<span class="req"></span></label>
					<div class="formRight">
						<span class="oneTwo"><input name="re_password" id="param_re_password" _autocheck="true" type="password"></span>
						<span name="name_autocheck" class="autocheck"></span>
						<div class="clear error" name="name_error"> <?php echo form_error('re_password'); ?> </div>
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