 <div class="row clearfix">
  <form id="form_validation" method="POST"  action="<?= base_url() ?>item/add_purchase_process">
   <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
   <div class="col-lg-8 col-md-8    col-sm-12 col-xs-12">
    <div class="card">
      <div class="header" align="center">
        <h2><?php echo isset($heading)?$heading:'ADD PURCHASE' ?></h2>
        
      </div>
      <div class="body">

       <div class="col-md-6">
        <div class="form-group form-float">
         <!-- <div class="form-line"> -->
          <select class="form-control show-tick" name="vendor_id" required="" aria-required="true" >
            <option value="" >--Select Vendor-- </option>
            <?php {
              foreach($vendor as $row)
              {
                ?>

                <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
              <?php   }

            }?>

          </select>
          <!-- </div> -->
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group form-float">
          <div class="form-line">
            <input type="text" class="form-control" name="vendor_invoice"  aria-required="true">
            <label class="form-label">Vendor Invoice ID</label>
          </div>
        </div>
      </div>
       <div class="col-md-6">
            <div class="form-group form-float">
               <!-- <div class="form-line"> -->
              <select class="form-control show-tick" name="item_id" required="" aria-required="true" >
                <option value="" >--Select Item-- </option>
                <?php {
                  foreach($item as $row)
                  {
                      ?>

                      <option value="<?= $row['id'] ?>"><?= $row['item_name'] ?></option>
                <?php   }

                }?>
               
                </select>
              <!-- </div> -->
              </div>
            </div>
      <div class="col-md-6">
        <div class="form-group form-float">
          <div class="form-line">
            <input type="text" class="form-control" name="company_name" required="" aria-required="true">
            <label class="form-label">Item Company Name</label>
          </div>
        </div>
      </div>





      <div class="col-md-3">
        <div class="form-group form-float">
          <div class="form-line">
            <input type="text" class="form-control purchase_amount" name="purchase_amount" required="" aria-required="true" onkeyup="totalAmount()" onkeypress="return isNumberKey(event)" maxlength="10">
            <label class="form-label">Purchase Amount(unit)</label>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group form-float">
          <div class="form-line">
            <input type="text" class="form-control" name="selling_amount" required="" aria-required="true" onkeypress="return isNumberKey(event)" maxlength="10">
            <label class="form-label">Selling Amount</label>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group form-float">
          <div class="form-line placeholder">
            <input type="text" class="form-control total_amount" name="total_amount" required=""  aria-required="true" onkeypress="return isNumberKey(event)" >
            <label class="form-label">Total Purchase Amount</label>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group form-float">
         <!-- <div class="form-line"> -->
          <select class="form-control show-tick" name="unit" required="" aria-required="true" >
            <option value="">--select measurement unit--</option>
            <option value="pieces">pieces</option>
            <option value="meter">Meter</option>
            <option value="kg">Kg</option>
            <option value="meter">meter</option>
            <option value="cm">cm</option>
            <option value="g">gram</option>

          </select>
          <!-- </div> -->
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group form-float">
          <div class="form-line">
            <input type="text" class="form-control qty" name="qty" value=1 required=""  onkeyup="totalAmount();dynamicSerial()"  aria-required="true" onkeypress="return isNumberKey(event)" >
            <label class="form-label">Quantity</label>
          </div>
        </div>
      </div>


      <div class="col-md-12">
       <div class="form-group">
        <div class="form-line">
         <input type="checkbox" id="basic_checkbox_2" class="filled-in check" name="check" value="1" onchange="dynamicSerial()"  />
         <label for="basic_checkbox_2">Write serial and model no</label>
       </div>
     </div>
   </div>



   <button class="btn btn-info" type="submit">Submit</button>
 </div>
</div>
</div>





<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 otherPanel"  style="display: none">
 <div class="card" style="overflow-y: scroll;max-height: 700px;">


  <div class="newRow"></div>

</div>
</div>
</form>
</div>



<script type="text/javascript">
  function dynamicSerial()
  {
  // $('.newRow').remove();
  var line=' <div class="body"><div class="col-md-6">'+
  '<div class="form-group form-float">'+
  '<div class="form-line ps">'+
  '<input type="text" class="form-control " name="serial_number[]" required="" aria-required="true">'+
  '<label class="form-label">Serial no.</label>'+
  '</div>'+
  '</div>'+
  '</div>'+
  '<div class="col-md-6">'+
  '<div class="form-group form-float">'+
  '<div class="form-line ps">'+
  '<input type="text" class="form-control" name="model_number[]" required="" aria-required="true">'+
  '<label class="form-label">Model no.</label>'+
  '</div>'+
  '</div>'+
  '</div></div>';
  $('.newRow').empty();
  var qty=$('.qty').val();
  if($('.check').is(':checked'))
  {

// if()
console.log(qty);
for(var i=0;i<qty;i++)
{
  $('.otherPanel').show();
  $('.newRow').append(line);
  $(".ps").addClass("focused");
}
}
else
{
  $('.otherPanel').hide();
  $('.newRow').empty();
}
} 
function totalAmount()
{ 
  var purchase_amount=$('.purchase_amount').val();
  var qty=$('.qty').val();
  var total_purchase=purchase_amount*qty;
  $('.total_amount').val(total_purchase);
  $(".placeholder").addClass("focused");

}
</script>