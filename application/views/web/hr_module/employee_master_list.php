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
                        <li class="breadcrumb-item"><a href="javascript:void(0)">HR</a></li>
                        <li class="breadcrumb-item active"><a href="<?= base_url().'employee_master' ?>"><?= $page_title ?></a></li>
                    </ol>
                </div>
            </div>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-md-12 col-sm-12 col-12 text-right">
										<a href="<?= base_url().'add_employee' ?>" class="btn btn-info btn-sm" style="background-color:#5897ED; border-color:#5897ED;"><i class="fa fa-plus"></i> New</a>
									<button type="button" id="AddBtn" class="btn btn-info btn-sm" style="background-color:#53D769; border-color:#53D769;"><i class="fa fa-upload"></i> Import</button>
									<button type="button" id="FillerBtn" class="btn btn-info btn-sm" style="background-color:#E7E7E7; border-color:#E7E7E7; color:black;"><i class="fa fa-search"></i> Filter</button>
								</div>
								<div class="col-md-12 col-sm-12 col-12"><hr/>
									<div class="table-responsive">
										<table class="table table-bordered" id="DataTable" width="100%" style="font-size: 15px;">
											<thead>
												<tr>
													<th width="5%">#</th>
													<th width="10%">Emp ID</th>
													<th width="15%">Emp Name</th>
													<th width="12%">Email Address</th>
													<th width="12%">Mobile No</th>
													<th width="13%">Department</th>
													<th width="15%">Designation</th>
													<th width="12%">Action</th>
												</tr>
											</thead>
										</table>
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

<div class="modal fade show" id="FormModal" aria-modal="true" role="dialog">
	<div class="modal-dialog modal-lg">
		<form id="DataForm" autocomplete="OFF">
			<div class="modal-content">
				<div class="modal-header">
					<h4 id="FormModalHeading">Import Export File</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
							<div class="col-md-8">
							<div class="form-group">
								<label class="form-check-label">Attachment (Excel File)</label>
								<input type="file" class="form-control form-control-sm" name="import_excel" id="import_excel" required />
							</div>
						</div>
					</div>
					<div class="text-right">
						<a href="<?= base_url().'assets/employee_master_import.xlsx' ?>" downloaded>Download Sample File</a>
					</div>
				</div>
				<div class="modal-footer" style="text-align:left !important;">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-success">Submit</button>
					<button type="reset" class="btn btn-danger">Reset</button>
				</div>
			</div>
		</form>
	</div>
</div>


<script>
$(document).ready(function(){
	$('#DataTable').DataTable({
		'processing': true,
		'serverSide': true,
		'serverMethod': 'post',
		"order": [[ 3, "asc" ]],
		'ajax': {
			'url':	"<?= base_url().'list_employee_master' ?>",
			'type':	"POST"
		},
		"columnDefs": [{ 
			"targets": [0,7],
			"orderable": false
		}]
	});
});

$("#AddBtn").click(function(){
	$("#DataForm [type='submit']").html('Submit');
	$("#DataForm").trigger('reset');
	$('#import_month').val('').trigger('change');
	
	$("#FormModal").modal('show');
});

$("#ResetBtn").click(function(){
	clear_data_form();
});

$("#DataForm").on('submit',(function(e){
	e.preventDefault();
	var formData = new FormData($("#DataForm")[0]);
	$.ajax({
		url: "<?= base_url().'add_employee_master_import' ?>",
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
				$('#ImportDataTable').DataTable().ajax.reload(null, false);
				toastr.success(data['msg']);
				$("#FormModal").modal('hide');
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
			url: "<?= base_url().'delete_employee_category' ?>",
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

</script>
