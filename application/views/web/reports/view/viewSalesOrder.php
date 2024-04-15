<div class="content-wrapper">
	
    <section class="content-header">
        <div class="container-fluid">
 <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                View Sales Order
                    
                </h3>
                        </div>
                       <span style='float:right;' class='btn btn-primary'><a href='<?php echo base_url()?>sales/orders' style='color:white'>Back</a></span>
                    </div>
                    <div class="clearfix"></div>

            

							
							<div class='col-md-12 col-sm-12 col-xs-12'>
                                  <br>
                                  
                           <table class="table1" width="100%" border="1">
							   <tr>
								   <td width="25%">Order No</td>
								   <td width="25%"><?php echo $order->salesordernum ?></td>
								   <td width="25%">Issue Date</td>
								   <td width="25%"><?php echo $order->issuedate ?></td>
							   </tr>
							   <tr>
								   <td>Delivery Date</td>
								   <td><?php echo $order->deliverydate ?></td>
								   <td>Customer</td>
								   <td><?php echo get_contactname($order->customer) ?></td>
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
					<th>Description</th>
					<th>Quantity</th>
					<th>Rate</th>
					<th>Total</th>
				</tr>
			</thead>
			
			<tbody>
				<?php
				if(!empty($orderrecords)){
					$i = 1;
					foreach($orderrecords as $tmp){
				?>
				<tr>
					<td align="right"><?php echo $i++;?></td>
					<td><?php echo get_itemcode($tmp->itemcode);?></td>
					<td><?php echo get_item($tmp->itemcode);?></td>
					<td><?php echo $tmp->description;?></td>
					<td align="right"><?php echo $tmp->quantity;?></td>
					<td align="right"><?php echo $tmp->unitprice;?></td>
					<td align="right"><?php echo $tmp->amount;?></td>
				</tr>
				<?php
					}
				}
				?>
				<tr>
				    <td colspan="5"></td>
					<td><b>VAT</b></td>
					<td align="right"><?php echo $order->vat;?></td>
				</tr>
				<tr>
				    <td colspan="5"></td>
					<td><b>Total</b></td>
					<td align="right"><?php echo $order->totalamount;?></td>
				</tr>
			</tbody>
			
	</table>
	
</div>
<div class='col-md-12 col-sm-12 col-xs-12'>
<br>

<!-- <table class="table3" width="100%" border="1">	
	<tr>
		<td width="25%">Authorized By</td>
		<td><?php echo $order->authorizedby?$order->authorizedby:"-";?></td>
	</tr>
</table>  -->

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
		background-color:#343A40;
		padding:10px;
		color:#fff;
	}
</Style>
