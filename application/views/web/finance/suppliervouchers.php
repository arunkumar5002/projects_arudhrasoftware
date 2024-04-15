<?php echo load_datatables(); ?>
<style>
#FormModalHeading{
	margin-bottom:-5px;
}
</style>
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
                        <li class="breadcrumb-item"><a href="<?php echo base_url()?>Accounts/customer_receipt"> Customer Receipt</a></li>
                        
                    </ol>
                </div>
            </div>
			
			
			<div class="row">
				<div class="col-12">
				 <div class="card">
				  <div class="card-body">
                    <script src="<?php echo base_url()?>site/admin/js/input_mask/jquery.inputmask.js"></script>
					<script>
						$(document).ready(function () {
							$(":input").inputmask();
						});
					</script>
					<div class="row" style="float: right;">
					<div class="col-md-12">
                <h3>
                  <span><?php if(isset($previous)){ ?> <a class='btn btn-primary btn-sm' href='<?php echo base_url()?>accounts/salesvoucher/<?php echo $previous;?>'>Prev</a> <?php } ?> <?php if(isset($next->voucherid)){ ?> <a href='<?php echo base_url()?>accounts/salesvoucher/<?php echo $next->voucherid;?>' class='btn btn-primary btn-sm'>Next</a> <?php }else { ?> <a href='<?php echo base_url()?>accounts/salesvoucher' class='btn btn-primary btn-sm'>New</a> <?php } ?></span>
                </h3>
                      </div>  
                    </div>
					</div>
					
					 <div class="container">
							  <form id="voucherform" data-parsley-validate class="form-horizontal form-label-left" method='post' action="<?php echo base_url()?>accounts/savepurchasevoucher">
									<input type=hidden name='voucherid' value='<?php echo isset($voucherid)?$voucherid:""?>'>
                                        <div class="container">	
                                       <div class="row">	
									   <div class="form-group col-md-3">
                                            <span class="control-label pull-left" for="customername">Voucher Number<span class="required">*</span>
                                            </span>
                                            <div class="">
                                                <input type="text" style='text-align: right;' readonly value='<?php echo $vouchernumber;?>' id="vouchernumber" name="vouchernumber" required="required" class="form-control form-control-sm">
                                            </div>
                                        </div>
										
										 <div class="form-group col-md-3">
                                            <span for="website" class="control-label  pull-left">Voucher Date<span class="required">*</span></span>
                                            <div class="">
                                                <input id="voucherdate" name="voucherdate" data-inputmask="'mask': '99-99-9999'" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])-(0[1-9]|1[012])-[0-9]{4}" class="tabp required form-control form-control-sm" type="text" autocomplete="off" value='<?php echo isset($voucherdate)?date("d-m-Y",strtotime($voucherdate)):""?>'>
                                            </div>
                                        </div>
										
                                        <div class="form-group col-md-3">
                                            <span for="website" class="control-label">Invoice No<span class="required">*</span></span>
                                            <div class="">
											<input type='hidden' id='vouchertype' name='vouchertype' value='1'>
												<select id="invoiceno" name="invoiceno" class="tabp required form-control form-control-sm">
													<option value="">Choose..</option>
													<?php 			
													if(isset($purchaseinvoiceno) && !empty($purchaseinvoiceno))
													{
															foreach( $purchaseinvoiceno as $tmp1)
															{
																
																
																 if(isset($invoiceno) && !empty($invoiceno) && ($tmp1->invoicenumber == $invoiceno) && ($invoiceno != 0))
																{
																?>
																		<option selected='selected' value='<?php echo $tmp1->purchaseinvoiceid; ?>' ><?php echo $tmp1->invoicenumber; ?></option>											
																<?php
															}
															else{ ?>
																		<option  value='<?php echo $tmp1->purchaseinvoiceid; ?>' ><?php echo $tmp1->invoicenumber; ?></option>											
																<?php 
																} 
															}
													}
													?>
												</select>
												
                                            </div>
                                        </div>
                                        
                                     
                                        <div class="form-group col-md-3">
                                            <span class="control-label col-md-5 " for="customername" id=''>Paid To
                                            </span>
                                            <div class="">
                                                <input type="text" id="towhom" name="towhom" class="tabp required form-control form-control-sm" value='<?php echo isset($towhom)?$towhom:"";?>'>
                                            </div>
                                        </div>
                                        
										
										 <div class="form-group col-md-3" id='inamtdisplay' name='inamtdisplay' style='display:none;' >
                                            <span for="website" class="control-label ">Invoice Amount</span>
                                            <div class="">
										            <input type="text" id="invamt" name="invamt" class="tabp required form-control form-control-sm" value='0' readonly >
                                    
                                            </div>
                                        </div>
										</div>
										</div>
									
                                        
                                        
              <div class='row'></div><br>
			  <div class="container">
        <div class="form-group" style='background-color:#EAEAEA'>
           <div class="row">		
			<div class="col-md-1"  align='center'>
				S.No
			</div>		
			<div class="col-md-4" align='center'>
				Account Name [ <a style='cursor:pointer' data-toggle="modal" data-target=".chart_of_accounts_ajax" class='btn-primary' id="newaccountname" >New</a> ]
			</div>
			<div class="col-md-2" align='center'>
				Debit
			</div>
			<div class="col-md-2" align='center'>
				Credit
			</div>
			<div class="col-md-2" align='center'>
				Reference
			</div>
			<div class="col-md-1" align='center'>
				
			</div>	
		</div>	
		</div>
        <!-- Main Row -->        
        <div  id='firstLine'>
		<?php
		if(!isset($records)){
		?>
		<div class="form-group">
           <div class="row">		
			<div class="col-md-1 rowid " style='margin-top:5px' align='center'>
				1
			</div>		
			<div class="col-md-4">
				<input type="text" name="accountname[]" class="tabp accountname form-control form-control-sm">				
			</div>
			<div class="col-md-2">
				<input type="text" id='debit_1' name="debit[]" style='text-align: right;' value='0' onkeypress="return isNumberKeyPeriod(event)" class="tabp debit form-control form-control-sm" value=''>
			</div>
			<div class="col-md-2">
				<input type="text" id='credit_1' name="credit[]" style='text-align: right;' value='0' onkeypress="return isNumberKeyPeriod(event)" class="tabp credit form-control form-control-sm">
			</div>
			<div class="col-md-2">
				<input type="text" name="reference[]" class="tabp reference form-control form-control-sm">
			</div>
			<div class="col-md-1" style='padding-left:10px;'>
				<a style='cursor:pointer;padding:0px 0px' id='addNew' class="btn btn-success btn-sm">Add row</a>
			</div>	
		</div>
		</div>
		
		
		<div class="form-group">
         <div class="row">		
			<div class="col-md-1 rowid" style='margin-top:5px' align='center'>
				2
			</div>		
			<div class="col-md-4">
				<input type="text" name="accountname[]" class="tabp accountname form-control form-control-sm">				
			</div>
			<div class="col-md-2">
				<input type="text" id='debit_2' name="debit[]" style='text-align: right;' value='0' onkeypress="return isNumberKeyPeriod(event)" class="tabp debit form-control form-control-sm" value=''>
			</div>
			<div class="col-md-2">
				<input type="text" id='credit_2' name="credit[]" style='text-align: right;' value='0' onkeypress="return isNumberKeyPeriod(event)" class="tabp credit form-control form-control-sm">
			</div>
			<div class="col-md-2">
				<input type="text" name="reference[]" class="tabp reference form-control form-control-sm">
			</div>
			<div class="col-md-1" style='padding-left:30px;margin-top:7px'>
				
			</div>
            </div>			
		</div>
		<?php
		}else{
			//edit voucher
			$i = 1;
			foreach($records as $tmp){
		?>
			<div class="form-group">
              <div class="row">			
				<div class="col-md-1 rowid" style='margin-top:5px' align='center'>
					<?php echo $i;?>
				</div>		
				<div class="col-md-4">
					<input type="text" name="accountname[]" class="tabp accountname form-control form-control-sm" value='<?php echo get_accountname($tmp->accountname)?>'> 
					
				</div>
				<div class="col-md-2">
					<input type="text" id='debit_<?php echo $i; ?>' name="debit[]" style='text-align: right;' maxlength='10' onkeypress="return isNumberKeyPeriod(event)" class="tabp debit form-control form-control-sm" value='<?php echo $tmp->debit?>'>
				</div>
				<div class="col-md-2">
					<input type="text" id='credit_<?php echo $i; ?>' name="credit[]" style='text-align: right;' maxlength='10' onkeypress="return isNumberKeyPeriod(event)" class="tabp credit form-control form-control-sm" value='<?php echo $tmp->credit?>'>
				</div>
				<div class="col-md-2">
					<input type="text" name="reference[]" class="tabp reference form-control form-control-sm" value='<?php echo $tmp->reference?>'>
				</div>
			
				<div class="col-md-1"  <?php if($i == 1){ ?>style='padding-left:20px;' <?php } ?> >
					
					
					<?php
						if($i == 1){
					?>
					<a style='cursor:pointer;padding:0px 0px' id='addNew' class="btn btn-success btn-sm">Add row</a>
					<?php
						} else {
					?>
					<a style='cursor:pointer;padding:0px 0px' class="delRow btn btn-warning">Delete</a>
					<?php 	
						}
					?>
				</div>	
				</div>
			</div>
		<?php
				$i++;
			}
		}
		?>
		</div>                                
		<!-- Main Row -->
		<div class="form-group"> 
           <div class="row">		
			<div class="col-md-1" style='margin-top:5px' align='center'>
				
			</div>		
			<div class="col-md-4" align='right'>
				Total
			</div>
			<div class="col-md-2" align='center'>
				<input type=text class='form-control form-control-sm' style='text-align: right;' name='totaldebit' id='totaldebit' value='<?php echo isset($totaldebit)?$totaldebit:"0"?>' readonly>
			</div>
			<div class="col-md-2" align='center'>
				<input type=text class='form-control form-control-sm' style='text-align: right;' name='totalcredit' id='totalcredit' value='<?php echo isset($totalcredit)?$totalcredit:"0"?>' readonly>
			</div>
			<div class="col-md-2" align='center'>
				
			</div>
			<div class="col-md-1" style='margin-top:5px' align='center'>
				
			</div>	
			</div>
		</div>	
		<br>
		<div class="form-group">	
			
			<div class="col-md-12" align='center'>
				<textarea placeholder='Narration' class='tabp form-control' name='narration' id='narration'><?php echo isset($narration)?$narration:""?></textarea>
			</div>				
		</div>	
										<Br>
										<div class="row">
										 <div class="form-group col-md-6">
                                            <span class="control-label" for="customername">Prepared By <span class="required">*</span>
                                            </span>
                                            <div class="">
                                                <input type="text" id="preparedby" name="preparedby" class="tabp required form-control form-control-sm" value='<?php echo isset($preparedby)?$preparedby:logged_user();?>'>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group col-md-6">
                                            <span for="website" class="control-label">Authorized By  </span>
                                            <div class="">
                                                <input id="authorizedby" name="authorizedby" class="tabp required form-control form-control-sm" type="text" value='<?php echo isset($authorizedby)?$authorizedby:"";?>'>
                                            </div>
                                        </div>
										</div>
                                        <input type=hidden id='achidden' value='0'>
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-12 col-md-offset-3">
                                                <button type="submit" class="tabp btn btn-success btn-sm" id='submitButton'>Submit</button>
												<button type="reset" class="btn btn-primary btn-sm">Cancel</button>
                                            </div>
                                        </div>

                                    </form>
									</div>
									</div>
			<!-- table end -->
			
			</div>
			</div>
			</div>
			</div>
			</section>
			</div>
