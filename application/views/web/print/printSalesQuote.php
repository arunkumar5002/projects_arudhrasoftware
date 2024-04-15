
<body onLoad="myFunction()">

<table width='100%' style=" width:700px "    >
	<tr>
		<td width='50%'><img style='marign-left:10px;' width='200px' height='80px' src='<?php echo base_url(); ?>site/companylogo/<?php echo $companydetails->companylogo; ?>' />
		</td>
		<td width='50%' ><b style='float:right; font-size:33px; margin-right:10px' >SALES ORDER</b></td>
		
		</tr>
		
</table>


<table width='100%' style=" width:700px "   >
	<tr>
			<td width='50%'> <p style='marign-left:10px;  font-weight:bold; ' ><?php echo $companydetails->companyname; ?></p>
			</td>
	</tr>	
</table>


<table width='100%' style=" width:700px "   >
	<tr>
			<td width='50%'> <p style='margin-left:5px;' ><?php echo $companydetails->address; ?></p></td>
			<td style='text-align:right;'  width='25%'> <p><b><?php echo 'INVOICE NO : '; ?></b></p></td>
			<td width='25%'> <p> <?php echo $order->salesordernum ?></p></td>
	</tr>
<tr>
			<td width='50%'> <p style='margin-left:5px;' ><?php echo $companydetails->contact; ?></p></td>
			<td style='text-align:right;' width='25%'> <p><b><?php echo 'DATE : '; ?></b></p></td>
			<td width='25%'> <p><?php echo date('d-m-Y',strtotime($order->issuedate)); ?></p></td>
			
	</tr>
<tr>
			<td width='50%'> <p style='margin-left:5px;' ><?php echo $companydetails->fax; ?></p></td>
			<td style='text-align:right;'  width='25%'> <p><b><?php echo 'CUSTOMER NAME : '; ?></b></p></td>
			<td width='25%'> <p> <?php echo get_contactname($order->customer); ?></p></td>

	</tr>
<tr>
			<td width='50%' colspan='2'> <p style='margin-left:5px;'  ><?php echo $companydetails->email; ?></p></td>
			
			
	</tr>	
</table>
<div class='clearfix' style='margin-top:20px;'  ></div>
<?php $customerdetails = get_cutomerdetails($order->customer); 
		
	?>
<table width='100%' style=" width:700px "   >
	<tr>
			<td width='10%'> <p><b>TO</b></p></td>
			<td width='40%'> <p><?php echo $customerdetails->customername; ?></p></td>
			<td width='10%'> <p><b>SHIP TO</b></p></td>
			<td width='40%'> <p><?php echo $customerdetails->customername; ?></p></td>
	</tr>
	
	<tr>
			<td width='10%'> <p></p></td>
			<td width='40%'> <p><?php echo get_companyname($customerdetails->companyid); ?></p></td>
			<td width='10%'> <p></p></td>
			<td width='40%'> <p><?php echo get_companyname($customerdetails->companyid); ?></p></td>
	</tr>
	<tr>
			<td width='10%'> <p></p></td>
			<td width='40%'> <p><?php echo $customerdetails->address1; ?></p></td>
			<td width='10%'> <p></p></td>
			<td width='40%'> <p><?php echo $customerdetails->address1; ?></p></td>
	</tr>
	<tr>
			<td width='10%'> <p></p></td>
			<td width='40%'> <p><?php echo $customerdetails->address2; ?></p></td>
			<td width='10%'> <p></p></td>
			<td width='40%'> <p><?php echo $customerdetails->address2; ?></p></td>
	</tr><tr>
			<td width='10%'> <p></p></td>
			<td width='40%'> <p><?php echo $customerdetails->phone; ?></p></td>
			<td width='10%'> <p></p></td>
			<td width='40%'> <p><?php echo $customerdetails->phone; ?></p></td>
	</tr>
</table> 
<div class='clearfix' style='margin-top:20px;'  ></div>
<?php $getsalequota = get_salequota($order->quoteno); 

?>
<table width='100%' style="border-collapse: collapse;border:2px solid #000 !important; width:700px "  border='1'  >
	<tr>	
		
		<th>SHIPPING TERMS</th>
		<th>DELIVERY DATE</th>
		<th>PAYMENT TERMS</th>
		<th>DUE DATE</th>
	</tr>
		
		<tr>
			
			<td><?php echo $getsalequota->otherterms; ?></td>
			<td><?php echo date('d-m-Y',strtotime($order->deliverydate)); ?></td>
			<td><?php echo $getsalequota->paymentterms; ?></td>
			<td><?php echo date('d-m-Y',strtotime($order->deliverydate)); ?></td>
		</tr>		
</table>

<div class='clearfix' style='margin-top:20px;'  ></div>
<table width='100%' style="border-collapse: collapse;border:2px solid #000 !important; width:700px "  border='1'  >
	<tr>	
		<th>QTY</th>
		<th>ITEM #</th>
		<th>DESCRIPTION</th>
		<th>UNIT PRICE</th>
		<th>DISCOUNT</th>
		<th>LINE TOTAL</th>
		
	</tr>
		<?php
		if(!empty($orderrecords)){
			foreach($orderrecords as $tmp){
		?>
			<tr>
			<td><?php echo $tmp->quantity; ?></td>
			<td><?php echo get_item($tmp->itemname); ?></td>
			<td><?php echo $tmp->description; ?></td>
			<td style='text-align:right;' ><?php echo $tmp->unitprice;?> </td>
			<td></td>
			<td style='text-align:right;'><?php echo $total[]=$tmp->amount;?> </td>
			
			</tr>	
		<?php } } ?>	
		<tr>
			<td style='text-align:right;' colspan='4'><p>TOTAL DISCOUNT</p></td>
			
			<td></td>
			<td></td>
			
		</tr>
		<tr>
			<td style='text-align:right;' colspan='5'><p>SUBTOTAL</p></td>
			
			<td style='text-align:right;'><?php echo array_sum($total); ?></td>
			
		</tr>	
		<!--<tr>
			<td style='text-align:right;' colspan='5'><p>SALES TAX</p></td>
			
			<td></td>
			
		</tr>	-->
		<tr>
			<td style='text-align:right;' colspan='5'><p>TOTAL</p></td>
			
			<td style='text-align:right;'><?php echo array_sum($total); ?></td>
			
		</tr>	
</table>

<div class='clearfix' style='margin-top:20px;'  ></div>

<table width='100%' style=" width:700px "   >
	<tr>
			<td> <p style='text-align:center' >Make all checks payable to <?php echo $companydetails->companyname;  ?></p>
			</td>
	</tr>	
	<tr>
			<td> <p style='text-align:center; font-weight:bold;' >THANK YOU FOR YOUR BUSINESS!
</p>
			</td>
	</tr>
</table>


</div>
</body>
<script>
function myFunction() {
    window.print();
}
</script>