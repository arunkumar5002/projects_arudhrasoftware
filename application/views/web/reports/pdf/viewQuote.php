<?php

?>                                               
                                          <table width='50%' align=center>
											  <tr>
												  <td width='25%'>Quote Number</td>
												  <td width='25%'><?php echo $quote->quotenumber ?></td>
												  <td width='25%'>Quote Date</td>
												  <td width='25%'><?php echo $quote->quotedate ?></td>
											  </tr>
											  <tr>
												  <td width='25%'>Supplier</td>
												  <td width='25%'><?php echo get_contactname($quote->customerid) ?></td>
												  <td width='25%'>Initiated By</td>
												  <td width='25%'><?php echo $quote->initiatedby ?></td>
											  </tr>
                                          </table>
                                          
                                          
                                      
						<br><br>
<table width='100%'>
    <tr>
		<th>Item Name</th>		
		<th>Description</th>		
		<th>Quantity</th>		
		<th>Rate</th>		
		<th>Total</th>				
	</tr>
		
		<?php
		if(!empty($quoterecords)){
			foreach($quoterecords as $tmp){
		?>
		<tr class='inner' height='40px'>
			<td><?php echo get_item($tmp->itemname);?></td>						
			<td>
				<?php echo $tmp->description;?>
			</td>			
			<td>
				<?php echo $tmp->quantity;?>
			</td>
			<td>
				<?php echo $tmp->unitprice;?>
			</td>
			<td>
				<?php echo $tmp->amount;?>
			</td>
		</tr>
		<?php
			}
		}
		?>		
		<tr class='inner'>
			<td colspan=4></td>
			<td><?php echo $quote->totalamount;?></td>
		</tr>
</table>

		
				
		<style>
			table tr.inner td{
				text-align:center;
			}
		</style>

<?php
?>
