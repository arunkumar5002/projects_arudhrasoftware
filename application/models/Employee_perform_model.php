<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Employee_perform_model extends CI_Model
{


     public function get_employee_details()
	{
		$this->db->select("tbl_desigantion_category.designation_name,tbl_department_category.department_name,employee.*");
		$this->db->join("tbl_department_category","tbl_department_category.id=employee.department");
		$this->db->join("tbl_desigantion_category","tbl_desigantion_category.id=employee.designation");
		$result = $this->db->get('employee')->result();
		return $result;
	}
	
	public function get_edit_employee($id)
	{
		
		$sql = "select * from tbl_employee_performance where id = '$id'";

		$result = $this->db->query($sql);

		return $result->row();
	}
	
	public function employee_view($id)
	{
		
		$sql = "select * from tbl_employee_performance where id = '$id'";
		$result = $this->db->query($sql);

		return $result->row();
	}
	
	
}