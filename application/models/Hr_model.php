<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Hr_model extends CI_Model
{

	public function save_employee($emp_id, $employeename, $contract_type, $employee_status, $department, $designation, $mobile, $emergency_number, $email, $birthdate, $gender, $employedDate, $address, $spousename, $image, $passport_name, $passport_number, $passport_issue_date, $passport_expiry_date, $passport_issue_place, $passport_file, $rp_number, $rp_issue_date, $rp_expiry_date, $rp_file, $crp_name, $crp_number, $crp_issue_date, $crp_expiry_date, $bank_account_name, $bank_iban, $bank_swift_code,$basic_salary,$other_allowance,$sio,$lmra_fee)
	{


		//echo"<pre>";
		//print_r($_POST);
		//exit;


		$sql = "INSERT INTO employee(emp_id,employeename,contract_type,employee_status,department,designation,mobile,emergency_number,email,birthdate,gender,employedDate,address,spousename,image,passport_name,passport_number,passport_issue_date,passport_expiry_date,passport_issue_place,passport_file,rp_number,rp_issue_date,rp_expiry_date,rp_file,crp_name,crp_number,crp_issue_date,crp_expiry_date,bank_account_name,bank_iban,bank_swift_code,basic_salary,other_allowance,sio,lmra_fee) values('$emp_id','$employeename','$contract_type','$employee_status','$department','$designation','$mobile','$emergency_number','$email','$birthdate','$gender','$employedDate','$address','$spousename','$image','$passport_name','$passport_number','$passport_issue_date','$passport_expiry_date','$passport_issue_place','$passport_file','$rp_number','$rp_issue_date','$rp_expiry_date','$rp_file','$crp_name','$crp_number','$crp_issue_date','$crp_expiry_date','$bank_account_name','$bank_iban','$bank_swift_code','$basic_salary','$other_allowance','$sio','$lmra_fee')";


		$result = $this->db->query($sql);
	}
	
	
      public function multiple_images($employee_id,$upload,$file_name){
		
		
		$sql = "INSERT INTO employee_certificates (employee_id, file_name,original_filename) values ('$employee_id','$upload','$file_name')";
		
		//echo"<pre>";
	  //print_r($upload);
	  //exit;
		
		$result = $this->db->query($sql);
		
		
	}
	
	   public function get_designation(){
		 
		 $sql = "select * from tbl_desigantion_category where designation_status = 'Active'";

		$result = $this->db->query($sql);

		return $result->result();
	}                                              
	
	
	 public function get_department(){
		 
		 $sql = "select * from tbl_department_category where department_status = 'Active'";

		$result = $this->db->query($sql);

		return $result->result();
	}                                              
	
	
	
	public function get_employe()
	{

		$sql = "select * from employee ";

		$result = $this->db->query($sql);

		return $result->result();
	}
	


	public function employee_list()
	{

		$sql = "select * from employee where status = 1 ";

		$result = $this->db->query($sql);

		return $result->result();
	}


	public function get_employee($root)
	{

		$sql = "select * from employee where employee_id = $root";

		$result = $this->db->query($sql);

		return $result->row();
	}


	public function view_employee($employee_id)
	{

		$sql = "select * from employee where employee_id = $employee_id";

		$result = $this->db->query($sql);

		return $result->row();
	}
	

	
	public function delete_images($image_id)
	{
		$sql = "delete from employee_certificates where image_id = $image_id";

		$result = $this->db->query($sql);
	}
	
	
	public function view_multiple($employee_id)
	{

		$sql = "select * from employee_certificates where employee_id = $employee_id";

		$result = $this->db->query($sql);

		return $result->result();
	}


	public function update_employee($emp_id, $employeename, $contract_type, $employee_status, $department, $designation, $mobile, $emergency_number, $email, $birthdate, $gender, $employedDate, $address, $spousename, $source, $passport_name, $passport_number, $passport_issue_date, $passport_expiry_date, $passport_issue_place, $passport_file, $rp_number, $rp_issue_date, $rp_expiry_date, $rp_file, $crp_name, $crp_number, $crp_issue_date, $crp_expiry_date, $bank_account_name, $bank_iban, $bank_swift_code,$basic_salary,$other_allowance,$sio,$lmra_fee, $employee_id)
	{
	
    
		 
		$sql = "update employee SET emp_id = '$emp_id', employeename = '$employeename' , contract_type ='$contract_type',employee_status = '$employee_status' ,department = '$department',designation = '$designation' , mobile = '$mobile',emergency_number = '$emergency_number' ,email = '$email' ,birthdate = '$birthdate',gender = '$gender' ,employedDate = '$employedDate' , address = '$address' , spousename = '$spousename',passport_name = '$passport_name',passport_number = '$passport_number' ,passport_issue_date = '$passport_issue_date',passport_expiry_date = '$passport_expiry_date' , passport_issue_place = '$passport_issue_place
',rp_number = '$rp_number' , rp_issue_date = '$rp_issue_date
',rp_expiry_date = '$rp_expiry_date' , crp_name = '$crp_name', crp_number = '
$crp_number' , crp_issue_date = '$crp_issue_date',crp_expiry_date = '$crp_expiry_date
',bank_account_name = '$bank_account_name',bank_iban = '$bank_iban',bank_swift_code = '
$bank_swift_code' ,basic_salary = '$basic_salary' ,other_allowance = '$other_allowance' , sio = '$sio' , lmra_fee = '$lmra_fee'  where employee_id = '$employee_id'";


          $result = $this->db->query($sql);

  if($source){
	  
	  $sql = "update employee SET image = '$source'";
	  
	  $result = $this->db->query($sql);
  }
  
  if($passport_file){
	  
	  $sql = "update employee SET passport_file = '$passport_file'";
	  
	  $result = $this->db->query($sql);
  }
  
  if($rp_file){
	  
	   $sql = "update employee SET rp_file = '$rp_file'";
	   
	   $result = $this->db->query($sql);
	  
        }
	 
	}

	public function delete_company($id)
	{

		$this->db->query("UPDATE  `employee` SET status = 0 Where employee_id='$id'");
	}
	
	
	  public function get_designation1(){
		 
		 $sql = "select * from employee where designation = 'Active'";

		$result = $this->db->query($sql);

		return $result->result();
	}                                              
	
	
	
	
	
	public function get_employee_details()
	{
		$this->db->select("tbl_desigantion_category.designation_name,tbl_department_category.department_name,employee.*");
		$this->db->join("tbl_department_category","tbl_department_category.id=employee.department");
		$this->db->join("tbl_desigantion_category","tbl_desigantion_category.id=employee.designation");
		$result = $this->db->get('employee')->result();
		return $result;
	}
	
	
	
	
	public function save_employeeperform($employee_name,$date_of_review,$review_period, $line_manager,
$job_knowledge_rating,$job_knowledge_comments,$quality_rating,$quality_rating_comments,
$attendance_punctuality_rating,$attendance_punctuality_comments,$takes_initiative_rating
,$takes_initiative_comments,$communication_listening_rating,$communication_listening_comments,
$dependability_rating,$dependability_comments,$total)
	{


		//echo"<pre>";
		//print_r($_POST);
		//exit;


		$sql = "INSERT INTO tbl_employee_performance(employee_id,date_of_review,review_period,line_manager
		,job_knowledge_rating,job_knowledge_comments,quality_rating,quality_rating_comments
		,attendance_punctuality_rating,attendance_punctuality_comments,takes_initiative_rating,takes_initiative_comments
		,communication_listening_rating,communication_listening_comments,dependability_rating,dependability_comments,overall_rating) values('$employee_name','$date_of_review','$review_period', '$line_manager',
'$job_knowledge_rating','$job_knowledge_comments','$quality_rating','$quality_rating_comments',
'$attendance_punctuality_rating','$attendance_punctuality_comments','$takes_initiative_rating'
,'$takes_initiative_comments','$communication_listening_rating','$communication_listening_comments',
'$dependability_rating','$dependability_comments','$total')";


		$result = $this->db->query($sql);
	}
	
	
	
		public function get_loan_name()
	{
		/*$this->db->select("tbl_desigantion_category.designation_name,employee.crp_number,employee.*, loan_master.*");
		
		$this->db->join("tbl_desigantion_category","tbl_desigantion_category.id=employee.designation");
		
		//$this->db->join("loan_master","loan_master.employee_id=employee.employee_id");
				
		$result = $this->db->get('employee')->result();*/
		
		
		$result = $this->db->query("select e.employeename,e.employee_id, e.crp_number, d.designation_name, (select l.date_of_request from loan_master l where l.employee_id = e.employee_id and l.loan_status = 'Active' order by l.created_at desc limit 0,1) as date_of_request from employee e join tbl_desigantion_category d on e.designation = d.id")->result();
		return $result;
	}
	
}



