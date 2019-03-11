<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Category extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Category_model');
	}



	function add_category()
	{
		$f_id=$this->session->f_id;
		$data['title']="add category";
		$data['_view'] = 'add';
		$params=array('f_id'=>$f_id);
		$category=$this->Category_model->select('table_category',$params,array('category_id','name'));
// var_dump($category);die;
		$data['category']=$category;
		$this->load->view('index.php',$data);

	}

	function add()
	{
		$f_id=$this->session->f_id;
		$category_name=strip_tags($this->input->post('name',1));
		$parent_cat_id=strip_tags($this->input->post('category_id'));
		##fetch category id according to f_id
		$params=array('f_id'=>$f_id);
		$category_id=$this->Category_model->fetchCategoryID('table_category',$params);
		$params=array(
			'f_id'=>$f_id,
			'name'=>$category_name,
			'category_id'=>$category_id,
			'parent_cat_id'=>$parent_cat_id,
			'created_at'=>date('Y-m-d H-i-s')
		);
		$this->Category_model->insert('table_category',$params);
		// $get_data=modules::run('api_call/api_call/call_api',''.api_url().'category/addCategory',$params,'POST');
		// var_dump($get_data);	
		$this->session->alerts = array(
			'severity'=> 'success',
			'title'=> 'successfully added'

		);
		if($this->input->get('redirect')==1)
		{
			echo "1";
		}
		else
		{
		redirect('category/add_category');
		}
	}



	function categoryTree($parent_id =0, $sub_mark = ''){
    // $db2=$this->load->database('portal',TRUE);
		$params=array('parent_cat_id'=>$parent_id);
		$get_data=modules::run('api_call/api_call/call_api',''.api_url().'category/fetchCategoryTree',$params,'POST');
		// var_dump($get_data);die;
     // $this->db->select('*');
		for($i=0;$i<count($get_data);$i++)
		{
			echo '<option value="'.$get_data[$i]['id'].'">'.$sub_mark.$get_data[$i]['name'].'</option>';
			$this->categoryTree($get_data[$i]['id'], $sub_mark.'-');
		}




	}
	function call()
	{
		echo '<select name="category">';
		echo  $this->categoryTreeForMembers();

		echo '</select>';
	}

function categoryTreeForMembers($parent_id =0, $sub_mark = ''){
    // $db2=$this->load->database('portal',TRUE);
		// $params=array('group_id'=>$parent_id);
		// $db2=$this->load->database('portal',TRUE);
		$this->db->select('staff.name,staff.id,map_group_member.group_id,map_group_member.member_id,team_group.name as group_name,map_group_member.parent_id');
		$this->db->from('map_group_member');
    	 $this->db->where(array('map_group_member.group_id'=>$parent_id));
		$this->db->join('staff','map_group_member.member_id=staff.id');
		$this->db->join('team_group','map_group_member.group_id=team_group.group_id');
  		 $row=$this->db->get()->result_array();
  		 // var_dump($row);die;
		// $get_data=modules::run('api_call/api_call/call_api',''.api_url().'category/fetchCategoryTree',$params,'POST');
		// var_dump($get_data);die;
     // $this->db->select('*');
		for($i=0;$i<count($row);$i++)
		{
			echo '<option value="'.$row[$i]['group_id'].'">'.$sub_mark.$row[$i]['group_name'].'</option>';
			echo '<option value="'.$row[$i]['member_id'].'">'.$sub_mark.$row[$i]['name'].'</option>';
			// $this->categoryTreeForMembers($row[$i]['id'], $sub_mark.'-');
		}




	}

function frenchise_tree($parent_f_id =0, $sub_mark = '')
{	
	echo '<table class="table table-bordered">';
	$params=array('parent_f_id'=>$parent_f_id);
		$get_data=modules::run('api_call/api_call/call_api',''.api_url().'frenchise/frenchiseTree',$params,'POST');
	
		for($i=0;$i<count($get_data);$i++)
		{
			echo '<tr><td '.$get_data[$i]['id'].'">'.$sub_mark.$get_data[$i]['name'].'</td></tr><br>';
			$this->frenchise_tree($get_data[$i]['id'], $sub_mark.'-');
		}
echo '</table>';
}

function category_list()
{	
	$condition=array('f_id'=>$this->session->f_id);
	$data['category']=$this->Category_model->select('table_category',$condition,array('id','category_id','name'));
	$data['_view'] = 'category_list';
		$this->load->view('index.php',$data);

}
function fetch_category()
{
 $categoryParam = array('f_id'=>$this->session->f_id);
    // $this->load->model('category/Category_model');
    $category = $this->Category_model->select('table_category', $categoryParam, array('category_id', 'name'));
    echo json_encode($category);
    // $data['category'] = $category;
}

}
?>	