<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hr extends CI_Controller
{
    public function __construct(){
		parent::__construct();
		$this->load->model('common_model');
		$this->load->model('set_employee_perform_model');
		$this->load->model('loan_master_model');
		$this->load->model('loan_payment_model');
		$this->load->model('Set_holiday_model');
	}
	   
	public function index()
	{
	}

	public function employee_master()
	{

		$data['employee_master'] = 'menu';
		
	    $data['designation'] = $this->Hr_model->get_designation();
		
		$data['department'] = $this->Hr_model->get_department();

		$data['content'] = "web/employee/employee_master";

		$this->load->view('web/template', $data);
	}




	public function save_employee()
	{

		$employee_id = $this->input->post('employee_id');

		$emp_id = $this->input->post('emp_id');
		$employeename = $this->input->post('employeename');
		$contract_type = $this->input->post('contract_type');
		$employee_status = $this->input->post('employee_status');
		$department = $this->input->post('department');
		$designation = $this->input->post('designation');
		$mobile = $this->input->post('mobile');
		$emergency_number = $this->input->post('emergency_numer');
		$email = $this->input->post('email');
		$birthdate = $this->input->post('birthdate');
		$gender = $this->input->post('gender');
		$employedDate = $this->input->post('employedDate');
		$address = $this->input->post('address');
		$spousename = $this->input->post('spousename');
		$passport_name = $this->input->post('passport_name');
		$passport_number = $this->input->post('passport_number');
		$passport_issue_date = $this->input->post('passport_issue_date');
		$passport_expiry_date = $this->input->post('passport_expiry_date');
		$passport_issue_place = $this->input->post('passport_issue_place');
		$rp_number = $this->input->post('rp_number');
		$rp_issue_date = $this->input->post('rp_issue_date');
		$rp_expiry_date = $this->input->post('rp_expiry_date');
		$crp_name = $this->input->post('crp_name');
		$crp_number = $this->input->post('crp_number');
		$crp_issue_date = $this->input->post('crp_issue_date');
		$crp_expiry_date = $this->input->post('crp_expiry_date');
		$bank_account_name = $this->input->post('bank_account_name');
		$bank_iban = $this->input->post('bank_iban');
		$bank_swift_code = $this->input->post('bank_swift_code');
		$basic_salary = $this->input->post('basic_salary');
		$other_allowance = $this->input->post('other_allowance');
		$sio = $this->input->post('sio');
		$lmra_fee = $this->input->post('lmra_fee');



		$birthdate = date("Y-m-d", strtotime($birthdate));
		$employedDate = date("Y-m-d", strtotime($employedDate));
		$passport_issue_date = date("Y-m-d", strtotime($passport_issue_date));
		$passport_expiry_date = date("Y-m-d", strtotime($passport_expiry_date));
		$rp_issue_date = date("Y-m-d", strtotime($rp_issue_date));
		$rp_expiry_date = date("Y-m-d", strtotime($rp_expiry_date));
		$crp_issue_date = date("Y-m-d", strtotime($crp_issue_date));
		$crp_expiry_date = date("Y-m-d", strtotime($crp_expiry_date));

		//echo"<pre>";
		// print_r($_POST);
		//exit;


		$source = '';
		if (isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])) {
			$config['upload_path']     = 'site/uploads/';
			$config['allowed_types']   = 'jpg|png|jpeg';
			$config['file_name']       = rand() . time();


			$this->load->library('upload', $config);


			if (!$this->upload->do_upload('image')) {
			} else {

				$data = array('upload_data' => $this->upload->data());
				$source = $data['upload_data']['file_name'];
			}
		}
      
	  //echo"<pre>";
		 //print_r($source);
		//exit;



		$passport_file = '';
		if (isset($_FILES['passport_file']['name']) && !empty($_FILES['passport_file']['name'])) {
			$config['upload_path']     = 'site/uploads/';
			$config['allowed_types']   = 'jpg|png|jpeg';
			$config['file_name']       = rand() . time();


			$this->load->library('upload', $config);


			if (!$this->upload->do_upload('passport_file')) {
			} else {

				$data = array('upload_data' => $this->upload->data());
				$passport_file = $data['upload_data']['file_name'];
			}
		}


		$rp_file = '';
		if (isset($_FILES['rp_file']['name']) && !empty($_FILES['rp_file']['name'])) {
			$config['upload_path']     = 'site/uploads/';
			$config['allowed_types']   = 'jpg|png|jpeg';
			$config['file_name']       = rand() . time();


			$this->load->library('upload', $config);


			if (!$this->upload->do_upload('rp_file')) {
			} else {

				$data = array('upload_data' => $this->upload->data());
				$rp_file = $data['upload_data']['file_name'];
			}
		}


		//echo"<pre>";
		// print_r($uploadImgData);
		// exit;


		if ($employee_id == '') {
			$this->Hr_model->save_employee($emp_id, $employeename, $contract_type, $employee_status, $department, $designation, $mobile, $emergency_number, $email, $birthdate, $gender, $employedDate, $address, $spousename, $source, $passport_name, $passport_number, $passport_issue_date, $passport_expiry_date, $passport_issue_place, $passport_file, $rp_number, $rp_issue_date, $rp_expiry_date, $rp_file, $crp_name, $crp_number, $crp_issue_date, $crp_expiry_date, $bank_account_name, $bank_iban, $bank_swift_code, $basic_salary, $other_allowance, $sio, $lmra_fee);
			
			$employee_id = $this->db->insert_id();
			
		} else {
			$this->Hr_model->update_employee($emp_id, $employeename, $contract_type, $employee_status, $department, $designation, $mobile, $emergency_number, $email, $birthdate, $gender, $employedDate, $address, $spousename, $source, $passport_name, $passport_number, $passport_issue_date, $passport_expiry_date, $passport_issue_place, $passport_file, $rp_number, $rp_issue_date, $rp_expiry_date, $rp_file, $crp_name, $crp_number, $crp_issue_date, $crp_expiry_date, $bank_account_name, $bank_iban, $bank_swift_code, $basic_salary, $other_allowance, $sio, $lmra_fee, $employee_id);
		}
		
		

		

		$file_name = '';
		$this->load->library('upload');
		$image = array();
		$ImageCount = count($_FILES['file_name']['name']);
		for ($i = 0; $i < $ImageCount; $i++) {
			$_FILES['file']['name']       = $_FILES['file_name']['name'][$i];
			$_FILES['file']['type']       = $_FILES['file_name']['type'][$i];
			$_FILES['file']['tmp_name']   = $_FILES['file_name']['tmp_name'][$i];
			$_FILES['file']['error']      = $_FILES['file_name']['error'][$i];
			$_FILES['file']['size']       = $_FILES['file_name']['size'][$i];

			// File upload configuration
			$config['upload_path']     = 'site/uploads/images/';
			$config['allowed_types']   = 'jpg|png|jpeg|pdf';

			// Load and initialize upload library
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			// Upload file to server
			if ($this->upload->do_upload('file')) {
				// Uploaded file data
				$imageData = $this->upload->data();
				$uploadImgData = $imageData['file_name'];

				$file_name = $_FILES['file']['name'];

				$this->Hr_model->multiple_images($employee_id, $uploadImgData, $file_name);

				//echo"<pre>";
				//print_r($employee_id);
				// exit;	 

			}
		}

		$this->session->set_flashdata("message", " Added Successfully");

		redirect('Hr/employee_master_list');
	}



	public function employee_master_list()
	{

		$data['employee_master_list'] = 'menu';

		$data['keys'] = $this->Hr_model->employee_list();

		$data['content'] = "web/employee/employee_master_list";

		$this->load->view('web/template', $data);
	}



	public function edit_employee($rt)
	{

	
		$data['edit'] = $this->Hr_model->get_employee($rt);
		
		$data['designation'] = $this->Hr_model->get_designation($rt);
		
		$data['department'] = $this->Hr_model->get_department($rt);

		$data['content'] = "web/employee/employee_master";

		$data['image'] = $this->Hr_model->view_multiple($rt);

		$this->load->view('web/template', $data);
	}




	public function view_employee($id)
	{

		$data['view'] = $this->Hr_model->view_employee($id);
		

		$data['image'] = $this->Hr_model->view_multiple($id);

		$data['content'] = "web/employee/employee_master_view";

		$this->load->view('web/template', $data);
	}


	public function delete_employee($id)
	{

		$result = $this->Hr_model->delete_company($id);

		$this->session->set_flashdata("delete_message", "Deleted Successfully...");

		redirect('Hr/employee_master_list');
	}


	public function delete_image()
	{


		$id = $this->input->post("keys");



		//echo"<pre>";
		//print_r($where);
		//exit;

		$result = $this->Hr_model->delete_images($id);
	}



	public function salary_master()
	{

		$data['salary_master'] = 'menu';

		$data['content'] = "web/salarymaster/salary_master";

		$this->load->view('web/template', $data);
	}

	public function salary_generator()
	{

		$data['salary_generator'] = 'menu';

		$data['content'] = "web/salarymaster/salary_generator";

		$this->load->view('web/template', $data);
	}

	public function levy_master()
	{

		$data['levy_master'] = 'menu';

		$data['content'] = "web/levymaster/levy_master";

		$this->load->view('web/template', $data);
	}

	public function levymaster()
	{

		$data['levymaster'] = 'menu';

		$data['content'] = "web/levymaster/levymaster";

		$this->load->view('web/template', $data);
	}



	public function attendence_form()
	{

		$data['content'] = 'web/attendence/attendence_form';

		$this->load->view('web/template', $data);
	}

	public function daily_attendence()
	{

		$data['content'] = 'web/attendence/daily_attendence';

		$this->load->view('web/template', $data);
	}

	public function month_attendence()
	{

		$data['content'] = 'web/attendence/month_attendence';

		$this->load->view('web/template', $data);
	}

	public function salary_slip()
	{
		$data['content'] 			= "web/salarymaster/salary_slip";
		$data['list_employee'] 		= $this->db->select('*')->order_by('emp_id','asc')->get('employee')->result_array();
		$data['list_month'] 		= $this->db->select('id,attend_month_year')->group_by('attend_month_year')->get('tbl_attendance_master')->result_array();
		$this->load->view('web/template', $data);
	}
	
	
	public function get_salary_slip(){
        $emp_id 		= $this->input->post('search_emp_id');
		$search_month 	= $this->input->post('search_month');
		
		$emp_details = get_employe_details($emp_id);
		if(!empty($emp_details->basic_salary)){
		
			$emp_info ='<table>';
				$emp_info.='<tbody>';
					$emp_info.='<tr>';
						$emp_info.='<th width:"60%">Employee Name</th>';
						$emp_info.='<td>:&nbsp;&nbsp;&nbsp;&nbsp;'.$emp_details->employeename.'</td>';
					$emp_info.='</tr>';
					$emp_info.='<tr>';
						$emp_info.='<th>Employee Id</th>';
						$emp_info.='<td>:&nbsp;&nbsp;&nbsp;&nbsp;'.$emp_details->emp_id.'</td>';
					$emp_info.='</tr>';
					$emp_info.='<tr>';
						$emp_info.='<th>Department</th>';
						$emp_info.='<td>:&nbsp;&nbsp;&nbsp;&nbsp;'.$emp_details->department_name.'</td>';
					$emp_info.='</tr>';
					$emp_info.='<tr>';
						$emp_info.='<th>Designation</th>';
						$emp_info.='<td>:&nbsp;&nbsp;&nbsp;&nbsp;'.$emp_details->designation_name.'</td>';
					$emp_info.='</tr>';
				$emp_info.='</tbody>';
			$emp_info.='</table>&nbsp;&nbsp;&nbsp;&nbsp;';
			
			$month_year	 	= $search_month;
			$basic_salary	= $emp_details->basic_salary;
			$sio	 		= $emp_details->sio;
			$limra	 		= $emp_details->lmra_fee;
			
			$emp_payroll_details ='<table>';
				$emp_payroll_details.='<tbody>';
					$emp_payroll_details.='<tr>';
						$emp_payroll_details.='<th width:"60%">Date</th>';
						$emp_payroll_details.='<td>:&nbsp;&nbsp;&nbsp;&nbsp;'.date('d-m-Y').'</td>';
					$emp_payroll_details.='</tr>';
					$emp_payroll_details.='<tr>';
						$emp_payroll_details.='<th> CRP Number </th>';
						$emp_payroll_details.='<td>:&nbsp;&nbsp;&nbsp;&nbsp;'.$emp_details->crp_number.'</td>';
					$emp_payroll_details.='</tr>';
					$emp_payroll_details.='<tr>';
						$emp_payroll_details.='<th>Bank A/C Name</th>';
						$emp_payroll_details.='<td>:&nbsp;&nbsp;&nbsp;&nbsp;'.$emp_details->bank_account_name.'</td>';
					$emp_payroll_details.='</tr>';
					$emp_payroll_details.='<tr>';
						$emp_payroll_details.='<th>IBAN Number</th>';
						$emp_payroll_details.='<td>:&nbsp;&nbsp;&nbsp;&nbsp;'.$emp_details->bank_iban.'</td>';
					$emp_payroll_details.='</tr>';
				$emp_payroll_details.='</tbody>';
			$emp_payroll_details.='</table>';
			
			$i=1;
			$tot_earn = 0;
			$earnings = "";
			$result = $this->db->select('*')->where('earninings_status','Active')->order_by('earninings_name','asc')->get('tbl_salary_earninings')->result_array();
			if(!empty($result)){
				$earnings.= '<tr>';
					$earnings.= '<td>Basic Salary</td>';
					$earnings.= '<td class="text-right">'.number_format($emp_details->basic_salary).'</td>';
				$earnings.= '</tr>';
				foreach($result as $row){
					$val = ($emp_details->basic_salary * $row['earninings_percent'])/100;
					$earnings.= '<tr>';
						$earnings.= '<td>'.$row['earninings_name'].'</td>';
						$earnings.= '<td class="text-right">'.$val.'</td>';
					$earnings.= '</tr>';
					$i++;
					$tot_earn+= $val;
				}
				$tot_earn+= $emp_details->basic_salary;
			}
			
			$i=1;
			$tot_dedt 	= 0;
			$deductions = "";
			$result = $this->db->select('*')->where('deductions_status','Active')->order_by('deductions_name','asc')->get('tbl_salary_deductions')->result_array();
			if(!empty($result)){
				foreach($result as $row){
					$val = ($emp_details->basic_salary * $row['deductions_percent'])/100;
					$deductions.= '<tr>';
						$deductions.= '<td>'.$row['deductions_name'].'</td>';
						$deductions.= '<td class="text-right">'.$val.'</td>';
					$deductions.= '</tr>';
					$tot_dedt+= $val;
					$i++;
				}
				
				$loan_details = $this->db->select('*')->where('employee_id',$emp_details->employee_id)->where('loan_status','Active')->get('loan_master')->result_array();
				if(!empty($loan_details)){
					foreach($loan_details as $row){
						$deductions.= '<tr>';
							$deductions.= '<td>Loan <br/><small>Total Amount : '.number_format($row['loan_amount']).'</small><br/><small>Balance Amount : '.number_format($row['loan_balance_amount']).'</small></td>';
							$deductions.= '<td class="text-right">'.number_format($row['emi']).'</td>';
						$deductions.= '</tr>';
						$i++;
						$tot_dedt+= $row['emi'];
					}
				}
			}
			
			$output = array(
				'status' 		=> 'Success',
				'emp_details' 	=> $emp_info,
				'pay_details' 	=> $emp_payroll_details,
				'ear_details' 	=> $earnings,
				'ded_details' 	=> $deductions,
				'tot_earn' 		=> $tot_earn,
				'tot_dedt' 		=> $tot_dedt,
				'tot_gross' 	=> number_format($tot_earn-$tot_dedt),
				'tot_words' 	=> convert_amount_words(round($tot_earn-$tot_dedt)),
				'month_year'    => $month_year,
				'basic_salary'  => $basic_salary,
				'sio'           => $sio,
				'limra'         => $limra,
			);
		}else{
			$output = array(
				'status' => 'Error'
			);
		}
		
		echo json_encode($output);
	}
	
	public function update_salary_slip(){
		$emp_id = $this->input->post('keys1');
		$month 	= $this->input->post('keys2');
		
		$result = $this->db->select('*')->where('slip_emp_id',$emp_id)->where('slip_month',$month)->get('tbl_salary_slip')->row();
		if(empty($result)){
			$data_arr = array(
				'slip_emp_id' 	=> $emp_id,
				'slip_month'	=> $month,
				'created_at'	=> date('Y-m-d h:i:s'),
				'created_by'	=> $this->session->userdata('user_id'),
			);
			$row_id = $this->common_model->insert('tbl_salary_slip',$data_arr);
				
			$emp_details = get_employe_details($emp_id);	
			
			$tot_earn = 0;
			$earnings = "";
			$result = $this->db->select('*')->where('earninings_status','Active')->order_by('earninings_name','asc')->get('tbl_salary_earninings')->result_array();
			if(!empty($result)){
				foreach($result as $row){
					$val = ($emp_details->basic_salary * $row['earninings_percent'])/100;
					$tot_earn+= $val;
					
					$data_val = array(
						'slip_id' 			=> $row_id,
						'details_name' 		=> $row['earninings_name'],
						'details_amount' 	=> $val,
						'details_type'		=> '1',
					);
					$this->common_model->insert('tbl_salary_details',$data_val);
				}
			}
			
			$tot_dedt 	= 0;
			$result = $this->db->select('*')->where('deductions_status','Active')->order_by('deductions_name','asc')->get('tbl_salary_deductions')->result_array();
			if(!empty($result)){
				foreach($result as $row){
					$val = ($emp_details->basic_salary * $row['deductions_percent'])/100;
					$tot_dedt+= $val;
					
					$data_val = array(
						'slip_id' 			=> $row_id,
						'details_name' 		=> $row['deductions_name'],
						'details_amount' 	=> $val,
						'details_type'		=> '2',
					);
					$this->common_model->insert('tbl_salary_details',$data_val);
				}
				
				$loan_details = $this->db->select('*')->where('employee_id',$emp_details->employee_id)->where('loan_status','Active')->get('loan_master')->result_array();
				if(!empty($loan_details)){
					foreach($loan_details as $row){
						$tot_dedt+= $row['emi'];
						
						$data_val = array(
							'slip_id' 			=> $row_id,
							'details_name' 		=> 'Loan',
							'details_amount' 	=> $row['emi'],
							'details_type'		=> '3',
						);
						$this->common_model->insert('tbl_salary_details',$data_val);
					}
				}
			}
			
			$data_arr = array(
				'slip_earnings' 	=> $tot_earn,
				'slip_deductions'	=> $tot_dedt,
				'slip_net_pay'		=> ($tot_earn - $tot_dedt),
			);
			$where = "id='$row_id'";
			$this->common_model->update('tbl_salary_slip',$data_arr,$where);
			
			$output = array(
				'status' 	=> 'Success',
				'msg'		=> 'Salary Slip Generated Successfully',
			);
		}else{
			$output = array(
				'status' 	=> 'Error',
				'msg'		=> 'Salary Slip Already Generated',
			);
		}
		echo json_encode($output);
	}
	
	public function pdf_salary_slip($select2,$select){
		
		$var = json_decode($this->get_salary_slip($select2,$select));
		$data['data'] = $var;
		
		
		$this->load->helper('pdf_helper');
		
		//echo $data;exit;
		tcpdf();
		$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$obj_pdf->SetCreator(PDF_CREATOR);
		$title = "_".$select2."_".$select."_Attendance";
		$obj_pdf->SetTitle($title);
		//$obj_pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $title, PDF_HEADER_STRING);
		$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		$obj_pdf->SetDefaultMonospacedFont('helvetica');
		$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		$obj_pdf->SetFont('helvetica', '',6);
		$obj_pdf->setFontSubsetting(false);
		$obj_pdf->AddPage();
		ob_start();
				
		$message = $this->load->view('web/salarymaster/pdf/pdf_salary_slip',$data,TRUE);
		//echo $message;exit;
		
		ob_end_clean();
		$obj_pdf ->lastPage();
		$obj_pdf->writeHTML($message, true, false, true, false, '');
		$obj_pdf->Output($title.'.pdf', 'D'); 

   }
   
   
   
	public function add_salary_slip_form($select2,$select){
		
		$var = json_decode($this->get_salary_slip($select2,$select));
		
	    $data['slip_emp_id'] = $select2;
	    $data['slip_month'] = urldecode($select);
		
		
		$this->common_model->insert('tbl_salary_slip',$data);
		 
		
		redirect('Hr/salary_slip');   
	
	}
	
	public function salary_sheet()
	{
		$data['salary_sheet'] = 'menu';
		$data['content'] = "web/salarymaster/salary_sheet";
		$this->load->view('web/template', $data);
	}

	public function leave_category()
	{
		$data['leave_category'] = 'menu';
		$data['content'] = "web/salarymaster/leave_category";
		$this->load->view('web/template', $data);
	}

	public function leave_management()
	{
		$data['leave_management'] = 'menu';
		$data['content'] = "web/salarymaster/leave_management";
		$this->load->view('web/template', $data);
	}
	public function leave_management_list()
	{
		$data['leave_management_list'] = 'menu';


		$data['content'] = "web/salarymaster/leave_management_list";
		$this->load->view('web/template', $data);
	}


	
	
	public function employee_perform(){
	
		$data['employee_perform'] = 'menu';
		$data['content'] = "web/salarymaster/employee_perform";
		$data['department'] = $this->Hr_model->get_employee_details();
        $data['designation'] = $this->Hr_model->get_employee_details();
		$this->load->view('web/template',$data);
		
		

	}
	
	
	public function list_employee_perform(){
	
		$data['employee_perform_list'] = 'menu';
		$data['content'] = "web/salarymaster/employee_perform_list";
		
		$this->load->view('web/template',$data);

	}
	
	
	
	
	
	
	//public function saveemployeeperform(){
	
	// echo "<pre>";
	// print_r($_POST);
		
		
		/*	$employee_name 	= $this->input->post('employee_name');
			$date_of_review 	= $this->input->post('date_of_review');
			$review_period 	= $this->input->post('review_period');
			$line_manager 	= $this->input->post('line_manager');
			$job_knowledge_rating 	= $this->input->post('job_knowledge_rating');
			$job_knowledge_comments 	= $this->input->post('job_knowledge_comments');
			$quality_rating 	= $this->input->post('quality_rating');
			$quality_rating_comments 	= $this->input->post('quality_rating_comments');
			$attendance_punctuality_rating 	= $this->input->post('attendance_punctuality_rating');
			$attendance_punctuality_comments 	= $this->input->post('attendance_punctuality_comments');
			$takes_initiative_rating 	= $this->input->post('takes_initiative_rating');
			$takes_initiative_comments 	= $this->input->post('takes_initiative_comments');
			$communication_listening_rating 	= $this->input->post('communication_listening_rating');
			$communication_listening_comments 	= $this->input->post('communication_listening_comments');
			$dependability_rating 	= $this->input->post('dependability_rating');
			$dependability_comments 	= $this->input->post('dependability_comments');
		   $total = $this->input->post('overall_rating');
		   
		   
	
	 

  
		
			$date_of_review = date("Y-m-d", strtotime($date_of_review));
			
		
	
   $this->Hr_model->save_employeeperform($employee_name, $date_of_review,$review_period, $line_manager,
$job_knowledge_rating,$job_knowledge_comments,$quality_rating,$quality_rating_comments,
$attendance_punctuality_rating,$attendance_punctuality_comments,$takes_initiative_rating
,$takes_initiative_comments,$communication_listening_rating,$communication_listening_comments,
$dependability_rating,$dependability_comments,$total);	
	
	}*/
	
	
		public function submit_employee_perform_category(){
		$row_id	 = $this->input->post('row_id');
		
		$data_arr = array(
			
			'employee_id' 	=> $this->input->post('employee_id'),
			'date_of_review '	=> $this->input->post('date_of_review'),
			'review_period' 	=> $this->input->post('review_period'),
			'line_manager '	=> $this->input->post('line_manager'),
			'job_knowledge_rating' 	=> $this->input->post('job_knowledge_rating'),
			'job_knowledge_comments' 	=> $this->input->post('job_knowledge_comments'),
			'quality_rating' 	=> $this->input->post('quality_rating'),
			'quality_rating_comments' 	=> $this->input->post('quality_rating_comments'),
			'attendance_punctuality_rating' 	=> $this->input->post('attendance_punctuality_rating'),
			'attendance_punctuality_comments' 	=> $this->input->post('attendance_punctuality_comments'),
			'takes_initiative_rating' 	=> $this->input->post('takes_initiative_rating'),
			'takes_initiative_comments' 	=> $this->input->post('takes_initiative_comments'),
			'communication_listening_rating' 	=> $this->input->post('communication_listening_rating'),
			'communication_listening_comments' 	=> $this->input->post('communication_listening_comments'),
			'dependability_rating'	=> $this->input->post('dependability_rating'),
			'dependability_comments' 	=> $this->input->post('dependability_comments'),
		    'overall_rating' => $this->input->post('overall_rating'),
			'employee_status' => $this->input->post('employee_status'),
			
			
			'date_of_review' => date("Y-m-d", strtotime('date_of_review')),
			
		);
		if(empty($row_id)){
			$data_arr['created_at'] = date('Y-m-d h:i:s');
				
			$this->common_model->insert('tbl_employee_performance',$data_arr);
			$output = array(
				'status'	=> 'Success',
				'msg'		=> 'User Account Type Added Successfully',
			);
		}else{
			$data_arr['updated_at'] = date('Y-m-d h:i:s');
			
			$where = "id='$row_id'";
			$this->common_model->update('tbl_employee_performance',$data_arr,$where);
			$output = array(
				'status'	=> 'Success',
				'msg'		=> 'User Account Type Updated Successfully',
			);
		}
		echo json_encode($output);
	}
	
	public function employee_perform_list(){
		$data = $row = array();
		$memData 	= $this->set_employee_perform_model->getRows($_POST);
		$i 			= $_POST['start'];
		
		foreach($memData as $member){
			$i++;
			
			$action=	"<button type='button' class='btn btn-info btn-sm edit_data'
			data-id='".$member->id."' data-name='".$member->employee_id."' data-review='".$member->date_of_review."'data-period='".$member->review_period."' data-manager='".$member->line_manager."' 
			data-knowledge='".$member->job_knowledge_rating."'  data-job='".$member->job_knowledge_comments."' 
			data-punctuality='".$member->attendance_punctuality_rating."' data-attendance='".$member->attendance_punctuality_comments."' 
			data-takes='".$member->takes_initiative_rating."' data-initiative='".$member->takes_initiative_comments."' 
			data-communication='".$member->communication_listening_rating."' data-listening='".$member->communication_listening_comments."' 
			data-dependability='".$member->dependability_rating."' data-comments='".$member->dependability_comments."' 
			data-overall='".$member->overall_rating."' data-status='".$member->employee_status."'><i class='fa fa-edit'></i></button>&nbsp;&nbsp;";
			$action.=	"<button type='button' class='btn btn-danger btn-sm delete_data' data-id='".$member->id."'><i class='fa fa-trash'></i></button>";
			
			$employee_status = ($member->employee_status=='Active')?'<span class="badge badge-success">Active</span>':'<span class="badge badge-danger">Inactive</span>';
			
			$data[] = array($i, $member->employeename, $employee_status, $action);
		}
		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->set_employee_perform_model->countAll($_POST),
			"recordsFiltered" 	=> $this->set_employee_perform_model->countFiltered($_POST),
			"data" 				=> $data,
		);
		echo json_encode($output);
	}

	public function delete_employee_perform_category(){
		$row_id = $this->input->post('keys');
		
		$where = "id='$row_id'";
		$result = $this->common_model->delete('tbl_employee_performance',$where);
		
		if($result==true){
			$output = array(
				'status'	=> 'Success',
				'msg'		=> 'User Account Type Deleted Successfully',
			);
		}else{
			$output = array(
				'status'	=> 'Warning',
				'msg'		=> 'Unable to Delete User Account Type Details',
			);
		}
		echo json_encode($output);
	}
	
	public function loan_master()
	{
        $data['page_title'] = "Loan Master";
		$data['loanmaster_form'] = 'menu';

		$data['content'] = "web/loanmaster/loanmaster_form";
        $data['employees'] = $this->Hr_model->get_loan_name();
		
        /*$data['designation'] = $this->Hr_model->get_loan_name();*/
	   
		$this->load->view('web/template', $data);
	}
	
	public function submit_loan_master(){
		$row_id	 = $this->input->post('row_id');
		
		$data_arr = array(
			'employee_id' 			=> $this->input->post('employee_id'),
			'monthly_salery' 		=> $this->input->post('monthly_salery'),
			'date_of_request' 		=> $this->input->post('date_of_request'),
			'loan_amount' 			=> $this->input->post('loan_amount'),
			'installment_month' 	=> $this->input->post('installment_month'),
			'emi' 					=> $this->input->post('emi'),
			'previous_loan_date' 	=> $this->input->post('previous_loan_date'),
			'accounts_feedback' 	=> $this->input->post('accounts_feedback'),
			'loan_status' 			=> $this->input->post('loan_status'),
		);
		if(empty($row_id)){
			$data_arr['loan_balance_amount'] = $this->input->post('loan_amount');
			$data_arr['created_at'] 		 = date('Y-m-d h:i:s');
			
			$this->common_model->insert('loan_master',$data_arr);
			$output = array(
				'status'	=> 'Success',
				'msg'		=> 'Loan Master Added Successfully',
			);
		}else{
			$data_arr['updated_at'] = date('Y-m-d h:i:s');
			
			$where = "id='$row_id'";
			$this->common_model->update('loan_master',$data_arr,$where);
			$output = array(
				'status'	=> 'Success',
				'msg'		=> 'Loan Master Updated Successfully',
			);
		}
		echo json_encode($output);
	}
	
	public function list_loan_master(){
		$data = $row = array();
		$memData 	= $this->loan_master_model->getRows($_POST);
		$i 			= $_POST['start'];
		
		foreach($memData as $member){
			$i++;
			$payment_url = base_url().'loan_payment/'.$member->loan_id;
			
			$action = "<button type='button' class='btn btn-info btn-sm edit_data' data-id='".$member->loan_id."' data-empid='".$member->employee_id."' data-crp='".$member->crp_number."' data-design='".$member->designation_name."' data-month='".$member->monthly_salery."' data-date='".$member->date_of_request."' data-loan='".$member->loan_amount."' data-amount='".$member->installment_month."' data-accounts='".$member->emi."' data-feed='".$member->accounts_feedback."' data-status='".$member->loan_status."'><i class='fa fa-edit'></i></button>&nbsp;&nbsp;";
			$action.= "<button type='button' class='btn btn-danger btn-sm delete_data' data-id='".$member->loan_id."'><i class='fa fa-trash'></i></button>&nbsp;&nbsp;";
			$action.= "<a href='".$payment_url."' class='btn btn-primary btn-sm'><i class='fas fa-money-check'></i></i></button>";
			
			$loan_status = ($member->loan_status=='Active')?'<span class="badge badge-success">Active</span>':'<span class="badge badge-danger">Inactive</span>';
			
			$date_of_request 	= date("d-m-Y",strtotime($member->date_of_request));
			$installment_month	= '<p class="text-center">'.$member->installment_month."</p>";

			$loan_amount	 	= '<p class="text-right"> '.number_format($member->loan_amount)."</p>";

			$loan_amount	 	= '<p class="text-right">'.number_format($member->loan_amount)."</p>";

			$emi_amount	 	 	= '<p class="text-right">'.number_format($member->emi)."</p>";
			
			$loan_balance	 	= '';
			if(!empty($member->loan_balance_amount)){

				$loan_balance	 	= '<p class="text-right"> '.number_format($member->loan_balance_amount)."</p>";

				$loan_balance	 	= '<p class="text-right">'.number_format($member->loan_balance_amount)."</p>";

			}
			
			
			$data[] = array($i,  $date_of_request, $member->employeename, $loan_amount,  $installment_month, $emi_amount,$loan_balance , $loan_status, $action);
		}
		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->loan_master_model->countAll($_POST),
			"recordsFiltered" 	=> $this->loan_master_model->countFiltered($_POST),
			"data" 				=> $data,
		);
		echo json_encode($output);
	}
	
	public function delete_loan_master(){
		$row_id = $this->input->post('keys');
		
		$where = "id='$row_id'";
		$result = $this->common_model->delete('loan_master',$where);
		
		if($result==true){
			$output = array(
				'status'	=> 'Success',
				'msg'		=> 'Loan Master Deleted Successfully',
			);
		}else{
			$output = array(
				'status'	=> 'Warning',
				'msg'		=> 'Unable to Delete Loan Master Details',
			);
		}
		echo json_encode($output);
	}
	
	//Loan Payment
	public function loan_payment($loan_id){
        $data['page_title'] 	= "Loan Payment";
		$data['content'] 		= "web/loanmaster/loan_payment_master";
		
		$data['loan_details'] 		= $this->db->select('*')->where('id',$loan_id)->get('loan_master')->row();
		$data['employee_details'] 	= $this->db->select('*')->where('employee_id',$data['loan_details']->employee_id)->get('employee')->row();
		$data['emp_department'] 	= $this->db->select('*')->where('id',$data['employee_details']->department)->get('tbl_department_category')->row();
		$data['emp_designation'] 	= $this->db->select('*')->where('id',$data['employee_details']->designation)->get('tbl_desigantion_category')->row();
		$this->load->view('web/template', $data);
	}
	
	public function submit_payment(){
		$payment_balance_amount = $this->input->post('payment_balance_amount');
		$payment_amount 		= $this->input->post('payment_amount');
		$payment_date 			= (!empty($this->input->post('payment_date')))?date("Y-m-d",strtotime($this->input->post('payment_date'))):'';
		$payment_balance 		= $payment_balance_amount - $payment_amount;
		
		if($payment_balance>=0){
			$payment_data = array(
				'payment_loan_id' 	=> $this->input->post('payment_loan_id'),
				'payment_date' 		=> $payment_date,
				'payment_amount' 	=> $payment_amount,
				'payment_method' 	=> $this->input->post('payment_method'),
				'payment_details' 	=> $this->input->post('payment_details'),
				'created_by' 		=> $this->session->userdata('user_id'),
			);
			$this->common_model->insert('loan_payment_history',$payment_data);
			
			$this->db->set('loan_balance_amount', $payment_balance);
			$this->db->where('id', $this->input->post('payment_loan_id'));
			$this->db->update('loan_master');
			
			$output = array(
				'status'	=> 'Success',
				'balance'	=> $payment_balance,
				'msg'		=> 'Payment Completed Successfully',
			);
		}else{
			$output = array(
				'status'	=> 'Error',
				'msg'		=> 'Invaild Payment Amount',
			);
		}
		echo json_encode($output);
	}
	
	public function list_loan_details(){
		$data = $row = array();
		$memData 	= $this->loan_payment_model->getRows($_POST);
		$i 			= $_POST['start'];
		
		foreach($memData as $member){
			$i++;
			
			$payment_date 		= date("d-m-Y",strtotime($member->payment_date));
			$payment_amount	 	= '<p class="text-right"> '.number_format($member->payment_amount)."</p>";
			$data[] = array($i, $payment_date, $payment_amount, $member->payment_method , $member->payment_details);
		}
		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->loan_payment_model->countAll($_POST),
			"recordsFiltered" 	=> $this->loan_payment_model->countFiltered($_POST),
			"data" 				=> $data,
		);
		echo json_encode($output);
	}
	
	public function pay_rol(){
		$data['content'] = "web/setting/pay_rol";
		$data['earnings_details'] 		= $this->db->select('*')->where('earninings_status','Active')->order_by('earninings_name','asc')->get('tbl_salary_earninings')->result_array();
		$data['deductions_details'] 	= $this->db->select('*')->where('deductions_status','Active')->order_by('deductions_name','asc')->get('tbl_salary_deductions')->result_array();
		$data['salary_slip_details'] 	= $this->db->select('*')->order_by('id','desc')->get('tbl_salary_slip')->result_array();
		$this->load->view('web/template', $data);
	}
	
	//Payslip Generator
	public function payslip_generator(){
		$data['page_title'] 	= "Payslip Generator";
		$data['content'] 		= "web/salarymaster/payslip_generator";
		$data['list_employee'] 	= $this->db->select('*')->order_by('emp_id','asc')->get('employee')->result_array();
		$data['list_month'] 	= $this->db->select('id,attend_month_year')->group_by('attend_month_year')->get('tbl_attendance_master')->result_array();
		$this->load->view('web/template', $data);
	}
	
	public function get_payslip_details(){
		$search_emp_id 	= $this->input->post('search_emp_id');
		$search_month 	= $this->input->post('search_month');
		
		$emp_details = get_employee_details($search_emp_id);
		
		if(!empty($emp_details->basic_salary)){
			$emp_info	 = "<strong>".$emp_details->employeename."</strong><br>
				Email : ".$emp_details->email."<br/>
				Mobile : ".$emp_details->mobile."<br/>
				Department : ".$emp_details->department_name."<br/>
				Designation : ".$emp_details->designation_name."<br/>
			";
			
			$emp_payroll_details ='<table>';
				$emp_payroll_details.='<tbody>';
					$emp_payroll_details.='<tr>';
						$emp_payroll_details.='<th width:"60%">Date</th>';
						$emp_payroll_details.='<td>'.date('d-m-Y').'</td>';
					$emp_payroll_details.='</tr>';
					$emp_payroll_details.='<tr>';
						$emp_payroll_details.='<th>PaySlip Month</th>';
						$emp_payroll_details.='<td>'.$search_month.'</td>';
					$emp_payroll_details.='</tr>';
					$emp_payroll_details.='<tr>';
						$emp_payroll_details.='<th>Basic Salary</th>';
						$emp_payroll_details.='<td>'.$emp_details->basic_salary.'</td>';
					$emp_payroll_details.='</tr>';
					$emp_payroll_details.='<tr>';
						$emp_payroll_details.='<th>Other Allowance</th>';
						$emp_payroll_details.='<td>'.$emp_details->other_allowance.'</td>';
					$emp_payroll_details.='</tr>';
					$emp_payroll_details.='<tr>';
						$emp_payroll_details.='<th>SIO</th>';
						$emp_payroll_details.='<td>'.$emp_details->sio.'</td>';
					$emp_payroll_details.='</tr>';
					$emp_payroll_details.='<tr>';
						$emp_payroll_details.='<th>IMRA Fee</th>';
						$emp_payroll_details.='<td>'.$emp_details->lmra_fee.'</td>';
					$emp_payroll_details.='</tr>';
				$emp_payroll_details.='</tbody>';
			$emp_payroll_details.='</table>';
			
			$i=1;
			$earnings = "";
			$result = $this->db->select('*')->where('earninings_status','Active')->order_by('earninings_name','asc')->get('tbl_salary_earninings')->result_array();
			if(!empty($result)){
				$earnings.= '<h5>Earnings</h5>';
				$earnings.= '<table class="table table-striped">';
                    $earnings.= '<thead>';
						$earnings.= '<tr>';
							$earnings.= '<th>SNo</th>';
							$earnings.= '<th>Title</th>';
							$earnings.= '<th>Percentage/Amount</th>';
							$earnings.= '<th>Subtotal</th>';
						$earnings.= '</tr>';
                    $earnings.= '</thead>';
                    $earnings.= '<tbody>';
						foreach($result as $row){
							$val = ($emp_details->basic_salary * $row['earninings_percent'])/100;
							$earnings.= '<tr>';
								$earnings.= '<td>'.$i.'</td>';
								$earnings.= '<td>'.$row['earninings_name'].'</td>';
								$earnings.= '<td class="text-right">'.$row['earninings_percent'].' %</td>';
								$earnings.= '<td class="text-right">'.$val.'</td>';
							$earnings.= '</tr>';
							$i++;
						}
                    $earnings.= '</tbody>';
                $earnings.= '</table>';
			}
			
			$i=1;
			$deductions = "";
			$result = $this->db->select('*')->where('deductions_status','Active')->order_by('deductions_name','asc')->get('tbl_salary_deductions')->result_array();
			if(!empty($result)){
				$deductions.= '<h5>Deductions</h5>';
				$deductions.= '<table class="table table-striped">';
                    $deductions.= '<thead>';
						$deductions.= '<tr>';
							$deductions.= '<th>SNo</th>';
							$deductions.= '<th>Title</th>';
							$deductions.= '<th>Percentage/Amount</th>';
							$deductions.= '<th>Subtotal</th>';
						$deductions.= '</tr>';
                    $deductions.= '</thead>';
                    $deductions.= '<tbody>';
						foreach($result as $row){
							$val = ($emp_details->basic_salary * $row['deductions_percent'])/100;
							$deductions.= '<tr>';
								$deductions.= '<td>'.$i.'</td>';
								$deductions.= '<td>'.$row['deductions_name'].'</td>';
								$deductions.= '<td class="text-right">'.$row['deductions_percent'].' %</td>';
								$deductions.= '<td class="text-right">'.$val.'</td>';
							$deductions.= '</tr>';
							$i++;
						}
						
						$loan_details = $this->db->select('*')->where('employee_id',$emp_details->employee_id)->where('loan_status','Active')->get('loan_master')->result_array();
						if(!empty($loan_details)){
							foreach($loan_details as $row){
								$deductions.= '<tr>';
									$deductions.= '<td>'.$i.'</td>';
									$deductions.= '<td>Loan <br/><small>Total Amount : '.number_format($row['loan_amount']).'</small><br/><small>Balance Amount : '.number_format($row['loan_balance_amount']).'</small></td>';
									$deductions.= '<td class="text-right">'.number_format($row['emi']).'</td>';
									$deductions.= '<td class="text-right">'.number_format($row['emi']).'</td>';
								$deductions.= '</tr>';
								$i++;
							}
						}
                    $deductions.= '</tbody>';
                $deductions.= '</table>';
			}
			
			$output = array(
				'status' 		=> 'Success',
				'emp_details' 	=> $emp_info,
				'pay_details' 	=> $emp_payroll_details,
				'ear_details' 	=> $earnings,
				'ded_details' 	=> $deductions,
			);
		}else{
			$output = array(
				'status' => 'Error'
			);
		}
		echo json_encode($output);
	}
	
	
		public function holidays()
	{
        $data['page_title'] = " Holidays ";
		$data['holidays'] = 'menu';
		$data['content'] = "web/holidays/holidays";
		$this->load->view('web/template', $data);
	}
	
	
	
	public function holidays_submit(){
		$row_id	 = $this->input->post('row_id');
		$holidays_date 	= (!empty($this->input->post('holidays_date')))?date('Y-m-d',strtotime($this->input->post('holidays_date'))):'';
		
		

		$data_arr = array(
			'holidays_name' 	=> $this->input->post('holidays_name'),
			'holidays_date' 	=> $this->input->post('holidays_date'),
			'holidays_day' 	=> $this->input->post('holidays_day'),
			'holiday_status' 	=> $this->input->post('holiday_status'),
			
		);
		if(empty($row_id)){
			$data_arr['created_at'] = date('Y-m-d h:i:s');
	
			$this->common_model->insert('tbl_holidays',$data_arr);
			$output = array(
				'status'	=> 'Success',
				'msg'		=> 'Customer  Added Successfully',
			);
		}else{
			$data_arr['updated_at'] = date('Y-m-d h:i:s');
			
			$where = "id='$row_id'";
			$this->common_model->update('tbl_holidays',$data_arr,$where);
			$output = array(
				'status'	=> 'Success',
				'msg'		=> 'Customer Updated Successfully',
			);
		}
		echo json_encode($output);
	}
	
	
		public function list_holidays(){
		$data = $row = array();
		$memData 	= $this->Set_holiday_model->getRows($_POST);
		$i 			= $_POST['start'];
		
		foreach($memData as $member){
			$i++;
			
			
		$action=	"<button type='button' class='btn btn-info btn-sm edit_data' data-id='".$member->id."' data-name='".$member->holidays_name."' data-date='".$member->holidays_date."' data-day='".$member->holidays_day."' data-status='".$member->holiday_status."'><i class='fa fa-edit'></i></button>&nbsp;&nbsp;";
		$action.=	"<button type='button' class='btn btn-danger btn-sm delete_data' data-id='".$member->id."'><i class='fa fa-trash'></i></button>";

			$holiday_status = ($member->holiday_status=='Active')?'<span class="badge badge-success">Active</span>':'<span class="badge badge-danger">Inactive</span>';
			
			$data[] = array($i, $member->holidays_name,$member->holidays_date,$member->holidays_day,$holiday_status, $action);
		}
		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->Set_holiday_model->countAll($_POST),
			"recordsFiltered" 	=> $this->Set_holiday_model->countFiltered($_POST),
			"data" 				=> $data,
		);
		echo json_encode($output);
	}
	
	
	
		public function delete_value(){
		$row_id = $this->input->post('keys');
		
		$where = "id='$row_id'";
		$result = $this->common_model->delete('tbl_holidays',$where);
		
		if($result==true){
			$output = array(
				'status'	=> 'Success',
				'msg'		=> 'Holiday Deleted Successfully',
			);
		}else{
			$output = array(
				'status'	=> 'Warning',
				'msg'		=> 'Unable to Delete the Holiday Details',
			);
		}
		echo json_encode($output);
	}
	
	
}