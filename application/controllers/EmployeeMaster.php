<?php
defined('BASEPATH') or exit('No direct script access allowed');
class EmployeeMaster extends CI_Controller
{
	public function __construct(){
        parent::__construct();
        $this->load->model('user_account_master_model');
        $this->load->model('user_model');
		$this->load->model('employee_master_model');
		$this->load->model('employee_certificate_master_model');
		
		$this->load->library('excel');
    }
	
	public function index(){
		$data['page_title'] = "Employee Master";
		$data['content'] 	= "web/hr_module/employee_master_list";
		$this->load->view('web/template', $data);
	}
	
	public function add_employee(){
		$data['page_title'] = "Add Employee";
		$data['content'] = "web/hr_module/employee_master_form";
		$this->load->view('web/template', $data);
	}
	
	public function edit_employee($emp_id){
		$data['page_title'] 	= "Edit Employee";
		$data['content'] 		= "web/hr_module/employee_master_form";
		$data['emp_details'] 	= $this->db->select('*')->where('employee_id',$emp_id)->get('employee')->row();
		$this->load->view('web/template', $data);
	}
	
	public function all_employee_notification(){
		$data['page_title'] 	= "All Employee Notification";
		$data['content'] 		= "web/notification_employee_details";
		$this->load->view('web/template', $data);
	}
	
