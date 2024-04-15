 <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                View Sales Quotation
                    
                </h3>
                        </div>
                       <span style='float:right;' class='btn btn-primary'><a href='<?php echo base_url()?>sales/quotations' style='color:white'>Back</a></span>
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">
						<div class="x_content">
							
							
<table  width='100%' style=""  >
<tr>
<td width='50%' align='left'>
<?php if(isset($fromCompany) && !empty($fromCompany->companylogo) ){ ?>
<img style='width:250px; height:100px;' src='<?php echo base_url();?>site/companylogo/<?php echo $fromCompany->companylogo; ?>' />
<?php } ?>
</td>
<td width='50%' align='right' >
<label  style='font-weight:bold; font-size:30px;' >Sales Quote</label><br>
<label style='margin-right:50px;'  >#ORDER NO - <?php echo $order1->quotenumber; ?></label><br>
<label style='margin-right:50px;'  >#Date - <?php echo date('d-m-Y',strtotime( $order1->quotedate)); ?></label>
</td>
</tr>
</table>
<table  width='100%' style="" >
<tr>
<td>
<label style='font-weight:bold; font-size:20px;' ><?php echo $fromCompany->companyname;?></label><br>
<?php echo $fromCompany->address;?><br>
<?php echo $fromCompany->contact;?><br>
<?php echo $fromCompany->email;?><br><br>
</td>
</tr>
</table>
<table  width='100%' style=" " >
<tr>
<td rowspan="2" width='50%' align='left'>
<b>To:</b><br>
<?php echo $toCompany->customername;?><br>
<?php echo $toCompany->address1?$toCompany->address1."<br>":"";?>
<?php echo $toCompany->address2?$toCompany->address2."<br>":"";?>
<?php echo $toCompany->phone?$toCompany->phone."<br>":"";?>
<?php echo $toCompany->email?$toCompany->email."<br><br>":"";?>
</td>

</tr>
<tr>



</tr>

<style type="text/css">
.bb td, .bb th {
     border-bottom: 1px solid black !important;
    }
.sit-in-the-corner {
    float: right;
    margin-left: 5px;
    margin-top: 0px;
}

  </style>
  
</table>

<table width='100%' class="quote" border='1'>
<thead>
	<tr  >
		<th >S.No</th>
		<th  >Particulars</th>
		<!--<th  >Quantity</th>-->
		<th  >Rate</th>
	</tr>
</thead>	
<tbody>
	<?php
	$sno = 1;
	foreach($order2 as $tmp){
	?>
		<tr  >
			<td   align='right'><?php echo $sno++; ?></td>
			<td ><?php echo get_item($tmp->itemname);?></td>
			<!--<td   align=right><?php  echo $tmp->quantity; ?></td>-->
			<td  align='right'><?php   echo $tmp->unitprice;?></td>
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
</body>


<Style>
	table.quote tr td{
		padding:10px;
	}
</Style>


		
                    </div>
                    </div>
                </div>
				 </div>

    </div>
