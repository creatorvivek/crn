<div class="row clearfix">
  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
    <div class="card">
      <div class="header" align="center">
        <h2><?php echo isset($heading)?$heading:'ADD ITEM' ?></h2>
        
      </div>
      <div class="body">
        <form id="form_validation" method="POST" novalidate="novalidate" action="<?= base_url() ?>item/edit_item/<?= $item[0]['id'] ?>">
            <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
          <div class="col-md-12">
            <div class="form-group form-float">
              <div class="form-line">
                <input type="text" class="form-control" name="name" required="" aria-required="true"  value="<?= ($this->input->post('name') ? $this->input->post('name') : $item[0]['item_name']); ?>" onkeypress="return isAlpha(event)">
                <label class="form-label">Item Name</label>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group form-float">
              <div class="form-line">
                <textarea class="form-control" name="description" required><?= ($this->input->post('description') ? $this->input->post('description') : $item[0]['description']); ?></textarea>
                <label class="form-label">Discription</label>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group form-float">
              <div class="form-line">
                <input type="text" class="form-control" name="purchase_amount" required=""  value="<?= ($this->input->post('purchase_amount') ? $this->input->post('purchase_amount') : $item[0]['purchase_price']); ?>" aria-required="true" onkeypress="return isNumberKey(event)" maxlength="10">
                <label class="form-label">Purchase Amount</label>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group form-float">
              <div class="form-line">
                <input type="text" class="form-control" name="selling_amount" value="<?= ($this->input->post('selling_amount') ? $this->input->post('selling_amount') : $item[0]['selling_price']); ?>" required="" aria-required="true" onkeypress="return isNumberKey(event)" maxlength="10">
                <label class="form-label">Selling Amount</label>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <select class="form-control show-tick" name="unit" required>
                <option value="">--select unit--</option>
                <option value="pieces" <?php  if($item[0]['unit']=='pieces') {echo 'selected'; } ?> >pieces</option>
                <option value="meter" <?php  if($item[0]['unit']=='meter') {echo 'selected'; } ?> >Meter</option>
                <option value="kg" <?php  if($item[0]['unit']=='kg') {echo 'selected'; } ?> >Kg</option>
               
                </select>
              </div>
            </div>
         
          <!-- <div class="col-md-6">
            <div class="form-group form-float">
              <div class="form-line">
                <input type="text" class="form-control qty" name="qty" required="" value="<?= ($this->input->post('qty') ? $this->input->post('qty') : $item[0]['quantity']); ?>"  aria-required="true" onkeypress="return isNumberKey(event)" >
                <label class="form-label">Quantity</label>
              </div>
            </div>
          </div> -->
         <!--  <div class="col-md-6">
            <div class="form-group form-float">
              <div class="form-line">
                <input type="text" class="form-control" name="serial_number" required="" aria-required="true" value="<?= ($this->input->post('serial_number') ? $this->input->post('serial_number') : $item[0]['serial_no']); ?>">
                <label class="form-label">Serial no.</label>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group form-float">
              <div class="form-line">
                <input type="text" class="form-control" name="model_number" required="" aria-required="true" value="<?= ($this->input->post('model_number') ? $this->input->post('model_number') : $item[0]['model_no']); ?>">
                <label class="form-label">Model no.</label>
              </div>
            </div>
          </div> -->
          <div class="col-md-6">
            <div class="form-group form-float">
              <div class="form-line">
                <input type="text" class="form-control" name="company_name" required="" aria-required="true" value="<?= ($this->input->post('company_name') ? $this->input->post('company_name') : $item[0]['item_company']); ?>" >
                <label class="form-label">Item Company Name</label>
              </div>
            </div>
          </div>
           <!--   <p>
              <b>Category</b>
            </p> -->
          <div class="col-md-6">
            <div class="form-group">
              <select class="form-control show-tick" name="category_id" required>
                <!-- <option value=""> --select category--</option> -->   
                <!-- <option value="0"> no parent category</option> -->
                <?php  foreach($category as $row)
                {  
                    if($item[0]['category']==$row['category_id']){ ?>
                    <option value="<?= $row['category_id'] ?>" selected ><?= $row['name'] ?> </option>
                    <?php

                  }else{
                    ?>

                    <option value='<?= $row['category_id'] ?>' ><?= $row['name'] ?> </option> 

                  <?php }} ?> 

                        

               
                
              </select>
            </div>
          </div>
          <!-- <div class="form-group">
            <input type="radio" name="gender" id="male" class="with-gap" value="male">
            <label for="male">Male</label>
            <input type="radio" name="gender" id="female" class="with-gap" value="female">
            <label for="female" class="m-l-20">Female</label>
          </div> -->
          <input type="hidden" name="f_id" value="<?= $this->session->f_id ?>">
          <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
        </form>
      </div>
    </div>
  </div>
</div>


<script src="<?= base_url() ?>assets/admin/plugins/jquery-validation/jquery.validate.js"></script>
<script src="<?= base_url() ?>assets/admin/js/pages/forms/form-validation.js"></script>
<script type="text/javascript">
$('#form_validation').validate({
rules: {
'checkbox': {
required: true
},
'gender': {
required: true
}
},
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
</script>