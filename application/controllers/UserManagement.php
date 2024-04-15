<?php
defined('BASEPATH') or exit('No direct script access allowed');
class UserManagement extends CI_Controller
{
	public function __construct(){
        parent::__construct();
        $this->load->model('user_account_master_model');
        $this->load->model('user_model');
    }
	
	public function index(){
		$data['content'] = "web/users_master/users";
		$this->load->view('web/template', $data);
	}
	
	public function submit_users(){
		$row_id	 = $this->input->post('user_row_id');
		
		$password 			= $this->input->post('password');
		$confirm_password 	= $this->input->post('confirm_password');
		$data_arr = array(
			'firstname'  	=> $this->input->post('firstname'),
			'lastname' 	 	=> $this->input->post('lastname'),
			'username' 	 	=> $this->input->post('username'),
			'email' 	 	=> $this->input->post('email'),
			'mobile' 	 	=> $this->input->post('mobile'),
			'user_role'  	=> $this->input->post('user_role'),
			'user_admin'  	=> 0,
			'status'  	 	=> $this->input->post('status'),
		);
		
		$old_data1 = $this->db->select('*')->where('username',$this->input->post('username'))->get('user')->row();
		$old_data2 = $this->db->select('*')->where('email',$this->input->post('email'))->get('user')->row();
		$old_data3 = $this->db->select('*')->where('mobile',$this->input->post('mobile'))->get('user')->row();
		
		$test_con = 0;
		if(($password!=$confirm_password) && ($password!="") && ($confirm_password!="")){
			$output = array(
				'status'	=> 'Error',
				'msg'		=> 'Password Mismatch',
			);
		}else{
			
			if(!empty($password)){
				$password = password_hash($password,PASSWORD_BCRYPT);
				$data_arr['password'] = $password;
			}
			
			if(empty($row_id)){
				if(!empty($old_data1)){
					$test_con = 1;
				}else if(!empty($old_data2)){
					$test_con = 2;
				}else if(!empty($old_data3)){
					$test_con = 3;
				}else{
					$data_arr['created_at'] = date('Y-m-d h:i:s');				
					$this->common_model->insert('user',$data_arr);
					$output = array(
						'status'	=> 'Success',
						'msg'		=> 'User Added Successfully',
					);
				}
			}else{
				if($old_data1->user_id!=$row_id){
					$test_con = 1;
				}
				
				if($old_data2->user_id!=$row_id){
					$test_con = 2;
				}
				
				if($old_data3->user_id!=$row_id){
					$test_con = 3;
				}
				
				if($test_con==0){
					$data_arr['updated_at'] = date('Y-m-d h:i:s');
					
					$where = "user_id='$row_id'";
					$this->common_model->update('user',$data_arr,$where);
					$output = array(
						'status'	=> 'Success',
						'msg'		=> 'User Updated Successfully',
					);
				}
			}
		}
		
		if($test_con==1){
			$output = array(
				'status'	=> 'Error',
				'msg'		=> 'Username Already Added',
			);
		}
		
		if($test_con==2){
			$output = array(
				'status'	=> 'Error',
				'msg'		=> 'Email Address Already Added',
			);
		}
		
		if($test_con==3){
			$output = array(
				'status'	=> 'Error',
				'msg'		=> 'Mobile No Already Added',
			);
		}
		echo json_encode($output);
	}
	
