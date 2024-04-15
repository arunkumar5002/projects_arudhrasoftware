<?php echo load_datatables(); ?>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row" style="margin-bottom:1.5rem!important;">
                <div class="col-sm-6">
                    <h1> Quick Sales Invoice </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active"><a href="#">Purchase Order</a></li>
                    </ol>
                </div>
            </div>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
								 <form id="salesquoteform" data-parsley-validate class="form-horizontal form-label-left" method='post' action="<?php echo base_url()?>accounts/savequickinvoice">  
							     <input type='hidden' name='salesinvoiceid' value='<?php if(isset($quote)){ echo $quote->salesquoteid;}?>'>
										<div class="row">
										<div class="col-md-3">
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
                                               <input type="text" style='text-align: right;' id="invoicedate" required name="invoicedate" required="required" class="tabp datepicker form-control form-control-sm" value="<?php if(isset($quote)){ echo date("d-m-Y",strtotime($quote->invoicedate));}?>">
                                            </div>
                                        </div>	
										
										
										<div class="form-group col-md-4">
                                            <label class="form-check-label" for="customername">Bank Name
                                            </label>
												<?php
												$quick_bank_accounts = json_decode(get_setting('quick_bank_accounts'));	?>
                                                <!--<input type="text"  id="bank_name" required name="bank_name" required="required" class="tabp form-control col-md-8 col-xs-8" value="<?php if(isset($quote)){ echo $quote->bank_name;}?>">-->
                                                <select id="bank_name" name="bank_name" class="tabp form-control form-control-sm">
													<option value=''>--Select--</option>
													<?php
													if(!empty($quick_bank_accounts)){
													foreach($quick_bank_accounts as $tmp){
														echo "<option value='".get_accountname($tmp[0])."_".$tmp[1]."'>".get_accountname($tmp[0])."</option>";
													}
													}
													?>
												</select>
                                            </div>	
											<div class="col-md-1 mt-4"> 
											    <a class='btn btn-success btn-sm' href="<?php echo base_url()?>hr/settings" id='get_salesorder'>Add</a>
                                            </div>
                                        
										<div class="form-group col-md-3">
                                            <label class="form-check-label" for="customername">Account Number 
                                            </label>
                                                <input type="text"  id="account_num" name="account_num" required="required" class="tabp form-control form-control-sm" readonly> 
                                        </div>	
										
										
										
								     <div class="form-group col-md-4">
                                            <label class="form-check-label" for="customername"> Customer <span class="required">*</span>
                                            </label>
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
										<div class="col-md-1 mt-4"> 
											    <a class='btn btn-success btn-sm' href="<?php echo base_url()?>Web/contact" id=''>Add</a>
                                            </div>
											
									<br>
        <br>		                                        
 <div class='row'>
 <div class="col-md-12" style="background-color: darkslategrey;">
        <div class="form-group mb-0" >	
		 <div class='row'>
			<div class="col-md-2  text-white" align='center'>
				Item Code
			</div>
			
			<div class="col-md-3  text-white" align='center'>
				Item Name
			</div>	
            <div class="col-md-3  text-white" align='center'>
				Description	
			</div>					
			<div class="col-md-1 text-white" align='center'>
				Rate/Unit
			</div>
			<div class="col-md-1 text-white" align='center'>
			     Quantity
			</div>			
			<div class="col-md-1 text-white" align='center'>
				Total
			</div>	
			<div class="col-md-1 text-white" align='center'>
              <a style='cursor:pointer;padding:0px 0px;color:#FFFFFF' style="padding: 0px;" id='newquoterow' class="btn-sm">[Add row]</a>			  
		</div>
		</div>
