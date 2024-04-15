<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Attendance extends CI_Controller
{

 
	public function attendance_master($month = ''){
		if($month)
			$data['month'] = $month;
		else
			$data['month'] = date("m-Y");
			
		$month = explode("-",$data['month']);	
		$data['year']=$month[1];
		$data['mon']=$month[0];	
		$data['content'] = 'web/attendance_new/attendance';		
        $data['days']=cal_days_in_month(CAL_GREGORIAN,$month[0],$month[1]);
		$data['employee'] = $this->common_model->get_records('employee','*');			
		$this->load->view('web/template',$data);	
	}
	
	
	
	public function pdfAttendance($year,$mon){
		
		$this->load->helper('pdf_helper');
		$data['days']=cal_days_in_month(CAL_GREGORIAN,$mon,$year);
		$data['year']=$year;
		$data['mon']=$mon;	
		$data['employee'] = $this->common_model->get_records('employee','*');	
		
		
		tcpdf();
		$obj_pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$obj_pdf->SetCreator(PDF_CREATOR);
		$title = "_".$mon."_".$year."_Attendance";
		$obj_pdf->SetTitle($title);
		//$obj_pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $title, PDF_HEADER_STRING);
		$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		$obj_pdf->SetDefaultMonospacedFont('helvetica');
		$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		$obj_pdf->SetFont('helvetica', '',6);
		$obj_pdf->setFontSubsetting(false);
		$obj_pdf->AddPage();
		ob_start();
				
		$message = $this->load->view('web/attendance_new/pdf/pdfAttendance',$data,TRUE);
		//echo $message;exit;
		
		ob_end_clean();
		$obj_pdf ->lastPage();
		$obj_pdf->writeHTML($message, true, false, true, false, '');
		$obj_pdf->Output($title.'.pdf', 'D'); 

   }
}

