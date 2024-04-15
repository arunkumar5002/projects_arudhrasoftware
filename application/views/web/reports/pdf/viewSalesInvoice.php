 <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                View Sales Invoice
                    
                </h3>
                        </div>
                       <span style='float:right;' class='btn btn-primary'><a href='<?php echo base_url()?>sales/invoices' style='color:white'>Back</a></span>
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">
						<div class="x_content">
							
							<div class='col-md-12 col-sm-12 col-xs-12'>
                                  <br>
										<div class="form-group col-md-6 col-sm-6 col-xs-6">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-4" for="customername">Invoice No <span class="required">*</span>
                                            </label>
                                            <div class="col-md-8 col-sm-8 col-xs-8">
                                               <?php echo $invoice->invoicenumber ?>
                                            </div>
                                        </div>	
                                        
                                       <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-4" for="customername">Invoice Date <span class="required">*</span>
                                            </label>
                                            <div class="col-md-8 col-sm-8 col-xs-8">
                                               <?php echo $invoice->invoicedate ?>
                                            </div>
                                        </div>	

                                        
                                        <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-4" for="customername">Sales Order <span class="required">*</span>
                                            </label>
                                            <div class="col-md-8 col-sm-8 col-xs-8">
												<?php echo $invoice->ordernum?$invoice->ordernum:"-";?>
                                            </div>
                                        </div>	
                                        
                                       
                                        
                                        <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-4" for="customername">Supplier <span class="required">*</span>
                                            </label>
                                            <div class="col-md-8 col-sm-8 col-xs-8">
                                                <?php echo get_contactname($invoice->customerid) ?>
                                            </div>
                                        </div>
                                        
                                        </div>
						
						
						
						<br>
						
						
<div class="col-md-10 col-sm-10 col-xs-10">
        <div class="form-group" style='background:#1a82c3;color:#fff;font-weight:bold;height:33px;padding-top:7px'>	
			<div class="col-md-3 col-sm-3 col-xs-3" style='margin-top:5px' align='center'>
				Item Name
			</div>		
			
			
			<div class="col-md-3 col-sm-2 col-xs-2" align='center'>
				Quantity
			</div>
			<div class="col-md-3 col-sm-2 col-xs-2" align='center'>
				Unit Price
			</div>
			<div class="col-md-3 col-sm-2 col-xs-2" align='center'>
				Amount
			</div>		
		</div>	
		<!-- Main Row -->
		<?php
		if(!empty($invoicerecords)){
			foreach($invoicerecords as $tmp){
		?>
		<div class="form-group">	
		
			<div class="col-md-3 col-sm-3 col-xs-3" align='center'>
				<?php echo get_item($tmp->itemname);?>
			</div>		
			
			<div class="col-md-3 col-sm-2 col-xs-2" align='center'>
				<?php echo $tmp->quantity?>
			</div>
			<div class="col-md-3 col-sm-2 col-xs-2" align='center'>
				<?php echo $tmp->unitprice;?>
			</div>
			
			<div class="col-md-3 col-sm-2 col-xs-2" align='center'>
				<?php echo $tmp->amount;?>
			</div>		
		</div>	
		<?php
			}
		}
		?>
		<!-- Main Row -->
</div>		
		
		


<div class='row'></div>
			<br><br>
		<div class="form-group">
		<div class="col-md-2 col-sm-2 col-xs-2" align='center'>
				
			</div>	
		
		<div class="col-md-2 col-sm-2 col-xs-2" align=''>
				Prepared By
			</div>	
			
		<div class="col-md-6 col-sm-6 col-xs-6" align='left'>
				<?php echo $invoice->preparedby?$invoice->preparedby:"-";?>
			</div>	
			</div>
<div class='row'></div>
<div class="form-group">
		<div class="col-md-2 col-sm-2 col-xs-2" align='center'>
				
			</div>	
		
		<div class="col-md-2 col-sm-2 col-xs-2" align=''>
				Authorized By
			</div>	
			
		<div class="col-md-6 col-sm-6 col-xs-6" align='left'>
				<?php echo $invoice->authorizedby?$invoice->authorizedby:"-";?>
			</div>	
			</div>



		
		
                    </div>
                    </div>
                </div>
				 </div>

    </div>
