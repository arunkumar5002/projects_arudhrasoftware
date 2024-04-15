 <?php echo load_datatables(); ?>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

<style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
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
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Purchasequote</a></li>
                    </ol>
                </div>
            </div>
			
			
			<!-- annual start -->
			
				<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<div class="row">
								
								<div class="col-md-12 col-sm-12 col-12">
									<div class="table-responsive">
										<h4> Annual 
										<p style="margin-left:880px;"> 
											<label class="switch">
											  <input type="checkbox" checked>
											  <span class="slider round"></span>
											</label> </p> </h4>
											
										<div class="col-md-6">
												<div class="form-group">
													<label class="form-group-text">Date <span class="text-required">*</span></label>
													<input type="text" class="form-control" name="date" id="date" readonly />
												</div>
											</div>
											
                                         <div class="col-md-6">
												<div class="form-group">
													<label class="form-check-label">Carry forward <span class="text-required">*</span></label>
													</br>
													<input type="radio" name="carry"> Yes
													<input type="radio" name="carry"> No
													<div class="input-group">
													<span class="input-group-text">Max</span>
													<input type="text" class="form-control" disabled>
													</div>
												</div>
											</div>			

											<div class="col-md-6">
												<div class="form-group">
													<label class="form-check-label">Earned leave	<span class="text-required">*</span></label>
													</br>
													<input type="radio" name="carry"> Yes
													<input type="radio" name="carry"> No
												</div>
												</div>
												
												
											<div class="custom-policy">
											<div class="leave-header">
											<div class="title">Custom policy</div>
											<div class="leave-action">
											<button class="btn btn-sm btn-primary addbtn" type="button"  style="margin-left: 799px;"><i class="fa fa-plus"></i> Add custom policy</button>
											</div>
											</div>
											</div>
											
											
											
											<table class="table table-hover table-nowrap leave-table mb-0" style="margin-top:20px;">
											<thead>
											<tr>
											<th class="l-name">Name</th>
											<th class="l-days">Days</th>
											<th class="l-assignee">Assignee</th>
											<th></th>
											</tr>
											</thead>
											<tbody>
											<tr>
											<td>5 Year Service </td>
											<td>5</td>
											<td>
											<a href="#" class="avatar"><img alt="" src="assets/img/profiles/avatar-02.jpg"></a>
											<a href="#">John Doe</a>
											</td>
											</tr>
											</table>
											
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<!-- annual end -->
			
			<!-- sick start -->
			
				<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<div class="row">
								
								<div class="col-md-12 col-sm-12 col-12">
									<div class="table-responsive">
										<h4> Sick 
										<p style="margin-left:880px;"> 
											<label class="switch">
											  <input type="checkbox" checked>
											  <span class="slider round"></span>
											</label> </p> </h4>
											
										<div class="col-md-6">
												<div class="form-group">
													<label class="form-group-text">Date <span class="text-required">*</span></label>
													<input type="text" class="form-control" name="date" id="date" readonly />
												</div>
											</div>
											
                                         
											
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<!-- sick end -->
			
			<!-- Hospitalisation start -->
			
				<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<div class="row">
								
								<div class="col-md-12 col-sm-12 col-12">
									<div class="table-responsive">
										<h4> Hospitalisation
										<p style="margin-left:880px;"> 
											<label class="switch">
											  <input type="checkbox" checked>
											  <span class="slider round"></span>
											</label> </p> </h4>
											
										<div class="col-md-6">
												<div class="form-group">
													<label class="form-group-text">Date <span class="text-required">*</span></label>
													<input type="text" class="form-control" name="date" id="date" readonly />
												</div>
											</div>
											
                                         <div class="custom-policy">
											<div class="leave-header">
											<div class="title">Custom policy</div>
											<div class="leave-action">
											<button class="btn btn-sm btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#add_custom_policy" style="margin-left: 799px;"><i class="fa fa-plus"></i> Add custom policy</button>
											</div>
											</div>
											</div>
											
											
											
											<table class="table table-hover table-nowrap leave-table mb-0" style="margin-top:20px;">
											<thead>
											<tr>
											<th class="l-name">Name</th>
											<th class="l-days">Days</th>
											<th class="l-assignee">Assignee</th>
											<th></th>
											</tr>
											</thead>
											<tbody>
											<tr>
											<td>5 Year Service </td>
											<td>5</td>
											<td>
											<a href="#" class="avatar"><img alt="" src="assets/img/profiles/avatar-02.jpg"></a>
											<a href="#">John Doe</a>
											</td>
											</tr>
											</table>
											
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<!-- Hospitalisation end -->
			
			

