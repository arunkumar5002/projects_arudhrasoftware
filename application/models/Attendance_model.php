<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Attendance_model extends CI_Model
{
	 public function get_attendance($emp_id,$attend_month_year){		
		
		//$query = $this->db->query("select attend_month_year,count(*) as total FROM tbl_attendance_master where attend_emp_id = $emp_id and MONTH(attend_month_year) = $month AND YEAR(attend_month_year) = $year group by attend_month_year");
		
		$query = $this->db->query("SELECT attend_month_year, COUNT(*) AS total FROM tbl_attendance_master WHERE attend_emp_id = $emp_id AND (attend_month_year) = $attend_month_year");
		
		return $query->result();
	}
	
    public function get_attendance_present($emp_id,$date){		
		
		$query = $this->db->query("select attend_month_year,count(*) as present FROM tbl_attendance_master where attend_emp_id = $emp_id and attend_status = 'present' and attend_date = '$date' group by attend_date");
		
		return $query->row();
	}
	
    public function get_attendance_leave($emp_id,$date){		
		
		$query = $this->db->query("select attend_date,count(*) as le FROM tbl_attendance_master where attend_emp_id = $emp_id and attend_status <> 'present' and attend_month_year = '$date' group by attend_month_year");
		
		return $query->row();
	}
	
	
	public function get_emp_attendance($emp_id,$attend_month_year){
		//$query = $this->db->query("select * from tbl_attendance_master where attend_emp_id=$emp_id and YEAR(attend_month_year)=$year and MONTH(attend_month_year)=$mon and DAY(attend_month_year)=$day");
		
		$query = $this->db->query("SELECT * FROM tbl_attendance_master WHERE attend_emp_id = $emp_id AND (attend_date ) = '$attend_month_year'");
		return $query->row();
	}
	
}