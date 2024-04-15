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
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active"><a href="<?php echo base_url() ?>Purchase/purchaseorder">Purchase Order</a></li>
                    </ol>
                </div>
            </div>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
								   <form id="purchaseorderform" data-parsley-validate class="form-horizontal form-label-left" method='post' action="<?php echo base_url()?>purchase/savepurchaseorder">
									<input type=hidden name='purchaseorderid' value='<?php echo isset($details)?$details->purchaseorderid:"";?>'>
										<div class="row">
											<div class="col-md-3">
												<div class="form-group">
													<label class="form-check-label">Order No <span class="text-required">*</span></label>
													<input type="text"  id="ordernum" name="ordernum" style='text-align: right;' readonly class="form-control form-control-sm" value='<?php echo $ordernum ?>'>
												</div>
											</div>
											
								<div class="col-md-3">
							<div class="form-group">
								<label class="form-check-label">Quote No  <span class="text-required">*</span></label>
								          <?php
											if(isset($details)){
												?>
												<input type="text" id="quotenumber" name="quotenumber"  class="form-control form-control-sm " value='<?php echo isset($details)?$details->purchaseordernum:""; ?>'>
												<?php
												}else{
												?>
                                                <select autocomplete='off' id="quotenumber" name="quotenumber" class="form-control form-control-sm">													
													<?php
													if(!empty($quote_list)){
														echo "<option value=''>Select Quote</option>";
														foreach($quote_list as $tmp){
															echo "<option value='".$tmp->purchasequoteid."'>$tmp->quotenumber</option>";
														}														
													}else{
														echo "<option value=''>No Previous Quote</option>";
													}
													?>
												</select>
												<?php 
												}
												?>
							               </div>
										   	<div class="col-md-1 col-sm-2 col-xs-2" style='display:none'>
                                               <a class='btn btn-success' id='get_purchasequote'>Get</a>
                                            </div>
					                      </div>
											<div class="col-md-3">
												<div class="form-group">
													<label class="form-check-label">Issue Date <span class="text-required">*</span></label>
													 <input type="text" id="issuedate" name="issuedate" required="required" class="datepicker1 form-control form-control-sm " value='<?php echo isset($details)?date("d-m-Y",strtotime($details->issuedate)):"";?>'> 
												</div>
											</div>	
													<div class="col-md-3">
												<div class="form-group">
													<label class="form-check-label">Delivery Date<span class="text-required">*</span></label>
													 <input id="deliverydate" autocomplete='off' style='text-align: right;' name="deliverydate" required class="datepicker2 required form-control form-control-sm" type="text" value='<?php echo isset($details)?date("d-m-Y",strtotime($details->deliverydate)):"";?>'>
												</div>
											</div>
										
											<div class="col-md-3">
												<div class="form-group">
													<label class="form-check-label">Vendor<span class="text-required">*</span></label>
													<select id="supplier" name="supplier" class="required form-control form-control-sm" required>
													<option value=''>Choose..</option>
													<?php
													if(!empty($suppliers)){
														foreach($suppliers as $tmp){
															if(isset($details) && $details->supplier == $tmp->contactid)
															echo "<option selected value='$tmp->contactid'>$tmp->customername</option>";
															else
															echo "<option value='$tmp->contactid'>$tmp->customername</option>";
														}
													}
													?>
												</select>
												</div>
											</div>	
											</div>
								
											
 <div class="row">
 <div class="col-md-12" style="background-color: darkslategrey;padding: 5px;">
        <div class="form-group mb-0">
			<div class="row">
			<div class="col-md-2 text-white" align='center'>
				Item Code
			</div>
            <div class="col-md-3 text-white" align='center'>
				Item Name
			</div>				
			<div class="col-md-3 text-white" align='center'>
				Description
			</div>
			<div class="col-md-1 text-white" align='center'>
				Quantity
			</div>
			<div class="col-md-1 text-white" align='center'>
				Unit Price
			</div>
			
			<div class="col-md-1 text-white" align='center'>
				Amount
			</div>	
			<div class="col-md-1" align='center'>
			<a style='cursor:pointer;padding:0px 0px;color:#FFFFFF' style="padding: 0px;" id='addNew' class="btn-sm">[Add row]</a>
			</div>	
		</div>	
		</div>
		</div>
        <!-- Main Row -->
        <div  id='firstLine' class="col-md-12 mt-3">
		<?php
		if(!isset($detailsrecords)){
		?>
		<div class="form-group" style="margin-bottom:0px !important">
         <div class="row">		
			<div class="col-md-2" align='center'>
				<select name="itemcode[]" id='itemcode_1' class="itemcode form-control form-control-sm w-100">
					<option value=''>Choose..</option>
					<?php
					if(!empty($itemmaster)){
						foreach($itemmaster as $tmp){
							echo "<option value='$tmp->itemid'>$tmp->itemcode</option>";
						}
					}
					?>
				</select>
			</div>

             <div class="col-md-3" align='center'>
				<input name="itemname[]" id='itemname_1' class="itemname form-control form-control-sm w-100" value=''>
			</div>				

			<div class="col-md-3 text-center">
				<input type="text" name='description[]' class="description form-control form-control-sm w-100" value='' style="margin-right: 0px; width:80%;">
			</div>
			<div class="col-md-1 text-center">
				<input type="text" name='quantity[]'  id='quantity_1' style='text-align: right;' class="quantity form-control form-control-sm w-100" onkeypress="return isNumberKeyPeriod(event)" value='0'>
			</div>
			<div class="col-md-1 text-center">
				<input type="text" name="unitprice[]"  id='unitprice_1' style='text-align: right;' readonly class="unitprice w-100 form-control form-control-sm" onkeypress="return isNumberKeyPeriod(event)" value='0'>
			</div>
			
			<div class="col-md-1 text-center">
				<input type="text" name="amount[]" id='amount_1' style='text-align: right;' readonly class="w-100 amount form-control form-control-sm" onkeypress="return isNumberKeyPeriod(event)" value='0'>
			</div>			
			</div>
		</div>
		<?php }else{ ?>
			
			<?php 
			foreach($detailsrecords as $temp){				
			?>
			
			<div class="form-group">
            <div class="row">				
			<div class="col-md-2" align='center'>
				<select name="itemcode[]" id='itemcode_1' class="itemcode form-control form-control-sm w-100">
				<option value=''>Choose..</option>
				<?php
					if(!empty($itemmaster)){
						foreach($itemmaster as $tmp){
							if($tmp->itemid == $temp->itemcode)
								echo "<option selected value='$tmp->itemid'>$tmp->itemcode</option>";
							else
								echo "<option value='$tmp->itemid'>$tmp->itemcode</option>";
						}
					}
					?>
				</select>
				</div>	

                 <div class="col-md-3" align='center'>
				<input name="itemname[]" id='itemname_1' class="itemname form-control form-control-sm w-100" value="<?php echo isset($temp)?$temp->itemname:'';?>">
			    </div>				
				
				<div class="col-md-3 text-center">
					<input type="text" name='description[]' class="description form-control form-control-sm w-100" value="<?php echo isset($temp)?$temp->description:'';?>" style="margin-right: 0px; width:80%;">
				</div>
				<div class="col-md-1 text-center">
					<input type="text" name='quantity[]'  id='quantity_1' style='text-align: right;' class="quantity form-control form-control-sm w-100" onkeypress="return isNumberKeyPeriod(event)" value="<?php echo isset($temp)?$temp->quantity:'';?>">
				</div>
				<div class="col-md-1 text-center">
					<input type="text" name="unitprice[]"  id='unitprice_1' style='text-align: right;' readonly class="unitprice w-100 form-control form-control-sm" onkeypress="return isNumberKeyPeriod(event)" value="<?php echo isset($temp)?$temp->unitprice:'';?>">
				</div>
				
				
			<div class="col-md-1 text-center">
					<input type="text" name="amount[]" id='amount_1' style='text-align: right;' readonly class="w-100 amount form-control form-control-sm" onkeypress="return isNumberKeyPeriod(event)" value="<?php echo isset($temp)?$temp->amount:'';?>">
				</div>			
		
			</div>
			</div>
			<?php } ?>			
		<?php } ?>	
		</div>
		
