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
                        <li class="breadcrumb-item active"><a href="#">Sales Quote</a></li>
                    </ol>
                </div>
            </div>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
								   <form id="salesquoteform" data-parsley-validate class="form-horizontal form-label-left" method='post' action="<?php echo base_url()?>sales/savesalesquote">
									<input type='hidden' name='salesquoteid' value='<?php if(isset($quote)){ echo $quote->salesquoteid;}?>'>
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label class="form-check-label">Quote No <span class="text-required">*</span></label>
													<input type="text" style='text-align: right;' id="quotenumber" name="quotenumber" readonly class="form-control form-control-sm" value='<?php echo $quotenumber?>'>
												</div>
											</div>
											
							
											<div class="col-md-4">
												<div class="form-group">
													<label class="form-check-label">Quote Date <span class="text-required">*</span></label>
													 <input type="text" id="issuedate" name="issuedate" required="required" style='text-align: right;' class="datepicker form-control form-control-sm " value="<?php if(isset($quote)){ echo date("d-m-Y",strtotime($quote->quotedate));}?>"> 
												</div>
											</div>	
											
										<div class="col-md-4">
                                            <label class="form-check-label">Customer <span class="text-required">*</span></label>
                                            <div class="">
                                                <select class='tabp form-control form-control-sm' name='customername' id='customername' required>
													<option value=''>Choose..</option>
													<?php
													if(!empty($customers)){
														foreach($customers as $tmp){
															if(isset($quote) && $tmp->contactid == $quote->customerid)
																echo "<option value='$tmp->contactid' selected>$tmp->customername</option>";
															else
																echo "<option value='$tmp->contactid'>$tmp->customername</option>";
														}
													}
													?>
												</select>
                                            </div>
                                        </div>	
											</div>
												
			</br>								                                        
 <div class='row'>
 <div class="col-md-12" style="background-color: darkslategrey;">
        <div class="form-group mb-0">	
		   <div class='row'>
		    <div class="col-md-1 text-white" align='center'>
				Item Code 
			</div>
			<div class="col-md-2 text-white" align='center'>
				Item Name 
			</div>		
			<div class="col-md-2 text-white" align='center'>
				Description
			</div>
			<div class="col-md-1 text-white" align='center'>
				GST
			</div>
			<div class="col-md-1 text-white" align='center'>
				Quantity
			</div>
			<div class="col-md-1 text-white" align='center'>
				Unit/Rate
			</div>
			<div class="col-md-1 text-white" align='center'>
				Unit
			</div>
			<div class="col-md-1 text-white" align='center'>
				Amount
			</div>
            <div class="col-md-1 text-white" align='center'>
				Sub Amount
			</div>			
		   <div class="col-md-1" align='center'>
			<a style='cursor:pointer;padding:0px 0px;color:#FFFFFF' style="padding: 0px;" id='newquoterow' class="btn-sm">[Add row]</a>
		   </div>	
		</div>	
		</div>
		</div>
        <!-- Main Row -->
        <div  id='firstLine' class="mt-3 col-md-12">
		<?php if(!isset($quoterecords)) {?>	
		<div class="form-group">
          <div class='row'>	

            <div class="col-md-1" align='center'>
				<select name="itemcode[]" id='itemcode_1' class="itemcode form-control form-control-sm w-100">
					<option value='0'>Choose..</option>
					<?php
					if(!empty($itemmaster)){
						foreach($itemmaster as $tmp){
							echo "<option value='$tmp->itemid'>$tmp->itemcode</option>";
						}
					}
					?>
				</select>
			</div>			  
			<div class="col-md-2" align='center'>
				<input name="itemname[]" id='itemname_1' class="itemname form-control form-control-sm w-100" value=''>
			</div>
			<div class="col-md-2 text-center">
				<input type="text" name='description[]' class="description form-control form-control-sm border-1 tabp w-100" id='description_1' value=''>
			</div>
			<div class="col-md-1 text-center">
			    <input name="gst[]" id='gst_1' class="gst form-control form-control-sm w-100" value=''>
			</div>
			<div class="col-md-1 text-center">
					<input type="text" name='quantity[]'  id='quantity_1' style='text-align: right;' class="quantity form-control form-control-sm w-100" onkeypress="return isNumberKeyPeriod(event)" value='0'>
			</div>
			<div class="col-md-1">
				<input type="text" name="unitprice[]"  id='unitprice_1' style='text-align: right;'  class="unitprice w-100 form-control form-control-sm tabp" value='0' readonly>
			</div>
			<div class="col-md-1">
				<input type="text" name="unit[]"  id='unit_1' style='text-align: right;'  class="unit w-100 form-control form-control-sm tabp" value='0' readonly>
			</div>
			<div class="col-md-1 text-center">
				<input type="text" name="amount[]" id='amount_1' style='text-align: right;' readonly class="w-100 amount form-control form-control-sm"  value='0'>
			</div>
			<div class="col-md-1 text-center">
				<input type="text" class="form-control form-control-sm" name="vat" id="vat_amount" readonly style="text-align: right;" value="<?php if(isset($quote)){ echo $quote->vat;}?>">
			</div>
			</div>
		</div>
		<?php }else{ ?>
			
			<?php 
			foreach($quoterecords as $temp){				
			?>
			
			<div class="form-group">
               <div class='row'>				
				<div class="col-md-1 mb-2" align='center'>
					<select name="itemcode[]" id='itemcode_1' class="itemcode form-control form-control-sm w-100">
						<option value='0'>Choose..</option>
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
                 <div class="col-md-2 text-center">
					<input type=text class='form-control form-control-sm itemname tabp w-100' name='itemname[]' id='itemname_1' value="<?php if(isset($temp)){ echo $temp->itemname;}?>">
				</div>				
				<div class="col-md-3 text-center">
					<input type=text class='form-control form-control-sm description tabp w-100' name='description[]' id='description_1' value="<?php if(isset($temp)){ echo $temp->description;}?>">
				</div>
				<div class="col-md-3 text-center">
					<input type=text class='form-control form-control-sm gst tabp w-100' name='gst[]' id='gst_1' value="<?php if(isset($temp)){ echo $temp->gst;}?>">
				</div>
				<div class="col-md-1 text-center">
					<input type=text class='form-control form-control-sm quantity tabp w-100' style='text-align: right;' name='quantity[]' id='quantity_1' onkeypress="return isNumberKeyPeriod(event)" value='<?php if(isset($temp)){ echo $temp->quantity;}?>'>
				</div>
				<div class="col-md-1">
					<input type=text class='form-control form-control-sm unitprice w-100' name='unitprice[]' id='unitprice_1' value="<?php if(isset($temp)){ echo $temp->unitprice;}?>" style='text-align: right;' readonly>
				</div>
				<div class="col-md-1">
					<input type=text class='form-control form-control-sm unit w-100' name='unit[]' id='unit_1' value="<?php if(isset($temp)){ echo $temp->unit;}?>" style='text-align: right;' readonly>
				</div>
				<div class="col-md-1 text-center">
				<input type="text" name="amount[]" id='amount_1' class='form-control form-control-sm amount w-100' readonly style='text-align: right;' value="<?php echo isset($temp)?$temp->amount:'';?>">
			</div>		
			</div>
			</div>
			
			<?php } ?>			
		<?php } ?>	
		
		</div>
		</div>
		</div>
		
		<!-- Main Row -->
		
		<div class='row'></div>
		<div class="col-md-12 mb-5" >
	  <div class="form-group">
          <div class="row">		
			<div class="col-md-1"  align='center'>
				
			</div>		
			<div class="col-md-4" align='center' style='margin-top:5px'>
				
			</div>
			<div class="col-md-2" align='center'>
				
			</div>
			<div class="col-md-2" align='right'>
				Total
			</div>
			
			<div class="col-md-2" align='center'>
				<input type=text class='form-control form-control-sm' style='text-align: right;' name='totalamount' id='totalamount' value="<?php if(isset($quote)){ echo $quote->totalamount;}?>" readonly>
			</div>
			<div class="col-md-1 w-100" align='center'>
				
			</div>
			 </div>
				
		</div>	
		</div>
		
		
		<div class="row col-md-12">
			<div class="col-md-6">
			<div class="form-group">
				<label class="form-check-label" for="customername">Validity Period
				</label>
					<input type='text' class='form-control form-control-sm' name='validityperiod' value="<?php if(isset($quote)){ echo $quote->validityperiod;}?>">
			</div>
			</div>
			<div class="col-md-6">
			<div class="form-group">
				<label class="form-check-label" for="customername">Delivery Period
				</label>
					<input type='text' class='form-control form-control-sm' name='deliveryperiod' value="<?php if(isset($quote)){ echo $quote->deliveryperiod;}?>">
			</div>
			</div>
		</div>
		
			<!--<div class="form-group row">
				<label class="control-label col-md-2 col-sm-2 col-xs-2" for="customername">Payment Terms
				</label>
				<div class="col-md-10 col-sm-10 col-xs-10">
					<input type='text' class='form-control' name='paymentterms' value="<?php if(isset($quote)){ echo $quote->paymentterms;}?>">
				</div>
			</div>-->
	
		
		<div class="row col-md-12">
			<div class="col-md-6">
			<div class="form-group">
			<label class="form-check-label">Prepared By<span class="text-required">*</span></label>
			<input type="text" id="preparedby" name="preparedby" class="required form-control form-control-sm" value="<?php if(isset($quote)){ echo $quote->preparedby;}?>">
			</div>
		</div>
											
							
		<div class="col-md-6">
			<div class="form-group">
			<label class="form-check-label">Authorized By<span class="text-required">*</span></label>
		    <input id="authorizedby" name="authorizedby" class="required form-control form-control-sm " type="text" value="<?php if(isset($quote)){ echo $quote->authorizedby;}?>">
			</div>
			</div>	
		</div>
		
		
		<div class='row col-md-12'>
		<div class="col-md-12">
			<div class="form-group">
				<label class="form-check-label" for="customername">Payment Terms and Conditions
				</label>
			<textarea class='form-control form-control-sm' name='otherterms' id="terms"><?php if(isset($quote)){ echo $quote->otherterms;}?></textarea>
			</div>
		</div>
		</div>
		

     							  
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
    </section>
