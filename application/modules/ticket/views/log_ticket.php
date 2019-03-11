<div class="row clearfix">
	<div class="card">
		<div class="header">
			<h3 class="title"><div class="row"><div class="col-md-3" style="color:#1158a3">
				Ticket Id- <?= $ticket_id ?> </div><div class="col-md-3"> <?= $name ?> </div><div class="col-md-3"><button class="btn btn-info">Call <?= $mobile ?> </button></div><div class="col-md-3" style="font-size: 14px;"><?= date('j F Y', strtotime($created_at)); ?>&nbsp &nbsp<?= date('h:i a', strtotime($created_at)); ?></div> </div> </h3>
			</div>
			<!-- /.card-header -->
			<div class="body">
				<!-- <b>CUSTOMER-ID</b>  -  123
				<hr> -->
				<b>ISSUE -</b>  <?= $description ?>
				<hr><b>Status -</b>
				<?php if($status=='open')
				{ ?>

				<span class="label label-danger"><?= $status ?></span>
			<?php 
				}  else { ?>
						<span class="label label-success"><?= $status ?></span>

			<?php	} ?>
			</div>
		</div>
		
		<div class="card">
			<div class="header bg-cyan ">
				<h2>
				Ticket Log
				</h2>
				
			</div>
		</div>	
			<!-- </div> -->
			
			<?php foreach($ticket_log as $row){ ?>
			
			<div class="card">
				<div class="header ">
					<h5> Created by :
					<?= $row['staff_name']; ?>
					<small> <?= date('j F Y', strtotime($row['created_at'])); ?>&nbsp &nbsp<?= date('h:i a', strtotime($row['created_at'])); ?></small>
					</h5>
				</div>
				<div class="body">
					<?= $row['reply']; ?>
					
				</div>
			</div>
			
			<?php } ?>
		
		<div class="card">
			<div class="header bg-cyan">
				<h2>
				Reply
				</h2>
			</div>
			<form method="post" action="<?= base_url() ?>ticket/reply">
				 <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
			<div class="body">
				<div class="col-md-12">
					<div class="form-group form-float">
						<div class="form-line">
							<textarea class="form-control" name="reply"></textarea>
							<label class="form-label">Reply</label>
						</div>
					</div>
				</div>
				<div class="demo-checkbox">
					
					<input type="checkbox" id="basic_checkbox_2" class="filled-in" name="sms" value="1"  />
					<label for="basic_checkbox_2">send sms and email</label>
					<!-- <input type="checkbox" id="basic_checkbox_3" class="filled-in" name="status" value="1"  />
					<label for="basic_checkbox_3">Resolve and Request to close</label>
					<input type="checkbox" id="basic_checkbox_4" class="filled-in" name="statusclose" value="1" />
					<label for="basic_checkbox_4">Resolve and  close</label> -->
					
									 		<input  type="radio" class="with-gap" id="radio_3" name="status" value="status"  />
                                <label for="radio_3">Resolve and Request to close</label>
                                <input  type="radio" class="with-gap" id="radio_4" name="status" value="statusclose" />
                                <label for="radio_4">Resolve and  close</label>
                          
				</div>
				<!-- <div class="demo-radio-button">
                                <input name="status" type="radio" id="radio_1" checked />
                                <label for="radio_1">Radio - 1</label>
                                <input name="group1" type="radio" id="radio_2" />
                                <label for="radio_2">Radio - 2</label>
                                <input name="group1" type="radio" class="with-gap" id="radio_3" />
                                <label for="radio_3">Radio - With Gap</label>
                                <input name="group1" type="radio" id="radio_4" class="with-gap" />
                                <label for="radio_4">Radio - With Gap</label>
                                <input name="group2" type="radio" id="radio_5" checked disabled />
                                <label for="radio_5">Radio - Disabled</label>
                                <input name="group3" type="radio" id="radio_6" class="with-gap" checked disabled />
                                <label for="radio_6">Radio - Disabled</label>
                            </div> -->
			
		</br>
				<div class="form-group col-md-4">
				<p>
					Assign To
				</p>
					<select class="form-control" name="assign">
						<option value="">--select to assign--</option>
						<?php for($i=0;$i<count($staff);$i++)
						{ ?>

							<option value="<?= $staff[$i]['id'] ?>"><?= $staff[$i]['name'] ?></option>

					<?php 	} ?>
 
					</select>
				</div>
				</div>
			</br>
					<div class="form-group">
				<button class="btn btn-info" type="submit">add new reply</button>
			</div>
				 <input type="hidden" name="ticket_id" value="<?= $ticket_id ?>"> 
             <input type="hidden" name="comment" value="<?= $description ?>">
               <input type="hidden" name="mobile" value="<?= $mobile ?>">
              
			</div>

		</form>
		</div>

		    <!-- <script src="<?= base_url() ?>assets/admin/js/pages/forms/basic-form-elements.js"></script> -->