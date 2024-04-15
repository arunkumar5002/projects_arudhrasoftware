<?php
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(0);

class Sales extends CI_Controller
{
	public function quotations(){
		
		$company_id = get_customercompanyid();
	    $data['page_title'] 	= "Sales Quotations";
		$data['quotations'] = $this->common_model->get_records("salesquote","*",array("company_id"=>$company_id,"status <>"=>2));
		$data['content'] = 'web/sales/quotations';	
		$this->load->view('web/template',$data);
	}
	
	public function salesquote(){
		
		$company_id = get_customercompanyid();		
		$data['page_title'] 	= "Sales Quotations";
		$records = $this->common_model->get_records("salesquote","*",array("company_id"=>$company_id));
		 $data['vat'] = $this->common_model->get_record("company","company_id,vat", array("company_id"=>$company_id));
		$result->vat;
		$data['quotenumber'] = count($records)+1;	
		$data['accountnames'] = $this->sys_model->get_accountnames();
		$data['content'] = 'web/sales/salesquote';	
		$data['customers'] = $this->common_model->get_records("contacts","contactid,customername",array('contacttype !='=>2,"company_id"=>$company_id,"status"=>0));	
		$data['itemmaster'] = $this->common_model->get_records("itemmaster","*",array("status"=>0,"company_id"=>$company_id));	
		$data['taxmaster'] = $this->common_model->get_records("taxmaster","*",array("status"=>0,"company_id"=>$company_id));	
		$this->load->view('web/template',$data);
	}
	
	public function editsalesquote($id){	
		
		$company_id = get_customercompanyid();
		$data['page_title'] 	= "Edit Sales Quotations";
		$record = $data['quote'] = $this->common_model->get_record("salesquote","*",array("salesquoteid"=>$id));
		$data['quoterecords'] = $this->common_model->get_records("salesquoterecords","*",array("quoteid"=>$id));
		$data['vat'] = $this->common_model->get_record("company","company_id,vat", array("company_id"=>$company_id));
		$result->vat;
		$data['quotenumber'] = $record->quotenumber;	
		$data['accountnames'] = $this->sys_model->get_accountnames();
		$data['content'] = 'web/sales/salesquote';	
		$data['customers'] = $this->common_model->get_records("contacts","contactid,customername",array('contacttype !='=>2,"company_id"=>$company_id,"status"=>0));	
		$data['itemmaster'] = $this->common_model->get_records("itemmaster","*",array("company_id"=>$company_id,"status"=>0));	
		$data['taxmaster'] = $this->common_model->get_records("taxmaster","*",array("company_id"=>$company_id,"status"=>0));	
		$this->load->view('web/template',$data);
	}
	
	public function get_itemdetails(){
		
		$company_id = get_customercompanyid();
		$itemid = trim(strip_tags($this->input->post('itemid')));			
		$data = $this->common_model->get_record("itemmaster","*",array("company_id"=>$company_id,"status"=>0,"itemid"=>$itemid));	
		echo json_encode($data);
	}
	
	public function get_salesquoterow(){
		
		$company_id = get_customercompanyid();
		$data['rowid'] = trim(strip_tags($this->input->post('rowid')));				
		$data['itemmaster'] = $this->common_model->get_records("itemmaster","*",array("company_id"=>$company_id,"status"=>0));
		$this->load->view('web/sales/salesquoteRow',$data);
	}
	
	public function viewSalesQuote($id){
		
		$company_id = get_customercompanyid();
		$data['content'] = 'web/sales/viewSalesQuote';
		$data['order1'] = $this->common_model->get_record("salesquote","*",array("salesquoteid"=>$id));
		$data['order2'] = $this->common_model->get_records("salesquoterecords","*",array("quoteid"=>$id));
		$data['fromCompany'] = $this->common_model->get_record('company','*');
		$data['toCompany'] = $this->common_model->get_record('contacts','*',array("company_id"=>$company_id,"contactid"=>$data['order1']->customerid));
		//print_r($data);
		$this->load->view('web/template',$data);
	}
	
