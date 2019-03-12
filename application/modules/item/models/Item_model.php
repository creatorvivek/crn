<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



class Item_model extends MY_Model{
    function __construct(){
        parent::__construct();
    }


function stock_list($table_name,$condition,$content_display)
{


    $this->db->select($content_display);
    $this->db->from($this->$table_name);
    if(!is_null($condition))
      $this->db->where($condition);
  	$this->db->join($this->table_staff,''.$this->$table_name.'.created_by='.$this->table_staff.'.id');
    $data= $this->db->get()->result_array();
    if($data){
      
    return $data;
    }
    return array();		
    // return json_encode($returnData);
  }



  function search($table_name,$condition,$content_display,$search)
  {
     $this->db->select($content_display);



    $this->db->from($this->$table_name);  
 
    $this->db->where($condition);
  
    $this->db->group_start();
    $this->db->where("item.item_name like '%$search%' ");
               // $this->db->or_where("crn.name like '%search_query%' ");
               $this->db->or_where("item.serial_no like '%$search%' ");
            
        $this->db->group_end();
  
    $data=$this->db->get()->result_array();
    $sql = $this->db->last_query();
    return $data;
  }
   function get_max_order_no($table_name,$params)
  {
   
   $this->db->select_max('order_id');
   $this->db->from($this->$table_name);
   $this->db->where($params);       
   $id = $this->db->get()->row_array();
      // return json_encode($id);
   if(is_null($id['order_id']))
   {
   // $id=1;
     return '';
   }
   else
   {
     $id= ++$id['order_id'];
     $returnData= array('status'=>'success','data'=>$id,'status_code'=>200) ;
   }
   return $id;
 }

 function select_payment_details($table_name,$condition,$content_display)
 {
   $this->db->select($content_display);
    $this->db->from($table_name);
    if(!is_null($condition))
      $this->db->where($condition);
    $this->db->join($this->table_invoices,''.$table_name.'.invoice_id='.$this->table_invoices.'.invoice_id');
    // $this->db->join($this->table_item,''.$this->$table_name.'.item_id='.$this->table_item.'.id');
    $data= $this->db->get()->row_array();
    if($data){
      
    return $data;
    }
    return array();   
 }



 ##purchase list with multiple joining of table

function purchase_list($table_name,$condition,$content_display)
{
  $this->db->select($content_display);
    $this->db->from($this->$table_name);
    if(!is_null($condition))
      $this->db->where($condition);
    $this->db->join($this->table_item,''.$this->$table_name.'.item_id='.$this->table_item.'.id');
    $this->db->join($this->table_vendor,''.$this->$table_name.'.vendor_id='.$this->table_vendor.'.id');
    $this->db->join($this->table_staff,''.$this->$table_name.'.created_by='.$this->table_staff.'.id');

    // $this->db->join($this->table_item,''.$this->$table_name.'.item_id='.$this->table_item.'.id');
    $data= $this->db->get()->result_array();
    if($data){
      
    return $data;
    }
    return array();   
 }
##used in ajax
function fetch_item_details($table_name,$condition,$content_display)
{
 $this->db->select($content_display);
    $this->db->from($this->$table_name);
    if(!is_null($condition))
      $this->db->where($condition);
    $this->db->join($this->table_item,''.$this->$table_name.'.item_id='.$this->table_item.'.id');
    $this->db->join($this->table_vendor,''.$this->$table_name.'.vendor_id='.$this->table_vendor.'.id');
    // $this->db->join($this->table_staff,''.$this->$table_name.'.created_by='.$this->table_staff.'.id');

    // $this->db->join($this->table_item,''.$this->$table_name.'.item_id='.$this->table_item.'.id');
    $data= $this->db->get()->result_array();
    if($data){
      
    return $data;
    }
    return array();   
}
##end of class
}