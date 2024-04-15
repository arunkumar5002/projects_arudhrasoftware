
<?php echo load_datatables(); ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row" style="margin-bottom:1.5rem!important;">
                <div class="col-sm-6">
                    <h1>Bank Entries</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                       <li class="breadcrumb-item active"><a href="<?php echo base_url() ?>Bank/bank_form"> Bank Entries</a></li>
                    </ol>
                </div>
            </div>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header p-2">
							<ul class="nav nav-pills">
								<li class="nav-item"><a class="nav-link active" href="#timeline" data-toggle="tab">Bank Entries</a></li>
							</ul>
						</div>
						<div class="card-body">
							<div class="tab-content">
								<div class="tab-pane active" id="timeline">
									<div class="row">
										<div class="col-md-12 col-sm-12 col-12">
											 <form autocomplete="OFF"  id="entries" data-parsley-validate enctype="multipart/form-data">
												<input type="hidden" name="row_id" id="row_id" />
												<div class="row">
													
													<div class="col-md-6">
														<div class="form-group">
															<label class="form-check-label">Bank Accounts</label>
															<select class="form-control form-control-sm" name="bank_account" id="bank_account" required>
																<option value=''>-- Select Bank Accounts --</option>
																<option value='Gulf International Bank'>Gulf International Bank</option>
																<option value='Ahli United Bank'>Ahli United Bank</option>
																<option value='Arab Banking Corporation'>Arab Banking Corporation</option>
																<option value='Al Baraka'>Al Baraka</option>
																<option value='National Bank of Bahrain'>National Bank of Bahrain</option>
																<option value='Al-Salam Bank'>Al-Salam Bank</option>
																<option value='Bank Of Bahrain and Kuwait'>Bank Of Bahrain and Kuwait</option>
																
															</select>
														</div>
													</div>
													
													<div class="col-md-6">
														<div class="form-group">
															<label class="form-check-label">Opening Balance</label>
															<input type="text" class="form-control form-control-sm opening" onkeypress="return isNumberKeyPeriod(event)" name="openingbalance" id="opening" required />
														</div>
													</div>
													</div>
													
													<div class="form-row">

				<div class="pull-right" style="width:100%;">
				<button type="button" class="btn btn pull-right btn-sm add" style="float:right;background-color:#19A7CE;color:white">Add New</button><br><br>
				</div> 
					
				
                <table border="1" width="100%" class="table" id="entry">
                    <thead>
                        <tr>
                            <th width="">Date</th>
                            <th width="">Withdraw</th>
                            <th width="">Deposit</th>
                            <th width="">Balance</th>
                            <th width="">Reference</th>
                            <th width=""></th>
                        </tr>
                    </thead>

                    <tbody>
							
							
		
						<tr>
							<td><input type="date"  class="form-control form-control-sm inputmask" name="date[]" id="date" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])-(0[1-9]|1[012])-[0-9]{4}" required /></td>
							<td><input type="text" class="form-control form-control-sm  withdraw" onkeypress="return isNumberKeyPeriod(event)" name="withdraw[]" id="withdraw" required /></td>
							<td><input type="text" class="form-control form-control-sm  deposit" onkeypress="return isNumberKeyPeriod(event)" name="deposit[]" id="deposit" required /></td>
							<td><input type="text" class="form-control form-control-sm  balance" onkeypress="return isNumberKeyPeriod(event)" readonly name="balance[]" id="balance" required /></td>
							<td><input type="text" class="form-control form-control-sm  reference "  name="reference[]" id="reference"   required /></td>
							<td><button type="button" class="btn btn-primary btn-sm  remove">X</button></td>
						</tr>
                    </tbody>
                </table>

            </div>

													
													
													
													<div class="col-md-1" style="margin-top:22px;">
														
													</div>
													
													
													
													
													
												</div>
												<div class="row">
												<div class="col-md-12" style="margin-top:22px;display: flex; justify-content: flex-end;">
														<button type="submit" class="btn btn-success btn-sm" style="margin-right:3px;" >Submit</button>
														<button type="reset" class="btn btn-danger btn-sm" id="ResetBtn">Reset</button>
														
													</div>
												</div>
											</form><hr/>
										</div>
										
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
	$('#DataTable').DataTable({
		'processing': true,
		'serverSide': true,
		'serverMethod': 'post',
		"order": [[ 1, "asc" ]],
		'ajax': {
			'url':	"<?= base_url().'list_department_category' ?>",
			'type':	"POST"
		},
		"columnDefs": [{ 
			"targets": [0,3],
			"orderable": false
		}]
	});
});

