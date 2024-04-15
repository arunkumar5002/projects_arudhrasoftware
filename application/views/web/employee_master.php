<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  
  
  
  <div id="tabs" style="padding: 30px">
  <ul>
    <li><a href="#tabs-1">Employee Details</a></li>
    <li><a href="#tabs-2">Passport Details</a></li>
    <li><a href="#tabs-3">Identification Card Details</a></li>
	<li><a href="#tabs-4">Bank Details</a></li>
  </ul>
  <div id="tabs-1">
    <div class="page-title">
                        <div class="title_left">
                            <h3> Employee Master </h3>
                        </div>
                        
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">

                    <div class="x_content">
                        <br>
                        <form  enctype="multipart/form-data"
                             method="post"
                            action="<?php echo base_url();?>Company/">
                            <input type="hidden" name="employeid" id="employeid">
							<div class="row">
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <label  for="employeename">Employee Name
                                    <span class="required">*</span>
                                </label>
                                
                                    <input type="text" id="employeename" name="employeename" required="required" class="form-control"
                                        autocomplete="off">
                             
                            </div>

                            <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                <label for="employeeid">Employee Id
                                   <span class="required">*</span>
                                </label>
                                
                                    <input type="text" id="employeeid" name="employeeid" class="form-control"
                                         required="" autocomplete="off">
                                
                            </div>

 
                             <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                <label for="department">Department 
                                   <span class="required">*</span>
                                </label>
                                
                                    <input type="text" id="department" name="department" class="form-control"
                                         required="" autocomplete="off">
                                
                            </div>


                             <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                <label for="designation">Designation 
                                   <span class="required">*</span>
                                </label>
                                
                                    <input type="text" id="designation" name="designation" class="form-control"
                                         required="" autocomplete="off">
                                
                            </div>
							
							
							
							<div class="form-group col-md-6 col-sm-6 col-xs-6">
                                <label for="date">Date of Joining  
                                   <span class="required">*</span>
                                </label>
                                
                                    <input type="date" id="date" name="date" class="form-control"
                                         required="" autocomplete="off">
                                
                            </div>
							
							
							
							<div class="form-group col-md-6 col-sm-6 col-xs-6">
                                <label for="resignation">Date Of Resignation 
                                   <span class="required">*</span>
                                </label>
                                
                                    <input type="text" id="resignation" name="resignation" class="form-control"
                                         required="" autocomplete="off">
                                
                            </div>
							
							
							
							<div class="form-group col-md-6 col-sm-6 col-xs-6">
                                <label for="function">Function 
                                   <span class="required">*</span>
                                </label>
                                
                                    <input type="text" id="function" name="function" class="form-control"
                                         required="" autocomplete="off">
                                
                            </div>
							
							
							<div class="form-group col-md-6 col-sm-6 col-xs-6">
                                <label for="leave">Paid Leave  
                                   <span class="required">*</span>
                                </label>
                                
                                    <input type="text" id="leave" name="leave" class="form-control"
                                         required="" autocomplete="off">
                                
                            </div>


                            <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                <label for="location">Location 
                                   <span class="required">*</span>
                                </label>
                                
                                    <input type="text" id="location" name="location" class="form-control"
                                         required="" autocomplete="off">
                                
                            </div>


                             <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                <label class="control-label col-md-4 col-sm-4 col-xs-4" for="currency">Gender<span class="required">*</span>
                                </label>
								</br>
                                
                                    <input type="radio" class="gender" id="gender" name="gender" value="M" required=""
                                        style="margin-top:8px;margin-left:20px"> Male
                                    <input type="radio" class="gender" id="gender" name="gender" value="F" required="" class="form-control"
                                        style="margin-top:8px;margin-left:20px"> Female
                                </div>

                             
							 <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                <label for="blood_group">Blood Group 
                                   <span class="required">*</span>
                                </label>
                                
                                    <input type="text" id="blood_group" name="blood_group" class="form-control"
                                         required="" autocomplete="off">
                                
                            </div>
							
							
							<div class="form-group col-md-6 col-sm-6 col-xs-6">
                                <label for="father_name">Father/Mother Name 
                                   <span class="required">*</span>
                                </label>
                                
                                    <input type="text" id="father_name" name="father_name" class="form-control"
                                         required="" autocomplete="off">
                                
                            </div>
							
							
							<div class="form-group col-md-6 col-sm-6 col-xs-6">
                                <label for="spouse_name">Spouse Name 
                                   <span class="required">*</span>
                                </label>
                                
                                    <input type="text" id="spouse_name" name="spouse_name" class="form-control"
                                         required="" autocomplete="off">
                                
                            </div>
							
							
							<div class="form-group col-md-6 col-sm-6 col-xs-6">
                                <label for="number">Contact Number 
                                   <span class="required">*</span>
                                </label>
                                
                                    <input type="text" id="number" name="number" class="form-control"
                                         required="" autocomplete="off">
                                
                            </div>
							 
							 
							 
                            <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class="form-group">
                                <label for="address" class="control-label ">Address <span
                                        class="required">*</span></label>
                                
                                    <textarea required="" id="address" name="address"
                                        class=" form-control" ></textarea>
                                
                            </div>
							</div>
							 
							 
							 <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                <label  for="email">Email <span
                                        class="required"></span>
                                </label>
                                
                                    <input type="text" pattern="[a-zA-Z0-9._\-]+@[a-zA-Z0-9.\-]+\.[a-zA-Z]{2,4}"
                                        id="email" name="email" title="Please Enter Your Correct Email Address"
                                        class="form-control " autocomplete="off">
                               
                            </div>
							 

                            <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                <label  for="dob">Date of
                                    Birth<span class="required">*</span>
                                </label>
                                
                                    <input type="date" id="dob" name="dob" class=" form-control" required="" >
                                
                            </div>

                          

                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <label  for="currency">Identification Type  <span
                                        class="required">*</span>
                                </label>
                               
                                    <select id="identification" name="identification" class=" form-control"
                                        required="">
                                        <option value="">--Select --</option>
                                        <option value="S">Singapore Citizen</option>
										<option value="S">Singapore Permanent  Residents</option>
                                        <option value="$">Employeement Pass</option>
                                        <option value=""> S Pass</option>
										<option value="$"> Work Permit Holder</option>
                                        <option value=""> Dependent Pass</option>
										<option value=""> Others</option>
                                    </select>
                                </div>
                            

                            
							     <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                <label class="control-label col-md-4 col-sm-4 col-xs-4" for="currency">Mode Of Payment<span class="required">*</span>
                                </label>
								</br>
                                
                                    <input type="radio" class="payment" id="payment" name="payment" value="Cash" required=""
                                        style="margin-top:8px;margin-left:20px"> Cash
                                    <input type="radio" class="payment" id="payment" name="payment" value="Bank" required="" class="form-control"
                                        style="margin-top:8px;margin-left:20px"> Bank
									<input type="radio" class="payment" id="payment" name="payment" value="Cheque" required="" class="form-control"
                                        style="margin-top:8px;margin-left:20px">  Cheque
                                </div>

							
							   <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                <label class="control-label col-md-4 col-sm-4 col-xs-4" for="currency">Salary Type <span class="required">*</span>
                                </label>
								</br>
                                
                                    <input type="radio" class="salary" id="salary" name="salary" value="Fixed" required=""
                                        style="margin-top:8px;margin-left:20px"> Fixed
                                    <input type="radio" class="salary" id="salary" name="salary" value="Variable" required="" class="form-control"
                                        style="margin-top:8px;margin-left:20px"> Variable
									
                                </div>
							
							
							
							    <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                <label  for="basic_salary">Basic Salary Per Month<span class="required">*</span>
                                </label>
                                
                                    <input type="text" id="basic_salary" name="basic_salary" class=" form-control" required="" >
                                
                                </div>

							
							  <div class="col-md-6 col-sm-6 col-xs-6">
                                <label  for="currency">Nationality Type  <span
                                        class="required">*</span>
                                </label>
                               
                                    <select id="nationality" name="nationality" class=" form-control"
                                        required="">
                                        <option value="">--Select nationality--</option>
                                        <option value="S">Singaporean</option>
										<option value="S">Singapore PR</option>
                                        <option value="$">Chinese </option>
                                        <option value=""> Indian</option>
										<option value="$"> Malaysian</option>
                                       
                                    </select>
                                </div> 
				
                               </br>
                            <div class="form-group">  </br>
                                <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-4">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <button type="reset" class="btn btn-primary">Cancel</button>
                                </div>
                            </div>
							</div>
                        </form>
                    </div>


                </div>
            </div>
        </div>
  </div>
  <div id="tabs-2">
    <div class="page-title">
                        <div class="title_left">
                            <h3>Passport Details </h3>
                        </div>
                        
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">

                    <div class="x_content">
                        <br>
                        <form  enctype="multipart/form-data"
                             method="post"
                            action="<?php echo base_url();?>Company/">
                            <input type="hidden" name="employeeid" id="employeeid">
							<div class="row">
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <label  for="passport_name">Name in Passport
                                    <span class="required">*</span>
                                </label>
                                
                                    <input type="text" id="passport_name" name="passport_name" required="required" class="form-control"
                                        autocomplete="off">
                             
                            </div>

                            <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                <label for="passportnumber">Passport Number
                                   <span class="required">*</span>
                                </label>
                                
                                    <input type="text" id="passportnumber" name="passportnumber" class="form-control"
                                         required="" autocomplete="off">
                                
                            </div>

 
                             <div class="form-group col-md-4 col-sm-6 col-xs-6">
                                <label for="date_issue">Date of Issue 
                                   <span class="required">*</span>
                                </label>
                                
                                    <input type="text" id="date_issue" name="date_issue" class="form-control"
                                         required="" autocomplete="off">
                                
                            </div>


                            <div class="form-group col-md-4 col-sm-6 col-xs-6">
                                <label for="place_issue">Place of Issue
                                   <span class="required">*</span>
                                </label>
                                
                                    <input type="text" id="place_issue" name="place_issue" class="form-control"
                                         required="" autocomplete="off">
                                
                            </div>
							
							

                             <div class="form-group col-md-4 col-sm-6 col-xs-6">
                                <label for="date_expiry">Date of Expiry 
                                   <span class="required">*</span>
                                </label>
                                
                                    <input type="text" id="date_expiry" name="date_expiry" class="form-control"
                                         required="" autocomplete="off">
                                
                            </div>
							
							
							
							
				
                               </br>
                            <div class="form-group">  </br>
                                <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-4">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <button type="reset" class="btn btn-primary">Cancel</button>
                                </div>
                            </div>
							</div>
                        </form>
                    </div>


                </div>
            </div>
        </div>
  </div>
  <div id="tabs-3">
    
	 <div class="page-title">
                        <div class="title_left">
                            <h3>Identification Details </h3>
                        </div>
                        
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">

                    <div class="x_content">
                        <br>
                        <form  enctype="multipart/form-data"
                             method="post"
                            action="<?php echo base_url();?>Company/">
                            <input type="hidden" name="employeeid" id="employeeid">
							<div class="row">
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <label  for="name_id">Name as per ID
                                    <span class="required">*</span>
                                </label>
                                
                                    <input type="text" id="name_id" name="name_id" required="required" class="form-control"
                                        autocomplete="off">
                             
                            </div>

                            <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                <label for="identification_number">Identification Number
                                   <span class="required">*</span>
                                </label>
                                
                                    <input type="text" id="identification_number" name="identification_number" class="form-control"
                                         required="" autocomplete="off">
                                
                            </div>

 
                             <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                <label for="date_issue">Date of Issue 
                                   <span class="required">*</span>
                                </label>
                                
                                    <input type="text" id="date_issue" name="date_issue" class="form-control"
                                         required="" autocomplete="off">
                                
                            </div>
							
							

                             <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                <label for="date_expiry">Date of Expiry 
                                   <span class="required">*</span>
                                </label>
                                
                                    <input type="text" id="date_expiry" name="date_expiry" class="form-control"
                                         required="" autocomplete="off">
                                
                            </div>
							
							
										
                               </br>
                            <div class="form-group">  </br>
                                <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-4">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <button type="reset" class="btn btn-primary">Cancel</button>
                                </div>
                            </div>
							</div>
                        </form>
                    </div>


                </div>
            </div>
        </div>
  </div>
  <div id="tabs-4">
  
   <div class="page-title">
                        <div class="title_left">
                            <h3>Bank Details </h3>
                        </div>
                        
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">

                    <div class="x_content">
                        <br>
                        <form  enctype="multipart/form-data"
                             method="post"
                            action="<?php echo base_url();?>Company/">
                            <input type="hidden" name="bankid" id="bankid">
							<div class="row">
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <label  for="account_name">Account Name
                                    <span class="required">*</span>
                                </label>
                                
                                    <input type="text" id="account_name" name="account_name" required="required" class="form-control"
                                        autocomplete="off">
                             
                            </div>

                            <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                <label for="account_number">Account Number
                                   <span class="required">*</span>
                                </label>
                                
                                    <input type="text" id="account_number" name="account_number" class="form-control"
                                         required="" autocomplete="off">
                                
                            </div>

 
                             <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                <label for="bank_name">Bank Name
                                   <span class="required">*</span>
                                </label>
                                
                                    <input type="text" id="bank_name" name="bank_name" class="form-control"
                                         required="" autocomplete="off">
                                
                            </div>
						
							
							<div class="form-group col-md-6 col-sm-6 col-xs-6">
                                <label for="branch_name">Branch Name	
                                   <span class="required">*</span>
                                </label>
                                
                                    <input type="text" id="branch_name" name="branch_name" class="form-control"
                                         required="" autocomplete="off">
                                
                            </div>
														
							

                             <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                <label for="account_type">Account Type
                                   <span class="required">*</span>
                                </label>
                                
                                    <input type="text" id="account_type" name="account_type" class="form-control"
                                         required="" autocomplete="off">
                                
                            </div>
							
							
										
                               </br>
                            <div class="form-group col-md-12"> </br>
                                <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-4">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <button type="reset" class="btn btn-primary">Cancel</button>
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
  </div>
	
	
	
	
	
	
 
  
  
  <script>
  $( function() {
    $( "#tabs" ).tabs();
  } );
  </script>