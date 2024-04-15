<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
	<script src="js/addons/rating.js"></script>

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
                   <h1> Closing Stock </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">HR</a></li>
                       
                    </ol>
                </div>
            </div>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-md-12 col-sm-12 col-12 text-right">
									<button type="button" id="AddBtn" class="btn btn-info btn-sm"><i class="fa fa-plus"></i> New</button>
									<hr/>
								</div>
								<div class="col-md-12 col-sm-12 col-12">
									<div class="table-responsive">
										<table class="table table-bordered" id="DataTable" width="100%">
											<thead>
												<tr>
													<th>#</th>
													<th>S.No </th>
													<th>Date</th>
													<th>V.No</th>
													<th>Closing Stock</th>
													<th> Action </th>
															
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
			<input type="hidden" name="row_id" id="row_id" />
			<div class="modal-content">
				<div class="modal-header">
					<h4 id="FormModalHeading">Closing Stock</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<h4>  </h4>
				<div class="modal-body">
					<div class="row">
						
						
						<div class="col-md-4">
							<div class="form-group">
							<label for="date" class="form-check-label"> <b> Date </b>
                                   <span class="required"></span>
                                </label>
                                    <input type="text" id="date" name="date" class="form-control form-control-sm datepicker"
                                         required="" autocomplete="off">
							</div>
						</div>
						
						
						
						<div class="col-md-4">
							<div class="form-group">
							<label for="date" class="form-check-label"> <b> Closing Stock </b>
                               <span class="required"></span>
                            </label>
                          <input type="text" id="stock" name="stock" class="form-control form-control-sm" autocomplete="off">
							</div>
						</div>
						
						
								<div class="col-md-4">
							<div class="form-group">
								<label class="form-check-label"> <b> Status </b></label>
				<select class="form-control form-control-sm" name="status" id="status" required>
									<option value=''>-- Select Status --</option>
									<option value='Active'>Active</option>
									<option value='Inactive'>Inactive</option>
								</select>
							</div>
						</div>	
			
					</div>
				</div>
				<div class="modal-footer" style="text-align:left !important;">
					<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close </button>
					<button type="submit" class="btn btn-success btn-sm">Submit</button>
					<button type="reset" class="btn btn-danger btn-sm">Reset</button>
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
		"order": [[ 1, "asc" ]],
		'ajax': {
			'url':	"<?= base_url().'list_closing_submit' ?>",
			'type':	"POST"
		},
		"columnDefs": [{
			"targets": [0,3],
			"orderable": false
		}]
	});
});

$("#AddBtn").click(function(){
	clear_data_form();
	
	$("#FormModal").modal('show');
});

$("#ResetBtn").click(function(){
	clear_data_form();
});

$("#DataForm").on('submit',(function(e){
	e.preventDefault();
	var formData = new FormData($("#DataForm")[0]);
	$.ajax({
		url: "<?= base_url().'closing_submit' ?>",
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
				$('#DataTable').DataTable().ajax.reload(null, false);
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
			url: "<?= base_url().'delete_value' ?>",
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

	$('#row_id').val($(this).attr('data-id'));
	$('#date').val($(this).attr('data-date'));
	$('#stock').val($(this).attr('data_stock'));
	$('#status').val($(this).attr('data-status'));

	
	
	$("#FormModalHeading").html('Edit Closing Stock Request');
	$("#DataForm [type='submit']").html('Update');
	$("#FormModal").modal('show');
});


function clear_data_form(){
	$('#row_id').val('');
	$("#DataForm [type='submit']").html('Submit');
	$("#DataForm").trigger('reset');
}

</script>