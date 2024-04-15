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
                        <li class="breadcrumb-item active"><a href="<?php echo base_url() ?>purchase/purchasequote">Purchase Quote List</a></li>
                    </ol>
                </div>
            </div>
			<div class="row">
				<div class="col-12">
					<div class="card">
						
						<div class="card-body">
						
								   <form id="purchaseorderform" data-parsley-validate class="form-horizontal form-label-left" method='post' action="<?php echo base_url()?>purchase/savepurchasequote">
									<input type=hidden name='purchasequoteid' value='<?php echo isset($details)?$details->purchasequoteid:"";?>'>
										<div class="row">
											<div class="col-md-3">
												<div class="form-group">
													<label class="form-check-label">Quote No <span class="text-required">*</span></label>
													<input type="text" style='text-align: right;' id="quotenumber" name="quotenumber" readonly class="form-control form-control-sm" value='<?php echo $quotenumber?>'>
												</div>
											</div>
											
							
											<div class="col-md-3">
												<div class="form-group">
													<label class="form-check-label">Quote Date <span class="text-required">*</span></label>
													 <input type="text" id="issuedate" name="issuedate" required="required" style='text-align: right;' class="datepicker form-control form-control-sm " value='<?php echo isset($details)?date("d-m-Y",strtotime($details->quotedate)):"";?>'> 
												</div>
											</div>	
											
												<div class="col-md-3">
												<div class="form-group">
													<label class="form-check-label">Vendor<span class="text-required">*</span></label>
													<select class='form-control form-control-sm' name='customername' id='customername' required>
													<option value=''>Choose..</option>
													<?php
													if(!empty($customers)){
														foreach($customers as $tmp){
															if(isset($details) && $details->customerid == $tmp->contactid)
																echo "<option selected value='$tmp->contactid'>$tmp->customername</option>";
															else
																echo "<option value='$tmp->contactid'>$tmp->customername</option>";
														}
													}
													?>
												</select>
												</div>
											</div>
											
											
										
											<div class="col-md-3">
												<div class="form-group">
													<label class="form-check-label">Initiated By<span class="text-required">*</span></label>
													 <input id="initiatedby" autocomplete='off' style='text-align: right;' name="initiatedby" required class="required form-control form-control-sm" type="text" value="<?php echo isset($details)?$details->initiatedby:'';?>">
											</div>
</div>									
</div>		
								
											
			</br>								                                        
 <div class='row'>
		<div class="col-md-12" style="background-color: darkslategrey;padding: 5px;">
    <div class="form-group mb-0">
        <div class="row">
		    <div class="col-md-2 text-white" align='center'>
				Item Code 
      
			<a class="btn-primary" id='newitementer' data-target=".newitem_ajax" data-toggle="modal" style="cursor:pointer;  color:orange !important"></a> 
			</div>	
            <div class="col-md-3 text-white" align='center'>
               Item Name 
            </div>
            <div class="col-md-3 text-white"  align='center'>
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
			<div class="col-md-1 text-white" align='center'>
              <a style='cursor:pointer;padding:0px 0px;color:#FFFFFF' style="padding: 0px;" id='addNew' class="btn-sm">[Add row]</a>
            </div>
        </div>
    </div>
</div>
        <!-- Main Row -->
        <div  id='firstLine' class="mt-3 col-md-12">
		<?php
		if(!isset($detailsrecords)){
		?>
		<div class="form-group">
		<div class="row mb-3">	
            <div class="col-md-2" align='center'>
				<select name="itemcode[]" id='itemcode_1' class="itemcode form-control-sm form-control w-100">
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
			
			<div class="col-md-3">
				<input type="text" name='description[]' class="description form-control form-control-sm border-1 w-100" id='description_1' value=''>
			</div>
			<div class="col-md-1">
				
				<input type="text" name="quantity[]"  id='quantity_1' style='text-align: right;' onkeypress="return isNumberKey(event)" class="quantity w-100 form-control form-control-sm" value='0'>
			</div>
			<div class="col-md-1">
			<input type="text" name="unitprice[]"  id='unitprice_1' style='text-align: right;' onkeypress="return isNumberKey(event)" class="unitprice w-100 form-control form-control-sm" value='0'>
				
			</div>
			
			<div class="col-md-1">
				<input type="text" name="amount[]" id='amount_1' style='text-align: right;' readonly class="w-100 amount form-control form-control-sm"  value='0'>
			</div>			
			</div>
		</div>
		<?php }else{ ?>
			
			<?php 
			foreach($detailsrecords as $temp){				
			?>
			
			<div class="form-group">
			<div class="row mb-2">
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
			   
			   <div class="col-md-3">
				<input name="itemname[]" id='itemname_1' class="itemname form-control form-control-sm w-100" value="<?php echo isset($temp)?$temp->itemname:'';?>">
			</div>
			
				<div class="col-md-3">
					<input type="text" name='description[]' class="description form-control form-control-sm text-center w-100 " value="<?php echo isset($temp)?$temp->description:'';?>">
				</div>
				<div class="col-md-1">
					<input type="text" name='quantity[]'  id='quantity_1' style='text-align: right;' onkeypress="return isNumberKey(event)" class="quantity form-control form-control-sm w-100"  value="<?php echo isset($temp)?$temp->quantity:'';?>" style='text-align: right;'>
				</div>
				<div class="col-md-1">
					<input type="text" name="unitprice[]"  id='unitprice_1' class="unitprice form-control form-control-sm w-100 " value="<?php echo isset($temp)?$temp->unitprice:'';?>" style='text-align: right;'>
				</div>
				
				<div class="col-md-1">
					<input type="text" name="amount[]" id='amount_1' class='form-control form-control-sm amount w-100' readonly style='text-align: right;' value="<?php echo isset($temp)?$temp->amount:'';?>">
				</div>			
			
			</div>
			</div>
			
			<?php } ?>			
		<?php } ?>	
		
		</div>
		<!-- Main Row -->
	<div class="row"></div>	
