<?php echo load_datatables(); ?>

<div class="content-wrapper">
	<section class="content-header">
		<div class="container-fluid">
			<div class="row" style="margin-bottom:1.5rem!important;">
				<div class="col-sm-6">
					<h1>Shift Timing Master</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
						<li class="breadcrumb-item"><a href="javascript:void(0)">Settings</a></li>
						<li class="breadcrumb-item active"><a href="<?= base_url() . 'shift_timing_master' ?>">Shift Timing Master</a></li>
					</ol>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header p-2">
							<ul class="nav nav-pills">
								<li class="nav-item"><a class="nav-link active" href="#timeline" data-toggle="tab">Shift Timing Master</a></li>
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
													<div class="col-md-3">
														<div class="form-group">
															<label class="form-check-label">Shift Name</label>
															<input type="text" class="form-control form-control-sm" name="shift_name" id="shift_name" required />
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<label class="form-check-label">Shift In Time</label>
															<input type="time" class="form-control form-control-sm" name="shift_in_time" id="shift_in_time" required />
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<label class="form-check-label">Shift Out Time</label>
															<input type="time" class="form-control form-control-sm" name="shift_out_time" id="shift_out_time" required />
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<label class="form-check-label">Status</label>
															<select class="form-control form-control-sm" name="shift_status" id="shift_status" required>
																<option value=''>-- Select Status --</option>
																<option value='Active'>Active</option>
																<option value='Inactive'>Inactive</option>
															</select>
														</div>
													</div>
													<div class="col-md-12">
														<button type="submit" class="btn btn-success btn-sm">Submit</button>
														<button type="reset" class="btn btn-danger btn-sm" id="ResetBtn">Reset</button>
													</div>
												</div>
											</form>
											<hr />
										</div>
										<div class="col-md-12 col-sm-12 col-12">
											<div class="table-responsive">
												<table class="table table-bordered" id="DataTable" width="100%">
													<thead>
														<tr>
															<th width="8%">#</th>
															<th width="30%">Shift Name</th>
															<th width="30%">Shift In Time</th>
															<th width="30%">Shift Out Time</th>
															<th width="20%">Status</th>
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
			</div>
		</div>
	</section>

</div>

<script>
	$(document).ready(function() {
		$('#DataTable').DataTable({
			'processing': true,
			'serverSide': true,
			'serverMethod': 'post',
			"order": [
				[1, "asc"]
			],
			'ajax': {
				'url': "<?= base_url() . 'list_shift_timing_category' ?>",
				'type': "POST"
			},
			"columnDefs": [{
				"targets": [0, 3],
				"orderable": false
			}]
		});
	});

	$("#ResetBtn").click(function() {
		clear_data_form();
	});

	$("#DataForm").on('submit', (function(e) {
		e.preventDefault();
		var formData = new FormData($("#DataForm")[0]);
		$.ajax({
			url: "<?= base_url() . 'add_edit_shift_timing_category' ?>",
			type: "POST",
			data: formData,
			dataType: "JSON",
			contentType: false,
			cache: false,
			processData: false,
			beforeSend: function() {
				$("#DataForm [type='submit']").attr('disabled', true);
			},
			success: function(data) {
				if (data['status'] == "Error") {
					toastr.error(data['msg']);
				} else {
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

	$(document).on("click", ".delete_data", function() {
		var val = confirm("Are You Sure to Delete !!!");
		if (val == true) {
			$.ajax({
				url: "<?= base_url() . 'delete_shift_timing_category' ?>",
				type: "POST",
				data: {
					keys: $(this).attr('data-id')
				},
				dataType: "JSON",
				success: function(data) {
					if (data['status'] == "Warning") {
						toastr.warning(data['msg']);
					} else {
						toastr.info(data['msg']);
						$('#DataTable').DataTable().ajax.reload(null, false);
					}
				}
			});
		}
	});

	$(document).on("click", ".edit_data", function() {
		$("#DataForm [type='submit']").html('Update');
		$('#row_id').val($(this).attr('data-id'));
		$('#shift_name').val($(this).attr('data-name'));
		$('#shift_in_time').val($(this).attr('data-in'));
		$('#shift_out_time').val($(this).attr('data-out'));

		$('#shift_status').val($(this).attr('data-status'));

		window.scroll({
			top: 0,
			behavior: "smooth"
		})
	});

	function clear_data_form() {
		$('#row_id').val('');
		$("#DataForm [type='submit']").html('Submit');
		$("#DataForm").trigger('reset');
	}
</script>