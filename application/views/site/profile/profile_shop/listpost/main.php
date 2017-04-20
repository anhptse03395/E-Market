
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
<div class="container" style="width: 100%">
	<div class="row">
		

    <div class="col-md-12">
      <h4 style="color: #388494">Danh sách bài đăng của bạn</h4>
    
  
          <form id="eventForm" action="<?php echo user_url('profile/search_post') ?>" method="post" class="form-horizontal">

            <div class="form-group" style="width: 60%;margin-left: 15%">
              <label class="col-xs-3 control-label " style="">Tên sản phẩm </label>
              <div class="input-group"> 
                <span class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span>
              </span>
              <input  type="text" class="form-control" name="product_name" value="<?php echo set_value('product_name') ?>" style="width: 50%" />
            </div>
          </div>


          <div class="form-group" style="float: left;width: 50%">
            <label class="col-xs-3 control-label" style="">Từ ngày</label>
            <div class="col-xs-5 date" >
              <div class="input-group input-append date" id="datePicker" >
                <input  type="text" class="form-control" value="<?php echo set_value('from_date') ?>"  name="from_date"  />
                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar " ></span></span>
              </div>


            </div>
          </div> 


          <div class="form-group" style="float: left;width: 50%">
            <label class="col-xs-3 control-label" style="">Đến ngày</label>
            <div class="col-xs-5 date" >
              <div class="input-group input-append date" id="datePicker1">
                <input  type="text" class="form-control" value="<?php echo set_value('end_date') ?>" name="end_date" />
                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
              </div>

            </div>
          </div>


          <div class="form-group">
            <div class="col-xs-6 col-xs-offset-4">
              <button type="submit" class="btn btn-info">Tìm kiếm</button>

            </div>
          </div>
  
  <a  href="<?php echo user_url('profile/addproduct') ?>" class="btn btn-success loading" style="margin-left:13% " >Thêm sản phẩm</a>

  <a href="<?php echo user_url('profile/search_post') ?>" class="btn btn-warning loading" style="margin-left:20% ">Xem tất cả</a>
          <?php $this->load->view($temp1,$this->data) ?>

  </div>
</div>
</div>




