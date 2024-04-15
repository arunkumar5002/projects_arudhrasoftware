<?php
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(0);

class Purchase extends CI_Controller
{
	
	public function __construct(){
        parent::__construct();
		$this->load->model('Set_purchase_model');
        $this->load->model('Set_purchasequote_model');
	  
    }

	public function purchasequote(){
		
		$company_id = get_customercompanyid();
        $data['page_title'] 	= "Purchase Quotations";
        $data['quotations'] = $this->common_model->get_records("purchasequote", "*",array("company_id"=>$company_id,"status !="=>'2'));	
		$data['content'] 		= "web/purchase/purchasequote";	
		$this->load->view('web/template',$data);
	}
	
	 public function create_purchase_list(){
		
		$this->load->model("sys_model");
		$company_id = get_customercompanyid();		
		$data['page_title'] 	= "Purchase Quotations";
		$records = $this->common_model->get_records("purchasequote","*",array("company_id"=>$company_id));
		$data['quotenumber'] = count($records)+1;
        $data['vat'] = $this->common_model->get_record("company","company_id,vat", array("company_id"=>$company_id));
		$result->vat;		
		$data['accountnames'] = $this->sys_model->get_accountnames();
		$data['content'] = 'web/purchase/create_purchase_list';	
		$data['customers'] = $this->common_model->get_records("contacts","contactid,customername",array('contacttype !='=>1,"company_id"=>$company_id));	
		$data['itemmaster'] = $this->common_model->get_records("itemmaster","*",array("status"=>0,"company_id"=>$company_id));	
		$data['taxmaster'] = $this->common_model->get_records("taxmaster","*",array("status"=>0,"company_id"=>$company_id));	
		$this->load->view('web/template',$data);
	}
	
	public function get_purchasequoterow(){
		
		$company_id = get_customercompanyid();
		$data['rowid'] = trim(strip_tags($this->input->post('rowid')));			
		$data['itemmaster'] = $this->common_model->get_records("itemmaster","*",array("status"=>0,"company_id"=>$company_id));	
		$data['taxmaster'] = $this->common_model->get_records("taxmaster","*",array("status"=>0,"company_id"=>$company_id));	
		$this->load->view('web/purchase/purchasequoteRow',$data);
	}
	
	public function get_itemdetails(){
		
		$itemid = trim(strip_tags($this->input->post('itemid')));			
		$data = $this->common_model->get_record("itemmaster","*",array("status"=>0,"itemid"=>$itemid));	
		echo json_encode($data);
	}
	
