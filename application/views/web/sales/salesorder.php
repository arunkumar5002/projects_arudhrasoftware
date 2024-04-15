<?php echo load_datatables(); ?>

	<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row" style="margin-bottom:1.5rem!important;">
                <div class="col-sm-6">
             <h3>Sales Order</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active"><a href="#">Sales Order</a></li>
                    </ol>
                </div>
            </div>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
								    <form id="salesorderform" data-parsley-validate class="form-horizontal form-label-left" method='post' action="<?php echo base_url()?>sales/savesalesorder">
									
								    <input type='hidden' name='salesorderid' value='<?php echo isset($order)?$order->salesorderid:""; ?>'>
										<div class="row">
											<div class="col-md-2">
												<div class="form-group">
													<label class="form-check-label">Order No <span class="text-required">*</span></label>
													    <input type="text" style='text-align: right;' id="ordernum" name="ordernum" readonly class="form-control form-control-sm" value='<?php echo $ordernum ?>'>
												</div>
											</div>
										
								<div class="col-md-3">
							<div class="form-group">
								<label class="form-check-label">Quote No  <span class="text-required">*</span></label>
								         <?php 
												if(isset($order)){
												?>	
													<input type="text" style='text-align: right;' id="quotenumber" name="quotenumber" readonly class="form-control form-control-sm" value='<?php echo isset($order)?$order->quoteno:""; ?>'>
												<?php 
												}else{ 
												?>
                                                <select id="quotenumber" name="quotenumber" class="form-control form-control-sm">
													<?php
													if(!empty($quote_list)){
														echo "<option value=''>Select Quote</option>";
														foreach($quote_list as $tmp){
															echo "<option value='".$tmp->salesquoteid."'>$tmp->quotenumber</option>";
														}														
													}else{
														echo "<option value=''>No Previous Quote</option>";
													}
													?>
												</select>
												
												<?php } ?>
							               </div>
										   	<div class="col-md-1 col-sm-2 col-xs-2" style='display:none'>
                                                 <a class='btn btn-success' id='get_salesquote'>Get</a>
                                            </div>
					                      </div>
											<div class="col-md-2">
												<div class="form-group">
													<label class="form-check-label">Issue Date <span class="text-required">*</span></label>
													 <input type="text" style='text-align: right;' id="issuedate" name="issuedate" required="required" class="datepicker form-control form-control-sm" value='<?php echo isset($order)?$order->issuedate:""; ?>'>
												</div>
											</div>	
											<div class="col-md-2">
												<div class="form-group">
													<label class="form-check-label">Delivery Date<span class="text-required">*</span></label>
													 <input id="deliverydate" style='text-align: right;' name="deliverydate" required class="datepicker required form-control form-control-sm" type="text" value='<?php echo isset($order)?$order->	deliverydate:""; ?>'>
												</div>
											</div>
										
											<div class="col-md-3">
												<div class="form-group">
													<label class="form-check-label">Vendor<span class="text-required">*</span></label>
													<select id="customer" name="customer" class="required form-control form-control-sm" required>
													<option value=''>Choose..</option>
													<?php
													if(!empty($suppliers)){
														foreach($suppliers as $tmp){
															if(isset($order) && $order->customer == $tmp->contactid)
																echo "<option selected value='$tmp->contactid'>$tmp->customername</option>";
															else
																echo "<option value='$tmp->contactid'>$tmp->customername</option>";
														}
													}
													?>
												</select>
												</div>
											</div>	
								
											
											                                        
 <div class='row'>
 <div class="col-md-12" style="background-color: darkslategrey;">
        <div class="form-group mb-0">
         <div class="row">
            <div class="col-md-2 text-white" align='center'>
				Item Code
			</div>			 
			<div class="col-md-2 text-white" align='center'>
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
				Unit
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
        <div  id='firstLine' class="mt-3 col-md-12">
		<?php
		if(!isset($orderrecords)){
		?>
		<div class="form-group">
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

             <div class="col-md-2 text-center">
				<input type="text" name='itemname[]' id="itemname_1" class="itemname form-control form-control-sm w-100" value='' style="margin-right: 0px; width:80%;">
			</div>			
			
			<div class="col-md-3 text-center">
				<input type="text" name='description[]' id="description_1" class="description form-control form-control-sm w-100" value='' style="margin-right: 0px; width:80%;">
			</div>
			<div class="col-md-1 text-center">
				<input type="text" name='quantity[]'  id='quantity_1' style='text-align: right;' class="quantity form-control form-control-sm w-100" onkeypress="return isNumberKeyPeriod(event)" value='0'>
			</div>
			<div class="col-md-1 text-center">
				<input type="text" name="unitprice[]"  id='unitprice_1' style='text-align: right;' readonly class="unitprice w-100 form-control form-control-sm" onkeypress="return isNumberKeyPeriod(event)" value='0'>
			</div>
			<div class="col-md-1 text-center">
				<input type="text" name="unit[]"  id='unit_1' style='text-align: right;' readonly class="unit w-100 form-control form-control-sm" onkeypress="return isNumberKeyPeriod(event)" value='0'>
			</div>
			<div class="col-md-1 text-center">
				<input type="text" name="amount[]" id='amount_1' style='text-align: right;' readonly class="w-100 amount form-control form-control-sm" onkeypress="return isNumberKeyPeriod(event)" value='0'>
			</div>			
			</div>
		</div>
		<?php }else{ ?>
			
			<?php 
			foreach($orderrecords as $temp){				
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
                <div class="col-md-2 text-center">
					<input type="text" name='itemname[]' class="itemname form-control form-control-sm w-100" value="<?php echo isset($temp)?$temp->itemname:'';?>">
				</div>				
				<div class="col-md-3 text-center">
					<input type="text" name='description[]' class="description form-control form-control-sm w-100" value="<?php echo isset($temp)?$temp->description:'';?>">
				</div>
				<div class="col-md-1 text-center">
					<input type="text" name='quantity[]'  id='quantity_1' style='text-align: right;' class="quantity form-control form-control-sm w-100" onkeypress="return isNumberKeyPeriod(event)" value="<?php echo isset($temp)?$temp->quantity:'';?>">
				</div>
				<div class="col-md-1 text-center">
					<input type="text" name="unitprice[]"  id='unitprice_1' style='text-align: right;' readonly class="unitprice w-100 form-control form-control-sm w-100" onkeypress="return isNumberKeyPeriod(event)" value="<?php echo isset($temp)?$temp->unitprice:'';?>">
				</div>
				<div class="col-md-1 text-center">
					<input type="text" name="unit[]"  id='unit_1' style='text-align: right;' readonly class="unit w-100 form-control form-control-sm w-100" onkeypress="return isNumberKeyPeriod(event)" value="<?php echo isset($temp)?$temp->unit:'';?>">
				</div>
				<div class="col-md-1 text-center">
					<input type="text" name="amount[]" id='amount_1' style='text-align: right;' readonly class="w-100 amount form-control form-control-sm" onkeypress="return isNumberKeyPeriod(event)" value="<?php echo isset($temp)?$temp->amount:'';?>">
				</div>			
		
			</div>
			</div>
			
			<?php } ?>			
		<?php } ?>	
		</div>
		<br>
