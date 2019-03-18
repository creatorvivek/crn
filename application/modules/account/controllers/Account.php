<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH.'libraries/qr/qrlib.php');
class Account extends MY_Controller
{

 function __construct()
 {
  parent::__construct();
  $this->load->model('Account_model');
}


function invoice($params,$particular)
{
  // print_r($params);
  // print_r($particular);

  $invoice_id=$this->get_invoice_id();
  // print_r($invoice_id);
  $f_id=$this->session->f_id;
  $seller_info=$this->seller_info($f_id);
  // print_r($seller_info);
  // die;
##insert particular and amount in master invoice table_invoices
  $length=count($particular['particular']);
  $amount=0;
  for($k=0;$k<$length;$k++)
  {
    
    $masterInvoiceParams=array(
      'invoice_id'=>$invoice_id,
      'particular'=>$particular['particular'][$k],
      'price'=>$particular['price'][$k],
      'quantity'=>$particular['quantity'][$k],
      'unit'=>$particular['unit'][$k],
      'f_id'=>$f_id



    );
    print_r($masterInvoiceParams);
    $amount=$amount+$particular['price'][$k];
    $data=$this->Account_model->insert('table_master_invoice', $masterInvoiceParams);
    // $insertAccountPariculars=modules::run('api_call/api_call/call_api',''.api_url().'account/insertAccountParticular',$masterInvoiceParams,'POST');
  }
## maintain tax of seller
  // $tax_detail=json_decode($seller_info['data']['tax'],true) ;
  $tax_detail=json_decode($seller_info[0]['tax'],1) ;
  // print_r(array_values($tax_detail[0]));
  $tax_amount=0;
  // $tax_amount=round($amount*0.18);
  for($i=0;$i<count($tax_detail);$i++) {
        // print_r($tax_detail[$i])  ;           




  
   $tax_amount = $tax_amount+round($amount  * (array_values($tax_detail[$i])[0])/100)   ;


 //   $taxMaintain=array(

 //    'invoice_id'=>$invoice_id,
 //    'f_id'=>$seller_info['data']['seller_id'],
 //    'tax_name'=>array_keys($tax_detail[$i])[0],
 //    'tax_amount'=>round(($amount * (array_values($tax_detail[$i]))[0])/100) 


 //  ); 

 //   $insertAccountTransaction=modules::run('api_call/api_call/call_api',''.api_url().'account/insertTaxAmountDetail',$taxMaintain,'POST');

   

  }
  $total=$amount+round($tax_amount);
##insert in database
##check seller have isp licence or not if not have upper seller has to pay dot
    $seller_id_param=array('f_id'=>$f_id);
 // $total=round($tax_amount)+$amount;
##insert invoice details
 $invoiceParams=array(
  'invoice_id'=>$invoice_id,
  'name'=>$params['customer_name'],
  'customer_id'=>$params['customer_id'],
  'company_name'=>$seller_info[0]['company_name'],
  'f_mobile'=>$seller_info[0]['mobile'],
  'f_email'=>$seller_info[0]['email'],
  'f_logo'=>$seller_info[0]['logo'],
  'f_id'=>$f_id,
  'email'=>$params['email'],
  'mobile'=>$params['mobile'],
  'order_id'=>$params['order_id'],
  'address'=>$params['address'],
  'c_city'=>$params['c_city'],
  'c_pincode'=>$params['c_pincode'],
  'f_address'=>$seller_info[0]['address'],
  'f_city'=>$seller_info[0]['city'],
  'f_pincode'=>$seller_info[0]['pincode'],
  'tax'=>$seller_info[0]['tax'],
  'created_at'=>date('y-m-d H-i-s'),
  'amount'=>$amount,
  'total'=>$total
  // 'username'=>$params[0]['username'],
  // 'caf_id'=>$params[0]['id']
);
print_r($invoiceParams);die;
 // $collectUserInformation=modules::run('api_call/api_call/call_api',''.api_url().'account/insert_invoice_information',$invoiceParams,'POST');
 $collectUserInformation=$this->Account_model->insert('table_invoices',$invoiceParams);
 // print_r(expression)
 $last_inserted_id=$collectUserInformation;

 $accountTransaction=array(
  'reference_id'=>$last_inserted_id,
  'reference_type'=>1,
  'debit'=>$total,
  'f_id'=>$f_id,
  'invoice_id'=>$invoice_id,
  'customer_id'=>$params['customer_id'],
  // 'caf_id'=>$params[0]['id'],
  'created_at'=>date('Y-m-d H-i-s')

);
 $this->Account_model->insert('table_account_transaction',$accountTransaction);
 
## get which type of frnchise fix, or revenue
 // $seller_type=$this->seller_type($f_id);
//  if($seller_type['data'][0]['seller_type']==2)
//  {
//   $sellerParams=array(
//     'f_id'=>$f_id
//   );
//   $getsellerWalletAmount=modules::run('api_call/api_call/call_api',''.api_url().'account/getsellerWalletAmount',$sellerParams,'POST');
//   if($getsellerWalletAmount['status']=='success')
//   {
//     $wallet_amount=$getsellerWalletAmount['data'][0]['wallet'];
//       // echo $wallet_amount;
//       // echo $amount;die;
//     $updated_wallet_amount=$wallet_amount - $amount;
//     $updated_wallet_amount_param=array('wallet'=>$updated_wallet_amount,'f_id'=>$f_id);
//     $updatesellerWalletAmount=modules::run('api_call/api_call/call_api',''.api_url().'account/updatesellerWalletAmount',$updated_wallet_amount_param,'POST');

//   }


// }


##if seller type is share revenue then wallet concept is applicable so in every invoice wallet is reduced by base amount


  // var_dump($insertAccountTransaction);
/*----*/
   // updateBalance();
   ##get user balance
// $accountBalanceParam=array(
//   'f_id'=>$f_id,
//   'username'=>$params[0]['username']
// );
// $customerBalance=modules::run('api_call/api_call/call_api',''.api_url().'account/customerBalance',$accountBalanceParam,'POST');

// $updateBalanceParam=array(
//   'balance'=>$customerBalance,
//   'caf_id'=>$params[0]['id']
// );

// $update_customer_balance=modules::run('api_call/api_call/call_api',''.api_url().'account/updateBalance',$updateBalanceParam,'POST');


return $invoice_id;
}


function collect_information_invoices($username,$particular)

{

  $user_name=array('username'=>$username);

  $collectUserInformation=modules::run('api_call/api_call/call_api',''.api_url().'account/userInformation',$user_name,'POST');
  // echo '<pre>';
  // var_dump($collectUserInformation);
  
  // die;
  
  $this->invoice($collectUserInformation['data'],$particular);

  
}

function reciept($params)
{
  $f_id=$params['f_id'];
  $reciept_id=$this->get_reciept_id();
  $user_id=array(
    'username'=>$params['username']
  );

 // $getsellerInfo= modules::run('api_call/api_call/call_api',''.api_url().'account/userInformation',$user_id,'POST');
  $seller_info=$this->seller_info($f_id);
  $recieptParams=array(
    'reciept_id'=>$reciept_id,
    'username'=>$params['username'],


    'customer_name'=>$params['name'],
    'customer_mobile'=>$params['mobile'],

    'paid_amount'=>$params['paid_amount'],
    'pay_type'=>$params['pay_type'],
    'attend_type'=>$params['attend_type'],
    'f_name'=>$seller_info['data']['f_name'],
    'f_mobile'=>$seller_info['data']['mobile'],
    'f_address'=>$seller_info['data']['address'],
    'f_logo' =>$seller_info['data']['logo'],
    'f_id'=>$f_id,
    'date'=>date('y-m-d H:i:s')
  );

  $reciept=modules::run('api_call/api_call/call_api',''.api_url().'account/addReciept',$recieptParams,'POST');
## insert reciept information in account transaction
  $accountTransaction=array(
    'reference_id'=>$reciept['last_inserted_id'],
    'reference_type'=>2,
    'credit'=>$params['paid_amount'],
    'f_id'=>$f_id,
    'reciept_id'=>$reciept_id,
    'username'=>$params['username'],
    'caf_id'=>$params['caf_id'],
    'date'=>date('y-m-d H:i:s')

  );

  $insertAccountTransaction=modules::run('api_call/api_call/call_api',''.api_url().'account/insertAccountTransactionInformation',$accountTransaction,'POST');

  // return  $reciept['last_inserted_id'];

 ##search and maintain balance of customer
  $accountBalanceParam=array(
    'f_id'=>$f_id,
    'username'=>$params['username']
  );
  $customerBalance=modules::run('api_call/api_call/call_api',''.api_url().'account/customerBalance',$accountBalanceParam,'POST');

  $updateBalanceParam=array(
    'balance'=>$customerBalance,
    'caf_id'=>$params['caf_id']
  );

  $update_customer_balance=modules::run('api_call/api_call/call_api',''.api_url().'account/updateBalance',$updateBalanceParam,'POST');

 ##maintain status of invoice (paid,pending,partially)'

  $invoiceStatusParam=array(
    'paid'=>$params['paid_amount'],
    'f_id'=>$f_id,
    'caf_id'=>$params['caf_id']

  );
  $maintain_status_invoice=modules::run('api_call/api_call/call_api',''.api_url().'account/invoiceStatusmaintain',$invoiceStatusParam,'POST');



}

private function get_reciept_id()
{
  $f_id=$this->session->f_id;
  $recieptNoParams=array('f_id'=>$f_id);
  $maxRecieptNo=modules::run('api_call/api_call/call_api',''.api_url().'account/getMaxRecieptNo',$recieptNoParams,'POST');
  if($maxRecieptNo['status']=='not found')
  {
    return $reciept_id='reciept'.$f_id.'_00001';
  }
  else if($maxRecieptNo['status']=='success')
  {

    return $reciept_id=$maxRecieptNo['data'];
  }
  else
  {
    try
    {
      if($maxRecieptNo['error'])

        throw new Exception($maxRecieptNo['error'], 1);

    }
    catch(Exception $e)
    {
     echo $e->getMessage();
     exit();
   }     
 }
}

private function get_invoice_id()
{
  $f_id=$this->session->f_id;
  $invoiceNoParams=array('f_id'=>$f_id);
  // $maxInvoiceNo=modules::run('api_call/api_call/call_api',''.api_url().'account/get_max_invoice_no',$invoiceNoParams,'POST');
 $maxInvoiceNo= json_decode($this->Account_model->get_max_invoice_no('table_invoices',$invoiceNoParams),1);
 // print_r($maxInvoiceNo);die;
  if($maxInvoiceNo['status']=='not found')
  {
    return $invoice_id='1';
  }
  else if($maxInvoiceNo['status']=='success')
  {

   return $invoice_id=$maxInvoiceNo['data'];
 }
 else
 {
  try
  {
    if($maxInvoiceNo['error'])

      throw new Exception($maxInvoiceNo['error'], 1);
    
  }
  catch(Exception $e)
  {
   echo $e->getMessage();
   exit();
 }     
}
}
 function get_payment_id()
{
  $f_id=$this->session->f_id;
  $invoiceNoParams=array('f_id'=>$f_id);
  // $maxInvoiceNo=modules::run('api_call/api_call/call_api',''.api_url().'account/get_max_invoice_no',$invoiceNoParams,'POST');
 $maxInvoiceNo= json_decode($this->Account_model->get_max_payment_no($invoiceNoParams),1);
 // print_r($maxInvoiceNo);die;
  if($maxInvoiceNo['status']=='not found')
  {
    return $invoice_id='1';
  }
  else if($maxInvoiceNo['status']=='success')
  {

   return $invoice_id=$maxInvoiceNo['data'];
 }
 else
 {
  try
  {
    if($maxInvoiceNo['error'])

      throw new Exception($maxInvoiceNo['error'], 1);
    
  }
  catch(Exception $e)
  {
   echo $e->getMessage();
   exit();
 }     
}
}

function get_invoice($invoice_id)
{
  $f_id=$this->session->f_id;
  $params=array('invoice_id'=>$invoice_id,'f_id'=>$f_id);
  // $getInvoiceData=modules::run('api_call/api_call/call_api',''.api_url().'account/get_invoice_data',$params,'POST');
  // var_dump($getInvoiceData);
  $getInvoiceData=$this->Account_model->select('table_invoices',$params,array('id','name','mobile','email','company_name','f_mobile','f_email','f_logo','f_address','address','amount','tax','created_at','invoice_id','total','c_city','c_pincode'));
      // print_r($getInvoiceData);die;
  // try
  // {
  //   if($getInvoiceData=='')
  //   {
  //     throw new Exception("server down", 1);
  //     log_error("account/getInvoiceData function error");

  //   }
  //   if(isset($getInvoiceData['error']))
  //   {
  //     throw new Exception($getInvoiceData['error'], 1);
  //   }
  // }
  // catch(Exception $e)
  // {
  //   die(show_error($e->getMessage()));
  // }

  // if($getInvoiceData['status']=='success')
  // {
  //   $data['invoice']=$getInvoiceData['data'][0];
  // }
  // var_dump($getInvoiceData['data'][0]['tax']);
  // echo array_keys($getInvoiceData['data'][0]['tax']);
  // die;
  // $get_particular_detail= modules::run('api_call/api_call/call_api',''.api_url().'account/getInvoiceParticularData',$params,'POST');
  $get_particular_detail=$this->Account_model->select('table_master_invoice',$params,array('particular','price','quantity'));
          // var_dump($get_particular_detail['data']);

  $rows = "";
  $no =1;
  $subtotal=0;
  $data['rows']='';
  $length=count($get_particular_detail);
  for($i=0;$i<$length;$i++) {


    $name = $get_particular_detail[$i]["particular"];
    $quantity = $get_particular_detail[$i]["quantity"];
    $price = $get_particular_detail[$i]["price"];
    $subtotal = $subtotal + $price;

    if($name!=""){
      $data['rows'] .= "<tr><td>".$no."</td><td>".$name."</td><td>".$quantity."</td><td>".$price."</td>
      </tr>";
    }
    $no++;


  }
  ##generate qr code
  // $data['qr']='amount='.$data['invoice']['amount'].','.'invoice_id='.$invoice_id;
  ##generate bar code
  // $data['barcode']=$data['invoice']['invoice_id'];


  ##take invoice template to database seller basis
  $data['invoice']=$getInvoiceData[0];
  $invoice_template=$this->session->invoice_template;
  if($invoice_template==0){$invoice_template='default';}
  // $this->load->view('invoice_template/'.$invoice_template,$data);
  $this->load->view('invoice_template/first',$data);

}

function get_reciept($id)
{
 $params=array('reciept_id'=>$id);
 $getRecieptData=modules::run('api_call/api_call/call_api',''.api_url().'account/getRecieptData',$params,'POST');
  // var_dump($getInvoiceData);
 try
 {
  if($getRecieptData=='')
  {
    throw new Exception("server down", 1);
    log_error("account/getRecieptData function error");

  }
  if(isset($getRecieptData['error']))
  {
    throw new Exception($getRecieptData['error'], 1);
  }
}
catch(Exception $e)
{
  die(show_error($e->getMessage()));
}

if($getRecieptData['status']=='success')
{
 $data['reciept']=$getRecieptData['data'][0];
 // var_dump($data['reciept']);
}
 // $data['_view'] = 'reciept';

$this->load->view('reciept',$data);
}

function invoice_list()
{
  $f_id=$this->session->f_id;
  if($this->input->get('status')=='pending')
  {
    $invoiceParam=array(
    'f_id'=>$f_id,
    'status!='=>'paid'
       );  
    $invoice_list=$this->Account_model->select('table_invoices',$invoiceParam,array('id','name','mobile','email','amount','paid','status','invoice_id','created_at','total','customer_id'));
  }
 
else if($_SERVER['REQUEST_METHOD'] == 'POST' )
  {
     $this->load->helper('user_helper');
    $date_range = explode(' - ',$this->input->post('date_range'));
    $start_date = date_change_db($date_range[0]);


    $end_date = date_change_db($date_range[1]);
    // }
  
    $condition=array(
   
      'f_id'=>$f_id,
     
    );
  // var_dump($ledgerParam);
  // die;
    $invoice_list= $this->Account_model->report('table_invoices',array('*'),$condition,$start_date,$end_date,$status='');

  }
  else
  {
  $invoiceParam=array(
    'f_id'=>$f_id

  );
 $invoice_list=$this->Account_model->select('table_invoices',$invoiceParam,array('id','name','mobile','email','amount','paid','status','invoice_id','created_at','total','customer_id'));

  }
  
    $data['invoice']=$invoice_list;
    $data['heading']='INVOICE LIST';
  $data['_view'] = 'invoice_list';

  $this->load->view('index.php',$data);



}
function invoice_list_condition()
{
 $status=$this->input->get('status');
 $f_id=$this->session->f_id;
 $invoiceParam=array(
  'f_id'=>$f_id,
  'status'=>$status

);

 $invoice_list= modules::run('api_call/api_call/call_api',''.api_url().'account/invoiceList',$invoiceParam,'POST');
 try
 {
  if($invoice_list=='')
  {
    throw new Exception("server down", 1);
    log_error("account/invoiceList function error");

  }
  if(isset($invoice_list['error']))
  {
    throw new Exception($invoice_list['error'], 1);
  }
}
catch(Exception $e)
{
  die(show_error($e->getMessage()));
}

if($invoice_list['status']=='success')
{
  $data['invoice']=$invoice_list['data'];
}
else 
{
  $data['invoice']=[];
}
$data['_view'] = 'invoice_list';

$this->load->view('index.php',$data);


}

