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
						
								   <form id="grnform" data-parsley-validate class="form-horizontal form-label-left" method='post' action="<?php echo base_url()?>Accounts/savegrn">
									<input type=hidden name='grnid' value='<?php echo isset($details)?$details->grnid:"";?>'>
										<div class="row">
											<div class="col-md-3">
												<div class="form-group">
													<label class="form-check-label">GRN No <span class="text-required">*</span></label>
													<input type="text" style='text-align: right;' id="grnnumber" name="grnnumber" class="form-control form-control-sm" readonly value='<?php echo $grnnumber?>'>
												</div>
											</div>
											
							
											<div class="col-md-3">
												<div class="form-group">
													<label class="form-check-label">Date of Receipt <span class="text-required">*</span></label>
													 <input type="text" id="receiptdate" name="receiptdate" required="required" style='text-align: right;' class="datepicker form-control form-control-sm " required value='<?php echo isset($details)?date("d-m-Y",strtotime($details->issuedate)):"";?>'> 
												</div>
											</div>	
											
											
											
											<div class="col-md-3">
												<div class="form-group">
													<label class="form-check-label">Purchase Order No <span class="text-required">*</span></label>
													   <div>
											   <?php
											   if(isset($details)){
											   ?>	
												<input type=text id="purchaseorder" name="purchaseorder" required="required" class="form-control form-control-sm" value='<?php echo isset($details)?$details->purchaseordernum:"";?>' readonly>
												
											   <?php } else { ?>
                                               <select id="purchaseorder" name="purchaseorder" required="required" class="form-control form-control-sm">
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
											   <?php } ?>
                                            </div>
												</div>
												<div class="col-md-2 col-sm-2 col-xs-2" style='display:none'> 
                                               <a class='btn btn-success' id='get_purchaseorder'>Get</a>
                                            </div>
											</div>
											
											
											
											<div class="col-md-3">
												<div class="form-group">
													<label class="form-check-label">Purchase Order Date <span class="text-required">*</span></label>
													 <input type="text" id="orderdate" name="orderdate" style='text-align: right;' class="form-control form-control-sm " readonly value="<?php echo isset($purchaseorder)?date("d-m-Y",strtotime($purchaseorder->issuedate)):'';?>"> 
												</div>
											</div>	

											
											
											
												<div class="col-md-3">
												<div class="form-group">
													<label class="form-check-label">Vendor Name<span class="text-required">*</span></label>
													 <input type="text" id="supplier" readonly name="supplier" class="form-control form-control-sm " value='<?php echo isset($details)?get_contactname($details->supplierid):"";?>'>
                                                <input type="hidden" id="suppliername" name="suppliername" class="form-control form-control-sm " value='<?php echo isset($details)?$details->supplierid:"";?>'>
													
												</select>
												</div>
												
											</div>
											</div>
											
			</br>								                                        
 <div class='row'>
 <div class="col-md-12" style="background-color: darkslategrey;">
        <div class="form-group  mb-0">
          <div class="row">		
			<div class="col-md-2 text-white" align='center'>
				 Code
			</div>	
            
            <div class="col-md-3 text-white" align='center'>
				Item Name
			</div>			
			
			<div class="col-md-3 text-white" align='center'>
				Description
			</div>
			<div class="col-md-1 text-white" align='center'>
				Qty in p.o
			</div>
			<div class="col-md-1 text-white" align='center'>
				Qty
			</div>
			<div class="col-md-2 text-white" align='center'>
				Qty Difference
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
           <div class="row">		
			<div class="col-md-2" align='center'>
				<input type="text" name='itemcode[]' readonly class="itemcode form-control-sm w-100 border-1" value=''>
			</div>

            <div class="col-md-3" align='center'>
				<input type="text" name='itemname[]' readonly class="itemname form-control-sm w-100 border-1" value=''>
			</div>			
			
			<div class="col-md-3 text-center">
				<input type="text" name='description[]' readonly class="description form-control-sm border-1 w-100" id='description_1' value=''>
			</div>
			<div class="col-md-1">
				
				<input type="text" name="quantity[]"  id='quantity_1' style='text-align: right;' readonly class="quantity w-100 form-control-sm" value='0'>
			</div>
			<div class="col-md-1">
			<input type="text" name="received[]"  id='received' style='text-align: right;' onkeypress="return isNumberKeyPeriod(event)" class="received w-100 form-control-sm" value='0'>
				
			</div>
			
			<div class="col-md-2 text-center">
				<input type="text" name="difference[]" id='difference_1' style='text-align: right;' readonly class="difference form-control-sm w-100"  value='0'>
			</div>			
			</div>
		</div>
		<?php }else{ ?>
			
			<?php 
			foreach($detailsrecords as $temp){
			 				
			 $description = get_record('purchaseorderrecords','description',array('purchaseorderid'=>$details->purchaseordernum,'itemcode'=>$temp->itemid));
			 
			 $quantity = get_record('purchaseorderrecords','quantity',array('purchaseorderid'=>$details->purchaseordernum,'itemcode'=>$temp->itemid));			 
								
			?>
			
			<div class="form-group">
              <div class="row">			
				<div class="col-md-2" align='center'>
					<input type="text" name='itemcode[]' class="form-control-sm w-100 border-1" value='<?php echo isset($temp)?get_itemcode($temp->itemid):"";?>' readonly>
				</div>

                <div class="col-md-3" align='center'>
					<input type="text" name='itemname[]' class="form-control-sm w-100 border-1" value='<?php echo isset($temp)?get_item($temp->itemid):"";?>' readonly>
				</div>					
				
				<div class="col-md-3">
					<input type="text" name='description[]' class="description w-100 form-control-sm" readonly value='<?php echo $description;?>'>
				</div>
				<div class="col-md-1">
					<input type="text" name='quantity[]' readonly id='quantity_1' style='text-align: right;' class="quantity w-100 form-control-sm" onkeypress="return isNumberKeyPeriod(event)" value='<?php echo $quantity;?>'>
				</div>
				<div class="col-md-1">
					<input type="text" name="received[]"  id='received_1' style='text-align: right;' class="received w-100 form-control-sm" onkeypress="return isNumberKeyPeriod(event)" value='<?php echo isset($temp)?$temp->received:"";?>'>
				</div>
				
				<div class="col-md-2">
					<input type="text" name="difference[]" id='difference_1' readonly style='text-align: right;' class="difference w-100 form-control-sm" onkeypress="return isNumberKeyPeriod(event)" value='<?php echo isset($temp)?$temp->difference:"";?>'>
				</div>			
			</div>
			</div>
			
			
			<?php } ?>	
<?php } ?>			
		
		</div>
		<br>
