
<table width="100%">
	<tr>
	
	<td width="50%">
		<label style="font-weight:bold; font-size:20px;" ><?php echo $fromCompany->companyname;?></label><br>
		<?php echo $fromCompany->address;?><br>
		Tel : <?php echo $fromCompany->contact?$fromCompany->contact:"-";?> &nbsp;&nbsp; <br>
		Email: <?php echo $fromCompany->email?$fromCompany->email:"-"; ?> 
	</td>
	<td width="50%" align="left">
		<?php if(isset($fromCompany) && !empty($fromCompany->companylogo) ){ ?>
		<img style="width:200px; height:120px;" src='<?php echo base_url();?>site/companylogo/<?php echo $fromCompany->companylogo; ?>' />
		<?php } ?>
	</td>
	</tr>

</table>

<div style="border-bottom:3px solid #000;margin-bottom:10px;width:100%;"></div>
<br><br>
<div></div>
<table width="100%">
	<tr>
		<td width="48%;" style="padding:10px;">
			<table width="90%;" style="border:1px solid #000;padding:2px;">
				<tr>
					<td colspan ="2" align="left" style="font-weight:bold;" >To </td>
				</tr>
				<tr>
					<td colspan ="2" align="left"><?php echo $toCompany->customername;?></td>
				</tr>
				<tr>
					<td colspan ="2" align="left"><?php echo $toCompany->address1?$toCompany->address1:"-";?></td>
				</tr>
				<tr>
					<td colspan ="2" align="left"><?php echo $toCompany->address2?$toCompany->address2:"-";?></td>
				</tr>

				<tr>
					<td colspan ="2" align="left">Phone: <?php echo $toCompany->phone?$toCompany->phone:"-";?> </td>		
				</tr>
				<tr>		
					<td colspan ="2" align="left">E-mail: <?php echo $toCompany->email?$toCompany->email:"-";?> </td>	
				</tr>
			</table>
		</td>
		<td>
		<table width="100%;" class="invoicecls">
			<tr>
				<td colspan ="2" width="50%" align="left" style="font-weight:bold;" >INVOICE </td>
			</tr>			
			<tr>
				<td width="50%" align="left" style="font-weight:bold;border:1px solid #000;padding:2px;" >Date </td>
				<td width="50%" align="left" style="font-weight:bold;border:1px solid #000;padding:2px;" > <?php echo date("d-m-Y",strtotime($order1->invoicedate)); ?> </td>
			</tr>
			<tr>
				<td width="50%" align="left" style="font-weight:bold;border:1px solid #000;padding:2px;" >Invoice ref no </td>
				<td width="50%" align="left" style="font-weight:bold;border:1px solid #000;padding:2px;" > <?php echo $order1->invoicenumber; ?> </td>
			</tr>
			<tr>
				<td width="50%" align="left" style="font-weight:bold;border:1px solid #000;padding:2px;" >Name of the bank </td>
				<td width="50%" align="left" style="font-weight:bold;border:1px solid #000;padding:2px;" > <?php echo $order1->bank_name; ?> </td>
			</tr>
			<tr>
				<td width="50%" align="left" style="font-weight:bold;border:1px solid #000;padding:2px;" >Account no</td>
				<td width="50%" align="left" style="font-weight:bold;border:1px solid #000;padding:2px;" > <?php echo $order1->account_num; ?> </td>
			</tr>
			
		</table>
		</td>
	</tr>
</table>


<div class='clearfix' style='margin-top:20px;'  ></div>
<?php $getvalues = get_saleinvoice($order1->salesinvoiceid); ?>



<div class='clearfix' style='margin-top:20px;'  ></div>

<table width="100%;" class="prodlist" border="1" style="border-collapse: collapse;border:1px solid #000 !important; width:100% "  >
	<tr>
		<th width="10%" >S.No</th>
		<th width="50%" >Description</th>
		<th width="15%">Unit Price</th>
		<th width="10%" >Qty</th>
		<th width="15%" >Amount</th>
	</tr>
		<?php 
		$i = 1;
		foreach($order2 as $tmp){ ?>
	<tr>
		<td align="right"><?php echo $i++;; ?></td>
		<td style="font-weight:bold; "><?php echo get_item($tmp->itemname)." - ".$tmp->description;?></td>
		<td style="text-align:right" ><?php echo $tmp->unitprice;?></td>
		<td style="text-align:right" ><?php echo $tmp->quantity; ?></td>
		<td style="text-align:right" ><?php echo $total[] = toDollar($tmp->unitprice 
		* $tmp->quantity); $fxTotal[] = ($tmp->unitprice * $tmp->quantity); ?></td>
	</tr>
		<?php } ?>

	<tr>
		<td></td>
		<td colspan="3" style="" >Sub Total : </td>		
		<td style="text-align:right; font-weight:bold; "  ><?php echo toDollar(array_sum($fxTotal)); ?></td>	
	</tr>
	<tr>
		<td></td>
		<td colspan="3" style=" " >GST : </td>
		<td style="text-align:right; font-weight:bold; "  ><?php echo $order1->gst; ?></td>	
	</tr>
	<tr>
		<td></td>
		<td colspan="3" style="font-weight:bold; " >Total : </td>	
		<td style="text-align:right; font-weight:bold; "  ><?php echo toDollar($order1->gst + array_sum($fxTotal)); ?></td>	
	</tr>
	<tr>
		<td colspan="6"><b>In Words - <?php echo convert_number($order1->gst + array_sum($fxTotal));?></b></td>
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


<Style>
	.invoicecls tr td{
		
	}
	.prodlist tr td{
		padding:10px;
	}
	.invoicecls tr td{
		
	}
</Style>
