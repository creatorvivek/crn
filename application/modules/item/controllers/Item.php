<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Item extends MY_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('Item_model');
  }





  function add_item()
  {
    $f_id = $this->session->f_id;
    $data['title'] = 'ADD ITEM';

    $params = array('f_id' => $f_id);
    $this->load->model('category/Category_model');
    $category = $this->Category_model->select('table_category', $params, array('category_id', 'name'));
// var_dump($category);die;
    $data['category'] = $category;
    $data['heading'] = 'ADD ITEM';
    $data['_view'] = 'add_item';
    $this->load->view('index', $data);
  }
        function add_purchase()
        {
        $f_id = $this->session->f_id;

         $data['title'] = 'ADD PURCHASE';
            $params = array('f_id' => $f_id);
            $this->load->model('category/Category_model');
            $data['vendor'] = $this->Item_model->select('table_vendor', $params, array('id', 'name'));
            $data['item'] = $this->Item_model->select('table_item', $params, array('id','item_name'));
        // var_dump($category);die;
            // $data['category'] = $category;
            $data['heading'] = 'ADD PURCHASE';
            $data['_view'] = 'add_purchase';
            $this->load->view('index', $data);

        }
  function item_list()
  {

    /*future use*/
    $data['title'] = 'ITEM LIST';
    $f_id = $this->session->f_id;
    $staff_id = $this->session->staff_id;
    $params = array('item_list.f_id' => $f_id);
    $itemList = $this->Item_model->stock_list('table_item', $params, array('item_list.id', 'item_name', 'description', 'item_list.created_by', 'item_list.created_at', 'category', 'staff.name as staff_name','snp'));
    // print_r($itemList);die;
   // echo '<pre>';
    $categoryParam = array('f_id' => $f_id);
    $this->load->model('category/Category_model');
    $category = $this->Category_model->select('table_category', $categoryParam, array('category_id', 'name'));
    $data['category'] = $category;
  // $this->output->enable_profiler(TRUE);
   // die;
    $data['heading'] = 'ITEM LIST';
    $data['item'] = $itemList;
    $data['_view'] = 'item_list';
    $this->load->view('index', $data);


  }

  function add_more_qty($id)
  {   
    // $item_id= $this->input->post('item_id', 1); 
   $qty =   strip_tags($this->input->post('newqty', 1));
   $purchase_price = strip_tags($this->input->post('purchase_amount', 1));
   $total=$qty*$purchase_price;
   $condition = array('id' => $id,'f_id'=>$this->session->f_id);
      ##fetch item detail by item id
   $item = $this->Item_model->select('table_item', $condition, array('id', 'total_purchase_price','quantity'));
   if($item)
   {
    $total_purchase_price=$item[0]['total_purchase_price'];
    $quantity=$item[0]['quantity'];
    $newQuantity=$qty+$quantity;
    $newTotalPurchasePrice=$total_purchase_price+$total;
    $paramsItem=array('total_purchase_price'=>$newTotalPurchasePrice,'quantity'=>$newQuantity);
    $result=$this->Item_model->update_col('table_item',$condition,$paramsItem);
    if($result)
    {
     $this->session->alerts = array(
      'severity' => 'success',
      'title' => 'successfully quantity adjusted'
    );
   }
   redirect('item/item_list');


 }



}
function add_more_item($id)
{ 
  $data['id']=$id;
  $condition=array('id'=>$id,'f_id'=>$this->session->f_id);
  $item = $this->Item_model->select('table_item', $condition, array('id', 'purchase_price','quantity'));
    // print_r($item);
  if($item[0])
  {
    $data['quantity']=$item[0]['quantity'];
    $data['purchase_price']=$item[0]['purchase_price'];
  }
  else
  {
    $data['quantity']='';
    $data['purchase_price']='';
  }
    // print_r($data);
  $data['_view'] = 'add_qty';
  $this->load->view('index', $data);
}
## item add

