<!DOCTYPE html>
<html >
<head>
	<link href="<?php echo public_url('site')?>/css/owl.theme.css" rel="stylesheet">
	<!-- theme stylesheet -->
	<link href="<?php echo public_url('site')?>/css/style.default.css" rel="stylesheet" id="theme-stylesheet">

	<!-- your stylesheet with modifications -->
	<link href="<?php echo public_url('site')?>/css/custom.css" rel="stylesheet">

	<script src="<?php echo public_url('site')?>/js/respond.min.js"></script>

    <link href="<?php echo public_url('user')?>/css/checkout.css" rel="stylesheet">

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
           

       });      
   </script>



   <?php 
   $this->load->view('site/head');
   ?>

</head>

<body>

	<div id="header">
		<?php $this->load->view('site/header'); ?>
	</div>

	

    <div class="container wrapper" style="margin-bottom: 10%">
        <div class="row cart-head" style="margin-top: 5%;margin-bottom: 2%">
            <div class="container">
                <div class="row">
                    <p></p>
                </div>
                <div class="row">
                    <div style="display: table; margin: auto;">
                        <span class="step step_complete"> <a href="<?php echo user_url('cart')?>" class="check-bc">Giỏ hàng</a> <span class="step_line step_complete"> </span> <span class="step_line backline"> </span> </span>
                        <span class="step step_complete"> <a href="#" class="check-bc">Đặt hàng</a> <span class="step_line "> </span> <span class="step_line step_complete"> </span> </span>
                        <span class="step_thankyou check-bc step_complete">Cảm ơn! </span>
                    </div>
                </div>
                <div class="row">
                    <p></p>
                </div>
            </div>
        </div>    
        <div class="row cart-body">
            <form class="form-horizontal" method="post" action="<?php echo user_url('order/checkout')?>">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-md-push-6 col-sm-push-6">
                    <!--REVIEW ORDER-->
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            Đơn hàng đã mua <div class="pull-right"><a  href="">Tên của hàng</a></div>
                        </div>
                        <div class="panel-body">
                          <?php foreach ($carts as $row):?>
                            <div class="form-group">
                                <div class="col-sm-3 col-xs-3">
                                    <img class="img-responsive" src="<?php echo base_url('upload/product/'.$row['image_link'])?>" />
                                </div>
                                <div class="col-sm-6 col-xs-6">
                                    <div class="col-xs-12"><?php echo $row['name'];?></div>
                                    <div class="col-xs-12"><small>Số lượng:<span style="color: blue"><?php echo $row['qty'].'Kg';?></span></small></div>
                                </div>
                                <div class="col-sm-3 col-xs-3 text-right">
                                    <h4><?php echo $row['shop_name'];?></h4>
                                </div>

                            </div>
                            <div class="form-group"><hr /></div>
                        <?php endforeach;?>


                    </div>
                </div>
                <div class="panel panel-info">
                    <div class="panel-heading" style="background-color: rgb(9, 93, 197); color: white">
                     Thông tin cửa hàng<div class="pull-right"></div>
                 </div>
                 <div style=" text-decoration: underline; margin-top: 2%;color: #fe980f;text-align: center;"> Bạn sẽ nhận được các hóa đơn từ các của hàng sau </div>
                 <table class="table table-user-information" style="width: 100%">
                  <thead>
                      <tr>
                          <td class="description" style="color: blue">Tên cửa hàng</td>
                          <td class="description" style="color: blue">Địa chỉ</td>
                          <td  class="description" style="color: blue">Chơ bán</td>
                          <td  class="description" style="color: blue">Số điện thoại</td>
                      </tr>
                  </thead>
                        
                  <tbody>
                     <?php foreach ($shops as $row):?>



                        <tr>
                            <td ><?php echo $row['shop_name'];?></td>
                            <td ><?php echo $row['local_name'];?></td>
                            <td ><?php echo $row['market_name'];?></td>
                            <td ><?php echo '0'.$row['shop_phone'];?></td>

                        </tr>
                    <?php endforeach;?>


                </tbody>
            </table>

        </div>
        <!--REVIEW ORDER END-->
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-md-pull-6 col-sm-pull-6">

        <!--CREDIT CART PAYMENT-->
        <div class="panel panel-info">
            <div class="panel-heading"><span><i class="glyphicon glyphicon-lock"></i></span> Thông tin người mua</div>
            <div class="panel-body">
               <table class="table table-user-information" >
                <tbody>
                    <tr>
                        <td style="width: 40%">Tên người mua:</td>
                        <td><?php echo $buyer->buyer_name?></td>
                    </tr>

                    <tr>
                        <td>Địa chỉ người mua</td>
                        <td><?php echo $buyer->address?></td>
                    </tr>
                    <tr>
                        <td>Số điện thoại</td>
                        <td><?php echo '0'.$buyer->phone?></td>
                    </tr>

                </tbody>
            </table>
            <hr style="color: blue;size: 1px">   </hr>
            <h3 style="margin-left: 15%">Thông tin người nhận</h3>

            <div class="form-group" style="width: 50%;float: left;">
                <div class="col-md-12"><strong>Họ tên người nhận</strong></div>
                <div class="col-md-12"><input type="text" class="form-control" name="name_receiver" value="<?php echo $buyer->name_receiver ?>" /></div>
            </div>
            <div class="form-group" style="width: 50%;float: left; margin-left: 3% ">
                <div class="col-md-12"><strong>Địa chỉ nhận hàng:</strong></div>
                <div class="col-md-12"><input type="text" class="form-control" name="address_receiver" value="<?php echo $buyer->address_receiver ?>" /></div>
            </div>
            <div class="form-group" style="width: 50%;">
                <div class="col-md-12"><strong>Số điện thoại:</strong></div>
                <div class="col-md-12"><input type="text" class="form-control" name="phone_receiver" value="<?php if($buyer->phone_receiver!=0) echo '0'.$buyer->phone_receiver ?>" /></div>
                <div class="clear error" style="color: red" name="name_error"><?php echo form_error('phone_receiver') ?></div>


            </div>

            <div class="form-group" style="width: 43%;margin-left: 0.8%">
                <label for="email">
                    Ngày nhận hàng dự kiến</label>
                    <div class="input-group input-append date" id="datePicker" >
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>
                    <input type="text" class="form-control"  name="date_receive" value="<?php echo set_value('date_receive') ?>"  />

                </div>
                <div class="clear error" style="color: red" name="name_error"><?php echo form_error('date_receive') ?></div>

            </div>


            <div class="form-group">

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

                    <label for="email">Nội dung đặt hàng</label>
                    <textarea type="text" rows="3" cols="10"  sclass="form-control" name="message"></textarea>
                </div>
                   <div class="clear error" style="color: red" name="name_error"><?php echo form_error('message') ?></div>

            </div>

            <div class="box-footer">
                <div class="pull-left">
                    <a href="<?php echo user_url('cart')?>" class="btn btn-info"><i class="fa fa-chevron-left"></i>Chỉnh sửa đơn hàng</a>
                </div>
                <div class="pull-right">
                    <button type="submit" class="btn btn-success">Đặt hàng<i class="fa fa-chevron-right"></i>
                    </button>
                </div>
                </div
            </div>
        </div>
        <!--CREDIT CART PAYMENT END-->
    </div>

</form>
</div>
<div class="row cart-footer" >

</div>
</div>





</body>




</html>
