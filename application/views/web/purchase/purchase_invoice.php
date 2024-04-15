<?php echo load_datatables(); ?>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
 <div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row" style="margin-bottom:1.5rem!important;">
                <div class="col-sm-6">
                    <h1>Purchase Invoice</h1>
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
								   <form id="purchaseorderform" data-parsley-validate class="form-horizontal form-label-left" method='post' action="<?php echo base_url()?>purchase/savepurchaseinvoice">
								<input type=hidden name='purchaseinvoiceid' value='<?php echo isset($details)?$details->purchaseinvoiceid:"";?>'>
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
                                            
                                               <input type="text" style='text-align: right;' id="issuedate" name="issuedate" required="required" class="datepicker form-control form-control-sm" value='<?php echo isset($details)?date("d-m-Y",strtotime($details->invoicedate)):"";?>'>
                                            </div>
                                        </div>	
											
										
											<div class="col-md-4">
										            <div class="form-group">
                                            <label class="form-check-label" for="customername">Order No <span class="required">*</span>
                                            </label>
                                            <div class="get-input d-flex" >
											<select id="orderno" name="orderno" class="form-control form-control-sm">
													<?php
													if(!empty($order_list)){
														echo "<option value=''>Select Order</option>";
														foreach($order_list as $tmp){
															echo "<option value='".$tmp->purchaseorderid."'>$tmp->purchaseordernum</option>";
														}														
													}else{
														echo "<option value=''>No Previous Order</option>";
													}
													?>
												</select>
												<div class="col-md-2">
                                               <a class='btn btn-success btn-sm' id='get_purchaseorder'>Get</a>
                                            </div>
											
											</div>
                                                
                                            </div>
											
                                        </div>
								      <div class="col-md-4">
										 <div class="form-group">
                                            <label class="form-check-label" for="customername">GRN No <span class="required">*</span>
                                            </label>
                                              <div class="get-input d-flex" >
                                                <select id="grnnumber" name="grnnumber" class="form-control form-control-sm">
													<?php
													if(!empty($grn_list)){
														echo "<option value=''>Select GRN</option>";
														foreach($grn_list as $tmp){
															echo "<option value='".$tmp->grnid."'>$tmp->grnnumber</option>";
														}						
													}else{
														echo "<option value=''>No Previous GRN</option>";
													}
													?>
												</select>
													<div class="col-md-2">
                                               <a class='btn btn-success btn-sm' id='get_purchasegrn'>Get</a>
                                            </div>
                                            </div>
										</div>
                                        </div>
										
										<div class="col-md-4">
										<div class="form-group">
                                            <label class="form-check-label" for="customername">Vendor <span class="required">*</span>
                                            </label>
                                            
                                               <input type=text class='form-control form-control-sm' name='customername' id='customername' readonly value='<?php echo isset($details)?get_contactname($details->customerid):"";?>'>
                                                <input type=hidden class='form-control form-control-sm' name='customerid' id='customerid' value='<?php echo isset($details)?$details->customerid:"";?>'>
                                            </div>
                                        </div>
											
									<br>
        <br>		                                        
 <div class='row'>
 <div class="col-md-12" style="background-color: darkslategrey;">
        <div class="form-group mb-0">	
			<div class='row'>
            <div class="col-md-2 text-white" align='center'>
			    Item Code
		  </div>			
			<div class="col-md-3 text-white" align='center'>
				Item Name
			</div>					
			<div class="col-md-2 text-white" align='center'>
				Quantity
			</div>
			<div class="col-md-2 text-white" align='center'>
				Unit Price
			</div>			
			<div class="col-md-2 text-white" align='center'>
				Amount
			</div>				
			  <div class="col-md-1">
			&nbsp;
		</div>
		</div>
