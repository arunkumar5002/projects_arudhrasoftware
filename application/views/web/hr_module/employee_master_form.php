<?php echo load_datatables(); ?>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

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
                        <li class="breadcrumb-item active"><a href="<?= base_url().'employee_master' ?>">Employee Master</a></li>
                    </ol>
                </div>
            </div>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header p-2">
							<ul class="nav nav-pills">
								<li class="nav-item"><a class="nav-link active" href="#employee_details" id="nav_employee_details" data-toggle="tab">Employee Details</a></li>
								<li class="nav-item"><a class="nav-link" href="#passport_details" id="nav_passport_details" data-toggle="tab">Passport Details</a></li>
								<li class="nav-item"><a class="nav-link" href="#resident_permit_details" id="nav_resident_permit_details" data-toggle="tab">Resident Permit Details</a></li>
								<li class="nav-item"><a class="nav-link" href="#cpr_details" id="nav_cpr_details" data-toggle="tab">CPR Details</a></li>
								<li class="nav-item"><a class="nav-link" href="#bank_details" id="nav_bank_details" data-toggle="tab">Bank Details</a></li>
								<li class="nav-item"><a class="nav-link" href="#salary_details" id="nav_salary_details" data-toggle="tab">Salary Details</a></li>
								<li class="nav-item"><a class="nav-link" href="#certificate_details" id="nav_certificate_details" data-toggle="tab">Certificate Details</a></li>
							</ul>
						</div>
						<div class="card-body">
							<div class="tab-content">
								<div class="tab-pane active" id="employee_details">
									<form id="EmployeeForm" autocomplete="OFF">
										<input type="hidden" name="employee_row_id" id="employee_row_id" value="<?= (!empty($emp_details))?$emp_details->employee_id:'' ?>" />
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label class="form-check-label">Employee ID <span class="text-required">*</span></label>
													<input type="text" class="form-control form-control-sm" name="emp_id" id="emp_id" required value="<?= (!empty($emp_details))?$emp_details->emp_id:'' ?>" />
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label class="form-check-label">Employee Name <span class="text-required">*</span></label>
													<input type="text" class="form-control form-control-sm" name="employeename" id="employeename" required value="<?= (!empty($emp_details))?$emp_details->employeename:'' ?>" />
												</div>
											</div>
											<div class="col-md-4">
												<?php $employee_status = (!empty($emp_details))?$emp_details->employee_status:''; ?>
												<div class="form-group">
													<label class="form-check-label">Employee Status</label>
													<select class="form-control form-control-sm select2" name="employee_status">
														<option value="">-- Select Employee Status --</option>
														<option <?php if($employee_status=="Local"){ echo 'selected'; } ?> value="Local">Local</option>
														<option <?php if($employee_status=="Expat"){ echo 'selected'; } ?> value="Expat">Expat</option>
													</select>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label class="form-check-label">Email Address <span class="text-required">*</span></label>
													<input type="text" class="form-control form-control-sm" name="email" id="email" required value="<?= (!empty($emp_details))?$emp_details->email:'' ?>" />
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label class="form-check-label">Mobile No <span class="text-required">*</span></label>
													<input type="text" class="form-control form-control-sm" name="mobile" id="mobile" onkeypress='return Validate(event);' required value="<?= (!empty($emp_details))?$emp_details->mobile:'' ?>" />
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label class="form-check-label">Emergency Mobile No</label>
													<input type="text" class="form-control form-control-sm" name="emergency_mobile_no" id="emergency_mobile_no" value="<?= (!empty($emp_details))?$emp_details->emergency_mobile_no:'' ?>" />
												</div>
											</div>
											<div class="col-md-4">
												<?php $contract_type = (!empty($emp_details))?$emp_details->contract_type:''; ?>
												<div class="form-group">
													<label class="form-check-label">Contract Type</label>
													<select class="form-control form-control-sm select2" name="contract_type" id="contract_type">
														<option value="">-- Select Contract Type --</option>
														<option <?php if($contract_type=="Part Time"){ echo 'selected'; } ?> value="Part Time">Part Time</option>
														<option <?php if($contract_type=="Full Time"){ echo 'selected'; } ?> value="Full Time">Full Time</option>
													</select>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label class="form-check-label">Department <span class="text-required">*</span></label>
													<select class="form-control form-control-sm select2" name="department" id="department">
														<?php
															$department = (!empty($emp_details))?$emp_details->department:'';
															$list = list_employee_department();
															if(!empty($list)){
																echo '<option value="">-- Select Department --</option>';
																foreach($list as $row){
																	$temp = ($row['id']==$department)?'selected':'';
																	echo '<option value="'.$row['id'].'" '.$temp.'>'.$row['department_name'].'</option>';
																}
															}else{
																echo '<option value="">-- Department List Empty --</option>';
															}
														?>
													</select>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label class="form-check-label">Designation <span class="text-required">*</span></label>
													<select class="form-control form-control-sm select2" name="designation" id="designation">
														<?php
															$designation = (!empty($emp_details))?$emp_details->designation:'';
															$list = list_employee_desigantion();
															if(!empty($list)){
																echo '<option value="">-- Select Designation --</option>';
																foreach($list as $row){
																	$temp = ($row['id']==$designation)?'selected':'';
																	echo '<option value="'.$row['id'].'" '.$temp.'>'.$row['designation_name'].'</option>';
																}
															}else{
																echo '<option value="">-- Designation List Empty --</option>';
															}
														?>
													</select>
												</div>
											</div>
											<div class="col-md-4">
												<?php
													$birthdate = "";
													if((!empty($emp_details)) && ($emp_details->birthdate!="0000-00-00")){
														$birthdate = date('d-m-Y',strtotime($emp_details->birthdate));
													}
												?>
												<div class="form-group">
													<label class="form-check-label">DOB</label>
													<input type="text" class="form-control form-control-sm datepicker" name="birthdate" value="<?= $birthdate ?>" />
												</div>
											</div>
											<div class="col-md-4">
												<?php
													$employedDate = "";
													if((!empty($emp_details)) && ($emp_details->employedDate!="0000-00-00")){
														$employedDate = date('d-m-Y',strtotime($emp_details->employedDate));
													}
												?>
												<div class="form-group">
													<label class="form-check-label">Join Date</label>
													<input type="text" class="form-control form-control-sm datepicker" name="employedDate" value="<?= $employedDate ?>" />
												</div>
											</div>
											
											<div class="col-md-4"> <div class="form-group"> <label class="form-check-label">Nationality</label> <select class="form-control form-control-sm " name="nationality" id="nationality"> <option value="">-- Select Nationality Type --</option> <option value="Bahraini">Bahraini</option> <option value="Indian"> Indian </option> <option value="British"> British </option> <option value="French"> French </option> <option  value="Bangladeshi"> Bangladeshi </option> <option  value="SriLankan"> SriLankan </option> </select> </div> </div>
											
											
											<div class="col-md-4">
												<div class="form-group">
													<label class="form-check-label"> User Name<span class="text-required">*</span></label>
													<input type="text" class="form-control form-control-sm" name="username" id="username" value="<?= (!empty($emp_details))?$emp_details->username:'' ?>" />
												</div>
											</div>
						                    <div class="col-md-4">
												<div class="form-group">
													<label class="form-check-label">Password <?php if((!empty($emp_details)) && (empty($emp_details->username))){ ?><span class="text-required" id="password_div">*</span><?php } ?></label>
													<input type="password" class="form-control form-control-sm" name="password" id="password" <?php if((!empty($emp_details)) && (empty($emp_details->username))){ echo 'required'; }?>/>
												</div>
						                    </div>
											<div class="col-md-4">
												<div class="form-group">
													<label class="form-check-label">Confirm Password <?php if((!empty($emp_details)) && (empty($emp_details->username))){ ?><span class="text-required" id="password_div">*</span><?php } ?></label>
													<input type="password" class="form-control form-control-sm" name="confirm_password" id="confirm_password" <?php if((!empty($emp_details)) && (empty($emp_details->username))){ echo 'required'; }?>/>
												</div>
						                    </div>
											<div class="col-md-12">
												<div class="form-group">
													<label class="form-check-label">Address</label>
													<textarea class="form-control form-control-sm" name="address" rows="3" ><?= (!empty($emp_details))?$emp_details->address:''; ?></textarea>
												</div>
											</div>
											<div class="col-md-4">
												<?php $profile_image = (!empty($emp_details))?$emp_details->profile_image:''; ?>
												<div class="form-group">
													<label class="form-check-label">Employee Image <?php if(empty($profile_image)){ ?><span class="text-required">*</span><?php } ?></label>
													<input type="file" class="form-control form-control-sm" name="profile_image" <?php if(empty($profile_image)){ echo 'required'; } ?> />
												</div>
												<?php
													if(!empty($profile_image)){
														$path = base_url().EMPLOYEE_PROFILE_IMG_PATH.'/'.$profile_image;
														echo '<img src="'.$path.'" alt="No Employee Image" width="50%" />';
													}
												?>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label class="form-check-label">Spouse Name</label>
													<input type="text" class="form-control form-control-sm" name="spousename" value="<?= (!empty($emp_details))?$emp_details->spousename:'' ?>" />
												</div>
											</div>
											
											<div class="col-md-4">
												<?php $gender = (!empty($emp_details))?$emp_details->gender:''; ?>
												<div class="form-group">
													<label class="form-check-label">Gender <span class="text-required">*</span></label><br/>
													<input type="radio" name="gender" <?php if($gender=="Male"){ echo 'checked'; } ?> id="gender_male" value="Male" required > Male &nbsp;&nbsp;
													<input type="radio" name="gender" <?php if($gender=="Female"){ echo 'checked'; } ?> id="gender_female" value="Female" > Female
												</div>
											</div>
											
											
											<div class="col-md-12 text-right">
												<button class="btn btn-success" type="submit">Next</button>
											</div>
										</div>
									</form>
								</div>
								<div class="tab-pane" id="passport_details">
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
											<div class="col-md-12 text-right">
												<button class="btn btn-info" onclick="change_nav('passport_details','employee_details');" type="button">Prev</button>
												<button class="btn btn-success" type="submit">Next</button>
											</div>
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
											<div class="col-md-12 text-right">
												<button class="btn btn-info" onclick="change_nav('resident_permit_details','passport_details');" type="button">Prev</button>
												<button class="btn btn-success" type="submit">Next</button>
											</div>
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
											<div class="col-md-12 text-right">
												<button class="btn btn-info" onclick="change_nav('cpr_details','resident_permit_details');" type="button">Prev</button>
												<button class="btn btn-success" type="submit">Next</button>
											</div>
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
											<div class="col-md-12 text-right">
												<button class="btn btn-info" onclick="change_nav('bank_details','cpr_details');" type="button">Prev</button>
												<button class="btn btn-success" type="submit">Next</button>
											</div>
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
													<input type="text" id="basicsalary" class="form-control form-control-sm" name="basic_salary" value="<?= (!empty($emp_details))?$emp_details->basic_salary:'' ?>" required />
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label class="form-check-label">Other Allowance <span class="text-required">*</span></label>
													<input type="text" class="form-control form-control-sm" name="other_allowance" value="<?= (!empty($emp_details))?$emp_details->other_allowance:'' ?>" required />
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label class="form-check-label">SIO <span class="text-required">*</span></label>
													<input type="text" id="myform" class="form-control form-control-sm" name="sio" value="<?= (!empty($emp_details))?$emp_details->sio:'' ?>" required />
												</div>
											</div>
												<div class="col-md-1">
												<div class="form-group">
													<button type="button" id="AddBtn" class="btn btn-info btn-sm" style="margin-top: 21px;"><i class="fa fa-plus"></i></button>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label class="form-check-label">Limra Fee <span class="text-required">*</span></label>
													<input type="text" class="form-control form-control-sm" name="lmra_fee" value="<?= (!empty($emp_details))?$emp_details->lmra_fee:'' ?>" required />
												</div>
											</div>
											<div class="col-md-12 text-right">
												<button class="btn btn-info" onclick="change_nav('salary_details','bank_details');" type="button">Prev</button>
												<button class="btn btn-success" type="submit">Next</button>
											</div>
										</div>
									</form>
								</div>
								<div class="tab-pane" id="certificate_details">
									<form id="CertificateForm" autocomplete="OFF">
										<input type="text" name="certificate_row_id" id="certificate_row_id" value="<?= (!empty($emp_details))?$emp_details->employee_id:'' ?>" />
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
									</form>
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



