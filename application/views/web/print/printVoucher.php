
<body onLoad="myFunction()">

<center><h3><?php echo get_companyname($company_id);?></h3></center>

<table width='100%' style="border-collapse: collapse;border:2px solid #ccc !important; width:700px "  border='1'  >
	<tr>
			<td rowspan= "2" width='39%' ><span style='margin-left:20px; font-weight:bold; font-size:18px'>
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
			case 5:
				echo "Purchase Voucher";
				break;
			case 6:
				echo "Sales Voucher";
				break;
		}
	?></span></td>
		<td width='18%' ><b>Voucher No :</b><span style='margin-left:10px'><?php echo $voucher[0]->voucherno?></span></td>
		
		</tr>
		<tr>
		
		<td width='18%'><b>Date :</b><span style='margin-left:10px'><?php echo date('d-m-Y',strtotime($voucher[0]->voucherdate));?></span></td>
		</tr>
	<tr>
		
		<td colspan="2" width='39%' ><span style="margin-left:50px;"><b><i><?php if($voucher[0]->vouchertype == 4){ echo "Deposit / Withdraw : "; } else { echo "Pay To : ";}?></i></b></span><span><?php echo $voucher[0]->towhom?></span></td>
	</tr>
</table>

<table width="100%" style="border-collapse: collapse;border:2px solid #ccc !important; width:700px; border-top: none !important; "  border=1 >
	<tr style="border-top: none !important;" >
		
		<th style="border-top: none !important;">DESCRIPTION</th>
		<th  style="border-top: none !important;" colspan='3' >Debit</th>
		<th  style="border-top: none !important;" colspan='3' >Credit</th>
		<th  style="border-top: none !important;" colspan='3' >Reference </th>
		
		
	</tr>
	<?php
	$sno = 1;
	foreach($voucher as $tmp){
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
	<tr >
		<td colspan='1'></td>
		<?php $totalcer = array_sum($debitArr);
			$totcer = explode(".",$totalcer);	
				
		?>
		<td align=left style="border-color: #ff0000 #FFFFFF" ><span style='margin-left:5px '><?php echo "$ ";?></span></td>
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
	
		<td width='60%'><b>Prepared By :</b><span style='margin-left:10px'><?php echo ucfirst($voucher[0]->preparedby);?></span></td>
		
		<td width='40%'><b>Authorized By :</b><span style='margin-left:10px'><?php echo ucfirst($voucher[0]->authorizedby);?></span></td>
	</tr>
</table> 
</div>
</body>
<script>
function myFunction() {
    window.print();
}
</script>
