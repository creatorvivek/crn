<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Test extends MX_Controller
{

 function __construct()
 {
  parent::__construct();
}

function tree()
{

$this->db->select('*');
$this->db->from('frenchise');
$row=$this->db->get()->result_array();
// var_dump($row);
for($i=0;$i<count($row);$i++)
{
 $sub_data["id"] = $row[$i]["id"];
 $sub_data["name"] = $row[$i]["name"];
 $sub_data["text"] = $row[$i]["name"];
 $sub_data["email"] = $row[$i]["email"];
 $sub_data["parent_f_id"] = $row[$i]["parent_f_id"];
 $data[] = $sub_data;
}
foreach($data as $key => &$value)
{
 $output[$value["id"]] = &$value;
}
foreach($data as $key => &$value)
{
 if($value["parent_f_id"] && isset($output[$value["parent_f_id"]]))
 {
  $output[$value["parent_f_id"]]["nodes"][] = &$value;
 }
}
foreach($data as $key => $value)
{
 if($value["email"] && isset($output[$value["parent_f_id"]]))
 {
  $output[$value["email"]]["nodes"][] = $value;
 }
}
foreach($data as $key => &$value)
{
 if($value["parent_f_id"] && isset($output[$value["parent_f_id"]]))
 {
  unset($data[$key]);
 }
}
echo json_encode($data);
// echo '<pre>';
// print_r($data);
// echo '</pre>';








}


function tree_view()
{

   // $data['_view'] = 'add_staff';

   $this->session->alerts = array(
      'severity' => 'success',
      'title' => 'successfully added'
    );
    redirect('sales/sales_list');
}


function capcha_form()
{
// $this->load->helper('captcha');
// $vals = array(
//         // 'word'          => 'Random word',
//         'img_path'      => './captcha/',
//         'img_url'       => base_url('captcha'),
//         // 'font_path'     => './path/to/fonts/texb.ttf',
//         // 'img_width'     => '150',
//         // 'img_height'    => 30,
//         'expiration'    => 7200,
//         'word_length'   => 4,
//         // 'font_size'     => 19,
//         // 'img_id'        => 'Imageid',
//         'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',

//         // White background and border, black text and red grid
//         'colors'        => array(
//                 'background' =>array(255, 255, 255) ,
//                 'border' => array(0, 0, 0),
//                 'text' => array(0, 0, 0),
//                 'grid' => array(255, 40, 40)
//         )
// );

// $data['cap'] = create_captcha($vals);
$data['_view'] = 'capchatest';
  $this->load->view('index',$data);
// print_r($data['cap']);

}

function profiling()
{
  $this->output->enable_profiler(TRUE);
}
function time()
{
$r=date('Y/m/d',strtotime("-1 days"));
echo $r;

}

function check()
{
$f=$this->frenchise_info(12);
if($f['status']=='success')
{
  print_r($f['data']);
}
}


private function frenchise_info($f_id)

{
  $params=array('f_id'=>$f_id);
  return modules::run('api_call/api_call/call_api',''.api_url().'account/checkGst',$params,'POST');
}
function demo()
{
  // $data['_view'] = 'add_staff';
  // $this->load->view('index',$data);
   echo date('h:i a', strtotime('11-3-2019 11-22-33'));
  // $this->load->view('add_staff');
}
function form()
{
   $this->load->model('Test_model');
   $params = array('item_list.f_id' =>14);
    $data['item'] = $this->Test_model->select('table_item',$params, array('*'));
$data['_view'] = 'form';
  $this->load->view('index',$data);
 
}


function datatable()
{
//   $this->load->library('parser');
//   $data = array(
//         'blog_title' => 'My Blog Title',
//         'blog_heading' => 'My Blog Heading'
// );

  $data['_view'] = 'dtable';
// $this->parser->parse('index', $data);
  $this->load->view('index',$data);
}

 public function ajax_list()
    {
      $this->load->model('Test_model');
        $list = $this->Test_model->get_datatables('table');
        // print_r($list);
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $customers) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $customers->name;
         
            $row[] = $customers->mobile;
            // $row[] = $customers->address;
            // $row[] = $customers->city;
            // $row[] = $customers->country;
 
            $data[] = $row;
        }
         $draw = intval($this->input->get("draw"));
          $start = intval($this->input->get("start"));
          $length = intval($this->input->get("length"));
        $output = array(
                        "draw" => @$_POST['draw'],
                        "recordsTotal" => $this->Test_model->count_all('table'),
                        "recordsFiltered" => $this->Test_model->count_filtered('table'),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
    function d2()
    {
      $this->load->model('Test_model');
         $draw = intval($this->input->get("draw"));
          $start = intval($this->input->get("start"));
          $length = intval($this->input->get("length"));


          $books = $this->Test_model->select('table_crn',array('f_id'=>1),array('*'));

          $data = array();

          foreach($books as $r) {

               $data[] = array(
                    $r['name'],
                    $r['mobile'],
                     $r['id'],
                    // $r->author,
                    // $r->rating . "/10 Stars",
                    // $r->publisher
               );
          }

          $output = array(
               "draw" => $draw,
                 "recordsTotal" => 7,
                 "recordsFiltered" => 7,
                 "data" => $data
            );
          echo json_encode($output);
    }
    function profiler()
    {

      $this->output->enable_profiler(true);
    }
/*all function end*/
}
?>	