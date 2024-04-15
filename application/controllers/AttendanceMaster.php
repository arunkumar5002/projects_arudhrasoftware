<?php
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(0);

class AttendanceMaster extends CI_Controller
{
	public function __construct(){
        parent::__construct();
        $this->load->model('attendance_import_model');
        $this->load->model('attendance_approve_model');
		
		$this->load->library('excel');
    }
	
	public function index(){
		$data['page_title'] 	= "Attendance Master";
		$data['content'] 		= "web/hr_module/attendance_master";
		$data['list_employee'] 	= $this->db->select('*')->order_by('emp_id','asc')->get('employee')->result_array();
		$data['list_month'] 	= $this->db->select('id,attend_month_year')->group_by('attend_month_year')->get('tbl_attendance_master')->result_array();
		$this->load->view('web/template', $data);
	}
	
	public function employee_view($emp_id){
		$data['page_title'] 	= "Employee Attendance Master";
		$data['content'] 		= "web/hr_module/employee_attendance_master";
		$data['list_leave']		= $this->db->select('*')->where('category_status','Active')->get('tbl_attendance_leave_category')->result_array();
		$data['employee_id'] 	= $emp_id;
		
		$data['employee_data'] 		= $this->db->select('*')->where('employee_id',$emp_id)->get('employee')->row();
		$data['emp_department'] 	= $this->db->select('*')->where('id',$data['employee_data']->department)->get('tbl_department_category')->row();
		$data['emp_designation'] 	= $this->db->select('*')->where('id',$data['employee_data']->designation)->get('tbl_desigantion_category')->row();
		$this->load->view('web/template', $data);
	}
	
	public function submit_attendance_import(){
		$i=0;
		
		$tab_con   = 1;
		$loop_con  = 0;
		$att_date  = "";
		$att_val   = "";
		
		if(isset($_FILES["import_excel"]["name"])){
			$attend_month_year = $this->input->post("import_month")." - ".date("Y");
			$extension = pathinfo($_FILES["import_excel"]["name"], PATHINFO_EXTENSION);
			if($extension=="xlsx" || $extension=="xls" || $extension=="csv"){
				$path 	= $_FILES["import_excel"]["tmp_name"];
				$object = PHPExcel_IOFactory::load($path);
				foreach($object->getWorksheetIterator() as $worksheet){
					$highestRow 	= $worksheet->getHighestRow();
					$highestColumn 	= $worksheet->getHighestColumn();
					for($row=7; $row<=$highestRow; $row++){
						
						if(empty($att_val)){
							if($worksheet->getCellByColumnAndRow(1, $row)->getValue()=="Attendance Date"){
								$att_val = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
							}
						}
						
						if($att_val=="Attendance Date"){
							if($loop_con==0){
								$att_date = PHPExcel_Style_NumberFormat::toFormattedString($worksheet->getCellByColumnAndRow(4, $row)->getValue(), 'Y-m-d');
								$tab_con  = 1;
							}

							if($loop_con>=4){
								$tab_con = trim($worksheet->getCellByColumnAndRow(1, $row)->getValue());
								$emp_id	 = trim($worksheet->getCellByColumnAndRow(2, $row)->getValue());
								$status	 = trim($worksheet->getCellByColumnAndRow(13, $row)->getValue());
								
								$attend_action_status = 0;
								if($status=="Present"){
									$attend_action_status = 1;
								}
								
								$data_arr = array(
									'attend_month_year'		=>	$attend_month_year,
									'attend_date'			=>	trim($att_date),
									'attend_emp_id'			=>	trim($emp_id),
									'attend_shift'			=>	trim($worksheet->getCellByColumnAndRow(5, $row)->getValue()),
									'attend_in_time'		=>	trim($worksheet->getCellByColumnAndRow(7, $row)->getValue()),
									'attend_out_time'		=>	trim($worksheet->getCellByColumnAndRow(8, $row)->getValue()),
									'attend_work_hours'		=>	trim($worksheet->getCellByColumnAndRow(10, $row)->getValue()),
									'attend_over_time'		=>	trim($worksheet->getCellByColumnAndRow(11, $row)->getValue()),
									'attend_total_hours'	=>	trim($worksheet->getCellByColumnAndRow(12, $row)->getValue()),
									'attend_status'			=>	$status,
									'attend_action_status'	=>	$attend_action_status,
									'attend_notes'			=>	trim($worksheet->getCellByColumnAndRow(15, $row)->getValue()),
								);
								$data_arr['created_at'] 		= date('Y-m-d h:i:s');
								$data_arr['attend_import_by'] 	= $this->session->userdata('user_id');
								
								$old_data = $this->db->select('*')->where('attend_date',$att_date)->where('attend_emp_id',$emp_id)->get('tbl_attendance_master')->row();
								if(empty($old_data)){
									$this->common_model->insert('tbl_attendance_master',$data_arr);
									$i++;
								}
								
								if(!empty($tab_con)){
									$tab_con   = 1;
								}else{
									$tab_con   = 0;
									$loop_con  = 0;
									$att_val   = "";
								}
							}
							if($tab_con>0){
								$loop_con++;
							}
						}
					}
				}
				$output = array(
					'status'	=> 'Success',
					'msg'		=> 'Attendance Import Successfully Completed',
				);
			}else{
				$i=1;
				$output = array(
					'status'	=> 'Error',
					'msg'		=> 'Import Excel File has Invaild Format',
				);
			}
		}else{
			$i=1;
			$output = array(
				'status'	=> 'Error',
				'msg'		=> 'Please Choose Excel File',
			);
		}
		if($i>0){
			echo json_encode($output);
		}
	}
	