<div class="row"></div>	
<!-- Main Row -->
<div class="col-md-12">
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
			<input type="hidden" id="vat" name="vat" value="<?php echo $vat->vat;?>">
			<input type="text" class="form-control form-control-sm" name="vat" id="vat_amount" readonly style="text-align: right;" value="<?php echo isset($order)?$order->vat:""; ?>">
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
				<input type=text class='form-control form-control-sm' style='text-align: right;' name='totalamount' id='totalamount' value="<?php echo isset($order)?$order->totalamount:'0';?>"readonly>
			</div>
				
		</div>
		
		
		
		<div class="col-md-12 mt-5">
			<div class="row">
			<div class="form-group col-md-3">
			<span>Ship Via</span>
			<select name="ship_via" id='ship_via' class="ship_via form-control form-control-sm w-100">
            <option value=''>Choose One..</option>
			<option value='Ship'>Ship</option>
			<option value='Flight'>Flight</option>
			<option value='Road'>Road</option>	
		    </select>
			</div>
			<div class="form-group col-md-3">
			<span>Inconterms</span>
			<input type='text' class='form-control form-control-sm' id="Inconterms" name='Inconterms' value="<?php echo isset($order)?$order->Inconterms:""; ?>">
			</div>
			<div class="form-group col-md-3">
			<span>Bill Of lading No</span>
			<input type='text' class='form-control form-control-sm' id="bill_laddingno" name='bill_laddingno' value="<?php echo isset($order)?$order->bill_laddingno:""; ?>">
			</div>
			<div class="form-group col-md-3">
			<span>Total net Weight</span>
			<input type='text' class='form-control form-control-sm' id="total_netweight" name='total_netweight' value="<?php echo isset($order)?$order->total_netweight:""; ?>">
			</div>
			<div class="form-group col-md-3">
			<span>Container no</span>
			<input type='text' class='form-control form-control-sm' id="container_no" name='container_no' value="<?php echo isset($order)?$order->container_no:""; ?>">
			</div>
			<div class="form-group col-md-3">
			<span>Total gross weight</span>
			<input type='text' class='form-control form-control-sm' id="gross_weight" name='gross_weight' value="<?php echo isset($order)?$order->gross_weight:""; ?>">
			</div>
			<div class="form-group col-md-3">
			<span>Seal No</span>
			<input type='text' class='form-control form-control-sm' id="seal_no" name='seal_no' value="<?php echo isset($order)?$order->seal_no:""; ?>">
			</div>
			<div class="form-group col-md-3">
			<span>No.of Rolls</span>
			<input type='text' class='form-control form-control-sm' id="rolls" name='rolls' value="<?php echo isset($order)?$order->rolls:""; ?>">
			</div>
			<div class="form-group col-md-3">
			<span>Custom/HS Code</span>
			<input type='text' class='form-control form-control-sm' id="custom_hscode" name='custom_hscode' value="<?php echo isset($order)?$order->custom_hscode:""; ?>">
			</div>
			<div class="form-group col-md-3">
			<span>No.of Pallets</span>
			<input type='text' class='form-control form-control-sm' id="pallets" name='pallets' value="<?php echo isset($order)?$order->pallets:""; ?>">
			</div>
			<div class="form-group col-md-3">
			<span>Loading Port</span>
			<input type='text' class='form-control form-control-sm' id="loading_port" name='loading_port' value="<?php echo isset($order)?$order->loading_port:""; ?>">
			</div>
			<div class="form-group col-md-3">
			<span>Discharge Port</span>
			<input type='text' class='form-control form-control-sm' id="discharge_port" name='discharge_port' value="<?php echo isset($order)?$order->discharge_port:""; ?>">
			</div>
			<div class="form-group col-md-3">
			<span>Beneficiary Name</span>
			<input type='text' class='form-control form-control-sm' id="beneficiary_name" name='beneficiary_name' value="<?php echo isset($order)?$order->beneficiary_name:""; ?>">
			</div>
			
			<div class="form-group col-md-3">
			<span>Validity Period</span>
			<input type='text' class='form-control form-control-sm' id="validityperiod" name='validityperiod'  value="<?php if(isset($quoterecord)){ echo $quoterecord->validityperiod;}?>">
			
			</div>
			
			<div class="form-group col-md-3">
			<span>Delivery Period</span>
			<input type='text' class='form-control form-control-sm' id="deliveryperiod" name='deliveryperiod'  value="<?php if(isset($quoterecord)){ echo $quoterecord->deliveryperiod;}?>">
			
			</div>
			
			</div>
			</div>
		
		
			<div class="col-md-12">
			<div class="row">
			<div class="form-group col-md-12">
				<span>Payment Terms and Conditions
				</span>
				
					<textarea class='form-control form-control-sm' id="otherterms" name='otherterms'  id="terms"><?php if(isset($quoterecord)){ echo $quoterecord->otherterms;}?></textarea>
				
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
            $(document).ready(function () {
				/*$("#addNew").click(function(){
					var line = $("#firstLine").html();
					$("#firstLine").append().after("<div class='form-group'>"+line+"</div>");				
				
				$('#voucherdate').daterangepicker();*/
				
				i = 1;
				$("#addNew").click(function(){					 
					 i++;
					 $.ajax({
					  url: "<?php echo base_url();?>sales/get_salesorderrow",
					  type:"POST",
					  data: {
						rowid: i
					  },
					  success: function( data ) {
						  $("#firstLine").append(data);								 
					  }
					});
				});
				   $(document).on("click",".delrow",function(){
				  $(this).parent().parent().remove(); 
			   });
			   $("#quotenumber").change(function(){
					$("#get_salesquote").trigger("click");
				});
				
				$("#get_salesquote").click(function(){
					
					$.ajax({
						url: "<?php echo base_url();?>sales/get_salesquotedetails",
						method: "POST",
						dataType: "json",
						data: {
							quoteid: $("#quotenumber").val()
						},
						success: function( data ) {
							$("#customer").val(data.customerid);
							$("#totalamount").val(data.totalamount);
							$("#vat_amount").val(data.vat);
							$("#validityperiod").val(data.validityperiod);
							$("#paymentterms").val(data.paymentterms);
							$("#deliveryperiod").val(data.deliveryperiod);
							$("#otherterms").val(data.otherterms);
							
							i = data.total_quote;							
						}
					});
					
					$.ajax({
						url: "<?php echo base_url();?>sales/get_salesquoterecords",
						method: "POST",
						data: {
							quoteid: $("#quotenumber").val()
						},
						success: function(data) {
							if($.trim(data) != '')
								$("#firstLine").html(data);
						}
					});
					
				});
				
				$(".datepicker").datepicker({
					dateFormat: "dd-mm-yy"
				});
					
				
				$(document).on("focus",".quantity",function(){
					if($(this).val() == '0')
						$(this).val('');
				});
				$(document).on("blur",".quantity",function(){
					if($(this).val() == '')
						$(this).val('0');
				});				
				
				
				
				$(document).on("keyup",".quantity",function(){					
					 id = $(this).attr("id");
					 id = id.split("_");
					 
					  if ($("#unitprice_" + id[1]).val() !== '0') {
						if ($.isNumeric($(this).val())) {
						  var total = parseFloat($("#unitprice_" + id[1]).val()) * parseFloat($(this).val());
						  $("#amount_" + id[1]).val(parseFloat(total));
						}
					  }
					  
					var subtotal = 0;
					$(".amount").each(function(){
                       subtotal += parseFloat($(this).val());
					});
					
					  var vat = parseFloat($("#vat").val());
					  var vatAmount = (subtotal * vat) / 100;
					  var totalAmount = subtotal + vatAmount;

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
						url: "<?php echo base_url();?>purchase/get_itemdetails",
						method: "POST",
						dataType: "json",
						data: {
							itemid: $(this).val()
						},
						success: function( data ) {
							$("#unitprice_"+id[1]).val(data.price);
							$("#itemname_"+id[1]).val(data.itemname);
							$("#unit_"+id[1]).val(data.unit);
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
					  url: "<?php echo base_url();?>purchase/ajax_addsupplier",
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
							
							$('#customer').append('<option value="'+res[0]+'">'+res[1]+'</option>');
							
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
					  url: "<?php echo base_url();?>purchase/ajax_additemname",
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
        <div  id='firstLine' class="col-md-12 mt-3">
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
			
	<div class="form-group ">
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
				<input type=text
				class='form-control form-control-sm w-100 vat' name='vat' id='vat' readonly style='text-align: right;' value="<?php echo isset($invoice)?$invoice->vat:'';?>">
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
				<input type=text class='form-control form-control-sm w-100 totalamount' name='totalamount' id='totalamount' readonly value='<?php echo isset($invoice)?$invoice->totalamount:'';?>' style='text-align: right;'>
			</div>
			<div class="col-md-1 " align='center'>
				
			</div>
				
		</div>	
		</div>
		</div>
		<br>
		<br>
		</br>
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
           
<br>
<br>			
       </br>                               
                                    

                             
			
		              <div class="form-group">
                                            <div class="col-md-12 col-md-offset-3">
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

