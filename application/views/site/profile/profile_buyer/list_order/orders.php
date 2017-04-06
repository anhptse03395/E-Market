
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
    <h3>Đơn hàng của tôi</h3>

    <form id="eventForm" action="<?php echo user_url('profile/search_order_buyer') ?>" method="post" class="form-horizontal">

      <div class="form-group" style="width: 60%;margin-left: 15%">
        <label class="col-xs-3 control-label">Mã đơn hàng </label>
        <div class="input-group"> 
          <span class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span>
        </span>
        <input  type="text" class="form-control" name="order_id" style="width: 50%" />
      </div>
    </div>


    <div class="form-group" style="float: left;width: 50%">
      <label class="col-xs-3 control-label">Từ ngày</label>
      <div class="col-xs-5 date" >
        <div class="input-group input-append date" id="datePicker" >
          <input  type="text" class="form-control"  name="from_date"  />
          <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar " ></span></span>
        </div>
      

      </div>
    </div> 


    <div class="form-group" style="float: left;width: 50%">
      <label class="col-xs-3 control-label">Đến ngày</label>
      <div class="col-xs-5 date" >
        <div class="input-group input-append date" id="datePicker1">
          <input  type="text" class="form-control" name="end_date" />
          <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
        </div>
      
      </div>
    </div>


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
          <th>Mã số</th>
          <th>Ngày đặt hàng</th>
          <th>Tổng số tiền</th>
          <th>Nội dung</th>
          <th>Xem chi tiết</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($list as $row):?>
          <tr>
            <th><?php echo $row->order_id?></th>
            <td> <?php echo mdate('%d-%m-%Y',$row->date_order)?></td>
            <td> <?php echo $row->total_price?> </td>

            <td> <?php echo $row->description?> </td>

            <td><a href="<?php echo user_url('profile/list_order_details/'.$row->order_id) ?>" class="btn btn-info btn-sm">xem</a>
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
