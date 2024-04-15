 <!-- page content -->
  <!-- page content -->
  <style>
  .tables table th td{
	  font-size:5px;
  }
  
  </style>
 <div class="content-wrapper">
	<section class="content-header">
		<div class="container-fluid">
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
								$balance['g1'][$details->groupid][$details->subsubcategoryid][$tmp->accountname]['debit'][] = $tmp->debit;
								$balance['g1'][$details->groupid][$details->subsubcategoryid][$tmp->accountname]['credit'][] = $tmp->credit;
							}else if($details->groupid == 2){
								$balance['g2'][$details->groupid][$details->categoryid][$tmp->accountname]['debit'][] = $tmp->debit;
								$balance['g2'][$details->groupid][$details->categoryid][$tmp->accountname]['credit'][] = $tmp->credit;
							}
						}
						
						/*foreach($openingbalance as $tmp){
							
							$details = get_accountname_details($tmp->accountname);
							
							if($details->groupid == 1){
								$balance[$details->groupid][$details->subcategoryid][$tmp->accountname]['debit'][] = $tmp->debit;
								$balance[$details->groupid][$details->subcategoryid][$tmp->accountname]['credit'][] = $tmp->credit;
							}else if($details->groupid == 2){
								$balance[$details->groupid][$details->categoryid][$tmp->accountname]['debit'][] = $tmp->debit;
								$balance[$details->groupid][$details->categoryid][$tmp->accountname]['credit'][] = $tmp->credit;
							}
						}*/
						ksort($balance);
						
                    ?>
       <div class="trial_cls">                
 <div  class="row">
	 <div class="col-md-5">
		<a href='#' id='print' class='btn btn-primary btn-sm'>Print</a>
		<a href='#' id='pdf' class='btn btn-primary btn-sm'>PDF</a> 
		<a href='#' id='excel' class='btn btn-primary btn-sm'>Excel</a> 
		<a href='<?php echo base_url()?>reports/trialbalance'  class='btn btn-primary btn-sm'>Trial Balance</a> <br>
		<input type="checkbox" id="opening_check" checked> Show Opening Balance
		<input type="checkbox" id="trans_check" checked> Show Transaction
	</div>
	<form method="post" action="">
	   <div class="row">
		 <div class="col-md-4">
			 <input type="text" name='fromDate' id='fromDate' placeholder="From Date" class="form-control form-control-sm datepicker" required value="<?php echo isset($fromDate)?$fromDate:"";?>">
		 </div>
		 <div class="col-md-4">
			 <input type="text" name='toDate' id='toDate' placeholder="To Date" class="form-control form-control-sm datepicker" required value="<?php echo isset($toDate)?$toDate:"";?>">
		 </div>
		 <div class="col-md-2">
			<input type="submit" class='btn btn-primary btn-sm' value="Submit"> 
		 </div>
		</div>
	</form>
</div>
                    <div class="container" style="padding: 0px 100px 0px 100px;">
                    <div class="row mt-5">
						<?php
						if(!empty($balance)){
						?>
						<table width='100%' class="tables" align=center border= 1>
							<tr style="margin-bottom:0px;">
								<th  width='40%'>Particulars</th>
								<th  width='15%' class='opening_table'>Opening Balance</th>
								<th  width='15%' class='trans_table'>Debit (<?php echo get_currency() ?>)</th>
								<th  width='15%' class='trans_table'>Credit (<?php echo get_currency() ?>)</th>
								<th  width='15%' class='opening_table'>Closing Balance</th>
							</tr>
						<?php
							foreach($balance as $bbbb){
								
								foreach($bbbb as $l1=>$tmp1){
																									
								foreach($tmp1 as $l2=>$tmp2){		
									if($l1 == 1){
										echo "<tr><td colspan='3' class='cat_head'>".get_subsubcategoryname($l2)."</td></tr>";
									}else if($l1 == 2){
										echo "<tr><td colspan='3' class='cat_head'>".get_categoryname($l2)."</td></tr>";
									}
									
									foreach($tmp2 as $l3=>$tmp3){		
										   
								
										   $find = array_sum($tmp3['debit']) - array_sum($tmp3['credit']);
										   
								
						?>
								<tr height='40px'>
									<td><h6 class="acc_head" id="<?php echo $l3;?>"><?php echo get_accountname($l3)?><h6></td>
									<td class='opening_table'>
									<h6 align='right' style='margin-right:5px;' >
										<?php 
											$openb = json_decode(get_company_opening_balance($l3));
											if(isset($openb->debit)){
												echo number_format(abs($openb->debit),2)." Dr";
												//$totaldebit[] = abs($openb->debit);
											}else if(isset($openb->credit)){
												echo number_format(abs($openb->credit),2)." Cr";
												//$totalcredit[] = abs($openb->credit);
											}else{
												echo "0.00";
											}
										?>
									</h6>
									</td>
									<td class='trans_table'>
									<h6 align='right' style='margin-right:5px;' >
									<?php
										$debit = $totaldebit[] = abs(array_sum($tmp3['debit']));
										echo number_format(abs($debit),2);
									?>
									</h6>
									</td>
									<td class='trans_table'>
									<h6 align='right' style='margin-right:5px;' >
									<?php
										$credit = $totalcredit[] = abs(array_sum($tmp3['credit']));
										echo number_format(abs($credit),2);
									?>
									</h6>
									</td>
									<td class='opening_table'>
									<h6 align='right' style='margin-right:5px;' >
									<?php		
											if(isset($openb->debit)){
												echo number_format(abs((abs($openb->debit) + abs($debit)) - abs($credit)),2)." Dr";
											}else if(isset($openb->credit)){
												echo number_format(abs(($openb->credit + $credit) - abs($debit)),2)." Cr";
											}else{
												$ftot = abs($debit) - abs($credit);
												if($ftot < 0){
													echo number_format(abs($ftot),2)." Cr";
												}else{
													echo number_format(abs($ftot),2)." Dr";
												}
											}
											
												/*$ftot = $debit - $credit;
												if($ftot < 0){
													echo number_format(round(abs($ftot)),2)." Cr";
												}else{
													echo number_format(round(abs($ftot)),2)." Dr";
												}*/
											
									?>
									</h6>
									</td>
								</tr>
						<?php
									}									
									
								}
									
							}
							}
							echo "<tr>";
								echo "<td align=left><h5 style='margin-left:5px;' >Total</h5></td>";								
								echo "<td align=right class='opening_table'><h5 style='margin-right:5px;'></h5></td>";								
								echo "<td align=right class='trans_table'><h5 style='margin-right:5px;' >".number_format(abs(array_sum($totaldebit)),2)."</h5></td>";								
								echo "<td align=right class='trans_table'><h5 style='margin-right:5px;' >".number_format(abs(array_sum($totalcredit)),2)."</h5></td>";								
								echo "<td align=right class='opening_table'><h5 style='margin-right:5px;'></h5></td>";
							echo "</tr>";
							
							echo "</table>";
						}
						?>
                    </div>
					</div>
                     </div>
                    <!------------------ LEDGER --------------------->
                     <div class="ledger_cls">                
					 </div>
                    <!------------------ LEDGER --------------------->
                </div>
				 </div>
				 </div>
				 </section>
				 </div>
				 
				 	<?php 
					if(abs(array_sum($totaldebit)) - abs(array_sum($totalcredit))){
						$diff_amt = number_format(abs(abs(array_sum($totaldebit)) - abs(array_sum($totalcredit))),2);
						$diff_amt = $diff_amt?$diff_amt:"";
					?>					
					<script type ='text/javascript' >
						  $(document).ready(function () {			  
								 new PNotify({
									title: 'Warning',
									text: 'Total Debit not equal to the Total Credit<?php echo $diff_amt?".<br>Difference Amount is: $diff_amt":"";?>',
									type: 'error',
									hide: false
								 });
						
						}); 
					</script>
					<?php } ?>

    </div>
