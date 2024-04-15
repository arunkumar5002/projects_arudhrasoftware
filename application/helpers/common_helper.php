<?php

function company_name(){
	return "Arudhra Technologies";
}

function product_name(){
	return "Ilium";
}

function logo(){
	return "assets/arudhralogo.png";
}

function pdf(){
	return "assets/pdf.png";
}

function profit_loss_accounts(){
	return '37';
}

function inventory_balance_sheet(){
	return '56';
}

function inventory_profit_loss(){
	return '58';
}

function purchases_account(){
	return '8';
}

function get_company_count(){
	$CI = get_instance();
    $CI->load->model("common_model");
	$data = $CI->common_model->get_records_count("company","*");
	return $data;
}

function convert_number($number){ 

    if (($number < 0) || ($number > 999999999)) 
    { 
    throw new Exception("Number is out of range");
    } 

    $Gn = floor($number / 1000000);  /* Millions (giga) */ 
    $number -= $Gn * 1000000; 
    $kn = floor($number / 1000);     /* Thousands (kilo) */ 
    $number -= $kn * 1000; 
    $Hn = floor($number / 100);      /* Hundreds (hecto) */ 
    $number -= $Hn * 100; 
    $Dn = floor($number / 10);       /* Tens (deca) */ 
    $n = $number % 10;               /* Ones */ 

    $res = ""; 

    if ($Gn) 
    { 
        $res .= convert_number($Gn) . " Million"; 
    } 

    if ($kn) 
    { 
        $res .= (empty($res) ? "" : " ") . 
            convert_number($kn) . " Thousand"; 
    } 

    if ($Hn) 
    { 
        $res .= (empty($res) ? "" : " ") . 
            convert_number($Hn) . " Hundred"; 
    } 

    $ones = array("", "One", "Two", "Three", "Four", "Five", "Six", 
        "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", 
        "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", 
        "Nineteen"); 
    $tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty", 
        "Seventy", "Eigthy", "Ninety"); 

    if ($Dn || $n) 
    { 
        if (!empty($res)) 
        { 
            $res .= " and "; 
        } 

        if ($Dn < 2) 
        { 
            $res .= $ones[$Dn * 10 + $n]; 
        } 
        else 
        { 
            $res .= $tens[$Dn]; 

            if ($n) 
            { 
                $res .= "-" . $ones[$n]; 
            } 
        } 
    } 

    if (empty($res)) 
    { 
        $res = "zero"; 
    } 

    return $res; 
} 

function get_customer_count(){
	$CI = get_instance();    
    $CI->load->model("common_model");
    $company = get_customercompanyid();
	$data = $CI->common_model->get_records_count("contacts","*",array('companyid'=>$company,'contacttype'=>1,'status'=>0));
	return $data;
}
function get_vendor_count(){
	$CI = get_instance();    
    $CI->load->model("common_model");
    $company = get_customercompanyid();
	$data = $CI->common_model->get_records_count("contacts","*",array('company_id'=>$company,'contacttype'=>2,'status'=>0));
	return $data;
}
function get_vouchers_count(){
	$CI = get_instance();    
    $CI->load->model("common_model");
    $company = get_customercompanyid();
	$data = $CI->common_model->get_records_count("voucher","*",array('company_id'=>$company,'status'=>0));
	return $data;
}
function get_employees_count(){
	$CI = get_instance();    
    $CI->load->model("common_model");
    $company = get_customercompanyid();
	$data = $CI->common_model->get_records_count("employee","*",array('company_id'=>$company,'status'=>1));
	return $data;
}


function get_sales_quote_count(){
	$CI = get_instance();    
    $CI->load->model("common_model");
    $company = get_customercompanyid();
	$data = $CI->common_model->get_records_count("salesquote","*",array('company_id'=>$company,'status'=>0));
	return $data;
}

function get_sales_order_count(){
	$CI = get_instance();    
    $CI->load->model("common_model");
    $company = get_customercompanyid();
	$data = $CI->common_model->get_records_count("salesorder","*",array('company_id'=>$company,'status'=>0));
	return $data;
}

