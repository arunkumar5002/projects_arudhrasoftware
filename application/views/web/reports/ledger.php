<?php echo load_datatables(); ?>
<style>
	#FormModalHeading {
		margin-bottom: -5px;
	}
</style>
 <!-- page content -->
 <script src="<?php echo base_url()?>site/admin/js/input_mask/jquery.inputmask.js"></script>
 <script>
        $(document).ready(function () {
            $(":input").inputmask();
        });
    </script>
<div class="content-wrapper">
	<section class="content-header">
		<div class="container-fluid">
		  <div class="right_col" role="main">
                    <div class="page-title">
						<div class="title_left" style='width:100%;text-align:center;'>
						<u><p>
							<h3><span style='color:green'><?php echo get_defaultcompany()?></span></h3>
						</p>
                        <p>
						<?php 
							$vouchertypelist = array('1'=>"SP",'2'=>"CR",'3'=>"JV",'4'=>"CV",'5'=>"PV",'6'=>"SV","7"=>"DN","8"=>"CN");
						?>
							<h3 style='font-size:21px !important; margin-top:15px' >General Ledgers
							<?php if(isset($start)){ ?>
							 for the period from <?php echo isset($start)?date("d.m.Y",strtotime($start)):"";?> to <?php echo isset($end)?date("d.m.Y",strtotime($end)):"";?></h3>
							<?php } ?>
						</p>
						</u>
                        </div>
                       
                    </div>
                 <div class="card-body">
				<div class="form-group">
					<form method='post' action='' id='ledgerform'>
					<div class="row">
						<div class="col-md-4">
							<select id='accounthead' name='accountname' class='form-control form-control-sm tabp select2'>
								<option value='A'>All Account</option>
							<?php
							foreach($ledger_drop as $tmp){
								if(isset($accountname) && $accountname == $tmp->accountname)
									echo "<option value='".$tmp->accountname."' selected>".get_accountname($tmp->accountname)."</option>";
								else
									echo "<option value='".$tmp->accountname."'>".get_accountname($tmp->accountname)."</option>";
							}
							foreach($ledger_drop_opening as $tmp){
								if(isset($accountname) && $accountname == $tmp->accountname)
									echo "<option value='".$tmp->accountname."' selected>".get_accountname($tmp->accountname)."</option>";
								else
									echo "<option value='".$tmp->accountname."'>".get_accountname($tmp->accountname)."</option>";
							}
							?>
							</select>
							
						</div>
						<div class="col-md-2">
							<input type=text class='tabp form-control form-control-sm' placeholder='From Date' data-inputmask="'mask': '99.99.9999'" name='startdate' id='startdate' required value='<?php echo isset($start)?date("d-m-Y",strtotime($start)):get_defaultyear_start();?>'>
						</div>
						
						<div class="col-md-2">
							<input type=text class='tabp form-control form-control-sm' placeholder='To Date' data-inputmask="'mask': '99.99.9999'" name='enddate' id='enddate' required value='<?php echo isset($end)?date("d-m-Y",strtotime($end)):get_defaultyear_end();?>'>
						</div>
						
						<div class="col-md-4">
							<input type=submit class='tabp btn btn-primary btn-sm' name='submit' value='Submit'  id='submitButton'>
							<a href='#' id='print' class='btn btn-primary btn-sm'>Print</a>
							<!--<a href='#' id='pdf' class='btn btn-primary btn-sm'>PDF</a>
							 <a href='#' id='excel' class='btn btn-primary btn-sm'>Excel</a> -->
						</div>
						</div>
					</form>
                </div>
				 </div>
				   <div class="container" style="font-size: small;max-width: 960px;">
                    <div class="row" style="display: contents;">
							<?php
							if(isset($accountname) && $accountname != 'A'){
								if(!print_account_table($accountname,$start,$end)){
									echo "<center><h3>No Records</h3></center>";
								}
							}else if(isset($accountname)){
								foreach($ledger_drop as $tmp){
									print_account_table($tmp->accountname,$start,$end);
								}
							?>
							
							
							
							<?php 
							}
							?>
						
               </div>
			   </div>
			