<div class="modal fade show" id="FormModal" aria-modal="true" role="dialog">
	<div class="modal-dialog modal-lg">
		
			<input type="hidden" name="user_row_id" id="user_row_id" />
			<div class="modal-content">
				<div class="modal-header">
					<h4 id="FormModalHeading">Contribution</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
					<div class="col-md-6">
									
						
							<div class="form-group">
								<label class="form-check-label">Employee <span class="text-required">*</span></label>
								<select class="form-control form-control-sm emp" name="" id="emp" required>
									
									
								</select>
							</div>
						</div>
					
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-check-label">Employer Contribution <span class="text-required">*</span><span class="text-required" id="employ"></span></label>
								<input type="number" class="form-control form-control-sm value-1" name="employer" id="amount" required />
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-check-label">Employee Contribution  <span class="text-required">*</span><span class="text-required" id="contibution"></span></label>
								<input type="number" class="form-control form-control-sm value-2" name="employee" id="rate" required />
							</div>
						</div>
							<div class="col-md-6">
							<div class="form-group">
								<label class="form-check-label">Total SIO Contribution  <span class="text-required">*</span></label>
								<input type="text" class="form-control form-control-sm result" name="" id="totalPercentage" required />
							</div>
						</div>
				
					</div>
				</div>
				<div class="modal-footer" style="text-align:left !important;">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-success" id="sub">Submit</button>
					<button type="reset" class="btn btn-danger">Reset</button>
				</div>
			</div>
		
	</div>