</div>		
		</div>
        <!-- Main Row -->
        <div  id='firstLine' class="col-md-12 mt-3">
		<?php
		if(!isset($detailsrecords)){
		?>
		<div class="form-group">	
		  <div class='row'>
			<div class="col-md-2" align='center'>
				<input type=text class='form-control form-control-sm w-100 itemcode' name='itemcode[]' id='itemcode_1' readonly>
			</div>
			
			<div class="col-md-3" align='center'>
				<input type=text class='form-control form-control-sm w-100 itemname' name='itemname[]' id='itemname_1' readonly>
			</div>
			
			<div class="col-md-2" align='center'>
				<input type=text class='form-control form-control-sm quantity w-100' name='quantity[]' id='quantity_1' value='0' style='text-align: right;' readonly>
			</div>
			<div class="col-md-2" align='center'>
				<input type=text class='form-control form-control-sm unitprice w-100' name='unitprice[]' id='unitprice_1' value='0' style='text-align: right;' readonly>
			</div>
			
			<div class="col-md-2" align='center'>
				<input type=text class='form-control form-control-sm amount w-100' name='amount[]' id='amount_1' readonly style='text-align: right;' value='0'>
			</div>	
			  <div class="col-md-1">
			&nbsp;
		</div>
		</div>
		</div>	
		<?php }else{ ?>
			
			<?php 
			foreach($detailsrecords as $temp){				
			?>
			
		<div class="form-group">
         <div class='row'>					
		    <div class="col-md-2" align='center'>
				<input type=text class='form-control form-control-sm w-100 itemcode' name='itemcode[]' id='itemcode_1' value='<?php echo isset($temp)?get_itemcode($temp->itemcode):'';?>' readonly>
			</div>
			<div class="col-md-3" align='center'>
				<input type=text class='form-control form-control-sm itemname' name='itemname[]' id='itemname_1' readonly value='<?php echo isset($temp)?get_item($temp->itemcode):'';?>'>
			</div>
			
			<div class="col-md-2 col-sm-2 col-xs-2" align='center'>
				<input type=text class='form-control form-control-sm quantity' name='quantity[]' id='quantity_1' value='<?php echo isset($temp)?$temp->quantity:'';?>' style='text-align: right;' readonly>
			</div>
			<div class="col-md-2 col-sm-2 col-xs-2" align='center'>
				<input type=text class='form-control form-control-sm unitprice' name='unitprice[]' id='unitprice_1' value='<?php echo isset($temp)?$temp->unitprice:'';?>' style='text-align: right;' readonly>
			</div>
			
			<div class="col-md-2 col-sm-2 col-xs-2" align='center'>
				<input type=text class='form-control form-control-sm amount' name='amount[]' id='amount_1' readonly style='text-align: right;' value='<?php echo isset($temp)?$temp->amount:'';?>'>
			</div>	
			  <div class="col-md-1 col-sm-1 col-xs-1">
			&nbsp;
		</div>
		</div>
			<?php } ?>			
		<?php } ?>
		</div>
		<br>
<div class="row"></div>	

