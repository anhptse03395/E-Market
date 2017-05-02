<?php $this ->load->view('admin/seller/head',$this->data) ?>
<div class="line"></div>

<div class="wrapper">

	<div class="widget">

		<div class="title">
			
			<h6>Chinh sua thong tin nguoi dung</h6>

		</div>

		<form class="form" action="" method ="post" >
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
						<div class=""><?php echo '0'.$info->phone?></div>	
					</div>
					<div class="clear"></div>
				</div>
				
				<div class="formRow">
					<label  class="formLeft" style="text-align: center;" >Địa chỉ:<span class="req"></span></label>
					<div class="formRight">
						<div class=""><?php echo $info->address?></div>	
					</div>
					<div class="clear"></div>
				</div>

				<div class="formRow">
					<label  class="formLeft" style="text-align: center;" >Tỉnh thành:<span class="req"></span></label>
					<div class="formRight">
						<div class=""><?php echo $provinces->local_name?></div>	
					</div>
					<div class="clear"></div>
				</div>


				<div class="formRow">
					<label  class="formLeft" style="text-align: center;" >Chợ:<span class="req"></span></label>
					<div class="formRight">
						<div class=""><?php echo $market_places->market_name?></div>
						<input type="hidden" name="empty" value="">	
					</div>
					<div class="clear"></div>
				</div>


				<?php if($info->role_id ==3){ ?>
				<div onclick="return confirmAction()" class="formSubmit left ">
					<input type="submit" value="Cấm cửa hàng này" class="redB">

				</div>
				<?php }else{ ?>
				<div class="formSubmit left "onclick="return confirmAction1()" >
					<input type="submit"  value="Mở cửa hàng này" class="blueB">

				</div>
				<?php } ?>
			</fieldset>
		</form>
	</div>

</div>
<SCRIPT LANGUAGE="JavaScript">
	function confirmAction() {
		return confirm("bạn có đồng ý cấm cửa hàng này không?")
	}
	function confirmAction1() {
		return confirm("bạn có đồng ý mở lại cửa hàng này không?")
	}
</SCRIPT>
