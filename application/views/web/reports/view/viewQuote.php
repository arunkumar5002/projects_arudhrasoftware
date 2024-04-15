 <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                View Quotation
                    
                </h3>
                        </div>
                       <span style='float:right;' class='btn btn-primary'><a href='<?php echo base_url()?>accounts/quotations' style='color:white'>Back</a></span>
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">
						<div class="x_content">
							
							<div class='col-md-12 col-sm-12 col-xs-12'>
                                  <br>
                                  
                                  
                                  <table border="1" width="100%" class="table1">
									  <tr>
										  <td width="25%">Quote No</td>
										  <td width="25%"><?php echo $quote->quotenumber ?></td>
										  <td width="25%">Quote Date</td>
										  <td width="25%"><?php echo date("d-m-Y",strtotime($quote->quotedate)); ?></td>
									  </tr>
									  <tr>
										  <td>Supplier</td>
										  <td> <?php echo get_contactname($quote->customerid) ?></td>
										  <td>Initiated By</td>
										  <td><?php echo $quote->initiatedby ?></td>
									  </tr>
                                  </table>
                                  
										
                                        </div>
						
						
						
						<br>
						
						
		<div class='col-md-12 col-sm-12 col-xs-12'>		
			<br><br><br>			
<table class="table2" width="100%" border="1">
	<thead>
		<tr>
			<th>S.No</th>
			<th>Item Name</th>
			<th>Description</th>
			<th>Quantity</th>
			<th>Rate</th>
			<th>Total</th>
		</tr>
	</thead>
	
	<tbody>
		<?php
		if(!empty($quoterecords)){
			$i = 1;
			foreach($quoterecords as $tmp){
		?>
		<tr>
			<td align="right"><?php echo $i++;?></td>
			<td><?php echo get_item($tmp->itemname);?></td>
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
			<td><?php echo $quote->totalamount;?></td>
		</tr>
	</tbody>	
</table>						
	
		</div>
		
		
		
		
                    </div>
                    </div>
                </div>
				 </div>

    </div>
<style>
	.table1 tr td{
		padding: 10px;
	}
	.table2 tr td{
		padding: 10px;
	}
	
	.table2 thead tr th{
		background-color:#1a82c3;
		padding:10px;
		color:#fff;
	}
</style>
