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

 
           <td class="image">Hình ảnh</td>
           <td class="description">Tên sản phẩm</td>
           <th>Chỉnh sửa</th>

           <th>Xóa</th>
         </thead>
         <tbody>
           <?php foreach ($list as $row):?>
             <tr>
           
              <td class="cart_description">
                <a href=""><img  height="50"  src="<?php echo base_url('upload/product/'.$row->image_link)?>" alt=""></a>
              </td>
              <td class="cart_description">
                <b> <a href=""> <?php echo $row->product_name?></b>
              </td>
              <td> <a class="glyphicon glyphicon-wrench" title="Chỉnh sửa" href="<?php echo user_url('profile/edit_post/'.$row->id)?>">
            
            </a></td>
              <td><a class="glyphicon glyphicon-trash" title="Xóa" href="<?php echo user_url('profile/del/'.$row->id)?>">
                
              </a></td>
            </tr>
          <?php endforeach;?>


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