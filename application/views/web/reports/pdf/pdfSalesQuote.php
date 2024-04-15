<table  width="100%" style=" width:700px "  >
	<tr>
		<td width="50%" align="left">
			<?php if(isset($fromCompany) && !empty($fromCompany->companylogo) ){ ?>
			<img style="width:250px; height:100px;" src="<?php echo base_url();?>site/companylogo/<?php echo $fromCompany->companylogo; ?>" />
			<?php } ?>
		</td>
		<td width="50%" align="right" >
			<label  style="font-weight:bold; font-size:30px;" >Sales Quote</label><br>
			<label style="margin-right:50px;"  >#ORDER NO - <?php echo $order1->quotenumber; ?></label>
		</td>
	</tr>
</table>

<table  width="100%" style="width:700px;" >
	<tr>
		<td>
			<label style="font-weight:bold; font-size:20px;" ><?php echo $fromCompany->companyname;?></label><br>
			<?php echo $fromCompany->address;?><br>
			<?php echo $fromCompany->contact;?><br>
			<?php echo $fromCompany->email;?><br><br>
		</td>
	</tr>
</table>

<table  width="100%" style=" width:700px;" >
	<tr>
		<td  width="50%" align="left">
			<b>To:</b><br>
			<?php echo $toCompany->customername;?><br>
			<?php echo $toCompany->address1;?><br>
			<?php echo $toCompany->address2;?><br>
			<?php echo $toCompany->phone;?><br>
			<?php echo $toCompany->email;?><br><br>
		</td>
		<td width="20%" align="right">
			 Date : <br>
		</td>
		<td width="30%" align="left" >

			<?php echo date("d-m-Y",strtotime( $order1->quotedate)); ?> <br>
		</td>
	</tr>
	
</table>
<table width="100%" style="border-collapse: collapse;border:1px solid #000 !important; width:700px " border="1">

	<tr>
		<th><b>S.No</b></th>
		<th><b>Particulars</b></th>
	
		<th><b>Rate</b></th>
	</tr>

	<?php
	$sno = 1;
	foreach($order2 as $tmp){
	?>
		<tr>
			<td align="right"><?php echo $sno++; ?></td>
			<td><?php echo get_item($tmp->itemname);?></td>
			
			<td align="right"><?php echo $tmp->unitprice;?></td>
		</tr>
	<?php
	}
	?>
	
</table>

<br>
<br>
Thank You & Regards<br>
<?php echo $order1->authorizedby ?>

<br><br>
Terms & conditions *
<?php if(isset($order1) && !empty($order1->otherterms)) { ?>
<br>
Note: <?php echo $order1->otherterms; ?>	
<?php } ?>
<br>
Note: This is computer generated document, hence no signature required.

