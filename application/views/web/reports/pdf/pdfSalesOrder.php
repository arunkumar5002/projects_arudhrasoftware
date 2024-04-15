


<table width="100%" style=" width:700px "    >
	<tr>
			<td width="50%"><img src="<?php echo base_url();?>assets/logo.png" alt="AdminLTELogo" height="60" width="120">
		</td>
		<td width="50%" ><b style="float:right; font-size:33px; margin-right:10px" >SALES ORDER</b></td>
		
		</tr>
		
</table>


<table width="100%" style=" width:700px "   >
	<tr>
			<td width="50%"> <p style="marign-left:10px;  font-weight:bold; " ><?php echo $companydetails->name; ?></p>
			</td>
	</tr>	
</table>


<table width="100%" style=" width:700px " >
	<tr>
			<td width="50%" style="margin-left:5px;" ><?php echo $companydetails->address; ?></td>
			<td style="text-align:right; font-weight:bold;"  width="25%"><?php echo "INVOICE NO : "; ?></td>
			<td width="25%"><?php echo $order->salesordernum ?></td>
	</tr>
<tr>
			<td width="50%" style="margin-left:5px;" ><?php echo $companydetails->mobile; ?></td>
			<td style="text-align:right; font-weight:bold;" width="25%"><?php echo "DATE : "; ?></td>
			<td width="25%"><?php echo date("d-m-Y",strtotime($order->issuedate)); ?></td>
			
	</tr>
<tr>
			
			<td style="text-align:right; font-weight:bold;"  width="25%"> <?php echo "CUSTOMER NAME : "; ?></td>
			<td width="25%"><?php echo get_contactname($order->customer); ?></td>

	</tr>
<tr>
			<td width="50%" colspan="3" style="margin-left:5px;"  ><?php echo $companydetails->email; ?></td>
			
			
	</tr>	
</table>


<div class="clearfix" style="margin-top:20px;"  ></div>
<?php $customerdetails = get_cutomerdetails($order->customer); 
		
	?>
<table width="100%"  style="width:700px" >
	<tr>
			<td width="10%"><b>BILL TO</b></td>
			<td width="40%"><?php echo $customerdetails->customername; ?></td>
			<td width="10%"><b>SHIP TO</b></td>
			<td width="40%"><?php echo $customerdetails->customername; ?></td>
	</tr>
	
	
	<tr>
			<td width="10%"></td>
			<td width="40%"><?php echo $customerdetails->address1; ?></td>
			<td width="10%"> </td>
			<td width="40%"> <?php echo $customerdetails->address1; ?></td>
	</tr>
	<tr>
			<td width="10%"></td>
			<td width="40%"> <?php echo $customerdetails->address2; ?></td>
			<td width="10%"></td>
			<td width="40%"> <?php echo $customerdetails->address2; ?></td>
	</tr><tr>
			<td width="10%"> </td>
			<td width="40%"><?php echo $customerdetails->phone; ?></td>
			<td width="10%"></td>
			<td width="40%"> <?php echo $customerdetails->phone; ?></td>
	</tr>
</table> 

<div class="clearfix" style="margin-top:20px;"  ></div>
<?php $getsalequota = get_salequota($order->quoteno); 

?>
<table width="100%" style="border-collapse: collapse;border:2px solid #000 !important; width:700px "  border="1"  >
	<tr>	
		
		<th><b>SHIPPING TERMS</b></th>
		<th><b>DELIVERY DATE</b></th>
		<th><b>PAYMENT TERMS</b></th>
		<th><b>DUE DATE</b></th>
	</tr>
		
		<tr>
			
			<td><?php echo $getsalequota->otherterms; ?></td>
			<td><?php echo date("d-m-Y",strtotime($order->deliverydate)); ?></td>
			<td><?php echo $getsalequota->paymentterms; ?></td>
			<td><?php echo date("d-m-Y",strtotime($order->deliverydate)); ?></td>
		</tr>		
</table>

<div class="clearfix" style="margin-top:20px;"  ></div>
<table width="100%" style="border-collapse: collapse;border:2px solid #000 !important; width:700px "  border="1"  >
	<tr>	
		<th><b>QTY</b></th>
		<th><b>ITEM</b></th>
		<th><b>DESCRIPTION</b></th>
		<th><b>UNIT PRICE</b></th>
		<th><b>DISCOUNT</b></th>
		<th><b>LINE TOTAL</b></th>
		
	</tr>
		<?php
		if(!empty($orderrecords)){
			foreach($orderrecords as $tmp){
		?>
			<tr>
			<td><?php echo $tmp->quantity; ?></td>
			<td><?php echo get_item($tmp->itemname); ?></td>
			<td><?php echo $tmp->description; ?></td>
			<td style="text-align:right;" ><?php echo $tmp->unitprice;?> </td>
			<td></td>
			<td style="text-align:right;"><?php echo $total[]=$tmp->amount;?> </td>
			
			</tr>	
		<?php } } ?>	
		<tr>
			<td style="text-align:right;" colspan="4"><b>TOTAL DISCOUNT</b></td>
			
			<td></td>
			<td></td>
			
		</tr>
		<tr>
			<td style="text-align:right;" colspan="5"><b>SUBTOTAL</b></td>
			
			<td style="text-align:right;"><?php echo array_sum($total); ?></td>
			
		</tr>	
		<!--<tr>
			<td style="text-align:right;" colspan="5"><p>SALES TAX</p></td>
			
			<td></td>
			
		</tr>	-->
		<tr>
			<td style="text-align:right;" colspan="5"><b>TOTAL</b></td>
			
			<td style="text-align:right;"><?php echo array_sum($total); ?></td>
			
		</tr>	
</table>

<div class="clearfix" style="margin-top:20px;"  ></div>

<table width="100%" style=" width:700px "   >
	<tr>
			<td style="text-align:center" >Make all checks payable to <?php echo $companydetails->name;  ?>
			</td>
	</tr>	
	<tr>
			<td style="text-align:center; font-weight:bold;" >THANK YOU FOR YOUR BUSINESS!

		</td>
	</tr>
</table>


</div>
