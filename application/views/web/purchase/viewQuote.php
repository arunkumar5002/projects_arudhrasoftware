 <!-- page content -->
<?php echo load_datatables(); ?>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row" style="margin-bottom:1.5rem!important;">
                <div class="col-sm-6">
                    <h1>View Quotation</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                         <span style='float:right;' class='btn btn-primary'><a href='<?php echo base_url()?>purchase/purchasequote' style='color:white'>Back</a></span>
                    </ol>
                </div>
            </div>
			
			
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
                     <div class="row">
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
		if(!empty($quoterecords)){
			$i = 1;
			foreach($quoterecords as $tmp){
		?>
		<tr>
			<td align="right"><?php echo $i++;?></td>
			<td><?php echo get_itemcode($tmp->itemcode);?></td>
			<td><?php echo get_item($tmp->itemcode);?></td>
			<td><?php echo $tmp->description;?></td>
			<td align="right"><?php echo $tmp->quantity;?></td>
			<td align="right"><?php echo $tmp->unitprice;?></td>
			<td align="right"><?php echo get_currency()?></td>
			<td align="right"><?php echo $tmp->amount;?></td>
		</tr>
		<?php
			}
		}
		?>
		<tr>
			<td colspan="7" style="text-align:right"> <b> VAT </b> </td>
			<td><?php echo $quote->vat;?></td>
		</tr>
		<tr>
			<td colspan="7" style="text-align:right"> <b> Total </b> </td>
			<td><?php echo $quote->totalamount;?></td>
		</tr>
		<tr></br>
       
		<td colspan="2"style='font-weight:bold; font-size:16px;' align=right ><b>Total Amount In Words</b></td>
		
		<td colspan="6"align=left><?php echo convert_number($quote->totalamount); ?> - <?php echo get_currency()?></td>
	</tr>
	</tbody>	
</table>						
		</div>
        
         </div>
    </div>
	</div>
	</div>
	</div>
	</div>
	</section>
	</div>
<style>
	.table1 tr td{
		padding: 10px;
	}
	.table2 tr td{
		padding: 10px;
	}
	
	.table2 thead tr th{
		background-color:#2F4F4F;
		padding:10px;
		color:#fff;
	}
</style>
