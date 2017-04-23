   <div class="table-responsive" style="margin-top: 5%">


        <table id="mytable" class="table table-bordred table-striped">

         <thead>

 
           <td class="description" style="color: blue">Hình ảnh</td>
           <td class="description" style="color: blue">Tên sản phẩm</td>
           
             <td class="description" style="color: blue">Ngày đăng</td>
           <td class="description" style="color: blue">Chỉnh sửa</td>
           <td class="description" style="color: blue">xóa</td>
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