	public function list_attendance_import(){
		$data = $row = array();
		$memData 	= $this->attendance_import_model->getRows($_POST);
		$i 			= $_POST['start'];
		
		foreach($memData as $member){
			$i++;
			
			$attend_status = ($member->attend_status=="Present")?'<span class="badge badge-success">'.$member->attend_status.'</span>':'<span class="badge badge-danger">'.$member->attend_status.'</span>';
			if(!empty($_POST['emp_id'])){
				$data[] = array($i, $member->attend_date, $member->attend_shift, $member->attend_in_time, $member->attend_out_time, $member->attend_over_time, $member->attend_total_hours, $attend_status);
			}else{
				$emp_details = "<b>Code : </b>".$member->attend_emp_id."<br/>";
				$emp_details.= "<b>Name : </b>".$member->employeename."<br/>";
				$emp_details.= "<b>Designation : </b>".$member->designation_name;
				
				$time_details = "<b>In Time : </b>". $member->attend_in_time."<br/>";
				$time_details.= "<b>Out Time : </b>". $member->attend_out_time;
			
				$data[] = array($i, $member->attend_date, $emp_details, $member->attend_shift, $time_details, $member->attend_work_hours, $member->attend_over_time, $member->attend_total_hours, $attend_status);
			}
		}
		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->attendance_import_model->countAll($_POST),
			"recordsFiltered" 	=> $this->attendance_import_model->countFiltered($_POST),
			"data" 				=> $data,
		);
		echo json_encode($output);
	}
	
	public function list_attendance_approve(){
		$data = $row = array();
		$memData 	= $this->attendance_approve_model->getRows($_POST);
		$i 			= $_POST['start'];
		
		foreach($memData as $member){
			$i++;
			
			$input_chk = "<input type='checkbox' name='attend_app_id[]' value='".$member->id."' class='approve_attend' />";
			
			$attend_status = ($member->attend_status=="Present")?'<span class="badge badge-success">'.$member->attend_status.'</span>':'<span class="badge badge-danger">'.$member->attend_status.'</span>';
			
			$emp_details = "<b>Code : </b>".$member->attend_emp_id."<br/>";
			$emp_details.= "<b>Name : </b>".$member->employeename."<br/>";
			$emp_details.= "<b>Designation : </b>".$member->designation_name;
			
			$time_details = "<b>In Time : </b>". $member->attend_in_time."<br/>";
			$time_details.= "<b>Out Time : </b>". $member->attend_out_time;
		
			$data[] = array($input_chk, $member->attend_date, $emp_details, $member->attend_shift, $time_details, $member->attend_work_hours, $member->attend_over_time, $member->attend_total_hours, $attend_status);
		}
		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->attendance_approve_model->countAll($_POST),
			"recordsFiltered" 	=> $this->attendance_approve_model->countFiltered($_POST),
			"data" 				=> $data,
		);
		echo json_encode($output);
	}
	
	public function submit_attendance_approve(){
		$attend_app_id = $this->input->post('attend_app_id');
		
		if(!empty($attend_app_id)){
			for($i=0;$i<count($attend_app_id);$i++){
				$data_arr = array(
					'attend_action_status' 	=> $this->input->post('attend_app_status'),
					'attend_action_by' 		=> $this->session->userdata('user_id'),
					'attend_amount' 		=> $this->input->post('attend_amount'),
					'attend_leave_category' => $this->input->post('attend_leave_category'),
					'attend_action_notes' 	=> $this->input->post('attend_app_notes'),
					'attend_action_at' 		=> date('Y-m-d h:i:s'),
				);
				
				$where = "id='".$attend_app_id[$i]."'";
				$this->common_model->update('tbl_attendance_master',$data_arr,$where);
			}
			$output = array(
				'status'	=> 'Success',
				'msg'		=> 'Attendance Status Updated Successfully',
			);
		}else{
			$output = array(
				'status'	=> 'Error',
				'msg'		=> 'Please Choose Any Attendance Info',
			);
		}
		echo json_encode($output);
	}
}
?>