	public function deletesalesquote($id){
		
		$values['status'] = 2;		
		$values['modifiedBy'] = $this->session->userdata("customerid");	
		$values['modifiedTime'] = date("Y-m-d H:i:s");	
			
		$where['salesquoteid'] = $id;
		
		$this->common_model->update("salesquote",$values,$where);
		
		redirect('sales/quotations');
	}
	
	public function savesalesquote(){		
		
		
		$salesquoteid = trim(strip_tags($this->input->post('salesquoteid')));
		
		$values['company_id'] = get_customercompanyid();
		$values['quotedate'] = date("Y-m-d",strtotime(trim(strip_tags($this->input->post('issuedate')))));
		$values['quotenumber'] = trim(strip_tags($this->input->post('quotenumber')));
		$values['customerid'] = trim(strip_tags($this->input->post('customername')));
		$values['preparedby'] = trim(strip_tags($this->input->post('preparedby')));
		$values['authorizedby'] = trim(strip_tags($this->input->post('authorizedby')));
		$values['vat'] = trim(strip_tags($this->input->post('vat')));
		$values['totalamount'] = trim(strip_tags($this->input->post('totalamount')));
		$values['validityperiod'] = trim(strip_tags($this->input->post('validityperiod')));
		$values['deliveryperiod'] = trim(strip_tags($this->input->post('deliveryperiod')));
		$values['otherterms'] = trim(strip_tags($this->input->post('otherterms')));
		
		if(!$salesquoteid){
			
			
			$values['createdTime'] = date("Y-m-d H:i:s");	
			
			$quoteid = $this->common_model->insert('salesquote',$values);
			unset($values);		
			
			$itemcode = $this->input->post('itemcode');
			$itemname = $this->input->post('itemname');
			$description = $this->input->post('description');
			$quantity = $this->input->post('quantity');
			$unitprice = $this->input->post('unitprice');
			$unit = $this->input->post('unit');
			$amount = $this->input->post('amount');
			foreach($itemcode as $key=>$tmp){
				$values['quoteid'] = $quoteid;
				$values['itemcode'] = $tmp;
				$values['itemname'] = $itemname[$key];
				$values['quantity'] = $quantity[$key];
				$values['description'] = $description[$key];
				$values['unit'] = $unit[$key];
				$values['unitprice'] = $unitprice[$key];
				$values['amount'] = $amount[$key];				
				$this->common_model->insert('salesquoterecords',$values);
				unset($values);
			}
			
		}else{
			
			$values['modifiedTime'] = date("Y-m-d H:i:s");	
			
			$where['salesquoteid'] = $salesquoteid;
			
		    $this->common_model->update('salesquote',$values,$where);
			unset($values);	
			unset($where);	
			
			$where['quoteid'] = $salesquoteid;
			$this->common_model->delete('salesquoterecords',$where);
			
			$itemcode = $this->input->post('itemcode');
			$itemname = $this->input->post('itemname');
			$description = $this->input->post('description');
			$quantity = $this->input->post('quantity');
			$unitprice = $this->input->post('unitprice');
			$unit = $this->input->post('unit');
			$amount = $this->input->post('amount');
			foreach($itemcode as $key=>$tmp){
				$values['quoteid'] = $salesquoteid;
				$values['itemcode'] = $tmp;
				$values['itemname'] = $itemname[$key];
				$values['description'] = $description[$key];
				$values['quantity'] = $quantity[$key];
				$values['unitprice'] = $unitprice[$key];
				$values['unit'] = $unit[$key];
                $values['amount'] = $amount[$key];				
				$this->common_model->insert('salesquoterecords',$values);
				unset($values);
			}
			
		}
		redirect('sales/quotations');
	}
	
