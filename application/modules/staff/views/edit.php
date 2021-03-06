


<div class="row clearfix">
                <div class="col-lg-16 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>EDIT <?= $heading ?></h2>
                            
                        </div>
                        <div class="body">
                            <form id="form_validation" method="POST" novalidate="novalidate" action="<?= base_url() ?>staff/update/<?= $staff['id'] ?>">
                                 <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="name" required="" value="<?= ($this->input->post('name') ? $this->input->post('name') : $staff['name']); ?>" aria-required="true" >
                                        <label class="form-label">Name</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="mobile" value="<?= ($this->input->post('mobile') ? $this->input->post('mobile') : $staff['mobile']); ?>" required="" aria-required="true" onkeypress="return isNumberKey(event)" maxlength="10">
                                        <label class="form-label">Mobile</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="email" class="form-control" name="email" required="" value="<?= ($this->input->post('email') ? $this->input->post('email') : $staff['email']); ?>" aria-required="true">
                                        <label class="form-label">Email</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="gender" id="male" class="with-gap" value="male"  <?php if($staff['gender']=='male'){ echo "checked"; }  ?> >
                                    <label for="male">Male</label>

                                    <input type="radio" name="gender" id="female" class="with-gap" value="female" <?php if($staff['gender']=='female'){ echo "checked"; }  ?>>
                                    <label for="female" class="m-l-20">Female</label>
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
 </script>

          