

<div class="row clearfix">
  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
    <div class="card">
      <div class="header">
        <h2 align="center">
        ADD CATEGORY
        
        </h2>
        
      </div>
      <div class="body">
        <?= form_open('category/add',array("class"=>"form-horizontal")); ?>
        <div class="col-md-12">
          <div class="form-group form-float">
            <div class="form-line">
              <input type="text" id="name" name="name" class="form-control" required onkeypress="return isAlpha(event)" >
              <label class="form-label">Category Name</label>
            </div>
          </div>
        </div>
        <!-- <div class="form-group">
          <label for="category" class="col-md-4 control-label"><span class="text-danger">*</span>Select Parent Category</label>
          <div class="col-md-3">
            <select name="paraent_cat_id" class="form-control">
              <option value="0"> no parent category</option>
            </select>
            <span class="text-danger name_error"></span>
          </div>
        </div> -->
        <div class="col-md-12">
         <!--  <p>
            <b>Parent Category</b>
          </p> -->
          <div class="form-group">
          <select class="form-control show-tick" name="category_id" required>

            <option value=""> --select category--</option>
            <option value="0"> no parent category</option>
            <?php  foreach($category as $row)
            { ?>
            <option value="<?= $row['category_id'] ?>" > <?= $row['name'] ?></option>
            <?php } ?>
            
          </select>
        </div>
        </div>
        <button class="btn btn-info">Add</button>
        <?= form_close() ?>
      </div>
    </div>
  </div>
</div>