	public function pdfsaleQuote($id){
		$this->load->helper('pdf_helper');
		
		$data['order1'] = $this->common_model->get_record("salesquote","*",array("salesquoteid"=>$id));
		$data['order2'] = $this->common_model->get_records("salesquoterecords","*",array("quoteid"=>$id));
		
		$data['fromCompany'] = $this->common_model->get_record('company','*');
		$data['toCompany'] = $this->common_model->get_record('contacts','*',array("contactid"=>$data['order1']->customerid));
		
		
		tcpdf();
		$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$obj_pdf->SetCreator(PDF_CREATOR);
		$title = "Purchase Quote PDF";
		$obj_pdf->SetTitle($title);
		//$obj_pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $title, PDF_HEADER_STRING);
		$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		$obj_pdf->SetDefaultMonospacedFont('helvetica');
		$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		$obj_pdf->SetFont('helvetica', '', 9);
		$obj_pdf->setFontSubsetting(false);
		$obj_pdf->AddPage();
		ob_start();
		
		$message = $this->load->view('web/sales/pdfSalesQuote',$data,TRUE);
		
		
		ob_end_clean();
		$obj_pdf ->lastPage();
		$obj_pdf->writeHTML($message, true, false, true, false, '');
		$obj_pdf->Output('SalesQuote.pdf', 'D');

	}
	
	public function printQuotation($id){
		
		$data['order1'] = $this->common_model->get_record("salesquote","*",array("salesquoteid"=>$id));
		$data['order2'] = $this->common_model->get_records("salesquoterecords","*",array("quoteid"=>$id));
		$data['fromCompany'] = $this->common_model->get_record('company','*');
		$data['toCompany'] = $this->common_model->get_record('contacts','*',array("contactid"=>$data['order1']->customerid));
		$this->load->view('web/sales/printSalesQuote',$data);
	}
	
	
	//sales order
	public function orders(){
		
		$data['orders'] = 'menu';
		$data['page_title'] 	= "Sales Order List";
		$data['orders'] = $this->common_model->get_records("salesorder","*",array("status <>"=>2));
		$data['content'] = "web/sales/orders";
		$this->load->view('web/template', $data);
	}
	

	public function salesorder(){
		
        $company_id = get_customercompanyid();		
	    $data['content'] = "web/sales/salesorder";
  		$data['accountnames'] = $this->sys_model->get_accountnames();
		$data['quote_list'] = $this->sys_model->get_order_quote_list();
		$records = $this->common_model->get_records("salesorder","*",array("company_id"=>$company_id));
		$data['ordernum'] = count($records)+1;		
	    $data['vat'] = $this->common_model->get_record("company","company_id,vat", array("company_id"=>$company_id));
		$result->vat;
		$data['suppliers'] = $this->common_model->get_records("contacts","contactid,customername",array('contacttype !='=>2,"company_id"=>$company_id,"status"=>0));	
		$data['itemmaster'] = $this->common_model->get_records("itemmaster","*",array("status"=>0,"company_id"=>$company_id));	
		$data['taxmaster'] = $this->common_model->get_records("taxmaster","*",array("status"=>0,"company_id"=>$company_id));
		$this->load->view('web/template',$data);
	}
	
	
	public function get_salesorderrow(){
		
        $company_id = get_customercompanyid();			
		$data['rowid'] = trim(strip_tags($this->input->post('rowid')));			
		$data['itemmaster'] = $this->common_model->get_records("itemmaster","*",array("status"=>0,"company_id"=>$company_id));	
		$data['taxmaster'] = $this->common_model->get_records("taxmaster","*",array("status"=>0,"company_id"=>$company_id));	
		$this->load->view('web/sales/salesorderRow',$data);
	}
		
		
	public function get_salesquotedetails(){
		
		$values['salesquoteid'] = trim(strip_tags($this->input->post('quoteid')));
		$record = $this->common_model->get_record("salesquote","customerid,validityperiod,paymentterms,deliveryperiod,otherterms,vat",$values);
		$record->total_quote = count($this->sys_model->get_salesquoterecords($values['salesquoteid']));
		
		echo json_encode($record);
	}
	

