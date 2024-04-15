<?php echo load_datatables(); ?>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
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
                        <li class="breadcrumb-item active"><a href="<?= base_url().'leave_request_master' ?>"><?= $page_title ?></a></li>
                    </ol>
                </div>
            </div>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header p-2">
							<ul class="nav nav-pills">
								<li class="nav-item"><a class="nav-link active" href="#attendance_import" data-toggle="tab">Attendance Import</a></li>
								<li class="nav-item"><a class="nav-link" href="#attendance_approve" data-toggle="tab">Attendance Approval</a></li>
							</ul>
						</div>
						<div class="card-body">
							<div class="tab-content">
								<div class="tab-pane active" id="attendance_import">
									<div class="row">
										<div class="col-md-6 col-sm-6 col-6">
											<div class="row">
												<div class="col-md-10 col-sm-10 col-10">
													<select class="form-control form-control-sm select2" id="search_emp_id" required>
														<?php
															if(!empty($list_employee)){
																echo '<option value="">Select Employee</option>';
																foreach($list_employee as $row){
																	echo '<option value="'.$row['employee_id'].'">'.$row['emp_id'].' - '.$row['employeename'].'</option>';
																}
															}else{
																echo '<option value="">Employee List Empty</option>';
															}
														?>
													</select>
												</div>
												<div class="col-md-2 col-sm-2 col-2">
													<button type="button" id="SearchBtn" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> View</button>
												</div>
											</div>
										</div>
										<div class="col-md-6 col-sm-6 col-6 text-right">
											<button type="button" id="AddBtn" class="btn btn-info btn-sm"><i class="fa fa-upload"></i> Import</button>
											<button type="button" id="FillerBtn" class="btn btn-info btn-sm"><i class="fa fa-search"></i> Filter</button>
											<a href="<?= base_url().'view_attendance_report' ?>" target="_blank" class="btn btn-info btn-sm"><i class="fa fa-list"></i> List</a>
										</div>
										<div class="col-md-12 col-sm-12 col-12" id="FilterDiv"><hr/>
											<h4>Filter</h4>
											<div class="row">
												<div class="col-md-4">
													<select class="form-control form-control-sm select2" id="attend_month_year">
														<?php
															if(!empty($list_month)){
																echo '<option value="">Select Month</option>';
																foreach($list_month as $row){
																	echo '<option value="'.$row['attend_month_year'].'">'.$row['attend_month_year'].'</option>';
																}
															}else{
																echo '<option value="">Month List Empty</option>';
															}
														?>
													</select>
												</div>
												<div class="col-md-4">
													<button class="btn btn-success btn-sm" type="button" id="FilterSearchBtn">Search</button>
												</div>
											</div>
										</div>
										<div class="col-md-12 col-sm-12 col-12"><hr/>
											<div class="table-responsive">
												<table class="table table-bordered" id="ImportDataTable" width="100%">
													<thead>
														<tr>
															<th width="5%">#</th>
															<th width="15%">Date</th>
															<th width="20%">Employee Details</th>
															<th width="7%">Shift</th>
															<th width="17%">Time Details</th>
															<th width="9%">Worked Duration</th>
															<th width="10%">OT</th>
															<th width="9%">Total Duration</th>
															<th width="15%">Status</th>
														</tr>
													</thead>
												</table>
											</div>
										</div>
									</div>
								</div>
								<div class="tab-pane" id="attendance_approve">
									<h4>Filter</h4>
									<div class="row">
										<div class="col-md-4 col-sm-4 col-4">
											<select class="form-control form-control-sm select2" id="approve_emp_id" required>
												<?php
													if(!empty($list_employee)){
														echo '<option value="">Select Employee</option>';
														foreach($list_employee as $row){
															echo '<option value="'.$row['employee_id'].'">'.$row['emp_id'].' - '.$row['employeename'].'</option>';
														}
													}else{
														echo '<option value="">Employee List Empty</option>';
													}
												?>
											</select>
										</div>
										<div class="col-md-2 col-sm-2 col-2">
											<select class="form-control form-control-sm select2" id="attend_month_year">
												<?php
													if(!empty($list_month)){
														echo '<option value="">Select Month</option>';
														foreach($list_month as $row){
															echo '<option value="'.$row['attend_month_year'].'">'.$row['attend_month_year'].'</option>';
														}
													}else{
														echo '<option value="">Month List Empty</option>';
													}
												?>
											</select>
										</div>
										<div class="col-md-2 col-sm-2 col-2">
											<input type="text" class="form-control form-control-sm datepicker" name="birthdate" placeholder="Start Date" />
										</div>
										<div class="col-md-2 col-sm-2 col-2">
											<input type="text" class="form-control form-control-sm datepicker" name="birthdate" placeholder="End Date" />
										</div>
										<div class="col-md-2 col-sm-2 col-2">
											<button class="btn btn-success btn-sm" type="button" id="">Search</button>
											<button class="btn btn-danger btn-sm" type="button" id="">Reset</button>
										</div>
									</div>
									<form id="ApproveForm" autocomplete="OFF">
										<div class="row">
											<div class="col-md-10 col-sm-12 col-12"><hr/>
												<div class="table-responsive">
													<table class="table table-bordered" id="ApproveDataTable" width="100%">
														<thead>
															<tr>
																<th width="5%">#</th>
																<th width="10%">Date</th>
																<th width="20%">Employee Details</th>
																<th width="10%">Shift</th>
																<th width="20%">Time Details</th>
																<th width="10%">Worked Duration</th>
																<th width="10%">OT</th>
																<th width="10%">Total Duration</th>
																<th width="15%">Status</th>
															</tr>
														</thead>
													</table>
												</div>
											</div>
											<div class="col-md-2 col-sm-12 col-12"><hr>
												<div class="form-group">
													<label>Status</label><br/>
													<input type="radio" name="attend_app_status" value="1" checked>Salary Paid<br/>
													<input type="radio" name="attend_app_status" value="2"> OT Paid<br/>
													<input type="radio" name="attend_app_status" value="3"> Government Paid<br/>
													<input type="radio" name="attend_app_status" value="4"> Deduction
													<input type="radio" name="attend_app_status" value="5"> Half Paid
												</div>
												<div class="form-group">
													<label>Amount</label>
													<input type="text" class="form-control form-control-sm" name="attend_amount" onkeypress='return Validate(event);' />
												</div>
												<div class="form-group">
													<label>Leave Category</label>
													<select class="form-control form-control-sm" name="attend_leave_category" >
														<?php
															$result = list_leave_category();
															if(!empty($result)){
																echo '<option value="">Select Leave Category</option>';
																foreach($result as $row){
																	echo '<option value="'.$row['id'].'">'.$row['category_name'].'</option>';
																}
															}else{
																echo '<option value="">Leave Category List Empty</option>';
															}
														?>
													</select>
												</div>
												<div class="form-group">
													<label>Notes</label>
													<textarea class="form-control form-control-sm" name="attend_app_notes" rows="4" placeholder="Notes"></textarea>
												</div>
												<div class="form-group">
													<button class="btn btn-success btn-sm" type="submit">Submit</button>
													<button class="btn btn-danger btn-sm" type="button" id="">Reset</button>
												</div>
											</div>
										</div>
									</form>
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
						<div class="col-md-4">
							<div class="form-group">
								<label class="form-check-label">Attendance Month</label>
								<select class="form-control form-control-sm select2" name="import_month" id="import_month" required >
									<option value="">Select Month</option>
									<option value="January">January	</option>
									<option value="February">February</option>
									<option value="March">March</option>
									<option value="April">April</option>
									<option value="May">May</option>
									<option value="June">June</option>
									<option value="July">July</option>
									<option value="August">August</option>
									<option value="September">September</option>
									<option value="October">October</option>
									<option value="November">November</option>
									<option value="December">December</option>
								</select>
							</div>
						</div>
						<div class="col-md-8">
							<div class="form-group">
								<label class="form-check-label">Attachment (Excel File)</label>
								<input type="file" class="form-control form-control-sm" name="import_excel" id="import_excel" required />
							</div>
						</div>
					</div>
					<div class="text-right">
						<a href="<?= base_url().'assets/attendance_import.xlsx' ?>" downloaded>Download Sample File</a>
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
	$('#ImportDataTable').DataTable({
		'processing': true,
		'serverSide': true,
		'serverMethod': 'post',
		"order": [[ 1, "desc" ]],
		'ajax': {
			'url':	"<?= base_url().'list_attendance_import' ?>",
			'type':	"POST",
			'data': function (d) {
				d.attend_month_year = $("#attend_month_year").val()
			},
		},
		"columnDefs": [{ 
			"targets": [0],
			"orderable": false
		}]
	});
	
	$('#ApproveDataTable').DataTable({
		'processing': true,
		'serverSide': true,
		'serverMethod': 'post',
		"order": [[ 1, "desc" ]],
		'ajax': {
			'url':	"<?= base_url().'list_attendance_approve' ?>",
			'type':	"POST",
			'data': function (d) {
				d.attend_month_year = $("#attend_month_year").val()
			},
		},
		"columnDefs": [{ 
			"targets": [0],
			"orderable": false
		}]
	});
	
	$("#FilterDiv").hide();
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
		url: "<?= base_url().'add_attendance_import' ?>",
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

