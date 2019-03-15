<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
      <div class="header">
        <h2>
        CATEGORY LIST
        </h2>
        
      </div>
      <div class="body">
        
         <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover user_table dataTable">
          <thead>
            <tr>
              <!-- <th>Ticket id</th> -->
              <th>id</th>
              <th>Name</th>
             
          
            </tr>
          </thead>
          <tbody>
            <?php foreach($category as $row){ ?>
            <tr id="<?= $row['id'] ?>">
              
              <td><?= $row['category_id']; ?></td>
              <td><?= $row['name']; ?></td>
          
            
               
               <!--  <td>
                  
                  <div class="btn-group" role="group">
                    <a href="<?= base_url() ?>ticket/add_ticket?crn=<?= $row['id'] ?>&name=<?= $row['name'] ?>&mobile=<?= $row['mobile'] ?>&email=<?= $row['email'] ?>" data-toggle="tooltip" data-placement="top" title="generate ticket" class="btn btn-info"><i class="material-icons">assignment</i></a>
                    <a href="<?= base_url() ?>crn/update/<?= $row['id'] ?>" class="btn btn-primary waves-effect"><i class="material-icons">create</i></a>
                    <a href="<?= base_url() ?>crn/customer_info/<?= $row['id'] ?>" class="btn btn-primary waves-effect"><i class="material-icons">explore</i></a>
                    
                    <button type="button" class="btn btn-danger" onclick="delFunction(<?php echo $row['id'] ?>);" data-toggle="tooltip" data-placement="top" title="Delete"><i class="material-icons">delete</i></button>
                  </div>
                  
               
              </td> -->
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
      
     <script src="<?= base_url() ?>assets/admin/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="<?= base_url() ?>assets/admin/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script type="text/javascript">
$(document).ready( function () {
$('.user_table').DataTable(
{
 
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