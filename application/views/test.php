<script src="<?php echo public_url('user/home')?>/js/main.js"></script>
<script src="<?php echo public_url('user/home')?>/js/bootstrap.min.js"></script>








<div class="form-group">
    <label for="subject">
        Tỉnh thành</label>
        <div class="input-group"> 
            <span class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span>
        </span>
        <select id="city_select"  class="form-control">
            <option value="">Chọn</option>
            <?php foreach ($provinces as $row) :?>

                <option data-subtext="<i class='glyphicon glyphicon-eye-open'></i>"   value="<?php echo $row->id?>" <?php echo ($this->input->post('province') == $row->id) ? 'selected' : '' ?>> <?php echo $row->local_name ?> </option>

            <?php endforeach;?>
        </select>
    </div>
</div>


<div class="form-group" id="area_section">
    <label for="area">
        Địa điểm chợ</label>
        <div class="input-group"  > 
            <span class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span>
        </span>
        <select    name="market" id="market" class="form-control" >
            <option value="">Chọn</option>

        </select>
    </div>
</div>






<script type="text/javascript">

    $(document).ready(function() {

     $('#city_select').on('change', function() {

      var province_id = $(this).val();

      $.ajax({
        contentType: "application/json; charset=utf-8",
          url: '<?php echo base_url() ?>test/get_view ',
          type: 'POST',
          dataType: 'json',
          data: {province_id: $(this).val()},

          success : function(data){
            alert(data);},
            error : function(httpReq,status,exception){
                alert(status+" "+exception);
            }
        })

      

      


  });
 });

    
</script>
