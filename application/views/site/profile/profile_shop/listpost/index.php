
<script src="<?php echo public_url('user/home') ?>/js/main.js"></script>
<script type="text/javascript" src="<?php echo public_url('user/home') ?>/js/moment-2.4.0.js"></script>
<script src="<?php echo public_url('user/home') ?>/js/bootstrap-datetimepicker.min.js"></script>
<link href="<?php echo public_url('user/home')?>/css/bootstrap-datetimepicker.css" rel="stylesheet">


<script type="text/javascript">
  $(function() {              
           // Bootstrap DateTimePicker v4
           $('#datePicker').datetimepicker({
             format: 'DD/MM/YYYY',


           });
           $('#datePicker1').datetimepicker({
             format: 'DD/MM/YYYY',


           });

         });      
       </script>
<div class="container" style="width: 100%">
	<div class="row">
		

    <div class="col-md-12">
      <h4>Danh sách tin của bạn</h4>
    
  
          <form id="eventForm" action="<?php echo user_url('profile/search_post') ?>" method="post" class="form-horizontal">

            <div class="form-group" style="width: 60%;margin-left: 15%">
              <label class="col-xs-3 control-label">Tên sản phẩm </label>
              <div class="input-group"> 
                <span class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span>
              </span>
              <input  type="text" class="form-control" name="product_name" style="width: 50%" />
            </div>
          </div>


          <div class="form-group" style="float: left;width: 50%">
            <label class="col-xs-3 control-label">Từ ngày</label>
            <div class="col-xs-5 date" >
              <div class="input-group input-append date" id="datePicker" >
                <input  type="text" class="form-control"  name="from_date"  />
                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar " ></span></span>
              </div>


            </div>
          </div> 


          <div class="form-group" style="float: left;width: 50%">
            <label class="col-xs-3 control-label">Đến ngày</label>
            <div class="col-xs-5 date" >
              <div class="input-group input-append date" id="datePicker1">
                <input  type="text" class="form-control" name="end_date" />
                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
              </div>

            </div>
          </div>


          <div class="form-group">
            <div class="col-xs-6 col-xs-offset-4">
              <button type="submit" class="btn btn-info">Tìm kiếm</button>
            </div>
          </div>
        </form>
      <div class="table-responsive">


        <table id="mytable" class="table table-bordred table-striped">

         <thead>

 
           <td class="description">Hình ảnh</td>
           <td class="description">Tên sản phẩm</td>
            <td class="description">Số lượng</td>
             <td class="description">Ngày đăng</td>
           <td class="description">Chỉnh sửa</td>
           <td class="description">xóa</td>
         </thead>
         <tbody>
           <?php foreach ($list as $row):?>
             <tr>
           
              <td class="cart_description">
                <img  height="50"  src="<?php echo base_url('upload/product/'.$row->image_link)?>" alt="">
              </td>
              <td class="cart_description">
          <?php echo $row->product_name?>
              </td>
              <td class="cart_description">
          <?php echo $row->quantity?>
              </td>
              <td class="cart_description">
               <?php echo mdate('%d-%m-%Y',$row->created)?>
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




