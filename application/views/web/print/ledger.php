
<body onLoad="myFunction()">
<div class="title_left" style='width:100%;text-align:center;'>
						<u><p>
							<h4><span style='color:green'><?php echo get_defaultcompany()?></span></h4>
						</p>
                        <p>
							<h4>General Ledger
							<?php if(isset($start)){ ?>
							 for the period from <?php echo isset($start)?date("d.m.Y",strtotime($start)):"";?> to <?php echo isset($end)?date("d.m.Y",strtotime($end)):"";?></h4>
							<?php } ?>
						</p>
						</u>
                        </div>
<div class="row">
<?php  $vouchertypelist = array('1'=>"SP",'2'=>"CR",'3'=>"JV",'4'=>"CV",'5'=>"PV",'6'=>"SV","7"=>"DN","8"=>"CN");		
						?>
						<?php
						if(isset($accountname) && isset($start) && isset($end)){
						foreach($ledger as $tmp){
							$comp_opening = get_company_opening_balance($tmp->accountname);
							
							if($tmp->accountname != $accountname && $accountname != 'A')
								continue;
							$particulars = get_ledger_particulars($tmp->accountname,$accountname,$start,$end);							
							if(!$comp_opening && empty($particulars))
								continue;
						?>
							<center><h3 id='<?php echo $tmp->accountname ?>'><?php echo get_accountname($tmp->accountname); ?></h3></center>
							<table width='100%' border=1  align=center style="border-collapse: collapse;border:2px solid #000 !important; "  cellpadding=5>
								<tr>
									<th>S.No</th>
									<th>Date</th>
									<th>V Type</th>
									<th>Trans ID</th>
									<th>Particulars</th>
									<th>Ref</th>
									<th>Debit (<?php echo get_currency() ?>)</th>
									<th>Credit (<?php echo get_currency() ?>)</th>
									<th>Balance (<?php echo get_currency() ?>)</th>
								</tr>
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
								<tr>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td>Opening Balance</td>
									<td></td>
									<td align=right>
									<?php 
										if($openBal->debit){
											$openBal->debit = $openBal->debit + abs($debit_open);
											echo number_format(round(abs($openBal->debit)),2)."";
										}else{
											echo "0.00"."";
										}									
										$debitArr[] = $openBal->debit;
										
									?>
									</td>
									<td align=right>
									<?php 
										if($openBal->credit){
											$openBal->credit = $openBal->credit + abs($credit_open);
											echo number_format(round(abs($openBal->credit)),2)."";
										}else{
											echo "0.00"."";
										}
										$creditArr[] = $openBal->credit;
									?>
									</td>
									<td align=right>
										<?php 
											$res = array_sum($creditArr) - array_sum($debitArr);
											if($res >= 0)
												$str = ' (Dr)'."";
											else
												$str = ' (Cr)'."";
											//echo abs($res).$str;
																						
											echo number_format(round(abs(abs($res))),2).$str." ";
										?>
									</td>
								</tr>
								<?php 
									} 
								}else if(!empty($comp_opening)){
									//Previous year opening balance entry display
								?>
									<tr>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td>Opening Balance</td>
										<td></td>
										<td align=right>
										<?php 
											
											echo number_format($debit_open,2)."";
																			
											$debitArr[] = $debit_open;
											
										?>
										</td>
										<td align=right>
										<?php 
											
											echo number_format($credit_open,2)."";
											
											$creditArr[] = $credit_open;
										?>
										</td>
										<td align=right>
											<?php 
												$res = array_sum($creditArr) - array_sum($debitArr);
												if($credit_open > 0)
													$str = ' (Cr)'."";
												else
													$str = ' (Dr)'."";
												//echo abs($res).$str;
																							
												echo number_format(round(abs(abs($res))),2).$str." ";
											?>
										</td>
									</tr>
								
								
								<?php
								}	
								?>
								<?php
								$sno = 1;
								foreach($particulars as $temp){
								?>
									<tr>
										<td width="1%" align="right"><?php echo $sno++; ?></td>
										<td width="2%" align="right"><?php echo date("d-m-y",strtotime($temp->voucherdate));?></td>
										<td width='2%' align="right"><?php if(isset($temp->vouchertype) && !empty($temp->vouchertype)) { echo $vouchertypelist[$temp->vouchertype]; }  ?></td>
										<td width='2%' align="right"><?php echo $temp->voucherno;?></td>
										<td width='5%'>
										<?php 
											if($temp->debit != '0.00')
												$s = 'By';
											else if($temp->credit != '0.00')
												$s = 'To';
											
											echo $s.' '.get_accountname($temp->accountname)
										?></td>
										<td width='3%'><?php echo $temp->reference?$temp->reference:"-";?></td>
										<td width='3%' align=right>
										<?php 
											$debitArr[] = $credit = $temp->credit;
											echo number_format(round(abs($credit),2),2);
										?></td>
										<td width='3%'  align=right>
										<?php 
											$creditArr[] = $debit = $temp->debit;
											echo number_format(round(abs($debit),2),2);
										?></td>
										<td width='3%' align=right>
										<?php 
											$res = array_sum($creditArr) - array_sum($debitArr);
											if($res <= 0)
												$str = ' (Dr)';
											else
												$str = ' (Cr)';
											//echo abs($res).$str;
																						
											echo number_format(round(abs($res),2),2).$str;
										?>
										</td>
									</tr>
								<?php
									if($tmp->groupid == 2){
										if(array_sum($debitArr)>0){
											$tmpArr[$tmp->accountname]['debit'][] = $debit;
										}
										if(array_sum($creditArr)>0){
											$tmpArr[$tmp->accountname]['credit'][] = $credit;
										}	
									}
								}
								echo "<tr>";
									echo "<td colspan='3'></td>";
									echo "<td colspan='3' align=center>Closing Balance (c/f)</td>";
									if($res<0){
										echo "<td  align=right>-</td>";
										$closed = abs($res);
									}
									else{
										echo "<td align=right>".number_format(round(abs($res),2),2)."</td>";								
										$closed = 0;
									}
									
									if($res>0){
										echo "<td  align=right>-</td>";										
											$closec = abs($res);
									}
									else{
										echo "<td  align=right>".number_format(round(abs($res),2),2)."</td>";								
										$closec = 0;
									}
									
									echo "<td  align=right>-</td>";
								echo "</tr>";
								
								echo "<tr>";
									echo "<td colspan='5'>  </td>";
									echo "<td align=center> Total </td>";
									if(array_sum($debitArr)>0)
										echo "<td  align=right>".number_format(round(abs((array_sum($debitArr) + $closec)),2),2)."</td>";
									else
										echo "<td align=right>".number_format(round(abs((array_sum($creditArr) + $closed)),2),2)."</td>";
									
									if(array_sum($creditArr)>0)
										echo "<td align=right>".number_format(round(abs((array_sum($creditArr) + $closed)),2),2)."</td>";
									else
										echo "<td align=right>".number_format(round(abs((array_sum($debitArr) + $closec)),2),2)."</td>";
									echo "<td align=right>-</td>";
								echo "</tr>";
								
								
								echo "<tr>";
									echo "<td colspan='3'></td>";
									echo "<td colspan='3' align=center>Opening Balance (b/f)</td>";
									if($res>0)
										echo "<td align=right>-</td>";
									else
										echo "<td align=right>".number_format(round(abs((array_sum($creditArr)-array_sum($debitArr))),2),2)."</td>";
									
									if($res<0)
										echo "<td align=right>-</td>";
									else
										echo "<td align=right>".number_format(round(abs((array_sum($debitArr)-array_sum($creditArr))),2),2)."</td>";
								
									echo "<td align=right>-</td>";
								echo "</tr>";
								
								unset($creditArr);
								unset($debitArr);
								?>
								
							</table>
						<?php
						}
						?>
						
						
						<?php
						if(false && isset($tmpArr)){
						?>
						<center><h3><?php echo get_accountname(profit_loss_account()); ?></h3></center>
							<table width='100%' align=center style="border-collapse: collapse;border:2px solid #000 !important; "  border=1>
								<tr>
									<th>S.No</th>
									<!-- <th>Date</th> -->
									<th>Particulars</th>
									<th>Debit</th>
									<th>Credit</th>
									<th>Balance</th>
								</tr>
						<?php
							$sno = 1;
							foreach($tmpArr as $key=>$tmp){
								//print_r(array_sum($tmp['debit']));
						?>
							<tr>
								<td><?php echo $sno++;?></td>
								<!-- <td></td> -->
								<td><?php echo get_accountname($key); ?></td>
								<td  align=right>
								<?php
								if(isset($tmp['credit'])){
									$pdArr[] = $debit = array_sum($tmp['credit']);
									echo number_format(round(abs($debit)),2);								
								}
								else{
									echo "-";
									$pdArr[] = $debit = 0;
								}
								?>
								</td>
								<td  align=right>
								<?php
								if(isset($tmp['debit'])){
									$pcArr[] = $credit = array_sum($tmp['debit']);
									echo number_format(round(abs($credit)),2);
								}
								else{
									echo "-";
									$pcArr[] = $credit = 0;
								}
								?>
								</td>
								<td align=right>
								<?php 
									$res = array_sum($pdArr)-array_sum($pcArr);
									if($res >= 0)
										$str = ' (Dr)';
									else
										$str = ' (Cr)';
									echo number_format(round(abs($res)),2).$str;
								?></td>
							</tr>
						<?php
							}
							
							echo "<tr>";
								echo "<td></td>";
								echo "<td align=center>".get_accountname(profit_loss_account())."</td>";
								if($res<0){
									$closingd = abs($res);
									echo "<td align=right>".number_format(round(abs($res)),2)."</td>";
								}
								else{
									$closingd = 0;
									echo "<td align=right>- </td>";
								}
								
								if($res>0){
									echo "<td align=right>".number_format(round(abs($res)),2)."</td>";
									$closingc = abs($res);
								}
								else{
									echo "<td align=right>- </td>";
									$closingc = 0;
								}
								
								echo "<td align=right>- </td>";
							echo "</tr>";
							
							echo "<tr>";
								echo "<td colspan='2'></td>";
								echo "<td align=right>".number_format(round(abs(array_sum($pdArr)) + $closingd),2)."</td>";
								echo "<td align=right>".number_format(round(abs(array_sum($pcArr)) + $closingc),2)."</td>";
								echo "<td align=right>- </td>";
							echo "</tr>";
							
							echo "</table>";
						}
						}
						?>
                    </div>
                </div>
</body>
<script>
function myFunction() {
    window.print();
}
</script>
<style>
	table tr td{
		font-size:10px;
		padding:4px;
	}
	
	table tr th{
		border-collapse: collapse;border:2px solid #000 !important; 
		font-size:13px;
	}
</style>
