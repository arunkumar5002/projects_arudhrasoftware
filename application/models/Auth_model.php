<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth_model extends CI_Model
{
   public function insert_record($table,$values)
	{		
		$this->db->insert($table,$values);
		return $this->db->insert_id();	
	}
	
	
	
		public function get_record($table,$fields='*',$where='')
	{
			if($fields)
				$this->db->select($fields);
			if(!empty($where))
				$this->db->where($where);
			return $this->db->get($table)->row();					 
	}
	
	public function get_records_count($table,$fields='*',$where='')
	{
		if(!empty($where))
			$this->db->where($where);
		$this->db->from($table);
		return $this->db->count_all_results();	
			
	}
	
	
	
	
	
	
	

}