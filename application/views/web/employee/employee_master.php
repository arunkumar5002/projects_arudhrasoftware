<!-- Content Wrapper. Contains page content -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<div class="content-wrapper">
 
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Employee Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><a href="<?php echo base_url() ?>Hr/employee_master">Employee</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
	<section class="content-header">
        <div class="container-fluid">
		<div class="card">
		<div class="card-header p-2">
							<ul class="nav nav-pills">
								<li class="nav-item"><a class="nav-link active" href="#timeline" data-toggle="tab"> Employee Details</a></li>
							</ul>
						</div>


   
    <form enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>Hr/save_employee">
	
        
            <ul class="nav nav-tabs">
                <li><a  class="nav-link active" data-bs-toggle="tab" href="#tabs-1">Employee Details</a></li>
                <li><a  class="nav-link " data-bs-toggle="tab" href="#tabs-2">Passport Details</a></li>
                <li><a  class="nav-link " data-bs-toggle="tab" href="#tabs-3"> Resident Permit Details</a></li>
                <li><a  class="nav-link " data-bs-toggle="tab" href="#tabs-4">CPR Details</a></li>
                <li><a  class="nav-link " data-bs-toggle="tab" href="#tabs-5">Bank Details</a></li>
                <li><a  class="nav-link " data-bs-toggle="tab" href="#tabs-6"> Salary </a></li>
            </ul>
			
		<div class="tab-content">
            <div class="tab-pane container active"  id="tabs-1">
                <div class="page-title">
                    <div class="title_left">
                        
                    </div>

                </div>
                <div class="clearfix"></div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">

                        <div class="x_content">
                            <br>


                            <div class="row">
                                <input type="hidden" name="employee_id" id="employee_id" value="<?php echo isset($edit) ? $edit->employee_id : ''; ?>" />

                                <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                    <label for="emp_id">Employee Id
                                        <span class="required">*</span>
                                    </label>

                                    <input type="text" id="emp_id" name="emp_id" class="form-control" required="" autocomplete="off" value="<?php echo isset($edit) ? $edit->emp_id : ''; ?>" />

                                </div>


                                <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                    <label for="email">Email <span class="required">*</span>
                                    </label>

                                    <input type="text" pattern="[a-zA-Z0-9._\-]+@[a-zA-Z0-9.\-]+\.[a-zA-Z]{2,4}" id="email" name="email" title="Please Enter Your Correct Email Address" class="form-control " autocomplete="off" value="<?php echo isset($edit) ? $edit->email : ''; ?>" />
                                    <span id="email" background="color:red"></span>
                                    <h6 id="result"></h6>
                                </div>

                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <label for="employeename"> Employee Name

                                    </label>

                                    <input type="text" id="employeename" name="employeename" class="form-control" autocomplete="off" value="<?php echo isset($edit) ? $edit->employeename : ''; ?>" />

                                </div>



                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <label for="employee_status"> Employee Status

                                    </label>
                                    <select id="employee_status" name="employee_status" class=" form-control">

                                        <option value="Local">Local</option>
                                        <option value="Expat">Expat</option>
                                    </select>


                                </div>


                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <label for="contract_type"> Contract Type

                                    </label>
                                    <select id="contract_type" name="contract_type" class=" form-control">

                                        <option value="PartTime">PartTime</option>
                                        <option value="FulTime">FulTime</option>
                                    </select>


                                </div>



                                <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                    <label for="department">Department

                                    </label>

                                    <div class="mb-3">
				
				             <select name="department" class="form-control" id='department' value="<?php echo isset($val) ? $val->department_name : ''; ?>">
	                          <option value="">--select one--</option>
		
	                          <?php
			  
	                              foreach($department as $val){
					  
					             ?>
					  
					           <?php 
			 
				            echo "<option value='".$val->id."'>".$val->department_name."</option>";
							
				  
			                   ?>
			  
				             <?php } ?>
                               </select>
	                 
                               </div>

                                </div>


                                <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                    <label for="designation">Designation

                                    </label>

                                    <div class="mb-3">
				
				             <select name="designation" class="form-control" id='designation' value="<?php echo isset($val) ? $val->designation_name : ''; ?>">
	                          <option value="">--select one--</option>
		
	                          <?php
			  
	                              foreach($designation as $val){
					  
					             ?>
					  
					           <?php 
			 
				            echo "<option value='".$val->id."'>".$val->designation_name."</option>";
							
				  
			                   ?>
			  
				             <?php } ?>
                               </select>
	                 
                               </div>

                                </div>



                                <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                    <label for="mobile"> Mobile
                                        <span class="required">*</span>
                                    </label>

                                    <input type="text" id="mobile" name="mobile" class="form-control" required="" autocomplete="off" value="<?php echo isset($edit) ? $edit->mobile : ''; ?>" />

                                </div>


                                <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                    <label for="emergency_numer"> Emergency Number

                                    </label>

                                    <input type="text" id="emergency_numer" name="emergency_numer" class="form-control" autocomplete="off" value="<?php echo isset($edit) ? $edit->emergency_numer : ''; ?>" />

                                </div>


                                <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                    <label for="date"> DOB

                                    </label>

                                    <input type="date" id="birthdate" name="birthdate" class="form-control" autocomplete="off" value="<?php echo isset($edit) ? $edit->birthdate : ''; ?>" />

                                </div>


                                <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                    <label for="spousename"> Spouse Name

                                    </label>

                                    <input type="text" id="spousename" name="spousename" class="form-control" autocomplete="off" value="<?php echo isset($edit) ? $edit->spousename : ''; ?>" />

                                </div>



                                <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                    <label for="employedDate"> Employed Date

                                    </label>

                                    <input type="date" id="employedDate" name="employedDate" class="form-control" autocomplete="off" value="<?php echo isset($edit) ? $edit->employedDate : ''; ?>">

                                </div>



                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <div class="form-group">
                                        <label for="address" class="control-label ">Address</label>

                                        <textarea id="address" name="address" class=" form-control"><?php echo isset($edit) ? $edit->address : ''; ?></textarea>

                                    </div>
                                </div>



                                <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                    <label class="control-label col-md-4 col-sm-4 col-xs-4" for="currency">Gender Type
                                    </label>
                                    </br>

                                    <input type="radio" id="male" name="gender" value="M
										" required="" style="margin-top:8px;margin-left:20px"> Male
                                    <input type="radio" id="female" name="gender" value="F" required="" style="margin-top:8px;margin-left:20px"> Female

                                </div>




                                <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                    <label for="image"> Employee Image
                                        
                                    </label></br>

                                    <input type="file" id="picture" class="form-control " name="image" autocomplete="off" accept="image/*" <?php if (empty($edit)) {
                                                                                                                            echo 'required';
                                                                                                                        } ?>>
                                    </br>
                                    <p id="error1" style="display:none; color:#FF0000;">
                                        Invalid Image Format ! Image Format Must Be JPG, JPEG, PNG or GIF.
                                    </p>
                                    <p id="error2" style="display:none; color:#FF0000;">
                                        Maximum File Size Limit is 1MB.
                                    </p>
                                    <p><a href="">Remove</a></p>
                                </div>



                                <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                    <label for="file_name"> Certificates

                                    </label></br>

                                    <input type="file" id="picture3" class="form-control" name="file_name[]" multiple autocomplete="off" <?php if (empty($edit)) {
                                                                                                                        echo 'required';
                                                                                                                    } ?>>
                                    </br>
                                    <p id="error7" style="display:none; color:#FF0000;">
                                        Invalid Image Format ! Image Format Must Be JPG, JPEG, PNG, pdf or GIF.
                                    </p>
                                    <p id="error8" style="display:none; color:#FF0000;">
                                        Maximum File Size Limit is 1MB.
                                    </p>
                                    </br>
                                </div>
                                <div class="row">
                                </div>

                                <div class="col-md-12" style="    display: flex;
    justify-content: space-between;">



                                    <?php
                                    if (!empty($image)) {
                                        foreach ($image as $val) {

                                    ?>

                                            <div>
                                                <div>
                                                    <?php
                                                    if (strpos($val->file_name, '.pdf')) {
                                                    ?>
                                                        <div id="imagediv_<?php echo $val->image_id; ?>">
                                                            <img class="animation__shake" src="<?php echo base_url(pdf()); ?>" alt="AdminLTELogo" height="128" width="128"></br>
                                                            <a href="<?php echo base_url() . 'site/uploads/images/' . $val->file_name; ?>" download> Download </a>


                                                            <p><?php echo $val->original_filename; ?></p>
                                                            <center>
                                                                <a style="cursor: pointer;" class="remove_image" data-id="<?php echo $val->image_id; ?>">Remove</a>
                                                            </center>
                                                        </div>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <div id="imagediv_<?php echo $val->image_id; ?>">
                                                            <img src="<?php echo base_url() . 'site/uploads/images/' . $val->file_name; ?>" height="128" width="128"></br>
                                                            <center>
                                                                <a style="cursor: pointer;" class="remove_image" data-id="<?php echo $val->image_id; ?>">Remove</a>
                                                            </center>
                                                        </div>
                                                    <?php
                                                    }
                                                    ?>

                                                </div>

                                                <div class="text-center">

                                                </div>

                                            </div>


                                    <?php }
                                    }
                                    ?>
                                </div>



                                </br>

                            </div>
                            <input type="hidden" name="deleted_images" id="deleted_images">

                        </div>


                    </div>
                </div>
				<div style="margin-bottom:20px">
				 <a class="btn btn-primary btnNext">Next</a>
            </div>
			</div>






            <div class="tab-pane container " id="tabs-2">
                <div class="page-title">
                    <div class="title_left">
                       
                    </div>

                </div>
                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">

                            <div class="x_content">
                                <br>


                                <div class="row">
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <label for="passport_name">Name in Passport
                                            <span class="required">*</span>
                                        </label>

                                        <input type="text" id="passport_name" name="passport_name" required="required" class="form-control" autocomplete="off" value="<?php echo isset($edit) ? $edit->passport_name : ''; ?>">

                                    </div>

                                    <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                        <label for="passport_number">Passport Number
                                            <span class="required">*</span>
                                        </label>

                                        <input type="text" id="passport_number" name="passport_number" class="form-control" required="" autocomplete="off" value="<?php echo isset($edit) ? $edit->passport_number : ''; ?>">

                                    </div>



                                    <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                        <label for="passport_issue_date">Date of Issue
                                            <span class="required">*</span>
                                        </label>

                                        <input type="text" id="passport_issue_date" name="passport_issue_date" class="form-control datepicker" required="" autocomplete="off" value="<?php echo isset($edit) ? $edit->passport_issue_date : ''; ?>">

                                    </div>


                                    <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                        <label for="passport_issue_place">Place of Issue
                                            <span class="required">*</span>
                                        </label>

                                        <input type="text" id="passport_issue_place" name="passport_issue_place" class="form-control" required="" autocomplete="off" value="<?php echo isset($edit) ? $edit->passport_issue_place : ''; ?>">

                                    </div>



                                    <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                        <label for="passport_expiry_date">Date of Expiry
                                            <span class="required">*</span>
                                        </label>

                                        <input type="text" id="passport_expiry_date" name="passport_expiry_date" class="form-control datepicker" required="" autocomplete="off" value="<?php echo isset($edit) ? $edit->passport_expiry_date : ''; ?>">

                                    </div>


                                    <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                        <label for="passport_file"> Passport Document
                                           
                                        </label>

                                        <input type="file" id="picture1" class="form-control " name="passport_file" <?php if (empty($edit)) {
                                                                                                    echo 'required';
                                                                                                } ?> autocomplete="off" accept="image/*">
                                        <p id="error3" style="display:none; color:#FF0000;">
                                            Invalid Image Format! Image Format Must Be JPG, JPEG, PNG or GIF.
                                        </p>
                                        <p id="error4" style="display:none; color:#FF0000;">
                                            Maximum File Size Limit is 1MB.
                                        </p>
                                        <p><a href="">Remove</a></p>
                                    </div>
									
						

                                </div>

                            </div>


                        </div>
                    </div>
                </div>
				<div style="margin-bottom:20px">
					<a class="btn btn-primary btnPrevious">Back</a>
					<a class="btn btn-primary btnNext">Next</a>
					</div>
            </div>
            <div class="tab-pane container" id="tabs-3" style="padding: 30px">
                <div class="page-title">
                    <div class="title_left">
                       
                    </div>

                </div>
                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">

                            <div class="x_content">
                                <br>


                                <div class="row">


                                    <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                        <label for="rp_number"> RP Number
                                            <span class="required">*</span>
                                        </label>

                                        <input type="text" id="rp_number" name="rp_number" class="form-control" required="" autocomplete="off" value="<?php echo isset($edit) ? $edit->rp_number : ''; ?>">

                                    </div>




                                    <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                        <label for="rp_issue_date">Date of Issue
                                            <span class="required">*</span>
                                        </label>

                                        <input type="text" id="rp_issue_date" name="rp_issue_date" class="form-control datepicker" required="" autocomplete="off" value="<?php echo isset($edit) ? $edit->rp_issue_date : ''; ?>">

                                    </div>



                                    <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                        <label for="rp_expiry_date">Date of Expiry
                                            <span class="required">*</span>
                                        </label>

                                        <input type="text" id="rp_expiry_date" name="rp_expiry_date" class="form-control datepicker" required="" autocomplete="off" value="<?php echo isset($edit) ? $edit->rp_expiry_date : ''; ?>">

                                    </div>


                                    <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                        <label for="rp_file"> RP Document
                                            
                                        </label>

                                        <input type="file" id="picture2" name="rp_file" class="form-control " <?php if (empty($edit)) {
                                                                                                                    echo 'required';
                                                                                                                } ?> autocomplete="off" accept="image/*">
                                        <p id="error5" style="display:none; color:#FF0000;">
                                            Invalid Image Format! Image Format Must Be JPG, JPEG, PNG or GIF.
                                        </p>
                                        <p id="error6" style="display:none; color:#FF0000;">
                                            Maximum File Size Limit is 1MB.
                                        </p>
                                        <p><a href="">Remove</a></p>
                                    </div>





                                    </br>
                                    <div class="col-md-12">

                                    </div>
                                </div>

                            </div>


                        </div>
                    </div>
                </div>
				<div style="margin-bottom:20px">
				<a class="btn btn-primary btnPrevious">Back</a>
					<a class="btn btn-primary btnNext">Next</a>
					</div>

            </div>

            <div class="tab-pane container " id="tabs-4">

                <div class="page-title">
                    <div class="title_left">
                       
                    </div>

                </div>
                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">

                            <div class="x_content">
                                <br>


                                <div class="row">
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <label for="crp_name">Name as per ID
                                            <span class="required">*</span>
                                        </label>

                                        <input type="text" id="crp_name" name="crp_name" required="required" class="form-control" autocomplete="off" value="<?php echo isset($edit) ? $edit->crp_name : ''; ?>">

                                    </div>

                                    <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                        <label for="crp_number"> CRP Number
                                            <span class="required">*</span>
                                        </label>

                                        <input type="text" id="crp_number" name="crp_number" class="form-control" required="" autocomplete="off" value="<?php echo isset($edit) ? $edit->crp_number : ''; ?>">

                                    </div>


                                    <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                        <label for="crp_issue_date">Date of Issue
                                            <span class="required">*</span>
                                        </label>

                                        <input type="text" id="crp_issue_date" name="crp_issue_date" class="form-control datepicker" required="" autocomplete="off" value="<?php echo isset($edit) ? $edit->crp_issue_date : ''; ?>">

                                    </div>



                                    <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                        <label for="crp_expiry_date">Date of Expiry
                                            <span class="required">*</span>
                                        </label>

                                        <input type="text" id="crp_expiry_date" name="crp_expiry_date" class="form-control datepicker" required="" autocomplete="off" value="<?php echo isset($edit) ? $edit->crp_expiry_date : ''; ?>">

                                    </div>



                                    </br>

                                </div>
                            </div>


                        </div>
                    </div>
                </div>
				<div style="margin-bottom:20px">
				<a class="btn btn-primary btnPrevious">Back</a>
					<a class="btn btn-primary btnNext">Next</a>
					</div>

            </div>
            <div class="tab-pane container " id="tabs-5">
                <div class="page-title">
                    <div class="title_left">
                        
                    </div>

                </div>
                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">

                            <div class="x_content">
                                <br>


                                <div class="row">
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <label for="bank_account_name">Account Name
                                            <span class="required">*</span>
                                        </label>

                                        <input type="text" id="bank_account_name" name="bank_account_name" required="required" class="form-control" autocomplete="off" value="<?php echo isset($edit) ? $edit->bank_account_name : ''; ?>">

                                    </div>

                                    <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                        <label for="bank_iban"> IBAN Number
                                            <span class="required">*</span>
                                        </label>

                                        <input type="text" id="bank_iban" name="bank_iban" class="form-control" required="" autocomplete="off" value="<?php echo isset($edit) ? $edit->bank_iban : ''; ?>">

                                    </div>


                                    <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                        <label for="bank_swift_code"> SWIFT CODE
                                            <span class="required">*</span>
                                        </label>

                                        <input type="text" id="bank_swift_code" name="bank_swift_code" class="form-control" required="" autocomplete="off" value="<?php echo isset($edit) ? $edit->bank_swift_code : ''; ?>">

                                    </div>




                                </div>

                            </div>


                            </br>


                        </div>
                    </div>
                </div>
				<div style="margin-bottom:20px">
				<a class="btn btn-primary btnPrevious">Back</a>
					<a class="btn btn-primary btnNext">Next</a>
					</div>

            </div>
            <div class="tab-pane container " id="tabs-6">
                <div class="page-title">
                    <div class="title_left">
                       
                    </div>

                </div>
                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">

                            <div class="x_content">
                                <br>


                                <div class="row">
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <label for="basic_salary"> Basic salary
                                            <span class="required">*</span>
                                        </label>

                                        <input type="text" id="basic_salary" name="basic_salary" required="required" class="form-control" autocomplete="off" value="<?php echo isset($edit) ? $edit->basic_salary : ''; ?>">

                                    </div>

                                    <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                        <label for="other_allowance">Other Allowance
                                            <span class="required">*</span>
                                        </label>

                                        <input type="text" id="other_allowance" name="other_allowance" class="form-control" required="" autocomplete="off" value="<?php echo isset($edit) ? $edit->other_allowance : ''; ?>">

                                    </div>


                                    <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                        <label for="sio"> SIO
                                            <span class="required">*</span>
                                        </label>

                                        <input type="text" id="sio" name="sio" class="form-control" required="" autocomplete="off" value="<?php echo isset($edit) ? $edit->sio : ''; ?>">

                                    </div>


                                    <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                        <label for="lmra_fee"> IMRA fee
                                            <span class="required">*</span>
                                        </label>

                                        <input type="text" id="lmra_fee" name="lmra_fee" class="form-control" required="" autocomplete="off" value="<?php echo isset($edit) ? $edit->lmra_fee : ''; ?>">

                                    </div>




                                </div>

                            </div>


                            </br>


                        </div>
                    </div>
                </div>
				<div style="margin-bottom:20px">
				<a class="btn btn-primary btnPrevious">Back</a>
				</div>
            </div>
			</div>

        </div>
        <div class="form-group col-md-12"> </br>
            <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-4">
                <input type="submit" class="btn btn-success" value="submit">
                <button type="reset" class="btn btn-primary">Cancel</button>
            </div>
        </div>
    </form>
