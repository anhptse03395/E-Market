<html >
<head>
	<?php 
	$this->load->view('site/head');
	?>

</head>

<body >
	<div id="header">
		<?php $this->load->view('site/header'); ?>
	</div>

	<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						
						<div style="color: red;text-align: center;font-weight:bold"> <?php echo form_error('login') ;?> </div>
						
						
						<h2>Đăng nhập bằng tài khoản</h2>
						<form action="<?php echo user_url('login') ?>" method="post">
							<input placeholder="Email Address" type="text" name="email">
							<input placeholder="Mật Khẩu" type="password" name="password">
							
							<button type="submit"  class="btn btn-default">Đăng Nhập</button>
							</br>
							<span>
								<a href="<?php echo user_url('forgotpassword') ?>">Quên mật khẩu click vào đây </a>
							</span>

						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">Hoặc</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>Đăng kí tài khoản mơi!</h2>
						<?php  $message = $this->session->flashdata('message');
						?>

						<?php if(isset($message) && $message):?>
							<div class="nNote nInformation hideit">
								<p><strong> </strong><?php echo $message?></p>
							</div>
						<?php endif;?>


						<form action="<?php echo user_url('register') ?>" method="post">
							<input placeholder="Tên" type="text" name="r_name" value="<?php echo set_value('r_name')?>">
							<div class="clear error" name="name_error"><?php echo form_error('r_name')?></div>
							<input placeholder="Email Address" type="email" name="r_email" value="<?php echo set_value('r_email')?>" >
							<div class="clear error" name="name_error"><?php echo form_error('r_email')?></div>
							<input placeholder="Số Điện Thoại" type="text" name="r_phone" value="<?php echo set_value('r_phone')?>">
							<div class="clear error" name="name_error"><?php echo form_error('r_phone')?></div>
							<input placeholder="Địa Chỉ" type="text" name="r_address" value="<?php echo set_value('r_address')?>">
							<div class="clear error" name="name_error"><?php echo form_error('r_address')?></div>
							<input placeholder="Mật Khẩu" type="password" name="r_password">
							<div class="clear error" name="name_error"><?php echo form_error('r_password')?></div>
							<input placeholder="Nhập lại mật khẩu" type="password" name="r_repassword">
							<div class="clear error" name="name_error"><?php echo form_error('r_repassword')?></div>
							<button type="submit" class="btn btn-default">Đăng Kí</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section>
	



	<link href="<?php echo public_url('user')?>/css/main.css" rel="stylesheet">
	<script src="<?php echo public_url('user')?>/js/jquery.js"></script>
	<script src="<?php echo public_url('user') ?>/js/bootstrap.min.js"></script>
	<script src="<?php echo public_url('user') ?>/js/jquery.scrollUp.min.js"></script>
	<script src="<?php echo public_url('user') ?>/js/price-range.js"></script>
	<script src="<?php echo public_url('user') ?>/js/jquery.prettyPhoto.js"></script>
	<script src="<?php echo public_url('user') ?>/js/main.js"></script>

</body>
</html>