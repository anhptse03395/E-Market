<style>
    .thumbnail
    {
        margin-bottom: 20px;
        padding: 0px;
        -webkit-border-radius: 0px;
        -moz-border-radius: 0px;
        border-radius: 0px;
    }

    .item.list-group-item
    {
        float: none;
        width: 50%;
        background-color: #fff;
        margin-bottom: 10px;
    }
    .item.list-group-item:nth-of-type(odd):hover,.item.list-group-item:hover
    {
        background: #428bca;
    }

    .item.list-group-item .list-group-image
    {
        margin-right: 10px;
    }
    .item.list-group-item .thumbnail
    {
        margin-bottom: 0px;
    }
    .item.list-group-item .caption
    {
        padding: 9px 9px 0px 9px;
    }
    .item.list-group-item:nth-of-type(odd)
    {
        background: #eeeeee;
    }

    .item.list-group-item:before, .item.list-group-item:after
    {
        display: table;
        content: " ";
    }

    .item.list-group-item img
    {
        float: left;
    }
    .item.list-group-item:after
    {
        clear: both;
    }
    .list-group-item-text
    {
        margin: 0 0 11px;
    }

</style>



<html>


<head>
    <?php
    $this->load->view('site/head');
    ?>

</head>

<body>
<div id="header">
    <?php $this->load->view('site/header'); ?>
</div>
<form action="<?php echo user_url('listproduct/product_detail_shop') ?>" method="post">

<div class="container">
    <div class="well well-sm">
        <strong>Category Title</strong>
        <div class="btn-group">
            <a href="#" id="list" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-th-list">
            </span> List</a> <a href="#" id="grid" class="btn btn-default btn-sm"><span
                    class="glyphicon glyphicon-th"></span> Grid</a>
        </div>
    </div>
    <div id="products" class="row list-group" >
        <?php foreach ($product as $row):?>
            <div class="item  col-xs-4 col-lg-4">
            <div class="thumbnail">
                <img class="group list-group-image" src="<?php echo base_url('upload/product/'.$row->image_link)?>" alt="" />

                <div class="caption">
                    <h4 class="group inner list-group-item-heading">
                        <?php echo $row->product_name ?></h4>
                    <p class="group inner list-group-item-text">
                        <?php echo $row->description ?></p>
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <p class="lead">
                                <?php $row->quantity ?></p>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <a class="btn btn-success" href="<?php echo user_url('listproduct/product_detail/'.$row->id)?>">Xem chi tiet</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach;?>
    </div>

</div>
    <div class="clearfix"></div>
    <ul class="pagination pull-right">
        <li><?php echo $this->pagination->create_links();?></li>
    </ul>


</form>
</body>


<script src="<?php echo public_url('user')?>/js/jquery.js"></script>
<script src="<?php echo public_url('user') ?>/js/bootstrap.min.js"></script>
<script src="<?php echo public_url('user') ?>/js/jquery.scrollUp.min.js"></script>
<script src="<?php echo public_url('user') ?>/js/price-range.js"></script>
<script src="<?php echo public_url('user') ?>/js/jquery.prettyPhoto.js"></script>
<script src="<?php echo public_url('user') ?>/js/main.js"></script>
<script src="<?php echo public_url('user') ?>/js/detail_shop.js"></script>

</html>