<?php
					$year = get_defaultyeardata();
				?>
	
	 <script>
		$(document).ready(function(){
			$("#pdf").click(function(){
				window.location.href='<?php echo base_url()?>reports/trialbalancefull_pdf';
			});
				
			$("#excel").click(function(){
				window.location.href='<?php echo base_url()?>reports/trialbalancefull_excel';
			});
				
			$("#print").click(function(){
				var fromDate = $("#fromDate").val();
				var toDate = $("#toDate").val();
				
				if(fromDate != '' && toDate != ''){
					window.open('<?php echo base_url()?>reports/print_trialbalancefull/'+fromDate+'/'+toDate, "popupWindow", "width=1200,height=600,scrollbars=yes");
				}else{
					window.open('<?php echo base_url()?>reports/print_trialbalancefull/', "popupWindow", "width=1200,height=600,scrollbars=yes");
				}
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
			
			$(".acc_head").click(function(){
				
				$(".trial_cls").hide();
				$(".ledger_cls").show();
				$(".ledger_cls").html("<center><h3>Loading...Please Wait</h3></center>");
				
				var id = $(this).attr("id");
				
				
					$.ajax({
					  url: "<?php echo base_url();?>reports/get_account_ledger",
					  type:"POST",
					  data: {
						acc:id,
						from: "fulltrial"
					  },
					  success: function( data ) {
						 $(".ledger_cls").show();
						 $(".ledger_cls").html(data);
					  }
					});
			});
			
			<?php			
			if($trialbalance){				
				?>
				
				
					$(".trial_cls").hide();
					$(".ledger_cls").show();
					$(".ledger_cls").html("<center><h1>Loading...</h1><h1>Please Wait</h1></center>");
				
					var id = <?php echo $trialbalance;?>;
				
				
					$.ajax({
					  url: "<?php echo base_url();?>reports/get_account_ledger",
					  type:"POST",
					  data: {
						from: "trial",
						acc:id
					  },
					  success: function( data ) {
						 $(".ledger_cls").show();
						 $(".ledger_cls").html(data);
					  }
					});
					
				
				<?php
			}
			?>
			
			$(document).on("click","#back_trial",function(){
				
				$(".ledger_cls").html("<center><h1>Loading...</h1><h1>Please Wait</h1></center>");
				$(".ledger_cls").hide();
				$(".trial_cls").show();
				
			});
			
			$(document).on("change","#opening_check",function(){
				if($(this).is(":checked")){
					$(".opening_table").show();
				}else{
					$(".opening_table").hide();
				}
			});
			$(document).on("change","#trans_check",function(){
				if($(this).is(":checked")){
					$(".trans_table").show();
				}else{
					$(".trans_table").hide();
				}
			});
		});
    </script>
<style>
	.acc_head{
		margin-left:20px;
		cursor:pointer;
	}
	.cat_head{
		font-size:17px;
		font-weight:bold;
	}
</style>	
