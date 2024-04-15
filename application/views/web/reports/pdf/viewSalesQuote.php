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
							
							<div class='col-md-12 col-sm-12 col-xs-12'>
                                  <br>
										<div class="form-group col-md-4 col-sm-4 col-xs-4">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-4" for="customername">Quote No <span class="required">*</span>
                                            </label>
                                            <div class="col-md-8 col-sm-8 col-xs-8">
                                               <?php echo $quote->quotenumber ?>
                                            </div>
                                        </div>	
                                        
                                       <div class="form-group col-md-4 col-sm-4 col-xs-4">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-4" for="customername">Quote Date <span class="required">*</span>
                                            </label>
                                            <div class="col-md-8 col-sm-8 col-xs-8">
                                               <?php echo $quote->quotedate ?>
                                            </div>
                                        </div>	

                                        
                                        <div class="form-group col-md-4 col-sm-4 col-xs-4">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-4" for="customername">Customer <span class="required">*</span>
                                            </label>
                                            <div class="col-md-8 col-sm-8 col-xs-8">
                                                <?php echo get_contactname($quote->customerid) ?>
                                            </div>
                                        </div>	
                                        
                                        
						
						
						
						<br>
						
						
<div class="col-md-11 col-sm-11 col-xs-11">
        <div class="form-group" style='background:#1a82c3;color:#fff;font-weight:bold;height:33px;padding-top:7px'>	
			<div class="col-md-4 col-sm-4 col-xs-4" align='center'>
				Item Name
			</div>					
			<div class="col-md-4 col-sm-4 col-xs-4" align='center'>
				Description
			</div>
			
			<div class="col-md-4 col-sm-4 col-xs-4" align='center'>
				Rate Per Unit
			</div>	
							
		</div>	
		<!-- Main Row -->
		<?php
		if(!empty($quoterecords)){
			foreach($quoterecords as $tmp){
		?>
		<div class="form-group">	
			<div class="col-md-4 col-sm-4 col-xs-4" align='center'>
				<?php echo get_item($tmp->itemname);?>
			</div>	
						
			<div class="col-md-4 col-sm-4 col-xs-4" align='center'>
				<?php echo $tmp->description;?>
			</div>
			
			<div class="col-md-4 col-sm-4 col-xs-4" align='center'>
				<?php echo $tmp->unitprice;?>
			</div>
			
		</div>	
		<?php
			}
		}
		?>
		<!-- Main Row -->
</div>		

<div class='row'></div>
<br>
		<div class="col-md-1 col-sm-1 col-xs-1">
			</div>
		<div class="col-md-11 col-sm-11 col-xs-11">
		<table width='100%'>
			<tr height='40px'>
				<td width='25%'>Validity Period</td>
				<td width='25%'><?php echo $quote->validityperiod ?></td>
				<td width='25%'>Payment Terms</td>
				<td width='25%'><?php echo $quote->paymentterms ?></td>
			</tr>
			<tr height='40px'>
				<td width='25%'>Delivery Period</td>
				<td width='25%'><?php echo $quote->deliveryperiod ?></td>
				<td width='25%'>Other Terms</td>
				<td width='25%'><?php echo $quote->otherterms ?></td>
			</tr>
			<tr height='40px'>
				<td width='25%'>Prepared By</td>
				<td width='25%'><?php echo $quote->preparedby ?></td>
				<td width='25%'>Authorized By</td>
				<td width='25%'><?php echo $quote->authorizedby ?></td>
			</tr>
		</table>
		</div>
		
                    </div>
                    </div>
                </div>
				 </div>

    </div>
