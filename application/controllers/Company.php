<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Company extends CI_Controller
{
	public function __construct(){
        parent::__construct();
        $this->load->model('company_model');
        $this->load->model('set_leave_category_model');
        $this->load->model('set_salary_earninings_model');
        $this->load->model('set_salary_deductions_model');
        $this->load->model('set_department_category_model');
        $this->load->model('set_designation_category_model');
        $this->load->model('set_shift_timing_model');
		$this->load->model('set_vat_model');
    }
	    
	public function index()
	{
		
		
	}

	public function company_master()
	{

		$data['company_master'] = 'menu';
		$data['content'] = "web/company/company_master";
		$this->load->view('web/template', $data);
		 
	}
	
	public function savecompanymaster(){
		
 
	    $company_id = $this->input->post("company_id");
	  
		$name = $this->input->post('name');
	    $email = $this->input->post('email');
		$landline = $this->input->post('landline');
		$mobile = $this->input->post('mobile');
	    $address = $this->input->post('address');
		$website = $this->input->post('website');
		$vat = $this->input->post('vat');
		$currencyused = $this->input->post('currencyused');
	    $locality = $this->input->post('locality');
		$pincode = $this->input->post('pincode');
		$status = 0;
		
		$source = '';
	   if(isset($_FILES['logo']['name']) && !empty($_FILES['logo']['name'])){
				            $config['upload_path']     = 'site/uploads';
				            $config['allowed_types']   = 'jpg|png|jpeg';
				            $config['file_name']       = rand().time();     


				            $this->load->library('upload', $config);
							
							
				         if ( ! $this->upload->do_upload('logo')){
                            } else{
				  
				             $data = array('upload_data' => $this->upload->data());
				           $source = $data['upload_data']['file_name'];
				        }
	   }
		
		
		//print_r($source);
		//exit();
			
		 if($company_id == ''){
		   $this->company_model->save_companymaster($name,$email,$landline,$mobile, $address,$source,$website,$vat,$currencyused,$locality,$pincode,$status);
		$this->session->set_flashdata("message","Company Master Created successfully.");
		}else{
			$this->company_model->update_companymaster($name,$email,$landline,$mobile, $address,$source,$website,$vat,$currencyused,$locality,$pincode,$company_id);
		$this->session->set_flashdata("message","Company Master Updated successfully.");
		}
	   
		     redirect('company/company_master_list');   
	}    	
	
	

	

	public function company_master_list()
	{
        $data['key'] = $this->company_model->company_list();
		$data['company_master_list'] = 'menu';
		$data['content'] = "web/company/company_master_list";
		$this->load->view('web/template', $data);
	}
	
    public function company_edit($company_id){
		
		$data['ghfyhfyhe'] = $this->company_model->edit_customer($company_id);
	    $data['content'] = "web/company/company_master";
		$this->load->view('web/template',$data);
	}
	public function company_view($company_id){
		
		$data['view'] = $this->company_model->view_company($company_id);

	    $data['content'] = "web/company/company_view";
		$this->load->view('web/template',$data);
	}
	
	  public function delete_companymaster($company_id) {

        $result = $this->company_model->delete_company($company_id);
      	$this->session->set_flashdata("delete_message","Deleted Successfully...");
       redirect('company/company_master_list'); 

	  }
	  
	  public function status_companymaster($company_id){
		 
          $key = $this->company_model->edit_customer($company_id);
		
		   if($key->status == 2){
		   $this->company_model->update_status('company', array('status'=> 1), array('company_id'=>$company_id));
		  
		   }else{
		  $this->company_model->update_status('company', array('status'=> 2), array('company_id'=>$company_id));
		   }
		    $this->session->set_flashdata("message","Status Changed Successfully...");
		redirect('company/company_master_list'); 
	}
	

	public function setting()
	{

		$data['setting'] = 'menu';

		$data['content'] = "web/setting/setting";

		$this->load->view('web/template', $data);
	}

	public function tax_master_form()
	{

		$data['tax_master_form'] = 'menu';

		$data['content'] = "web/taxmaster/tax_master_form";

		$this->load->view('web/template', $data);
	}
	
	//Attendance Master - Leave Category
	public function attendance_master()
	{
		$data['tax_master_form'] 	= 'menu';
		$data['content'] 			= "web/setting/attendance_master";
		$this->load->view('web/template', $data);
	}
	
	public function submit_leave_category(){
		$row_id	 = $this->input->post('row_id');
		
		$data_arr = array(
			'category_name' 	=> $this->input->post('category_name'),
			'category_value' 	=> $this->input->post('category_value'),
			'category_type' 	=> $this->input->post('category_type'),
			'category_status' 	=> $this->input->post('category_status'),
		);
		if(empty($row_id)){
			$data_arr['created_at'] = date('Y-m-d h:i:s');
			
			$this->common_model->insert('tbl_attendance_leave_category',$data_arr);
			$output = array(
				'status'	=> 'Success',
				'msg'		=> 'Leave Category Added Successfully',
			);
		}else{
			$data_arr['updated_at'] = date('Y-m-d h:i:s');
			
			$where = "id='$row_id'";
			$this->common_model->update('tbl_attendance_leave_category',$data_arr,$where);
			$output = array(
				'status'	=> 'Success',
				'msg'		=> 'Leave Category Updated Successfully',
			);
		}
		echo json_encode($output);
	}
	
	public function list_leave_category(){
		$data = $row = array();
		$memData 	= $this->set_leave_category_model->getRows($_POST);
		$i 			= $_POST['start'];
		
		foreach($memData as $member){
			$i++;
			
			$action=	"<button type='button' class='btn btn-info btn-sm edit_data' data-id='".$member->id."' data-name='".$member->category_name."' data-category_type='".$member->category_type."' data-value='".$member->category_value."' data-status='".$member->category_status."'><i class='fa fa-edit'></i></button>&nbsp;&nbsp;";
			$action.=	"<button type='button' class='btn btn-danger btn-sm delete_data' data-id='".$member->id."'><i class='fa fa-trash'></i></button>";
			
			$category_status = ($member->category_status=='Active')?'<span class="badge badge-success">Active</span>':'<span class="badge badge-danger">Inactive</span>';
			
			$category_type="";
			if($member->category_type==2){
				$category_type="Unpaid";
			}else if($member->category_type==1){
				$category_type="Paid";
			}
			
			$data[] = array($i, $member->category_name, $member->category_value, $category_type, $category_status, $action);
		}
		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->set_leave_category_model->countAll($_POST),
			"recordsFiltered" 	=> $this->set_leave_category_model->countFiltered($_POST),
			"data" 				=> $data,
		);
		echo json_encode($output);
	}
	
	public function delete_leave_category(){
		$row_id = $this->input->post('keys');
		
		$where = "id='$row_id'";
		$result = $this->common_model->delete('tbl_attendance_leave_category',$where);
		
		if($result==true){
			$output = array(
				'status'	=> 'Success',
				'msg'		=> 'Leave Category Deleted Successfully',
			);
		}else{
			$output = array(
				'status'	=> 'Warning',
				'msg'		=> 'Unable to Delete the Leave Category Details',
			);
		}
		echo json_encode($output);
	}
	
	//Salary Master - Earninings
	public function salary_master()
	{
		$data['tax_master_form'] 	= 'menu';
		$data['content'] 			= "web/setting/salary_master";
		$this->load->view('web/template', $data);
	}
	
	public function submit_salary_earninings(){
		$row_id	 = $this->input->post('earninings_row_id');
		
		$data_arr = array(
			'earninings_name' 		=> $this->input->post('earninings_name'),
			'earninings_percent' 	=> $this->input->post('earninings_percent'),
			'earninings_status' 	=> $this->input->post('earninings_status'),
		);
		if(empty($row_id)){
			$data_arr['created_at'] = date('Y-m-d h:i:s');
			
			$this->common_model->insert('tbl_salary_earninings',$data_arr);
			$output = array(
				'status'	=> 'Success',
				'msg'		=> 'Earninings Added Successfully',
			);
		}else{
			$data_arr['updated_at'] = date('Y-m-d h:i:s');
			
			$where = "id='$row_id'";
			$this->common_model->update('tbl_salary_earninings',$data_arr,$where);
			$output = array(
				'status'	=> 'Success',
				'msg'		=> 'Earninings Updated Successfully',
			);
		}
		echo json_encode($output);
	}
	
	public function list_salary_earninings(){
		$data = $row = array();
		$memData 	= $this->set_salary_earninings_model->getRows($_POST);
		$i 			= $_POST['start'];
		
		foreach($memData as $member){
			$i++;
			
			$action=	"<button type='button' class='btn btn-info btn-sm edit_earninings_data' data-id='".$member->id."' data-name='".$member->earninings_name."' data-percent='".$member->earninings_percent."' data-status='".$member->earninings_status."'><i class='fa fa-edit'></i></button>&nbsp;&nbsp;";
			$action.=	"<button type='button' class='btn btn-danger btn-sm delete_earninings_data' data-id='".$member->id."'><i class='fa fa-trash'></i></button>";
			
			$earninings_status = ($member->earninings_status=='Active')?'<span class="badge badge-success">Active</span>':'<span class="badge badge-danger">Inactive</span>';
			
			$data[] = array($i, $member->earninings_name, $member->earninings_percent, $earninings_status, $action);
		}
		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->set_salary_earninings_model->countAll($_POST),
			"recordsFiltered" 	=> $this->set_salary_earninings_model->countFiltered($_POST),
			"data" 				=> $data,
		);
		echo json_encode($output);
	}
	
	public function delete_salary_earninings(){
		$row_id = $this->input->post('keys');
		
		$where = "id='$row_id'";
		$result = $this->common_model->delete('tbl_salary_earninings',$where);
		
		if($result==true){
			$output = array(
				'status'	=> 'Success',
				'msg'		=> 'Earninings Deleted Successfully',
			);
		}else{
			$output = array(
				'status'	=> 'Warning',
				'msg'		=> 'Unable to Delete the Earninings Details',
			);
		}
		echo json_encode($output);
	}
	
	//Salary Master - Deduction
		public function submit_salary_deductions(){
		$row_id	 = $this->input->post('deductions_row_id');
		
		$data_arr = array(
			'deductions_name' 		=> $this->input->post('deductions_name'),
			'deductions_percent' 	=> $this->input->post('deductions_percent'),
			'deductions_status' 	=> $this->input->post('deductions_status'),
		);
		if(empty($row_id)){
			$data_arr['created_at'] = date('Y-m-d h:i:s');
			
			$this->common_model->insert('tbl_salary_deductions',$data_arr);
			$output = array(
				'status'	=> 'Success',
				'msg'		=> 'Deductions Added Successfully',
			);
		}else{
			$data_arr['updated_at'] = date('Y-m-d h:i:s');
			
			$where = "id='$row_id'";
			$this->common_model->update('tbl_salary_deductions',$data_arr,$where);
			$output = array(
				'status'	=> 'Success',
				'msg'		=> 'Deductions Updated Successfully',
			);
		}
		echo json_encode($output);
	}
	
	public function list_salary_deductions(){
		$data = $row = array();
		$memData 	= $this->set_salary_deductions_model->getRows($_POST);
		$i 			= $_POST['start'];
		
		foreach($memData as $member){
			$i++;
			$action=	"<button type='button' class='btn btn-info btn-sm edit_deductions_data' data-id='".$member->id."' data-name='".$member->deductions_name."' data-percent='".$member->deductions_percent."' data-status='".$member->deductions_status."'><i class='fa fa-edit'></i></button>&nbsp;&nbsp;";
			$action.=	"<button type='button' class='btn btn-danger btn-sm delete_deductions_data' data-id='".$member->id."'><i class='fa fa-trash'></i></button>";
			
			$deductions_status = ($member->deductions_status=='Active')?'<span class="badge badge-success">Active</span>':'<span class="badge badge-danger">Inactive</span>';
			
			$data[] = array($i, $member->deductions_name, $member->deductions_percent, $deductions_status, $action);
		}
		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->set_salary_deductions_model->countAll($_POST),
			"recordsFiltered" 	=> $this->set_salary_deductions_model->countFiltered($_POST),
			"data" 				=> $data,
		);
		echo json_encode($output);
	}
	
	public function delete_salary_deductions(){
		$row_id = $this->input->post('keys');
		
		$where = "id='$row_id'";
		$result = $this->common_model->delete('tbl_salary_deductions',$where);
		
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
	
	public function designation_master()
	{
		$data['designation_master'] 	= 'menu';
		$data['content'] 			= "web/company/designation_master";
		$this->load->view('web/template', $data);
	}
	
	public function submit_designation_category()
	{
		$row_id	 = $this->input->post('row_id');
		$data_arr = array(
			'designation_name' 		=> $this->input->post('designation_name'),
			'designation_status' 	=> $this->input->post('designation_status'),
		);

		if(empty($row_id)){
			$data_arr['created_at'] = date('Y-m-d h:i:s');
			
			$this->common_model->insert('tbl_desigantion_category',$data_arr);
			$output = array(
				'status'	=> 'Success',
				'msg'		=> 'Designation Category Added Successfully',
				);
		}else{
			$data_arr['updated_at'] = date('Y-m-d h:i:s');
			
			$where = "id='$row_id'";
			$this->common_model->update('tbl_desigantion_category',$data_arr,$where);
			$output = array(
				'status'	=> 'Success',
				'msg'		=> 'Designation Category Updated Successfully',
			);
		}
		echo json_encode($output);
	}

	public function list_designation_category(){
		$data = $row = array();
		$memData 	= $this->set_designation_category_model->getRows($_POST);
		$i 			= $_POST['start'];
	
		foreach($memData as $member){
			$i++;
			
			$action=	"<button type='button' class='btn btn-info btn-sm edit_data' data-id='".$member->id."' data-name='".$member->designation_name."' data-status='".$member->designation_status."'><i class='fa fa-edit'></i></button>&nbsp;&nbsp;";
			$action.=	"<button type='button' class='btn btn-danger btn-sm delete_data' data-id='".$member->id."'><i class='fa fa-trash'></i></button>";
			
			$designation_status = ($member->designation_status=='Active')?'<span class="badge badge-success">Active</span>':'<span class="badge badge-danger">Inactive</span>';
			
			$data[] = array($i, $member->designation_name,$designation_status, $action);
		}
		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->set_designation_category_model->countAll($_POST),
			"recordsFiltered" 	=> $this->set_designation_category_model->countFiltered($_POST),
			"data" 				=> $data,
		);
		echo json_encode($output);
	}
	
	public function delete_designation_category(){
		$row_id = $this->input->post('keys');
		
		$where = "id='$row_id'";
		$result = $this->common_model->delete('tbl_desigantion_category',$where);
		
		if($result==true){
			$output = array(
				'status'	=> 'Success',
				'msg'		=> 'Designation  Category Deleted Successfully',
			);
		}else{
			$output = array(
				'status'	=> 'Warning',
				'msg'		=> 'Unable to Delete the Designation Category Details',
			);
		}
		echo json_encode($output);
	}
	
	public function department_master()
	{
		$data['department_master'] = 'menu';
		$data['content'] = "web/company/department_master";
		$this->load->view('web/template', $data);
	}
	
	public function submit_department_category(){
		$row_id	 = $this->input->post('row_id');
		
		$data_arr = array(
			'department_name' 	=> $this->input->post('department_name'),
			'department_status' => $this->input->post('department_status'),
		);
		if(empty($row_id)){
			$data_arr['created_at'] = date('Y-m-d h:i:s');
			
			$this->common_model->insert('tbl_department_category',$data_arr);
			$output = array(
				'status'	=> 'Success',
				'msg'		=> 'Department Category Added Successfully',
			);
		}else{
			$data_arr['updated_at'] = date('Y-m-d h:i:s');
			
			$where = "id='$row_id'";
			$this->common_model->update('tbl_department_category',$data_arr,$where);
			$output = array(
				'status'	=> 'Success',
				'msg'		=> 'Department Category Updated Successfully',
			);
		}
		echo json_encode($output);
	}
	
	public function list_department_category(){
		$data = $row = array();
		$memData 	= $this->set_department_category_model->getRows($_POST);
		$i 			= $_POST['start'];
		
		foreach($memData as $member){
			$i++;
			
			$action=	"<button type='button' class='btn btn-info btn-sm edit_data' data-id='".$member->id."' data-name='".$member->department_name."' data-status='".$member->department_status."'><i class='fa fa-edit'></i></button>&nbsp;&nbsp;";
			$action.=	"<button type='button' class='btn btn-danger btn-sm delete_data' data-id='".$member->id."'><i class='fa fa-trash'></i></button>";
			
			$department_status = ($member->department_status=='Active')?'<span class="badge badge-success">Active</span>':'<span class="badge badge-danger">Inactive</span>';
			
			$data[] = array($i, $member->department_name, $department_status, $action);
		}
		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->set_department_category_model->countAll($_POST),
			"recordsFiltered" 	=> $this->set_department_category_model->countFiltered($_POST),
			"data" 				=> $data,
		);
		echo json_encode($output);
	}

	public function delete_department_category(){
		$row_id = $this->input->post('keys');
		
		$where = "id='$row_id'";
		$result = $this->common_model->delete('tbl_department_category',$where);
		
		if($result==true){
			$output = array(
				'status'	=> 'Success',
				'msg'		=> 'Leave Category Deleted Successfully',
			);
		}else{
			$output = array(
				'status'	=> 'Warning',
				'msg'		=> 'Unable to Delete the Leave Category Details',
			);
		}
		echo json_encode($output);
	}
	
	
	
		public function shift_timing_master()
	{
		$data['shift_timing_master'] = 'menu';
		$data['content'] = "web/setting/shift_timing_master";
		$this->load->view('web/template', $data);
	}
	
	public function submit_shift_timing_category(){
		$row_id	 = $this->input->post('row_id');
		
		$data_arr = array(
			'shift_name' 	=> $this->input->post('shift_name'),
			'shift_in_time' 	=> $this->input->post('shift_in_time'),
			'shift_out_time' 	=> $this->input->post('shift_out_time'),
			'shift_status' => $this->input->post('shift_status'),
		);
		if(empty($row_id)){
			$data_arr['created_at'] = date('Y-m-d h:i:s');
			
			$this->common_model->insert('tbl_shift_timing_master',$data_arr);
			$output = array(
				'status'	=> 'Success',
				'msg'		=> 'Shift Timing Added Successfully',
			);
		}else{
			$data_arr['updated_at'] = date('Y-m-d h:i:s');
			
			$where = "id='$row_id'";
			$this->common_model->update('tbl_shift_timing_master',$data_arr,$where);
			$output = array(
				'status'	=> 'Success',
				'msg'		=> 'Shift Timing Updated Successfully',
			);
		}
		echo json_encode($output);
	}
	
	public function list_shift_timing_category(){
		$data = $row = array();
		$memData 	= $this->set_shift_timing_model->getRows($_POST);
		$i 			= $_POST['start'];
		
		foreach($memData as $member){
			$i++;
			
			$action=	"<button type='button' class='btn btn-info btn-sm edit_data' data-id='".$member->id."' data-name='".$member->shift_name."' 
			data-in='".$member->shift_in_time."' data-out='".$member->shift_out_time."'
			data-status='".$member->shift_status."'><i class='fa fa-edit'></i></button>&nbsp;&nbsp;";
			$action.=	"<button type='button' class='btn btn-danger btn-sm delete_data' data-id='".$member->id."'><i class='fa fa-trash'></i></button>";
			
			$shift_status = ($member->shift_status=='Active')?'<span class="badge badge-success">Active</span>':'<span class="badge badge-danger">Inactive</span>';
			
			$data[] = array($i, $member->shift_name,$member->shift_in_time,$member->shift_out_time, $shift_status, $action);
		}
		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->set_shift_timing_model->countAll($_POST),
			"recordsFiltered" 	=> $this->set_shift_timing_model->countFiltered($_POST),
			"data" 				=> $data,
		);
		echo json_encode($output);
	}

	public function delete_shift_timing_category(){
		$row_id = $this->input->post('keys');
		
		$where = "id='$row_id'";
		$result = $this->common_model->delete('tbl_shift_timing_master',$where);
		
		if($result==true){
			$output = array(
				'status'	=> 'Success',
				'msg'		=> 'Shift Timing Deleted Successfully',
			);
		}else{
			$output = array(
				'status'	=> 'Warning',
				'msg'		=> 'Unable to Delete Shift timing Details',
			);
		}
		echo json_encode($output);
	}
	


	public function vat_master()
	{

		$data['vat_master'] = 'menu';

		$data['content'] = "web/vatmaster/vat_master";

		$this->load->view('web/template', $data);
	}

	
	
	public function submit_vat(){
		$row_id	 = $this->input->post('row_id');
		
		$data_arr = array(
			'vat_code' 	=> $this->input->post('vat_code'),
			'percentage' 	=> $this->input->post('percentage'),
			'description' 	=> $this->input->post('description'),
			'vat_status' => $this->input->post('vat_status'),
		);
		if(empty($row_id)){
			$data_arr['created_at'] = date('Y-m-d h:i:s');
			
			$this->common_model->insert('tbl_vat_master',$data_arr);
			$output = array(
				'status'	=> 'Success',
				'msg'		=> 'VAT Category Added Successfully',
			);
		}else{
			$data_arr['updated_at'] = date('Y-m-d h:i:s');
			
			$where = "id='$row_id'";
			$this->common_model->update('tbl_vat_master',$data_arr,$where);
			$output = array(
				'status'	=> 'Success',
				'msg'		=> 'VAT Category Updated Successfully',
			);
		}
		echo json_encode($output);
	}
	
	public function list_vat(){
		$data = $row = array();
		$memData 	= $this->set_vat_model->getRows($_POST);
		$i 			= $_POST['start'];
		
		foreach($memData as $member){
			$i++;
			
			$action=	"<button type='button' class='btn btn-info btn-sm edit_data' data-id='".$member->id."' data-code='".$member->vat_code."' data-percent='".$member->percentage."' data-descrip='".$member->description."'data-status='".$member->vat_status."'><i class='fa fa-edit'></i></button>&nbsp;&nbsp;";
			$action.=	"<button type='button' class='btn btn-danger btn-sm delete_data' data-id='".$member->id."'><i class='fa fa-trash'></i></button>";
			
			$vat_status = ($member->vat_status=='Active')?'<span class="badge badge-success">Active</span>':'<span class="badge badge-danger">Inactive</span>';
			
			$data[] = array($i, $member->vat_code,$member->description,$member->percentage, $vat_status, $action);
		}
		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->set_vat_model->countAll($_POST),
			"recordsFiltered" 	=> $this->set_vat_model->countFiltered($_POST),
			"data" 				=> $data,
		);
		echo json_encode($output);
	}

	public function delete_vat(){
		$row_id = $this->input->post('keys');
		
		$where = "id='$row_id'";
		$result = $this->common_model->delete('tbl_vat_master',$where);
		
		if($result==true){
			$output = array(
				'status'	=> 'Success',
				'msg'		=> 'VAT Category Deleted Successfully',
			);
		}else{
			$output = array(
				'status'	=> 'Warning',
				'msg'		=> 'Unable to Delete the Leave Category Details',
			);
		}
		echo json_encode($output);
	}
	
    public function financialyear()
	{
		$data['financialyear'] = 'menu';
		$data['content'] = "web/company/financialyear";
		$company_id = get_customercompanyid();		
		$data['financialyear'] = $this->common_model->get_records("financialyear","*",array("company_id"=>$company_id,"status != "=>2));	
		$this->load->view('web/template',$data);
	}
	
	public function savefinancialyear(){
		$this->form_validation->set_rules('startdate', 'startdate', 'trim|required');
        $this->form_validation->set_rules('enddate', 'startdate', 'trim|required');

        if ($this->form_validation->run() == FALSE){			
			$company_id = get_customercompanyid();		
			$data['content'] = "web/company/financialyear";	
			$data['financialyear'] = $this->common_model->get_records("financialyear","*",array("company_id"=>$company_id));	
			$this->load->view('web/template',$data);
		}else{
			$values['company_id'] = get_customercompanyid();	
			$values['startyear'] = date("Y",strtotime(trim(strip_tags($this->input->post('startdate')))));
			$values['endyear'] = date("Y",strtotime(trim(strip_tags($this->input->post('enddate')))));
			
				$values['status'] = 0;
				$yearid = trim(strip_tags($this->input->post('yearid')));
				$exists = $this->common_model->get_record("financialyear","*",$values);
				
				$values['startdate'] = date("Y-m-d",strtotime(trim(strip_tags($this->input->post('startdate')))));
				$values['enddate'] = date("Y-m-d",strtotime(trim(strip_tags($this->input->post('enddate')))));		
				if(empty($exists) && !$yearid){		
					
					$values['createdTime'] = date("Y-m-d H:i:s");
					$this->common_model->insert("financialyear",$values);
					$this->session->set_flashdata("financial_created","Financial Year Created Successfuly");					
				}elseif(!empty($exists) && $yearid){
					$where['yearid'] = $yearid;
					
					$values['modifiedTime'] = date("Y-m-d H:i:s");
					$this->common_model->update("financialyear",$values,$where);
					$this->session->set_flashdata("financial_created","Financial Year Updated Successfuly");
				}elseif(empty($exists) && $yearid){
					$where['yearid'] = $yearid;
					
					$values['modifiedTime'] = date("Y-m-d H:i:s");
					$this->common_model->update("financialyear",$values,$where);
					$this->session->set_flashdata("financial_created","Financial Year Updated Successfuly");
				}			
				else{
					$this->session->set_flashdata("financial_created","Financial Year already Exists");			
				}
			
		}
		
		redirect('company/financialyear');
	}
	
	
	public function get_yeardetails(){
		$values['yearid'] = trim(strip_tags($this->input->post('yearid')));			
		$exists = $this->common_model->get_record("financialyear","*",$values);
		$exists->startdate = date("d-m-Y",strtotime($exists->startdate));
		$exists->enddate = date("d-m-Y",strtotime($exists->enddate));
		echo json_encode($exists);
	}
	
	public function yearstatus($id){
		if($id){
			$changestatus = $this->common_model->get_record("financialyear","*",array("status != "=>2,'yearid'=>$id));
			if(count($changestatus)){
				$where['yearid'] = $id;
				if($changestatus->status == 0){
					$values['status'] = 1;
				}else{
					$values['status'] = 0;
				}
				
				$values['modifiedTime'] = date("Y-m-d H:i:s");
				$this->common_model->update_record("financialyear",$values,$where);
				$this->session->set_flashdata("financial_created","Financial Year Status Changed Successfuly");
			}
			redirect("company/financialyear");
		}else{
			redirect("company/financialyear");
		}
	}
	
	public function deleteyear($id=''){
		if($id){
			$changestatus = $this->common_model->get_record("financialyear","*",array("status != "=>2,'yearid'=>$id));
			if(count($changestatus)){
				$where['yearid'] = $id;
				$values['status'] = 2;
				$values['modifiedTime'] = date("Y-m-d H:i:s");
				$this->common_model->update_record("financialyear",$values,$where);
				$this->session->set_flashdata("financial_created","Financial Year Deleted Successfuly");
			}
			redirect("company/financialyear");
		}else{
			redirect("company/financialyear");
		}
	}
	//Financial Year Master
	
}
