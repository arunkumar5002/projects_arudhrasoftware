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
$objPHPExcel->getActiveSheet()->mergeCells('A1:I1');
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_DARKGREEN);
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setUnderline(PHPExcel_Style_Font::UNDERLINE_SINGLE);
$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));

$startsdate = '';
if(isset($start))
{
	$startsdate  = date("d.m.Y",strtotime($start));	
}

$enddate = '';
if(isset($end))
{
	$enddate  = date("d.m.Y",strtotime($end));	
}

$subtitle = "General Ledger for the period from ".$startsdate." to ".$enddate ;
$vouchertypelist = array('1'=>"SP",'2'=>"CR",'3'=>"JV",'4'=>"CV",'5'=>"PV",'6'=>"SV","7"=>"DN","8"=>"CN");
							
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('A2', $subtitle );  
$objPHPExcel->getActiveSheet()->mergeCells('A2:I2');
$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setSize(18);
$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_DARKGREEN);
$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setUnderline(PHPExcel_Style_Font::UNDERLINE_SINGLE);
$objPHPExcel->getActiveSheet()->getStyle('A2')->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));


 $i = 3;
	if(isset($accountname) && isset($start) && isset($end)){
						foreach($ledger as $tmp){
							$comp_opening = get_company_opening_balance($tmp->accountname);
							
							if($tmp->accountname != $accountname && $accountname != 'A')
								continue;
							$particulars = get_ledger_particulars($tmp->accountname,$accountname,$start,$end);							
							if(empty($particulars))
								continue;
							
							

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('A'.$i,get_accountname($tmp->accountname));  
$objPHPExcel->getActiveSheet()->mergeCells('A'.$i.':'.'I'.$i);
$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setSize(16);
$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));

$i = $i+1;		


$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('A'.$i,'S.No');  
$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setSize(14);
$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('B'.$i,'Date');  
$objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setSize(14);
$objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('C'.$i,'Trans ID');  
$objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setSize(14);
$objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('D'.$i,'V Type');  
$objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setSize(14);
$objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));


$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('E'.$i,'Particulars');  
$objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getFont()->setSize(14);
$objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));


