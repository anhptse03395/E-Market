<?php $this ->load ->view('admin/feedback/head',$this->data);?>

<div class="line"></div>
<div class="wrapper">
	<?php $this->load->view('admin/message',$this->data); ?>
	<div class="widget">

		<div class="title">

			<h6>Danh sách người dùng</h6>
			<div class="num f12">Tổng số: </div>
		</div>

		<table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAll">

			
			<thead>
				<tr>
					<td style="width:10px;"><img src="<?php echo public_url('admin') ?>/images/icons/tableArrows.png" /></td>
					<td style="width:80px;">Mã số</td>
					<td>Tên</td>
					<td>Số Điện Thoại</td>
					<td>Lí Do</td>
					<td>Nội Dung</td>
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
<!-- 
						<div class="pagination">
							<?php echo $this->pagination->create_links()?>
						</div> -->
					</td>
				</tr>
			</tfoot>
			<!-- /<?php foreach ($list as $row):  ?> -->
				<tr>
					<td><input type="checkbox" name="" value="" /></td>

					<td class="textC"><!-- <?php echo $row->account_id ?> -->02</td>


						<td><span title="" class="tipS">Trung Đức
							<!-- <?php echo $row->buyer_name ?> --></span></td>

							<td><span title="" class="tipS">
							0963852741<!-- <?php echo $row->phone ?> --></span></td>

							<td><span title="" class="tipS">Feedback cho cửa hàng A
							<!-- <?php echo $row->address ?> --></span></td>


							<td><span title="" class="tipS">Rau không ngon.................
							<!-- <?php echo mdate('%d-%m-%Y',$row->created) ?> --></span></td>


							
							<td class="option">
								<a href="" title="Chỉnh sửa" class="tipS">
									<img src="<?php echo public_url('admin') ?>/images/icons/color/edit.png" />
								</a>



								<a  onclick="return confirmAction()" href="" title="Xóa" class="tipS verify_action">
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


