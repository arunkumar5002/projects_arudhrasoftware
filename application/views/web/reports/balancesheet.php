 <div class="content-wrapper">
	<section class="content-header">
		<div class="container-fluid"><!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left" style='width:100%;text-align:center;'>
						<u><p>
							<h3><span style='color:green'><?php echo get_defaultcompany()?></span></h3>
						</p>
                        <p>
							<h3 style='font-size:21px !important; margin-top:15px' >Balance Sheet as at <span style='color:green'><?php echo date("d-M-Y",strtotime(get_defaultyear_end()));?></span></h3>
						</p>
						</u>
                        </div>
                        <div class="row">
							 <div class="col-md-3">
								<a href='#' id='print' class='btn btn-primary btn-sm'>Print</a>
								<!-- <a href='#' id='pdf' class='btn btn-primary btn-sm'>PDF</a> 
								<a href='#' id='excel' class='btn btn-primary btn-sm'>Excel</a> -->
							 </div>
								<form method="post" action="">
								<div class="row">
									 <div class="col-md-5">
										 <input type="text" name='fromDate' id='fromDate' placeholder="From Date" class="form-control form-control-sm datepicker" required value="<?php echo isset($fromDate)?$fromDate:"";?>">
									 </div>
									 <div class="col-md-5">
										 <input type="text" name='toDate' id='toDate' placeholder="To Date" class="form-control form-control-sm datepicker" required value="<?php echo isset($toDate)?$toDate:"";?>">
									 </div>
									 <div class="col-md-2">
										<input type="submit" class='btn btn-primary btn-sm' value="Submit"> 
									 </div>
									 </div>
								</form>
						</div>
                    </div>
                    <div class="clearfix"></div>
					

                    <div class="row trial_cls" style="margin-top:15px;display: inline;">
						
							
						</h4>
						<?php
							$company_id = get_customercompanyid();
							if(isset($fromDate) && isset($toDate))
								$balancesheet = $this->sys_model->get_vouchers_balance_sheet_new($company_id,$fromDate,$toDate);	
							else
								$balancesheet = $this->sys_model->get_vouchers_balance_sheet_new($company_id);	
							
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
							/*ksort($data);
							echo "<pre>";
								print_r($data);
								print_r($datasum);
							echo "</pre>";*/
							
							
							foreach($data as $key=>$tmp){	//Main Category Start
						?>	
					<?php if(!isset($fake)){ $fake = 1;?>
					<table width='50%' align=center >
						<tr>
							
							<th>								
								<h4><span style='float:right; margin-right:50px;'><?php echo get_currency() ?></span></h4>							
							</th>
							
						</tr>
						<?php } ?>
					</table>	
					<table width='50%' align=center border=0>
						
						

						<tr>
							<th <?php if(isset($fake)){ ?> colspan = 2 <?php } ?> width='70%'  ><h3 style='margin-left: -30px;'><b><?php echo get_categoryname($key);?></b></h3></th>
							
						</tr>
						
					</table>
					<?php
						foreach($tmp as $skey=>$temp){ //Subcategory Start							
					?>
					<table width='50%' align=center border=0>
						
						<tr>
							<th colspan=2 height='30px'><h5><b><span style='margin-left:20px'><?php echo get_subcategoryname($skey);?></span></b><h5></th>
						</tr>
						<?php
						/*if(isset($fromDate) && isset($toDate)){
							$records = get_voucherslist($tmp->categoryid,$temp->subcategoryid,$fromDate,$toDate);
						}else{						
							$records = get_voucherslist($tmp->categoryid,$temp->subcategoryid);
						}*/
						
						
							
						foreach($temp as $sskey=>$baa){
							
							 if($sskey){
								echo "<tr class='subcategory' style='cursor:monitor' id='".$sskey."'>";
									echo "<th colspan=1 height='30px' width='70%'><span style='margin-left:50px'>".get_subsubcategoryname($sskey)."</span></th>";
									echo "<td colspan=1 height='30px' align='right'><b style='margin-right:5px'>";
									
									if($key == 1 && $datasum[$key][$skey][$sskey] > 0)								
										echo "(".number_format(abs($datasum[$key][$skey][$sskey]),2).")";
									else if($key == 2 && $datasum[$key][$skey][$sskey] < 0)
										echo "(".number_format(abs($datasum[$key][$skey][$sskey]),2).")";
									else 
										echo number_format(abs($datasum[$key][$skey][$sskey]),2);
									
									echo "</b></td>";
								echo "</tr>";
							}
							foreach($baa as $akey=>$ba){							
							if($ba == '0.00')
								continue;
							
							$diff[$key][] = $ba;
						?>
						<tr height='40px' class='<?php echo $sskey?"account_head":"";?> acc_<?php echo $sskey;?>' id='' style="margin-left:20px;">
							<td width="70%" style='color:blue'>
								<span style='<?php echo $sskey?"margin-left:60px":"margin-left:50px";?>' class="acc_head" id="<?php echo $akey;?>">
									<?php echo ucwords(get_accountname($akey));?>
								</span>
							</td>
							<td width="30%" style='color:blue' align=right><span style='margin-right:5px;' >
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
									echo number_format(round($val),2);
								else
									echo number_format(round($val),2);*/
									
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
						} //account names end
						}
						unset($bArr);
						if($key == '2' && $skey == '4'){
							$pResult = get_profit_loss_result();
							$sfake = 1;
							
							
							//$equity = balance_equity_reserve();
							$equity = $pResult->result;
							$arr[$key][] = $equity;
							echo "<tr  height='30px'>";
							echo "<td width='70%' style='color:brown'><span style='margin-left:40px'><a href='profitandloss' style='color:brown'>".get_accountname(profit_loss_accounts())."</a></span></td>";
							if($equity < 0)
								echo "<td width='30%' align=right style='color:brown'><span style='margin-right:5px;' >(".number_format(abs($equity),2).")</span></td>";
							else
								echo "<td width='30%' align=right style='color:brown'><span style='margin-right:5px;' >".number_format(abs($equity),2)."</span></td>";
							echo "</tr>";
							
							$datasum[2][4][] = $equity;
							$diff[2][] = $equity;
						}
						?>
						
					</table>
					<?php		
								}
						
					?>
						<table  width='50%' align=center border=0>
						<tr>
							<td width='70%' style='color:green'><span style='margin-left:60px; font-size:16px; font-weight:bold;'>Total <?php echo get_categoryname($key); ?></span></td>
							<td width='30%'  align=right style='color:green; font-size:16px; font-weight:bold; border-bottom:double 3px #000; '><span style='margin-right:5px;' ><?php echo isset($arr[$key])?number_format(abs(array_sum($arr[$key])),2):"-";?></span></td>
						</tr>
						</table>
						<?php	


						if( isset($arr[$key]))
												{
													if(isset($checkvalues) && !empty($checkvalues) && round($checkvalues,2) != abs(array_sum($arr[$key])))
													{
														/*echo $checkvalues;
														echo abs(array_sum($arr[$tmp->categoryid]));*/
														$diff_amt = number_format(abs(array_sum($diff[1])) - abs(array_sum($diff[2])),2);
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
														<?php }
													}
													
													$conditionvalues = "";
													if(isset($conditionvalues) && empty($conditionvalues))
													{
														$conditionvalues = $checkvalues = abs(array_sum($arr[$key]));
													}
													
													
												}
						
							} //Main category end
						?>
						
						<!--<br><br>
						<table width='50%' align=center>
							<tr>
								<td width='70%' style='color:green'><span style='margin-left:60px; font-size:16px; font-weight:bold;'>Total Difference</span></td>
								<td width='30%'  align=right style='color:green; font-size:16px; font-weight:bold; '>
									<?php ?>
								</td>
							</tr>
						</table>-->
						
						
                    </div>
                     <!------------------ LEDGER --------------------->
                     <div class="ledger_cls">                
					 </div>
                    <!------------------ LEDGER --------------------->
                </div>
				 </div>
				 <?php
				 				
							
				 ?>

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
					window.location.href='<?php echo base_url()?>reports/balancesheet_pdf/'+fromDate+'/'+toDate;
				}else{
					window.location.href='<?php echo base_url()?>reports/balancesheet_pdf';
				}
			});
			

			$("#excel").click(function(){
				window.location.href='<?php echo base_url()?>reports/balancesheet_excel';
			});
			
			$("#print").click(function(){
				var fromDate = $("#fromDate").val();
				var toDate = $("#toDate").val();
				
				if(fromDate != '' && toDate != ''){
					window.open('<?php echo base_url()?>reports/print_balancesheet/'+fromDate+'/'+toDate, "popupWindow", "width=1000,height=600,scrollbars=yes");
				}else{
					window.open('<?php echo base_url()?>reports/print_balancesheet/', "popupWindow", "width=1000,height=600,scrollbars=yes");
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
			
			$(".account_head").hide();
			
			$(".subcategory").click(function(){
				var id = $(this).attr("id");
				
				$(".acc_"+id).toggle();
			});
			
			$(".acc_head").click(function(){
				
				$(".trial_cls").hide();
				$(".ledger_cls").show();
				$(".ledger_cls").html("<center><h1>Loading...</h1><h1>Please Wait</h1></center>");
				
				var id = $(this).attr("id");
				
				
					$.ajax({
					  url: "<?php echo base_url();?>reports/get_account_ledger",
					  type:"POST",
					  data: {
						from: "balancesheet",
						acc:id
					  },
					  success: function( data ) {
						 $(".ledger_cls").show();
						 $(".ledger_cls").html(data);
					  }
					});
			});
			
			
			<?php			
			if($reports_tally){				
				?>
				
				
					$(".trial_cls").hide();
					$(".ledger_cls").show();
					$(".ledger_cls").html("<center><h1>Loading...</h1><h1>Please Wait</h1></center>");
				
					var id = <?php echo $reports_tally;?>;
				
				
					$.ajax({
					  url: "<?php echo base_url();?>reports/get_account_ledger",
					  type:"POST",
					  data: {
						from: "balancesheet",
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
    
    
