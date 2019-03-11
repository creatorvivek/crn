

<div class="row">

  <div class="col-md-9">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Add Plan</h3> 
            <!-- <div class="checkbox"> -->
              <label style="font-weight:400"><input type="checkbox"  name="service_enable" value="enable" id="check"> Enabled </label>
            <!-- </div> -->
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <?= form_open('plan/add',array("class"=>"form-horizontal")) ?>
        <div class="row">
          <div class="col-md-6">
            <label for="service_name" class="col-md-12 control-label"><span class="text-danger">*</span>Plan name</label>
            <div class="form-group">
              <input type="text" name="service_name" value="<?php echo $this->input->post('service_name'); ?>" class="form-control" id="service_name" required  autofocus />
              <span class="text-danger service_name_error"></span>
            </div>
          </div>


          <div class="col-md-6">
            <label for="description" class="col-md-12 control-label "><span class="text-danger">*</span>Plan  Description</label>
            <div class="form-group">
              <input type="text" name="description" value="<?php echo $this->input->post("description"); ?>" class="form-control" id="description"  />
              <span class="text-danger nas_error"></span>
            </div>
          </div>
          <div class="col-md-6">
           <div class="form-group col-sm-6">
            <label>Service Enable</label>
            <div class="checkbox">
              <label style="font-weight:400"><input type="checkbox"  name="service_enable" value="enable" id="check"> Enabled </label>
            </div>
          </div>
        </div>
        <div class="col-md-5">
          <div class="form-group">
            <label  class="col-md-10 control-label"><span class="text-danger">*</span>Type of Service</label>
            <select class="form-control" data-placeholder="Select a member and group" name="service_type" id="service_type">
             <option value="">--select--</option>
             <option value="prepaid">Prepaid</option>
             <option value="postpaid">Postpaid</option>
             <option value="advance_rental">Advance Rental</option>
           </select>
         </div>
       </div>

       <div class="form-group col-md-6">
        <label><input type="checkbox" tabindex="13" id="enabledaytimelimit" name="enabledaytimelimit" data-toggle="modal" data-target="#myModal" value="1"  >&nbsp;&nbsp;Limit day and time</label> <span data-toggle="tooltip" title="you can select current plan work in which days and also what time to what time if you not selected this plan work in 7 day and 24 hour "><i class="fa fa-question-circle" aria-hidden="true"></i></span>
      </div>
      <div class="form-group col-md-6">
        <label><input type="checkbox" tabindex="13"  name="enableburst" data-toggle="modal" data-target="#burstModal"  value="1"  >&nbsp;&nbsp;Enable burst mode:</label> <span data-toggle="tooltip" title="to enable burst mode you can apply starting speed of plan just fill burst limit and give time in second in  burst time "><i class="fa fa-question-circle" aria-hidden="true"></i></span>
      </div>
      <div id="myModal" class="modal fade col-md-12" role="dialog">
        <div class="modal-dialog modal-lg">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>
            <div class="modal-body">
              <div class="col-md-12">
               <div class="form-group">
                <label>Select Days(optional)</label>
                <div class="col-md-12">

                  <select class="form-control select2" multiple  data-placeholder="Select days" name="member[]" data-toggle="tooltip" title="if select days plan will work in particular day if not selected then plan will working all days" name="selectday"
                  style="width: 100%;">



                  <option value="monday">Monday</option>
                  <option value="tuesday">Tuesday</option>
                  <option value="wednesday">Wednesday</option>
                  <option value="thrusday">Thrusday</option>
                  <option value="friday">Friday</option>      
                  <option value="saturday">Saturday</option>
                  <option value="sunday">Sunday</option>



                </select>
              </div>
            </div>

          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Time range:(optional)</label>
              <div class="row">
               <select class="form-control col-md-1" name="starttimeH">
                 <option>1</option>
                 <option>2</option>
                 <option>3</option>
                 <option>4</option>
                 <option>5</option>
                 <option>6</option> 
                 <option>7</option> 
                 <option>8</option>
                 <option>9</option>
                 <option>10</option>
                 <option>11</option> 
                 <option>12</option>
               </select>
               <select class="form-control col-md-1" name="starttimeM" >
                 <option>0</option>
                 <option>30</option>
               </select>
               <select class="form-control col-md-2"  name="starttime">
                 <option value="am">Am</option>
                 <option value="pm">Pm</option>
               </select>
               <div class="col-md-1">  - To -</div>
               <select class="form-control col-md-1" name="endtimeH">
                 <option>1</option>
                 <option>2</option>
                 <option>3</option>
                 <option>4</option>
                 <option>5</option>
                 <option>6</option>
                 <option>7</option> 
                 <option>8</option>
                 <option>9</option>
                 <option>10</option>
                 <option>11</option> 
                 <option>12</option>
               </select>
               <select class="form-control col-md-1" name="endtimeM">
                 <option>0</option>
                 <option>30</option>
               </select>
               <select class="form-control col-md-2" name="endtime">
                 <option value="am">Am</option>
                 <option value="pm">Pm</option>
               </select>
             </div>
           </div>
         </div>
       </div>
       <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div><!-- /.modal end -->


