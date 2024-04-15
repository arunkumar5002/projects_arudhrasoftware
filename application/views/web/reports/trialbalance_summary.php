
<div style="float:right">
	<a style="cursor:pointer" id="back_trial" class='btn btn-success'>Back</a>
</div>
<br>
<br>

<div>
	<center><h2><?php echo get_accountname($accountname);?></h2></center>
	
	<?php
	$comp_opening = get_company_opening_balance($accountname);
	$debitArr = $creditArr = array();	
	$res = 0;
	if(!empty($particulars) || !empty($comp_opening)){
	?>
<table width='100%' border=1 cellpadding=10>
								<tr>
									<th>S.No</th>
									<th>Date</th>									
									<th>V Type</th>
									<th>Trans ID</th>
									<th>Particulars</th>
									<th>Ref</th>
									<th>Debit (<?php echo get_currency(); ?>)</th>
									<th>Credit (<?php echo get_currency(); ?>)</th>
									<th>Balance (<?php echo get_currency(); ?>)</th>
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
		if(!empty($comp_opening)){
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
					
					echo $debit_open."&nbsp;";
													
					$debitArr[] = $debit_open;
					
				?>
				</td>
				<td align=right>
				<?php 
					
					echo $credit_open."&nbsp;";
					
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
																	
						echo number_format(abs(abs($res)),2).$str." ";
					?>
				</td>
			</tr>
			<?php
			}
				
			
			?>		
								
								
								
								
								
								
<?php
		$sno = 1;	
		$vouchertypelist = array('1'=>"SP",'2'=>"CR",'3'=>"JV",'4'=>"CV",'5'=>"PV",'6'=>"SV","7"=>"DN","8"=>"CN");	
		foreach($particulars as $temp){
		?>
			<tr height='30px'>
				<td width='5%'>&nbsp;
				<a href="<?php echo base_url()?>accounts/voucher/<?php echo $temp->voucherid?>"><span class="fa fa-pencil"></span></a>
				<?php echo $sno++; ?></td>
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
				<td width='10%'>&nbsp;<?php echo $temp->reference?$temp->reference:"-";?></td>
				<td width='10%' align=right>&nbsp;
				<?php 
					$debitArr[] = $credit = $temp->credit;
					echo number_format(abs($credit),2)."&nbsp;";
				?></td>
				<td width='10%'  align=right>&nbsp;
				<?php 
					$creditArr[] = $debit = $temp->debit;
					echo number_format(abs($debit),2)."&nbsp;";
				?></td>
				<td width='10%' align=right>&nbsp;
				<?php 
					$res = array_sum($creditArr) - array_sum($debitArr);
					if($res <= 0)
						$str = ' (Dr)';
					else
						$str = ' (Cr)';
					//echo abs($res).$str;
																
					echo number_format(abs(abs($res)),2).$str."&nbsp;";
				?>
				</td>
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
				
				echo "<td align=right>".number_format(abs($res),2)."&nbsp;</td>";
				$closed = 0;
			}
			
			if(isset($res) && $res>0){
				echo "<td  align=right>- &nbsp;</td>";	
				$closec = abs($res);
			}
			else{
				echo "<td  align=right>".number_format(abs($res),2)."&nbsp;</td>";
				$closec = 0;
			}
			
			echo "<td  align=right>- &nbsp;</td>";
		echo "</tr>";
		
		echo "<tr>";
			echo "<td colspan='5'>  </td>";
			echo "<td align=center> Total </td>";
			if(array_sum($debitArr)>0)
				echo "<td  align=right>".number_format(abs((array_sum($debitArr) + $closec)),2)."&nbsp;</td>";
			else
				echo "<td align=right>".number_format(abs((array_sum($creditArr) + $closed)),2)."&nbsp;</td>";
			
			if(array_sum($creditArr)>0)
				echo "<td align=right>".number_format(abs((array_sum($creditArr) + $closed)),2)."&nbsp;</td>";
			else
				echo "<td align=right>".number_format(abs((array_sum($debitArr) + $closec)),2)."&nbsp;</td>";
			echo "<td align=right>- &nbsp;</td>";
		echo "</tr>";
		
		
		echo "<tr>";
			echo "<td colspan='3'></td>";
			echo "<td colspan='3' align=center>Opening Balance (b/f)</td>";
			if($res>0)
				echo "<td align=right>- &nbsp;</td>";
			else				
				echo "<td align=right>".number_format(abs((array_sum($creditArr)-array_sum($debitArr))),2)."&nbsp;</td>";
			
			if($res<0)
				echo "<td align=right>- &nbsp;</td>";
			else				
				echo "<td align=right>".number_format(abs((array_sum($debitArr)-array_sum($creditArr))),2)."&nbsp;</td>";
				
			echo "<td align=right>- &nbsp;</td>";
		echo "</tr>";
		
		unset($creditArr);
		unset($debitArr);
		?>
		
	</table>
	<?php
	}else{
		echo "<center><h3>No Records</h3></center>";
	}
	?>
</div>
