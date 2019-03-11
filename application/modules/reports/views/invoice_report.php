<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- <section class="content-header head">
  <h1>Invoices Report</h1>
</section> -->
<form name="form" method="post" action="<?php base_url()?>invoice_report">                  <!-- Date range -->
<!-- <div class="row">
  <div class="col-md-12">
    <div class="card card-danger card-outline">
      <div class="card-body">
        <div class="row">
          <div class="col-md-3">
            <div class="input-group">
              <span class="input-group-text">Date Range</span>
              <input type="text" class="form-control" id="daterange" name="date_range" autocomplete="off" required>
              
              </div>
            </div>
            <div class="col-md-3">
              <div class="input-group">
                <span class="input-group-text">invoice status</span>
                <select class="form-control" name="invoice_status">
                  <option value="">--select--</option>
                  <option value="pending">pending</option>
                  <option value="partial">partial</option>
                  <option value="paid">paid</option>
                </select>
                
                </div>
              </div>
              <div class="col-md-1">
                <div class="form-group">
                
                  <input type="submit" name="dat_range" value="Search"  class="btn btn-primary form-control" >
                </div>
              </div>
              <div class="col-md-5 pull-right">
                <div class="form-group">
                  
                  <?php
                  $date_rang = (!empty($this->input->post('date_range')))? $this->input->post('date_range'): 'Please select date range';
                  ?>
                  Date Rang: <?php echo  $this->input->post('date_range')?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> -->
  
  <div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="card">
        <div class="header">
          <h2>
          EXPORTABLE TABLE
          </h2>
          <ul class="header-dropdown m-r--5">
            <li class="dropdown">
              <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="material-icons">more_vert</i>
              </a>
              
            </li>
          </ul>
        </div>
        <div class="body">
          <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Invoice Number</th>
                  <th>Customer Name</th>
                  <th>Base Amount</th>
                  <th>Total Amount</th>
                  <th>Date</th>
                  <!-- <th>status</th> -->
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                  <?php   $count=1;
                  $amount=0; ?>
                  <?php foreach ($invoices as $row) { ?>
                  <?php
                  $amount +=$row['total']; ?>
                <tr>
                
                    <td><?=$count++ ?></td>
                    <td><a href="<?= site_url('account/get_invoice/'.$row['invoice_id']); ?>"  target="_blank"><?=$row['invoice_id']; ?></a> </td>
                    <td data-toggle="tooltip" data-placement="top" title="click to view"  onclick="userInformation(<?= $row['caf_id']; ?> )"><?=$row['name'] ?> </td>
                    <td><?=$row['amount'] ?></td>
                    <td><?=$row['total'] ?></td>
                    <td><?=$row['created_at'] ?></td>
                   <!--  <td>
                      <span class="badge <?php if($row['status']=='pending'){
                      echo 'badge-danger';} else if($row['status']=='partially'){
                      echo 'badge-warning';
                      } else{
                      echo 'badge-success';
                      }
                    ?>"><?= $row['status'] ?></span>
                  </td> -->
                    <td><a href="<?= site_url('account/get_invoice/'.$row['invoice_id']); ?>" class="btn btn-info btn-xs" target="_blank">Get Pdf</a>
                  </td>
                </tr>
                <?php } ?>
              </tbody>
             <!--  <tfoot>
              <tr>
                <td>Total </td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td><strong><?php echo $amount;?></strong></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
               
              </tr>
              
           
            
          </tfoot> -->
        </table>
      </div>
    </div>
  </div>
</div>
</div>
<!-- #END# Exportable Table -->
<div class="modal" id="user_profile">
<div class="modal-dialog">
  <div class="modal-content">
    <!-- Modal Header -->
    <div class="modal-header">
      <h4 class="modal-title">User Profile</h4>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <!-- Modal body -->
    <div class="modal-body body">
      
    </div>
    <!-- Modal footer -->
    <div class="modal-footer">
      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
    </div>
  </div>
</div>
</div>
 <!-- Jquery DataTable Plugin Js -->
    <!-- <script src="<?= base_url() ?>/assets/admin/plugins/jquery-datatable/jquery.dataTables.js"></script> -->
    <!-- <script src="<?= base_url() ?>/assets/admin/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script> -->
    <script src="<?= base_url() ?>/assets/admin/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="<?= base_url() ?>/assets/admin/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="<?= base_url() ?>/assets/admin/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="<?= base_url() ?>/assets/admin/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="<?= base_url() ?>/assets/admin/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="<?= base_url() ?>/assets/admin/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="<?= base_url() ?>/assets/admin/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
    <script type="text/javascript">
$(function () {
    // $('.js-basic-example').DataTable({
    //     responsive: true
    // });

    //Exportable table
    $('.js-exportable').DataTable({
        dom: 'Bfrtip',
        responsive: true,
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
});
</script>
<script>
/*$(function () {
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

$(document).ready(function() {
var table = $('#example').DataTable( {
"lengthMenu": [[25, 50,100,-1], [25 , 10,50,100,"All"]]
} );
// for each column in header add a togglevis button in the div
$("#example thead th").each( function ( i ) {
var name = table.column( i ).header();
var spanelt = document.createElement( "button" );
spanelt.innerHTML = name.innerHTML;

$(spanelt).addClass("colvistoggle");
$(spanelt).addClass("btn btn-info");
$(spanelt).attr("colidx",i);    // store the column idx on the button

$(spanelt).on( 'click', function (e) {
e.preventDefault();
// Get the column API object
var column = table.column( $(this).attr('colidx') );
// Toggle the visibility
column.visible( ! column.visible() );
if($(spanelt).hasClass('btn-danger'))
$(spanelt).removeClass('btn-danger');
else
$(spanelt).addClass("btn btn-danger");
});
$("#colvis").append($(spanelt));
});
} );*/

function userInformation(caf_id)
{
// console.log(caf_id);
$.ajax({
type: "post",
url: "<?= base_url() ?>admin/userDetailsInProfilesbyCaf",
data:{caf_id:caf_id},
success: function (data) {
// alert(data);
// console.log(data);
var obj=JSON.parse(data)
// var result=datas;
var row='<h3 class="profile-username text-center" id="name">'+obj.name+'</h3><hr><strong>Email</strong><p class="text-muted" id="email">'+obj.primary_email+'</p><hr><strong>Mobile</strong><p class="text-muted" id="mobile">'+obj.contact_mobile+'</p><hr><strong>Permanent Location</strong><p class="text-muted" id="p_address">'+obj.permanent_address+'  pincode-: '+obj.p_add_pincode+'</p><hr><strong>Username</strong><p class="text-muted" id="username"></p><hr><strong>Crn number</strong><p class="text-muted" id="crn_number">'+obj.crn_number+'</p><hr><strong>caf id</strong><p class="text-muted" id="caf_id">'+obj.id+'</p>';
$('.body').html(row);
$('#user_profile').show();
$('#user_profile').modal();

// console.log(obj);
},
})
}
</script>