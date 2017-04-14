
<style>
  .center {
    margin-top:50px;   
}

.modal-header {
  padding-bottom: 5px;
}

.modal-footer {
      padding: 0;
  }
    
.modal-footer .btn-group button {
  height:40px;
  border-top-left-radius : 0;
  border-top-right-radius : 0;
  border: none;
  border-right: 1px solid #ddd;
}
  
.modal-footer .btn-group:last-child > button {
  border-right: 0;
}
</style>


<script src="<?php echo public_url('user/home') ?>/js/main.js"></script>
<script type="text/javascript" src="<?php echo public_url('user/home') ?>/js/moment-2.4.0.js"></script>
<script src="<?php echo public_url('user/home') ?>/js/bootstrap-datetimepicker.min.js"></script>
<link href="<?php echo public_url('user/home')?>/css/bootstrap-datetimepicker.css" rel="stylesheet">
<link href="<?php echo public_url('user/home')?>/css/bootstrap.min.css" rel="stylesheet">
<script src="<?php echo public_url('user/home') ?>/js/bootstrap.min.js"></script>



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
        <h4 style="color: #2ca6a7">Đơn hàng của khách</h4>

          <form id="eventForm" action="<?php echo user_url('profile/search_order_shop') ?>" method="post" class="form-horizontal">

            <div class="form-group" style="width: 60%;margin-left: 15%">
              <label class="col-xs-3 control-label" style="color: rgba(32, 86, 171, 0.96)" >Mã đơn hàng </label>
              <div class="input-group"> 
                <span class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span>
              </span>
              <input  type="text" class="form-control"  name="order_id" value="<?php echo set_value('order_id') ?>" style="width: 50%" />
            </div>
          </div>



          <div class="form-group" style="float: left;width: 50%">
            <label class="col-xs-3 control-label" style="color: #7ade0f" >Từ ngày</label>
            <div class="col-xs-5 date" >
              <div class="input-group input-append date" id="datePicker" >
                <input  type="text" value="<?php echo set_value('from_date')  ?>"  class="form-control"  name="from_date"  />
                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar " ></span></span>
              </div>


            </div>
          </div> 


          <div class="form-group" style="float: left;width: 50%">
            <label class="col-xs-3 control-label" style="color: #fe980f" >Đến ngày</label>
            <div class="col-xs-5 date" >
              <div class="input-group input-append date" id="datePicker1">
                <input  type="text" value="<?php echo set_value('end_date') ?>"  class="form-control" name="end_date" />
                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
              </div>

            </div>
          </div>


          <div class="form-group">
            <div class="col-xs-6 col-xs-offset-4">
              <button type="submit" class="btn btn-info">Tìm kiếm</button>
            </div>
          </div>
        </form>


        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th class="description" style="color: blue" >Mã số</th>
              
                <th class="description" style="color: blue">Người mua</th>
                <th class="description" style="color: blue">Số tiền</th>
                <th class="description" style="color: blue">Nội dung</th>
                <th class="description" style="color: blue">Ngày đặt</th>
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
                  <?php echo $row->buyer_name?>
                </td>
                <td class="cart_description">
                  <?php if (isset($row->total_price)) {?>
              <?php if($row->total_price==0) { ?>
                      <?php echo '<strong style="color:#fe950f">'.'Thương lượng'.'</strong>' ?>
                    <?php } ?>

            <?php if($row->total_price>0) { ?>
                      <?php echo $row->total_price ?>
                    <?php } ?>
          <?php } ?>

                </td>
                <td class="cart_description">
                  <?php echo $row->description?>
                </td>
                <td class="cart_description">
                 <?php echo mdate('%d-%m-%Y',$row->date_order)?>
               </td>
               <td class="cart_description">

                <?php if (isset($row->status)) {?>

                <span class="label label-danger"><?php if($row->status==3){echo "Đơn hàng bị hủy";}?></span>  <span class="label label-info"> <?php if($row->status==0){echo "Đơn hàng mới";}?>
                <span class="label label-info"> <?php if($row->status==1){echo "Đang xử lý";}?>
                 <span class="label label-success"> <?php  if($row->status==2){echo "Đã gửi hàng";}
                  ?></span>

                  <?php } ?>
                </td>
                <td> <a  href="<?php echo user_url('profile/detail_order_shop/'.$row->order_id) ?>" class="open-list btn btn-info btn-sm">xem</a>
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


<!-- Modal -->