$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('F'.$i,'Ref');  
$objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getFont()->setSize(14);
$objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('G'.$i,'Debit('.get_currency().')');  
$objPHPExcel->getActiveSheet()->getStyle('G'.$i)->getFont()->setSize(14);
$objPHPExcel->getActiveSheet()->getStyle('G'.$i)->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('G'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('H'.$i,'Credit('.get_currency().')');  
$objPHPExcel->getActiveSheet()->getStyle('H'.$i)->getFont()->setSize(14);
$objPHPExcel->getActiveSheet()->getStyle('H'.$i)->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('H'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('I'.$i,'Balance ('.get_currency().')');  
$objPHPExcel->getActiveSheet()->getStyle('I'.$i)->getFont()->setSize(14);
$objPHPExcel->getActiveSheet()->getStyle('I'.$i)->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('I'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('J'.$i,' ');  
$objPHPExcel->getActiveSheet()->getStyle('J'.$i)->getFont()->setSize(14);
$objPHPExcel->getActiveSheet()->getStyle('J'.$i)->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('J'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));




/*************************OPENING BALANCE*******************************/
								
									
								$comp_opening = json_decode($comp_opening);
								$debit_open = $credit_open = '0.00';
								
								if(!empty($comp_opening)){
									if(isset($comp_opening->debit))
										$debit_open = $comp_opening->debit;
									else if(isset($comp_opening->credit))
										$credit_open = $comp_opening->credit;
								}else{
									$comp_opening = 0;
								}
								
								
								
								 
								$startdate = date("Y-m-d",strtotime(get_defaultyear_start()));
								$Tmpstart = date("Y-m-d",strtotime($start));
								
								if(get_defaultyear() != '-' && $startdate != $Tmpstart){
									
									
									if($startdate != $Tmpstart){										
										$Tmpstart = date("Y-m-d",strtotime("-1 day".$Tmpstart));
										$openBal = get_ledger_opening_balance($startdate,$Tmpstart,$tmp->accountname);
									
							$i = $i+1;			
									
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('A'.$i,'');  
$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setSize(12);
$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT));

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('B'.$i,'');  
$objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setSize(12);
$objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT));

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('C'.$i,'');  
$objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setSize(12);
$objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT));

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('D'.$i,'');  
$objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setSize(12);
$objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT));

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('E'.$i,'Opening Balance');  
$objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getFont()->setSize(12);
$objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT));

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('F'.$i,'');  
$objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getFont()->setSize(12);
$objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT));

											if($openBal->debit){
												$openBal->debit = $openBal->debit + abs($debit_open);
												$GD = number_format(abs($openBal->debit),2)."&nbsp;";
											}else{
												$GD = "0.00";
											}									
											$debitArr[] = $openBal->debit;				
									
									
											if($openBal->credit){
												$openBal->credit = $openBal->credit + abs($credit_open);
												$HC = number_format(abs($openBal->credit),2)."&nbsp;";
											}else{
												$HC = "0.00";
											}
											$creditArr[] = $openBal->credit;
										
										
											$res = array_sum($creditArr) - array_sum($debitArr);
											if($res >= 0)
												$str = ' (Dr)';
											else
												$str = ' (Cr)';
															
											$IT = number_format(abs(abs($res)),2)." ";
											
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('G'.$i,$GD);  
$objPHPExcel->getActiveSheet()->getStyle('G'.$i)->getFont()->setSize(12);
$objPHPExcel->getActiveSheet()->getStyle('G'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));
								
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('H'.$i,$HC);  
$objPHPExcel->getActiveSheet()->getStyle('H'.$i)->getFont()->setSize(12);
$objPHPExcel->getActiveSheet()->getStyle('H'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('I'.$i,$IT);  
$objPHPExcel->getActiveSheet()->getStyle('I'.$i)->getFont()->setSize(12);
$objPHPExcel->getActiveSheet()->getStyle('I'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));
								
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('J'.$i,$str);  
$objPHPExcel->getActiveSheet()->getStyle('J'.$i)->getFont()->setSize(12);
$objPHPExcel->getActiveSheet()->getStyle('J'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT));
								
								
									} 
								}else if(!empty($comp_opening)){
									//Previous year opening balance entry display
								$i = $i+1;	
								
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('A'.$i,'');  
$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setSize(12);
$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT));

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('B'.$i,'');  
$objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setSize(12);
$objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT));

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('C'.$i,'');  
$objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setSize(12);
$objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT));

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('D'.$i,'');  
$objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setSize(12);
$objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT));

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('E'.$i,'Opening Balance');  
$objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getFont()->setSize(12);
$objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT));

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('F'.$i,'');  
$objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getFont()->setSize(12);
$objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT));

											$GD = $debit_open;
																			
											$debitArr[] = $debit_open;			
									
									
											$HC = $credit_open;
											
											$creditArr[] = $credit_open;
										
										
											$res = array_sum($creditArr) - array_sum($debitArr);
											if($credit_open > 0)
												$str = ' (Cr)';
											else
												$str = ' (Dr)';
																						
											$IT = number_format(abs(abs($res)),2)." ";
											
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('G'.$i,$GD);  
$objPHPExcel->getActiveSheet()->getStyle('G'.$i)->getFont()->setSize(12);
$objPHPExcel->getActiveSheet()->getStyle('G'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));
								
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('H'.$i,$HC);  
$objPHPExcel->getActiveSheet()->getStyle('H'.$i)->getFont()->setSize(12);
$objPHPExcel->getActiveSheet()->getStyle('H'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('I'.$i,$IT);  
$objPHPExcel->getActiveSheet()->getStyle('I'.$i)->getFont()->setSize(12);
$objPHPExcel->getActiveSheet()->getStyle('I'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));
								
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('J'.$i,$str);  
$objPHPExcel->getActiveSheet()->getStyle('J'.$i)->getFont()->setSize(12);
$objPHPExcel->getActiveSheet()->getStyle('J'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT));
								
									
								
								
								
								}	
							
/*************************OPENING BALANCE*******************************/





		$sno = 1;
		foreach($particulars as $temp){
			
			$i=$i+1;
			
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('A'.$i,$sno++);  
$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setSize(12);
$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT));

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('B'.$i,date("d-m-Y",strtotime($temp->voucherdate)));  
$objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setSize(12);
$objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT));

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('C'.$i,$temp->voucherno);  
$objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setSize(12);
$objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT));

if($temp->debit != '0.00')
	$s = 'By';
