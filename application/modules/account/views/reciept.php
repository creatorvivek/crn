             
  


  <!DOCTYPE html>
  <html>
  <head>
    <title></title>
  <link rel="stylesheet" href="<?= base_url() ;?>assets/admin/plugins/bootstrap/css/bootstrap.css">
  <script src="<?= base_url() ;?>assets/admin/plugins/jquery/jquery.min.js"></script>
  <style type="text/css">
    @page {
   size: 8.27in 11.69in;
   margin: 12mm 3mm 10mm 3mm;
}
.rectanglespace
{
  height:100px;
  width:100%;
  background-color:#e8eaed;

}
.text_main
{
  /*text-align:center;*/
  font-weight: 900;
font-style: bold;
  font-size: 20px;
  position: relative;
  top: 40%;
  left:50%;
  l
}
header
{
  width:100%;
  height: 60px;
  background-color: red;
}
.address
{
  /*height: 100px;*/
  /*width: 30%;*/
}

     @page {
        size: A4;
        margin: 0;
    }
    @media print {
        html, body {
            width: 210mm;
            height: 297mm;        
        }


  </style>
  </head>
  <body>
    <div class="container">
 <header></header>



 

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <!-- <div class="col-md-12"> -->
                  <!-- <a onclick="printFunction()" id="printpagebutton" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a> -->
                 <!--  <button type="button" class="btn btn-success float-right"><i class="fa fa-credit-card"></i> Submit
                    Payment
                  </button> -->
                  <div class="col-md-12"><h3>Reciept</h3></div> 
                  <div class="col-md-12 float-right"><img src="<?= base_url() ?>uploads/frenchise/<?= $reciept['f_logo'] ?>" style="height:40px; width:40px">
                    <br>
                    <?= $reciept['f_name'] ?><br>
                     mobile: <?= $reciept['f_mobile'] ?><br>
                      Address:  <?=  wordwrap($reciept['f_address']) ?>
                    <hr>
                </div>
                  <div class="col-md-6">  <h6>Payment Date -: <?= $reciept['date'] ?></h6></div>
                    <!-- <br> -->
                    <div class="col-md-6">  <h6>Recipet number -:<?= $reciept['reciept_id'] ?></h6> </div>
                    

                 
                  <br><br>
                  <!-- <div class="col-md-4 "><?= $reciept['f_name'] ?><br><h5>Address</h5><?= $newtext = wordwrap($reciept['f_address']) ?> </div> -->
                  <div class="col-md-8"><h5>Bill To</h5>
                    <h6>  <?= $reciept['customer_name'] ?></h6>

                    mobile: <?= $reciept['customer_mobile'] ?>
                    <!-- <?= $newtext = wordwrap('shubham nayak baloda bazar raipur', 20, "<br />\n"); ?> -->
                    <hr>
                     </div> 
                 <!--  <table class="table table-bordered">
                    <tr style="background-color:red;color:white;height:10px;">
                      <th>item</th>
                      <th>price</th>
                    </tr>
                    <tr>
                      
                      <td>20gb </td>
                      <td>300 </td>
                    </tr>

                  </table> -->
                  <br><hr>
                  <div class="col-md-12 pull-right"><h5>Paid - <?= $reciept['paid_amount'] ?> </h5></div>
                 <!--  <button type="button" class="btn btn-primary float-right" onclick="printFunction()" id="printpagebutton" target="_blank" style="margin-right: 5px;">
                    <i class="fa fa-download"></i> Generate PDF
                  </button> -->
                </div>
              <!-- </div> -->
           

  </div>
            <script type="text/javascript">
              function printFunction()
              {
                var printButton = document.getElementById("printpagebutton");
        //Set the print button visibility to 'hidden' 
             printButton.style.visibility = 'hidden';
                window.print();
                 printButton.style.visibility = 'visible';
              }
 $(document).ready(function() {

    window.print();
  });

            </script>
             </body>
  </html>