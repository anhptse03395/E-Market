  
<link href="<?php echo public_url('user')?>/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo public_url('user')?>/css/profile.css" rel="stylesheet">
<link href="<?php echo public_url('user')?>/css/option.css" rel="stylesheet">
  <form style="margin-bottom: 5%;width: 100%" action="" method="post">


<div class="form_main col-md-4 col-sm-5 col-xs-7" style="width: 100%">

  <?php  $message = $this->session->flashdata('message');
                        ?>
                        <?php if(isset($message) && $message):?>
                            <div class="alert alert-info">
                                <h3 style="text-align: center;"><strong> </strong><?php echo $message?></h3>
                            </div>
                        <?php endif;?>

  <div class="form">

  
     <?php foreach ($list as $row):?>
       <table class="table table-user-information" style="width: 40% ;float: left; margin-left: 5% ">
        <tbody>
          <tr>
            <td >Mã đơn hàng:</td>
            <td><?php echo $row->order_id ?></td>
          </tr>

          <tr>
            <td>Tên khách hàng</td>
            <td><?php echo $row->buyer_name ?></td>
          </tr>
          <tr>
            <td>Tên sản phẩm</td>
            <td><?php echo $row->product_name ?></td>
          </tr>
          <tr>
            <td>Số lượng</td>
            <td><?php echo $row->quantity ?></td>
          </tr>
          <tr>
            <td>Giá</td>
            <?php if (isset($row->price)) {?>
            <?php if($row->price==0) { ?>
            <td><?php echo '<strong style="color:#fe950f">'.'Thương lượng'.'</strong>' ?></td>   
            <?php } ?>

            <?php if($row->price>0) { ?>
            <td><?php echo $row->price ?></td>   
            <?php } ?>
            <?php } ?>
            <td> <a href="<?php echo user_url('profile/put_price/'.$row->order_id.'/'.$row->product_id) ?>" class="btn btn-warning loading" style="">Gửi giá</a></td>     
          </tr>
          <tr>
            <td>Số điện thoại</td>
            <td><?php echo '0'.$row->phone ?></td>
          </tr>
          <tr>
            <td>Ngày đặt hàng</td>
            <td><?php echo mdate('%d-%m-%Y',$row->date_order) ?></td>
          </tr>
          <tr>
            <td>Nội dung</td>
            <td><?php echo $row->description ?></td>
          </tr>

          <tr>
            <td>Trạng thái</td>
            <td>
             <?php if (isset($row->status)) {?>

             <span class="label label-danger"><?php if($row->status==3){echo "Đơn hàng bị hủy";}?></span> 
             <span class="label label-info"> <?php if($row->status==1){echo "Đang xử lý";}?>
               <span class="label label-success"> <?php  if($row->status==2){echo "Đã gửi hàng";}
                ?></span>

                <?php } ?>

              </td>
            </tr>


          </tbody>
        </table>

      <?php endforeach;?> 


   
   
</div>

</div>
     <div class="pbody" style="width: 25%;margin-left: 30%">
  
       <h4 class="text-center">Xác nhận đơn hàng</h4>
       
       <div class="cards">
           <select class="form-control" name="status">
              <option value="">Chọn</option>
               <option value="2">Gủi hàng</option>
                <option value="3">Hủy đơn hàng</option>
           </select>
           <button  style="margin-top: 1%" class="btn btn-info center-block btn-md">Xác nhận</button>
       </div>
   </div>


  </form>


