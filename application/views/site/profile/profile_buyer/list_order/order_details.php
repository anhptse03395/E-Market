<script src="<?php echo public_url('user/home') ?>/js/main.js"></script>
<script type="text/javascript" src="<?php echo public_url('user/home') ?>/js/moment-2.4.0.js"></script>
<script src="<?php echo public_url('user/home') ?>/js/bootstrap-datetimepicker.min.js"></script>
<link href="<?php echo public_url('user/home')?>/css/bootstrap-datetimepicker.css" rel="stylesheet">
<script src="<?php echo public_url('user/home') ?>/js/bootstrap.min.js"></script>


<SCRIPT LANGUAGE="JavaScript">
  function confirmAction() {
    return confirm("bạn đồng ý với giao dịch này?")
  }
  function confirmAction1() {
    return confirm("bạn có xác nhận hủy bỏ  không?")
  }
</SCRIPT>

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
                        <?php echo number_format($row->price , 0, '.', ',') ?>
                        <?php } ?>
                        <?php } ?>
                      </td>
                      <td class="cart_description">


                        <?php if (isset($row->status)) {?>
                      
                 <span class="label label-warning"> <?php if($row->status==1){echo 'Đơn hàng mới';}?></span>
                <span class="label label-success"><?php if($row->status==4){echo "Đã gửi hàng";}?></span>
                <span class="label label-danger"><?php if($row->status==7){echo "Đơn hàng bị hủy";}?></span>  <span class="label label-success"><?php if($row->status==5){echo "Đã nhận hàng";}?></span>
                 <span class="label label-success"><?php if($row->status==6){echo "Đã hoàn thành";}?></span>
                <span class="label label-info"> <?php if($row->status==2){echo "Đang đàm phán";}?></span>
                <span class="label label-success"> <?php  if($row->status==3){echo "Đang xử lý";}?></span>

                          <?php } ?>
                        </td>


                      </tr>
                      <!--                    --><?php endforeach;?>


                    </tbody>

                  </table>
                <?php if ($orders->status==2) {?>
                <div class="form-group"  >
                  <label class="col-xs-3 control-label">Xác nhận giá đơn hàng </label>
                  <div class="input-group"> 
                    <span class="input-group-addon"><span class=""></span>
                  </span>
                  
                    <label class="btn btn-success ">
                  <input type="radio" name="review_price" value="1" onclick="return confirmAction()" onchange="this.form.submit();"    />
                  Đồng ý
                </label>

                <label style="margin-left: 10%" class="btn btn-danger"  >
                  <input type="radio" name="review_price" value="2"  onclick="return confirmAction1()" onchange="this.form.submit();"  />
                  Hủy bỏ
                </label>
                </div>
              </div>
              <?php } ?>

                <div class="clearfix"></div>

              </div>
            </form>

          </div>
        </div>
      </div>