else if($temp->credit != '0.00')
	$s = 'To';
											
$listvi = $s.' '.get_accountname($temp->accountname);
	
if(isset($temp->vouchertype) && !empty($temp->vouchertype)) { 
$vtypename = $vouchertypelist[$temp->vouchertype]; 
} 
	
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('D'.$i,$vtypename);  
$objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setSize(12);
$objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT));


$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('E'.$i,$listvi);  
$objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getFont()->setSize(12);
$objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT));


$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('F'.$i,$temp->reference?$temp->reference:"-");  
$objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getFont()->setSize(12);
$objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT));

$debitArr[] = $debit = $temp->credit;
												
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('G'.$i,number_format(abs($debit),2));  
$objPHPExcel->getActiveSheet()->getStyle('G'.$i)->getFont()->setSize(12);
$objPHPExcel->getActiveSheet()->getStyle('G'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));

$creditArr[] = $credit = $temp->debit;

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('H'.$i,number_format(abs($credit),2));  
$objPHPExcel->getActiveSheet()->getStyle('H'.$i)->getFont()->setSize(12);
$objPHPExcel->getActiveSheet()->getStyle('H'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));

$res = array_sum($creditArr) - array_sum($debitArr);
if($res >= 0)
	$str = ' (Dr)';
else
	$str = ' (Cr)';

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('I'.$i,number_format(abs($res),2));  
$objPHPExcel->getActiveSheet()->getStyle('I'.$i)->getFont()->setSize(12);
$objPHPExcel->getActiveSheet()->getStyle('I'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));


$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('J'.$i,$str);  
$objPHPExcel->getActiveSheet()->getStyle('J'.$i)->getFont()->setSize(12);
$objPHPExcel->getActiveSheet()->getStyle('J'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT));

				
		if($tmp->groupid == 2){
										if(array_sum($debitArr)>0){
											$tmpArr[$tmp->accountname]['debit'][] = $debit;
										}
										if(array_sum($creditArr)>0){
											$tmpArr[$tmp->accountname]['credit'][] = $credit;
										}	
									}							
	
		}

	$i=$i+1;
	
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('A'.$i,'Closing Balance (c/f)'); 
$objPHPExcel->getActiveSheet()->mergeCells('A'.$i.':'.'F'.$i); 
$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setSize(12);
$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));

if($res<0){
	
	
	$objPHPExcel->setActiveSheetIndex(0);
	$objPHPExcel->getActiveSheet()->setCellValue('G'.$i,'-'); 
	$objPHPExcel->getActiveSheet()->getStyle('G'.$i)->getFont()->setSize(12);
	$objPHPExcel->getActiveSheet()->getStyle('G'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));
	$closed = abs($res);
	

}
else
{
	$objPHPExcel->setActiveSheetIndex(0);
	$objPHPExcel->getActiveSheet()->setCellValue('G'.$i,number_format(abs($res),2));  
	
	$objPHPExcel->getActiveSheet()->getStyle('G'.$i)->getFont()->setSize(12);
	$objPHPExcel->getActiveSheet()->getStyle('G'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));
	
	$closed = 0;
}	

if($res>0){
	
	$objPHPExcel->setActiveSheetIndex(0);
	$objPHPExcel->getActiveSheet()->setCellValue('H'.$i,'-'); 
	$objPHPExcel->getActiveSheet()->getStyle('H'.$i)->getFont()->setSize(12);
	$objPHPExcel->getActiveSheet()->getStyle('H'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));

	$closec = abs($res);
}
else{
	
	$objPHPExcel->setActiveSheetIndex(0);
	$objPHPExcel->getActiveSheet()->setCellValue('H'.$i,number_format(abs($res),2));  
	
	$objPHPExcel->getActiveSheet()->getStyle('H'.$i)->getFont()->setSize(12);
	$objPHPExcel->getActiveSheet()->getStyle('H'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));
	
	$closec = 0;
	
}	

$objPHPExcel->setActiveSheetIndex(0);
	$objPHPExcel->getActiveSheet()->setCellValue('I'.$i,'-');  
	$objPHPExcel->getActiveSheet()->getStyle('I'.$i)->getFont()->setSize(12);
	$objPHPExcel->getActiveSheet()->getStyle('I'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));

	$i = $i+1;
	
	$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('A'.$i,''); 
