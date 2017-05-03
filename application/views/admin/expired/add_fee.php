<?php $this ->load->view('admin/expired/head',$this->data) ?>
<div class="line"></div>

<div class="wrapper">

	<div class="widget">

		<div class="title">
			
			<h6>Quản lý phí người bán hàng</h6>

		</div>

		<form class="form" id="form" action="" method="post" >
			<fieldset>
				<div class="formRow">
                	<label  class="formLeft" style="text-align: center;" >Tên cửa hàng:<span class="req"></span></label>
                	<div class="formRight">
                		<div class=""><?php echo $info->shop_name?></div>	
                	</div>
                	<div class="clear"></div>
                </div>
                	<div class="formRow">
                	<label  class="formLeft" style="text-align: center;" >Số điện thoại:<span class="req"></span></label>
                	<div class="formRight">
                		<div class=""><?php echo '0'.$account->phone?></div>	
                	</div>
                	<div class="clear"></div>
                </div>
			
				
                <div class="formRow">
                	<label for="param_address" style="text-align: center;" class="formLeft">Địa chỉ:<span class="req"></span></label>
                	<div class="formRight">
                		<div class=""><?php echo $info->address?></div>	
                		
                	</div>
                	<div class="clear"></div>
                </div>
                <div class="formRow">
                	<label for="param_name" style="text-align: center;" class="formLeft">Ngày thanh toán<span class="req"></span></label>
                	<div class="formRight">
                		<span class="oneTwo"><input style="border: 2px ridge" name="filing_date" value="" id="filter_created" type="text" class="datepicker" /></span>
                		<span class="autocheck" name="name_autocheck"></span>
                		<div class="clear error" name="name_error"><?php echo form_error('shop_name')?></div>
                	</div>
                	<div class="clear"></div>
                </div>

				
				<div class="formRow">
					<label for="param_cat" style="text-align: center;" class="formLeft">Số ngày<span class="req"></span></label>
					<div class="formRight">
					    <select name="number_month" class="form-control">
                                <option value="">Chọn</option>
                                <option value="30">1 tháng</option>
                                <option value="60">2 tháng </option>
                                <option value="90">3 tháng</option>
                                <option value="180">6 tháng</option>
                                 <option value="365">1 năm</option>
                                
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