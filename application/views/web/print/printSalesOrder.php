<body onLoad="myFunction()">
	<style>
		table {
			font-family: Arial, Helvetica, sans-serif;
		}

		.b-1 {
			border: 1px solid black;

		}

		table {
			border-collapse: collapse;
			font-size: 12px !important;
		}

		td {
			padding: 10px;
		}

		.b-n {
			border: none;
		}

		.w-100 {
			width: 100%;
		}

		.w-50 {
			width: 50%;
		}

		.bg-grey {
			background-color: #eaeaea85;
		}

		.heading {
			font-weight: 600;
		}

		.text-center {
			text-align: center !important;
		}

		.p-10 {
			padding: 10px;
		}

		.mb-0 {
			margin-bottom: 0px !important;
		}

		.t-red {
			color: #ad0000;
		}

		#oc_table td {
			border: 1px solid black;
		}

		#oc_value td {
			border-left: 1px solid black;
			border-bottom: none !important;
			border-top: none !important;
		}
		#oc_method tr td {
			border: 1px solid black;
		}
	</style>
	<div style="margin:50px auto; ">
		<table class="w-100">
			<tr>
				<td><img src="<?php echo base_url(); ?>assets/logo.png" alt="AdminLTELogo" height="60" width="120"></td>
				<td>
					<div style="float:right; width:100%;">
						<table class="w-100">
							<tr>
								<td class="b-1 heading bg-grey">Date</td>
								<td class="b-1"><?php echo date('d/m/Y',strtotime($order->issuedate)); ?></td>
							</tr>
							<tr>
								<td class="b-1 heading t-red"
									style="background-color: yellow; text-transform: uppercase;">Order
									Confirmation</td>
								<td class="b-1 heading"><?php echo $order->salesordernum ?></td>
							</tr>

						</table>
					</div>
				</td>
			</tr>
		</table>
		<div style="margin:20px 0px"></div>
<?php $customerdetails = get_cutomerdetails($order->customer); ?>
		<table>
			<tr>
				<td width="450px;">
					<p class="mb-0">Ship To :</p>
					<div class="col-md-6" >
					<div class="b-1" style="padding:10px;">
						<p><?php echo $customerdetails->customername; ?></p>
						<p><?php echo get_companyname($customerdetails->company_id); ?></p>
						<p><?php echo $customerdetails->address1; ?></p>
						<p><?php echo $customerdetails->address2; ?></p>
						<p><?php echo $customerdetails->phone; ?></p>
					</div>
					</div>
				</td>
				<td width="20px;">
				</td>
				<td width="450px;">
					<p class="mb-0">Invoice To :</p>
					<div class="col-md-6">
					<div class="b-1" style="padding:10px;">
						<p><?php echo $customerdetails->customername; ?></p>
						<p><?php echo get_companyname($customerdetails->company_id); ?></p>
						<p><?php echo $customerdetails->address1; ?></p>
						<p><?php echo $customerdetails->address2; ?></p>
						<p><?php echo $customerdetails->phone; ?></p>
					</div>
					</div>
                 
				</td>
			</tr>
		</table>
		<div style="margin:20px 0px"></div>
