<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bank extends CI_Controller
{
	
	public function __construct(){
        parent::__construct();
        $this->load->model('Bank_model');
    }

    public function index()
	{
		
		
	}

	public function bank_form()
	{

		$data['bank_form'] = 'menu';

		$data['content'] = "web/Bank Reconciliation/bank_form";

		$this->load->view('web/template', $data);
	}
	
	public function save_bank_form()
	{
		$row_id	 = $this->input->post('row_id');
		$data_arr = array(
			'bank_account' 		=> $this->input->post('bank_account'),
			'openingbalance' 	=> $this->input->post('openingbalance'),
			'date1' 		        => $this->input->post('date1'),
			'withdraw'    	    => $this->input->post('withdraw'),
			'deposit' 		    => $this->input->post('deposit'),
			'reference' 	    => $this->input->post('reference'),
			'balance' 		    => $this->input->post('balance'),
			
		);

		if(empty($row_id)){
			$data_arr['created_at'] = date('Y-m-d h:i:s');
			
			$this->common_model->insert('tbl_bank_entries',$data_arr);
			$output = array(
				'status'	=> 'Success',
				'msg'		=> 'Bank Entries Added Successfully',
				);
		}else{
			$data_arr['updated_at'] = date('Y-m-d h:i:s');
			
			$where = "id='$row_id'";
			$this->common_model->update('tbl_bank_entries',$data_arr,$where);
			$output = array(
				'status'	=> 'Success',
				'msg'		=> 'Bank Entries  Updated Successfully',
			);
		}
		echo json_encode($output);
	}

	public function list_designation_category(){
		$data = $row = array();
		$memData 	= $this->Set_bank_entries_model->getRows($_POST);
		$i 			= $_POST['start'];
	
		foreach($memData as $member){
			$i++;
			
			$action=	"<button type='button' class='btn btn-info btn-sm edit_data' data-id='".$member->id."' data-name='".$member->bank_account."' data-openingbalance='".$member->openingbalance."' data-date1='".$member->date1."'  data-withdraw='".$member->withdraw."'  data-deposit='".$member->deposit."'  data-reference='".$member->reference."'  data-balance='".$member->balance."'><i class='fa fa-edit'></i></button>&nbsp;&nbsp;";
			$action.=	"<button type='button' class='btn btn-danger btn-sm delete_data' data-id='".$member->id."'><i class='fa fa-trash'></i></button>";
			
			//$Bank_status = ($member->Bank_status=='Active')?'<span class="badge badge-success">Active</span>':'<span class="badge badge-danger">Inactive</span>';
			
			$data[] = array($i, $member->designation_name,$member->openingbalance,$member->date1,$member->withdraw,$member->deposit,$member->reference,$member->balance,$Bank_status, $action);
		}
		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->Set_bank_entries_model->countAll($_POST),
			"recordsFiltered" 	=> $this->Set_bank_entries_model->countFiltered($_POST),
			"data" 				=> $data,
		);
		echo json_encode($output);
	}
	
	public function delete_bank_form(){
		$row_id = $this->input->post('keys');
		
		$where = "id='$row_id'";
		$result = $this->common_model->delete('tbl_bank_entries',$where);
		
		if($result==true){
			$output = array(
				'status'	=> 'Success',
				'msg'		=> 'Bank Entries  Deleted Successfully',
			);
		}else{
			$output = array(
				'status'	=> 'Warning',
				'msg'		=> 'Unable to Delete the Bank Entries  Details',
			);
		}
		echo json_encode($output);
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

     public function bank_entries_upload()
	{

		$data['bank_entries_upload'] = 'menu';

		$data['content'] = "web/Bank Reconciliation/bank_entries_upload";

		$this->load->view('web/template', $data);
	}


      public function Bank_Entries_Final()
	{

		$data['Bank_Entries_Final'] = 'menu';

		$data['content'] = "web/Bank Reconciliation/Bank_Entries_Final";

		$this->load->view('web/template', $data);
	}
	
	
	 public function Bank_Entries_View()
	{

		$data['Bank_Entries_View'] = 'menu';

		$data['content'] = "web/Bank Reconciliation/Bank_Entries_View";

		$this->load->view('web/template', $data);
	}
}