<!-- Maternity start -->
			
				<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<div class="row">
								
								<div class="col-md-12 col-sm-12 col-12">
									<div class="table-responsive">
										<h4> Maternity Assigned to female only
										<p style="margin-left:880px;"> 
											<label class="switch">
											  <input type="checkbox" checked>
											  <span class="slider round"></span>
											</label> </p> </h4>
											
										<div class="col-md-6">
												<div class="form-group">
													<label class="form-group-text">Date <span class="text-required">*</span></label>
													<input type="text" class="form-control" name="date" id="date" readonly />
												</div>
											</div>
											
                                         
											
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<!-- Maternity end -->
			
			
			<!-- Paternity start -->
			
				<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<div class="row">
								
								<div class="col-md-12 col-sm-12 col-12">
									<div class="table-responsive">
										<h4> Paternity Assigned to male only
										<p style="margin-left:880px;"> 
											<label class="switch">
											  <input type="checkbox" checked>
											  <span class="slider round"></span>
											</label> </p> </h4>
											
										<div class="col-md-6">
												<div class="form-group">
													<label class="form-group-text">Date <span class="text-required">*</span></label>
													<input type="text" class="form-control" name="date" id="date" readonly />
												</div>
											</div>
											
                                         
											
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<!-- Paternity end -->
			
			<!-- lop start -->
			
				<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<div class="row">
								
								<div class="col-md-12 col-sm-12 col-12">
									<div class="table-responsive">
										<h4> LOP 
										<p style="margin-left:880px;"> 
											<label class="switch">
											  <input type="checkbox" checked>
											  <span class="slider round"></span>
											</label> </p> <p style="margin-left:880px;"><button type="reset" class="btn btn-danger btn-sm">Delete</button> </p></h4>
											
										<div class="col-md-6">
												<div class="form-group">
													<label class="form-group-text">Date <span class="text-required">*</span></label>
													<input type="text" class="form-control" name="date" id="date" readonly />
												</div>
											</div>
											
                                         <div class="col-md-6">
												<div class="form-group">
													<label class="form-check-label">Carry forward <span class="text-required">*</span></label>
													</br>
													<input type="radio" name="carry"> Yes
													<input type="radio" name="carry"> No
													<div class="input-group">
													<span class="input-group-text">Max</span>
													<input type="text" class="form-control" disabled>
													</div>
												</div>
											</div>			

											<div class="col-md-6">
												<div class="form-group">
													<label class="form-check-label">Earned leave	<span class="text-required">*</span></label>
													</br>
													<input type="radio" name="carry"> Yes
													<input type="radio" name="carry"> No
												</div>
												</div>
												
												
											<div class="custom-policy">
											<div class="leave-header">
											<div class="title">Custom policy</div>
											<div class="leave-action">
											<button class="btn btn-sm btn-primary  add_custom_policy" type="button"  style="margin-left: 799px;"><i class="fa fa-plus"></i> Add custom policy</button>
											</div>
											</div>
											</div>
											
											
											
											<table class="table table-hover table-nowrap leave-table mb-0" style="margin-top:20px;">
											<thead>
											<tr>
											<th class="l-name">Name</th>
											<th class="l-days">Days</th>
											<th class="l-assignee">Assignee</th>
											<th></th>
											</tr>
											</thead>
											<tbody>
											<tr>
											<td>5 Year Service </td>
											<td>5</td>
											<td>
											<a href="#" class="avatar"><img alt="" src="assets/img/profiles/avatar-02.jpg"></a>
											<a href="#">John Doe</a>
											</td>
											</tr>
											</table>
											
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			
			<!-- lop end -->
			
			
			
			
		</div>
    </section>
</div>



<div class="modal fade show" id="FormModal" aria-modal="true" role="dialog">
	<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Add Custom Policy</h5>
<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<form>
<div class="form-group">
<label>Policy Name <span class="text-danger">*</span></label>
<input type="text" class="form-control">
</div>
<div class="form-group">
<label>Days <span class="text-danger">*</span></label>
<input type="text" class="form-control">
</div>
<div class="form-group leave-duallist">
<label>Add employee</label>
<div class="row">
<div class="col-lg-5 col-sm-5">
<select name="customleave_from" id="customleave_select" class="form-control form-select" size="5" multiple="multiple">
<option value="1">Bernardo Galaviz </option>
<option value="2">Jeffrey Warden</option>
<option value="2">John Doe</option>
<option value="2">John Smith</option>
<option value="3">Mike Litorus</option>
</select>
</div>
<div class="multiselect-controls col-lg-2 col-sm-2 d-grid gap-2">
<button type="button" id="customleave_select_rightAll" class="btn w-100 btn-white"><i class="fa fa-forward"></i></button>
<button type="button" id="customleave_select_rightSelected" class="btn w-100 btn-white"><i class="fa fa-chevron-right"></i></button>
<button type="button" id="customleave_select_leftSelected" class="btn w-100 btn-white"><i class="fa fa-chevron-left"></i></button>
<button type="button" id="customleave_select_leftAll" class="btn w-100 btn-white"><i class="fa fa-backward"></i></button>
</div>
<div class="col-lg-5 col-sm-5">
<select name="customleave_to" id="customleave_select_to" class="form-control form-select" size="8" multiple="multiple"></select>
</div>
</div>
</div>
<div class="submit-section">
<button class="btn btn-primary submit-btn">Submit</button>
</div>
</form>
 </div>
</div>
</div>
</div>




<script>
$(".addbtn").click(function(){

	$("#FormModal").modal('show');
});


</script>