function add_purchase_process()
{
  $r=$this->input->post();
  // print_r($r);die;
  $f_id = $this->session->f_id;
  $staff_id = $this->session->staff_id;

  $item_id = strip_tags($this->input->post('item_id', 1));
  $vendor_invoice = strip_tags($this->input->post('vendor_invoice', 1));
  $vendor_id = strip_tags($this->input->post('vendor_id', 1));
  $selling_price = strip_tags($this->input->post('selling_amount', 1));
  $purchase_price = strip_tags($this->input->post('purchase_amount', 1));
  // $item_category = strip_tags($this->input->post('category_id', 1));

  $model_number =   $this->input->post('model_number');
  $serial_number =  $this->input->post('serial_number');
  $company_name =   strip_tags($this->input->post('company_name', 1));
  $unit =         strip_tags($this->input->post('unit', 1));
  $qty =         strip_tags($this->input->post('qty', 1));
  $total_amount =         strip_tags($this->input->post('total_amount', 1));

  $this->load->library('form_validation');
  // $this->form_validation->set_rules('name', 'Item Name', 'required|trim');
  // $this->form_validation->set_rules('description', 'description', 'required|trim');

  $this->form_validation->set_rules('selling_amount', 'selling price', 'required');
 // print_r($this->input->post());die;
  if ($this->form_validation->run()) {


    $itemParams = array(

      'item_id' => $item_id,
      // 'description' => $description,
      // 'category' => $item_category,
// 'quantity'=>$quantity,
      'selling_price' => $selling_price,
      'purchase_price' => $purchase_price,
      'f_id' => $f_id,
      'unit'=>$unit,
      'quantity'=>$qty,
      'quantity_for_sale'=>$qty,
      'vendor_id'=>$vendor_id,
      'vendor_invoice_no'=>$vendor_invoice,
// 'f_id'=>$f_id,
      'total_purchase_price'=> $total_amount,
      'item_company' => $company_name,

      'created_at' => date('Y-m-d H-i-s'),
      'created_by' => $staff_id

    );
    $insertItem = $this->Item_model->insert('table_purchase', $itemParams);

      ##insert serial and model no


    for($i=0;$i<$qty;$i++)
    {
      $insertItemDetailsParams=array(
        'item_id'=>$insertItem,
        'serial_no' => @$serial_number[$i],
        'model_no' => @$model_number[$i] 

      );
      $insertItemDetails = $this->Item_model->insert('table_item_details',$insertItemDetailsParams);
         // print_r($insertItem);

    }


    if ($insertItem) {
      $this->session->alerts = array(
        'severity' => 'success',
        'title' => 'successfully added'
      );
      redirect('item/purchase_list');

    } else {
      $data['error'] = "item not added";
      $data['_view'] = 'add_item';
      $this->load->view('index', $data);
    }

  }
}

function add_item_process()
{

 $f_id = $this->session->f_id;
 $staff_id = $this->session->staff_id;

 $item_name = strip_tags($this->input->post('name', 1));
 $description = strip_tags($this->input->post('description', 1));
 $item_category = strip_tags($this->input->post('category_id', 1));
 $snp = strip_tags($this->input->post('snp', 1));
 $this->load->library('form_validation');
 $this->form_validation->set_rules('name', 'Item Name', 'required|trim');
 $this->form_validation->set_rules('description', 'description', 'required|trim');

 // $this->form_validation->set_rules('snp', 'snp number', 'required');
 // print_r($this->input->post());die;
 if ($this->form_validation->run()) {


  $itemParams = array(

    'item_name' =>$item_name,
    'description' => $description,
    'category' => $item_category,

    'f_id' => $f_id,
    'snp'=>$snp,

    'created_at' => date('Y-m-d H-i-s'),
    'created_by' => $staff_id

  );
  $insertItem = $this->Item_model->insert('table_item', $itemParams);
  if ($insertItem) {
      $this->session->alerts = array(
        'severity' => 'success',
        'title' => 'successfully added'
      );
      redirect('item/item_list');
}


}
}
function purchase_list()
{
  $data['title'] = 'PURCHASE LIST';
  $f_id = $this->session->f_id;
  if($this->input->get('id'))
  {
    $item_id=$this->input->get('id');
    $condition = array('purchase_item.f_id' => $f_id,'item_id'=>$item_id);
  }
  else
  { 
$condition = array('purchase_item.f_id' => $f_id);
   } 
 $categoryParam = array('f_id' => $f_id);
    $category = $this->Item_model->select('table_category', $categoryParam, array('category_id', 'name'));
    $data['category'] = $category;
$data['purchase']=$this->Item_model->purchase_list('table_purchase',$condition,array('purchase_item.id','purchase_item.selling_price','purchase_item.purchase_price','purchase_item.quantity','purchase_item.quantity_out','purchase_item.item_company','purchase_item.quantity_for_sale','purchase_item.unit','purchase_item.created_at','staff.name as staff_name','vendor.name as vendor_name','item_list.item_name','item_list.category'));

// echo '<pre>';
// print_r($data['purchase']);
$data['_view'] = 'purchase_list';
      $this->load->view('index', $data);


  
}
function fetch_amount()
{
  $item_id = $this->input->post('item_id');
  $params = array('purchase_item.id' => $item_id);
  $item = $this->Item_model->fetch_item_details('table_purchase', $params, array('purchase_item.id', 'selling_price', 'item_name','quantity','unit'));
   // print_r($item);
  echo json_encode($item[0]);



}