$objPHPExcel->getActiveSheet()->mergeCells('A'.$i.':'.'E'.$i); 
$objPHPExcel->getActiveSheet()->setCellValue('F'.$i,'Total'); 
$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setSize(12);
$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
	
if(array_sum($debitArr)>0)	
{		
	$objPHPExcel->setActiveSheetIndex(0);
	$objPHPExcel->getActiveSheet()->setCellValue('G'.$i,number_format(abs((array_sum($debitArr) + $closec)),2));  
	$objPHPExcel->getActiveSheet()->getStyle('G'.$i)->getFont()->setSize(12);
	$objPHPExcel->getActiveSheet()->getStyle('G'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));

	
}
else
{
	$objPHPExcel->setActiveSheetIndex(0);
	$objPHPExcel->getActiveSheet()->setCellValue('G'.$i,number_format(abs((array_sum($creditArr) + $closed)),2)); 
	$objPHPExcel->getActiveSheet()->getStyle('G'.$i)->getFont()->setSize(12);
	$objPHPExcel->getActiveSheet()->getStyle('G'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));
	
}								
if(array_sum($creditArr)>0)								
{									
		$objPHPExcel->setActiveSheetIndex(0);
	$objPHPExcel->getActiveSheet()->setCellValue('H'.$i,number_format(abs((array_sum($creditArr) + $closed)),2));  
	$objPHPExcel->getActiveSheet()->getStyle('H'.$i)->getFont()->setSize(12);
	$objPHPExcel->getActiveSheet()->getStyle('H'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));

}
else{
	
	$objPHPExcel->setActiveSheetIndex(0);
	$objPHPExcel->getActiveSheet()->setCellValue('H'.$i,number_format(abs((array_sum($debitArr) + $closec)),2)); 
	$objPHPExcel->getActiveSheet()->getStyle('H'.$i)->getFont()->setSize(12);
	$objPHPExcel->getActiveSheet()->getStyle('H'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));
	
}	

	$objPHPExcel->setActiveSheetIndex(0);
	$objPHPExcel->getActiveSheet()->setCellValue('I'.$i,'-'); 
	$objPHPExcel->getActiveSheet()->getStyle('I'.$i)->getFont()->setSize(12);
	$objPHPExcel->getActiveSheet()->getStyle('I'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));
	
	$i=$i+1;
	
	
		
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('A'.$i,'Opening Balance (b/f)'); 
$objPHPExcel->getActiveSheet()->mergeCells('A'.$i.':'.'F'.$i); 
$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setSize(12);
$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));

if($res>0){
	
	
	$objPHPExcel->setActiveSheetIndex(0);
	$objPHPExcel->getActiveSheet()->setCellValue('G'.$i,'-'); 
	$objPHPExcel->getActiveSheet()->getStyle('G'.$i)->getFont()->setSize(12);
	$objPHPExcel->getActiveSheet()->getStyle('G'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));
	
	
}
else
{
	
	$objPHPExcel->setActiveSheetIndex(0);
	$objPHPExcel->getActiveSheet()->setCellValue('G'.$i,number_format(abs((array_sum($creditArr)-array_sum($debitArr))),2));  
	
	$objPHPExcel->getActiveSheet()->getStyle('G'.$i)->getFont()->setSize(12);
	$objPHPExcel->getActiveSheet()->getStyle('G'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));
}	

if($res<0){
	
	$objPHPExcel->setActiveSheetIndex(0);
	$objPHPExcel->getActiveSheet()->setCellValue('H'.$i,'-'); 
	$objPHPExcel->getActiveSheet()->getStyle('H'.$i)->getFont()->setSize(12);
	$objPHPExcel->getActiveSheet()->getStyle('H'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));
}
else{
	
$objPHPExcel->setActiveSheetIndex(0);
	$objPHPExcel->getActiveSheet()->setCellValue('H'.$i,number_format(abs((array_sum($debitArr)-array_sum($creditArr))),2));  	
	$objPHPExcel->getActiveSheet()->getStyle('H'.$i)->getFont()->setSize(12);
	$objPHPExcel->getActiveSheet()->getStyle('H'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));
	
}	

$objPHPExcel->setActiveSheetIndex(0);
	$objPHPExcel->getActiveSheet()->setCellValue('I'.$i,'-');  
	$objPHPExcel->getActiveSheet()->getStyle('I'.$i)->getFont()->setSize(12);
	$objPHPExcel->getActiveSheet()->getStyle('I'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));
							
