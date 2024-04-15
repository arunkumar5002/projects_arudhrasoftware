<?php


//$this->load->helper('excel_helper');					
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


	$styleArray = array(
    'font'  => array(
       
        'color' => array('rgb' => 'A52A2A')
      
    ));
	
	$styleArrayred = array(
    'font'  => array(
       
        'color' => array('rgb' => 'E62E00')
      
    ));
	
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
$objPHPExcel->getActiveSheet()->setCellValue('A2', 'Profit & Loss for the financial year ended  '.date("d-M-Y",strtotime(get_defaultyear_end())));  
$objPHPExcel->getActiveSheet()->mergeCells('A2:B2');
$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_DARKGREEN);

$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setSize(18);
$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);

$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setUnderline(PHPExcel_Style_Font::UNDERLINE_SINGLE);
$objPHPExcel->getActiveSheet()->getStyle('A2')->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));



$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('A3', get_currency());  
$objPHPExcel->getActiveSheet()->mergeCells('A3:B3');
$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setSize(16);
$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A3')->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));

$i = 4;
$category = get_categorylist(2);
foreach($category as $tmp){	//Main Category Start
if($tmp->categoryid != 3 && $tmp->categoryid != 5)
	continue;


$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $tmp->categoryname); 
$objPHPExcel->getActiveSheet()->mergeCells('A'.$i.':B'.$i); 
$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT));

if(isset($fromDate) && isset($toDate)){
	$records = get_voucherslist_profit_loss($tmp->categoryid,$fromDate,$toDate);
}else{
	$records = get_voucherslist_profit_loss($tmp->categoryid);
}

unset($bArr);
foreach($records as $record){ //Account name display start	
											
if($record->debit != '0.00')
	$bArr[$record->accountname]['debit'][] = $record->debit;
else
	$bArr[$record->accountname]['debit'][] = 0;
							
if($record->credit != '0.00')
	$bArr[$record->accountname]['credit'][] = $record->credit;
else
	$bArr[$record->accountname]['credit'][] = 0;
	}
$cost_sales = 0;

if(isset($bArr)){
	foreach($bArr as $key=>$ba){
		$i = $i+1;
		if(inventory_profit_loss() == $key){
			$costofsales = $ba['credit'];
				continue;
		}else{
			$costofsales = array();
		}
							
if(purchases_account() == $key){
	
	
				$objPHPExcel->setActiveSheetIndex(0);
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$i,' Cost Of Sales');
				$objPHPExcel->getActiveSheet()->mergeCells('A'.$i.':'.'B'.$i);  
				$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setSize(13);				
				$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT));
				

				$i=$i+1;	
				
				$objPHPExcel->setActiveSheetIndex(0);
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$i,'     Opening Stock');				 				
				$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT));
				
				$objPHPExcel->setActiveSheetIndex(0);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$i,'-');				 				
				$objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));

				
				$i=$i+1;	
				
				$objPHPExcel->setActiveSheetIndex(0);
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$i,'     Add'.get_accountname($key));				 				
				$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT));
				
				$objPHPExcel->setActiveSheetIndex(0);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$i,number_format(abs(array_sum($ba['debit'])),2));				 				
				$objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));
				
				
				$i=$i+1;	
				
				$objPHPExcel->setActiveSheetIndex(0);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$i,'--------------------');				 				
				$objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));

				$i=$i+1;	
				
				$objPHPExcel->setActiveSheetIndex(0);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$i,number_format(abs(array_sum($ba['debit'])),2));				 				
				$objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));
				
				$i=$i+1;	
				
				$objPHPExcel->setActiveSheetIndex(0);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$i,'--------------------');				 				
				$objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));
				
				$i=$i+1;	
				
				$objPHPExcel->setActiveSheetIndex(0);
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$i,'     Less:'.get_accountname(inventory_profit_loss()));				 				
				$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT));
				
				$objPHPExcel->setActiveSheetIndex(0);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$i,number_format(abs(array_sum($costofsales)),2));				 				
				$objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));
				
				$i=$i+1;	
				
				$objPHPExcel->setActiveSheetIndex(0);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$i,'--------------------');				 				
				$objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));
				
				$i=$i+1;	
				//unset($totalcost);
				//unset($cost_sales);
										
				$cost_sales = array_sum($ba['debit']) - array_sum($costofsales);
				$totalcost = (array_sum($ba['debit']) - array_sum($costofsales))?number_format(abs((array_sum($ba['debit']) - array_sum($costofsales))),2):"-";
								
								
				$objPHPExcel->setActiveSheetIndex(0);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$i,$totalcost);				 				
				$objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));
			
			
								
}else{

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, get_accountname($key));  
$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT));

$arr[$tmp->categoryid][] = $val = array_sum($ba['credit']) - array_sum($ba['debit']);								
								
								

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, number_format(abs($val),2));  
$objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));


		}
	}
  }
  
  $i =$i+1;
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, "Total ".$tmp->categoryname);
$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setBold(true);  
$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT));


