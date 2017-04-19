
<script src="<?php echo public_url('user') ?>/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/chart-master/Chart.js"></script>
<script rel="stylesheet" type="text/css" href="<?php echo public_url('user/home')?>/js/bootstrap-datetimepicker.min.js"></script>
<script rel="stylesheet" type="text/css" href="<?php echo public_url('user/home')?>/js/bootstrap-datetimepicker.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo public_url('user/home/css')?>/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo public_url('user/home/css')?>/bootstrap-datetimepicker.css">
<div class="container" style="width: 100%">
    <div class="row">


        <div class="col-md-12">
            <div class="col-md-4" style="margin-left: -10%">
                <ul class="breadcrumb">
                    <li><a href="<?php echo user_url('profile/list_debt_buyer') ?>">Công nợ</a>
                    </li>
                    <li>chi tiết</li>
                </ul>
            </div>
            <div class="col-md-6">

            <div class="form-group ">
                <label for="">
                    Order_id</label>
                <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span>
                                </span>
                    <input type="text" class="form-control " style="text-align: center;" placeholder=" Order_id" name="order_id" value=""  readonly="readonly"/></div>
            </div>

                <div class="form-group" style="width: 43%;margin-left: 0.8%">
                    <label for="email">
                        Ngày nhận hàng dự kiến</label>
                    <div class="input-group input-append date" id="datePicker" >
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>
                        <input type="text" class="form-control"  name="date_receive" value=""  />

                    </div>
                    <div class="clear error" name="name_error"></div>

                </div>


            <div class="form-group">
                <label for="">
                    Amount</label>
                <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-hdd"></span>
                                </span>
                    <input type="text" style="width: 50%" class="form-control"  placeholder="amount" name="amount" value="" required="required" /></div>
                <div class="clear error" name="name_error"></div>
            </div>

            </div>
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary pull-right" >
                    Thêm số tiền</button>
            </div>

        </div>
    </div>
</div>


