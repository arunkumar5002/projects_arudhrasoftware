<?php echo load_datatables(); ?>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<style>
  table {
    border-collapse: collapse;
    width: 100%;
  }

  th, td {
    border: 1px solid black;
    padding: 8px;
    text-align: left;
  }

  th {
    background-color: #f2f2f2;
  }
</style>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row" style="margin-bottom:1.5rem!important;">
                <div class="col-sm-6">
                  
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">HR</a></li>
                        <li class="breadcrumb-item active"><a href="<?= base_url().'stock' ?>">Production Review</a></li>
                    </ol>
                </div>
            </div>
			
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header p-2">
							<ul class="nav nav-pills">
								<li class="nav-item"><a class="nav-link active" href="#employee_details" id="nav_employee_details" data-toggle="tab">Orders</a></li>
								<li class="nav-item"><a class="nav-link" href="#passport_details" id="nav_passport_details" data-toggle="tab">Lets Roll</a></li>
								<li class="nav-item"><a class="nav-link" href="#resident_permit_details" id="nav_resident_permit_details" data-toggle="tab">Stoppage Log</a></li>
								<li class="nav-item"><a class="nav-link" href="#cpr_details" id="nav_cpr_details" data-toggle="tab">Roll Defects</a></li>
								<li class="nav-item"><a class="nav-link" href="#bank_details" id="nav_bank_details" data-toggle="tab">QA Stage</a></li>
								<li class="nav-item"><a class="nav-link" href="#salary_details" id="nav_salary_details" data-toggle="tab">Pallet List</a></li>
								<li class="nav-item"><a class="nav-link" href="#certificate_details" id="nav_certificate_details" data-toggle="tab">Production Log </a></li>
								
							</ul>
						</div>
						<div class="card-body">
							<div class="tab-content">
								<div class="tab-pane active" id="employee_details">
								
								<form id="EmployeeForm" autocomplete="OFF">
										<input type="hidden" name="employee_row_id" id="employee_row_id" />
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label class="form-check-label">Customer ID <span class="text-required">*</span></label>
													<input type="text" class="form-control form-control-sm" name="emp_id" id="emp_id" />
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label class="form-check-label">No <span class="text-required">*</span></label>
													<input type="text" class="form-control form-control-sm" name="employeename" id="employeename" required />
												</div>
											</div>
									
											<div class="col-md-4">
												<div class="form-group">
													<label class="form-check-label">Name <span class="text-required">*</span></label>
													<input type="text" class="form-control form-control-sm" name="email" id="email" />
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label class="form-check-label">Office Tel <span class="text-required">*</span></label>
													<input type="text" class="form-control form-control-sm" name="mobile" id="mobile" onkeypress='return Validate(event);' required />
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label class="form-check-label">Office Tel</label>
													<input type="text" class="form-control form-control-sm" name="emergency_mobile_no" id="emergency_mobile_no"  />
												</div>
											</div>
									
										
									<div class="col-md-4">
												<div class="form-group">
													<label class="form-check-label">Mobile</label>
													<input type="text" class="form-control form-control-sm datepicker" name="birthdate"  />
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label class="form-check-label">Internal No</label>
													<input type="text" class="form-control form-control-sm datepicker" name="employedDate"  />
												</div>
											</div>
											
											
											
											
											<div class="col-md-4">
												<div class="form-group">
													<label class="form-check-label">Contact<span class="text-required">*</span></label>
													<input type="text" class="form-control form-control-sm" name="username" id="username"  />
												</div>
											</div>
						                    <div class="col-md-4">
												<div class="form-group">
													<label class="form-check-label">Email <span class="text-required" id="password_div">*</span></label>
													<input type="text" class="form-control form-control-sm" name="password" id="password" />
												</div>
						                    </div>
										
											<div class="col-md-4">
												<div class="form-group">
													<label class="form-check-label">Website</label>
													<input class="form-control form-control-sm" name="addres" />
												</div>
											</div>
												<div class="col-md-4">
											
												<div class="form-group">
													<label class="form-check-label">Terms</label>
													<select class="form-control form-control-sm select2" name="contract_type" id="contract_type">
														<option value="">-- Select Terms --</option>
														
													</select>
												</div>
											</div>
												<div class="col-md-4">
											
												<div class="form-group">
													<label class="form-check-label">Delivery</label>
													<select class="form-control form-control-sm select2" name="contract_type" id="contract_type">
														<option value="">-- Select  --</option>
														
													</select>
												</div>
											</div>
												<div class="col-md-4">
												<div class="form-group">
													<label class="form-check-label">Notes</label>
													<textarea class="form-control form-control-sm" name="address"></textarea>
												</div>
											</div>
											<div class="col-md-4">
												
												
												<div class="form-group">
													<label class="form-check-label">Quick List <span class="text-required">*</span></label><br/>
													<input type="radio" name="gender" id="gender_male" value="Male" required > Customer Order &nbsp;&nbsp;
													<input type="radio" name="gender"  id="gender_female" value="Female" > Production Order
												</div>
											</div>
											
											
											
										</div>
									</form>
								
																	<div class="row">
									<table style="margin-top:40px;">
  <thead>
    <tr>
      <th> ID </th>
      <th>Product Ref </th>
      <th> Customer </th>
      <th> Roll Court </th>
      <th> Production Order </th>
	  <th> Ilium pallet Date created</th>
	  <th> Roll Details </th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>1</td>
      <td>2023-05-23 10:00 AM</td>
      <td>John</td>
      <td>Doe</td>
      <td>12345</td>
	  <td> </td>
	   <td> </td>
    </tr>
    <tr>
      <td>2</td>
      <td>2023-05-23 11:30 AM</td>
      <td>Jane</td>
      <td>Smith</td>
      <td>67890</td>
	   <td> </td>
	  <td>
	  </td>
    </tr>
    <!-- Add more rows as needed -->
  </tbody>
