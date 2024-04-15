 <?php echo load_datatables(); ?>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
	<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row" style="margin-bottom:1.5rem!important;">
                <div class="col-sm-6">
                    <h1><?= $page_title ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">   
                    </ol>
                </div>
            </div>
			<div class="row">
				<div class="col-12">
					<div class="card">
						
						<div class="card-body">
						
								   <form id="purchaseorderform" data-parsley-validate class="form-horizontal form-label-left" method='post' action="<?php echo base_url()?>Accounts/savesalesgdn">
									<input type=hidden class='form-control' name='gdnid' value='<?php echo isset($invoice)?$invoice->gdnid:"";?>'>
										<div class="row">
											<div class="col-md-2">
												<div class="form-group">
													<label class="form-check-label">Invoice No <span class="text-required">*</span></label>
													<input type="text" style='text-align: right;' id="gdnnumber" name="gdnnumber" class="form-control form-control-sm" readonly value='<?php echo $gdnnumber?>'>
													
												</div>
											</div>
											
							
											<div class="col-md-3">
												<div class="form-group">
													<label class="form-check-label">Date <span class="text-required">*</span></label>
													 <input type="text" id="receiptdate" name="receiptdate" required="required" style='text-align: right;' class="datepicker form-control form-control-sm " required value='<?php echo isset($details)?date("d-m-Y",strtotime($details->issuedate)):"";?>'> 
												</div>
											</div>	
											
											
											
											<div class="col-md-3">
												<div class="form-group">
													<label class="form-check-label">Invoice No  <span class="text-required">*</span></label>
													   <div>
											   <?php if(isset($invoice)) { ?>
												<input type=text id="invoiceid" name="invoiceid" required="required" class="form-control form-control-sm" readonly value='<?php echo isset($invoice)?$invoice->ordernum:"";?>'>
												
											   <?php } else { ?>
                                               <select id="invoiceid" name="invoiceid" required="required" class="form-control form-control-sm">
												   	<?php
													if(!empty($invoice_list)){
														echo "<option value=''>Select Invoice</option>";
														foreach($invoice_list as $tmp){
															echo "<option value='".$tmp->salesinvoiceid."'>$tmp->invoicenumber</option>";
														}														
													}else{
														echo "<option value=''>No Previous Invoice</option>";
													}
													?>
											   </select>
											   <?php } ?>
                                            </div>
												</div>
												</div>
												<div class="col-md-1" style="margin-top:22px;">
												<?php if(!isset($invoice)) { ?>
                                               <a class='btn btn-success btn-sm' id='get_salesinvoice'>Get</a>
                                               <?php } ?>
                                            </div>
											
											<div class="col-md-3">
												<div class="form-group">
													<label class="form-check-label">Customer <span class="text-required">*</span></label>
													<input type="text" style='text-align: right;' id="customername" name="customername" class="form-control form-control-sm" readonly value='<?php echo isset($invoice)?get_contactname($invoice->customerid):"";?>'>
													<input type=hidden class='form-control' name='customerid' id='customerid' value='<?php echo isset($invoice)?$invoice->customerid:"";?>'>
													
												</div>
											</div>
                                            
											</div>
												
			</br>								                                        
 <div class='row'>
 <div class="col-md-12" style="background-color: darkslategrey;padding: 5px;">
    <div class="form-group mb-0">
        <div class="row">
            <div class="col-md-1 text-white" align='center'>
                S.No
            </div>
			<div class="col-md-2 text-white"  align='center'>
                Item Code
            </div>
            <div class="col-md-3 text-white"  align='center'>
                Item Name
            </div>
            <div class="col-md-2 text-white" align='center'>
                Unit Price
            </div>
            <div class="col-md-2 text-white" align='center'>
                Quantity
            </div>
            <div class="col-md-2 text-white" align='center'>
                Dispatched
            </div>
        </div>
    </div>
</div>

		
        <!-- Main Row -->
        <div  id='firstLine' class="col-md-12 mt-3">
		<?php if(!isset($invoicerecords)) { ?>
		
		<div class="form-group">	
		 <div class="row">
			<div class="col-md-1" align='center'>
				1
			</div>	
            <div class="col-md-2 text-center">
				<input type="text" name='itemcode[]' readonly class="itemcode form-control-sm w-100" id='itemcode_1' value=''>
			</div>			
			
			<div class="col-md-3 text-center">
				<input type="text" name='itemname[]' readonly class="itemname form-control-sm w-100" id='itemname_1' value=''>
			</div>
			<div class="col-md-2 ">
				<input type="text" name="unitprice[]" id='unitprice_1' style='text-align: right;' readonly class="w-100 unitprice form-control-sm" value='0'>
			</div>
			<div class="col-md-2">
			<input type="text" name="quantity[]"  id='quantity_1' style='text-align: right;' class="w-100 quantity form-control-sm" readonly value='0'>
			
			</div>
			
			<div class="col-md-2">
				<input type="text" name="dispatched[]" id='dispatched_1' style='text-align: right;' readonly class="w-100 dispatched form-control-sm"  value='0'>
			</div>	
           		
			</div>
		</div>
		<?php }else { 
				$i = 0;
				foreach($invoicerecords as $temp){				
		?>
			<div class="form-group">
               <div class="row">			
				<div class="col-md-1" align='center'>
					<?php echo ++$i;?>
				</div>	
                <div class="col-md-2 text-center">
				<input type="text" name='itemcode[]' readonly class="itemcode form-control-sm w-100" id='itemcode_1' value='<?php echo isset($temp)?get_itemcode($temp->itemcode):"";?>'>
			     </div>				
				
				<div class="col-md-3">
					<input type="text" name='itemname[]' class="itemname form-control-sm w-100"id='itemname_1' readonly value='<?php echo isset($temp)?get_item($temp->itemname):"";?>'>
					
				</div>
				<div class="col-md-2">
					<input type="text" name='unitprice[]' readonly id='unitprice_1' style='text-align: right;' class="quantity form-control-sm w-100" value='<?php echo isset($temp)?$temp->unitprice:"";?>'>
				</div>
				<div class="col-md-2">
					<input type="text" name="quantity[]"  id='quantity_1' style='text-align: right;' class="quantity form-control-sm w-100" readonly value='<?php echo isset($temp)?$temp->quantity:"";?>'>
				</div>
				
				<div class="col-md-2">
					<input type="text" name="dispatched[]" id='dispatched_1' readonly style='text-align: right;' class="amount form-control-sm w-100" value='<?php echo isset($temp)?$temp->amount:"";?>'>
				</div>			
			</div>
			</div>
			
			
			<?php } ?>	
<?php } ?>			
		
		</div>
		<br>

