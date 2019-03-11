
<div class="row">
  <div class="col-md-4">

    <div class="card">
      <div class="card-header">
        <h3 class="card-title">ADD GROUP</h3>
      </div>
      <div class="card-body">
         <?php echo form_open('group/add',array("class"=>"form-horizontal")); ?>
        <div class="form-group">
          <label for="Name" class="col-md-10 control-label"><span class="text-danger">*</span>Group Name</label>
          <div class="col-md-10">
            <input type="text" name="name" value="<?php echo $this->input->post('name'); ?>" class="form-control" id="name" required  autofocus />
            <span class="text-danger name_error"></span>
          </div>
        </div>


        <div class="form-group">
          <label for="head" class="col-md-10 control-label"><span class="text-danger">*</span>Head</label>
          <div class="col-md-10">
            <input type="text" name="head" value="<?php echo $this->input->post('head'); ?>" class="form-control" id="head" required  />
            <span class="text-danger nas_error"></span>
          </div>
        </div>

        <div class="form-group">
          <label for="description" class="col-md-10 control-label"><span class="text-danger">*</span>Description</label>
          <div class="col-md-10">
            <input type="text" name="description" value="<?php echo $this->input->post('description'); ?>" class="form-control" id="description" required />
            <span class="text-danger"><?php echo form_error('description');?></span>
          </div>
        </div>
        <div class="form-group">
          <label for="f_detail" class="col-md-10 control-label">Frenchizy Detail</label>
          <div class="col-md-10">
            <input type="text" name="f_detail" value="<?php echo $this->input->post('f_detail'); ?>" class="form-control" id="f_detail" data-toggle="tooltip" data-placement="top" title=""/>
            <span class="text-danger ip_error"> </span>
          </div>
        </div>
        <div class="form-group">
          <label for="business" class="col-md-10 control-label"><span class="text-danger">*</span>Business</label>
          <div class="col-md-10">
            <input type="text" name="business" value="<?php echo $this->input->post('business'); ?>" class="form-control" id="business" required />
            <span class="text-danger"></span>
          </div>
        </div>
        <div class="form-group">
          <label>Add Member</label>
          <div class="col-md-10">
            
            <select class="form-control select2" multiple  data-placeholder="Select a member and group" name="member[]  "
            style="width: 100%;">
               <?php for($i=0;$i<count($staff);$i++) { ?>
              
       
            <option value="<?= $staff[$i]['id'] ?>"><?= $staff[$i]['name'] ?></option>
    <?php  }  ?> 

            
          </select>
        </div>
      </div>
      <!-- /.form-group -->
      <div class="form-group">
        <div class="col-sm-offset-10 col-sm-10">
          <button type="submit" class="btn btn-success">ADD</button>
        </div>
      </div>

       <?php echo form_close(); ?> 

    </div><!--card body -->
  </div><!--card  -->
</div><!--card col  -->
</div><!--row  -->
<!-- <script type="text/javascript">
  function ip()
  {

   var ip_address = $('#ip_address').val();
 // console.log(ip_address);                
 if(!ip_address)
 {
   $('.ip_error').html("ip address can not be empty");
   $('#ip_address').focus();
 }
 else{
  validateIp();
  function validateIp() {     
    $.ajax({  
      url:"<?= base_url()?>nas/validateIpAddress",  
      method:"post",  
      data:{ip:ip_address},  
      success:function(data){ 
        console.log(data);
        $('.ip_error').html(data); 
        if(data=="Invalid ip address")
        {
          $('#ip_address').focus();
        }
      }
    });
  }
}
}
function validationNas()
{

 var nas_id = $('#nas_id').val();
 // console.log(nas_id);                
 if(!nas_id)
 {
   $('.nas_error').html("nas id can not be empty");
   $('#nas_id').focus();
 }
 else
 {
  $('.nas_error').hide();
}
}
function validationNasName()
{

 var name= $('#name').val();
 // console.log(nas_id);                
 if(!name)
 {
   $('.name_error').html("nas name can not be empty");
   $('#name').focus();
 }
 else
 {
  $('.name_error').hide();
}
}
</script> -->
<script type="text/javascript">
  $(document).ready(function() {
    //Initialize Select2 Elements
    $('.select2').select2();

    //Datemask dd/mm/yyyy
    
  });
</script>