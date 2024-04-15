<?php echo load_datatables(); ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row" style="margin-bottom:1.5rem!important;">
                <div class="col-sm-6">
                    <h1>Financial Year Master</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Settings</a></li>
                        <li class="breadcrumb-item active"><a href="<?= base_url().'financialyear' ?>">Financial Year</a></li>
                    </ol>
                </div>
            </div>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<div class="tab-content">
								<div class="tab-pane active" id="timeline">
									<div class="row">
										<div class="col-md-12 col-sm-12 col-12">
											 <form id="yearForm" data-parsley-validate class="form-horizontal form-label-left" method='post' action="<?php echo base_url()?>company/savefinancialyear">
												<input type=hidden name='yearid' id='yearid'>
												<div class="row">
													<div class="col-md-4">
														<div class="form-group">
															<label class="form-check-label">From Date</label>
															 <input autocomplete='off' type="text" id="startdate" name="startdate" required="required" class="datepicker form-control form-control-sm">
														</div>
													</div>
													
													<div class="col-md-4">
														<div class="form-group">
															<label class="form-check-label">To Date</label>
															 <input autocomplete='off' id="enddate" name="enddate" required="required" class="datepicker form-control form-control-sm" type="text" title='End Date must be greater than Start Date'>
														</div>
													</div>
													
													<div class="col-md-2" style="margin-top:22px;">
														<button type="submit" class="btn btn-success btn-sm">Submit</button>
														<button type="reset" class="btn btn-danger btn-sm" id="ResetBtn">Reset</button>
													</div>
												</div>
											</form><hr/>
										</div>
								
										<div class="col-md-12">
											<div class="table-responsive">
												<table id="example" class="table table-striped responsive-utilities jambo_table">
                                        <thead>
                                            <tr class="headings">
                                                <th>
                                                   
                                                </th>
                                                <th>S.No </th>
                                                <th>Start Year </th>
                                                <th>End Year </th>
                                                <th>Start Date </th>
                                                <th>End Date </th>
                                                <th>Status </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                           <?php
										   if(isset($financialyear) && count($financialyear)){
											   $i = 1;
											   foreach($financialyear as $tmp){
											
										   ?>
                                           
                                            <tr class="odd pointer">
                                                <td>
                                                    <input type="radio" class="tableflat year" name='yearCheck' id='year_<?php echo $tmp->yearid;?>'>
                                                </td>
                                                <td class=" "><?php echo $i++;?></td>
                                                
                                                <td class=" "><?php echo $tmp->startyear;?> </td>
                                                <td class=" "><?php echo $tmp->endyear;?> </td>
												
                                                <td class=" "><?php echo date("d-m-Y",strtotime($tmp->startdate));?> </td>
                                                <td class=" "><?php echo date("d-m-Y",strtotime($tmp->enddate));?> </td>
                                               	<td class=" ">
												<?php
												if($tmp->status == 0)
													echo "Active";
												else if($tmp->status == 1)
													echo "Inactive";
												?>
												</td>				
                                                
                                            </tr>
                                           <?php
										   	   
											   }
										   }
										   ?>
                                            
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
		</div>
    </section>
	
</div>


        <script>
            $(document).ready(function () {
				
                $('input.tableflat').iCheck({
                    checkboxClass: 'icheckbox_flat-green',
                    radioClass: 'iradio_flat-green'
                });
            });

            var asInitVals = new Array();
            $(document).ready(function () {
                var oTable = $('#example').dataTable({
                    "oLanguage": {
                        "sSearch": "Search all columns:"
                    },
                    "aoColumnDefs": [
                        {
                            'bSortable': false,
                            'aTargets': [0]
                        }
            ],
                    'iDisplayLength': 10,
                    "sPaginationType": "full_numbers",
                    "dom": 'T<"clear">lfrtip'
                });
                
            }); 
            
            $("#startdate").datepicker({
					dateFormat: "dd-mm-yy",
					 onSelect: function (selected) {
						  $("#enddate").datepicker("option","minDate", selected)
					 }
					
			});
			
            $("#enddate").datepicker({
					dateFormat: "dd-mm-yy"					
			});
			
				
			$(document).ready(function () {				
               $(".DTTT_container").hide();
			   
			   $(".edityear").click(function(){
				     if($(".year").is(":checked")){
						  if($(".year:checked").length == 1){
							  var id = $(".year:checked").attr("id");
							  id = id.split("_");
							    $.ajax({
								  url: "<?php echo base_url();?>company/get_yeardetails",
								  dataType: "json",
								  type:"POST",	  
								  data: {
									yearid: id[1]
								  },
								  success: function( data ) {
									  $.each(data,function(id,value){
										  $("#"+id).val(value);
									  });
								  }
								});
						  }else{
							  alert("Please select one Year");
						  }
					 }else{
						 alert("Please select one Year");
					 }
			   });
			   
			   
			   
			   $(".changestatus").click(function(){
				     if($(".year").is(":checked")){
						  if($(".year:checked").length == 1){
							  var id = $(".year:checked").attr("id");
							  id = id.split("_");
							  e = confirm("Do you want to change the Status?");
							  if(e)
							  window.location.href = "<?php echo base_url()?>company/yearstatus/"+id[1];
						  }else{
							  alert("Please select one Year");
						  }
					 }else{
						 alert("Please select one Year");
					 }
			   });
			   
			   $(".deleteyear").click(function(){
				     if($(".year").is(":checked")){
						  if($(".year:checked").length == 1){
							  var id = $(".year:checked").attr("id");
							  id = id.split("_");
							  e = confirm("Do you want to delete the Financial Year?");
							  if(e)
							  window.location.href = "<?php echo base_url()?>company/deleteyear/"+id[1];
						  }else{
							  alert("Please select one Year");
						  }
					 }else{
						 alert("Please select one Year");
					 }
			   });
			   
			   <?php
			        if($this->session->flashdata('financial_created')){
			      ?>
						new PNotify({
							title: 'Financial Year Master',
							text: '<?php echo $this->session->flashdata('financial_created');?>',
							type: 'success'
						});
				  <?php 
					}
				  ?>
				  
				  
				  $("#yearForm").submit(function(){
						$('button[type=submit]').attr('disabled',true);
				  });					
            });
			
        </script>