</div>


<script>

$(document).ready(function() {
  $('#nationality').change(function() {
    var selectedOption = $(this).val();
      $('#emp').html('');
    if(selectedOption == 'Bahraini') {
      $('#emp').append('<option value="1">Local</option>');
    } else if(selectedOption == 'Indian') {
      $('#emp').append('<option value="2"> Expat </option>');
    } else if(selectedOption == 'British') {
      $('#emp').append('<option value="2">Expat</option>');
    } else if(selectedOption == 'French') {
      $('#emp').append('<option value="2">Expat</option>');
    } else if(selectedOption == 'Bangladeshi') {
      $('#emp').append('<option value="2">Expat</option>');
    } else if(selectedOption == 'SriLankan') {
      $('#emp').append('<option value="2">Expat</option>');
    }
	
  });
});
</script>
<script>
$("#EmployeeForm").on('submit',(function(e){
	e.preventDefault();
	var formData = new FormData($("#EmployeeForm")[0]);
	$.ajax({
		url: "<?= base_url().'add_edit_employee_details' ?>",
		type: "POST",
		data:  formData,
		dataType: "JSON",
		contentType: false,
		cache: false,
		processData:false,
		beforeSend: function() {
			$("#EmployeeForm [type='submit']").attr('disabled', true);
		},
		success: function(data)
		{
			if(data['status']=="Error"){
				toastr.error(data['msg']);
			}else{
				change_nav('employee_details','passport_details');
				toastr.success(data['msg']);
				
				$("#employee_row_id").val(data['emp_id']);
				$("#passport_row_id").val(data['emp_id']);
				$("#resident_row_id").val(data['emp_id']);
				$("#cpr_row_id").val(data['emp_id']);
				$("#bank_row_id").val(data['emp_id']);
				$("#salary_row_id").val(data['emp_id']);
				$("#certificate_row_id").val(data['emp_id']);
				$('#DataTable').DataTable().ajax.reload(null, false);
			}
		},
		complete: function(data) {
			$("#EmployeeForm [type='submit']").attr('disabled', false);
		},
	});
}));

