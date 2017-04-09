   <form id="eventForm" action="" method="post" class="form-horizontal">

   	<div class="form-group" style="width: 60%;margin-left: 15%">
   	<label class="col-xs-3 control-label " style="color: rgba(32, 86, 171, 0.96)">Giá sản phẩm/1Kg </label>
   		<div class="input-group"> 
   			<span class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span>
   		</span>
   		<input  type="text" class="form-control" name="price" value="<?php echo set_value('price') ?>" style="width: 50%" />
   	</div>
   </div>
    <div class="form-group">
            <div class="col-xs-6 col-xs-offset-4">
              <button type="submit" class="btn btn-info">Đặt giá</button>

            </div>
          </div>

</form>