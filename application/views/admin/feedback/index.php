<?php $this ->load ->view('admin/feedback/head',$this->data);?>

<div class="line"></div>
<div class="wrapper">
	<?php $this->load->view('admin/message',$this->data); ?>
	<div class="widget">

		<div class="title">

			<h6>Phản hổi người dùng</h6>
			<div class="num f12">Tổng số: <b><?php echo $total_rows?></b></div>
		</div>

		<table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAll">
			<thead class="filter"><tr><td colspan="9">
				<form method="post" action="<?php echo admin_url('feedback/search')?>" class="list_filter form">
					<table cellpadding="0" cellspacing="0" width="80%"><tbody>
						<tr>
							<td style="width:155px;text-align:right;" class="label"><label for="filter_id">Số Điện Thoại</label></td>
							<td style="width:155px;" class="item"><input style="border: 2px ridge" type="text" id="filter_iname" value="" name="phone"></td>

							<td class="label" style="width:150px; text-align: right; "><label for="filter_created"></label>Từ ngày</td>
									<td class="item"><input style="border: 2px ridge" name="from_date" value="" id="filter_created" type="text" class="datepicker" /></td>
																			
						</tr>

								<tr>
									<td></td>
									<td></td>	

									<td class="label" style="width:150px;" ><label for="filter_created_to"> Đến ngày</label></td>
									<td class="item" style="width:150px;" ><input style="border: 2px ridge" name="end_date" value="" type="text" class="datepicker" /></td>
								</tr>
								<tr>
									<td colspan='2' style='width:60px'>
									<input type="submit" class="button blueB" value="Tìm kiếm"/>
									</td>
								</tr>

							</tbody></table>
						</form>
					</td></tr></thead>

			
			<thead>
				<tr>
					<td style="width:10px;"><img src="<?php echo public_url('admin') ?>/images/icons/tableArrows.png" /></td>
					<td style="width:80px;">Mã số</td>
					<td>Số Điện Thoại</td>
					<td>Lí Do</td>
					<td>Ngày Tạo</td>
					<td style="width:100px;">Hành động</td>
				</tr>
			</thead>
			
			<tfoot>


				<tr>
					<td colspan="6">
 						<div class="pagination">
 							<?php echo $this->pagination->create_links()?>
 						</div>
					</td>
				</tr>
			</tfoot>
			<?php foreach ($list as $row):  ?>
				<tr>
					<td><input type="checkbox" name="" value="" /></td>

					<td class="textC"><?php echo $row->feedback_id ?></td>

							<td><span title="" class="tipS">
							0<?php echo $row->phone ?></span></td>

							<td><span title="" class="tipS">
							<?php echo $row->reason ?></span></td>


							<td><span title="" class="tipS">
							<?php echo mdate('%d-%m-%Y',$row->created) ?></span></td>


							
							<td class="option">
								<a  onclick="return confirmAction()" href="<?php echo admin_url('feedback/edit/'.$row->feedback_id)?>" title="Chỉnh sửa" >
								<input type="button" value="Xem">
								<a  onclick="return confirmAction()" href="<?php echo admin_url('feedback/delete/'.$row->account_id)?>" title="Xóa" class="tipS verify_action">
								<img src="<?php echo public_url('admin')?>/images/icons/color/delete.png" />
							</td>
						</tr>
					<?php endforeach ;?>
					<tbody>
					</table>

				</div>
			</div>
			<div class="clear mt30"></div>