	public function get_salesquoterecords(){
		$quoteid = trim(strip_tags($this->input->post('quoteid')));
		
		$data['records'] = $this->sys_model->get_salesquoterecords($quoteid);
				
		$this->load->view('web/sales/ajax/order_records',$data);		
	}
	
	public function editsalesorder($id){
	
		$company_id = get_customercompanyid();		
		$record = $data['order'] = $this->common_model->get_record("salesorder","*",array("salesorderid"=>$id));
		$data['orderrecords'] = $this->common_model->get_records("salesorderrecords","*",array("salesorderid"=>$id));
		$data['quoterecord'] = $this->common_model->get_record("salesquote","*",array("salesquoteid"=>$record->quoteno));
		$data['vat'] = $this->common_model->get_record("company","company_id,vat", array("company_id"=>$company_id));
		$result->vat;
		$data['content'] = 'web/sales/salesorder';
  		$data['accountnames'] = $this->sys_model->get_accountnames();
		$data['quote_list'] = $this->sys_model->get_order_quote_list();
		$data['ordernum'] = $record->salesordernum;	
		$data['suppliers'] = $this->common_model->get_records("contacts","contactid,customername",array("contacttype"=>1,"status"=>0,"company_id"=>$company_id));	
		$data['itemmaster'] = $this->common_model->get_records("itemmaster","*",array("status"=>0,"company_id"=>$company_id));	
		$data['taxmaster'] = $this->common_model->get_records("taxmaster","*",array("status"=>0,"company_id"=>$company_id));	
		$this->load->view('web/template',$data);
	
	}

