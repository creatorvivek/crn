

<div class="row">

  <div class="col-md-5">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Add TopUp</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <?= form_open('topup/add',array("class"=>"form-horizontal")) ?>
        <div class="col-md-9">
          <label for="ticket" class="col-md-4 control-label"><span class="text-danger">*</span>Topup name</label>
          <div class="form-group">
            <input type="text" name="ticket" value="<?php echo $this->input->post('ticket'); ?>" class="form-control" id="ticket" required  autofocus />
            <span class="text-danger name_error"></span>
          </div>
        </div>


        <div class="col-md-9">
          <label for="task" class="col-md-5 control-label"><span class="text-danger">*</span>Data limit</label>
          <div class="form-group">
            <input type="text" name="datalimit" value="<?php echo $this->input->post("datalimit"); ?>" class="form-control" id="datalimit"  />
            <span class="text-danger nas_error"></span>
          </div>
        </div>
        <div class="col-md-9">
          <label for="task" class="col-md-5 control-label"><span class="text-danger">*</span>Amount</label>
          <div class="form-group">
            <input type="text" name="topup_amount" value="<?php echo $this->input->post("topup_amount"); ?>" class="form-control" id="topup_amount"  />
            <span class="text-danger nas_error"></span>
          </div>
        </div>



<div class="form-group">
  <div class="col-sm-offset-4 col-sm-5">
    <button type="submit" class="btn btn-success">Save</button>
  </div>
</div>
<?= form_close(); ?>
</div>
</div>
</div>