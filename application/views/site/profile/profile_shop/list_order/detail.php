


<script src="<?php echo public_url('user/home') ?>/js/main.js"></script>
<link href="<?php echo public_url('user/home')?>/css/bootstrap.min.css" rel="stylesheet">
<script src="<?php echo public_url('user/home') ?>/js/bootstrap.min.js"></script>




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
    <input type="text" name ="test" value="<?php set_value('test') ?>">
    <div><?php echo form_error('test') ?></div>

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

          <td class="cart_description">
           <?php if (isset($row->price)) {?>
           <?php if($row->price==0) { ?>
           <input  type="text" name="price_<?php echo $row->product_id?>" value="" />
           <?php } ?>

           <?php if($row->price>0) { ?>
           <input  type="text"  name="price_<?php echo $row->product_id?>" value="<?php echo $row->price ?>"  />
           <?php } ?>
           <?php } ?>

                
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


          <?php if (isset($row->status)) {?>
          <span class="label label-warning"> <?php if($row->status==1){echo 'Đơn hàng mới';}?></span>
          <span class="label label-danger"><?php if($row->status==4){echo "Đơn hàng bị hủy";}?></span> 
          <span class="label label-info"> <?php if($row->status==2){echo "Đang đàm phán";}?></span>
          <span class="label label-success"> <?php  if($row->status==3){echo "Đang xử lý";}
            ?></span>

            <?php } ?>

            <?php } ?>
          </td>


        </tr>
      <?php endforeach;?> 

    </tbody>
  </table>
    <button  style="margin-top: 1%" class="btn btn-info center-block btn-md">Gửi giá</button>
</form>


</div>
</div>
</div>


<!-- Modal -->

