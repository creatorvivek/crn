
<style type="text/css">
::placeholder {
  /*color: blue;*/
  font-size:15px;
}
.form-control { font-size:15px;}

@media (min-width: 992px) {
  ::placeholder {
    /*color: blue;*/
    font-size:12px;

  }
  .form-control { font-size:12px;}
  select ::placeholder {font-size: 8px;}
  .input-group-text
  {
   font-size:10px;
 }
}
.input-group-text
{
 font-size:15px;
}
#ajax_indicator
{
  position: absolute;
  top:40%;
  left:50%;
  z-index: 3000;
  font-size: 30px;
}
</style>
<div id="ajax_indicator"><i class="fa fa-spinner fa-spin" style="font-size:44px;"></i></div>
<div class="row">

  <div class="col-md-8">
    <div class="card">
     
      <form id="form" method="post">
        <div class="card-header">
          <div class="row">
            <div class="col-md-2">
              <h3 class="card-title">Add Plan</h3> 
            </div>
            <div class="col-md-5">
              <label style="font-weight:200"><input type="checkbox"  name="service_enable" value="1" id="check" checked> Enabled </label>
            </div>
          </div>
          <!-- <div class="checkbox"> -->
            <!-- </div> -->
          </div> 
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">

                <div class="form-group">
                  <input type="text" name="plan_name"  class="form-control" id="plan_name" required  autofocus placeholder="Plan name" tabindex=1 data-toggle="tooltip" title="plan name">
                  <span class="text-danger plan_name_error"></span>
                </div>
                <!-- </div> -->
                <!-- <div class="col-md-5"> -->
                  <div class="form-group" tabindex=3>
                   
                    <select class="form-control select2"  id="plan_type" onfocusin="validation()" onfocusout="focusburst()"  tabindex=3  data-placeholder="Plan type" multiple style="width: 100%;" >
                      <!-- <option value="" disable>Plan Type</option> -->
                      <?php 
                      // var_dump($plan_type);
                      $length=count($plan_type);
                        // echo $length;
                      for($i=0;$i<$length;$i++) { ?>
                        <option value="<?= $plan_type[$i]['id'] ?>"><?= $plan_type[$i]['type'] ?></option>
                        <!-- <option value="postpaid">Postpaid</option> -->
                        <!-- <option value="advance_rental">Advance Rental</option> -->
                      <?php } ?>
                    </select>
                  </div>
                  
                  <div class="input-group">
                    <input type="text" name="validity" placeholder="Validity" class="form-control" id="validity" disabled onkeypress="return isNumberKey(event)"  tabindex=5>
                    <select disabled tabindex=5  name="validity_unit" class="form-control" id="validity_unit" ><option value="">Select</option><option value="1">Days</option><option value="2">Week</option><option value="3">Month</option><option value="4">Year</option></select>

                    <input class="form-control" disabled type="number" name="amount" id="amount" placeholder="Amount" tabindex="6" onkeypress="return isNumberKey(event)">
                    <span class="input-group-addon"><button type="button" tabindex="7" class="btn btn-success addMutipleValidity" >Add</button></span>
                  </div>
                  <br>


                </div>

                <!-- </div> -->
                <div class="col-md-6">
                  <div class="form-group">
                    <textarea placeholder="Plan description"  class="form-control" id="discription" onfocusin="validation()"  rows="3" tabindex=2></textarea>
                    <span class="text-danger nas_error"></span>
                  </div>
                  <!-- </div> -->

                   <div class="col-md-5">
                  <div class="form-group">
                    <!-- <label  class="col-md-10 control-label"><span class="text-danger">*</span>Type of Service</label> -->
                    <select class="form-control" name="burst" id="burstmode" tabindex=4 onfocusout="enableValidity()">
                      <option value="">Burst mode</option>
                      <option value="disable">disable</option>
                      <option value="double">enable by double rate</option>
                      <option value="custom_burst_mode">custom</option>
                    </select>
                    <span class="text-danger burst_error"></span>
                  </div>
                </div>
                <!-- <div class="col-md-4"> -->
                <!--  <div class="form-group">
                   <select class="form-control select2"  id="plan_type" onfocusin="validation()" onfocusout="focusburst()"  tabindex=3  data-placeholder="Plan type" multiple style="width: 80%;" >
                     
                      <?php 
                    
                      $length=count($plan_type);
                       
                      for($i=0;$i<$length;$i++) { ?>
                        <option value="<?= $plan_type[$i]['id'] ?>"><?= $plan_type[$i]['type'] ?></option>
                      
                      <?php } ?>
                    </select>
                </div> -->
              <!-- </div> -->
              <!-- </div> -->
            </div>
              </div><!-- /row -->
              
              <div id="addValidityId"></div>
              <br><br>
              <div class="row" id="form_2" style="display:none">


                <div class="col-md-6">
                  <div class="form-group">
                    <!-- <label  class="col-md-10 control-label"><span class="text-danger">*</span>Type of Service</label> -->
                    <select class="form-control"  name="priority" id="priority" tabindex=10>
                      <option value="">Priority</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                      <option value="6">6</option>
                      <option value="7">7</option>
                      <option value="8">8</option>

                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <!-- <label  class="col-md-10 control-label"><span class="text-danger">*</span>Type of Service</label> -->
                    <select class="form-control"  name="vacation_mode" id="vacation_mode" tabindex=11>
                      <option value="" hidden >Vacation mode </option>
                      <option value="1" default>Enable</option>
                      <option value="0">Disable</option>


                    </select>
                  </div>

                </div>
                <!-- <div id="totalbox"> -->


                  <!-- </div> -->



                  <div class="col-md-6" id="addRowsExtra"></div>




                  <!-- </div> -->
                  <!-- ./totalbox -->

                </div><!-- /.row -->



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
                            <input type="text" class="form-control dlburstlimit" tabindex="14" onkeypress="return isNumberKey(event)" name="dlburstlimit"   />

                            <input type="text" class="form-control ulburstlimit" tabindex="15" onkeypress="return isNumberKey(event)" name="ulburstlimit"  />
                          </div>      
                          <label>Burst threshold (DL / UL):(kbps)</label>
                          <div class="input-group">
                            <input type="text" class="form-control dlburstthreshold" onkeypress="return isNumberKey(event)" tabindex="16" name="dlburstthreshold"  />

                            <input type="text" class="form-control ulburstthreshold" tabindex="17" onkeypress="return isNumberKey(event)" name="ulburstthreshold"  />
                          </div>       
                          <label>Burst time (DL / UL):(kbps)</label>
                          <div class="input-group">
                            <input type="text" class="form-control dlbursttime" tabindex="18" onkeypress="return isNumberKey(event)" name="dlbursttime" />

                            <input type="text" class="form-control ulbursttime" tabindex="19" onkeypress="return isNumberKey(event)" name="ulbursttime" />
                          </div>
                          <label>Priority:</label>
                          <div class="input-group">
                            <input type="text" class="form-control burst_priority" name="priority" onkeypress="return isNumberKey(event)" tabindex="20" value="8" />
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">ok</button>
                      </div>
                    </div>
                  </div>
                </div><!-- /# burst modal -->



              </div><!-- /row under body  -->
            </div><!-- /card -->
            <div id="form_3"  style="display:none;">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                   <div class="col-md-6 col-sm-6" id="add_row" >
                    <div class="row boxstylerow">
                      <div class="col-md-3 col-sm-3">
                        <input type="text" name="download_data" placeholder="Download data"  class="form-control download_data" onkeyup="disableTotalData();" tabindex=12 data-toggle="tooltip" title="bydefault download data limit is 0,here 0 indicate unlimited">
                      </div>
                      <div class="col-md-3 col-sm-6 col-xs-3">
                        <input type="text" name="upload_data"  class="form-control upload_data"  placeholder="Upload data" onkeyup="disableTotalData();" tabindex=13 data-toggle="tooltip" title="bydefault upload data limit is 0,here 0 indicate unlimited">
                      </div>
                      <div class="col-md-3 col-sm-3">
                       <input type="text" name="data_transfer"  class="form-control data_transfer" placeholder="Data Transfer" onkeyup="disableOther()" tabindex=14>
                     </div>
                     <div class="col-md-2 col-sm-3">
                       <select class="form-control data_unit" tabindex=15><option value="2">Mb</option><option value="1">Kb</option><option value="3">Gb</option></select>
                     </div>


                     <div class="col-md-3">
                       <input type="text" name="" placeholder="Download Speed" onkeypress="return isNumberKey(event)"  class="form-control download_speed" tabindex=16 onkeyup="disableTotalSpeed()"></div>
                       <div class="col-md-3">
                        <input type="text" name="upload_speed[]" onkeypress="return isNumberKey(event)"  class="form-control upload_speed" placeholder="Upload Speed" tabindex=17 onkeyup="disableTotalSpeed()">
                      </div>
                      <div class="col-md-3">
                        <input type="text" name="transfer_speed" onkeypress="return isNumberKey(event)" class="form-control transfer_speed" placeholder="Transfer Speed" tabindex=18 onkeyup="disableOther()" >
                      </div>
                      <div class="col-md-2">
                        <select class="form-control speed_unit"  tabindex=19><option value="2">Mb/s</option><option value="1">Kb/s</option><option value="3">Gb/s</option></select>
                      </div>

                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="row">
                      <div class="col-md-6" id="datalimitselect">
                        <div class="row">
                          <div class="col-md-4">
                            <!-- <div class="form-group"> -->
                              <input type="text" name="" class="form-control" placeholder="Limit">
                              <!-- </div> -->
                            </div>
                            <div class="col-md-4">
                              <!-- <div class="form-group"> -->
                               
                                <select class="form-control" id="validity_unit" ><option value=''>select</option><option value="1">Days</option><option value="2">Week</option><option value="3">Month</option><option value="4">Year</option></select>
                                

                                <!-- </div> -->
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <!-- <label  class="col-md-10 control-label"><span class="text-danger">*</span>Type of Service</label> -->
                                  <select class="form-control"  name="repeat_mode" id="repeat_mode">
                                    <option value="">Repeat Mode</option>
                                    <option value="once">Once</option>
                                    <option value="daily">Unlimited</option>

                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="input-group">
                              <input type="text" name="" placeholder="00 H" onkeypress="return isNumberKey(event)"  class="form-control startH">
                              <!-- <span class="input-group-addon">:</span> -->
                              <input type="text" name="" placeholder="00 M" onkeypress="return isNumberKey(event)" class="form-control startM">
                              <span class="input-group-text">To</span>
                              <input type="text" name="" placeholder="23 H" onkeypress="return isNumberKey(event)" class="form-control endH">
                              <input type="text" name="" placeholder="59 M" onkeypress="return isNumberKey(event)" class="form-control endM">

                            </div>
                          </div>
                          <!-- </div> -->
                        </div><!-- /.row -->

                        <div class="col-md-12">
                          <div class="row pull-right">
                            <div class="col">
                              <!-- Default inline 1-->
                              <label class="checkbox-inline" data-toggle="tooltip" title="Monday">
                                <input type="checkbox"   class="monday" value="1" checked>&nbsp M
                              </label>&nbsp&nbsp 
                              <label class="checkbox-inline" data-toggle="tooltip" title="Tuesday">
                                <input type="checkbox" class="tuesday" value="1" checked>&nbspT
                              </label>&nbsp&nbsp 
                              <label class="checkbox-inline" data-toggle="tooltip" title="Wednesday">
                                <input type="checkbox"  class="wednesday" value="1" checked>&nbspW
                              </label>&nbsp&nbsp 
                              <label class="checkbox-inline" data-toggle="tooltip" title="Thrusday">
                                <input type="checkbox" class="thrusday" value="1" checked>&nbspT
                              </label>&nbsp&nbsp 
                              <label class="checkbox-inline" data-toggle="tooltip" title="Friday">
                                <input type="checkbox" class="friday" value="1" checked>&nbspF
                              </label>&nbsp&nbsp  
                              <label class="checkbox-inline" data-toggle="tooltip" title="Saturday">
                                <input type="checkbox" class="saturday" value="1" checked>&nbspS
                              </label>&nbsp&nbsp  
                              <label class="checkbox-inline" data-toggle="tooltip" title="Sunday">
                                <input type="checkbox" class="sunday" value="1" checked>&nbspSu
                              </label>
                             <!--  <div class="custom-control custom-checkbox custom-control-inline" data-toggle="tooltip" title="thrusday">
                                <input type="checkbox" class="custom-control-input thrusday" id="defaultInline4" value="1" checked>
                                <label class="custom-control-label" for="defaultInline4">T</label>
                              </div>
                              <div class="custom-control custom-checkbox custom-control-inline" data-toggle="tooltip" title="friday">
                                <input type="checkbox" class="custom-control-input friday" id="defaultInline5" value="1" checked>
                                <label class="custom-control-label" for="defaultInline5">F</label>
                              </div>
                              <div class="custom-control custom-checkbox custom-control-inline" data-toggle="tooltip" title="saturday">
                                <input type="checkbox" class="custom-control-input saturday" id="defaultInline6" value="1"  checked>
                                <label class="custom-control-label" for="defaultInline6">S</label>
                              </div>
                              <div class="custom-control custom-checkbox custom-control-inline" data-toggle="tooltip" title="sunday">
                                <input type="checkbox" class="custom-control-input sunday" id="defaultInline7" value="1" checked>
                                <label class="custom-control-label" for="defaultInline7">S</label>
                              </div> -->
                            </div>


                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-12" id="addRowsId"></div>
              <button type="button" class="btn btn-info pull-right"  id="addMultipleRow" style="display:none;" >Add More</button>

              <!-- <div class="row"><div class="col">Time</div></div> -->

              <div class="form-group">
                <div class="col-sm-offset-4 col-sm-5">
                  <button type="submit" class="btn btn-success">Add Plan</button>
                </div>
              </div>
            </form>
          </div>
        </div>

        <!-- <table><th>Amount</th></table> -->
        <script type="text/javascript">

          $('#enable_burst').click(function(){
            $('.burstmode').toggle();
          });





          $('#selected_validity').click(function(){
            
          });


          function enableValidity()
          {
            var plan_name=$('#plan_name').val();
            var plan_description=$('#discription').val();
            var plan_type=$('#plan_type').val();
            var burst_mode=$('#burstmode').val();
            
  // console.log(plan_name);
  // console.log(plan_description);
  // console.log(plan_type);
  if(plan_name && plan_type && plan_description && burst_mode)
  {
   $('#validity').prop("disabled",false);
   $('#validity_unit').prop("disabled",false);
   $('#amount').prop("disabled",false);
   $('#validity').focus();  

 }


}
$(document).ready(function(){
  $('#ajax_indicator').hide();
  var count=1;
  $('.addMutipleValidity').click(function(){
    var validity=$('#validity').val();
    var validity_unit=$('#validity_unit').val();
    var amount=$('#amount').val();
    var plan_name=$('#plan_name').val();
    var plan_description=$('#discription').val();
    var plan_type=$('#plan_type').val();
    var burst_mode=$('#burstmode').val();
    if(plan_name && plan_type && plan_description && burst_mode && validity && validity_unit && amount )
    {
      $('#form_2').show();
      $('#form_3').show();
      $('#addMultipleRow').show();
      $("input[name=validity]").val('');
    // $("input[name=validity_unit]").val(' ');
    $('input[name=validity_unit]').prop('selectedIndex',0);
    $("input[name=amount]").val('');
    // $('validity').val(' ');
    // $('amount').val(' ');
    count = count + 1;
    var tax_rate=0.18;
    var tax,total_amount;
    tax=amount*tax_rate;
    total_amount=parseInt(amount)+parseInt(tax);

    var plan_detail='<div class="row" id="row'+count+'"><div class="col-md-3"><div class="input-group"><span class="input-group-text">Validity</span><input type="number" name="" value="'+validity+'" class="form-control validity"  id="validity" tabindex=7 readonly> </div></div><div class="col-md-3"><div class="input-group"><span class="input-group-text">Amount</span><input type="number"  class="form-control amount" value="'+amount+'"  id="amount"  readonly tabindex=7> <span class="input-group-text"><i class="fa fa-inr"></i></span></div></div><input type="hidden" value="'+validity_unit+'"  class="validity_unit" id="validity_unit"><div class="col-md-2"> <div class="input-group"><span class="input-group-text">Tax</span><input type="number" value="'+tax+'" class="form-control"  readonly id="tax" tabindex=8> </div></div><div class="col-md-3"><div class="input-group"><span class="input-group-text">Total Amount</span> <input type="number" value="'+total_amount+'" class="form-control"  readonly="readonly" id="total_amount" tabindex=9> <span class="input-group-text"><i class="fa fa-inr"></i></span></div></div><div class="col-md-1"><button class="btn btn-danger removeplanlist"  data-row="row'+count+'">-</button></div></div>';

    // calculateTotalAmount();
    $('#addValidityId').append(plan_detail);
  }
  else
  {
    alert('please fill all the field');
  }
});
  $(document).on('click', '.removeplanlist', function(){
    var delete_rows = $(this).data("row");
    $('#' + delete_rows).remove();
  });

  var count=1;
  $('#addMultipleRow').click(function(){
    count = count + 1;
    var newrow='<div class="card" id="row'+count+'"><div class="card-body"><div class="row"><div class="col-md-6" id="add_row" > <div class="row boxstylerow"><div class="col-md-3 col-sm-3 "><input type="text" name="download_data" placeholder="Download data"  class="form-control download_data" onkeyup="disableTotalData();" tabindex=12 data-toggle="tooltip" title="bydefault download data limit is 0,here 0 indicate unlimited"></div><div class="col-md-3 col-sm-3"><input type="text" name="upload_data"  class="form-control upload_data"  placeholder="Upload data" onkeyup="disableTotalData();" tabindex=13 data-toggle="tooltip" title="bydefault upload data limit is 0,here 0 indicate unlimited"></div><div class="col-md-3 col-sm-3"><input type="text" name="data_transfer"  class="form-control data_transfer" placeholder="Data Transfer" onkeyup="disableOther()" tabindex=14></div><div class="col-md-2 col-sm-2"><select class="form-control data_unit" tabindex=15><option value="2">Mb</option><option value="1">Kb</option><option value="3">Gb</option></select> </div><div class="col-md-3"><input type="text" name="" placeholder="Download Speed"  class="form-control download_speed" tabindex=16 onkeyup="disableTotalSpeed()"></div><div class="col-md-3"><input type="text" name="upload_speed[]"  class="form-control upload_speed" placeholder="Upload Speed" tabindex=17 onkeyup="disableTotalSpeed()"></div><div class="col-md-3"><input type="text" name="transfer_speed"  class="form-control transfer_speed" placeholder="Transfer Speed" tabindex=18 onkeyup="disableOther()" ></div><div class="col-md-2"><select class="form-control speed_unit"  tabindex=19><option value="2">Mb/s</option><option value="1">Kb/s</option><option value="3">Gb/s</option></select></div> </div></div><div class="col-md-6"><div class="row"><div class="col-md-6" id="datalimitselect"><div class="row"><div class="col-md-4"><div class="form-group"><input type="text" name="" class="form-control" placeholder="Limit"></div></div><div class="col-md-4"><div class="form-group"><select class="form-control" id="validity_unit" ><option value="">select</option><option value="1">Days</option><option value="2">Week</option><option value="3">Month</option><option value="4">Year</option></select></div></div><div class="col-md-4"><div class="form-group"><select class="form-control"  name="repeat_mode" id="repeat_mode"><option value="">Repeat Mode</option><option value="once">Once</option><option value="daily">Unlimited</option></select></div> </div></div> </div> <div class="col-md-6"><div class="input-group"><input type="text" name="" placeholder="00 H" class="form-control startH"><input type="text" name="" placeholder="00 M" class="form-control starM"><span class="input-group-text">To</span> <input type="text" name="" placeholder="23 H" class="form-control endH"><input type="text" name="" placeholder="59 M" class="form-control endM"></div></div></div><div class="col-md-12"><div class="row pull-right"><div class="col"><label class="checkbox-inline" data-toggle="tooltip" title="Monday"><input type="checkbox"   class="monday" value="1" checked>&nbsp M</label>&nbsp&nbsp <label class="checkbox-inline" data-toggle="tooltip" title="Tuesday"><input type="checkbox" class="tuesday" value="1" checked>&nbspT</label>&nbsp&nbsp <label class="checkbox-inline" data-toggle="tooltip" title="Wednesday"><input type="checkbox"  class="wednesday" value="1" checked>&nbspW</label>&nbsp&nbsp <label class="checkbox-inline" data-toggle="tooltip" title="Thrusday"><input type="checkbox" class="thrusday" value="1" checked>&nbspT</label>&nbsp&nbsp <label class="checkbox-inline" data-toggle="tooltip" title="Friday"><input type="checkbox" class="friday" value="1" checked>&nbspF</label>&nbsp&nbsp  <label class="checkbox-inline" data-toggle="tooltip" title="Saturday"><input type="checkbox" class="saturday" value="1" checked>&nbspS</label>&nbsp&nbsp  <label class="checkbox-inline" data-toggle="tooltip" title="Sunday"><input type="checkbox" class="sunday" value="1" checked>&nbspSu</label></div><button class="btn btn-danger form3row" data-row="row'+count+'">-</button></div> </div></div> </div></div></div>';
    // var newrow='<br><div class="row  boxstylerow" id="row'+count+'"><div class="col-md-3 col-sm-3 "><input type="text" name="download_data" placeholder="Download data"  class="form-control download_data" onkeyup="disableTotalData();"></div><div class="col-md-3 col-sm-3"><input type="text" name="upload_data"  class="form-control upload_data"  placeholder="Upload data" onkeyup="disableTotalData();"></div><div class="col-md-3 col-sm-3"><input type="text" name="data_transfer"  class="form-control data_transfer" placeholder="Data Transfer" onkeyup="disableOther()"></div><div class="col-md-2 col-sm-2"><select class="form-control"><option>Mb</option><option>Kb</option><option>Gb</option></select></div><div class="col-md-1"><button name="remove" data-row="row'+count+'" class="btn btn-danger remove">-</button></div><div class="col-md-3 "><input type="text" name="" placeholder="Download Speed"  class="form-control download_speed" onkeyup="disableTotalSpeed()"></div><div class="col-md-3"><input type="text" name="upload_speed[]"  class="form-control upload_speed" placeholder="Upload Speed" onkeyup="disableTotalSpeed()"></div><div class="col-md-3"><input type="text" name="transfer_speed"  class="form-control transfer_speed" placeholder="Transfer Speed" onkeyup="disableOther()" ></div><div class="col-md-2"><select class="form-control"><option>Mb/s</option><option>Kb/s</option><option>Gb/s</option></select></div></div> </div><div class="row"></div>';
    // var i=$('.boxstylerow').val();
    $('#addRowsId').append(newrow);
  });
$(document).on('click', '.remove', function(){
  var delete_row = $(this).data("row");
  $('#' + delete_row).remove();
});
$(document).on('click', '.form3row', function(){
  var delete_row = $(this).data("row");
  $('#' + delete_row).remove();
});

$("#form" ).on( "submit", function( event ) {
  
  event.preventDefault();
  var download_data = [];
  var upload_data = [];
  var data_transfer = [];
  var upload_speed = [];
  var download_speed = [];
  var transfer_speed = [];
  var data_unit = [];
  var validity = [];
  var validity_unit = [];
  var amount = [];
  var speed_unit = [];
  var start_hour = [];
  var start_minute = [];
  var end_hour = [];
  var end_minute = [];
  var sunday = [];
  var monday = [];
  var tuesday = [];
  var wednesday = [];
  var thrusday = [];
  var friday = [];
  var saturday = [];



// var item_price = [];
$('.download_data').each(function(){
  download_data.push($(this).val());
});
$('.upload_data').each(function(){
  upload_data.push($(this).val());
}); 
$('.data_transfer').each(function(){
  data_transfer.push($(this).val());
});
$('.upload_speed').each(function(){
  upload_speed.push($(this).val());
});
$('.download_speed').each(function(){
  download_speed.push($(this).val());
}); 
$('.transfer_speed').each(function(){
  transfer_speed.push($(this).val());
}); 
$('.data_unit').each(function(){
  data_unit.push($(this).val());
}); 
$('.validity').each(function(){
  validity.push($(this).val());
}); 
$('.amount').each(function(){
  amount.push($(this).val());
}); 
$('.validity_unit').each(function(){
  validity_unit.push($(this).val());
}); 
$('.speed_unit').each(function(){
  speed_unit.push($(this).val());
}); 
$('.startH').each(function(){
  start_hour.push($(this).val());
});
$('.startM').each(function(){
  start_minute.push($(this).val());
});
$('.endH').each(function(){
  end_hour.push($(this).val());
});
$('.endM').each(function(){
  end_minute.push($(this).val());
});
$('.sunday').each(function(){
  sunday.push(this.checked ? $(this).val() : 0);
});
$('.monday').each(function(){
  monday.push(this.checked ? $(this).val() : 0);
});
$('.tuesday').each(function(){
  tuesday.push(this.checked ? $(this).val() : 0);
});
$('.wednesday').each(function(){
  wednesday.push(this.checked ? $(this).val() : 0);
});
$('.thrusday').each(function(){
  thrusday.push(this.checked ? $(this).val() : 0);
});
$('.friday').each(function(){
  friday.push(this.checked ? $(this).val() : 0);
});
$('.saturday').each(function(){
  saturday.push(this.checked ? $(this).val() : 0);
});
var plan_name=$('#plan_name').val();
var plan_description=$('#discription').val();
var plan_type=$('#plan_type').val();
// console.log(plan_type);

if ($('#check').is(":checked"))
{
  // it is checked
  var service=1;
}
else
{
  var service=0;
}
var burst_mode=$('#burstmode').val();

var vacation_mode=$('#vacation_mode').val();

var priority=$('#priority').val();
var day_limit=$('#day_limit').val();
var start=$('#starttimeH').val();
console.log(burst_mode);
if(burst_mode=='')
{
  $('.burst_error').show();
  $('.burst_error').html('please select any field');
  $('#burstmode').focus();
}

else
{
  $("#ajax_indicator").show();
  $.ajax({
    url:"<?= base_url() ?>plan/add",
    method:"POST",
    data:{plan_description:plan_description,
      plan_name:plan_name,
      plan_type:plan_type,
      burst_mode:burst_mode,
      validity:validity,
      validity_unit:validity_unit,
      amount:amount,
      vacation_mode:vacation_mode,
      priority:priority,
      download_data:download_data,
      upload_data:upload_data,
      data_transfer:data_transfer,
      upload_speed:upload_speed,
      download_speed:download_speed,
      transfer_speed:transfer_speed,
      data_unit:data_unit,
      speed_unit:speed_unit,
      start_hour:start_hour,
      start_minute:start_minute,
      end_hour:end_hour,
      end_minute:end_minute,
      sunday:sunday,
      monday:monday,
      tuesday:tuesday,
      wednesday:wednesday,
      thrusday:thrusday,
      friday:friday,
      saturday:saturday,
      status:service

    },
    
    success: function (data) {
     // $("#ajax_indicator").hide();
     // console.log(data);
     
     document.location.reload();
   },

 });
}
});
});
function disableTotalData()
{
  var upload_data=$('.upload_data').val();
  var download_data=$('.download_data').val();
  $('.data_transfer').prop("disabled",false);
  // console.log(download_data);
  // console.log(upload_data);
// if(download_data=='' || download_data==null)
if(download_data || upload_data)
{
// console.log("download_data");
$('.data_transfer').prop("disabled",true);
}
}

