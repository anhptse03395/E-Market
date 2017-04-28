<!-- head -->
<?php $this->load->view('admin/catalog/head', $this->data)?>

<div class="line"></div>

<div class="wrapper">

    <?php $this->load->view('admin/message', $this->data);?>
    
	<div class="widget">
	
		<div class="title">
			<span class="titleIcon">
			<div class="checker" id="uniform-titleCheck">
    			<span>
    			   <input type="checkbox" name="titleCheck" id="titleCheck" style="opacity: 0;">
    			</span>
			</div>
			</span>
			<h6>Danh sách danh mục sản phẩm</h6>
		 	<div class="num f12">Tổng số: <b><?php echo count($list)?></b></div>
		</div>
		
		<table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAll">

			<thead>
				<tr>
					<td style="width:10px;"><img src="<?php echo public_url('admin') ?>/images/icons/tableArrows.png" /></td>
					<td style="width:80px;">Mã số</td>
					<td>Tên Danh Mục</td>
					<td>Hạng</td>
					<td style="width:100px;">Hành động</td>
				</tr>
			</thead>
			
			<tfoot>


				<tr>
					<td colspan="7">
						<div class='pagination'>
						</div>
					</td>
				</tr>
			</tfoot>
			<?php foreach ($list as $row):  ?>
				<tr>
					<td><input type="checkbox" name="id[]" value="<?php echo $row->category_id ?>" /></td>

					<td class="textC"><?php echo $row->category_id ?></td>


						<td><span title="<?php echo $row->category_name ?>" class="tipS">
							<?php echo $row->category_name ?></span></td>


							<td>
							<?php if(isset($row->parent_id)){?>
								<span title="<?php echo $row->parent_id ?>" class="tipS">
							<?php if ($row->parent_id != 0) {
								echo 'Danh mục con';
							} ?></span>
							<span title="<?php echo $row->parent_id ?>" class="tipS">
							<?php if ($row->parent_id == 0) {
								echo 'Danh mục cha';
							} ?></span></td>

							</td>
							<?php } ?>


							
							<td class="option">
								<a href="<?php echo admin_url('catalog/edit/'.$row->category_id) ?>" title="Chỉnh sửa" class="tipS">
									<img src="<?php echo public_url('admin') ?>/images/icons/color/edit.png" />
								</a>


								<a  onclick="return confirmAction()" href="<?php echo admin_url('catalog/delete/'.$row->category_id)?>" title="Xóa" class="tipS verify_action">
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
