<style type="text/css">
    .help-block{
        color:#b94a48;
    }

</style>
<div class="container">
    <div class="row">
       
                <!-- Form Name -->
                <legend>Chỉnh sửa sản phẩm</legend>
                <?php  $message = $this->session->flashdata('message');
                ?>
                <?php if(isset($message) && $message):?>
                    <div class="alert alert-success">
                        <h3 style="text-align: center;"><strong> </strong><?php echo $message?></h3>
                    </div>
                <?php endif;?>

                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="well well-sm">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <label for="subject">
                                                    Danh Mục Sản Phẩm</label>
                                                    <div class="input-group">
                                                      <span class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span>
                                                  </span>
                                                  <select  name="catalog" class="form-control">
                                                  <option value="">Danh mục</option>
                                                    <!-- kiem tra danh muc co danh muc con hay khong -->
                                                    <?php foreach ($catalogs as $row):?>
                                                        <?php if(count($row->subs) > 1):?>
                                                            <optgroup label="<?php echo $row->category_name?>">
                                                                <?php foreach ($row->subs as $sub):?>
                                                                    <option value="<?php echo $sub->id?>" <?php if($sub->id == $product->category_id) echo 'selected';?>> <?php echo $sub->category_name?> </option>
                                                                <?php endforeach;?>
                                                            </optgroup>
                                                        <?php else:?>
                                                          <option value="<?php echo $row->id?>" <?php if($row->id == $product->category_id) echo 'selected';?>><?php echo $row->category_name?></option>
                                                      <?php endif;?>
                                                  <?php endforeach;?>
                                              </select>
                                          </div>
                                      </div>

                                      <div class="form-group">
                                        <label for="email">
                                            Tên sản phẩm</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-text-height"></span>
                                            </span>
                                            <input type="text" class="form-control"  placeholder=" Tên sản phẩm" name="product_name" value="<?php echo $product->product_name?>" /></div>
                                            <div class="clear error" name="name_error"><?php echo form_error('product_name')?></div>
                                        </div>
                                       <!--  <div class="form-group">
                                           <label for="email">
                                               Số lượng/Kg</label>
                                               <div class="input-group">
                                                   <span class="input-group-addon"><span class="glyphicon glyphicon-hdd"></span>
                                               </span>
                                               <input type="text" style="width: 50%" class="form-control"  placeholder="Số lượng/kg" name="quantity" value="<?php echo $product->quantity ?>" /></div>
                                               <div class="clear error" name="name_error"><?php echo form_error('quantity')?></div>
                                           </div> -->

                                            <div class="form-group">
                                                <label for="email">
                                                    Hình ảnh</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class=" glyphicon glyphicon-picture"></span>
                                                    </span>

                                                    <input type="file" name="image" id="image" size="25">
                                                    <img src="<?php echo base_url('upload/product/'.$product->image_link)?>" style="width:100px;height:70px">

                                                </div>
                                                <div class="clear error" name="image_error"></div>
                                            </div>
                                            <div class="form-group">

                                                <?php $image_list = json_decode($product->image_list);?>
                                                <label for="email">
                                                    Hình ảnh kèm theo</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="glyphicon glyphicon-th-list"></span>
                                                    </span>
                                                    <input type="file" multiple="" name="image_list[]" id="image_list" size="25" >
                                                    <?php if(!empty($image_list)): ?>
                                                        <?php foreach ($image_list as $img):?>
                                                            <img src="<?php echo base_url('upload/product/'.$img)?>" style="width:100px;height:70px;margin:5px">
                                                        <?php endforeach;?>
                                                    <?php endif ;?>
                                                    <div class="clear error" name="image_list_error"></div>
                                                </div>


                                            </div>

                                            <div class="form-group">
                                                <label for="email">Nội Dung</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span>
                                                </span>
                                                <textarea type="text" class="form-control" rows="9" cols="25" name="description"  placeholder="Nội Dung Đăng Bài" >
                                                    <?php echo $product->description?>
                                                </textarea>

                                            </div>
                                            <div class="clear error" name="name_error"><?php echo form_error('description')?></div>
                                        </div>
                                    </div>


                                    <div class="col-md-12">

                                        <div class="formSubmit">
                                            <input type="submit" class="btn btn-primary col-lg-pull-0" value="Cập nhật">
                                            <input type="reset" class="btn btn-primary col-lg-pull-11" value="Hủy bỏ">
                                        </div>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
     

</div>
</div>