	public function savesalesorder(){
				
		$salesorderid = trim(strip_tags($this->input->post('salesorderid')));	
        $values['company_id'] = get_customercompanyid();
		$values['issuedate'] = date("Y-m-d",strtotime(trim(strip_tags($this->input->post('issuedate')))));
		$values['deliverydate'] = date("Y-m-d",strtotime(trim(strip_tags($this->input->post('deliverydate')))));
		$values['quoteno'] = trim(strip_tags($this->input->post('quotenumber')));
		$values['salesordernum'] = trim(strip_tags($this->input->post('ordernum')));
		$values['customer'] = trim(strip_tags($this->input->post('customer')));
		$values['vat'] = trim(strip_tags($this->input->post('vat')));
		$values['totalamount'] = trim(strip_tags($this->input->post('totalamount')));
		$values['authorizedby'] = trim(strip_tags($this->input->post('authorizedby')));
		
		$values['ship_via'] = trim(strip_tags($this->input->post('ship_via')));
		$values['Inconterms'] = trim(strip_tags($this->input->post('Inconterms')));
		$values['bill_laddingno'] = trim(strip_tags($this->input->post('bill_laddingno')));
		$values['total_netweight'] = trim(strip_tags($this->input->post('total_netweight')));
		$values['container_no'] = trim(strip_tags($this->input->post('container_no')));
		$values['gross_weight'] = trim(strip_tags($this->input->post('gross_weight')));
		$values['seal_no'] = trim(strip_tags($this->input->post('seal_no')));
		$values['rolls'] = trim(strip_tags($this->input->post('rolls')));
		$values['custom_hscode'] = trim(strip_tags($this->input->post('custom_hscode')));
		$values['pallets'] = trim(strip_tags($this->input->post('pallets')));
		$values['loading_port'] = trim(strip_tags($this->input->post('loading_port')));
		$values['discharge_port'] = trim(strip_tags($this->input->post('discharge_port')));
		$values['beneficiary_name'] = trim(strip_tags($this->input->post('beneficiary_name')));
		
		//print_r($_POST);
		//exit();
		
		if(!$salesorderid){
		
				
			$values['createdTime'] = date("Y-m-d H:i:s");	
			
			$salesorderid = $this->common_model->insert('salesorder',$values);
			unset($values);
			
			$itemcode = $this->input->post('itemcode');
			$itemname = $this->input->post('itemname');
			$description = $this->input->post('description');
			$quantity = $this->input->post('quantity');
			$unitprice = $this->input->post('unitprice');
			$unit = $this->input->post('unit');
			$amount = $this->input->post('amount');
			foreach($itemcode as $key=>$tmp){
				$values['salesorderid'] = $salesorderid;
				$values['itemcode'] = $tmp;
				$values['itemname'] = $itemname[$key];
				$values['quantity'] = $quantity[$key];
				$values['description'] = $description[$key];
				$values['unitprice'] = $unitprice[$key];
				$values['unit'] = $unit[$key];
				$values['amount'] = $amount[$key];
				$this->common_model->insert('salesorderrecords',$values);
				unset($values);
			}
		
		}else{
			$values['modifiedBy'] = $this->session->userdata("customerid");	
			$values['modifiedTime'] = date("Y-m-d H:i:s");	
			
			$where['salesorderid'] = $salesorderid;
			
			$this->common_model->update('salesorder',$values,$where);
			unset($values);
			unset($where);
			
			$where['salesorderid'] = $salesorderid;
			$this->common_model->delete('salesorderrecords',$where);
			
			
			$itemcode = $this->input->post('itemcode');
			$itemname = $this->input->post('itemname');
			$description = $this->input->post('description');
			$quantity = $this->input->post('quantity');
			$unitprice = $this->input->post('unitprice');
			$unit = $this->input->post('unit');
			$amount = $this->input->post('amount');
			foreach($itemcode as $key=>$tmp){
				$values['salesorderid'] = $salesorderid;
				$values['itemcode'] = $tmp;
				$values['itemname'] = $itemname[$key];
				$values['quantity'] = $quantity[$key];
				$values['description'] = $description[$key];
				$values['unitprice'] = $unitprice[$key];
				$values['unit'] = $unit[$key];
				$values['amount'] = $amount[$key];
				$this->common_model->insert('salesorderrecords',$values);
				unset($values);
			}
			
		}
		
	redirect('sales/orders');
	}
	
	
	public function deletesalesorder($id){
		
		$values['status'] = 2;		
		$values['modifiedBy'] = $this->session->userdata("customerid");	
		$values['modifiedTime'] = date("Y-m-d H:i:s");	
			
		$where['salesorderid'] = $id;
		
		$this->common_model->update("salesorder",$values,$where);
		
		redirect('sales/orders');
	}
	
	
	// ---------------  Sales Invoice start ----------------- //
	
	
	public function invoices()
	{

		$data['invoices'] = 'menu';
		$company_id = get_customercompanyid();
	    $data['invoices'] = $this->common_model->get_records("salesinvoice","*",array("company_id"=>$company_id,"status" => 0));
		$data['content'] = "web/sales/invoices";

		$this->load->view('web/template', $data);
	}
	
	
	public function creaditnote()
	{

		$data['invoices'] = 'menu';
		$company_id = get_customercompanyid();
	    $data['creditnote'] = $this->common_model->get_records("creditnotes","*",array("company_id"=>$company_id,"status" => 0));
		$data['content'] = "web/sales/credit_note";

		$this->load->view('web/template', $data);
	}
	
	
	public function salesinvoice(){
			
		$company_id = get_customercompanyid();		
		
		$data['order_list'] = $this->sys_model->get_sales_order_list_for_invoice();		
		$records = $this->common_model->get_records("salesinvoice","*",array("company_id"=>$company_id));
		$data['invoicenumber'] = count($records) + 1;	
		
		$data['content'] = 'web/sales/salesinvoice';	
		$data['customers'] = $this->common_model->get_records("contacts","contactid,customername",array('contacttype !='=>2,"company_id"=>$company_id));	
		$data['itemmaster'] = $this->common_model->get_records("itemmaster","*",array("status"=>0,"company_id"=>$company_id));	
		$data['taxmaster'] = $this->common_model->get_records("taxmaster","*",array("status"=>0,"company_id"=>$company_id));	
		$this->load->view('web/template',$data);
	}
	