<?php $getsalequota = get_salequota($order->quoteno);?>
		<table id="oc_table" class="w-100">
			<tr>
				<td class="bg-grey">For the attention of:</td>
				<td colspan="5"><p class="heading"><?php echo $customerdetails->customername; ?></p></td>
				<td class="bg-grey">Sales order no:</td>
				<td colspan="3" class="t-red"><?php echo $order->salesordernum ?></td>
			</tr>
			<tr>

				<td colspan="6" class="heading t-red" style="font-style: italic;">Expected Production Availability Date
					: week Feb 01,2024</td>
				<td class="bg-grey">Sales order Date:</td>
				<td colspan="3" class="t-red"><?php echo date('d-m-Y',strtotime($order->issuedate)); ?></td>
			</tr>
			<tr class="bg-grey">
				<td class="heading">Items</td>
				<td class="heading">Item Code</td>
				<td class="heading">Item Name</td> 
				<td class="heading">Description</td>
				<td class="heading">Quantity</td>
				<td class="heading">Unit</td>
				<td class="heading">Unit Price</td>
				<td class="heading">Amount</td>
				<td class="heading">Currency</td>
			</tr>
			
	<?php $i = 1; if(!empty($orderrecords)){ foreach($orderrecords as $tmp){ ?>
			<tr id="oc_value">
			    <td><?php echo $i++ ?></td>
				<td><?php echo get_itemcode($tmp->itemcode); ?></td>
				<td><?php echo get_item($tmp->itemcode); ?></td>
				<td><?php echo $tmp->description; ?></td>
				<td><?php echo $tmp->quantity; ?></td>
				<td><?php echo $tmp->unit;?></td>
				<td><?php echo $tmp->unitprice;?></td>
				<td><?php echo $total[]=$tmp->amount;?></td>
				<td><?php echo get_currency() ?></td>
				
			</tr>
			<?php } } ?>
			

			<tr class="text-center">
				<td rowspan="4" colspan="3">
					<p class="heading">Lorem ipsum dolor sit amet</p>
					<span style="font-style:italic;">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Odio,
						dolore, fuga quibusdam, neque
						doloribus voluptatum maiores itaque sit voluptates ea facilis id exercitationem sequi eum earum
						libero optio velit? Laboriosam!</span>
				</td>
			</tr>
			<tr>
				<td colspan="4">
					<p class="heading" style="float:right;">TOTAL PRICE :</p>
				</td>
				<td>
					<p class="heading"><?php echo array_sum($total); ?></p>
				</td>
				<td>
					<p class="heading">
					<?php echo get_currency();?>
					</p>
				</td>
			</tr>
			<tr>
				<td colspan="6">
					<p class="heading">
						<?php echo convert_number(array_sum($total)); ?> - <?php echo get_currency() ?>
					</p>
				</td>

			</tr>
		</table>
		<div style="margin:20px 0px"></div>

		<table id="oc_method" class="w-100">
			<tr>
				<td colspan="2" class="heading">Ship Via :</td>
				<td class="text-center"><?php echo $order->ship_via ?></td>
				<td colspan="2" class="heading">Incoterms :</td>
				<td class="text-center"><?php echo $order->Inconterms ?></td>
			</tr>
			<tr>
				<td colspan="2" class="heading">Bill of Lading No :</td>
				<td class="text-center"><?php echo $order->bill_laddingno ?></td>
				<td colspan="2" class="heading">Total net weight :</td>
				<td class="text-center"><?php echo $order->total_netweight ?> <?php echo $tmp->unit;?></td>
			</tr>
			<tr>
				<td colspan="2" class="heading">Container No :</td>
				<td class="text-center"><?php echo $order->container_no ?></td>
				<td colspan="2" class="heading">Total Gross weight :</td>
				<td class="text-center"><?php echo $order->gross_weight ?> <?php echo $tmp->unit;?></td>
			</tr>
			<tr>
				<td colspan="2" class="heading">Seal No :</td>
				<td class="text-center"><?php echo $order->seal_no ?></td>
				<td colspan="2" class="heading">No of rolls :</td>
				<td class="text-center"><?php echo $order->rolls ?></td>
			</tr>
			<tr>
				<td colspan="2" class="heading">Custom Code / HS Code :</td>
				<td class="text-center"><?php echo $order->custom_hscode ?></td>
				<td colspan="2" class="heading">No of pallets :</td>
				<td class="text-center"><?php echo $order->pallets ?></td>
			</tr>
			<tr>
				<td colspan="2" class="heading">Loading Port :</td>
				<td class="text-center"><?php echo $order->loading_port ?></td>
				<td colspan="2" class="heading">Discharge Port :</td>
				<td class="text-center"><?php echo $order->discharge_port ?></td>
			</tr>
			<tr>
				<td colspan="2" class="heading">Payment Terms :</td>
				<td  colspan="2" class="text-center heading">60 days dateof BL/-2% on dispatch</td>
				<td class="heading">By :</td>
				<td class="text-center heading">BANK TRANSFER</td>
			</tr>
			<tr>
				<td  class="heading">Beneficiary name :</td>
				<td  colspan="3" class="text-center heading"><?php echo $order->beneficiary_name ?></td>
				<td class="heading"> </td>
				<td class="text-center heading"> </td>
			</tr>
			<tr>
				<td>Bank :</td>
				<td><p class="heading">KHALEEJI COMMERCIAL BANK</p></td>
				<td>IBAN no:</td>
				<td>BH3964551315VF654984A</td>
				<td><p class="heading">Swift Code:</p></td>
				<td><p class="heading">KHCSSEADD</p></td>
			</tr>
		</table>
	</div>
	</div>
</body>
<script>
	function myFunction() {
		window.print();
	}
</script>




<!--


<body onLoad="myFunction()">

<table width='100%' style=" width:700px "    >
	<tr>
			<img src="<?php echo base_url();?>assets/logo.png" alt="AdminLTELogo" height="60" width="120">
		</td>
		<td width='50%' ><b style='float:right; font-size:33px; margin-right:10px' >SALES ORDER</b></td>
		
		</tr>
		
</table>


<table width='100%' style=" width:700px "   >
	<tr>
			<td width='50%'> <p style='marign-left:10px;  font-weight:bold; ' ><?php echo $companydetails->name; ?></p>
			</td>
	</tr>	
</table>


<table width='100%' style=" width:700px "   >
	<tr>
	
	        <td width='50%'> <p style='margin-left:5px;' ><?php echo $companydetails->mobile; ?></p></td>
			<td style='text-align:right;' width='25%'> <p><b><?php echo 'DATE : '; ?></b></p></td>
			<td width='25%'> <p><?php echo date('d-m-Y',strtotime($order->issuedate)); ?></p></td>
	   
			
	</tr>
<tr>
			<td width='50%'> <p style='margin-left:5px;' ><?php echo $companydetails->address; ?></p></td>
			<td style='text-align:right;'  width='25%'> <p><b><?php echo 'INVOICE NO : '; ?></b></p></td>
			<td width='25%'> <p> <?php echo $order->salesordernum ?></p></td>
			
	</tr>
<tr>
			<td width='50%'> <p style='margin-left:5px;' ><?php echo $companydetails->	landline; ?></p></td>
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
			<td width='40%'> <p><?php echo get_companyname($customerdetails->company_id); ?></p></td>
			<td width='10%'> <p></p></td>
			<td width='40%'> <p><?php echo get_companyname($customerdetails->company_id); ?></p></td>
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
			
			<td style='text-align:right;'><?php echo convert_number(array_sum($total)); ?></td>
			
		</tr>	
</table>

<div class='clearfix' style='margin-top:20px;'  ></div>

<table width='100%' style=" width:700px "   >
	<tr>
			<td> <p style='text-align:center' >Make all checks payable to <?php echo $companydetails->name;  ?></p>
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
*/