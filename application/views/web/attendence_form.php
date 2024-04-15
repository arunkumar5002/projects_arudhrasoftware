<div class="content-wrapper">
  
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/base/jquery-ui.css">


 <style>
    .ui-datepicker-calendar {
        display: none;
    }
    </style>


<div class="content-header">
  <div class="container-fluid">
<!-- /.row -->
  </div><!-- /.container-fluid -->
</div>

    <div class="card card-primary" style="padding:20px;">

      <div class="card-header">
       
          <p class="card-title">
 </p>
          <input type="hidden" name="service_id" value="" >
      

        
        <!-- /.card-tools -->
      </div>
      <!-- /.card-header -->
      <div class="card-body">
<section class="content">
<div class="container-fluid">
<div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="">
                            <h3>
                   Attendance
                   
					
                     <span style="float:right;">
								
								 <!--<a class='btn btn-success ' style='cursor:pointer' href='http://188.166.230.38/projects/accounts/hr/month_attendance'>Month Attendance</a> -->
                                 <a class="btn btn-success " style="cursor:pointer" href="<?php echo base_url()?>UserManagement/month_attendence">Month Attendance</a>
								 <a class="btn btn-success " style="cursor:pointer" href="<?php echo base_url()?>UserManagement/daily_attendence">Daily Attendance</a> 
								
								
								 </span>
                </h3>
                        </div>

                       
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">
						
<div class="col-md-4 col-sm-4 col-xs-4">	
	</div>					

  <div class="col-md-4">
          <div class="form-group">	
	
<input type="text"  id="startDate" name="startDate" class=" form-control date-picker " required="" autocomplete="off">  
		 	
	</div>
	</div>

	 </div>
<div class="col-md-4 col-sm-4 col-xs-4">						
	</div>
 
 
 
                        <div class="col-md-12 col-sm-12 col-xs-12">
							
                            <div class="x_panel">
                             
                                <div class="x_content">
								
								  <div class="clearfix"></div>
								  <style>
								  .leave{color:#fff;background-color:rgb(255, 8, 8); }
								  .present{color:#000;background-color:#fff; }
								  .halfday{color:#fff;background-color:rgb(252, 169, 0); }
								  .ml{color:#fff;background-color:rgb(7, 150, 189); }
								  .pl{color:#fff;background-color:#600808; }
								  .lop{color:#fff;background-color:rgb(189, 7, 123); }
								  .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td{
									  border: 1px solid #ddd !important;
									  padding: 10px 0px 7px 7px; line-height: 0.1; 
									 }
								  </style>
								  
								  
	<div style="padding-bottom:10px;">
<button class="btn btn-secondary buttons-pdf buttons-html5" tabindex="0" aria-controls="example1" type="button"><span>PDF</span></button>
	<button class="btn btn-secondary buttons-excel buttons-html5" tabindex="0" aria-controls="example1" type="button"><span>Excel</span></button>							  
		</div>						  
								   <table id="color_indictaion" class="table table-striped responsive-utilities">
									<tbody><tr>
										<td class="present" style="padding-bottom:10px;" align="center">P-Present</td>
										<td class="leave" style="padding-bottom:10px;" align="center">A-Absent</td>
										<td class="halfday" style="padding-bottom:10px;" align="center">H-Half Day</td>
										<td class="ml" style="padding-bottom:10px;" align="center">M-Medical Leave</td>
										<td class="pl" style="padding-bottom:10px;" align="center">E-Paid Leave</td>
										<td class="lop" style="padding-bottom:10px;" align="center">L-LOP</td>
									</tr>   
								   </tbody></table>
							
                                    <table id="example" class="table table-striped responsive-utilities">
                                        <thead>
                                            <tr class="headings">
                                                <td colspan="2">Date</td>
                                                												<td>1</td>
                                                												<td>2</td>
                                                												<td>3</td>
                                                												<td>4</td>
                                                												<td>5</td>
                                                												<td>6</td>
                                                												<td>7</td>
                                                												<td>8</td>
                                                												<td>9</td>
                                                												<td>10</td>
                                                												<td>11</td>
                                                												<td>12</td>
                                                												<td>13</td>
                                                												<td>14</td>
                                                												<td>15</td>
                                                												<td>16</td>
                                                												<td>17</td>
                                                												<td>18</td>
                                                												<td>19</td>
                                                												<td>20</td>
                                                												<td>21</td>
                                                												<td>22</td>
                                                												<td>23</td>
                                                												<td>24</td>
                                                												<td>25</td>
                                                												<td>26</td>
                                                												<td>27</td>
                                                												<td>28</td>
                                                												<td>29</td>
                                                												<td>30</td>
                                                												<td>31</td>
                                                                                            </tr>
                                            <tr class="headings">
                                                <td colspan="2">Day</td>
                                                												<td>W</td>
                                                												<td>T</td>
                                                												<td>F</td>
                                                												<td>S</td>
                                                												<td>S</td>
                                                												<td>M</td>
                                                												<td>T</td>
                                                												<td>W</td>
                                                												<td>T</td>
                                                												<td>F</td>
                                                												<td>S</td>
                                                												<td>S</td>
                                                												<td>M</td>
                                                												<td>T</td>
                                                												<td>W</td>
                                                												<td>T</td>
                                                												<td>F</td>
                                                												<td>S</td>
                                                												<td>S</td>
                                                												<td>M</td>
                                                												<td>T</td>
                                                												<td>W</td>
                                                												<td>T</td>
                                                												<td>F</td>
                                                												<td>S</td>
                                                												<td>S</td>
                                                												<td>M</td>
                                                												<td>T</td>
                                                												<td>W</td>
                                                												<td>T</td>
                                                												<td>F</td>
                                                                                            </tr>
                                        </thead>

                                        <tbody>
                                                                                  </tbody>

                                    </table>
                                </div>
                            </div>
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
   
   
  
  
  
  
  
  
  
  
  
  
  
  
  

                                
                                
                                
                                
                                
                    
                                
                                
                                	
				 
                                
                                
                            