function get_sales_invoice_count(){
	$CI = get_instance();    
    $CI->load->model("common_model");
    $company = get_customercompanyid();
	$data = $CI->common_model->get_records_count("salesinvoice","*",array('companyid'=>$company,'status'=>0));
	return $data;
}
function get_accountname_details($id){	
	$CI = get_instance();
    $CI->load->model("common_model");
	$data = $CI->common_model->get_record("accountnames","groupid,categoryid,subcategoryid,subsubcategoryid",array("accountid"=>$id));
	return $data;
}

function get_subsubcategoryname($id){
	$CI = get_instance();
    $CI->load->model("common_model");
	$data = $CI->common_model->get_record("subsubcategory","subsubcategoryname",array("subsubcategoryid"=>$id));
	if(isset($data->subsubcategoryname))
		return $data->subsubcategoryname;
	else
		return "-";
}

function get_defaultyear_end(){
	$CI = get_instance();
    $CI->load->model("common_model");
	$cid = get_customercompanyid();
	
	$data = $CI->common_model->get_record("financialyear","enddate",array("comp"=>1,"company_id"=>$cid));
	if(isset($data->enddate)){
		return date("d.m.Y",strtotime($data->enddate));	
	}
	else
		return "-";
}

function get_voucherslist_profit_loss($cid,$fromDate = '',$toDate = ''){
	$CI = get_instance();
    $CI->load->model("common_model");
    $CI->load->model("sys_model");
	$company_id = get_customercompanyid();
	
	$records = $CI->sys_model->get_profit_loss($cid,$company_id,$fromDate,$toDate);	
	return $records;	
}

function get_voucher_details_text($vid){
	$CI = get_instance();
    $CI->load->model("sys_model");
	$data = $CI->sys_model->get_voucher_details_text($vid);
	return $data;
}

function get_categorylist($group){	
	$CI = get_instance();
    $CI->load->model("common_model");
	$data = $CI->common_model->get_records("category","*",array("groupid"=>$group));
	return $data;
}

function get_defaultyear_start(){
	$CI = get_instance();
    $CI->load->model("common_model");
	$cid = get_customercompanyid();
	
	$data = $CI->common_model->get_record("financialyear","startdate",array("comp"=>1,"company_id"=>$cid));
	if(isset($data->startdate)){
		return date("d.m.Y",strtotime($data->startdate));	
	}
	else
		return "-";
}
//Mani
function load_datatables(){
	$output = '<link rel="stylesheet" href="'.base_url().'assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">';
	$output.= '<link rel="stylesheet" href="'.base_url().'assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">';
	$output.= '<link rel="stylesheet" href="'.base_url().'assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">';
	
	$output.= '<link rel="stylesheet" href="'.base_url().'assets/plugins/select2/css/select2.min.css">';
	$output.= '<link rel="stylesheet" href="'.base_url().'assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">';

	$output.= '<script src="'.base_url().'assets/plugins/datatables/jquery.dataTables.min.js"></script>';
	$output.= '<script src="'.base_url().'assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>';
	$output.= '<script src="'.base_url().'assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>';
	$output.= '<script src="'.base_url().'assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>';
	$output.= '<script src="'.base_url().'assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>';
	$output.= '<script src="'.base_url().'assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>';
	$output.= '<script src="'.base_url().'assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>';
	$output.= '<script src="'.base_url().'assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>';
	$output.= '<script src="'.base_url().'assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>';
	
	$output.='<style>
		.select2-container .select2-selection--single .select2-selection__rendered {
			padding-left: 0px !important;
		}
		
		select.form-control-sm~.select2-container--default .select2-selection--single .select2-selection__arrow {
			top: 3px !important;
			padding-right: 30px;
		}
	</style>';
	
	return $output;
}

function get_accountid($name){
	$CI = get_instance();
    $CI->load->model("common_model");
    $company_id = get_customercompanyid();
	$data = $CI->common_model->get_record("accountnames","accountid",array("accountname"=>$name));
	return $data->accountid;
}

function list_user_account_type(){
	$CI 	= &get_instance();
	$result = $CI->db->select('*')->where('account_status','Active')->order_by('account_name','ASC')->get('tbl_user_account_type')->result_array();
	return $result;
}



function get_profit_loss_result(){
	$CI = get_instance();
    $CI->load->model("sys_model");
	 $cid = get_customercompanyid();
	$data = $CI->sys_model->get_profit_loss_result($cid);
	return $data;
}