<script>
	$("#newaccountname").click(function() {
		$("#FormModal1").modal('show');

	});
</script>			
			
<script>
            $(document).ready(function () {
				$(".select2_single").select2({
                    placeholder: "Select Account Name",
                    allowClear: true
                });
				/*$("#addNew").click(function(){
					var line = $("#firstLine").html();
					$("#firstLine").append().after("<div class='form-group'>"+line+"</div>");				
				
				$('#voucherdate').daterangepicker();*/
				<?php if(isset($records)) { ?>
					row = <?php echo count($records); ?>;
				<?php } else { ?>
					row  = 2;
				<?php } ?>
				
				
				$("#addNew").click(function(){
					 row++;
					 $.ajax({
					  url: "<?php echo base_url();?>accounts/get_voucherrow",
					  type:"POST",
					  data: {
						row:row,
					  },
					  success: function( data ) {
						  $("#firstLine").append(data);		
					  }
					});
				});
				
				$(document).on('blur',".accountname", function() {
					if($("#achidden").val() != '1'){
						$(this).val('');
					}
				});
				
				$(document).on('keypress',"#towhom", function() {
					$(this).autocomplete({
						source: function( request, response ) {
						$.ajax({
							url: "<?php echo base_url();?>accounts/get_towhom",
							method: "POST",
							dataType: "json",
							data: {
								key: request.term,
								type: $("#vouchertype").val()
							},
							success: function( data ) {
								response( data );
							}
						});
						}
					});
				});
				
				
				$(document).on('keypress',".accountname", function() {
					$("#achidden").val('0');
					$(this).autocomplete({
						source: function( request, response ) {
						$.ajax({
							url: "<?php echo base_url();?>accounts/get_accountname",
							method: "POST",
							dataType: "json",
							data: {
								key: request.term
							},
							success: function( data ) {
								response( data );
							}
						});
						},
						select: function( event, ui ) {
							 /*$(".accountname").each(function(){
								 if($(this).val() == ui.item.value){
									 ui.item.value = '';
									 alert("Already choosed the account name");
								 }
							 });*/
							 $("#achidden").val('1');
						}
					});
				});
				<?php
				$yeardata = get_defaultyeardata();
				if(!empty($yeardata)){
				?>
				
				/*$("#voucherdate").datepicker({
					dateFormat: "dd-mm-yy",
					minDate: new Date('<?php echo !empty($yeardata)?$yeardata->startdate:"0";?>'),
					maxDate: new Date('<?php echo !empty($yeardata)?$yeardata->enddate:"0";?>'),
					onSelect: function (dateText, inst) {
						 $("#voucherdate").focus();
					 }
				});*/
				<?php
				}
				?>	
				
				$(document).on("focus",".debit",function(){
					if($(this).val() == '0')
						$(this).val('');
				});
				$(document).on("blur",".debit",function(){
					if($(this).val() == '')
						$(this).val('0');
				});
				
				$(document).on("focus",".credit",function(){
					if($(this).val() == '0')
						$(this).val('');
				});
				$(document).on("blur",".credit",function(){
					if($(this).val() == '')
						$(this).val('0');
				});
				
				//Add debit values for totaldebit
				$(document).on("keyup",".debit",function(){
					
					var creditcheck = $(this).attr('id');
					var getid = creditcheck.substring(6);
					var	creaditval = $('#credit_'+getid).val();
					
					if(parseFloat(creaditval) != 0 )
					{
						//alert('Please check Credit Value!!!.');	
						$(this).val(0);
					}
					
					if($(this).val() != ''){
						 var totaldebit = 0;
						 $(".debit").each(function(){
							 totaldebit = parseFloat(totaldebit) + parseFloat($(this).val());
						 });
						 
						 $("#totaldebit").val(totaldebit.toFixed(2));
					}
					
					
				});
				
				$(document).on("keyup",".credit",function(){
					
					var creditcheck = $(this).attr('id');
					var getid = creditcheck.substring(7);
					var	creaditval = $('#debit_'+getid).val();
					
					if(parseFloat(creaditval) != 0 )
					{
						//alert('Please check Debit Value!!!.');	
						$(this).val(0);
					}
					
					
					
					if($(this).val() != ''){
						 var totalcredit = 0;
						 $(".credit").each(function(){
							 totalcredit = parseFloat(totalcredit) + parseFloat($(this).val());
						 });
						 
						 $("#totalcredit").val(totalcredit.toFixed(2));
					}
				});
				//Add debit values for totaldebit
				
            });
			
        </script>
        
	<script type="text/javascript">
        $(function () {
            
			$("#vouchertype").change(function(){
				$("#towhom").val('');
				if($(this).val() == 1){
					$(".towhom").show();					
					$("#typechange").html("Paid To");
				}else if($(this).val() == 3){
					$(".towhom").show();
					//$("#typechange").html("Receivables From");
					var str = '<select name="vtype_journal" style="height:20px">';
					str += '<option value="1">Receivables From</option>';
					str += '<option value="2">Payable To</option>';
					str += '<option value="3">Provision</option>';
					str += '</select>';
					$("#typechange").html(str);
				}else if($(this).val() == 2){
					$(".towhom").show();
					$("#typechange").html("Received From");
				}else if($(this).val() == 4){
					$(".towhom").hide();
				}

				 $.ajax({
					  url: "<?php echo base_url();?>accounts/get_voucherno",
					  type:"POST",	  
					  data: {
						vouchertype: $(this).val()
					  },
					  success: function( data ) {
						 $("#vouchernumber").val(data);
						
					  }
					});
				 
			});
			
			if(<?php echo (isset($vouchertype) && $vouchertype == 1)?"true":"false";?>){
					$(".towhom").show();					
					$("#typechange").html("Paid To");
			}else if(<?php echo (isset($vouchertype) && $vouchertype == 3)?"true":"false";?>){
				$(".towhom").show();
				$("#typechange").html("Receivables From");
			}else if(<?php echo (isset($vouchertype) && $vouchertype == 2)?"true":"false";?>){
				$(".towhom").show();
				$("#typechange").html("Received From");
			}else if(<?php echo (isset($vouchertype) && $vouchertype == 4)?"true":"false";?>){
				$(".towhom").hide();
			}
			
			
			$("#voucherform").submit(function(){				
				$(".glyphicon-remove").trigger("click");
				if($("#voucherdate").val() == ''){
					new PNotify({
						title: 'Warning',
						text: 'Sales Voucher Date field is missing',
						type: 'error'
					});
					$("#voucherdate").focus();
					return false;
				}else{
					
					<?php
						$yeardata = get_defaultyeardata();
						if(!empty($yeardata)){
					?>
					
					var d = $.datepicker.parseDate("yy-mm-dd",  '<?php echo !empty($yeardata)?$yeardata->startdate:"0";?>');
					var startdate = $.datepicker.formatDate( "yy-mm-dd", d);
					
					var d = $.datepicker.parseDate("yy-mm-dd",  '<?php echo !empty($yeardata)?$yeardata->enddate:"0";?>');
					var enddate = $.datepicker.formatDate( "yy-mm-dd", d);
					
					var d1 = $.datepicker.parseDate("dd-mm-yy",  $("#voucherdate").val());
					var voucherdate = $.datepicker.formatDate( "yy-mm-dd", d1);
					
									
					
					if(new Date(startdate) <= new Date(voucherdate) && new Date(enddate) >= new Date(voucherdate)){			
					}
					else{
						new PNotify({
							title: 'Warning',
							text: 'Enter the date between financial year period',
							type: 'error'
						});
						$("#voucherdate").focus();
					
						return false;
					}
					
					<?php
					}
					?>	
				}
				
				/*if($("#towhom").val() == '' && $("#vouchertype").val() == 1){
					new PNotify({
						title: 'Warning',
						text: 'Paid To field is missing',
						type: 'error'
					});
					$("#towhom").focus();
					return false;
				}
				
				if($("#towhom").val() == '' && $("#vouchertype").val() == 2){
					new PNotify({
						title: 'Warning',
						text: 'Received From field is missing',
						type: 'error'
					});
					$("#towhom").focus();
					return false;
				}
				
				if($("#towhom").val() == '' && $("#vouchertype").val() == 3){
					new PNotify({
						title: 'Warning',
						text: 'Receivables From field is missing',
						type: 'error'
					});
					$("#towhom").focus();
					return false;
				}*/
					
				acnameCheck = true;
				$(".accountname").each(function(){
					if($(this).val() == ''){
						new PNotify({
							title: 'Warning',
							text: 'Accountname field is missing',
							type: 'error'
						});
						acnameCheck = false;
						return false;
					}
				});
				
				if(acnameCheck == false)
					return false;
				
				if($("#totaldebit").val() == '0' && $("#totalcredit").val() == '0'){
						new PNotify({
							title: 'Warning',
							text: 'Debit & Credit fields are missing',
							type: 'error'
						});
						return false;
				}
				
				
				if($("#preparedby").val() == ''){
					new PNotify({
						title: 'Warning',
						text: 'Prepared By field is missing',
						type: 'error'
					});
					$("#preparedby").focus();
					return false;
				}
			
				
				if($("#totaldebit").val() != $("#totalcredit").val()){
						new PNotify({
							title: 'Warning',
							text: 'Debit & Credit values are not equal',
							type: 'error'
						});
						return false;
				}
				
				$('button[type=submit]').attr('disabled',true);
				var overlay = jQuery('<div id="overlay"> </div>');
				overlay.appendTo(document.body);
				
			});
			
			$('body').keydown(function(event) {
						if(event.which == 113) { //F2
							$("#addNew").trigger("click");
						}					
					});
			
			
			$('#voucherform').on('keyup keypress', function(e) {
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
			
			
			$("#vouchertype").focus();
			
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
				else if (e.keyCode == 27)
				{					
					focusable = form.find('.tabp').filter(':visible');
					next = focusable.eq(focusable.index(this)-1);
					if (next.length) {
						next.focus();
					} 
					return false; 
				}
			});
			
			$(document).on("click",".delRow",function(){
				e = confirm("Do you want to delete the row?");
				
				if(e){
					$(this).parent().parent().remove();
					
					rowid = 1;
					$(".rowid").each(function(){
						$(this).html(rowid);
						rowid++;						
					});
					
					 var totaldebit = 0;						
					debitid = 1;
					$(".debit").each(function(){						
						$(this).attr('id','debit_'+debitid);	
						 totaldebit = parseInt(totaldebit) + parseInt($(this).val());						
						debitid++;	
					});
					$("#totaldebit").val(totaldebit.toFixed(2));
					
					 var totalcredit = 0;	 
					creditid = 1;
					$(".credit").each(function(){						
						$(this).attr('id','credit_'+creditid);
						totalcredit = parseInt(totalcredit) + parseInt($(this).val());					
						creditid++;	
					});
					$("#totalcredit").val(totalcredit.toFixed(2));	
					
					row--;
					debitid--;
					creditid--;
				}
			});
			
				  <?php
			        if($this->session->flashdata('voucher_created')){
			      ?>
						new PNotify({
							title: 'Voucher',
							text: '<?php echo $this->session->flashdata('voucher_created');?>',
							type: 'success'
						});
				  <?php 
					}
				  ?>
			/*$(document).on("click",".delRow",function(){
				
			    $( "#dialog-confirm" ).dialog({
				  resizable: false,
				  height:140,
				  modal: true,
				  buttons: {
					"Ok": function() {
					  $( this ).dialog( "close" );
					},
					Cancel: function() {
					  $( this ).dialog( "close" );
					}
				  }
				});
				
			});*/
			
        });
    </script>
