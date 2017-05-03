<!-- head -->
<?php $this->load->view('admin/catalog/head', $this->data)?>

<div class="line"></div>

<div class="wrapper">
      <div class="widget">
           <div class="title">
      <h6>Thêm mới danh mục sản phẩm</h6>
    </div>

      <form id="form" class="form" enctype="multipart/form-data" method="post" action="">
          <fieldset>
                
                <div class="formRow">
                  <label for="param_name" class="formLeft">Tên:<span class="req">*</span></label>
                  <div class="formRight">
                    <span class="oneTwo"><input style="border: 2px ridge" type="text" _autocheck="true" id="param_name" value="<?php echo $info->category_name?>" name="category_name"></span>
                    <span class="autocheck" name="name_autocheck"></span>
                    <div class="clear error" name="name_error"><?php echo form_error('category_name')?></div>
                  </div>
                  <div class="clear"></div>
                </div>
                
                 <div class="formRow">
                  <label for="param_name" class="formLeft">Danh mục cha:</label>
                  <div class="formRight">
                    <span class="oneTwo">
                        <select _autocheck="true" id="param_parent_id"  name="parent_id">
                             <option value="0">Là danh mục cha</option>
                             <?php foreach ($list as $row):?>
                               <option value="<?php echo $row->id?>" <?php echo ($row->id == $info->parent_id) ? 'selected' : '';?>><?php echo $row->category_name?></option>
                             <?php endforeach;?>
                        </select>
                    </span>
                    <span class="autocheck" name="parent_id_autocheck"></span>
                    <div class="clear error" name="parent_id_error"><?php echo form_error('parent_id')?></div>
                  </div>
                  <div class="clear"></div>
                </div>                
                
                <div class="formSubmit">
                  <input type="submit" class="redB" value="Cập nhật">
              </div>
          </fieldset>
      </form>
      
      </div>
</div>