function list_employee_department(){
	$CI 	= &get_instance();
	$result = $CI->db->select('*')->where('department_status','Active')->order_by('department_name','ASC')->get('tbl_department_category')->result_array();
	return $result;
}

function list_employee_desigantion(){
	$CI 	= &get_instance();
	$result = $CI->db->select('*')->where('designation_status','Active')->order_by('designation_name','ASC')->get('tbl_desigantion_category')->result_array();
	return $result;
}

function get_currency(){
	$CI = get_instance();
    $CI->load->model("common_model");
	
	$company_id = get_customercompanyid();
	
	$data = $CI->common_model->get_record("company",'currencyused',array("company_id"=>$company_id));
	if(isset($data->currencyused))
		return $data->currencyused;
	else
		return '-';
}

function list_leave_category(){
	$CI 	= &get_instance();
	$result = $CI->db->select('*')->where('category_status','Active')->order_by('category_name','ASC')->get('tbl_attendance_leave_category')->result_array();
	return $result;
}

function menu_module(){
	$CI 	= &get_instance();
	$result = $CI->db->select('*')->order_by('menu_order','ASC')->get('tbl_menu')->result_array();
	return $result;
}

function get_employee_passport_notification($limit=NULL){
	$CI = get_instance();
	
	$cur_date = date('Y-m-d');
	$new_date = date('Y-m-d', strtotime($cur_date. ' + 90 days'));
	
	$where	= "passport_expiry_date BETWEEN '".$cur_date."' AND '".$new_date."'";
	if(!empty($limit)){
		$data 	= $CI->db->select('emp_id,employeename,passport_expiry_date')->where($where)->limit($limit)->get('employee')->result_array();
	}else{
		$data 	= $CI->db->select('emp_id,employeename,passport_expiry_date')->where($where)->get('employee')->result_array();
	}
	if(!empty($data)){
		return $data;
	}else{
		return 0;
	}
}

function get_employee_rp_notification(){
	$CI = get_instance();
	
	$cur_date = date('Y-m-d');
	$new_date = date('Y-m-d', strtotime($cur_date. ' + 90 days'));
	
	$where	= "rp_expiry_date BETWEEN '".$cur_date."' AND '".$new_date."'";
	$data 	= $CI->db->select('emp_id,employeename,rp_expiry_date')->where($where)->get('employee')->result_array();
	if(!empty($data)){
		return $data;
	}else{
		return 0;
	}
}

function get_contacttype($id){
	$CI = get_instance();
    $CI->load->model("common_model");
	$data = $CI->common_model->get_record("contacttype","contacttype",array("typeid"=>$id));
	return $data->contacttype;
}

function get_employee_crp_notification(){
	$CI = get_instance();
	
	$cur_date = date('Y-m-d');
	$new_date = date('Y-m-d', strtotime($cur_date. ' + 90 days'));
	
	$where	= "crp_expiry_date BETWEEN '".$cur_date."' AND '".$new_date."'";
	$data 	= $CI->db->select('emp_id,employeename,crp_expiry_date')->where($where)->get('employee')->result_array();
	if(!empty($data)){
		return $data;
	}else{
		return 0;
	}
}

function get_employee_details($emp_id){
	$CI = get_instance();
	
	$CI->db->select('tbl_department_category.department_name,tbl_desigantion_category.designation_name,employee.*');
	$CI->db->from('employee');
	$CI->db->join('tbl_desigantion_category','tbl_desigantion_category.id=employee.designation');
	$CI->db->join('tbl_department_category','tbl_department_category.id=employee.department');
	$CI->db->where('employee.employee_id',$emp_id);
	$query = $CI->db->get();
	$employee_details = $query->row();
	if(!empty($employee_details)){
		return $employee_details;
	}else{
		return 0;
	}
}

function get_salary_earnings_details($slip_id){
	$CI = get_instance();
	
	$CI->db->select('employee.*');
	$CI->db->from('tbl_salary_details');
	$CI->db->where('employee.employee_id',$emp_id);
	$CI->db->order_by('details_name','ASC');
	$query = $CI->db->get();
	$employee_details = $query->row();
	if(!empty($employee_details)){
		return $employee_details;
	}else{
		return 0;
	}
}


