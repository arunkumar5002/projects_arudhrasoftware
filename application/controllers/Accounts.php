<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Accounts extends CI_Controller
{

    public function index()
	{
		
		
	}

	public function new_closing_stock_list()
	{

		$data['new_closing_stock_list'] = 'menu';

		$data['content'] = "web/accounts/new_closing_stock_list";

		$this->load->view('web/template', $data);
	}
	
	public function closing_closing_submit(){
		
		$row_id	 = $this->input->post('row_id');
		$date 	= (!empty($this->input->post('date')))?date('Y-m-d',strtotime($this->input->post('date'))):'';
	
		

		$data_arr = array(
			'stock' 	=> $this->input->post('stock'),
			'status' 	=> $this->input->post('status'),
			
		);
		if(empty($row_id)){
			$data_arr['created_at'] = date('Y-m-d h:i:s');
	
			$this->common_model->insert('voucher',$data_arr);
			$output = array(
				'status'	=> 'Success',
				'msg'		=> 'closing  Added Successfully',
			);
		}else{
			$data_arr['updated_at'] = date('Y-m-d h:i:s');
			
			$where = "id='$row_id'";
			$this->common_model->update('voucher',$data_arr,$where);
			$output = array(
				'status'	=> 'Success',
				'msg'		=> 'closing Updated Successfully',
			);
		}
		echo json_encode($output);
	}
	
	
		public function list_closing_submit(){
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
	
	// Customer Receipt start 
	
	
	
	
	
	
	public function get_accountname(){
		$row = $this->input->post('key');
		
		$records = $this->sys_model->get_accountname_ajax($row);
		$main_array = array();
		if(!empty($records) && count($records)){
			
			foreach($records as $tmp){
				$tmp_array['id'] = $tmp->accountid;
				$tmp_array['value'] = $tmp->accountname;				
				array_push($main_array,$tmp_array);
			}
			
		}	
		echo json_encode($main_array);		
	}
	
	public function get_towhom(){
		$row = $this->input->post('key');
		$type = $this->input->post('type');
		
		$records = $this->sys_model->get_towhom_ajax($row,$type);
		$main_array = array();
		if(!empty($records) && count($records)){
			
			foreach($records as $tmp){
				$tmp_array['value'] = $tmp->towhom;				
				array_push($main_array,$tmp_array);
			}
			
		}	
		echo json_encode($main_array);	
	}

	
	public function customer_receipt(){
		if(!empty($_POST)){
			$data['search']['startdate'] = $_POST['startdate'];
			$data['search']['enddate'] = $_POST['enddate'];
			$data['search']['vouchertype'] = $_POST['vouchertype'];
			$data['search']['voucherno'] = $_POST['voucherno'];
			$data['search']['debit'] = $_POST['debit'];
			$data['search']['credit'] = $_POST['credit'];			
		}
		
		
		$company_id = get_customercompanyid();
		$data['page_title'] = "Customer Receipt";
		$data['content'] = "web/finance/customer_receipt";
		$yeardata = get_defaultyeardata();
		$data['vouchers'] =$this->common_model->get_records("voucher","*",array("company_id"=>$company_id,"vouchertype"=>2,'invoiceno !='=>0,"system"=>0,'status'=>"0"));
		
		
		$this->load->view('web/template',$data);
	}
	
	
	
	public function purchasevouchers(){
		if(!empty($_POST)){
			$data['search']['startdate'] = $_POST['startdate'];
			$data['search']['enddate'] = $_POST['enddate'];
			$data['search']['vouchertype'] = $_POST['vouchertype'];
			$data['search']['voucherno'] = $_POST['voucherno'];
			$data['search']['debit'] = $_POST['debit'];
			$data['search']['credit'] = $_POST['credit'];			
		}
		
		
		$company_id = get_customercompanyid();
		$data['page_title'] 	= "Supplier Receipt";
		$data['content'] = "web/finance/purchasevouchers";
		$yeardata = get_defaultyeardata();
		$data['vouchers'] =$this->common_model->get_records("voucher","*",array("company_id"=>$company_id,"vouchertype"=>1,'invoiceno !='=>0,"system"=>0,'status'=>"0"));
		
		
		$this->load->view('web/template',$data);
	}
	
	
	/**************  Grn ****************/
	
	public function grns(){
		
		$company_id = get_customercompanyid();
		$data['grns'] = $this->common_model->get_records("grn","*",array('status !='=> 2,"company_id"=>$company_id));
		$data['page_title'] 	= "Goods Received Note";
		$data['content'] = 'web/inventory_master/grns';	
		$this->load->view('web/template',$data);
	}
	
	
	public function grn(){
		
		$data['order_list'] = $this->sys_model->get_purchase_order_list();
		$data['page_title'] 	= "Goods Received Note";
			
		$records = $this->common_model->get_records("grn","*");
		$data['grnnumber'] = count($records)+1;	
		
		$data['content'] = 'web/inventory_master/grn';	
		$this->load->view('web/template',$data);
	}
	
	
	public function get_purchaseorderrecords(){
		$purchaseorderid = trim(strip_tags($this->input->post('orderid')));
		
		$data['records'] = $this->sys_model->get_purchaseorderrecords($purchaseorderid);
				
		$this->load->view('web/purchase/grn_records',$data);		
	}
	
	public function savegrn(){
			
			$grnid =  trim(strip_tags($this->input->post('grnid')));
		    $values['company_id'] = get_customercompanyid();
			
			
			$values['grnnumber'] = trim(strip_tags($this->input->post('grnnumber')));
			$values['purchaseordernum'] = trim(strip_tags($this->input->post('purchaseorder')));
			$values['totalquantity'] = trim(strip_tags($this->input->post('totalquantity')));
			$values['totaldifference'] = trim(strip_tags($this->input->post('totaldifference')));
			$values['notes'] = trim(strip_tags($this->input->post('notes')));
			$values['receivedby'] = trim(strip_tags($this->input->post('receivedby')));
			$values['supplierid'] = trim(strip_tags($this->input->post('suppliername')));
			$values['issuedate'] = date("Y-m-d",strtotime(trim(strip_tags($this->input->post('receiptdate')))));
			
		   if(!$grnid){		
				
				$grnid = $this->common_model->insert("grn",$values);
				unset($values);
				
				$itemcode = $this->input->post('itemcode');
				$received = $this->input->post('received');
				$difference = $this->input->post('difference');
				foreach($itemcode as $key=>$tmp){			
					
					$values['grnid'] = $grnid;
					$values['itemid'] = get_itemid($tmp);
					$values['received'] = $received[$key];
					$values['difference'] = $difference[$key];
					$this->common_model->insert("grnrecords",$values);		
					unset($values);
				}
				
			}else{
				$where['grnid'] = $grnid;
				$this->common_model->update("grn",$values,$where);
				unset($values);
				
				
				$where['grnid'] = $grnid;
				$this->common_model->delete('grnrecords',$where);
				
				$itemname = $this->input->post('itemname');
				$received = $this->input->post('received');
				$difference = $this->input->post('difference');
				foreach($itemname as $key=>$tmp){			
					
					$values['grnid'] = $grnid;
					$values['itemid'] = get_itemname($tmp);
					$values['received'] = $received[$key];
					$values['difference'] = $difference[$key];
					$this->common_model->insert("grnrecords",$values);		
					unset($values);
				}
				
			}
		redirect('Accounts/grns');
	}
	
	public function deletegrn($id){
		if($id){	
				$where['grnid'] = $id;
				$values['status'] = 2;
				$this->common_model->update("grn",$values,$where);			
				unset($values);
				
				redirect("Accounts/grns");
		}else{
				redirect("Accounts/grns");
		}
	}
	
	
	public function editgrn($id){
		
		$company_id = get_customercompanyid();	
		$data['page_title'] 	= "Edit Goods Received Note";
		$details = $data['details'] = $this->common_model->get_record("grn","*",array("company_id"=>$company_id,"grnid"=>$id));
		$data['detailsrecords'] = $this->common_model->get_records("grnrecords","*",array("grnid"=>$id));
		$data['purchaseorder'] = $this->common_model->get_record('purchaseorder','*',array("purchaseorderid"=>$details->purchaseordernum));
		$data['order_list'] = $this->sys_model->get_purchase_order_list();
		$records = $this->common_model->get_records("grn","*",array("company_id"=>$company_id));
		$data['grnnumber'] = $data['details']->grnnumber;	
		$data['content'] = 'web/inventory_master/grn';	
		$this->load->view('web/template',$data);
	}
	
	
	public function viewGrn($id){
		$data['content'] = 'web/purchase/viewGrn';
		$data['grn'] = $this->common_model->get_record("grn","*",array("grnid"=>$id));
		$data['grnrecords'] = $this->common_model->get_records("grnrecords","*",array("grnid"=>$id));
		
		$this->load->view('web/template',$data);
	}
	
	
	
	/**************  Gdn starts ****************/
	
	public function gdn(){
		$data['page_title'] 	= "Goods Dispatch Notes";			
		$data['gdn_list'] = $this->common_model->get_records("gdn","*");
		$data['content'] = 'web/inventory_master/gdn';	
		$this->load->view('web/template',$data);
	}
	
	public function newgdn(){
		$company_id = get_customercompanyid();	
		
		$data['page_title'] 	= "New Goods Dispatch Notes";
		
		$data['invoice_list'] = $this->sys_model->get_sales_invoice_list($company_id);
		
        //$data['gst'] = $this->common_model->get_records();
		
		$records = $this->common_model->get_records("gdn","*",array("company_id"=>$company_id));
		$data['gdnnumber'] = count($records)+1;	
		
		$data['content'] = 'web/inventory_master/newgdn';
		
		$this->load->view('web/template',$data);
	}
	
	public function get_invoiceusinggdn(){
		$values['salesinvoiceid'] = trim(strip_tags($this->input->post('invoiceid')));
		
		$company_id = get_customercompanyid();	
		
		$record = $this->common_model->get_record("salesinvoice","customerid,totalamount,vat",$values);
		$record->customername = get_contactname($record->customerid);
		
		$data = $this->sys_model->get_invoice_total_quantity($values['salesinvoiceid']);
		$record->quantity = $data->quantity;
			
		echo json_encode($record);
	}  


	public function get_invoicerecordsusinggdn(){
		$invoiceid = trim(strip_tags($this->input->post('invoiceid')));
		//print_r($invoiceid);
	    $data['records'] = $this->sys_model->get_salesinvoice_records_gdn($invoiceid);
		//print_r($data);
				
		$this->load->view('web/inventory_master/gdn_invoice_records',$data);		
	}
	
	public function savesalesgdn(){
		
		
		$values['gdnnumber'] = trim(strip_tags($this->input->post('gdnnumber')));
		$values['salesinvoiceid'] = trim(strip_tags($this->input->post('invoiceid')));
		$values['customerid'] = trim(strip_tags($this->input->post('customerid')));
		$values['company_id'] = get_customercompanyid();	
		
		$values['issuedate'] = date("Y-m-d",strtotime($this->input->post('issuedate')));
		//$values['vat'] = trim(strip_tags($this->input->post('vat')));
		$values['totalquantity'] = trim(strip_tags($this->input->post('totalquantity')));
		$values['totaldispatched'] = trim(strip_tags($this->input->post('totaldispatched')));
		$values['status'] = 0;
		
			
		$values['createdTime'] = date("Y-m-d H:i:s");	
		
		$gdnid = $this->common_model->insert("gdn",$values);	
		unset($values);
		
		$items = $this->input->post('itemcode');
		$dispatched = $this->input->post('dispatched');
		
		
		foreach($items as $key=>$tmp){
			$values['gdnid'] = $gdnid;			
			$values['itemid'] = $tmp;
			$values['dispatched'] = $dispatched[$key];			
			$this->common_model->insert("gdnrecords",$values);	
			unset($values);	
		}
		
		redirect('Accounts/gdn');
		
	}
	
	
	/*************************** Quick Sales Invoice Start **************************/
	
	public function quickinvoicelist(){
		
		$company_id = get_customercompanyid();
		$data['content'] = 'web/sales/quickinvoicelist';		
		$data['invoices'] = $this->common_model->get_records("salesinvoice","*",array("status"=>0,"company_id"=>$company_id,'quickinvoice'=>1));			
		$this->load->view('web/template',$data);
	}
	
	public function quickinvoice(){
		
		$company_id = get_customercompanyid();
		$data['vat'] = $this->common_model->get_record("company","company_id,vat", array("company_id"=>$company_id));
		$data['content'] = 'web/sales/quickinvoice';	
		$records = $this->common_model->get_records("salesinvoice","*",array("company_id"=>$company_id));
		$data['invoicenumber'] = count($records) + 1;	
		$data['accountnames'] = $this->sys_model->get_accountnames();
		$data['customers'] = $this->common_model->get_records("contacts","contactid,customername",array('contacttype !='=>2,"company_id"=>$company_id));	
		$data['itemmaster'] = $this->common_model->get_records("itemmaster","*",array("status"=>0,"company_id"=>$company_id));	
		$data['taxmaster'] = $this->common_model->get_records("taxmaster","*",array("status"=>0,"company_id"=>$company_id));	
		$this->load->view('web/template',$data);
	}
	
	public function quickinvoiceRow(){
		
		$data['rowid'] = trim(strip_tags($this->input->post('rowid')));			
		$company_id = get_customercompanyid();		
		$data['itemmaster'] = $this->common_model->get_records("itemmaster","*",array("status"=>0,"company_id"=>$company_id));			
		$this->load->view('web/sales/quickinvoiceRow',$data);
	}
	
	public function viewQuickInvoice($id){
		
		$company_id = get_customercompanyid();	
		$data['order1'] = $this->common_model->get_record("salesinvoice","*",array("salesinvoiceid"=>$id,"company_id"=>$company_id));
		$data['order2'] = $this->common_model->get_records("salesinvoicerecords","*",array("invoiceid"=>$id));
		
		$data['fromCompany'] = $this->common_model->get_record('company','*',array("company_id"=>$company_id));
		$data['toCompany'] = $this->common_model->get_record('contacts','*',array("contactid"=>$data['order1']->customerid));
		$data['content'] = "web/sales/viewQuickInvoice";
		$this->load->view('web/template',$data);
	}
	
	public function savequickinvoice(){
		
		
		$salesinvoiceid = trim(strip_tags($this->input->post('salesinvoiceid')));
		
		$values['company_id'] = get_customercompanyid();
		$values['invoicedate'] = date("Y-m-d",strtotime(trim(strip_tags($this->input->post('invoicedate')))));
		$values['invoicenumber'] = trim(strip_tags($this->input->post('invoicenumber')));
		$values['customerid'] = trim(strip_tags($this->input->post('customername')));
		$values['ordernum'] = 0;
		$values['vat'] = trim(strip_tags($this->input->post('vat')));
		$values['totalamount'] = trim(strip_tags($this->input->post('totalamount')));
		$values['conditions'] = $this->input->post('terms');
		$values['quickinvoice'] = 1;
		if(trim(strip_tags($this->input->post('bank_name')))){
			$bank_name = trim(strip_tags($this->input->post('bank_name')));
			$bank_name = explode("_",$bank_name);
			$values['bank_name'] = $bank_name[0];
		}
		$values['account_num'] = trim(strip_tags($this->input->post('account_num')));
		$values['preparedby'] = trim(strip_tags($this->input->post('preparedby')));
		$values['authorizedby'] = trim(strip_tags($this->input->post('authorizedby')));
		
		if(!$salesinvoiceid){
			
			$values['createdTime'] = date("Y-m-d H:i:s");	
			
			$invoiceid = $this->common_model->insert('salesinvoice',$values);		
			unset($values);		
			
			/***********System Voucher Entry************/
			$company_id = get_customercompanyid();			
			$records = $this->common_model->get_records("voucher","*",array("company_id"=>$company_id,'vouchertype'=>'3'));
			$values['voucherno'] = count($records)+1;
			$values['vouchertype'] = 3;
			$values['company_id'] = $company_id;
			$values['voucherdate'] = date("Y-m-d",strtotime(trim(strip_tags($this->input->post('invoicedate')))));
			$values['preparedby'] = trim(strip_tags($this->input->post('preparedby')));
			$values['totaldebit'] = trim(strip_tags($this->input->post('totalamount')));
			$values['totalcredit'] = trim(strip_tags($this->input->post('totalamount')));
				
			$values['createdTime'] = date("Y-m-d H:i:s");	
			$values['system'] = 1;	
			$voucherid = $this->common_model->insert('voucher',$values);
			unset($values);	
			
			/*********** System Voucher Entry ************/
			
			$itemcode = $this->input->post('itemcode');
			$itemname = $this->input->post('itemname');
			$quantity = $this->input->post('quantity');
			$unitprice = $this->input->post('unitprice');
			$amount = $this->input->post('totalprice');
			$description = $this->input->post('description');
			foreach($itemcode as $key=>$tmp){
				$values['invoiceid'] = $invoiceid;
				$values['itemcode'] = $tmp;
				$values['itemname'] = $itemname[$key];
				$values['quantity'] = $quantity[$key];
				$values['unitprice'] = $unitprice[$key];
				$values['amount'] = $amount[$key];
				$values['description'] = $description[$key];
				$this->common_model->insert('salesinvoicerecords',$values);
				unset($values);			
				
				/***********System Voucher Entry************/
				$values['voucherid'] = $voucherid;
				$values['accountname'] = get_item_account($tmp);
				$values['credit'] = $amount[$key];
				$this->common_model->insert('voucherrecords',$values);
				unset($values);
				/***********System Voucher Entry************/		
			}
			
			/***********System Voucher Entry************/
				$values['voucherid'] = $voucherid;
				$values['accountname'] = get_customer_account($tmp);
				$values['debit'] = trim(strip_tags($this->input->post('totalamount')));
				$this->common_model->insert('voucherrecords',$values);
				unset($values);
			/***********System Voucher Entry************/	
		
		}else{
			
			
			$values['modifiedTime'] = date("Y-m-d H:i:s");	
			
			$where['salesinvoiceid'] = $salesinvoiceid;
			
			$this->common_model->update('salesinvoice',$values,$where);		
			unset($values);	
			
		}
		
		redirect('Accounts/quickinvoicelist');
	}
	
	
	public function deleteQuick($id){
		if($id){			
			
				$where['salesinvoiceid'] = $id;
				$values['status'] = 2;
				$values['modifiedBy'] = $this->session->userdata("customerid");	
				$values['modifiedTime'] = date("Y-m-d H:i:s");
				$this->common_model->update("salesinvoice",$values,$where);			
				unset($values);
				
			redirect("Accounts/quickinvoicelist");
		}else{
			redirect("Accounts/quickinvoicelist");
		}
	}
	
	
	public function vouchers(){
		
		$this->session->set_userdata('trial_tally','');
		$this->session->set_userdata('tally_look','');
		$this->session->set_userdata('tally_look_start','');
		$this->session->set_userdata('tally_look_end','');
		$this->session->set_userdata('reports_tally','');	
		$this->session->set_userdata('profit_tally','');	
		$this->session->set_userdata('fulltrial_tally','');	
		
		if(!empty($_POST)){
			$data['search']['startdate'] = $_POST['startdate'];
			$data['search']['enddate'] = $_POST['enddate'];
			$data['search']['vouchertype'] = $_POST['vouchertype'];
			$data['search']['voucherno'] = $_POST['voucherno'];
			$data['search']['debit'] = $_POST['debit'];
			$data['search']['credit'] = $_POST['credit'];			
			$data['search']['reference'] = $_POST['reference'];			
		}
		
		$company_id = get_customercompanyid();
		$data['voucher'] = 'menu';
		$data['page_title'] 	= "Transaction Vouchers List";
		$data['content'] = 'web/finance/voucher';
		$yeardata = get_defaultyeardata();
		$data['vouchers'] =$this->common_model->get_records("voucher","*",array("company_id"=>$company_id,"system"=>0,'status'=>"0"));
		$this->load->view('web/template',$data);
	}
	
	public function voucher($id='',$vouchertype='',$voucherdate=''){
		
		
		if(isset($vouchertype) && !empty($vouchertype) && isset($voucherdate) && !empty($voucherdate) )
		{
			$data['vouchertype']=$vouchertype;
			$data['voucherdate']=$voucherdate;
		}
		
		if($id != '' && $id != 0){
			
			$where['voucherid'] = $id;
			if($id){
				$data = (array) $this->common_model->get_record("voucher","*",$where);
				$data['vouchernumber'] = $data['voucherno'];
			}else{
				$company_id = get_customercompanyid();		
				$records = $this->common_model->get_records("voucher","*",array("company_id"=>$company_id,"vouchertype"=>$vouchertype));
				$data['vouchernumber'] = count($records)+1;
			}
			
			$data['next'] = $this->common_model->get_next_record("voucher","voucherid",$id);
			$productval = $this->common_model->get_previous_record("voucher","voucherid",$id);
			if(isset($productval->voucherid))
			$data['previous'] = $productval->voucherid;
			$data['records'] = $this->common_model->get_records("voucherrecords","*",$where);
			
			
		}else{
			$company_id = get_customercompanyid();			
			$records = $this->common_model->get_records("voucher","*",array("company_id"=>$company_id,"vouchertype"=>1));
			
			$data['vouchernumber'] = count($records)+1;
			
			$temp = $this->sys_model->get_latest_voucher_authorized();
			if(isset($temp->authorizedby))
				$data['authorizedby'] = $temp->authorizedby;
				
			$id = $this->common_model->get_last_voucher_record();
			if(isset($id->voucherid))
				$data['previous'] = $id->voucherid;
			
			
		}
		$data['maingroup'] = $this->common_model->get_records("maingroup");
		$data['accountnames'] = $this->sys_model->get_accountnames();
		$data['content'] = 'web/finance/vouchers';
		$data['page_title'] 	= "Voucher Create";
		
		$this->load->view('web/template',$data);
	}
	
	
	public function get_voucherrow(){
		$data['row'] = $this->input->post('row');
		$this->load->view('web/finance/voucherRow',$data);
	}
	
	
	public function savevoucher(){
		
		$this->form_validation->set_rules('vouchernumber', 'Voucher Number', 'trim|required');        
        $this->form_validation->set_rules('voucherdate', 'Voucher Date', 'trim|required');
        $this->form_validation->set_rules('preparedby', 'Prepared By', 'trim|required');
       // $this->form_validation->set_rules('towhom', 'To Whom', 'trim|required');

        if ($this->form_validation->run() == FALSE){			
			redirect('accounts/voucher');
		}else{
			$voucherid = trim(strip_tags($this->input->post('voucherid')));
			$saveprint =trim(strip_tags( $this->input->post('saveprint')));
		
			$values['voucherno'] = trim(strip_tags($this->input->post('vouchernumber')));
			$values['vouchertype'] = $data['vouchertype'] = trim(strip_tags($this->input->post('vouchertype')));
			$values['jtype'] = trim(strip_tags($this->input->post('vtype_journal')));
			$values['company_id'] = get_customercompanyid();
			$values['voucherdate'] = $data['voucherdate'] =  date("Y-m-d",strtotime(trim(strip_tags($this->input->post('voucherdate')))));
			$values['preparedby'] = trim(strip_tags($this->input->post('preparedby')));
			$values['authorizedby'] = trim(strip_tags($this->input->post('authorizedby')));
			$values['towhom'] = trim(strip_tags($this->input->post('towhom')));
			$values['totaldebit'] = trim(strip_tags($this->input->post('totaldebit')));
			$values['totalcredit'] = trim(strip_tags($this->input->post('totalcredit')));
			$values['narration'] = trim(strip_tags($this->input->post('narration')));
			
			$supplies_type = trim(strip_tags($this->input->post('supplies_type')));
			if($supplies_type){
				$values['supplies_type'] = trim(strip_tags($this->input->post('supplies_type')));
			}
			
			$values['voucherlink'] = trim(strip_tags($this->input->post('voucherlink')));
			
			$values['billno'] = trim(strip_tags($this->input->post('bill_num')));
			
			$values['totaldebit'] = str_replace(",","",$values['totaldebit']);
			$values['totalcredit'] = str_replace(",","",$values['totalcredit']);
		
			
			if(!$voucherid){	
				$edit = false;
							
				$values['createdBy'] = $this->session->userdata("customerid");	
				$values['createdTime'] = date("Y-m-d H:i:s");	
				
				$voucherid = $this->common_model->insert("voucher",$values);
				$this->session->set_flashdata("voucher_created","Voucher Created Successfuly");
			}else{
				$edit = true;
				
				
				//edit voucher
				$values['modifiedBy'] = $this->session->userdata("customerid");	
				$values['modifiedTime'] = date("Y-m-d H:i:s");	
				
				$where['voucherid'] = $voucherid;
				$this->common_model->update("voucher",$values,$where);
				
				$this->common_model->delete("voucherrecords",$where);
				unset($where);
				$this->session->set_flashdata("voucher_created","Voucher Updated Successfuly");
			}
			
			unset($values);
			
			$accountname = $this->input->post("accountname");
			$debit = $this->input->post("debit");
			$credit = $this->input->post("credit");
			$reference = $this->input->post("reference");
			if(!empty($accountname) && count($accountname)){
				foreach($accountname as $key=>$tmp){
					if($tmp){
						$values['voucherid'] = $voucherid;
						$values['accountname'] = get_accountid($tmp);
						$values['debit'] = $debit[$key];					
						$values['credit'] = $credit[$key];					
						$values['reference'] = $reference[$key];					
						$this->common_model->insert("voucherrecords",$values);
						unset($values);
					}
				}
			}
			
			$this->session->set_flashdata('savevoucher','Voucher Created Successfully');
			
			$data['id']=0;
			
			if(isset($saveprint) && !empty($saveprint) && ($saveprint == "print"))
			{				
				redirect('reports/printVoucher/'.$voucherid);
							
			}
			
				
			
				if(!$edit){
					redirect('accounts/voucher/'.$data['id'].'/'.$data['vouchertype'].'/'.$data['voucherdate']);
				}else{				
					
					if($this->session->userdata('fulltrial_tally')){
						$trial = $this->session->userdata('fulltrial_tally');
						redirect('reports/trialbalancefull/'.$trial);	
					}else if($this->session->userdata('trial_tally')){
						$trial = $this->session->userdata('trial_tally');
						redirect('reports/trialbalance/'.$trial);						
					}else if($this->session->userdata('profit_tally')){
						$bal = $this->session->userdata('profit_tally');
						redirect('reports/profitandloss/'.$bal);						
					}elseif($this->session->userdata('tally_look')){
						$accountname_tally = $this->session->userdata('tally_look');
						$tally_start = $this->session->userdata('tally_look_start');
						$tally_end = $this->session->userdata('tally_look_end');
						
						redirect('reports/ledger/'.$accountname_tally.'/'.$tally_start.'/'.$tally_end);
					}else if($this->session->userdata('reports_tally')){
						$bal = $this->session->userdata('reports_tally');
						redirect('reports/balancesheet/'.$bal);
					}else{					
						redirect('accounts/voucher/'.$voucherid);
					}
				}
			
		}
		
	}
	
	public function deleteVoucher($ids){
		if($ids){			
			$ids = explode("_",$ids);
			foreach($ids as $id){
				$where['voucherid'] = $id;
				$values['status'] = 2;
				$values['modifiedBy'] = $this->session->userdata("customerid");	
				$values['modifiedTime'] = date("Y-m-d H:i:s");
				$this->common_model->update("voucher",$values,$where);			
				unset($values);
				
				$where['voucherid'] = $id;
				$values['status'] = 2;
				$this->common_model->update("voucherrecords",$values,$where);
				$this->session->set_flashdata("voucher_created","Voucher Deleted Successfuly");
			}
				
			redirect("accounts/vouchers");
		}else{
			redirect("accounts/vouchers");
		}
	}
	
	
	public function purchaseorder(){
		$company_id = get_customercompanyid();		
		$data['content'] = 'accounts/purchaseorder';
		
		$data['quote_list'] = $this->sys_model->get_purchase_quote_list();
  		$data['accountnames'] = $this->sys_model->get_accountnames();
		$records = $this->common_model->get_records("purchaseorder","*",array("company_id"=>$company_id));
		$data['ordernum'] = count($records)+1;	
			
		$data['suppliers'] = $this->common_model->get_records("contacts","contactid,customername",array("contacttype"=>2,"companyid"=>$companyid));	
		$data['itemmaster'] = $this->common_model->get_records("itemmaster","*",array("status"=>0,"company_id"=>$company_id));	
		$data['taxmaster'] = $this->common_model->get_records("taxmaster","*",array("status"=>0,"company_id"=>$company_id));	
		$this->load->view('web/template',$data);
	}
	
	
	public function editPurchaseOrder($id){
		$companyid = get_customercompanyid();		
		$data['content'] = 'accounts/purchaseorder';
		
		
		$data['details'] = $this->common_model->get_record("purchaseorder","*",array("companyid"=>$companyid,'purchaseorderid'=>$id));
		$data['detailsrecords'] = $this->common_model->get_records("purchaseorderrecords","*",array('purchaseorderid'=>$id));
		
		$data['quote_list'] = $this->sys_model->get_purchase_quote_list();
  		$data['accountnames'] = $this->sys_model->get_accountnames();
		$records = $this->common_model->get_records("purchaseorder","*",array("companyid"=>$companyid));
		$data['ordernum'] = $data['details']->purchaseordernum;	
			
		$data['suppliers'] = $this->common_model->get_records("contacts","contactid,customername",array("contacttype"=>2,"companyid"=>$companyid));	
		$data['itemmaster'] = $this->common_model->get_records("itemmaster","*",array("status"=>0,"companyid"=>$companyid));	
		$data['taxmaster'] = $this->common_model->get_records("taxmaster","*",array("status"=>0,"companyid"=>$companyid));	
		$this->load->view('web/template',$data);
	}
	
	public function get_purchaseorderrow(){
		$data['rowid'] = trim(strip_tags($this->input->post('rowid')));			
		$companyid = get_customercompanyid();		
		$data['itemmaster'] = $this->common_model->get_records("itemmaster","*",array("status"=>0,"companyid"=>$companyid));	
		$data['taxmaster'] = $this->common_model->get_records("taxmaster","*",array("status"=>0,"companyid"=>$companyid));	
		$this->load->view('accounts/purchaseorderRow',$data);
	}
	
	public function get_itemdetails(){
		$itemid = trim(strip_tags($this->input->post('itemid')));			
		$data = $this->common_model->get_record("itemmaster","*",array("status"=>0,"itemid"=>$itemid));	
		echo json_encode($data);
	}
	
	public function savepurchaseorder(){
				
		$purchaseorderid = trim(strip_tags($this->input->post('purchaseorderid')));
				
				
				
		$values['companyid'] = get_customercompanyid();
		$values['issuedate'] = date("Y-m-d",strtotime(trim(strip_tags($this->input->post('issuedate')))));
		$values['deliverydate'] = date("Y-m-d",strtotime(trim(strip_tags($this->input->post('deliverydate')))));
		$values['quoteno'] = trim(strip_tags($this->input->post('quotenumber')));
		$values['purchaseordernum'] = trim(strip_tags($this->input->post('ordernum')));
		$values['supplier'] = trim(strip_tags($this->input->post('supplier')));
		$values['totalamount'] = trim(strip_tags($this->input->post('totalamount')));
		$values['authorizedby'] = trim(strip_tags($this->input->post('authorizedby')));
		$values['terms'] = trim(strip_tags($this->input->post('terms')));
		
		if(!$purchaseorderid){
		
			$values['createdBy'] = $this->session->userdata("customerid");	
			$values['createdTime'] = date("Y-m-d H:i:s");	
			
			$purchaseorderid = $this->common_model->insert('purchaseorder',$values);
			unset($values);
		
			$itemname = $this->input->post('itemname');
			$description = $this->input->post('description');
			$quantity = $this->input->post('quantity');
			$unitprice = $this->input->post('unitprice');
			$amount = $this->input->post('amount');
			foreach($itemname as $key=>$tmp){
				$values['purchaseorderid'] = $purchaseorderid;
				$values['itemname'] = $tmp;
				$values['quantity'] = $quantity[$key];
				$values['description'] = $description[$key];
				$values['unitprice'] = $unitprice[$key];
				$values['amount'] = $amount[$key];
				$this->common_model->insert('purchaseorderrecords',$values);
				unset($values);
			}
		
		}else{
			$where['purchaseorderid'] = $purchaseorderid;
		
			$values['modifiedBy'] = $this->session->userdata("customerid");	
			$values['modifiedTime'] = date("Y-m-d H:i:s");	
			
			$this->common_model->update('purchaseorder',$values,$where);
			unset($values);
			
			$this->common_model->delete('purchaseorderrecords',$where);
		
			$itemname = $this->input->post('itemname');
			$description = $this->input->post('description');
			$quantity = $this->input->post('quantity');
			$unitprice = $this->input->post('unitprice');
			$amount = $this->input->post('amount');
			foreach($itemname as $key=>$tmp){
				$values['purchaseorderid'] = $purchaseorderid;
				$values['itemname'] = $tmp;
				$values['quantity'] = $quantity[$key];
				$values['description'] = $description[$key];
				$values['unitprice'] = $unitprice[$key];
				$values['amount'] = $amount[$key];
				$this->common_model->insert('purchaseorderrecords',$values);
				unset($values);
			}
		
		}
		
		redirect('accounts/orders');
	}
	
		
	public function deletePurchaseOrder($id){
		if($id){	
				$where['purchaseorderid'] = $id;
				$values['status'] = 2;
				$values['modifiedBy'] = $this->session->userdata("customerid");	
				$values['modifiedTime'] = date("Y-m-d H:i:s");
				$this->common_model->update("purchaseorder",$values,$where);			
				unset($values);
				
				
				redirect("accounts/orders");
		}else{
				redirect("accounts/orders");
		}
	}
	
	
	/******************Purchase Quotation********************/
	public function purchasequote(){
		$companyid = get_customercompanyid();		
		
		$records = $this->common_model->get_records("purchasequote","*",array("companyid"=>$companyid));
		$data['quotenumber'] = count($records)+1;	
		$data['accountnames'] = $this->sys_model->get_accountnames();
		$data['content'] = 'accounts/purchasequote';	
		$data['customers'] = $this->common_model->get_records("contacts","contactid,customername",array("contacttype"=>2,"companyid"=>$companyid));	
		$data['itemmaster'] = $this->common_model->get_records("itemmaster","*",array("status"=>0,"companyid"=>$companyid));	
		$data['taxmaster'] = $this->common_model->get_records("taxmaster","*",array("status"=>0,"companyid"=>$companyid));	
		$this->load->view('web/template',$data);
	}
	
	
	public function editPurchaseQuote($id){
		$companyid = get_customercompanyid();	
		
		
		$details = $data['details'] = $this->common_model->get_record('purchasequote','*',array('purchasequoteid'=>$id));
		$data['detailsrecords'] = $this->common_model->get_records('purchasequoterecords','*',array('quoteid'=>$id));
		
		
		$data['quotenumber'] = $details->quotenumber;	
		$data['accountnames'] = $this->sys_model->get_accountnames();
		$data['content'] = 'accounts/purchasequote';	
		$data['customers'] = $this->common_model->get_records("contacts","contactid,customername",array("contacttype"=>2,"companyid"=>$companyid));	
		$data['itemmaster'] = $this->common_model->get_records("itemmaster","*",array("status"=>0,"companyid"=>$companyid));	
		$data['taxmaster'] = $this->common_model->get_records("taxmaster","*",array("status"=>0,"companyid"=>$companyid));	
		$this->load->view('web/template',$data);
	}
	
	public function get_purchasequoterow(){
		$data['rowid'] = trim(strip_tags($this->input->post('rowid')));			
		$companyid = get_customercompanyid();		
		$data['itemmaster'] = $this->common_model->get_records("itemmaster","*",array("status"=>0,"companyid"=>$companyid));	
		$data['taxmaster'] = $this->common_model->get_records("taxmaster","*",array("status"=>0,"companyid"=>$companyid));	
		$this->load->view('accounts/purchasequoteRow',$data);
	}
	
	public function savepurchasequote(){		
		
		
		$purchasequoteid = trim(strip_tags($this->input->post('purchasequoteid')));
		
		
			$values['companyid'] = get_customercompanyid();
			$values['quotedate'] = date("Y-m-d",strtotime(trim(strip_tags($this->input->post('issuedate')))));
			$values['quotenumber'] = trim(strip_tags($this->input->post('quotenumber')));
			$values['customerid'] = trim(strip_tags($this->input->post('customername')));
			$values['initiatedby'] = trim(strip_tags($this->input->post('initiatedby')));
			$values['preparedby'] = trim(strip_tags($this->input->post('preparedby')));
			$values['authorizedby'] = trim(strip_tags($this->input->post('authorizedby')));
			$values['totalamount'] = trim(strip_tags($this->input->post('totalamount')));
			
		
		if(!$purchasequoteid){
			$values['createdBy'] = $this->session->userdata("customerid");	
			$values['createdTime'] = date("Y-m-d H:i:s");	
			$quoteid = $this->common_model->insert('purchasequote',$values);
			unset($values);		
			
			$itemname = $this->input->post('itemname');
			$description = $this->input->post('description');
			$quantity = $this->input->post('quantity');
			$unitprice = $this->input->post('unitprice');
			$amount = $this->input->post('amount');
			foreach($itemname as $key=>$tmp){
				$values['quoteid'] = $quoteid;
				$values['itemname'] = $tmp;
				$values['quantity'] = $quantity[$key];
				$values['description'] = $description[$key];
				$values['unitprice'] = $unitprice[$key];			
				$values['amount'] = $amount[$key];
				$this->common_model->insert('purchasequoterecords',$values);
				unset($values);
			}
		
		}else{
			
			$where['purchasequoteid'] = $purchasequoteid;
			$quoteid = $this->common_model->update('purchasequote',$values,$where);
			unset($values);		
			unset($where);		
			
			$where['quoteid'] = $purchasequoteid;
			$this->common_model->delete('purchasequoterecords',$where);
			
			
			$itemname = $this->input->post('itemname');
			$description = $this->input->post('description');
			$quantity = $this->input->post('quantity');
			$unitprice = $this->input->post('unitprice');
			$amount = $this->input->post('amount');
			foreach($itemname as $key=>$tmp){
				$values['quoteid'] = $purchasequoteid;
				$values['itemname'] = $tmp;
				$values['quantity'] = $quantity[$key];
				$values['description'] = $description[$key];
				$values['unitprice'] = $unitprice[$key];			
				$values['amount'] = $amount[$key];
				$this->common_model->insert('purchasequoterecords',$values);
				unset($values);
			}
			
			
			
		}
		redirect('accounts/quotations');
	}
	
	
	
	public function deletePurchaseQuote($id){
		if($id){	
				$where['purchasequoteid'] = $id;
				$values['status'] = 2;
				$values['modifiedBy'] = $this->session->userdata("customerid");	
				$values['modifiedTime'] = date("Y-m-d H:i:s");
				$this->common_model->update("purchasequote",$values,$where);			
				unset($values);
				
				
				redirect("accounts/quotations");
		}else{
				redirect("accounts/quotations");
		}
	}
	

	
	
	
	
	/******************Purchase Quotation********************/
	
	
	
	
	public function purchaseinvoice(){
		$companyid = get_customercompanyid();
		
		$data['order_list'] = $this->sys_model->get_purchase_quote_list_for_invoice();		
		$data['grn_list'] = $this->sys_model->get_grn_list();		
		
		$records = $this->common_model->get_records("purchaseinvoice","*",array("companyid"=>$companyid));
		$data['invoicenumber'] = count($records)+1;	
		
		$data['content'] = 'accounts/purchaseinvoice';	
		$data['customers'] = $this->common_model->get_records("contacts","contactid,customername",array("contacttype"=>2,"companyid"=>$companyid));	
		$data['itemmaster'] = $this->common_model->get_records("itemmaster","*",array("status"=>0,"companyid"=>$companyid));	
		$data['taxmaster'] = $this->common_model->get_records("taxmaster","*",array("status"=>0,"companyid"=>$companyid));	
		$this->load->view('web/template',$data);
	}
	
	public function editPurchaseInvoice($id){
		$companyid = get_customercompanyid();
		
		$data['details'] = $this->common_model->get_record("purchaseinvoice","*",array("purchaseinvoiceid"=>$id));
		$data['detailsrecords'] = $this->common_model->get_records("purchaseinvoicerecords","*",array("invoiceid"=>$id));
		
		$data['order_list'] = $this->sys_model->get_purchase_quote_list_for_invoice();		
		$data['grn_list'] = $this->sys_model->get_grn_list();		
		
		$records = $this->common_model->get_records("purchaseinvoice","*",array("companyid"=>$companyid));
		$data['invoicenumber'] = $data['details']->invoicenumber;	
		
		$data['content'] = 'accounts/purchaseinvoice';	
		$data['customers'] = $this->common_model->get_records("contacts","contactid,customername",array("contacttype"=>2,"companyid"=>$companyid));	
		$data['itemmaster'] = $this->common_model->get_records("itemmaster","*",array("status"=>0,"companyid"=>$companyid));	
		$data['taxmaster'] = $this->common_model->get_records("taxmaster","*",array("status"=>0,"companyid"=>$companyid));	
		$this->load->view('web/template',$data);
	}
	
	public function get_purchaseinvoicerow(){
		$data['rowid'] = trim(strip_tags($this->input->post('rowid')));			
		$companyid = get_customercompanyid();		
		$data['itemmaster'] = $this->common_model->get_records("itemmaster","*",array("status"=>0,"companyid"=>$companyid));	
		$data['taxmaster'] = $this->common_model->get_records("taxmaster","*",array("status"=>0,"companyid"=>$companyid));	
		$this->load->view('accounts/purchaseinvoiceRow',$data);
	}
	
	public function savepurchaseinvoice(){
		
		$purchaseinvoiceid = trim(strip_tags($this->input->post('purchaseinvoiceid')));
		
		$values['companyid'] = get_customercompanyid();
		$values['invoicedate'] = date("Y-m-d",strtotime(trim(strip_tags($this->input->post('issuedate')))));
		$values['invoicenumber'] = trim(strip_tags($this->input->post('invoicenumber')));
		$values['customerid'] = trim(strip_tags($this->input->post('customerid')));
		$values['ordernum'] = trim(strip_tags($this->input->post('orderno')));
		$values['grnnumber'] = trim(strip_tags($this->input->post('grnnumber')));
		$values['totalamount'] = trim(strip_tags($this->input->post('totalamount')));
		$values['preparedby'] = trim(strip_tags($this->input->post('preparedby')));
		$values['authorizedby'] = trim(strip_tags($this->input->post('authorizedby')));
		
		if(!$purchaseinvoiceid){
		
			$values['createdBy'] = $this->session->userdata("customerid");	
			$values['createdTime'] = date("Y-m-d H:i:s");	
			
			$invoiceid = $this->common_model->insert('purchaseinvoice',$values);		
			unset($values);		
			
			/***********System Voucher Entry************/
			$companyid = get_customercompanyid();			
			$records = $this->common_model->get_records("voucher","*",array("companyid"=>$companyid));
			$values['voucherno'] = count($records)+1;
			$values['vouchertype'] = 3;
			$values['companyid'] = $companyid;
			$values['voucherdate'] = date("Y-m-d",strtotime(trim(strip_tags($this->input->post('issuedate')))));
			$values['preparedby'] = logged_user();
			$values['totaldebit'] = trim(strip_tags($this->input->post('totalamount')));
			$values['totalcredit'] = trim(strip_tags($this->input->post('totalamount')));
			$values['createdBy'] = $this->session->userdata("customerid");	
			$values['createdTime'] = date("Y-m-d H:i:s");	
			$values['system'] = 1;	
			$voucherid = $this->common_model->insert('voucher',$values);
			unset($values);		
			/***********System Voucher Entry************/
			
					
			$itemname = $this->input->post('itemname');
			$quantity = $this->input->post('quantity');
			$unitprice = $this->input->post('unitprice');
			$amount = $this->input->post('amount');
			
			
			foreach($itemname as $key=>$tmp){
				$values['invoiceid'] = $invoiceid;
				$values['itemname'] = $tmp;
				$values['quantity'] = $quantity[$key];
				$values['unitprice'] = $unitprice[$key];
				$values['amount'] = $amount[$key];
				$this->common_model->insert('purchaseinvoicerecords',$values);
				unset($values);			
				
				/***********System Voucher Entry************/
				$values['voucherid'] = $voucherid;
				$values['accountname'] = get_item_account($tmp);
				$values['debit'] = $amount[$key];
				$this->common_model->insert('voucherrecords',$values);
				unset($values);
				/***********System Voucher Entry************/		
			}
			
			/***********System Voucher Entry************/
				$values['voucherid'] = $voucherid;
				$values['accountname'] = get_customer_account(trim(strip_tags($this->input->post('customerid'))));
				$values['credit'] = trim(strip_tags($this->input->post('totalamount')));
				$this->common_model->insert('voucherrecords',$values);
				unset($values);
				
				
				$values['voucherid'] = $voucherid;
				$values['accountname'] = inventory_balance_sheet();
				$values['debit'] = trim(strip_tags($this->input->post('totalamount')));
				$this->common_model->insert('voucherrecords',$values);
				unset($values);
				
				$values['voucherid'] = $voucherid;
				$values['accountname'] = inventory_profit_loss();
				$values['credit'] = trim(strip_tags($this->input->post('totalamount')));
				$this->common_model->insert('voucherrecords',$values);
				unset($values);
				
			/***********System Voucher Entry************/	
		}else{
			
			
		}
		
		redirect('accounts/invoices');
	}
	
	
	
	
	public function get_purchaseorderdetails(){
		$values['purchaseorderid'] = trim(strip_tags($this->input->post('orderid')));
		$values['company_id'] = get_customercompanyid();	
		
		$record = $this->common_model->get_record("purchaseorder","issuedate,supplier",$values);		
		$record->supplierid = $record->supplier;
		$record->supplier = get_contactname($record->supplier);
		$record->issuedate = date("d-m-Y",strtotime($record->issuedate));
		
		echo json_encode($record);
	}
	
	
	public function quotations(){
		$companyid = get_customercompanyid();	
		$data['quotations'] = $this->common_model->get_records("purchasequote","*",array("companyid"=>$companyid,"status !="=>'2'));
		$data['content'] = 'accounts/masters/quotations';	
		$this->load->view('web/template',$data);
	}
	
	public function get_purchasequotedetails(){
		$values['purchasequoteid'] = trim(strip_tags($this->input->post('quoteid')));
		$values['companyid'] = get_customercompanyid();	
		
		$record = $this->common_model->get_record("purchasequote","customerid,totalamount",$values);
		/*$record->supplier = get_contactname($record->customerid);
		$record->issuedate = date("d-m-Y",strtotime($record->issuedate));*/
		
		echo json_encode($record);
	}
	
	public function get_purchasequoterecords(){
		$quoteid = trim(strip_tags($this->input->post('quoteid')));
		
		$data['records'] = $this->sys_model->get_purchasequoterecords($quoteid);
				
		$this->load->view('accounts/ajax/order_records',$data);		
	}
	
	public function orders(){
		$companyid = get_customercompanyid();	
		$data['orders'] = $this->common_model->get_records("purchaseorder","*",array("companyid"=>$companyid,"status !="=>'2'));
		$data['content'] = 'accounts/masters/orders';	
		$this->load->view('web/template',$data);
	}
	
	
	
	public function invoices(){
		$companyid = get_customercompanyid();	
		$data['invoices'] = $this->common_model->get_records("purchaseinvoice","*",array("companyid"=>$companyid));
		$data['content'] = 'accounts/masters/invoices';	
		$this->load->view('web/template',$data);
	}
	
	public function get_invoiceusingorder(){
		$values['purchaseordernum'] = trim(strip_tags($this->input->post('orderid')));
		$values['companyid'] = get_customercompanyid();	
		
		$record = $this->common_model->get_record("purchaseorder","supplier,totalamount",$values);
		$record->customerid = $record->supplier;
		$record->customername = get_contactname($record->supplier);
			
		echo json_encode($record);
	}
	
	public function get_invoicerecordsusingorder(){
		$orderid = trim(strip_tags($this->input->post('orderid')));
		
		$data['records'] = $this->sys_model->get_purchaseorder_records_invoice($orderid);
				
		$this->load->view('accounts/ajax/invoice_records',$data);		
	}
	
	public function get_invoiceusinggrn(){
		$values['grnid'] = trim(strip_tags($this->input->post('grnnumber')));
		$values['companyid'] = get_customercompanyid();	
		
		$record = $this->common_model->get_record("grn","supplierid,purchaseordernum",$values);
		$record->customerid = $record->supplierid;
		$record->customername = get_contactname($record->supplierid);
		
		$order = $this->common_model->get_record("purchaseorder","totalamount",array("purchaseorderid"=>$record->purchaseordernum));
		$record->totalamount = $order->totalamount;	
			
		echo json_encode($record);
	}
	
	public function get_invoicerecordsusinggrn(){
		$grnnumber = trim(strip_tags($this->input->post('grnnumber')));
		
		$data['records'] = $this->sys_model->get_grn_records_invoice($grnnumber);
				
		$this->load->view('accounts/ajax/invoice_records',$data);	
	}

	public function get_voucherno(){
		$vouchertype = trim(strip_tags($this->input->post('vouchertype')));
		
		if(isset($vouchertype) && !empty($vouchertype))
		{
			$company_id = get_customercompanyid();			
			$records = $this->common_model->get_records("voucher","*",array("company_id"=>$company_id,"vouchertype"=>$vouchertype));
			echo $count = count($records)+1;
		}	
	}
	
	public function get_billnumber(){
		
			$company_id = get_customercompanyid();
            $current_year = date('Y');				
			$records = $this->common_model->get_records("voucher","*",array("company_id"=>$company_id,"vouchertype"=>2));
			echo $counts = $current_year.sprintf('%03d',count($records)+1);
			
	}
	
	public function ajax_addsupplier()
	{
			$values['contacttype'] = trim(strip_tags($this->input->post('contacttype')));
			$values['customername'] = $customername = trim(strip_tags($this->input->post('customername')));
			$values['phone'] = trim(strip_tags($this->input->post('phone')));
			$values['email'] = trim(strip_tags($this->input->post('email')));
			$values['currency'] = trim(strip_tags($this->input->post('currency')));
			$values['accountname'] = trim(strip_tags($this->input->post('accountname')));
			
			
				$company_id = get_customercompanyid();				
				$values['company_id'] = $company_id;
				$values['createdBy'] = $this->session->userdata('customerid');
				$values['createdTime'] = date("Y-m-d H:i:s");			
				
				$id = $this->common_model->insert("contacts",$values);
			echo $id."&*&%^".$customername;
	}


public function ajax_additemname()
	{				
			$values['itemname'] = $itemname = trim(strip_tags($this->input->post('itemname')));
			$values['price'] = trim(strip_tags($this->input->post('price')));
			$values['accountname'] = trim(strip_tags($this->input->post('accountname')));
			$values['tax'] = trim(strip_tags($this->input->post('tax')));
			$values['quantity'] = trim(strip_tags($this->input->post('quantity')));
			$values['location'] = trim(strip_tags($this->input->post('location')));
			
				$values['company_id'] = get_customercompanyid();		
				$values['createdBy'] = $this->session->userdata("customerid");	
				$values['createdTime'] = date("Y-m-d H:i:s");	
				$id = $this->common_model->insert("itemmaster",$values);
				
			echo $id."&*&%^".$itemname;
				
	}


	public function salesvoucher($id='',$vouchertype='2',$voucherdate='',$invoice = ''){
		
		
		if(isset($vouchertype) && !empty($vouchertype) && isset($voucherdate) && !empty($voucherdate) )
		{
			
			$data['voucherdate']=$voucherdate;
		}
		$data['vouchertype']=$vouchertype;
		
		if($id){
			$where['voucherid'] = $id;
			$where1['voucherid'] = $id;
			$where1['vouchertype'] = 2;
			$where1['invoiceno !='] = 0;
			$data = (array) $this->common_model->get_record("voucher","*",$where1);
			
			if(isset($data['invoiceno']) && !empty($data['invoiceno']))
			{
				$data['invoiceno']=$data['invoiceno'];
				
			}	
			$data['next'] = $this->common_model->get_next_record_sales("voucher","voucherid",$id);
			$productval = $this->common_model->get_previous_record_sales("voucher","voucherid",$id);
			
			
			if(isset($productval) && !empty($productval))
				$data['previous'] = $productval->voucherid;
			
			$data['records'] = $this->common_model->get_records("voucherrecords","*",$where);
			
			if(isset($data['voucherno']) && !empty($data['voucherno']))
			$data['vouchernumber'] = $data['voucherno'];
			
		}else{
			$company_id = get_customercompanyid();			
			$records = $this->common_model->get_records("voucher","*",array("company_id"=>$company_id,"vouchertype"=>2,"status"=>0));
		
			$data['vouchernumber'] = count($records)+1;
			$data['invoicenum'] = $invoice;
			
			$temp = $this->sys_model->get_latest_voucher_authorized();
			if(isset($temp->authorizedby))
				$data['authorizedby'] = $temp->authorizedby;
				
			$id = $this->common_model->get_last_voucher_record_type(2);
			if(isset($id->voucherid))
			$data['previous'] = $id->voucherid;
			
		}
		
		$data['salesinvoiceno'] = $this->common_model->get_salesinvoiceid();
		$data['maingroup'] = $this->common_model->get_records("maingroup");
		$data['accountnames'] = $this->sys_model->get_accountnames();
		$data['salesvoucher'] = 'menu';
		$data['page_title'] 	= "Customer Receipt";
		$data['content'] = "web/finance/salesvoucher";
		$this->load->view('web/template',$data);
		
	 }
	
	
		public function savesalesvoucher(){
		
		$this->form_validation->set_rules('vouchernumber', 'Voucher Number', 'trim|required');        
        $this->form_validation->set_rules('voucherdate', 'Voucher Date', 'trim|required');
        $this->form_validation->set_rules('preparedby', 'Prepared By', 'trim|required');
       // $this->form_validation->set_rules('towhom', 'To Whom', 'trim|required');

        if ($this->form_validation->run() == FALSE){			
			redirect('accounts/voucher');
		}else{
			$voucherid = trim(strip_tags($this->input->post('voucherid')));
			
			$values['voucherno'] = trim(strip_tags($this->input->post('vouchernumber')));
			$values['invoiceno'] = trim(strip_tags($this->input->post('invoiceno')));
			$values['vouchertype'] = $data['vouchertype'] = trim(strip_tags($this->input->post('vouchertype')));
			$values['jtype'] = trim(strip_tags($this->input->post('vtype_journal')));
			$values['company_id'] = get_customercompanyid();
			$values['voucherdate'] = $data['voucherdate'] =  date("Y-m-d",strtotime(trim(strip_tags($this->input->post('voucherdate')))));
			$values['preparedby'] = trim(strip_tags($this->input->post('preparedby')));
			$values['authorizedby'] = trim(strip_tags($this->input->post('authorizedby')));
			$values['towhom'] = trim(strip_tags($this->input->post('towhom')));
			$values['totaldebit'] = trim(strip_tags($this->input->post('totaldebit')));
			$values['totalcredit'] = trim(strip_tags($this->input->post('totalcredit')));
			$values['narration'] = trim(strip_tags($this->input->post('narration')));
			
			
			if(!$voucherid){				
				$values['createdBy'] = $this->session->userdata("customerid");	
				$values['createdTime'] = date("Y-m-d H:i:s");	
				
				$voucherid = $this->common_model->insert("voucher",$values);
				$this->session->set_flashdata("voucher_created","Sales Voucher Created Successfuly");
			}else{
				//edit voucher
				$values['modifiedBy'] = $this->session->userdata("customerid");	
				$values['modifiedTime'] = date("Y-m-d H:i:s");	
				
				$where['voucherid'] = $voucherid;
				$this->common_model->update("voucher",$values,$where);
				
				$this->common_model->delete("voucherrecords",$where);
				unset($where);
				$this->session->set_flashdata("voucher_created","Sales Voucher Updated Successfuly");
			}
			
			unset($values);
			
			$accountname = $this->input->post("accountname");
			$debit = $this->input->post("debit");
			$credit = $this->input->post("credit");
			$reference = $this->input->post("reference");
			if(!empty($accountname) && count($accountname)){
				foreach($accountname as $key=>$tmp){
					if($tmp){
						$values['voucherid'] = $voucherid;
						$values['accountname'] = get_accountid($tmp);
						$values['debit'] = $debit[$key];					
						$values['credit'] = $credit[$key];					
						$values['reference'] = $reference[$key];					
						$this->common_model->insert("voucherrecords",$values);
						unset($values);
					}
				}
			}
			
			$this->session->set_flashdata('savevoucher','Sales Voucher Created Successfully');
			
			$data['id']=0;
			
			redirect('accounts/salesvoucher/'.$data['id'].'/'.$data['vouchertype'].'/'.$data['voucherdate'] );
		}
		
	}
	
	public function salesdeleteVoucher($ids){
		if($ids){			
			$ids = explode("_",$ids);
			foreach($ids as $id){
				$where['voucherid'] = $id;
				$values['status'] = 2;
				$values['modifiedBy'] = $this->session->userdata("customerid");	
				$values['modifiedTime'] = date("Y-m-d H:i:s");
				$this->common_model->update("voucher",$values,$where);			
				unset($values);
				
				$where['voucherid'] = $id;
				$values['status'] = 2;
				$this->common_model->update("voucherrecords",$values,$where);
				$this->session->set_flashdata("voucher_created","Sales Voucher Deleted Successfuly");
			}
				
			redirect("accounts/customer_receipt");
		}else{
			redirect("accounts/customer_receipt");
		}
	}
	
	public function invoicepayment(){
			
			$data['content'] = 'accounts/invoicepayments';		
			$this->load->view('web/template',$data);
	}
	
	
	/****************Purchase Vouchers****************/
	
	
	public function purchasevoucher($id='',$vouchertype='2',$voucherdate='',$invoice = ''){
		
		
		if(isset($vouchertype) && !empty($vouchertype) && isset($voucherdate) && !empty($voucherdate) )
		{
			
		  $data['voucherdate']=$voucherdate;
		}
		$data['vouchertype']=$vouchertype;
		
		if($id){
			$where['voucherid'] = $id;
			$where1['voucherid'] = $id;
			$where1['vouchertype'] = 2;
			$where1['invoiceno !='] = 0;
			$data = (array) $this->common_model->get_record("voucher","*",$where1);
			
			if(isset($data['invoiceno']) && !empty($data['invoiceno']))
			{
				$data['invoiceno']=$data['invoiceno'];
				
			}	
			$data['next'] = $this->common_model->get_next_record_sales("voucher","voucherid",$id);
			$productval = $this->common_model->get_previous_record_sales("voucher","voucherid",$id);
			
			
			if(isset($productval) && !empty($productval))
				$data['previous'] = $productval->voucherid;
			
			$data['records'] = $this->common_model->get_records("voucherrecords","*",$where);
			
			if(isset($data['voucherno']) && !empty($data['voucherno']))
			$data['vouchernumber'] = $data['voucherno'];
			
		}else{
			$company_id = get_customercompanyid();			
			$records = $this->common_model->get_records("voucher","*",array("company_id"=>$company_id,"vouchertype"=>2,"status"=>0));
		
			$data['vouchernumber'] = count($records)+1;
			$data['invoicenum'] = $invoice;
			
			$temp = $this->sys_model->get_latest_voucher_authorized();
			if(isset($temp->authorizedby))
				$data['authorizedby'] = $temp->authorizedby;
				
			$id = $this->common_model->get_last_voucher_record_type(2);
			if(isset($id->voucherid))
				$data['previous'] = $id->voucherid;
			
		}
		
		$data['purchaseinvoiceno'] = $this->common_model->get_purchaseinvoiceid();
		$data['maingroup'] = $this->common_model->get_records("maingroup");
		$data['accountnames'] = $this->sys_model->get_accountnames();
		$data['content'] = 'web/finance/suppliervouchers';
		$data['page_title'] 	= "Supplier Payment";
		
		$this->load->view('web/template',$data);
	}
	
	
	public function savepurchasevoucher(){
		
		$this->form_validation->set_rules('vouchernumber', 'Voucher Number', 'trim|required');        
        $this->form_validation->set_rules('voucherdate', 'Voucher Date', 'trim|required');
        $this->form_validation->set_rules('preparedby', 'Prepared By', 'trim|required');
       // $this->form_validation->set_rules('towhom', 'To Whom', 'trim|required');

        if ($this->form_validation->run() == FALSE){			
			redirect('accounts/voucher');
		}else{
			$voucherid = trim(strip_tags($this->input->post('voucherid')));
			
			$values['voucherno'] = trim(strip_tags($this->input->post('vouchernumber')));
			$values['invoiceno'] = trim(strip_tags($this->input->post('invoiceno')));
			$values['vouchertype'] = $data['vouchertype'] = trim(strip_tags($this->input->post('vouchertype')));
			$values['jtype'] = trim(strip_tags($this->input->post('vtype_journal')));
			$values['company_id'] = get_customercompanyid();
			$values['voucherdate'] = $data['voucherdate'] =  date("Y-m-d",strtotime(trim(strip_tags($this->input->post('voucherdate')))));
			$values['preparedby'] = trim(strip_tags($this->input->post('preparedby')));
			$values['authorizedby'] = trim(strip_tags($this->input->post('authorizedby')));
			$values['towhom'] = trim(strip_tags($this->input->post('towhom')));
			$values['totaldebit'] = trim(strip_tags($this->input->post('totaldebit')));
			$values['totalcredit'] = trim(strip_tags($this->input->post('totalcredit')));
			$values['narration'] = trim(strip_tags($this->input->post('narration')));
			
			
			//print_r($_POST);
			//exit();
			
			if(!$voucherid){				
				$values['createdBy'] = $this->session->userdata("customerid");	
				$values['createdTime'] = date("Y-m-d H:i:s");	
				
				$voucherid = $this->common_model->insert("voucher",$values);
				$this->session->set_flashdata("voucher_created","Purchase Voucher Created Successfuly");
			}else{
				//edit voucher
				$values['modifiedBy'] = $this->session->userdata("customerid");	
				$values['modifiedTime'] = date("Y-m-d H:i:s");	
				
				$where['voucherid'] = $voucherid;
				$this->common_model->update("voucher",$values,$where);
				
				$this->common_model->delete("voucherrecords",$where);
				unset($where);
				$this->session->set_flashdata("voucher_created","Purchase Voucher Updated Successfuly");
			}
			
			unset($values);
			
			$accountname = $this->input->post("accountname");
			$debit = $this->input->post("debit");
			$credit = $this->input->post("credit");
			$reference = $this->input->post("reference");
			if(!empty($accountname) && count($accountname)){
				foreach($accountname as $key=>$tmp){
					if($tmp){
						$values['voucherid'] = $voucherid;
						$values['accountname'] = get_accountid($tmp);
						$values['debit'] = $debit[$key];					
						$values['credit'] = $credit[$key];					
						$values['reference'] = $reference[$key];					
						$this->common_model->insert("voucherrecords",$values);
						unset($values);
					}
				}
			}
			
			$this->session->set_flashdata('savevoucher','Purchase Voucher Created Successfully');
			
			$data['id']=0;
			
			redirect('Accounts/purchasevoucher/'.$data['id'].'/'.$data['vouchertype'].'/'.$data['voucherdate'] );
		}
		
	}
	
	
	public function purchasedeleteVoucher($ids){
		if($ids){			
			$ids = explode("_",$ids);
			foreach($ids as $id){
				$where['voucherid'] = $id;
				$values['status'] = 2;
				$values['modifiedBy'] = $this->session->userdata("customerid");	
				$values['modifiedTime'] = date("Y-m-d H:i:s");
				$this->common_model->update("voucher",$values,$where);			
				unset($values);
				
				$where['voucherid'] = $id;
				$values['status'] = 2;
				$this->common_model->update("voucherrecords",$values,$where);
				$this->session->set_flashdata("voucher_created","Sales Voucher Deleted Successfuly");
			}
				
			redirect("accounts/purchasevoucher");
		}else{
			redirect("accounts/purchasevoucher");
		}
	}
	/****************Purchase Vouchers****************/
	
	
	public function get_purchase_vouchers(){
		
		$company_id = get_customercompanyid();			
		
		$records = $this->common_model->get_records("voucher","*",array('vouchertype'=>5,'status'=>0,'company_id'=>$company_id,'billno <>'=>""));
		
		if(!empty($records)){	
			
			$arr = array();
			foreach($records as $tmp){
				
				$data = $this->common_model->get_records("voucher","*",array('voucherlink'=>$tmp->voucherid,'status'=>0,'company_id'=>$company_id));
				$total = 0.00;
				foreach($data as $temp){
					$total += $temp->totaldebit;
				}
				
				if(isset($total) && $total != $tmp->totaldebit)
					$arr[] = "<option value='".$tmp->voucherid."'>$tmp->billno</option>";
				
			}
			
			if(empty($arr)){
				echo "<option value='0'>NO VOUCHER</option>";
			}else{
				echo "<option value='0'>Select</option>";		
				echo implode("",$arr);
			}
		}else{
			echo "<option value='0'>NO VOUCHER</option>";
		}
	}
	
	public function get_sales_vouchers(){
		$company_id = get_customercompanyid();	
		$records = $this->common_model->get_records("voucher","*",array('vouchertype'=>6,'status'=>0,'company_id'=>$company_id,'billno <>'=>""));
		
		if(!empty($records)){
			$arr = array();
			foreach($records as $tmp){
				
				$data = $this->common_model->get_records("voucher","*",array('voucherlink'=>$tmp->voucherid,'status'=>0,'company_id'=>$company_id));
				$total = 0.00;
				foreach($data as $temp){
					$total += $temp->totaldebit;
				}
								
				if(isset($total) && $total != $tmp->totaldebit)
					$arr[] =  "<option value='".$tmp->voucherid."'>$tmp->billno</option>";
				
			}
			
			if(empty($arr)){
				echo "<option value='0'>NO VOUCHER</option>";
			}else{
				echo "<option value='0'>Select</option>";		
				echo implode("",$arr);
			}
		}else{
			echo "<option value='0'>NO VOUCHER</option>";
		}
	}
	
	
	public function get_voucher_amount(){
		$voucherid = trim(strip_tags($this->input->post('voucherid')));
			
		$records = $this->common_model->get_record("voucher","*",array('voucherid'=>$voucherid));
		
		$data = $this->common_model->get_records("voucher","*",array('voucherlink'=>$voucherid,"status"=>0));
		$total = 0;
		foreach($data as $tmp){
			$total += $tmp->totaldebit;
		}
		
		echo number_format(round(abs($records->totaldebit - $total)),2);
	}
	
	public function voucher_aging(){
		$data['content'] = 'accounts/voucher_aging';		
		$this->load->view('web/template',$data);
	}
	public function voucher_aging_sales(){
		$data['content'] = 'accounts/voucher_aging_sales';		
		$this->load->view('web/template',$data);
	}
	
	public function ajax_voucher_aging(){
		
		$length = $this->input->post("length");
		$start = $this->input->post("start");
		$draw = $this->input->post("draw");
		$search = $this->input->post("search");	
		
		$companyid = get_customercompanyid();	
		
		$year = get_defaultyeardata();
		
		
		$records = $this->common_model->get_records("voucher","*",array('vouchertype'=>5,'status'=>0,'companyid'=>$companyid,'billno <>'=>""));
	
		if(!empty($records)){	
			
			$array = array();
			$main_array = array();
			$sno = 1;
			foreach($records as $tmp){
				
				$data = $this->common_model->get_records("voucher","*",array('voucherlink'=>$tmp->voucherid,'status'=>0,'companyid'=>$companyid));
				$total = 0.00;
				foreach($data as $temp){
					$total += $temp->totaldebit;
				}
				
				if(isset($total) && $total != $tmp->totaldebit){
					
					$date1=date_create($tmp->voucherdate);
					$date2=date_create($year->enddate);
					$diff=date_diff($date1,$date2);
					
					$array['sno'] = $sno++;
					$array['date'] = "<p style='text-align:center'>".date("d-m-Y",strtotime($tmp->voucherdate))."</p>" ;
					$array['customer_name'] = "<p style='text-align:left'>".$tmp->towhom."</p>" ;
					$array['voucherno'] = "<p style='text-align:right'>".$tmp->voucherno."</p>" ;
					$array['billno'] = "<p style='text-align:right'>".$tmp->billno."</p>" ;
					$array['voucher_amount'] = "<p style='text-align:right'>".number_format($tmp->totaldebit,2)."</p>" ;
					$array['paid_amount'] = "<p style='text-align:right'>".number_format($total,2)."</p>" ;
					$array['pending_amount'] = "<p style='text-align:right'>".number_format(($tmp->totaldebit-$total),2)."</p>" ;
					$array['days'] = "<p style='text-align:left'>".$diff->format("%a days")."</p>" ;
					
					
					array_push($main_array,$array);		
				}
				
				
				unset($array);
			}
			
			if(!empty($main_array)){
				$str = array();
				foreach($main_array as $tmp){					
					foreach($tmp as $key=>$temp){
						$str[] =  '"'.$key.'":"'.$temp.'"';
					}
					$str = implode(",",$str);
					$str_tmp[] = "{".$str."}";
					unset($str);
				}
				
				$str_tmp = implode(",",$str_tmp);
				
				
				echo '{"draw":'.$draw.',"recordsTotal":'.count($records).',"recordsFiltered":'.count($records).',"data":['.$str_tmp.']}';
			}else{
				echo '{"draw":'.$draw.',"recordsTotal":0,"recordsFiltered":0,"data":[]}';
			}
			
		}else{
			echo '{"draw":'.$draw.',"recordsTotal":0,"recordsFiltered":0,"data":[]}';
		}
			
	}
	
	
	
	public function pdf_voucher_purchase_aging(){
		
		
		$companyid = get_customercompanyid();	
		
		$year = get_defaultyeardata();
		
		
		$records = $this->common_model->get_records("voucher","*",array('vouchertype'=>5,'status'=>0,'companyid'=>$companyid,'billno <>'=>""));
	
		if(!empty($records)){	
			
			$array = array();
			$main_array = array();
			$sno = 1;
			foreach($records as $tmp){
				
				$data = $this->common_model->get_records("voucher","*",array('voucherlink'=>$tmp->voucherid,'status'=>0,'companyid'=>$companyid));
				$total = 0.00;
				foreach($data as $temp){
					$total += $temp->totaldebit;
				}
				
				if(isset($total) && $total != $tmp->totaldebit){
					
					$date1=date_create($tmp->voucherdate);
					$date2=date_create($year->enddate);
					$diff=date_diff($date1,$date2);
					
					$array['sno'] = $sno++;
					$array['date'] = "<p style='text-align:center'>".date("d-m-Y",strtotime($tmp->voucherdate))."</p>" ;
					$array['customer_name'] = "<p style='text-align:left'>".$tmp->towhom."</p>" ;
					$array['voucherno'] = "<p style='text-align:right'>".$tmp->voucherno."</p>" ;
					$array['billno'] = "<p style='text-align:right'>".$tmp->billno."</p>" ;
					$array['voucher_amount'] = "<p style='text-align:right'>".number_format($tmp->totaldebit,2)."</p>" ;
					$array['paid_amount'] = "<p style='text-align:right'>".number_format($total,2)."</p>" ;
					$array['pending_amount'] = "<p style='text-align:right'>".number_format(($tmp->totaldebit-$total),2)."</p>" ;
					$array['days'] = "<p style='text-align:left'>".$diff->format("%a days")."</p>" ;
					
					
					array_push($main_array,$array);		
				}
				
				
				unset($array);
			}
			
	
			
			$data['main_array'] = $main_array;
		
			tcpdf();
			$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
			$obj_pdf->SetCreator(PDF_CREATOR);
			$title = "Aging Schedule Purchase";
			$obj_pdf->SetTitle($title);
			//$obj_pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $title, PDF_HEADER_STRING);
			$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
			$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
			$obj_pdf->SetDefaultMonospacedFont('helvetica');
			$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
			$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
			//$obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
			$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
			$obj_pdf->SetFont('helvetica', '', 9);
			$obj_pdf->setFontSubsetting(false);
			$obj_pdf->AddPage();
			ob_start();
			
			$message = $this->load->view('accounts/pdf/pdf_voucher_purchase_aging',$data,TRUE);
				
					
			ob_end_clean();
			$obj_pdf ->lastPage();
			$obj_pdf->writeHTML($message, true, false, true, false, '');
			$obj_pdf->Output('Aging_Schedule_Purchase.pdf', 'D');
		
		}else{
			
			redirect('accounts/voucher_aging');
		}
	}
	
	public function print_voucher_purchase_aging(){
		
		
		$companyid = get_customercompanyid();	
		
		$year = get_defaultyeardata();
		
		
		$records = $this->common_model->get_records("voucher","*",array('vouchertype'=>5,'status'=>0,'companyid'=>$companyid,'billno <>'=>""));
	
		if(!empty($records)){	
			
			$array = array();
			$main_array = array();
			$sno = 1;
			foreach($records as $tmp){
				
				$data = $this->common_model->get_records("voucher","*",array('voucherlink'=>$tmp->voucherid,'status'=>0,'companyid'=>$companyid));
				$total = 0.00;
				foreach($data as $temp){
					$total += $temp->totaldebit;
				}
				
				if(isset($total) && $total != $tmp->totaldebit){
					
					$date1=date_create($tmp->voucherdate);
					$date2=date_create($year->enddate);
					$diff=date_diff($date1,$date2);
					
					$array['sno'] = $sno++;
					$array['date'] = "<p style='text-align:center'>".date("d-m-Y",strtotime($tmp->voucherdate))."</p>" ;
					$array['customer_name'] = "<p style='text-align:left'>".$tmp->towhom."</p>" ;
					$array['voucherno'] = "<p style='text-align:right'>".$tmp->voucherno."</p>" ;
					$array['billno'] = "<p style='text-align:right'>".$tmp->billno."</p>" ;
					$array['voucher_amount'] = "<p style='text-align:right'>".number_format($tmp->totaldebit,2)."</p>" ;
					$array['paid_amount'] = "<p style='text-align:right'>".number_format($total,2)."</p>" ;
					$array['pending_amount'] = "<p style='text-align:right'>".number_format(($tmp->totaldebit-$total),2)."</p>" ;
					$array['days'] = "<p style='text-align:left'>".$diff->format("%a days")."</p>" ;
					
					
					array_push($main_array,$array);		
				}
				
				
				unset($array);
			}
			
	
			
			$data['main_array'] = $main_array;
		
			
			
			$this->load->view('accounts/print/print_voucher_purchase_aging',$data);
							
				
		}else{
			
			redirect('accounts/voucher_aging');
		}
	}
	
	
	public function ajax_voucher_aging_sales(){
		
		$length = $this->input->post("length");
		$start = $this->input->post("start");
		$draw = $this->input->post("draw");
		$search = $this->input->post("search");	
		
		$companyid = get_customercompanyid();	
		
		$year = get_defaultyeardata();
		
		
		$records = $this->common_model->get_records("voucher","*",array('vouchertype'=>6,'status'=>0,'companyid'=>$companyid,'billno <>'=>""));
	
		if(!empty($records)){	
			
			$array = array();
			$main_array = array();
			$sno = 1;
			foreach($records as $tmp){
				
				$data = $this->common_model->get_records("voucher","*",array('voucherlink'=>$tmp->voucherid,'status'=>0,'companyid'=>$companyid));
				$total = 0.00;
				foreach($data as $temp){
					$total += $temp->totaldebit;
				}
				
				if(isset($total) && $total != $tmp->totaldebit){
					
					$date1=date_create($tmp->voucherdate);
					$date2=date_create($year->enddate);
					$diff=date_diff($date1,$date2);
					
					$array['sno'] = $sno++;
					$array['date'] = "<p style='text-align:center'>".date("d-m-Y",strtotime($tmp->voucherdate))."</p>" ;
					$array['customer_name'] = "<p style='text-align:left'>".$tmp->towhom."</p>" ;
					$array['voucherno'] = "<p style='text-align:right'>".$tmp->voucherno."</p>" ;
					$array['billno'] = "<p style='text-align:right'>".$tmp->billno."</p>" ;
					$array['voucher_amount'] = "<p style='text-align:right'>".number_format($tmp->totaldebit,2)."</p>" ;
					$array['paid_amount'] = "<p style='text-align:right'>".number_format($total,2)."</p>" ;
					$array['pending_amount'] = "<p style='text-align:right'>".number_format(($tmp->totaldebit-$total),2)."</p>" ;
					$array['days'] = "<p style='text-align:left'>".$diff->format("%a days")."</p>" ;
					
					
					array_push($main_array,$array);		
				}
				
				
				unset($array);
			}
			
			if(!empty($main_array)){
				$str = array();
				foreach($main_array as $tmp){					
					foreach($tmp as $key=>$temp){
						$str[] =  '"'.$key.'":"'.$temp.'"';
					}
					$str = implode(",",$str);
					$str_tmp[] = "{".$str."}";
					unset($str);
				}
				
				$str_tmp = implode(",",$str_tmp);
				
				
				echo '{"draw":'.$draw.',"recordsTotal":'.count($records).',"recordsFiltered":'.count($records).',"data":['.$str_tmp.']}';
			}else{
				echo '{"draw":'.$draw.',"recordsTotal":0,"recordsFiltered":0,"data":[]}';
			}
			
		}else{
			echo '{"draw":'.$draw.',"recordsTotal":0,"recordsFiltered":0,"data":[]}';
		}
			
	}
	
	public function pdf_voucher_sales_aging(){
		$companyid = get_customercompanyid();	
		
		$year = get_defaultyeardata();
		
		
		$records = $this->common_model->get_records("voucher","*",array('vouchertype'=>6,'status'=>0,'companyid'=>$companyid,'billno <>'=>""));
	
		if(!empty($records)){	
			
			$array = array();
			$main_array = array();
			$sno = 1;
			foreach($records as $tmp){
				
				$data = $this->common_model->get_records("voucher","*",array('voucherlink'=>$tmp->voucherid,'status'=>0,'companyid'=>$companyid));
				$total = 0.00;
				foreach($data as $temp){
					$total += $temp->totaldebit;
				}
				
				if(isset($total) && $total != $tmp->totaldebit){
					
					$date1=date_create($tmp->voucherdate);
					$date2=date_create($year->enddate);
					$diff=date_diff($date1,$date2);
					
					$array['sno'] = $sno++;
					$array['date'] = "<p style='text-align:center'>".date("d-m-Y",strtotime($tmp->voucherdate))."</p>" ;
					$array['customer_name'] = "<p style='text-align:left'>".$tmp->towhom."</p>" ;
					$array['voucherno'] = "<p style='text-align:right'>".$tmp->voucherno."</p>" ;
					$array['billno'] = "<p style='text-align:right'>".$tmp->billno."</p>" ;
					$array['voucher_amount'] = "<p style='text-align:right'>".number_format($tmp->totaldebit,2)."</p>" ;
					$array['paid_amount'] = "<p style='text-align:right'>".number_format($total,2)."</p>" ;
					$array['pending_amount'] = "<p style='text-align:right'>".number_format(($tmp->totaldebit-$total),2)."</p>" ;
					$array['days'] = "<p style='text-align:left'>".$diff->format("%a days")."</p>" ;
					
					
					array_push($main_array,$array);		
				}
				
				
				unset($array);
			}
			
			$data['main_array'] = $main_array;
		
			tcpdf();
			$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
			$obj_pdf->SetCreator(PDF_CREATOR);
			$title = "Aging Schedule Sales";
			$obj_pdf->SetTitle($title);
			//$obj_pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $title, PDF_HEADER_STRING);
			$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
			$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
			$obj_pdf->SetDefaultMonospacedFont('helvetica');
			$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
			$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
			//$obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
			$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
			$obj_pdf->SetFont('helvetica', '', 9);
			$obj_pdf->setFontSubsetting(false);
			$obj_pdf->AddPage();
			ob_start();
			
			$message = $this->load->view('accounts/pdf/pdf_voucher_sales_aging',$data,TRUE);
				
					
			ob_end_clean();
			$obj_pdf ->lastPage();
			$obj_pdf->writeHTML($message, true, false, true, false, '');
			$obj_pdf->Output('Aging_Schedule_Sales.pdf', 'D');
			
		}else{
			
			redirect('accounts/voucher_aging_sales');
		}
	}
	
	public function print_voucher_sales_aging(){
		$companyid = get_customercompanyid();	
		
		$year = get_defaultyeardata();
		
		
		$records = $this->common_model->get_records("voucher","*",array('vouchertype'=>6,'status'=>0,'companyid'=>$companyid,'billno <>'=>""));
	
		if(!empty($records)){	
			
			$array = array();
			$main_array = array();
			$sno = 1;
			foreach($records as $tmp){
				
				$data = $this->common_model->get_records("voucher","*",array('voucherlink'=>$tmp->voucherid,'status'=>0,'companyid'=>$companyid));
				$total = 0.00;
				foreach($data as $temp){
					$total += $temp->totaldebit;
				}
				
				if(isset($total) && $total != $tmp->totaldebit){
					
					$date1=date_create($tmp->voucherdate);
					$date2=date_create($year->enddate);
					$diff=date_diff($date1,$date2);
					
					$array['sno'] = $sno++;
					$array['date'] = "<p style='text-align:center'>".date("d-m-Y",strtotime($tmp->voucherdate))."</p>" ;
					$array['customer_name'] = "<p style='text-align:left'>".$tmp->towhom."</p>" ;
					$array['voucherno'] = "<p style='text-align:right'>".$tmp->voucherno."</p>" ;
					$array['billno'] = "<p style='text-align:right'>".$tmp->billno."</p>" ;
					$array['voucher_amount'] = "<p style='text-align:right'>".number_format($tmp->totaldebit,2)."</p>" ;
					$array['paid_amount'] = "<p style='text-align:right'>".number_format($total,2)."</p>" ;
					$array['pending_amount'] = "<p style='text-align:right'>".number_format(($tmp->totaldebit-$total),2)."</p>" ;
					$array['days'] = "<p style='text-align:left'>".$diff->format("%a days")."</p>" ;
					
					
					array_push($main_array,$array);		
				}
				
				
				unset($array);
			}
			
			$data['main_array'] = $main_array;
		
			$this->load->view('accounts/print/print_voucher_sales_aging',$data);
				
		}else{
			
			redirect('accounts/voucher_aging_sales');
		}
	}
	
	public function gstform($id = ''){
		
		$companyid = get_customercompanyid();		
		
		
		$data['standard_rated'] = $this->sys_model->get_standard_rated_supplies($companyid);
		$data['zero_rated'] = $this->sys_model->get_zero_rated_supplies($companyid);
		$data['exempt_supplies'] = $this->sys_model->get_exempt_supplies($companyid);
		
		$data['taxable_purchase'] = $this->sys_model->get_gst_purchase_total($companyid);
		
		$data['gst_id'] = $id;
			
		$data['content'] = 'accounts/gstform';	
		$this->load->view('web/template',$data);
	}
	
	public function print_gst($gst_id = ''){
		
		if($gst_id){
			
			$data['form_data'] = $this->common_model->get_record('gst_form','*',array('gst_id'=>$gst_id));
			
			$this->load->view('print/print_gst',$data);
			
		}else{
			foreach($_POST as $key=>$tmp){
				$_POST[$key] = str_replace(",","",$tmp);
			}
			
			
			$values['gst_data'] = json_encode($_POST);
			$values['createdBy'] = $this->session->userdata("customerid");	
			$values['createdTime'] = date("Y-m-d H:i:s");	
			
			$id = $this->common_model->insert('gst_form',$values);
			
			redirect('accounts/gstform/'.$id);
		}
	}
	
	public function pdf_gst($gst_id = ''){
		
		if($gst_id){
			
			$data['form_data'] = $this->common_model->get_record('gst_form','*',array('gst_id'=>$gst_id));
			
			tcpdf();
			$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
			$obj_pdf->SetCreator(PDF_CREATOR);
			$title = "GST F5 Form";
			$obj_pdf->SetTitle($title);
			//$obj_pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $title, PDF_HEADER_STRING);
			$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
			$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
			$obj_pdf->SetDefaultMonospacedFont('helvetica');
			$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
			$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
			//$obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
			$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
			$obj_pdf->SetFont('helvetica', '', 9);
			$obj_pdf->setFontSubsetting(false);
			$obj_pdf->AddPage();
			ob_start();
			
			$message = $this->load->view('print/pdf_gst',$data,TRUE);
				
					
			ob_end_clean();
			$obj_pdf ->lastPage();
			$obj_pdf->writeHTML($message, true, false, true, false, '');
			$obj_pdf->Output('gst_f5.pdf', 'D');
			
		}
		
	}
	
	
	/***************************Closing Stock**************************/
	public function closing_stock(){
		$companyid = get_customercompanyid();
		$data['content'] = 'accounts/closing_stock';	
		$data['vouchers'] = $this->common_model->get_records("voucher","*",array("companyid"=>$companyid,"status"=>0,"system"=>1,"vouchertype"=>3));	
		$this->load->view('web/template',$data);
	}
	public function new_closing_stock(){
		$companyid = get_customercompanyid();
		$data['content'] = 'accounts/new_closing_stock';			
		$this->load->view('web/template',$data);
	}
	public function edit_closing_stock($id){
		$companyid = get_customercompanyid();
		$data['content'] = 'accounts/new_closing_stock';	
		$data['voucher'] = $this->common_model->get_record("voucher","*",array("voucherid"=>$id,"status"=>0,"system"=>1,"vouchertype"=>3));			
		$this->load->view('web/template',$data);
	}
	public function save_closing_stock(){
		
		$companyid = get_customercompanyid();
		
		$voucherid = trim(strip_tags($this->input->post('voucherid')));
		
		$values['voucherdate'] =  date("Y-m-d",strtotime(trim(strip_tags($this->input->post('stockdate')))));
		$values['totaldebit'] = trim(strip_tags($this->input->post('closingstock')));
		$values['totalcredit'] = trim(strip_tags($this->input->post('closingstock')));
		
		if(!$voucherid){
			$records = $this->common_model->get_records("voucher","*",array("companyid"=>$companyid,"vouchertype"=>3));		
			
			$values['voucherno'] = count($records)+1;		
			$values['companyid'] =  get_customercompanyid();
			$values['status'] =  0;
			$values['system'] =  1;
			$values['vouchertype'] =  3;		
		
			$values['createdBy'] = $this->session->userdata("customerid");	
			$values['createdTime'] = date("Y-m-d H:i:s");	
		
			$voucherid = $this->common_model->insert("voucher",$values);		
		}else{
			
			$where['voucherid'] = $voucherid;
			$values['modifiedBy'] = $this->session->userdata("customerid");	
			$values['modifiedTime'] = date("Y-m-d H:i:s");	
		
			$this->common_model->update("voucher",$values,$where);		
			unset($where);
			
			
			$where['voucherid'] = $voucherid;
			$this->common_model->delete("voucherrecords",$where);
			unset($where);
		}
		
		
		unset($values);
		
		
		$values['voucherid'] = $voucherid;
		$values['accountname'] = closingstock_balancesheet();
		$values['debit'] = trim(strip_tags($this->input->post('closingstock')));
		$values['credit'] = 0;		
		$this->common_model->insert("voucherrecords",$values);
		unset($values);
		
		
		$values['voucherid'] = $voucherid;
		$values['accountname'] = closingstock_profitloss();
		$values['debit'] = 0;
		$values['credit'] = trim(strip_tags($this->input->post('closingstock')));
		$this->common_model->insert("voucherrecords",$values);
		
		redirect('accounts/closing_stock');
	}
	
	public function delete_closing_stock($id){
		if($id){			
			
				$where['voucherid'] = $id;
				$values['status'] = 2;
				$values['modifiedBy'] = $this->session->userdata("customerid");	
				$values['modifiedTime'] = date("Y-m-d H:i:s");
				$this->common_model->update("voucher",$values,$where);			
				unset($values);
				
				$where['voucherid'] = $id;
				$values['status'] = 2;
				$this->common_model->update("voucherrecords",$values,$where);
				$this->session->set_flashdata("voucher_created","Voucher Deleted Successfuly");
			
			redirect("accounts/closing_stock");
		}else{
			redirect("accounts/closing_stock");
		}
	}
	/***************************Closing Stock**************************/
	
	public function copy_voucher($id){
		//echo "<pre>";
		
		$companyid = get_customercompanyid();
		
		$record = $this->common_model->get_record("voucher","*",array("companyid"=>$companyid,"voucherid"=>$id));		
		
		$records = $this->common_model->get_records("voucher","*",array("companyid"=>$companyid,"vouchertype"=>$record->vouchertype));
		$vouchernumber = count($records)+1;
		
		
		unset($record->voucherid);
		$record->voucherno = $vouchernumber;
		$record->createdTime = date("Y-m-d H:i:s");
		//print_r($record);
		$voucherid = $this->common_model->insert('voucher',$record);
		
		$data = $this->common_model->get_records("voucherrecords","*",array("voucherid"=>$id));		
		foreach($data as $tmp){
			$tmp->voucherid = $voucherid;
			//print_r($tmp);
			$this->common_model->insert('voucherrecords',$tmp);
		}
		
		redirect("accounts/voucher/".$voucherid);	
	}
	
	
	
}