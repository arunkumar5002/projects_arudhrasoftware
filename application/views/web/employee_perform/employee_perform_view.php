<div class="content-wrapper">
 <section class="content-header">
	<div id="printableArea">
        <div class="container-fluid">
            
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header p-2">
							<ul class="nav nav-pills">
								<img style="margin-left: 2%;
    height: 70px;
    width: fit-content;"  src="<?php echo base_url(logo());?>" alt="AdminLTELogo">
							</ul>
						</div>
						<div class="card-body">
							<div class="tab-content">
								<div class="tab-pane active" id="timeline">
									<div class="row">
										<div class="col-md-12 col-sm-12 col-12">
											 <form autocomplete="OFF" id="DataForm">
                            
                                <div class="row">
               
									
									<input type="hidden" name="row_id" id="row_id" value="<?= (!empty($view))?$view->id:'' ?>" >
								
									<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <label for="companyname">Employee Name
                                            <span class="required">*</span>
                                        </label>

                                       <select class="form-control" required="" name="employee_id" id="employeename">
                                      <option value="">--Choose--</option>
                                     <?php foreach ($department as $key => $value) {
									  if(isset($view) && $view->employee_id == $value->employee_id)
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
													if((!empty($view)) && (!empty($view->date_of_review)) && ($view->date_of_review!="0000-00-00")){
														$date_of_review = date('d-m-Y',strtotime($view->date_of_review));
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

                                        <input type="text" id="review_period" name="review_period" required="required" class="form-control" autocomplete="on" value="<?php echo isset($view)?$view->review_period:'';?>">
                                       <span id="name_error" style="color:red;"></span>
                                    </div>

	<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <label for="companyname">Line Manager
                                            <span class="required">*</span>
                                        </label>

                                        <input type="text" id="line_manager" name="line_manager" required="required" class="form-control" autocomplete="on" value="<?php echo isset($view)?$view->line_manager:'';?>">
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
									<input type="radio" class="star_rate" name="job_knowledge_rating" value="1" <?php echo isset($view->job_knowledge_rating) && $view->job_knowledge_rating == 1?'checked':'';?>>
									
								</td>
                              <td><input type="radio" class="star_rate" name="job_knowledge_rating" value="2" <?php echo isset($view->job_knowledge_rating) && $view->job_knowledge_rating == 2?'checked':'';?>>
							   
									
									</td>
							
                              <td><input type="radio" class="star_rate" name="job_knowledge_rating" value="3" <?php echo isset($view->job_knowledge_rating) && $view->job_knowledge_rating == 3?'checked':'';?>>
							   
									</td>
							     
                            <td><input type="radio" class="star_rate" name="job_knowledge_rating" value="4" <?php echo isset($view->job_knowledge_rating) && $view->job_knowledge_rating == 4?'checked':'';?>>
							    
									</td>
							   
						 <td><input type="radio" class="star_rate" name="job_knowledge_rating" value="5" <?php echo isset($view->job_knowledge_rating) && $view->job_knowledge_rating == 5?'checked':'';?>>
						   
									</td>
						         
                           </tr>
                         </thead>
						 <tbody>
						 
						 <tr>
							  <td> List Down Work KPI</td>
							  <td colspan="18"><textarea style="width:700px;" id="job_knowledge_comments" name="job_knowledge_comments" class=" form-control"><?php echo isset($view) ? $view->job_knowledge_comments : ''; ?>
                                 </textarea> </td>
                 		 
							 </tr>
						 
						 	   <tr>
                             <th><b> Quality of Work</b></th>
							 	 <td><input type="radio" class="star_rate" name="quality_rating" value="1" <?php echo isset($view->quality_rating) && $view->quality_rating == 1?'checked':'';?>>
								 	
									</td>
                              <td><input type="radio" class="star_rate" name="quality_rating" value="2" <?php echo isset($view->quality_rating) && $view->quality_rating == 2?'checked':'';?>>
							  
									</td>
                              <td><input type="radio" class="star_rate" name="quality_rating" value="3" <?php echo isset($view->quality_rating) && $view->quality_rating == 3?'checked':'';?>>
							   
									</td>
                            <td><input type="radio" class="star_rate" name="quality_rating" value="4" <?php echo isset($view->quality_rating) && $view->quality_rating == 4?'checked':'';?>>
							
									</td>
						 <td><input type="radio" class="star_rate" name="quality_rating" value="5" <?php echo isset($view->quality_rating) && $view->quality_rating == 5?'checked':'';?>>
						 
									</td>
                           </tr>
                         </thead>
						 <tbody>
						 
						 <tr>
							  <td>Comments</td>
							  <td colspan="18"><textarea style="width:700px;" id="quality_rating_comments" name="quality_rating_comments" class=" form-control"><?php echo isset($view) ? $view->quality_rating_comments : ''; ?></textarea> </td>
                             
							 
							 </tr>
						 
						 	   <tr>
                             <th><b>Attendance/Punctuality</b></th>
							 <td><input type="radio" class="star_rate" name="attendance_punctuality_rating" value="1" <?php echo isset($view->attendance_punctuality_rating) && $view->attendance_punctuality_rating == 1?'checked':'';?>>
							     
									</td>
                              <td><input type="radio" class="star_rate" name="attendance_punctuality_rating" value="2" <?php echo isset($view->attendance_punctuality_rating) && $view->attendance_punctuality_rating == 2?'checked':'';?>>
							       
									</td>
                              <td><input type="radio" class="star_rate" name="attendance_punctuality_rating" value="3" <?php echo isset($view->attendance_punctuality_rating) && $view->attendance_punctuality_rating == 3?'checked':'';?>>
							  
									</td>
                            <td><input type="radio" class="star_rate" name="attendance_punctuality_rating" value="4" <?php echo isset($view->attendance_punctuality_rating) && $view->attendance_punctuality_rating == 4?'checked':'';?>>
							 
									</td>
									</td>
						 <td><input type="radio" class="star_rate" name="attendance_punctuality_rating" value="5" <?php echo isset($view->attendance_punctuality_rating) && $view->attendance_punctuality_rating == 5?'checked':'';?>>
						       
									</td></td>
                           </tr>
                         </thead>
						 <tbody>
						 
						 <tr>
							  <td>Attach attendance sheet for the Quatre</td>
							  <td colspan="18"><textarea style="width:700px;" id="attendance_punctuality_comments" name="attendance_punctuality_comments" class=" form-control"><?php echo isset($view) ? $view->attendance_punctuality_comments : ''; ?></textarea> </td>
                             
							 
							 </tr>
							 
							 	   <tr>
                             <th><b> Takes Initiative</b></th>
							 <td><input type="radio" class="star_rate" name="takes_initiative_rating" value="1" <?php echo isset($view->takes_initiative_rating) && $view->takes_initiative_rating == 1?'checked':'';?>>
							       
									</td>
                              <td><input type="radio" class="star_rate" name="takes_initiative_rating" value="2" <?php echo isset($view->takes_initiative_rating) && $view->takes_initiative_rating == 2?'checked':'';?>>
							      
									</td>
                              <td><input type="radio" class="star_rate" name="takes_initiative_rating" value="3" <?php echo isset($view->takes_initiative_rating) && $view->takes_initiative_rating == 3?'checked':'';?>>
							  
									</td>
                            <td><input type="radio" class="star_rate" name="takes_initiative_rating" value="4" <?php echo isset($view->takes_initiative_rating) && $view->takes_initiative_rating == 4?'checked':'';?>>
							      
									</td>
						 <td><input type="radio" class="star_rate" name="takes_initiative_rating" value="5" <?php echo isset($view->takes_initiative_rating) && $view->takes_initiative_rating == 5?'checked':'';?>>
						        
									</td>
                           </tr>
                         </thead>
						 <tbody>
						 
						 <tr>
							  <td> Comments</td>
							  <td colspan="18"><textarea style="width:700px;" id="takes_initiative_comments" name="takes_initiative_comments" class=" form-control"><?php echo isset($view) ? $view->takes_initiative_comments : ''; ?></textarea> </td>
                             
							 
							 </tr>
							 
							 	   <tr>
                             <th><b>Communication/Listening </b></th>
							  <td><input type="radio" class="star_rate" name="communication_listening_rating" value="1" <?php echo isset($view->communication_listening_rating) && $view->communication_listening_rating == 1?'checked':'';?>>
							        
									</td>
                              <td><input type="radio" class="star_rate" name="communication_listening_rating" value="2" <?php echo isset($view->communication_listening_rating) && $view->communication_listening_rating == 2?'checked':'';?>>
							 
									</td>
                              <td><input type="radio" class="star_rate" name="communication_listening_rating" value="3" <?php echo isset($view->communication_listening_rating) && $view->communication_listening_rating == 3?'checked':'';?>>
							  
									</td>
                            <td><input type="radio" class="star_rate" name="communication_listening_rating" value="4" <?php echo isset($view->communication_listening_rating) && $view->communication_listening_rating == 4?'checked':'';?>>
							       
									</td>
						 <td><input type="radio" class="star_rate" name="communication_listening_rating" value="5" <?php echo isset($view->communication_listening_rating) && $view->communication_listening_rating == 5?'checked':'';?>>
						        
									</td>
                           </tr>
                         </thead>
						 <tbody>
						 
						 <tr>
							  <td> Comments</td>
							  <td colspan="18"><textarea style="width:700px;" id="	communication_listening_comments" name="communication_listening_comments" class=" form-control"><?php echo isset($view) ? $view->communication_listening_comments : ''; ?></textarea> </td>
                             
							 
							 </tr>
							 
							 	   <tr>
                             <th><b> Dependability</b></th>
							 <td><input type="radio" class="star_rate" name="dependability_rating" value="1" <?php echo isset($view->dependability_rating) && $view->dependability_rating == 1?'checked':'';?>>
							      
									</td>
                              <td><input type="radio" class="star_rate" name="dependability_rating" value="2" <?php echo isset($view->dependability_rating) && $view->dependability_rating == 2?'checked':'';?>>
							      
									</td>
                              <td><input type="radio" class="star_rate" name="dependability_rating" value="3" <?php echo isset($view->dependability_rating) && $view->dependability_rating == 3?'checked':'';?>>
							       
									</td>
                            <td><input type="radio" class="star_rate" name="dependability_rating" value="4" <?php echo isset($view->dependability_rating) && $view->dependability_rating == 4?'checked':'';?>>
							     
									</td>
						 <td><input type="radio" class="star_rate" name="dependability_rating" value="5" <?php echo isset($view->dependability_rating) && $view->dependability_rating == 5?'checked':'';?>>
						          
									</td>
                           </tr>
                         </thead>
						 <tbody>
						 

							 <tr>
							 <td>
							 Comments
							 </td>
							 
							
						  <td colspan="5"><textarea style="width:700px;" id="dependability_comments" name="dependability_comments" class=" form-control"><?php echo isset($view) ? $view->dependability_comments : ''; ?></textarea> </td>
							
							 </tr>
							 
						
							 <tr>
							 <td  colspan="2">
							Overall Rating
							 </td>
							 
							 <td  colspan="4">
							<input style="width:50px;" type="text" name="overall_rating" id="overall_rating"  value="<?php echo isset($view)?$view->overall_rating:'';?>" > <b> / 5 </b>
	 

							 </td>
							 </tr>
							 
							 
							 
							 
							 
						 </tbody>
						 
		
						 </table>
</div>
<div class="row no-print" style="margin-top:40px">
<div class="col-12">

<input type="button" onclick="printDiv('printableArea')" value="Print" rel="noopener" target="_blank" class="btn btn-default">
                                            <button type="submit" class="btn btn-success">Submit</button>
											<div id="error_message" class="ajax_response" style="float:left"></div>
	                            <div id="success_message" class="ajax_response" style="float:left"></div>
                                            <button type="reset" class="btn btn-primary">Cancel</button>
                                        </div>
										</div>
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

	<script type="text/javascript">
function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}
</script>
	
	
	
	<script>
	$(document).ready(function(){ 
	
	
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
	
	
	$('#DataTable').DataTable({
		'processing': true,
		'serverSide': true,
		'serverMethod': 'post',
		"order": [[ 1, "asc" ]],
		'ajax': {
			'url':	"<?= base_url().'list_employee_perform' ?>",
			'type':	"POST"
		},
		"columnDefs": [{ 
			"targets": [0,3],
			"orderable": false
		}]
	});
});

$("#ResetBtn").click(function(){
	clear_data_form();
});


$(document).on("click",".delete_data",function(){
	var val = confirm("Are You Sure to Delete !!!");
	if(val==true){
		$.ajax({
			url: "<?= base_url().'delete_Employee_Perform' ?>",
			type: "POST",
			data:  { keys : $(this).attr('data-id') },
			dataType: "JSON",
			success: function(data)
			{
				if(data['status']=="Warning"){
					toastr.warning(data['msg']);
				}else{
					toastr.info(data['msg']);
					$('#DataTable').DataTable().ajax.reload(null, false);
				}
			}
		});
	}
});

$(document).on("click",".edit_data",function(){
	

	$("#DataForm [type='submit']").html('Update');
	$('#id').val($(this).attr('data-id'));
	$('#employee_id').val($(this).attr('data-name'));
	$('#date_of_review').val($(this).attr('data-review'));
	$('#review_period').val($(this).attr('data-period'));
	$('#line_manager').val($(this).attr('data-manager'));
	$('#job_knowledge_rating').val($(this).attr('data-knowledge'));
	$('#job_knowledge_comments').val($(this).attr('data-job'));
	$('#attendance_punctuality_rating').val($(this).attr('data-punctuality'));
	$('#attendance_punctuality_comments').val($(this).attr('data-attendance'));
	$('#takes_initiative_rating').val($(this).attr('data-takes'));
	$('#takes_initiative_comments').val($(this).attr('data-initiative'));
	$('#communication_listening_rating').val($(this).attr('data-communication'));
	$('#communication_listening_comments').val($(this).attr('data-listening'));
	$('#dependability_rating').val($(this).attr('data-dependability'));
	$('#dependability_comments').val($(this).attr('data-comments'));
	$('#overall_rating').val($(this).attr('data-overall'));
	$('#employee_status').val($(this).attr('data-status'));
	
	
	window.scroll({top: 0, behavior: "smooth"})
	
	
	
	
});

function clear_data_form(){
	$('#row_id').val('');
	$("#DataForm [type='submit']").html('Submit');
	$("#DataForm").trigger('reset');
}
</script>