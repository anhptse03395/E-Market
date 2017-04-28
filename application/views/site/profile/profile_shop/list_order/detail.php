

<script src="<?php echo public_url('user/home') ?>/js/main.js"></script>
<script type="text/javascript" src="<?php echo public_url('user/home') ?>/js/moment-2.4.0.js"></script>
<script src="<?php echo public_url('user/home') ?>/js/bootstrap-datetimepicker.min.js"></script>
<link href="<?php echo public_url('user/home')?>/css/bootstrap-datetimepicker.css" rel="stylesheet">

<script src="<?php echo public_url('user/home') ?>/js/bootstrap.min.js"></script>

<SCRIPT LANGUAGE="JavaScript">
  function confirmAction() {
    return confirm("bạn có xác nhận xóa sản phẩm này không?")
  }
  function confirmAction1() {
    return confirm("bạn có xác nhận gửi hàng  không?")
  }
</SCRIPT>


<div class="col-md-9" id="customer-orders" style="width: 100%">
  <div class="box">
    <h4 style="color: #2ca6a7">Đơn hàng của khách</h4>
    <?php  $message = $this->session->flashdata('message');
    ?>
    <?php if(isset($message) && $message):?>
      <div class="alert alert-info">
        <h3 style="text-align: center;"><strong> </strong><?php echo $message?></h3>
      </div>
    <?php endif;?>

    <form  action="" method="post" class="form-horizontal" style="margin-bottom: 3%">
  <!--    <input type="text" name ="test" value="<?php set_value('test') ?>"> 
  <div><?php echo form_error('test') ?></div> -->

  <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th class="description" style="color: blue" >Mã đơn hàng</th>
          <th class="description" style="color: blue">Tên khách hàng</th>
          <th class="description" style="color: blue">Tên sản phẩm</th>
          <th class="description" style="color: blue">Số lượng</th>
          <th class="text-center" style="color: blue">Giá/Kg</th>
          <th class="description" style="color: blue">Số điện thoại</th>
          <th class="description" style="color: blue">Ngày đặt hàng</th>
          <th class="description" style="color: blue">Ngày nhận hàng</th>
          <th class="description" style="color: blue">Trạng thái</th>
          <?php if ($orders->status<=3) {?>
          <th class="description" style="color: blue">Xóa sản phẩm</th>
          <?php } ?>
        </tr>
      </thead>

      <tbody>
        <?php foreach ($list as $row):?>
         <tr>
          <td class="cart_description">
            <input type="hidden" name="order_id" value="<?php echo  $row->order_id ;  ?>">
            <?php echo  $row->order_id ;  ?>
          </td>

          <td class="cart_description">
            <?php echo $row->buyer_name?>
          </td>
          <td class="cart_description">
            <input type="hidden" name="product_<?php echo $row->product_id?>" value="<?php echo  $row->product_id ;  ?>">
            <?php echo $row->product_name ?>
          </td>
          <td class="cart_description"><?php echo $row->quantity ?></td>

          <td class="">
           <?php if (isset($row->price)) {?>
           <?php if($row->price==0) { ?>
           <input  type="text" name="price_<?php echo $row->product_id?>" value="" />
           <?php } ?>

           <?php if($row->price>0) { ?>
           <input  type="text"  name="price_<?php echo $row->product_id?>" value="<?php echo number_format($row->price, 0, '.', ',') ?>"  />
           <?php } ?>
           <?php } ?>
           <div><?php echo form_error('price_'. $row->product_id) ?></div>

         </td>

         <td class="cart_description">
           <?php echo '0'.$row->phone ?>
         </td>
         <td class="cart_description">
           <?php echo mdate('%d-%m-%Y',$row->date_order)?>
         </td>

         <td  class="cart_description"><?php echo mdate('%d-%m-%Y',$row->date_receive) ?></td>
         <td class="cart_description">




          <?php if (isset($row->status)) {?>




          <span style="color: #0dbbde" > <?php if($row->status==1){echo 'Đơn hàng mới';}?></span>
          <span style="color: #428bca"><?php if($row->status==4){echo "Đã gửi hàng";}?></span>
          <span style="color: #d80e0a"><?php if($row->status==7){echo "Đơn hàng bị hủy";}?></span>
          <span style="color: #3bbf41" ><?php if($row->status==5){echo "Đã nhận hàng";}?></span>
          <span style="color: #fe980f"><?php if($row->status==6){echo "Đã hoàn thành";}?></span>
          <span style="color: #43c5e0" > <?php if($row->status==2){echo "Đang đàm phán";}?></span>
          <span style="color: #4d6e75"> <?php  if($row->status==3){echo "Đang xử lý";}?></span>

          <?php } ?>


        </td>
        <?php if ($row->status<=3) { ?>
        <td class="cart_description">
          <a  onclick="return confirmAction()" class="glyphicon glyphicon-trash" title="Xóa" href="<?php echo user_url('profile/del_order/'.$row->order_id.'/'.$row->product_id)?>">

          </a>
        </td>
        <?php } ?>

      </tr>
    <?php endforeach;?> 

  </tbody>
</table>

<div class="box-footer">
 <?php if ($orders->status==3) {?>
 <div class="pull-left" style="margin-left: 10%">
  <a   href="<?php echo user_url('profile/send_order/'.$order_id)?>" class="btn btn-success"> Gửi hàng</a>
</div>
<?php } ?>
<?php if ($orders->status<3) {?>

<div class="pull-left " style="margin-left: 10%" >
  <button class="btn btn-info" type="submit"><i class="glyphicon glyphicon-euro"></i>Gửi giá</button>

</div>
<?php } ?>

</div>




</form>


</div>
</div>
</div>


<!-- Modal -->
