<!-- page content -->
<?php echo load_datatables(); ?>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row" style="margin-bottom:1.5rem!important;">
                <div class="col-sm-6">
                    <h1> View GRN</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                         <span style='float:right;' class='btn btn-primary'><a href='<?php echo base_url()?>accounts/grns' style='color:white'>Back</a></span>
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
                                  
                                  
                <table class="table1" width="100%" border="1">
					<tr>
						<td width="25%">GRN No</td>
						<td width="25%"><?php echo $grn->grnnumber ?></td>
						<td width="25%">Date of Receipt</td>
						<td width="25%"><?php echo $grn->issuedate ?></td>
					</tr>
					<tr>
						<td>Purchase Order</td>
						<td><?php echo $grn->purchaseordernum ?></td>
						<td>Purchase Order Date</td>
						<td><?php echo get_purchase_order_date($grn->purchaseordernum)?></td>
					</tr>
					<tr>
						<td>Supplier</td>
						<td><?php echo get_contactname($grn->supplierid) ?></td>
						<td></td>
						<td></td>
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
				<th>Quantity in P.O</th>
				<th>Quantity Received</th>
				<th>Quantity Difference</th>
			</tr>
		</thead>
		
		<tbody>
			<?php
			if(!empty($grnrecords)){
				$i = 1;
				foreach($grnrecords as $tmp){
			?>
			<tr>
				<td><?php echo $i++;?></td>
				<td><?php echo get_itemcode($tmp->itemid);?></td>
				<td><?php echo get_purchase_order_quantity($grn->purchaseordernum,$tmp->itemid)?></td>
				<td><?php echo $tmp->received;?></td>
				<td><?php echo $tmp->difference;?></td>
			</tr>
			<?php
				}
			}
			?>
		</tbody>		
	</table>
</div>


        
<div class='col-md-12 col-sm-12 col-xs-12'>
<br>
	<table class="table3" width="100%" border="1">
		<tr>
			<td width="25%">Notes</td>
			<td width="25%"><?php echo $grn->notes?$grn->notes:"-";?></td>
			<td width="25%">Received By</td>
			<td width="25%"><?php echo $grn->receivedby?$grn->receivedby:"-";?></td>
		</tr>
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