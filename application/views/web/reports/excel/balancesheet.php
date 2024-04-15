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
$objPHPExcel->getActiveSheet()->mergeCells('A1:B1');
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_DARKGREEN);
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setUnderline(PHPExcel_Style_Font::UNDERLINE_SINGLE);
$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('A2', 'Balance Sheet as at '.date("d-M-Y",strtotime(get_defaultyear_end())));  
$objPHPExcel->getActiveSheet()->mergeCells('A2:B2');
$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setSize(18);
$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_DARKGREEN);
$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setUnderline(PHPExcel_Style_Font::UNDERLINE_SINGLE);
$objPHPExcel->getActiveSheet()->getStyle('A2')->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));


$companyid = get_customercompanyid();
		$balancesheet = $this->sys_model->get_vouchers_balance_sheet_new($companyid);	
							
		$data = array();
		foreach($balancesheet as $tmp){
			$data[$tmp->categoryid][$tmp->subcategoryid][$tmp->accountname] = $tmp->diff;	
			}							
			$data[2][4][] = 0.00;
							
			foreach($opening as $tmp){
				if($tmp->debit == '0.00' && isset($data[$tmp->categoryid][$tmp->subcategoryid][$tmp->accountid])){
					$data[$tmp->categoryid][$tmp->subcategoryid][$tmp->accountid] += $tmp->credit;	
				}else if($tmp->debit == '0.00'){ 
					$data[$tmp->categoryid][$tmp->subcategoryid][$tmp->accountid] = $tmp->credit;	
				}
								
				if($tmp->credit == '0.00' && isset($data[$tmp->categoryid][$tmp->subcategoryid][$tmp->accountid])){
					$data[$tmp->categoryid][$tmp->subcategoryid][$tmp->accountid] -= $tmp->debit;					
				}else if($tmp->credit == '0.00'){
					$data[$tmp->categoryid][$tmp->subcategoryid][$tmp->accountid] = -$tmp->debit;	
					}				
					}
			$i=3;				
		foreach($data as $key=>$tmp){	//Main Category Start						
				if(!isset($fake)){ $fake = 1;
				
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, get_currency());  
$objPHPExcel->getActiveSheet()->mergeCells('A'.$i.':B'.$i);
$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setSize(16);
$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));
	

	
				
				}
$i=$i+1;				
				
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, get_categoryname($key));  
if(isset($fake)){
$objPHPExcel->getActiveSheet()->mergeCells('A'.$i.':B'.$i);

}

$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setSize(16);
$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT));


foreach($tmp as $skey=>$temp){ 
$i=$i+1;
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, get_subcategoryname($skey));  
$objPHPExcel->getActiveSheet()->mergeCells('A'.$i.':B'.$i);
$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setSize(16);
$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT));

foreach($temp as $akey=>$ba){
							if($ba == '0.00')
								continue;
							
$i=$i+1;
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, ucwords(get_accountname($akey)));  
$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setSize(14);

$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT));
	

$arr[$key][] = $val = $ba;
																	
if($key == 1 && $val > 0){
	$val1 =  "(".number_format(abs($val),2).")";
}else if($key == 2 && $val < 0){
	$val1 =  "(".number_format(abs($val),2).")";
}else{
	$val1 =  number_format(abs($val),2);
}


$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $val1 );  
$objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setSize(14);
$objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));

}

		unset($bArr);
		if($key == '2' && $skey == '4'){
		$pResult = get_profit_loss_result();
		$sfake = 1;
							
							
							//$equity = balance_equity_reserve();
		$equity = $pResult->result;
		$arr[$key][] = $equity;
	$i=$i+1;	
	
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, get_accountname(profit_loss_account()));  
$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setSize(14);

$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT));


$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, number_format(abs($equity),2) );  
$objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setSize(14);

$objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));

	
	
}		
								
}	


$i=$i+1;	
	
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, "Total ".get_categoryname($key));  
$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setSize(16);
$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_DARKGREEN);
$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT));


$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, isset($arr[$key])?number_format(abs(array_sum($arr[$key])),2):"-" );  
$objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setSize(16);
$objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_DARKGREEN);
$objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));


}
		
		
					
$objPHPExcel->getActiveSheet()->getStyle('A4:B'.$i)->applyFromArray(
		array(
			
			'borders' => array(
				'allborders'     => array(
 					'style' => PHPExcel_Style_Border::BORDER_THIN
 				)
			)
	 		
		)
);

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);

$objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);	// Needs to be set to true in order to enable any worksheet protection!
$objPHPExcel->getActiveSheet()->protectCells('A4:C4', 'PHPExcel');



$subtitle = "As at ".date("d-M-Y",strtotime(get_defaultyear_end()));
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle($subtitle);


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="BalanceSheet.xls"');
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
