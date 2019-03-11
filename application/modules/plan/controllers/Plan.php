<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Plan extends MY_Controller
{

 function __construct()
 {
  parent::__construct();
}





function add_plan()
{
  $data['title']='Add Plan';
  $f_id=$this->session->f_id;
  // $staff_params=array(
  //   'f_id'=>$f_id
  // );
  // $staff_info = modules::run('api_call/api_call/call_api',''.api_url().'staff/fetchstaff',$staff_params,'POST');
  // if($staff_info['status']=='success')
  // {

  //   $data['staff']=$staff_info['data'];

  // }
  $params=array('f_id'=>'');
  $result=modules::run('api_call/api_call/call_api',''.api_url().'plan/planTypeMaster',0,'GET');
  // var_dump($result);die;
  if($result['status']=='success')
  {
    $data['plan_type']=$result['data'];
  }
  else
  {
   $data['plan_type']=[];
 }
 $data['_view'] = 'add_plan2';
 $this->load->view('index',$data);
}

function plan_list()
{

  $f_id=$this->session->f_id;
 ##plan_category 1 for primary plan
  $params=array('frenchise_id'=>$f_id,'plan_category'=>1);
  $get_plan_list=modules::run('api_call/api_call/call_api',''.api_url().'plan/planList',$params,'POST');
  try
    {
      if($get_plan_list=='')
      {
        throw new Exception("server down", 1);
        log_error("plan/planList function error");
        
      }
      if(isset($get_plan_list['error']))
      {
        throw new Exception($get_plan_list['error'], 1);
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
  // echo '<pre>';
  // var_dump($get_plan_list);die;
  if($get_plan_list['status']=='success')
  {
    $data['plan_lists']=$get_plan_list['data'];

  }
  else if($get_plan_list['status']=='not found')
  {
   $data['plan_lists']=[];
 }
 


$data['_view'] = 'plan_list';
$this->load->view('index',$data);
}


function secondry_plan_list()
{
  $plan_id=$this->uri->segment(3);
  $params=array('id'=>50);
  $get_secondry_plan_list=modules::run('api_call/api_call/call_api',''.api_url().'plan/secondryPlanList',$params,'POST');
  // echo '<pre>';
  print_r($get_secondry_plan_list);



}

function delete_plan()
{
  $plan_id=$this->input->post('plan_id');
  $params=array('plan_id'=>$plan_id,'id'=>$plan_id);
 // echo json_encode($params);die;
  $result=modules::run('api_call/api_call/call_api',''.api_url().'plan/deletePlan',$params,'POST');
 // echo '<pre>';
  echo json_encode($result);



}

function add()
{
  // echo '<pre>';
  // echo json_encode($this->input->post());die;
  $f_id=$this->session->f_id;
  $planName = $this->input->post('plan_name');
  $planDescription = $this->input->post('plan_description');
  
  $planTypes= $this->input->post('plan_type');
  /*convert plan type to csv*/
  $planType=implode(",",$planTypes);
  /*end */

  $planStatus= $this->input->post('plan_status');
  $uploadSpeed = $this->input->post('upload_speed');
  $downloadSpeed = $this->input->post('download_speed');
  $transferSpeed = $this->input->post('transfer_speed');
  
  $downloadData = $this->input->post('download_data');
  $uploadData = $this->input->post('upload_data');
  $dataTransfer = $this->input->post('data_transfer');
  $burstLimit = $this->input->post('burst_mode');
  $data_unit = $this->input->post('data_unit');
  $speed_unit = $this->input->post('speed_unit');
  $priority = $this->input->post('priority');
  $vacation_mode = $this->input->post('vacation_mode');

  $validity = $this->input->post('validity');
  $validity_unit = $this->input->post('validity_unit');

  $amount = $this->input->post('amount');



  /*time limit*/

  $start_hour = $this->input->post('start_hour');
  $start_minute = $this->input->post('start_minute');
  $end_hour = $this->input->post('end_hour');
  $end_minute = $this->input->post('end_minute');
  $sunday = $this->input->post('sunday');
  $monday = $this->input->post('monday');
  $tuesday = $this->input->post('tuesday');
  $wednesday = $this->input->post('wednesday');
  $thrusday = $this->input->post('thrusday');
  $friday = $this->input->post('friday');
  $saturday = $this->input->post('saturday');
  $burst_mode=$this->input->post('burst_mode');
  $status=$this->input->post('status');
  if($burst_mode=='disable')
  {
    $burst_limit=0;
    $burst_priority=8;
    $burst_time=12;
    $burst_threshold=0;
    $upload_speed_kb=0;
    $download_speed_kb=0;
    $transfer_speed_kb=0;

  }
  if($burst_mode=='custom')
  {
   $burst_threshold_ul = $this->input->post('burst_threshold_ul');
   $burst_threshold_dl = $this->input->post('burst_threshold_dl');
   $burst_time_dl = $this->input->post('burst_time_dl');
   $burst_time_ul = $this->input->post('burst_time_ul');
   $burst_limit_ul = $this->input->post('burst_limit_ul');
   $burst_limit_dl = $this->input->post('burst_limit_dl');
   $burst_priority = $this->input->post('burst_priority');
 }

 
 $last_inserted_id=0;/*for last plan no expiration condition*/
 $length=count($data_unit);
 for($i=$length-1;$i>=0;$i--)
 {
  switch($data_unit[$i])
  {
##kb
    case 1:

    $upload_data_mb=$uploadData[$i]/1024;
    $download_data_mb=$downloadData[$i]/1024;
    $data_transfer_mb=$dataTransfer[$i]/1024;
    break;
  ##mb
    case 2:
    $upload_data_mb=$uploadData[$i];
    $download_data_mb=$downloadData[$i];
    $data_transfer_mb=$dataTransfer[$i];
    break;
   ## gb
    case 3:

    $upload_data_mb=$uploadData[$i]*1024;
    $download_data_mb=$downloadData[$i]*1024;
    $data_transfer_mb=$dataTransfer[$i]*1024;
    break;


  }

  switch($speed_unit[$i]) {
    /*gb*/
    case 3:
    $upload_speed_kb=$uploadSpeed[$i]*1024*1024;
    $download_speed_kb=$downloadSpeed[$i]*1024*1024;
    $transfer_speed_kb=$transferSpeed[$i]*1024*1024;
    if($burst_mode="double")
    {
     $upload_burst_speed_kb=$uploadSpeed[$i]*1024*1024*2;
     $download_burst_speed_kb=$downloadSpeed[$i]*1024*1024*2;
     $transfer_burst_speed_kb=$transferSpeed[$i]*1024*1024*2;
   }
   break;
   case 2:
   /*mb*/
   $upload_speed_kb=$uploadSpeed[$i]*1024;
   $download_speed_kb=$downloadSpeed[$i]*1024;
   $transfer_speed_kb=$transferSpeed[$i]*1024;
   if($burst_mode="double")
   {
     $upload_burst_speed_kb=$uploadSpeed[$i]*1024*2;
     $download_burst_speed_kb=$downloadSpeed[$i]*1024*2;
     $transfer_burst_speed_kb=$transferSpeed[$i]*1024*2;
   }
   break;
##kb
   case 1:
   $upload_speed_kb=$uploadSpeed[$i];
   $download_speed_kb=$downloadSpeed[$i];
   $transfer_speed_kb=$transferSpeed[$i];
   if($burst_mode="double")
   {
     $upload_burst_speed_kb=$uploadSpeed[$i]*2;
     $download_burst_speed_kb=$downloadSpeed[$i]*2;
     $transfer_burst_speed_kb=$transferSpeed[$i]*2;
   }
   break;
 }
##used to identify which plan is primary and which plan is secondry
 if($i==0)
 {
  $plan_category=1;
}
else
{
  $plan_category=0;
}
//##
$planParams=array(
  'name'=>$planName,
  'description'=>$planDescription,
  'plan_type'=>$planType,
  'upload_speed'=>$upload_speed_kb,
  'download_speed'=> $download_speed_kb,
  'transfer_speed'=>$transfer_speed_kb,
  'download_data_limit'=>$download_data_mb,
  'upload_data_limit'=>$upload_data_mb,
  'data_transfer_limit'=>$data_transfer_mb,
  'priority'=>$priority,
  'vacation_mode'=>$vacation_mode,
  'after_expire'=>$last_inserted_id,
  'burst_time'=>$burst_time,
  'burst_limit'=>$burst_limit,
  'burst_threshold'=>$burst_threshold,
  'burst_priority'=>$burst_priority,
  'status'=>$status,
  'plan_category'=>$plan_category,
  'data_unit'=>$data_unit[$i],
  'speed_unit'=>$speed_unit[$i]

);

$insert_plan_details = modules::run('api_call/api_call/call_api',''.api_url().'plan/addPlan',$planParams,'POST');
if($insert_plan_details['status']=='success')
{
// echo json_encode($planParams);
  $last_inserted_id=$insert_plan_details['last_inserted_id'];
  $planDayLimitParam=array(
    'plan_id'=> $last_inserted_id,
    'sunday'=>$sunday[$i],
    'monday'=>$monday[$i],
    'tuesday'=>$tuesday[$i],
    'wednesday'=>$wednesday[$i],
    'thrusday'=>$thrusday[$i],
    'friday'=>$friday[$i],
    'saturday'=>$saturday[$i]
  );
  if(!($start_hour[$i] && $start_minute[$i])){  $start_time=0 ; }else{  $start_time=$start_hour[$i].':'.$start_minute[$i];   }
  if(!($end_hour[$i] && $end_minute[$i])){  $end_time=0 ; }else{  $end_time=$end_hour[$i].':'.$end_minute[$i];   }
  $planTimeLimitParam=array(
    'start_time'=>$start_time,
    'end_time'=>$end_time,
    'plan_id'=>$last_inserted_id
  );
      ##map frenchise and plan
  $mapFrenchisePlan=array(
    'frenchise_id'=>$f_id,
    'plan_id'=>$last_inserted_id
  );
    // echo json_encode($mapFrenchisePlan);
  $insert_map_frenchise_plan=modules::run('api_call/api_call/call_api',''.api_url().'plan/mapFrenchisePlan',$mapFrenchisePlan,'POST');
    // echo json_encode($insert_map_frenchise_plan);
  $insert_plan_time_limit_details = modules::run('api_call/api_call/call_api',''.api_url().'plan/addPlanTimeLimit',$planTimeLimitParam,'POST');
  $insert_plan_day_limit_details = modules::run('api_call/api_call/call_api',''.api_url().'plan/addPlanDayLimit',$planDayLimitParam,'POST');
    // echo json_encode($insert_plan_time_limit_details);
}
}
// die; 
$lengthValidity=count($validity);
for($j=0;$j<$lengthValidity;$j++)
{
  switch($validity_unit[$j])
  {
    /*1=days*/
    case 1:
    $validity_in_sec=$validity[$j]*86400;
    $validity_actual=$validity[$j];
    break;
    /*2=week*/
    case 2:
    $validity_in_sec=$validity[$j]*604800;
    $validity_actual=$validity[$j]*7;
    break;
    /*3=month*/
    case 3:
    $validity_in_sec=$validity[$j]*2592000;
    ##not perfect
    $validity_actual=$validity[$j]*30;
    break;
    /*year 365 days*/
    $validity_in_sec=$validity[$j]*31536000;
    $validity_actual=$validity[$j]*365;
  }


  $validityPriceParams=array(
    'plan_id'=>$last_inserted_id,
    'validity'=>$validity_in_sec,
    'amount'=>$amount[$j],
    'validity_type'=>$validity_unit[$j],
    'validity_actual'=>$validity_actual


  );
  $insert_plan_validity_details = modules::run('api_call/api_call/call_api',''.api_url().'plan/planAmountValidity',$validityPriceParams,'POST');
  echo json_encode($insert_plan_validity_details);
  $this->session->alerts = array(
    'severity'=> 'success',
    'title'=> 'successfully plan added'

  );



} 







}



function edit($plan_id)
{


  $data['title']="Edit plan details";
  $params=array('id'=>$plan_id);
  $amountParams=array('plan_id'=>$plan_id);

    ##details of plan 
  $data['plan'] = modules::run('api_call/api_call/call_api',''.api_url().'plan/getPlanById',$params,'POST');
  $data['secondry'] = modules::run('api_call/api_call/call_api',''.api_url().'plan/secondry',$params,'POST');
  // var_dump($data['secondry']);die;



    // var_dump($data['plan']['data'][0]['plan_id']);die;
  // if($data['plan']['data'][0]['after_expire']!=0)
  // {
  //     $paramsSecondry=array('id'=>$data['plan']['data'][0]['after_expire']);
  // $data['s_plans'] = modules::run('api_call/api_call/call_api',''.api_url().'plan/secondryPlanList',$paramsSecondry,'POST');
  // }
  /*for amount and validity*/
  $data['amount'] = modules::run('api_call/api_call/call_api',''.api_url().'plan/getValidityAmountByPlanId',$amountParams,'POST');



  if(isset($data['plan']['data'][0]['plan_id']))
  {
    $this->load->library('form_validation');


    $this->form_validation->set_rules('plan_name','Name','required');
    if($this->form_validation->run() )     
    {   
      $planName = $this->input->post('plan_name');
      $planDescription = $this->input->post('plan_description');

      $planTypes= $this->input->post('plan_type');
      /*convert plan type to csv*/
      $planType=implode(",",$planTypes);
      /*end */

      $planStatus= $this->input->post('plan_status');
      $uploadSpeed = $this->input->post('upload_speed');
      $downloadSpeed = $this->input->post('download_speed');
      $transferSpeed = $this->input->post('transfer_speed');

      $downloadData = $this->input->post('download_data');
      $uploadData = $this->input->post('upload_data');
      $dataTransfer = $this->input->post('data_transfer');
      $burstLimit = $this->input->post('burst_mode');
      $data_unit = $this->input->post('data_unit');
      $speed_unit = $this->input->post('speed_unit');
      $priority = $this->input->post('priority');
      $vacation_mode = $this->input->post('vacation_mode');

      $validity = $this->input->post('validity');
      $validity_unit = $this->input->post('validity_unit');

      $amount = $this->input->post('amount');
      $after_expire = $this->input->post('after_expire');

      /*time limit*/

      $start_hour = $this->input->post('start_hour');
      $start_minute = $this->input->post('start_minute');
      $end_hour = $this->input->post('end_hour');
      $end_minute = $this->input->post('end_minute');
      $sunday = $this->input->post('sunday');
      $monday = $this->input->post('monday');
      $tuesday = $this->input->post('tuesday');
      $wednesday = $this->input->post('wednesday');
      $thrusday = $this->input->post('thrusday');
      $friday = $this->input->post('friday');
      $saturday = $this->input->post('saturday');
      $burst_mode=$this->input->post('burst_mode');
      if($burst_mode=='disable')
      {
        $burst_limit=0;
        $burst_priority=8;
        $burst_time=12;
        $burst_threshold=0;
        $upload_speed_kb=0;
        $download_speed_kb=0;
        $transfer_speed_kb=0;

      }
      if($burst_mode=='custom')
      {
       $burst_threshold = $this->input->post('burst_threshold');
       $burst_time = $this->input->post('burst_time');
       $burst_limit = $this->input->post('burst_limit');
       $burst_priority = $this->input->post('burst_priority');
     }



     $length=count($data_unit);
     for($i=$length-1;$i>=0;$i--)
     {
      if($data_unit[$i]=='kb')
      {
        $upload_data_mb=$uploadData[$i]/1024;
        $download_data_mb=$downloadData[$i]/1024;
        $data_transfer_mb=$dataTransfer[$i]/1024;
      }
      else if($data_unit[$i]=='gb')
      {
        $upload_data_mb=$uploadData[$i]*1024;
        $download_data_mb=$downloadData[$i]*1024;
        $data_transfer_mb=$dataTransfer[$i]*1024;
      }
      else
      {
       $upload_data_mb=$uploadData[$i];
       $download_data_mb=$downloadData[$i];
       $data_transfer_mb=$dataTransfer[$i];
     }
     switch($speed_unit[$i]) {
      /*gb*/
      case 3:
      $upload_speed_kb=$uploadSpeed[$i]*1024*1024;
      $download_speed_kb=$downloadSpeed[$i]*1024*1024;
      $transfer_speed_kb=$transferSpeed[$i]*1024*1024;
      if($burst_mode="double")
      {
       $upload_burst_speed_kb=$uploadSpeed[$i]*1024*1024*2;
       $download_burst_speed_kb=$downloadSpeed[$i]*1024*1024*2;
       $transfer_burst_speed_kb=$transferSpeed[$i]*1024*1024*2;
     }
     break;
     case 2:
     /*mb*/
     $upload_speed_kb=$uploadSpeed[$i]*1024;
     $download_speed_kb=$downloadSpeed[$i]*1024;
     $transfer_speed_kb=$transferSpeed[$i]*1024;
     if($burst_mode="double")
     {
       $upload_burst_speed_kb=$uploadSpeed[$i]*1024*2;
       $download_burst_speed_kb=$downloadSpeed[$i]*1024*2;
       $transfer_burst_speed_kb=$transferSpeed[$i]*1024*2;
     }
     break;

     default:
     $upload_speed_kb=$uploadSpeed[$i];
     $download_speed_kb=$downloadSpeed[$i];
     $transfer_speed_kb=$transferSpeed[$i];
     if($burst_mode="double")
     {
       $upload_burst_speed_kb=$uploadSpeed[$i]*2;
       $download_burst_speed_kb=$downloadSpeed[$i]*2;
       $transfer_burst_speed_kb=$transferSpeed[$i]*2;
     }
   }
   $planParams=array(
    'name'=>$planName,
    'description'=>$planDescription,
    'plan_type'=>$planType,
    'upload_speed'=>$upload_speed_kb,
    'download_speed'=> $download_speed_kb,
    'transfer_speed'=>$transfer_speed_kb,
    'download_data_limit'=>$download_data_mb,
    'upload_data_limit'=>$upload_data_mb,
    'data_transfer_limit'=>$data_transfer_mb,
    'priority'=>$priority,
    'vacation_mode'=>$vacation_mode,
    'after_expire'=>$after_expire,
    'burst_time'=>$burst_time,
    'burst_limit'=>$burst_limit,
    'burst_threshold'=>$burst_threshold,
    'burst_priority'=>$burst_priority,
     'plan_category'=>$plan_category,
  'data_unit'=>$data_unit[$i],
   'speed_unit'=>$speed_unit[$i],
    'plan_id'=>$data['plan']['data'][0]['plan_id']

  );
 // echo json_encode($planParams);die;
        // var_dump($data['customer']['data'][0]['username']);die;
   $update_data = modules::run('api_call/api_call/call_api',''.api_url().'plan/updatePlan',$planParams,'POST');
   echo json_encode($update_data);
      // var_dump($update_data);die;
 }

##send username and password in credential table
 ##if username is avilable so in edit username update but if username is null so new row created in authentiction table    

 $this->session->alerts = array(
  'severity'=> 'success',
  'title'=> 'succesfully updated'

);
     // redirect('plan/plan_list');

}






else
{
  $data['_view'] = 'edit';
  $this->load->view('index',$data);
}
}
else
  show_error('The group you are trying to edit does not exist.');

}

##  ajax call by caf module when plan type is selected (prepaid,postaid) then accoriding to this plan is shown in dropdown
function selectPlan()
{
 $f_id=$this->session->f_id;
 $plan_type=$this->input->post('plan_type');
 $params=array(
  'plan_type'=>$plan_type,
  'f_id'=>$f_id
);
 $result=modules::run('api_call/api_call/call_api',''.api_url().'plan/selectPlan',$params,'POST');
  try
    {
      if($result=='')
      {
        throw new Exception("server down", 1);
        log_error("plan/selectPlan function error");
        
      }
      if(isset($result['error']))
      {
        throw new Exception($result['error'], 1);
      }
    }
   
    catch(Exception $e)
    {
      die(show_error($e->getMessage()));
    }
 if($result['status']=='success')
 {
  echo json_encode($result['data']);
}

else
{
  $result['data']=[];
  echo json_encode($result['data']);
}


}

function assign_plan($caf_id)
{
  $data['_view'] = 'assign_plan';
  $this->load->view('index',$data);
}



function selectPlanType()
{
  $f_id=$this->input->post('f_id');
   $params=array(
  
  'f_id'=>$f_id
);

 $result=modules::run('api_call/api_call/call_api',''.api_url().'plan/planTypeMaster',0,'GET');
 if($result['status']=='success')
 {
  echo json_encode($result['data']);
 }


}
## recharge panel search plan
function searchPlan()
{
  // $query=$this->input->post('search_query');
   $f_id=$this->session->f_id;
  $search_query=$this->input->post('search_query',1);
  $params=array('query'=>$search_query,
    'f_id'=>$f_id
  );
  $data=modules::run('api_call/api_call/call_api',''.api_url().'plan/autoSuggetionsInPlan',$params,'POST');
  if($data['status']=='success')
  {
    echo json_encode($data['data']);
  }
  else
  {
    echo json_encode([]);
  }
}



function get_plan_end_date()
{
  
}




/*all function end*/
}
?>	