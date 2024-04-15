<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function get_functions($id){	
	$CI = get_instance();
    $CI->load->model("common_model");
	$data = $CI->common_model->get_records("systemfunctions","*",array("moduleid"=>$id));
	return $data;	
}

function logged_user(){	
	
	$CI = get_instance();
	return $CI->session->userdata("username");	
}

function get_customername($id = ''){	
	$CI = get_instance();
    $CI->load->model("common_model");
	if(!$id){
		$id = $CI->session->userdata("customerid");	
	}
	$data = $CI->common_model->get_record("customers","name",array("customerid"=>$id));
	return $data->name;	
}

function get_customercompany($id){	
	$CI = get_instance();
    $CI->load->model("common_model");
	$data = $CI->common_model->get_record("customerdetails","companyname",array("customerid"=>$id));
	return $data->companyname;	
}

function get_customeremail($id){	
	$CI = get_instance();
    $CI->load->model("common_model");
	$data = $CI->common_model->get_record("customerdetails","email",array("customerid"=>$id));
	return $data->email;	
}

function get_customercontact($id){	
	$CI = get_instance();
    $CI->load->model("common_model");
	$data = $CI->common_model->get_record("customerdetails","contactno",array("customerid"=>$id));
	return $data->contactno;	
}

function get_customer_account($id){	
	$CI = get_instance();
    $CI->load->model("common_model");
	$data = $CI->common_model->get_record("accountnames","accountname",array("accountid"=>$id));
	return $data->accountname;	
}


function get_item_account($id){
	$CI = get_instance();
    $CI->load->model("common_model");
	$data = $CI->common_model->get_record("itemmaster","accountname",array("itemid"=>$id));
	return $data->accountname;
}



//Function to get the system module functions
function get_module_functions($id){
	$CI = get_instance();
    $CI->load->model("common_model");
	$data = $CI->common_model->get_records("systemfunctions","*",array("moduleid"=>$id));
	return $data;
}

function get_attendance_present($date){
	$CI = get_instance();
    $CI->load->model("hr_model");
    $companyid = get_customercompanyid();
	$data = $CI->hr_model->get_attendance_present($companyid,$date);
	if(isset($data->present))
		return $data->present;
	else
		return 0;
	
}

function get_attendance_leave($date){
	$CI = get_instance();
    $CI->load->model("hr_model");
    $companyid = get_customercompanyid();
	$data = $CI->hr_model->get_attendance_leave($companyid,$date);
	if(isset($data->le))
		return $data->le;
	else
		return 0;
}

function get_employee_leave($empid,$date){
	$CI = get_instance();
    $CI->load->model("hr_model");
    $companyid = get_customercompanyid();
	$data = $CI->hr_model->get_employee_leave($empid,$companyid,$date);
	return $data;
}

function get_loan_insallment_amount($empid){
	$CI = get_instance();
    $CI->load->model("hr_model");
    $companyid = get_customercompanyid();
	$data = $CI->hr_model->get_loan_insallment_amount($empid);
	$amount = 0;
	foreach($data as $tmp){
		
		$installemnt = $tmp->loan_amount/$tmp->installment;
		
		$amount = $amount + $installemnt;
	}
	
	return $amount;
	
}

  