<div class="row"></div>	
		<!-- Main Row -->
		<div class="form-group col-md-12">
           <div class="row">		
			<div class="col-md-2"  align='center'>
				
			</div>	
            <div class="col-md-3"  align='center'>
				
			</div>			
			<div class="col-md-3 mt-4" align='center' style='margin-top:5px'>
				
			</div>
			<div class="col-md-1 mt-4" align='center'>
				Total
			</div>
			<div class="col-md-1 mt-4" align='center'>
				<input type=text class='form-control form-control-sm' style='text-align: right;' name='totalquantity' id='totalquantity' value='<?php echo isset($details)?$details->totalquantity:"";?>' readonly>
			</div>
			
			<div class="col-md-2  mt-4" align='center'>
				<input type=text class='form-control form-control-sm' style='text-align: right;' name='totaldifference' id='totaldifference' value='<?php echo isset($details)?$details->totaldifference:"";?>' readonly>
			</div>
			</div>	
		</div>	
		
		<div class="container">
		<div class="row col-md-12">
			<div class="col-md-6">
			<div class="form-group">
			<label class="form-check-label">Notes<span class="text-required">*</span></label>
			<textarea placeholder='Notes' class='form-control form-control-sm' name='notes' id='notes'><?php echo isset($details)?$details->notes:"";?></textarea>
			</div>
		</div>
								
		<div class="col-md-6">
			<div class="form-group">
			<label class="form-check-label">Received By<span class="text-required">*</span></label>
		   <input type=text class='form-control form-control-sm' placeholder='Received By' name='receivedby' id='receivedby' value='<?php echo isset($details)?$details->receivedby:"";?>'>
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
            $(document).ready(function () {
				
				
				$("#purchaseorder").change(function(){
					$("#get_purchaseorder").trigger("click");
				});
				
				
				$("#get_purchaseorder").click(function(){
					
					$.ajax({
						url: "<?php echo base_url();?>Accounts/get_purchaseorderdetails",
						method: "POST",
						dataType: "json",
						data: {
							orderid: $("#purchaseorder").val()
						},
						success: function( data ) {
							$("#orderdate").val(data.issuedate);
							$("#suppliername").val(data.supplierid);
							$("#supplier").val(data.supplier);
						}
					});
					
					$.ajax({
						url: "<?php echo base_url();?>Accounts/get_purchaseorderrecords",
						method: "POST",
						data: {
							orderid: $("#purchaseorder").val()
						},
						success: function(data) {
							if($.trim(data) != '')
								$("#firstLine").html(data);
						}
					});
					
				});
					
				
				$(document).on("focus",".received",function(){
					if($(this).val() == '0')
						$(this).val('');
				});
				$(document).on("blur",".received",function(){
					if($(this).val() == '')
						$(this).val('0');
				});				
				
				//Add quantity values for totalquantity
				$(document).on("keyup",".received",function(){					
					  var id = $(this).attr("id");
					  id = id.split("_");
					  
					  quantity = $("#quantity_"+id[1]).val();
					  
					  if(parseInt(quantity) >= parseInt($(this).val())){
						  $("#difference_"+id[1]).val(parseInt(quantity) - parseInt($(this).val()));
						  var totalreceived = 0;						  
						  $(".received").each(function(){
							  totalreceived = parseInt(totalreceived) + parseInt($(this).val());							  
						  });						  						  
						  $("#totalquantity").val(totalreceived);
						  
						  
						  var totaldiff = 0;						  
						  $(".difference").each(function(){
							  totaldiff = parseInt(totaldiff) + parseInt($(this).val());							  
						  });						  						  
						  $("#totaldifference").val(totaldiff);
					  }else{
						  $("#difference_"+id[1]).val("0");
						  $(this).val("0");
					  }
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
						url: "<?php echo base_url();?>Accounts/get_itemdetails",
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
            
			
			$("#grnform").submit(function(){				
				
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
        });
    </script>