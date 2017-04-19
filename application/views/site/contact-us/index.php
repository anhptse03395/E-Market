<html >

<head>
    <link href="<?php echo public_url('user')?>/css/login.css" rel="stylesheet">
    <?php
    $this->load->view('site/head');
    ?>

</head>
<body >
<div id="header">
    <?php $this->load->view('site/header'); ?>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="well well-sm">
                <?php $this->load->helper('form'); ?>
                <form class="form-horizontal" action="<?php echo user_url('contact/feedback_guess') ?>" method="post">
                    <fieldset>
                        <legend class="text-center header">Contact us</legend>
                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-1">
                                <input id="fname" name="first_name" type="text" placeholder="First Name" class="form-control" value="<?=set_value('first_name')?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-1">
                                <input id="lname" name="last_name" type="text" placeholder="Last Name" class="form-control" value="<?=set_value('last_name')?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-1">
                                <input id="email" name="address" type="text" placeholder="Email Address" class="form-control" <?=set_value('address')?>>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-1">
                                <input id="phone" name="phone" type="text" placeholder="Phone" class="form-control" <?=set_value('phone')?>>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-1">
                                <textarea class="form-control" id="message" name="description" placeholder="Enter your massage for us here. We will get back to you within 2 business days." rows="7">
                                    <?=set_value('description')?>
                                </textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
        <div class="col-md-6">
            <div>
                <div class="panel panel-default">
                    <div class="text-center header">Our Office</div>
                    <div class="panel-body text-center">
                        <h4>Address</h4>
                        <div>
                            Khu GD&ĐT, Khu Công Nghệ Cao Km29 Đại Lộ Thăng Long,, Thạch Thất, Hà Nội, Vietnam<br/>
                            fpt.edu.vn<br/>
                            +84 4 7300 1866<br/>
                        </div>
                        <hr />
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14897.925976156508!2d105.5264669!3d21.0134118!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xa3c62e29d8ab37e4!2sFPT+University%2C+Hoa+Lac+campus!5e0!3m2!1sen!2s!4v1491362330161" width="450" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>



<style>
    .map {
        min-width: 300px;
        min-height: 300px;
        width: 100%;
        height: 100%;
    }

    .header {
        background-color: #F5F5F5;
        color: #36A0FF;
        height: 70px;
        font-size: 27px;
        padding: 10px;
    }
</style>



<link href="<?php echo public_url('user')?>/css/main.css" rel="stylesheet">
<script src="<?php echo public_url('user')?>/js/jquery.js"></script>
<script src="<?php echo public_url('user') ?>/js/bootstrap.min.js"></script>
<script src="<?php echo public_url('user') ?>/js/jquery.scrollUp.min.js"></script>
<script src="<?php echo public_url('user') ?>/js/price-range.js"></script>
<script src="<?php echo public_url('user') ?>/js/jquery.prettyPhoto.js"></script>
<script src="<?php echo public_url('user') ?>/js/main.js"></script>
<script src="<?php echo public_url('user') ?>/js/login.js"></script>
</body>
</html>