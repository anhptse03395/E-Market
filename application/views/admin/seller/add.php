<?php $this ->load->view('admin/seller/head',$this->data) ?>
<div class="line"></div>

<div class="wrapper">

	<div class="widget">

		<div class="title">
			
			<h6>Them moi thanh vien</h6>

		</div>

		<form class="form" id="form" action="" method="post" enctype="multipart/form-data">
			<fieldset>

				<div class="formRow">
					<label for="param_phone" class="formLeft">Tên người bán:<span class="req">*</span></label>
					<div class="formRight">
						<span class="oneTwo"><input style="border: 2px ridge" type="text" _autocheck="true" id="param_phone" value="<?php echo set_value('shop_name')?>" name="shop_name"></span>
						<span class="autocheck" name="phone_autocheck"></span>
						<div class="clear error" name="phone_error"><?php echo form_error('shop_name')?></div>
					</div>
					<div class="clear"></div>
				</div>					
				<div class="formRow">
					<label for="param_phone" class="formLeft">Chức năng:<span class="req">*</span></label>
					<div class="formRight">
						<span class="oneTwo"><input style="border: 2px ridge" type="text" readonly="true" _autocheck="true" id="param_phone" value="Người Bán" name="role_id"></span>
						<span class="autocheck" name="phone_autocheck"></span>
						<div class="clear error" name="phone_error"><?php echo form_error('role_id')?></div>
					</div>
					<div class="clear"></div>
				</div>								
				<div class="formRow">
					<label for="param_phone" class="formLeft">Phone:<span class="req">*</span></label>
					<div class="formRight">
						<span class="oneTwo"><input style="border: 2px ridge" type="text" _autocheck="true" id="param_phone" value="<?php echo set_value('phone')?>" name="phone"></span>
						<span class="autocheck" name="phone_autocheck"></span>
						<div class="clear error" name="phone_error"><?php echo form_error('phone')?></div>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<label for="param_phone" class="formLeft">Địa Chỉ:<span class="req">*</span></label>
					<div class="formRight">
						<span class="oneTwo"><input style="border: 2px ridge" type="text" _autocheck="true" id="param_phone" value="<?php echo set_value('address')?>" name="address"></span>
						<span class="autocheck" name="phone_autocheck"></span>
						<div class="clear error" name="phone_error"><?php echo form_error('address')?></div>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<label for="param_address" class="formLeft">Trạng Thái:<span class="req">*</span></label>
					<div class="formRight">
						<span class="oneTwo"><input style="border: 2px ridge" type="text" readonly="true" _autocheck="true" id="param_address" value="Đã Hoạt Động" name="active"></span>
						<span class="autocheck" name="address_autocheck"></span>
						<div class="clear error" name="address_error"><?php echo form_error('active')?></div>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<label for="param_cat" class="formLeft">Tên Tỉnh:<span class="req">*</span></label>
					<div class="formRight">
					    <select name="province"  class="left" onchange="this.form.submit();" >
							<option value=""></option>
									<!-- kiem tra danh muc co danh muc con hay khong -->
								<?php foreach ($provinces as $row) :?>
										
										<option    value="<?php echo $row->id?>" <?php echo ($this->input->post('province') == $row->id) ? 'selected' : '' ?>> <?php echo $row->local_name ?> </option>

									<?php endforeach;?>

						</select>
						<span class="autocheck" name="cat_autocheck"></span>
						<div class="clear error" name="cat_error"></div>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<label for="param_cat" class="formLeft">Tên Chợ:<span class="req">*</span></label>
					<div class="formRight">
					    <select name="market_id"  class="left" onchange="this.form.submit();" >
							<?php if($market_places) :?>
										<?php foreach ($market_places as $row) :?>

											<option value="<?php echo $row->id?>" <?php echo ($this->input->post('market_id') == $row->id) ? 'selected' : '' ?>> <?php echo $row->market_name ?> </option>

										<?php endforeach;?>
									<?php endif ; ?>

						</select>
						<span class="autocheck" name="cat_autocheck"></span>
						<div class="clear error" name="cat_error"></div>
					</div>
					<div class="clear"></div>
				</div>
		


				<div class="formRow">
					<label for="param_name" class="formLeft" >Mật khẩu:<span class="req">*</span></label>
					<div class="formRight">
						<span class="oneTwo"><input style="border: 2px ridge" type="password" _autocheck="true" id="param_password"  name="password"></span>
						<span name="name_autocheck" class="autocheck"></span>
						<div class="clear error" name="name_error" ><?php echo form_error('password') ?></div>
					</div>
					<div class="clear"></div>
				</div>

				<div class="formRow">
					<label class="formLeft" for="param_name">Nhập lại mật khẩu:<span class="req">*</span></label>
					<div class="formRight">
						<span class="oneTwo"><input style="border: 2px ridge" name="re_password" id="param_re_password" _autocheck="true" type="password"></span>
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