<?php echo load_datatables(); ?>
<style>
	#FormModalHeading {
		margin-bottom: -5px;
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
						<li class="breadcrumb-item"><a href="<?php echo base_url() ?>Accounts/vouchers"> Vouchers List</a></li>

					</ol>
				</div>
			</div>

			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							 <form id="voucherform" data-parsley-validate class="form-horizontal form-label-left" method='post' action="<?php echo base_url()?>Accounts/savevoucher">
					<div style="display: flex;
    justify-content: flex-end;width:100%;gap:10px;margin-bottom: 10px;">
									<span style='float:right'>
					   <?php if(isset($previous)){ ?> 
					   <a class='btn btn-primary btn-sm' href='<?php echo base_url()?>accounts/voucher/<?php echo $previous;?>'>Prev</a> 
					   <?php } ?> <?php if(isset($next->voucherid)){ ?> 
					   <a href='<?php echo base_url()?>accounts/voucher/<?php echo $next->voucherid;?>' class='btn btn-primary btn-sm'>Next</a> 
					   <?php } ?> <a href='<?php echo base_url()?>accounts/voucher' class='btn btn-primary btn-sm'>New</a> <?php ?></span>
								</div>

								<div class="form-group">
									<div class="row">
										
										<input type=hidden name='voucherid' value='<?php echo isset($voucherid)?$voucherid:""?>'>
										<input type='hidden' name='saveprint' id="saveprint" value=''>

										<div class="form-group col-md-4">
                                            <span>Voucher Number*</span>
                                            
                                            <div class="">
                                                <input type="text" style='text-align: right;' readonly value='<?php echo $vouchernumber;?>' id="vouchernumber" name="vouchernumber" required="required" class="form-control form-control-sm">
                                            </div>
                                        </div>
										
										 <div class="form-group col-md-4">
                                            <span>Voucher Date*</span>
                                            <div class="">
                                                <input id="voucherdate" name="voucherdate" data-inputmask="'mask': '99-99-9999'" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])-(0[1-9]|1[012])-[0-9]{4}" class="tabp required form-control form-control-sm datepicker" type="text" autocomplete="off" value='<?php echo isset($voucherdate)?date("d-m-Y",strtotime($voucherdate)):""?>' placeholder='dd-mm-yyyy'>
                                            </div>
                                        </div>

										<div class="form-group col-md-4">  
											<span>Voucher Type*</span>
                                            <div class="">
                                                <select id="vouchertype" name="vouchertype" class="tabp required form-control form-control-sm">
													<option value='1' <?php echo (isset($vouchertype) && $vouchertype == 1)?"selected":"";?>>Payment</option>
													<option value='2' <?php echo (isset($vouchertype) && $vouchertype == 2)?"selected":"";?>>Receipt</option>
													<option value='3' <?php echo (isset($vouchertype) && $vouchertype == 3)?"selected":"";?>>Journal</option>
													<option value='4' <?php echo (isset($vouchertype) && $vouchertype == 4)?"selected":"";?>>Contra</option>
													<option value='5' <?php echo (isset($vouchertype) && $vouchertype == 5)?"selected":"";?>>Purchase</option>
													<option value='6' <?php echo (isset($vouchertype) && $vouchertype == 6)?"selected":"";?>>Sales</option>
													<option value='7' <?php echo (isset($vouchertype) && $vouchertype == 7)?"selected":"";?>>Debit Note</option>
													<option value='8' <?php echo (isset($vouchertype) && $vouchertype == 8)?"selected":"";?>>Credit Note</option>
												</select>
                                            </div>
                                        </div>

								<div class="clear"></div>
                                        
                                        <div class="form-group col-md-4 towhom">
                                            <span for="customername" id='typechange'>Paid To :</span>
                                            <div class="">
                                                <input type="text" id="towhom" name="towhom" class="tabp required form-control form-control-sm" value='<?php echo isset($towhom)?$towhom:"";?>'>
                                            </div>
                                        </div>
                                        
                                      <div class="form-group col-md-4 voucherlink">
                                            <span class="control-label" for="customername" id=''>Bill Number </span>
                                            <div class="">
                                                <select id="voucherlink" name="voucherlink" class="tabp required form-control form-control-sm" value=''>
												</select>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group col-md-4 voucheramount voucherlink">
                                            <span class="control-label" for="customername" id=''>Amount
                                            </span>
                                            <div class="">
                                               <input type="text" id="voucheramount" class="tabp required form-control form-control-sm">
                                            </div>
                                        </div>
                                        
                                         <div class="form-group col-md-4 bill_num">
                                            <span class="control-label" for="customername" id=''>Bill Number <span class="required">*</span>
                                            </span>
                                            <div class="">
                                               <input type="text" id="bill_num" name="bill_num" class="tabp required form-control form-control-sm" value="<?php echo isset($billno)?$billno:"";?>">
                                            </div>
                                        </div>
										</div>
										</div>
								
                                        <div class="form-group col-md-12">
										<div class="row">
                                            <span>
											Multi Currency &nbsp
											<input type='checkbox' id='multi_currency'>
                                            </span>
                                            <div class="form-group form-group-sm col-md-4 multi_currency">
												<select class='form-control form-control-sm'>
													<option value=''>--From Currency--</option>
													<option value='S$'>Singapore Dollar</option>
													<option value='MYR'>Malaysian Ringgit</option>
													<option value='$'>US Dollar</option>
													<option value='INR'>Indian Rupee</option>
												</select>
											</div>
											<div class="form-group  form-group-sm col-md-4 multi_currency">
												<select class='form-control form-control-sm'>
													<option value=''>--Base Currency--</option>
													<option value='S$'>Singapore Dollar</option>
													<option value='MYR'>Malaysian Ringgit</option>
													<option value='$'>US Dollar</option>
													<option value='INR'>Indian Rupee</option>
												</select>
											</div>
                                        </div>
										</div>
                                       
                                        
                                       <div class='row'></div>
                                        
                                        <div class='col-md-3' style="width:215px">
										</div>
								
								
								
								<div class='multi_currency'>
                                        <div class='row'>
										  <div class="col-md-4">
													<input type="text" id="" name="" style='text-align: right;' class="multi required form-control form-control-sm" placeholder="Exchange Rate">
											</div>
											
											<div class="col-md-4">
													<input type="text" id="" name="" style='text-align: right;' class="multi required form-control form-control-sm" placeholder="From Amount">
											</div>
											
											<div class="col-md-4">
													<input type="text" id="" name="" style='text-align: right;' class="multi_result required form-control form-control-sm" placeholder="Base Amount">
											</div>
                                        </div>
                                    </div>

								<!-- table start -->
                                   
								<div class='row'></div><br />
								<div class="form-group" style='background-color:#EAEAEA'>
									<div class='row'>
										<div class="col-md-1" align='center'>
											S.No
										</div>
										<div class="col-md-4" align='center'>
											Account Name [ <a style='cursor:pointer' id="AddBtn2" class="">New</a> ]
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
										<a style='cursor:pointer;padding:0px 0px' id='addNew' class="btn btn-success btn-sm">Add Row</a>
										</div>
									</div>
								</div>
								<!-- Main Row -->
								<div id='firstLine'>
									<?php
									if (!isset($records)) {
									?>
										<div class="form-group">
											<div class="row">
												<div class="col-md-1 rowid" align='center'>
													1
												</div>
												<div class="col-md-4">
													<input type="text" name="accountname[]" id="accountname_1" class="tabp accountname form-control form-control-sm">	
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

											</div>
										</div>


										<div class="form-group">
											<div class="row">
												<div class="col-md-1 rowid" align='center'>
													2
												</div>
												<div class="col-md-4">
													<input type="text" name="accountname[]" class="tabp accountname form-control form-control-sm" id="accountname_2">
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
													<div class="col-md-1 rowid"  align='center'>
														<?php echo $i; ?>
													</div>
													<div class="col-md-4">
														<input type="text" name="accountname[]" class="tabp accountname form-control form-control-sm" value='<?php echo get_accountname($tmp->accountname) ?>'>

													</div>
													<div class="col-md-2">
														<input type="text" id='debit_<?php echo $i; ?>' name="debit[]" style='text-align: right;' maxlength='10' onkeypress="return isNumberKeyPeriod(event)" class="tabp debit form-control form-control-sm" value='<?php echo $tmp->debit ?>'>
													</div>
													<div class="col-md-2">
														<input type="text" id='credit_<?php echo $i; ?>' name="credit[]" style='text-align: right;' maxlength='10' onkeypress="return isNumberKeyPeriod(event)" class="tabp credit form-control form-control-sm" value='<?php echo $tmp->credit ?>'>
													</div>
													<div class="col-md-2">
														<input type="text" name="reference[]" class="tabp reference form-control form-control-sm" value='<?php echo $tmp->reference ?>'>
													</div>

													<div class="col-md-1" align='center' <?php if ($i == 1) { ?> <?php } ?>>


														<?php
														if ($i == 1) {
														?>
															
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
										<div class="col-md-1" align='center'>

										</div>
										<div class="col-md-4" align='right'>
											Total
										</div>
										<div class="col-md-2" align='center'>
											<input type=text class='form-control form-control-sm' style='text-align: right;' name='totaldebit' id='totaldebit' value='<?php echo isset($totaldebit)?number_format($totaldebit,2):"0"?>' readonly>
										</div>
										<div class="col-md-2" align='center'>
											<input type=text class='form-control form-control-sm' name='totalcredit' id='totalcredit' style='text-align: right;' value='<?php echo isset($totalcredit)?number_format($totalcredit,2):"0"?>' readonly>
										</div>
										<div class="col-md-2" align='center'>

										</div>
										<div class="col-md-1" align='center'>

										</div>
									</div>
								</div>
								<br>
								<div class="form-group">
									<div class="row">
										<div class="col-md-12">
											<textarea placeholder='Narration' class='tabp form-control' name='narration' id='narration'><?php echo isset($narration) ? $narration : "" ?></textarea>
										</div>
									</div>
								</div>

								 <div class="form-group">
									<div class="row">
									  <!-- <div class="col-md-4" align="center">
											<center><b>Supplies Type</b></center>
											<input type="radio" value='1' name='supplies_type' class='supplies_type' <?php echo (isset($supplies_type) && $supplies_type == 1) ? "checked" : "" ?>> Standard Rates
											<input type="radio" value='2' name='supplies_type' class='supplies_type' <?php echo (isset($supplies_type) && $supplies_type == 2) ? "checked" : "" ?>> Zero Rates
											<input type="radio" value='3' name='supplies_type' class='supplies_type' <?php echo (isset($supplies_type) && $supplies_type == 3) ? "checked" : "" ?>> Exempt Supplies
										</div> -->
										<div class='col-md-4'>
											<span> Prepared By * </span>
											<input type='text' class='form-control form-control-sm' id="preparedby" value='<?php echo isset($preparedby)?$preparedby:logged_user();?>' name='preparedby'>
										</div>
										<div class='col-md-4'>
											<span> Authorized By *</span>
											<input type='text' class='form-control form-control-sm' id="authorizedby" value='<?php echo isset($authorizedby)?$authorizedby:"";?>' name='authorizedby'>
										</div>
									</div>
								</div> 
								     <input type=hidden id='achidden' value='0'>
                                        <div class="ln_solid"></div>
                                        <div class="form-group" align="right">
                                            <div class="col-md-12 col-md-offset-3">
                                                <button type="submit" class="tabp btn btn-success btn-sm" id='submitButton' name='submitButton' value='saveonly'>Submit</button>
                                                <button type="submit"  formtarget="_blank" class="tabp btn btn-success btn-sm" id='submitButton2' name='submitButton' value='saveprint' >Submit & Print</button>
												<a href="<?php echo base_url()?>accounts/vouchers" class="btn btn-primary btn-sm">Cancel</a>
												<?php 
													if($this->session->userdata('tally_look') || $this->session->userdata('reports_tally') || $this->session->userdata('profit_tally') || $this->session->userdata('trial_tally') || $this->session->userdata('fulltrial_tally')){
														$accountname_tally = $this->session->userdata('tally_look');
														$tally_start = $this->session->userdata('tally_look_start');
														$tally_end = $this->session->userdata('tally_look_end');
														if($this->session->userdata('fulltrial_tally')){
															$trial = $this->session->userdata('fulltrial_tally');
															echo "<a href='".base_url()."reports/trialbalancefull/".$trial."' class='btn btn-primary'>Back</a>";
														}
														else if($this->session->userdata('trial_tally')){
															$trial = $this->session->userdata('trial_tally');
															echo "<a href='".base_url()."reports/trialbalance/".$trial."' class='btn btn-primary'>Back</a>";
														}
														else if($this->session->userdata('profit_tally')){
															$profit = $this->session->userdata('profit_tally');
															echo "<a href='".base_url()."reports/profitandloss/".$profit."' class='btn btn-primary'>Back</a>";
														}
														else if($this->session->userdata('reports_tally')){
															$bal = $this->session->userdata('reports_tally');
															echo "<a href='".base_url()."reports/balancesheet/".$bal."' class='btn btn-primary'>Back</a>";
														}else{
												?>
														<a href="<?php echo base_url()?>reports/ledger/<?php echo $accountname_tally.'/'.$tally_start.'/'.$tally_end;?>" class="btn btn-primary">Back</a>
												<?php 
														}
													}							
													
												?>
                                            </div>
                                        </div>
							</form>
							<!-- table end -->

						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<script>
$("#AddBtn2").click(function(){
	
$("#FormModal1").modal('show');

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

<script>
            $(document).ready(function () {
				
				//$(".supplies_type").prop("disabled",true);
				$(".bill_num").hide();
			
				<?php if(isset($vouchertype) && $vouchertype == 6){ ?>
					$(".supplies_type").removeAttr("disabled");
					
					$(".bill_num").show();
					$(".voucherlink").hide();
				<?php } ?>
				
				
				
				$(".select2_single").select2({
                    placeholder: "Select Account Name",
                    allowClear: true
                });
				$(".voucherlink_select").select2({
                    placeholder: "",
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
				$(document).on("keypress",".debit",function(){
					if($(this).val() == '0')
						$(this).val('');
				});
				$(document).on("keyup",".debit",function(){
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
				$(document).on("keypress",".credit",function(){
					if($(this).val() == '0')
						$(this).val('');
				});
				$(document).on("keyup",".credit",function(){
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
					
					if($("#accountname_"+getid).val() == ''){
						alert("Please Enter the Account Name");
						$(this).val(0);
						return false;
					}
					
					if(parseFloat(creaditval) != 0 )
					{
						//alert('Please check Credit Value!!!.');	
						$(this).val(0);
					}
					
					if($(this).val() != ''){
						 var totaldebit = 0;
						 $(".debit").each(function(){
							 totaldebit = parseFloat(totaldebit.toFixed(2)) + parseFloat($(this).val());
						 });
						 
						// $("#totaldebit").val(totaldebit.toFixed(2));
						 var resi = numberchange(totaldebit);
						 $("#totaldebit").val(resi);
						 
						 /*if(getid == 1){
							
							debitval = parseFloat($(this).val());
							
							$("#credit_2").val(debitval.toFixed(2));
							$("#totalcredit").val(debitval.toFixed(2));
						}*/
					}else{
						//$("#totaldebit").val(0);
						//$("#credit_2").val(0);
						//$("#totalcredit").val(0);
						 $(this).val('0');
						 var totaldebit = 0;
						 $(".debit").each(function(){
							 totaldebit = parseFloat(totaldebit.toFixed(2)) + parseFloat($(this).val());
						 });
						 //$("#totaldebit").val(totaldebit.toFixed(2));
						 var resi = numberchange(totaldebit);
						 $("#totaldebit").val(resi);
						 
						 var totalcredit = 0;
						 $(".credit").each(function(){
							 totalcredit = parseFloat(totalcredit.toFixed(2)) + parseFloat($(this).val());
						 });
						 ///$("#totalcredit").val(totalcredit.toFixed(2));
						  var resi = numberchange(totalcredit);
						 $("#totalcredit").val(resi);
					}
					
					
				});
				
				$(document).on("keyup",".credit",function(){
					
					var creditcheck = $(this).attr('id');
					var getid = creditcheck.substring(7);
					var	creaditval = $('#debit_'+getid).val();
					
					if($("#accountname_"+getid).val() == ''){
						alert("Please Enter the Account Name");
						$(this).val(0);
						return false;
					}
					
					if(parseFloat(creaditval) != 0 )
					{
						//alert('Please check Debit Value!!!.');	
						$(this).val(0);
					}
					
					
					
					if($(this).val() != ''){
						 var totalcredit = 0;
						 $(".credit").each(function(){
							 if($(this).val())
								totalcredit = parseFloat(totalcredit) + parseFloat($(this).val());
						 });
						 
						 //$("#totalcredit").val(totalcredit.toFixed(2));
						 var resi = numberchange(totalcredit.toFixed(2));
						 $("#totalcredit").val(resi);
						 
						 /*if(getid == 1){
							 creditv = parseFloat($(this).val());
							 
							$("#debit_2").val(creditv.toFixed(2));
							$("#totaldebit").val(creditv.toFixed(2));
						}*/
					}else{
						//$("#totalcredit").val(0);
						//$("#debit_2").val(0);
						//$("#totaldebit").val(0);
						 $(this).val('0');
						 var totalcredit = 0;
						 $(".credit").each(function(){
							 totalcredit = parseFloat(totalcredit.toFixed(2)) + parseFloat($(this).val());
						 });
						 //$("#totalcredit").val(totalcredit.toFixed(2));
						 var resi = numberchange(totalcredit);
						 $("#totalcredit").val(resi);
						 var totaldebit = 0;
						 $(".debit").each(function(){
							 totaldebit = parseFloat(totaldebit.toFixed(2)) + parseFloat($(this).val());
						 });
						// $("#totaldebit").val(totaldebit.toFixed(2));
						 var resi = numberchange(totaldebit.toFixed(2));
						 $("#totaldebit").val(resi);
					}
				});
				//Add debit values for totaldebit
				
            });
			
        </script>
        
	<script type="text/javascript">
        $(function () {
          
			$("#vouchertype").change(function(){
				
				//$(".supplies_type").prop("disabled",true);
				//$(".supplies_type").prop("checked",false);
				
				$("#towhom").val('');
				if($(this).val() == 1){
					$(".towhom").show();					
					$("#typechange").html("Paid To");
					
					
					 $.ajax({
					  url: "<?php echo base_url();?>accounts/get_purchase_vouchers",
					  type:"POST",	  
					  data: {
						
					  },
					  success: function( data ) {
						  $("#voucherlink").html(data);
					  }
					});
					
					$(".bill_num").hide();
					$(".voucherlink").show();
					$("#voucheramount").val('');
				}else if($(this).val() == 3){
					$(".towhom").show();
					//$("#typechange").html("Receivables From");
					var str = '<select name="vtype_journal" style="height:20px">';
					str += '<option value="1">Receivables From</option>';
					str += '<option value="2">Payable To</option>';
					str += '<option value="3">Provision</option>';
					str += '</select>';
					$("#typechange").html(str);
					$(".voucherlink").hide();
					$(".bill_num").hide();
				}else if($(this).val() == 2){
					$(".towhom").show();
					$("#typechange").html("Received From");
					
					
					$.ajax({
					  url: "<?php echo base_url();?>accounts/get_sales_vouchers",
					  type:"POST",	  
					  data: {
						
					  },
					  success: function( data ) {
						  $("#voucherlink").html(data);
					  }
					});
					
					
					$(".bill_num").hide();
					$(".voucherlink").show();
					$("#voucheramount").val('');
				}else if($(this).val() == 4){
					$(".towhom").hide();
					$(".voucherlink").hide();
					$(".bill_num").hide();
				}else if($(this).val() == 7){					
					$(".voucherlink").hide();
					$(".bill_num").hide();
				}else if($(this).val() == 8){
					$(".voucherlink").hide();
					$(".bill_num").hide();
				}
				
				if($(this).val() == 5){
					$(".towhom").show();
					$("#typechange").html("Vendor");					
					$(".voucherlink").hide();
					$(".bill_num").show();
				}
				if($(this).val() == 6){
					$(".towhom").show();
					$("#typechange").html("Customer");
					$(".voucherlink").hide();
					$(".bill_num").show();
					
					//$(".supplies_type").removeAttr("disabled");
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
			
			$(".voucheramount").hide();
			$("#voucherlink").change(function(){
				 
				 if($(this).val()){
					$.ajax({
					  url: "<?php echo base_url();?>accounts/get_voucher_amount",
					  type:"POST",	  
					  data: {
						voucherid: $(this).val()
					  },
					  success: function( data ) {					
						 $(".voucheramount").show();
						 $("#voucheramount").val(data);
					  }
					});
				}
					
			});
			
			<?php if(!isset($voucherid)) { ?>
			$("#vouchertype").trigger("change");
			<?php } ?>
			
			if(<?php echo (isset($vouchertype) && $vouchertype == 1)?"true":"false";?>){
					$(".towhom").show();					
					$("#typechange").html("Paid To");
			}else if(<?php echo (isset($vouchertype) && $vouchertype == 3)?"true":"false";?>){
				$(".towhom").show();
				var str = '<select name="vtype_journal" style="height:20px">';
					str += '<option value="1" <?php echo (isset($jtype) && $jtype == 1)?"selected":"";?>>Receivables From</option>';
					str += '<option value="2" <?php echo (isset($jtype) && $jtype == 2)?"selected":"";?>>Payable To</option>';
					str += '<option value="3" <?php echo (isset($jtype) && $jtype == 3)?"selected":"";?>>Provision</option>';
					str += '</select>';
					$("#typechange").html(str);
			}else if(<?php echo (isset($vouchertype) && $vouchertype == 2)?"true":"false";?>){
				$(".towhom").show();
				$("#typechange").html("Received From");
			}else if(<?php echo (isset($vouchertype) && $vouchertype == 4)?"true":"false";?>){
				$(".towhom").hide();			
			}else if(<?php echo (isset($vouchertype) && $vouchertype == 7)?"true":"false";?>){
				$(".voucherlink").hide();
			}else if(<?php echo (isset($vouchertype) && $vouchertype == 8)?"true":"false";?>){
				$(".voucherlink").hide();
			}
			
			
			$("#voucherform").submit(function(){				
				$(".glyphicon-remove").trigger("click");
				if($("#voucherdate").val() == ''){
					new PNotify({
						title: 'Warning',
						text: 'Voucher Date field is missing',
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
				
				if($("#vouchertype").val() == 5 && $("#bill_num").val() == ''){
						new PNotify({
							title: 'Warning',
							text: 'Bill Number is required',
							type: 'error'
						});
						return false;
				}
				
				if($("#vouchertype").val() == 6 && $("#bill_num").val() == ''){
						new PNotify({
							title: 'Warning',
							text: 'Bill Number is required',
							type: 'error'
						});
						return false;
				}
				
				$('button[type=submit]').attr('disabled',true);
				
				var subprint = $('#saveprint').val();
				if(subprint != "print")
				{					
					var overlay = jQuery('<div id="overlay"> </div>');
					overlay.appendTo(document.body);
				}
				
				
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
			
			$('#submitButton2').on('click', function() {
				$("#saveprint").val("print");
			});
			
		$('#submitButton').on('click', function() {
				$("#saveprint").val("");
			});
			
			$("#vouchertype").focus();
			
			$('body').on('keydown', '.tabp', function(e) {
				var self = $(this), 
				form = self.parents('form:eq(0)'), 
				focusable, next;
				if (e.keyCode == 13) {
					var str = $(this).attr("id");
					str = str.split("_");
					
										
					focusable = form.find('.tabp').filter(':visible');
					if(str[0] == 'debit' && $(this).val() != '')
						next = focusable.eq(focusable.index(this)+2);
					else
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
					//$("#totaldebit").val(totaldebit.toFixed(2));
					var resi = numberchange(totaldebit);
					$("#totaldebit").val(resi);
						 
					 var totalcredit = 0;	 
					creditid = 1;
					$(".credit").each(function(){						
						$(this).attr('id','credit_'+creditid);
						totalcredit = parseInt(totalcredit) + parseInt($(this).val());					
						creditid++;	
					});
					//$("#totalcredit").val(totalcredit.toFixed(2));	
					var resi = numberchange(totalcredit);
					$("#totalcredit").val(resi);
						 
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
						 /*if(data){
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
						 }*/
						 
						 if(data){
							$("#subcategory").removeAttr("disabled");
							$("#subcategory").html(data);
							
							$("#subsubcategory").removeAttr("disabled");
							if($("#editsubcategory").val()){
								$("#subcategory").val($("#editsubcategory").val());
							}
							$("#editsubcategory").val('');
							$("#subcategory").trigger("change");
						 }
						 else{
							 $("#subcategory").html(data);
							 $("#subsubcategory").html(data);
							 $("#subcategory").attr("disabled","true");
							 $("#subsubcategory").attr("disabled","true");
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
						type: "POST",	 
						dataType: "json",
						data: {
							maingroup: $("#maingroup").val(),
							category: $("#category").val(),
							subcategory: $("#subcategory").val(),
							subsubcategory: $("#subsubcategory").val(),
							acname: $("#acname").val()
						},
						success: function(data) {
							if(data.success == "Error") {
								toastr.error(data['msg']);
								$("#acname").val("");
							} else {
								toastr.success(data['msg']);
								$("#FormModal1").modal('hide');
								// Reload the page after a short delay (1000 milliseconds)
								setTimeout(function() {
									location.reload();
								}, 1000);
							}
						}
					});
				});
			   
			    $(".multi").keyup(function(){
				   tot = 1;
				   $(".multi").each(function(){
					    tot = tot * $(this).val();
				   });
				   
				   if(tot != 1)
				   $(".multi_result").val(tot);
				   else
				   $(".multi_result").val('0');
			   });
			   
			   					   $(".multi_currency").hide();

			   $("#multi_currency").change(function(){
				   if($(this).is(":checked")){
					   $(".multi_currency").show();
				   }else{
					   $(".multi_currency").hide();
				   }
			   });
			   
			   
			});
			   
		</script>
<script type='text/javascript'>

function numberchange(changeval)
{
	var x=parseFloat(changeval);
		x=x.toString();
	var afterPoint = '';
	if(x.indexOf('.') > 0)
		afterPoint = x.substring(x.indexOf('.'),x.length);
		x = Math.floor(x);
		x=x.toString();
	var lastThree = x.substring(x.length-3);
	var otherNumbers = x.substring(0,x.length-3);
	if(otherNumbers != '')
		lastThree = ',' + lastThree;
	var res = otherNumbers.replace(/\B(?=(\d{3})+(?!\d))/g, ",") + lastThree + afterPoint;
	if(res.indexOf('.') > 0)
	{
		return res;
	}
	else
	{
		var getval = res+".00";
		return getval;
		
	}	
	
}
</script>
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
