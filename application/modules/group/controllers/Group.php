<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Group extends MY_Controller
{


	function __construct()
	{
		parent::__construct();
		$this->load->model('Group_model');

	}


	function add_group()
	{
		$f_id=$this->session->f_id;
		$staff_params=array(
			'f_id'=>$f_id
		);
		$staff_info =
		 modules::run('api_call/api_call/call_api',''.api_url().'staff/fetchstaff',$staff_params,'POST');

		try
		{
			if($staff_info=='')
			{
				throw new Exception("server down", 1);
				log_error("group/groupList function error");

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
		else
		{
			$data['staff']=[];
		}

		$data['_view'] = 'add';
		$this->load->view('index',$data);

		// $data['_view'] = 'add';
		// $this->load->view('index',$data);

	}
	function add()
	{
		##generate new group id
		$f_id=$this->session->f_id;
		$params=array(
			'f_id'=>$f_id
		);
		$groupId= modules::run('api_call/api_call/call_api',''.api_url().'group/lastGroupId',$params,'POST');
		try
		{
			if($groupId=='')
			{
				throw new Exception("server down", 1);
				log_error("group/groupList function error");
				
			}
			if(isset($groupId['error']))
			{
				throw new Exception($groupId['error'], 1);
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

		if($groupId['status']=='success')
		{
			$group_id=$groupId['group_id'];
		}
		elseif($groupId['comment']=='initiate')
		{
			$group_id='f'.$this->session->f_id.'_g'.$groupId['data'];
		}
		else
		{
			echo $groupId['error'];
		}

		$params = array(

			'name' => $this->input->post('name'),
			'head_name' => $this->input->post('head'),
			'description' => $this->input->post('description'),
			'frenchizy_detail' => $this->input->post('f_detail'),

			'belong_business' => $this->input->post('business'),
			
			'f_id'=>$f_id,
			'created_at'=>date('d-m-y:h-m-s'),
			'group_id'=>$group_id
		);
		$get_data = modules::run('api_call/api_call/call_api',''.api_url().'group/addGroup',$params,'POST');
		try
		{
			if($get_data=='')
			{
				throw new Exception("server down", 1);
				log_error("group/groupList function error");
				
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
			$id=$group_id;
		}
		#map group and staff
		$memberId=$this->input->post('member');
		// $mapBunch=[];
		foreach ($memberId as $row) {
			$mapping=array(
				'group_id'=>$id,
				'member_id'=>$row
			);
			$mapInfo = modules::run('api_call/api_call/call_api',''.api_url().'group/addMappingToStaff',$mapping,'POST');
			
		}		
		$this->session->alerts = array(
			'severity'=> 'success',
			'title'=> 'succesfully add'

		);
		redirect('group/all_group_list');
	}

	function all_group_list()
	{

		$f_id=$this->session->f_id;
		$params=array(
			'f_id'=>$f_id
		);
		$get_data = modules::run('api_call/api_call/call_api',''.api_url().'group/groupList',$params,'POST');
		try
		{
			if($get_data=='')
			{
				throw new Exception("server down", 1);
				log_error("group/groupList function error");
				
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

			$data['group']=$get_data['data'];
			$data['_view'] = 'groupList';
			$this->load->view('index',$data);
			
		}
		else if($get_data['status']=='not found')
		{
			$data['group']=[];
			$data['_view'] = 'groupList';
			$this->load->view('index',$data);
		}
		

	}
	## details of group are shown
	function group_info()
	{
		$f_id=$this->session->f_id;
		$group_id=$this->input->get('group_id');
		$params=array(
			'group_id'=>$group_id
		);
		$staff_params=array(
			'group_id'=>$group_id
		);
		$staff_list=array(
			'f_id'=>$f_id
		);
		##details of group 
		$get_data = modules::run('api_call/api_call/call_api',''.api_url().'group/groupList',$params,'POST');
		#list of group member
		// var_dump($get_data);
		$staff_info = modules::run('api_call/api_call/call_api',''.api_url().'staff/fetchStaffByGroup',$staff_params,'POST');
		// var_dump($staff_info);
		##fetch total staff of current frenchise to give option in dropdown
		$staff_total = modules::run('api_call/api_call/call_api',''.api_url().'staff/fetchstaff',$staff_list,'POST');
		// var_dump($staff_total);die;
		try
		{
			if($get_data=='' && $staff_info=='' && $staff_total=='')
			{
				throw new Exception("server down", 1);
				log_error(" function error");
				
			}
			if(isset($get_data['error']))
			{
				throw new Exception($deleteInfo['error'], 1);
			}
			if(isset($staff_info['error']))
			{
				throw new Exception($staff_info['error'], 1);
			}
			if(isset($staff_total['error']))
			{
				throw new Exception($staff_total['error'], 1);
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
			if($staff_info['status']=='success' && $staff_total['status']=='success')
			{
				$data['staff']=$staff_info['data'];
				$data['staff_list']=$staff_total['data'];
			}
			else
			{
				$data['staff']=[];
				$data['staff_list']=[];
			}	
			// $data['staff_list']=$staff_total['data'];
			$data['group']=$get_data['data'];
			$data['_view'] = 'groupInfo';
			$this->load->view('index',$data);

		}
		else
		{
			echo $get_data['error'];
		}



	}
	function mapGroupMember()
	{
		#map group and staff
		$memberId=$this->input->post('member');
		$groupId=$this->input->post('group_id');
		// $mapBunch=[];
		foreach ($memberId as $row) {
			$mapping=array(
				'group_id'=>$groupId,
				'member_id'=>$row

			);
			$mapInfo = modules::run('api_call/api_call/call_api',''.api_url().'group/addMappingToStaff',$mapping,'POST');
			if($mapInfo['status']=='success')
			{
				echo json_encode($mapInfo['status']);
			}
			
		}
	}
	function deleteMember()
	{
		$member_id=$this->input->post('member_id');
		$groupId=$this->input->post('group_id');
		$params=array('group_id'=>$groupId,'member_id'=>$member_id);
		$deleteInfo = modules::run('api_call/api_call/call_api',''.api_url().'group/removeMemberFromGroup',$params,'POST');
		if($deleteInfo['status']=='success')
		{
			echo "success";
		}

	}

	function deleteGroup()
	{
		$group_id=$this->input->post('group_id');
		$params=array(
			'group_id'=>$group_id	


		);	
		$deleteInfo = modules::run('api_call/api_call/call_api',''.api_url().'group/deleteGroup',$params,'POST');
		try
		{
			if($deleteInfo=='')
			{
				throw new Exception("server down", 1);
				log_error("group/groupList function error");
				
			}
			if(isset($deleteInfo['error']))
			{
				throw new Exception($deleteInfo['error'], 1);
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
		if($deleteInfo['status']='success')
		{
			$this->session->alerts = array(
				'severity'=> 'success',
				'title'=> 'successfully deleted'

			);
			redirect('group/all_group_list');
		}
		elseif($deleteInfo['status']='failure')
		{

			$this->session->alerts = array(
				'severity'=> 'failure',
				'title'=> 'not deleted'

			);
		}
		else
		{
			echo($deleteInfo['error']);
			
		}

	}
	function my_group()
	{
		$staff_id=$this->session->staff_id;
		$params=array('member_id'=>$staff_id);
		$groupInfo = modules::run('api_call/api_call/call_api',''.api_url().'group/myGroup',$params,'POST');
		try
		{
			if($groupInfo=='')
			{
				throw new Exception("server down", 1);
				log_error("group/groupList function error");
				
			}
			if(isset($groupInfo['error']))
			{
				throw new Exception($groupInfo['error'], 1);
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
		if($groupInfo['status']=='success')
		{
			$data['group']=$groupInfo['data'];
			$data['_view'] = 'groupList';
			$this->load->view('index',$data);
		}
		elseif($groupInfo['status']=='not found')
		{
			$data['group']=[];
			$data['_view'] = 'groupList';
			$this->load->view('index',$data);
		}
		
	}
	

	function edit($id)
	{
		$data['title']="Edit Group";
		$params=array('id'=>$id);
		
		##details of group 
		$data['group'] = modules::run('api_call/api_call/call_api',''.api_url().'group/groupList',$params,'POST');
		// var_dump($get_data['group']['data'][0]['id']);die;
		if(isset($data['group']['data'][0]['id']))
		{
			$this->load->library('form_validation');

			
			$this->form_validation->set_rules('name','Name','required');
			if($this->form_validation->run() )     
			{   
				$updateParams = array(

					'name' => $this->input->post('name'),
					'head_name' => $this->input->post('head'),
					'description' => $this->input->post('description'),
					'frenchizy_detail' => $this->input->post('f_detail'),

					'belong_business' => $this->input->post('business'),

					'f_id'=>1,
					'created_at'=>date('d-m-y:h-m-s'),
					'group_id'=>$data['group']['data'][0]['group_id'],
					'id'=>$data['group']['data'][0]['id']


				);
				// var_dump($updateParams);
				$update_data = modules::run('api_call/api_call/call_api',''.api_url().'group/updateGroup',$updateParams,'POST');

				if($update_data['status']=='success')
				{

					$this->session->alerts = array(
						'severity'=> 'success',
						'title'=> 'successfully edited'
					);
					redirect('group/all_group_list');
				}
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


	function test()
	{	
		$params=(array('ticket.ticket_id'=>1));
		$groupInfo = modules::run('api_call/api_call/call_api',''.api_url().'group/test',$params,'POST');
		var_dump($groupInfo);

	}
}


?>