<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Frenchise extends MY_Controller
{

 function __construct()
 {
  parent::__construct();
 
}





function add_frenchise()
{
 // $function_name=$this->uri->segment(2);
 // $user_id=8;
 // $authorization_id=$this->session->authorization_id;
 
// $auth=$this->Authentication_model->check_authentication($controller_name,$function_name,$user_id,$authorization_id);
// var_dump($auth);die;
  $data['_view'] = 'add_frenchise';
if($this->session->authorization_id==0)
{

  $this->load->view('sindex',$data);
}
else
{
  $this->load->view('index',$data);
}


}






function add()
{
  $config['upload_path']          = './uploads/frenchise';
  $config['allowed_types']        = 'gif|jpg|png';
  $this->load->library('upload', $config);
  $f_id=$this->session->f_id;
  $name = $this->input->post('f_name');
  
  $email= $this->input->post('email');
  $mobile = $this->input->post('mobile');
  $crn_number = $this->input->post('crn_number');
  $username = $this->input->post('uname');
  $password = $this->input->post('pw');
  $encrypted_password=md5($password);
  $f_type = $this->input->post('f_type');
  $r_percent = $this->input->post('revenue');
  $address = $this->input->post('address');
	$f_id=$this->session->f_id;
 ##check this mobile number crn number exist or not in database
  $mobileParams=array('mobile'=>$mobile,'f_id'=>$f_id);
  $result_mobile_validation= modules::run('api_call/api_call/call_api',''.api_url().'crn/mobileCheck',$mobileParams,'POST');
  try
  {
    if($result_mobile_validation=='')
    {
      throw new Exception("server down", 1);
      log_error("crn/mobilenoCheck error");
      
    }
    if(isset($result_mobile_validation['error']))
    {
      throw new Exception($result_mobile_validation['error'], 1);
    }
  }
  catch(Exception $e)
  {
    die(show_error($e->getMessage()));
  }
 
  if($result_mobile_validation['status']=='success')
  {
    // var_dump($result_mobile_validation);
    $crn_number=$result_mobile_validation['data'][0]['crn_id'];

  }
  else
  {

    $crnParams=array(
      'name'=>$name, 
      'mobile'=>$mobile,
      'location'=>$address,
      // 'city'=>$perCity,
      // 'pincode'=>$perPincode,
      // 'landmark'=>$perLandmark,
      'email'=>$email,
      'f_id'=>$f_id,
      'created_at'=>date('y-m-d H-m-s')


    );
  // var_dump($crnParams);
    $get_data=modules::run('api_call/api_call/call_api',''.api_url().'crn/addCrn',$crnParams,'POST');
    if($get_data['status']=='success')
    {
      $crn_number=$get_data['last_inserted_id'];
    }
  }
  $params=array(
    'name'=>$name,
    'email'=>$email,
    'mobile'=>$mobile,
    'frenchise_type'=>$f_type,
    'revenue_percent'=>$r_percent,
    'created_at'=>date('y-m-d:H-m-s'), 
    'parent_f_id'=>$f_id,
    'address'=>$address,
    'crn_number'=>$crn_number

  );
  if($this->upload->do_upload('logo'))
  {
    $data['image'] =  $this->upload->data();
    $image_path=$data['image']['raw_name'].$data['image']['file_ext'];
    $params['logo']=$image_path;
  }
  if($this->upload->do_upload('profile_pic'))
  {
    $data['images'] =  $this->upload->data();
    $image_path=$data['images']['raw_name'].$data['images']['file_ext'];
    $params['profile_pic']=$image_path;
    $staffParams['profile_image']=$image_path;
  }

##add frenchise
  $insert_data=modules::run('api_call/api_call/call_api',''.api_url().'frenchise/addFrenchise',$params,'POST');
    if($insert_data['status']=='success')
  {

    $frenchise_id=$insert_data['last_inserted_id'];
##adding in staff list
  $staffParams=array(
    'name'=>$name,
    'email'=>$email,
    'mobile'=>$mobile,
    'created_at'=>date('Y-m-d H:i:s'),
    'f_id'=>$frenchise_id

  );

  $staff_data=modules::run('api_call/api_call/call_api',''.api_url().'staff/addStaff',$staffParams,'POST');
  if($staff_data['status']=='success')
  {
    $staff_id=$staff_data['last_inserted_id'];
  }

  

    #generate username and password
     $password= $frenchise_id.rand(1,100).rand(1,9000);
    $encrypted_password=md5($password);
    $username= $frenchise_id.'_'.time();
  ##add credential of frenchise
    $f_credential=array(

      'username'=>$username,
      'password'=>$encrypted_password,
      'clear_text'=>$password,
      'crn_number'=>$crn_number,
      'f_id'=>$frenchise_id,
      'staff_id'=>$staff_id,
      'authorization_id'=>1,
      'api_key'=>123


    );
    $insert_credential=modules::run('api_call/api_call/call_api',''.api_url().'crn/insertUserCredential', $f_credential,'POST');
    ##send sms to frenchise
    $smsParam=array(
      'mobile'=>$mobile,
      'username'=>$username,
      'password'=>$password,
      'f_id'=>$f_id,
      'module'=>'user credential',
);
    $sms=modules::run('sms/sms/send_sms_notification',$smsParam,'POST');
    ##send email to frenchise
     $emailParam=array(
      'email'=>$email,
      'username'=>$username,
      'password'=>$password,
      'f_id'=>$f_id,
      'module'=>'user credential',
);
     $email=modules::run('email/email/send_email_notification',$emailParam,'POST');
    ##insert blank value in frenchise setting table becaz it is used in update time when frenchise used his panel
    $frenchiseSettingParams=array(
      'isp_license'=>'',
      'bank_account'=>'',
      'billing_cycle'=>'',
     
      'terms'=>'',
      'customer_care'=>'',
      'f_id'=>$frenchise_id

    );
    $insert_frenchise_setting_blank=modules::run('api_call/api_call/call_api',''.api_url().'frenchise/insertFrenchiseSetting',$frenchiseSettingParams,'POST');
    /*--*/

     ##insert frenchise id in tax table
    $frenchiseTaxDetailsParams=array('f_id'=>$frenchise_id,'tax'=>'[]');
    $insert_frenchise_setting_blank=modules::run('api_call/api_call/call_api',''.api_url().'frenchise/insertFrenchiseSettingTax',$frenchiseTaxDetailsParams,'POST');
    /*---*/
    
    $this->session->alerts = array(
      'severity'=> 'success',
      'title'=> 'successfully added'
    );
    redirect('frenchise/frenchise_list');

  }
  else 
  {
    // $data['error']="TOPUP ADDED FAILED";
    // $data['_view'] = 'add_task';
    // $this->load->view('index',$data);
  }


}
function frenchise_list()
{
  $data['title']='frenchise list';
  $f_id=$this->session->f_id;
  $params=array('parent_f_id'=>$f_id);
  $frenchise_list=modules::run('api_call/api_call/call_api',''.api_url().'frenchise/listFrenchise',$params,'POST');
  // var_dump($frenchise_list);
  try
  {
    if($frenchise_list=="")
    {
      throw new Exception("server down", 1);
      log_error("frenchise/listFrenchise");
      
    }
    if(isset($frenchise_list['error']))
    {
      throw new Exception($frenchise_list['error'], 1);
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
  if($frenchise_list['status']=='success')
  {
    $data['frenchise']=$frenchise_list['data'];
  }
  else if($frenchise_list['status']=='not found')
  {
    $data['frenchise']=[];
  }
// var_dump($data['frenchise']);die;
   // var_dump($frenchise_list);
  $data['_view'] = 'frenchise_list';
  $this->load->view('index',$data);
  // $this->output->enable_profiler(TRUE);

}


function other_frenchise_session()
{
  $frenchise_id=$this->uri->segment('3');
  $paramsFrenchise=array(
    'id'=>$frenchise_id
  );
  $frenchise_credential=modules::run('api_call/api_call/call_api',''.api_url().'frenchise/listFrenchiseSession',$paramsFrenchise,'POST');

// var_dump($frenchise_credential);die;
// var_dump($credential);
  $username=$frenchise_credential[0]['username'];
  $password=$frenchise_credential[0]['password'];
  $api_key=$this->session->api_key=$frenchise_credential['data'][0]['api_key'];
  $username=$this->session->username=$frenchise_credential['data'][0]['username'];

  $authorization_id=$this->session->authorization_id=$frenchise_credential['data'][0]['authorization_id'];
  $f_id=$this->session->f_id=$frenchise_credential['data'][0]['id'];
  redirect('admin/dashboard');


}


// function delete()
// {
//   $member_id=$this->input->post('member_id');
//   $paramsFrenchise=array('id'=>$member_id);
//   $frenchise_credential=modules::run('api_call/api_call/call_api',''.api_url().'frenchise/frenchiseDelete',$paramsFrenchise,'POST');



// }
function edit($id)
{
  $params=array('id'=>$id);
  $frenchise_credential=modules::run('api_call/api_call/call_api',''.api_url().'frenchise/listFrenchiseSession',$params,'POST');
  if($frenchise_credential['status']=='success')
  {
    $data['frenchise']=$frenchise_credential['data'];
  }
  // print_r($data['frenchise']);die;
  $data['_view'] = 'edit';
  $this->load->view('index',$data);

}
function update($id)
{
  $config['upload_path']          = './uploads/frenchise';
  $config['allowed_types']        = 'gif|jpg|png';
  $this->load->library('upload', $config);
  $f_id=$this->session->f_id;
  $name = $this->input->post('f_name');
  
  $email= $this->input->post('email');
  $mobile = $this->input->post('mobile');
  $crn_number = $this->input->post('crn_number');
  // $username = $this->input->post('uname');
  // $password = $this->input->post('pw');
  // $encrypted_password=md5($password);
  $f_type = $this->input->post('f_type');
  $r_percent = $this->input->post('revenue');
  $address = $this->input->post('address');

 ##check this mobile number crn number exist or not in database
  $mobileParams=array('mobile'=>$mobile);
  $result_mobile_validation= modules::run('api_call/api_call/call_api',''.api_url().'crn/mobilenoCheck',$mobileParams,'POST');
  // if($result_mobile_validation['status']=='success')
  // {
  //   // var_dump($result_mobile_validation);
  //   $crn_number=$result_mobile_validation['data'][0]['crn_id'];

  // }
  // else
  // {

  //   $crnParams=array(
  //     'name'=>$name, 
  //     'mobile'=>$mobile,
  //     'location'=>$address,
  //     // 'city'=>$perCity,
  //     // 'pincode'=>$perPincode,
  //     // 'landmark'=>$perLandmark,
  //     'email'=>$email,
  //     'f_id'=>$f_id,
  //     'created_at'=>date('y-m-d:h-m-s')


  //   );
  // var_dump($crnParams);
  //   $get_data=modules::run('api_call/api_call/call_api',''.api_url().'crn/addCrn',$crnParams,'POST');
  //   if($get_data['status']=='success')
  //   {
  //     $crn_number=$get_data['last_inserted_id'];
  //   }
  // }
  $params=array(
    'id'=>$id,
    'name'=>$name,
    'email'=>$email,
    'mobile'=>$mobile,
    // 'frenchise_type'=>$f_type,
    // 'revenue_percent'=>$r_percent,
    
    
    'address'=>$address
    // 'crn_number'=>$crn_number

  );
  if($this->upload->do_upload('logo'))
  {
    $data['image'] =  $this->upload->data();
    $image_path=$data['image']['raw_name'].$data['image']['file_ext'];
    $params['logo']=$image_path;
  }
  if($this->upload->do_upload('profile_pic'))
  {
    $data['images'] =  $this->upload->data();
    $image_path=$data['images']['raw_name'].$data['images']['file_ext'];
    $params['profile_pic']=$image_path;
  }
  $result_mobile_validation= modules::run('api_call/api_call/call_api',''.api_url().'frenchise/updateFrenchiseDetails',$params,'POST');
  // var_dump($params); 
  // var_dump($params['profile_pic']);die;
##add frenchise
  
  
  $this->session->alerts = array(
    'severity'=> 'success',
    'title'=> 'successfully edit'
  );
  redirect('frenchise/frenchise_list');

}







/*all function end*/
}
?>	