</div>		
		</div>
		
        <!-- Main Row -->
        <div  id='firstLine' class="col-md-12 mt-3">
		<?php if(!isset($quoterecords)) {?>	
		<div class="form-group mb-0">
           <div class='row'>		
		     <div class="col-md-2" align='center'>
				<select class='form-control form-control-sm itemcode tabp' name='itemcode[]' id='itemcode_1' required>
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
				<input type=text class='form-control form-control-sm w-100 itemname' name='itemname[]' id='itemname_1' readonly>
			</div>
			
			<div class="col-md-3" align='center'>
				<input type="text" class='form-control form-control-sm description tabp w-100' name='description[]' id='description_1'>
			</div>
			
			
			<div class="col-md-1" align='center'>
				<input type=text class='form-control form-control-sm unitprice w-100' name='unitprice[]' id='unitprice_1' value='0' style='text-align: right;' readonly>
			</div>
			
			<div class="col-md-1" align='center'>
				<input type=text class='form-control form-control-sm quantity w-100' name='quantity[]' id='quantity_1' value='0' style='text-align: right;'>
			</div>
			
			<div class="col-md-1" align='center'>
				<input type=text class='form-control form-control-sm totalprice w-100' name='totalprice[]' id='totalprice_1' readonly style='text-align: right;' value='0'>
			</div>	
		</div>	
		</div>
		
			<?php }else { 
			foreach($quoterecords as $temp){
		?>
			
	<div class="form-group mb-0">
 <div class='row'>					
		 <div class="col-md-2" style="text-align:center">
				<select class='form-control form-control-sm itemcode tabp' name='itemcode[]' id='itemcode_1' required>
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
				<input type=text class='form-control form-control-sm itemname' name='itemname[]' id='itemname_1' value='<?php echo isset($temp)?$temp->itemname:'';?>' style='text-align: right;'>
			</div>
			
			<div class="col-md-3" align='center'>
			<input type=text class='form-control form-control-sm description tabp' name='description[]' id='description_1' value="<?php if(isset($temp)){ echo $temp->description;}?>">
			</div>
			
			
			<div class="col-md-1" align='center'>
				<input type=text class='form-control form-control-sm unitprice' name='unitprice[]' id='unitprice_1' value='<?php echo isset($temp)?$temp->unitprice:'';?>' style='text-align: right;' readonly>
			</div>
			
			<div class="col-md-1" align='center'>
				<input type=text class='form-control form-control-sm quantity' name='quantity[]' id='quantity_1' value='<?php echo isset($temp)?$temp->quantity:'';?>' style='text-align: right;'>
			</div>
			
			<div class="col-md-1" align='center'>
				<input type=text class='form-control form-control-sm totalprice' name='totalprice[]' id='totalprice_1' readonly style='text-align: right;' value='<?php echo isset($temp)?$temp->amount:'';?>'>
			</div>	
			  <div class="col-md-1 ">
			&nbsp;
		</div>
		</div>
			<?php } ?>			
		<?php } ?>
		</div>
		</div>
		
		<br>

		<!-- Main Row -->
       <div class="col-md-12">
		<div class="form-group">	
		  <div class="row">
			<div class="col-md-1" align='center' >
				
			</div>
            <div class="col-md-3" align='center' >
				
			</div>
			 
			<div class="col-md-4" align='center'>
				
			</div>	

				<div class="col-md-1 mt-4" align='center'>
				VAT
					</div>
			<div class="col-md-2 mt-4" align='center'>
				 <input type="hidden" id="vat" name="vat" value="<?php echo $vat->vat;?>">
				<input type="text" class="form-control form-control-sm" name="vat" id="vat_amount" readonly style="text-align: right;">
			</div>
			<div class="col-md-1" align='center'>
					
				</div>
				<br>
			
			</div>
			</div>
			</div>
	
		<div class="col-md-12">
		<div class="form-group">	
		  <div class="row">	
			<div class="col-md-1" align='center' >
				
			</div>

			<div class="col-md-3" align='center'>
				
			</div>
			<div class="col-md-4" align='center'>
				
			</div>
			
			<div class="col-md-1" align='center'>
				Total
			</div>
			<div class="col-md-2" align='center'>
				<input type=text class='form-control form-control-sm w-100 totalamount' name='totalamount' id='totalamount' readonly value='<?php echo isset($order)?$order->totalamount:""; ?>' style='text-align: right;'>
			</div>
			<div class="col-md-1 " align='center'>
				
			</div>
				
		</div>	
		</div>
		</div>
		<br>
		<br>
		</br>
		
		<div class="col-md-6">
					<div class="form-group">
				<label class="control-label" for="customername">Terms & Condition
				</label>
				
					<textarea class='form-control' name='terms' id="terms"></textarea>
				
			</div>
			</div>

             <div class="row col-md-12">
				<div class="col-md-6">
			 <div class="form-group">
                   <label class="control-label" for="customername">Prepared By <span class="required">*</span>
                    </label>               
                   <input type="text" id="preparedby" name="preparedby" required class="tabp required form-control form-control-sm w-100" value='<?php echo isset($preparedby)?$preparedby:"";?>'>
                                           
                                        </div>
         </div>
		 <div class="col-md-6">
                   <div class="form-group">
                       <label for="website" class="control-label col-md-4 col-sm-4 col-xs-4">Authorized By  <span class="required">*</span></label>                   
                   <input id="authorizedby" name="authorizedby" class="tabp required form-control form-control-sm w-100" type="text" value='<?php echo isset($authorizedby)?$authorizedby:"";?>'>
                                          
                                        </div>										
		</div>
		</div>
			 