function get_employe_details($emp_id){
	$CI = get_instance();
	
	$CI->db->select('tbl_department_category.department_name,tbl_desigantion_category.designation_name,employee.*');
	$CI->db->from('employee');
	$CI->db->join('tbl_desigantion_category','tbl_desigantion_category.id=employee.designation');
	$CI->db->join('tbl_department_category','tbl_department_category.id=employee.department');
	$CI->db->where('employee.employee_id',$emp_id);
	$query = $CI->db->get();
	$milestone_details = $query->row();
	if(!empty($milestone_details)){
		return $milestone_details;
	}else{
		return 0;
	}
}

function convert_amount_words($number){
   $no = floor($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'One', '2' => 'Two',
    '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
    '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
    '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
    '13' => 'Thirteen', '14' => 'Fourteen',
    '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
    '18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
    '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
    '60' => 'Sixty', '70' => 'Seventy',
    '80' => 'Eighty', '90' => 'Ninety');
   $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
  $points = ($point) ?
    "." . $words[$point / 10] . " " . 
          $words[$point = $point % 10] : '';
	
	$amount = $result . "Bahraini Dinar  ";
	if(!empty($points)){
		$amount .= $points . " Paise";
	}
	return $amount;
}

//Arun
/*******Get Attendance*******/
function get_emp_attendance($attend_emp_id,$attend_month_year){
	$CI = get_instance();
    $CI->load->model("Attendance_model");
    
    $data = $CI->Attendance_model->get_emp_attendance($attend_emp_id,$attend_month_year);
    
	return $data;
}

//Kalai
function get_role_permission_list($menu_id){
	$CI = get_instance();
	
	$user_admin = $CI->session->userdata('user_id');
	$user_id 	= $CI->session->userdata('user_id');
	if(!isset($user_admin)){
		$data = $CI->db->select('*')->where('user_id',$user_id)->where('menu_id',$menu_id)->get('user_role')->row();
		if(!empty($data)){
			return $data;
		}else{
			return 0;
		}
	}else{
		$data = array(
			'menu_permission_add' 		=> 1,
			'menu_permission_edit' 		=> 1,
			'menu_permission_delete' 	=> 1,
			'menu_permission_view' 		=> 1,
			'menu_permission_download' 	=> 1,
		);
		return $data;
	}
}



//SELECT * FROM `user_role` WHERE `user_id` = 8 and menu_id = 3 and (menu_permission_add = 1 or menu_permission_edit = 1 or menu_permission_delete = 1 or menu_permission_view = 1 or menu_permission_download = 1);



function get_employee_leave_details($employee_id, $category_id){
	
	
	$CI = get_instance();
	$CI->load->model("Common_model");
    
	
	$sql = "select * from tbl_leave_request_master where request_emp_id  = $employee_id and request_leave_category = $category_id and request_status = 1;";
	
	$result = $CI->Common_model->custom_query_result($sql);
	
	
	return $result;
	
}


function get_maingroup($id){
	$CI = get_instance();
    $CI->load->model("common_model");
	$data = $CI->common_model->get_record("maingroup","groupname",array("groupid"=>$id));
	return $data->groupname;
}

function get_categoryname($id){
	$CI = get_instance();
    $CI->load->model("common_model");
	$data = $CI->common_model->get_record("category","categoryname",array("categoryid"=>$id));
	return $data->categoryname;
}

function get_subcategoryname($id){
	$CI = get_instance();
    $CI->load->model("common_model");
	$data = $CI->common_model->get_record("subcategory","subcategoryname",array("subcategoryid"=>$id));
	if(isset($data->subcategoryname))
		return $data->subcategoryname;
	else
		return "-";
}

function get_accountname($id){
	$CI = get_instance();
    $CI->load->model("common_model");
	$data = $CI->common_model->get_record("accountnames","accountname",array("accountid"=>$id));
	return ucfirst($data->accountname);
}

function get_total_receivables(){
	$CI = get_instance();    
    $CI->load->model("common_model");
    $company = get_customercompanyid();
	$data = $CI->sys_model->total_receivables($company);
	if($data->amount)
	return round($data->amount);
	else
	return "0";
}