</div>
</div>
</div>
</section>
</div>













<script>
    $(function() {
        $("#tabs").tabs();
    });
</script>

<script>
    $(function() {
        $(".datepicker").datepicker({
            showOtherMonths: true,
            selectOtherMonths: true
        });
    });
</script>


<script>
    const validateEmail = (email) => {
        return email.match(
            /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
        );
    };

    const validate = () => {
        const $result = $('#result');
        const email = $('#email').val();
        $result.text('');

        if (validateEmail(email)) {
            $result.text(email + ' This Email is valid ');
            $result.css('color', 'green');
        } else {
            $result.text(email + ' This Email is not valid ');
            $result.css('color', 'red');
        }
        return false;
    }

    $('#email').on('input', validate);
</script>

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>



<script>
    $(document).ready(function() {

        var a = 0;
        //binds to onchange event of your input field
        $('#picture').bind('change', function() {
            if ($('input:submit').attr('disabled', false)) {
                $('input:submit').attr('disabled', true);
            }
            var ext = $('#picture').val().split('.').pop().toLowerCase();
            if ($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                $('#error1').slideDown("slow");
                $('#error2').slideUp("slow");
                a = 0;
            } else {
                var picsize = (this.files[0].size);
                if (picsize > 1000000) {
                    $('#error2').slideDown("slow");
                    a = 0;
                } else {
                    a = 1;
                    $('#error2').slideUp("slow");
                }
                $('#error1').slideUp("slow");
                if (a == 1) {
                    $('input:submit').attr('disabled', false);
                }
            }

        });



        var a = 0;
        //binds to onchange event of your input field
        $('#picture1').bind('change', function() {
            if ($('input:submit').attr('disabled', false)) {
                $('input:submit').attr('disabled', true);
            }
            var ext = $('#picture1').val().split('.').pop().toLowerCase();
            if ($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                $('#error3').slideDown("slow");
                $('#error4').slideUp("slow");
                a = 0;
            } else {
                var picsize = (this.files[0].size);
                if (picsize > 1000000) {
                    $('#error4').slideDown("slow");
                    a = 0;
                } else {
                    a = 1;
                    $('#error4').slideUp("slow");
                }
                $('#error3').slideUp("slow");
                if (a == 1) {
                    $('input:submit').attr('disabled', false);
                }
            }

        });



        var a = 0;
        //binds to onchange event of your input field
        $('#picture2').bind('change', function() {
            if ($('input:submit').attr('disabled', false)) {
                $('input:submit').attr('disabled', true);
            }
            var ext = $('#picture2').val().split('.').pop().toLowerCase();
            if ($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                $('#error5').slideDown("slow");
                $('#error6').slideUp("slow");
                a = 0;
            } else {
                var picsize = (this.files[0].size);
                if (picsize > 1000000) {
                    $('#error6').slideDown("slow");
                    a = 0;
                } else {
                    a = 1;
                    $('#error6').slideUp("slow");
                }
                $('#error5').slideUp("slow");
                if (a == 1) {
                    $('input:submit').attr('disabled', false);
                }
                return false;
            }

        });




        var a = 0;
        //binds to onchange event of your input field
        $('#picture3').bind('change', function() {
            if ($('input:submit').attr('disabled', false)) {
                $('input:submit').attr('disabled', true);
            }
            var ext = $('#picture3').val().split('.').pop().toLowerCase();
            if ($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg', 'pdf']) == -1) {
                $('#error7').slideDown("slow");
                $('#error8').slideUp("slow");
                a = 0;
            } else {
                var picsize = (this.files[0].size);
                if (picsize > 1000000) {
                    $('#error8').slideDown("slow");
                    a = 0;
                } else {
                    a = 1;
                    $('#error8').slideUp("slow");
                }
                $('#error7').slideUp("slow");
                if (a == 1) {
                    $('input:submit').attr('disabled', false);
                }
            }

        });
    });
</script>


<!-- image upload -->
<script src="<?= base_url() ?>assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script type="text/javascript">
    $(document).on("click", ".remove_image", function() {
        var image_id = $(this).attr("data-id");



        if (confirm("Do you want to delete the image?")) {
            $.ajax({
                url: "<?= base_url() . 'hr/delete_image' ?>",
                type: "POST",
                data: {
                    keys: image_id
                },
                success: function(data) {
                    window.location.reload();
                }
            });
        }
    });

    // image upload end
</script>









<script>
 $('.btnNext').click(function() {
  const nextTabLinkEl = $('.nav-tabs .active').closest('li').next('li').find('a')[0];
  const nextTab = new bootstrap.Tab(nextTabLinkEl);
  nextTab.show();
});

$('.btnPrevious').click(function() {
  const prevTabLinkEl = $('.nav-tabs .active').closest('li').prev('li').find('a')[0];
  const prevTab = new bootstrap.Tab(prevTabLinkEl);
  prevTab.show();
});
</script>
</body>
</html>