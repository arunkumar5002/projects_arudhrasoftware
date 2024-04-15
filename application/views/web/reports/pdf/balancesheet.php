
                    <div class="" style="width:100%;text-align:center;">
						<u>
							<h2 ><span style="color:green; font-size:15px;" ><?php echo get_defaultcompany()?></span></h2>						
							<h3 style="font-size:14px;" >Balance Sheet as at <span style="color:green"><?php echo date("d-M-Y",strtotime(get_defaultyear_end()));?></span></h3>						
						</u>
                    </div>
			<div class="" style="" >
						
						
						<?php
							$companyid = get_customercompanyid();
							$balancesheet = $this->sys_model->get_vouchers_balance_sheet_new($companyid);	
							
							$data = array();
							$datasum = array();
							foreach($balancesheet as $tmp){
								$data[$tmp->categoryid][$tmp->subcategoryid][$tmp->subsubcategoryid][$tmp->accountname] = $tmp->diff;	
								if(isset($datasum[$tmp->categoryid][$tmp->subcategoryid][$tmp->subsubcategoryid]))
									$datasum[$tmp->categoryid][$tmp->subcategoryid][$tmp->subsubcategoryid] += $tmp->diff;	
								else
									$datasum[$tmp->categoryid][$tmp->subcategoryid][$tmp->subsubcategoryid] = $tmp->diff;	
							}							
							$data[2][4][][] = 0.00;
							$datasum[2][4][] = 0.00;
							
							foreach($opening as $tmp){
								$tmp->subsubcategoryid = $tmp->subsubcategoryid ? $tmp->subsubcategoryid : 0;
								
								if($tmp->debit == '0.00' && isset($data[$tmp->categoryid][$tmp->subcategoryid][$tmp->subsubcategoryid][$tmp->accountid])){
									$data[$tmp->categoryid][$tmp->subcategoryid][$tmp->subsubcategoryid][$tmp->accountid] += $tmp->credit;	
									//$datasum[$tmp->categoryid][$tmp->subcategoryid][$tmp->subsubcategoryid] += round($tmp->credit);	
								}else if($tmp->debit == '0.00'){ 
									$data[$tmp->categoryid][$tmp->subcategoryid][$tmp->subsubcategoryid][$tmp->accountid] = $tmp->credit;	
									//$datasum[$tmp->categoryid][$tmp->subcategoryid][$tmp->subsubcategoryid] += round($tmp->credit);	
								}
								
								if($tmp->credit == '0.00' && isset($data[$tmp->categoryid][$tmp->subcategoryid][$tmp->subsubcategoryid][$tmp->accountid])){
									$data[$tmp->categoryid][$tmp->subcategoryid][$tmp->subsubcategoryid][$tmp->accountid] -= $tmp->debit;					
									//$datasum[$tmp->categoryid][$tmp->subcategoryid][$tmp->subsubcategoryid] -= round($tmp->debit);					
								}else if($tmp->credit == '0.00'){
									$data[$tmp->categoryid][$tmp->subcategoryid][$tmp->subsubcategoryid][$tmp->accountid] = -$tmp->debit;	
									//$datasum[$tmp->categoryid][$tmp->subcategoryid][$tmp->subsubcategoryid] -= round($tmp->debit);	
								}
								
								if(isset($datasum[$tmp->categoryid][$tmp->subcategoryid][$tmp->subsubcategoryid])){
									$datasum[$tmp->categoryid][$tmp->subcategoryid][$tmp->subsubcategoryid] += $tmp->credit;	
									$datasum[$tmp->categoryid][$tmp->subcategoryid][$tmp->subsubcategoryid] -= $tmp->debit;	
								}
								else{									
									$datasum[$tmp->categoryid][$tmp->subcategoryid][$tmp->subsubcategoryid] = $tmp->credit;		
									$datasum[$tmp->categoryid][$tmp->subcategoryid][$tmp->subsubcategoryid] = -$tmp->debit;		
								}			
							}
							
							foreach($data as $key=>$tmp){	
						?>	
					<?php if(!isset($fake)){ $fake = 1; ?>
					<table width="100%" align="center" >
						<tr>
							
							<th>								
								<h4 align="right" style="margin-right:50px;" ><span style="float:right; font-size:13px; margin-right:50px;"><?php echo get_currency(); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></h4>							
							</th>
							
						</tr>
						
					</table>	
						<?php } ?>
			
				<table width="100%"  align="center" border="1">						
						<tr>
							<th <?php if(isset($fake)){ ?> colspan ="2" <?php } ?> width='70%'  ><h4 align="left" 	style="margin-left:10px; font-size:13px; font-weight:bold; ">&nbsp;&nbsp;<?php echo get_categoryname($key)?></h4></th>
							
						</tr>	
				</table>
					<?php
						foreach($tmp as $skey=>$temp){ //Subcategory Start
					?>
					<table width="100%" align="center" border="1">
						
						<tr>
							<th align="left"  colspan="2" ><h5 align="left"  style="margin-left:10px; font-size:12px; " ><span  style="margin-left:10px; font-size:12px; ">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo get_subcategoryname($skey);?></span></h5></th>
						</tr>
						<?php
						/*if(isset($fromDate) && isset($toDate)){
							$records = get_voucherslist($tmp->categoryid,$temp->subcategoryid,$fromDate,$toDate);
						}else{						
							$records = get_voucherslist($tmp->categoryid,$temp->subcategoryid);
						}*/
						
						
						foreach($temp as $sskey=>$baa){
							if($sskey){
								echo "<tr>";
								?>								
								<td width="70%" style=""><span align="left" style="margin-left:40px; font-size:12px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo 
								get_subsubcategoryname($sskey);?></span></td>
								<td width="30%"style="margin-left:40px; font-size:12px;" align="right" >
								<?php
									//echo '<td width="30%" align="right"><b style="margin-right:5px">';
									
									if($key == 1 && $datasum[$key][$skey][$sskey] > 0)								
										echo "(".number_format(abs($datasum[$key][$skey][$sskey]),2).")";
									else if($key == 2 && $datasum[$key][$skey][$sskey] < 0)
										echo "(".number_format(abs($datasum[$key][$skey][$sskey]),2).")";
									else 
										echo number_format(abs($datasum[$key][$skey][$sskey]),2);
									
									echo "</td>";
								echo "</tr>";
							}
							foreach($baa as $akey=>$ba){							
							if($ba == '0.00')
								continue;
							
							$diff[$key][] = $ba;
						?>
						<tr height="20%" style="line-height: 150%;">
							<td width="70%" style="color:brown"><span align="left" style="margin-left:50px; font-size:11px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ucwords(get_accountname($akey));?></span></td>
							<td width="30%" style="color:brown" align="right"><span style="margin-right:5px; font-size:11px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<?php
							
								/*if(array_sum($ba['debit']) && array_sum($ba['credit']))
									$arr[$tmp->categoryid][] = $val = array_sum($ba['debit']) - array_sum($ba['credit']);
								else if(array_sum($ba['debit']))
									$arr[$tmp->categoryid][] = $val = array_sum($ba['debit']);
								else if(array_sum($ba['credit'])  && $tmp->categoryid == 1)
									$arr[$tmp->categoryid][] = $val = -array_sum($ba['credit']);
								else if(array_sum($ba['credit']))
									$arr[$tmp->categoryid][] = $val = -array_sum($ba['credit']);*/
								
								$arr[$key][] = $val = $ba;
								
								/*if($val<0 && $akey != '35')
									echo "".number_format(round(abs($val)),2)."";
								else
									echo number_format(round(abs($val)),2);*/
									
								if($key == 1 && $val > 0){
									echo "(".number_format(abs($val),2).")";
								}else if($key == 2 && $val < 0){
									echo "(".number_format(abs($val),2).")";
								}else{
									echo number_format(abs($val),2);
								}
							?>
							</span></td>
						</tr>
						<?php
						} 
					}
						unset($bArr);
						if($key == '2' && $skey == '4'){
							$pResult = get_profit_loss_result();
							$sfake = 1;
							
							$equity = $pResult->result;
							$arr[$key][] = $equity;
							echo '<tr  height="30px">';
							echo '<td width="70%" style="color:brown"><span align="left" style="margin-left:40px; font-size:11px;" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.get_accountname(profit_loss_account()).'</span></td>';
							echo '<td width="30%" align="right" style="color:brown"><span style="margin-right:5px; font-size:11px;" >'.number_format(abs($equity),2).'&nbsp;&nbsp;</span></td>';
							echo '</tr>';
							
							$datasum[2][4][] = $equity;
							$diff[2][] = $equity;
						}
						?>
						
					</table>
					<?php					
						}
					?>
						<table  width="100%" align="center" border="1">
						<tr>
							<th width="70%" align="left" style="color:green; margin-left:60px;"><h5  style="font-size:13px; margin-left:60px; font-weight:bold; padding-top:15; padding-bottom:0px;  margin: 0 5px 15px;"><span style="margin-left:30px;"  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Total <?php echo get_categoryname($key)?></span></h5></th>
							<th width="30%"  align="right" ><h5 style="color:green; font-size:13px; font-weight:bold; padding-top:15; padding-bottom:0px;  margin: 0 5px 15px; "><span style="margin-right:5px;" > <?php echo isset($arr[$key])?number_format(abs(array_sum($arr[$key])),2):"-";?>&nbsp;&nbsp;</span></h5></th>
						</tr>
						</table>
						
						<?php		
						} 
						?>
			
                    </div>
           
