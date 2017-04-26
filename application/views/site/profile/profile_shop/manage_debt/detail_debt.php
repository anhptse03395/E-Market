
<script src="<?php echo public_url('user/home') ?>/js/main.js"></script>
<script type="text/javascript" src="<?php echo public_url('user/home') ?>/js/moment-2.4.0.js"></script>
<script src="<?php echo public_url('user/home') ?>/js/bootstrap-datetimepicker.min.js"></script>
<link href="<?php echo public_url('user/home')?>/css/bootstrap-datetimepicker.css" rel="stylesheet">

<script src="<?php echo public_url('user/home') ?>/js/bootstrap.min.js"></script>
<div class="container" style="width: 100%">
    <div class="row">


        <div class="col-md-12">
            <div class="col-md-4" style="margin-left: -10%">
                <ul class="breadcrumb">
                    <li><a href="<?php echo user_url('profile/manage_debt_shop') ?>">Công nợ</a>
                    </li>
                    <li>chi tiết</li>
                </ul>
            </div>
            
        </div>

        <div class="table-responsive">


            <table id="mytable" class="table table-bordred table-striped">

                <thead>


                    <td class="description" style="color: blue">Mã đơn hàng</td>
                    <td class="description" style="color: blue">Lần trả</td>
                    <td class="description" style="color: blue">Ngày trả tiền</td>
                    <td class="description" style="color: blue">Số tiền(VND)</td>
                    <td class="description" style="color: blue">Tên khách hàng</td>
                    <td class="description" style="color: blue">Số điện thoại</td>
                    <td class="description" style="color: blue">Trạng thái</td>

                </thead>
                <tbody>
                    <?php $count =1; ?>
                    <?php foreach ($list as $row):?>
                        <tr>
                            <td class="cart_description" style="color: rgba(71, 189, 34, 0.9)">
                                <?php echo $row->order_id?>
                            </td>
                            <td class="cart_description">
                               <?php if(isset($row->amount)) {?>
                               <?php echo 'Lần'.$count; $count++?>
                               <?php } ?>

                           </td>

                           <td class="cart_description" style="color: #da8f2a">
                               <?php if(isset($row->date_pay)) {?>
                               <?php echo mdate('%d-%m-%Y',$row->date_pay)?>
                               <?php } ?>
                           </td>
                           <td class="cart_description">
                               <?php if(isset($row->amount)) {?>
                               <?php  echo number_format($row->amount  , 0, '.', ',') ?>
                               <?php } ?>

                           </td>
                           <td class="cart_description">
                            <a >  <?php echo $row->buyer_name?></a>
                        </td>
                        <td class="cart_description">
                            <?php echo '0'.$row->phone ?>

                        </td>


                        <td class="cart_description">

                            <?php if (isset($row->status)) {?>
                            
                            <span class="label label-warning"> <?php if($row->status==1){echo 'Đơn hàng mới';}?></span>
                            <span class="label label-success"><?php if($row->status==4){echo "Đã gửi hàng";}?></span>
                            <span class="label label-danger"><?php if($row->status==7){echo "Đơn hàng bị hủy";}?></span>  <span class="label label-success"><?php if($row->status==5){echo "Đã nhận hàng";}?></span>
                            <span class="label label-success"><?php if($row->status==6){echo "Đã hoàn thành";}?></span>
                            <span class="label label-info"> <?php if($row->status==2){echo "Đang đàm phán";}?></span>
                            <span class="label label-success"> <?php  if($row->status==3){echo "Đang xử lý";}?></span>
                            <?php } ?>
                        </td>
                                 <!--      <td>
                                   <a href="<?php echo user_url('profile/add_debt_buyer/') ?>" class="btn btn-info btn-sm">Add</a>
                                 
                               </td> -->

                           </tr>
                       <?php endforeach;?>


                   </tbody>

               </table>

               <div class="clearfix"></div>



           </div>
           <div class="text-center" style="margin-top: 5%;margin-bottom: 5%">  
            <a  href="<?php echo user_url('profile/add_debt_shop/'.$order_id)?>" class="btn btn-info"><i class="fa fa-chevron-right"></i>Thêm số tiền trả mới</a>
        </div> 


    </div>
</div>
</div>


