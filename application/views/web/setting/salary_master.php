<?php echo load_datatables(); ?>

<div class="content-wrapper">
	<section class="content-header">
		<div class="container-fluid">
			<div class="row" style="margin-bottom:1.5rem!important;">
				<div class="col-sm-6">
					<h1>Salary Master</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
						<li class="breadcrumb-item"><a href="javascript:void(0)">Settings</a></li>
						<li class="breadcrumb-item active"><a href="<?= base_url() . 'salary_master' ?>">Salary Master</a></li>
					</ol>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header p-2">
							<ul class="nav nav-pills">
								<li class="nav-item"><a class="nav-link active" href="#earninings" data-toggle="tab">Earninings</a></li>
								<li class="nav-item"><a class="nav-link" href="#deductions" data-toggle="tab">Deductions</a></li>
							</ul>
						</div>
						<div class="card-body">
							<div class="tab-content">
								<div class="tab-pane active" id="earninings">
									<div class="row">
										<div class="col-md-12 col-sm-12 col-12">
											<form autocomplete="OFF" id="DataForm1">
												<input type="hidden" name="earninings_row_id" id="earninings_row_id" />
												<div class="row">
													<div class="col-md-4">
														<div class="form-group">
															<label class="form-check-label">Earnining Name</label>
															<input type="text" class="form-control form-control-sm" name="earninings_name" id="earninings_name" required />
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<label class="form-check-label">Earnining Percent</label>
															<input type="text" class="form-control form-control-sm" name="earninings_percent" id="earninings_percent" required />
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<label class="form-check-label">Status</label>
															<select class="form-control form-control-sm" name="earninings_status" id="earninings_status" required>
																<option value=''>-- Select Status --</option>
																<option value='Active'>Active</option>
																<option value='Inactive'>Inactive</option>
															</select>
														</div>
													</div>
													<div class="col-md-2" style="margin-top:23px;">
														<button type="submit" class="btn btn-success btn-sm">Submit</button>
														<button type="reset" class="btn btn-danger btn-sm" id="ResetBtn1">Reset</button>
													</div>
												</div>
											</form>
											<hr />
										</div>
										<div class="col-md-12 col-sm-12 col-12">
											<div class="table-responsive">
												<table class="table table-bordered" id="DataTable1" width="100%">
													<thead>
														<tr>
															<th width="8%">#</th>
															<th width="40%">Name</th>
															<th width="20%">Percent</th>
															<th width="20%">Status</th>
															<th width="12%">Action</th>
														</tr>
													</thead>
												</table>
											</div>
										</div>
									</div>
								</div>
								<div class="tab-pane" id="deductions">
									<div class="row">
										<div class="col-md-12 col-sm-12 col-12">
											<form autocomplete="OFF" id="DataForm2">
												<input type="hidden" name="deductions_row_id" id="deductions_row_id" />
												<div class="row">
													<div class="col-md-4">
														<div class="form-group">
															<label class="form-check-label">Deduction Name</label>
															<input type="text" class="form-control form-control-sm" name="deductions_name" id="deductions_name" required />
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<label class="form-check-label">Deduction Percent</label>
															<input type="text" class="form-control form-control-sm" name="deductions_percent" id="deductions_percent" required />
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<label class="form-check-label">Status</label>
															<select class="form-control form-control-sm" name="deductions_status" id="deductions_status" required>
																<option value=''>-- Select Status --</option>
																<option value='Active'>Active</option>
																<option value='Inactive'>Inactive</option>
															</select>
														</div>
													</div>
													<div class="col-md-2" style="margin-top:23px;">
														<button type="submit" class="btn btn-success btn-sm">Submit</button>
														<button type="reset" class="btn btn-danger btn-sm" id="ResetBtn2">Reset</button>
													</div>
												</div>
											</form>
											<hr />
										</div>
										<div class="col-md-12 col-sm-12 col-12">
											<div class="table-responsive">
												<table class="table table-bordered" id="DataTable2" width="100%">
													<thead>
														<tr>
															<th width="8%">#</th>
															<th width="40%">Name</th>
															<th width="20%">Percent</th>
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
		$('#DataTable1').DataTable({
			'processing': true,
			'serverSide': true,
			'serverMethod': 'post',
			"order": [
				[1, "asc"]
			],
			'ajax': {
				'url': "<?= base_url() . 'list_salary_earninings' ?>",
				'type': "POST"
			},
			"columnDefs": [{
				"targets": [0, 4],
				"orderable": false
			}]
		});

		$('#DataTable2').DataTable({
			'processing': true,
			'serverSide': true,
			'serverMethod': 'post',
			"order": [
				[1, "asc"]
			],
			'ajax': {
				'url': "<?= base_url() . 'list_salary_deductions' ?>",
				'type': "POST"
			},
			"columnDefs": [{
				"targets": [0, 4],
				"orderable": false
			}]
		});
	});

	$("#ResetBtn1").click(function() {
		clear_earninings_form();
	});

	$("#DataForm1").on('submit', (function(e) {
		e.preventDefault();
		var formData = new FormData($("#DataForm1")[0]);
		$.ajax({
			url: "<?= base_url() . 'add_edit_salary_earninings' ?>",
			type: "POST",
			data: formData,
			dataType: "JSON",
			contentType: false,
			cache: false,
			processData: false,
			beforeSend: function() {
				$("#DataForm1 [type='submit']").attr('disabled', true);
			},
			success: function(data) {
				if (data['status'] == "Error") {
					toastr.error(data['msg']);
				} else {
					clear_earninings_form();
					$('#DataTable1').DataTable().ajax.reload(null, false);
					toastr.success(data['msg']);
				}
			},
			complete: function(data) {
				$("#DataForm1 [type='submit']").attr('disabled', false);
			},
		});
	}));

	$(document).on("click", ".delete_earninings_data", function() {
		var val = confirm("Are You Sure to Delete !!!");
		if (val == true) {
			$.ajax({
				url: "<?= base_url() . 'delete_salary_earninings' ?>",
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
						$('#DataTable1').DataTable().ajax.reload(null, false);
					}
				}
			});
		}
	});

	$(document).on("click", ".edit_earninings_data", function() {
		$("#DataForm1 [type='submit']").html('Update');
		$('#earninings_row_id').val($(this).attr('data-id'));
		$('#earninings_name').val($(this).attr('data-name'));
		$('#earninings_percent').val($(this).attr('data-percent'));
		$('#earninings_status').val($(this).attr('data-status'));

		window.scroll({
			top: 0,
			behavior: "smooth"
		})
	});

	function clear_earninings_form() {
		$('#earninings_row_id').val('');
		$("#DataForm1 [type='submit']").html('Submit');
		$("#DataForm1").trigger('reset');
	}

	//Deductions Form
	$("#ResetBtn2").click(function() {
		clear_deductions_form();
	});

	$("#DataForm2").on('submit', (function(e) {
		e.preventDefault();
		var formData = new FormData($("#DataForm2")[0]);
		$.ajax({
			url: "<?= base_url() . 'add_edit_salary_deductions' ?>",
			type: "POST",
			data: formData,
			dataType: "JSON",
			contentType: false,
			cache: false,
			processData: false,
			beforeSend: function() {
				$("#DataForm2 [type='submit']").attr('disabled', true);
			},
			success: function(data) {
				if (data['status'] == "Error") {
					toastr.error(data['msg']);
				} else {
					clear_deductions_form();
					$('#DataTable2').DataTable().ajax.reload(null, false);
					toastr.success(data['msg']);
				}
			},
			complete: function(data) {
				$("#DataForm2 [type='submit']").attr('disabled', false);
			},
		});
	}));

	$(document).on("click", ".delete_deductions_data", function() {
		var val = confirm("Are You Sure to Delete !!!");
		if (val == true) {
			$.ajax({
				url: "<?= base_url() . 'delete_salary_deductions' ?>",
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
						$('#DataTable2').DataTable().ajax.reload(null, false);
					}
				}
			});
		}
	});

	$(document).on("click", ".edit_deductions_data", function() {
		$("#DataForm2 [type='submit']").html('Update');
		$('#deductions_row_id').val($(this).attr('data-id'));
		$('#deductions_name').val($(this).attr('data-name'));
		$('#deductions_percent').val($(this).attr('data-percent'));
		$('#deductions_status').val($(this).attr('data-status'));

		window.scroll({
			top: 0,
			behavior: "smooth"
		})
	});

	function clear_deductions_form() {
		$('#deductions_row_id').val('');
		$("#DataForm2 [type='submit']").html('Submit');
		$("#DataForm2").trigger('reset');
	}
</script>