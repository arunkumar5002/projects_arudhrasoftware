<body onLoad="myFunction()">


<table width='100%'>
	<tr>
	
	<td width='50%'>
		<label style='font-weight:bold; font-size:20px;' ><?php echo $fromCompany->name;?></label><br>
		<?php echo $fromCompany->address;?><br>
		Tel : <?php echo $fromCompany->mobile?$fromCompany->mobile:"-";?> &nbsp;&nbsp; <br>
		Email: <?php echo $fromCompany->email?$fromCompany->email:"-"; ?> 
	</td>
	<td width='50%' align='left'>
		<?php if(isset($fromCompany) && !empty($fromCompany->companylogo) ){ ?>
		<img style='width:200px; height:120px;' src='<?php echo base_url();?>site/companylogo/<?php echo $fromCompany->companylogo; ?>' />
		<?php } ?>
	</td>
	</tr>

</table>

<div class='clearfix' style='margin-top:20px;'  ></div>

<hr>
<table width="100%">
	<tr>
		<td width='50%;'>
			<table width='100%;' style="border:1px solid #000;">
				<tr>
					<td colspan ='2' align='left' style='font-weight:bold;' >To </td>
				</tr>
				<tr>
					<td colspan ='2' align='left'><?php echo $toCompany->customername;?></td>
				</tr>
				<tr>
					<td colspan ='2' align='left'><?php echo $toCompany->address1?$toCompany->address1:"-";?></td>
				</tr>
				<tr>
					<td colspan ='2' align='left'><?php echo $toCompany->address2?$toCompany->address2:"-";?></td>
				</tr>

				<tr>
					<td colspan ='2' align='left'>Phone: <?php echo $toCompany->phone?$toCompany->phone:"-";?> </td>		
				</tr>
				<tr>		
					<td colspan ='2' align='left'>E-mail: <?php echo $toCompany->email?$toCompany->email:"-";?> </td>	
				</tr>
			</table>
		</td>
		<td>
		<table width='100%;' class="invoicecls">
			<tr>
				<td colspan ='2' width='50%' align='left' style='font-weight:bold;' >INVOICE </td>
			</tr>			
			<tr>
				<td width='50%' align='left' style='font-weight:bold;' >Date </td>
				<td width='50%' align='left' style='font-weight:bold;' > <?php echo date("d-m-Y",strtotime($order1->invoicedate)); ?> </td>
			</tr>
			<tr>
				<td width='50%' align='left' style='font-weight:bold;' >Invoice ref no </td>
				<td width='50%' align='left' style='font-weight:bold;' > <?php echo $order1->invoicenumber; ?> </td>
			</tr>
			<tr>
				<td width='50%' align='left' style='font-weight:bold;' >Name of the bank </td>
				<td width='50%' align='left' style='font-weight:bold;' > <?php echo $order1->bank_name; ?> </td>
			</tr>
			<tr>
				<td width='50%' align='left' style='font-weight:bold;' >Account no</td>
				<td width='50%' align='left' style='font-weight:bold;' > <?php echo $order1->account_num; ?> </td>
			</tr>
			
		</table>
		</td>
	</tr>
</table>


<div class='clearfix' style='margin-top:20px;'  ></div>
<?php $getvalues = get_saleinvoice($order1->salesinvoiceid); ?>



<div class='clearfix' style='margin-top:20px;'  ></div>

<table width='100%;' class="prodlist" border='1' style="border-collapse: collapse;border:1px solid #000 !important; width:100% "  >
	<tr>
		<th width='10%' >S.No</th>
		<th width='25%' >Item Name</th>
		<th width='350%' >Description</th>
		<th width='15%'>Unit Price</th>
		<th width='10%' >Qty</th>
		<th width='15%' >Amount</th>
	</tr>
		<?php foreach($order2 as $tmp){ ?>
	<tr>
		<td align="right"><?php echo $tmp->invoiceid; ?></td>
		<td align="right"><?php echo $tmp->itemname; ?></td>
		<td style='font-weight:bold; '><?php echo $tmp->description;?></td>
		<td style='text-align:right' ><?php echo $tmp->unitprice;?></td>
		<td style='text-align:right' ><?php echo $tmp->quantity; ?></td>
		<td style='text-align:right' ><?php echo $total[] = toDollar($tmp->unitprice 
		* $tmp->quantity); $fxTotal[] = ($tmp->unitprice * $tmp->quantity); ?></td>
	</tr>
		<?php } ?>

	<tr>
		<td></td>
		<td width='85%' colspan="3" align="right" >Sub Total : </td>		
		<td width='15%'style='text-align:right; font-weight:bold; '  ><?php echo toDollar(array_sum($fxTotal)); ?></td>	
	</tr>
	<tr>
		<td></td>
		<td width='85%' colspan="3" align="right">VAT : </td>
		<td width='15%' style='text-align:right; font-weight:bold; '  ><?php echo $fromCompany->vat; ?></td>	
	</tr>
	<tr>
		<td></td>
		<td width='85%' colspan="3" align="right" style='font-weight:bold; ' >Total : </td>	
		<td width='15%'style='text-align:right; font-weight:bold; '  ><?php echo toDollar($fromCompany->vat + array_sum($fxTotal)); ?></td>	
	</tr>
	<tr>
		<td colspan="6" align="left"><b>In Words - </b> <?php echo convert_number($fromCompany->vat + array_sum($fxTotal));?></td>
	</tr>
</table>	
<div class='clearfix' style='margin-top:20px;'  ></div>

<div class='clearfix' style='margin-top:20px;'  ></div>

<b>Terms and Condition :</b><br>

<?php echo $order1->conditions; ?>

<br><br>
<table width='100%;'  >
	<tr>
		<td width='30%' style='font-weight:bold; '  >Note : </td>					
	</tr>
	<tr>
		<td>Thanks for you business! </td>		
		
	</tr>
	
</table>
<br>

<p>*This is computer generated invoice hence no need of signatory</p>



</body>
<script>
function myFunction() {
    //window.print();
}
</script>

<Style>
	.invoicecls tr td{
		border:1px solid #000;
	}
	.prodlist tr td{
		padding:10px;
	}
	.invoicecls tr td{
		padding:2px;
	}
</Style>
