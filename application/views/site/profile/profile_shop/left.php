	
	<div class="profile-sidebar">
	

		<div class="profile-usertitle">
			<div class="profile-userpic">
				<img src="<?php echo base_url('upload/shop/'.$shop_info->image_shop)?>" class="img-responsive" alt="">
			</div>
			<div class="profile-usertitle-name">
				<span class="hidden-xs"><?php echo $shop_info->shop_name ?></span>
			</div>
			<div class="profile-usertitle-job">
			</div>
		</div>
		<!-- END SIDEBAR USER TITLE -->
		<!-- SIDEBAR MENU -->
		<div class="profile-usermenu">
			<ul class="nav">

				<li>
					<a href="<?php echo user_url('profile/list_order_shop') ?>">
						<i class="glyphicon glyphicon-th-list"></i>
						<span class="hidden-xs">Đơn hàng của khách <span></a>
						</li>
						
						<li>
							<a href="<?php echo user_url('profile/listpost') ?>">
								<i class="glyphicon glyphicon-tasks"></i>
								<span class="hidden-xs">Quản lý sản phẩm<span> </a>
								</li>

								
								<li>
									<a href="<?php echo user_url('profile/manage_debt_shop') ?>">
										<i class="glyphicon glyphicon-list-alt"></i>
										<span class="hidden-xs">Quản lý công nợ <span> </a>

										</li>

								<li>
									<a href="<?php echo user_url('profile/feedback_shop') ?>">
										<i class="glyphicon glyphicon-list-alt"></i>
										<span class="hidden-xs">Phản hồi <span> </a>

										</li>		
										<li >
											<a href="<?php echo user_url('profile/shop/index')?>">
												<i class="glyphicon glyphicon-user"></i>
												<span class="hidden-xs">Cá Nhân<span> </a>
												</li>

											</ul>
										</div>
										<!-- END MENU -->
									</div>
								</div>