<?php
function print_account_table($accountname,$start,$end){
	$vouchertypelist = array('1'=>"SP",'2'=>"CR",'3'=>"JV",'4'=>"CV",'5'=>"PV",'6'=>"SV","7"=>"DN","8"=>"CN");
	$debitArr = $creditArr = array();	
	$res = 0;
	$comp_opening = get_company_opening_balance($accountname);
	$particulars = get_ledger_particulars($accountname,$accountname,$start,$end);
	if(!$comp_opening && empty($particulars)){		
		return false;
	}
	?>
	<center><h3 id='<?php echo $accountname ?>'><?php echo get_accountname($accountname); ?></h3></center>
	<table width='100%' border=1 cellpadding=10>
		<tr>
			<th>S.No</th>
			<th>Date</th>									
			<th>V Type</th>
			<th>Trans ID</th>
			<th>Particulars</th>
			<th>Debit (<?php echo get_currency(); ?>)</th>
			<th>Credit (<?php echo get_currency(); ?>)</th>
			<th>Balance (<?php echo get_currency(); ?>)</th>
			<th>Ref</th>
		</tr>
		<?php
			
		
			$comp_opening = json_decode($comp_opening);
			$debit_open = $credit_open = '0.00';
			
			if(!empty($comp_opening)){
				if(isset($comp_opening->debit))
					$debit_open = $comp_opening->debit;
				else if(isset($comp_opening->credit))
					$credit_open = - $comp_opening->credit;
			}else{
				$comp_opening = 0;
			}
		?>
		<?php 
		$startdate = date("Y-m-d",strtotime(get_defaultyear_start()));
		$Tmpstart = date("Y-m-d",strtotime($start));
		
		if(get_defaultyear() != '-' && $startdate != $Tmpstart){
			
			
			if($startdate != $Tmpstart){										
				
				/*$Tmpstartnew1 = date("Y-m-d",strtotime($start));
				$Tmpstartnew2 = date("Y-m-d",strtotime("-1 day".$end));
				$openBal = get_ledger_opening_balance($Tmpstartnew1,$Tmpstartnew2,$accountname);	*/
				
				$Tmpstart = date("Y-m-d",strtotime("-1 day".$Tmpstart));				
				$openBal = get_ledger_opening_balance($startdate,$Tmpstart,$accountname);				
										
				
				if($debit_open)
					$openBal->diff = $openBal->diff + $debit_open;
					
				if($credit_open)
					$openBal->diff = $openBal->diff + $credit_open;
				
		?>
		<tr height='30px'>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;&nbsp;Opening Balance</td>
			<td>&nbsp;</td>
			<td align=right>
			<?php 
				if($openBal->diff > 0){
					$openBal->debit = $openBal->diff;
					echo number_format(round(abs($openBal->diff),2),2)."&nbsp;";
					$debitArr[] = abs($openBal->diff);
				}else{
					echo "0.00"."&nbsp;";
				}									
				
				
			?>
			</td>
			<td align=right>
			<?php 
				if($openBal->diff < 0){
					$openBal->credit = $openBal->diff;
					echo number_format(round(abs($openBal->diff),2),2)."&nbsp;";
					$creditArr[] = abs($openBal->diff);
				}else{
					echo "0.00"."&nbsp;";
				}
				
			?>
			</td>
			<td align=right>
				<?php 
					$res = array_sum($creditArr) - array_sum($debitArr);
					if($res <= 0)
						$str = ' (Dr)'."&nbsp;";
					else
						$str = ' (Cr)'."&nbsp;";
					//echo abs($res).$str;
																
					echo number_format(round(abs(abs($res)),2),2).$str." ";
				?>
			</td>
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
				<td align=right>
				<?php 
					$debit_open = abs($debit_open);
					echo number_format($debit_open,2)."&nbsp;";
													
					$debitArr[] = $debit_open;
					
				?>
				</td>
				<td align=right>
				<?php 
					$credit_open = abs($credit_open);
					echo number_format($credit_open,2)."&nbsp;";
					
					$creditArr[] = $credit_open;
				?>
				</td>
				<td align=right>
					<?php 
						$res = array_sum($creditArr) - array_sum($debitArr);
						if($credit_open > 0)
							$str = ' (Cr)'."&nbsp;";
						else
							$str = ' (Dr)'."&nbsp;";
						//echo abs($res).$str;
																	
						echo number_format(round(abs(abs($res)),2),2).$str." ";
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
			
			<tr height='30px'>
				<td width='5%'>&nbsp;
					<a href="<?php echo base_url()?>accounts/voucher/<?php echo $temp->voucherid?>"><span class="fa fa-pencil"></span></a>
					<?php echo $sno++; ?>					
				</td>
				<td width='8%'>&nbsp;<?php echo date("d-m-Y",strtotime($temp->voucherdate));?></td>
				<td width='4%'>&nbsp;<?php if(isset($temp->vouchertype) && !empty($temp->vouchertype)) { echo $vouchertypelist[$temp->vouchertype]; }  ?></td>
				<td width='7%'>&nbsp;<?php echo $temp->voucherno;?></td>										
				<td width='32%'>&nbsp;
				<?php 
					if($temp->debit != '0.00')
						$s = 'By';
					else if($temp->credit != '0.00')
						$s = 'To';
					
					echo $s.' '.get_accountname($temp->accountname);
				?></td>
				
				
				
				<td width='10%' align=right>&nbsp;
				<?php 
					$debitArr[] = $credit = $temp->credit;
					echo number_format(round(abs($credit),2),2)."&nbsp;";
				?></td>
				<td width='10%'  align=right>&nbsp;
				<?php 
					$creditArr[] = $debit = $temp->debit;
					echo number_format(round(abs($debit),2),2)."&nbsp;";
				?></td>
				<td width='10%' align=right>&nbsp;
				<?php 
					$res = array_sum($creditArr) - array_sum($debitArr);
					if($res <= 0)
						$str = ' (Dr)';
					else
						$str = ' (Cr)';
					//echo abs($res).$str;
																
					echo number_format(round(abs(abs($res)),2),2).$str."&nbsp;";
				?>
				</td>
				 <td width='10%'>&nbsp;<?php echo $temp->reference?$temp->reference:"-";?></td>  
			</tr>			
		<?php									
		}
		echo "<tr>";
			echo "<td colspan='3'></td>";
			echo "<td colspan='3' align=center>Closing Balance (c/f)</td>";
			if(isset($res) && $res<0){
				echo "<td  align=right>- &nbsp;</td>";
				$closed = abs($res);
			}
			else{										
				echo "<td align=right>".number_format(round(abs($res),2),2)."&nbsp;</td>";
				$closed = 0;
			}
			
			if(isset($res) && $res>0){
				echo "<td  align=right>- &nbsp;</td>";
				$closec = abs($res);
			}
			else{
				
				echo "<td  align=right>".number_format(round(abs($res),2),2)."&nbsp;</td>";
				$closec = 0;
			}
			
			echo "<td  align=right>- &nbsp;</td>";
		echo "</tr>";
		
		echo "<tr>";
			echo "<td colspan='5'>  </td>";
			echo "<td align=center> Total </td>";
			if(array_sum($debitArr)>0)
				echo "<td  align=right>".number_format(round(abs((array_sum($debitArr) + $closec)),2),2)."&nbsp;</td>";
			else
				echo "<td align=right>".number_format(round(abs((array_sum($creditArr) + $closed)),2),2)."&nbsp;</td>";
			
			if(array_sum($creditArr)>0)
				echo "<td align=right>".number_format(round(abs((array_sum($creditArr) + $closed)),2),2)."&nbsp;</td>";
			else
				echo "<td align=right>".number_format(round(abs((array_sum($debitArr) + $closec)),2),2)."&nbsp;</td>";
			echo "<td align=right>- &nbsp;</td>";
		echo "</tr>";
		
		
		echo "<tr>";
			echo "<td colspan='3'></td>";
			echo "<td colspan='3' align=center>Opening Balance (b/f)</td>";
			if($res>0)
				echo "<td align=right>- &nbsp;</td>";
			else
				echo "<td align=right>".number_format(round(abs((array_sum($creditArr)-array_sum($debitArr))),2),2)."&nbsp;</td>";
			
			if($res<0)
				echo "<td align=right>- &nbsp;</td>";
			else
				echo "<td align=right>".number_format(round(abs((array_sum($debitArr)-array_sum($creditArr))),2),2)."&nbsp;</td>";
				
			echo "<td align=right>- &nbsp;</td>";
		echo "</tr>";
		
		unset($creditArr);
		unset($debitArr);
		?>
		
	</table>
	<?php
	return true;
}
?>

			</div>
		</div>
	</section>
</div>
          
<script>
	$(document).ready(function(){
		$("#accounthead").change(function(){
			
		});
		
		<?php
		$yeardata = get_defaultyeardata();
		?>
			$(".datepicker1").datepicker({
					dateFormat: "dd-mm-yy",
					minDate: new Date('<?php echo !empty($yeardata)?$yeardata->startdate:"0";?>'),
					maxDate: new Date('<?php echo !empty($yeardata)?$yeardata->enddate:"0";?>'),
					 onSelect: function (selected) {
						  $(".datepicker2").datepicker("option","minDate", selected)
					 }
					
			});
			
            $(".datepicker2").datepicker({
					dateFormat: "dd-mm-yy",					
					minDate: new Date('<?php echo !empty($yeardata)?$yeardata->startdate:"0";?>'),
					maxDate: new Date('<?php echo !empty($yeardata)?$yeardata->enddate:"0";?>')
			});
			
			$("#pdf").click(function(){
				ac = $("#accounthead").val();
				start = $("#startdate").val();
				end = $("#enddate").val();
				if(ac != '' && start != '' && end != '')
					window.location.href='<?php echo base_url()?>reports/ledger_pdf/'+ac+'/'+start+'/'+end;
			});
			
			$("#print").click(function(){
				ac = $("#accounthead").val();
				start = $("#startdate").val();
				end = $("#enddate").val();
				if(ac != '' && start != '' && end != '')
					window.open('<?php echo base_url()?>reports/print_ledger/'+ac+'/'+start+'/'+end, "popupWindow", "width=1300,height=600,scrollbars=yes");
					
			});
		
		$("#excel").click(function(){
				ac = $("#accounthead").val();
				start = $("#startdate").val();
				end = $("#enddate").val();				
				window.location.href='<?php echo base_url()?>reports/ledger_excel/'+ac+'/'+start+'/'+end;
			});
			
			
			
			$('#ledgerform').on('keyup keypress', function(e) {
			  var code = e.keyCode || e.which;
			  if (code == 13) {
				e.preventDefault();				
			  }
			});
			
			$('#submitButton').on('keyup keypress', function(e) {
				 var code = e.keyCode || e.which;
				if (code == 13) {
					$('#ledgerform').submit();
				}
			});
			
			
			$("#accounthead").focus();
			
			$('body').on('keydown', '.tabp', function(e) {
				var self = $(this), 
				form = self.parents('form:eq(0)'), 
				focusable, next;
				if (e.keyCode == 13) {
					
					focusable = form.find('.tabp').filter(':visible');
					next = focusable.eq(focusable.index(this)+1);
					if (next.length) {
						next.focus();
					} else {
						form.submit();
					}
					return false;
				}
				else if (e.keyCode == 27)
				{					
					focusable = form.find('.tabp').filter(':visible');
					next = focusable.eq(focusable.index(this)-1);
					if (next.length) {
						next.focus();
					} 
					return false; 
				}
			});
			
			
                
                window.history.pushState("IRES", "IRES", "<?php echo base_url()?>reports/ledger");
	});
	</script>