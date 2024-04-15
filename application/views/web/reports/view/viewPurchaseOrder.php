 
 <div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
       
 
 <!-- page content -->
           
                    <div class="page-title">
                        <div class="row" style="margin-bottom:1.5rem!important;">
                <div class="col-sm-6">
                    <h1>View Purchase Order</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                         <span style='float:right;' class='btn btn-success'><a href='<?php echo base_url()?>purchase/purchaseorder' style='color:white'>Back</a></span>
                    </ol>
                </div>
              
</div>
                  
						<div class="x_content">
							<div class="card">
							<div class='col-md-12 col-sm-12 col-xs-12'>
                                  <br>
                                  
                                  <table class="table1" border="1" width="100%">
									  <tr>
										  <td>Order No</td>
										  <td><?php echo $order->purchaseordernum ?></td>
										  <td>Issue Date</td>
										  <td><?php echo $order->issuedate ?></td>
									  </tr>
									  <tr>
										  <td>Delivery Date </td>
										  <td><?php echo $order->deliverydate ?></td>
										  <td>Supplier</td>
										  <td><?php echo get_contactname($order->supplier) ?></td>
									  </tr>
                                  </table>
                                  
                                  
										
                                        </div>
						
						
						
						<br>
	
<div class='col-md-12 col-sm-12 col-xs-12'>
<br>

	<table class="table2" width="100%" border="1" >
		<thead>
			<tr>
				<th>S.No</th>
				<th>Item Code</th>
				<th>Item Name</th>
				<th>Description</th>
				<th>Quantity</th>
				<th>Rate</th>
				<th>Currency</th>
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
				<td><?php echo $i++;?></td>
				<td><?php echo get_itemcode($tmp->itemcode);?></td>
				<td><?php echo get_item($tmp->itemcode);?></td>
				<td><?php echo $tmp->description;?></td>
				<td><?php echo $tmp->quantity;?></td>
				<td><?php echo $tmp->unitprice;?></td>
				<td><?php  echo get_currency()?></td>
				<td><?php echo $tmp->amount;?></td>
			</tr>
			<?php
				}
			}
			?>
			<tr>
			     <td colspan="6"> </td>
				 <td style="text-align:center;"><b>VAT</br></td>
				 <td><?php echo $order->vat;?></td>
			</tr>
			<tr>
			     <td colspan="6"> </td>
				 <td style="text-align:center;"><b>TOTAL</br></td>
				 <td><?php echo $order->totalamount;?></td>
			</tr>
		</tbody>
	</table>


</div>						
		
<div class='col-md-12 col-sm-12 col-xs-12 mb-4'>
<br>
	<table width="100%" border="1" class="table3">
		<tr>
			<td width="25%">Terms & Conditions</td>
			<td width="25%"><?php echo $order->terms?$order->terms:"-";?></td>
			<td width="25%">Authorized By</td>
			<td width="25%"><?php echo $order->authorizedby?$order->authorizedby:"-";?></td>
		</tr>
	</table>
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
