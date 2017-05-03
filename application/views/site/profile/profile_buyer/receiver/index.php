
<link href="<?php echo public_url('user')?>/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo public_url('user')?>/css/profile.css" rel="stylesheet">

<div class="form_main col-md-4 col-sm-5 col-xs-7">
    <h4 class="heading"><strong>Thông tin </strong> cá nhân <span></span></h4>
    <?php  $message1 = $this->session->flashdata('message');
    ?>
    <?php if(isset($message1) && $message1):?>
      <div class="alert alert-info">
        <h3 style="text-align: center;"><strong> </strong><?php echo $message1?></h3>
      </div>
    <?php endif;?>
    <div class="form">
        <form action="" method="post">

            <table class="table table-user-information" style="width: 60%;">
                <tbody>
               
                <tr>
                    <td>Tên người nhận</td>
                    <td><input  type="text" name="name_receiver" value="<?php echo $buyer->name_receiver ?>"></td>
                     <div class="clear error" name="name_error"><?php echo form_error('name_receiver')?></div>
                </tr>
                 <tr>
                    <td >Số điện thoại người nhận:</td>
                    <td><input  type="text" name="phone_receiver" value="<?php echo '0'.$buyer->phone_receiver ?>"></td>
                     <div class="clear error" name="name_error"><?php echo form_error('phone_receiver')?></div>
                </tr>
                <tr>
                    <td>Địa chỉ người nhận</td>
                    <td><input  type="text" name="address_receiver" value="<?php echo $buyer->address_receiver ?>"></td>
                        <div class="clear error" name="name_error"><?php echo form_error('address_receiver')?></div>
                </tr>

                </tbody>
            </table>
             <button type="submit"  class="btn btn-default">Xác nhận</button>
        </form>

    </div>
</div>
