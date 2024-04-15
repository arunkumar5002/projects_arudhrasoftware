  
  <div class="content-wrapper">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/base/jquery-ui.css">


 <style>
    .ui-datepicker-calendar {
        display: none;
    }
    </style>


<div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>Month Attendance</h3>
                        </div>
                        
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                
                                <div class="x_content">
                                    <br>
                                    <form id="att_submit" data-parsley-validate="" enctype="multipart/form-data" class="form-horizontal form-label-left" method="post" action="http://188.166.230.38/projects/accounts/hr/save_month_attendance">
                                  
                                   <input type="hidden" name="companyid" id="companyid">                                   
										
										<div class="form-group  col-md-6 col-sm-6 col-xs-6">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-4" for="companyname">Attendance Month <span class="required">*</span>
                                            </label>
                                            <div class="col-md-8 col-sm-8 col-xs-8">
   
    <input name="startDate" id="startDate" class="form-control  date-picker" />
                                            </div>
                                 </div>
										<div class="clear"></div>
										
										                                       
										
                                        
										
										
										<div class="form-group">											
                                            <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-4">
                                                <button type="submit" class="btn btn-success">Submit</button>
												<a href="http://188.166.230.38/projects/accounts/hr/attendance" class="btn btn-primary">Cancel</a>
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
					 
 <script type="text/javascript">
       $(function() {
          $('.date-picker').datepicker( {
           changeMonth: true,
           changeYear: true,
            showButtonPanel: true,
            dateFormat: 'MM yy',
            onClose: function(dateText, inst) { 
                $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
            }
            });
        });
    </script>
    
  
  
  
  
      
   
