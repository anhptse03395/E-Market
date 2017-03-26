<!DOCTYPE html>
<html >
<head>
	<link href="<?php echo public_url('site')?>/css/font-awesome.css" rel="stylesheet">

	<link href="<?php echo public_url('site')?>/css/owl.theme.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100' rel='stylesheet' type='text/css'>
	<!-- theme stylesheet -->
	<link href="<?php echo public_url('site')?>/css/style.default.css" rel="stylesheet" id="theme-stylesheet">

	<!-- your stylesheet with modifications -->
	<link href="<?php echo public_url('site')?>/css/custom.css" rel="stylesheet">

	<script src="<?php echo public_url('site')?>/js/respond.min.js"></script>


	<?php 
	$this->load->view('site/head');
	?>

</head>

<body>

	<div id="header">
		<?php $this->load->view('site/header'); ?>
	</div>

	<div id="all">

		<div id="content">
			<div class="container">

             <div class="col-md-12">
                <ul class="breadcrumb">
                    <li><a href="#">Trang chủ</a>
                    </li>
                    <li>Địa chỉ-Thanh toán</li>
                </ul>
            </div>

            <div class="col-md-9" id="checkout">

                <div class="box">
                    <form method="post" action="<?php echo user_url('order/checkout')?>">
        
                        <ul class="nav nav-pills nav-justified">
                    
                            <li class="active"><a href="#"><i class="fa fa-money"></i><br>Thanh toán</a>
                            </li>
                        </ul>
                       

                        <div class="content">
                         
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="firstname">Tên</label>
                                        <input type="text"  value="<?php echo $buyer->buyer_name?>"  readonly="readonly" class="form-control" name="name">
                                    </div>
                                </div>
                                                             
                            </div>
                            <!-- /.row -->

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="company">Email</label>
                                        <input type="text" value="<?php echo $buyer->buyer_email?>"  readonly="readonly" class="form-control" name="email">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="phone">Số điện thoại</label>
                                        <input type="text" value="<?php echo $buyer->phone?>"  class="form-control" name="phone">
                                    </div>
                                </div>
                                
                            </div>
                       
                            <!-- /.row -->

                            <div class="row">
                                
                               
                                <div class="col-sm-6 col-md-3">
                                    <div class="form-group">
                                        <label for="state">Cổng thanh toán</label>
                                        <select class="form-control" name="payment"></select>
                                    </div>
                                </div>
                              

                                
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="email">Nội dung</label>
                                        <textarea type="text" rows="3" cols="10"  sclass="form-control" name="message"></textarea>
                                    </div>
                                </div>

                            </div>
                            <!-- /.row -->
                        </div>

                        <div class="box-footer">
                            <div class="pull-left">
                                <a href="basket.html" class="btn btn-default"><i class="fa fa-chevron-left"></i>Trở lại đặt hàng</a>
                            </div>
                            <div class="pull-right">
                                <button type="submit" class="btn btn-primary">Thanh Toán<i class="fa fa-chevron-right"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.box -->


            </div>
             <!-- /.col-md-9 -->



            <div class="col-md-3">
                <div class="box" id="order-summary">
                    <div class="box-header">
                        <h3>Order summary</h3>
                    </div>
                    <p class="text-muted">Shipping and additional costs are calculated based on the values you have entered.</p>

                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Order subtotal</td>
                                    <th>$446.00</th>
                                </tr>
                                <tr>
                                    <td>Shipping and handling</td>
                                    <th>$10.00</th>
                                </tr>
                                <tr>
                                    <td>Tax</td>
                                    <th>$0.00</th>
                                </tr>
                                <tr class="total">
                                    <td>Total</td>
                                    <th>$456.00</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>



            </div>

        </div>
    </div>








</body>

<script src="<?php echo public_url('site')?>/js/jquery-1.11.0.min.js"></script>
<script src="<?php echo public_url('site')?>/js/bootstrap.min.js"></script>

<script src="<?php echo public_url('site')?>/js/jquery.cookie.js"></script>
<script src="<?php echo public_url('site')?>/js/waypoints.min.js"></script>
<script src="<?php echo public_url('site')?>/js/modernizr.js"></script>
<script src="<?php echo public_url('site')?>/js/bootstrap-hover-dropdown.js"></script>
<script src="<?php echo public_url('site')?>/js/owl.carousel.min.js"></script>
<script src="<?php echo public_url('site')?>/js/front.js"></script>



<script src="<?php echo public_url('user') ?>/js/jquery.scrollUp.min.js"></script>
<script src="<?php echo public_url('user') ?>/js/price-range.js"></script>
<script src="<?php echo public_url('user') ?>/js/jquery.prettyPhoto.js"></script>
<script src="<?php echo public_url('user') ?>/js/main.js"></script>


</html>