<!--
<style>
	#dialog-confirm{
		height: 60px !important;
	}
	.ui-dialog-titlebar-close{
		display:none;
	}
</style>
<div id="dialog-confirm" title="Delete Voucher Row">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Do you want to delete the row?</p>
</div>
-->

<script type='text/javascript'>
		  $(document).ready(function () {
			   $("#maingroup").change(function(){
				   $.ajax({
					  url: "<?php echo base_url();?>web/get_category",
					  type:"POST",	  
					  data: {
						maingroup: $(this).val()
					  },
					  success: function( data ) {
						 $("#category").html(data);
						 $("#category").trigger("change");
					  }
					});
			   });
			   
			   $("#category").change(function(){				  
				   $.ajax({
					  url: "<?php echo base_url();?>web/get_subcategory",
					  type:"POST",	  
					  data: {
						category: $(this).val()
					  },
					  success: function( data ) {
						 if(data){
							$("#subcategory").removeAttr("disabled");
							$("#subcategory").html(data);
							if($("#editsubcategory").val()){
								$("#subcategory").val($("#editsubcategory").val());
							}
							$("#editsubcategory").val('');
						 }
						 else{
							 $("#subcategory").html(data);
							 $("#subcategory").attr("disabled","true");
						 }
					  }
					});
			   });
			   $("#subcategory").change(function(){				  
				   $.ajax({
					  url: "<?php echo base_url();?>web/get_subsubcategory",
					  type:"POST",	  
					  data: {
						subcategory: $(this).val()
					  },
					  success: function( data ) {
						 if(data){
							$("#subsubcategory").removeAttr("disabled");
							$("#subsubcategory").html(data);
						 }
						 else{
							 $("#subsubcategory").html(data);
							 $("#subsubcategory").attr("disabled","true");
						 }
					  }
					});
			   });
			   
			     $("#newaccountname").click(function(){
					 
					 $("#acname").val('');
					 $("#subcategory").val('');
					 $("#category").val('');
					 $("#maingroup").val('');
					 
				 });
				 
			     $("#saveac").click(function(){
				   $.ajax({
					  url: "<?php echo base_url();?>web/addcontactaccountname",
					  type:"POST",	 
					  dataType: "json",
					  data: {
						maingroup: $("#maingroup").val(),
						category: $("#category").val(),
						subcategory: $("#subcategory").val(),
						subsubcategory: $("#subsubcategory").val(),
						acname: $("#acname").val()
					  },
					  success: function( data ) {
						  if(data.success == true){
							window.location.href='<?= base_url() .'voucher' ?>';
						  }
					  }
					});
			   });
			     $("#invoiceno").val(<?php echo $invoicenum;?>);
			     $("#invoiceno").change(function(){
				   $.ajax({
					  url: "<?php echo base_url();?>web/purchaseinvoiceamount",
					  type:"POST",	 					  
					  data: {
						invoiceno:$(this).val(), 
					  },
					  success: function( data ) {
						
						if(data != '-')
						{
							$('#inamtdisplay').show();
							$('#invamt').val(data);
						}
						else
						{
							$('#inamtdisplay').hide();	
						}	
					  }
					});


					$.ajax({
					  url: "<?php echo base_url();?>web/purchaseinvoice_suppliername",
					  type:"POST",	 					  
					  data: {
						invoiceno:$(this).val(), 
					  },
					  success: function( data ) {
						
						if(data != '-')
						{
							$('#inamtdisplay').show();
							$('#towhom').val(data);
						}
						else
						{
							$('#inamtdisplay').hide();	
						}	
					  }
					});
			   });
			   $("#invoiceno").trigger("change");
			   <?php if(isset($invoiceno) && !empty($invoiceno) && ($invoiceno != 0)) 
			   {
				   ?>
				    $.ajax({
					  url: "<?php echo base_url();?>web/invoiceamount",
					  type:"POST",	 					  
					  data: {
						invoiceno:<?php echo $invoiceno; ?>, 
					  },
					  success: function( data ) {
						
						if(data != '-')
						{
							$('#inamtdisplay').show();
							$('#invamt').val(data);
						}
						else
						{
							$('#inamtdisplay').hide();	
						}	
					  }
					});
			   
			   <?php } ?>
			   
			});
			   
		</script>
		
		<div class="modal fade show" id="FormModal1" aria-modal="true" role="dialog">
	<div class="modal-dialog modal-lg">
		<form id="vendorDataForm" autocomplete="OFF">
			<input type="hidden" name="row_id" id="row_id" />
			<div class="modal-content">
				<div class="modal-header">
					<h4 id="FormModalHeading">Create A/C Name</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">

						<div class="col-md-4">
							<div class="form-group">
								<label class="form-check-label">Main Group <span class="text-required">*</span></label>
								<select class='form-control form-control-sm' name='maingroup' id='maingroup'>
									<?php
									if (isset($maingroup) && !empty($maingroup)) {
										echo "<option value=''>--Select--</option>";
										foreach ($maingroup as $tmp) {
											echo "<option value='" . $tmp->groupid . "'>$tmp->groupname</option>";
										}
									}
									?>
								</select>
							</div>
						</div>


						<div class="col-md-4">
							<div class="form-group">
								<label class="form-check-label">Main Category <span class="text-required">*</span></label>
								<select class='form-control form-control-sm' name='category' id='category'>

								</select>
							</div>
						</div>


						<div class="col-md-4">
							<div class="form-group">
								<label class="form-check-label">Category <span class="text-required">*</span></label>
								<select class='form-control form-control-sm' name='subcategory' id='subcategory'>

								</select>
							</div>
						</div>



						<div class="col-md-4">
							<div class="form-group">
								<label class="form-check-label">Sub Category <span class="text-required">*</span></label>
								<select class='form-control form-control-sm' name='subsubcategory' id='subsubcategory'>

								</select>
							</div>
						</div>

						<div class="col-md-2">
							<div class="form-group">
								<a href="<?php echo base_url() ?>web/account_subcategory" class="btn btn-primary btn-sm" style="margin-top: 23px;
                        margin-left: 10px;">+ Add</a>
							</div>
						</div>


						<div class="col-md-6">
							<div class="form-group">
								<label class="form-check-label">A/C Name <span class="text-required">*</span></label>
								<input type=text class='form-control form-control-sm' name='acname' id='acname' style="text-transform: capitalize;">
							</div>
						</div>



					</div>
				</div>
				<div class="modal-footer" style="text-align:left !important;">
					<button type="button" class="btn btn-info btn-sm" id="closeclick" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary btn-sm" style="align-center" id='saveac'>Save</button>
				</div>
			</div>
		</form>
	</div>
</div>