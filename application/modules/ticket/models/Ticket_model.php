<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



class Ticket_model extends MY_Model{
    function __construct(){
        parent::__construct();
    }



// function fetch_tickets($table_name,$condition=null,$content_display,$in_condition=null)
// {
  
  
//   $this->db->select($content_display);
//   $this->db->from($this->$table_name);
//   if(!is_null($condition))
//    $this->db->where($condition);

//  $this->db->join('staff','staff.id=ticket.created_by','left');
//  $data=$this->db->get()->result_array();


//   return $data;

// }


function getLastTicketId($table_name,$condition)
  {
  	
    $this->db->select("ticket_id");
    $this->db->from($this->$table_name);
    if(!is_null($condition))
      $this->db->where($condition);
    $data= $this->db->get()->last_row('array');

   //  if($data){
   //    return ++$data['ticket_id'] ;
   //  }
   //  if($data=='')
   //  {
   //   return 00000001 ;
   // }
   if($data){
      return json_encode(array('status'=>'success','data'=>$data,'status_code'=>200,'ticket_id'=>++$data['ticket_id']) );
    }
    elseif($data=='')
    {
     return json_encode(array('status'=>'initiate','data'=>00000001,'status_code'=>200,'comment'=>'initiate') );
   }
}

function log_by_ticket_number($table_name,$condition,$selected_contents)
{
  
  $this->db->select($selected_contents);
  $this->db->from($this->$table_name);
  $this->db->where($condition);
  $this->db->join('ticket','ticket.ticket_id=log_ticket.ticket_id and ticket.f_id=log_ticket.f_id');
  $this->db->join('staff','staff.id=log_ticket.created_by','left');
  $data=$this->db->get()->result_array();
  // if($data){
   
  //    $returnData=array('status'=>'success','data'=>$data,'status_code'=>200) ;
  // }

 
    return $data;
  


}

function fetch_tickets($table_name,$condition,$content_display,$interval_unit='',$table_row='ticket.created_at')
{


    $this->db->select($content_display);
    $this->db->from($this->$table_name);
    if(!is_null($condition))
      $this->db->where($condition);
    $this->db->join('staff','staff.id=ticket.created_by','left');
    // $this->db->join($this->table_item,''.$this->$table_name.'.item_id='.$this->table_item.'.id');
     if($interval_unit)
     $this->db->where(" (".$table_row.") BETWEEN DATE_SUB( CURDATE( ),".$interval_unit." ) AND CURDATE()");
    $data= $this->db->get()->result_array();
    if($data){
      
    return $data;
    }
    return array();   
    // return json_encode($returnData);
  }
   function  fetch_tickets_current($table_name,$condition,$display_contents,$interval_unit='',$table_row='ticket.created_at',$start_date='',$end_date='')
    {
 
  $this->db->select($display_contents);
 $this->db->from($this->$table_name);
 if(!is_null($condition))
 $this->db->where($condition);
 // if(!empty($start_date) && !empty($end_date))
  $this->db->join('staff','staff.id=ticket.created_by','left');
 if($interval_unit)
  $this->db->where(" date(".$table_row.") BETWEEN  DATE_FORMAT( CURDATE(),'".$interval_unit."') AND CURDATE()");

$data=$this->db->get()->result_array();
return $data;

}



}
 // $this->db->where(" DATE(".$table_row.") BETWEEN DATE_FORMAT( CURDATE( ),".$interval_unit." ) AND CURDATE( )");