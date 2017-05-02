<div class="titleArea">
	<div class="wrapper">
		<div class="pageTitle">
			<h5>Bảng điều khiển</h5>
			<span>Trang quản lý hệ thống</span>
		</div>
		
		<div class="clear"></div>
	</div>
</div>
<div class="line"></div>
<div class="wrapper">
	
	<div class="widgets">
	     <!-- Stats -->
		
<!-- Amount -->

<!-- User -->
<div class="oneTwo">
	<div class="widget">
		<div class="title">
			<img src="<?php echo public_url('admin'); ?>/images/icons/dark/users.png" class="titleIcon">
			<h6>Thống kê dữ liệu</h6>
		</div>
		
		<table cellpadding="0" cellspacing="0" width="100%" class="sTable myTable">
			<tbody>
				
				<tr>
					<td>
						<div class="left">Tổng số người sử dụng</div>
						<div class="right f11"><a href=""></a></div>
					</td>
					
					<td class="textC webStatsLink">
						<?php echo number_format($total_account)?>
					</td>
				</tr>
				<tr>
					<td>
						<div class="left">Tổng số người bán</div>
						<div class="right f11"><a href="<?php echo admin_url('seller') ?>">Chi tiết</a></div>
					</td>
					
					<td class="textC webStatsLink">
						<?php echo number_format($total_shop)?>
						<a href="">
					</td>
				</tr>
				
				<tr>
					<td>
						<div class="left">Tổng số người mua</div>
						<div class="right f11"><a href="<?php echo admin_url('user') ?>">Chi tiết</a></div>
					</td>
					
					<td class="textC webStatsLink">
						<?php echo number_format($total_buyer)?>
					</td>
				</tr>
				
				<tr>
					<td>
						<div class="left">Tổng số sản phẩm đã đăng</div>
						<div class="right f11"><a href="<?php echo admin_url('product')?>">Chi tiết</a></div>
					</td>
					
					<td class="textC webStatsLink">
						<?php echo number_format($total_product)?></td>
				</tr>
				
				  
			</tbody>
		</table>
	</div>
</div>

		<div class="clear"></div>
		

        	</div>
	
</div>
<div class="clear mt30"></div>