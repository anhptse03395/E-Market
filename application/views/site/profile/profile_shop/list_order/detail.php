
<style>
  .center {
    margin-top:50px;   
  }

  .modal-header {
    padding-bottom: 5px;
  }

  .modal-footer {
    padding: 0;
  }

  .modal-footer .btn-group button {
    height:40px;
    border-top-left-radius : 0;
    border-top-right-radius : 0;
    border: none;
    border-right: 1px solid #ddd;
  }
  
  .modal-footer .btn-group:last-child > button {
    border-right: 0;
  }
</style>


<script src="<?php echo public_url('user/home') ?>/js/main.js"></script>
<link href="<?php echo public_url('user/home')?>/css/bootstrap.min.css" rel="stylesheet">
<script src="<?php echo public_url('user/home') ?>/js/bootstrap.min.js"></script>






<div class="col-md-9" id="customer-orders" style="width: 100%">
  <div class="box">
    <h4 style="color: #2ca6a7">Đơn hàng của khách</h4>

    <form id="eventForm" action="" method="post" class="form-horizontal" style="margin-bottom: 3%">

      <div class="pbody" style="width: 25%;margin-left: 30%">

       <h4 style="color: blue" class="text-center">Xác nhận đơn hàng</h4>

       <div class="cards">
         <select class="form-control" name="status">
           <option value="">Chọn</option>
           
           <option value="2">Đang xử lý</option>
           <option value="3">Đã gửi hàng</option>
           <option value="4">Đơn bị hủy</option>

         </select>
         <button  style="margin-top: 1%" class="btn btn-info center-block btn-md">Xác nhận</button>
       </div>
     </div>



   </form>


   <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th class="description" style="color: blue" >Mã đơn hàng</th>

          <th class="description" style="color: blue">Tên khách hàng</th>
          <th class="description" style="color: blue">Tên sản phẩm</th>
          <th class="description" style="color: blue">Số lượng</th>
          <th class="description" style="color: blue">Giá</th>
          <th class="description" style="color: blue">Số điện thoại</th>
          <th class="description" style="color: blue">Ngày đặt hàng</th>
          <th class="description" style="color: blue">Ngày nhận hàng</th>
          <td class="description" style="color: blue">Trạng thái</td>
        </tr>
      </thead>

      <tbody>
        <?php foreach ($list as $row):?>
         <tr>
          <td class="cart_description">
            <?php echo  $row->order_id ;  ?>
          </td>

          <td class="cart_description">
            <?php echo $row->buyer_name?>
          </td>
          <td class="cart_description">
           <?php echo $row->product_name ?>
         </td>
         <td class="cart_description"><?php echo $row->quantity ?></td>

         <td class="cart_description">
           <?php if (isset($row->price)) {?>
           <?php if($row->price==0) { ?>
           <?php echo '<strong style="color:#fe950f">'.'Thương lượng'.'</strong>' ?>
           <?php } ?>

           <?php if($row->price>0) { ?>
           <?php echo $row->price ?>
           <?php } ?>
           <?php } ?>
           <a href="<?php echo user_url('profile/put_price/'.$row->order_id.'/'.$row->product_id) ?>" class="btn btn-warning loading" style="">Gửi giá</a>
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
          <span class="label label-info"> <?php if($row->status==2){echo "Đang xử lý";}?></span>
          <span class="label label-success"> <?php  if($row->status==3){echo "Đã gửi hàng";}
            ?></span>

            <?php } ?>

            <?php } ?>
          </td>


        </tr>
      <?php endforeach;?> 

    </tbody>
  </table>
  <div class="clearfix"></div>

</div>
</div>
</div>


<!-- Modal -->

