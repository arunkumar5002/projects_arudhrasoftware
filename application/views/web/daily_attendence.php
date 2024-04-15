  
  <div class="content-wrapper">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  <div class="x_panel">
                                
                                <div class="x_content">
                                    <br>
                                    <form id="att_submit" data-parsley-validate="" enctype="multipart/form-data" class="form-horizontal form-label-left" method="post" action="http://188.166.230.38/projects/accounts/hr/save_month_attendance">
                                  
                                   <input type="hidden" name="companyid" id="companyid">                                   
										
										<div class="form-group  col-md-6 col-sm-6 col-xs-6">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-4" for="companyname">Attendance Daily <span class="required">*</span>
                                            </label>
                                            <div class="col-md-8 col-sm-8 col-xs-8">
                                                <input type="text" value="" id="datepicker" name="attendance_month" class="form-control " required="" autocomplete="off">
                                            </div>
                                        </div>
										<div class="clear"></div>
										
										                                       
										
                                        
										
										
										<div class="form-group">											
                                            <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-4">
                                                <button type="submit" class="btn btn-success">Submit</button>
												<a href="" class="btn btn-primary">Cancel</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
								   </div>
                                        </div>
										
													 <script>
  $( function() {
    $( "#datepicker" ).datepicker({
      showOtherMonths: true,
      selectOtherMonths: true
    });
  } );
  </script>
  
  
  
  
  