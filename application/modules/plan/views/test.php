<style type="text/css">
  #ajax_indicator
  {
    position: absolute;
    top:40%;
    left:50%;
    z-index: 3000;
    font-size: 30px;
  }
</style>
<!-- <div id="ajax_indicator" > <i class="fa fa-spinner fa-spin" style="font-size:44px"></i></div> -->
<div id="target" class="loading">
  <div class="loading-overlay">
    <p class="loading-spinner">
      <span class="loading-icon"></span>
      <span class="loading-text">loading</span>
    </p>
  </div>
</div>
 <form  method="post" id="form" >
 <div id="form_3">
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
                     <select class="form-control data_unit" tabindex=15><option value="mb">Mb</option><option value="kb">Kb</option><option value="gb">Gb</option></select>
                   </div>


                   <div class="col-md-3">
                     <input type="text" name="" placeholder="Download Speed"  class="form-control download_speed" tabindex=16 onkeyup="disableTotalSpeed()"></div>
                     <div class="col-md-3">
                      <input type="text" name="upload_speed[]"  class="form-control upload_speed" placeholder="Upload Speed" tabindex=17 onkeyup="disableTotalSpeed()">
                    </div>
                    <div class="col-md-3">
                      <input type="text" name="transfer_speed"  class="form-control transfer_speed" placeholder="Transfer Speed" tabindex=18 onkeyup="disableOther()" >
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
                          <input type="text" name="" placeholder="00 H"  class="form-control startH">
                          <!-- <span class="input-group-addon">:</span> -->
                          <input type="text" name="" placeholder="00 M" class="form-control startM">
                          <span class="input-group-text">To</span>
                          <input type="text" name="" placeholder="23 H" class="form-control endH">
                          <input type="text" name="" placeholder="59 M" class="form-control endM">

                        </div>
                      </div>
                      <!-- </div> -->
                    </div><!-- /.row -->

                    <div class="col-md-12">
                      <div class="row pull-right">
                        <div class="col">
                          <!-- Default inline 1-->
                          <div class="custom-control custom-checkbox custom-control-inline" data-toggle="tooltip" title="monday">
                            <input type="checkbox" name="monday[]" class="custom-control-input monday" id="defaultInline1" value="1" checked>
                            <label class="custom-control-label" for="defaultInline1">M</label>
                          </div>

                          <!-- Default inline 2-->
                          <div class="custom-control custom-checkbox custom-control-inline" data-toggle="tooltip" title="tuesday">
                            <input type="checkbox" class="custom-control-input tuesday" id="defaultInline2"  checked>
                            <label class="custom-control-label" for="defaultInline2">T</label>
                          </div>

                          <!-- Default inline 3-->
                          <div class="custom-control custom-checkbox custom-control-inline" data-toggle="tooltip" title="wednesday">
                            <input type="checkbox" class="custom-control-input wednesday" id="defaultInline3" value="1" checked>
                            <label class="custom-control-label" for="defaultInline3">W</label>
                          </div>
                          <div class="custom-control custom-checkbox custom-control-inline" data-toggle="tooltip" title="thrusday">
                            <input type="checkbox" class="custom-control-input thrusday" id="defaultInline4" value="1" checked>
                            <label class="custom-control-label" for="defaultInline4">T</label>
                          </div>
                          <div class="custom-control custom-checkbox custom-control-inline" data-toggle="tooltip" title="friday">
                            <input type="checkbox" class="custom-control-input friday" id="defaultInline58" value="1" checked>
                            <label class="custom-control-label" for="defaultInline58">F</label>
                          </div>
                          <div class="custom-control custom-checkbox custom-control-inline" data-toggle="tooltip" title="saturday">
                            <input type="checkbox" class="custom-control-input saturday" id="defaultInline6" value="1"  checked>
                            <label class="custom-control-label" for="defaultInline6">S</label>
                          </div>
                          <div class="custom-control custom-checkbox custom-control-inline" data-toggle="tooltip" title="sunday">
                            <input type="checkbox" class="custom-control-input sunday" id="defaultInline7" value="1" checked>
                            <label class="custom-control-label" for="defaultInline7">S</label>
                          </div>
                        </div>


                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div id="form_3">
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
                     <select class="form-control data_unit" tabindex=15><option value="mb">Mb</option><option value="kb">Kb</option><option value="gb">Gb</option></select>
                   </div>


                   <div class="col-md-3">
                     <input type="text" name="" placeholder="Download Speed"  class="form-control download_speed" tabindex=16 onkeyup="disableTotalSpeed()"></div>
                     <div class="col-md-3">
                      <input type="text" name="upload_speed[]"  class="form-control upload_speed" placeholder="Upload Speed" tabindex=17 onkeyup="disableTotalSpeed()">
                    </div>
                    <div class="col-md-3">
                      <input type="text" name="transfer_speed"  class="form-control transfer_speed" placeholder="Transfer Speed" tabindex=18 onkeyup="disableOther()" >
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
                          <input type="text" name="" placeholder="00 H"  class="form-control startH">
                          <!-- <span class="input-group-addon">:</span> -->
                          <input type="text" name="" placeholder="00 M" class="form-control startM">
                          <span class="input-group-text">To</span>
                          <input type="text" name="" placeholder="23 H" class="form-control endH">
                          <input type="text" name="" placeholder="59 M" class="form-control endM">

                        </div>
                      </div>
                      <!-- </div> -->
                    </div><!-- /.row -->

                    <div class="col-md-12">
                   
                      
                          <!-- Default inline 1-->
                          <label class="checkbox-inline">
      <input type="checkbox"   class="sundays" value="1">S
    </label>
    <label class="checkbox-inline">
      <input type="checkbox" class="sundays" value="1" >M
    </label>
    <label class="checkbox-inline">
      <input type="checkbox" value="">Option 3
    </label>
                        


                      <!-- </div> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <button type="submit">add</button>
        </form>
        <label class="checkbox-inline">
      <input type="checkbox"   class="sundays" value="1">S
    </label>
    <label class="checkbox-inline">
      <input type="checkbox" class="sundays" value="1" >M
    </label>
    <label class="checkbox-inline">
      <input type="checkbox" value="">Option 3
    </label>
        <script type="text/javascript">
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

$("#loading-image").show();

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
$('.sundays').each(function(){
  sunday.push(this.checked ? $(this).val() : 0);
});
$(':checkbox').each(function(){
  var ischecked = $(this).is(":checked");
  monday.push($(this).val());
});
$('.tuesday').each(function(){
  tuesday.push($(this).val());
});
$('.wednesday').each(function(){
  wednesday.push($(this).val());
});
$('.thrusday').each(function(){
  thrusday.push($(this).val());
});
$('.friday').each(function(){
  friday.push($(this).val());
});
$('.saturday').each(function(){
  saturday.push($(this).val());
});
var plan_name=$('#plan_name').val();
var plan_description=$('#discription').val();
var plan_type=$('#plan_type').val();
var burst_mode=$('#burstmode').val();

var vacation_mode=$('#vacation_mode').val();

var priority=$('#priority').val();
var day_limit=$('#day_limit').val();
var start=$('#starttimeH').val();
// console.log(sunday);
console.log(sunday);
// var s=$('input[name=]').val();
// var r=$('input[name=mondays]').checked();
// var r= $('input.mondays').prop('checked')
// console.log(r);
// console.log(s);
 // target.loadingOverlay();
 // $('#ajax_indicator').show();


/*$.ajax({
  url:"<?= base_url() ?>plan/test3",
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
    saturday:saturday
  },
  success: function (data) {
     // $("#loading-image").hide();
    // console.log(data);
  },*/

// });
});
        </script>