<div class="col-md-5">
  <div class="form-group">
    <label for="remark" class="col-md-10 control-label"><span class="text-danger">*</span>Type of Plan</label>
    <select class="form-control" data-placeholder="Select a member and group" name="plan_type" id="plan_type">
     <option value="prepaid">--select--</option>
     <option value="unlimited">Unlimited data plan</option>
     <option value="fup">fup</option>
     <option value="daily data limit">Daily data limit plan</option>
     <option value="custom plan">Custom Plan</option> 
   </select>
 </div>
</div>
<div class="col-md-5">
  <!-- blank for becaz we want col blank -->


</div>
<div id="basic_plan_parameter" class="col-md-10" style="display: none;">
  <div class="row">
   <div class="col-md-2">
    <label for="task" class="col-md-12 control-label"><span class="text-danger">*</span>Data Speed (Kb/s)</label>
    <div class="form-group">
      <!-- <div class="row">
       <div class="col-md-4">
       <input type="text" name="data_rate_u" value="<?php echo $this->input->post("data_rate_u"); ?>" class="form-control" id="data_rate_u" placeholder="uploading"  data-toggle="tooltip"
          title="uploading speed of your plan"
          />
        </div>
        <div class="col-md-4">
          <input type="text" name="data_rate_u" value="<?php echo $this->input->post("data_rate_u"); ?>" class="form-control" id="data_rate_u" placeholder="downloading" data-toggle="tooltip"
          title="downloading speed of your plan" />
        </div> -->
        <!-- <div class="col-md-4"> -->
          <input type="text" name="datalimit" value="<?php echo $this->input->post("datalimit"); ?>" class="form-control" id="datalimit"  />
          <!-- </div> -->
        </div>
        <span class="text-danger nas_error"></span>
      </div>
      <!-- </div> -->

      <div class="col-md-2">
        <label for="task" class="col-md-12 control-label"><span class="text-danger">*</span>Validity</label>
        <div class="form-group">
          <input type="text" name="validity" value="<?php echo $this->input->post("validity"); ?>" class="form-control" id="validity" data-toggle="tooltip" title="d=day   w=week  m=month (example='2w means 14 days' ,26d=26 days) "   />
          <span class="text-danger nas_error"></span>
        </div>
      </div>
      <div class="col-md-2">
        <label  class="col-md-12 control-label"><span class="text-danger">*</span>Amount</label>
        <div class="form-group">
          <input type="text" name="amount" value="<?php echo $this->input->post("amount"); ?>" class="form-control" id="amount" title="amount of plan excluded tax" />
          <span class="text-danger nas_error"></span>
        </div>
      </div>
    </div><!-- /.row -->
  </div><!-- /.basic plan parameter -->
  <div id="daily_data_parameter" class="col-md-5" style="display:none">
    <!-- <div class="col-md-5"> -->
      <label for="data" class="col-md-12 control-label"><span class="text-danger">*</span>Daily data(in mb)</label>
      <div class="form-group">
        <input type="text" name="daily_data" value="<?php echo $this->input->post("daily_data"); ?>" class="form-control" id="" title="example - 1gb, 500mb, 1.5gb ,4gb....etc" />
        <span class="text-danger nas_error"></span>
      </div>
      <label for="task" class="col-md-12 control-label"><span class="text-danger">*</span>After limit cross speed</label>
      <div class="form-group">
        <select class="form-control"  name="daily_data_limit_cross" id="daily_data_limit_cross">
         <option value="">--select--</option>
         <option value="unlimited">10mbps</option>
         <option value="sup">20mbps</option>
         <option value="custom_set">custom set</option>
         <!-- <option value="daily data limit">daily data limit</option> -->
       </select>
       <span class="text-danger nas_error"></span>
     </div>
     <div class="form-group">
       <label><input type="checkbox" tabindex="13"  name="customize_time" data-toggle="modal" data-target="#customize_time"  value="1"  >&nbsp;&nbsp;customize time in a day</label> <span data-toggle="tooltip" title="you can choose different plan in a particular hour"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
     </div>
   </div><!-- /daily_data_parameter -->
   <!-- </div> -->
   <div id="sup_parameter" class="col-md-5" style="display:none">
    <label for="data" class="col-md-12 control-label"><span class="text-danger">*</span>Total Data(in mb)</label>
    <div class="form-group">
      <input type="text" name="total_data" value="" class="form-control" id="" title="example - 1gb, 500mb, 1.5gb ,4gb....etc" />
      <span class="text-danger nas_error"></span>
    </div>
    <label for="task" class="col-md-12 control-label"><span class="text-danger">*</span>After Limit cross Data Rate (Kb/s)</label>
    <div class="form-group">
      <select class="form-control"  name="service_type" id="after_limit_crossing">
       <option value="prepaid">--select--</option>
       <option value="unlimited">10mbps</option>
       <option value="sup">20mbps</option>
       <option value="custom_set">custom set</option>
       <!-- <option value="daily data limit">daily data limit</option> -->
     </select>
     <span class="text-danger nas_error"></span>
   </div>
   
