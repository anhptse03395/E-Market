

	<div class="table-responsive cart_info">
		<table class="table table-condensed">

			<div class="well-searchbox">

			</div>
			<thead>
				<tr class="cart_menu" style="text-align: center;">
				<td class="description">Số thứ tự</td>
					<td class="description">Hình ảnh</td>
					<td class="description">Tên sản phẩm</td>
					<td class="description">Tên cửa hàng</td>
				</tr>
			</thead>
			<?php $counter = 1;  ?>
			<tbody>
				<?php foreach ($info as $row):?>
					<tr style="text-align: center; " >
						<td class="cart_description" style="margin-left: 2%;text-align: center;">
							<?php echo  $counter;
							$counter++ 
							?>
						</td>
						<td class="cart_description">
							<a href="<?php echo user_url('listproduct/product_detail/'.$row->product_id)?>"><img  height="70" src="<?php echo base_url('upload/product/'.$row->image_link)?>" alt=""></a>
							<p style="color: green"> <?php echo $row->shop_name.' ' ;
								echo '</br>'.'<h6>'.'ngày đăng'.' :'. mdate('%d-%m-%Y',$row->product_created).'</h6>' ;

								?></p>	
							</td>

							<td class="cart_description">
								<a style="color: #0f8efe" href="<?php echo user_url('listproduct/product_detail/'.$row->product_id)?>"> <?php echo $row->product_name?>
								</td>
								
								<td class="cart_description">
									<a href="<?php echo user_url('listproduct/product_detail_shop/'.$row->shop_id)?>"><img  height="70" width="60" src="<?php echo base_url('upload/shop/'.$row->image_shop)?>" alt=""></a>
									<p style="color: green"> <?php echo $row->shop_name.' ' ;
										echo '</br>'.'<h6>'.'Tham gia'.' :'. mdate('%d-%m-%Y',$row->shop_created).'</h6>' ;

										?></p>	
									</td>



								</tr>



							<?php endforeach;?>

						</tbody>


					</table>
					<div class="pagination">

						<li><?php echo $this->pagination->create_links()?></li>


					</div>
				</div>