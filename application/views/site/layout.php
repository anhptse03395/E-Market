<!DOCTYPE html>
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

		<section id="slider">
			<?php $this->load->view('site/slider'); ?>
		</section>
		<section>
					
		</section>
		

</body>
<footer id="footer">
	<?php $this->load->view('site/footer') ?>

</footer>
    <script src="<?php echo public_url('user') ?>/js/jquery.prettyPhoto.js"></script>
</html>