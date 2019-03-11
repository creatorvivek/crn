<section class="content-header head">
  <h1>User Ledger Report</h1>
</section>
<form name="form" method="post" action="<?php base_url()?>user_ledger_report">                  <!-- Date range -->

 <div class="row">
  <div class="col-md-12">
    <div class="card card-danger card-outline">
      <div class="card-body">
        <div class="row">
          <div class="col-md-3">
           <div class="input-group">
          <span class="input-group-text">Date Range</span>
              <input type="text" class="form-control" id="daterange" name="date_range" autocomplete="off" required>
                          
          </div><!-- /.form group -->
        </div>
         
        <div class="col-md-2">
        	 <div class="form-group">
            <!-- <label>dfsdf </label> -->
            <input type="text" name="caf_id" placeholder="caf id" class="form-control" >
          </div>
        </div>
        <div class="col-md-1">
          <div class="form-group">
            <!-- <label>dfsdf </label> -->
            <input type="submit" name="dat_range" value="Search"  class="btn btn-primary form-control" >
          </div>
        </div>

               <div class="col-md-5 pull-right">
         <div class="form-group">
           <!-- <label> </label> -->
           <?php
           $date_rang = (!empty($this->input->post('date_range')))? $this->input->post('date_range'): 'Please select date range';
           ?>
           Date Rang: <?=  $this->input->post('date_range')?>
         </div>
       </div>
     </div>
   </div>
 </div>
</div>
</div>



<div class="row">
  <div class="col-md-12">
    <div class="card card-warning">

     <section class="content">
      <div class="row">
       <div class="col-md-12">
        <div class="card">
        	<div class="card-header">
        		<h3 class="card-title"><?php if(isset($customer_name))  { echo $customer_name;   } ?></h3>

        	</div> 
          <div class="card-body" id="colvis">                                                 
           <table id="example" class="table table-bordered table-striped">
            <thead>
              <tr>
               <th>ID</th>
               <th>Invoice Number</th>
               <th>Reciept Number</th>
               <!-- <th>Customer Name</th> -->
               <th>Debit</th>
               <th>Credit</th>
               <th>Date</th>
             

              
             </tr>
           </thead>
           <tbody>
           	<?php if(isset($message)) { echo "<div class='bg-danger'>".$message ."</div>"; }
           	else{ ?>
            <?php   $count=1;
            $debit_amount=0;
            $credit_amount=0;
             ?>
            <?php foreach ($ledger as $row) { ?>
              <?php 

              $debit_amount +=$row['debit']; 
              $credit_amount +=$row['credit']; 
              	if($row['debit']==0)
              	{
              		$row['debit']='-';
              	}
              	if($row['credit']==0)
              	{
              		$row['credit']='-';
              	}
              ?>
              <tr>
                <td><?=$count++ ?></td>
                <td><a href="<?= site_url('account/get_invoice/'.$row['invoice_id']); ?>"  target="_blank"><?=$row['invoice_id']; ?> </a></td>
                <td><?=$row['reciept_id']; ?> </td>
                <!-- <td data-toggle="tooltip" data-placement="top" title="click to view" ><a href="<?=base_url()?>student/getFullDetails?student_id=?>"></a> </td> -->
                <td><?=$row['debit'] ?></td>
                <td><?=$row['credit'] ?></td>
                <td><?=$row['date'] ?></td>
                
                	
                  
                   
                    
                  </tr>
                <?php } ?>
              </tbody>
              <tfoot>
                <tr>
                  <td><b>Total</b> </td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <!-- <td></td> -->
                  <td><?= $debit_amount ?> </td>
                  <td><?= $credit_amount ?></td> 
                  <td>&nbsp;</td> 
                  <!-- <td class="text-right"><b>Total:</b></td> -->
                  <!-- <td></td> -->
                </tr>
                <tr>
                	<td colspan=3><b>Balance </b></td>
                  <!-- <td>&nbsp;</td> -->
                  <!-- <td>&nbsp;</td> -->
                  <!-- <td></td> -->
                  <td colspan=3 align="center"><b><?php echo $debit_amount-$credit_amount ?></b> </td>
                  <!-- <td><?= $credit_amount ?></td>  -->
                  <td>&nbsp;</td> 
                </tr>
              </tfoot>
          <?php } ?>
            </table>
          </div>
        </div>
      </div>
    </div>
    <script>
  $(function () {

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
  </script>