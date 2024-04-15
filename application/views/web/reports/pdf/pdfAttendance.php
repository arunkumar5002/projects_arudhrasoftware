<table width="100%" style="width:700px"   >
	<tr>
	<td width="30%" align="left">
		<?php if(isset($fromCompany) && !empty($fromCompany->companylogo) ){ ?>
		<img style="width:200px; height:120px;" src="<?php echo base_url();?>site/companylogo/<?php echo $fromCompany->companylogo; ?>" />
		<?php } ?>
	</td>
	<td width="70%">
		<label style="font-weight:bold; font-size:14px;" ><?php echo $fromCompany->companyname; ?></label><br>
		<?php echo $fromCompany->address;?><br>
		Tel : <?php echo $fromCompany->contact;?> &nbsp;&nbsp; <br>

	</td>
	</tr>

</table>

<table width="100%" style="width:700px"  >
	<tr>
		<td width="30%" align="left"></td>
		<td width="35%" align="left">Email: <?php echo $fromCompany->email;?>  </td>
		<td width="35%" align="left">Invoice No : <b><?php echo $order1->invoicenumber; ?> </b><br> </td>
	</tr>
</table>
<div class="clearfix" style="margin-top:20px;"  ></div>

<table width="100%" style="width:700px"  >
	<tr>
		<td width="70%" ><hr></td>
		<td width="15%" align="center" style="font-weight:bold; font-size:14px; margin-bottom: 7px;" >INVOICE</td>
		<td width="20%" ><hr></td>
	</tr>
</table>

<table width="100%" style="width:700px" >
	<tr>
		<td colspan ="2" width="50%" align="left" style="font-weight:bold;" >Bill to </td>
		<td colspan ="2" width="50%" align="left" style="font-weight:bold;" >Ship to </td>
	</tr>
	<tr>
		<td colspan ="2" width="50%" align="left"><?php echo $toCompany->customername;?></td>
		<td colspan ="2" width="50%" align="left"><?php echo $toCompany->customername;?></td>
	</tr>
	<tr>
		<td colspan ="2" width="50%" align="left"><?php echo $toCompany->address1;?></td>
		<td colspan ="2" width="50%" align="left"><?php echo $toCompany->address1;?></td>
	</tr>
	<tr>
		<td colspan ="2" width="50%" align="left"><?php echo $toCompany->address2;?></td>
		<td colspan ="2" width="50%" align="left"><?php echo $toCompany->address2;?></td>
	</tr>

	<tr>
		<td colspan ="2" width="50%"align="left">Phone: <?php echo $toCompany->phone;?> </td>
	
		<td colspan ="2" width="50%" align="left">Phone: <?php echo $toCompany->phone;?> </td>
		
	</tr>
	<tr>
		
		<td colspan ="2" width="50%" align="left">E-mail: <?php echo $toCompany->email;?> </td>
		<td colspan ="2" width="50%" align="left">E-mail: <?php echo $toCompany->email;?> </td>
	
	
	</tr>
</table>
<div class="clearfix" style="margin-top:20px;"  ></div>
<?php $getvalues = get_purchaseinvoice($order1->purchaseinvoiceid); ?>
<table width="100%" border="1" style="border-collapse: collapse;border:1px solid #000 !important; width:700px "  >
	<tr>
		<td width="17%" style="font-weight:bold;"  align="left">Date</td>
		<td width="13%" align="left"><?php echo date("d-m-Y",strtotime( $order1->invoicedate)); ?>  </td>
		<td width="17%" style="font-weight:bold;"  align="left">Order No</td>
		<td width="18%" align="left"><?php echo $order1->ordernum; ?> </td>
		<td width="15%" style="font-weight:bold;"  align="left">Sales Person </td>
		<td width="20%" align="left"><?php echo $getvalues->authorizedby; ?> </td>
	</tr>
	<!--<tr>
		<td width="17%" style="font-weight:bold;"  align="left">Shipping Date</td>
		<td width="13%" align="left">19-Oct-2010 </td>
		<td width="17%" style="font-weight:bold;"  align="left">Shipping Terms</td>
		<td width="18%" align="left"><?php echo $getvalues->otherterms; ?></td>
		<td width="15%" style="font-weight:bold;"  align="left">Terms </td>
		<td width="20%" align="left"><?php echo $getvalues->paymentterms; ?></td>
	</tr>-->
</table>

<div class="clearfix" style="margin-top:20px;"  ></div>

<table width="100%"  border="1" style="border-collapse: collapse;border:1px solid #000 !important; width:700px "  >
	<tr>
		<th width="15%"style="font-weight:bold;"  >ID</th>
		<th width="45%" style="font-weight:bold;" >SKU/Description</th>
		<th width="15%" style="font-weight:bold;" >Unit Price</th>
		<th width="10%" style="font-weight:bold;"  >Qty</th>
		<th width="15%" style="font-weight:bold;" >Amount</th>
	</tr>
		<?php foreach($order2 as $tmp){ ?>
	<tr>
		<td>PS,V860.05</td>
		<td><?php echo get_item($tmp->itemname);?></td>
		<td style="text-align:right" ><?php echo $tmp->unitprice;?></td>
		<td style="text-align:right" ><?php echo $tmp->quantity; ?></td>
		<td style="text-align:right" ><?php echo $total[] = $tmp->unitprice 
		* $tmp->quantity; ?></td>
	</tr>
		<?php } ?>
</table>
<table width="100%" style="width:700px"  >
	<tr>
		<td width="85%" style="text-align:right; font-weight:bold; " >Sub Total : </td>		
		<td width="15%"style="text-align:right; font-weight:bold; "  ><?php echo toDollar(array_sum($total)); ?></td>	
	</tr>
	
	<tr>
		<td width="85%" style="text-align:right; font-weight:bold; " >Total : </td>		
		<td width="15%"style="text-align:right; font-weight:bold; "  ><?php echo toDollar(array_sum($total)); ?></td>	
	</tr>
</table>	

	<div class="clearfix" style="margin-top:20px;"  ></div>
<table width="100%" style="width:700px"  >
	<tr>
		<td width="30%" style="font-weight:bold;" >Note : </td>				
	</tr>
	<tr>
		<td>Thanks for you business! </td>		
			
	</tr>

</table>
