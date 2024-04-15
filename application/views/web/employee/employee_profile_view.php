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
                        <li class="breadcrumb-item active"><a href="<?= base_url().'employee_profile' ?>"><?= $page_title ?></a></li>
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
							<p class="text-muted"><?= $emp_details->employeename ?></p><hr>
							<strong><i class="fa fa-caret-right mr-1"></i> Employee ID</strong>
							<p class="text-muted"><?= $emp_details->emp_id ?></p><hr>
							<strong><i class="fa fa-caret-right mr-1"></i> Mobile Number</strong>
							<p class="text-muted"><?= $emp_details->mobile ?></p><hr>
							<strong><i class="fa fa-caret-right mr-1"></i> Email Address</strong>
							<p class="text-muted"><?= $emp_details->email ?></p><hr>
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
								<li class="nav-item"><a class="nav-link active" href="#passport_details" id="nav_passport_details" data-toggle="tab">Passport Details</a></li>
								<li class="nav-item"><a class="nav-link" href="#resident_permit_details" id="nav_resident_permit_details" data-toggle="tab">Resident Permit Details</a></li>
								<li class="nav-item"><a class="nav-link" href="#cpr_details" id="nav_cpr_details" data-toggle="tab">CPR Details</a></li>
								<li class="nav-item"><a class="nav-link" href="#bank_details" id="nav_bank_details" data-toggle="tab">Bank Details</a></li>
								<li class="nav-item"><a class="nav-link" href="#salary_details" id="nav_salary_details" data-toggle="tab">Salary Details</a></li>
								<li class="nav-item"><a class="nav-link" href="#certificate_details" id="nav_certificate_details" data-toggle="tab">Certificate Details</a></li>
							</ul>
						</div>
						<div class="card-body">
							<div class="tab-content">
								<div class="tab-pane active" id="passport_details">
									<form id="PassportForm" autocomplete="OFF">
										<input type="hidden" name="passport_row_id" id="passport_row_id" value="<?= (!empty($emp_details))?$emp_details->employee_id:'' ?>" />
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label class="form-check-label">Name in Passport <span class="text-required">*</span></label>
													<input type="text" class="form-control form-control-sm" name="passport_name" required value="<?= (!empty($emp_details))?$emp_details->passport_name:'' ?>" />
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label class="form-check-label">Passport Number <span class="text-required">*</span></label>
													<input type="text" class="form-control form-control-sm" name="passport_number" required value="<?= (!empty($emp_details))?$emp_details->passport_number:'' ?>" />
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label class="form-check-label">Place of Issue <span class="text-required">*</span></label>
													<input type="text" class="form-control form-control-sm" name="passport_issue_place" required value="<?= (!empty($emp_details))?$emp_details->passport_issue_place:'' ?>" />
												</div>
											</div>
											<div class="col-md-4">
												<?php $passport_file = (!empty($emp_details))?$emp_details->passport_file:''; ?>
												<div class="form-group">
													<label class="form-check-label">Passport Document <?php if(empty($passport_file)){ ?><span class="text-required">*</span><?php } ?></label>
													<input type="file" class="form-control form-control-sm" name="passport_file" <?php if(empty($passport_file)){ echo 'required'; } ?> />
												</div>
												<?php
													if(!empty($passport_file)){
														$path = base_url().EMPLOYEE_PASSPORT_IMG_PATH.'/'.$passport_file;
														echo '<img src="'.$path.'" alt="No Employee Image" width="50%" />';
													}
												?>
											</div>
											<div class="col-md-4">
												<?php
													$passport_issue_date = "";
													if((!empty($emp_details)) && (!empty($emp_details->passport_issue_date)) && ($emp_details->passport_issue_date!="0000-00-00")){
														$passport_issue_date = date('d-m-Y',strtotime($emp_details->passport_issue_date));
													}
												?>
												<div class="form-group">
													<label class="form-check-label">Date of Issue <span class="text-required">*</span></label>
													<input type="text" class="form-control form-control-sm datepicker" name="passport_issue_date" value="<?= $passport_issue_date ?>" required />
												</div>
											</div>
											<div class="col-md-4">
												<?php
													$passport_expiry_date = "";
													if((!empty($emp_details)) && (!empty($emp_details->passport_expiry_date)) && ($emp_details->passport_expiry_date!="0000-00-00")){
														$passport_expiry_date = date('d-m-Y',strtotime($emp_details->passport_expiry_date));
													}
												?>
												<div class="form-group">
													<label class="form-check-label">Date of Expiry <span class="text-required">*</span></label>
													<input type="text" class="form-control form-control-sm datepicker" name="passport_expiry_date" value="<?= $passport_expiry_date ?>" required />
												</div>
											</div>
											<!--<div class="col-md-12 text-right">
												<button class="btn btn-info" onclick="change_nav('passport_details','employee_details');" type="button">Prev</button>
												<button class="btn btn-success" type="submit">Next</button>
											</div>-->
										</div>
									</form>
								</div>
								<div class="tab-pane" id="resident_permit_details">
									<form id="ResidentForm" autocomplete="OFF">
										<input type="hidden" name="resident_row_id" id="resident_row_id" value="<?= (!empty($emp_details))?$emp_details->employee_id:'' ?>" />
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label class="form-check-label">RP Number <span class="text-required">*</span></label>
													<input type="text" class="form-control form-control-sm" name="rp_number" required value="<?= (!empty($emp_details))?$emp_details->rp_number:'' ?>" />
												</div>
											</div>
											<div class="col-md-4">
												<?php
													$rp_issue_date = "";
													if((!empty($emp_details)) && (!empty($emp_details->rp_issue_date)) && ($emp_details->rp_issue_date!="0000-00-00")){
														$rp_issue_date = date('d-m-Y',strtotime($emp_details->rp_issue_date));
													}
												?>
												<div class="form-group">
													<label class="form-check-label">Date of Issue <span class="text-required">*</span></label>
													<input type="text" class="form-control form-control-sm datepicker" name="rp_issue_date" value="<?= $rp_issue_date ?>" required />
												</div>
											</div>
											<div class="col-md-4">
												<?php
													$rp_expiry_date = "";
													if((!empty($emp_details)) && (!empty($emp_details->rp_expiry_date)) && ($emp_details->rp_expiry_date!="0000-00-00")){
														$rp_expiry_date = date('d-m-Y',strtotime($emp_details->rp_expiry_date));
													}
												?>
												<div class="form-group">
													<label class="form-check-label">Date of Expiry <span class="text-required">*</span></label>
													<input type="text" class="form-control form-control-sm datepicker" name="rp_expiry_date" value="<?= $rp_expiry_date ?>" required />
												</div>
											</div>
											<div class="col-md-4">
												<?php $rp_file = (!empty($emp_details))?$emp_details->rp_file:''; ?>
												<div class="form-group">
													<label class="form-check-label">RP Document Image <?php if(empty($rp_file)){ ?><span class="text-required">*</span><?php } ?></label>
													<input type="file" class="form-control form-control-sm" name="rp_file" id="rp_file" <?php if(empty($rp_file)){ echo 'required'; } ?> />
												</div>
												<?php
													if(!empty($rp_file)){
														$path = base_url().EMPLOYEE_PR_FILE_IMG_PATH.'/'.$rp_file;
														echo '<img src="'.$path.'" alt="No Employee Image" width="50%" />';
													}
												?>
											</div>
											<!--<div class="col-md-12 text-right">
												<button class="btn btn-info" onclick="change_nav('resident_permit_details','passport_details');" type="button">Prev</button>
												<button class="btn btn-success" type="submit">Next</button>
											</div>-->
										</div>
									</form>
								</div>
								<div class="tab-pane" id="cpr_details">
									<form id="CprForm" autocomplete="OFF">
										<input type="hidden" name="cpr_row_id" id="cpr_row_id" value="<?= (!empty($emp_details))?$emp_details->employee_id:'' ?>" />
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label class="form-check-label">Name as per ID <span class="text-required">*</span></label>
													<input type="text" class="form-control form-control-sm" name="crp_name" value="<?= (!empty($emp_details))?$emp_details->crp_name:'' ?>" required />
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label class="form-check-label">CRP Number <span class="text-required">*</span></label>
													<input type="text" class="form-control form-control-sm" name="crp_number" value="<?= (!empty($emp_details))?$emp_details->crp_number:'' ?>" required />
												</div>
											</div>
											<div class="col-md-4">
												<?php
													$crp_issue_date = "";
													if((!empty($emp_details)) && (!empty($emp_details->crp_issue_date)) && ($emp_details->crp_issue_date!="0000-00-00")){
														$crp_issue_date = date('d-m-Y',strtotime($emp_details->crp_issue_date));
													}
												?>
												<div class="form-group">
													<label class="form-check-label">Date of Issue <span class="text-required">*</span></label>
													<input type="text" class="form-control form-control-sm datepicker" name="crp_issue_date" value="<?= $crp_issue_date ?>" required />
												</div>
											</div>
											<div class="col-md-4">
												<?php
													$crp_expiry_date = "";
													if((!empty($emp_details)) && (!empty($emp_details->crp_expiry_date)) && ($emp_details->crp_expiry_date!="0000-00-00")){
														$crp_expiry_date = date('d-m-Y',strtotime($emp_details->crp_expiry_date));
													}
												?>
												<div class="form-group">
													<label class="form-check-label">Date of Expiry <span class="text-required">*</span></label>
													<input type="text" class="form-control form-control-sm datepicker" name="crp_expiry_date" value="<?= $crp_expiry_date ?>" required />
												</div>
											</div>
											<!--<div class="col-md-12 text-right">
												<button class="btn btn-info" onclick="change_nav('cpr_details','resident_permit_details');" type="button">Prev</button>
												<button class="btn btn-success" type="submit">Next</button>
											</div>-->
										</div>
									</form>
								</div>
								<div class="tab-pane" id="bank_details">
									<form id="BankForm" autocomplete="OFF">
										<input type="hidden" name="bank_row_id" id="bank_row_id" value="<?= (!empty($emp_details))?$emp_details->employee_id:'' ?>" />
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label class="form-check-label">Account Name <span class="text-required">*</span></label>
													<input type="text" class="form-control form-control-sm" name="bank_account_name" value="<?= (!empty($emp_details))?$emp_details->bank_account_name:'' ?>" required />
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label class="form-check-label">IBAN Number <span class="text-required">*</span></label>
													<input type="text" class="form-control form-control-sm" name="bank_iban" value="<?= (!empty($emp_details))?$emp_details->bank_iban:'' ?>" required />
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label class="form-check-label">Swift Code <span class="text-required">*</span></label>
													<input type="text" class="form-control form-control-sm" name="bank_swift_code" value="<?= (!empty($emp_details))?$emp_details->bank_swift_code:'' ?>" required />
												</div>
											</div>
											<!--<div class="col-md-12 text-right">
												<button class="btn btn-info" onclick="change_nav('bank_details','cpr_details');" type="button">Prev</button>
												<button class="btn btn-success" type="submit">Next</button>
											</div>-->
										</div>
									</form>
								</div>
								<div class="tab-pane" id="salary_details">
									<form id="SalaryForm" autocomplete="OFF">
										<input type="hidden" name="salary_row_id" id="salary_row_id" value="<?= (!empty($emp_details))?$emp_details->employee_id:'' ?>" />
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label class="form-check-label">Basic Salary <span class="text-required">*</span></label>
													<input type="text" class="form-control form-control-sm" name="basic_salary" value="<?= (!empty($emp_details))?$emp_details->basic_salary:'' ?>" required />
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label class="form-check-label">Other Allowance <span class="text-required">*</span></label>
													<input type="text" class="form-control form-control-sm" name="other_allowance" value="<?= (!empty($emp_details))?$emp_details->other_allowance:'' ?>" required />
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label class="form-check-label">SIO <span class="text-required">*</span></label>
													<input type="text" class="form-control form-control-sm" name="sio" value="<?= (!empty($emp_details))?$emp_details->sio:'' ?>" required />
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label class="form-check-label">Limra Fee <span class="text-required">*</span></label>
													<input type="text" class="form-control form-control-sm" name="lmra_fee" value="<?= (!empty($emp_details))?$emp_details->lmra_fee:'' ?>" required />
												</div>
											</div>
											<!--<div class="col-md-12 text-right">
												<button class="btn btn-info" onclick="change_nav('salary_details','bank_details');" type="button">Prev</button>
												<button class="btn btn-success" type="submit">Next</button>
											</div>-->
										</div>
									</form>
								</div>
								<div class="tab-pane" id="certificate_details">
									<input type="hidden" name="certificate_row_id" id="certificate_row_id" value="<?= (!empty($emp_details))?$emp_details->employee_id:'' ?>" />
									<!--<form id="CertificateForm" autocomplete="OFF">
										<div class="row">
											<div class="col-md-5">
												<div class="form-group">
													<label class="form-check-label">Certificate Name</label>
													<input type="text" class="form-control form-control-sm" name="certificate_name" required />
												</div>
											</div>
											<div class="col-md-5">
												<div class="form-group">
													<label class="form-check-label">Certificate Image</label>
													<input type="file" class="form-control form-control-sm" name="certificate_image" required />
												</div>
											</div>
											<div class="col-md-2" style="margin-top:23px;">
												<button type="submit" class="btn btn-success btn-sm">Submit</button>
												<button type="reset" class="btn btn-danger btn-sm" id="ResetBtn1">Reset</button>
											</div>
										</div>
									</form>-->
									<div class="row">
										<div class="col-md-12 table-responsive">
											<table class="table table-bordered" id="DataTable" width="100%">
												<thead>
													<tr>
														<th>SNo</th>
														<th>Certificate Name</th>
														<th>Certificate File Name</th>
														<th>Uploaded At</th>
														<th>Action</th>
													</tr>
												</thead>
											</table>
										</div>
										<div class="col-md-12 text-right"><br/>
											<button class="btn btn-info" onclick="change_nav('certificate_details','salary_details');" type="button">Prev</button>
											<a class="btn btn-success" href="<?= base_url().'employee_master' ?>">Submit</a>
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
		"order": [[ 1, "desc" ]],
		'ajax': {
			'url':	"<?= base_url().'list_certificate_details' ?>",
			'type':	"POST",
			'data': function (d) {
				d.emp_id = $("#certificate_row_id").val()
			},
		},
		"columnDefs": [{ 
			"targets": [0,4],
			"orderable": false
		}]
	});
});
</script>