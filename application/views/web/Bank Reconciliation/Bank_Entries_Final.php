		
<?php echo load_datatables(); ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row" style="margin-bottom:1.5rem!important;">
                <div class="col-sm-6">
                    <h1>Bank Entries Upload</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                       <li class="breadcrumb-item active"><a href="<?php echo base_url() ?>Bank/bank_form"> Bank Entries Upload</a></li>
                    </ol>
                </div>
            </div>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header p-2">
							<ul class="nav nav-pills">
								<li class="nav-item"><a class="nav-link active" href="#timeline" data-toggle="tab">Bank Entries </a></li>
							</ul>
						</div>
						<div class="card-body">
							<div class="tab-content">
								<div class="tab-pane active" id="timeline">
									<div class="row">
										<div class="col-md-12 col-sm-12 col-12">
											 <form autocomplete="OFF" id="DataForm">
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
													
												</div>
												<div class="row">
												<div class="col-md-12" style="margin-top:22px;margin-left: -261px;display: flex; justify-content: flex-end;">
														<button type="submit" class="btn btn-success btn-sm" style="margin-right:3px;" >Fetch Data</button>
														<button type="submit" class="btn btn-success btn-sm" style="margin-right:3px;" >Posting To Ledger</button>
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
		url: "<?= base_url().'add_edit_department_category' ?>",
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
			url: "<?= base_url().'delete_department_category' ?>",
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
