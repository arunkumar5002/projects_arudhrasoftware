<?php echo load_datatables(); ?>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

	<script src="js/addons/rating.js"></script>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row" style="margin-bottom:1.5rem!important;">
                <div class="col-sm-6">
                    <h1> Employee Perform</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active"><a href="<?php echo base_url().'employee_perform_list'?>">Employee Perform List</a></li>
					   
                    </ol>
                </div>
            </div>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header p-2">
							<ul class="nav nav-pills">
								<li class="nav-item"><a class="nav-link active" href="#timeline" data-toggle="tab">Employee Perform</a></li>
							</ul>
						</div>
						<div class="card-body">
							<div class="tab-content">
								<div class="tab-pane active" id="timeline">
									<div class="row">
										<div class="col-md-12 col-sm-12 col-12">
											 <form autocomplete="OFF" id="DataForm">
                            
                                <div class="row">
               
									
									<input type="hidden" name="row_id" id="row_id" value="<?= (!empty($edit))?$edit->id:'' ?>" >
								
									<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <label for="companyname">Employee Name
                                            <span class="required">*</span>
                                        </label>

                                       <select class="form-control" required="" name="employee_id" id="employeename">
                                      <option value="">--Choose--</option>
                                     <?php foreach ($department as $key => $value) {
									  if(isset($edit) && $edit->employee_id == $value->employee_id)
                                      echo "<option selected value=".$value->employee_id." data-dept='".$value->department_name."' data-desi='".$value->designation_name."'>".$value->employeename."</option>";
								  else
                                      echo "<option value=".$value->employee_id." data-dept='".$value->department_name."' data-desi='".$value->designation_name."'>".$value->employeename."</option>";
                                        } ?>
										
								
                                   </select>
                                    </div>
									
								

                               
                                  <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                    <label for="jobtitle">Job Title
                                        <span class="required">*</span>
                                    </label>
                                   <input type="text" class="form-control" id='designation' required="" name="designation_name" value="">

                                </div>
									
									  
                                       <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                    <label for="department">Department
                                           <span class="required">*</span>
                                    </label>

                                    <input type="text"  class="form-control" id='department' required="" name="department_name" value="">
                                </div>
								
									


           <div class="form-group  col-md-6 col-sm-6 col-xs-6">
		   <?php
													$date_of_review = "";
													if((!empty($edit)) && (!empty($edit->date_of_review)) && ($edit->date_of_review!="0000-00-00")){
														$date_of_review = date('d-m-Y',strtotime($edit->date_of_review));
													}
												?>
            <label class="control-label col-md-6 col-sm-4 col-xs-4" for="companyname"> Date of Review <span class="required">*</span>
            </label>
           
              <input type="text" name="date_of_review" class="form-control datepicker" required="" autocomplete="off" value="<?= $date_of_review ?>">
           
          </div>
                         
	<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <label for="companyname">Review period
                                            <span class="required">*</span>
                                        </label>

                                        <input type="text" id="review_period" name="review_period" required="required" class="form-control" autocomplete="on" value="<?php echo isset($edit)?$edit->review_period:'';?>">
                                       <span id="name_error" style="color:red;"></span>
                                    </div>

	<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <label for="companyname">Line Manager
                                            <span class="required">*</span>
                                        </label>

                                        <input type="text" id="line_manager" name="line_manager" required="required" class="form-control" autocomplete="on" value="<?php echo isset($edit)?$edit->line_manager:'';?>">
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
							 <th>1 - Poor </th>
                             <th>2 - Fair </th>
                             <th> 3 - Satisfactory </th>
                             <th> 4 - Good </th>
							  <th> 5 - Excellent </th>
                           </tr>
						   <tr>
                             <th><b> Job Knowledge</b></th>
							 	<td>
									<input type="radio" class="star_rate" name="job_knowledge_rating" value="1" <?php echo isset($edit->job_knowledge_rating) && $edit->job_knowledge_rating == 1?'checked':'';?>>
									
								</td>
                              <td><input type="radio" class="star_rate" name="job_knowledge_rating" value="2" <?php echo isset($edit->job_knowledge_rating) && $edit->job_knowledge_rating == 2?'checked':'';?>>
							   
									
									</td>
							
                              <td><input type="radio" class="star_rate" name="job_knowledge_rating" value="3" <?php echo isset($edit->job_knowledge_rating) && $edit->job_knowledge_rating == 3?'checked':'';?>>
							   
									</td>
							     
                            <td><input type="radio" class="star_rate" name="job_knowledge_rating" value="4" <?php echo isset($edit->job_knowledge_rating) && $edit->job_knowledge_rating == 4?'checked':'';?>>
							    
									</td>
							   
						 <td><input type="radio" class="star_rate" name="job_knowledge_rating" value="5" <?php echo isset($edit->job_knowledge_rating) && $edit->job_knowledge_rating == 5?'checked':'';?>>
						   
									</td>
						         
                           </tr>
                         </thead>
						 <tbody>
						 
						 <tr>
							  <td> List Down Work KPI</td>
							  <td colspan="18"><textarea style="width:700px;" id="job_knowledge_comments" name="job_knowledge_comments" class=" form-control"><?php echo isset($edit) ? $edit->job_knowledge_comments : ''; ?>
                                 </textarea> </td>
                 		 
							 </tr>
						 
						 	   <tr>
                             <th><b> Quality of Work</b></th>
							 	 <td><input type="radio" class="star_rate" name="quality_rating" value="1" <?php echo isset($edit->quality_rating) && $edit->quality_rating == 1?'checked':'';?>>
								 	
									</td>
                              <td><input type="radio" class="star_rate" name="quality_rating" value="2" <?php echo isset($edit->quality_rating) && $edit->quality_rating == 2?'checked':'';?>>
							  
									</td>
                              <td><input type="radio" class="star_rate" name="quality_rating" value="3" <?php echo isset($edit->quality_rating) && $edit->quality_rating == 3?'checked':'';?>>
							   
									</td>
                            <td><input type="radio" class="star_rate" name="quality_rating" value="4" <?php echo isset($edit->quality_rating) && $edit->quality_rating == 4?'checked':'';?>>
							
									</td>
						 <td><input type="radio" class="star_rate" name="quality_rating" value="5" <?php echo isset($edit->quality_rating) && $edit->quality_rating == 5?'checked':'';?>>
						 
									</td>
                           </tr>
                         </thead>
						 <tbody>
						 
						 <tr>
							  <td>Comments</td>
							  <td colspan="18"><textarea style="width:700px;" id="quality_rating_comments" name="quality_rating_comments" class=" form-control"><?php echo isset($edit) ? $edit->quality_rating_comments : ''; ?></textarea> </td>
                             
							 
							 </tr>
						 
						 	   <tr>
                             <th><b>Attendance/Punctuality</b></th>
							 <td><input type="radio" class="star_rate" name="attendance_punctuality_rating" value="1" <?php echo isset($edit->attendance_punctuality_rating) && $edit->attendance_punctuality_rating == 1?'checked':'';?>>
							     
									</td>
                              <td><input type="radio" class="star_rate" name="attendance_punctuality_rating" value="2" <?php echo isset($edit->attendance_punctuality_rating) && $edit->attendance_punctuality_rating == 2?'checked':'';?>>
							       
									</td>
                              <td><input type="radio" class="star_rate" name="attendance_punctuality_rating" value="3" <?php echo isset($edit->attendance_punctuality_rating) && $edit->attendance_punctuality_rating == 3?'checked':'';?>>
							  
									</td>
                            <td><input type="radio" class="star_rate" name="attendance_punctuality_rating" value="4" <?php echo isset($edit->attendance_punctuality_rating) && $edit->attendance_punctuality_rating == 4?'checked':'';?>>
							 
									</td>
									</td>
						 <td><input type="radio" class="star_rate" name="attendance_punctuality_rating" value="5" <?php echo isset($edit->attendance_punctuality_rating) && $edit->attendance_punctuality_rating == 5?'checked':'';?>>
						       
									</td></td>
                           </tr>
                         </thead>
						 <tbody>
						 
						 <tr>
							  <td>Attach attendance sheet for the Quatre</td>
							  <td colspan="18"><textarea style="width:700px;" id="attendance_punctuality_comments" name="attendance_punctuality_comments" class=" form-control"><?php echo isset($edit) ? $edit->attendance_punctuality_comments : ''; ?></textarea> </td>
                             
							 
							 </tr>
							 
							 	   <tr>
                             <th><b> Takes Initiative</b></th>
							 <td><input type="radio" class="star_rate" name="takes_initiative_rating" value="1" <?php echo isset($edit->takes_initiative_rating) && $edit->takes_initiative_rating == 1?'checked':'';?>>
							       
									</td>
                              <td><input type="radio" class="star_rate" name="takes_initiative_rating" value="2" <?php echo isset($edit->takes_initiative_rating) && $edit->takes_initiative_rating == 2?'checked':'';?>>
							      
									</td>
                              <td><input type="radio" class="star_rate" name="takes_initiative_rating" value="3" <?php echo isset($edit->takes_initiative_rating) && $edit->takes_initiative_rating == 3?'checked':'';?>>
							  
									</td>
                            <td><input type="radio" class="star_rate" name="takes_initiative_rating" value="4" <?php echo isset($edit->takes_initiative_rating) && $edit->takes_initiative_rating == 4?'checked':'';?>>
							      
									</td>
						 <td><input type="radio" class="star_rate" name="takes_initiative_rating" value="5" <?php echo isset($edit->takes_initiative_rating) && $edit->takes_initiative_rating == 5?'checked':'';?>>
						        
									</td>
                           </tr>
                         </thead>
						 <tbody>
						 
						 <tr>
							  <td> Comments</td>
							  <td colspan="18"><textarea style="width:700px;" id="takes_initiative_comments" name="takes_initiative_comments" class=" form-control"><?php echo isset($edit) ? $edit->takes_initiative_comments : ''; ?></textarea> </td>
                             
							 
							 </tr>
							 
							 	   <tr>
                             <th><b>Communication/Listening </b></th>
							  <td><input type="radio" class="star_rate" name="communication_listening_rating" value="1" <?php echo isset($edit->communication_listening_rating) && $edit->communication_listening_rating == 1?'checked':'';?>>
							        
									</td>
                              <td><input type="radio" class="star_rate" name="communication_listening_rating" value="2" <?php echo isset($edit->communication_listening_rating) && $edit->communication_listening_rating == 2?'checked':'';?>>
							 
									</td>
                              <td><input type="radio" class="star_rate" name="communication_listening_rating" value="3" <?php echo isset($edit->communication_listening_rating) && $edit->communication_listening_rating == 3?'checked':'';?>>
							  
									</td>
                            <td><input type="radio" class="star_rate" name="communication_listening_rating" value="4" <?php echo isset($edit->communication_listening_rating) && $edit->communication_listening_rating == 4?'checked':'';?>>
							       
									</td>
						 <td><input type="radio" class="star_rate" name="communication_listening_rating" value="5" <?php echo isset($edit->communication_listening_rating) && $edit->communication_listening_rating == 5?'checked':'';?>>
						        
									</td>
                           </tr>
                         </thead>
						 <tbody>
						 
						 <tr>
							  <td> Comments</td>
							  <td colspan="18"><textarea style="width:700px;" id="	communication_listening_comments" name="communication_listening_comments" class=" form-control"><?php echo isset($edit) ? $edit->communication_listening_comments : ''; ?></textarea> </td>
                             
							 
							 </tr>
							 
							 	   <tr>
                             <th><b> Dependability</b></th>
							 <td><input type="radio" class="star_rate" name="dependability_rating" value="1" <?php echo isset($edit->dependability_rating) && $edit->dependability_rating == 1?'checked':'';?>>
							      
									</td>
                              <td><input type="radio" class="star_rate" name="dependability_rating" value="2" <?php echo isset($edit->dependability_rating) && $edit->dependability_rating == 2?'checked':'';?>>
							      
									</td>
                              <td><input type="radio" class="star_rate" name="dependability_rating" value="3" <?php echo isset($edit->dependability_rating) && $edit->dependability_rating == 3?'checked':'';?>>
							       
									</td>
                            <td><input type="radio" class="star_rate" name="dependability_rating" value="4" <?php echo isset($edit->dependability_rating) && $edit->dependability_rating == 4?'checked':'';?>>
							     
									</td>
						 <td><input type="radio" class="star_rate" name="dependability_rating" value="5" <?php echo isset($edit->dependability_rating) && $edit->dependability_rating == 5?'checked':'';?>>
						          
									</td>
                           </tr>
                         </thead>
						 <tbody>
						 

							 <tr>
							 <td>
							 Comments
							 </td>
							 
							
						  <td colspan="5"><textarea style="width:700px;" id="dependability_comments" name="dependability_comments" class=" form-control"><?php echo isset($edit) ? $edit->dependability_comments : ''; ?></textarea> </td>
							
							 </tr>
							 
						
							 <tr>
							 <td  colspan="2">
							Overall Rating
							 </td>
							 
							 <td  colspan="4">
							<input style="width:50px;" type="text" name="overall_rating" id="overall_rating"  value="<?php echo isset($edit)?$edit->overall_rating:'';?>" > <b> / 5 </b>
	 

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
					</div>
				</div>
			</div>
		</div>
    </section>
	