$("#PassportForm").on('submit',(function(e){
	e.preventDefault();
	var formData = new FormData($("#PassportForm")[0]);
	$.ajax({
		url: "<?= base_url().'update_passport_details' ?>",
		type: "POST",
		data:  formData,
		dataType: "JSON",
		contentType: false,
		cache: false,
		processData:false,
		beforeSend: function() {
			$("#PassportForm [type='submit']").attr('disabled', true);
		},
		success: function(data)
		{
			if(data['status']=="Error"){
				toastr.error(data['msg']);
			}else{
				change_nav('passport_details','resident_permit_details');
				toastr.success(data['msg']);
			}
		},
		complete: function(data) {
			$("#PassportForm [type='submit']").attr('disabled', false);
		},
	});
}));

$("#ResidentForm").on('submit',(function(e){
	e.preventDefault();
	var formData = new FormData($("#ResidentForm")[0]);
	$.ajax({
		url: "<?= base_url().'update_resident_details' ?>",
		type: "POST",
		data:  formData,
		dataType: "JSON",
		contentType: false,
		cache: false,
		processData:false,
		beforeSend: function() {
			$("#ResidentForm [type='submit']").attr('disabled', true);
		},
		success: function(data)
		{
			if(data['status']=="Error"){
				toastr.error(data['msg']);
			}else{
				change_nav('resident_permit_details','cpr_details');
				toastr.success(data['msg']);
			}
		},
		complete: function(data) {
			$("#ResidentForm [type='submit']").attr('disabled', false);
		},
	});
}));

