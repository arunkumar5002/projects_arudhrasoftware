 <!-- page content -->
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
							$details = get_accountname_details($tmp->accountname);
							
							if($details->groupid == 1){
								$balance[$details->groupid][$details->subsubcategoryid][$tmp->accountname]['debit'][] = $tmp->debit;
								$balance[$details->groupid][$details->subsubcategoryid][$tmp->accountname]['credit'][] = $tmp->credit;
							}else if($details->groupid == 2){
								$balance[$details->groupid][$details->categoryid][$tmp->accountname]['debit'][] = $tmp->debit;
								$balance[$details->groupid][$details->categoryid][$tmp->accountname]['credit'][] = $tmp->credit;
							}
							
							/*$balance[$tmp->accountname]['debit'][] = $tmp->debit;
							$balance[$tmp->accountname]['credit'][] = $tmp->credit;*/
						}
						
						foreach($openingbalance as $tmp){
							/*$balance[$tmp->accountname]['debit'][] = $tmp->debit;
							$balance[$tmp->accountname]['credit'][] = $tmp->credit;*/
							
							$details = get_accountname_details($tmp->accountname);
							
							if($details->groupid == 1){
								$balance[$details->groupid][$details->subsubcategoryid][$tmp->accountname]['debit'][] = $tmp->debit;
								$balance[$details->groupid][$details->subsubcategoryid][$tmp->accountname]['credit'][] = $tmp->credit;
							}else if($details->groupid == 2){
								$balance[$details->groupid][$details->categoryid][$tmp->accountname]['debit'][] = $tmp->debit;
								$balance[$details->groupid][$details->categoryid][$tmp->accountname]['credit'][] = $tmp->credit;
							}
						}
						
						ksort($balance);
						/*echo "<pre>";
						print_r($balance);
						echo "</pre>";*/
						
                    ?>
    <div class="trial_cls">                
 <div  class="row">
	 <div class="col-md-5">
		<a href='#' id='print' class='btn btn-primary btn-sm'>Print</a>
		<!-- <a href='#' id='pdf' class='btn btn-primary btn-sm'>PDF</a>  -->
		<!-- <a href='#' id='excel' class='btn btn-primary btn-sm'>Excel</a>  -->
		<a href='<?php echo base_url()?>reports/trialbalancefull'  class='btn btn-primary btn-sm'>Full Trial Balance</a> 
	</div>
	<form method="post" action="">
	<div class="row">
		 <div class="col-md-4">
			 <input type="text" placeholder="From Date" name='fromDate' id='fromDate' class="form-control form-control-sm datepicker" required value="<?php echo isset($fromDate)?$fromDate:"";?>">
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
                    <div class="row mt-5" >
						<?php
						if(!empty($balance)){
						?>
						<table width='72%' align=center border= 1 >
							<tr  style="margin-bottom:0px">
								<th  width='60%'><h4 align=center >Particulars</h4></th>
								<th  width='20%'><h4 align=center >Debit (<?php echo get_currency() ?>)</h4></th>
								<th  ><h4 align=center >Credit (<?php echo get_currency() ?>)</h4></th>
							</tr>
						<?php
							
							foreach($balance as $l1=>$tmp1){
																									
								foreach($tmp1 as $l2=>$tmp2){		
									if($l1 == 1){
										echo "<tr><td colspan='3' class='cat_head'>".get_subsubcategoryname($l2)."</td></tr>";
									}else if($l1 == 2){
										echo "<tr><td colspan='3' class='cat_head'>".get_categoryname($l2)."</td></tr>";
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
												<td><h5 class="acc_head" id="<?php echo $l3;?>"><?php echo get_accountname($l3)?><h5>
												
												<?php
												/*if(!isset($finds)){
													$finds = 1;
													$particulars = get_ledger_particulars($l3,'0',$year->startdate,$year->enddate);		
													echo "<pre>";
													print_r($particulars);
													echo "</pre>";
												}*/
												?>
												</td>
												<td>
												<h5 align='right' style='margin-right:5px;' >
												<?php
													//$debit = $totaldebit[] = array_sum($tmp['debit']);
													echo number_format(abs($debit),2);
												?>
												</h5>
												</td>
												<td>
												<h5 align='right' style='margin-right:5px;' >
												<?php
													//$credit = $totalcredit[] = array_sum($tmp['credit']);
													echo number_format(abs($credit),2);
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
									echo "<td align=right><h4 style='margin-right:5px;' >".number_format(abs(array_sum($totaldebit)),2)."</h4></td>";								
									echo "<td align=right><h4 style='margin-right:5px;' >".number_format(abs(array_sum($totalcredit)),2)."</h4></td>";								
									echo "</tr>";
									
									echo "";
							
								   
								
						?>
						
					<?php 
					if(abs(array_sum($totaldebit)) - abs(array_sum($totalcredit))){
						$diff_amt = number_format(abs(abs(array_sum($totaldebit)) - abs(array_sum($totalcredit))),2);
						$diff_amt = $diff_amt?$diff_amt:"";
						
						if(abs($diff_amt) != '0.00'){
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
					<?php } }?>
								<!--<tr>
									<td colspan="2"><h4 style='margin-left:5px;' >Total Difference</h4></td>
									<td align=right><h4 style='margin-right:5px;' >
										<?php
										echo number_format(round(abs(array_sum($totaldebit))),2) - number_format(round(abs(array_sum($totalcredit))),2);
										?>
										
										</h4>
									</td>
								</tr>-->
								</table>
						<?php
							//}
							
						}
						?>
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
					$year = get_defaultyeardata();
				?>
	 <script>
		$(document).ready(function(){
			$("#pdf").click(function(){
				var fromDate = $("#fromDate").val();
				var toDate = $("#toDate").val();
				
				if(fromDate != '' && toDate != ''){
					window.location.href='<?php echo base_url()?>reports/trialbalance_pdf/'+fromDate+'/'+toDate;
				}else{
					window.location.href='<?php echo base_url()?>reports/trialbalance_pdf';
				}
			});
				
			$("#excel").click(function(){
				window.location.href='<?php echo base_url()?>reports/trialbalance_excel';
			});
				
			$("#print").click(function(){
				var fromDate = $("#fromDate").val();
				var toDate = $("#toDate").val();
				
				if(fromDate != '' && toDate != ''){
					window.open('<?php echo base_url()?>reports/print_trialbalance/'+fromDate+'/'+toDate, "popupWindow", "width=1000,height=600,scrollbars=yes");
				}else{
					window.open('<?php echo base_url()?>reports/print_trialbalance/', "popupWindow", "width=1000,height=600,scrollbars=yes");
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
						from: "trial",
						acc:id
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
		padding-left:5px;
	}
</style>