function fetch_item()
{
  $f_id = $this->session->f_id;
  $params = array('f_id' => $f_id, 'quantity>=' => 1);
  $item = $this->Item_model->select('table_item', $params, array('id', 'item_name', 'description', 'selling_price', 'purchase_price', 'model_no', 'serial_no', 'created_by', 'created_at','quantity_for_sale'));
  echo json_encode($item);
}


function edit_item($id)
{
  $data['title'] = "EDIT ITEM";
  $data['heading'] = "EDIT ITEM";
  $f_id = $this->session->f_id;
 // $f_id=$this->input->post('f_id');
  $condition = array('id' => $id, 'f_id' => $f_id);
  $this->load->model('category/Category_model');
  $catParams = array('f_id' => $f_id);
  $category = $this->Category_model->select('table_category', $catParams, array('category_id', 'name'));
  // var_dump($category);
  $data['category'] = $category;
  $data['item'] = $this->Item_model->select('table_purchase', $condition, array('id', 'selling_price', 'purchase_price', 'model_no', 'serial_no', 'purchase_item.created_by', 'purchase_item.created_at', 'item_company','quantity','unit'));
  // print_r($data['item']);die;




  if (isset($data['item'][0]['id'])) {
    $this->load->library('form_validation');

    $this->form_validation->set_rules('selling_amount', 'Selling Amount', 'required');
    // $this->form_validation->set_rules('email','Email','max_length[50]|valid_email');

    // $this->form_validation->set_rules('paddress','Permanent Address','required');
    // $this->form_validation->set_rules('taddress','Temporary Address','required');

    if ($this->form_validation->run()) {

      $staff_id = $this->session->staff_id;

      // $item_name = strip_tags($this->input->post('name', 1));
      // $description = strip_tags($this->input->post('description', 1));
      $selling_price = strip_tags($this->input->post('selling_amount', 1));
      $purchase_price = strip_tags($this->input->post('purchase_amount', 1));
      $item_category = strip_tags($this->input->post('category_id', 1));

      // $model_number = strip_tags($this->input->post('model_number', 1));
      // $serial_number = strip_tags($this->input->post('serial_number', 1));
      $company_name = strip_tags($this->input->post('company_name', 1));
      $unit =         strip_tags($this->input->post('unit', 1));
      // $qty =         strip_tags($this->input->post('qty', 1));
      $itemParams = array(
        // 'item_name' => $item_name,
        // 'description' => $description,
        // 'category' => $item_category,
        // 'quantity'=>$qty,
        'unit'=>$unit,
        'selling_price' => $selling_price,
        'purchase_price' => $purchase_price,
        // 'f_id' => $f_id,
// 'f_id'=>$f_id,
        'item_company' => $company_name,
        // 'serial_no' => $serial_number,
        // 'model_no' => $model_number,
    // 'created_at'=>date('Y-m-d H-i-s'),
    // 'created_by'=>$staff_id

      );
// var_dump($params);die;

      $this->Item_model->update_col('table_purchase',$condition,$itemParams);



      $this->session->alerts = array(
        'severity' => 'success',
        'title' => 'successfully updated'
      );
      redirect('item/item_list');
    } else {
      $data['_view'] = 'edit_item';
      $this->load->view('index', $data);
    }
  } else
  show_error('The item you are trying to edit does not exist.');
}