function get_customercompanyid(){	
    $CI = get_instance();
    $CI->load->model("common_model");
	
	$data = $CI->common_model->get_record("company","company_id",array("comp"=>1));
	if(isset($data->company_id))
		return $data->company_id;	
	else
		return 0;
}

	function get_total_payables(){
	$CI = get_instance();    
    $CI->load->model("common_model");
    $company = get_customercompanyid();
	$data = $CI->sys_model->total_payables($company);
	if($data->amount)
	return round($data->amount);
	else
	return "0";
}

function get_defaultyeardata(){
	$CI = get_instance();
    $CI->load->model("common_model");
	$cid = get_customercompanyid();
	
	$data = $CI->common_model->get_record("financialyear","startdate,enddate",array("comp"=>1,"company_id"=>$cid));
	if(isset($data->startdate) && isset($data->enddate)){
		return $data;
	}
	else
		return false;
}

function get_contactname($id){
	$CI = get_instance();
    $CI->load->model("common_model");
	
	$data = $CI->common_model->get_record("contacts","customername",array("status"=>0,"contactid"=>$id));
	if(isset($data->customername))
		return $data->customername;	
	else
		return "-";
}


function toDollar($val,$symbol='',$r=2){    
   return $symbol . ($val < 0 ? '-' : '') . number_format(abs($val), $r);
}


function get_item($id){
	$CI = get_instance();
    $CI->load->model("common_model");
	$data = $CI->common_model->get_record("itemmaster","itemname",array("itemid"=>$id));
	return $data->itemname;
}

function get_itemname($id){
	$CI = get_instance();
    $CI->load->model("common_model");
	$data = $CI->common_model->get_record("itemmaster","itemid",array("itemname"=>$id));
	return $data->itemid;
}

function get_itemcode($id){
	$CI = get_instance();
    $CI->load->model("common_model");
	$data = $CI->common_model->get_record("itemmaster","itemcode",array("itemid"=>$id));
	return $data->itemcode;
}

function get_itemid($id){
	$CI = get_instance();
    $CI->load->model("common_model");
	$data = $CI->common_model->get_record("itemmaster","itemid",array("itemcode"=>$id));
	return $data->itemid;
}

function get_purchase_order_date($order){	
	$CI = get_instance();
    $CI->load->model("common_model");
	$data = $CI->common_model->get_record("purchaseorder","issuedate",array("purchaseorderid"=>$order));
	return $data->issuedate;
}

function get_purchase_order_quantity($order,$item){	
	$CI = get_instance();
    $CI->load->model("common_model");
	$data = $CI->common_model->get_record("purchaseorderrecords","quantity",array("itemcode"=>$item,"purchaseorderid"=>$order));
	return $data->quantity;
}

function get_record($table,$field,$where){
	$CI = get_instance();
    $CI->load->model("common_model");
	$data = $CI->common_model->get_record($table,$field,$where);
	return $data->$field;
}

function get_purchase_invoice_paid($invoiceno){	
		$CI = get_instance();
		$CI->load->model("common_model");
	
		
		$paid = $CI->common_model->get_remaining_invoice_amount_purchases($invoiceno);
		
		$getinvoiveamount = $CI->common_model->get_record('purchaseinvoice','totalamount',array('invoicenumber'=>$invoiceno,'status'=>0));	
		if(isset($getinvoiveamount) && !empty($getinvoiveamount)){			
			if($paid->sum){
				return $paid->sum;			
			}
			else{
				return 0;
			}		
		}
		else{
			return 0;
		}			
}

function get_companyname($id){
	$CI = get_instance();
    $CI->load->model("common_model");
	
	$data = $CI->common_model->get_record("company","*",array("company_id"=>$id));
	if(isset($data->name))
		return $data->name;	
	else
		return "-";
} 

function get_cutomerdetails($id){
	$CI = get_instance();
    $CI->load->model("common_model");
	
	$data = $CI->common_model->get_record("contacts","*",array("status"=>0,"contactid"=>$id));
	if(isset($data))
		return $data;	
	else
		return "-";
}

function get_gstregistered(){	
	$CI = get_instance();
    $CI->load->model("common_model");
	
	$cid = get_customercompanyid();
	
	$data = $CI->common_model->get_record("company","vat",array("company_id"=>$cid));
	if(isset($data->vat))
		return $data->vat;	
	else
		return 0;
}