function disableTotalSpeed()
{
  var upload_speed=$('.upload_speed').val();
  var download_speed=$('.download_speed').val();
  $('.transfer_speed').prop("disabled",false);
// console.log(download_speed);
// console.log(upload_speed);
// if(download_data=='' || download_data==null)
if(download_speed || upload_speed)
{
// console.log("download_data");
$('.transfer_speed').prop("disabled",true);
}
}


function disableOther()
{
  var data_transfer=$('.data_transfer').val();
  var transfer_speed=$('.transfer_speed').val();
  $('.upload_speed').prop("disabled",false);
  $('.download_speed').prop("disabled",false);
  $('.upload_data').prop("disabled",false);
  $('.download_data').prop("disabled",false);
  if(transfer_speed)
  {
    $('.upload_speed').prop("disabled",true);
    $('.download_speed').prop("disabled",true);
  }
  if(data_transfer)
  {
    $('.upload_data').prop("disabled",true);
    $('.download_data').prop("disabled",true);
  }

}

/*open popup in custom burst select*/
$('#burstmode').change(function(){
  var burstmode=$('#burstmode').val();
  if(burstmode=='custom_burst_mode')
  {
    $('#burstModal').show();
    $('#burstModal').modal();

  }


});
function calculateTotalAmount()
{
  var amount=$('#amount').val();
  // var tax_rate=0.18;
  var tax=0;
/*used in future*/
$.ajax({
    url:"<?= base_url() ?>plan/add",
    method:"POST",
    data:{f_id:f_id,
   
    },
    
    success: function (data) {
var json=[{"cgst":"9"},{"sgst":"9"}];


var obj=JSON.parse(json);
var length=obj.length;
for($i=0;$i<length;$i++)
{
 tax +=(Object.values(obj[0])*amount)/100;

}
var total=amount+tax;
 
  $('#tax').val(tax);
  $('#total_amount').val(total_amount);
}
});

}
function focusburst()
{
  // $('#burstmode').focus();
}
function validation()
{
  // alert("sd");
  if($('#plan_name').val()=='')
  {
    $('.plan_name_error').html('plan name should be mendatory');
    $('#plan_name').focus();
  }
  else
  {
    $('.plan_name_error').hide();
  }
}

</script>
<script type="text/javascript">

  $(document).ready(function() {
//Initialize Select2 Elements
$('.select2').select2();
 
});

</script>
<!-- <script type="text/javascript">
   $(document).ready(function() {
//Initialize Select2 Elements

  var json='[{"cgst":"9"},{"sgst":"9"}]';
var amount=101;
var obj=JSON.parse(json);
var length=obj.length;
var tax=0;
for($i=0;$i<length;$i++)
{
 tax +=(Object.values(obj[0])*amount)/100;

}
var total=amount+tax;
console.log(total);

});
</script> -->