<?php echo load_datatables(); ?>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row" style="margin-bottom:1.5rem!important;">
                <div class="col-sm-6">
                    <h1>Sales Invoice</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">HR</a></li>
                        <li class="breadcrumb-item active"><a href="#">Purchase Order</a></li>
                    </ol>
                </div>
            </div>
			<div class="row">
				<div class="col-12">
					<div class="card">
					
						<div class="card-body">
						
							
								  <form id="purchaseorderform" data-parsley-validate class="form-horizontal form-label-left" method='post' action="<?php echo base_url()?>sales/savesalesinvoice">
                                    
							     <input type=hidden class='form-control' name='salesinvoiceid' value='<?php echo isset($invoice)?$invoice->salesinvoiceid:"";?>'>
										<div class="row">
										<div class="col-md-4">
										<div class="form-group">
                                            <label class="form-check-label" for="customername">Invoice No <span class="required">*</span>
                                            </label>
                                            
                                                <input type="text" style='text-align: right;' readonly id="invoicenumber" name="invoicenumber" required="required" class="form-control form-control-sm" value='<?php echo $invoicenumber?>'>
                                            </div>
                                        </div>	
										<div class="col-md-4">
										<div class="form-group">
                                            <label class="form-check-label" for="customername">Invoice Date <span class="required">*</span>
                                            </label>
                                            
                                               <input type="text" style='text-align: right;' id="issuedate" name="issuedate" required="required" class="datepicker form-control form-control-sm" value='<?php echo isset($invoice)?date("d-m-Y",strtotime($invoice->invoicedate)):date("d-m-Y")?>'>
                                        </div>
                                        </div>	
											
										
								
											<div class="col-md-4">
										            <div class="form-group">
                                            <label class="form-check-label" for="customername">Order No <span class="required">*</span>
                                            </label>
                                            <div class="get-input d-flex" >
														<?php if(isset($invoice)) { ?>
													<input type='text' id="orderno" name="orderno" class="form-control form-control-sm" readonly value='<?php echo isset($invoice)?$invoice->ordernum:"";?>'>
												<?php }else { ?>
                                                <select id="orderno" name="orderno" class="form-control form-control-sm">
													<?php
													if(!empty($order_list)){
														echo "<option value=''>Select Order</option>";
														foreach($order_list as $tmp){
															echo "<option value='".$tmp->salesorderid."'>$tmp->salesordernum</option>";
														}														
													}else{
														echo "<option value=''>No Previous Order</option>";
													}
													?>
												</select>
												<?php } ?>
												<div class="col-md-2">
                                               	<?php if(!isset($invoice)) { ?> 
											    <a class='btn btn-success btn-sm' id='get_salesorder'>Get</a>
                                               <?php } ?>
                                            </div>
											
											</div>
                                                
                                            </div>
											
                                        </div>
								      <div class="col-md-4">
										 <div class="form-group">
                                            <label class="form-check-label" for="customername">Customer <span class="required">*</span>
                                            </label>
                                              <div class="get-input d-flex" >
                                                <input type=text class='form-control form-control-sm' name='customername' id='customername' readonly value='<?php echo isset($invoice)?get_contactname($invoice->customerid):"";?>'>
                                                <input type=hidden class='form-control form-control-sm' name='customerid' id='customerid' value='<?php echo isset($invoice)?$invoice->customerid:"";?>'>
												
                                            </div>
										</div>
                                        </div>
											
									                 
 <div class='row'>
 <div class="col-md-12" style="background-color: darkslategrey;">
        <div class="form-group mb-0">	
		 <div class='row'>
			<div class="col-md-1 text-white" style="text-align:center">
				s.no
			</div> 
            
			<div class="col-md-3  text-white" align='center'>
				Item Code
			</div>
			
			<div class="col-md-4  text-white" align='center'>
				Item Name
			</div>					
			<div class="col-md-1 text-white" align='center'>
				Unit Price
			</div>
			<div class="col-md-1 text-white" align='center'>
			Quantity
			</div>			
			<div class="col-md-1 text-white" align='center'>
				Amount
			</div>				
			 <div class="col-md-1 text-white">
				&nbsp;
			</div> 
		</div>
        </div>
	</div>
        <!-- Main Row -->
        <div  id='firstLine' class="mt-3 col-md-12">
		<?php if(!isset($invoicerecords)) { ?>
		<div class="form-group mb-0">
 <div class='row'>		
		   <div class="col-md-1" style="text-align:center">
			1
		  </div>
		    <div class="col-md-3" align='center'>
				<input type=text class='form-control form-control-sm w-100 itemcode' name='itemcode[]' id='itemcode_1' readonly>
			</div>
		    
			<div class="col-md-4" align='center'>
				<input type=text class='form-control form-control-sm w-100 itemname' name='itemname[]' id='itemname_1' readonly>
			</div>
			
			<div class="col-md-1" align='center'>
				<input type=text class='form-control form-control-sm quantity w-100' name='quantity[]' id='quantity_1' value='0' style='text-align: right;' readonly>
			</div>
			<div class="col-md-1" align='center'>
				<input type=text class='form-control form-control-sm unitprice w-100' name='unitprice[]' id='unitprice_1' value='0' style='text-align: right;' readonly>
			</div>
			
			<div class="col-md-1" align='center'>
				<input type=text class='form-control form-control-sm amount w-100' name='amount[]' id='amount_1' readonly style='text-align: right;' value='0'>
			</div>	
			<div class="col-md-1">
			&nbsp;
		  </div>
		</div>	
		</div>
		<?php }else{ ?>
			
			<?php 
			foreach($orderrecords as $temp){				
			?>
			
			<div class="form-group">
            <div class='row'>					
		 <div class="col-md-1 mb-4" style="text-align:center">
				<?php echo ++$i;?>
			  </div>
			<div class="col-md-3" align='center'>
				<input type=text class='form-control form-control-sm itemcode' name='itemncode[]' id='itemncode_1' readonly value='<?php echo isset($temp)?get_itemcode($temp->itemcode):'';?>'>
			</div>
			
			<div class="col-md-4" align='center'>
				<input type=text class='form-control form-control-sm itemname' name='itemname[]' id='itemname_1' value='<?php echo isset($temp)?$temp->itemname:'';?>' style='text-align: right;' readonly>
			</div>
			
			<div class="col-md-1" align='center'>
				<input type=text class='form-control form-control-sm quantity' name='quantity[]' id='quantity_1' value='<?php echo isset($temp)?$temp->quantity:'';?>' style='text-align: right;' readonly>
			</div>
			<div class="col-md-1" align='center'>
				<input type=text class='form-control form-control-sm unitprice' name='unitprice[]' id='unitprice_1' value='<?php echo isset($temp)?$temp->unitprice:'';?>' style='text-align: right;' readonly>
			</div>
			
			<div class="col-md-1" align='center'>
				<input type=text class='form-control form-control-sm amount' name='amount[]' id='amount_1' readonly style='text-align: right;' value='<?php echo isset($temp)?$temp->amount:'';?>'>
			</div>	
			  <div class="col-md-1 ">
			&nbsp;
		</div>
		</div>
			</div>
			
			<?php } ?>			
		<?php } ?>	
		</div>
		<br>