$("#ResetBtn").click(function(){
	clear_data_form();
});

$("#DataForm").on('submit',(function(e){
	

	e.preventDefault();
	var formData = new FormData($("#DataForm")[0]);
	$.ajax({
		url: "<?= base_url().'add_edit_bank_form' ?>",
		type: "POST",
		data:  formData,
		dataType: "JSON",
		contentType: false,
		cache: false,
		processData:false,
		beforeSend: function() {
			$("#DataForm [type='submit']").attr('disabled', true);
		},
		success: function(data)
		{
			if(data['status']=="Error"){
				toastr.error(data['msg']);
			}else{
				clear_data_form();
				$('#DataTable').DataTable().ajax.reload(null, false);
				toastr.success(data['msg']);
			}
		},
		complete: function(data) {
			$("#DataForm [type='submit']").attr('disabled', false);
		},
	});
}));

$(document).on("click",".delete_data",function(){
	var val = confirm("Are You Sure to Delete !!!");
	if(val==true){
		$.ajax({
			url: "<?= base_url().'delete_bank_form' ?>",
			type: "POST",
			data:  { keys : $(this).attr('data-id') },
			dataType: "JSON",
			success: function(data)
			{
				if(data['status']=="Warning"){
					toastr.warning(data['msg']);
				}else{
					toastr.info(data['msg']);
					$('#DataTable').DataTable().ajax.reload(null, false);
				}
			}
		});
	}
});

$(document).on("click",".edit_data",function(){
	$("#DataForm [type='submit']").html('Update');
	$('#row_id').val($(this).attr('data-id'));
	$('#department_name').val($(this).attr('data-name'));
	
	$('#department_status').val($(this).attr('data-status'));
	
	window.scroll({top: 0, behavior: "smooth"})
});

function clear_data_form(){
	$('#row_id').val('');
	$("#DataForm [type='submit']").html('Submit');
	$("#DataForm").trigger('reset');
}
</script>

<script>

