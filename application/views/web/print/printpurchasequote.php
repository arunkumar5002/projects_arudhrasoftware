<body onLoad="myFunction()">
<div style='width:50%'>
</div>
<div style='width:100%;'>
<table  width='100%'>
<tr>
<td align='left'>
<img src="<?php echo base_url();?>assets/logo.png" alt="AdminLTELogo" height="60" width="120" style="margin-bottom:40px;"></br>
<?php echo $fromCompany->email;?></br>
<?php echo $fromCompany->mobile;?>
</td>

<td width='50%' align='right' ></br>
<label  style='font-weight:bold; font-size:30px;' >Purchase Quote</label><br>
</br>
<label><b>Quote No</b> :<?php echo $order1->quotenumber; ?></label>
<br>
<label><b>Quote Date</b><?php echo " : ".date('d-m-Y',strtotime( $order1->quotedate)); ?> </label><br>
<label><b>customerid</b> :<?php echo get_contactname($order1->customerid); ?></label><br>
</td>
</tr>
</table>
<table  width='100%'>
<tr>
<td rowspan="2" width='50%' align='left'>
<b>Ship To:</b><br></br>
<?php $toarray[] = $toCompany->customername;?>
<?php $toarray[] = $toCompany->address1;?>
<?php $toarray[] = $toCompany->address2;?>
<?php $toarray[] = $toCompany->phone;?>
<?php $toarray[] = $toCompany->email;?>
<?php
$toarray = array_filter($toarray);
$toarray = implode("<br>",$toarray);
echo $toarray;
?>
</td>

<td rowspan="2" width='50%' align='right'>
<b>Vendor:</b><br></br>
<?php $toarrays[] = $toCompany->customername;?>
<?php $toarrays[] = $toCompany->address1;?>
<?php $toarrays[] = $toCompany->address2;?>
<?php $toarrays[] = $toCompany->phone;?>
<?php $toarrays[] = $toCompany->email;?>
<?php
$toarrays = array_filter($toarrays);
$toarrays = implode("<br>",$toarrays);
echo $toarrays;
?>
</td>
</tr>

  
</table>
<table width='100%'>
<thead style='background-color:#73879C'>
	<tr class="bb" >
		<th>S.No</th>
		<th>Item Code</th>
		<th>Item Name</th>
		<th>Unit Price</th>
		<th>Currency</th>
		<th>Quantity</th>
		<th>Total</th>
	</tr>
</thead>	
<tbody>
	<?php
	$sno = 1;
	foreach($order2 as $tmp){
	?>
		<tr class="bb" >
			<td align=center><?php echo $sno++; ?></td>
			<td align=right><?php echo get_itemcode($tmp->itemcode);?></td>
			<td align=right><?php echo get_item($tmp->itemcode);?></td>
			<td align=right><?php  echo $tmp->unitprice;?></td>
			<td align=right><?php  echo get_currency()?></td>
			<td align=right><?php  echo $tmp->quantity; ?></td>
			<td align=right><?php  echo $tmp->quantity * $tmp->unitprice; ?></td>
		</tr>
	<?php
	}
	?>
</tbody>	
<tfoot>
   <tr></br>	
        <td colspan="5"></td>   
		<td style='font-weight:bold; font-size:16px;' align=right ><b>Vat</b></td>
		
		<td align=right><?php echo $order1->vat; ?></td>
	</tr></br>
	<tr></br>
        <td colspan="5"></td>   	
		<td style='font-weight:bold; font-size:16px;' align=right ><b>Total</b></td>
		
		<td align=right><?php echo $order1->totalamount; ?></td>
	</tr>
	
	<tr></br>
       
		<td colspan="2"style='font-weight:bold; font-size:16px;' align=right ><b>Total Amount In Words</b></td>
		
		<td colspan="5"align=right><?php echo convert_number($order1->totalamount); ?> - <?php echo get_currency()?></td>
	</tr>
	
	
</tfoot>
</table>
<br>
<br>
<div style="margin-left:450px;">
<b>Thank You & Regards</b>
<br>
<?php echo $order1->authorizedby ?>
</div>
</br>
</br>

<b>Terms & conditions *</b>
<br>
<?php echo $order1->preparedby;?>
</br>
<br>
</div>
<div style='width:5%'>&nbsp;
</div>
</body>
<script>
function myFunction() {
    window.print();
}
</script>

<style type="text/css">
body {
    font-family: Arial, sans-serif;
}

.invoice {
    width: 800px;
    margin: 0 auto;
    border: 1px solid #ccc;
    padding: 20px;
}

.header {
    /* Add styling for the header section */
}

.content {
    margin-top: 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
}

table th, table td {
    border: 1px solid #ccc;
    padding: 8px;
    text-align: left;
}

.footer {
    margin-top: 20px;
    text-align: right;
}

.total {
    font-weight: bold;
	text-align: right;
}


  </style>