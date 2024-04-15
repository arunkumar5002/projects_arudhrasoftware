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


// Add some data
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('A1', get_defaultcompany());  
$objPHPExcel->getActiveSheet()->mergeCells('A1:C1');
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_DARKGREEN);
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setUnderline(PHPExcel_Style_Font::UNDERLINE_SINGLE);
$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
	
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('A2', 'Trial Balance as on '.get_defaultyear_end());  
$objPHPExcel->getActiveSheet()->mergeCells('A2:C2');
$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setSize(18);
$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_DARKGREEN);
$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setUnderline(PHPExcel_Style_Font::UNDERLINE_SINGLE);
$objPHPExcel->getActiveSheet()->getStyle('A2')->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
	
	
	
						
						$balance = array();
						foreach($trial as $tmp){
							/*$balance[$tmp->accountname]['debit'][] = $tmp->debit;
							$balance[$tmp->accountname]['credit'][] = $tmp->credit;*/
							$details = get_accountname_details($tmp->accountname);
							
							if($details->groupid == 1){
								$balance[$details->groupid][$details->subcategoryid][$tmp->accountname]['debit'][] = $tmp->debit;
								$balance[$details->groupid][$details->subcategoryid][$tmp->accountname]['credit'][] = $tmp->credit;
							}else if($details->groupid == 2){
								$balance[$details->groupid][$details->categoryid][$tmp->accountname]['debit'][] = $tmp->debit;
								$balance[$details->groupid][$details->categoryid][$tmp->accountname]['credit'][] = $tmp->credit;
							}
						}
						
						foreach($openingbalance as $tmp){
							/*$balance[$tmp->accountname]['debit'][] = $tmp->debit;
							$balance[$tmp->accountname]['credit'][] = $tmp->credit;*/
							$details = get_accountname_details($tmp->accountname);
							
							if($details->groupid == 1){
								$balance[$details->groupid][$details->subcategoryid][$tmp->accountname]['debit'][] = $tmp->debit;
								$balance[$details->groupid][$details->subcategoryid][$tmp->accountname]['credit'][] = $tmp->credit;
							}else if($details->groupid == 2){
								$balance[$details->groupid][$details->categoryid][$tmp->accountname]['debit'][] = $tmp->debit;
								$balance[$details->groupid][$details->categoryid][$tmp->accountname]['credit'][] = $tmp->credit;
							}
						}
						
						ksort($balance);
						
if(!empty($balance)){
	
$objPHPExcel->setActiveSheetIndex(0);			
$objPHPExcel->getActiveSheet()->setCellValue('A3', 'Particulars');
$objPHPExcel->getActiveSheet()->setCellValue('B3', 'Opening Balance');
$objPHPExcel->getActiveSheet()->setCellValue('C3', 'Debit ('.get_currency().')');
$objPHPExcel->getActiveSheet()->setCellValue('D3', 'Credit ('.get_currency().')');
$objPHPExcel->getActiveSheet()->setCellValue('E3', 'Closing Balance');
$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setSize(14);
$objPHPExcel->getActiveSheet()->getStyle('B3')->getFont()->setSize(14);
$objPHPExcel->getActiveSheet()->getStyle('C3')->getFont()->setSize(14);
$objPHPExcel->getActiveSheet()->getStyle('D3')->getFont()->setSize(14);
$objPHPExcel->getActiveSheet()->getStyle('E3')->getFont()->setSize(14);

$i = 3;
	
foreach($balance as $l1=>$tmp1){
																									
foreach($tmp1 as $l2=>$tmp2){	
	$i=$i+1;
		if($l1 == 1){
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, get_subcategoryname($l2));
			$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->mergeCells('A'.$i.':E'.$i);
		}else if($l1 == 2){
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, "  ".get_categoryname($l2));
			$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->mergeCells('A'.$i.':E'.$i);
		}
									
foreach($tmp2 as $l3=>$tmp3){		
			$i=$i+1;								   
	 $find = array_sum($tmp3['debit']) - array_sum($tmp3['credit']);
								  					
			
$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, "  ".get_accountname($l3));
$openval =''; 
$openb = json_decode(get_company_opening_balance($l3));
			if(isset($openb->debit)){
				$openval = number_format(round(abs($openb->debit)),2)." Dr";
			}else if(isset($openb->credit)){
				$openval = number_format(round(abs($openb->credit)),2)." Cr";
			}else{
				$openval = "0.00";
			}
											
$objPHPExcel->getActiveSheet()->setCellValue('B'.$i,$openval);
$debit = $totaldebit[] = array_sum($tmp3['debit']);
			
$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, number_format(round(abs($debit)),2));
$credit = $totalcredit[] = array_sum($tmp3['credit']);
									
$objPHPExcel->getActiveSheet()->setCellValue('D'.$i, number_format(round(abs($credit)),2) );
$closeval =''; 
if(isset($openb->debit)){
		$closeval = number_format(round(abs(($openb->debit + $debit) - $credit)),2)." Dr";
}else if(isset($openb->credit)){
		$closeval = number_format(round(abs(($openb->credit + $credit) - $debit)),2)." Cr";
}else{
	$ftot = $debit - $credit;
	if($ftot < 0){
		$closeval = number_format(round(abs($ftot)),2)." Cr";
	}else{
		$closeval = number_format(round(abs($ftot)),2)." Dr";
	}
}
											
$objPHPExcel->getActiveSheet()->setCellValue('E'.$i, $closeval);
$objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));
$objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));
$objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));
$objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));



		}
	}
	
}	

$i=$i+1;
	$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, 'Total');
	$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setSize(12);
	$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, number_format(round(abs(array_sum($totaldebit))),2));
	$objPHPExcel->getActiveSheet()->setCellValue('D'.$i, number_format(round(abs(array_sum($totalcredit))),2));
	$objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setSize(12);
	$objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setSize(12);
	$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));
	$objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));

	
}


$objRichText = new PHPExcel_RichText();





$objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);	// Needs to be set to true in order to enable any worksheet protection!
$objPHPExcel->getActiveSheet()->protectCells('A3:E'.$i, 'PHPExcel');


$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);




$objPHPExcel->getActiveSheet()->getStyle('A3:E'.$i)->applyFromArray(
		array(
			
			'borders' => array(
				'allborders'     => array(
 					'style' => PHPExcel_Style_Border::BORDER_THIN
 				)
			)
	 		
		)
);


$objPHPExcel->getActiveSheet()->getStyle('A3:E3')->applyFromArray(
		array(
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			),
			'font'    => array(
				'bold'      => true
			)
			
		)
);



$subtitle = "As on ".get_defaultyear_end();
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle($subtitle);


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="trialbalance.xls"');
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