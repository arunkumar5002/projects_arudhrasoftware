<div class="content-wrapper">
  <div class="right_col"   style=" padding: 20px;" 
 role="main">
                <div class="" style="background-color: white;
    padding: 14px;">

                    <div class="page-title">
                        <div class="title_left">
                            <h3>Company Master</h3>
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
                            action="<?php echo base_url();?>Company/savecompanymaster">
                            <input type="hidden" name="companyid" id="companyid">
							<div class="row">
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <label  for="companyname">Company Name
                                    <span class="required">*</span>
                                </label>
                                
                                    <input type="text" id="companyname" name="companyname" required="required" class="form-control"
                                        autocomplete="off">
                             
                            </div>

                            <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                <label for="currency">Registration
                                    Number <span class="required">*</span>
                                </label>
                                
                                    <input type="text" id="registration" name="registration" class="form-control"
                                         required="" autocomplete="off">
                                
                            </div>


                            <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                <label  for="currency">Date of
                                    Incorporation<span class="required">*</span>
                                </label>
                                
                                    <input type="text" id="incorporationdate" name="incorporationdate" class=" form-control" required="" >
                                
                            </div>

                            
      

                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <label  for="currency">Currency <span
                                        class="required">*</span>
                                </label>
                               
                                    <select id="currencyused" name="currency" class=" form-control"
                                        required="">
                                        <option value="">--Select Currency--</option>
                                        <option value="S$">Singapore Dollar</option>
                                        <option value="$">US Dollar</option>
                                        <option value="INR">Indian Rupee</option>
                                    </select>
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

                            <div class="form-group col-md-6" >
                                <label for="contact" >Contact <span
                                        class="required"></span></label>
                               
                                    <input id="contact" onkeypress="return isNumberKey(event)" name="contact"
                                        class="form-control" type="text" autocomplete="off">
                               
                            </div>


                            <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                <label  for="fax">Landline <span
                                        class="required"></span>
                                </label>
                                
                                    <input type="text" id="fax" name="fax" onkeypress="return isNumberKey(event)"
                                        class="form-control " autocomplete="off">
                                
                            </div>

                            
							<div class="form-group col-md-6 col-sm-6 col-xs-6">
                                <label class="control-label col-md-4 col-sm-4 col-xs-4" for="currency">GST
                                    Registered<span class="required">*</span>
                                </label>
								</br>
                                
                                    <input type="radio" class="gst" id="gst" name="gst" value="1" required=""
                                        style="margin-top:8px;margin-left:10px">Yes
                                    <input type="radio" class="gst" id="gst" name="gst" value="2" required="" class="form-control"
                                        style="margin-top:8px;margin-left:10px">No
                                </div>




                            <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                <label  for="fax">Company Logo <span
                                        class="required"></span>
                                </label>
                                <div class="col-md-8 col-sm-8 col-xs-8" style="margin-top:8px">

                                    <img id="companylogoview" name="companylogoview" src=""
                                        style="width:100px; height:100px; display:none;">
                                    <a id="companylogoremove" style="display:none;">Remove</a>

                                    <input type="file" id="companylogo" name="companylogo" accept="image/*" style="margin-left: -13px;"
                                        class="col-md-8 col-xs-8">
                                </div>
                            </div>

                            


                 

                            <div class="form-group">
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
   
