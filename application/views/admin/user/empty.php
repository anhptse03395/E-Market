<?php $this ->load ->view('admin/user/head',$this->data);?>

<div class="line"></div>
<div class="wrapper">
	<?php $this->load->view('admin/message',$this->data); ?>
	<div class="widget">

		<div class="title">

			<h6>Danh sách người dùng</h6>
			<div class="num f12">Tổng số: ?</div>
		</div>

		<table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAll">

			<thead class="filter"><tr><td colspan="9">
				<form method="post" action="<?php echo admin_url('user/search')?>" class="list_filter form">
					<table width="80%" cellspacing="0" cellpadding="0"><tbody>

						<tr>							
							<td style="width:40px;text-align: center;" class="label"><label for="filter_id">Số Điện Thoại</label></td>
							<td style="width:155px;" class="item"><input type="text" style="width:155px;" id="filter_iname" value="" name="phone"></td>

							<td style="width:40px;text-align: center;" class="label"><label for="filter_id">Tên</label></td>
							<td style="width:155px;" class="item"><input type="text" style="width:155px;" id="filter_iname" value="" name="name"></td>
						</tr>
						<tr>
									<td class="col-xs-3 control-label" style="text-align: center;">Từ ngày</td>

					                <td><input  type="text" class="form-control" value=""  name="from_date"  /></td>
					                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar " ></span></span>
				          			<td class="col-xs-3 control-label" style="text-align: center;">Đến ngày</td>


					                <td><input  type="text" class="form-control" value=""  name="end_date"  /></td>
					                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar " ></span></span>
						</tr>

						<tr>
							<td style="width:150px">
								<input type="submit" value="Tìm Kiếm" class="button blueB"></td>
								<td><input type="reset" onclick="window.location.href = '<?php echo admin_url('user')?>'; " value="Reset" class="basic">
							</td>
						</tr>
							
							
						</tr>
					</tbody></table>
				</form>
			</td></tr></thead>

			<thead>
				<tr>
					<td style="width:10px;"><img src="<?php echo public_url('admin') ?>/images/icons/tableArrows.png" /></td>
					<td style="width:80px;">Mã số</td>
					<td>Name</td>
					<td>Phone</td>
					<td>Address</td>
					<!-- <td>Chức vụ</td> -->
					<td style="width:100px;">Hành động</td>
				</tr>
			</thead>
			
			<tfoot>


				<tr>
					<td colspan="7">
						<div class="list_action itemActions">
							<a href="#submit" id="submit" class="button blueB" url="user/del_all.html">
								<span style='color:white;'>Xóa hết</span>
							</a>
						</div>

						<div class="pagination">
							<?php echo $this->pagination->create_links()?>
						</div>
					</td>
				</tr>
			</tfoot>
			<!-- <?php foreach ($list as $row):  ?>
				<tr>
					<td><input type="checkbox" name="id[]" value="<?php echo $row->account_id ?>" /></td>

					<td class="textC"><?php echo $row->account_id ?></td>


						<td><span title="<?php echo $row->buyer_name ?>" class="tipS">
							<?php echo $row->buyer_name ?></span></td>

							<td><span title="<?php echo $row->phone ?>" class="tipS">
							0<?php echo $row->phone ?></span></td>

							<td><span title="<?php echo $row->address ?>" class="tipS">
							<?php echo $row->address ?></span></td>


							<td><span title="<?php echo $row->role_name ?>" class="tipS">
							<?php echo $row->role_name ?></span></td>


							
							<td class="option">
								<a href="<?php echo admin_url('user/edit/'.$row->account_id) ?>" title="Chỉnh sửa" class="tipS">
									<img src="<?php echo public_url('admin') ?>/images/icons/color/edit.png" />
								</a>



								<a  onclick="return confirmAction()" href="<?php echo admin_url('user/delete/'.$row->account_id)?>" title="Xóa" class="tipS verify_action">
									<img src="<?php echo public_url('admin')?>/images/icons/color/delete.png" />
								</a>


							</td>
						</tr>
					<?php endforeach ;?> -->
					<tbody>
					</table>

				</div>
			</div>
			<div class="clear mt30"></div>


