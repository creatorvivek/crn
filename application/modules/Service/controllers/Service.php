<?php


class Service extends MY_Controller{
	function __construct()
	{
		parent::__construct();

			$this->load->model('Service_model');

	} 

function add_service()
{
$data['heading']="SERVICE";
$data['title']="ADD SERVICE";
$data['_view'] = 'add_service';
$this->load->view('index',$data);

}


function add()
{

	$service_name = strip_tags($this->input->post('service_name', 1));
    $duration = strip_tags($this->input->post('validity', 1));
    $discription = strip_tags($this->input->post('discription', 1));
    $duration_unit = strip_tags($this->input->post('validity_unit', 1));
    $amount = strip_tags($this->input->post('amount', 1));
    $f_id=$this->session->f_id;
    $serviceParams=array(
    	'service_name'=>$service_name,
    	'validity'=>$duration,
    	'validity_unit'=>$duration_unit,
    	'f_id'=>$f_id,
    	'description'=>$discription,
    	'amount'=>$amount,
        'created_at'=>date('Y-m-d H-i-s')

    );
    $this->Service_model->insert('table_services',$serviceParams);
    $this->session->alerts = array(
      'severity'=> 'success',
      'title'=> 'successfully added'

    );
    redirect('service/service_list');

    // $item_id = $this->input->post('item_id', 1);
}
function service_list()
{
$data['header']="SERVICE";
$data['title']="SERVICE LIST";
 $f_id=$this->session->f_id;
$condition=array('f_id'=>$f_id);
$data['service']=$this->Service_model->select('table_services',$condition,array('*'));
$data['_view'] = 'service_list';
$this->load->view('index',$data);

}


function service_edit($id)
{   
    $data['heading']="SERVICE";
$data['title']="SERVICE EDIT";
    $condition=array('f_id'=>$this->session->f_id,'id'=>$id);    
    $data['service']=$this->Service_model->select('table_services',$condition,array('*'));
    if(isset($data['service'][0]))
    {
    
    // print_r($data['service']);
    $data['_view'] = 'edit';
    $this->load->view('index',$data);
}
else
{
    show_error("This id is not exists");
}
}
function service_update($id)
{

    $service_name = strip_tags($this->input->post('service_name', 1));
    $duration = strip_tags($this->input->post('validity', 1));
    $discription = strip_tags($this->input->post('discription', 1));
    $duration_unit = strip_tags($this->input->post('validity_unit', 1));
    $amount = strip_tags($this->input->post('amount', 1));
    $f_id=$this->session->f_id;
    $serviceParams=array(
        'service_name'=>$service_name,
        'validity'=>$duration,
        'validity_unit'=>$duration_unit,
       
        'description'=>$discription,
        'amount'=>$amount

    );
    $condition=array('f_id'=>$f_id,'id'=>$id);
    $this->Service_model->update_col('table_services',$condition,$serviceParams);
    $this->session->alerts = array(
      'severity'=> 'success',
      'title'=> 'successfully updated'

    );
    redirect('service/service_list');
}

function fetch_service()
  {
    $service_id=$this->input->post('service_id',1);
    $f_id = $this->session->f_id;
    $params = array('f_id' => $f_id,'id'=>$service_id);
    $service = $this->Service_model->select('table_services', $params, array('id','service_name','amount','validity','validity_unit'));
    echo json_encode($service[0]);
  }






}
?>