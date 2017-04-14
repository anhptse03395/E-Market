<h4 class="text-center"> Tên sản phẩm:<?php echo $product->product_name?></h4>
                                <a href="<?php echo user_url('listproduct/product_detail_shop/'.$product->shop_id)?>"> <?php echo '</br>'.'<p style="margin-left: 33%;margin-top:1px">'.'Người đăng:'. $product->shop_name.'</p>' ?>
                                </a>

                                <?php  	echo '</br>'.'<h6 style="margin-left: 33%">'.'ngày đăng'.' :'. mdate('%d-%m-%Y',$product->product_created).'</h6>';?>
								<?php echo '</br>'.'<h3 style="margin-left: 33%;margin-top:">'.'Địa chỉ:'. $product->address.'</h3>'  ?>
								<p class="price"><?php echo 'SĐT'.':'.'0' .$product->phone ?></p>
									
								<p class="text-center buttons">
									<a href="<?php echo user_url('cart/add/'.$product->product_id)?>" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Đăt Hàng </a>

								</p>