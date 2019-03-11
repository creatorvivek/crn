 

<div class="row ">

  <div class="col-md-5">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Add Frenchise</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <?= form_open_multipart('frenchise/add',array("class"=>"form-horizontal")) ?>
        <div class="row"> 
        <div class="col-md-6">
          <label for="ticket" class="col-md-12 control-label"><span class="text-danger">*</span>Frenchise name</label>
          <div class="form-group">
            <input type="text" name="f_name" value="<?php echo $this->input->post('f_name'); ?>" class="form-control" id="f_name" required autocomplete="off" autofocus />
            <span class="text-danger f_name_error"></span>
          </div>
        </div>

        <div class="col-md-6">
          <label for="task" class="col-md-12 control-label"><span class="text-danger">*</span>Mobile Number</label>
          <div class="form-group">
            <input type="text" name="mobile" value="<?php echo $this->input->post("mobile"); ?>" maxlength=10 class="form-control" id="mobile" autocomplete="off" onkeypress="return isNumberKey(event)" onfocusout="validateMobile()"  />
            <span class="text-danger col-md-12 mobile_error"></span>
          </div>
        </div>

        <div class="col-md-6">
          <label for="task" class="col-md-12 control-label">Crn Number</label>
          <div class="form-group">
            <input type="text" name="crn_number" disabled  class="form-control" id="crn_number"  />
            <span class="text-danger crn_error"></span>
          </div>
        </div>
        <div class="col-md-6">
          <label for="task" class="col-md-12 control-label"><span class="text-danger">*</span>Email</label>
          <div class="form-group">
            <input type="text" name="email" value="<?php echo $this->input->post("email"); ?>" class="form-control" id="email"  />
            <span class="text-danger email_error"></span>
          </div>
        </div>
        <div class="col-md-12">
          <label for="task" class="col-md-12 control-label"><span class="text-danger">*</span>Address</label>
          <div class="form-group">
            <textarea row="7" class="form-control" name="address"></textarea>
            <span class="text-danger nas_error"></span>
          </div>
        </div>
        <div class="col-md-6">
          <label for="task" class="col-md-12 control-label">Upload Logo</label>
          <div class="form-group">
            <input type="file" name="logo"  class="form-control"   />
            <span class="text-danger nas_error"></span>
          </div>
        </div>
        <div class="col-md-6">
          <label for="task" class="col-md-12 control-label">Upload Profile Picture</label>
          <div class="form-group">
            <input type="file" name="profile_pic"  class="form-control"   />
            <span class="text-danger nas_error"></span>
          </div>
        </div>
        <!-- <div class="col-md-6">
          <label for="task" class="col-md-12 control-label"><span class="text-danger">*</span>Username</label>
          <div class="form-group">
            <input type="text" name="uname" value="<?php echo $this->input->post("uname"); ?>" class="form-control" id="username" onkeyup='usernameValidation()' />
            <span class="username_error"></span>
          </div>
        </div>
        <div class="col-md-6">
          <label for="task" class="col-md-12 control-label"><span class="text-danger">*</span>Password</label>
          <div class="form-group">
            <input type="password" name="pw" value="<?php echo $this->input->post("pw"); ?>" class="form-control" id="pw"  />
            <span class="text-danger nas_error"></span>
          </div>
        </div> -->
       
        <div class="col-md-6">
          <label for="task" class="col-md-12 control-label"><span class="text-danger">*</span>Frenchise Type</label>
          <select class="form-control" id="f_type" name="f_type">
            <option value="">--Select--</option>
            <option value="1">Fix capacity</option>
            <option value="2">Share Revenue</option>
          </select>
        </div>
        <div id="revenue_persent"  class="col-md-6" style="display:none;">
          <label for="task" class="col-md-12 control-label"><span class="text-danger">*</span>Revenue %</label>
          <div class="form-group">
          <input type="text" name="r_persent" class="form-control" data-toggle="tooltip" title="parent frenchise Revenue percentage">
        </div>
        </div>
        <br>
  <div class="col-sm-offset-4 col-sm-6 col-md-12" align="center">
<div class="form-group">
    <button type="submit" class="btn btn-success save-button">Save</button>
  </div>
</div>
        </div>



<?= form_close(); ?>
</div>
</div>
</div>
<script type="text/javascript">
  $('#f_type').change(function(){
var f_type=$('#f_type').val();
if(f_type==2)
{
  $('#revenue_persent').show();

}
else
{
  $('#revenue_persent').hide();
}

  });
function validateMobile()
 {
  var mobile=$('#mobile').val();
  
  if(mobile=='')
  {
    $('.mobile_error').show();
    $('.mobile_error').html('Please fill this field');
    $('#mobile').focus();
  }
  else
  {
    $('.mobile_error').hide();
    $.ajax({
      type: "post",
      url: "<?= base_url() ?>crn/mobileCheck",
      data:{mobile:mobile},
      success: function (data) {
        // console.log(data);
        var obj=JSON.parse(data);
        // console.log(obj);
        // console.log(obj.length);
        if(obj.length>0)
        {
          // $('.mobile_error').show();
          // $('.mobile_error').html('mobile number with crn='+obj[0].crn_id+'');
          $('#crn_number').val(obj[0].crn_id);
        }
        else
        {
          $('#crn_number').val(' ');
        }
      },
    });

  }
}
function usernameValidation()
   {
    var username=$('#username').val();
    $.ajax({
      type: "post",
      url: "<?= base_url() ?>crn/usernameCheck",
      data:{username:username},
      success: function (data) {
        // alert(data);
        var obj=JSON.parse(data)
        // var result=datas;
        if(obj.length>0)
        {

          $('.username_error').html('This username is already exist');
          $('.username_error').css('color','red');
          $('.save-button').attr("disabled", "disabled");
        }
        else
        {
          $('.username_error').html('This username is available');
          $('.username_error').css('color','green');
           $('.save-button').removeAttr("disabled");
        }
// console.log(obj);

},
})
  }
</script>