	public function list_employee_master(){
		$data = $row = array();
		$memData 	= $this->employee_master_model->getRows($_POST);
		$i 			= $_POST['start'];
		
		foreach($memData as $member){
			$i++;	
			
			$links  = base_url().'edit_employee/'.$member->employee_id;
			$action = "<a href='".$links."' class='btn btn-info btn-sm'><i class='fa fa-edit'></i></a>&nbsp;&nbsp;";
			
			$action.=	"<button type='button' class='btn btn-danger btn-sm delete_data' data-id='".$member->employee_id."'><i class='fa fa-trash'></i></button>";
			$data[] = array($i, $member->emp_id,$member->employeename,$member->email,$member->mobile,$member->department_name,$member->designation_name, $action);
		}
		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->employee_master_model->countAll($_POST),
			"recordsFiltered" 	=> $this->employee_master_model->countFiltered($_POST),
			"data" 				=> $data,
		);
		echo json_encode($output);
	}
	
	
	public function delete_employee_category(){
		$row_id = $this->input->post('keys');
		
		$where = "employee_id='$row_id'";
		$result = $this->common_model->delete('employee',$where);
		
		if($result==true){
			$output = array(
				'status'	=> 'Success',
				'msg'		=> 'Employee Deleted Successfully',
			);
		}else{
			$output = array(
				'status'	=> 'Warning',
				'msg'		=> 'Unable to Delete Employee Details',
			);
		}
		echo json_encode($output);
	}
	
	
	public function add_edit_employee_details(){
		$row_id		= $this->input->post('employee_row_id');
		
		$birth_date 	= (!empty($this->input->post('birthdate')))?date('Y-m-d',strtotime($this->input->post('birthdate'))):'';
		$employe_date 	= (!empty($this->input->post('employedDate')))?date('Y-m-d',strtotime($this->input->post('employedDate'))):'';
		$data_arr 		= array(
			'emp_id' 				=> $this->input->post('emp_id'),
			'employeename' 			=> $this->input->post('employeename'),
			'password'              => $this->input->post('password'),
			'employee_status' 		=> $this->input->post('employee_status'),
			'email' 				=> $this->input->post('email'),
			'mobile' 				=> $this->input->post('mobile'),
			'emergency_mobile_no' 	=> $this->input->post('emergency_mobile_no'),
			'contract_type' 		=> $this->input->post('contract_type'),
			'department' 			=> $this->input->post('department'),
			'designation' 			=> $this->input->post('designation'),
			'birthdate' 			=> $birth_date,
			'employedDate' 			=> $employe_date,
			'gender' 				=> $this->input->post('gender'),
			'nationality'			=> $this->input->post('nationality'),
			'address' 				=> $this->input->post('address'),
			'spousename' 			=> $this->input->post('spousename'),
			'username' 				=> $this->input->post('username'),
		);
		
		$test_con 	 = 0;
		$small_image = "";
		if(isset($_FILES["profile_image"]["name"]) && !empty($_FILES["profile_image"]["name"])){
    		$image_info = getimagesize($_FILES["profile_image"]["tmp_name"]);
    		$image_width = $image_info[0];
    		$image_height = $image_info[1];
    		$imageData1['imageName']='profile_image';
    		$imageData1['imageWidth']=$image_width;
    		$imageData1['imageHeight']=$image_height;
    		$imageData1['prefWidth']=$image_width;
		    $imageData1['prefHeight']=$image_height;
    		$extension = pathinfo($_FILES["profile_image"]["name"], PATHINFO_EXTENSION);
    		$filename = pathinfo($_FILES['profile_image']['name'], PATHINFO_FILENAME);
    		
    		$config['upload_path']    = EMPLOYEE_PROFILE_IMG_PATH;
    		$config['allowed_types']  = 'jpg|jpeg|png|webp|JPG|JPEG|PNG|WEBP';
    		$config['file_name']      = $filename.rand() . '_' . date('YmdHis') . "." . $extension;	
    		$this->load->library('upload', $config);
    		if(!$this->upload->do_upload('profile_image')){
    			$test_con   = 1;
    			$error      = $this->upload->display_errors();
    		}else{
    			$data           = array('upload_data' => $this->upload->data());
    			$test_con       = 0;
    			$data_arr['profile_image']    = $data['upload_data']['file_name'];
    		}
        }
		
		if($test_con==0){
			if(empty($row_id)){
				$data_arr['created_at'] 	= date('Y-m-d h:i:s');
				$data_arr['created_by'] 	= $this->session->userdata('user_id');
				
				$row_id = $this->common_model->insert('employee',$data_arr);
				$output = array(
					'status'	=> 'Success',
					'msg'		=> 'Employee Details Added Successfully',
					'emp_id'	=> $row_id,
				);
			}else{
				$data_arr['updated_at'] = date('Y-m-d h:i:s');
				$data_arr['updated_by'] = $this->session->userdata('user_id');
				
				$where = "employee_id='$row_id'";
				$this->common_model->update('employee',$data_arr,$where);
				$output = array(
					'status'	=> 'Success',
					'msg'		=> 'Employee Details Updated Successfully',
					'emp_id'	=> $row_id,
				);
			}
		}else{
			$output = array(
				'status'	=> 'Error',
				'msg'		=> $error,
			);
		}
		echo json_encode($output);
	}
	
	public function update_passport_details(){
		$row_id		= $this->input->post('passport_row_id');
		
		$issue_date 	= (!empty($this->input->post('passport_issue_date')))?date('Y-m-d',strtotime($this->input->post('passport_issue_date'))):'';
		$expiry_date 	= (!empty($this->input->post('passport_expiry_date')))?date('Y-m-d',strtotime($this->input->post('passport_expiry_date'))):'';
		$data_arr 		= array(
			'passport_name' 		=> $this->input->post('passport_name'),
			'passport_number' 		=> $this->input->post('passport_number'),
			'passport_issue_place' 	=> $this->input->post('passport_issue_place'),
			'passport_issue_date' 	=> $issue_date,
			'passport_expiry_date' 	=> $expiry_date,
		);
		
		$test_con 	 = 0;
		$small_image = "";
		if(isset($_FILES["passport_file"]["name"]) && !empty($_FILES["passport_file"]["name"])){
    		$image_info = getimagesize($_FILES["passport_file"]["tmp_name"]);
    		$image_width = $image_info[0];
    		$image_height = $image_info[1];
    		$imageData1['imageName']='passport_file';
    		$imageData1['imageWidth']=$image_width;
    		$imageData1['imageHeight']=$image_height;
    		$imageData1['prefWidth']=$image_width;
		    $imageData1['prefHeight']=$image_height;
    		$extension = pathinfo($_FILES["passport_file"]["name"], PATHINFO_EXTENSION);
    		$filename = pathinfo($_FILES['passport_file']['name'], PATHINFO_FILENAME);
    		
    		$config['upload_path']    = EMPLOYEE_PASSPORT_IMG_PATH;
    		$config['allowed_types']  = 'jpg|jpeg|png|webp|JPG|JPEG|PNG|WEBP';
    		$config['file_name']      = $filename.rand() . '_' . date('YmdHis') . "." . $extension;	
    		$this->load->library('upload', $config);
    		if(!$this->upload->do_upload('passport_file')){
    			$test_con   = 1;
    			$error      = $this->upload->display_errors();
    		}else{
    			$data           = array('upload_data' => $this->upload->data());
    			$test_con       = 0;
    			$data_arr['passport_file']    = $data['upload_data']['file_name'];
    		}
        }
		
		if($test_con==0){
			if(empty($row_id)){
				$output = array(
					'status'	=> 'Error',
					'msg'		=> 'Please Complete Employee Details',
				);
			}else{
				$data_arr['updated_at'] = date('Y-m-d h:i:s');
				$data_arr['updated_by'] = $this->session->userdata('user_id');
				
				$where = "employee_id='$row_id'";
				$this->common_model->update('employee',$data_arr,$where);
				$output = array(
					'status'	=> 'Success',
					'msg'		=> 'Passport Details Updated Successfully',
				);
			}
		}else{
			$output = array(
				'status'	=> 'Error',
				'msg'		=> $error,
			);
		}
		echo json_encode($output);
	}
	
	public function update_resident_details(){
		$row_id		= $this->input->post('resident_row_id');
		
		$issue_date 	= (!empty($this->input->post('rp_issue_date')))?date('Y-m-d',strtotime($this->input->post('rp_issue_date'))):'';
		$expiry_date 	= (!empty($this->input->post('rp_expiry_date')))?date('Y-m-d',strtotime($this->input->post('rp_expiry_date'))):'';
		$data_arr 		= array(
			'rp_number' 		=> $this->input->post('rp_number'),
			'rp_issue_date' 	=> $issue_date,
			'rp_expiry_date' 	=> $expiry_date,
		);
		
		$test_con 	 = 0;
		$small_image = "";
		if(isset($_FILES["rp_file"]["name"]) && !empty($_FILES["rp_file"]["name"])){
    		$image_info = getimagesize($_FILES["rp_file"]["tmp_name"]);
    		$image_width = $image_info[0];
    		$image_height = $image_info[1];
    		$imageData1['imageName']='rp_file';
    		$imageData1['imageWidth']=$image_width;
    		$imageData1['imageHeight']=$image_height;
    		$imageData1['prefWidth']=$image_width;
		    $imageData1['prefHeight']=$image_height;
    		$extension = pathinfo($_FILES["rp_file"]["name"], PATHINFO_EXTENSION);
    		$filename = pathinfo($_FILES['rp_file']['name'], PATHINFO_FILENAME);
    		
    		$config['upload_path']    = EMPLOYEE_PR_FILE_IMG_PATH;
    		$config['allowed_types']  = 'jpg|jpeg|png|webp|JPG|JPEG|PNG|WEBP';
    		$config['file_name']      = $filename.rand() . '_' . date('YmdHis') . "." . $extension;	
    		$this->load->library('upload', $config);
    		if(!$this->upload->do_upload('rp_file')){
    			$test_con   = 1;
    			$error      = $this->upload->display_errors();
    		}else{
    			$data           = array('upload_data' => $this->upload->data());
    			$test_con       = 0;
    			$data_arr['rp_file']    = $data['upload_data']['file_name'];
    		}
        }
		
		if($test_con==0){
			if(empty($row_id)){
				$output = array(
					'status'	=> 'Error',
					'msg'		=> 'Please Complete Employee Details',
				);
			}else{
				$data_arr['updated_at'] = date('Y-m-d h:i:s');
				$data_arr['updated_by'] = $this->session->userdata('user_id');
				
				$where = "employee_id='$row_id'";
				$this->common_model->update('employee',$data_arr,$where);
				$output = array(
					'status'	=> 'Success',
					'msg'		=> 'Resident Permit Details Updated Successfully',
				);
			}
		}else{
			$output = array(
				'status'	=> 'Error',
				'msg'		=> $error,
			);
		}
		echo json_encode($output);
	}
	
	public function update_cpr_details(){
		$row_id		= $this->input->post('cpr_row_id');
		
		$issue_date 	= (!empty($this->input->post('crp_issue_date')))?date('Y-m-d',strtotime($this->input->post('crp_issue_date'))):'';
		$expiry_date 	= (!empty($this->input->post('crp_expiry_date')))?date('Y-m-d',strtotime($this->input->post('crp_expiry_date'))):'';
		$data_arr 		= array(
			'crp_name' 			=> $this->input->post('crp_name'),
			'crp_number' 		=> $this->input->post('crp_number'),
			'crp_issue_date' 	=> $issue_date,
			'crp_expiry_date' 	=> $expiry_date,
		);
		if(empty($row_id)){
			$output = array(
				'status'	=> 'Error',
				'msg'		=> 'Please Complete Employee Details',
			);
		}else{
			$data_arr['updated_at'] = date('Y-m-d h:i:s');
			$data_arr['updated_by'] = $this->session->userdata('user_id');
			
			$where = "employee_id='$row_id'";
			$this->common_model->update('employee',$data_arr,$where);
			$output = array(
				'status'	=> 'Success',
				'msg'		=> 'CRP Details Updated Successfully',
			);
		}
		echo json_encode($output);
	}
	
	public function update_bank_details(){
		$row_id		= $this->input->post('bank_row_id');
		
		$data_arr 		= array(
			'bank_account_name' 	=> $this->input->post('bank_account_name'),
			'bank_iban' 			=> $this->input->post('bank_iban'),
			'bank_swift_code' 		=> $this->input->post('bank_swift_code'),
		);
		if(empty($row_id)){
			$output = array(
				'status'	=> 'Error',
				'msg'		=> 'Please Complete Employee Details',
			);
		}else{
			$data_arr['updated_at'] = date('Y-m-d h:i:s');
			$data_arr['updated_by'] = $this->session->userdata('user_id');
			
			$where = "employee_id='$row_id'";
			$this->common_model->update('employee',$data_arr,$where);
			$output = array(
				'status'	=> 'Success',
				'msg'		=> 'Bank Details Updated Successfully',
			);
		}
		echo json_encode($output);
	}
	
	public function update_salary_details(){
		$row_id		= $this->input->post('salary_row_id');
		$data_arr 	= array(
			'basic_salary' 		=> $this->input->post('basic_salary'),
			'other_allowance' 	=> $this->input->post('other_allowance'),
			'sio' 				=> $this->input->post('sio'),
			'lmra_fee' 			=> $this->input->post('lmra_fee'),
		);
		if(empty($row_id)){
			$output = array(
				'status'	=> 'Error',
				'msg'		=> 'Please Complete Employee Details',
			);
		}else{
			$data_arr['updated_at'] = date('Y-m-d h:i:s');
			$data_arr['updated_by'] = $this->session->userdata('user_id');
			
			$where = "employee_id='$row_id'";
			$this->common_model->update('employee',$data_arr,$where);
			$output = array(
				'status'	=> 'Success',
				'msg'		=> 'Salary Details Updated Successfully',
			);
		}
		echo json_encode($output);
	}
	
	public function add_certificate_details(){
		$certificate_row_id = $this->input->post('certificate_row_id');
		$data_arr 	= array(
			'certificate_emp_id' 	=> $certificate_row_id,
			'certificate_name' 		=> $this->input->post('certificate_name'),
		);
		
		$test_con 	 = 0;
		$small_image = "";
		if(isset($_FILES["certificate_image"]["name"]) && !empty($_FILES["certificate_image"]["name"])){
    		$image_info = getimagesize($_FILES["certificate_image"]["tmp_name"]);
    		$image_width = $image_info[0];
    		$image_height = $image_info[1];
    		$imageData1['imageName']='certificate_image';
    		$imageData1['imageWidth']=$image_width;
    		$imageData1['imageHeight']=$image_height;
    		$imageData1['prefWidth']=$image_width;
		    $imageData1['prefHeight']=$image_height;
    		$extension = pathinfo($_FILES["certificate_image"]["name"], PATHINFO_EXTENSION);
    		$filename = pathinfo($_FILES['certificate_image']['name'], PATHINFO_FILENAME);
    		
    		$config['upload_path']    = EMPLOYEE_CERTIFICATE_IMG_PATH;
    		$config['allowed_types']  = 'jpg|jpeg|png|webp|JPG|JPEG|PNG|WEBP';
    		$config['file_name']      = $filename.rand() . '_' . date('YmdHis') . "." . $extension;	
    		$this->load->library('upload', $config);
    		if(!$this->upload->do_upload('certificate_image')){
    			$test_con   = 1;
    			$error      = $this->upload->display_errors();
    		}else{
    			$data           = array('upload_data' => $this->upload->data());
    			$test_con       = 0;
    			$data_arr['certificate_image']    = $data['upload_data']['file_name'];
    		}
        }
		
		if($test_con==0){
			if(empty($certificate_row_id)){
				$output = array(
					'status'	=> 'Error',
					'msg'		=> 'Please Complete Employee Details',
				);
			}else{
				$data_arr['created_at'] = date('Y-m-d h:i:s');
				$data_arr['created_by'] = $this->session->userdata('user_id');
				
				$row_id = $this->common_model->insert('employee_certificate',$data_arr);
				$output = array(
					'status'	=> 'Success',
					'msg'		=> 'Certificate Added Successfully',
				);
			}
		}else{
			$output = array(
				'status'	=> 'Error',
				'msg'		=> $error,
			);
		}
		echo json_encode($output);
	}
	
	public function list_certificate_details(){
		$data = $row = array();
		$memData 	= $this->employee_certificate_master_model->getRows($_POST);
		$i 			= $_POST['start'];
		
		foreach($memData as $member){
			$i++;
			
			$link   = base_url().EMPLOYEE_CERTIFICATE_IMG_PATH.'/'.$member->certificate_image;
			$action = "<a href='".$link."' class='btn btn-info btn-sm' download='".$link."'><i class='fa fa-download'></i></a>&nbsp;&nbsp;";
			$action.= "<button type='button' class='btn btn-danger btn-sm delete_data' data-id='".$member->certificate_emp_id."'><i class='fa fa-trash'></i></button>";
			
			$created_at = date("d-m-Y h:i a",strtotime($member->created_at));
			
			$data[] = array($i, $member->certificate_name, $member->certificate_image, $created_at, $action);
		}
		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->employee_certificate_master_model->countAll($_POST),
			"recordsFiltered" 	=> $this->employee_certificate_master_model->countFiltered($_POST),
			"data" 				=> $data,
		);
		echo json_encode($output);
	}
	
	public function employee_profile(){
		$data['page_title'] 	= "Profile";
		$data['content'] 		= "web/employee/employee_profile_view";
		$data['list_leave']		= $this->db->select('*')->where('category_status','Active')->get('tbl_attendance_leave_category')->result_array();
		$data['employee_id'] 	= $this->session->userdata('user_id');
		
		$data['emp_details'] 		= $this->db->select('*')->where('employee_id',$this->session->userdata('user_id'))->get('employee')->row();
		$data['emp_department'] 	= $this->db->select('*')->where('id',$data['emp_details']->department)->get('tbl_department_category')->row();
		$data['emp_designation'] 	= $this->db->select('*')->where('id',$data['emp_details']->designation)->get('tbl_desigantion_category')->row();
		$this->load->view('web/template', $data);
	}
	
		public function delete_certificate(){
		$row_id = $this->input->post('keys');
		
		$where = "certificate_emp_id='$row_id'";
		$result = $this->common_model->delete('employee_certificate',$where);
		
		if($result==true){
			$output = array(
				'status'	=> 'Success',
				'msg'		=> 'Deductions Deleted Successfully',
			);
		}else{
			$output = array(
				'status'	=> 'Warning',
				'msg'		=> 'Unable to Delete the Deductions Details',
			);
		}
		echo json_encode($output);
	}
	
	
	  public function add_employee_master_import(){
		
		if(isset($_FILES["import_excel"]["name"])){
			$extension = pathinfo($_FILES["import_excel"]["name"], PATHINFO_EXTENSION);
			if($extension=="xlsx" || $extension=="xls" || $extension=="csv"){
				$path 	= $_FILES["import_excel"]["tmp_name"];
				$object = PHPExcel_IOFactory::load($path);
				foreach($object->getWorksheetIterator() as $worksheet){
					$highestRow 	= $worksheet->getHighestRow();
					$highestColumn 	= $worksheet->getHighestColumn();
					for($row=2; $row<=$highestRow; $row++){
						
						$employee_date = PHPExcel_Style_NumberFormat::toFormattedString($worksheet->getCellByColumnAndRow(14, $row)->getValue(), 'Y-m-d');
						
						$birth_date = PHPExcel_Style_NumberFormat::toFormattedString($worksheet->getCellByColumnAndRow(12, $row)->getValue(), 'Y-m-d');
						
						$passport_issue_date = PHPExcel_Style_NumberFormat::toFormattedString($worksheet->getCellByColumnAndRow(19, $row)->getValue(), 'Y-m-d');
						
						$passport_expiry_date = PHPExcel_Style_NumberFormat::toFormattedString($worksheet->getCellByColumnAndRow(20, $row)->getValue(), 'Y-m-d');
						
						$rp_issue_date = PHPExcel_Style_NumberFormat::toFormattedString($worksheet->getCellByColumnAndRow(23, $row)->getValue(), 'Y-m-d');
						
						$rp_expiry_date = PHPExcel_Style_NumberFormat::toFormattedString($worksheet->getCellByColumnAndRow(24, $row)->getValue(), 'Y-m-d');
						
						$crp_issue_date = PHPExcel_Style_NumberFormat::toFormattedString($worksheet->getCellByColumnAndRow(27, $row)->getValue(), 'Y-m-d');
						
						$crp_expiry_date = PHPExcel_Style_NumberFormat::toFormattedString($worksheet->getCellByColumnAndRow(28, $row)->getValue(), 'Y-m-d');
						

								$data_arr = array(
									'emp_id'			=>	trim($worksheet->getCellByColumnAndRow(1, $row)->getValue()),
									'employeename'		=>	trim($worksheet->getCellByColumnAndRow(2, $row)->getValue()),
									'username'	=>	trim($worksheet->getCellByColumnAndRow(3, $row)->getValue()),
									'password'			=>	trim($worksheet->getCellByColumnAndRow(4, $row)->getValue()),
									'contract_type'			=>	trim($worksheet->getCellByColumnAndRow(5, $row)->getValue()),
									'employee_status'		=>	trim($worksheet->getCellByColumnAndRow(6, $row)->getValue()),
									'department'			=>	trim($worksheet->getCellByColumnAndRow(7, $row)->getValue()),
									'designation'		=>	trim($worksheet->getCellByColumnAndRow(8, $row)->getValue()),
									'mobile'		=>	trim($worksheet->getCellByColumnAndRow(9, $row)->getValue()),
									'emergency_mobile_no'	=>	trim($worksheet->getCellByColumnAndRow(10, $row)->getValue()),
									'email'		=>	trim($worksheet->getCellByColumnAndRow(11, $row)->getValue()),
									'birthdate'		=>	trim($birth_date),
									'gender'		=>	trim($worksheet->getCellByColumnAndRow(13, $row)->getValue()),
									'employedDate'		=>	trim($employee_date),
									'address'			=>	trim($worksheet->getCellByColumnAndRow(15, $row)->getValue()),
									'spousename'		=>	trim($worksheet->getCellByColumnAndRow(16, $row)->getValue()),
									'passport_name'		=>	trim($worksheet->getCellByColumnAndRow(17, $row)->getValue()),
									'passport_number'		=>	trim($worksheet->getCellByColumnAndRow(18, $row)->getValue()),
									'passport_issue_date'	=>	trim($passport_issue_date),
									'passport_expiry_date'			=>	trim($passport_expiry_date),
									'passport_issue_place'		=>	trim($worksheet->getCellByColumnAndRow(21, $row)->getValue()),
									'rp_number'			=>	trim($worksheet->getCellByColumnAndRow(22, $row)->getValue()),
									'rp_issue_date'		=>	trim($rp_issue_date),
									'rp_expiry_date'		=>	trim($rp_expiry_date),
									'crp_name'		=>	trim($worksheet->getCellByColumnAndRow(25, $row)->getValue()),
									'crp_number'		=>	trim($worksheet->getCellByColumnAndRow(26, $row)->getValue()),
									'crp_issue_date'	=>	trim($crp_issue_date),
									'crp_expiry_date'			=>	trim($crp_expiry_date),
									'bank_account_name'			=>	trim($worksheet->getCellByColumnAndRow(29, $row)->getValue()),
									'bank_iban'		=>	trim($worksheet->getCellByColumnAndRow(30, $row)->getValue()),
									'bank_swift_code'		=>	trim($worksheet->getCellByColumnAndRow(31, $row)->getValue()),
									'basic_salary'	=>	trim($worksheet->getCellByColumnAndRow(32, $row)->getValue()),
									'other_allowance'			=>	trim($worksheet->getCellByColumnAndRow(33, $row)->getValue()),
									'sio'			=>	trim($worksheet->getCellByColumnAndRow(34, $row)->getValue()),
									'lmra_fee'		=>	trim($worksheet->getCellByColumnAndRow(35, $row)->getValue()),
									
								);
								$data_arr['created_at'] 		= date('Y-m-d h:i:s');
								
								
								
							   $this->common_model->insert('employee',$data_arr);					
			
	
                             }
							 
							 $output = array(
					'status'	=> 'Success',
					'msg'		=> 'Attendance Import Successfully Completed',
				);
				}
			}
		}
		
		echo json_encode($output);
} 
}
?>