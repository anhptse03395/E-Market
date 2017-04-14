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

				<div class="col-md-9" style="margin-left:10% ">

					<div class="row" id="productMain">
						<div class="col-sm-6">
							<div id="mainImage">
								<img src="<?php echo base_url('upload/product/'.$product->image_link)?>" style="width: 450px;height: 400px" alt="" class="img-responsive">

							</div>
							

						</div>
						<div class="col-sm-6">
							<div class="box" style="background: rgba(230, 158, 23, 0.04);" >
								<ul style="color: rgba(26, 15, 109, 0.78)">

									<li style=" font-size: 20px"  ><i class="glyphicon glyphicon-record"></i> Tên sản phẩm:<?php echo $product->product_name?></li>

									<li  style="margin-top: 10px; font-size: 20px"> <i class="glyphicon glyphicon-user"></i>  <a href="<?php echo user_url('listproduct/product_detail_shop/'.$product->shop_id)?>"> Người đăng: <?php echo  $product->shop_name ?>
									</a></li>
									<li style="margin-top: 10px; font-size: 20px"><i class="glyphicon glyphicon-time"></i> Ngày đăng:     <?php  	echo  mdate('%d-%m-%Y',$product->product_created);?></li>
									<li style="margin-top: 10px; font-size: 20px" ><i class="glyphicon glyphicon-home"></i> Địa chỉ : <?php echo $product->address ?></li>
									<li style="margin-top: 10px; font-size: 20px"><i class="glyphicon glyphicon-phone-alt"></i> Số điện thoại : 0<?php echo $product->phone?></li>
									<li style="margin: 10px 5px; font-size: 20px ;cursor:pointer; text-decoration:underline;" data-toggle="collapse" data-target="#info"><i class="glyphicon glyphicon-chevron-right"></i>Các thông tin khác</li>

									<div id="info" class="collapse">
									<li  style="margin-top: 10px ; font-size: 20px"> <i class="glyphicon glyphicon-qrcode"></i> Mã sản phẩm : <?php echo $product->product_id?></li>
										<li  style="margin-top: 10px ; font-size: 20px"> <i class="glyphicon glyphicon-tree-deciduous"></i> Loại sản phẩm : <?php echo $category->category_name?></li>
										<li  style="margin-top: 10px; font-size: 20px"><i class="fa fa-truck"></i> Nhà sản xuất : <?php echo 'Ecopark' ?></li>
										<li  style="margin-top: 10px; font-size: 20px"> <i class="glyphicon glyphicon-tower"></i> Địa điểm chợ : <?php echo $market->market_name?></li>
										<li  style="margin-top: 10px; font-size: 20px"> <i class="glyphicon glyphicon-map-marker"></i> Tỉnh thành : <?php echo $province->local_name?></li>
									</div>
								</ul>
								<p class="text-center buttons">
									<a href="<?php echo user_url('cart/add/'.$product->product_id)?>" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Đăt Hàng </a>

								</p>

							</div>
							<div class="row" style="" id="thumbs">

								<?php if(is_array($image_list)):?>
									<?php foreach ($image_list as $img):?>
										<div class="col-xs-4">
											<a href="<?php echo base_url('upload/product/'.$img)?>" class="thumb">
												<img src="<?php echo base_url('upload/product/'.$img)?>" style="width: 120px;height: 100px" alt="" class="img-responsive">
											</a>
										</div>
									<?php endforeach;?>
								<?php endif;?>


							</div>

							
						</div>

					</div>


					<div class="box" id="details">
						<h4 style="color: blue"> Mô tả</h4>

						<blockquote>
							<p><em><?php echo $product->description?></em>
							</p>
						</blockquote>

						<hr>

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