<div class="row"></div>	
<!-- Main Row -->
<div class="col-md-12 mt-3 ">
	  <div class="form-group">
          <div class="row">		
			<div class="col-md-4"  align='center'>
				
			</div>		
			<div class="col-md-3" align='center' style='margin-top:5px'>
				
			</div>
			<div class="col-md-1" align='center'>
			
			</div>
			<div class="col-md-1 mt-2" align='center'>
				VAT
			</div>
			
		  <div class="col-md-2" align='center'>
			
			<input type=text
				class='form-control form-control-sm w-100 vat' name='vat' id='vat' readonly style='text-align: right;' value="<?php echo isset($invoice)?$invoice->vat:'';?>">
			</div>
			 </div>
				
		</div>	
		</div>
		
		<!-- Main Row -->
		<div class="form-group col-md-12">
         <div class="row">		
			<div class="col-md-4"  align='center'>
				
			</div>		
			<div class="col-md-3 mt-4" align='center' style='margin-top:5px'>
				
			</div>
			<div class="col-md-1" align='center'>
				<!-- <input type=text class='form-control' style='text-align: right;' name='totalquantity' id='totalquantity' value='0' readonly>-->
			</div>
			<div class="col-md-1" align='center'>
				Total
			</div>
			
			<div class="col-md-2" align='center'>
				<input type=text class='form-control form-control-sm w-100 totalamount' name='totalamount' id='totalamount' readonly value='<?php echo isset($invoice)?$invoice->totalamount:'';?>' style='text-align: right;'>
			</div>
				
		</div>
		
		
		
		<div class="col-md-12 mt-5">
			<div class="row">
		<div class="col-md-6">
			
				
			<div class="form-group">
				<label class="form-check-label" for="customername">Validity Period
				</label>
			
					<input type='text' class='form-control form-control-sm' name='validityperiod' value="<?php if(isset($quotedetails)){ echo $quotedetails->validityperiod;}?>">
		
			</div>			
	</div>
	<div class="col-md-6">
			<div class="form-group ">
				<label class="form-check-label" for="customername">Delivery Period
				</label>

					<input type='text' class='form-control form-control-sm' name='deliveryperiod' value="<?php if(isset($quotedetails)){ echo $quotedetails->deliveryperiod;}?>">
			</div>
			</div>

				<div class="col-md-6">
			 <div class="form-group">
                   <label class="form-check-label" for="customername">Prepared By <span class="required">*</span>
                    </label>
                                           
                   <input type="text" id="preparedby" name="preparedby" class="required form-control form-control-sm" value='<?php if(isset($invoice)){ echo $invoice->preparedby;}?>'>
                                           
                                        </div>
         </div>
		 <div class="col-md-6">
                   <div class="form-group">
                       <label for="website" class="form-check-label">Authorized By  <span class="required">*</span></label>
                                           
                      <input id="authorizedby" name="authorizedby" class="required form-control form-control-sm" type="text" value='<?php if(isset($invoice)){ echo $invoice->authorizedby;}?>'>
                                          
                                        </div>										
		</div>
					<div class="col-md-12">
					<div class="form-group">
				<label class="form-check-label" for="customername">Payment Terms and Conditions
				</label>
				
					<textarea class='form-control form-control-sm' name='otherterms' id="terms"><?php if(isset($quotedetails)){ echo $quotedetails->otherterms;}?></textarea>
				
			</div>
			</div>
			</div>
			</div>			
            </div>
