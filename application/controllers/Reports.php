<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reports extends CI_Controller {

		
	public function viewPurchaseOrder($id){
		$data['content'] = 'web/reports/view/viewPurchaseOrder';
		$data['order'] = $this->common_model->get_record("purchaseorder","*",array("purchaseorderid"=>$id));
		$data['orderrecords'] = $this->common_model->get_records("purchaseorderrecords","*",array("purchaseorderid"=>$id));
		
		$this->load->view('web/template',$data);
	}
	
	public function printQuotation($id){
		
		$data['order1'] = $this->common_model->get_record("purchasequote","*",array("purchasequoteid"=>$id));
		$data['order2'] = $this->common_model->get_records("purchasequoterecords","*",array("quoteid"=>$id));
		$data['fromCompany'] = $this->common_model->get_record('company','*');
		$data['toCompany'] = $this->common_model->get_record('contacts','*',array("contactid"=>$data['order1']->customerid));
		$this->load->view('web/print/printpurchasequote',$data);
	}
	
	
		public function printPurchaseOrder($id){
	    
		$company_id = get_customercompanyid();
		$data['order1'] = $this->common_model->get_record("purchaseorder","*",array("purchaseorderid"=>$id));
		$data['order2'] = $this->common_model->get_records("purchaseorderrecords","*",array("purchaseorderid"=>$id));
		$data['toCompany'] = $this->common_model->get_record('contacts','*',array("contactid"=>$data['order1']->supplier));
		$data['fromCompany'] = $this->common_model->get_record('company','*',array("company_id"=>$company_id));
		$this->load->view('web/print/printPurchaseOrder',$data);
	}
	
		public function viewPurchaseInvoice($id){
			
		$data['content'] = 'web/reports/view/viewPurchaseInvoice';
		$data['invoice'] = $this->common_model->get_record("purchaseinvoice","*",array("purchaseinvoiceid"=>$id));
		$data['invoicerecords'] = $this->common_model->get_records("purchaseinvoicerecords","*",array("invoiceid"=>$id));
		
		$this->load->view('web/template',$data);
	}
	
	
	  public function printSalesInvoice($id){
		$company_id = get_customercompanyid();
		$data['order1'] = $this->common_model->get_record("salesinvoice","*",array("salesinvoiceid"=>$id));
		$data['order2'] = $this->common_model->get_records("salesinvoicerecords","*",array("invoiceid"=>$id));
		$data['fromCompany'] = $this->common_model->get_record('company','*',array("company_id"=>$company_id));
		$data['toCompany'] = $this->common_model->get_record('contacts','*',array("contactid"=>$data['order1']->customerid));
		$this->load->view('web/print/printSalesInvoice',$data);
	}
	
	   public function printinvoice($id){
		   
		$company_id = get_customercompanyid();
	    $data['invoice1'] = $this->common_model->get_record("purchaseinvoice","*",array("purchaseinvoiceid"=>$id));
		$data['invoicerecords2'] = $this->common_model->get_records("purchaseinvoicerecords","*",array("invoiceid"=>$id));
		$data['fromCompany'] = $this->common_model->get_record('company','*',array("company_id"=>$company_id));
		$data['toCompany'] = $this->common_model->get_record("contacts","*",array("contactid"=>$data['invoice1']->customerid));
	
		$this->load->view('web/print/printinvoice',$data);
	}
		
	public function viewSalesOrder($id){
	
		$data['content'] = 'web/reports/view/viewSalesOrder';
		$data['order'] = $this->common_model->get_record("salesorder","*",array("salesorderid"=>$id));
		$data['orderrecords'] = $this->common_model->get_records("salesorderrecords","*",array("salesorderid"=>$id));
		$this->load->view('web/template',$data);
	}
	
	public function viewSalesInvoice($id){
		
		$data['content'] = 'web/reports/view/viewSalesInvoice';
		$data['invoice'] = $this->common_model->get_record("salesinvoice","*",array("salesinvoiceid"=>$id));
		$data['invoicerecords'] = $this->common_model->get_records("salesinvoicerecords","*",array("invoiceid"=>$id));
		
		$this->load->view('web/template',$data);
	}
		
		public function printSalesOrder($id){
		
		$data['order'] = $this->common_model->get_record("salesorder","*",array("salesorderid"=>$id));
		$data['orderrecords'] = $this->common_model->get_records("salesorderrecords","*",array("salesorderid"=>$id));
		$data['companydetails'] = $this->common_model->get_record('company','*');
		$this->load->view('web/print/printSalesOrder',$data); 
	}
	
	
		public function pdfSalesOrder($id){
			
			
			
		$this->load->helper('pdf_helper');
		
	
		$data['order'] = $this->common_model->get_record("salesorder","*",array("salesorderid"=>$id));
		$data['orderrecords'] = $this->common_model->get_records("salesorderrecords","*",array("salesorderid"=>$id));
		$data['companydetails'] = $this->common_model->get_record('company','*');
		
		
		
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
		
		$message = $this->load->view('web/reports/pdf/pdfSalesOrder',$data,TRUE);
		
		
ob_end_clean();
$obj_pdf ->lastPage();
$obj_pdf->writeHTML($message, true, false, true, false, '');
$obj_pdf->Output('SalesOrder.pdf', 'D');

	}
	
	public function pdfSalesInvoice($id){
		
			
		 $this->load->helper('pdf_helper');
		
		$company_id = get_customercompanyid();
		$data['order1'] = $this->common_model->get_record("salesinvoice","*",array("salesinvoiceid"=>$id));
		$data['order2'] = $this->common_model->get_records("salesinvoicerecords","*",array("invoiceid"=>$id));
		
		$data['fromCompany'] = $this->common_model->get_record('company','*',array("company_id"=>$company_id));
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
		
		$message = $this->load->view('web/reports/pdf/pdfSalesInvoice',$data,TRUE);
		
		
		ob_end_clean();
		$obj_pdf ->lastPage();
		$obj_pdf->writeHTML($message, true, false, true, false, '');
		$obj_pdf->Output('SalesInvoice.pdf', 'D'); 

	}
	
	public function balancesheet($id = ''){
				
		$this->session->set_userdata('trial_tally','');		
		$this->session->set_userdata('profit_tally','');		
		$this->session->set_userdata('reports_tally','');		
		$this->session->set_userdata('tally_look','');
		$this->session->set_userdata('tally_look_start','');
		$this->session->set_userdata('tally_look_end','');
		$this->session->set_userdata('fulltrial_tally','');
		
		$data['reports_tally'] = $id;
		
		if(isset($_POST) && !empty($_POST)){
			$data['fromDate'] = $_POST['fromDate'];
			$data['toDate'] = $_POST['toDate'];
		}
		$company_id = get_customercompanyid();
		$data['opening'] = $this->sys_model->get_opening_balance_list($company_id);
		
		$data['content'] = 'web/reports/balancesheet';		
		$this->load->view('web/template',$data);
	}
	
	public function ledger($accountname = '',$start = '',$end = ''){
		
		$this->session->set_userdata('reports_tally','');
				
		$data['content'] = 'web/reports/ledger';	
		if(!$accountname && !$start && !$end){	
			$accountname = trim(strip_tags($this->input->post('accountname')));
			$start = trim(strip_tags($this->input->post('startdate')));
			$end = trim(strip_tags($this->input->post('enddate')));	
			
			if($accountname != 'A'){
				$this->session->set_userdata('tally_look',$accountname);
				$this->session->set_userdata('tally_look_start',$start);
				$this->session->set_userdata('tally_look_end',$end);
			}
				
		}else{
			
		}
		
		//print_r($_POST);
		//exit();
		$company_id = get_customercompanyid();		
		if($accountname && $start && $end){
			
			
			
			$data['accountname'] = $accountname;
			$data['start'] = date("Y-m-d",strtotime($start));
			$data['end'] = date("Y-m-d",strtotime($end));
			//$data['ledger_drop'] = $this->sys_model->get_general_ledger_list($company_id,$data['start'],$data['end']);		
		}else{
			$year = get_defaultyeardata();
			$data['ledger_drop'] = $this->sys_model->get_general_ledger_list($company_id,$year->startdate,$year->enddate);		
		}		
		$data['ledger'] = $this->sys_model->get_general_ledger($company_id);			
		$data['ledger_drop'] = $this->sys_model->get_general_ledger($company_id);		
		//$data['ledger'] = $this->sys_model->get_general_ledger_list($company_id);	
		
		$year = get_defaultyeardata();		
		
		//$data['ledger_drop_opening']  = $this->sys_model->get_ledger_opening_balance_head($company_id);		
		$this->load->view('web/template',$data);
	}
	
	public function ledger_subcategory(){
		$companyid = get_customercompanyid();		
		$data['content'] = 'reports/ledger_subcategory';	
		$data['subsubcategory'] = $this->common_model->get_records('subsubcategory');
		
		$start = trim(strip_tags($this->input->post('startdate')));
		$end = trim(strip_tags($this->input->post('enddate')));				
		$subsubcategory = trim(strip_tags($this->input->post('subsubcategory')));
		
		if($subsubcategory && $start && $end){
			
			$data['start'] = date("Y-m-d",strtotime($start));
			$data['end'] = date("Y-m-d",strtotime($end));
			
			$data['accountnames'] = $this->sys_model->get_general_ledger_subcategory($companyid,$subsubcategory);
		}		
			
		$this->load->view('web/template',$data);
	}
	
	public function trialbalance($id = ''){
		
		
		$this->session->set_userdata('profit_tally','');		
		$this->session->set_userdata('reports_tally','');		
		$this->session->set_userdata('tally_look','');
		$this->session->set_userdata('tally_look_start','');
		$this->session->set_userdata('tally_look_end','');
		$this->session->set_userdata('fulltrial_tally','');
		$this->session->set_userdata('trial_tally','');
		
		$data['trialbalance'] = $id;
				
		$company_id = get_customercompanyid();
		if(isset($_POST) && !empty($_POST)){
			$data['fromDate'] = $_POST['fromDate'];
			$data['toDate'] = $_POST['toDate'];
			$data['trial'] = $this->sys_model->get_trial_balance($company_id,$_POST['fromDate'],$_POST['toDate']);
		}else{
			$data['trial'] = $this->sys_model->get_trial_balance($company_id);
		}
		$data['openingbalance'] = $this->common_model->get_records("openingbalance","*",array("company_id"=>$company_id));	
		$data['content'] = 'web/reports/trailbalance';
		$this->load->view('web/template',$data);
	}
	
	public function trialbalancefull($id = ''){		
		
		
		$this->session->set_userdata('profit_tally','');		
		$this->session->set_userdata('reports_tally','');		
		$this->session->set_userdata('tally_look','');
		$this->session->set_userdata('tally_look_start','');
		$this->session->set_userdata('tally_look_end','');
		$this->session->set_userdata('fulltrial_tally','');
		$this->session->set_userdata('trial_tally','');
		
		$data['trialbalance'] = $id;
		
		$data['content'] = 'web/reports/trialbalance_full';
		$company_id = get_customercompanyid();
		if(isset($_POST) && !empty($_POST)){
			$data['fromDate'] = $_POST['fromDate'];
			$data['toDate'] = $_POST['toDate'];
			$data['trial'] = $this->sys_model->get_trial_balance($company_id,$_POST['fromDate'],$_POST['toDate']);
		}else{
			$data['trial'] = $this->sys_model->get_trial_balance($company_id);
		}
		$data['openingbalance'] = $this->common_model->get_records("openingbalance","*",array("company_id"=>$company_id));	
		$this->load->view('web/template',$data);
	}
	
	public function profitandloss($id = ''){		
		
		$this->session->set_userdata('profit_tally','');		
		$this->session->set_userdata('reports_tally','');		
		$this->session->set_userdata('tally_look','');
		$this->session->set_userdata('tally_look_start','');
		$this->session->set_userdata('tally_look_end','');
		$this->session->set_userdata('trial_tally','');
		$this->session->set_userdata('fulltrial_tally','');
		
		if(isset($_POST) && !empty($_POST)){
			$data['fromDate'] = $_POST['fromDate'];
			$data['toDate'] = $_POST['toDate'];
		}
		
		$data['content'] = 'web/reports/profitandloss';
		$data['profitnloss'] = $id;
		
		$data['company_id'] = get_customercompanyid();
		
		$this->load->view('web/template',$data);
	}
	
	/*************Print****************/
	
	public function printprofitandloss($fromDate = '',$toDate = ''){	
		$data = array();	
			
		if($fromDate && $toDate){
			$data['fromDate'] = $fromDate;
			$data['toDate'] = $toDate;
		}
		
		$companyid = get_customercompanyid();
		
		$this->load->view('print/profitandloss',$data);
	}
	
	
	public function printVoucher($id){		
		$company_id = get_customercompanyid();
		$data['voucher'] = $this->sys_model->get_voucher_details($company_id,$id);
		$data['company_id'] = $company_id;
		$this->load->view('web/print/printVoucher',$data);
	}
	
	public function printcreditnote($id){		
		$company_id = get_customercompanyid();
		$data['creditnote'] = $this->sys_model->get_creditnote_details($company_id,$id);
		$data['company_id'] = $company_id;
		$this->load->view('web/print/printcreditnote',$data);
	}
	

	public function pdfVoucher($id){


		$this->load->helper('pdf_helper');
		$company_id = get_customercompanyid();
		$data['voucher'] = $this->sys_model->get_voucher_details($company_id,$id);
		
		tcpdf();
		$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$obj_pdf->SetCreator(PDF_CREATOR);
		$title = "Balance Sheet PDF";
		$obj_pdf->SetTitle($title);
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
		
		
		$message = $this->load->view('web/reports/pdf/pdfVoucher',$data,TRUE);
			
				
		ob_end_clean();
		$obj_pdf ->lastPage();
		$obj_pdf->writeHTML($message, true, false, true, false, '');
		$obj_pdf->Output('voucher.pdf', 'D');
		
	
		
	}
	
	public function pdfprofitandloss($fromDate = '',$toDate = ''){		
		
		$data = array();	
			
		if($fromDate && $toDate){
			$data['fromDate'] = $fromDate;
			$data['toDate'] = $toDate;
		}		
		
		$companyid = get_customercompanyid();
		
		$data['companyid'] = $companyid;
		tcpdf();
		$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$obj_pdf->SetCreator(PDF_CREATOR);
		$title = "Profit and Loss PDF";
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
		
		
		$message = $this->load->view('reports/pdf/profitandloss',$data,TRUE);
			
				
		ob_end_clean();
		$obj_pdf ->lastPage();
		$obj_pdf->writeHTML($message, true, false, true, false, '');
		$obj_pdf->Output('profitandloss.pdf', 'D');
		
		
	}
	
	
	
	
	public function print_ledger($accountname,$start,$end){
					
		$company_id = get_customercompanyid();
		
		if($accountname && $start && $end){
			$data['accountname'] = $accountname;
			$data['start'] = date("Y-m-d",strtotime($start));
			$data['end'] = date("Y-m-d",strtotime($end));
		}
		
		$data['ledger'] = $this->sys_model->get_general_ledger($company_id);
		
		$data['ledger_drop'] = $this->sys_model->get_general_ledger($company_id);
		
		$this->load->view('web/print/ledger',$data);
	}
	
	public function print_balancesheet($fromDate = '',$toDate = ''){
		$data = array();
		
		if(isset($_POST) && !empty($_POST)){
			$data['fromDate'] = $_POST['fromDate'];
			$data['toDate'] = $_POST['toDate'];
		}
		$company_id = get_customercompanyid();
		$data['opening'] = $this->sys_model->get_opening_balance_list($company_id);
		$this->load->view('print/balancesheet',$data);
	}
	
	
	public function print_trialbalance($fromDate = '',$toDate = ''){	
		$data = array();
		
			$company_id = get_customercompanyid();
			
		if($fromDate && $toDate){
			$data['fromDate'] = $fromDate;
			$data['toDate'] = $toDate;
			$data['trial'] = $this->sys_model->get_trial_balance($company_id,$fromDate,$toDate);
		}else{
			$data['trial'] = $this->sys_model->get_trial_balance($company_id);	
		}
		
		
		$data['openingbalance'] = $this->common_model->get_records("openingbalance","*",array("company_id"=>$company_id));	
		
		
		$this->load->view('web/print/trialbalance',$data);
	}
	
	public function print_trialbalancefull($fromDate = '',$toDate = ''){	
		$data = array();
		
		$company_id = get_customercompanyid();
			
		if($fromDate && $toDate){
			$data['fromDate'] = $fromDate;
			$data['toDate'] = $toDate;
			$data['trial'] = $this->sys_model->get_trial_balance($company_id,$fromDate,$toDate);
		}else{
			$data['trial'] = $this->sys_model->get_trial_balance($company_id);	
		}
		
		
		$data['openingbalance'] = $this->common_model->get_records("openingbalance","*",array("company_id"=>$company_id));	
		
		
		$this->load->view('web/print/trialbalancefull',$data);
	}
	
	
	/*************Print****************/
	
	
	/*************View****************/
	public function viewQuote($id){
		$data['content'] = 'reports/view/viewQuote';
		
		$companyid = get_customercompanyid();
		$data['quote'] = $this->common_model->get_record("purchasequote","*",array("purchasequoteid"=>$id));
		$data['quoterecords'] = $this->common_model->get_records("purchasequoterecords","*",array("quoteid"=>$id));
		
		$this->load->view('web/template',$data);
	}
	
	
	public function viewGrn($id){
		$data['content'] = 'reports/view/viewGrn';
		
		$companyid = get_customercompanyid();
		$data['grn'] = $this->common_model->get_record("grn","*",array("grnid"=>$id));
		$data['grnrecords'] = $this->common_model->get_records("grnrecords","*",array("grnid"=>$id));
		
		$this->load->view('web/template',$data);
	}
	
	
	/*************View****************/
	
	/*************Sales View****************/
	public function viewSalesQuote($id){
		$data['content'] = 'reports/view/viewSalesQuote';
		
		/*$companyid = get_customercompanyid();
		$data['quote'] = $this->common_model->get_record("salesquote","*",array("salesquoteid"=>$id));
		$data['quoterecords'] = $this->common_model->get_records("salesquoterecords","*",array("quoteid"=>$id));*/
		
		$companyid = get_customercompanyid();
		$data['order1'] = $this->common_model->get_record("salesquote","*",array("salesquoteid"=>$id,"companyid"=>$companyid));
		$data['order2'] = $this->common_model->get_records("salesquoterecords","*",array("quoteid"=>$id));
		
		$data['fromCompany'] = $this->common_model->get_record('company','*',array("companyid"=>$companyid));
		$data['toCompany'] = $this->common_model->get_record('contacts','*',array("contactid"=>$data['order1']->customerid));
		
		
		$this->load->view('web/template',$data);
	}
	
	
	
	
		
	
	/*************Email****************/
	public function emailPurchaseQuote(){
		$this->load->helper('pdf_helper');
		$id = trim(strip_tags($this->input->post('emailPurchaseQuote')));
		$companyid = get_customercompanyid();
		$data['quote'] = $this->common_model->get_record("purchasequote","*",array("purchasequoteid"=>$id));
		$data['quoterecords'] = $this->common_model->get_records("purchasequoterecords","*",array("quoteid"=>$id));
		
		$message = $this->load->view('reports/email/viewQuote',$data,TRUE);
		
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$to      = trim(strip_tags($this->input->post('to')));
		$from      = trim(strip_tags($this->input->post('from')));
		$subject      = trim(strip_tags($this->input->post('subject')));
		
		$headers .= 'From: accounts@addobyte.com' . "\r\n" .
			'X-Mailer: PHP/' . phpversion();

		mail($to, $subject, $message, $headers);
		
		redirect('accounts/quotations');
	}
	
	public function emailPurchaseOrder(){
		$this->load->helper('pdf_helper');
		$id = trim(strip_tags($this->input->post('emailPurchaseOrder')));
		
		$companyid = get_customercompanyid();
		$data['order'] = $this->common_model->get_record("purchaseorder","*",array("purchaseorderid"=>$id));
		$data['orderrecords'] = $this->common_model->get_records("purchaseorderrecords","*",array("purchaseorderid"=>$id));
		$message = $this->load->view('reports/email/viewPurchaseOrder',$data,TRUE);
		
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$to      = trim(strip_tags($this->input->post('to')));
		$from      = trim(strip_tags($this->input->post('from')));
		$subject      = trim(strip_tags($this->input->post('subject')));
		
		$headers .= 'From: accounts@addobyte.com' . "\r\n" .
			'X-Mailer: PHP/' . phpversion();

		mail($to, $subject, $message, $headers);
		
		redirect('accounts/quotations');
	}
	/*************Email****************/
	
	
	/*************pdf****************/	
	
	public function balancesheet_pdf($fromDate = '',$toDate = ''){
		
		$data = array();
		
		if($fromDate && $toDate){
			$data['fromDate'] = $fromDate;
			$data['toDate'] = $toDate;
		}
		$companyid = get_customercompanyid();
		$data['opening'] = $this->sys_model->get_opening_balance_list($companyid);
		$this->load->helper('pdf_helper');
		$data['s'] = 's';
		tcpdf();
		$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		//$obj_pdf->SetCreator(PDF_CREATOR);
		$title = "Balance Sheet PDF";
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
		
		
		$message = $this->load->view('web/reports/pdf/balancesheet',$data,TRUE);
			
				
		ob_end_clean();
		$obj_pdf ->lastPage();
		$obj_pdf->writeHTML($message, true, false, true, false, '');
		$obj_pdf->Output('balancesheet.pdf', 'D');
	}
	
	
	public function ledger_pdf($accountname,$start,$end){
		$this->load->helper('pdf_helper');
					
		$company_id = get_customercompanyid();
		
		if($accountname && $start && $end){
			$data['accountname'] = $accountname;
			$data['start'] = date("Y-m-d",strtotime($start));
			$data['end'] = date("Y-m-d",strtotime($end));
		}
		
		$data['ledger'] = $this->sys_model->get_general_ledger($company_id);
		
		$data['ledger_drop'] = $this->sys_model->get_general_ledger_pdf($company_id,$accountname,$start,$end);
			
		tcpdf();
		$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$obj_pdf->SetCreator(PDF_CREATOR);
		$title = "General Ledger PDF";
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
		
		$message = $this->load->view('reports/pdf/ledger',$data,TRUE);
			
				
		ob_end_clean();
		$obj_pdf ->lastPage();
		$obj_pdf->writeHTML($message, true, false, true, false, '');
		$obj_pdf->Output('General_ledger.pdf', 'D');
	}
	
	
	public function pdfsaleQuote($id){
		$this->load->helper('pdf_helper');
		$companyid = get_customercompanyid();
		$data['order1'] = $this->common_model->get_record("salesquote","*",array("salesquoteid"=>$id,"companyid"=>$companyid));
		$data['order2'] = $this->common_model->get_records("salesquoterecords","*",array("quoteid"=>$id));
		
		$data['fromCompany'] = $this->common_model->get_record('company','*',array("companyid"=>$companyid));
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
		
		$message = $this->load->view('reports/pdf/pdfSalesQuote',$data,TRUE);
		
		
ob_end_clean();
$obj_pdf ->lastPage();
$obj_pdf->writeHTML($message, true, false, true, false, '');
$obj_pdf->Output('SalesQuote.pdf', 'D');

	}
	
	
	
	
	
		
	
	
	public function pdfPurchaseInvoice($id){
		
		$this->load->helper('pdf_helper');
		
		$companyid = get_customercompanyid();
		$data['order1'] = $this->common_model->get_record("purchaseinvoice","*",array("purchaseinvoiceid"=>$id,"companyid"=>$companyid));
		$data['order2'] = $this->common_model->get_records("purchaseinvoicerecords","*",array("invoiceid"=>$id));
		
		$data['fromCompany'] = $this->common_model->get_record('company','*',array("companyid"=>$companyid));
		$data['toCompany'] = $this->common_model->get_record('contacts','*',array("contactid"=>$data['order1']->customerid));
		
		
tcpdf();
$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$title = "Purchase Invoice PDF";
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
		
		$message = $this->load->view('reports/pdf/pdfPurchaseInvoice',$data,TRUE);
		
		
ob_end_clean();
$obj_pdf ->lastPage();
$obj_pdf->writeHTML($message, true, false, true, false, '');
$obj_pdf->Output('PurchaseInvoice.pdf', 'D'); 

	}
	
	
		
	
	public function pdfQuote($id){
		$this->load->helper('pdf_helper');
		
		$companyid = get_customercompanyid();
		$data['quote'] = $this->common_model->get_record("purchasequote","*",array("purchasequoteid"=>$id));
		$data['quoterecords'] = $this->common_model->get_records("purchasequoterecords","*",array("quoteid"=>$id));
		
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
		
		$message = $this->load->view('reports/pdf/viewQuote',$data,TRUE);
		
		
ob_end_clean();
$obj_pdf ->lastPage();
$obj_pdf->writeHTML($message, true, false, true, false, '');
$obj_pdf->Output('PurchaseQuote.pdf', 'D');

	}
	
	public function pdfOrder($id){
		$this->load->helper('pdf_helper');
		$companyid = get_customercompanyid();
		$data['order1'] = $this->common_model->get_record("purchaseorder","*",array("purchaseorderid"=>$id,"companyid"=>$companyid));
		$data['order2'] = $this->common_model->get_records("purchaseorderrecords","*",array("purchaseorderid"=>$id));
		
		$data['fromCompany'] = $this->common_model->get_record('company','*',array("companyid"=>$companyid));
		$data['toCompany'] = $this->common_model->get_record('contacts','*',array("contactid"=>$data['order1']->supplier));
		
		
tcpdf();
$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$title = "Purchase Order PDF";
$obj_pdf->SetTitle($title);
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
		
		$message = $this->load->view('print/printPurchaseOrder',$data,TRUE);//$this->load->view('reports/pdf/viewQuote',$data);
		
		
ob_end_clean();
$obj_pdf ->lastPage();
$obj_pdf->writeHTML($message, true, false, true, false, '');
$obj_pdf->Output('PurchaseOrder.pdf', 'D');

	}
	/*************pdf****************/


	
	public function trialbalance_pdf($fromDate = '',$toDate = ''){
		$this->load->helper('pdf_helper');
										
		$company_id = get_customercompanyid();
		if(isset($_POST) && !empty($_POST)){
			$data['fromDate'] = $_POST['fromDate'];
			$data['toDate'] = $_POST['toDate'];
			$data['trial'] = $this->sys_model->get_trial_balance($company_id,$_POST['fromDate'],$_POST['toDate']);
		}else{
			$data['trial'] = $this->sys_model->get_trial_balance($company_id);
		}
	
		$data['openingbalance'] = $this->common_model->get_records("openingbalance","*",array("company_id"=>$company_id));	
		

		tcpdf();
		$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$obj_pdf->SetCreator(PDF_CREATOR);
		$title = "Trialbalance PDF";
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
		
		$message = $this->load->view('web/reports/pdf/trialbalance',$data,TRUE);
			
				
		ob_end_clean();
		$obj_pdf ->lastPage();
		$obj_pdf->writeHTML($message, true, false, true, false, '');
		$obj_pdf->Output('Trial_Balance.pdf', 'D');
	}
	
	

	/************************ Full Report *****************************/
	
	public function trialbalancefull_pdf($fromDate = '',$toDate = ''){
		$this->load->helper('pdf_helper');
										
		$companyid = get_customercompanyid();
		if(isset($_POST) && !empty($_POST)){
			$data['fromDate'] = $_POST['fromDate'];
			$data['toDate'] = $_POST['toDate'];
			$data['trial'] = $this->sys_model->get_trial_balance($companyid,$_POST['fromDate'],$_POST['toDate']);
		}else{
			$data['trial'] = $this->sys_model->get_trial_balance($companyid);
		}
	
		$data['openingbalance'] = $this->common_model->get_records("openingbalance","*",array("companyid"=>$companyid));	
		

		tcpdf();
		$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$obj_pdf->SetCreator(PDF_CREATOR);
		$title = "Trialbalance PDF";
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
		
		$message = $this->load->view('reports/pdf/trialbalancefull',$data,TRUE);
			
				
		ob_end_clean();
		$obj_pdf ->lastPage();
		$obj_pdf->writeHTML($message, true, false, true, false, '');
		$obj_pdf->Output('Trial_Balance_Full.pdf', 'D');
	}
	
	
	/************************ EXCEL Report *****************************/

	
		public function trialbalance_excel(){
		
		$company_id = get_customercompanyid();
		if(isset($_POST) && !empty($_POST)){
			$data['fromDate'] = $_POST['fromDate'];
			$data['toDate'] = $_POST['toDate'];
			$data['trial'] = $this->sys_model->get_trial_balance($company_id,$_POST['fromDate'],$_POST['toDate']);
		}else{
			$data['trial'] = $this->sys_model->get_trial_balance($company_id);
		}
		$data['openingbalance'] = $this->common_model->get_records("openingbalance","*",array("company_id"=>$company_id));	
		
		$this->load->view('web/reports/excel/trialbalance',$data);
		
	}
	
	public function trialbalancefull_excel(){
		
		$companyid = get_customercompanyid();
		if(isset($_POST) && !empty($_POST)){
			$data['fromDate'] = $_POST['fromDate'];
			$data['toDate'] = $_POST['toDate'];
			$data['trial'] = $this->sys_model->get_trial_balance($companyid,$_POST['fromDate'],$_POST['toDate']);
		}else{
			$data['trial'] = $this->sys_model->get_trial_balance($companyid);
		}
		$data['openingbalance'] = $this->common_model->get_records("openingbalance","*",array("companyid"=>$companyid));	
		
		$this->load->view('reports/excel/trialbalancefull',$data);
		
	}
	
	public function balancesheet_excel(){
	if(isset($_POST) && !empty($_POST)){
			$data['fromDate'] = $_POST['fromDate'];
			$data['toDate'] = $_POST['toDate'];
		}
		$company_id = get_customercompanyid();
		$data['opening'] = $this->sys_model->get_opening_balance_list($company_id);
		
		
		$this->load->view('web/reports/excel/balancesheet',$data);		
	}
	
	
	public function ledger_excel($accountname,$start,$end){	
	
	$company_id = get_customercompanyid();
		
		if($accountname && $start && $end){
			$data['accountname'] = $accountname;
			$data['start'] = date("Y-m-d",strtotime($start));
			$data['end'] = date("Y-m-d",strtotime($end));
		}
		
		$data['ledger_drop'] = $data['ledger'] = $this->sys_model->get_general_ledger($company_id);
		
		$this->load->view('web/reports/excel/ledger',$data);	
			
	}
	
	public function profitandloss_excel(){
		$data = array();
	if(isset($_POST) && !empty($_POST)){
			$data['fromDate'] = $_POST['fromDate'];
			$data['toDate'] = $_POST['toDate'];
		}
		
		$companyid = get_customercompanyid();
		
		$this->load->view('reports/excel/profitandloss',$data);		
	}
	
	public function get_account_ledger(){
		$data['accountname'] = $acc = trim(strip_tags($this->input->post('acc')));
		$from = trim(strip_tags($this->input->post('from')));
		
		if($from == 'fulltrial')
			$this->session->set_userdata('fulltrial_tally',$acc);
			
		if($from == 'trial')
			$this->session->set_userdata('trial_tally',$acc);
		
		if($from == 'balancesheet')
			$this->session->set_userdata('reports_tally',$acc);
			
		if($from == 'profit')
			$this->session->set_userdata('profit_tally',$acc);
		
		$year = get_defaultyeardata();
		$data['particulars'] = get_ledger_particulars($acc,'0',$year->startdate,$year->enddate);		
		
		$this->load->view('web/reports/trialbalance_summary',$data);
	}
	
	public function excelvoucher($id){		
		$companyid = get_customercompanyid();
		$data['voucher'] = $this->sys_model->get_voucher_details($companyid,$id);				
		$this->load->view('reports/excel/excelvoucher',$data);		
	}
	
	
	public function printQuickInvoice($id){
		$company_id = get_customercompanyid();	
		
		$data['order1'] = $this->common_model->get_record("salesinvoice","*",array("salesinvoiceid"=>$id,"company_id"=>$company_id));
		$data['order2'] = $this->common_model->get_records("salesinvoicerecords","*",array("invoiceid"=>$id));
		
		$data['fromCompany'] = $this->common_model->get_record('company','*',array("company_id"=>$company_id));
		$data['toCompany'] = $this->common_model->get_record('contacts','*',array("contactid"=>$data['order1']->customerid));
		$this->load->view('web/print/printQuickInvoice',$data);
	}
	
	
	public function pdfQuickInvoice($id){
				
		$companyid = get_customercompanyid();	
		
		$data['order1'] = $this->common_model->get_record("salesinvoice","*",array("salesinvoiceid"=>$id,"companyid"=>$companyid));
		$data['order2'] = $this->common_model->get_records("salesinvoicerecords","*",array("invoiceid"=>$id));
		
		$data['fromCompany'] = $this->common_model->get_record('company','*',array("companyid"=>$companyid));
		$data['toCompany'] = $this->common_model->get_record('contacts','*',array("contactid"=>$data['order1']->customerid));
		
		
		tcpdf();
		$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$obj_pdf->SetCreator(PDF_CREATOR);
		$title = "Quick Invoice PDF";
		$obj_pdf->SetTitle($title);
		$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		$obj_pdf->SetDefaultMonospacedFont('helvetica');
		$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		$obj_pdf->SetFont('helvetica', '', 9);
		$obj_pdf->setFontSubsetting(false);
		$obj_pdf->AddPage();
		ob_start();
		
		$message = $this->load->view('reports/pdf/pdfQuickInvoice',$data,TRUE);
			
				
		ob_end_clean();
		$obj_pdf ->lastPage();
		$obj_pdf->writeHTML($message, true, false, true, false, '');
		$obj_pdf->Output('quickinvoice.pdf', 'D');
		
		
	}
	
	
	/***********************REPORTS*************************/
	public function purchaseinvoice(){
		$companyid = get_customercompanyid();	
		
		if(isset($_POST) && !empty($_POST)){
			$invoicenumber = trim(strip_tags($this->input->post('invoicenumber')));
			$startdate = trim(strip_tags($this->input->post('startdate')));
			$enddate = trim(strip_tags($this->input->post('enddate')));
			$invoiceamount = trim(strip_tags($this->input->post('invoiceamount')));
			$customer = trim(strip_tags($this->input->post('customer')));
			
			$str = array("companyid = $companyid");
			if($invoicenumber){
				$str[] = "invoicenumber = ".$invoicenumber;
			}
			
			if($startdate && $enddate){
				$startdate = date("Y-m-d",strtotime($startdate));
				$enddate = date("Y-m-d",strtotime($enddate));
				$str[] = "invoicedate between '$startdate' and '$enddate'";
			}
			
			if($startdate && !$enddate){
				$startdate = date("Y-m-d",strtotime($startdate));
				$str[] = "invoicedate = '$startdate'";
			}
			
			if($invoiceamount){
				$str[] = "totalamount = $invoiceamount";
			}
			
			$string = implode(" and ",$str);
			
			$salesinvoice = $data['salesinvoice'] = $this->sys_model->get_purchase_invoice_reports($string);
			
		}
		
		$data['content'] = 'reports/purchaseinvoice';		
		$this->load->view('web/template',$data);
	}
	
	public function salesinvoice(){
		$companyid = get_customercompanyid();	
		
		if(isset($_POST) && !empty($_POST)){
			$invoicenumber = trim(strip_tags($this->input->post('invoicenumber')));
			$startdate = trim(strip_tags($this->input->post('startdate')));
			$enddate = trim(strip_tags($this->input->post('enddate')));
			$invoiceamount = trim(strip_tags($this->input->post('invoiceamount')));
			$customer = trim(strip_tags($this->input->post('customer')));
			
			$str = array("companyid = $companyid and quickinvoice = 0");
			if($invoicenumber){
				$str[] = "invoicenumber = ".$invoicenumber;
			}
			
			if($startdate && $enddate){
				$startdate = date("Y-m-d",strtotime($startdate));
				$enddate = date("Y-m-d",strtotime($enddate));
				$str[] = "invoicedate between '$startdate' and '$enddate'";
			}
			
			if($startdate && !$enddate){
				$startdate = date("Y-m-d",strtotime($startdate));
				$str[] = "invoicedate = '$startdate'";
			}
			
			if($invoiceamount){
				$str[] = "totalamount = $invoiceamount";
			}
			
			$string = implode(" and ",$str);
			
			$salesinvoice = $data['salesinvoice'] = $this->sys_model->get_sales_invoice_reports($string);
			
		}
		
		$data['content'] = 'reports/salesinvoice';		
		$this->load->view('web/template',$data);
	}
	
	public function quicksalesinvoice(){
		$companyid = get_customercompanyid();	
		
		if(isset($_POST) && !empty($_POST)){
			$invoicenumber = trim(strip_tags($this->input->post('invoicenumber')));
			$startdate = trim(strip_tags($this->input->post('startdate')));
			$enddate = trim(strip_tags($this->input->post('enddate')));
			$invoiceamount = trim(strip_tags($this->input->post('invoiceamount')));
			$customer = trim(strip_tags($this->input->post('customer')));
			
			$str = array("companyid = $companyid and quickinvoice = 1");
			if($invoicenumber){
				$str[] = "invoicenumber = ".$invoicenumber;
			}
			
			if($startdate && $enddate){
				$startdate = date("Y-m-d",strtotime($startdate));
				$enddate = date("Y-m-d",strtotime($enddate));
				$str[] = "invoicedate between '$startdate' and '$enddate'";
			}
			
			if($startdate && !$enddate){
				$startdate = date("Y-m-d",strtotime($startdate));
				$str[] = "invoicedate = '$startdate'";
			}
			
			if($invoiceamount){
				$str[] = "totalamount = $invoiceamount";
			}
			
			$string = implode(" and ",$str);
			
			$salesinvoice = $data['salesinvoice'] = $this->sys_model->get_sales_invoice_reports($string);
			
		}
		
		$data['content'] = 'reports/quicksalesinvoice';		
		$this->load->view('web/template',$data);
	}
	/***********************REPORTS*************************/

}