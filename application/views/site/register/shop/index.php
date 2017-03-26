<html >
<head>


	<!-- Website CSS style -->
	<link href="<?php echo public_url('user') ?>/css/bootstrap.min.css" rel="stylesheet">

	<!-- Website Font style -->
	>
	<link rel="<?php echo public_url('user') ?>/css.register.css" href="style.css">
	<!-- Google Fonts -->

	<title>Admin</title>



	<?php 
	$this->load->view('site/head');
	?>

</head>

<body >
	<div id="header">
		<?php $this->load->view('site/header'); ?>
	</div>
	<div class="container" style="width: 40%">
		<div class="row main">
			<div class="main-login main-center">
				<h5>	<?php  $message = $this->session->flashdata('message');
					?>

					<?php if(isset($message) && $message):?>
						<div class="nNote nInformation hideit">
							<p><strong> </strong><?php echo $message?></p>
						</div>
					<?php endif;?></h5>
					<form method="post" action="<?php echo user_url('register/shop') ?>" enctype="multipart/form-data">

						<div class="form-group" >
							<label for="name" class="cols-sm-2 control-label">Tên của bạn</label>
							<div class="cols-sm-10">
								<div class="input-group" >
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="r_name" value="<?php echo set_value('r_name')?>"  placeholder="Tên của bạn"/>
								</div>
								<div class="clear error" name="name_error"><?php echo form_error('r_name')?></div>
							</div>
						</div>

						<div class="form-group">
							<label for="email" class="cols-sm-2 control-label">Email đăng nhập</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="r_email"  placeholder="Email đăng nhập"value="<?php echo set_value('r_email')?>" />
								</div>
								<div class="clear error" name="name_error"><?php echo form_error('r_email')?></div>

							</div>
						</div>
						<div class="form-group">
							<label for="email" class="cols-sm-2 control-label">Số điện thoại</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-earphone" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="r_phone"  placeholder="Số điện thoại" value="<?php echo set_value('r_phone')?>" />
								</div>
								<div class="clear error" name="name_error"><?php echo form_error('r_phone')?></div>

							</div>
						</div>
						<div class="form-group">
							<label for="email" class="cols-sm-2 control-label">Địa chỉ</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-home" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="r_address"  placeholder="Địa chỉ"
									value="<?php echo set_value('r_address')?>" />
								</div>
								<div class="clear error" name="name_error"><?php echo form_error('r_address')?></div>

							</div>
						</div>
						 

						<div class="form-group">
							<label for="subject">
								Tỉnh thành</label>
								<div class="input-group"> 
									<span class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span>
								</span>
								<select  data-show-icon="true"  name="province" class="form-control"  onchange="this.form.submit();">
									<option value="">Chọn</option>
									<?php foreach ($provinces as $row) :?>
										
										<option data-subtext="<i class='glyphicon glyphicon-eye-open'></i>"   value="<?php echo $row->id?>" <?php echo ($this->input->post('province') == $row->id) ? 'selected' : '' ?>> <?php echo $row->local_name ?> </option>

									<?php endforeach;?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="subject">
								Địa điểm chợ</label>
								<div class="input-group"> 
									<span class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span>
								</span>
								<select  name="market_place" class="form-control"  onchange="this.form.submit();">
									<option value="">Chọn</option>
									<?php if($market_places) :?>
										<?php foreach ($market_places as $row) :?>

											<option value="<?php echo $row->id?>" <?php echo ($this->input->post('market_place') == $row->id) ? 'selected' : '' ?>> <?php echo $row->market_name ?> </option>

										<?php endforeach;?>
									<?php endif ; ?>
								</select>
							</div>
						</div>
						<div class="form-group">
                            <label for="email">
                               Hình ảnh đại diện</label>
                            <div class="input-group">
                                <span class="input-group-addon"><span class="	glyphicon glyphicon-picture"></span>
                                </span>
                                <input type="file" class="form-control" name="image" id="image" size="10" required="required"  />
                             </div>
                             <div class="clear error" name="image_error"></div>
                        </div>




						<div class="form-group">
							<label for="password" class="cols-sm-2 control-label">Mật khẩu</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
									<input type="password" class="form-control" name="r_password" id="password"  placeholder="Mật khẩu"/>
								</div>
								<div class="clear error" name="name_error"><?php echo form_error('r_password')?></div>
							</div>
						</div>



						<div class="form-group">
							<label for="confirm" class="cols-sm-2 control-label">Nhập lại mật khẩu</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
									<input type="password" class="form-control" name="r_confirm" id="confirm"  placeholder="Nhập lại mật khẩu"/>
								</div>
								<div class="clear error" name="name_error"><?php echo form_error('r_confirm')?></div>
							</div>
						</div>
					


						<div class="form-group ">
							<input type="submit"  class="btn btn-primary btn-lg btn-block login-button" value="Đăng kí">
						</div>

					</form>
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