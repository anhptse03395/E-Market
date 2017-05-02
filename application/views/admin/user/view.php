<?php $this ->load->view('admin/user/head',$this->data) ?>
<div class="line"></div>

<div class="wrapper">

	<div class="widget">

		<div class="title">
			
			<h6>Chỉnh sửa thông tin người mua</h6>

		</div>

		<form class="form" id="form" action="" method="post" enctype="multipart/form-data">
			<fieldset>
			<div class="formRow">
					<label  class="formLeft" style="text-align: center;" >Tên người mua:<span class="req"></span></label>
					<div class="formRight">
						<div class=""><?php echo $info->buyer_name?></div>	
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

			

			</fieldset>
		</form>
	</div>

</div>