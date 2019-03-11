<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends MX_Controller {
public function __construct() {
        parent::__construct();
        $this->load->helper('url');       
    }
 public function index(){
    $this->load->view('index');
 }
 public function check(){
     
     // all values are required
    $amount =  $this->input->post('payble_amount');
    $product_info = $this->input->post('product_info');
    $customer_name = $this->input->post('customer_name');
    $customer_emial = $this->input->post('customer_email');
    $customer_mobile = $this->input->post('mobile_number');
    $customer_address = $this->input->post('customer_address');
    
    //payumoney details
    
    
        $MERCHANT_KEY = "sBWOAiVv"; //change  merchant with yours
        $SALT = "VDWgaYEGs3";  //change salt with yours 

        $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
        //optional udf values 
        $udf1 = '';
        $udf2 = '';
        $udf3 = '';
        $udf4 = '';
        $udf5 = '';
        
         $hashstring = $MERCHANT_KEY . '|' . $txnid . '|' . $amount . '|' . $product_info . '|' . $customer_name . '|' . $customer_emial . '|' . $udf1 . '|' . $udf2 . '|' . $udf3 . '|' . $udf4 . '|' . $udf5 . '||||||' . $SALT;
         $hash = strtolower(hash('sha512', $hashstring));
         
       $success = base_url() . 'Status';  
        $fail = base_url() . 'Status';
        $cancel = base_url() . 'Status';
        
        
         $data = array(
            'mkey' => $MERCHANT_KEY,
            'tid' => $txnid,
            'hash' => $hash,
            'amount' => $amount,           
            'name' => $customer_name,
            'productinfo' => $product_info,
            'mailid' => $customer_emial,
            'phoneno' => $customer_mobile,
            'address' => $customer_address,
            'action' => "https://test.payu.in", //for live change action  https://secure.payu.in
            'sucess' => $success,
            'failure' => $fail,
            'cancel' => $cancel            
        );
        $this->load->view('confirmation', $data);   
     }
   function generate_hash()
   {
    // $input=$this->input->post('key');
    $data=array(
        'key'=>$this->input->post('key'),
        'salt'=>$this->input->post('salt'),
        'txnid'=>$this->input->post('txnid'),
        'amount'=>$this->input->post('amount'),
        'pinfo'=>$this->input->post('pinfo'),
        'fname'=>$this->input->post('fname'),
        'email'=>$this->input->post('email'),
        'mobile'=>$this->input->post('mobile'),
        'udf5'=>$this->input->post('udf5')
);   // $data = json_decode(file_get_contents('php://input'));
   //  // $data = json_decode($input);
            $hash=hash('sha512', $data['key'].'|'.$data['txnid'].'|'.$data['amount'].'|'.$data['pinfo'].'|'.$data['fname'].'|'.$data['email'].'|||||'.$data['udf5'].'||||||'.$data['salt']);
        $json=array();
        // $string = str_replace('"',' ', $hash); 
        // $json['success'] = $hash;
        // echo json_encode($string);
        echo trim('76c190c74ab9f0f749e3002f70f8c09a2c9df27d5c88df71351445676c54013d1bebb2cfd085dd55dd11053a7cd9f910600114135428459b71872dfd448ee40a','');
   }
     function response_payment()
   {
    $data['key']                =   $this->input->post('key');
    $data['salt']               =   $this->input->post('salt');
    $data['txnid']              =   $this->input->post('txnid');
    $data['amount']             =   $this->input->post('amount');
    $data['productInfo']        =   $this->input->post('productinfo');
    $data['firstname']          =   $this->input->post('firstname');
    $data['email']              =   $this->input->post('email');
    $data['udf5']               =   $this->input->post('udf5');
    $data['mihpayid']           =   $this->input->post('mihpayid');
    $data['status']             =   $this->input->post('status');
    $data['resphash']               =   $this->input->post('hash');
    print_r($data);
    // die;
     $this->load->view('response',$data);
   }
    
   }