</div><!-- /sub_parameter -->
<div id="custom_speed_set" class="col-md-12"  style="display:none">
    <div class="form-group">
      <div class="row">
       <!-- <div class="col-md-4">
        <input type="text" name="datalimit" value="<?php echo $this->input->post("datalimit"); ?>" class="form-control" id="datalimit" placeholder="uploading" />
      </div> -->
      <!-- <div class="col-md-4">
        <input type="text" name="datalimit" value="<?php echo $this->input->post("datalimit"); ?>" class="form-control" id="datalimit" placeholder="downloading" />
      </div> -->
      <div class="col-md-5">
        <label for="task" class="col-md-12 control-label"><span class="text-danger">*</span>data speed (Kb/s)</label>
        <input type="text" name="datalimit" value="<?php echo $this->input->post("datalimit"); ?>" class="form-control" id="datalimit" placeholder="" />
      </div>
    </div>
    <span class="text-danger nas_error"></span>
  </div>
</div><!-- /custom_speed_set -->
<!-- custom plan -->
<div id="custom_plan" class="col-md-6" style="display:none">
  <div class="row">
   <div class="form-group col-md-6">
        <label><input type="checkbox" tabindex="13"  name="custom_enable_data_limit" id="custom_enable_data_limit"  value="1" >Enable Data limit:</label> <span data-toggle="tooltip" title=""><i class="fa fa-question-circle" aria-hidden="true"></i></span>
      </div>
   <div class="form-group col-md-5">
        <input type="text" name="custom_datalimit" id="custom_datalimit" class="form-control" disabled value="unlimited">
     </div>
     <div class="form-group col-md-6">
        <label><input type="checkbox" tabindex="13"  name=""  value="1"  id="custom_speed_after_limit"> After limit cross speed:</label> <span data-toggle="tooltip" title=""><i class="fa fa-question-circle" aria-hidden="true"></i></span>
      </div>
   <div class="form-group col-md-5">
        <input type="text" name="custom_speed_limit" class="form-control" id="custom_speedlimit" disabled >
     </div>
     <div class="form-group col-md-6">
        <label><input type="checkbox" tabindex="13"  name="" id="check_assign_day"  value="1" > Assign days for plan</label> <span data-toggle="tooltip" title=""><i class="fa fa-question-circle" aria-hidden="true"></i></span>
      </div>
      <div class="form-group">
       <label><input type="checkbox" tabindex="13"  name="customize_time" data-toggle="modal" data-target="#customize_time"  value="1"  >&nbsp;&nbsp;customize time in a day</label> <span data-toggle="tooltip" title="to enable burst mode you can apply starting speed of plan just fill burst limit and give time in second in  burst time "><i class="fa fa-question-circle" aria-hidden="true"></i></span>
     </div>
      

 <div class="col-md-12" id="assign_days" style="display:none">
   <div class="form-group">
    <label>Select Days(optional)</label>
    <div class="col-md-12">

      <select class="form-control select2" multiple  data-placeholder="Select days" name="member[]" data-toggle="tooltip" title="if select days plan will work in particular day if not selected then plan will working all days" name="selectday"
      style="width: 100%;">



      <option value="monday">Monday</option>
      <option value="tuesday">Tuesday</option>
      <option value="wednesday">Wednesday</option>
      <option value="thrusday">Thrusday</option>
      <option value="friday">Friday</option>      
      <option value="saturday">Saturday</option>
      <option value="sunday">Sunday</option>



    </select>
  </div>