</div>

<script>
$(function () {
	//$('.select2').select2();

	$(".datepicker").datepicker({
		dateFormat: 'dd-mm-yy'
	});
});
	
	
  </script>
  

<script type="text/javascript">
 
$(document).on("change",".star_rate",function(){
	
	rate = 0;
	$(".star_rate:checked").each(function(){
		rate = rate + parseInt($(this).val());
	});
	
	$("#overall_rating").val((rate/6).toFixed(2));
	
});

$("#employeename").change(function(){
	var id = $(this).val();
	if(id!=""){
		$("#department").val($(this).find(':selected').data('dept'));
	}else{
		$("#department").val('');
	}
});

$("#employeename").change(function(){
	var id = $(this).val();
	if(id!=""){
		$("#designation").val($(this).find(':selected').data('desi'));
	}else{
		$("#designation").val('');
	}
});

$("#employeename").trigger("change");


</script>




<script>


$("#ResetBtn").click(function(){
	clear_data_form();
});

$("#DataForm").on('submit',(function(e){
	e.preventDefault();
	var formData = new FormData($("#DataForm")[0]);
	$.ajax({
		url: "<?= base_url().'add_edit_employee_perform' ?>",
		type: "POST",
		data:  formData,
		dataType: "JSON",
		contentType: false,
		cache: false,
		processData:false,
		beforeSend: function() {
			$("#DataForm [type='submit']").attr('disabled', true);
		},
		success: function(data)
		{
			if(data['status']=="Error"){
				toastr.error(data['msg']);
			}else{
				toastr.success(data['msg']);
				
				clear_data_form();
				//window.location.href = "<?php echo base_url();?>";
			}
		},
		complete: function(data) {
			$("#DataForm [type='submit']").attr('disabled', false);
		},
	});
}));




function clear_data_form(){
	$('#row_id').val('');
	$("#DataForm [type='submit']").html('Submit');
	$("#DataForm").trigger('reset');
}
</script>

