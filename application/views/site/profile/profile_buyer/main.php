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

	</body>
	</html>