<?php $this ->load->view('admin/admin/head',$this->data) ?>
<div class="line"></div>

<div class="wrapper">

	<div class="widget">

		<div class="title">
			
			<h6>Chỉnh sửa quản trị</h6>

		</div>

		<form class="form" id="form" action="" method="post" enctype="multipart/form-data">
			<fieldset>
				<div class="formRow">
                	<label for="param_address" class="formLeft">Địa Chỉ:<span class="req">*</span></label>
                	<div class="formRight">
                		<span class="oneTwo"><input type="text" _autocheck="true" id="param_address" value="<?php echo $info->address?>" name ="address"></span>
                		<span class="autocheck" name="address_autocheck"></span>
                		<div class="clear error" name="address_error"><?php echo form_error('address')?></div>
                	</div>
                	<div class="clear"></div>
                </div>



				<div class="formRow">
					<label for="param_name" class="formLeft" >PassWord:<span class="req">*</span></label>
					<div class="formRight">
						<span class="oneTwo"><input type="password" _autocheck="true" id="param_password"  name="password"></span><label>&nbsp;&nbsp;&nbsp;</label><label>(Nếu Thay Đổi Mật Khẩu Thì Điền Vào)</label>
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


 				<div class="formRow">
					<label class="formLeft" for="param_name">Phan Quyen:<span class="req">*</span></label>
					<div class="formRight">
						<?php foreach ($config_permissions  as $controller => $action):?>
							<?php
								$permissions_action = array();
								if(isset($info->permissions->{$controller})){
									$permissions_action = $info->permissions->{$controller};
								}
							?> 
							<div>
								<label style="width: 80px"><b><?php echo $controller?>:</b></label>
								<?php foreach ($action as $action):?>
								<label style="width: 80px"><input type="checkbox" name="permissions[<?php echo $controller?>][]" value="<?php echo $action?>" <?php echo(in_array($action, $permissions_action)) ? 'checked' : ''?> /><?php echo $action?></label>
								<?php endforeach;?>
								<div class="clear"></div>
							</div>
						<?php endforeach;?>

							
						
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