function get_dispatched_item($invoice,$item){
	$CI = get_instance();    
    $CI->load->model("common_model");
    $company = get_customercompanyid();
    $data = $CI->sys_model->get_dispatched_item($invoice,$item);
    
    if($data->dispatched)
	return $data->dispatched;
	else
	return "0";
}

function get_defaultyear(){
	$CI = get_instance();
    $CI->load->model("common_model");
	$cid = get_customercompanyid();
	
	$data = $CI->common_model->get_record("financialyear","startdate,enddate",array("comp"=>1,"company_id"=>$cid));
	if(isset($data->startdate) && isset($data->enddate)){
		return date("M Y",strtotime($data->startdate)).' - '.date("M Y",strtotime($data->enddate));	
	}
	else
		return "-";
}

function get_ledger_opening_balance($startdate,$Tmpstart,$aid){
	$CI = get_instance();
    $CI->load->model("common_model");
	$cid = get_customercompanyid();
	
	return $CI->sys_model->get_ledger_opening_balance($cid,$startdate,$Tmpstart,$aid);
}

function get_customeryearid(){
	
	$CI = get_instance();
    $CI->load->model("common_model");
	
	$data = $CI->common_model->get_record("financialyear","yearid",array("comp"=>1));
	if(isset($data->yearid))
		return $data->yearid;	
	else
		return 0;
}

function get_company_opening_balance($aid){
	$CI = get_instance();
    $CI->load->model("common_model");
    
    $cid = get_customercompanyid();
    $yid = get_customeryearid();
	
	$data = $CI->common_model->get_record("openingbalance","*",array("company_id"=>$cid,"yearid"=>$yid,"accountname"=>$aid));
	if(isset($data->debit) && $data->debit != '0.00'){
		return json_encode(array("debit"=>$data->debit));	
	}
	else if(isset($data->credit) && $data->credit != '0.00'){
		return json_encode(array("credit"=>$data->credit));	
	}
	else
		return "0";
}

function get_ledger_particulars($aid,$accountname,$start,$end){
	$CI = get_instance();
    $CI->load->model("common_model");
    $CI->load->model("sys_model");
	$company_id = get_customercompanyid();
	
	$records = $CI->sys_model->get_ledger_particulars($aid,$company_id,$accountname,$start,$end);	
	return $records;
}

function get_defaultcompany(){
	$CI = get_instance();
    $CI->load->model("common_model");
	
	$data = $CI->common_model->get_record("company","name",array("comp"=>1));
	if(isset($data->name))
		return $data->name;	
	else
		return "-";
}

function get_companylist(){
	$CI = get_instance();
    $CI->load->model("common_model");
	
	$data = $CI->common_model->get_records("company","*",array("status"=>0));
	return $data;	
}

function get_financialyear_list(){
	$cid = get_customercompanyid();
	
	$CI = get_instance();
    $CI->load->model("common_model");
	
	$data = $CI->common_model->get_records("financialyear","*",array("status"=>0,"company_id"=>$cid));
	return $data;	
}

function get_salequota($id){
	$CI = get_instance();
    $CI->load->model("common_model");
	
	$data = $CI->common_model->get_record("salesquote","*",array("salesquoteid"=>$id));
	if(isset($data))
		return $data;	
	else
		return "-";
}

function get_sales_invoice_paid($invoiceno){	
		$CI = get_instance();
		$CI->load->model("common_model");
		
		
		$paid = $CI->common_model->get_remaining_invoice_amount_sales($invoiceno);
		
		$getinvoiveamount = $CI->common_model->get_record('salesinvoice','totalamount',array('invoicenumber'=>$invoiceno,'status'=>0));	
		if(isset($getinvoiveamount) && !empty($getinvoiveamount)){			
			if($paid->sum){
				return $paid->sum;			
			}
			else{
				return 0;
			}		
		}
		else{
			return 0;
		}			
}


function get_saleinvoice($id){
	$CI = get_instance();
    $CI->load->model("common_model");
	
	$data = $CI->common_model->get_invoice_details($id);
	if(isset($data))
		return $data;	
	else
		return "-";
}

function get_setting($setting){
	$CI = get_instance();
    $CI->load->model("common_model");
	
	$data = $CI->common_model->get_record("settings","value",array("settingname"=>$setting));
	if(isset($data->value))
		return $data->value;	
	else
		return "-";
}