unset($creditArr);
unset($debitArr);
//$i = $i+1;

//$objPHPExcel->setActiveSheetIndex(0);
//$objPHPExcel->getActiveSheet()->setCellValue('A'.$i,'');  
//$objPHPExcel->getActiveSheet()->mergeCells('A'.$i.':'.'J'.$i);


//$i = $i+1;
}


if(false && isset($tmpArr)){
	
	$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('A'.$i,get_accountname(profit_loss_account()));  
$objPHPExcel->getActiveSheet()->mergeCells('A'.$i.':'.'J'.$i);
$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setSize(16);
$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));

$i=$i+1;


$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('A'.$i,'S.No');  
$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setSize(14);
$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('B'.$i,'Particulars');  
$objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setSize(14);
$objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('C'.$i,'Debit');  
$objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setSize(14);
$objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('D'.$i,'Credit');  
$objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setSize(14);
$objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('E'.$i,'Balance');  
$objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getFont()->setSize(14);
$objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
							
								
$sno = 1;
foreach($tmpArr as $key=>$tmp){
$i=$i+1;

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('A'.$i,$sno++);  
$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setSize(12);
$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT));

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('B'.$i,get_accountname($key));  
$objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setSize(12);
$objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT));


if(isset($tmp['credit'])){
	$pdArr[] = $debit = array_sum($tmp['credit']);
	$chekliv = number_format(abs($debit),2);								
}
else{
	$chekliv = "-";
	$pdArr[] = $debit = 0;
}
								
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('C'.$i,$chekliv);  
$objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setSize(12);
$objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));

if(isset($tmp['debit'])){
	$pcArr[] = $credit = array_sum($tmp['debit']);
	$cheklcredit = number_format(abs($credit),2);
}
else{
$cheklcredit = "-";
$pcArr[] = $credit = 0;
}

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('D'.$i,$cheklcredit);  
$objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setSize(12);
$objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));

	$res = array_sum($pdArr)-array_sum($pcArr);
									if($res >= 0)
										$str = ' (Dr)';
									else
										$str = ' (Cr)';
																		 
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('E'.$i,number_format(abs($res),2));  
$objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getFont()->setSize(12);
$objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));


$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('F'.$i,$str);  
$objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getFont()->setSize(12);
$objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT));

						
}

$i= $i+1;

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('B'.$i,get_accountname(profit_loss_account()));  
$objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setSize(12);
$objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));

if($res<0){
	$closingd = abs($res);
	
	$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('C'.$i,number_format(abs($res),2));  
$objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setSize(12);
$objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));

}
else
{
	$closingd = 0;
	$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('C'.$i,"-");  
$objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setSize(12);
$objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));


}	
if($res>0){
	
	$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('D'.$i,number_format(abs($res),2));  
$objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setSize(12);
$objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));


	$closingc = abs($res);
}
else{
	
	$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('D'.$i,"-");  
$objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setSize(12);
$objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));

	$closingc = 0;
}

	$i=$i+1;

	$objPHPExcel->setActiveSheetIndex(0);
	$objPHPExcel->getActiveSheet()->setCellValue('A'.$i,'');  
	$objPHPExcel->getActiveSheet()->mergeCells('A'.$i.':'.'B'.$i);

	$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('C'.$i,number_format(abs(( array_sum($pdArr)) + $closingd),2));  
$objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setSize(12);
$objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));
	
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('D'.$i,number_format(abs((array_sum($pcArr)) + $closingc),2));  
$objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setSize(12);
$objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));


$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('E'.$i,"-");  
$objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getFont()->setSize(12);
$objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));
							
}
								

}

		 	
$objPHPExcel->getActiveSheet()->getStyle('A4'.':'.'J'.$i)->applyFromArray(
		array(
			
			'borders' => array(
				'allborders'     => array(
 					'style' => PHPExcel_Style_Border::BORDER_THIN
 				)
			)
	 		
		)
);
 

$objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);	// Needs to be set to true in order to enable any worksheet protection!
$objPHPExcel->getActiveSheet()->protectCells('A4:C4', 'PHPExcel');

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);

$subtitle = "General Ledger ";
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle($subtitle);


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Ledger.xls"');
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
