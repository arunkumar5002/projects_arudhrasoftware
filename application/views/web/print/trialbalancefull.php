 <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        
                       <div class="title_left" style='width:100%;text-align:center;'>
						<u><p>
							<h3><span style='color:green'><?php echo get_defaultcompany()?></span></h3>
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
						<table width='100%' align=center border= 1 style="border-collapse: collapse;border:2px solid #ccc !important; width:1000px">
							<tr  style="margin-bottom:0px">
								<th  width='40%'><h4 align=center >Particulars</h4></th>
								<th  width='15%'><h4 align=center >Opening Balance</h4></th>
								<th  width='15%'><h4 align=center >Debit (<?php echo get_currency() ?>)</h4></th>
								<th  width='15%'><h4 align=center >Credit (<?php echo get_currency() ?>)</h4></th>
								<th  width='15%'><h4 align=center >Closing Balance</h4></th>
							</tr>
						<?php
							
						foreach($balance as $l1=>$tmp1){
																									
								foreach($tmp1 as $l2=>$tmp2){		
									if($l1 == 1){
										echo "<tr><td colspan='3' class='cat_head'>".get_subcategoryname($l2)."</td></tr>";
									}else if($l1 == 2){
										echo "<tr><td colspan='3' class='cat_head'>".get_categoryname($l2)."</td></tr>";
									}
									
									foreach($tmp2 as $l3=>$tmp3){		
										   
								
										   $find = array_sum($tmp3['debit']) - array_sum($tmp3['credit']);
								  
								
						?>
								<tr height='40px'>
									<td><h5 style='margin-left:5px;' ><?php echo get_accountname($l3)?><h5></td>
									<td>
									<h5 align='right' style='margin-right:5px;' >
										<?php 
											$openb = json_decode(get_company_opening_balance($l3));
											if(isset($openb->debit)){
												echo number_format(round(abs($openb->debit)),2)." Dr";
											}else if(isset($openb->credit)){
												echo number_format(round(abs($openb->credit)),2)." Cr";
											}else{
												echo "0.00";
											}
										?>
									</h5>
									</td>
									<td>
									<h5 align='right' style='margin-right:5px;' >
									<?php
										$debit = $totaldebit[] = array_sum($tmp3['debit']);
										echo number_format(round(abs($debit)),2);
									?>
									</h5>
									</td>
									<td>
									<h5 align='right' style='margin-right:5px;' >
									<?php
										$credit = $totalcredit[] = array_sum($tmp3['credit']);
										echo number_format(round(abs($credit)),2);
									?>
									</h5>
									</td>
									<td>
									<h5 align='right' style='margin-right:5px;' >
									<?php		
											if(isset($openb->debit)){
												echo number_format(round(abs(($openb->debit + $debit) - $credit)),2)." Dr";
											}else if(isset($openb->credit)){
												echo number_format(round(abs(($openb->credit + $credit) - $debit)),2)." Cr";
											}else{
												$ftot = $debit - $credit;
												if($ftot < 0){
													echo number_format(round(abs($ftot)),2)." Cr";
												}else{
													echo number_format(round(abs($ftot)),2)." Dr";
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
							echo "<tr>";
								echo "<td align=left><h4 style='margin-left:5px;' >Total</h4></td>";								
								echo "<td align=right><h4 style='margin-right:5px;' ></h4></td>";								
								echo "<td align=right><h4 style='margin-right:5px;' >".number_format(round(abs(array_sum($totaldebit))),2)."</h4></td>";								
								echo "<td align=right><h4 style='margin-right:5px;' >".number_format(round(abs(array_sum($totalcredit))),2)."</h4></td>";								
								echo "<td align=right><h4 style='margin-right:5px;' ></h4></td>";
							echo "</tr>";
							
							echo "</table>";
						}
						?>
                    </div>
                </div>
				 </div>

    </div>
<?php
					$year = get_defaultyeardata();
				?>
	
	 <script>
		$(document).ready(function(){
			$("#pdf").click(function(){
				window.location.href='<?php echo base_url()?>reports/trialbalance_pdf';
			});
				
			$("#excel").click(function(){
				window.location.href='<?php echo base_url()?>reports/trialbalance_excel';
			});
				
			$("#print").click(function(){
				window.open('<?php echo base_url()?>reports/print_trialbalancefull/', "popupWindow", "width=1000,height=600,scrollbars=yes");
			});
			
			$(".datepicker").datepicker({
				changeMonth: true,
				changeYear: true,
				dateFormat: "dd-mm-yy",
				<?php if(!empty($year)){ ?>
				minDate: new Date("<?php echo date("Y",strtotime($year->startdate)).'-'.date("m",strtotime($year->startdate)).'-'.date("d",strtotime($year->startdate));?>"),
				maxDate: new Date("<?php echo date("Y",strtotime($year->enddate)).'-'.date("m",strtotime($year->enddate)).'-'.date("d",strtotime($year->enddate));?>")
				<?php } ?>
			});
		});
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
