
<center><h3>GST F5</h3> </center><br>
<center><h3>GOODS AND SERVICES TAX RETURN</h3></center><br>
<center>Goods and Services Tax Act (Cap 117A)</center>	<br>

<br>

<table>
	<tr>
		<td>Name</td>
		<td>:</td>
		<td></td>
	</tr>
	<tr>
		<td>Tax Reference No</td>
		<td>:</td>
		<td></td>
	</tr>
	<tr>
		<td>GST Registration No</td>
		<td>:</td>
		<td></td>
	</tr>
	<tr>
		<td>Due Date</td>
		<td>:</td>
		<td></td>
	</tr>
	<tr>
		<td>Period covered by this return</td>
		<td>:</td>
		<td></td>
	</tr>
</table>	

<br>
<?php 
$data = json_decode($form_data->gst_data);

?>
<table width="100%">
	<tr height="30px" class="row_head">
		<td colspan="2">Supplies</td>
	</tr>
	<tr height="30px">
		<td>Total value of standard-rated supplies</td>
		<td align="right"><?php echo number_format($data->standard_rated,2); ?></td>
	</tr>
	<tr height="30px">
		<td>Total value of zero-rated supplies</td>
		<td align="right"><?php echo number_format($data->zero_rated,2); ?></td>
	</tr>
	<tr height="30px">
		<td>Total value of exempt supplies</td>
		<td align="right"><?php echo number_format($data->exempt_supplies,2); ?></td>
	</tr>
	<tr height="30px">
		<td>Total value of (1) + (2) + (3)</td>
		<td align="right"><?php echo number_format(($data->standard_rated + $data->zero_rated + $data->exempt_supplies),2); ?></td>
	</tr>
	
	
	<tr height="30px" class="row_head">
		<td colspan="2">Purchases</td>
	</tr>
	<tr height="30px">
		<td>Total value of taxable purchases</td>
		<td align="right"><?php echo number_format($data->taxable_purchase,2); ?></td>
	</tr>
	
	<tr height="30px" class="row_head">
		<td colspan="2">Taxes</td>
	</tr>
	<tr height="30px">
		<td>Output Tax Due</td>
		<td align="right"><?php echo number_format($data->output_tax,2); ?></td>
	</tr>
	<tr height="30px">
		<td>Less: <br> Input tax and refunds claimed</td>
		<td align="right"><?php echo number_format($data->input_tax,2); ?></td>
	</tr>
	<tr height="30px">
		<td>Equals: <br> Net GST to be paid to IRAS</td>
		<td align="right"><?php echo number_format($data->net_gst,2); ?></td>
	</tr>
	
	
	<tr height="30px" class="row_head">
		<td colspan="2">Applicable to taxable persons under major exporter scheme / approved 3rd party logistics company / other approved schemes only</td>
	</tr>
	<tr height="30px">
		<td>Total value of goods imported under this scheme</td>
		<td align="right"><?php echo number_format($data->imported_goods,2); ?></td>
	</tr>
	
	
	<tr style="line-height: 150%;" class="row_head">
		<td colspan="2">Did you make the following claims in box?</td>
	</tr>
	<tr height="30px">
		<td>Did you claim for GST you had refunded to tourists?</td>
		<td align="right"><?php echo number_format($data->gst_tourists_value,2); ?></td>
	</tr>
	<tr height="30px">
		<td>Did you make any bad debt releif claims?</td>
		<td align="right"><?php echo number_format($data->debt_claims_value,2); ?></td>
	</tr>
	<tr height="30px">
		<td>Did you make any pre-registration claims?</td>
		<td align="right"><?php echo number_format($data->registration_claims_value,2); ?></td>
	</tr>
	
	
	<tr height="30px" class="row_head">
		<td colspan="2">Revenue</td>
	</tr>
	<tr height="30px">
		<td>Revenue for the accounting period</td>
		<td align="right"><?php echo number_format($data->revenue,2); ?></td>
	</tr>
	
	
	<tr height="30px" class="row_head">
		<td colspan="2">Declaration</td>
	</tr>		
	<tr>		
		<td colspan="2">I declare that the information given above is true and complete<br></td>							
	</tr>
</table>

<table width="50%">
	<tr>
		<td>Name of Declarant</td>
		<td>:</td>
		<td><?php echo $data->declarant_name;?></td>
	</tr>
	<tr>
		<td>Declarant ID</td>
		<td>:</td>
		<td><?php echo $data->declarant_id;?></td>
	</tr>
	<tr>
		<td>Designation</td>
		<td>:</td>
		<td><?php echo $data->desingation;?></td>
	</tr>
	<tr>
		<td>Contact Person</td>
		<td>:</td>
		<td><?php echo $data->contact_person;?></td>
	</tr>
	<tr>
		<td>Contact Tel.No</td>
		<td>:</td>
		<td><?php echo $data->contact_number;?></td>
	</tr>
</table>
	
 <style>
	.row_head{
		background-color:#000;
		color:#fff;
	}
	
</style>
