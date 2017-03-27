<html >

<head>
<link href="<?php echo public_url('user')?>/css/login.css" rel="stylesheet">
	<?php 
	$this->load->view('site/head');
	?>

</head>

<body >
	<div id="header">
		<?php $this->load->view('site/header'); ?>
	</div>


    <div class="container">
            <?php  $message = $this->session->flashdata('message');
                        ?>
                        <?php if(isset($message) && $message):?>
                            <div class="alert alert-success">
                                <h3 style="text-align: center;"><strong> </strong><?php echo $message?></h3>
                            </div>
                        <?php endif;?>

        <div class="omb_login">
            <h3 class="omb_authTitle">Đăng Nhập <a href="<?php echo user_url('register/kind_account') ?>">Đăng ký</a></h3>


            <div class="row omb_row-sm-offset-3 omb_loginOr">
                <div class="col-xs-12 col-sm-6">
                    <hr class="omb_hrOr">
                    <span class="omb_spanOr">Hoặc</span>
                </div>
            </div>
                <div style="color: red;text-align: center;font-weight:bold"> <?php echo form_error('login') ;?> </div>
                        

            <div class="row omb_row-sm-offset-3">
                <div class="col-xs-12 col-sm-6">    
                    <form class="omb_loginForm" action="<?php echo user_url('login') ?>" method="POST">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" class="form-control" name="email" placeholder="email address">
                        </div>
                        <span class="help-block"></span>

                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input  type="password" class="form-control" name="password" placeholder="Password">
                        </div>
                       
                        <button class="btn btn-lg btn-primary btn-block" type="submit">Đăng Nhập</button>
                    </form>
                </div>
            </div>
            <div class="row omb_row-sm-offset-3">
              
                <div class="col-xs-12 col-sm-3">
                    <p class="omb_forgotPwd">
                        <a href="<?php echo user_url('forgotpassword') ?>">Quên mật khẩu?</a>
                    </p>
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
    <script src="<?php echo public_url('user') ?>/js/login.js"></script>
</body>
</html>