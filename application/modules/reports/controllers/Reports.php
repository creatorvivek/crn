<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Reports extends MY_Controller
{

 function __construct()
 {
  parent::__construct();
  $this->load->helper('user_helper');
  $this->load->model('Reports_model');
}





function invoice_report()
{

  if ($_SERVER['REQUEST_METHOD'] == 'POST' ) {
    $date_range = explode(' - ',$this->input->post('date_range'));
    $start_date = date_change_db($date_range[0]);
    if($date_range[1])

      $end_date = date_change_db($date_range[1]);
    // }
    $f_id=$this->session->f_id;

    $invoice_status= $this->input->post('invoice_status');

    $invoiceReportParams=array(
      'f_id'=>$f_id,
      'start_date'=>$start_date,
      'end_date'=>$end_date,
      'invoice_status'=>$invoice_status

    );

   $invoice_report=$this->Reports_model->select('table_invoices',$invoiceParam,array('id','name','mobile','email','f_name','f_mobile','f_email','f_logo','f_address','address','amount','tax','created_at','invoice_id','caf_id','total'));
    // $this->
    // try
    // {
    //   if($invoices=='')
    //   {
    //     throw new Exception("server down", 1);
    //     log_error("staff/fetchstaff function error");

    //   }
    //   if(isset($invoices['error']))
    //   {
    //     throw new Exception($invoices['error'], 1);
    //   }
    // }
    // catch(Exception $e)
    // {
    //   die(show_error($e->getMessage()));
    // }
    // catch(Exception $e)
    // {
    //   die(show_error($e->getMessage()));
    // }
    // if($invoices['status']=='success')
    // {
    //   $data['invoices']=$invoices['data'];
    // }
    // else{
    //   $data['invoices']=[];
    // }
    // $data['_view'] = 'invoice_report';
// 
    // $this->load->view('index.php',$data);
  }
  else 
  {
   $f_id=$this->session->f_id;
   $invoiceParam=array(
    'f_id'=>2

  );

$invoice_report=$this->Reports_model->select('table_invoices',$invoiceParam,array('id','name','mobile','email','f_name','f_mobile','f_email','f_logo','f_address','address','amount','tax','created_at','invoice_id','caf_id','total'));
   // $invoice_list= modules::run('api_call/api_call/call_api',''.api_url().'account/invoiceList',$invoiceParam,'POST');
  //  try
  //  {
  //   if($invoice_list=='')
  //   {
  //     throw new Exception("server down", 1);
  //     log_error("account/invoiceList error");

  //   }
  //   if(isset($invoice_list['error']))
  //   {
  //     throw new Exception($invoice_list['error'], 1);
  //   }
  // }
  // catch(Exception $e)
  // {
  //   die(show_error($e->getMessage()));
  // }
  // catch(Exception $e)
  // {
  //   die(show_error($e->getMessage()));
  // }
   // var_dump($invoice_list['data'][0]['caf_id']);
  // if($invoice_list['status']=='success')
  // {
    $data['invoices']=$invoice_report;
    // print_r($data['invoices']);die;
  // }
  // else 
  // {
  //   $data['invoices']=[];
  // }
  $data['_view'] = 'invoice_report';

  $this->load->view('index.php',$data);
}
}


function debit_credit_report()
{

 if ($_SERVER['REQUEST_METHOD'] == 'POST' ) {
  $date_range = explode(' - ',$this->input->post('date_range'));
  $start_date = date_change_db($date_range[0]);
  

  $end_date = date_change_db($date_range[1]);
    // }
  $f_id=$this->session->f_id;



  $creditReportParams=array(
    'f_id'=>$f_id,
    'start_date'=>$start_date,
    'end_date'=>$end_date,

    'reference_type'=>1

  );
  $debitReportParams=array(
    'f_id'=>$f_id,
    'start_date'=>$start_date,
    'end_date'=>$end_date,

    'reference_type'=>2

  );
// var_dump($creditReportParams);
  $debitResults =modules::run('api_call/api_call/call_api',''.api_url().'account/accountTransactionDebitReport', $creditReportParams,'POST');
  $creditResults =modules::run('api_call/api_call/call_api',''.api_url().'account/accountTransactionDebitReport', $debitReportParams,'POST');
  try
  {
    if($debitResults==''  &&  $creditResults==''  )
    {
      throw new Exception("server down", 1);
      log_error("account error");

    }
    if(isset($debitResults['error']) && isset($creditResults['error']) )
    {
      throw new Exception('error', 1);
    }
  }
  catch(Exception $e)
  {
    die(show_error($e->getMessage()));
  }
  catch(Exception $e)
  {
    die(show_error($e->getMessage()));
  }
  if($debitResults['status']=='success')
  {
    $data['debits']=$debitResults['data'];
  }
  else{
    $data['debits']=[];
  }
  if($creditResults['status']=='success')
  {
    $data['credits']=$creditResults['data'];
  }
  else{
    $data['credits']=[];
  }
  $data['_view'] = 'ledger_report';

  $this->load->view('index.php',$data);
}
else 
{
 $f_id=$this->session->f_id;



 $creditReportParams=array(
  'f_id'=>$f_id,
  'start_date'=>'',
  'end_date'=>'',

  'reference_type'=>1

);
 $debitReportParams=array(
  'f_id'=>$f_id,
  'start_date'=>'',
  'end_date'=>'',

  'reference_type'=>2

);
// var_dump($creditReportParams);
 $debitResults =modules::run('api_call/api_call/call_api',''.api_url().'account/accountTransactionDebitReport', $creditReportParams,'POST');
 $creditResults =modules::run('api_call/api_call/call_api',''.api_url().'account/accountTransactionDebitReport', $debitReportParams,'POST');
 try
 {
  if($debitResults==''  &&  $creditResults==''  )
  {
    throw new Exception("server down", 1);
    log_error("account error");

  }
  if(isset($debitResults['error']) && isset($creditResults['error']) )
  {
    throw new Exception('error', 1);
  }
}
catch(Exception $e)
{
  die(show_error($e->getMessage()));
}
catch(Exception $e)
{
  die(show_error($e->getMessage()));
  }   // var_dump($creditResults);
  if($debitResults['status']=='success')
  {
    $data['debits']=$debitResults['data'];
  }
  else{
    $data['debits']=[];
  }
  if($creditResults['status']=='success')
  {
    $data['credits']=$creditResults['data'];
  }
  else{
    $data['credits']=[];
  }

  $data['_view'] = 'ledger_report';

  $this->load->view('index.php',$data);
}
}

function user_ledger_report()
{
  if($this->input->get('caf_id'))
  {
    $f_id=$this->session->f_id;
    $caf_id=$this->input->get('caf_id');  
    $data['customer_name']=$this->input->get('customer_name');  

    $ledgerParam=array(
      'caf_id'=>$caf_id,
      'f_id'=>$f_id,
      'start_date'=>'',
      'end_date'=>''
    );
    $ledgerResults =modules::run('api_call/api_call/call_api',''.api_url().'account/ledgerReportoUser',$ledgerParam,'POST');
   
    if($ledgerResults['status']=='success')
    {
      $data['ledger']=$ledgerResults['data'];
    }
    else
    {
      $data['ledger']=[];
      $data['message']='NO DATA AVILABLE FOR THIS DATE RANGE';
    }

    $data['_view'] = 'user_ledger';

    $this->load->view('index.php',$data);
  }
  else if($_SERVER['REQUEST_METHOD'] == 'POST' )
  {
    $date_range = explode(' - ',$this->input->post('date_range'));
    $start_date = date_change_db($date_range[0]);


    $end_date = date_change_db($date_range[1]);
    // }
    $f_id=$this->session->f_id;
    $caf_id=$this->input->post('caf_id');
    $ledgerParam=array(
      'caf_id'=>$caf_id,
      'f_id'=>$f_id,
      'start_date'=>$start_date,
      'end_date'=>$end_date
    );
  // var_dump($ledgerParam);
    $ledgerResults =modules::run('api_call/api_call/call_api',''.api_url().'account/ledgerReportoUser',$ledgerParam,'POST');
   // var_dump($ledgerResults);
    if($ledgerResults['status']=='success')
    {
      $data['ledger']=$ledgerResults['data'];
    }
    else
    {
      $data['ledger']=[];
      $data['message']='NO DATA AVILABLE FOR THIS DATE RANGE';
    }

    $data['_view'] = 'user_ledger';

    $this->load->view('index.php',$data);
  }
  else
  {
   $data['_view'] = 'user_ledger';
   $data['ledger']=[];
   $this->load->view('index.php',$data);
 }



}

function reciept_report()
{
   // $data['reciepts']=[];
  $f_id=$this->session->f_id;
  $recieptsReportParams=array('f_id'=>$f_id);
  $reciepts =modules::run('api_call/api_call/call_api',''.api_url().'account/recieptReport',$recieptsReportParams,'POST');
  try
    {
      if($reciepts=='')
      {
        throw new Exception("server down", 1);
        log_error("task/addtask function error");

      }
      if(isset($reciepts['error']))
      {
        throw new Exception($reciepts['error'], 1);
      }
    }
    catch(Exception $e)
    {
      die(show_error($e->getMessage()));
    }
    catch(Exception $e)
    {
      die(show_error($e->getMessage()));
    }
  if($reciepts['status']=='success')
  {
    $data['reciepts']=$reciepts['data'];
  }
  $data['_view'] = 'reciept_report';
  $this->load->view('index.php',$data);
}

// function profit_analysis()
// {

// $f_id=$this->session->f_id;
// $condition=array('f_id'=>$f_id);  
// // $sumPurchase=$this->Reports_model->salesAnalysis('table_item_graph',$condition,$purchase_condition);

// ##last 1 month profit
//   $duration='INTERVAL 3 MONTH';
//   $data['sumSales']=$this->Reports_model->data_between_date('table_sales',array("MONTHNAME(created_at) as month","sum(total) as 'sell_total'"),$condition,$duration,$coloumn='created_at','MONTH','MONTH');

//   $data['sumPurchase']=$this->Reports_model->data_between_date('table_purchase',array("MONTHNAME(created_at) as month","sum(total_purchase_price) as 'purchase_total'","sum(purchase_price*quantity_for_sale) as 'stock reamaning'"),$condition,$duration,$coloumn='created_at','MONTH','MONTH');
//   // $stockPriceReamaning =  $this->Reports_model->data_between_date('table_purchase',array("MONTHNAME(created_at) as month","sum(purchase_price*quantity_for_sale) as 'stock reamaning'"),$condition,$duration,$coloumn='created_at');
//   // print_r($stockPriceReamaning);
//   // $this->output->enable_profiler(TRUE);
//    // $profit= $sumSales-$sumPurchase + $stockPriceReamaning[0]['sum'];
// // echo $stockPriceReamaning ;
// // echo '<br>';
//   echo json_encode($data);

// }

function profit_analysis()
{
  $f_id=$this->session->f_id;
$condition=array('f_id'=>$f_id);  
  if ($_SERVER['REQUEST_METHOD'] == 'POST' ) {
  $date_range = explode(' - ',$this->input->post('date_range'));
  $start_date = date_change_db($date_range[0]);
  

  $end_date = date_change_db($date_range[1]);

$sales_sum=$this->Reports_model->report('table_sales',array("sum(total) as 'sell_total'"),$condition,$start_date,$end_date,'',$coloumn='created_at');
$data['sales_sum']=$sales_sum[0]['sell_total'];
  // print_r($data['sumSales']);die;
  $purchase_sum=$this->Reports_model->report('table_purchase',array("sum(total_purchase_price) as 'purchase_price'","sum(quantity_for_sale*purchase_price) as stock_remain"),$condition,$start_date,$end_date,'',$coloumn='created_at');
  $data['purchase_sum']=$purchase_sum[0]['purchase_price'];
  $stockReaminingPrice=$purchase_sum[0]['stock_remain'];
           $data['profit']=$data['sales_sum']-$data['purchase_sum']+$stockReaminingPrice;
  // print_r($data['purchase_sum']);die;
// report($table_name,$display_contents,$condition,$start_date='',$end_date='',$status='',$coloumn='created_at')
                                              }
$data['_view'] = 'profitgraph';
  $this->load->view('index.php',$data);

}


function sales_analysis()
{
  $f_id=$this->session->f_id;
 
  $condition=array('f_id'=>$f_id);  
  $purchase_condition='purchase_price';
  $selling_condition='selling_price';
  $sumPurchase=$this->Reports_model->salesAnalysis('table_item_graph',$condition,$purchase_condition);
  $sumSales=$this->Reports_model->salesAnalysis('table_item_graph',$condition,$selling_condition);
  
  print_r($sumPurchase);
  print_r($sumSales);
}

/*all function end*/
}
?>	