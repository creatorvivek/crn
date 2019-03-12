<div class="row clearfix">
  <div class="col-md-12">
    <div class="card">
      <div class="card-tools pull-right">
          <a href="<?= site_url('crn/add_crn'); ?>" class="btn btn-success ">Add Customer</a>
        </div> 
        <form action="<?= base_url() ?>crn/customer_list" method="post">
      <div class="body">
        <div class="row clearfix">
         
        <div class="col-md-4">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            DATE RANGE
                                        </span>
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="daterange" name="date_range" placeholder="select date range" autocomplete="off" required>
                                        </div>
                                    </div>
                                </div>
        <div class="col-md-1">
          <div class="form-group">
            <!-- <label>dfsdf </label> -->
            <button type="submit"    class="btn btn-primary form-control" >SEARCH</button>
          </div>
        </div>
        <div class="col-md-5 pull-right">
         <div class="form-group">
           <!-- <label> </label> -->
           <?php
           $date_rang = (!empty($this->input->post('date_range')))? $this->input->post('date_range'): 'Please select date range';
           ?>
           Date Rang: <?php echo  $this->input->post('date_range')?>
         </div>
       </div>
     </div>
   </div>
 </form>
 </div>
</div>
</div>


<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
      <div class="header">
        <h2>
        CUSTOMER LIST
        </h2>
        
      </div>
      <div class="body">
        
         <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover user_table dataTable">
          <thead>
            <tr>
              <!-- <th>Ticket id</th> -->
              <th>Name</th>
              <th>Email</th>
              <th>Mobile</th>
              <th>location</th>
              <th>City</th>
              <!-- <th>leads</th> -->
              <th>Created_at</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($customer as $row){ ?>
            <tr id="<?= $row['id'] ?>">
              
              <td><?= $row['name']; ?></td>
              <td><?= $row['email']; ?></td>
              <td><?= $row['mobile']; ?></td>
              <td><?= $row['address']; ?></td>
              <td><?= $row['city']; ?></td>
            
              <td><?= $row['created_at']; ?></td>
                <!-- <br><div class="creator_name"><?= '-'. $row['created_by']; ?></div></td> -->
                <td>
                  
                  <div class="btn-group" role="group">
                    <a href="<?= base_url() ?>ticket/add_ticket?crn=<?= $row['id'] ?>&name=<?= $row['name'] ?>&mobile=<?= $row['mobile'] ?>&email=<?= $row['email'] ?>" data-toggle="tooltip" data-placement="top" title="generate ticket" class="btn btn-info"><i class="material-icons">assignment</i></a>
                    <a href="<?= base_url() ?>crn/update/<?= $row['id'] ?>" class="btn btn-primary waves-effect" data-toggle="tooltip" data-placement="top" title="edit"><i class="material-icons">create</i></a>
                    <a href="<?= base_url() ?>crn/customer_info/<?= $row['id'] ?>" class="btn btn-primary waves-effect" data-toggle="tooltip" data-placement="top" title="customer details"><i class="material-icons">explore</i></a>
                     <a href="<?= base_url() ?>sms/index?mobile=<?= $row['mobile'] ?>" class="btn btn-info waves-effect" data-toggle="tooltip" data-placement="top" title="send sms"><i class="material-icons">textsms</i></a>
                   <!--  <button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="delete" onclick="delFunction(<?php echo $row['id'] ?>);" data-toggle="tooltip" data-placement="top" title="Delete"><i class="material-icons">delete</i></button> -->
                  </div>
                  
               
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      </div>
    </div>
  </div>
</div>

      <!-- /.tab-pane -->
      
    
<script type="text/javascript">
$(document).ready( function () {
$('.user_table').DataTable(
{
  "order": [[ 4, 'desc' ]]
// "processing": true
});
} );
 function delFunction(id)
        {
     swal({
      title: "Are you sure?", 
      text: "Are you sure that you want to delete this id?", 
      type: "warning",
      showCancelButton: true,
      closeOnConfirm: false,
      confirmButtonText: "Yes, delete it!",
      confirmButtonColor: "#ec6c62"
    }, function() {
      $.ajax({
        url: "<?= base_url() ?>crn/remove/"+id,
        type: "DELETE"
      })
      .done(function(data) {
        swal("Deleted!", "Your file was successfully deleted!", "success");
         $('#'+id+'').fadeOut(300);
      })
      .error(function(data) {
        swal("Oops", "We couldn't connect to the server!", "error");
      });
    });
  }
</script>
<script src="<?= base_url() ;?>assets/admin/plugins/daterangepicker/moment.js"></script>
     <script src="<?= base_url() ;?>assets/admin/plugins/daterangepicker/daterangepicker.js"></script>
     <script>
     $(function () {

    $('#daterange').daterangepicker(
    {
      ranges: {
        'Today': [moment(), moment()],
        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month': [moment().startOf('month'), moment().endOf('month')],
        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      },
      startDate: moment().subtract(29, 'days'),
      endDate: moment()
    },
    function (start, end) {
      $('#daterange').val(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
    }
    );
  });
</script>