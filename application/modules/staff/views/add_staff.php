<div class="row clearfix">
                <div class="col-lg-16 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>ADD <?= $heading ?></h2>
                            
                        </div>
                        <div class="body">
                            <form id="form_validation" method="POST" novalidate="novalidate" action="<?= base_url() ?>staff/add">
                                 <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="name"  value="<?= $this->input->post('name'); ?>" required="" aria-required="true" >
                                        <label class="form-label">Name</label>
                                        <span class="text-danger"><?= form_error('name');?></span>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="mobile" required=""  value="<?= $this->input->post('mobile'); ?>" aria-required="true" onkeypress="return isNumberKey(event)" maxlength="10">
                                        <label class="form-label">Mobile</label>
                                        <span class="text-danger"><?= form_error('mobile');?></span>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="email" class="form-control" name="email" required="" value="<?= $this->input->post('email'); ?>" aria-required="true">
                                        <label class="form-label">Email</label>
                                        <span class="text-danger"><?= form_error('email');?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="gender" id="male" class="with-gap" value="male" <?php echo  set_radio('gender', '1'); ?> >
                                    <label for="male">Male</label>

                                    <input type="radio" name="gender" id="female" class="with-gap" value="female" <?php echo  set_radio('gender', '1'); ?> >
                                    <label for="female" class="m-l-20">Female</label>
                                    <span class="text-danger"><?= form_error('gender');?></span>
                                </div>
                               
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

   function validation()
   {


      var $regexname=/^([a-zA-Z]{3,16})$/;
   
             if (! $('.name').val().match($regexname)) {
              // there is a mismatch, hence show the error message
                 alert("not match");
             }
             else
             {

             }
   }
 </script>

          