<?php echo load_datatables(); ?>
<style>
.alert{
	margin-bottom:0px;
}
.nav-link{
	color:black;
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
                        <li class="breadcrumb-item active"><a href="<?= base_url().'attendance_master' ?>">Attendance Master</a></li>
                    </ol>
                </div>
            </div>
			<div class="row">
				<div class="col-3">
					<div class="card card-primary">
						<div class="card-header">
							<h3 class="card-title">About Employee</h3>
						</div>
						<div class="card-body">
							<strong><i class="fa fa-caret-right mr-1"></i> Employee Name</strong>
							<p class="text-muted"><?= $employee_data->employeename ?></p><hr>
							<strong><i class="fa fa-caret-right mr-1"></i> Employee ID</strong>
							<p class="text-muted"><?= $employee_data->emp_id ?></p><hr>
							<strong><i class="fa fa-caret-right mr-1"></i> Mobile Number</strong>
							<p class="text-muted"><?= $employee_data->mobile ?></p><hr>
							<strong><i class="fa fa-caret-right mr-1"></i> Email Address</strong>
							<p class="text-muted"><?= $employee_data->email ?></p><hr>
							<strong><i class="fa fa-caret-right mr-1"></i> Department</strong>
							<p class="text-muted"><?= $emp_department->department_name ?></p><hr>
							<strong><i class="fa fa-caret-right mr-1"></i> Designation</strong>
							<p class="text-muted"><?= $emp_designation->designation_name ?></p>
						</div>
					</div>
				</div>
				<div class="col-9">
					<div class="card">
						<div class="card-header p-2">
							<ul class="nav nav-pills">
								<li class="nav-item"><a class="nav-link active" href="#overall_attendance" data-toggle="tab">Overall Attendance</a></li>
								<li class="nav-item"><a class="nav-link" href="#category_wise_attendance" data-toggle="tab">Category Wise Attendance</a></li>
							</ul>
						</div>
						<div class="card-body">
							<div class="tab-content">
								<div class="tab-pane active" id="overall_attendance">
									<div class="row">
										<div class="col-md-12 col-sm-12 col-12 text-right">
											<button type="button" id="" class="btn btn-info btn-sm"><i class="fa fa-download"></i> Export</button>
											<button type="button" id="FillerBtn" class="btn btn-info btn-sm"><i class="fa fa-search"></i> Filter</button>
										</div>
										<div class="col-md-12 col-sm-12 col-12"><hr/>
											<div class="table-responsive">
												<table class="table table-bordered" id="DataTable" width="100%">
													<thead>
														<tr>
															<th width="5%">#</th>
															<th width="10%">Date</th>
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
									</div>
								</div>
								<div class="tab-pane" id="category_wise_attendance">
									<div class="row">
										<div class="col-md-4">
											<div class="card card-widget widget-user-2">
												<div class="widget-user-header bg-warning">
													<h5 class="widget-user-desc" style="text-align: center; margin-left:0px;">2019 - 2020</h5>
												</div>
												<div class="card-footer p-0">
													<ul class="nav flex-column">
														<?php
															if(!empty($list_leave)){
																foreach($list_leave as $row){
																	echo '<li class="nav-item">';
																		echo '<a class="nav-link">';
																			echo $row['category_name'].' <span class="float-right badge bg-primary">31/50</span>';
																		echo '</a>';
																	echo '</li>';
																}
															}else{
																echo '<li class="nav-item">';
																	echo '<a class="nav-link">';
																		echo '<div class="alert alert-danger">No More Records</div>';
																	echo '</a>';
																echo '</li>';
															}
														?>
													</ul>
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
		</div>
    </section>
</div>

<script>
$(document).ready(function(){
	$('#DataTable').DataTable({
		'processing': true,
		'serverSide': true,
		'serverMethod': 'post',
		"order": [[ 1, "DESC" ]],
		'ajax': {
			'url':	"<?= base_url().'list_attendance_import' ?>",
			'type':	"POST",
			'data': function (d) {
				d.emp_id = <?= $employee_id ?>
			},
		},
		"columnDefs": [{ 
			"targets": [0],
			"orderable": false
		}]
	});
});
</script>