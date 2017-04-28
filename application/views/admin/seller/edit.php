<?php $this ->load->view('admin/seller/head',$this->data) ?>
<div class="line"></div>

<div class="wrapper">

	<div class="widget">

		<div class="title">
			
			<h6>Chinh sua thong tin nguoi dung</h6>

		</div>

		<form class="form" id="form" action="" method="post" enctype="multipart/form-data">
			<fieldset>
				<div class="formRow">
                	<label for="param_name" class="formLeft">Tên Shop:<span class="req">*</span></label>
                	<div class="formRight">
                		<span class="oneTwo"><input type="text" _autocheck="true" id="param_name" value="<?php echo $info->shop_name?>" name ="shop_name"></span>
                		<span class="autocheck" name="name_autocheck"></span>
                		<div class="clear error" name="name_error"><?php echo form_error('shop_name')?></div>
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
					<label for="param_cat" class="formLeft">Tên Tỉnh:<span class="req">*</span></label>
					<div class="formRight">
					    <select name="province"  class="left" id="province">
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
					    <select  id="market_place" name="market_place"   class="form-control" disabled=""  onchange="this.form.submit();">
                                <option value="">Chọn</option>
                                
                            </select>
						<span class="autocheck" name="cat_autocheck"></span>
						<div class="clear error" name="cat_error"></div>
					</div>
					<div class="clear"></div>
				</div>
			


				<div class="formSubmit">
					<input type="submit" value="Cập nhật" class="redB">

				</div>

			</fieldset>
		</form>
	</div>

</div>