	public function ajax_addsupplier()
	{
		
			$values['contacttype'] = trim(strip_tags($this->input->post('contacttype')));
			$values['customername'] = $customername = trim(strip_tags($this->input->post('customername')));
			$values['phone'] = trim(strip_tags($this->input->post('phone')));
			$values['email'] = trim(strip_tags($this->input->post('email')));
			$values['currency'] = trim(strip_tags($this->input->post('currency')));
			$values['accountname'] = trim(strip_tags($this->input->post('accountname')));
			$values['createdTime'] = date("Y-m-d H:i:s");			
				
			$id = $this->common_model->insert_record("contacts",$values);
			echo $id."&*&%^".$customername;
	}
	
	
	public function ajax_additemname()
	{				
			$values['itemcode'] = $itemname = trim(strip_tags($this->input->post('itemcode')));
			$values['price'] = trim(strip_tags($this->input->post('price')));
			$values['accountname'] = trim(strip_tags($this->input->post('accountname')));
			$values['tax'] = trim(strip_tags($this->input->post('tax')));
			$values['quantity'] = trim(strip_tags($this->input->post('quantity')));
			$values['location'] = trim(strip_tags($this->input->post('location')));
			
				$values['createdTime'] = date("Y-m-d H:i:s");	
				$id = $this->common_model->insert_record("itemmaster",$values);
				
			echo $id."&*&%^".$itemname;
				
	}
	
	
	public function savepurchasequote(){		
		
		
		    $purchasequoteid = trim(strip_tags($this->input->post('purchasequoteid')));
		    $values['company_id'] = get_customercompanyid();
			$values['quotedate'] = date("Y-m-d",strtotime(trim(strip_tags($this->input->post('issuedate')))));
			$values['quotenumber'] = trim(strip_tags($this->input->post('quotenumber')));
			$values['customerid'] = trim(strip_tags($this->input->post('customername')));
			$values['initiatedby'] = trim(strip_tags($this->input->post('initiatedby')));
			$values['preparedby'] = trim(strip_tags($this->input->post('preparedby')));
			$values['authorizedby'] = trim(strip_tags($this->input->post('authorizedby')));
			$values['vat'] = trim(strip_tags($this->input->post('vat')));
			$values['totalamount'] = trim(strip_tags($this->input->post('totalamount')));
			
		
		if(!$purchasequoteid){
				
			$values['createdTime'] = date("Y-m-d H:i:s");	
			$quoteid = $this->common_model->insert('purchasequote',$values);
			unset($values);		
			
			$itemcode = $this->input->post('itemcode');
			$itemname = $this->input->post('itemname');
			$description = $this->input->post('description');
			$quantity = $this->input->post('quantity');
			$unitprice = $this->input->post('unitprice');
			$amount = $this->input->post('amount');
			foreach($itemcode as $key=>$tmp){
				$values['quoteid'] = $quoteid;
				$values['itemcode'] = $tmp;
				$values['itemname'] = $itemname[$key];
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
			
			$itemcode = $this->input->post('itemcode');
			$itemname = $this->input->post('itemname');
			$description = $this->input->post('description');
			$quantity = $this->input->post('quantity');
			$unitprice = $this->input->post('unitprice');
			$amount = $this->input->post('amount');
			foreach($itemcode as $key=>$tmp){
				$values['quoteid'] = $purchasequoteid;
				$values['itemcode'] = $tmp;
				$values['itemname'] = $itemname[$key];
				$values['quantity'] = $quantity[$key];
				$values['description'] = $description[$key];
				$values['unitprice'] = $unitprice[$key];			
				$values['amount'] = $amount[$key];
				$this->common_model->insert('purchasequoterecords',$values);
				unset($values);
			}
			
		}
		redirect('purchase/purchasequote');
	}
	
	
	 public function save_add_vendor(){
		 
		$row_id = $this->input->post('row_id');
		$data_arr = array(
			'vendor_name' 		 => $this->input->post('vendor_name'),
			'phone' 		 => $this->input->post('phone'),
			'email' 	 => $this->input->post('email'),
			'currency' 		 => $this->input->post('currency'),
			'account_name' 	 => $this->input->post('account_name'),
			
		);
		if(empty($row_id)){
			
			$data_arr['created_at'] = date('Y-m-d h:i:s');
			
			$this->common_model->insert('vendor',$data_arr,$status);
			$output = array(
				'status'	=> 'Success',
				'msg'		=> 'Vendor Added Successfully',
			);
		}else{
			$data_arr['updated_at'] = date('Y-m-d h:i:s');
			
			$where = "id='$row_id'";
			$this->common_model->update('vendor',$data_arr,$where,$status);
			$output = array(
				'status'	=> 'Success',
				'msg'		=> 'Vendor Updated Successfully',
			);
		}
		echo json_encode($output);
	}
	
	
	public function viewQuote($id){
		
		$company_id = get_customercompanyid();
		$data['quote'] = $this->common_model->get_record("purchasequote","*",array("purchasequoteid"=>$id));
		$data['quoterecords'] = $this->common_model->get_records("purchasequoterecords","*",array("quoteid"=>$id));
		$data['content'] = 'web/purchase/viewQuote';
		$this->load->view('web/template',$data);
	}
	
	public function editPurchaseQuote($id){
		
		$data['content'] = "web/purchase/create_purchase_list";
		$data['page_title'] 	= "Edit Purchase Quotations";
		$details = $data['details'] = $this->common_model->get_record('purchasequote','*',array('purchasequoteid'=>$id));
		$company_id = get_customercompanyid();
		$data['vat'] = $this->common_model->get_record("company","company_id,vat", array("company_id"=>$company_id));
		$result->vat;
		$data['detailsrecords'] = $this->common_model->get_records('purchasequoterecords','*',array('quoteid'=>$id));
		$data['quotenumber'] = $details->quotenumber;	
		$data['accountnames'] = $this->sys_model->get_accountnames();
		$data['customers'] = $this->common_model->get_records("contacts","contactid,customername",array('contacttype !='=>1,"company_id"=>$company_id));	
		$data['itemmaster'] = $this->common_model->get_records("itemmaster","*",array("status"=>0,"company_id"=>$company_id));	
		$data['taxmaster'] = $this->common_model->get_records("taxmaster","*",array("status"=>0,"company_id"=>$company_id));	
		$this->load->view('web/template',$data);
	}
	
	
	public function deletePurchaseQuote($id){
		if($id){	
				$where['purchasequoteid'] = $id;
				$values['status'] = 2;
				//$values['modifiedBy'] = $this->session->userdata("customerid");	
				$values['modifiedTime'] = date("Y-m-d H:i:s");
				$this->common_model->update("purchasequote",$values,$where);			
				unset($values);
				
				
				redirect("purchase/purchasequote");
		}else{
				redirect("purchase/purchasequote");
		}
	}
	
	
	/******************Purchase Quotation********************/
	
		public function purchaseorder(){
						
		$company_id = get_customercompanyid();				
		$data['page_title'] 	= "Purchase Order";
		$data['orders'] = $this->common_model->get_records("purchaseorder","*",array("company_id"=>$company_id,"status !="=>'2'));
		$data['content'] 		= "web/purchase/purchaseorder";	
		$this->load->view('web/template',$data);
	}

	
	 public function purchase_order_list(){
		 
		$company_id = get_customercompanyid(); 
		$this->load->model("sys_model");
		$data['page_title'] 	= " Purchase Order";
		$data['quote_list'] = $this->sys_model->get_purchase_quote_list();
		$records = $this->common_model->get_records("purchaseorder","*",array("company_id"=>$company_id));
		$data['ordernum'] = count($records)+1;	
		$company_id = get_customercompanyid();
		$data['vat'] = $this->common_model->get_record("company","company_id,vat", array("company_id"=>$company_id));
		$result->vat;
        $data['suppliers'] = $this->common_model->get_records("contacts", "contactid,customername",array('contacttype !='=>1,"company_id"=>$company_id));
		$data['itemmaster'] = $this->common_model->get_records("itemmaster","*",array("status"=>0,"company_id"=>$company_id));	
		$data['content'] 	= "web/purchase/purchase_order_list";		
		$this->load->view('web/template',$data);
	}

	public function savepurchaseorder(){
				
		$purchaseorderid = trim(strip_tags($this->input->post('purchaseorderid')));
		$values['company_id'] = get_customercompanyid();
		$values['issuedate'] = date("Y-m-d",strtotime(trim(strip_tags($this->input->post('issuedate')))));
		$values['deliverydate'] = date("Y-m-d",strtotime(trim(strip_tags($this->input->post('deliverydate')))));
		$values['quoteno'] = trim(strip_tags($this->input->post('quotenumber')));
		$values['purchaseordernum'] = trim(strip_tags($this->input->post('ordernum')));
		$values['supplier'] = trim(strip_tags($this->input->post('supplier')));
		$values['vat'] = trim(strip_tags($this->input->post('vat')));
		$values['totalamount'] = trim(strip_tags($this->input->post('totalamount')));
		$values['authorizedby'] = trim(strip_tags($this->input->post('authorizedby')));
		$values['terms'] = trim(strip_tags($this->input->post('terms')));
		
		if(!$purchaseorderid){
		
			
			$values['createdTime'] = date("Y-m-d H:i:s");	
			
			$purchaseorderid = $this->common_model->insert('purchaseorder',$values);
			unset($values);
		    
			$itemcode = $this->input->post('itemcode');
			$itemname = $this->input->post('itemname');
			$description = $this->input->post('description');
			$quantity = $this->input->post('quantity');
			$unitprice = $this->input->post('unitprice');
			$amount = $this->input->post('amount');
			foreach($itemcode as $key=>$tmp){
				$values['purchaseorderid'] = $purchaseorderid;
				$values['itemcode'] = $tmp;
				$values['itemname'] = $itemname[$key];
				$values['quantity'] = $quantity[$key];
				$values['description'] = $description[$key];
				$values['unitprice'] = $unitprice[$key];
				$values['amount'] = $amount[$key];
				$this->common_model->insert('purchaseorderrecords',$values);
				unset($values);
			}
		
		}else{
			$where['purchaseorderid'] = $purchaseorderid;
		
		
			$values['modifiedTime'] = date("Y-m-d H:i:s");	
			
			$this->common_model->update('purchaseorder',$values,$where);
			unset($values);
			
			$this->common_model->delete('purchaseorderrecords',$where);
		    
			$itemcode = $this->input->post('itemcode');
			$itemname = $this->input->post('itemname');
			$description = $this->input->post('description');
			$quantity = $this->input->post('quantity');
			$unitprice = $this->input->post('unitprice');
			$amount = $this->input->post('amount');
			foreach($itemcode as $key=>$tmp){
				$values['purchaseorderid'] = $purchaseorderid;
				$values['itemcode'] = $tmp;
				$values['itemname'] = $itemname[$key];
				$values['quantity'] = $quantity[$key];
				$values['description'] = $description[$key];
				$values['unitprice'] = $unitprice[$key];
				$values['amount'] = $amount[$key];
				$this->common_model->insert('purchaseorderrecords',$values);
				unset($values);
			}
		
		}
		
		redirect('purchase/purchaseorder');
	}
	

	public function editPurchaseOrder($id){
		
		$company_id = get_customercompanyid();		
		$data['content'] = 'web/purchase/purchase_order_list';
		$data['page_title'] 	= "Edit Purchase Order";
		
		$data['details'] = $this->common_model->get_record("purchaseorder","*",array("company_id"=>$company_id,'purchaseorderid'=>$id));
		$data['detailsrecords'] = $this->common_model->get_records("purchaseorderrecords","*",array('purchaseorderid'=>$id));
		$data['vat'] = $this->common_model->get_record("company","company_id,vat", array("company_id"=>$company_id));
		$result->vat;
		$data['quote_list'] = $this->sys_model->get_purchase_quote_list();
  		$data['accountnames'] = $this->sys_model->get_accountnames();
		$records = $this->common_model->get_records("purchaseorder","*",array("company_id"=>$company_id));
		$data['ordernum'] = $data['details']->purchaseordernum;	
			
		$data['suppliers'] = $this->common_model->get_records("contacts","contactid,customername",array('contacttype !='=>1,"company_id"=>$company_id));	
		$data['itemmaster'] = $this->common_model->get_records("itemmaster","*",array("status"=>0,"company_id"=>$company_id));	
		$data['taxmaster'] = $this->common_model->get_records("taxmaster","*",array("status"=>0,"company_id"=>$company_id));	
		$this->load->view('web/template',$data);
	}
	
	
		public function deletePurchaseOrder($id){
		if($id){	
				$where['purchaseorderid'] = $id;
				$values['status'] = 2;
				//$values['modifiedBy'] = $this->session->userdata("customerid");	
				$values['modifiedTime'] = date("Y-m-d H:i:s");
				$this->common_model->update("purchaseorder",$values,$where);			
				unset($values);
				
				redirect("purchase/purchaseorder");
		}else{
				redirect("purchase/purchaseorder");
		}
	}
		public function get_purchaseorderrow(){
		$data['rowid'] = trim(strip_tags($this->input->post('rowid')));			
			
		$data['itemmaster'] = $this->common_model->get_records("itemmaster","*",array("status"=>0));	
		$data['taxmaster'] = $this->common_model->get_records("taxmaster","*",array("status"=>0));	
		$this->load->view('web/purchase/purchaseorderRow',$data);
	}
	
		public function get_purchasequotedetails(){
			
		$values['purchasequoteid'] = trim(strip_tags($this->input->post('quoteid')));
		$record = $this->common_model->get_record("purchasequote","customerid,totalamount,vat",$values);
		
		$record->total_quo = count($this->sys_model->get_purchasequoterecord($values['purchasequoteid']));
		
		echo json_encode($record);
	}
	public function get_purchasequoterecords(){
		
		$quoteid = trim(strip_tags($this->input->post('quoteid')));
		$data['records'] = $this->sys_model->get_purchasequoterecord($quoteid);	
		$this->load->view('web/purchase/ajax/order_records',$data);		
	}	
	
	
	/******************Purchase Quotation  End********************/
	
	public function purchaseinvoice(){
		
		$data['page_title'] 	= "purchase invoice";
		$data['invoices'] = $this->common_model->get_records("purchaseinvoice","*");
		$data['content'] = 'web/purchase/purchaseinvoice';	
		$this->load->view('web/template',$data);
	}
	public function purchase_invoice(){
		
		$values['company_id'] = get_customercompanyid();
		$data['order_list'] = $this->sys_model->get_purchase_quote_list_for_invoice();		
		$data['grn_list'] = $this->sys_model->get_grn_list();		
		$data['vat'] = $this->common_model->get_record("company","company_id,vat", array("company_id"=>$company_id));
		$result->vat;
		$records = $this->common_model->get_records("purchaseinvoice","*");
		$data['invoicenumber'] = count($records)+1;	
		
		$data['customers'] = $this->common_model->get_records("contacts","contactid,customername",array('contacttype !='=>1,"company_id"=>$company_id));	
		$data['itemmaster'] = $this->common_model->get_records("itemmaster","*",array("status"=>0,"company_id"=>$company_id));	
		$data['taxmaster'] = $this->common_model->get_records("taxmaster","*",array("status"=>0,"company_id"=>$company_id));
        $data['content'] = 'web/purchase/purchase_invoice';		
		$this->load->view('web/template',$data);
	}
		public function get_invoiceusingorder(){
			
		$values['purchaseordernum'] = trim(strip_tags($this->input->post('orderid')));
		$record = $this->common_model->get_record("purchaseorder","vat,supplier,totalamount",$values);
		$record->customerid = $record->supplier;
		$record->customername = get_contactname($record->supplier);
			
		echo json_encode($record);
	}
	
	public function get_invoicerecordsusingorder(){
		$orderid = trim(strip_tags($this->input->post('orderid')));
		
		$data['records'] = $this->sys_model->get_purchaseorder_records_invoice($orderid);
				
		$this->load->view('web/purchase/ajax/invoice_records',$data);		
	}
	
	
	public function get_invoiceusinggrn(){
		$values['grnid'] = trim(strip_tags($this->input->post('grnnumber')));
	
		$record = $this->common_model->get_record("grn","supplierid,purchaseordernum",$values);
		$record->customerid = $record->supplierid;
		$record->customername = get_contactname($record->supplierid);
		
		$order = $this->common_model->get_record("purchaseorder","vat,supplier,totalamount",array("purchaseorderid"=>$record->purchaseordernum));
		
		///print_r($order);
		//exit();
		$record->totalamount = $order->totalamount;
		$record->vat = $order->vat;
        		
		echo json_encode($record);
	}
	
	
	public function get_invoicerecordsusinggrn(){
		$grnnumber = trim(strip_tags($this->input->post('grnnumber')));
		
		$data['records'] = $this->sys_model->get_grn_records_invoice($grnnumber);
				
		$this->load->view('web/purchase/ajax/invoice_records',$data);	
	}
	
		public function savepurchaseinvoice(){
		
		$purchaseinvoiceid = trim(strip_tags($this->input->post('purchaseinvoiceid')));
		
		$values['invoicedate'] = date("Y-m-d",strtotime(trim(strip_tags($this->input->post('issuedate')))));
		$values['company_id'] = get_customercompanyid();
		$values['invoicenumber'] = trim(strip_tags($this->input->post('invoicenumber')));
		$values['customerid'] = trim(strip_tags($this->input->post('customerid')));
		$values['ordernum'] = trim(strip_tags($this->input->post('orderno')));
		$values['grnnumber'] = trim(strip_tags($this->input->post('grnnumber')));
		$values['vat'] = trim(strip_tags($this->input->post('vat')));
		$values['totalamount'] = trim(strip_tags($this->input->post('totalamount')));
		$values['preparedby'] = trim(strip_tags($this->input->post('preparedby')));
		$values['authorizedby'] = trim(strip_tags($this->input->post('authorizedby')));
		
		if(!$purchaseinvoiceid){
			
			$values['createdTime'] = date("Y-m-d H:i:s");	
			
			$invoiceid = $this->common_model->insert('purchaseinvoice',$values);		
			unset($values);		
			
			$itemcode = $this->input->post('itemcode');	
			$itemname = $this->input->post('itemname');
			$quantity = $this->input->post('quantity');
			$unitprice = $this->input->post('unitprice');
			$amount = $this->input->post('amount');
			
			
			foreach($itemcode as $key=>$tmp){
				$values['invoiceid'] = $invoiceid;
				$values['itemcode'] = $tmp;
				$values['itemname'] = $itemname[$key];
				$values['quantity'] = $quantity[$key];
				$values['unitprice'] = $unitprice[$key];
				$values['amount'] = $amount[$key];
				//print_r($values);
				$this->common_model->insert('purchaseinvoicerecords',$values);
				unset($values);	
			}
			
		}else{
			
			
		}
		
		redirect('purchase/purchaseinvoice');
	}
	
	public function editPurchaseInvoice($id){
	
		$company_id = get_customercompanyid();
		
		$data['details'] = $this->common_model->get_record("purchaseinvoice","*",array("purchaseinvoiceid"=>$id));
		$data['detailsrecords'] = $this->common_model->get_records("purchaseinvoicerecords","*",array("invoiceid"=>$id));
		
		$data['order_list'] = $this->sys_model->get_purchase_quote_list_for_invoice();		
		$data['grn_list'] = $this->sys_model->get_grn_list();		
		
		$records = $this->common_model->get_records("purchaseinvoice","*",array("company_id"=>$company_id));
		$data['invoicenumber'] = $data['details']->invoicenumber;	
		
		$data['content'] = 'web/purchase/purchase_invoice';	
		$data['customers'] = $this->common_model->get_records("contacts","contactid,customername",array('contacttype !='=>1,"company_id"=>$company_id));	
		$data['itemmaster'] = $this->common_model->get_records("itemmaster","*",array("status"=>0,"company_id"=>$company_id));	
		$data['taxmaster'] = $this->common_model->get_records("taxmaster","*",array("status"=>0,"company_id"=>$company_id));	
		$this->load->view('web/template',$data);
	}
	
	
}