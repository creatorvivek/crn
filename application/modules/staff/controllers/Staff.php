<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Staff extends MY_Controller
{

 function __construct()
 {
  parent::__construct();
  $this->load->model('Staff_model');

}





function add_staff()
{
  // $f_id=$this->session->f_id;
  // $params=array('f_id'=>$f_id);
  // $get_data=modules::run('api_call/api_call/call_api',''.api_url().'group/groupList',$params,'POST');
  // try
  // {
  //   if($get_data=='')
  //   {
  //     throw new Exception("server down", 1);
  //     log_error("group/groupList function error");
      
  //   }
  //   if(isset($get_data['error']))
  //   {
  //     throw new Exception($get_data['error'], 1);
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
  // if($get_data['status']=='success')
  // {

  //   $data['group']=$get_data['data'];

  // }
  $heading=strtoupper(isset($this->session->menu_staff)?$this->session->menu_staff:'STAFF' );
   $data['heading']=$heading;
  $data['title']='ADD '. $heading;
  $data['_view'] = 'add_staff';
  $this->load->view('index',$data);
}



##add staff process
function add()
{
  $name = strip_tags($this->input->post('name',1));
   // $name=strip_tags($this->security->xss_clean($this->input->post('name')));
  $email = strip_tags($this->input->post('email',1));
  $mobile = strip_tags($this->input->post('mobile',1));
  // $groupId = $this->input->post('group');
  $gender = strip_tags($this->input->post('gender',1));
  // $username = $this->input->post('username');
  // $password = $this->input->post('password');
  // $encrtyted_password=md5($password);
 $this->load->library('form_validation');
  
  $this->form_validation->set_rules('name','Name','required|trim|alpha_numeric_spaces');

  $this->form_validation->set_rules('email','Email','required|valid_email|trim');
  $this->form_validation->set_rules('gender','Gender','required');
  

  $this->form_validation->set_rules('mobile','Mobile number','required|exact_length[10]|numeric');
  if($this->form_validation->run() )     
  {  
  $f_id=$this->session->f_id;
// if()
  // print_r($f_id);die;
  $params=array(
    'name'=>$name,
    'email'=>$email,
    'mobile'=>$mobile,
    'created_at'=>date('Y-m-d H:i:s'),
    'f_id'=>$f_id,
    'gender'=>$gender

  );
// print_r($params);die;
$addStaff=$this->Staff_model->insert('table_staff',$params);

// echo $addStaff;
  // $get_data=modules::run('api_call/api_call/call_api',''.api_url().'staff/addStaff',$params,'POST');
  // if($get_data['status']=='success')
  // {
  //   if(!$groupId[0]=='')
  //   {
  //     foreach ($groupId as $row) {
  //       $mapping=array(
  //         'group_id'=>$row,
  //         'member_id'=>$get_data['last_inserted_id']

  //       );
  //       $mapInfo = modules::run('api_call/api_call/call_api',''.api_url().'group/addMappingToStaff',$mapping,'POST');
  //       if($mapInfo['status']=='success')
  //       {
  //         $this->session->alerts = array(
  //           'severity'=> 'success',
  //           'title'=> 'successfully added'

  //         );
  //       }
  //     }
  //   }
    #add staff credential
    

    $password=rand(1,10000).rand(1,9000);
    $encrepted_password=md5($password);
    $username=$f_id.'_'.rand(1,10000);
    

    $credentialParams=array(
      'username'=>$username,
      'password'=>$encrepted_password,
      'clear_text'=>$password,
      'f_id'=>$f_id,
      'staff_id'=>$addStaff,

      'authorization_id'=>3
      // 'api_key'=>123
    );


##send username and password in credential table
    $resultPortalLogin=$this->Staff_model->insert('table_login',$credentialParams);
    ##send sms to user
  /*  $smsParam=array(
      'mobile'=>$mobile,
      'username'=>$username,
      'password'=>$password,
      // 'f_id'=>$f_id,
      'module'=>'user credential',
);
    $sms=modules::run('sms/sms/send_sms_notification',$smsParam,'POST');
     ##send email to frenchise
     $emailParam=array(
      'email'=>$email,
      'username'=>$username,
      'password'=>$password,
      // 'f_id'=>$f_id,
      'module'=>'user credential',
);
     $email=modules::run('email/email/send_email_notification',$emailParam,'POST');*/
    $this->session->alerts = array(
      'severity'=> 'success',
      'title'=> 'successfully added'

    );
    redirect('staff/staff_list');

}
else
{
   $heading=strtoupper(isset($this->session->menu_staff)?$this->session->menu_staff:'STAFF' );
   $data['heading']=$heading;
  $data['title']='ADD '. $heading;
   $data['_view'] = 'add_staff';

  $this->load->view('index.php',$data);
}


}

function staff_list()
{
  $f_id=$this->session->f_id;
  $condition=array('f_id'=>$f_id);
  $heading=strtoupper(isset($this->session->menu_staff)?$this->session->menu_staff:'STAFF' );

   $data['heading']=$heading;
  $data['title']=$heading.' LIST';
 $staffData= $this->Staff_model->select('table_staff',$condition,array('id','name','email','mobile','gender','created_at'));
//  echo '<pre>';
// print_r($staffData);die;
 if($staffData)
 {
  $data['staff']=$staffData;
 }

 else
 {
  $data['staff']=[];
 }
 $data['_view'] = 'staffList';
 $this->load->view('index',$data);


}
function edit($id)
{
  
   $heading=strtoupper(isset($this->session->menu_staff)?$this->session->menu_staff:'STAFF' );
   $data['heading']=$heading;
  $params=array('id'=>$id);
  $staff_total =$this->Staff_model->select('table_staff',$params,array('id','name','email','mobile','created_at','gender'));
   // modules::run('api_call/api_call/call_api',''.api_url().'staff/fetchstaff',$params,'POST');
 // print_r($staff_total);
  if($staff_total)
  {
  $data['staff']=$staff_total[0];
  $data['_view'] = 'edit';
  $this->load->view('index',$data);
    
  }
  else
  {
    show_error('this id is not exist');
  }
  // var_dump($staff['data']);

}
function update($id)
{
 $name = $this->input->post('name',1);
 $email = $this->input->post('email',1);
 $mobile = $this->input->post('mobile',1);
 $gender = $this->input->post('gender',1);
  // $groupId = $this->input->post('group');
  //  $username = $this->input->post('username');
  // $password = $this->input->post('password');
  // $encrtyted_password=md5($password);

 $f_id=$this->session->f_id;
// if()
 $params=array(
  
  'name'=>$name,
  'email'=>$email,
  'mobile'=>$mobile,
  'gender'=>$gender
    // 'created_at'=>date('Y-m-d H:i:s'),
    // 'f_id'=>$f_id

);
 $condition=array('id'=>$id);
$this->Staff_model->update($condition,'table_staff',$params);
 // $get_data=modules::run('api_call/api_call/call_api',''.api_url().'staff/updateStaff',$params,'POST');
 //  try
 //    {
 //      if($get_data=='')
 //      {
 //        throw new Exception("server down", 1);
 //        log_error("group/groupList function error");

 //      }
 //      if(isset($get_data['error']))
 //      {
 //        throw new Exception($get_data['error'], 1);
 //      }
 //    }
 //    catch(Exception $e)
 //    {
 //      die(show_error($e->getMessage()));
 //    }
 //    catch(Exception $e)
 //    {
 //      die(show_error($e->getMessage()));
 //    }

 $this->session->alerts = array(
  'severity'=> 'success',
  'title'=> 'updated'

);
 redirect('staff/staff_list');

}


function remove($id)
{
  // $member_id=$this->input->post('member_id');
  $condition=array('id'=>$id);
  
  $this->Staff_model->delete('table_staff',$condition);

  if($deleteInfo['status']=='success')
  {
    echo "success";
  }
  else
  {
    echo $deleteInfo['error'];
  }


}




/*all function end*/
}
?>	