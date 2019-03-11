<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Task extends MY_Controller
{

 function __construct()
 {
  parent::__construct();
}





function add_task()
{
  $f_id=$this->session->f_id;
  $staff_params=array(
    'f_id'=>$f_id
  );
  $staff_info = modules::run('api_call/api_call/call_api',''.api_url().'staff/fetchstaff',$staff_params,'POST');
  try
    {
      if($staff_info=='')
      {
        throw new Exception("server down", 1);
        log_error("account/getInvoiceData function error");

      }
      if(isset($staff_info['error']))
      {
        throw new Exception($staff_info['error'], 1);
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
  if($staff_info['status']=='success')
  {

    $data['staff']=$staff_info['data'];
    
  }

  $data['_view'] = 'add_task';
  $this->load->view('index',$data);
}

function task_list()
{
  
  /*future use*/
  $f_id=$this->session->f_id;
  $staff_id=$this->session->staff_id;
  $params=array('assign'=>$staff_id,'f_id'=>$f_id);
  $get_data=modules::run('api_call/api_call/call_api',''.api_url().'task/fetchtask',$params,'POST');
   try
    {
      if($get_data=='')
      {
        throw new Exception("server down", 1);
        log_error("account/getInvoiceData function error");

      }
      if(isset($get_data['error']))
      {
        throw new Exception($get_data['error'], 1);
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
  if($get_data['status']=='success')
  {
    $data['task']=$get_data['data'];
    $data['_view'] = 'taskList';
    $this->load->view('index',$data);
    
  }
  elseif($get_data['status']=='not found')
  {
    $data['task']=[];
    $data['_view'] = 'taskList';
    $this->load->view('index',$data);
  }


}




function add()
{
  $f_id=$this->session->f_id;
  $ticket_id = $this->input->post('ticket',true);
  
  $task = $this->input->post('task');
  $assign = $this->input->post('assign');
  // $f_id=$this->session->f_id;

  $params=array(
    'ticket_id'=>$ticket_id,
    'task'=>$task,
    'assign'=>$assign,
    'created_by'=>'admin', /*hardcoded this data will come by session*/
    'f_id'=>$f_id

  );
// print_r($params);die;
  $get_data=modules::run('api_call/api_call/call_api',''.api_url().'task/addtask',$params,'POST');
   try
    {
      if($get_data=='')
      {
        throw new Exception("server down", 1);
        log_error("task/addtask function error");

      }
      if(isset($get_data['error']))
      {
        throw new Exception($get_data['error'], 1);
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
  if($get_data['status']=='success')
  {
    $this->session->alerts = array(
      'severity'=> 'success',
      'title'=> 'successfully added'
    );
    redirect('task/add_task');
    
  }
  else
  {
    $data['error']="TASK ADDED FAILED";
    $data['_view'] = 'add_task';
    $this->load->view('index',$data);
  }


}






/*all function end*/
}
?>	