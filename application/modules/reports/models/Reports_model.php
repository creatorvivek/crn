<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



class Reports_model extends MY_Model{
    function __construct(){
        parent::__construct();
    }



    function salesAnalysis($table_name,$condition=null,$coloumn_name,$start_date='',$end_date='')
    {

    	 $this->db->select_sum($coloumn_name);
 		 if(!is_null($condition))
  		  $this->db->where($condition);
  			 if(!empty($start_date) && !empty($end_date))
  				$this->db->where("date(created_at) BETWEEN '$start_date' AND '$end_date'");
 					 $count=$this->db->get($this->$table_name)->row_array();
 					 return $count[$coloumn_name];





    }

























}