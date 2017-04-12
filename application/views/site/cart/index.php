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

                            <h1>Đặt hàng</h1>
                            <p class="text-muted">Đơn hàng của bạn</p>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th colspan="2">Sản phẩm</th>
                                            <th>Số lượng</th>
                                       <!--      <th>Giá đã thương lượng</th>
                                                                                 
                                       <th >Tổng tiền</th> -->
                                       <th >Xóa</th>
                                   </tr>
                               </thead>

                               <tbody>
                                <?php $total_amount = 0;?>
                                <?php foreach ($carts as $row):?>
                                    <?php $total_amount = $total_amount + $row['subtotal'];?>
                                    <tr>
                                        <td>
                                            <a href="#">
                                                <img src="<?php echo base_url('upload/product/'.$row['image_link'])?>" alt="White Blouse Armani">
                                            </a>
                                        </td>
                                        <td><a href="#"><?php echo $row['name'] ?></a>
                                        </td>
                                        <td>
                                            <?php $qty = 'qty'.$row['id']

                                            ?>
                                            <input name="qty_<?php echo $row['id']?>" value="<?php echo $row['qty'];?>" />
                                            <span> /Kg</span>
                                        </td>

                                              <!--   <td> <input type="hidden" name="price_<?php echo $row['id']?>" value="<?php echo $row['price'];?>" size="5"/>
                                               <span> Đồng</span>
                                              
                                              </td>
                                          -->
                                          <!--  <td><?php echo $row['subtotal']; ?></td> -->
                                          <td ><a href="<?php echo user_url('cart/del/'.$row['id'])?>"><i class="fa fa-trash-o" style="margin-left: 20px"></i></a>
                                          </td>
                                      </tr>
                                  <?php endforeach;?>

                              </tbody>
                                  <!--   <tfoot>
                                      <tr>
                                          <th colspan="5">Tổng số tiền</th>
                                          <th colspan="2"><?php echo number_format($total_amount)?>đ</th>
                                      </tr>
                                  </tfoot> -->
                              </table>

                          </div>
                          <!-- /.table-responsive -->

                          <div class="box-footer">
                            <div class="pull-left">
                                <a href="<?php echo user_url('listproduct/search')?>" class="btn btn-info"><i class="fa fa-chevron-left"></i> Trở lại đặt hàng</a>
                            </div>
                            <div class="pull-right " style="margin-left: 10%">
                                <button class="btn btn-toolbar" type="submit"><i class="glyphicon glyphicon-calendar"></i>Thêm vào giỏ hàng</button>

                            </div>
                            <div class="pull-right" >
                                <a  href="<?php echo user_url('order/checkout')?>" class="btn btn-success"><i class="fa fa-chevron-right"></i> Thanh toán</a>
                            </div>


                        </div>

                    </form>

                </div>
                <!-- /.box -->





            </div>

            <div class="col-md-3" style="width: 40%">
                <div class="box" id="order-summary">
                    <div class="box-header">
                        <h3>Giỏ hàng của bạn</h3>
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
                                        <?php echo $row['name'];?>
                                            
                                        </td>
                                        <td class="cart_description">
                                        <?php echo $row['qty'].'Kg';?>
                                            
                                        </td>
                                        <td class="cart_description">
                                        <?php echo $row['shop_name'];?>
                                            
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
