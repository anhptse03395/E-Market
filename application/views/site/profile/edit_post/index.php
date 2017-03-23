<style type="text/css">
  .help-block{
    color:#b94a48;
    }

</style>
<div class="container">
  <div class="row">
    <form class="form-horizontal">
      <fieldset>

        <!-- Form Name -->
        <legend>Chỉnh sửa sản phẩm</legend>

        <!-- Text input-->
        <div class="control-group">
          <label class="control-label" for="full_name">Full Name</label>
          <div class="controls">
            <input id="full_name" name="full_name" placeholder="Enter your full name" class="input-xlarge" type="text">

          </div>
        </div>




        <!-- Text input-->
        <div class="control-group">
          <label class="control-label" for="email">Email</label>
          <div class="controls">
            <input id="email" name="email" placeholder="Enter Your Email." class="input-xlarge" type="text">
            <p class="help-block">Error</p>
          </div>
        </div>

        <!-- Text input-->
        <div class="control-group">
          <label class="control-label" for="mobile">Mobile No.</label>
          <div class="controls">
            <input id="mobile" name="mobile" placeholder="Enter Your Mobile Number" class="input-xlarge" type="text">
            <p class="help-block">Error</p>
          </div>
        </div>




        <!-- Multiple Radios (inline) -->


        <!-- Select Basic -->
        <div class="control-group">
          <label class="control-label" for="course">Apply For</label>
          <div class="controls">
            <select id="course" name="course"  style="width: 10%" class="input-xlarge">
              <option>Select Course</option>
              <option>Computer Course</option>
              <option>University Course</option>
              <option>Other Course</option>
            </select>
          </div>
        </div>

        <!-- Textarea -->
        <div class="control-group">
          <label class="control-label" for="Address">Address</label>
          <div class="controls">                     
            <textarea id="Address" name="Address"  style="width: 10%" >Address</textarea>
          </div>
        </div>

        <!-- File Button --> 
        <div class="control-group">
          <label class="control-label" for="photo">Photo</label>
          <div class="controls">
            <input id="photo" name="photo" class="input-file" type="file">
          </div>
        </div>

        <!-- Button -->
        <div class="control-group">
          <label class="control-label" for="submit"></label>
          <div class="controls">
            <button id="submit" name="submit" class="btn btn-primary">Submit</button>
          </div>
        </div>

      </fieldset>
    </form>

  </div>
</div>