<div class="row"></div>	
<div class="form-group col-md-12">
          <div class="row">		
			<div class="col-md-4"  align='center'>
				
			</div>		
			<div class="col-md-3" align='center' style='margin-top:5px'>
				
			</div>
			<div class="col-md-1" align='center'>
				<!-- <input type=text class='form-control' style='text-align: right;' name='totalquantity' id='totalquantity' value='0' readonly>-->
			</div>
			<div class="col-md-1 mt-4" align='center'>
				VAT
			</div>
			
			<div class="col-md-2 mt-4" align='center'>
				<input type="hidden" id="vat" name="vat" value="<?php echo $vat->vat;?>">
				<input type="text" class="form-control" name="vat" id="vat_amount" readonly style="text-align: right;" value="<?php echo isset($details)?$details->vat:'0';?>">
			</div>
				</div>
		</div>	

		<!-- Main Row -->
		<div class="form-group col-md-12">
          <div class="row">		
			<div class="col-md-4"  align='center'>
				
			</div>		
			<div class="col-md-3" align='center' style='margin-top:5px'>
				
			</div>
			<div class="col-md-1" align='center'>
				<!-- <input type=text class='form-control' style='text-align: right;' name='totalquantity' id='totalquantity' value='0' readonly>-->
			</div>
			<div class="col-md-1" align='center'>
				Total
			</div>
			
			<div class="col-md-2" align='center'>
				<input type=text class='form-control' style='text-align: right;' name='totalamount' id='totalamount' value="<?php echo isset($details)?$details->totalamount:'0';?>"readonly>
			</div>
				</div>
		</div>	
		
		<div class="row col-md-12 mt-3">
			
			<div class="col-md-6">
			     <label class="form-check-label"> Terms & Conditions <span class="text-required">*</span></label>
				<textarea class='form-control' placeholder='Terms & Conditions' name='terms' id='terms'><?php echo isset($details)?$details->terms:'';?></textarea>
			</div>				
	
			<div class="col-md-6">
			 <label class="form-check-label"> Authorized By <span class="text-required">*</span></label>
				<input type=text class='form-control' placeholder='Authorized By' name='authorizedby' id='authorizedby' value="<?php echo isset($details)?$details->authorizedby:'';?>">
			</div>				
		</div>
		</r>
		</br>

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
				</form>
		
							</div>
							</div>
						</div>
					</div>

    </section>