<!-- Datatables -->
       
            $(document).ready(function () {
				
                $('input.tableflat').iCheck({
                    checkboxClass: 'icheckbox_flat-green',
                    radioClass: 'iradio_flat-green'
                });
            });

            var asInitVals = new Array();
            $(document).ready(function () {
                var oTable = $('#example').dataTable({
                    "oLanguage": {
                        "sSearch": "Search all columns:"
                    },
                    "aoColumnDefs": [
                        {
                            'bSortable': false,
                            'aTargets': [0]
                        }
            ],
                    'iDisplayLength': 10,
                    "sPaginationType": "full_numbers",
                    "dom": 'T<"clear">lfrtip'
                });
                
            }); 

 $(document).on("click",".delrow",function(){
					$(this).parent().parent().remove();
					$(".deposit").trigger("keyup");
				});

								$(document).on("focus",".date",function(){
					$(".date").datepicker({
						dateFormat: "dd-mm-yy",
						minDate: new Date('2023-04-01'),
						maxDate: new Date('2024-03-31')
					});
				});
					
			
			
               $(".DTTT_container").hide();
			   
			   
			   
			   $(document).on("focus",".withdraw, .deposit",function(){
				   if($(this).val() == 0)
					  $(this).val("");
			   });
			   $(document).on("blur",".withdraw, .deposit",function(){
				   if($(this).val() == "")
					  $(this).val("0");
			   });
			   
			   
			   $(document).on("keyup",".withdraw",function(){
				   
				   
					
					
					$(".withdraw").each(function(a,b){
						    
						    if(a == 0){
								prev = $(".opening").val();
								
							}else{								
								prev = $(".balance:eq("+(a-1)+")").val();
							}
							
							if($(this).val())
								its = $(this).val();
							else
								its = 0;
							
							if($(".deposit:eq("+a+")").val())
								deposit = $(".deposit:eq("+a+")").val();
							else
								deposit = 0;
							
							
							balance = parseFloat(prev) + parseFloat(deposit) - parseFloat(its);
							
							$(".balance:eq("+a+")").val(balance.toFixed(2));
						
					});
					
					
					
									   
			   });	
			   		   
			   $(document).on("keyup",".deposit",function(){
				   
					$(".withdraw").each(function(a,b){
						
						    
						    if(a == 0){
								prev = $(".opening").val();
							}else{								
								prev = $(".balance:eq("+(a-1)+")").val();
							}
							
							if($(this).val())
								its = $(this).val();
							else
								its = 0;
							
							if($(".deposit:eq("+a+")").val())
								deposit = $(".deposit:eq("+a+")").val();
							else
								deposit = 0;
														
							balance = parseFloat(prev) + parseFloat(deposit) - parseFloat(its);
							
							$(".balance:eq("+a+")").val(balance.toFixed(2));
						
					});
							
			   });			
			      
			   $(document).on("keyup",".opening",function(){
				   
				 
				   
				   $(".withdraw").each(function(a,b){
						    
						    if(a == 0){
								prev = $(".opening").val();
							}else{								
								prev = $(".balance:eq("+(a-1)+")").val();
							}
							
							
							if($(this).val())
								its = $(this).val();
							else
								its = 0;
							
							
							if($(".deposit:eq("+a+")").val())
								deposit = $(".deposit:eq("+a+")").val();
							else
								deposit = 0;
							
						
							
							balance = parseFloat(prev) + parseFloat(deposit) - parseFloat(its);
							
							$(".balance:eq("+a+")").val(balance.toFixed(2));
						
					});
			   });			   
			   
			   
			   $("#entries").submit(function(){
				   
				   out = false;
				   $(".date").each(function(a,b){						    
						   
							/*date = $(".date:eq("+a+")").val();
							deposit = $(".deposit:eq("+a+")").val();
							withdraw = $(".withdraw:eq("+a+")").val();
							reference = $(".reference:eq("+a+")").val();
							
							if(date == ''){
								$(".date:eq("+a+")").focus();
								out = true;
								return false;
							}	
												
							if(deposit == 0 && withdraw == 0){
								$(".deposit:eq("+a+")").focus();
								out = true;
								return false;
							}*/					
							
					});
					
					if(out == true)
						return false;
				   
			   });
			   
			   
			   
			   $("#bank_account").change(function(){
				   
						if($(this).val() != ''){
							
							$.ajax({
								url: "http://188.166.230.38/projects/accounts/bank/get_bank_entries",
								method: "POST",
								dataType: "json",
								data: {
									account:$(this).val()
								},
								success: function( data ) {
									if(data.success){
										$("#entry tbody").html(data.record);
										$("#opening").val(data.opening);
									}
									else{
										$("#entry tbody").html(data.record);
										$("#opening").val(data.opening);
									}
									
									
								}
							});
							
							
						}
				   
			   });
			   
			function isNumberKeyPeriod(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if(charCode == 46)
        return true;
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
}
function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
   
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
}
			   
			   
			      				  
				
			
			$('body').keydown(function(event) {
						
						 if(event.which == 115) { //F4
							$(".editcompany").trigger("click");
						}
						else if(event.which == 119) { //F8
							$(".changestatus").trigger("click");
						}
						else if(event.which == 120) { //F9
							$(".deletecompany").trigger("click");
						}
					});
			   </script>

			
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				<script>
    $(document).ready(function(){

        $("#createOrder").submit(function(){

            if($(".table tbody tr").length == 0){
                alert("Please add atleast one product");
                return false;
            }

        });


       $(document).on('click','.remove',function(){

            $(this).parent().parent().remove();

       });


       $(document).on('click','.add',function(){

				str = `<tr>
							<td><input type="date" class="form-control form-control-sm" name="date[]" id="date" required /></td>
							<td><input type="text" class="form-control form-control-sm withdraw" name="withdraw[]" id="withdraw" required /></td>
							<td><input type="text" class="form-control form-control-sm deposit" name="deposit[]" id="deposit" required /></td>
							<td><input type="text" class="form-control form-control-sm balance" readonly name="balance[]" id="balance" required /></td>
							<td><input type="text" class="form-control form-control-sm" name="reference[]" id="reference" required /></td>
							<td><button type="button" class="btn btn-primary btn-sm  remove">X</button></td>
						</tr>`;
				
				$(".table tbody").append(str);
       });

    
    });
</script>        













