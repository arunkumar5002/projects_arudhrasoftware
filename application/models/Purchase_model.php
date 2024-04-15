<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Purchase_model extends CI_Model
{

		 public function get_account_name(){
		 
		 $sql = "select * from tbl_department_category where department_status = 'Active'";

		$result = $this->db->query($sql);

		return $result->result();
	}                                              
	
	
}