<div class="row clearfix">
  <div class="col-lg-8 col-md-8    col-sm-12 col-xs-12">
    <div class="card">
      <div class="header" align="center">
        <h2><?php echo isset($heading)?$heading:'ADD ITEM' ?></h2>
        
      </div>
      <div class="body">
        <form id="form_validation" method="POST" novalidate="novalidate" action="<?= base_url() ?>item/add_item_process">
           <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
          <div class="col-md-12">
            <div class="form-group form-float">
              <div class="form-line">
                <input type="text" class="form-control" name="name" required="" aria-required="true" >
                <label class="form-label">Item Name</label>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group form-float">
              <div class="form-line">
                <textarea class="form-control" name="description" required></textarea>
                <label class="form-label">Discription</label>
              </div>
            </div>
          </div>
         
         <div class="col-md-12">
          
            <div class="form-group" >
              <select class="form-control show-tick" id="category_select" name="category_id" required="" onchange="addCategoryModal()">
               
                <option value=""> --select category--</option> 

               
                <?php  foreach($category as $row)
                { ?>
                <option value="<?= $row['category_id'] ?>" > <?= $row['name'] ?></option>
                <?php } ?> 
                 <option value="default"> -- ADD CATEGORY-- </option> 
              
                
              </select>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group form-float">
              <div class="form-line">
                <input type="text" class="form-control" name="snp" required="" aria-required="true" >
                <label class="form-label">SNP NUMBER</label>
              </div>
            </div>
          </div>
         
         <!--  <div class="col-md-12" align="center">
          <div class="form-group"> -->
          <button class="btn btn-primary waves-effect" align="center" type="submit">SUBMIT</button>
      <!--   </div>
        </div> -->
        </form>
      </div>
    </div>
  </div>


 
</div>


<!-- modal start -->
  <div class="modal fade" id="customerModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">ADD NEW CATEGORY</h4>
          <!-- <p>Invoice-id - <?= $invoice[0]['invoice_id'] ?></p> -->
        </div>
        <div class="modal-body">

              <div class="body">
       
        <div class="col-md-12">
          <div class="form-group form-float">
            <div class="form-line">
              <input type="text" id="cat_name" name="name" class="form-control" required onkeypress="return isAlpha(event)" >
              <label class="form-label">Category Name</label>
            </div>
          </div>
        </div>
        <br><br>
        
        <div class="col-md-12">
         <!--  <p>
            <b>Parent Category</b>
          </p> -->
          <div class="form-group">
          <select class="form-control show-tick" name="category_id" id="category_id" required>

            <option value=""> --select category--</option>
            <option value="0"> no parent category</option>
            <?php  foreach($category as $row)
            { ?>
            <option value="<?= $row['category_id'] ?>" > <?= $row['name'] ?></option>
            <?php } ?>
            
          </select>
        </div>
        </div>
        <button class="btn btn-info" onclick="addCategory()">Add</button>
        
      </div>
      </div>
    </div>
  </div>
</div>

<script src="<?= base_url() ?>assets/admin/plugins/jquery-validation/jquery.validate.js"></script>

<script type="text/javascript">

  $(document).ready( function () {

         fetch_category();
  });


$('#form_validation').validate({

highlight: function (input) {
$(input).parents('.form-line').addClass('error');
},
unhighlight: function (input) {
$(input).parents('.form-line').removeClass('error');
},
errorPlacement: function (error, element) {
$(element).parents('.form-group').append(error);
}
});


 function fetch_category()
 {
 $.get("<?= base_url()?>category/fetch_category",function(data)
 {
  var obj=JSON.parse(data);
    console.log(obj[0].category_id);
  var row='';
  for(var i=0;i<obj.length;i++)
  {
        row += "<option value="+obj[i].category_id+">"+obj[i].name+"</option>";
  }
    console.log(row);
    $('#s').html(row);
 });

 }
function addCategoryModal()
{
  // alert();
  var i=$('#category_select').val();
  // console.log(i);
  // alert("d");
  if($('#category_select').val()=='default')
  {
  $('#customerModal').modal();
  $('#customerModal').show();
}
}

function addCategory()
{
  var category_name = $('#cat_name').val();
  var category_id = $('#category_id').val();
  $.ajax({
type: "post",
url: "<?= base_url() ?>category/add",
data:{category_id:category_id,name:category_name,<?= $this->security->get_csrf_token_name();?>:"<?= $this->security->get_csrf_hash();?>"},
success: function (data) {
  // $('#customerModal').hide();
  // fetch_category();
 location.reload();

},
});
}
</script>