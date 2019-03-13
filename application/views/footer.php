
<script type="text/javascript">
   window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 4000);

  function isNumberKey(evt) {
  var charCode = (evt.which) ? evt.which : evt.keyCode;
  // Added to allow decimal, period, or delete
  if (charCode == 110 || charCode == 190 || charCode == 46) 
    return true;
  
  if (charCode > 31 && (charCode < 48 || charCode > 57)) 
    return false;
  
  return true;
} // isNumberKey

function isAlpha(evt) {
  var charCode = (evt.which) ? evt.which : event.keyCode
  if ((charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122))
    return false;

  return true;
}
/*use to make whole project autocomplete off*/
$(document).ready(function(){ 
    $("input").attr("autocomplete", "off");
}); 

</script>








 <!-- Jquery Core Js -->
   

    <!-- Bootstrap Core Js -->
    <script src="<?= base_url() ?>assets/admin/plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- Select Plugin Js -->
    <script src="<?= base_url() ?>assets/admin/plugins/bootstrap-select/js/bootstrap-select.min.js"></script>

    <!-- Slimscroll Plugin Js -->
    <!-- <script src="<?= base_url() ?>/assets/admin/plugins/jquery-slimscroll/jquery.slimscroll.js"></script> -->

    <!-- Waves Effect Plugin Js -->
    <script src="<?= base_url() ?>assets/admin/plugins/node-waves/waves.min.js"></script>

    <!-- Jquery CountTo Plugin Js -->
    



    <!-- Custom Js -->
    <script src="<?= base_url() ?>assets/admin/js/admin.js"></script>
    <!-- <script src="<?= base_url() ?>/assets/admin/js/pages/index.js"></script> -->

    <!-- Demo Js -->
    <!-- <script src="<?= base_url() ?>/assets/admin/js/demo.js"></script> -->
    
    <!--   <script src="<?= base_url() ?>assets/admin/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="<?= base_url() ?>assets/admin/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="<?= base_url() ?>assets/admin/js/pages/tables/jquery-datatable.js"></script> -->
      <script src="<?= base_url() ?>assets/jquery-ui.js"></script>
           <!-- <script src="<?= base_url() ?>assets/admin/plugins/momentjs/moment.js"></script> -->
      <!-- <script src="<?= base_url() ?>assets/admin/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script> -->
          <!-- <script src="<?= base_url() ?>assets/admin/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script> -->
           
</body>

</html>