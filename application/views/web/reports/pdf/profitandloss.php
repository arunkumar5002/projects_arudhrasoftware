
						<div class="title_left" style="width:100%;text-align:center;">
						<u>
							<h2 style="font-size:16px; !important"><span style="color:green; font-size:15px; !important"><?php echo get_defaultcompany()?></span></h2>
						
							<h3 style="font-size:14px; !important" >Profit & Loss for the financial year ended <span style="color:green"><?php echo date("d-M-Y",strtotime(get_defaultyear_end()));?></span></h3>
						
						</u>
                        </div>
						
			<div style="width:100%; margin-left:15%;">
						<table width="70%" style="width:70%;text-align:center;" align="center">
						<tr height="50px">
							<td width="90%"></td>
							<td align="left" width="10%"> 
							<span style="float:right; font-size: 10px !important; align:left "><?php echo get_currency(); ?></span>
							</td>
						</tr>
						</table>
			
						
		
						<?php
							
							$category = get_categorylist(2);
							foreach($category as $tmp){	//Main Category Start
								if($tmp->categoryid != 3 && $tmp->categoryid != 5)
									continue;
						?>	
						<h4><?php echo $tmp->categoryname; ?></h4>
					
						<?php
						if(isset($fromDate) && isset($toDate)){
							$records = get_voucherslist_profit_loss($tmp->categoryid,$fromDate,$toDate);
						}else{
							$records = get_voucherslist_profit_loss($tmp->categoryid);
						}
						echo '<table style="border-collapse: collapse; border:2px solid #ccc !important; "   width="70%" border="1" >';		
						
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
							if(inventory_profit_loss() == $key){
								$costofsales = $ba['credit'];
								continue;
							}else{
								$costofsales = array();
							}
							
							if(purchases_account() == $key){
							?>
							<tr height="30px">
								<td width="100%" colspan=3 style='font-size:15px'>&nbsp;Cost Of Sales</td>								
							</tr>
							<tr>
								
								<td width="65%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Opening Stock</td>
								<td width="15%" align='right'>&nbsp;-&nbsp;&nbsp;</td>
								<td width="20%"></td>
							</tr>
							<tr>
								
								<td width="21%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Add:<?php echo get_accountname($key)?></td>
								<td width="5%" align='right'>&nbsp;<?php echo number_format(abs(array_sum($ba['debit'])),2);?>&nbsp;&nbsp;</td>
								<td width="14%"></td>
							</tr>
							<tr>
								
								<td width="21%"></td>
								<td width="5%" align='right'>&nbsp;--------------------&nbsp;&nbsp;</td>
								<td width="14%"></td>
							</tr>
							<tr>
								
								<td width="21%"></td>
								<td width="5%" align='right'>&nbsp;<?php echo number_format(abs(array_sum($ba['debit'])),2);?>&nbsp;&nbsp;</td>
								<td width="14%"></td>
							</tr>
							<tr>
								
								<td width="21%"></td>
								<td width="5%" align='right'>&nbsp;--------------------&nbsp;&nbsp;</td>
								<td width="14%"></td>
							</tr>
							<tr>
								
								<td width="21%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Less:<?php echo get_accountname(inventory_profit_loss())?></td>
								<td width="5%" align='right'>&nbsp;<?php echo number_format(abs(array_sum($costofsales)),2);?>&nbsp;&nbsp;</td>
								<td width="14%"></td>
							</tr>
							<tr>
							
								<td width="21%"></td>
								<td width="5%" align='right'>&nbsp;--------------------&nbsp;&nbsp;</td>
								<td width="14%"></td>
							</tr>
							
							<tr>
								<td width="21%"></td>
								<td width="5%" align='right'></td>
								<td width="14%" align='right'>&nbsp;
								 <?php
								 $cost_sales = array_sum($ba['debit']) - array_sum($costofsales);
								 echo (array_sum($ba['debit']) - array_sum($costofsales))?number_format(abs((array_sum($ba['debit']) - array_sum($costofsales))),2):"-";
								 ?>&nbsp;&nbsp;&nbsp;</td>
							</tr>
							
							
							
							<?php
							}else{
							
						?>
						<tr height="30px">
							<td width="70%" ><label style="color:brown;" >&nbsp;<?php echo get_accountname($key)?></label></td>
							<td align="right" colspan="2"><label style="color:brown;" >&nbsp;
							<?php
								$arr[$tmp->categoryid][] = $val = array_sum($ba['credit']) - array_sum($ba['debit']);								
								
									echo number_format(abs($val),2);
									
							?>&nbsp;&nbsp;
							</label></td>
						</tr>
						<?php
							}
						} //account names end
						}
						echo "</table>";
						?>
					
						
						
						<table style=" border-collapse: collapse;border:2px solid #ccc !important "  border="1" width="98%" >
						<tr>
							<td width="50%" ><label style="color:#000">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Total <?php echo $tmp->categoryname?></label></td>
							<td width="47.7%" align="right" ><label style="color:#000" >&nbsp;&nbsp;
							<?php
							 
							 echo isset($arr[$tmp->categoryid])?number_format(abs(array_sum($arr[$tmp->categoryid])+$cost_sales),2):" -";
							 
							?>
							&nbsp;&nbsp;&nbsp;</label></td>
						</tr>
						</table>
						<?php		
							} //Main category end
						?>
						
						<?php
								$grossprofit = 0;
								if(isset($arr[3]) && isset($arr[5]))
									 $grossprofit = array_sum($arr[3]) + (array_sum($arr[5]) + $cost_sales);
								else if(isset($arr[3]))
									 $grossprofit = array_sum($arr[3]) - $cost_sales;
								else if(isset($arr[5]))
									 $grossprofit = - (array_sum($arr[5]) + $cost_sales);
								
						?>
						
						<table style="border-collapse: collapse;border:2px solid #ccc !important "  border="1" width="98%" >
						<tr height="50px">
							<td width="50%" ><label style="<?php if($grossprofit > 0) { ?>color:green; <?php }else { ?> color:red; <?php } ?> font-weight:bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Gross <?php if($grossprofit > 0) { ?>Profit <?php }else { ?> Loss <?php } ?> </label> </td>
							<td width="47.7%" style="<?php if($grossprofit > 0) { ?>color:green; <?php }else { ?> color:red; <?php } ?>  font-weight:bold" align="right">&nbsp;
									<?php echo number_format(abs($grossprofit),2);?>&nbsp;&nbsp;&nbsp;&nbsp;
							</td>
						</tr>
						</table>
						
						
						
						
						<?php
						
							unset($arr);
							$category = get_categorylist(2);
							foreach($category as $tmp){	//Main Category Start
								if($tmp->categoryid != 4 && $tmp->categoryid != 6)
									continue;
						?>	
						<h4><?php echo $tmp->categoryname?></h4>
					
						<?php
						if(isset($fromDate) && isset($toDate)){
							$records = get_voucherslist_profit_loss($tmp->categoryid,$fromDate,$toDate);
						}else{
							$records = get_voucherslist_profit_loss($tmp->categoryid);
						}
						echo '<table style="border-collapse: collapse; border:2px solid #ccc !important; "   width="98%" border="1" >';	
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
						?>
						<tr height="30px">
							<td width="50%" ><label style="color:brown;" >&nbsp;<?php echo get_accountname($key)?> </label></td>
							<td  width="47.7%" align="right"  ><label style="color:brown;" >&nbsp;
							<?php
								//$arr[$tmp->categoryid]['debit'][] = $record->debit;
								//$arr[$tmp->categoryid]['credit'][] = $record->credit;
								$arr[$tmp->categoryid][] = $val = array_sum($ba['credit']) - array_sum($ba['debit']);
							
									echo number_format(abs($val),2);
									?>&nbsp;&nbsp;
							</label></td>
						</tr>
						<?php
						} //account names end
						}
						echo "</table>";
						?>
					
						
						
						<table style="border-collapse: collapse;border:2px solid #ccc !important "  border="1" width="98%" >
						<tr>
							<td width="50%" ><label style="color:#000">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Total <?php echo $tmp->categoryname?> </label></td>
							<td width="47.7%" align="right"  ><label style="color:#000" >&nbsp;
							<?php 
							
								if(isset($arr[$tmp->categoryid])){
									$expenses = number_format(array_sum($arr[$tmp->categoryid]), 2, '.', '');
									echo number_format(abs($expenses),2);
								}
								else{
									echo $expenses = "-";
								}
								
							?>&nbsp;&nbsp;&nbsp; </label></td>
						</tr>
						<?php if($tmp->categoryid != 6){ ?>
						<tr height="40px">
							<td width="50%" ><label style='color:#000'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Total </label></td>
							<td width="47.7%" align="right" ><label style="color:#000">&nbsp;
							<?php 
							
								if(isset($arr[$tmp->categoryid])){
									$expenses = number_format(($grossprofit+array_sum($arr[$tmp->categoryid])), 2, '.', '');
									echo number_format(abs($expenses),2);
									if(!isset($indirect))
										$indirect = $expenses;
								}
								else{
									$expenses = number_format(($grossprofit), 2, '.', '');
									echo number_format(abs($expenses),2);
									if(!isset($indirect))
										$indirect = $expenses;
								}
								$grossprofit = 0;
							?>&nbsp;&nbsp;&nbsp;&nbsp;</label> </td>
						</tr>
						<?php } ?>
						</table>
						<?php		
							} //Main category end
						?>
						<?php
						
								if(isset($arr[4]) && isset($arr[6]))
									$net = array_sum($arr[6]);
								else if(isset($arr[4]))
									$net = array_sum($arr[4]);
								else if(isset($arr[6]))
									$net = array_sum($arr[6]);
								else
									$net = "0.00";
								
						?>
						<table style="border-collapse: collapse; border:2px solid #ccc !important; "   width="98%" border="1" >
						<tr height="50px">
							<td width="50%" ><label style="<?php if($indirect > abs($net)) { ?>color:green; <?php }else { ?> color:red; <?php } ?>  font-weight:bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Net <?php if(($indirect > abs($net))) { ?>Profit <?php  } else { ?> Loss <?php } ?> </label> </td>
							<td width="47.7%" style="<?php if($indirect > abs($net)) { ?>color:green; <?php }else { ?> color:red; <?php } ?> font-weight:bold" align="right">&nbsp;
							<?php
								
								echo number_format(abs($indirect + $net),2);
							?>&nbsp;&nbsp;&nbsp;&nbsp;
							</td>
						</tr>
						</table>
						
					</div>	

