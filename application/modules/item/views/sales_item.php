  
<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                              <?= $heading ?>
                                <!-- STOCK LIST -->
                            </h2>
                            
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover sales_table dataTable">
                                    <thead>
                                        <tr>
                                          <th>Sales Order #</th>
                                            <th>Customer Name</th>
                                            <th>Customer Mobile</th>
                                            <!-- <th>Item Name</th> -->
                                            <th>Total</th>
                                            <!-- <th>Serial No</th> -->
                                            <!-- <th>Model No</th> -->
                                            <th>Adding By</th> 
                                            <!-- <th>Category</th> -->
                                            <th>Action</th>
                                          
                                        </tr>
                                    </thead>
                                  
                                    <tbody>
                                      <?php foreach($item as $row)
                                      { ?>
                                        <tr>
                                          <td><?= $row['order_id'] ?></td>
                                            <td data-toggle="tooltip" data-placement="right" title="click to customer view"><a href="<?= base_url() ?>crn/customer_info/<?= $row['customer_id'] ?>"><?= $row['customer_name'] ?></a></td>
                                            <td><?= $row['mobile'] ?></td>
                                          <!-- <td><?= $row['item_name'] ?></td>  -->
                                            <td><?= $row['total'] ?></td>
                                            <!-- <td><?= $row['selling_price'] ?></td> -->
                                            <!-- <td><?= $row['serial_no'] ?></td> -->
                                            <!-- <td><?= $row['model_no'] ?></td> -->
                                            <td><?= $row['staff_name'] ?></br><?= $row['created_at'] ?></td>
                                           
                                             <td>
                                              <!-- <div class="btn-group" role="group">
                                              <a href="<?= base_url() ?>item/edit/<?= $row['id'] ?>" class="btn btn-primary waves-effect"><i class="material-icons">create</i></a>
                                              <a href="<?= base_url() ?>item/add_sales?item_name=<?= $row['item_name'] ?>&selling_price=<?= $row['selling_price'] ?>&id=<?= $row['id'] ?> " class="btn btn-danger waves-effect">sale</a>
                                            </div> -->
                                        </td>
                                    <!-- <button type="button" class="btn btn-default waves-effect">LEFT</button>
                                    <button type="button" class="btn btn-default waves-effect">MIDDLE</button>
                                    <button type="button" class="btn btn-default waves-effect">RIGHT</button> -->
                                       
                                            <!-- <td><a href="<?= base_url() ?>/item/edit/<?= $row['id'] ?>" class="btn btn-primary waves-effect"><i class="material-icons">create</i></a></td> -->
                                           
                                        </tr>
                                        
                                       <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

             <!-- Jquery DataTable Plugin Js -->
   
     <!-- <script src="<?= base_url() ?>assets/admin/js/pages/tables/jquery-datatable.js"></script> -->
     <script type="text/javascript">
      $(document).ready( function () {
    $('.sales_table').DataTable({
        "responsive": true,
        "processing": true,
        "order": [[ 4, 'desc' ]]
    });
});
     </script>