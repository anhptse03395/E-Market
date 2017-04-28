  
<link href="<?php echo public_url('user')?>/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo public_url('user')?>/css/profile.css" rel="stylesheet">
<link href="<?php echo public_url('user')?>/css/option.css" rel="stylesheet">
<form style="margin-bottom: 5%;width: 100%" action="" method="post">


  <div class="form_main col-md-4 col-sm-5 col-xs-7" style="width: 100%">

   <!--  <?php  $message = $this->session->flashdata('message');
   ?>
   <?php if(isset($message) && $message):?>
   
     <div class="alert alert-info">
       <h3 style="text-align: center;"><strong> </strong><?php echo $message?></h3>
     </div>
   <?php endif;?>
 -->
 <div class="form">


   <table class="table table-user-information" style="width: 70% ;float: left; margin-left: 5% ">
    <tbody>
      <tr>
        <td >Mã đơn hàng:</td>
        <td  ><?php echo $orders->id ?></td>
      </tr>

      <tr>
        <td>Tên người mua</td>
        <td><?php echo $buyers->buyer_name ?></td>
      </tr>
      <tr>
        <td>Tên người nhận</td>
        <td><?php echo $orders->name_receiver ?></td>
      </tr>
      <tr>
        <td>Số điện thoại</td>
        <td><?php echo '0'. $orders->phone_receiver ?></td>
      </tr>

      <tr>
        <td>Địa chỉ</td>
        <td><?php echo $orders->address_receiver ?></td>
      </tr>
    </tbody>
  </table>

  <table id="mytable" class="table table-bordred table-striped">

   <thead>
     <td class="description" style="color: blue">Tên sản phẩm</td>
     <td class="description" style="color: blue">Số lượng(Kg)</td>

     <td class="description" style="color: blue">Giá/Kg</td>
     <td class="description" style="color: blue">Thành tiền(VND)</td>
   </thead>
   <tbody>
    <?php $total=0; ?>
      <?php foreach ($list_order as $row): ?>
        
        <?php  
           $total = $row->total_price+$total;
         ?>
     <tr>

      <td class="cart_description">
        <?php echo $row->product_name ?>
      </td>
      <td class="cart_description">
      <?php echo $row->quantity ?>
      </td>

      <td class="cart_description">
       <?php echo number_format( $row->price, 0, '.', ',').' '. 'đồng' ?>
      </td>

      <td  class="cart_description">
      <?php echo number_format($row->total_price, 0, '.', ',').' '. 'đồng' ?>
      </td>
    
    </tr>
  <?php endforeach ;?>


</tbody>

</table>

<div class="text-right" style="margin-right: 18%"> Tổng số tiền: <?php echo number_format($total, 0, '.', ',').' '. 'đồng'?> </div>
<div class="text-left">Số tiền cần thu <input type="text" name="need_money"></div>

<div class="form-group" style="margin-top: 10%" >
                  <label class="col-xs-3 control-label"></label>
                  <div class="input-group"> 
                    <span class="input-group-addon"><span class=""></span>
                  </span>
                  
                    <label class="btn btn-success ">
                  <input type="radio" name="status" value="4"  onchange="this.form.submit();"  />
                  Lưu 
                </label>

                <label style="margin-left: 10%" class="btn btn-danger">
                  <input type="radio" name="status" value=""  onchange="this.form.submit();"  />
                  Hủy bỏ
                </label>            
                </div>
              </div>



</div>

</div>

</div>


</form>


