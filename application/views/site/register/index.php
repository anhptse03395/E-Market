<html>


<style type="text/css">
	.cuadro_intro_hover{
    	padding: 0px;
		position: relative;
		overflow: hidden;
		height: 200px;
	}
	.cuadro_intro_hover:hover .caption{
		opacity: 1;
		transform: translateY(-150px);
		-webkit-transform:translateY(-150px);
		-moz-transform:translateY(-150px);
		-ms-transform:translateY(-150px);
		-o-transform:translateY(-150px);
	}
	.cuadro_intro_hover img{
		z-index: 4;
	}
	.cuadro_intro_hover .caption{
		position: absolute;
		top:150px;
		-webkit-transition:all 0.3s ease-in-out;
		-moz-transition:all 0.3s ease-in-out;
		-o-transition:all 0.3s ease-in-out;
		-ms-transition:all 0.3s ease-in-out;
		transition:all 0.3s ease-in-out;
		width: 100%;
	}
	.cuadro_intro_hover .blur{
		background-color: rgba(0,0,0,0.7);
		height: 300px;
		z-index: 5;
		position: absolute;
		width: 100%;
	}
	.cuadro_intro_hover .caption-text{
		z-index: 10;
		color: #fff;
		position: absolute;
		height: 300px;
		text-align: center;
		top:-20px;
		width: 100%;
	}
</style>
<head>


	<!-- Website CSS style -->
	<link href="<?php echo public_url('user') ?>/css/bootstrap.min.css" rel="stylesheet">

	<!-- Website Font style -->
	<link rel="<?php echo public_url('user') ?>/css.register.css" href="style.css">
	<!-- Google Fonts -->



	<?php 
	$this->load->view('site/head');
	?>

</head>

<body >
	<div id="header">
		<?php $this->load->view('site/header'); ?>
	</div>
	<div class="container">
	<div class="row" style="margin-left: 25%">
		<h2  style="color: #b48608; font-family: 'Droid serif', serif; font-size: 36px; font-weight: 400; font-style: italic; line-height: 44px; margin: 0 0 12px;  ">Chọn loại tài khoản đăng ký </h2>
       
	</div>
    <div class="row" style="margin-left: 23%;margin-top: 5%">
    	<div class="col-lg-3">
    				<div class="cuadro_intro_hover " style="background-color:#cccccc;">
						<p style="text-align:center; margin-top:20px;">
							<img src="<?php echo public_url('user/images/seller.png') ?>" class="img-responsive" alt="">
						</p>
						<div class="caption">
							<div class="blur"></div>
							<div class="caption-text">
								<h3 style="border-top:2px solid blue; border-bottom:2px solid blue; padding:10px;">Người bán</h3>
								
								<a class=" btn btn-default" href="<?php echo user_url('register/shop') ?>"><span class="glyphicon glyphicon-home ">Chọn</span></a>
							</div>
						</div>
					</div>
				
	    </div>
     
     
        <div class="col-lg-3">
        			<div class="cuadro_intro_hover " style="background-color:#cccccc;">
						<p style="text-align:center; margin-top:20px;">
							<img src="<?php echo public_url('user/images/buyer.png') ?>" class="img-responsive" alt="">
						</p>
						<div class="caption">
							<div class="blur"></div>
							<div class="caption-text">
								<h3 style="border-top:2px solid white; border-bottom:2px solid white; padding:10px;">Người mua</h3>
							
								<a class=" btn btn-default" href="<?php echo user_url('register/buyer') ?>"><span class="glyphicon glyphicon-user">Chọn</span></a>
							</div>
						</div>
					</div>
				
	    </div>
    </div>
</div>
        

</div>






		<link href="<?php echo public_url('user')?>/css/main.css" rel="stylesheet">
		<script src="<?php echo public_url('user')?>/js/jquery.js"></script>
		<script src="<?php echo public_url('user') ?>/js/bootstrap.min.js"></script>
		<script src="<?php echo public_url('user') ?>/js/jquery.scrollUp.min.js"></script>
		<script src="<?php echo public_url('user') ?>/js/price-range.js"></script>
		<script src="<?php echo public_url('user') ?>/js/jquery.prettyPhoto.js"></script>
		<script src="<?php echo public_url('user') ?>/js/main.js"></script>

	</body>
	</html>