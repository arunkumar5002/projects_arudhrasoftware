<body onLoad="myFunction()">
	<div style='width:100%; margin-bottom:25px;' align="right">
		<label style="font-weight: bold; font-size: 15px;">Sales Invoice</label>
	</div>
	
	<table style="border-collapse:collapse;">
		<tr>
			<td width='30%' align='left'>
				<img src="<?php echo base_url(); ?>assets/arudhralogo.png" alt="AdminLTELogo" height="70" width="140">
			</td>
			<td width='70%' align='center' style="font-size:12px;">
				<p></br><?php echo $fromCompany->address; ?>
				</br>Email : <?php echo $fromCompany->email; ?> | <?php echo $fromCompany->website; ?></br>Landline : <?php echo $fromCompany->landline; ?> | Mobile :   <?php echo $fromCompany->mobile; ?></p>
			</td>
		</tr>
	</table>
	<table style="margin-top:10px; border-collapse:collapse;">
		<tr>
			<td width='20%' align='left'>
				<label>Order No : <?php echo $order1->ordernum; ?></label>
			</td>
			<td width='30%' align='center'>
				<label>Invoice Ref Number : <?php echo $order1->invoicenumber; ?></label>
			</td>
			<td width='30%' align='right'>
				<label>Invoice Date : <?php echo date('d-m-Y', strtotime($order1->invoicedate)); ?></label>
			</td>
		</tr>
	</table>
	<table style="margin-top:10px; border-collapse:collapse;">
		<tr>
		    <td width='20%' align='left'>
				<label>Contact Person : Arunkumar R</label>
			</td>
			<td width='30%' align='center'>
				<label>Quote Ref Number : <?php echo $order1->invoicenumber; ?></label>
			</td>
			<td width='30%' align='right'>
				<label>Quote Date : <?php echo date('d-m-Y', strtotime($order1->invoicedate)); ?></label>
			</td>
		</tr>
	</table>
	<table width='100%' style="margin-top:10px; font-size:12px;">
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
		}

		table th {
			padding: 2px;
		}

		.tables table th,
		table td {
			border: 1px solid #ccc;
			padding: 10px;
			text-align: left;
		}
	</style>


	<br>
	<table class="tables" width='100%' style="border-collapse: collapse;">
		<thead style='background-color:#445D76; color:White; '>
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
			foreach ($order2 as $tmp) {
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
		<tbody>

			<tr>
				<td colspan='5' style='font-weight:bold; font-size:16px;text-align:right;'><b>GST - <?php echo $fromCompany->vat; ?>%</b></td>

				<td><?php echo number_format($order1->vat); ?></td>
			</tr>
			<tr>
				<td colspan='5' style='font-weight:bold; font-size:16px;text-align:right;'><b>Total Amount</b></td>

				<td><?php echo number_format($order1->totalamount); ?></td>
			</tr>
			<tr>
				<td colspan='2' style='font-weight:bold; font-size:16px;text-align:left;'><b>Amount Words</b></td>

				<td colspan="4"><?php echo convert_number($order1->totalamount); ?> - (<?php echo get_currency() ?>)</td>
			</tr>
		</tbody>
	</table>
	
	<table width='100%' style="margin-top:10px; font-size:12px;">
		<tr>
			<td rowspan="2" width='50%' style="margin:5px;">
				<p><b>Bank Details</b></br></br>
				  Account Name  - Arudhra Technologies</br>
				  Bank Name - ICICI Bank</br>
				 Account No - 000027705004263</br>
				 IFSC - ICIC0000277</br>
				 Branch Name - Kadavanthara</br>
				</p>
			</td>
			
		</tr>
	</table>
	</br>

	<br>
	<div style="display:flex;justify-content: space-between;">
		<div align="right">&nbsp;
			<b> Terms and Condition </b>
			</br>
			<?php echo $order1->preparedby; ?>
		</div>
		<div align="right">
			<b> Thank You & Regards </b>
			<br>
			<?php echo $order1->authorizedby; ?>
			</br>
		</div>
	</div>
</body>
<script>
	function myFunction() {
		window.print();
	}
</script>