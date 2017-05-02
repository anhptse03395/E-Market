<!-- head -->
<?php $this->load->view('admin/product/head', $this->data)?>

<div class="line"></div>


<?php $this->load->library('form_validation');
		$this->load->helper('form'); ?>
<div id="main_product" class="wrapper">
	<div class="widget">

		<div class="title">
			
			<h6>
				Danh sách sản phẩm			
			</h6>
			<div class="num f12">Số lượng: <b><?php echo $total_rows?></b></div>
		</div>
		
		<table width="100%" cellspacing="0" cellpadding="0" id="checkAll" class="sTable mTable myTable">
			
			<thead class="filter"><tr><td colspan="8">
				<form method="post" action="<?php echo admin_url('product/search')?>" class="list_filter form">
					<table width="80%" cellspacing="0" cellpadding="0"><tbody>

						<tr>
							<td style="width:155px;text-align: right;" class="label"><label for="filter_id">Số Điện Thoại</label></td>
							<td style="width:155px;" class="item"><input type="text" id="filter_iname" value="<?php echo set_value('phone') ?>" name="phone"></td>
							
							<td class="col-xs-3 control-label" style="text-align: right;">Từ ngày</td>

					                <td style="width:155px;" class="col-xs-5 date" >
								          <div class="input-group input-append date" id="datePicker">
								            <input  type="text" value=""  class="datePicker" name="from_date" />
								            <!-- <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span> -->
								          </div>

								    </td>
						</tr>
						<tr>
							
							<td style="width:40px;" class="label"><label for="filter_id">Tên</label></td>
							<td style="width:155px;" class="item"><input type="text" style="width:155px;" id="filter_iname" value="<?php echo set_value('name')?>" name="name"></td>

							<td class="col-xs-3 control-label" style="text-align: right;">Đến ngày</td>


					                <td style="width:155px;"><input  type="text" class="datePicker" value=""  name="end_date"  /></td>
							
							<td style="width:60px;" class="label"><label for="filter_status">Thể loại</label></td>
							<td class="item">
								<select name="catalog">
									<option value=""></option>
									<!-- kiem tra danh muc co danh muc con hay khong -->
									<?php foreach ($catalogs as $row):?>
										<?php if(count($row->subs) > 1):?>
											<optgroup label="<?php echo $row->category_name?>">
												<?php foreach ($row->subs as $sub):?>
													<option value="<?php echo $sub->id?>" <?php echo ($this->input->get('catalog') == $sub->id) ? 'selected' : ''?>> <?php echo $sub->category_name?> </option>
												<?php endforeach;?>
											</optgroup>
										<?php else:?>
											<option value="<?php echo $row->id?>" <?php echo ($this->input->get('catalog') == $row->id) ? 'selected' : ''?>><?php echo $row->category_name?></option>
										<?php endif;?>
									<?php endforeach;?>
								</select>
							</td>
						</tr>

							
						<tr>			
									<td></td>					
									<td style="width:150px;text-align: center;">
									<input type="submit" value="Tìm Kiếm" class="button blueB"></td>
																				
						</tr>
					</tbody></table>
				</form>
			</td></tr></thead>
			
			<thead>
				<tr>
					
					<td style="width:60px;">Mã số</td>
					<td>Tên sản phẩm</td>
					<td >Tên cửa hàng</td>
					<td >Số điện thoại</td>
					<td >Ngày đăng</td>
					<td style="width:75px">Nội Dung</td>


					<td style="width:120px;">Hành động</td>
				</tr>
			</thead>
			
			<tfoot class="auto_check_pages">
				<tr>
					<td colspan="8">
						<div class="pagination">
							<?php echo $this->pagination->create_links()?>
						</div>
					</td>
				</tr>
			</tfoot>
			
			<tbody class="list_item">
				<?php foreach ($list as $row):?>
					<tr class="row_9">
						

						<td class="textC"><?php echo $row->product_id?></td>

						<td>
							<div class="image_thumb">
								<img height="50" src="<?php echo base_url('upload/product/'.$row->image_link)?>">
								<div class="clear"></div>
							</div>

							<a target="_blank" title="" class="tipS" href="">
								<b><?php echo $row->product_name?></b>
							</a>



						</td>


						<td class="textC"><?php echo $row->shop_name?></td>
						<td class="textC">0<?php echo $row->phone?></td>
						<td class="textC"><?php echo mdate('%d-%m-%Y',$row->created)?></td>
						<td style="margin:left" class="textR">
							<?php echo $row->description?>
						</td>

						<td class="option textC">
							<a class="tipS verify_action" title="Xóa" href="<?php echo admin_url('product/del/'.$row->product_id)?>">
								<img src="<?php echo public_url('admin/images')?>/icons/color/delete.png">
							</a>
						</td>
					</tr>
				<?php endforeach;?>
			</tbody>

		</table>
	</div>

</div>


