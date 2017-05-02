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

                <div class="col-md-9" id="basket" style="width: 60%">

                    <div class="box">

                        <form method="post" action="<?php echo user_url('cart/update')?>">

                            <h1 style="color: #224e46">Đặt hàng</h1>
                            <p class="text-muted">Đơn hàng của bạn</p>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th colspan="2">Sản phẩm</th>
                                            <th>Số lượng</th>
                                       
                                       <th >Xóa</th>
                                   </tr>
                               </thead>

                               <tbody>
                              
                                <?php foreach ($carts as $row):?>
                                   
                                    <tr>
                                        <td>
                                            <a href="#">
                                                <img src="<?php echo base_url('upload/product/'.$row['image_link'])?>" alt="White Blouse Armani">
                                            </a>
                                        </td>
                                        <td><a href="#"><?php echo $row['name'].'('.$row['shop_name'].')' ?></a>
                                        </td>
                                        <td>
                                            <?php $qty = 'qty'.$row['id']

                                            ?>
                                            <input name="qty_<?php echo $row['id']?>" value="<?php echo $row['qty'];?>" />
                                            <span> /Kg</span>
                                          <div style="color: red"><?php echo form_error('qty_'.$row['id']) ?></div>
                                        </td>

                                             
                                          <td ><a href="<?php echo user_url('cart/del/'.$row['id'])?>"><i class="fa fa-trash-o" style="margin-left: 20px"></i></a>
                                          </td>
                                      </tr>
                                  <?php endforeach;?>

                              </tbody>
                                
                              </table>

                          </div>
                          <!-- /.table-responsive -->

                          <div class="box-footer">
                            <div class="pull-left">
                                <a href="<?php echo user_url('listproduct/search')?>" class="btn btn-info"><i class="fa fa-chevron-left"></i>Chọn mặt hàng khác</a>
                            </div>
                            
                              <div class="pull-right" style="margin-left: 10%">
                                <a  href="<?php echo user_url('order/checkout')?>" class="btn btn-success"><i class="fa fa-chevron-right"></i> Đặt hàng</a>
                            </div>

                            <div class="pull-right " >
                                <button class="btn btn-toolbar" type="submit"><i class="glyphicon glyphicon-calendar"></i>Cập nhật giỏ hàng</button>

                            </div>
                          

                        </div>

                    </form>

                </div>
                <!-- /.box -->





            </div>

            <div class="col-md-3" style="width: 40%">
                <div class="box" id="order-summary">
                    <div class="box-header">
                        <h3 style="color: rgba(116, 254, 15, 0.81)">Giỏ hàng của bạn</h3>
                    </div>
            


                    <div class="table-responsive cart_info">
                        <table class="table table-condensed">

                            <div class="well-searchbox">

                            </div>
                            <thead>
                                <tr class="cart_menu">
                                    <td class="description" style="color: blue">Hình ảnh</td>
                                    <td class="description" style="color: blue" >Tên sản phẩm</td>
                                    <td class="description" style="color: blue" >Số lượng(Kg)</td>
                                    <td class="description" style="color: blue" >Cửa hàng</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($carts as $row):?>
                                    <tr>
                                        <td class="cart_description">
                                            <img  height="70"  src="<?php echo base_url('upload/product/'.$row['image_link'])?>" alt="">
                                           
                                        </td >
                                        
                                        <td class="cart_description">
                                         <h6 style="color: orange"><?php echo $row['name'];?></h6>
                                            
                                        </td>
                                        <td class="cart_description">
                                        <h6 style="color: blue"><?php echo $row['qty'].'Kg';?></h6>
                                            
                                        </td>
                                        <td class="cart_description">
                                         <h6 style="color: green"><?php echo $row['shop_name'];?></h6>
                                            
                                        </td>
                                    </tr>     
                                        <?php endforeach;?>
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
