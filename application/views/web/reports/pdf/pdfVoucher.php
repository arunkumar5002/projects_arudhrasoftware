
<table onLoad="changeurl();" cellpadding="2"  width="100%" style="border-collapse: collapse;border:2px solid #ccc !important; width:700px "  border="1"  >
	<tr>
			<td rowspan= "2" width="70%" ><span style="margin-left:20px; font-weight:bold; font-size:18px">
		<?php 
		switch($voucher[0]->vouchertype){
			case 1:
				echo "Payment Voucher";
				break;
			case 2:
				echo "Receipt Voucher";
				break;
			case 3:
				echo "Journal Voucher";
				break;
			case 4:
				echo "Contra Voucher";
				break;
		}
	?></span></td>
		<td width="30%" ><b>Voucher No :</b><span style="margin-left:10px">&nbsp;<?php echo $voucher[0]->voucherno?></span></td>
		
		</tr>
		<tr>
		
		<td width="30%" ><b>Date :</b><span style="margin-left:10px">&nbsp;<?php echo date('d-m-Y',strtotime($voucher[0]->voucherdate));?></span></td>
		</tr>
	<tr>
		
		<td colspan="2"  ><span style="margin-left:50px;"><b><i>&nbsp;<?php if($voucher[0]->vouchertype == 4){ echo "Deposit / Withdraw : "; } else { echo "Pay To : ";}?></i></b></span><span><?php echo $voucher[0]->towhom?></span></td>
	</tr>
</table>

<table width="100%" cellpadding="2" style="border-collapse: collapse;border:2px solid #ccc !important; width:700px; border-top: none !important; "  border="1" >
	<tr style="border-top: none !important;" >
		
		<th  width="40%" style="border-top: none !important;"><span align="center" ><b>DESCRIPTION</b></span></th>
		<th  width="23%" style="border-top: none !important;" colspan="3" ><span align="center" ><b>DEBIT</b></span></th>
		<th  width="22%" style="border-top: none !important;" colspan="3" ><span align="center" ><b>CREDIT</b></span></th>
		<th  width="15%" style="border-top: none !important;" colspan="3" ><span align="center" ><b>REFERENCE</b></span></th>
		
		
	</tr>
	<?php
	$sno = 1;
	foreach($voucher as $tmp){
	?>
	<tr >
		
		<td width= "40%" ><span style="margin-left:10px"><?php echo get_accountname($tmp->accountname); ?> <?php 
		/*if($tmp->debit == "0.00")
			{ echo " ( Debit )" ;} else { echo " ( Credit ) "; } */?></span></td>
		<td width= "16%" colspan="2" align="right" ><span style="margin-right:5px">
		<?php 
		
			if($tmp->debit != "0.00")
			{
				$debitArr[] = $debit = $tmp->debit;
				$deb = explode(".",$debit);	
				echo $deb[0];
			}
			else
			{
				echo "0";
			}	
		
		?>
		</span></td>
		
		<td width= "7%" align="left" ><span style="margin-left:5px">
		<?php 
		
			if($tmp->debit != "0.00")
			{
				
				echo $deb[1];
			}
			else
			{
				echo "00";
			}	
		
		?>
		</span></td>
	
		<td width= "15%" colspan="2" align="right" ><span style="margin-right:5px">
		<?php 
		
			if($tmp->credit != "0.00")
			{
				$creditArr[] = $credit = $tmp->credit;
				$cer = explode(".",$credit);	
				echo $cer[0];
			}
			else
			{
				echo "0";
			}	
		
		?>
		</span></td>
		
		<td width= "7%" colspan="3" align="left" ><span style="margin-left:5px">
		<?php 
		
			if($tmp->credit != "0.00")
			{				
				echo $cer[1];
			}
			else
			{
				echo "00";
			}	
		
		?>
		</span></td>
		
		<td width= "15%" align="left" ><span style="margin-left:5px">
		<?php 
		
			echo $tmp->reference; 
		
		?>
		</span></td>
	
	
	</tr>
	<?php
	}
	?>
	<tr >
		<td width= "40%" colspan="1"></td>
		<?php $totalcer = array_sum($debitArr);
			$totcer = explode(".",$totalcer);	
				
		?>
		<td width= "2%" align="left" style="border-color: #ff0000 #FFFFFF" ><span style="margin-left:5px "><?php echo "S$ ";?></span></td>
		<td width= "14%" align="right"><span style="margin-right:5px"><?php echo $totcer[0];?>&nbsp;&nbsp;</span></td>
		<td  width= "7%" align="left"><span style="margin-left:5px">&nbsp;&nbsp;<?php if(isset($totcer[1])){ echo $totcer[1]; }else { echo "00"; } ?></span></td>
		
		<td width= "15%" colspan="2" align="right"><span style="margin-right:5px"><?php echo $totcer[0];?>&nbsp;&nbsp;</span></td>
		<td  width= "7%" align="left"><span style="margin-left:5px">&nbsp;&nbsp;<?php if(isset($totcer[1])){ echo $totcer[1]; }else { echo "00"; } ?></span></td>
		<td  width= "15%" ><span style="margin-left:5px">&nbsp;&nbsp;</span></td>
		
		
	</tr>
	
</table>

<table cellpadding="2"  width="100%" style="border-collapse: collapse;border:2px solid #ccc !important; width:700px; border-top: none !important;"  border="1" >
	<tr style="border-top: none !important;">
		<td style="border-top: none;" colspan="2"><b>The Sum of Dollars : </b> <?php echo convert_number($totalcer)." Dollars Only. "; ?></td>
	</tr>
	<tr>
	
		<td width="60%"><b>Prepared By :</b>&nbsp;<span style="margin-left:10px"><?php echo ucfirst($voucher[0]->preparedby);?></span></td>
		
		<td width="40%"><b>Authorized By :</b>&nbsp;<span style="margin-left:10px"><?php echo ucfirst($voucher[0]->authorizedby);?></span></td>
	</tr>
</table> 


