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

                    <div class="row">
						<div class="x_content">
							
							<div class='col-md-12 col-sm-12 col-xs-12'>
                                  <br>
										<div class="form-group col-md-4 col-sm-4 col-xs-4">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-4" for="customername">Order No <span class="required">*</span>
                                            </label>
                                            <div class="col-md-8 col-sm-8 col-xs-8">
                                               <?php echo $order->salesordernum ?>
                                            </div>
                                        </div>	
                                        
                                       <div class="form-group col-md-4 col-sm-4 col-xs-4">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-4" for="customername">Issue Date <span class="required">*</span>
                                            </label>
                                            <div class="col-md-8 col-sm-8 col-xs-8">
                                               <?php echo $order->issuedate ?>
                                            </div>
                                        </div>	

                                        
                                        <div class="form-group col-md-4 col-sm-4 col-xs-4">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-4" for="customername">Delivery Date <span class="required">*</span>
                                            </label>
                                            <div class="col-md-8 col-sm-8 col-xs-8">
                                               <?php echo $order->deliverydate ?>
                                            </div>
                                        </div>	
                                        
                                        <div class="form-group col-md-4 col-sm-4 col-xs-4">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-4" for="customername">Customer <span class="required">*</span>
                                            </label>
                                            <div class="col-md-8 col-sm-8 col-xs-8">
                                                  <?php echo get_contactname($order->customer) ?>
                                            </div>
                                        </div>
                                        </div>
						
						
						
						<br>
						
						
<div class="col-md-11 col-sm-11 col-xs-11">
        <div class="form-group" style='background:#1a82c3;color:#fff;font-weight:bold;height:33px;padding-top:7px'>	
			<div class="col-md-4 col-sm-4 col-xs-4" align='center'>
				Item Name
			</div>					
			<div class="col-md-3 col-sm-3 col-xs-3" align='center'>
				Description
			</div>
			<div class="col-md-1 col-sm-1 col-xs-1" align='center'>
				Quantity
			</div>
			
			<div class="col-md-2 col-sm-2 col-xs-2" align='center'>
				Rate
			</div>	
			<div class="col-md-2 col-sm-2 col-xs-2" align='center'>
				Total
			</div>				
		</div>	
		<!-- Main Row -->
		<?php
		if(!empty($orderrecords)){
			foreach($orderrecords as $tmp){
		?>
		<div class="form-group">	
			<div class="col-md-4 col-sm-4 col-xs-4" align='center'>
				<?php echo get_item($tmp->itemname);?>
			</div>					
			<div class="col-md-3 col-sm-3 col-xs-3" align='center'>
				<?php echo $tmp->description;?>
			</div>
			
			<div class="col-md-1 col-sm-1 col-xs-1" align='center'>
				<?php echo $tmp->quantity;?>
			</div>
			<div class="col-md-2 col-sm-2 col-xs-2" align='center'>
				<?php echo $tmp->unitprice;?>
			</div>	
			<div class="col-md-2 col-sm-2 col-xs-2" align='center'>
				<?php echo $tmp->amount;?>
			</div>	
		</div>	
		<?php
			}
		}
		?>
		<!-- Main Row -->
</div>		
		
		<div class="form-group">
		<div class="col-md-9 col-sm-9 col-xs-9" align='center'>
				
			</div>	
		
		<div class="col-md-2 col-sm-2 col-xs-2" align='center'>
				<?php echo $order->totalamount;?>
			</div>	
			</div>	
			
			<div class='row'></div>
			<br><br>
		<div class="form-group">
		<div class="col-md-2 col-sm-2 col-xs-2" align='center'>
				
			</div>	
		
		<div class="col-md-2 col-sm-2 col-xs-2" align='center'>
				Authorized By
			</div>	
			
		<div class="col-md-2 col-sm-2 col-xs-2" align='center'>
				<?php echo $order->authorizedby?$order->authorizedby:"-";?>
			</div>	
			</div>
		
		
                    </div>
                    </div>
                </div>
				 </div>

    </div>
