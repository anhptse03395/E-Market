
<script src="<?php echo public_url('user/home') ?>/js/main.js"></script>
<script type="text/javascript" src="<?php echo public_url('user/home') ?>/js/moment-2.4.0.js"></script>
<script src="<?php echo public_url('user/home') ?>/js/bootstrap-datetimepicker.min.js"></script>
<link href="<?php echo public_url('user/home')?>/css/bootstrap-datetimepicker.css" rel="stylesheet">
<script src="<?php echo public_url('user/home') ?>/js/bootstrap.min.js"></script>



<div class="col-md-9" id="customer-orders" style="width: 100%">
  <div class="box">
    <h3>Công nợ</h3>
    
    <!-- <div class="text-center" style="margin-bottom: 10%"> <?php echo '<h4 style="color:blue">'.'Tổng số tiền khách hàng đã thanh toán' .' '.number_format($total_info->sum_paid, 0, '.', ',').' '.'nghìn đồng'.'</h4>' ?></div> -->


    <form id="eventForm" action="<?php echo user_url('profile/search_debt_shop') ?>" method="post" class="form-horizontal">


      <div class="form-group" style="width: 40%;float: left; margin-right: 10%" >
        <label class="col-xs-3 control-label">Mã đơn hàng </label>
        <div class="input-group">
          <span class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span>
        </span>
        <input  type="text" class="form-control" value="<?php echo set_value('order_id') ?>"  name="order_id"  />
      </div>
    </div>

    <div class="form-group" style="width: 40%;float: left;">
      <label class="col-xs-3 control-label">Trạng thái </label>
      <div class="input-group">
        <span class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span>
      </span>
      <select onchange="this.form.submit();" name="status" class="form-control">
        <option value="">Tất cả</option>
        <option value="5">Đơn hàng đã nhận</option>
        <option value="6">Đơn hàng hoàn thành</option>


      </select>
    </div>
  </div>
  <div class="form-group" style="width: 80%" >
    <label class="col-xs-3 control-label">Tên khách  hàng</label>
    <div class="input-group">
      <span class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span>
    </span>
    <input  type="text" class="form-control" value="<?php echo set_value('buyer_name') ?>"  name="buyer_name"  />
  </div>
</div>


<div class="form-group">
  <div class="col-xs-6 col-xs-offset-4">
    <button type="submit" class="btn btn-default">Tìm kiếm</button>
  </div>
</div>

<div class="text-center" style=" margin-bottom: 2%;margin-top: 3%;margin-left: -5%"> <?php echo '<h4 style="color:green">'. 'Tổng số tiền khách hàng còn nợ' .' '.number_format($total_info->sum_debt, 0, '.', ',').' '.'nghìn đồng'.'</h4>'?></div>
</form>


<div class="table-responsive">
  <table class="table table-hover">
    <thead>
      <tr>
        <th class="description" style="color: blue">Mã đơn hàng</th>
        <th class="description" style="color: blue">Tên khách hàng</th>
        <th class="description" style="color: blue">Tổng tiền(VND)</th>
        <th class="description" style="color: blue">Tiền đã thanh toán(VND)</th>
        <th class="description" style="color: blue">Số tiền nợ(VND)</th>
        <th class="description" style="color: blue">Trạng thái</th>
        <th class="description" style="color: blue">Xem chi tiết</th>
      </tr>
    </thead>
    <tbody>

     <?php foreach ($list as $row):?>
       <tr>
        <td class="cart_description">
          <?php echo  $row->order_id ;  ?>
        </td>
        <td class="cart_description">
          <?php echo $row->buyer_name ?>
        </td>
        <td class="cart_description">

          <?php echo number_format($row->total_price  , 0, '.', ',')?>
        </td>

        <td class="cart_description">
         <?php if (isset($row->total_paid)) {?>
         <?php echo  number_format($row->total_paid , 0, '.', ',')?>
         <?php }else{ ?>
         <?php echo 'Chưa nhận' ?>
         <?php  }?> 
       </td>
       <td class="cart_description">
        <?php echo number_format( $row->debt  , 0, '.', ',')?>
      </td>
               <!--  <td class="cart_description">
                <?php echo mdate('%d-%m-%Y',$row->date_order)?>
              </td> -->
              <td class="cart_description">

                <?php if (isset($row->status)) {?>

                <span style="color: #0dbbde" > <?php if($row->status==1){echo 'Đơn hàng mới';}?></span>
                <span style="color: #428bca"><?php if($row->status==4){echo "Đã gửi hàng";}?></span>
                <span style="color: #d80e0a"><?php if($row->status==7){echo "Đơn hàng bị hủy";}?></span>
                <span style="color: #3bbf41" ><?php if($row->status==5){echo "Đã nhận hàng";}?></span>
                <span style="color: #fe980f"><?php if($row->status==6){echo "Đã hoàn thành";}?></span>
                <span style="color: #43c5e0" > <?php if($row->status==2){echo "Đang đàm phán";}?></span>
                <span style="color: #4d6e75"> <?php  if($row->status==3){echo "Đang xử lý";}?></span>

                <?php } ?>
              </td>
              <td> <a  href="<?php echo user_url('profile/detail_debt_shop/'.$row->order_id) ?>" class="open-list btn btn-info btn-sm">xem</a>
              </td>

            </tr>
          <?php endforeach;?> 
        </tbody>
      </table>

      <div class="clearfix"></div>
      <ul class="pagination pull-right">
        <li><?php echo $this->pagination->create_links();?></li>
      </ul>

    </div>
  </div>
</div>