</div>

</div>
</div><!-- / .row of id custom_plan -->
</div>
<!-- /.id custom plan -->

<div class="modal fade" id="burstModal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>

      </div>
      <div class="modal-body">
       <div class="burstmode" style="overflow:hidden;">
        <label>Burst limit (DL / UL):(kbps)</label>
        <div class="input-group">
          <input type="number" class="form-control" tabindex="14" name="dlburstlimit" value="" />

          <input type="number" class="form-control" tabindex="15" name="ulburstlimit" value="" />
        </div>      
        <label>Burst threshold (DL / UL):(kbps)</label>
        <div class="input-group">
          <input type="number" class="form-control" tabindex="16" name="dlburstthreshold" value="" />

          <input type="number" class="form-control" tabindex="17" name="ulburstthreshold" value="" />
        </div>       
        <label>Burst time (DL / UL):(kbps)</label>
        <div class="input-group">
          <input type="number" class="form-control" tabindex="18" name="dlbursttime" value="" />

          <input type="number" class="form-control" tabindex="19" name="ulbursttime" value="" />
        </div>
        <label>Priority:</label>
        <div class="input-group">
          <input type="text" class="form-control" name="priority" tabindex="20" value="8" />
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">ok</button>
    </div>
  </div>
</div>
</div><!-- /# burst modal -->
<!-- customize time in daily data limit -->
<div class="modal fade" id="customize_time" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>

      </div>
      <div class="modal-body">
       <div class="col-md-12">
        <div class="form-group">
          <label>Time range:(optional)</label>
          <div class="row">
           <select class="form-control col-md-1" name="starttimeH">
             <option>1</option>
             <option>2</option>
             <option>3</option>
             <option>4</option>
             <option>5</option>
             <option>6</option> 
             <option>7</option> 
             <option>8</option>
             <option>9</option>
             <option>10</option>
             <option>11</option> 
             <option>12</option>
           </select>
           <select class="form-control col-md-1" name="starttimeM" >
             <option>0</option>
             <option>30</option>
           </select>
           <select class="form-control col-md-2"  name="starttime">
             <option value="am">am</option>
             <option value="pm">pm</option>
           </select>
           <div class="col-md-1">  - To - </div>
           <select class="form-control col-md-1" name="endtimeH">
             <option>1</option>
             <option>2</option>
             <option>3</option>
             <option>4</option>
             <option>5</option>
             <option>6</option>
             <option>7</option> 
             <option>8</option>
             <option>9</option>
             <option>10</option>
             <option>11</option> 
             <option>12</option>
           </select>
           <select class="form-control col-md-1" name="endtimeM">
             <option>0</option>
             <option>30</option>
           </select>
           <select class="form-control col-md-2" name="endtime">
             <option value="am">Am</option>
             <option value="pm">Pm</option>
           </select>
           <br><br>
           <div class="form-group">
           <label for="data" class="col-md-12 control-label"><span class="text-danger">*</span>Total Data(in mb)</label>
            <input type="text" name="total_data" value="" class="form-control" id="" title="example - 1gb, 500mb, 1.5gb ,4gb....etc" />
            <span class="text-danger nas_error"></span>
          </div>
          <div class="form-group">
          <label for="task" class="col-md-12 control-label"><span class="text-danger">*</span>Data Speed (Kb/s)</label>

            <input type="text" name="datalimit" value="<?php echo $this->input->post("datalimit"); ?>" class="form-control" id="datalimit"  />

          </div>
          <div class="form-group">
       <label><input type="checkbox" tabindex="13"  name="customize_time" id="enable_burst" value="1"  >&nbsp;enable burst mode</label> <span data-toggle="tooltip" title="to enable burst mode you can apply starting speed of plan just fill burst limit and give time in second in  burst time "></span>
     </div>




        </div>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">ok</button>
  </div>