</div>

    <script>
$(document).ready(function(){
	$(".datepicker").datepicker({
		dateFormat: "dd-mm-yy"
	});
	
	i = 1;
	$("#newquoterow").click(function(){
		 i++;
		 $.ajax({
		  url: "<?php echo base_url();?>sales/get_salesquoterow",
		  type:"POST",
		  data: {
			rowid: i
		  },
		  success: function( data ) {
			  $("#firstLine").append(data);								 
		  }
		});
	});
	
			$(document).on("change",".itemcode",function(){
				if($(this).val() != ''){
					var id = $(this).attr("id");
					id = id.split("_");
					
					$.ajax({
						url: "<?php echo base_url();?>Sales/get_itemdetails",
						method: "POST",
						dataType: "json",
						data: {
							itemid: $(this).val()
						},
						success: function( data ) {
							$("#unitprice_"+id[1]).val(data.price);
							$("#unit_"+id[1]).val(data.unit);
							$("#itemname_"+id[1]).val(data.itemname);
							$("#gst_"+id[1]).val(data.gst);
							if($("#quantity_"+id[1]).val() != '0'){
								total = parseFloat($("#quantity_"+id[1]).val()) *  parseFloat(data.price);
								$("#amount_"+id[1]).val(total);
								
							}
						}
					});
				}
			});
			
			$(document).on("click",".delrow",function(){
				  $(this).parent().parent().remove(); 
			   });
			
			
			$(document).on("focus",".quantity,.unitprice,.discount",function(){
		if($(this).val() == '0')
			$(this).val('');
	});
	$(document).on("blur",".quantity,.unitprice,.discount",function(){
		if($(this).val() == '')
			$(this).val('0');
	});		
			
			
				$(document).on("keyup", ".quantity", function() {
					  var id = $(this).attr("id");
					  id = id.split("_");

					  if ($("#unitprice_" + id[1]).val() !== '0') {
						if ($.isNumeric($(this).val())) {
						  var total = parseFloat($("#unitprice_" + id[1]).val()) * parseFloat($(this).val());
						  $("#amount_" + id[1]).val(parseFloat(total));
						}
					  }

					  var subtotal = 0;
					  $(".amount").each(function() {
						subtotal += parseFloat($(this).val());
					  });

					  var gst = parseFloat($("#gst").val());
					  var vatAmount = (subtotal * gst) / 100;
					  var totalAmount = subtotal + vatAmount;

					  $("#gst").val(gst);
					  $("#totalamount").val(totalAmount);
					  $("#vat_amount").val(vatAmount);
					 
			       });
			
			
			$('#salesquoteform').on('keyup keypress', function(e) {
			  var code = e.keyCode || e.which;
			  if (code == 13) {
				e.preventDefault();				
			  }
			});
			
			$('#submitButton').on('keyup keypress', function(e) {
				 var code = e.keyCode || e.which;
				if (code == 13) {
					$('#voucherform').submit();
				}
			});
			
			$('body').on('keydown', '.tabp', function(e) {
				var self = $(this), 
				form = self.parents('form:eq(0)'), 
				focusable, next;
				if (e.keyCode == 13) {
					focusable = form.find('.tabp').filter(':visible');
					next = focusable.eq(focusable.index(this)+1);
					if (next.length) {
						next.focus();
					} else {
						form.submit();
					}
					return false;
				}
			});
	
	
	
		
	function isNumberKey(evt)
{
	var charCode = (evt.which) ? evt.which : event.keyCode
	if (charCode > 31 && (charCode < 48 || charCode > 57))
		return false;
}

	 
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
					  url: "<?php echo base_url();?>accounts/ajax_addsupplier",
					  type:"POST",	 					  
					  data: {
						contacttype:'1',  
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
							
							$('#customername').append('<option value="'+res[0]+'">'+res[1]+'</option>');
							
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
					  url: "<?php echo base_url();?>accounts/ajax_additemname",
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
</script>

 
