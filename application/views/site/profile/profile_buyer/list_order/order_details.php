
<script src="<?php echo public_url('user') ?>/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/chart-master/Chart.js"></script>
<script rel="stylesheet" type="text/css" href="<?php echo public_url('user/home')?>/js/bootstrap-datetimepicker.min.js"></script>
<script rel="stylesheet" type="text/css" href="<?php echo public_url('user/home')?>/js/bootstrap-datetimepicker.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo public_url('user/home/css')?>/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo public_url('user/home/css')?>/bootstrap-datetimepicker.css">
<div class="container" style="width: 100%">
  <div class="row">


    <div class="col-md-12">
      <div class="col-md-4" style="margin-left: -10%">
        <ul class="breadcrumb">
          <li><a href="<?php echo user_url('profile/list_order_buyer') ?>">Đơn hàng</a>
          </li>
          <li>Đơn hàng chi tiết</li>
        </ul>
      </div>

        <!--     <form id="eventForm" action="<?php echo user_url('profile/search_order_buyer') ?>" method="post" class="form-horizontal">
            <div class="form-group" style="width: 60%;margin-left: 10%">
              <label class="col-xs-3 control-label">Trạng thái </label>
              <div class="input-group"> 
                  <span class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span>
              </span>
              <select  name="status" class="form-control">
                <option value="">chọn</option>
                <option value="2">Đã gửi hàng</option>
                <option value="1">Đang xử lý</option>
                <option value="3">Đơn hàng bị hủy</option>
        
            </select>
        </div>
                </div>
        
               
        
        
                <div class="form-group">
        <div class="col-xs-6 col-xs-offset-4">
            <button type="submit" class="btn btn-default">Tìm kiếm</button>
        </div>
                </div>
              </form> -->
              <form id="eventForm" action="" method="post" class="form-horizontal" style="margin-bottom: 3%">

                <div class="table-responsive">
                  <?php  $message = $this->session->flashdata('message');
                  ?>
                  <?php if(isset($message) && $message):?>
                    <div class="alert alert-info">
                      <h3 style="text-align: center;"><strong> </strong><?php echo $message?></h3>
                    </div>
                  <?php endif;?>


                  <table id="mytable" class="table table-bordred table-striped">

                    <thead>


                      <td class="description" style="color: blue">Tên sản phẩm</td>
                      <td class="description" style="color: blue">Nội dung</td>
                      <td class="description" style="color: blue">Ngày đặt hàng</td>
                      <td class="description" style="color: blue">Tên cửa hàng</td>

                      <td class="description" style="color: blue">Số lượng(Kg)</td>
                      <td class="description" style="color: blue">Giá(VND)</td>
                      <td class="description" style="color: blue">Trạng thái</td>

                    </thead>
                    <tbody>
                     <?php foreach ($list as $row):?>
                      <tr>
                        <td class="cart_description" style="color: rgba(71, 189, 34, 0.9)">
                         <?php echo $row->product_name?>
                       </td>
                       <td class="cart_description">
                        <?php echo $row->description?>                            </td>
                        <td class="cart_description" style="color: #da8f2a">
                          <?php echo mdate('%d-%m-%Y',$row->date_order)?>
                        </td>
                        <td class="cart_description">
                          <a href="<?php echo user_url('listproduct/product_detail_shop/').$row->shop_id ?>">  <?php echo $row->shop_name?></a>
                        </td>
                        <td class="cart_description">
                         <?php echo $row->quantity?>
                       </td>
                       <td class="cart_description">
                        <?php if (isset($row->price)) {?>
                        <?php if($row->price==0) { ?>
                        <?php echo '<strong style="color:#fe950f">'.'Thương lượng'.'</strong>' ?>
                        <?php } ?>

                        <?php if($row->price>0) { ?>
                        <?php echo $row->price ?>
                        <?php } ?>
                        <?php } ?>
                      </td>
                      <td class="cart_description">


                        <?php if (isset($row->status)) {?>
                        <span class="label label-warning"> <?php if($row->status==1){echo 'Đơn hàng mới';}?></span>
                        <span class="label label-success"><?php if($row->status==4){echo "Đã gửi hàng";}?></span>
                        <span class="label label-danger"><?php if($row->status==6){echo "Đơn hàng bị hủy";}?></span>  
                        <span class="label label-info"> <?php if($row->status==2){echo "Đang đàm phán";}?></span>
                        <span class="label label-success"> <?php  if($row->status==3){echo "Đang xử lý";}
                          ?></span>

                          <?php } ?>
                        </td>


                      </tr>
                      <!--                    --><?php endforeach;?>


                    </tbody>

                  </table>

                  <div class="form-group"  >
                    <label class="col-xs-3 control-label">Xác nhận giá đơn hàng </label>
                    <div class="input-group"> 
                      <span class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span>
                    </span>
                    

                    <select style="width: 40%" onchange="this.form.submit();" name="review_price" class="form-control">
                      <option value="">Chọn</option>
                      <option value="1">Đồng ý</option>
                      <option value="2">Hủy</option>


                    </select>


                  </div>
                </div>

                <div class="clearfix"></div>

              </div>
            </form>

          </div>
        </div>
      </div>