<br>
<br>			
       </br>                               
                                    

                             
			
		              <div class="form-group">
                                            <div class="col-md-12">
										
                                                <button type="submit" class="btn btn-success btn-sm">Submit</button>
												<button type="reset" class="btn btn-primary btn-sm">Cancel</button>
                                            </div>
                                        </div>	
	 </div>       </form>
                                </div>
							</div>
							</div>
						</div>
					</div>
</div>
    </section>
</div>




<style>
	#joditterms .toolbar{
		display:none;
	}
</style>	
<script>
$(document).ready(function(){
	$(".datepicker").datepicker({
		dateFormat: "dd-mm-yy"
	});
	
	i = 1;
	$("#newquoterow").click(function(){
		 i++;
		 $.ajax({
		  url: "<?php echo base_url();?>Accounts/quickinvoiceRow",
		  type:"POST",
		  data: {
			rowid: i
		  },
		  success: function( data ) {
			  $("#firstLine").append(data);								 
		  }
		});
	});
	
	
	
	$("#bank_name").change(function(){
		if($(this).val()){
		acc = $(this).val();
		acc = acc.split("_");
		$("#account_num").val(acc[1]);
		}else{
			$("#account_num").val("");
		}
	});
	$("#bank_name").trigger("change");
	
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
							$("#itemname_"+id[1]).val(data.itemname);
							if($("#quantity_"+id[1]).val() != '0'){
								total = parseFloat($("#quantity_"+id[1]).val()) *  parseFloat(data.price);
								$("#amount_"+id[1]).val(total);
							}
						}
					});
				}
			});
			
				$(document).on("keyup",".quantity",function(){					
					 id = $(this).attr("id");
					 id = id.split("_");
					 
					 if($("#unitprice_"+id[1]).val() != '0'){
						 if($.isNumeric($(this).val())){
							total = parseFloat($("#unitprice_"+id[1]).val()) * parseFloat($(this).val());
							$("#totalprice_"+id[1]).val(parseFloat(total).toFixed(2));
						 }else{
							  $("#totalprice_"+id[1]).val("0");
						 }
					 }else{
						 $("#totalprice_"+id[1]).val("0");
					 }
					 
						
						 var total = 0;
					  $(".totalprice").each(function() {
						total += parseFloat($(this).val());
					  });

					  var vat = parseFloat($("#vat").val());
					  var vatAmount = (total * vat) / 100;
					  var totalAmount = total + vatAmount;

					  $("#vat").val(vat);
					  $("#totalamount").val(totalAmount);
					  $("#vat_amount").val(vatAmount);
					
				});
			
			$(document).on("click",".removeRow",function(){
				$(this).parent().parent().remove();
			});
			
			$(document).on("focus",".quantity",function(){
				if($(this).val() == '0')
					$(this).val("");
			});
			$(document).on("blur",".quantity",function(){
				if($(this).val() == '')
					$(this).val("0");
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

