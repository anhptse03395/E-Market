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

						<?php  $message = $this->session->flashdata('message');
						?>

						<?php if(isset($message) && $message):?>
							<div class="nNote nInformation hideit">
								<p><strong> </strong><?php echo $message?></p>
							</div>
						<?php endif;?>
						

						<h2>Gửi email đã đăng kí</h2>
						<form action="<?php echo user_url('forgotpassword') ?>" method="post">
							<input placeholder="Email Address" type="text" name="forgot_email">
							<div class="clear error" name="name_error"><?php echo form_error('forgot_email')?></div>
							<button type="submit"  class="btn btn-default">Gui</button>
							
						</form>
					</div><!--/login form-->
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