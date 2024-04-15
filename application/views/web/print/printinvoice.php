<body onLoad="myFunction()">
	<div style='width:100%; margin-bottom:25px;' align="right">
		<label style="font-weight: bold; font-size: 15px;">Purchase Invoice</label>
	</div>
	<div style='width:50%;' align='left'>
		<img src="<?php echo base_url(); ?>assets/logo.png" alt="AdminLTELogo" height="60" width="120">
	</div>

	<table align="right" style="margin-bottom:30px; border-collapse:collapse;">
		<tr width="50%;" style="float: right;">

			<td style="min-width:150px; width:100%; background-color:yellow; text-align: center;">
				<label style="font-weight: bold; color: red; padding:10px;">INVOICE</label>
			</td>
			<td style="min-width:80px; width:100%;">
				<label style="font-weight: bold; padding:10px;"><?php echo $invoice1->invoicenumber; ?></label>
			</td>
		</tr>
	</table>
	<table>
		<tr>
			<td width='50%' style="text-align: center;">

				<div style=" background-color:yellow; text-align: center; display:inline; width:50%; padding:10px; border: 1px solid #ccc;">
					<label style="font-weight: bold; color: red; padding:10px;">VAT </label>
				</div>
				<div style="display:inline; width:50%; padding:10px; border: 1px solid #ccc;">
					<label style="font-weight: bold; padding:10px;"><?php echo $fromCompany->vat; ?> %</label>
				</div>

			</td>
			<td width='50%'>
				<label style="font-weight: bold;" align='top'>Ilium Composites</label>
				<p> iliumcomposites.com
					Building 1400 Road 1518, Block 115, HIDD
					</br>Mobile : <?php echo $fromCompany->mobile; ?> </p>
			</td>
			
			
		
		

		</tr>

	</table>


	<table style="margin-top:20px; border-collapse:collapse;">
		<tr>
			<td width='20%' align='left'>
				<label><b>Order No : </b><?php echo $invoice1->purchaseinvoiceid; ?></label>
			</td>
			<td width='30%' align='center'>
				<label><b>Invoice Number : </b><?php echo $invoice1->invoicenumber; ?></label>
			</td>
			<td width='30%' align='right'>
				<label><b>Invoice Date : </b><?php echo date('d-m-Y', strtotime($invoice1->invoicedate)); ?></label>
			</td>
		</tr>
	</table>

	</br>
	</tr>
	<table width='100%'>
		<tr>
			<td rowspan="2" width='50%' style="margin:5px;">
				<b>Bill To </b><br></br>
				<?php $toarrays[] = $toCompany->customername; ?>
				<?php $toarrays[] = $toCompany->address1; ?>
				<?php $toarrays[] = $toCompany->address2; ?>
				<?php $toarrays[] = $toCompany->phone; ?>
				<?php $toarrays[] = $toCompany->email; ?>
				<?php
				$toarrays = array_filter($toarrays);
				$toarrays = implode("<br>", $toarrays);
				echo $toarrays;
				?>
			</td>
			<td width='6px' style="border:none;"></td>
			<td rowspan="2" width='50%' style="margin:5px;">
				<b>Ship To </b></br></br>
				<?php $toarray[] = $toCompany->customername; ?>
				<?php $toarray[] = $toCompany->address1; ?>
				<?php $toarray[] = $toCompany->address2; ?>
				<?php $toarray[] = $toCompany->phone; ?>
				<?php $toarray[] = $toCompany->email; ?>
				<?php
				$toarray = array_filter($toarray);
				$toarray = implode("<br>", $toarray);
				echo $toarray;
				?>
			</td>
		</tr>
	</table>
	<style type="text/css">
		body {
			font-family: Arial, sans-serif;
		}

		table {
			width: 100%;
			/* border-collapse: collapse; */
		}

		table th {
			padding: 13px;
		}

		.tables table th,
		table td {
			border: 1px solid #ccc;
			padding: 15px;
			text-align: left;
		}
	</style>


	<br>
	<table class="tables" width='100%' style="border-collapse: collapse;">
		<thead style='background-color:#c7c7c7; color:black; '>
			<tr class="bb">
				<th>S.No</th>
				<th>Item Code</th>
				<th>Item Name</th>
				<th>Unit Price</th>
				<th>Quantity</th>
				<th>Total</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$sno = 1;
			foreach ($invoicerecords2 as $tmp) {
			?>
				<tr class="bb">
					<td align=center><?php echo $sno++; ?></td>
					<td align=center><?php echo get_itemcode($tmp->itemcode); ?></td>
					<td align=center><?php echo get_item($tmp->itemcode); ?></td>

					<td align=center><?php echo $tmp->unitprice; ?></td>
					<td align=center><?php echo $tmp->quantity; ?></td>
					<td align=center><?php echo number_format($tmp->quantity * $tmp->unitprice); ?></td>
				</tr>
			<?php
			}
			?>
		</tbody>
		<tfoot>

			<tr>
				<td colspan='5' style='font-weight:bold; font-size:16px;text-align:right;'><b>VAT</b></td>

				<td><?php echo $invoice1->vat; ?></td>
			</tr>
			<tr>
				<td colspan='5' style='font-weight:bold; font-size:16px;text-align:right;'><b>Total Amount</b></td>

				<td><?php echo number_format($invoice1->totalamount); ?></td>
			</tr>
			<tr>
				<td colspan='2' style='font-weight:bold; font-size:16px;text-align:left;'><b>Amount Words</b></td>

				<td colspan='4'><?php echo convert_number($invoice1->totalamount); ?> - (<?php echo get_currency() ?>)</td>
			</tr>
		</tfoot>
	</table>
	</br>

	<br>
	<div style="display:flex;justify-content: space-between;">
		<div align="right">&nbsp;
			<b> Terms and Condition </b>
			</br>
			<?php echo $invoice1->preparedby; ?>
		</div>
		<div align="right">
			<b> Thank You & Regards </b>
			<br>
			<?php echo $invoice1->authorizedby; ?>
			</br>
		</div>
	</div>
</body>
<script>
	function myFunction() {
		window.print();
	}
</script>