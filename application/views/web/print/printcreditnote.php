<body onLoad="myFunction()">

<center><h3><?php echo get_companyname($company_id);?></h3></center>

<table width='100%' style="border-collapse: collapse;border:2px solid #ccc !important; width:700px "  border='1'  >
	<tr>
		
		<td width='50%'><span style='margin-left:10px'><b>Against Invoice No:  </b><?php echo $creditnote[0]->against_invoice_no?></span></span></td>
		
		<td width='50%'><span style='margin-left:10px'><b>Credit Date :  </b><?php echo date('d-m-Y',strtotime($creditnote[0]->credit_date));?></span></span></td>
		
		</tr>
		<tr>
		<td width='50%' ><span style="margin-left:10px;"><span><b>Issue To :  </b><?php echo $creditnote[0]->issue_to?></span></span></td>
		
		<td width='50%' ><span style="margin-left:10px;"><span><b>Amount :  </b><?php echo $creditnote[0]->amount?></span></td>
		</tr>
</table>

<table width="100%" style="border-collapse: collapse;border:2px solid #ccc !important; width:700px; border-top: none !important; " border=1>
	<tr style="border-top: none !important;">
		
		<th style="border-top: none !important;">DESCRIPTION</th>
		<th style="border-top: none !important;" colspan='3' >Debit</th>
		<th style="border-top: none !important;" colspan='3' >Credit</th>
		<th style="border-top: none !important;" colspan='3' >Reference </th>
		
		
	</tr>
	<?php
	$sno = 1;
	foreach($creditnote as $tmp){
	?>
	<tr >
		
		<td><span style='margin-left:10px'><?php echo get_accountname($tmp->accountname)?> <?php 
		/*if($tmp->debit == "0.00")
			{ echo " ( Debit )" ;} else { echo " ( Credit ) "; } */?></span></td>
		<td colspan="2" align=right ><span style='margin-right:5px'>
		<?php 
		
			if($tmp->debit != "0.00")
			{
				$debitArr[] = $debit = $tmp->debit;
				$deb = explode(".",$debit);	
				echo $deb[0];
			}else{
				echo "0";
			}
			
		?>
		</span></td>
		
		<td align=left ><span style='margin-left:5px'>
		<?php 
		
			if($tmp->debit != "0.00")
			{
				
				echo $deb[1];
			}else{
				echo "00";
			}
			
		
		?>
		</span></td>
		
		
		
		<td colspan="2" align=right ><span style='margin-right:5px'>
		<?php 
		
			if($tmp->credit != "0.00")
			{				
				$creditArr[] = $credit = $tmp->credit;
				$cer = explode(".",$credit);	
				echo $cer[0];
			}else{
				echo "0";
			}
				
		
		?>
		</span></td>
		
		<td align=left ><span style='margin-left:5px'>
		<?php 
		
			if($tmp->credit != "0.00")
			{
				echo $cer[1];
				
			}else{
				echo "00";
			}
				
		
		?>
		</span></td>
	
		<td align=left ><span style='margin-left:5px'>
		<?php echo $tmp->reference;
		?>
		</span></td>
		
	</tr>
	<?php
	}
	?>
	<tr>
		<td colspan="1" align=right><span><b>Total (<?php echo get_currency();?>)</b></span></td>
		<?php $totalcer = array_sum($debitArr);
			$totcer = explode(".",$totalcer);	
				
		?>
		<td align=left style="border-color: #ff0000 #FFFFFF" ><span style='margin-left:5px '></span></td>
		<td align=right><span style='margin-right:5px'><?php echo $totcer[0];?></span></td>
		<td align=left><span style='margin-left:5px'><?php if(isset($totcer[1])) { echo $totcer[1];} else { echo "00"; } ?></span></td>
		
		<td align=right colspan="2"><span style='margin-right:5px'><?php echo $totcer[0];?></span></td>
		<td align=left><span style='margin-left:5px'><?php if(isset($totcer[1])) { echo $totcer[1];} else { echo "00"; } ?></span></td>
		<td colspan='3' >&nbsp; </td>
		
	</tr>
	
</table>

<table width="100%" style="border-collapse: collapse;border:2px solid #ccc !important; width:700px; border-top: none !important;"  border=1 >
	<tr style="border-top: none !important;">
		<td style="border-top: none;" colspan='2'><b>The Sum of Dollars : </b> <?php echo convert_number($totalcer)." Dollars Only. "; ?></td>
	</tr>
	<tr>
	
		<td width='60%'><b>Prepared By :</b><span style='margin-left:10px'><?php echo ucfirst($creditnote[0]->preparedby);?></span></td>
		
		<td width='40%'><b>Authorized By :</b><span style='margin-left:10px'><?php echo ucfirst($creditnote[0]->authorizedby);?></span></td>
	</tr>
</table> 
</div>
</body>
<script>
function myFunction() {
    window.print();
}
</script>
