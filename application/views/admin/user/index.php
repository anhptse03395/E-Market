<?php $this ->load ->view('admin/user/head',$this->data);?>

<div class="line"></div>
<div class="wrapper">
	<?php $this->load->view('admin/message',$this->data); ?>
	<div class="widget">

		<div class="title">

			<h6>Danh sách người dùng</h6>
			<div class="num f12">Tổng số: <?php echo $total_rows ?> </div>
		</div>

		<table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAll">

			<thead class="filter"><tr><td colspan="9">
				<form method="post" action="<?php echo admin_url('user/search')?>" class="list_filter form">
					<table cellpadding="0" cellspacing="0" width="80%"><tbody>

						<tr>
							<td style="width:80px;text-align:right;" class="label"><label for="filter_id">Số Điện Thoại</label></td>
							<td style="width:155px;" class="item"><input type="text" id="filter_iname" value="" name="phone"></td>

							
							<td class="label" style="width:150px;">Trạng thái<label for="filter_type"  > </label></td>
							<td class="item">
								<select name="status">
									<option value=""></option>
									<option value="1" >Kích hoạt </option>
									<option  value="2">Chưa kích hoạt</option>
									<option  value="2">Săp hết hạn</option>
								</select>
							</td>

							<td colspan='2' style='width:60px'>
							<input type="submit" class="button blueB" value="Tìm kiếm"/>
							</td>

						</tr>

								<tr>
									<td class="label" style="width:150px; text-align: right; "><label for="filter_created"></label>Từ ngày</td>
									<td class="item"><input name="from_date" value="" id="filter_created" type="text" class="datepicker" /></td>


									<td class="label" style="width:150px;" ><label for="filter_created_to"> Đến ngày</label></td>
									<td class="item" style="width:150px;" ><input name="end_date" value="" type="text" class="datepicker" /></td>
								</tr>

							</tbody></table>
						</form>
					</td></tr></thead>

					<thead>
						<tr>
							
							<td style="width:80px;">Mã số</td>
							<td>Name</td>
							<td>Số điện thoại</td>
							<td>Địa chỉ</td>
							<td>Ngày tạo</td>
							<td style="width:100px;">Hành động</td>
						</tr>
					</thead>

					<tfoot>


						<tr>
							<td colspan="7">

								<div class="pagination">
									<?php echo $this->pagination->create_links()?>
								</div>
							</td>
						</tr>
					</tfoot>
					<?php foreach ($list as $row):  ?>
						<tr>
						
							<td class="textC"><?php echo $row->account_id ?></td>


							<td style="text-align: center;"><span title="<?php echo $row->buyer_name ?>" class="tipS">
								<?php echo $row->buyer_name ?></span></td>

								<td style="text-align: center;"><span title="<?php echo $row->phone ?>" class="tipS">
									0<?php echo $row->phone ?></span></td>

									<td style="text-align: center;"><span title="<?php echo $row->address ?>" class="tipS">
										<?php echo $row->address ?></span></td>


										<td style="text-align: center;"><span title="" class="tipS">
											<?php echo mdate('%d-%m-%Y',$row->created) ?></span></td>



											<td class="option">
												<a href="<?php echo admin_url('user/edit/'.$row->account_id) ?>" title="Chỉnh sửa" class="tipS">
													<img src="<?php echo public_url('admin') ?>/images/icons/color/edit.png" />
												</a>



												<a  onclick="return confirmAction()" href="<?php echo admin_url('user/delete/'.$row->account_id)?>" title="Xóa" class="tipS verify_action">
													<img src="<?php echo public_url('admin')?>/images/icons/color/delete.png" />
												</a>


											</td>
										</tr>
									<?php endforeach ;?>
									<tbody>
									</table>

								</div>
							</div>
							<div class="clear mt30"></div>


