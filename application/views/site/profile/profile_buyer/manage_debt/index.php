
<script src="<?php echo public_url('user/home') ?>/js/main.js"></script>
<script type="text/javascript" src="<?php echo public_url('user/home') ?>/js/moment-2.4.0.js"></script>
<script src="<?php echo public_url('user/home') ?>/js/bootstrap-datetimepicker.min.js"></script>
<link href="<?php echo public_url('user/home')?>/css/bootstrap-datetimepicker.css" rel="stylesheet">


<script type="text/javascript">
    $(function() {
        // Bootstrap DateTimePicker v4
        $('#datePicker').datetimepicker({
            format: 'DD/MM/YYYY',


        });
        $('#datePicker1').datetimepicker({
            format: 'DD/MM/YYYY',


        });

    });
</script>


<div class="col-md-9" id="customer-orders" style="width: 100%">
    <div class="box">
        <h3>Công nợ</h3>
        <?php  
        $total_debt =0; 
            foreach ($list as $row) {
               $total_debt =   $total_debt + $row->debt;
            }

            
        ?>
        <div class="text-center" style="margin-bottom: 10%"> <?php echo 'Số tiền còn nợ' .' '.number_format($total_debt, 0, '.', ',').' '.'nghìn đồng'?></div>

        <form id="eventForm" action="<?php echo user_url('profile/search_debt_buyer') ?>" method="post" class="form-horizontal">

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
                <option value="1">Đơn hàng còn nợ</option>
                <option value="2">Đơn hàng trả xong</option>


            </select>
        </div>
    </div>
      <div class="form-group" style="width: 80%" >
                <label class="col-xs-3 control-label">Tên khách hàng</label>
                <div class="input-group">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span>
                </span>
                <input  type="text" class="form-control" value="<?php echo set_value('shop_name') ?>"  name="shop_name"  />
            </div>
        </div>


<!--     <div class="form-group" style="float: left;width: 50%">
    <label class="col-xs-3 control-label">Từ ngày</label>
    <div class="col-xs-5 date" >
        <div class="input-group input-append date" id="datePicker" >
            <input  type="text" class="form-control" value="<?php echo set_value('from_date') ?>"  name="from_date"  />
            <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar " ></span></span>
        </div>


    </div>
</div>

 -->
 <!--    <div class="form-group" style="float: left;width: 50%">
     <label class="col-xs-3 control-label">Đến ngày</label>
     <div class="col-xs-5 date" >
         <div class="input-group input-append date" id="datePicker1">
             <input  type="text" class="form-control" value="<?php echo set_value('end_date') ?>"  name="end_date" />
             <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
         </div>
 
     </div>
 </div>
  -->

    <div class="form-group">
        <div class="col-xs-6 col-xs-offset-4">
            <button type="submit" class="btn btn-default">Tìm kiếm</button>
        </div>
    </div>
</form>


<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th class="description" style="color: blue">Mã đơn hàng</th>
                <th class="description" style="color: blue">Tên cửa  hàng</th>
                <th class="description" style="color: blue">Tổng tiền</th>
                <th class="description" style="color: blue">Tiền đã thanh toán</th>
                <th class="description" style="color: blue">Số tiền nợ</th>
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
              <?php echo $row->shop_name?>
          </td>
          <td class="cart_description">
              <?php echo number_format($row->total_price, 0, '.', ',') ?>
          </td>
          
          <td class="cart_description">
           <?php  echo number_format($row->total_paid, 0, '.', ',')?>

       </td>
       <td class="cart_description">
          <?php echo number_format($row->debt, 0, '.', ',')?>
      </td>
               <!--  <td class="cart_description">
                <?php echo mdate('%d-%m-%Y',$row->date_order)?>
            </td> -->
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
              <td> <a  href="<?php echo user_url('profile/detail_debt_buyer/'.$row->order_id) ?>" class="open-list btn btn-info btn-sm">xem</a>
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
