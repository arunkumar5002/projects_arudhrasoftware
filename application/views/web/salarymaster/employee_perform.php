<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Employee Performance</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><a href="<?php echo base_url() ?>">Employee Perform</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
	<script src="js/addons/rating.js"></script>

    <div class="right_col" style=" padding: 20px;" role="main">
        <div class="" style="background-color: white;
    padding: 14px;">

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
                            <form enctype="multipart/form-data"   method="post" action="">
                            
                                <div class="row">
               
									
									
								
									<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <label for="companyname">Employee Name
                                            <span class="required">*</span>
                                        </label>

                                       <select class="form-control" required="" id="employeename">
                                      <option value="">--Choose--</option>
                                     <?php foreach ($designation1 as $key => $value) {
                                      echo "<option value=".$value->employee_id.">".$value->employeename."</option>";
                                        } ?>
                                   </select>
                                    </div>
									
								

                                 


                                  <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                    <label for="jobtitle">Job Title
                                        <span class="required">*</span>
                                    </label>
                                   <input type="text" class="form-control" id='designation' required="" name="designation_id">

                                </div>
									
									  
                                       <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                    <label for="department">Department
                                           <span class="required">*</span>
                                    </label>

                                    <input type="text"  class="form-control" id='department' required="" name="department_id">
                                </div>
								
									


           <div class="form-group  col-md-6 col-sm-6 col-xs-6">
            <label class="control-label col-md-6 col-sm-4 col-xs-4" for="companyname"> Date of Review <span class="required">*</span>
            </label>
           
              <input type="text"  id="datepicker" name="attendance_month" class="form-control " required="" autocomplete="off">
           
          </div>
                         
	<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <label for="companyname">Review period
                                            <span class="required">*</span>
                                        </label>

                                        <input type="text" id="" name="" required="required" class="form-control" autocomplete="on" value="">
                                       <span id="name_error" style="color:red;"></span>
                                    </div>

	<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <label for="companyname">Line Manager
                                            <span class="required">*</span>
                                        </label>

                                        <input type="text" id="" name="" required="required" class="form-control" autocomplete="on" value="">
                                       <span id="name_error" style="color:red;"></span>
                                    </div>									
									</div>
									</div>


           <div class="row">
                  <div class="col-md-12">
                    <h3 class="text-center">Ratings</h3>
                  </div>
                </div>
				
				 <table id="example1" class="table table-bordered table-striped" style="margin-top:30px">
					
                         <thead>
                           <tr>
                             <th><b> Ratings</b></th>
							 <th>1 = Poor </th>
                             <th>2 = Fair </th>
                             <th> 3 = Satisfactory </th>
                             <th> 4 = Good </th>
							  <th> 5 = Excellent </th>
                           </tr>
						   <tr>
                             <th><b> Job Knowledge</b></th>
							 	 <td><input type="radio" name="job_knowledge_rating" value="1"></td>
                              <td><input type="radio" name="job_knowledge_rating" value="2"></td>
                              <td><input type="radio" name="job_knowledge_rating" value="3"></td>
                            <td><input type="radio" name="job_knowledge_rating" value="4"></td>
						 <td><input type="radio" name="job_knowledge_rating" value="5"></td>
                           </tr>
                         </thead>
						 <tbody>
						 
						 <tr>
							  <td> List Down Work KPI</td>
							  <td colspan="18"><textarea style="width:700px;" id="job_knowledge_comments" name="job_knowledge_comments" class=" form-control">
                                 </textarea> </td>
                 		 
							 </tr>
						 
						 	   <tr>
                             <th><b> Quality of Work</b></th>
							 	 <td><input type="radio" name="quality_rating" value="1"></td>
                              <td><input type="radio" name="quality_rating" value="2"></td>
                              <td><input type="radio" name="quality_rating" value="3"></td>
                            <td><input type="radio" name="quality_rating" value="4"></td>
						 <td><input type="radio" name="quality_rating" value="5"></td>
                           </tr>
                         </thead>
						 <tbody>
						 
						 <tr>
							  <td>Comments</td>
							  <td colspan="18"><textarea style="width:700px;" id="quality_rating_comments" name="quality_rating_comments" class=" form-control"></textarea> </td>
                             
							 
							 </tr>
						 
						 	   <tr>
                             <th><b>Attendance/Punctuality</b></th>
							 <td><input type="radio" name="	attendance_punctuality_rating" value="1"></td>
                              <td><input type="radio" name="	attendance_punctuality_rating" value="2"></td>
                              <td><input type="radio" name="	attendance_punctuality_rating" value="3"></td>
                            <td><input type="radio" name="	attendance_punctuality_rating" value="4"></td>
						 <td><input type="radio" name="	attendance_punctuality_rating" value="5"></td>
                           </tr>
                         </thead>
						 <tbody>
						 
						 <tr>
							  <td>Attach attendance sheet for the Quatre</td>
							  <td colspan="18"><textarea style="width:700px;" id="attendance_punctuality_comments" name="attendance_punctuality_comments" class=" form-control"></textarea> </td>
                             
							 
							 </tr>
							 
							 	   <tr>
                             <th><b> Takes Initiative</b></th>
							 <td><input type="radio" name="takes_initiative_rating" value="1"></td>
                              <td><input type="radio" name="takes_initiative_rating" value="2"></td>
                              <td><input type="radio" name="takes_initiative_rating" value="3"></td>
                            <td><input type="radio" name="takes_initiative_rating" value="4"></td>
						 <td><input type="radio" name="takes_initiative_rating" value="5"></td>
                           </tr>
                         </thead>
						 <tbody>
						 
						 <tr>
							  <td> Comments</td>
							  <td colspan="18"><textarea style="width:700px;" id="takes_initiative_comments" name="takes_initiative_comments" class=" form-control"></textarea> </td>
                             
							 
							 </tr>
							 
							 	   <tr>
                             <th><b>Communication/Listening </b></th>
							  <td><input type="radio" name="communication_listening_rating" value="1"></td>
                              <td><input type="radio" name="communication_listening_rating" value="2"></td>
                              <td><input type="radio" name="communication_listening_rating" value="3"></td>
                            <td><input type="radio" name="communication_listening_rating" value="4"></td>
						 <td><input type="radio" name="communication_listening_rating" value="5"></td>
                           </tr>
                         </thead>
						 <tbody>
						 
						 <tr>
							  <td> Comments</td>
							  <td colspan="18"><textarea style="width:700px;" id="	communication_listening_comments" name="communication_listening_comments" class=" form-control"></textarea> </td>
                             
							 
							 </tr>
							 
							 	   <tr>
                             <th><b> Dependability</b></th>
							 <td><input type="radio" name="dependability_rating" value="1"></td>
                              <td><input type="radio" name="dependability_rating" value="2"></td>
                              <td><input type="radio" name="dependability_rating" value="3"></td>
                            <td><input type="radio" name="dependability_rating" value="4"></td>
						 <td><input type="radio" name="dependability_rating" value="5"></td>
                           </tr>
                         </thead>
						 <tbody>
						 

							 <tr>
							 <td>
							 Comments
							 </td>
							 
							
						  <td colspan="5"><textarea style="width:700px;" id="dependability_comments" name="dependability_comments" class=" form-control"></textarea> </td>
							
							 </tr>
							 
						
							 
							 
							 
							 <tr>
							 <td  colspan="2">
							Overall Rating
							 </td>
							 
							 <td  colspan="4">
							4.3
							 </td>
							 </tr>
							 
							 
							 
							 
							 
						 </tbody>
						 
						 
	
						 
		
						 </table>



                                    <div class="form-group">
                                        <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-4">
                                            <button type="submit" class="btn btn-success">Submit</button>
											<div id="error_message" class="ajax_response" style="float:left"></div>
	                            <div id="success_message" class="ajax_response" style="float:left"></div>
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
		
	<script>
    $(function() {
      $("#datepicker").datepicker({
        showOtherMonths: true,
        selectOtherMonths: true
      });
    });
	
	
  </script>
  
  
  <script type="text/javascript">
  $(document).ready(function(){
    $(document).on("change","#employeename",function(){
		

      employee_id = $(this).val();

       $.ajax({
      
            url: "<?php echo base_url();?>Hr/get_designation",
            dataType: "json",
            method: "POST",
            data:{
              employee_id: employee_id
            },
            success: function(data){

              $("#designation").html("");

              $.each(data, function( index, value ) {
                $("#designation").append("<option value='"+value.designation_id+"'>"+value.designation_name+"</option>");
              });
              <?php if(isset($record)) { ?>
                 $("#designation").val(<?php echo $record->employee_id?>);
              <?php } ?>

             
            }
        });


    });
    <?php if(isset($cat)) { ?>
      $("#employeename").val(<?php echo $cat->employee_id?>);
      $( "#employeename" ).trigger( "change" );
    <?php } ?>
  });
</script>

	