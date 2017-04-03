<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('site/profile/profile_buyer/head') ?>


</head>
<body>
	<?php $this->load->view('site/head') ?>
	<?php $this->load->view('site/header') ?>

	<div class="container">
		<div class="row profile">
			<div class="col-md-3">
                <?php $this->load->view('site/profile/profile_buyer/left',$this->data) ?>
				<div class="col-md-9 order-content" style="float: left; width: 75%">

				<?php $this ->load->view($temp,$this->data) ?>

				</div>


			</div>
		</div>
	</div>

		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="<?php echo public_url('user')?>/js/bootstrap.min.js"></script>
	</body>
	</html>