</table>
</div>
								
								</div>
								<div class="tab-pane" id="passport_details">
									
									
									
									
								</div>
								<div class="tab-pane" id="cpr_details">
										
									
								
									
									
									
								</div>
								<div class="tab-pane" id="bank_details">
									
									
									
									
								</div>
								<div class="tab-pane" id="salary_details">
									<h4> Pallet List </h4> 
									<div class="row">
									<div class="col-md-12" style="margin-left: 676px;">
									<span> Pallet Count: 8 </span>
									
									</div>
									</div>
									<div class="row">
									&nbsp;&nbsp;
									<button class="btn btn-info" type="submit" style=" justify-content: flex-end; display: flex;"> Refresh  &nbsp; <i class="fas fa-sync-alt"></i></button>
									</div>
									
									<div class="row">
									<table style="margin-top:40px;">
  <thead>
    <tr>
      <th> ID </th>
      <th>Product Ref </th>
      <th> Customer </th>
      <th> Roll Court </th>
      <th> Production Order </th>
	  <th> Ilium pallet Date created</th>
	  <th> Roll Details </th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>1</td>
      <td>2023-05-23 10:00 AM</td>
      <td>John</td>
      <td>Doe</td>
      <td>12345</td>
	  <td> </td>
	   <td> </td>
    </tr>
    <tr>
      <td>2</td>
      <td>2023-05-23 11:30 AM</td>
      <td>Jane</td>
      <td>Smith</td>
      <td>67890</td>
	   <td> </td>
	  <td>
	  </td>
    </tr>
    <!-- Add more rows as needed -->
  </tbody>
</table>
</div>
									
									
								</div>
								<div class="tab-pane" id="certificate_details">
									
									
									
									
									
									
									
									
								</div>
								
							
									

									
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
					
						<div class="card-body">
							<div class="tab-content">
							
										
									
								
									
										
											
								
											
									
											
											
								
							
											
										
										</div>
							
								</div>
								
											
						</div>
							</div>
								</div>
										</div>
							</section>
								</div>
								
		
