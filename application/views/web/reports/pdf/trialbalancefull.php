      
                       <div class="" style="width:100%;text-align:center;">
							<u>
								<h2><span style="color:green; font-size:14px;"><?php echo get_defaultcompany()?></span></h2>
							
								<h3 style="font-size:13px;">Trial Balance as on <span style="color:green"><?php echo get_defaultyear_end()?></span></h3>												
							</u>
                        </div>
					<?php
						
						
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
						
                    ?>
                    
						<?php
						if(!empty($balance)){
						?>
						<table width="100%"  border="1" >
							<tr  style="margin-bottom:0px">
								<th  width="40%"><h4 align="center" style=" font-size:11px;"  >Particulars</h4></th>
								<th  width='14%'><h4 align="center" style=" font-size:11px;" >Opening Balance</h4></th>
								<th  width="15%"><h4 align="center" style=" font-size:11px;" >Debit (<?php echo get_currency() ?>)</h4></th>
								<th  width="15%"><h4 align="center" style=" font-size:11px;"  >Credit (<?php echo get_currency() ?>)</h4></th>
								<th  width='14%'><h4 align="center" style=" font-size:11px;" >Closing Balance</h4></th>
							</tr>
						<?php
								
						foreach($balance as $l1=>$tmp1){
																									
								foreach($tmp1 as $l2=>$tmp2){		
									if($l1 == 1){
										echo "<tr><td colspan='4'><h4 style='font-size: 14px; font-weight: bold;'> ".get_subcategoryname($l2)."</h4></td></tr>";
									}else if($l1 == 2){
										echo "<tr><td colspan='4' ><h4 style='font-size: 14px; font-weight: bold;' > ".get_categoryname($l2)."</h4></td></tr>";
									}
									
								foreach($tmp2 as $l3=>$tmp3){		
									$find = array_sum($tmp3['debit']) - array_sum($tmp3['credit']);
										   
						?>
						
								
							
								
								<tr height='40px'>
									<td><h4 style=' padding-top:15; padding-bottom:0px; font-size:10px; margin: 0 20px 15px;' ><?php echo "    ".get_accountname($l3)?></h4></td>
									
									<td style="text-align:right;" >
									<h5 align='right' style='margin-right:5px;' >
										<?php 
											$openb = json_decode(get_company_opening_balance($l3));
											if(isset($openb->debit)){
												echo number_format(round(abs($openb->debit)),2)." Dr  ";
											}else if(isset($openb->credit)){
												echo number_format(round(abs($openb->credit)),2)." Cr  ";
											}else{
												echo "0.00  ";
											}
										?>
									</h5>
									</td>
									<td style="text-align:right;" ><h4  style='margin-right:5px; padding-top:15;padding-bottom:0px; font-size:10px; margin: 0 5px 15px;' >
									<?php
										$debit = $totaldebit[] = array_sum($tmp3['debit']);
										echo number_format(round(abs($debit)),2)."  ";
									?></h4>
									</td>
									<td style="text-align:right;" ><h4  style='margin-right:5px; padding-top:15;padding-bottom:0px;font-size:10px; margin: 0 5px 15px;' >
									<?php
										$credit = $totalcredit[] = array_sum($tmp3['credit']);
										echo number_format(round(abs($credit)),2)."  ";
									?></h4>
									</td>
									<td style="text-align:right;" >
									<h5 align='right' style='margin-right:5px;' >
									<?php		
											if(isset($openb->debit)){
												echo number_format(round(abs(($openb->debit + $debit) - $credit)),2)." Dr  ";
											}else if(isset($openb->credit)){
												echo number_format(round(abs(($openb->credit + $credit) - $debit)),2)." Cr  ";
											}else{
												$ftot = $debit - $credit;
												if($ftot < 0){
													echo number_format(round(abs($ftot)),2)." Cr  " ;
												}else{
													echo number_format(round(abs($ftot)),2)." Dr  ";
												}
											}
									?>
									</h5>
									</td>
									
								</tr>
								
						<?php
							}
						}									
									
					}
								
							echo '<tr>';
								echo '<td align="left"><h4 style="margin-left:5px; font-size:11px;" >&nbsp; Total</h4></td>';								
								echo "<td align=right><h4 style='margin-right:5px;' ></h4></td>";								
							
								echo '<td align="right"><h4 style="margin-right:5px; font-size:11px; " >'.number_format(round(abs(array_sum($totaldebit))),2).' &nbsp;&nbsp;</h4></td>';								
								echo '<td align="right"><h4 style="margin-right:5px; font-size:11px; " >'.number_format(round(abs(array_sum($totalcredit))),2).' &nbsp;&nbsp;</h4></td>';								
									echo "<td align=right><h4 style='margin-right:5px;' ></h4></td>";
							
							echo '</tr>';
							
							echo '</table>';
						}
						
						?>
				
              
				

	
	
	