function saled_item_list()
{
 /*future use*/
 $data['title'] = 'ITEM LIST';
 $f_id = $this->session->f_id;
 $staff_id = $this->session->staff_id;
 $params = array('item.f_id' => $f_id, 'status' => 0);
 $itemList = $this->Item_model->stock_list('table_item', $params, array('item.id', 'item_name', 'description', 'selling_price', 'purchase_price', 'model_no', 'serial_no', 'item.created_by', 'item.created_at', 'category', 'staff.name as staff_name'));
    // print_r($itemList);die;
   // echo '<pre>';
 $categoryParam = array('f_id' => $f_id);
 $this->load->model('category/Category_model');
 $category = $this->Category_model->select('table_category', $categoryParam, array('category_id', 'name'));
 $data['category'] = $category;
  // $this->output->enable_profiler(TRUE);
   // die;
 $data['heading'] = 'SAILED ITEM LIST';
 $data['item'] = $itemList;
 $data['_view'] = 'saled_item_list';
 $this->load->view('index', $data);
}
function search()
{
  $search = $this->input->post('search'); 
 // $search=$this->uri->segment(3);
  $condition = array('f_id' => $this->session->f_id);
  $data = array();
  $data['status_no'] = 0;
  $data['message'] = 'No Item Found!';
  $data['items'] = array();
  $item = $this->Item_model->search('table_item', $condition, array('id', 'item_name'), $search);
  // print_r($items);

  $i = 0;
  if ($item) {
    $data['status_no'] = 1;
    $data['message'] = 'Item Found';
  // $items['status_no'] = 1;
  }
  foreach ($item as $key => $value) {

                    // $itemPriceValue = DB::table('sale_prices')->where(['stock_id'=>$value->stock_id,'sales_type_id'=>$request['salesTypeId']])->select('price')->first();
                    // if(!isset($itemPriceValue)){
                    //     $itemSalesPriceValue = 0;
                    // }
                    // else
                    //  {
                    //     $itemSalesPriceValue = $itemPriceValue->price;
                    //  }
    $return_arr[$i]['id'] = $value['id'];
    $return_arr[$i]['item_name'] = $value['item_name'];
                    // $return_arr[$i]['description'] = $value->description;
                    // $return_arr[$i]['units'] = $value->units;
                    // $return_arr[$i]['price'] = $itemSalesPriceValue;
                    // $return_arr[$i]['tax_rate'] = $value->tax_rate;
                    // $return_arr[$i]['tax_id'] = $value->tax_id;
    $i++;
  }
               // echo json_encode($return_arr);
  $data['items'] = $return_arr;

  echo json_encode($data);
  // echo json_encode($items);

}

function sales_order_view($invoice_id)
{
  $f_id = $this->session->f_id;
  $condition = array('invoice_id' => $invoice_id, 'f_id' => $f_id);
  $data['invoice'] = $this->Item_model->select('table_invoices', $condition, array('*'));
  $data['invoice_particular'] = $this->Item_model->select('table_master_invoice', $condition, array('*'));
  $data['payment'] = $this->Item_model->select('table_payment_details', $condition, array('*'));
  $data['payment_type'] = $this->Item_model->select('table_payment_type', array("f_id" => $f_id), array('*'));

// echo '<pre>'; 
  // print_r($data);die;
  $data['_view'] = 'sales_order_view';
  $this->load->view('index', $data);
}
function payment_status()
{
  $f_id = $this->session->f_id;
  $staff_id = $this->session->staff_id;
  $invoice_id = $this->input->post('invoice_id');
  $payment_type = $this->input->post('payment_type');
  $paid = $this->input->post('pay');
  $order_reference = $this->input->post('order_id');
  $customer_id = $this->input->post('customer_id');
  $payment_date = $this->input->post('payment_date');
  $params = array(
    'f_id' => $f_id,
    'invoice_id' => $invoice_id,
    'staff_id' => $staff_id,
    'payment_method' => $payment_type,
    'amount' => $paid,
    'order_reference' => $order_reference,
    'payment_date' => $payment_date,
    'customer_id'=>$customer_id


  );
  $this->Item_model->insert('table_payment_details', $params); 

##update invoice paid column
  $invoiceCondition=array(
    'invoice_id'=>$invoice_id,
    'f_id'=>$f_id
  );
  $invoiceParams=array(
    'paid'=>$paid
  );
  $this->Item_model->update_col('table_invoices',$invoiceCondition,$invoiceParams); 
  $this->load->model('Account/Account_model');
  $this->Account_model->maintain_status_invoice($paid, $f_id, $invoice_id);
  $this->session->alerts = array(
    'severity' => 'success',
    'title' => 'successfully Paid'
  );


  redirect('item/sales_order_view/2');
}


function reciept_view($payment_id)
{
 $f_id = $this->session->f_id;
 $data['_view'] = 'reciept_view';
 $params=array('payment_details.f_id'=>$f_id,'payment_details.id'=>$payment_id);
 $data=$this->Item_model->select_payment_details('table_payment_details',$params,array('payment_details.invoice_id','name','mobile','company_name','f_mobile','f_email','address','f_address','payment_details.amount','payment_date','c_city','c_pincode','payment_method')); 
   // print_r($data);die;
 $data['_view'] = 'reciept_view';
 $this->load->view('index', $data);

}
/*all function end*/
}
?>	