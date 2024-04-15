<?php


$this->load->helper('excel_helper');					
phpexcel();

		
		
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

$objRichText = new PHPExcel_RichText();
// Set document properties
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");
$vouchertype='';
switch($voucher[0]->vouchertype){
			case 1:
				$vouchertype="Payment Voucher";
				break;
			case 2:
				$vouchertype="Receipt Voucher";
				break;
			case 3:
				$vouchertype="Journal Voucher";
				break;
			case 4:
				$vouchertype="Contra Voucher";
				break;
		}
// Add some data
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('A1', $vouchertype);  
$objPHPExcel->getActiveSheet()->mergeCells('A1:D2');
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT));

$objPHPExcel->getActiveSheet()->setCellValue('E1', "Voucher No : ");  
$objPHPExcel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('E1')->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT));

$objPHPExcel->getActiveSheet()->setCellValue('F1', $voucher[0]->voucherno );  
$objPHPExcel->getActiveSheet()->mergeCells('F1:H1');
$objPHPExcel->getActiveSheet()->getStyle('F1')->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT));


$objPHPExcel->getActiveSheet()->setCellValue('E2', "Date : ");  
$objPHPExcel->getActiveSheet()->getStyle('E2')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('E2')->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT));

$objPHPExcel->getActiveSheet()->setCellValue('F2', date('d-m-Y',strtotime($voucher[0]->voucherdate)) );  
$objPHPExcel->getActiveSheet()->mergeCells('F2:H2');
$objPHPExcel->getActiveSheet()->getStyle('F2')->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT));


$vouc ="";
if($voucher[0]->vouchertype == 4) 
	$vouc = "Deposit / Withdraw : "; 
else
	$vouc = "Pay To : ";


$objPHPExcel->getActiveSheet()->setCellValue('A3', $vouc );  
$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A3')->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));

$objPHPExcel->getActiveSheet()->setCellValue('B3', $voucher[0]->towhom );  
$objPHPExcel->getActiveSheet()->mergeCells('B3:G3');
$objPHPExcel->getActiveSheet()->getStyle('B3')->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT));


$objPHPExcel->getActiveSheet()->setCellValue('A4', "DESCRIPTION" ); 
$objPHPExcel->getActiveSheet()->getStyle('A4')->getFont()->setBold(true); 
$objPHPExcel->getActiveSheet()->getStyle('A4')->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));

$objPHPExcel->getActiveSheet()->setCellValue('B4', "DEBIT" ); 
$objPHPExcel->getActiveSheet()->mergeCells('B4:E4'); 
$objPHPExcel->getActiveSheet()->getStyle('B4')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('B4')->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));

$objPHPExcel->getActiveSheet()->setCellValue('F4', "CREDIT" ); 
$objPHPExcel->getActiveSheet()->mergeCells('F4:G4'); 
$objPHPExcel->getActiveSheet()->getStyle('F4')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('F4')->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));

$objPHPExcel->getActiveSheet()->setCellValue('H4', "REFERENCE" ); 
$objPHPExcel->getActiveSheet()->getStyle('H4')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('H4')->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));


 $i = 5;
foreach($voucher as $tmp){
	$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, get_accountname($tmp->accountname) ); 
	$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT));
	
	$dis_debit1 ='';
	if($tmp->debit != "0.00")
			{
				$debitArr[] = $debit = $tmp->debit;
				$deb = explode(".",$debit);	
				$dis_debit1 = $deb[0];
			}else{
				$dis_debit1 = "0";
			}
			
	$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $dis_debit1 ); 
	$objPHPExcel->getActiveSheet()->mergeCells('B'.$i.':'.'D'.$i); 
	$objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));
		
		$dis_debit2 ='';
		if($tmp->debit != "0.00")
			{
				
				$dis_debit2 = $deb[1];
			}else{
				$dis_debit2 = "00";
			}
			
	$objPHPExcel->getActiveSheet()->setCellValue('E'.$i, $dis_debit2 ); 
	$objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));

		$dis_credit1 ='';
			if($tmp->credit != "0.00")
			{				
				$creditArr[] = $credit = $tmp->credit;
				$cer = explode(".",$credit);	
				$dis_credit1 = $cer[0];
			}else{
				$dis_credit1 = "0";
			}

	$objPHPExcel->getActiveSheet()->setCellValue('F'.$i, $dis_credit1 ); 	
	$objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));
			
			$dis_credit2 ='';
			if($tmp->credit != "0.00")
			{
				$dis_credit2 = $cer[1];
				
			}else{
				$dis_credit2 = "00";
			}
				
				
	$objPHPExcel->getActiveSheet()->setCellValue('G'.$i, $dis_credit2 ); 	
	$objPHPExcel->getActiveSheet()->getStyle('G'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));

	
$objPHPExcel->getActiveSheet()->setCellValue('H'.$i, $tmp->reference ); 
$objPHPExcel->getActiveSheet()->getStyle('H'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));


	
	$i=$i+1;
}


$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, "$");  
$objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));


$totalcer = array_sum($debitArr);
$totcer = explode(".",$totalcer);

$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $totcer[0]); 
$objPHPExcel->getActiveSheet()->mergeCells('C'.$i.':'.'D'.$i); 
$objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));

$distotcer="";
if(isset($totcer[1])) 
	$distotcer = $totcer[1]; 
else  
	$distotcer = "00"; 

$objPHPExcel->getActiveSheet()->setCellValue('E'.$i, $distotcer);  
$objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));

$objPHPExcel->getActiveSheet()->setCellValue('F'.$i, $totcer[0]);  
$objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));

$objPHPExcel->getActiveSheet()->setCellValue('G'.$i, $distotcer);  
$objPHPExcel->getActiveSheet()->getStyle('G'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));

$i=$i+1;
$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, "The Sum of Dollars :");  
$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));

$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, convert_number($totalcer)." Dollars Only. " );  
$objPHPExcel->getActiveSheet()->mergeCells('B'.$i.':'.'H'.$i); 
$objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT));

$i=$i+1;
$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, "Prepared By : ");  
$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));

$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, ucfirst($voucher[0]->preparedby) );  
$objPHPExcel->getActiveSheet()->mergeCells('B'.$i.':'.'C'.$i); 
$objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT));

$objPHPExcel->getActiveSheet()->setCellValue('D'.$i, "Authorized By : ");
$objPHPExcel->getActiveSheet()->mergeCells('D'.$i.':'.'E'.$i);   
$objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));

$objPHPExcel->getActiveSheet()->setCellValue('F'.$i, ucfirst($voucher[0]->authorizedby) );  
$objPHPExcel->getActiveSheet()->mergeCells('F'.$i.':'.'H'.$i); 
$objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT));



$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);


		 	
$objPHPExcel->getActiveSheet()->getStyle('A1'.':'.'H'.$i)->applyFromArray(
		array(
			
			'borders' => array(
				'allborders'     => array(
 					'style' => PHPExcel_Style_Border::BORDER_THIN
 				)
			)
	 		
		)
);

$subtitle = "As at ".date("d-M-Y",strtotime(get_defaultyear_end()));
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle($subtitle);


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Voucher.xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;

?>