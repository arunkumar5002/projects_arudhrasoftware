 <!-- page content -->
<?php echo load_datatables(); ?>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row" style="margin-bottom:1.5rem!important;">
                <div class="col-sm-6">
                    <h1>View Sales Quotation</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <span style='float:right;' class='btn btn-primary'><a href='<?php echo base_url()?>sales/quotations' style='color:white'>Back</a></span>
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
                                  
                                  
                                 <table  width='100%' style=""  >
<tr>
<td width='50%' align='left'>
<?php if(isset($fromCompany) && !empty($fromCompany->companylogo) ){ ?>
<img style='width:250px; height:100px;' src='<?php echo base_url();?>site/companylogo/<?php echo $fromCompany->companylogo; ?>' />
<?php } ?>
</td>
<td width='50%' align='right' >
<label  style='font-weight:bold; font-size:30px;' >Sales Quote</label><br>
<label style='margin-right:60px;'>ORDER NO - <?php echo $order1->quotenumber; ?></label><br>
<label style='margin-right:50px;'>Date - <?php echo date('d-m-Y',strtotime( $order1->quotedate)); ?></label>
</td>
</tr>
</table>

<table  style="width: 100%;">
  <tr>
    <td style="width: 30%;">
      <b>Ship To : </b><br></br>
      <?php echo $fromCompany->name;?></br>
      <?php echo $fromCompany->address;?><br>
      <?php echo $fromCompany->mobile;?><br>
      <?php echo $fromCompany->email;?><br><br>
    </td>
    <td style="width: 70%;">
      <b>Bill To : </b><br>
      <?php echo $toCompany->customername;?><br>
      <?php echo $toCompany->address1 ? $toCompany->address1."<br>" : "";?>
      <?php echo $toCompany->address2 ? $toCompany->address2."<br>" : "";?>
      <?php echo $toCompany->phone ? $toCompany->phone."<br>" : "";?>
      <?php echo $toCompany->email ? $toCompany->email."<br><br>" : "";?>
    </td>
  </tr>
</table>

                    		
                                        </div>
						
		<div class='col-md-12 col-sm-12 col-xs-12'>		
			<br>			
<table width='100%'class="table2" border='1'>
<thead>
	<tr  >
		<th>S.No</th>
		<th>Item Code</th>
		<th>Item Name</th>
		<th>Quantity</th>
		<th>Rate</th>
		<th> Amount</th>
	</tr>
</thead>	
<tbody>
	<?php
	$sno = 1;
	foreach($order2 as $tmp){
	?>
		<tr  >
			<td   align='left'><?php echo $sno++; ?></td>
			<td><?php echo get_itemcode($tmp->itemcode);?></td>
			<td><?php echo get_item($tmp->itemcode);?></td>
			<td align=right><?php echo $tmp->quantity; ?></td>
			<td align='right'><?php echo $tmp->unitprice;?></td>
			<td align='right'><?php echo $tmp->amount;?></td>
		</tr>
		
	<?php
	}
	?>
</tbody>	
</table>


<br>
Terms & conditions :
<?php if(isset($order1) && !empty($order1->otherterms)) { ?>
<br>
<?php echo $order1->otherterms; ?>	
<?php } ?>


<br>
Authorizedby By:
<?php if(isset($order1) && !empty($order1->authorizedby)) { ?>
<br>
<?php echo $order1->authorizedby; ?>	
<?php } ?>
</body>
			
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
