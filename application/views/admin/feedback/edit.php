<?php $this ->load->view('admin/feedback/head',$this->data) ?>
<div class="line"></div>

<div class="wrapper">

	<div class="widget">

		<div class="title">
			
			<h6>Xem chi tiết phản hồi</h6>

		</div>

		<form class="form" id="form" action="" method="post" enctype="multipart/form-data">
			<fieldset>
				<div class="formRow">
                	<label for="param_name" class="formLeft">Số điện thoại:<span class="req">*</span></label>
                	<div class="formRight">
                		<span class="oneTwo"><input type="text" _autocheck="true" readonly="true" id="param_name" value="0<?php echo $info->phone?>" ></span>
                	</div>
                	<div class="clear"></div>
                </div>

                <div class="formRow">
                	<label for="param_name" class="formLeft">Ngày tạo:<span class="req">*</span></label>
                	<div class="formRight">
                		<span class="oneTwo"><input type="text" _autocheck="true" readonly="true" id="param_name" value="<?php echo mdate('%d-%m-%Y',$info->created) ?>" ></span>
                	</div>
                	<div class="clear"></div>
                </div>
							

				<div class="formRow">
                	<label for="param_name" class="formLeft">Lí do:<span class="req">*</span></label>
                	<div class="formRight">
                		<span class="oneTwo"><input type="text" _autocheck="true" readonly="true" id="param_name" value="<?php echo $info->reason?>" ></span>
                	</div>
                	<div class="clear"></div>
                </div>

                <div class="formRow">
                	<label for="param_name" class="formLeft">Nội dung:<span class="req">*</span></label>
                	<div class="formRight">
                		<span class="oneTwo"><textarea style="width: 600px" readonly="true" rows="10" cols="50"><?php echo $info->description?></textarea></span>
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