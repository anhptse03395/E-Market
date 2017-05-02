  
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


   <table class="table table-user-information"  ">
    <tbody>
      <tr>
        <td class="text-center" >Mã đơn hàng:</td>
        <td  ><?php echo $orders->id ?></td>
    </tr>

    <tr>
        <td class="text-center" >Tên khách hàng</td>
        <td><?php echo $buyers->buyer_name ?></td>
    </tr>
    <tr>
        <td class="text-center" >Số điện thoại</td>
        <td><?php echo '0'.$accounts->phone ?></td>
    </tr>
    <tr>
        <td class="text-center" >Địa chỉ</td>
        <td><?php echo $buyers->address ?></td>
    </tr>  
    <?php $count =1  ?>
    <?php foreach ($list as $row):?>
        <?php if(isset($row->date_pay)) {?>
        <tr>
            <td class="text-center"  >Ngày trả tiền lần <?php echo $count; $count++  ?> </td>
            <td><?php echo mdate('%d-%m-%Y',$row->date_pay) ?></td>
        </tr>
        <?php } ?>
        
        <?php if(isset($row->amount)) {?>
        <tr>
            <td class="text-center" >Số tiền</td>
            <td><?php echo number_format($row->amount , 0, '.', ',') .'VND' ?></td>
        </tr>
        <?php } ?>
        
    <?php endforeach;?> 

    <?php if(isset($debts->total_price)) {?>
    <tr>
        <td class="text-center" >Tổng số tiền của đơn hàng</td>
        <td><?php echo  number_format($debts->total_price , 0, '.', ',') .'VND' ?></td>
    </tr>
    <?php } ?>
    
    <?php if(isset($debts->total_paid)) {?>
    <tr>
        <td class="text-center" >Tổng tiền đã thanh toán</td>
        <td><?php echo  number_format($debts->total_paid , 0, '.', ',') .'VND' ?></td>
    </tr>
    <?php } ?>

    <?php if(isset($debts->debt)) {?>
    <tr>
        <td class="text-center" >Tổng số tiền còn nợ</td>
        <td><?php echo number_format($debts->debt  , 0, '.', ',') .'VND' ?></td>
    </tr>
    <?php } ?>

    <tr>
        <td class="text-center" >Số tiền thanh toán lần này</td>
        <td><input type="text"   name ="paid" value="<?php echo set_value('paid') ?>" ></td>
        <td class="text-center" style="color: red">  <?php echo form_error('paid') ?> </td>
    </tr>


</tbody>
</table>






</div>

</div>
<div class="pbody" style="width: 25%;margin-left: 30%">



 <div class="cards">
    <button  style="margin-top: 1%" class="btn btn-info center-block btn-md">Xác nhận</button>
</div>
</div>


</form>
