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
							<div class="box">
								<h3 class="text-center"><?php echo $product->product_name?></h3>
								 <?php echo '</br>'.'<p style="margin-left: 33%;margin-top:1px">'.'Người đăng:'. $product->shop_name.'</p>'  ?>
								<?php  	echo '</br>'.'<h6 style="margin-left: 33%">'.'ngày đăng'.' :'. mdate('%d-%m-%Y',$product->product_created).'</h6>';?>
								<?php echo '</br>'.'<h3 style="margin-left: 33%;margin-top:">'.'Địa chỉ:'. $product->address.'</h3>'  ?>
								<p class="price"><?php echo 'SĐT'.':' .$product->phone ?></p>

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
						<p>
							
							<blockquote>
								<p><em><?php echo $product->content ?></em>
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
