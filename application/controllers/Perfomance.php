<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Perfomance extends CI_Controller
{
	public function __construct(){
        parent::__construct();
        $this->load->model('common_model');
        $this->load->model('Employee_perform_model');
        $this->load->model('Set_employee_perform_model');

	
       
    }
	
	
	public function employee_perform()
	{
		$data['employee_perform'] = 'menu';
		$data['department'] = $this->Employee_perform_model->get_employee_details();
        $data['designation'] = $this->Employee_perform_model->get_employee_details();
		
		$data['content'] = "web/employee_perform/employee_perform";
		$this->load->view('web/template', $data);
	}
	
	public function employee_perform_list()
	{
		$data['employee_perform_list'] = 'menu';
		
		$data['content'] = "web/employee_perform/employee_perform_list";
		$this->load->view('web/template', $data);
	}
	
	
	public function employee_perform_views($row_id)
	{
		$data['employee_perform'] = 'menu';
		$data['department'] = $this->Employee_perform_model->get_employee_details();
		$data['edit'] = $this->Employee_perform_model->get_edit_employee($row_id);
		$data['content'] = "web/employee_perform/employee_perform";
		$this->load->view('web/template', $data);
	}
	
	
	public function employee_perform_view($row_id)
	{
		$data['employee_perform_view'] = 'menu';
		$data['department'] = $this->Employee_perform_model->get_employee_details();
		$data['view'] = $this->Employee_perform_model->employee_view($row_id);
		$data['content'] = "web/employee_perform/employee_perform_view";
		$this->load->view('web/template', $data);
	}
	
	
	
	
	public function submit_employee_perform(){
		
		$row_id	 = $this->input->post('row_id');
		
		$date_of_review = date("Y-m-d", strtotime($this->input->post('date_of_review')));
		
		$data_arr = array(
			'employee_id' 	=> $this->input->post('employee_id'),
			'date_of_review '	=> $date_of_review,
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
		);
		
		if(empty($row_id)){
			$data_arr['created_at'] = date('Y-m-d h:i:s');
				
			$this->common_model->insert('tbl_employee_performance',$data_arr);
			$output = array(
				'status'	=> 'Success',
				'msg'		=> 'Employee Perform Type Added Successfully',
			);
		}else{
			$data_arr['updated_at'] = date('Y-m-d h:i:s');
			
			$where = "id='$row_id'";
			$this->common_model->update('tbl_employee_performance',$data_arr,$where);
			$output = array(
				'status'	=> 'Success',
				'msg'		=> 'Employee Perform Type Updated Successfully',
			);
		}
		echo json_encode($output);
	}
	
	
	
	
	
	public function list_employee_perform(){
		$data = $row = array();
		$memData 	= $this->Set_employee_perform_model->getRows($_POST);
		$i 			= $_POST['start'];
		
		
		foreach($memData as $member){
			$i++;
			$link = base_url().'employee_perform_views/'.$member->perform_id;
			$links = base_url().'employee_perform_view/'.$member->perform_id;
			
			$action=	"<a href='".$link."' class='btn btn-info btn-sm edit_data'
			data-id='".$member->perform_id."' data-name='".$member->employee_id."' data-review='".$member->date_of_review."'data-period='".$member->review_period."' data-manager='".$member->line_manager."' 
			data-knowledge='".$member->job_knowledge_rating."'  data-job='".$member->job_knowledge_comments."' 
			data-punctuality='".$member->attendance_punctuality_rating."' data-attendance='".$member->attendance_punctuality_comments."' 
			data-takes='".$member->takes_initiative_rating."' data-initiative='".$member->takes_initiative_comments."' 
			data-communication='".$member->communication_listening_rating."' data-listening='".$member->communication_listening_comments."' 
			data-dependability='".$member->dependability_rating."' data-comments='".$member->dependability_comments."' 
			data-overall='".$member->overall_rating."' data-status='".$member->employee_status."'><i class='fa fa-edit'></i></a>&nbsp;&nbsp;";
			$action.=	"<button type='button' class='btn btn-danger btn-sm delete_data' data-id='".$member->perform_id."'><i class='fa fa-trash'></i></button>";
			
			
			$action.=	"<a href='".$links."' class='btn btn-info btn-sm edit_data'
			data-id='".$member->perform_id."' data-name='".$member->employee_id."' data-review='".$member->date_of_review."'data-period='".$member->review_period."' data-manager='".$member->line_manager."' 
			data-knowledge='".$member->job_knowledge_rating."'  data-job='".$member->job_knowledge_comments."' 
			data-punctuality='".$member->attendance_punctuality_rating."' data-attendance='".$member->attendance_punctuality_comments."' 
			data-takes='".$member->takes_initiative_rating."' data-initiative='".$member->takes_initiative_comments."' 
			data-communication='".$member->communication_listening_rating."' data-listening='".$member->communication_listening_comments."' 
			data-dependability='".$member->dependability_rating."' data-comments='".$member->dependability_comments."' 
			data-overall='".$member->overall_rating."' data-status='".$member->employee_status."'><i class='fa fa-eye'></i></a>&nbsp;&nbsp;";
			
			//$employee_status = ($member->employee_status=='Active')?'<span class="badge badge-success">Active</span>':'<span class="badge badge-danger">Inactive</span>';
			
			$data[] = array($i, $member->employeename,$member->designation_name,$member->department_name,$member->date_of_review,$member->review_period,$member->line_manager,$member->overall_rating."/5", $action);
			
			
			
		}
		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->Set_employee_perform_model->countAll($_POST),
			"recordsFiltered" 	=> $this->Set_employee_perform_model->countFiltered($_POST),
			"data" 				=> $data,
		);
		echo json_encode($output);
	}

	public function delete_employee_perform(){
		$row_id = $this->input->post('keys');
		
		$where = "id='$row_id'";
		$result = $this->common_model->delete('tbl_employee_performance',$where);
		
		if($result==true){
			$output = array(
				'status'	=> 'Success',
				'msg'		=> 'Employee Perform Deleted Successfully',
			);
		}else{
			$output = array(
				'status'	=> 'Warning',
				'msg'		=> 'Unable to Delete the Employee Perform Details',
			);
		}
		echo json_encode($output);
	}

	
	
	}