	public function list_users(){
		$data 		= array();
		$memData 	= $this->user_model->getRows($_POST);
		$i 			= $_POST['start'];
		
		foreach($memData as $member){
			$i++;
			
			$action = "<button type='button' class='btn btn-info btn-sm edit_user' data-id='".$member->user_id."' data-firstname='".$member->firstname."' data-lastname='".$member->lastname."' data-username='".$member->username."' data-email='".$member->email."' data-mobile='".$member->mobile."' data-user_role='".$member->user_role."' data-status='".$member->status."'><i class='fa fa-edit'></i></button>&nbsp;&nbsp;";
			$action.= "<button type='button' class='btn btn-danger btn-sm delete_user' data-id='".$member->user_id."'><i class='fa fa-trash'></i></button>&nbsp;&nbsp;";
			$action.= "<button type='button' class='btn btn-primary btn-sm pass_user' data-id='".$member->user_id."'><i class='fa fa-key'></i></button>";
			
			$status = ($member->status=='1')?'<span class="badge badge-success">Active</span>':'<span class="badge badge-danger">Inactive</span>';
			$full_name = $member->firstname." ".$member->lastname;
			
			$data[] = array($i, $full_name, $member->username, $member->email, $member->mobile, $member->account_name, $status, $action);
		}
		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->user_model->countAll($_POST),
			"recordsFiltered" 	=> $this->user_model->countFiltered($_POST),
			"data" 				=> $data,
		);
		echo json_encode($output);
	}
	
		public function delete_user_category(){
		$row_id = $this->input->post('keys');
		
		$where = "user_id='$row_id'";
		$result = $this->common_model->delete('user',$where);
		
		if($result==true){
			$output = array(
				'status'	=> 'Success',
				'msg'		=> 'user  Deleted Successfully',
			);
		}else{
			$output = array(
				'status'	=> 'Warning',
				'msg'		=> 'Unable to Delete user Details',
			);
		}
		echo json_encode($output);
	}
	
	
	public function check_permission(){
		
		$this->load->model('Common_model');
		
		$id = $this->input->post("id");
		
		
		$roles = $this->Common_model->get_result('user_role', array('user_id'=>$id));
		
		echo json_encode($roles);
		
	}
	
	//all modules permission
	public function submit_permission(){
		
		 $this->load->model('Common_model');
		
		//echo "<pre>";
		//print_r($_POST);
		$values['user_id'] =$row_id	 = $this->input->post('row_id');
		$result = $this->common_model->delete('user_role',$values);
		$menu = $this->input->post("menu");
		$menu_id = $this->input->post("menu_id");
		$menu_permission_add = $this->input->post("menu_permission_add");
		$menu_permission_edit = $this->input->post("menu_permission_edit");
		$menu_permission_delete = $this->input->post("menu_permission_delete");
		$menu_permission_view = $this->input->post("menu_permission_view");
		$menu_permission_download = $this->input->post("menu_permission_download");
		
		foreach($menu_id as $m){
			

			
			$values['user_id'] = $row_id;
			
			$menudata = $this->Common_model->get_row('tbl_menu', array('id'=>$m));
			$values['menu_name'] = $menudata->menu_name;
			$values['menu_id'] = $m;
			$values['menu_permission_add'] = isset($menu_permission_add[$m])?1:0;
			$values['menu_permission_edit'] = isset($menu_permission_edit[$m])?1:0;
			$values['menu_permission_delete'] = isset($menu_permission_delete[$m])?1:0;
			$values['menu_permission_view'] = isset($menu_permission_view[$m])?1:0;
			$values['menu_permission_download'] = isset($menu_permission_download[$m])?1:0;
		    
			$this->common_model->insert('user_role',$values);
			//print_r($values);
			
		}
		
	 redirect('Usermanagement/index');  
		
		/*$data_arr = array(
			'user_id' 		 => $this->input->post('user_id'),
			'menu_name' 	 => $this->input->post('menu_name'),
			'menu_permission_add' 	 => $this->input->post('menu_permission_add'),
			'menu_permission_edit' 	 => $this->input->post('menu_permission_edit'),
			'menu_permission_delete' 	 => $this->input->post('menu_permission_delete'),
			'menu_permission_view' 	 => $this->input->post('menu_permission_view'),
			'menu_permission_download' 	 => $this->input->post('menu_permission_download'),
			
		);
		$permission = json_encode($permission);
		if(empty($row_id)){
			$data_arr['created_at'] = date('Y-m-d h:i:s');
			
			$this->common_model->insert('user_role',$data_arr);
			$output = array(
				'status'	=> 'Success',
				'msg'		=> 'Account Type Added Successfully',
			);
		}else{
			$data_arr['updated_at'] = date('Y-m-d h:i:s');
			
			$where = "id='$row_id'";
			$this->common_model->update('user_role',$data_arr,$where);
			$output = array(
				'status'	=> 'Success',
				'msg'		=> 'Account Type Updated Successfully',
			);
		}
		echo json_encode($output);*/
		   
	}
	
	//Account Type Master
	public function submit_user_account_type_category(){
		$row_id	 = $this->input->post('account_type_row_id');
		
		$permission = (empty($this->input->post('account_permission')))?'0':'1';
		$data_arr = array(
			'account_name' 		 => $this->input->post('account_name'),
			'account_status' 	 => $this->input->post('account_status'),
			'account_permission' => $permission,
		);
		if(empty($row_id)){
			$data_arr['created_at'] = date('Y-m-d h:i:s');
			
			$this->common_model->insert('tbl_user_account_type',$data_arr);
			$output = array(
				'status'	=> 'Success',
				'msg'		=> 'Account Type Added Successfully',
			);
		}else{
			$data_arr['updated_at'] = date('Y-m-d h:i:s');
			
			$where = "id='$row_id'";
			$this->common_model->update('tbl_user_account_type',$data_arr,$where);
			$output = array(
				'status'	=> 'Success',
				'msg'		=> 'Account Type Updated Successfully',
			);
		}
		echo json_encode($output);
	}
	
	
	public function list_user_account_type_category(){
		$data = $row = array();
		$memData 	= $this->user_account_master_model->getRows($_POST);
		$i 			= $_POST['start'];
		
		foreach($memData as $member){
			$i++;
			
			$action = "<button type='button' class='btn btn-info btn-sm edit_data' data-id='".$member->id."' data-name='".$member->account_name."' data-status='".$member->account_status."' data-permission='".$member->account_permission."'><i class='fa fa-edit'></i></button>&nbsp;&nbsp;";
			$action.= "<button type='button' class='btn btn-danger btn-sm delete_data' data-id='".$member->id."'><i class='fa fa-trash'></i></button>";
			
			$account_status = ($member->account_status=='Active')?'<span class="badge badge-success">Active</span>':'<span class="badge badge-danger">Inactive</span>';
			$account_permission = ($member->account_permission=='1')?'<span class="badge badge-success">Yes</span>':'<span class="badge badge-danger">No</span>';
			
			$data[] = array($i, $member->account_name, $account_status, $account_permission, $action);
		}
		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->user_account_master_model->countAll($_POST),
			"recordsFiltered" 	=> $this->user_account_master_model->countFiltered($_POST),
			"data" 				=> $data,
		);
		echo json_encode($output);
	}

	public function delete_user_account_type_category(){
		$row_id = $this->input->post('keys');
		
		$where = "id='$row_id'";
		$result = $this->common_model->delete('tbl_user_account_type',$where);
		
		if($result==true){
			$output = array(
				'status'	=> 'Success',
				'msg'		=> 'Account Type Deleted Successfully',
			);
		}else{
			$output = array(
				'status'	=> 'Warning',
				'msg'		=> 'Unable to Delete Account Type Details',
			);
		}
		echo json_encode($output);
	}
	
	//Common Functions
	public function get_user_account_type_list(){
		$output = "";
		$result = list_user_account_type();
		if(!empty($result)){
			$output = "<option value=''>-- Select Account Type --</option>";
			foreach($result as $row){
				$output.= "<option value='".$row['id']."'>".$row['account_name']."</option>";
			}
		}else{
			$output = "<option value=''>Account Type List Empty</option>";
		}
		echo $output;
	}
	
}
?>