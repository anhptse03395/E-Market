<style>
    .jumbotron {
        background: #358CCE;
        color: #FFF;
        border-radius: 0px;
    }
    .jumbotron-sm { padding-top: 24px;
        padding-bottom: 24px; }
    .jumbotron small {
        color: #FFF;
    }
    .h1 small {
        font-size: 24px;
    }

</style>



<link href="<?php echo public_url('user')?>/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo public_url('user')?>/css/profile.css" rel="stylesheet">

<div class="container">
    <div class="row">
    <form action="<?php echo user_url('profile/feedback_shop') ?>" method="post">

        <div class="form_main col-md-4 col-sm-5 col-xs-7">

            <h1>Phản Hồi</h1>

            <div class="col-md-6">

            <div class="form-group ">
                <label for="">
                    Tên Liên Lạc</label>
                <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span>
                                </span>
                    <input type="text" class="form-control " style="text-align: center;" placeholder=" Tên Liên Lạc" name="p_name" value="<?php echo $info->shop_name ?>"  /></div>
            </div>


            <div class="form-group">
                <label for="email">
                    Số Điện Thoại</label>
                <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-earphone"></span>
                                </span>
                    <input type="text" class="form-control" placeholder="Phone" name="p_phone" style="text-align: center; " value="<?php echo $info->phone ?>"   /></div>
            </div>
            <div class="form-group">
                <label for="email">
                    Địa Chỉ</label>
                <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-inbox"></span>
                                </span>
                    <input type="text" class="form-control" placeholder="  Địa Chỉ" name="p_address" value="<?php echo $info->address ?>" style="text-align: center;"  /></div>
                <div class="clear error" name="name_error"></div>

            </div>

                <div class="form-group">
                    <label for="email">
                        Lý do đăng tin </label>
                    <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-text-height"></span>
                                </span>
                        <input type="text" class="form-control"  placeholder=" lý do" name="reason" value="<?=set_value('reason')?>" required="required" /></div>
                    <div class="clear error" name="name_error"></div>
                </div

            <div class="form-group">
                <label for="email">
                    Nội Dung</label>
                <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span>
                                </span>
                    <textarea type="text" class="form-control" rows="9" cols="25" name="description" required="required" placeholder="Nội Dung" >
                    <?=set_value('description')?>
                    </textarea>

                </div>
                <div class="clear error" name="name_error"></div>
            </div>





                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary pull-left" >
                        Phản Hồi</button>
                </div>



</form>

        </div>
        </div>

    </div>
</div>