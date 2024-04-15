
						<u>
							<h2><span  align="center" style=" font-size:15px;"><?php echo get_defaultcompany()?></span></h2>						
							<h3 align="center" style="font-size:14px;" >General Ledger
							<?php if(isset($start)){ ?>
							 for the period from <?php echo isset($start)?date("d.m.Y",strtotime($start)):"";?> to <?php echo isset($end)?date("d.m.Y",strtotime($end)):"";?></h3>
							<?php } ?>						
						</u>
                       <?php  $vouchertypelist = array('1'=>"SP",'2'=>"CR",'3'=>"JV",'4'=>"CV",'5'=>"PV",'6'=>"SV","7"=>"DN","8"=>"CN");					
						?>

						<?php
						if(isset($accountname) && isset($start) && isset($end)){
							
						foreach($ledger as $tmp){
							/*$creditArr = $debitArr = array();
							$res = 0;*/
							
							$comp_opening = get_company_opening_balance($tmp->accountname);
							if($tmp->accountname != $accountname && $accountname != 'A')
								continue;
							$particulars = get_ledger_particulars($tmp->accountname,$accountname,$start,$end);							
							if(!$comp_opening && empty($particulars))
								continue;
						?>
							<h3 align="center" id="<?php echo $tmp->accountname ?>"><?php echo get_accountname($tmp->accountname); ?></h3>
							<table style="page-break-after:always" width="100%" border="1" >
								<tr>
									<th align="center" width="6%">S.No</th>
									<th align="center" width="12%">Date</th>
									<th align="center" width="4%">VType</th>
									<th align="center" width="8%">Trans ID</th>
									<th align="center" width="25%">Particulars</th>
									<th align="center" width="14%">Ref</th>
									<th align="center" width="10%">Debit (<?php echo get_currency() ?>)</th>
									<th align="center"width="10%">Credit (<?php echo get_currency() ?>)</th>
									<th align="center" width="12%">Balance (<?php echo get_currency() ?>)</th>
									<th align="center" width="5%"></th>
								</tr>
								
								<!---------Opening Balance--------->
								<?php
									
									
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
								?>
								
								
								
								<?php 
								$startdate = date("Y-m-d",strtotime(get_defaultyear_start()));
								$Tmpstart = date("Y-m-d",strtotime($start));
								
								if(get_defaultyear() != '-' && $startdate != $Tmpstart){
									
									
									if($startdate != $Tmpstart){										
										$Tmpstart = date("Y-m-d",strtotime("-1 day".$Tmpstart));
										$openBal = get_ledger_opening_balance($startdate,$Tmpstart,$tmp->accountname);
									
									
								?>
								<tr height='30px'>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;&nbsp;Opening Balance</td>
									<td>&nbsp;</td>
									<td align="right">
									<?php 
										if($openBal->debit){
											$openBal->debit = $openBal->debit + abs($debit_open);
											echo number_format(abs($openBal->debit),2)."&nbsp;";
										}else{
											echo "0.00"."&nbsp;";
										}									
										$debitArr[] = $openBal->debit;
										
									?>
									</td>
									<td align="right">
									<?php 
										if($openBal->credit){
											$openBal->credit = $openBal->credit + abs($credit_open);
											echo number_format(abs($openBal->credit),2)."&nbsp;";
										}else{
											echo "0.00"."&nbsp;";
										}
										$creditArr[] = $openBal->credit;
									?>
									</td>
									<td align="right">
										<?php 
											$res = array_sum($creditArr) - array_sum($debitArr);
											if($res >= 0)
												$str = ' (Dr)'."&nbsp;";
											else
												$str = ' (Cr)'."&nbsp;";
											//echo abs($res).$str;
																						
											echo number_format(abs(abs($res)),2)." ";
										?>
									</td>
									<td><?php echo $str;?></td>
								</tr>
								<?php 
									} 
								}else if(!empty($comp_opening)){
									//Previous year opening balance entry display
								?>
									<tr height='30px'>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;&nbsp;Opening Balance</td>
										<td>&nbsp;</td>
										<td align="right">
										<?php 
											
											echo $debit_open."&nbsp;";
																			
											$debitArr[] = $debit_open;
											
										?>
										</td>
										<td align="right">
										<?php 
											
											echo $credit_open."&nbsp;";
											
											$creditArr[] = $credit_open;
										?>
										</td>
										<td align="right">
											<?php 
												$res = array_sum($creditArr) - array_sum($debitArr);
												if($credit_open > 0)
													$str = ' (Cr)'."&nbsp;";
												else
													$str = ' (Dr)'."&nbsp;";
												//echo abs($res).$str;
																							
												echo number_format(abs(abs($res)),2)." ";
											?>
										</td>
										<td><?php echo $str;?></td>
									</tr>
								
								
								<?php
								}	
								?>
								<!---------Opening Balance--------->
								
								
								<?php
								$sno = 1;
								
									foreach($particulars as $temp){
										//if($sno < 5){
								?>
									<tr >
										<td width="6%"><span style='font-size:8px' >&nbsp;<?php echo $sno++; ?></span></td>
										<td width="12%"><span style='font-size:8px' >&nbsp;<?php echo date("d-m-Y",strtotime($temp->voucherdate));?></span></td>
										<td width='4%'><span style='font-size:8px' >&nbsp;<?php if(isset($temp->vouchertype) && !empty($temp->vouchertype)) { echo $vouchertypelist[$temp->vouchertype]; }  ?></span></td>
										<td width="8%"><span style='font-size:8px' >&nbsp;<?php echo $temp->voucherno;?></span></td>
										<td width="25%"><span style='font-size:8px' >&nbsp;
										<?php 
											if($temp->debit != '0.00')
												$s = 'By';
											else if($temp->credit != '0.00')
												$s = 'To';
											
											echo $s.' '.get_accountname($temp->accountname)
										?></span></td>
										<td width="14%" ><span style='font-size:8px' >&nbsp;<?php echo $temp->reference?$temp->reference:"-";?></span></td>
										<td width="10%" align="right"><span style='font-size:8px' >&nbsp;
										<?php 
											$debitArr[] = $credit = $temp->credit;
											echo number_format(abs($credit),2);
										?></span></td>
										<td  width="10%" align="right"><span style='font-size:8px' >&nbsp;
										<?php 
											$creditArr[] = $debit = $temp->debit;
											echo number_format(abs($debit),2);
										?></span></td>
										<td width="12%" align="right"><span style='font-size:8px' >&nbsp;
										<?php 
											$res = array_sum($creditArr) - array_sum($debitArr);
											if($res <= 0)
												$str = ' (Dr)';
											else
												$str = ' (Cr)';
											//echo abs($res).$str;
																						
											echo number_format(abs($res),2);
										?>
										</span></td>
										<td width="5%" >
										<?php 
																				
											echo $str;
										?>
										</td>
									</tr>
								<?php	
									//}
									
								}
									echo '<tr>';
										
										echo '<td colspan="3"></td>';
										echo '<td colspan="3" align=center>Closing Balance (c/f)</td>';
										if(isset($res) && $res<0){
											echo '<td  align="right">-</td>';
											$closed = abs($res);
										}
										else if(isset($res)){
											echo '<td align="right">'.number_format(abs($res),2).'</td>';									
											$closed = 0;
										}
										
										if(isset($res) && $res>0){
											echo '<td  align="right">-</td>';
											$closec = abs($res);
										}
										else if(isset($res)){
											echo '<td  align="right">'.number_format(abs($res),2).'</td>';
												
											$closec = 0;
										}
										
										echo '<td  align="right">-</td>';
									echo '</tr>';
									
									echo '<tr>';
										echo '<td colspan="5">  </td>';
										echo '<td align=center> Total </td>';
										if(array_sum($debitArr)>0)
											echo '<td  align="right">'.number_format(abs((array_sum($debitArr) + $closec)),2).'</td>';
										else
											echo '<td align="right">'.number_format(abs((array_sum($creditArr) + $closed)),2).'</td>';
										
										if(array_sum($creditArr)>0)
											echo '<td align="right">'.number_format(abs((array_sum($creditArr) + $closed)),2).'</td>';
										else
											echo '<td align="right">'.number_format(abs((array_sum($debitArr) + $closec)),2).'</td>';
										echo '<td align="right">-</td>';
									echo '</tr>';
									
									
									echo '<tr>';
									
										echo '<td colspan="3"></td>';
										echo '<td colspan="3" align=center>Opening Balance (b/f)</td>';
										if($res>0)
											echo '<td align="right">-</td>';
										else
											echo '<td align="right">'.number_format(abs((array_sum($creditArr)-array_sum($debitArr))),2).'</td>';
									
										if($res<0)
											echo '<td align="right">-</td>';	
										else
											echo '<td align="right">'.number_format(abs((array_sum($debitArr)-array_sum($creditArr))),2).'</td>';
									
											
										echo '<td align="right">-</td>';
									echo '</tr>';
									
									unset($creditArr);
									unset($debitArr);
								
								?>
								
							</table>
						<?php
						}
						?>
						
						
						<?php
						}
						?>
                  
                