<!-- Main Row -->
<div class="col-md-12">
	  <div class="form-group">
          <div class="row">		
			<div class="col-md-1"  align='center'>
				
			</div>		
			<div class="col-md-5 mt-4" align='center' style='margin-top:5px'>
				
			</div>
			<div class="col-md-2 mt-2" align='center'>
				VAT
			</div>
			<div class="col-md-2 " align='center'>
				
			</div>
			
			<div class="col-md-2 " align='center'>
				<input type=text class='form-control form-control-sm vat' name='vat' id='vat' readonly value='0' style='text-align: right;' value='<?php echo isset($invoice)?$invoice->vat:"0";?>'>
			</div>
			
			 </div>
				
		</div>	
		</div>
	  
</br>
		<!-- Main Row -->
		<div class="col-md-12">
		<div class="form-group">
          <div class="row">		
			<div class="col-md-1"  align='center'>
				
			</div>		
			<div class="col-md-5 mt-4" align='center' style='margin-top:5px'>
				
			</div>
			<div class="col-md-2 mt-2" align='center'>
				Grand Total
			</div>
			<div class="col-md-2 " align='center'>
				<input type=text class='form-control form-control-sm totalquantity' style='text-align: right;' name='totalquantity' id='totalquantity' value='<?php echo isset($invoice)?$invoice->totalamount:"0";?>' readonly>
			</div>
			
			<div class="col-md-2 " align='center'>
				<input type=text class='form-control form-control-sm totaldispatched' style='text-align: right;' name='totaldispatched' id='totaldispatched' value='<?php echo isset($invoice)?$invoice->totalamount:"0";?>' readonly>
			</div>
			
			 </div>
				
		</div>	
		</div>
		<br>&nbsp;&nbsp;&nbsp;
		
		
		<div class="col-md-12">
		<div class="row" style="margin-left:20px;">
			<div class="col-md-6">
			<div class="form-group">
			<label class="form-check-label">Prepared By<span class="text-required">*</span></label>
			<input type=text class='form-control form-control-sm w-100' name='preparedby' id='preparedby' value='<?php echo isset($preparedby)?$preparedby:"";?>'>
			</div>
		</div>
											
							
		<div class="col-md-6">
			<div class="form-group">
			<label class="form-check-label">Authorized By <span class="text-required">*</span></label>
		   <input type=text class='form-control form-control-sm' placeholder='Received By' name='authorizedby' id='authorizedby' value='<?php echo isset($authorizedby)?$authorizedby:"";?>'>
			</div>
			</div>	
		</div>
		</div>
		
</div>
     							    </br>
									  </br>
									   
                                        <div class="form-group">
                                            <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-3">
                                                <button type="submit" class="btn btn-success btn-sm">Submit</button>
												<button type="reset" class="btn btn-primary btn-sm">Cancel</button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
				</div>
				</form>
						
							
								
					
								
							
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
	

	$("#get_salesinvoice").click(function(){
	
		$.ajax({
			url: "<?php echo base_url();?>Accounts/get_invoiceusinggdn",
			method: "POST",
			dataType: "json",
			data: {
				invoiceid: $("#invoiceid").val()
			},
			success: function( data ) {
				//print_r(data);
				$("#customerid").val(data.customerid);
				$("#customername").val(data.customername);
				$("#totalquantity").val(data.quantity);
				
				
			//var vat = Math.round(data.totalamount*vat/100);
				//$("#vat").val(vat);	
				
				//$("#totaldispatched").val(parseFloat(data.totaldispatched) + parseFloat(vat))
				
			}
		});
		
		
		$.ajax({
			url: "<?php echo base_url();?>Accounts/get_invoicerecordsusinggdn",
			method: "POST",
			data: {
				invoiceid: $("#invoiceid").val()
			},
			success: function(data) {
				if($.trim(data) != '')
					$("#firstLine").html(data);
			}
		});
		
	});
	
	$(document).on("keyup",".dispatched",function(){
		
			var id = $(this).attr("id");
			id = id.split("_");
			
			if(parseInt($("#quantity_"+id[1]).val()) < parseInt($(this).val())){
				$(this).val("0");
			}		
		
		
			dispatched = 0;
			$(".dispatched").each(function(){
				if($(this).val() != '')
					dispatched = dispatched + parseInt($(this).val());
			});
			
			$("#totaldispatched").val(dispatched);
	});
	$(document).on("change",".dispatched",function(){
		
			var id = $(this).attr("id");
			id = id.split("_");
			
			if(parseInt($("#quantity_"+id[1]).val()) < parseInt($(this).val())){
				$(this).val("0");
			}		
		
		
			dispatched = 0;
			$(".dispatched").each(function(){
				if($(this).val() != '')
					dispatched = dispatched + parseInt($(this).val());
			});
			
			$("#totaldispatched").val(dispatched);
	});
	
	


});
</script>