 function seller_info($f_id)

{
  $condition=array('seller_setting.f_id'=>$f_id);
  $data=$this->Account_model->fetch_seller_details('table_seller_setting',$condition,array('logo','name','mobile','email','address','gst_number','tax','city','pincode','company_name'));
  return $data;
  // print_r($data);
}


function seller_dot_license($f_id)
{
$params=array('f_id'=>$f_id);
return modules::run('api_call/api_call/call_api',''.api_url().'account/check_ist',$params,'POST');

}
function seller_type($f_id)
{
  $params=array('id'=>$f_id);
 return modules::run('api_call/api_call/call_api',''.api_url().'seller/seller_type',$params,'POST');
}
// function advance_rental()
// {
//    $f_id=$this->session->f_id;
//   ##get billing date of seller
//   $fParams=array('f_id'=>$f_id);
//   $seller_account=modules::run('api_call/api_call/call_api',''.api_url().'seller/list_seller_account',$fParams,'POST');
//   try
//   {
//   if($seller_account=='')
//       {
//         throw new Exception("server down", 1);
//         log_error("account/list_seller_account function error");

//       }
//       if(isset($seller_account['error']))
//       {
//         throw new Exception($seller_account['error'], 1);
//       }
//     }
//     catch(Exception $e)
//     {
//       die(show_error($e->getMessage()));
//     }
//    $seller_billing_cycle=$seller_account['data'][0]['billing_cycle'];
//    $current_date_day=date('d');
//    if($seller_billing_cycle==$current_date_day)
//    {

//   $plan_monthly_amount=500;
//   echo $date=date('y-m-d');
//   // echo '<br>';
//   $year=date('Y',strtotime($date));
//   $month=date('m',strtotime($date));

//   $day_in_month=cal_days_in_month(CAL_GREGORIAN,$month,$year);
//   // echo $day_in_month;
//   $one_day_rate=$plan_monthly_amount/$day_in_month;
//  round($one_day_rate, 2);
//   $date1=strtotime(date('y-m-'.$seller_billing_date.''));
//  $date2=strtotime(date('y-m-'.$current_date_day.''));
//  // echo $difference_in_date=date_diff('18-12-12 12:2:2',$date2);
//  $difference_in_date=7;
//  echo $partial_invoice_amount=$difference_in_date*$one_day_rate;
// $particular=array('particular'=>['advance rental'],'price'=> [$partial_invoice_amount]);
// $username='surya_1544874923';
// $this->collect_information_invoices($username,$particular);
// }
// else
// {
//   echo "today is not that date";
// }

// }





function get_tax()
{
 $f_id=$this->session->f_id;
  ##get billing date of seller
 $params=array('f_id'=>$f_id);

 $tax= modules::run('api_call/api_call/call_api',''.api_url().'account/checkGst',$params,'POST');
 $tax=$this->Account_model->select('table_seller_setting',$params,array('tax'));
 
  echo ($tax[0]['tax']);

} 

function test()
{
 $f_id=$this->session->f_id;
 $amount=350;
  $seller_info=$this->seller_info($f_id);
$tax_detail=json_decode($seller_info[0]['tax'],1) ;
// print_r($tax_detail);
$tax_amount=0;
  // $tax_amount=round($amount*0.18);
  for($i=0;$i<count($tax_detail);$i++) {
    // print_r(array_values($tax_detail[$i])[0]);
    // $tax_amount+=$amount+//
     $tax_amounat = $tax_amount + ( $amount  * (array_values($tax_detail[$i])[0])/100)   ;
  }
  $total=$amount+round($tax_amounat);
  print_r($total);
}














/*all function end*/
}
?>	