$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, isset($arr[$tmp->categoryid])?number_format(abs(array_sum($arr[$tmp->categoryid])+$cost_sales),2):" -");  
$objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));


}	


	$grossprofit = 0;
	if(isset($arr[3]) && isset($arr[5]))
		$grossprofit = array_sum($arr[3]) + (array_sum($arr[5]) + $cost_sales);
	else if(isset($arr[3]))
		$grossprofit = array_sum($arr[3]) - $cost_sales;
	else if(isset($arr[5]))
		$grossprofit = - (array_sum($arr[5]) + $cost_sales);

  $i =$i+1;
  
  if($grossprofit > 0) { 
  $chval ='Profit';
	$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_DARKGREEN);
	$objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_DARKGREEN);

  }
  else
  {
	$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
	$objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);

	$chval ='Loss';
  } 
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, "Gross ".$chval); 
$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setBold(true); 
$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT));


$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, number_format(abs($grossprofit),2));  
$objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));

	unset($arr);
	$category = get_categorylist(2);
	foreach($category as $tmp){	//Main Category Start
		if($tmp->categoryid != 4 && $tmp->categoryid != 6)
			continue;
	
$i = $i+1;
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $tmp->categoryname); 
$objPHPExcel->getActiveSheet()->mergeCells('A'.$i.':B'.$i); 
$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT));

	if(isset($fromDate) && isset($toDate)){
			$records = get_voucherslist_profit_loss($tmp->categoryid,$fromDate,$toDate);
		}else{
			$records = get_voucherslist_profit_loss($tmp->categoryid);
		}
						
	unset($bArr);
	foreach($records as $record){ //Account name display start
		if($record->debit != '0.00')
			$bArr[$record->accountname]['debit'][] = $record->debit;
		else
			$bArr[$record->accountname]['debit'][] = 0;
							
		if($record->credit != '0.00')
			$bArr[$record->accountname]['credit'][] = $record->credit;
		else
			$bArr[$record->accountname]['credit'][] = 0;
		}
						
	if(isset($bArr)){
		foreach($bArr as $key=>$ba){
							
	$i = $i+1;
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, get_accountname($key));  
$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT));

$arr[$tmp->categoryid][] = $val = array_sum($ba['credit']) - array_sum($ba['debit']);								
								
								

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('B'.$i,number_format(abs($val),2));  
$objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));


	
	
	
		}	
	}
	
	
	$i =$i+1;
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, "Total ".$tmp->categoryname);
$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setBold(true);  
$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT));


if(isset($arr[$tmp->categoryid])){
									$expenses = number_format(array_sum($arr[$tmp->categoryid]), 2, '.', '');
									$chech2 = number_format(abs($expenses),2);
								}
								else{
									$chech2 = $expenses = "-";
								}
								
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $chech2);  
$objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));

if($tmp->categoryid != 6){
	
	$i =$i+1;
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, "Total");
$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setBold(true);  
$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT));

	if(isset($arr[$tmp->categoryid])){
		$expenses = number_format(($grossprofit+array_sum($arr[$tmp->categoryid])), 2, '.', '');
		$val2 = number_format(abs($expenses),2);
			if(!isset($indirect))
				$indirect = $expenses;
					}
	else{
		$expenses = number_format(($grossprofit), 2, '.', '');
		$val2 = number_format(abs($expenses),2);
			if(!isset($indirect))
				$indirect = $expenses;
		}
	$grossprofit = 0;
								
	
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $val2);  
$objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));

	
	
	}
}	

	if(isset($arr[4]) && isset($arr[6]))
		$net = array_sum($arr[6]);
	else if(isset($arr[4]))
		$net = array_sum($arr[4]);
	else if(isset($arr[6]))
		$net = array_sum($arr[6]);
	else
		$net = "0.00";
								
	$i = $i + 1;
if($indirect > abs($net)){
  $chval ='Profit';
	$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_DARKGREEN);
	$objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_DARKGREEN);

  }
  else
  {
	$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
	$objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);

	$chval ='Loss';
  } 
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, "Net ".$chval); 
$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setBold(true); 
$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT));


$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, number_format(abs($indirect + $net),2));  
$objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));

	
								
								
$objPHPExcel->getActiveSheet()->getStyle('A4:B'.$i)->applyFromArray(
		array(
			
			'borders' => array(
				'allborders'     => array(
 					'style' => PHPExcel_Style_Border::BORDER_THIN
 				)
			)
	 		
		)
);


$objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);	// Needs to be set to true in order to enable any worksheet protection!
$objPHPExcel->getActiveSheet()->protectCells('A4:B'.$i, 'PHPExcel');

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);




$subtitle = "Profit & Loss";
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle($subtitle);


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Profitandloss.xls"');
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