<br>
<br>			
                                      
                                        <div class="form-group">
                                            <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-3">
										
                                                <button type="submit" class="btn btn-success btn-sm">Submit</button>
												<button type="reset" class="btn btn-primary btn-sm">Cancel</button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                                </div>
							</div>
							</div>
						</div>
					
</div>
    </section>
</div>

<script>
$(document).ready(function(){
	
	$(".datepicker").datepicker({
		dateFormat: "dd-mm-yy"
	});
	

	$("#get_salesorder").click(function(){
		
		$.ajax({
			url: "<?php echo base_url();?>sales/get_invoiceusingorder",
			method: "POST",
			dataType: "json",
			data: {
				orderid: $("#orderno").val()
			},
			success: function( data ) {
				$("#customerid").val(data.customerid);
				$("#customername").val(data.customername);
				$("#vat").val(data.vat);
				$("#totalamount").val(data.totalamount);
				
							$("#validityperiod").val(data.validityperiod);
							$("#paymentterms").val(data.paymentterms);
							$("#deliveryperiod").val(data.deliveryperiod);
							$("#otherterms").val(data.otherterms);
							
							
				
			}
		});
		
		$.ajax({
			url: "<?php echo base_url();?>sales/get_invoicerecordsusingorder",
			method: "POST",
			data: {
				orderid: $("#orderno").val()
			},
			success: function(data) {
				if($.trim(data) != '')
					$("#firstLine").html(data);
			}
		});
		
	});
	
	


});
</script>