$("#SearchBtn").click(function(){
	var id = $("#search_emp_id").val();
	window.location.href="<?= base_url().'attendance/' ?>"+id;
});

$("#FillerBtn").click(function(){
	$("#FilterDiv").toggle();
});

$("#FilterSearchBtn").click(function(){
	$('#ImportDataTable').DataTable().ajax.reload(null, false);
});

//Approve Process
$("#ApproveForm").on('submit',(function(e){
	e.preventDefault();
	var formData = new FormData($("#ApproveForm")[0]);
	$.ajax({
		url: "<?= base_url().'add_attendance_approve' ?>",
		type: "POST",
		data:  formData,
		dataType: "JSON",
		contentType: false,
		cache: false,
		processData:false,
		beforeSend: function() {
			$("#ApproveForm [type='submit']").attr('disabled', true);
		},
		success: function(data)
		{
			if(data['status']=="Error"){
				toastr.error(data['msg']);
			}else{
				$("#ApproveForm").trigger('reset');
				$('#ImportDataTable').DataTable().ajax.reload(null, false);
				$('#ApproveDataTable').DataTable().ajax.reload(null, false);
				toastr.success(data['msg']);
			}
		},
		complete: function(data) {
			$("#ApproveForm [type='submit']").attr('disabled', false);
		},
	});
}));
</script>