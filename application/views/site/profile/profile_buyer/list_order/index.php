<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script>
<script src="<?php echo public_url('user') ?>/js/bootstrap.min.js"></script>

<div class="container" style="width: 100%">
    <div class="row">


        <div class="col-md-12">
            <h4>Danh sách tin của bạn</h4>
            <div class="table-responsive">


                <table id="mytable" class="table table-bordred table-striped">

                    <thead>


                    <td class="description">Tên sản phẩm</td>
                    <td class="description">Địa chỉ</td>
                    <td class="description">Ngày đặt hàng</td>
                    <td class="description">Tên cửa hàng</td>

                    <td class="description">Số lượng</td>
                    <td class="description">Trạng thái</td>

                    </thead>
                    <tbody>
<!--                    --><?php foreach ($list as $row):?>
                        <tr>
                            <td class="cart_description">
                                <b>  <?php echo $row->product_name?></b>
                            </td>
                            <td class="cart_description">
                                <b> <?php echo $row->description?></b>
                            </td>
                            <td class="cart_description">
                                <b>  <?php echo mdate('%d-%m-%Y',$row->date_order)?></b>
                            </td>
                              <td class="cart_description">
                                <a href=""><b>  <?php echo $row->shop_name?></b></a>
                            </td>
                            <td class="cart_description">
                                <b>  <?php echo $row->quantity?></b>
                            </td>
                            <td class="cart_description">

                                            <?php if (isset($row->status)) {?>
                                                                                           
                                    <b> <?php if($row->status==0){
                                                echo "Đơn hàng bị hủy";}?>
                                               <?php if($row->status==1){echo "Đang xử lý";}?>
                                              <?php  if($row->status==2){echo "Đã gửi hàng";}
                                    ?></b>

                                    <?php } ?>
                            </td>


                        </tr>
<!--                    --><?php endforeach;?>


                    </tbody>

                </table>

                <div class="clearfix"></div>
                <ul class="pagination pull-right">
                    <li><?php echo $this->pagination->create_links();?></li>
                </ul>

            </div>

        </div>
    </div>
</div>




<script type="text/javascript">
    $(document).ready(function(){
        $("#mytable #checkall").click(function () {
            if ($("#mytable #checkall").is(':checked')) {
                $("#mytable input[type=checkbox]").each(function () {
                    $(this).prop("checked", true);
                });

            } else {
                $("#mytable input[type=checkbox]").each(function () {
                    $(this).prop("checked", false);
                });
            }
        });

        $("[data-toggle=tooltip]").tooltip();
    });
</script>