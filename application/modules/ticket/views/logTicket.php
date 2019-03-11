<div class="row clearfix">
  <div class="card">
    <div class="header">
      <h3 class="card-title"><div class="row"><div class="col-md-3" style="color:#1158a3">
        Ticket Id- <?= $ticket_id ?> </div><div class="col-md-3"> <i class="fa fa-user" aria-hidden="true"> vivek chourasiya</i> </div><div class="col-md-3"><button class="btn btn-info">Call 9148725074 </button></div><div class="col-md-3" style="font-size: 14px;"><i class="fa fa-clock-o" style="font-size:15px"></i>12/3/2018  12.33pm</div> </div> </h3>
      </div>
      <!-- /.card-header -->
      <div class="body">
        <b>CUSTOMER-ID</b>  -  123
        <hr>
        <b>ISSUE</b>  speed problem
      </div>
    </div>
    <!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="card">
        <div class="header">
          <h2>
          Ticket Log
          </h2>
          
        </div> -->
        
        <?php foreach($ticket_log as $row){ ?>
        <!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> -->
        <div class="card">
          <div class="header bg-cyan">
            <h5> Created by :
            <?= $row['staff_name']; ?>
            <small> <?= date('j F Y', strtotime($row['created_at'])); ?></small>
            </h5>
          </div>
          <div class="body">
            <p><?= $row['reply']; ?></p>
            <!-- <p>- Button with icon &amp; text added</p> -->
          </div>
        </div>
        <!-- </div> -->
        <?php } ?>
        <!-- <h4>Ticket Response</h4> -->
        <div class="card">
          <div class="header">
            <h3 class="card-title">Reply</h3>
            </div> <!-- /.card-header -->
            <!-- <form method="post" action="<?= base_url() ?>ticket/reply"> -->
              <div class="mb-3">
                <textarea class="textarea" placeholder="Place some text here" id="reply" name="reply"
                style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
              </div>
              <div class="form-group">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="yes" name="sms" >
                  <label class="form-check-label">Reply For Customer</label>
                </div>
              </div>
              <!--  <div class="form-check">
                <input class="form-check-input" type="checkbox" value="yes" name="status" >
                <label class="form-check-label">Resolve and Request to close</label>
              </div> -->
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="yes" name="status" >
                <label class="form-check-label">Resolve and request to close</label>
              </div>
             <!--  <div class="col-md-6">
                <div class="input-group input-group-lg">
                  <span class="input-group-addon">
                    <input type="checkbox" class="filled-in" id="ig_checkbox">
                    <label for="ig_checkbox"></label>
                  </span>
                  <div class="form-line">
                    <input type="text" class="form-control">
                  </div>
                </div>
              </div> -->
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="yes" name="statusclose" >
                <label class="form-check-label">Resolve and close</label>
              </div>
              <div class="col-md-3">
                <!-- <div class="form-group" id="assignIndivisual">
                  <label for="assign" class="col-md-4 control-label">Assign</label>
                  <select class="form-control select" name="assign" id="assign"   style="width: 100%;">
                    <option value="">--select--</option>
                    <?php for($i=0;$i<count($staff);$i++) {
                    if($this->session->staff_id!=$staff[$i]['id'])  {  ?>
                    
                    <option value="<?= $staff[$i]['id'] ?>"><?= $staff[$i]['name'] ?></option>
                    <?php  } } ?>
                  </select>
                </div>
              </div> -->
              <!-- <input type="hidden" name="ticket_id" value="<?= $ticket_detail['ticket_id'] ?>"> -->
              <!-- <input type="hidden" name="comment" value="<?= $ticket_detail['comment'] ?>"> -->
              <!-- <input type="hidden" name="mobile" value="<?= $ticket_detail['mobile'] ?>"> -->
              <!-- <input type="hidden" name="crn_number" value="<?= $ticket_detail['crn_number'] ?> "> -->
            </div>
            <button class="btn btn-info" type="submit">add new reply</button>
          <!-- </form> -->
        </div>
      </div>
     
      <script>
     
      function statusUpdate($id,$status,$ticket_id)
      {
      console.log($status);
      console.log($id);
      var ticket_id=$ticket_id;
      console.log(ticket_id);
      var status=$status;
      var id=$id;
      $.ajax({
      type: "POST",
      url: "<?= base_url() ?>ticket/statusChange",
      data: {
      status:status,id:id,ticket_id:ticket_id
      },
      success: function (data) {
      console.log(data);
      location.reload();
      // var obj=JSON.parse(data);
      }
      });
      }
      </script>