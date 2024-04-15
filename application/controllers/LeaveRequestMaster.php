<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LeaveRequestMaster extends CI_Controller
{
	public function __construct(){
        parent::__construct();
        $this->load->model('leave_request_model');
		$this->load->model('list_leave_model');
    }
	
	public function request_master(){		
		$data['page_title'] = "Leave Request Master";
		$data['content'] 	= "web/hr_module/leave_request";
		
		 $data['leave_request_master']  = $this->db->select('*')->where('request_status','1')->get('tbl_leave_request_master')->result_array();
		
		$data['list_employee'] 			= $this->db->select('*')->get('employee')->result_array();
		$data['list_leave_category'] 	= $this->db->select('*')->where('category_status', 'Active')->get('tbl_attendance_leave_category')->result_array();
		
		$this->load->view('web/template', $data);
	}
	
	public function approve_master(){		
		$data['page_title'] = "Leave Approve Master";
		$data['content'] 	= "web/hr_module/leave_approve";
		
		$data['list_employee'] 			= $this->db->select('*')->get('employee')->result_array();
		$data['list_leave_category'] 	= $this->db->select('*')->where('category_status', 'Active')->get('tbl_attendance_leave_category')->result_array();
		
		$this->load->view('web/template', $data);
	}
	
	public function submit_leave_request(){
		$row_id			= $this->input->post('row_id');
		
		$start_date 	= (!empty($this->input->post('request_start_date')))?date('Y-m-d',strtotime($this->input->post('request_start_date'))):'';
		$end_date 		= (!empty($this->input->post('request_end_date')))?date('Y-m-d',strtotime($this->input->post('request_end_date'))):'';
		if($start_date<=$end_date){
			$data_arr = array(
				'request_emp_id' 			=> $this->input->post('request_emp_id'),
				'request_leave_category' 	=> $this->input->post('request_leave_category'),
				'request_leave_type' 		=> $this->input->post('request_leave_type'),
				'request_start_date' 		=> $start_date,
				'request_end_date' 			=> $end_date,
				'request_reason' 			=> $this->input->post('request_reason'),
			);
			
			$test_con 	 = 0;
			$small_image = "";
			if(isset($_FILES["request_attachment"]["name"]) && !empty($_FILES["request_attachment"]["name"])){
				$image_info = getimagesize($_FILES["request_attachment"]["tmp_name"]);
				$image_width = $image_info[0];
				$image_height = $image_info[1];
				$imageData1['imageName']='request_attachment';
				$imageData1['imageWidth']=$image_width;
				$imageData1['imageHeight']=$image_height;
				$imageData1['prefWidth']=$image_width;
				$imageData1['prefHeight']=$image_height;
				$extension = pathinfo($_FILES["request_attachment"]["name"], PATHINFO_EXTENSION);
				$filename = pathinfo($_FILES['request_attachment']['name'], PATHINFO_FILENAME);
				
				$config['upload_path']    = LEAVE_REQUEST_IMG_PATH;
				$config['allowed_types']  = 'jpg|jpeg|png|webp|JPG|JPEG|PNG|WEBP';
				$config['file_name']      = $filename.rand() . '_' . date('YmdHis') . "." . $extension;	
				$this->load->library('upload', $config);
				if(!$this->upload->do_upload('request_attachment')){
					$test_con   = 1;
					$error      = $this->upload->display_errors();
				}else{
					$data           = array('upload_data' => $this->upload->data());
					$test_con       = 0;
					$data_arr['request_attachment']    = $data['upload_data']['file_name'];
				}
			}
			
			if($test_con==0){
				if(empty($row_id)){
					$data_arr['created_at'] 		= date('Y-m-d h:i:s');
					$data_arr['request_created_by'] = $this->session->userdata('user_id');
					
					$this->common_model->insert('tbl_leave_request_master',$data_arr);
					$output = array(
						'status'	=> 'Success',
						'msg'		=> 'Leave Request Applied Successfully',
					);
				}else{
					$data_arr['updated_at'] = date('Y-m-d h:i:s');
					
					$where = "id='$row_id'";
					$this->common_model->update('tbl_leave_request_master',$data_arr,$where);
					$output = array(
						'status'	=> 'Success',
						'msg'		=> 'Leave Request Applied Updated Successfully',
					);
				}
			}else{
				$output = array(
					'status'	=> 'Error',
					'msg'		=> 'Attachment Upload Image has Invaild Format',
				);
			}
		}else{
			$output = array(
				'status'	=> 'Error',
				'msg'		=> 'Invaild From Date & To Date Selected',
			);
		}
		echo json_encode($output);
	}
	
	public function list_leave_approve(){
		$data = $row = array();
		$memData 	= $this->leave_request_model->getRows($_POST);
		$i 			= $_POST['start'];
		
		foreach($memData as $member){
			$i++;
			
			$img_path = "";
			if(!empty($member->request_attachment)){
				$path = base_url().LEAVE_REQUEST_IMG_PATH."/".$member->request_attachment;
				$img_path = '<img src="'.$path.'" />';
			}
			
			$action=	"<button type='button' class='btn btn-info btn-sm leave_approve_request' data-id='".$member->id."' data-emp='".$member->request_emp_id."' data-category='".$member->request_leave_category."' data-type='".$member->request_leave_type."' data-start='".$member->request_start_date."' data-end='".$member->request_end_date."' data-reason='".$member->request_reason."' data-img='".$img_path."'><i class='fa fa-thumbs-up'></i></button>&nbsp;&nbsp;";
			$action.=	"<button type='button' class='btn btn-danger btn-sm leave_reject_request' data-id='".$member->id."'><i class='fa fa-thumbs-down'></i></button>";
			
			$leave_days = '1 Day';
			if($member->request_start_date!=$member->request_end_date){
				$from_date 	= strtotime($member->request_start_date);
				$to_date 	= strtotime($member->request_end_date);
				$datediff 	= $to_date - $from_date;
				$leave_days = round($datediff / (60 * 60 * 24))." Days";
			}
			
			$start_date = date('d-m-Y',strtotime($member->request_start_date));
			$end_date 	= date('d-m-Y',strtotime($member->request_end_date));
			
			$data[] = array($i, $member->employeename, $member->category_name, $leave_days, $start_date, $end_date, $action);
		}
		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->leave_request_model->countAll($_POST),
			"recordsFiltered" 	=> $this->leave_request_model->countFiltered($_POST),
			"data" 				=> $data,
		);
		echo json_encode($output);
	}
	
	public function list_leave_request(){
		$data = $row = array();
		$memData 	= $this->leave_request_model->getRows($_POST);
		$i 			= $_POST['start'];
		
		foreach($memData as $member){
			$i++;
			
			$img_path = "";
			if(!empty($member->request_attachment)){
				$path = base_url().LEAVE_REQUEST_IMG_PATH."/".$member->request_attachment;
				$img_path = '<img src="'.$path.'" />';
			}
			
			$action = "";
			if($member->request_status==0){
				$action.= "<button type='button' class='btn btn-info btn-sm edit_data' data-id='".$member->id."' data-emp='".$member->request_emp_id."' data-category='".$member->request_leave_category."' data-type='".$member->request_leave_type."' data-start='".$member->request_start_date."' data-end='".$member->request_end_date."' data-reason='".$member->request_reason."' data-img='".$img_path."'><i class='fa fa-edit'></i></button>&nbsp;&nbsp;";
				$action.= "<button type='button' class='btn btn-danger btn-sm delete_data' data-id='".$member->id."'><i class='fa fa-trash'></i></button>";
			}else{
				$action = ($member->request_status==1)?'<span class="badge badge-success">Approved</span>':'<span class="badge badge-danger">Rejected</span>';
			}
			
			$leave_type = ($member->request_leave_type==1)?'Single':'Multiple';
			$start_date = date('d-m-Y',strtotime($member->request_start_date));
			$end_date 	= date('d-m-Y',strtotime($member->request_end_date));
			
			$data[] = array($i, $member->category_name, $leave_type, $start_date, $end_date, $action);
		}
		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->leave_request_model->countAll($_POST),
			"recordsFiltered" 	=> $this->leave_request_model->countFiltered($_POST),
			"data" 				=> $data,
		);
		echo json_encode($output);
	}
	
	public function delete_leave_request(){
		$row_id = $this->input->post("keys");
		$data	= $this->db->select('*')->where('id', $row_id)->get('tbl_leave_request_master')->row();
		
		if(!empty($data)){
			if(!empty($data->request_attachment)){
				$old_img1 = LEAVE_REQUEST_IMG_PATH."/".$data->request_attachment;
				if(file_exists($old_img1)){
					unlink($old_img1);
				}
			}
			
			$where = "id='$row_id'";
			$this->common_model->delete('tbl_leave_request_master',$where);
			$output = array(
				'status'	=> 'Success',
				'msg'		=> 'Leave Request Deleted Successfully',
			);
		}else{
			$output = array(
				'status'	=> 'Error',
				'msg'		=> 'Unable to Delete Leave Request',
			);
		}
		echo json_encode($output);
	}
	
	public function approve_leave_request(){
		$row_id = $this->input->post('keys');
		$data	= $this->db->select('*')->where('id', $row_id)->get('tbl_leave_request_master')->row();
		if(!empty($data)){
			$data_arr['request_status'] = 1;
			$where = "id='$row_id'";
			$this->common_model->update('tbl_leave_request_master',$data_arr,$where);
			$output = array(
				'status'	=> 'Success',
				'msg'		=> 'Leave Request Approved Successfully',
			);
		}else{
			$output = array(
				'status'	=> 'Error',
				'msg'		=> 'Invaild Leave Request',
			);
		}
		echo json_encode($output);
	}
	
	public function reject_leave_request(){
		$row_id = $this->input->post('keys');
		$data	= $this->db->select('*')->where('id', $row_id)->get('tbl_leave_request_master')->row();
		if(!empty($data)){
			$data_arr['request_status'] = 2;
			$where = "id='$row_id'";
			$this->common_model->update('tbl_leave_request_master',$data_arr,$where);
			$output = array(
				'status'	=> 'Success',
				'msg'		=> 'Leave Request Rejected Successfully',
			);
		}else{
			$output = array(
				'status'	=> 'Error',
				'msg'		=> 'Invaild Leave Request',
			);
		}
		echo json_encode($output);
	}
	
	public function leave_settings(){	
	
		$data['page_title'] = "Leave setting";
		
		$data['content'] 	= "web/leave_settings";
	
		$this->load->view('web/template', $data);
	}
	
	
		
	
	public function leave_setting()
	{

		$data['leave_setting'] = 'menu';

		$data['content'] = "web/leave_setting";
       $data['employees'] = $this->Hr_model->get_loan_name();
		$this->load->view('web/template', $data);
	}
	

	
	public function submit_leave_setting(){
		$row_id	 = $this->input->post('row_id');
		
		$data_arr = array(
			'employee_id' 			=> $this->input->post('employee_id'),
			'rate_type' 		=> $this->input->post('rate_type'),
			'rate' 		=> $this->input->post('rate'),
			'total_hours' 			=> $this->input->post('total_hours'),
			'amount' 			=> $this->input->post('amount'),
			'ot_status' 			=> $this->input->post('ot_status'),
		);
		if(empty($row_id)){
			
			$data_arr['created_at'] = date('Y-m-d h:i:s');
			
			$this->common_model->insert('tbl_ot_time',$data_arr);
			$output = array(
				'status'	=> 'Success',
				'msg'		=> 'OT Added Successfully',
			);
		}else{
			$data_arr['created_by'] = date('Y-m-d h:i:s');
			
			$where = "id='$row_id'";
			$this->common_model->update('tbl_ot_time',$data_arr,$where);
			$output = array(
				'status'	=> 'Success',
				'msg'		=> 'OT Updated Successfully',
			);
		}
		echo json_encode($output);
	}
	
	public function list_leave_setting(){
		$data = $row = array();
		$memData 	= $this->list_leave_model->getRows($_POST);
		$i 			= $_POST['start'];
		
		foreach($memData as $member){
			$i++;
			
			
			$action = "<button type='button' class='btn btn-info btn-sm edit_data' data-id='".$member->id."' data-empid='".$member->employee_id."' data-type='".$member->rate_type."' data-rat='".$member->rate."' data-total='".$member->total_hours."' data-amt'".$member->amount."' data-status='".$member->ot_status."'><i class='fa fa-edit'></i></button>&nbsp;&nbsp;";
			
			$action.= "<button type='button' class='btn btn-danger btn-sm delete_data' data-id='".$member->id."'><i class='fa fa-trash'></i></button>&nbsp;&nbsp;";
		
			
			$ot_status = ($member->ot_status=='Active')?'<span class="badge badge-success">Active</span>':'<span class="badge badge-danger">Inactive</span>';
			
			
			$data[] = array($i,$member->employeename,$member->rate_type,$member->rate , $member->total_hours,$member->amount, $ot_status, $action);
		}
		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->list_leave_model->countAll($_POST),
			"recordsFiltered" 	=> $this->list_leave_model->countFiltered($_POST),
			"data" 				=> $data,
		);
		echo json_encode($output);
	}
	
	public function delete_leave_setting(){
		$row_id = $this->input->post('keys');
		
		$where = "id='$row_id'";
		$result = $this->common_model->delete('tbl_ot_time',$where);
		
		if($result==true){
			$output = array(
				'status'	=> 'Success',
				'msg'		=> 'leave setting Deleted Successfully',
			);
		}else{
			$output = array(
				'status'	=> 'Warning',
				'msg'		=> 'Unable to Delete leave setting Details',
			);
		}
		echo json_encode($output);
	}
	
	
	
}
?>