$("#CprForm").on('submit',(function(e){
	e.preventDefault();
	var formData = new FormData($("#CprForm")[0]);
	$.ajax({
		url: "<?= base_url().'update_cpr_details' ?>",
		type: "POST",
		data:  formData,
		dataType: "JSON",
		contentType: false,
		cache: false,
		processData:false,
		beforeSend: function() {
			$("#CprForm [type='submit']").attr('disabled', true);
		},
		success: function(data)
		{
			if(data['status']=="Error"){
				toastr.error(data['msg']);
			}else{
				change_nav('cpr_details','bank_details');
				toastr.success(data['msg']);
			}
		},
		complete: function(data) {
			$("#CprForm [type='submit']").attr('disabled', false);
		},
	});
}));

$("#BankForm").on('submit',(function(e){
	e.preventDefault();
	var formData = new FormData($("#BankForm")[0]);
	$.ajax({
		url: "<?= base_url().'update_bank_details' ?>",
		type: "POST",
		data:  formData,
		dataType: "JSON",
		contentType: false,
		cache: false,
		processData:false,
		beforeSend: function() {
			$("#BankForm [type='submit']").attr('disabled', true);
		},
		success: function(data)
		{
			if(data['status']=="Error"){
				toastr.error(data['msg']);
			}else{
				change_nav('bank_details','salary_details');
				toastr.success(data['msg']);
			}
		},
		complete: function(data) {
			$("#BankForm [type='submit']").attr('disabled', false);
		},
	});
}));