<div class="col-md-12">
	  <div class="form-group">
          <div class="row">		
			<div class="col-md-1"  align='center'>
				
			</div>		
			<div class="col-md-4 mt-4" align='center' style='margin-top:5px'>
				
			</div>
			<div class="col-md-2 " align='center'>
			
			</div>
			<div class="col-md-2 mt-4" align='center'>
				VAT
			</div>
			
			<div class="col-md-2 mt-4" align='center'>
				 <input type="hidden" id="vat" name="vat" value="<?php echo $vat->vat;?>">
				<input type="text" class="form-control form-control-sm" name="vat" id="vat_amount" readonly style="text-align: right;" value="<?php echo isset($details)?$details->vat:'';?>">
			</div>
			 </div>
		</div>	
		</div>
		<!-- Main Row -->
		<div class="form-group col-md-12">
       <div class="row">			
			<div class="col-md-1"  align='center'>
				
			</div>		
			<div class="col-md-4" align='center' style='margin-top:5px'>
				
			</div>
			<div class="col-md-2" align='center'>
				
			</div>
			<div class="col-md-2" align='center'>
				Total
			</div>
			
			<div class="col-md-2" align='center'>
				<input type=text class='form-control form-control-sm totalamount' style='text-align: right;' name='totalamount' id='totalamount' readonly value="<?php echo isset($details)?$details->totalamount:'0';?>">
			</div>
			</div>	
		</div>	
		
		<div class="row col-md-12">
			<div class="col-md-6">
			<div class="form-group">
			<label class="form-check-label">Prepared By<span class="text-required">*</span></label>
			<input type="text" id="preparedby" name="preparedby" class="required form-control form-control-sm" value='<?php echo isset($details)?$details->preparedby:"";?>'>
			</div>
		</div>
											
							
		<div class="col-md-6">
			<div class="form-group">
			<label class="form-check-label">Authorized By<span class="text-required">*</span></label>
		    <input id="authorizedby" name="authorizedby" class="required form-control form-control-sm " type="text" value='<?php echo isset($details)?$details->authorizedby:"";?>'>
			</div>
			</div>	
		</div>
	
</div>     							    </br>
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
						</div>
					</div>
	
		</div>
    </section>
</div>


    <script>
            $(document).ready(function () {
		
				i = 1;
				$("#addNew").click(function(){
					 i++;
					 $.ajax({
					  url: "<?php echo base_url();?>purchase/get_purchasequoterow",
					  type:"POST",
					  data: {
						rowid : i
					  },
					  success: function( data ) {
						  $("#firstLine").append(data);		
					  }
					});
				});
				
				
	$(document).on("focus",".quantity,.unitprice,.discount",function(){
		if($(this).val() == '0')
			$(this).val('');
	});
	$(document).on("blur",".quantity,.unitprice,.discount",function(){
		if($(this).val() == '')
			$(this).val('0');
	});	
	
			$(document).on("keyup",".quantity",function(){					
					 id = $(this).attr("id");
					 id = id.split("_");
					 
					 if($("#unitprice_"+id[1]).val() != '0'){
						 if($.isNumeric($(this).val())){
							total = parseFloat($("#unitprice_"+id[1]).val()) * parseFloat($(this).val());
							$("#amount_"+id[1]).val(total);
						 }
					 }		
                   var subtotal = 0;
					  $(".amount").each(function() {
						subtotal += parseFloat($(this).val());
					  });

					  var vat = parseFloat($("#vat").val());
					  var vatAmount = (subtotal * vat) / 100;
					  var totalAmount = subtotal + vatAmount;

					  $("#vat").val(vat);
					  $("#totalamount").val(totalAmount);
					  $("#vat_amount").val(vatAmount);
					 
			});
			
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
					  url: "<?php echo base_url();?>purchase/ajax_addsupplier",
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
			   
			   $(document).on("click",".delrow",function(){
				  $(this).parent().parent().remove(); 
			   });
			   
			   $("#purchasequoteform").submit(function(){
				    loop = false;
				    $(".quantity").each(function(){
						if($(this).val() == '0'){
							new PNotify({
								title: 'Purchase Quote',
								text: 'Quantity must be greater than 0',
								type: 'warning'
							});
							
							$(this).focus();
							
							loop = true;
							return false;
						}
					});
					
					if(loop)
						return false;
			   });
});
	
    </script>
