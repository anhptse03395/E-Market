	<div class="form_main col-md-4 col-sm-5 col-xs-7">
        <h4 class="heading"><strong>Thông tin </strong> cá nhân <span></span></h4>
        <div class="form">
            <form action="<?php echo user_url('profile') ?>" method="post" id="contactFrm" name="contactFrm">
                <?php echo form_hidden('profile', 1) ?>
                <!--need to repair-->
                <?php if (isset($error)): ?>
                    <div class="error"><?php echo $error; ?></div>
                <?php endif; ?>
                <?php foreach ($info as $row): ?>
                    <?php if(isset($row->name)):
                    if($row->name!= ''):
                        ?>Name :<?php echo $row->name;?><?php
                    endif;
                    endif;?>

                    <?php echo form_error('name', '<div class="error">', '</div>');?>
                    <br>
                    <br>
                    <?php if(isset($row->email)):
                    if($row->email!= ''):
                        ?>Email :<?php echo $row->email;?><?php
                    endif;
                    endif;?>
                    <?php echo form_error('email', '<div class="error">', '</div>');?>
                    <br>
                    <br>


                    <?php  $message = $this->session->flashdata('message');
                    ?>

                    <?php if(isset($message) && $message):?>
                        <div class="nNote nInformation hideit">
                            <p><strong> </strong><?php echo $message?></p>
                        </div>
                    <?php endif;?>

                </form>
            <?php endforeach;?>
            ChangePassword :
            <form action="" method="post">
                <input placeholder="New password" type="password" name="new_password">
                <div class="clear error" name="name_error"><?php echo form_error('new_password')?></div>
                <br>
                <input placeholder="Password cu" type="password" name="old_password">
                <div class="clear error" name="name_error"><?php echo form_error('old_password')?></div>
                <br>
                <input placeholder="Nhap lai password" type="password" name="repassword">
                <div class="clear error" name="name_error"><?php echo form_error('repassword')?></div>
                <br>
                
                <br>
                <button type="submit"  class="btn btn-default">Gui</button>
            </form>

        </div>
    </div>