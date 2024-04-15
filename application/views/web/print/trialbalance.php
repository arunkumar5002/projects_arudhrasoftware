 <!-- page content -->
 <body onLoad="myFunction()">
            <div  class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        
                       <div class="title_left" style='width:100%;text-align:center;'>
						<u><p>
							<h2><span style='color:green'><?php echo get_defaultcompany()?></span></h2>
						</p>

                        <p style='margin-bottom:5px;'>
							<h3 style='font-size:21px !important'>Trial Balance as on <span style='color:green'><?php echo get_defaultyear_end()?></span></h3>
						</p>

						<p>
							<h2></h2>
						</p></u>
						
						
						
                        </div>
						 
                    </div>
                    <div class="clearfix"></div>
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
                    <div class="row">
						<?php
						if(!empty($balance)){
						?>
						<table  border="1" style="border-collapse: collapse;border:2px solid #ccc !important; width:700px"  width='72%' align=center >
							<tr  style="margin-bottom:0px">
								<th  width='60%' style='padding-top:15;padding-bottom:0px;font-size:15px; margin: 0 0 15px; font-weight:bold;' ><h3 align=center >Particulars</h3></th>
								<th  width='20%' style='padding-top:15;padding-bottom:0px;font-size:15px; margin: 0 0 15px; font-weight:bold;'><h3 align=center >Debit (<?php echo get_currency() ?>)</h3></th>
								<th  style='padding-top:15;padding-bottom:0px;font-size:15px; margin: 0 0 15px; font-weight:bold;' ><h3 align=center >Credit (<?php echo get_currency() ?>)</h3></th>
							</tr>
						<?php
							foreach($balance as $l1=>$tmp1){
																									
								foreach($tmp1 as $l2=>$tmp2){		
									if($l1 == 1){
										echo "<tr><td colspan='3' style='font-size: 20px;font-weight: bold;'>".get_subcategoryname($l2)."</td></tr>";
									}else if($l1 == 2){
										echo "<tr><td colspan='3' style='font-size: 20px;font-weight: bold;' >".get_categoryname($l2)."</td></tr>";
									}
									
									foreach($tmp2 as $l3=>$tmp3){		
										   $debit = $credit = '0.00';
								
										   $find = array_sum($tmp3['debit']) - array_sum($tmp3['credit']);
										   if($find > 0){
											   $debit = $totaldebit[] = $find;
										   }
										   else{
												$credit = $totalcredit[] = $find;
										   }
										   
										   if(number_format(abs($debit),2) == '0.00' && number_format(abs($credit),2) == '0.00')
											continue;
						?>
								<tr height='40px'>
									<td><h5 style=' padding-top:15; padding-bottom:0px; font-size:15px; margin: 0 20px 15px;' ><?php echo get_accountname($l3)?></h5></td>
									<td><h5 align='right' style='margin-right:5px; padding-top:15;padding-bottom:0px; font-size:15px; margin: 0 5px 15px;' >
									<?php
										//$debit = $totaldebit[] = array_sum($tmp['debit']);
										echo number_format(abs($debit),2);
									?></h5>
									</td>
									<td><h5 align='right' style='margin-right:5px; padding-top:15;padding-bottom:0px;font-size:15px; margin: 0 5px 15px;' >
									<?php
										//$credit = $totalcredit[] = array_sum($tmp['credit']);
										echo number_format(abs($credit),2);
									?></h5>
									</td>
								</tr>
						<?php
									}									
									
								}
									
							}
							echo "<tr>";
								echo "<td align=left><h3 style=' padding-top:15;padding-bottom:0px;font-size:15px; margin: 0 5px 15px; font-weight:bold;' >Total</h3></td>";								
								echo "<td align=right><h3 style='margin-right:5px; padding-top:15;padding-bottom:0px;font-size:15px; margin: 0 5px 15px; font-weight:bold;' >".number_format(abs(array_sum($totaldebit)),2)."</h3></td>";								
								echo "<td align=right><h3 style='margin-right:5px; padding-top:15;padding-bottom:0px;font-size:15px; margin: 0 5px 15px; font-weight:bold;' >".number_format(abs(array_sum($totalcredit)),2)."</h3></td>";								
							echo "</tr>";
							
							echo "</table>";
						}
						?>
                    </div>
                </div>
				 </div>
</body>
    </div>
	
<script>
function myFunction() {
    window.print();
}
</script>
	
	
	
<style>
	.acc_head{
		margin-left:20px;
	}
	.cat_head{
		font-size:17px;
		font-weight:bold;
	}
</style>
	