	public function createcreditnote(){
			
		$company_id = get_customercompanyid();	
		//$data['order_list'] = $this->sys_model->get_sales_order_list_for_invoice();		
		//$records = $this->common_model->get_records("salesinvoice","*",array("company_id"=>$company_id));
		//$data['invoicenumber'] = count($records) + 1;	
		$data['content'] = "web/sales/createcreditnote";
        $data['salesinvoiceno'] = $this->common_model->get_salesinvoiceid();
        $records = $this->common_model->get_records("creditnotes","*",array("company_id"=>$company_id,"status"=>0));
		
		$data['credit_id'] = count($records)+1;		
		//$data['customers'] = $this->common_model->get_records("contacts","contactid,customername",array("contacttype"=>1,"company_id"=>$company_id));	
		//$data['itemmaster'] = $this->common_model->get_records("itemmaster","*",array("status"=>0,"company_id"=>$company_id));	
		//$data['taxmaster'] = $this->common_model->get_records("taxmaster","*",array("status"=>0,"company_id"=>$company_id));	
		$this->load->view('web/template',$data);
	}
	
	
	public function savecreditnote(){

			
			$values['credit_id'] = trim(strip_tags($this->input->post('credit_number')));
			$values['issue_to'] = trim(strip_tags($this->input->post('towhom')));
			$values['against_invoice_no'] = trim(strip_tags($this->input->post('against_invoice_no')));
            $values['company_id'] = get_customercompanyid();
			
			$values['credit_date'] = $data['credit_date'] =  date("Y-m-d",strtotime(trim(strip_tags($this->input->post('credit_date')))));
			$values['preparedby'] = trim(strip_tags($this->input->post('preparedby')));
			$values['authorizedby'] = trim(strip_tags($this->input->post('authorizedby')));
			$values['amount'] = trim(strip_tags($this->input->post('amount')));
			$values['type'] = trim(strip_tags($this->input->post('type')));
			//$values['paid_to'] = trim(strip_tags($this->input->post('paid_to')));
			$values['totaldebit'] = trim(strip_tags($this->input->post('totaldebit')));
			$values['totalcredit'] = trim(strip_tags($this->input->post('totalcredit')));
			$values['narration'] = trim(strip_tags($this->input->post('narration')));
			
			$values['invamt'] = trim(strip_tags($this->input->post('invamt')));
			$values['balanceamonut'] = trim(strip_tags($this->input->post('balanceamonut')));
			$values['invoicedate'] = trim(strip_tags($this->input->post('invoicedate')));
			
			
			
			if(!$credit_number){				
				$values['createdBy'] = $this->session->userdata("customerid");	
				$values['createdTime'] = date("Y-m-d H:i:s");	
				
				$credit_number = $this->common_model->insert("creditnotes",$values);
				$this->session->set_flashdata("voucher_created","Credit Note Created Successfuly");
			}else{
				//edit voucher
				$values['modifiedBy'] = $this->session->userdata("customerid");	
				$values['modifiedTime'] = date("Y-m-d H:i:s");	
				
				$where['credit_number'] = $credit_number;
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
						$values['credit_id'] = $credit_number;
						$values['accountname'] = get_accountid($tmp);
						$values['debit'] = $debit[$key];					
						$values['credit'] = $credit[$key];					
						$values['reference'] = $reference[$key];					
						$this->common_model->insert("creditnotes_records",$values);
						unset($values);
					}
				}
			}
			
			$this->session->set_flashdata('creditnotes','Sales Voucher Created Successfully');
			
			redirect('sales/creaditnote');
		
	}
		
	public function get_invoiceusingorder(){
		
		
		$values['salesorderid'] = trim(strip_tags($this->input->post('orderid')));
		$values['company_id'] = get_customercompanyid();
		$record = $this->common_model->get_record("salesorder","customer,totalamount,quoteno,vat",$values);
		$record->customerid = $record->customer;
		$record->customername = get_contactname($record->customer);
		$data = $this->common_model->get_record("salesquote","validityperiod,paymentterms,deliveryperiod,otherterms",array('salesquoteid'=>$record->quoteno));
		$record->validityperiod = $data->validityperiod;
		$record->paymentterms = $data->paymentterms;
		$record->deliveryperiod = $data->deliveryperiod;
		$record->otherterms = $data->otherterms;
		
			
		echo json_encode($record);
	}
		
	public function get_invoicerecordsusingorder(){
		
		$orderid = trim(strip_tags($this->input->post('orderid')));
		$data['records'] = $this->sys_model->get_salesorder_records_invoice($orderid);
		$this->load->view('web/sales/ajax/invoice_records',$data);		
	}
	
	public function savesalesinvoice(){
		
		$salesinvoiceid = trim(strip_tags($this->input->post('salesinvoiceid')));
		
        $values['company_id'] = get_customercompanyid();
		$values['invoicedate'] = date("Y-m-d",strtotime(trim(strip_tags($this->input->post('issuedate')))));
		$values['invoicenumber'] = trim(strip_tags($this->input->post('invoicenumber')));
		$values['customerid'] = trim(strip_tags($this->input->post('customerid')));
		$values['ordernum'] = trim(strip_tags($this->input->post('orderno')));
		$values['vat'] = trim(strip_tags($this->input->post('vat')));
		$values['totalamount'] = trim(strip_tags($this->input->post('totalamount')));
		$values['preparedby'] = trim(strip_tags($this->input->post('preparedby')));
		$values['authorizedby'] = trim(strip_tags($this->input->post('authorizedby')));
		
		if(!$salesinvoiceid){
		
			$values['createdTime'] = date("Y-m-d H:i:s");
			
			$invoiceid = $this->common_model->insert('salesinvoice',$values);		
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
				$this->common_model->insert('salesinvoicerecords',$values);
				unset($values);			
				
			}
			
			
		}else{
			
			
			$values['modifiedTime'] = date("Y-m-d H:i:s");	
			
			$where['salesinvoiceid'] = $salesinvoiceid;
			
			$this->common_model->update('salesinvoice',$values,$where);		
			unset($values);	
			
		}
		
	redirect('sales/invoices');

	}
	public function editsalesinvoice($id){
			
		$company_id = get_customercompanyid();
		$data['order_list'] = $this->sys_model->get_sales_order_list_for_invoice();
		$record = $data['invoice'] = $this->common_model->get_record("salesinvoice","*",array("salesinvoiceid"=>$id));		
		$data['invoicerecords'] = $this->common_model->get_records("salesinvoicerecords","*",array("invoiceid"=>$id));	
		$data['invoicenumber'] = $record->invoicenumber;	
		$data['content'] = 'web/sales/salesinvoice';	
		$data['customers'] = $this->common_model->get_records("contacts","contactid,customername",array("contacttype"=>1,"company_id"=>$company_id));	
		$data['itemmaster'] = $this->common_model->get_records("itemmaster","*",array("company_id"=>$company_id,"status"=>0));	
		$data['taxmaster'] = $this->common_model->get_records("taxmaster","*",array("company_id"=>$company_id,"status"=>0));
		$orderdata = $this->common_model->get_record("salesorder","customer,totalamount,quoteno,vat",array('salesorderid'=>$record->ordernum));
		$data['quotedetails'] = $this->common_model->get_record("salesquote","validityperiod,paymentterms,deliveryperiod,otherterms",array('salesquoteid'=>$orderdata->quoteno));
		$this->load->view('web/template',$data);
	}
		public function deletesalesinvoice($id){
		
		$values['status'] = 2;		
		$values['modifiedBy'] = $this->session->userdata("customerid");	
		$values['modifiedTime'] = date("Y-m-d H:i:s");	
			
		$where['salesinvoiceid'] = $id;
		
		$this->common_model->update("salesinvoice",$values,$where);
		
		redirect('sales/invoices');
	}
	
	
}
	