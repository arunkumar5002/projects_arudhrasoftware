<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Web extends CI_Controller
{
	
	public function __construct(){
        parent::__construct();
        $this->load->model('set_item_master_model');
        
    }

	public function index()
	{

		$this->load->view('auth/login');
	}


	public function dashboard(){
		
		$data['content'] = 'web/dashboard';
		
		$company_id = get_customercompanyid();
		//print_r($company_id);
		//exit();
		$yeardata = get_defaultyeardata();
		if($yeardata){
		$purchase = $this->sys_model->get_monthly_purchase($company_id,$yeardata);
		$sales = $this->sys_model->get_monthly_sales($company_id,$yeardata);
		//print_r($purchase);
		//exit();
		
		$keys = range(1,12);
		$arr1 = array_fill_keys($keys, '0');
		$arr2 = array_fill_keys($keys, '0');
		foreach($purchase as $tmp){
			$arr1[$tmp->month] = $tmp->amount;
		}
		foreach($sales as $tmp1){
			$arr2[$tmp1->month] = $tmp1->amount;
		}
		
		$data['purchase'] = implode(",",$arr1);
		$data['sales'] = implode(",",$arr2);
		}
		
		$this->load->view('web/template',$data);
	}
	
	public function settings(){
		
		$data['content'] = 'web/settings';
		$this->load->view('web/template', $data);
	}
	
	public function newmaster()
	{

		$data['newmaster'] = 'menu';
		$data['page_title'] 	= "Inventory Master";
		$data['accountnames'] = $this->sys_model->get_accountnames();
		$data['content'] = "web/inventory_master/newmaster";
		$this->load->view('web/template', $data);
	}
	
	
	public function save_item(){
	
	  $company_id = get_customercompanyid();	
	  $row_id = $this->input->post('row_id');
	
		$data_arr = array(
		    'company_id' 		 => $company_id,
		    'itemcode' 		 => $this->input->post('itemcode'), 
			'itemname' 		 => $this->input->post('itemname'),
			'category' 	 => $this->input->post('category'),
			'subcategory' 		 => $this->input->post('subcategory'),
			'brand' 	 => $this->input->post('brand'),
			'costprice' 		 => $this->input->post('costprice'),
			'price' 		 => $this->input->post('price'),
			'unit' 		 => $this->input->post('unit'),
			'gst' 		 => $this->input->post('gst'),
			'hsn_code' 		 => $this->input->post('hsn_code'),
			'quantity' 	 => $this->input->post('quantity'),
			'product_origin' 		 => $this->input->post('product_origin'),
			'location' 	 => $this->input->post('location'),
			'tax' 	 => $this->input->post('tax'),
			'min_reorder' 		 => $this->input->post('min_reorder'),
			'accountname' 	 => $this->input->post('accountname'),
			'status' 	 => $this->input->post('status'),
			'item_type' 	 => $this->input->post('item_type'),
			
		);
		if(empty($row_id)){
			
			//$data_arr['created_at'] = date('Y-m-d h:i:s');
			
			$this->common_model->insert('itemmaster',$data_arr);
			$output = array(
				'status'	=> 'Success',
				'msg'		=> 'Item Master Added Successfully',
			);
		}else{
			
			
			$where = "itemid='$row_id'";
			$this->common_model->update('itemmaster',$data_arr,$where);
			$output = array(
				'status'	=> 'Success',
				'msg'		=> 'Item Master Updated Successfully',
			);
		}
		echo json_encode($output);
		
	}
	
	public function purchaseinvoiceamount(){	
			$invoiceno = $this->input->post("invoiceno");
			$company_id = get_customercompanyid();
			
			//print_r($invoiceno);
			//exit();
			
			$getinvoiveamount = $this->common_model->get_record('purchaseinvoice','totalamount,customerid',array('purchaseinvoiceid'=>$invoiceno,'company_id'=>$company_id,'status'=>0));	
			if(isset($getinvoiveamount) && !empty($getinvoiveamount))			
				echo $getinvoiveamount->totalamount;
                //echo $getinvoiveamount->customerid;			
			else
				echo "-";			
	}

	public function purchaseinvoice_suppliername(){	
		$invoiceno = $this->input->post("invoiceno");
		$company_id = get_customercompanyid();
		
		
		$getinvoiveamount = $this->common_model->get_record('purchaseinvoice','totalamount,customerid',array('purchaseinvoiceid'=>$invoiceno,'company_id'=>$company_id,'status'=>0));	
		if(isset($getinvoiveamount) && !empty($getinvoiveamount)){

			$contact = $this->common_model->get_record('contacts','*',array('contactid'=>$getinvoiveamount->customerid));
			if(isset($contact) && !empty($contact)){
				echo $contact->customername;
			}
		}	
		else
			echo "-";			
}
	
	public function invoiceamount(){	
			$invoiceno = $this->input->post("invoiceno");
			$company_id = get_customercompanyid();
			
			$paid = $this->common_model->get_remaining_invoice_amount_sales($invoiceno);
			
			$getinvoiveamount = $this->common_model->get_record('salesinvoice','totalamount,invoicedate',array('invoicenumber'=>$invoiceno,'company_id'=>$company_id,'status'=>0));	
			
			$invoicedate = $getinvoiveamount->invoicedate;
			
			if(isset($getinvoiveamount) && !empty($getinvoiveamount)){			
				if($paid->sum){
					$balance = $getinvoiveamount->totalamount - $paid->sum;			
					$invoice = $getinvoiveamount->totalamount;
					
				}
				else{
					$balance = $invoice = $getinvoiveamount->totalamount;	
				}		
			}
			else{
				$balance = $invoice = 0;		
			}
			
			$balance = number_format((float)$balance, 2, '.', ''); 
			//print_r($invoicedate);
			//exit();	
			echo json_encode(array('invoiceamount'=>$invoice,"balanceamount"=>$balance,"invoicedate"=>$invoicedate));
	}
	
	
	public function ajaxsalesinvoicedetails(){
		
		$length = $this->input->post("length");
		$start = $this->input->post("start");
		$draw = $this->input->post("draw");
		$search = $this->input->post("search");	
		
		$company_id = get_customercompanyid();	
		
		$year = get_defaultyeardata();
	
				$vouchers =$this->sys_model->get_voucher_limit_salesinvoiceamtdetails($start,$length);
			if(!empty($year))
				$count_vouchers =$this->sys_model->get_voucher_for_year_salesinvoiceamtdetails($company_id,$year);
			else
				$count_vouchers =$this->sys_model->get_voucher_for_year_salesinvoiceamtdetailsonly($company_id);
		
		
		$main_array = array();
		$sno = 0;
		foreach($vouchers as $tmp){
				$sno = $sno + 1;
			$array['check'] = "<p style='text-align:left'>".$sno."</p>" ;
			$array['invoice_date'] = date('d-m-Y',strtotime($tmp->invoicedate));			
			$array['customername'] = get_contactname($tmp->customerid);
			$array['invoice_no'] = $tmp->invoicenumber;
			$array['invoice_amt'] = "<p style='text-align:right;margin-right:20px;'>".toDollar($tmp->totalamount)."</p>";
			$array['paid_amt'] = "<p style='text-align:right;margin-right:20px;'>".toDollar($tmp->totaldebit)."</p>";
            			
			$date1=date_create($tmp->invoicedate);
			$date2=date_create(date('Y-m-d'));
			$diff=date_diff($date1,$date2);
			$diffday = $diff->format("%a");	
				
				
			$calamt = $tmp->totalamount - $tmp->totaldebit;	
			
			if(toDollar($calamt) == 0.00){
				$array['pending_amt'] = "<span style='color:green;line-height:0px !important' title='No Due Pending'>".toDollar($calamt)."</span>";
				$array['status'] = "<p class='btn btn-success' style='font-size:11px;padding:0px 10px!important;'>No Due Pending</p>";
			}
			else{
				$array['pending_amt'] = "<span style='color:blue;line-height:0px !important;margin-right:20px;' title='Overdue'>".toDollar($calamt)."</span>";
				$array['status'] = "<p class='btn btn-success' style='font-size:15px;padding:0px 10px!important;background-color:red !important;color:white;'>".$diffday." days Overdue</p>";
			}
		
		
			
			array_push($main_array,$array);
		}
		
		if(count($vouchers)){
			foreach($main_array as $tmp){
				unset($str);
				foreach($tmp as $key=>$temp){
					$str[] =  '"'.$key.'":"'.$temp.'"';
				}
				$str = implode(",",$str);
				$str_tmp[] = "{".$str."}";
			}
			
			$str_tmp = implode(",",$str_tmp);
			
			
			echo '{"draw":'.$draw.',"recordsTotal":'.count($count_vouchers).',"recordsFiltered":'.count($count_vouchers).',"data":['.$str_tmp.']}';
		}
		else
			echo '{"draw":'.$draw.',"recordsTotal":0,"recordsFiltered":0,"data":[]}';
	}
	
	
	public function list_item_master()
{
    $data = $row = array();
    $memData = $this->set_item_master_model->getRows($_POST);
    $i = $_POST['start'];

    foreach ($memData as $member) {
        $i++;

        // Check if item_type is 1
        if ($member->item_type != 0) {
            $action = "<button type='button' class='btn btn-info btn-sm edit_data'
                data-id='".$member->itemid."' data-code='".$member->itemcode."' data-name='".$member->itemname."' data-cat='".$member->category."' data-sub='".$member->subcategory."' data-brd='".$member->brand."' data-cost='".$member->costprice."' data-pri='".$member->price."' data-unit='".$member->unit."' data-qua='".$member->quantity."' data-gst='".$member->gst."' data-hsn_code='".$member->hsn_code."' data-product='".$member->product_origin."' data-loc='".$member->location."' data-taxx='".$member->tax."' data-min='".$member->min_reorder."' data-acc='".$member->accountname."'  data-sta='".$member->status."' data-item_type='".$member->item_type."'><i class='fa fa-edit'></i></button>&nbsp;&nbsp;";
            $action .= "<button type='button' class='btn btn-danger btn-sm delete_data' data-id='".$member->itemid."'><i class='fa fa-trash'></i></button>";

            $status = ($member->status == '0') ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>';

            $data[] = array($i, $member->itemname,$member->price,$member->quantity, $member->unit,$member->brand, $member->location,  $status, $action);
        }
    }
    $output = array(
        "draw" => $_POST['draw'],
        "recordsTotal" => $this->set_item_master_model->countAll($_POST),
        "recordsFiltered" => $this->set_item_master_model->countFiltered($_POST),
        "data" => $data,
    );
    echo json_encode($output);
}

	
	public function delete_item_master(){
		$row_id = $this->input->post('keys');
		
		$where = "itemid='$row_id'";
		$result = $this->common_model->delete('itemmaster',$where);
		
		if($result==true){
			$output = array(
				'status'	=> 'Success',
				'msg'		=> 'Item Master Type Deleted Successfully',
			);
		}else{
			$output = array(
				'status'	=> 'Warning',
				'msg'		=> 'Unable to Delete Item Master Type Details',
			);
		}
		echo json_encode($output);
	}
	
	
	
	public function accountsname()
	{

		$data['accountsname'] = 'menu';
		
		$data['page_title'] 	= "A/C List";
		
		$data['maingroup'] = $this->common_model->get_records("maingroup");
		
		$data['accountnames'] = $this->sys_model->get_accountnames();

		$data['content'] = "web/finance/accountname";

		$this->load->view('web/template', $data);
	}
	
	
	public function account_subcategory()
	{

		$data['account_subcategory'] = 'menu';
		
		$data['page_title'] 	= "Account Subcategory";
		
		$company_id = get_customercompanyid();
		
		$data['maingroup'] = $this->common_model->get_records("maingroup");
		
		$data['subsubcategory'] = $this->sys_model->get_subsubcategory($company_id);

		$data['content'] = "web/finance/account_subcategory";

		$this->load->view('web/template', $data);
	}
	
	
	public function get_category(){
		$values['groupid'] = trim(strip_tags($this->input->post('maingroup')));
		
		$records = $this->common_model->get_records("category","*",$values);
		if(!empty($records)){
			foreach($records as $tmp){
				echo "<option value='$tmp->categoryid'>$tmp->categoryname</option>";
			}
		}
	}
	
	public function get_subcategory(){
		$values['categoryid'] = trim(strip_tags($this->input->post('category')));
		
		$records = $this->common_model->get_records("subcategory","*",$values);
		if(!empty($records)){
			foreach($records as $tmp){
				echo "<option value='$tmp->subcategoryid'>$tmp->subcategoryname</option>";
			}
		}
	}
	
	
	public function get_subsubcategory_record(){
		
		$values['subsubcategoryid'] = trim(strip_tags($this->input->post('subsubcategory')));
		
		$records = (array) $this->sys_model->get_subsubcategory_record($values['subsubcategoryid']);
		
		echo json_encode($records);
	}
	
	
	public function save_account_subcategory(){
		
		$values['subcategoryid'] = trim(strip_tags($this->input->post('subcategory_new')));
		$values['subsubcategoryname'] = trim(strip_tags($this->input->post('subsubcategory')));
				
				
		$this->common_model->insert("subsubcategory",$values);
				
		$this->session->set_flashdata("subcategory","Subcategory Created Successfuly");	
				
		redirect('web/account_subcategory');
	}
	
	
	public function addaccountname(){
		$this->form_validation->set_rules('maingroup', 'Main Group', 'trim|required');        
        $this->form_validation->set_rules('category', 'Category', 'required');
        $this->form_validation->set_rules('acname', 'Account Name', 'required');

        if ($this->form_validation->run() == FALSE){			
			$data['maingroup'] = $this->common_model->get_records("maingroup");
			$data['content'] = 'web/accountname';
			$this->load->view('web/template',$data);
		}else{
			$accountid = trim(strip_tags($this->input->post('accountid')));
			
				$values['accountname'] = trim(strip_tags($this->input->post('acname')));
				$values['company_id'] = get_customercompanyid();
				$values['groupid'] = trim(strip_tags($this->input->post('maingroup')));
				$values['categoryid'] = trim(strip_tags($this->input->post('category')));
				$values['subcategoryid'] = trim(strip_tags($this->input->post('subcategory')));
				$values['subsubcategoryid'] = trim(strip_tags($this->input->post('subsubcategory')));
			if(!$accountid){
									
				$values['createdBy'] = $this->session->userdata('customerid');
				$values['createdTime'] = date("Y-m-d H:i:s");
				
				$this->common_model->insert("accountnames",$values);
				$output = array(
					'status'	=> 'Success',
					'msg'		=> 'Account Name Added Successfully',
					'accountid' =>  $accountid,
				);
				
				echo json_encode($output);
			}else{
				$where['accountid'] = $accountid;
				
				$values['modifiedBy'] = $this->session->userdata('customerid');
				$values['modifiedTime'] = date("Y-m-d H:i:s");
				
				$this->common_model->update("accountnames",$values,$where);
				$output = array(
					'status'	=> 'Success',
					'msg'		=> 'Account Name Update Successfully',
					'accountid' =>  $accountid,
				);
				
				echo json_encode($output);
			}
		}
	}
	
	public function get_accountname(){
		$values['accountid'] = trim(strip_tags($this->input->post('accountid')));			
		$exists = $this->common_model->get_record("accountnames","*",$values);
		
		echo json_encode($exists);
	}
	
	
	
	public function addcontactaccountname(){
		$this->form_validation->set_rules('maingroup', 'Main Group', 'trim|required');        
        $this->form_validation->set_rules('category', 'Category', 'required');
        $this->form_validation->set_rules('acname', 'Account Name', 'required');

        if ($this->form_validation->run() == FALSE){			
			$data['maingroup'] = $this->common_model->get_records("maingroup");
			$data['content'] = 'web/contacts';
			$this->load->view('web/template',$data);
		}else{
			
				$values['accountname'] = $accountname = trim(strip_tags($this->input->post('acname')));
				$values['company_id'] = get_customercompanyid();
				$values['groupid'] = trim(strip_tags($this->input->post('maingroup')));
				$values['categoryid'] = trim(strip_tags($this->input->post('category')));
				$values['subcategoryid'] = trim(strip_tags($this->input->post('subcategory')));												
				$values['subsubcategoryid'] = trim(strip_tags($this->input->post('subsubcategory')));												
				$values['createdBy'] = $this->session->userdata('customerid');
				$values['createdTime'] = date("Y-m-d H:i:s");
				
				$accid = $this->common_model->insert("accountnames",$values);
				
				$output = array(
					'status'	=> 'Success',
					'msg'		=> 'Account Name Added Successfully',
					'acc_id'	=> $accid,
					'accountname'=>$accountname,
				);
				
				
				echo json_encode($output);
				
			
		}
	}
	
	
	public function accountstatus($id){
		if($id){
			$changestatus = $this->common_model->get_record("accountnames","*",array("status != "=>2,'accountid'=>$id));
			if(count($changestatus)){				
				$where['accountid'] = $id;
				if($changestatus->status == 0){
					$values['status'] = 1;
				}else{
					$values['status'] = 0;
				}
				$values['modifiedBy'] = $this->session->userdata('customerid');
				$values['modifiedTime'] = date("Y-m-d H:i:s");
				$this->common_model->update("accountnames",$values,$where);
			}
			redirect("web/accountsname");
		}else{
			redirect("web/accountsname");
		}
	}
	
	public function deleteaccount($id=''){
		if($id){
			$changestatus = $this->common_model->get_record("accountnames","*",array("status != "=>2,'accountid'=>$id));
			if(count($changestatus)){
				$where['accountid'] = $id;
				$values['status'] = 2;
				$values['modifiedBy'] = $this->session->userdata('customerid');
				$values['modifiedTime'] = date("Y-m-d H:i:s");
				$this->common_model->update("accountnames",$values,$where);
			}
			redirect("web/accountsname");
		}else{
			redirect("web/accountsname");
		}
	}
	
	
	
	public function get_subsubcategory(){
		$values['subcategoryid'] = trim(strip_tags($this->input->post('subcategory')));
		
		$records = $this->common_model->get_records("subsubcategory","*",$values);
		if(!empty($records)){
			foreach($records as $tmp){
				echo "<option value='$tmp->subsubcategoryid'>$tmp->subsubcategoryname</option>";
			}
		}
	}
	
	//Change the default company
	public function update_default_company(){
		$where['company_id != '] = 0;	
		$values['comp'] = 0;
		$this->common_model->update("company",$values,$where);
		
		$where['company_id'] = trim(strip_tags($this->input->post('company_id')));	
		$values['comp'] = 1;
		
		$this->common_model->update("company",$values,$where);
		
		echo json_encode(array("success"=>true));
	}
	//Change the default company

	//change default year	
	public function update_default_year(){
		$where['yearid != '] = 0;	
		$values['comp'] = 0;
		$this->common_model->update("financialyear",$values,$where);
		
		$where['yearid'] = trim(strip_tags($this->input->post('yearid')));	
		$values['comp'] = 1;
		
		$this->common_model->update("financialyear",$values,$where);
		
		echo json_encode(array("success"=>true));
	}
	//change default year
	
	
	//  contacts // 
	
	public function contact()
	{
        $company_id = get_customercompanyid();
		$data['contact'] = 'menu';
		$data['page_title'] 	= "Contact";
		$data['content'] = "web/contact/contact";
		$data['contacttype'] = $this->common_model->get_records("contacttype","*",array('status'=>0));
		$data['maingroup'] = $this->common_model->get_records("maingroup");
		$data['accountnames'] = $this->common_model->get_records("accountnames","*",array("company_id"=>$company_id));
		$data['contacts'] = $this->common_model->get_records("contacts","*",array("company_id"=>$company_id, "status IN (0, 1)"));
		$this->load->view('web/template', $data);
		
	}
	
	public function addcontact(){
		$this->form_validation->set_rules('contacttype', 'Contact Type', 'trim|required');        
        $this->form_validation->set_rules('customername', 'Customer Name', 'trim|required');
        //$this->form_validation->set_rules('phone', 'Phone', 'trim|required');
        //$this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('accountname', 'Account Name', 'trim|required');

        if ($this->form_validation->run() == FALSE){			
			$data['contacttype'] = $this->common_model->get_records("contacttype","*",array('status'=>0));
			$data['accountnames'] = $this->sys_model->get_accountnames();
			$data['contacts'] = $this->common_model->get_records("contacts","*",array("status !="=>2));
			$data['content'] = 'web/contacts';
			$this->load->view('web/template',$data);
		}else{
			$contactid = trim(strip_tags($this->input->post('contactid')));
			
			$values['contacttype'] = trim(strip_tags($this->input->post('contacttype')));
			$values['customername'] = trim(strip_tags($this->input->post('customername')));
			$values['address1'] = trim(strip_tags($this->input->post('address1')));
			$values['address2'] = trim(strip_tags($this->input->post('address2')));
			$values['phone'] = trim(strip_tags($this->input->post('phone')));
			$values['email'] = trim(strip_tags($this->input->post('email')));
			$values['website'] = trim(strip_tags($this->input->post('website')));
			$values['gstregistration'] = trim(strip_tags($this->input->post('gstregistration')));
			$values['bankname'] = trim(strip_tags($this->input->post('bankname')));
			$values['accountnumber'] = trim(strip_tags($this->input->post('accountnumber')));
			
			
			$values['currency'] = trim(strip_tags($this->input->post('currency')));
			$values['notes'] = trim(strip_tags($this->input->post('notes')));
			$values['accountname'] = trim(strip_tags($this->input->post('accountname')));
			
			if(!$contactid){
				$company_id = get_customercompanyid();				
				$values['company_id'] = $company_id;
				$values['createdTime'] = date("Y-m-d H:i:s");			
				
				$this->common_model->insert("contacts",$values);
			}else{
				$where['contactid'] = $contactid;
				$values['modifiedTime'] = date("Y-m-d H:i:s");			
				
				$this->common_model->update("contacts",$values,$where);
			}
			redirect("web/contact");
		}
	}
	
	public function get_contactdetails(){
		
		$values['contactid'] = trim(strip_tags($this->input->post('contactid')));			
		$exists = $this->common_model->get_record("contacts","*",$values);
		
		echo json_encode($exists);
	}
	
	public function contactstatus($id){
		if($id){
			$changestatus = $this->common_model->get_record("contacts","*",array("status != "=>2,'contactid'=>$id));
			if(count($changestatus)){
				$where['contactid'] = $id;
				if($changestatus->status == 0){
					$values['status'] = 1;
				}else{
					$values['status'] = 0;
				}
				$values['modifiedTime'] = date("Y-m-d H:i:s");
				$this->common_model->update_record("contacts",$values,$where);
			}
			redirect("web/contact");
		}else{
			redirect("web/contact");
		}
	}
	
	public function deletecontact($id=''){
		if($id){
			$changestatus = $this->common_model->get_record("contacts","*",array("status != "=>2,'contactid'=>$id));
			if(count($changestatus)){
				$where['contactid'] = $id;
				$values['status'] = 2;
				$values['modifiedTime'] = date("Y-m-d H:i:s");
				$this->common_model->update_record("contacts",$values,$where);
			}
			redirect("web/contact");
		}else{
			redirect("web/contact");
		}
	}
	
	public function ajax(){
		
		$length = $this->input->post("length");
		$start = $this->input->post("start");
		$draw = $this->input->post("draw");
		$search = $this->input->post("search");	
		
		/*if($draw != 1)
			$this->session->set_flashdata('voucher_draw',$draw);*/
		
		/*********Condition***********/
		$startdate = $this->input->post("startdate");	
		$enddate = $this->input->post("enddate");
		$vouchertype = $this->input->post("vouchertype");
		$voucherno = $this->input->post("voucherno");
		$debit = $this->input->post("debit");
		$credit = $this->input->post("credit");
		$reference = $this->input->post("reference");
		
		$where = array();
		if($startdate && $enddate){
			$startdate = date("Y-m-d",strtotime($startdate));
			$enddate = date("Y-m-d",strtotime($enddate));
			$where[] = "voucherdate between '$startdate' and '$enddate'";
		}else{
			$year = get_defaultyeardata();
			if(!empty($year)){
				$where[] = "v.voucherdate between '$year->startdate' and '$year->enddate'";
			}
		}
		
		if($vouchertype){
			$where[] = "v.vouchertype = $vouchertype";
		}
		
		if($voucherno){
			$where[] = "v.voucherno = $voucherno";
		}
		
		if($debit){
			$where[] = "v.totaldebit = $debit";
		}
		
		if($credit){
			$where[] = "v.totalcredit = $credit";
		}
		
		if($reference){
			$where[] = "v.voucherid = vs.voucherid and vs.reference LIKE '%$reference%' ";
			$tablename ="voucher v, voucherrecords vs";
		}
		else{
			$tablename ="voucher v";
		}
		$where = implode(" and ",$where);
		
		/*********Condition***********/
		
		

		$company_id = get_customercompanyid();	
		
		$year = get_defaultyeardata();

		if(!$search['value']){			
			
			if($where)
			{
				
				$vouchers =$this->sys_model->get_voucher_limit_with_condition($start,$length,$tablename,$where);
			
			
			}
			else
				$vouchers =$this->sys_model->get_voucher_limit($start,$length);
			if(!empty($year))
				$count_vouchers =$this->sys_model->get_voucher_for_year($company_id,$year);
			else
				$count_vouchers =$this->common_model->get_records("voucher","*",array("company_id"=>$company_id,"system"=>0,'status'=>"0"));
		}
		else{
			
			$vouchers =$this->sys_model->get_voucher_limit_search($start,$length,$search['value']);
			$count_vouchers =$this->sys_model->get_voucher_limit_search_count($search['value']);
		}

		//$vouchers =$this->sys_model->get_voucher_limit($start,$length);
		//$count_vouchers =$this->common_model->get_records("voucher","*",array("companyid"=>$companyid,"system"=>0,'status'=>"0"));
		
		$main_array = array();
		foreach($vouchers as $tmp){
			$array['check'] = "<input type=checkbox class='tableflat voucherid' name='voucher' id='voucher_".$tmp->voucherid."'>";
			$array['voucher_no'] = $tmp->voucherno;
			$type = '';
			switch($tmp->vouchertype){
				case 1:
					$type = "Payment";
					break;
				case 2:
					$type = "Receipt";
					break;
				case 3:
					$type = "Journal";
					break;
				case 4:
					$type = "Contra";
					break;
				case 5:
					$type = "Purchase";
					break;
				case 6:
					$type = "Sales";
					break;
				case 7:
					$type = "Debit";
					break;
				case 8:
					$type = "Credit";
					break;
			}
			
			
			$array['voucher_type'] = $type; 
			$array['voucher_date'] = date('d-m-y',strtotime($tmp->voucherdate)) ;
			$details = get_voucher_details_text($tmp->voucherid);
			
			if(!empty($details)){
				$strr = array();
				foreach($details as $rtmp){
					if($rtmp->debit != '0.00'){
						$strr[] = "By ".str_replace('"',"",$rtmp->accountname);
					}
					/* if($rtmp->credit != '0.00'){
						$strr[] = "To ".str_replace('"',"",$rtmp->accountname);
					} */
				}
			}
			$array['entry'] = implode(", ",$strr);
			$array['total_debit'] = toDollar($tmp->totaldebit);
			$array['total_credit'] = toDollar($tmp->totalcredit);
			array_push($main_array,$array);
		}
		
		if(count($vouchers)){
			foreach($main_array as $tmp){
				unset($str);
				foreach($tmp as $key=>$temp){
					$str[] =  '"'.$key.'":"'.$temp.'"';
				}
				$str = implode(",",$str);
				$str_tmp[] = "{".$str."}";
			}
			
			$str_tmp = implode(",",$str_tmp);
			
			
			echo '{"draw":'.$draw.',"recordsTotal":'.count($count_vouchers).',"recordsFiltered":'.count($count_vouchers).',"data":['.$str_tmp.']}';
		}
		else
			echo '{"draw":'.$draw.',"recordsTotal":0,"recordsFiltered":0,"data":[]}';
	}
	
	
	public function ajaxsalesinvoice(){
		
		$length = $this->input->post("length");
		$start = $this->input->post("start");
		$draw = $this->input->post("draw");
		$search = $this->input->post("search");	
		
		
		
		/*********Condition***********/
		$startdate = $this->input->post("startdate");	
		$enddate = $this->input->post("enddate");
		$vouchertype = $this->input->post("vouchertype");
		$voucherno = $this->input->post("voucherno");
		$debit = $this->input->post("debit");
		$credit = $this->input->post("credit");
		
		$where = array();
		if($startdate && $enddate){
			$startdate = date("Y-m-d",strtotime($startdate));
			$enddate = date("Y-m-d",strtotime($enddate));
			$where[] = "voucherdate between '$startdate' and '$enddate'";
		}else{
			$year = get_defaultyeardata();
			if(!empty($year)){
				$where[] = "voucherdate between '$year->startdate' and '$year->enddate'";
			}
		}
		
		if($vouchertype){
			$where[] = "vouchertype = $vouchertype";
		}
		
		if($voucherno){
			$where[] = "voucherno = $voucherno";
		}
		
		if($debit){
			$where[] = "totaldebit = $debit";
		}
		
		if($credit){
			$where[] = "totalcredit = $credit";
		}
	
		$where = implode(" and ",$where);
		/*********Condition***********/
		
		

		$company_id = get_customercompanyid();	
		
		$year = get_defaultyeardata();

		if(!$search['value']){			
		
			if($where)
				$vouchers =$this->sys_model->get_voucher_limit_with_condition_salesinvoice($start,$length,$where);
			else
				$vouchers =$this->sys_model->get_voucher_limit_salesinvoice($start,$length);
			if(!empty($year))
				$count_vouchers =$this->sys_model->get_voucher_for_year_salesinvoice($company_id,$year);
			else
				$count_vouchers =$this->common_model->get_records("voucher","*",array("company_id"=>$company_id,"system"=>0,"vouchertype"=>2,'status'=>"0"));
		}
		else{
			
			
			$vouchers =$this->sys_model->get_voucher_limit_search($start,$length,$search['value']);
			$count_vouchers =$this->sys_model->get_voucher_limit_search_count($search['value']);
		}
			
		
		//$vouchers =$this->sys_model->get_voucher_limit($start,$length);
		//$count_vouchers =$this->common_model->get_records("voucher","*",array("companyid"=>$companyid,"system"=>0,'status'=>"0"));
		
		$main_array = array();
		foreach($vouchers as $tmp){
			$array['check'] = "<input type=radio class='tableflat voucherid' name='voucher' id='voucher_".$tmp->voucherid."'>";
			$array['voucher_no'] = $tmp->voucherno;
			$type = '';
			switch($tmp->vouchertype){
				case 1:
					$type = "Payment";
					break;
				case 2:
					$type = "Receipt";
					break;
				case 3:
					$type = "Journal";
					break;
				case 4:
					$type = "Contra";
					break;
			}
			
			
			$array['voucher_type'] = $type; 
			$array['voucher_date'] = date('d-m-Y',strtotime($tmp->voucherdate)) ;
			$details = get_voucher_details_text($tmp->voucherid);
			
			if(!empty($details)){
				$strr = array();
				foreach($details as $rtmp){
					if($rtmp->debit != '0.00'){
						$strr[] = "By ".$rtmp->accountname;
					}
					if($rtmp->credit != '0.00'){
						$strr[] = "To ".$rtmp->accountname;
					}
				}
			}
			$array['entry'] = implode(", ",$strr);
			$array['total_debit'] = toDollar($tmp->totaldebit);
			$array['total_credit'] = toDollar($tmp->totalcredit);
			array_push($main_array,$array);
		}
		
		if(count($vouchers)){
			foreach($main_array as $tmp){
				unset($str);
				foreach($tmp as $key=>$temp){
					$str[] =  '"'.$key.'":"'.$temp.'"';
				}
				$str = implode(",",$str);
				$str_tmp[] = "{".$str."}";
			}
			
			$str_tmp = implode(",",$str_tmp);
			
			
			echo '{"draw":'.$draw.',"recordsTotal":'.count($count_vouchers).',"recordsFiltered":'.count($count_vouchers).',"data":['.$str_tmp.']}';
		}
		else
			echo '{"draw":'.$draw.',"recordsTotal":0,"recordsFiltered":0,"data":[]}';
	}
	
	public function ajaxpurchaseinvoice(){
		
		$length = $this->input->post("length");
		$start = $this->input->post("start");
		$draw = $this->input->post("draw");
		$search = $this->input->post("search");	
		
		
		
		/*********Condition***********/
		$startdate = $this->input->post("startdate");	
		$enddate = $this->input->post("enddate");
		$vouchertype = $this->input->post("vouchertype");
		$voucherno = $this->input->post("voucherno");
		$debit = $this->input->post("debit");
		$credit = $this->input->post("credit");
		
		$where = array();
		if($startdate && $enddate){
			$startdate = date("Y-m-d",strtotime($startdate));
			$enddate = date("Y-m-d",strtotime($enddate));
			$where[] = "voucherdate between '$startdate' and '$enddate'";
		}else{
			$year = get_defaultyeardata();
			if(!empty($year)){
				$where[] = "voucherdate between '$year->startdate' and '$year->enddate'";
			}
		}
		
		if($vouchertype){
			$where[] = "vouchertype = $vouchertype";
		}
		
		if($voucherno){
			$where[] = "voucherno = $voucherno";
		}
		
		if($debit){
			$where[] = "totaldebit = $debit";
		}
		
		if($credit){
			$where[] = "totalcredit = $credit";
		}
	
		$where = implode(" and ",$where);
		/*********Condition***********/
		
		

		$company_id = get_customercompanyid();	
		
		$year = get_defaultyeardata();

		if(!$search['value']){			
		
			if($where)
				$vouchers =$this->sys_model->get_voucher_limit_with_condition_purchaseinvoice($start,$length,$where);
			else
				$vouchers =$this->sys_model->get_voucher_limit_purchaseinvoice($start,$length);
			if(!empty($year))
				$count_vouchers =$this->sys_model->get_voucher_for_year_purchaseinvoiceamtdetails($company_id,$year);
			else
				$count_vouchers =$this->common_model->get_records("voucher","*",array("company_id"=>$company_id,"system"=>0,"vouchertype"=>1,'status'=>"0"));
		}
		else{
			
			
			$vouchers =$this->sys_model->get_voucher_limit_search($start,$length,$search['value']);
			$count_vouchers =$this->sys_model->get_voucher_limit_search_count($search['value']);
		}
			
		
		//$vouchers =$this->sys_model->get_voucher_limit($start,$length);
		//$count_vouchers =$this->common_model->get_records("voucher","*",array("companyid"=>$companyid,"system"=>0,'status'=>"0"));
		
		$main_array = array();
		foreach($vouchers as $tmp){
			$array['check'] = "<input type=radio class='tableflat voucherid' name='voucher' id='voucher_".$tmp->voucherid."'>";
			$array['voucher_no'] = $tmp->voucherno;
			$type = '';
			switch($tmp->vouchertype){
				case 1:
					$type = "Payment";
					break;
				case 2:
					$type = "Receipt";
					break;
				case 3:
					$type = "Journal";
					break;
				case 4:
					$type = "Contra";
					break;
			}
			
			
			$array['voucher_type'] = $type; 
			$array['voucher_date'] = date('d-m-Y',strtotime($tmp->voucherdate)) ;
			$details = get_voucher_details_text($tmp->voucherid);
			
			if(!empty($details)){
				$strr = array();
				foreach($details as $rtmp){
					if($rtmp->debit != '0.00'){
						$strr[] = "By ".$rtmp->accountname;
					}
					if($rtmp->credit != '0.00'){
						$strr[] = "To ".$rtmp->accountname;
					}
				}
			}
			$array['entry'] = implode(", ",$strr);
			$array['total_debit'] = toDollar($tmp->totaldebit);
			$array['total_credit'] = toDollar($tmp->totalcredit);
			array_push($main_array,$array);
		}
		
		if(count($vouchers)){
			foreach($main_array as $tmp){
				unset($str);
				foreach($tmp as $key=>$temp){
					$str[] =  '"'.$key.'":"'.$temp.'"';
				}
				$str = implode(",",$str);
				$str_tmp[] = "{".$str."}";
			}
			
			$str_tmp = implode(",",$str_tmp);
			
			
			echo '{"draw":'.$draw.',"recordsTotal":'.count($count_vouchers).',"recordsFiltered":'.count($count_vouchers).',"data":['.$str_tmp.']}';
		}
		else
			echo '{"draw":'.$draw.',"recordsTotal":0,"recordsFiltered":0,"data":[]}';
	}
	
	
}