<div class="form-group col-md-12">
          <div class="row">		
			<div class="col-md-4"  align='center'>
				
			</div>		
			<div class="col-md-3 " align='center' style='margin-top:5px'>
	
			</div>
			<div class="col-md-1" align='center'>
				<!-- <input type=text class='form-control' style='text-align: right;' name='totalquantity' id='totalquantity' value='0' readonly>-->
			</div>
			<div class="col-md-1 mt-4" align='center'>
				Vat
			</div>
			
			<div class="col-md-2  mt-4" align='center'>
				 <input type="hidden" id="vat" name="vat" value="<?php echo $vat->vat;?>">
				<input type="text" class="form-control form-control-sm vat" name="vat" id="vat_amount"  style="text-align: right;" value="<?php echo isset($details)?$details->vat:'';?>">
			</div>
				</div>
		</div>	


		<!-- Main Row -->
		<div class="form-group col-md-12">
          <div class="row">		
			<div class="col-md-4"  align='center'>
				
			</div>		
			<div class="col-md-3 " align='center' style='margin-top:5px'>
	
			</div>
			<div class="col-md-1" align='center'>
				<!-- <input type=text class='form-control' style='text-align: right;' name='totalquantity' id='totalquantity' value='0' readonly>-->
			</div>
			<div class="col-md-1" align='center'>
				Total
			</div>
			
			<div class="col-md-2" align='center'>
				<input type=text class='form-control form-control-sm w-100 totalamount' name='totalamount' id='totalamount' readonly value='<?php echo isset($details)?$details->totalamount:'0';?>' style='text-align: right;'>
			</div>
				</div>
		</div>	
		
		</br>
		<div class="row col-md-12">
				
			<div class="col-md-5">   
                 <label class="form-check-label" for="customername"> Prepared By<span class="required">*</span></label>			
				<input type="text" id="preparedby" placeholder="Prepared By" name="preparedby" class="required form-control form-control-sm" value='<?php echo isset($details)?$details->preparedby:"";?>' >
			</div>				
		
			<div class="col-md-5">
			      <label class="form-check-label" for="customername"> Authorized By <span class="required">*</span></label>
				<input id="authorizedby" name="authorizedby" placeholder="Authorized By" class="required form-control form-control-sm" type="text" value='<?php echo isset($details)?$details->authorizedby:"";?>'>
			</div>				
		</div>
       </form>
      </div>
		                       <div class="form-group mt-4">
                                            <div class="col-md-12">
										
                                                <button type="submit" class="btn btn-success btn-sm">Submit</button>
												<button type="reset" class="btn btn-primary btn-sm">Cancel</button>
                                            </div>
                                        </div>	
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
	<?php
		$yeardata = get_defaultyeardata();
		if(!empty($yeardata)){
	?>
	$(".datepicker").datepicker({
		dateFormat: "dd-mm-yy",
		minDate: new Date('<?php echo !empty($yeardata)?$yeardata->startdate:"0";?>'),
		maxDate: new Date('<?php echo !empty($yeardata)?$yeardata->enddate:"0";?>'),
	});
	<?php
		}
	?>

	$("#get_purchaseorder").click(function(){
		
		$.ajax({
			url: "<?php echo base_url();?>purchase/get_invoiceusingorder",
			method: "POST",
			dataType: "json",
			data: {
				orderid: $("#orderno").val()
			},
			success: function( data ) {
				$("#customerid").val(data.customerid);
				$("#customername").val(data.customername);
				$("#vat_amount").val(data.vat);
				$("#totalamount").val(data.totalamount);
				
			}
		});
		
		$.ajax({
			url: "<?php echo base_url();?>purchase/get_invoicerecordsusingorder",
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
	
	
	$("#get_purchasegrn").click(function(){

		var total = 0;
		$("#firstLine").html("");
		$("#vat_amount").val("");
		$("#totalamount").val("");

		$.ajax({
			url: "<?php echo base_url();?>purchase/get_invoiceusinggrn",
			method: "POST",
			dataType: "json",
			data: {
				grnnumber: $("#grnnumber").val()
			},
			success: function( data ) {
				$("#customerid").val(data.customerid);
				$("#customername").val(data.customername);
				//$("#vat_amount").val(data.vat);
				//$("#totalamount").val(data.totalamount);
				
			}
		});
		
		$.ajax({
			url: "<?php echo base_url();?>purchase/get_invoicerecordsusinggrn",
			method: "POST",
			data: {
				grnnumber: $("#grnnumber").val()
			},
			success: function(data) {
				if($.trim(data) != ''){
					$("#firstLine").html(data);


					$(".totalamount").each(function(){
						if(parseFloat($(this).val()) > 0)
						total += parseFloat($(this).val());
					});

					var vat = (total * 7 / 100);
					
					$("#vat_amount").val(vat);
					$("#totalamount").val(vat+total);
				}
			}
		});
		
	});

});
</script>
