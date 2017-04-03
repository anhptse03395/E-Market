
<html>


<head>
	<?php 
	$this->load->view('site/head');
	?>

</head>

<body>
	<div id="header">
		<?php $this->load->view('site/header'); ?>
	</div>

	<section id="cart_items">
		<div class="container">	

			<div class="breadcrumbs">
				<ol class="breadcrumb">

				</ol>
			</div>
			<?php 
			$this->load->library('form_validation');
			$this->load->helper('form');

			?>

			<form class="form-horizontal" method="post" action="<?php echo user_url('listproduct/search') ?>">
				<fieldset>

					<!-- Form Name -->
					<legend>Các bài đăng</legend>

					<!-- Text input-->
					<div class="form-group row has-success">
						<label  class="col-md-4 control-label" >Tên sản phẩm</label>  
						<div class="col-md-4">
							<input  type="text"  name="name" placeholder="Tên sản phẩm" value=" <?php echo set_value('name');?>" class="form-control input-md"/>

						</div>
					</div>

					<div class="form-group row has-warning">
						<label class="col-md-4 control-label">Danh mục sản phẩm</label>
						<div class="col-md-2">
							<select id="selectbasic" name="catalog" class="form-control">
								<option value="">Tất cả</option>

								<?php foreach ($catalogs as $row):?>
									<?php if(count($row->subs) > 1):?>
										<optgroup style="color: blue" label="<?php echo $row->category_name?>">
											<?php foreach ($row->subs as $sub):?>
												<option style="color: green" value="<?php echo $sub->id?>" <?php echo ($this->input->post('catalog') == $sub->id) ? 'selected' : ''?>> <?php echo $sub->category_name?> </option>
											<?php endforeach;?>
										</optgroup>
									<?php else:?>
										<option value="<?php echo $row->id?>" <?php echo ($this->input->post('catalog') == $row->id) ? 'selected' : ''?>><?php echo $row->category_name?></option>
									<?php endif;?>
								<?php endforeach;?>
							</select>
						</div>
					</div>

					<!-- Button -->
					<div class="form-group">
						<label class="col-md-4 control-label" for="submit"></label>
						<div class="col-md-4">
							<button  class="btn btn-primary">Tìm Kiếm</button>
						</div>
					</div>

				</fieldset>
			</form>



			<div class="table-responsive cart_info">
				<table class="table table-condensed">

					<div class="well-searchbox">

					</div>
					<thead>
						<tr class="cart_menu">
							<td class="description">Hình ảnh</td>
							<td class="description">Tên sản phẩm</td>
							<td class="description">Số lượng</td>
							<td class="description">Người đăng</td>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($info as $row):?>
							<tr>
									<td class="cart_description">
									<a href="<?php echo user_url('listproduct/product_detail/'.$row->product_id)?>"><img  height="70" src="<?php echo base_url('upload/product/'.$row->image_link)?>" alt=""></a>
									<p style="color: green"> <?php echo $row->shop_name.' ' ;
										echo '</br>'.'<h6>'.'ngày đăng'.' :'. mdate('%d-%m-%Y',$row->product_created).'</h6>' ;

										?></p>	
									</td>

									<td class="cart_description">
										<a style="color: black" href="<?php echo user_url('listproduct/product_detail/'.$row->product_id)?>"> <?php echo $row->product_name?>
									</td>
									<td class="cart_description">
											<p> <?php echo $row->quantity?>Kg</p>
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

				</div>	



			</section>

		</body>


		<script src="<?php echo public_url('user')?>/js/jquery.js"></script>
		<script src="<?php echo public_url('user') ?>/js/bootstrap.min.js"></script>
		<script src="<?php echo public_url('user') ?>/js/jquery.scrollUp.min.js"></script>
		<script src="<?php echo public_url('user') ?>/js/price-range.js"></script>
		<script src="<?php echo public_url('user') ?>/js/jquery.prettyPhoto.js"></script>
		<script src="<?php echo public_url('user') ?>/js/main.js"></script>
		</html>