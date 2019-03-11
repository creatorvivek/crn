<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



class Crn_model extends MY_Model{
    function __construct(){
        parent::__construct();
    }


function search_query($table_name,$condition,$search_query)
{


   // $this->db=$this->load->database('portal',TRUE);
    $this->db->select('id,name,email,mobile,pincode,city,address');



    $this->db->from($this->$table_name);  
    // $this->db->where('user_authentication.f_id',11);
    // $this->db->join($this->table_login,'caf.id=user_authentication.caf_id');
    $this->db->where($condition);
    // $this->db->like('user_authentication.username',$query,'after');
    // $this->db->or_like('caf.name',$query,'after');
    // $this->db->or_like('caf.contact_mobile',$query,'after');
    // $this->db->or_like('caf.id',$query,'after');
    $this->db->group_start();
    $this->db->where("crn.name like '$search_query%' ");
               // $this->db->or_where("crn.name like '%search_query%' ");
               $this->db->or_where("crn.mobile like '$search_query%' ");
               // $this->db->or_where("crn.id like '%search_query%' ");
                // $this->db->or_group_start()
                        // $this->db->where('b', 'b');
                        // $this->db->where('c', 'c');
                // $this->db->group_end()
        $this->db->group_end();
  
    $data=$this->db->get()->result_array();
    $sql = $this->db->last_query();
    return $data;
}








}