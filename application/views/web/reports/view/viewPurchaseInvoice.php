 
 <div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
 <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                View Purchase Invoice
                    
                </h3>
                        </div>
                       <span style='float:right;' class='btn btn-primary'><a href='<?php echo base_url()?>purchase/purchaseinvoice' style='color:white'>Back</a></span>
                    </div>
                    <div class="clearfix"></div>

      
						<div class="x_content">
							
							<div class='col-md-12 col-sm-12 col-xs-12'>
                                  <br>
                                  
					  <table class="table1" width="100%" border="1">
							<tr>   
								<td width="25%">Invoice No</td>
								<td width="25%"><?php echo $invoice->invoicenumber ?></td>
								<td width="25%">Invoice Date</td>
								<td width="25%"><?php echo $invoice->invoicedate ?></td>
							</tr>
							<tr>   
								<td>Purchase Order</td>
								<td><?php echo $invoice->ordernum?$invoice->ordernum:"-";?></td>
								<td>GRN</td>
								<td><?php echo $invoice->grnnumber?$invoice->grnnumber:"-";?></td>
							</tr>
							<tr>   
								<td>Supplier</td>
								<td><?php echo get_contactname($invoice->customerid) ?></td>
								
							</tr>
					 </table>	
                                  
										
                                        </div>
						
						
						
						<br>
<div class='col-md-12 col-sm-12 col-xs-12'>
<br>

	<table class="table2" width="100%" border="1">		
		<thead>
			<tr>
				<th>S.No</th>
				<th>Item Code</th>
				<th>Item Name</th>
				<th>Quantity</th>
				<th>Unit Price</th>
				<th>Amount</th>
			</tr>
		</thead>
		
		<tbody>
			<?php
			if(!empty($invoicerecords)){
				$i = 1;
				foreach($invoicerecords as $tmp){
			?>
			<tr>
				<td><?php echo $i++;?></td>
				<td><?php echo get_itemcode($tmp->itemcode);?></td>
				<td><?php echo get_item($tmp->itemcode);?></td>
				<td><?php echo $tmp->quantity?></td>
				<td><?php echo $tmp->unitprice;?></td>
				<td><?php echo $tmp->amount;?></td>
			</tr>
			<?php
				}
			}
			?>
			<tr>
			    <td colspan="4"></td>
				<td align=right><b> VAT </b></td>
				<td><?php echo $invoice->vat;?></td>
			</tr>
			<tr>
			    <td colspan="4"></td>
				<td align=right><b> TOTAL </b></td>
				<td><?php echo $invoice->totalamount;?></td>
			</tr>
		</tbody>
	</table>
	
</div>



		
<div class='col-md-12 col-sm-12 col-xs-12'>
<br>

	<table class="table3" width="100%" border="1">	
		<tr>   
			<td width="25%"> <b> Prepared By </b></td>
			<td width="25%"><?php echo $invoice->preparedby?$invoice->preparedby:"-";?></td>
			<td width="25%"> <b>Authorized By </b></td>
			<td width="25%"><?php echo $invoice->authorizedby?$invoice->authorizedby:"-";?></td>
		</tr>
	</table>
</div>		




		
		
                    </div>
           
                </div>
				 </div>
</div>
				 </div>
				 </section>
    </div>
<Style>
	.table1 tr td{
		padding: 10px;
	}
	.table2 tr td{
		padding: 10px;
	}
	.table3 tr td{
		padding: 10px;
	}
	.table2 thead tr th{
		background-color:#2F4F4F;
		padding:10px;
		color:#fff;
	}
</Style>