$("#SalaryForm").on('submit',(function(e){
	e.preventDefault();
	var formData = new FormData($("#SalaryForm")[0]);
	$.ajax({
		url: "<?= base_url().'update_salary_details' ?>",
		type: "POST",
		data:  formData,
		dataType: "JSON",
		contentType: false,
		cache: false,
		processData:false,
		beforeSend: function() {
			$("#SalaryForm [type='submit']").attr('disabled', true);
		},
		success: function(data)
		{
			if(data['status']=="Error"){
				toastr.error(data['msg']);
			}else{
				change_nav('salary_details','certificate_details');
				toastr.success(data['msg']);
			}
		},
		complete: function(data) {
			$("#SalaryForm [type='submit']").attr('disabled', false);
		},
	});
}));

function change_nav(nav_from,nav_to){
	$("#"+nav_from).removeClass("active");
	$("#"+nav_to).addClass("active");
	
	$("#nav_"+nav_from).removeClass("active");
	$("#nav_"+nav_to).addClass("active");
}

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

$("#CertificateForm").on('submit',(function(e){
	e.preventDefault();
	var formData = new FormData($("#CertificateForm")[0]);
	$.ajax({
		url: "<?= base_url().'add_certificate_details' ?>",
		type: "POST",
		data:  formData,
		dataType: "JSON",
		contentType: false,
		cache: false,
		processData:false,
		beforeSend: function() {
			$("#CertificateForm [type='submit']").attr('disabled', true);
		},
		success: function(data)
		{
			if(data['status']=="Error"){
				toastr.error(data['msg']);
			}else{
				$('#DataTable').DataTable().ajax.reload(null, false);
				toastr.success(data['msg']);
			}
		},
		complete: function(data) {
			$("#CertificateForm [type='submit']").attr('disabled', false);
		},
	});
}));



$(document).on("click",".delete_data",function(){
	var val = confirm("Are You Sure to Delete !!!");
	if(val==true){
		$.ajax({
			url: "<?= base_url().'delete_certificate' ?>",
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


<script>



$("#AddBtn").click(function(){
	$('#emp').trigger('change');
	$("#FormModal").modal('show');
});

/*$(document).ready(function() {
  $('#percent').change(function() {
    var amount = $('#amount').val();
	var rate = $('#rate').val();
    var percentage = $(this).val();
    var totalPercentage = amount + rate * percentage / 100;
    $('#totalPercentage').text(totalPercentage.toFixed(2));
  });
});*/

$(document).ready(function() {
 
  $('#emp').on('change', function() {
 var input = $('#basicsalary').val();
 

  if(($(this).val() == '1')){
	  a=parseFloat((12 / 100) * input);
      b=parseFloat((7 / 100) * input);
	  $('#employ').text('12');
	   $('#contibution').text('7');
  $('.value-1').val(a);
  $('.value-2').val(b);
  $('.result').val(a+b); 
  }else if($(this).val() == '2'){
	    $('#employ').text('3');
	   $('#contibution').text('1');
	  a=parseFloat((3 / 100) * input);
      b=parseFloat((1 / 100) * input);
	  
  $('.value-1').val(a);
  $('.value-2').val(b);
  $('.result').val(a+b);

  }
    
  //  var result = (value1 + value2) * percentage;
  
  });
});

$("#sub").click(function(){
	$('#myform').val($('.result').val());
	
	
	
});

/*$(document).ready(function() {

  $('.emp').on('change', function() {
    var basicsalary = parseFloat($('#basicsalary').val());
    var percentage = parseFloat($('#percentage').val()); 

    if($(this).val() == '1') {
      var value1 = basicsalary / 12;
      var value2 = basicsalary / 7;
    } else if($(this).val() == '2') {
      var value1 = basicsalary / 3;
      var value2 = basicsalary;
    }

    var result = (value1 + value2) * percentage / 100; 

    $('.result').val(result.toFixed(2)); 
  });
});*/

</script>