</div>
</div>
</div><!-- /# customize_time -->


</div><!-- /row under body  -->
</div><!-- /card-body -->
<input type="hidden" name="plan_name">
<input type="hidden" name="">


<div class="form-group">
  <div class="col-sm-offset-4 col-sm-5">
    <button type="submit" class="btn btn-success">Add Plan</button>
  </div>
</div>
<?= form_close(); ?>
</div>
</div>
</div>

<script type="text/javascript">
  $('#plan_type').change(function(){
    var plan=$('#plan_type').val();
    var service_type=$('#service_type').val();
    
    // alert(service_type);
    if(plan=="daily data limit")
    {
        // alert('hii');
        $('#basic_plan_parameter').show();
        $('#daily_data_parameter').show();
        $('#custom_speed_set').hide();
        $('#sup_parameter').hide();
          $('#custom_plan').hide();
        $('#daily_data_limit_cross').change(function(){
          var daily_data_limit_cross=$('#daily_data_limit_cross').val();
          // alert(daily_data_limit_cross);
          if(daily_data_limit_cross=="custom_set")
          {
            // alert('jjj');
            console.log('grg');
            $('#custom_speed_set').show();
            // $('#daily_data_parameter').show();
          }
        });
      }
      else if(plan=="sup")
      {
        $('#daily_data_parameter').hide();
        $('#basic_plan_parameter').show();
        $('#sup_parameter').show();
         $('#custom_plan').hide();
          $('#custom_speed_set').hide();
        $('#after_limit_crossing').change(function(){
          var v=$('#after_limit_crossing').val();
          // console.log(v);
          if($('#after_limit_crossing').val()=="custom_set")
          {
            $('#custom_speed_set').show();
          }
          else
          {
            $('#custom_speed_set').hide();
          }
        });


      }
      else if(plan=="unlimited")
      {
        $('#basic_plan_parameter').show();
        $('#daily_data_parameter').hide();
        $('#custom_speed_set').hide();
        $('#sup_parameter').hide();
         $('#custom_plan').hide();
      }
      else if(plan=="custom plan")
      {
       $('#basic_plan_parameter').show();
       $('#custom_plan').show();
        $('#daily_data_parameter').hide();
        $('#custom_speed_set').hide();
        $('#sup_parameter').hide();


     }
     else
     {
      $('#basic_plan_parameter').hide();
      $('#daily_data_parameter').hide();
      $('#custom_speed_set').hide();
      $('#sup_parameter').hide();
       $('#custom_plan').hide();
    }


  });


  function custom_speed()
  {
    $('#sup_parameter').show();

  }
  // $("#enableburst").click(function () 
  // {
  //   $(".burstmode").slideToggle();
  // }); 
  $('#check_assign_day').click(function(){
    $('#assign_days').toggle();
  });
/*custom plan enable datalimit*/
 $('#custom_enable_data_limit').click(function(){
    if($(this).prop("checked") == true){
    $('#custom_datalimit').prop("disabled",false);

    $('#custom_datalimit').val('');
  }
  else
  {

    // alert('ff');
    $('#custom_datalimit').prop("disabled",true);
    $('#custom_datalimit').val('unlimited');
  }
  });
/*custom plan enable data speed after limit*/
$('#custom_speed_after_limit').click(function(){
    if($(this).prop("checked") == true){
    $('#custom_speedlimit').prop("disabled",false);

  
  }
  else
  {

    // alert('ff');
    $('#custom_speedlimit').prop("disabled",true);
 
  }
  });
$('#enable_burst').click(function(){
   $('.burstmode').toggle();
  });
</script>
<script type="text/javascript">

 $(document).ready(function() {
    //Initialize Select2 Elements
    $('.select2').select2();
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker         : true,
      timePickerIncrement: 30,
      format             : 'MM/DD/YYYY h:mm A'
    })
  });
</script>