</div>
	

          <script>
            $(document).ready(function () {
		
				
				row = 1;
				$("#addNew").click(function(){
					 row++;
					 $.ajax({
					  url: "<?php echo base_url();?>Purchase/get_purchaseorderrow",
					  type:"POST",
					  data: {
						rowid:row
					  },
					  success: function( data ) {
						  $("#firstLine").append(data);		
					  }
					});
				});
				
				$("#quotenumber").change(function(){
					$("#get_purchasequote").trigger("click");
				});
				
				$("#get_purchasequote").click(function(){
					
					$.ajax({
						url: "<?php echo base_url();?>Purchase/get_purchasequotedetails",
						method: "POST",
						dataType: "json",
						data: {
							quoteid: $("#quotenumber").val()
						},
						success: function( data ) {
							$("#supplier").val(data.customerid);
							$("#totalamount").val(data.totalamount);
							$("#vat_amount").val(data.vat);
							
							row = data.total_quo;
						}
					});
					
					$.ajax({
						url: "<?php echo base_url();?>Purchase/get_purchasequoterecords",
						method: "POST",
						data: {
							quoteid: $("#quotenumber").val()
						},
						success: function(data) {
							if($.trim(data) != '')
								$("#firstLine").html(data);
							//$("#addNew").hide();
						}
					});
					
				});
				<?php
					$yeardata = get_defaultyeardata();
					if(!empty($yeardata)){
				?>
				$(".datepicker1").datepicker({
					dateFormat: "dd-mm-yy",
					minDate: new Date('<?php echo !empty($yeardata)?$yeardata->startdate:"0";?>'),
					maxDate: new Date('<?php echo !empty($yeardata)?$yeardata->enddate:"0";?>'),
					onSelect: function (selected) {
						$(".datepicker2").datepicker("option","minDate", selected)
					}
				});
				$(".datepicker2").datepicker({
					dateFormat: "dd-mm-yy",
					minDate: new Date('<?php echo !empty($yeardata)?$yeardata->startdate:"0";?>'),
					maxDate: new Date('<?php echo !empty($yeardata)?$yeardata->enddate:"0";?>'),
				});
				<?php
					}
				?>	
							
				$(document).on("focus",".quantity",function(){
					if($(this).val() == '0')
						$(this).val('');
				});
				$(document).on("blur",".quantity",function(){
					if($(this).val() == '')
						$(this).val('0');
				});				
				
				//Add quantity values for totalquantity
				$(document).on("keyup",".quantity",function(){					
					 var totalquantity = 0;
					 $(".quantity").each(function(){
						 if($.isNumeric($(this).val()))
						 totalquantity = parseInt(totalquantity) + parseInt($(this).val());
					 });
					 
					 $("#totalquantity").val(totalquantity);
				});			
				
				
				
				$(document).on("keyup",".quantity",function(){					
					 id = $(this).attr("id");
					 id = id.split("_");
					 
					 if($("#unitprice_"+id[1]).val() != '0'){
						 if($.isNumeric($(this).val())){
							total = parseFloat($("#unitprice_"+id[1]).val()) * parseFloat($(this).val());
							$("#amount_"+id[1]).val(parseFloat(total));
						 }
					 }
					var total = 0;
					  $(".amount").each(function() {
						total += parseFloat($(this).val());
					  });

					  var vat = parseFloat($("#vat").val());
					  var vatAmount = (total * vat) / 100;
					  var totalAmount = total + vatAmount;

					  $("#vat").val(vat);
					  $("#totalamount").val(totalAmount);
					  $("#vat_amount").val(vatAmount);
				});
				
				
				
            });
			
        </script>
        
	<script type="text/javascript">
        $(function () {
			
			$(document).on("change",".itemcode",function(){
				if($(this).val() != ''){
					var id = $(this).attr("id");
					id = id.split("_");
					
					$.ajax({
						url: "<?php echo base_url();?>Purchase/get_itemdetails",
						method: "POST",
						dataType: "json",
						data: {
							itemid: $(this).val()
						},
						success: function( data ) {
							$("#unitprice_"+id[1]).val(data.costprice);
							$("#itemname_"+id[1]).val(data.itemname);
							if($("#quantity_"+id[1]).val() != '0'){
								total = parseFloat($("#quantity_"+id[1]).val()) *  parseFloat(data.price);
								$("#amount_"+id[1]).val(total);
							}
						}
					});
				}
			});
            
			
			$("#purchaseorderform").submit(function(){				
				
				/*if($("#voucherdate").val() == ''){
					new PNotify({
						title: 'Warning',
						text: 'Voucher Date field is missing',
						type: 'error'
					});
					return false;
				}*/
				var overlay = jQuery('<div id="overlay"> </div>');
				overlay.appendTo(document.body)
				
			});
			   $(document).on("click",".delrow",function(){
				  $(this).parent().parent().remove(); 
			   });
			
	
	function isNumberKey(evt)
{
	var charCode = (evt.which) ? evt.which : event.keyCode
	if (charCode > 31 && (charCode < 48 || charCode > 57))
		return false;
}

	
	 $("#newsupplier").click(function(){
		 
		 $("#supname").val('');
		 $("#supphone").val('');
		 $("#supemail").val(''); 
		 $('#supcurr').prop('selectedIndex', 0); 
		 $('#supaccname').prop('selectedIndex', 0); 
		  $(".vallcheck").each(function(){						
					id = $.trim($(this).attr("id"));												
						$(".error-"+id).html("");					
					}); 
					
		 
	 });
	 
	 
	 $(document).on('change',".vallcheck",function(){
		 
		 id = $.trim($(this).attr("id"));					
					if(($(this).val() != '' || $(this).val() != null)  && id != "" ){					
						
						$(".error-"+id).html("");
						
						}
					});
					
	 
	 $("#saveac").click(function(){
		 
		 var check = true;  
		 $(".vallcheck").each(function(){						
					id = $.trim($(this).attr("id"));					
					if(($(this).val() == '' || $(this).val() == null)  && id != "" ){					
						
						$(".error-"+id).html("This field is required");
						check = false;
						}
					});
					
										
					if(check == false){	
						
						return false;
					} 
		 
				    $.ajax({
					  url: "<?php echo base_url();?>Purchase/ajax_addsupplier",
					  type:"POST",	 					  
					  data: {
						contacttype:'2',  
						customername: $("#supname").val(),
						phone: $("#supphone").val(),
						email: $("#supemail").val(),
						currency: $("#supcurr").val(),
						accountname: $("#supaccname").val() 
					  },
					  success: function( data ) {
							
							
							var coldata = $.trim(data);
							if(coldata != '')
							{
							var res = coldata.split("&*&%^");
							
							$('#supplier').append('<option value="'+res[0]+'">'+res[1]+'</option>');
							
							$( "#closemodel" ).trigger( "click" );
							}
					  }
					}); 
			   });
			   
			   
			       $("#newitementer").click(function(){
		 
		 $("#pitemamount").val('');
		 $("#pitemname").val(''); 
		 $('#pitemtax').prop('selectedIndex', 0); 
		 $('#pitemaccname').prop('selectedIndex', 0); 
		  $(".vallitemcheck").each(function(){						
					id = $.trim($(this).attr("id"));												
						$(".error-"+id).html("");					
					}); 
					
		 
	 });
	 
			    $(document).on('change',".vallitemcheck",function(){
		 
					id = $.trim($(this).attr("id"));					
					if(($(this).val() != '' || $(this).val() != null)  && id != "" ){					
						
						$(".error-"+id).html("");
						
						}
					});
					
					
					 $("#saveitem").click(function(){
		 
		 var check = true;  
		 $(".vallitemcheck").each(function(){						
					id = $.trim($(this).attr("id"));					
					if(($(this).val() == '' || $(this).val() == null)  && id != "" ){					
						
						$(".error-"+id).html("This field is required");
						check = false;
						}
					});
					
										
					if(check == false){	
						
						return false;
					} 
		 
				    $.ajax({
					  url: "<?php echo base_url();?>Purchase/ajax_additemname",
					  type:"POST",	 					  
					  data: {
						
						
						itemname: $("#pitemname").val(),
						price: $("#pitemamount").val(),
						accountname: $("#pitemaccname").val(),
						tax: $("#pitemtax").val(), 
						quantity: $("#pquantity").val(),
						location: $("#plocation").val() 
						
					  },
					  success: function( data ) {
							
							
							var coldata = $.trim(data);
							if(coldata != '')
							{
							var res = coldata.split("&*&%^");
							
							$('.itemname').append('<option value="'+res[0]+'">'+res[1]+'</option>');
							
							$( "#closemodel2" ).trigger( "click" );
							}
					  }
					});   
			   });
			   
        });
		
		
		
		   
$(document).on("click",".edit_data",function(){

	$('#row_id').val($(this).attr('data-id'));
	$('#ordernum').val($(this).attr('data-empid'))
	$('#quotenumber').val($(this).attr('data-crp'));
	$('#issuedate').val($(this).attr('data-design'));
	$('#deliverydate').val($(this).attr('data-month'));
	$('#date_of_request').val($(this).attr('data-date'));
	$('#loan_amount').val($(this).attr('data-loan'));
	$('#installment_month').val($(this).attr('data-amount'));
	$('#emi').val($(this).attr('data-accounts'));
	$('#accounts_feedback').val($(this).attr('data-feed'));
	
	

	$("#DataForm [type='submit']").html('Update');

});

    </script>
