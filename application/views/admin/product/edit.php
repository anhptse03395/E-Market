<!-- head -->
<?php $this->load->view('admin/product/head', $this->data)?>

<div class="line"></div>

<div class="wrapper">
    
	   	<!-- Form -->
		<form enctype="multipart/form-data" method="post" action="" id="form" class="form">
			<fieldset>
				<div class="widget">
				    <div class="title">
						<img class="titleIcon" src="<?php echo public_url('admin')?>/images/icons/dark/add.png">
						<h6>Cập nhật Sản phẩm</h6>
					</div>
					
				    <ul class="tabs">
		                <li class="activeTab"><a href="#tab1">Thông tin chung</a></li>
		            
		                
					</ul>
					
					<div class="tab_container">
					     <div class="tab_content pd0" id="tab1" style="display: block;">
					         <div class="formRow">
	<label for="param_name" class="formLeft">Tên:<span class="req">*</span></label>
	<div class="formRight">
		<span class="oneTwo"><input type="text" _autocheck="true" id="param_name" value="<?php echo $product->product_name?>" name="name"></span>
		<span class="autocheck" name="name_autocheck"></span>
		<div class="clear error" name="name_error"></div>
	</div>
	<div class="clear"></div>
</div>

<div class="formRow">
	<label class="formLeft">Hình ảnh:<span class="req">*</span></label>
	<div class="formRight">
		<div class="left">
    		<input type="file" name="image" id="image" size="25">
    		<img src="<?php echo base_url('upload/product/'.$product->image_link)?>" style="width:100px;height:70px">
		</div>
		<div class="clear error" name="image_error"></div>
	</div>
	<div class="clear"></div>
</div>

<?php $image_list = json_decode($product->image_list);?>

<div class="formRow">
	<label class="formLeft">Ảnh kèm theo:</label>
	<div class="formRight">
		<div class="left">
    		<input type="file" multiple="" name="image_list[]" id="image_list" size="25" >
    		<?php if(!empty($image_list)): ?>
    		<?php foreach ($image_list as $img):?>
    		<img src="<?php echo base_url('upload/product/'.$img)?>" style="width:100px;height:70px;margin:5px">
    		<?php endforeach;?>
    	<?php endif ;?>
		</div>
		<div class="clear error" name="image_list_error"></div>
	</div>
	<div class="clear"></div>
</div>




<div class="formRow">
	<label for="param_cat" class="formLeft">Thể loại:<span class="req">*</span></label>
	<div class="formRight">
	    <select name="catalog"  class="left" >
			<option value=""></option>
				<!-- kiem tra danh muc co danh muc con hay khong -->
				<?php foreach ($catalogs as $row):?>
				<?php if(count($row->subs) > 1):?>
  				<optgroup label="<?php echo $row->name?>">
  				    <?php foreach ($row->subs as $sub):?>
           			<option value="<?php echo $sub->id?>" <?php if($sub->id == $product->catalog_id) echo 'selected';?>> <?php echo $sub->name?> </option>
	                <?php endforeach;?>
           		</optgroup>
           		<?php else:?>
           		  <option value="<?php echo $row->id?>" <?php if($row->id == $product->catalog_id) echo 'selected';?>><?php echo $row->name?></option>
           		<?php endif;?>
           		<?php endforeach;?>
		</select>
		<span class="autocheck" name="cat_autocheck"></span>
		<div class="clear error" name="cat_error"></div>
	</div>
	<div class="clear"></div>
</div>


				     <div class="formRow hide"></div>
						 </div>
						 
						 <div class="tab_content pd0" id="tab3" style="display: block;">
						      <div class="formRow">
                            	<label class="formLeft">Nội dung:</label>
                            	<div class="formRight">
                            		<textarea class="editor" id="param_content" name="content"><?php echo $product->content?></textarea>
                            		<div class="clear error" name="content_error"></div>
                            	</div>
                            	<div class="clear"></div>
                            </div>
						      <div class="formRow hide"></div>
						 </div>
						
						
	        		</div><!-- End tab_container-->
	        		
	        		<div class="formSubmit">
	           			<input type="submit" class="redB" value="Cập nhật">
	           			<input type="reset" class="basic" value="Hủy bỏ">
	           		</div>
	        		<div class="clear"></div>
				</div>
			</fieldset>
		</form>
</div>
<div class="clear mt30"></div>
