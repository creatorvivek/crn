
<!-- <?php print_r($s_plans); ?> -->

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
							<h3 class="card-title">Edit Plan</h3> 
						</div>
						<div class="col-md-5">
							<label style="font-weight:200"><input type="checkbox"  name="service_enable" value="enable" id="check" <?php if($plan['data'][0]['status']==1){ echo 'checked'; } ?> > Enabled </label>
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
									<input type="text" name="plan_name"  class="form-control" id="plan_name" value="<?= ($this->input->post('plan_name') ? $this->input->post('plan_name') : $plan['data'][0]['name']); ?>" required  autofocus placeholder="Plan name" tabindex=1/ data-toggle="tooltip" title="plan name">
									<span class="text-danger service_name_error"></span>
								</div>
								<!-- </div> -->
								<!-- <div class="col-md-5"> -->
									<div class="form-group">
										<!-- <label  class="col-md-10 control-label"><span class="text-danger">*</span>Type of Service</label> -->
                    <!-- <select class="form-control"  name="service_type" id="plan_type" tabindex=3 >
                      <option value="">Plan Type</option>
                      <option value="prepaid">Prepaid</option>
                      <option value="postpaid">Postpaid</option>
                      <option value="advance_rental">Advance Rental</option>

                  </select> -->
                  <select class="form-control select2"  id="plan_type" tabindex=3  data-placeholder="Plan type" multiple style="width: 100%;" tabindex=3 >
                  	<!-- <option value="" disable>Plan Type</option> -->
                  	<option value="prepaid">Prepaid</option>
                  	<option value="postpaid">Postpaid</option>
                  	<option value="advance_rental">Advance Rental</option>
                  </select>
              </div>

              <div class="input-group">
              	<input type="number" name="validity" placeholder="Validity" class="form-control" id="validity" disabled  tabindex=5>
              	<select disabled tabindex=5  name="validity_unit" class="form-control" id="validity_unit" ><option value="">Select</option><option value="day">Days</option><option value="week">Week</option><option value="month">Month</option><option value="year">Year</option></select>

              	<input class="form-control" disabled type="number" name="amount" id="amount" placeholder="Amount" tabindex="6">
              	<span class="input-group-addon"><button type="button" tabindex="7" class="btn btn-success addMutipleValidity" >Add</button></span>
              </div>
              <br>


          </div>

          <!-- </div> -->
          <div class="col-md-6 col-xs-push-6">
          	<div class="form-group">
          		<textarea placeholder="Plan description"  class="form-control" id="discription"  rows="3.8" tabindex=2 ><?= ($this->input->post('discriptions') ? $this->input->post('discription') : $plan['data'][0]['description']); ?></textarea>
          		<span class="text-danger nas_error"></span>
          	</div>
          	<!-- </div> -->


          	<div class="form-group">
          		<!-- <label  class="col-md-10 control-label"><span class="text-danger">*</span>Type of Service</label> -->
          		<select class="form-control" name="burst" id="burstmode" tabindex=4 onfocusout="enableValidity()">
          			<option value="">Burst mode</option>
          			<option value="disable" >disable</option>
          			<option value="double">enable by double rate</option>
          			<option value="custom_burst_mode">custom</option>
          		</select>
          	</div>
          </div>
      </div><!-- /row -->
      <?php for($i=0;$i<count($amount['data']);$i++)   { ?>
      	<div class="row" id="row'+count+'"><div class="col-md-3"><div class="input-group"><span class="input-group-text">Validity</span><input type="number" name="" value="<?= $amount['data'][$i]['validity'] ?>" class="form-control validity"  id="validity" tabindex=7 readonly> </div></div><div class="col-md-3"><div class="input-group"><span class="input-group-text">Amount</span><input type="number"  class="form-control amount" value="<?= $amount['data'][$i]['amount'] ?>"  id="amount"  readonly tabindex=7> <span class="input-group-text"><i class="fa fa-inr"></i></span></div></div><input type="hidden" value="'+validity_unit+'"  class="validity_unit" id="validity_unit"><div class="col-md-2"> <div class="input-group"><span class="input-group-text">Tax</span><input type="number" value="'+tax+'" class="form-control"  readonly id="tax" tabindex=8> </div></div><div class="col-md-3"><div class="input-group"><span class="input-group-text">Total Amount</span> <input type="number" value="'+total_amount+'" class="form-control"  readonly="readonly" id="total_amount" tabindex=9> <span class="input-group-text"><i class="fa fa-inr"></i></span></div></div><div class="col-md-1"><button class="btn btn-danger removeplanlist"  data-row="row'+count+'">-</button></div></div>
      <?php } ?>
      <div id="addValidityId"></div>

      <br><br>
      <div class="row" id="form_2">


      	<div class="col-md-6">
      		<div class="form-group">
      			<!-- <label  class="col-md-10 control-label"><span class="text-danger">*</span>Type of Service</label> -->
      			<select class="form-control"  name="priority" id="priority" tabindex=10>
      				<option value="">Priority</option>
      				<option value="1" <?= ($plan['data'][0]['priority'] == '1')?'selected':''?> >1</option>
      				<option value="2" <?= ($plan['data'][0]['priority'] == '2')?'selected':''?> > 2</option>
      				<option value="3" <?= ($plan['data'][0]['priority'] == '3')?'selected':''?>>3</option>
      				<option value="4" <?= ($plan['data'][0]['priority'] == '4')?'selected':''?>>4</option>
      				<option value="5" <?= ($plan['data'][0]['priority'] == '5')?'selected':''?>>5</option>
      				<option value="6" <?= ($plan['data'][0]['priority'] == '6')?'selected':''?>>6</option>
      				<option value="7" <?= ($plan['data'][0]['priority'] == '7')?'selected':''?>>7</option>
      				<option value="8" <?= ($plan['data'][0]['priority'] == '8')?'selected':''?>>8</option>

      			</select>
      		</div>
      	</div>
      	<div class="col-md-6">
      		<div class="form-group">
      			<!-- <label  class="col-md-10 control-label"><span class="text-danger">*</span>Type of Service</label> -->
      			<select class="form-control"  name="vacation_mode" id="vacation_mode" tabindex=11>
      				<option value="" >Vacation mode </option>
      				<option value="1" <?php echo ($plan['data'][0]['vacation_mode'] == '1')?'selected':''?>>Enable</option>
      				<option value="0" <?php echo ($plan['data'][0]['vacation_mode'] == '0')?'selected':''?>>Disable</option>


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
      							<input type="number" class="form-control" tabindex="14" name="dlburstlimit" value=""  />

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



      </div><!-- /row under body  -->
  </div><!-- /card -->
  <div id="form_3"  >
  	<div class="card">
  		<div class="card-body">
  			<div class="row">
  				<div class="col-md-6 col-sm-6" id="add_row" >
  					<div class="row boxstylerow">
  						<div class="col-md-3 col-sm-3">
  							<input type="text" name="download_data" placeholder="Download data"  class="form-control download_data" onkeyup="disableTotalData();" value="<?= ($this->input->post('download_data') ? $this->input->post('download_data'):$plan['data'][0]['download_data_limit']); ?>" tabindex=12 data-toggle="tooltip" title="bydefault download data limit is 0,here 0 indicate unlimited">
  						</div>
  						<div class="col-md-3 col-sm-6 col-xs-3">
  							<input type="text" name="upload_data"  class="form-control upload_data"  placeholder="Upload data" onkeyup="disableTotalData();" tabindex=13 data-toggle="tooltip" value="<?= ($this->input->post('download_data') ? $this->input->post('download_data'):$plan['data'][0]['upload_data_limit']); ?>" title="bydefault upload data limit is 0,here 0 indicate unlimited">
  						</div>
  						<div class="col-md-3 col-sm-3">
  							<input type="text" name="data_transfer"  class="form-control data_transfer" placeholder="Data Transfer" onkeyup="disableOther()" tabindex=14 value="<?= ($this->input->post('download_da ta') ? $this->input->post('download_data'):$plan['data'][0]['data_transfer_limit']); ?>">
  						</div>
  						<div class="col-md-2 col-sm-3">
  							<select class="form-control data_unit" tabindex=15><option value="mb">Mb</option><option value="kb">Kb</option><option value="gb">Gb</option></select>
  						</div>


  						<div class="col-md-3">
  							<input type="text" name="" placeholder="Download Speed"  class="form-control download_speed" value="<?= ($this->input->post('download_speed') ? $this->input->post('download_speed'):$plan['data'][0]['download_speed']); ?>"  tabindex=16 onkeyup="disableTotalSpeed()"></div>
  							<div class="col-md-3">
  								<input type="text" name="upload_speed[]" value="<?= ($this->input->post('upload_speed') ? $this->input->post('upload_speed'):$plan['data'][0]['upload_speed']); ?>" class="form-control upload_speed" placeholder="Upload Speed" tabindex=17 onkeyup="disableTotalSpeed()">
  							</div>
  							<div class="col-md-3">
  								<input type="text" name="transfer_speed" value="<?= ($this->input->post('transfer_speed') ? $this->input->post('transfer_speed'):$plan['data'][0]['transfer_speed']); ?>" class="form-control transfer_speed" placeholder="Transfer Speed" tabindex=18 onkeyup="disableOther()" >
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
  										</div>


  									</div>
  								</div>
  							</div>
  						</div>
  					</div>
  				</div>
  			</div>
  			<input type="hidden" name="after_expire" id="after_expire" value="<?=$plan['data'][0]['after_expire'] ?>">
  			<?php 
  			$secondryPlanlength=count($secondry);
  			for($j=0;$j<$secondryPlanlength;$j++) { ?>
  				<div class="card" id="row'+count+'"><div class="card-body"><div class="row"><div class="col-md-6" id="add_row" > <div class="row boxstylerow"><div class="col-md-3 col-sm-3 "><input type="text" name="download_data" placeholder="Download data"  class="form-control download_data" onkeyup="disableTotalData();" tabindex=12 data-toggle="tooltip" title="bydefault download data limit is 0,here 0 indicate unlimited"></div><div class="col-md-3 col-sm-3"><input type="text" name="upload_data"  class="form-control upload_data"  placeholder="Upload data" onkeyup="disableTotalData();" tabindex=13 data-toggle="tooltip" title="bydefault upload data limit is 0,here 0 indicate unlimited"></div><div class="col-md-3 col-sm-3"><input type="text" name="data_transfer" value="<?= $secondry[$j]['data_transfer_limit'] ?>" class="form-control data_transfer" placeholder="Data Transfer" onkeyup="disableOther()" tabindex=14></div><div class="col-md-2 col-sm-2"><select class="form-control data_unit" tabindex=15><option value="mb">Mb</option><option value="kb">Kb</option><option value="gb">Gb</option></select> </div><div class="col-md-3"><input type="text" name="" placeholder="Download Speed"  class="form-control download_speed" tabindex=16 onkeyup="disableTotalSpeed()"></div><div class="col-md-3"><input type="text" name="upload_speed[]"  class="form-control upload_speed" placeholder="Upload Speed" tabindex=17 onkeyup="disableTotalSpeed()"></div><div class="col-md-3"><input type="text" name="transfer_speed"  class="form-control transfer_speed" placeholder="Transfer Speed" tabindex=18 onkeyup="disableOther()" ></div><div class="col-md-2"><select class="form-control speed_unit"  tabindex=19><option value="2">Mb/s</option><option value="1">Kb/s</option><option value="3">Gb/s</option></select></div> </div></div><div class="col-md-6"><div class="row"><div class="col-md-6" id="datalimitselect"><div class="row"><div class="col-md-4"><div class="form-group"><input type="text" name="" class="form-control" placeholder="Limit"></div></div><div class="col-md-4"><div class="form-group"><select class="form-control" id="validity_unit" ><option value="">select</option><option value="1">Days</option><option value="2">Week</option><option value="3">Month</option><option value="4">Year</option></select></div></div><div class="col-md-4"><div class="form-group"><select class="form-control"  name="repeat_mode" id="repeat_mode"><option value="">Repeat Mode</option><option value="once">Once</option<option value="daily">Unlimited</option></select></div> </div></div> </div> <div class="col-md-6"><div class="input-group"><input type="text" name="" placeholder="00 H" class="form-control startH"><input type="text" name="" placeholder="00 M" class="form-control starM"><span class="input-group-text">To</span> <input type="text" name="" placeholder="23 H" class="form-control endH"><input type="text" name="" placeholder="59 M" class="form-control endM"></div></div></div><div class="col-md-12"><div class="row pull-right"><div class="col"><label class="checkbox-inline" data-toggle="tooltip" title="Monday"><input type="checkbox"   class="monday" value="1" checked>&nbsp M</label>&nbsp&nbsp <label class="checkbox-inline" data-toggle="tooltip" title="Tuesday"><input type="checkbox" class="tuesday" value="1" checked>&nbspT</label>&nbsp&nbsp <label class="checkbox-inline" data-toggle="tooltip" title="Wednesday"><input type="checkbox"  class="wednesday" value="1" checked>&nbspW</label>&nbsp&nbsp <label class="checkbox-inline" data-toggle="tooltip" title="Thrusday"><input type="checkbox" class="thrusday" value="1" checked>&nbspT</label>&nbsp&nbsp <label class="checkbox-inline" data-toggle="tooltip" title="Friday"><input type="checkbox" class="friday" value="1" checked>&nbspF</label>&nbsp&nbsp  <label class="checkbox-inline" data-toggle="tooltip" title="Saturday"><input type="checkbox" class="saturday" value="1" checked>&nbspS</label>&nbsp&nbsp  <label class="checkbox-inline" data-toggle="tooltip" title="Sunday"><input type="checkbox" class="sunday" value="1" checked>&nbspSu</label></div><button class="btn btn-danger form3row" data-row="row'+count+'">-</button></div> </div></div> </div></div></div>
  			<?php } ?>
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
		var newrow='<div class="card" id="row'+count+'"><div class="card-body"><div class="row"><div class="col-md-6" id="add_row" > <div class="row boxstylerow"><div class="col-md-3 col-sm-3 "><input type="text" name="download_data" placeholder="Download data"  class="form-control download_data" onkeyup="disableTotalData();" tabindex=12 data-toggle="tooltip" title="bydefault download data limit is 0,here 0 indicate unlimited"></div><div class="col-md-3 col-sm-3"><input type="text" name="upload_data"  class="form-control upload_data"  placeholder="Upload data" onkeyup="disableTotalData();" tabindex=13 data-toggle="tooltip" title="bydefault upload data limit is 0,here 0 indicate unlimited"></div><div class="col-md-3 col-sm-3"><input type="text" name="data_transfer"  class="form-control data_transfer" placeholder="Data Transfer" onkeyup="disableOther()" tabindex=14></div><div class="col-md-2 col-sm-2"><select class="form-control data_unit" tabindex=15><option value="mb">Mb</option><option value="kb">Kb</option><option value="gb">Gb</option></select> </div><div class="col-md-3"><input type="text" name="" placeholder="Download Speed"  class="form-control download_speed" tabindex=16 onkeyup="disableTotalSpeed()"></div><div class="col-md-3"><input type="text" name="upload_speed[]"  class="form-control upload_speed" placeholder="Upload Speed" tabindex=17 onkeyup="disableTotalSpeed()"></div><div class="col-md-3"><input type="text" name="transfer_speed"  class="form-control transfer_speed" placeholder="Transfer Speed" tabindex=18 onkeyup="disableOther()" ></div><div class="col-md-2"><select class="form-control speed_unit"  tabindex=19><option value="2">Mb/s</option><option value="1">Kb/s</option><option value="3">Gb/s</option></select></div> </div></div><div class="col-md-6"><div class="row"><div class="col-md-6" id="datalimitselect"><div class="row"><div class="col-md-4"><div class="form-group"><input type="text" name="" class="form-control" placeholder="Limit"></div></div><div class="col-md-4"><div class="form-group"><select class="form-control" id="validity_unit" ><option value="">select</option><option value="1">Days</option><option value="2">Week</option><option value="3">Month</option><option value="4">Year</option></select></div></div><div class="col-md-4"><div class="form-group"><select class="form-control"  name="repeat_mode" id="repeat_mode"><option value="">Repeat Mode</option><option value="once">Once</option<option value="daily">Unlimited</option></select></div> </div></div> </div> <div class="col-md-6"><div class="input-group"><input type="text" name="" placeholder="00 H" class="form-control startH"><input type="text" name="" placeholder="00 M" class="form-control starM"><span class="input-group-text">To</span> <input type="text" name="" placeholder="23 H" class="form-control endH"><input type="text" name="" placeholder="59 M" class="form-control endM"></div></div></div><div class="col-md-12"><div class="row pull-right"><div class="col"><label class="checkbox-inline" data-toggle="tooltip" title="Monday"><input type="checkbox"   class="monday" value="1" checked>&nbsp M</label>&nbsp&nbsp <label class="checkbox-inline" data-toggle="tooltip" title="Tuesday"><input type="checkbox" class="tuesday" value="1" checked>&nbspT</label>&nbsp&nbsp <label class="checkbox-inline" data-toggle="tooltip" title="Wednesday"><input type="checkbox"  class="wednesday" value="1" checked>&nbspW</label>&nbsp&nbsp <label class="checkbox-inline" data-toggle="tooltip" title="Thrusday"><input type="checkbox" class="thrusday" value="1" checked>&nbspT</label>&nbsp&nbsp <label class="checkbox-inline" data-toggle="tooltip" title="Friday"><input type="checkbox" class="friday" value="1" checked>&nbspF</label>&nbsp&nbsp  <label class="checkbox-inline" data-toggle="tooltip" title="Saturday"><input type="checkbox" class="saturday" value="1" checked>&nbspS</label>&nbsp&nbsp  <label class="checkbox-inline" data-toggle="tooltip" title="Sunday"><input type="checkbox" class="sunday" value="1" checked>&nbspSu</label></div><button class="btn btn-danger form3row" data-row="row'+count+'">-</button></div> </div></div> </div></div></div>';
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
	$("#ajax_indicator").show();
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

var burst_mode=$('#burstmode').val();

var vacation_mode=$('#vacation_mode').val();

var priority=$('#priority').val();
var day_limit=$('#day_limit').val();
var after_expire=$('#after_expire').val();
// console.log(sunday);




$.ajax({
	url:"<?= base_url() ?>plan/edit/<?= $plan['data'][0]['plan_id'] ?>",
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
		after_expire:after_expire

	},

	success: function (data) {
		$("#ajax_indicator").hide();
		console.log(data);

             // document.location.reload();
         },

     });
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
	var tax_rate=0.18;
	var tax,total_amount;
	tax=amount*tax_rate;
	total_amount=parseInt(amount)+parseInt(tax);
	$('#tax').val(tax);
	$('#total_amount').val(total_amount);

}
</script>
<script type="text/javascript">

	$(document).ready(function() {
//Initialize Select2 Elements
$('.select2').select2();

});
</script>