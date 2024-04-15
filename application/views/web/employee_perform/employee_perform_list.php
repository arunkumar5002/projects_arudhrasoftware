		<?php echo load_datatables(); ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row" style="margin-bottom:1.5rem!important;">
                <div class="col-sm-6">
                    <h1> Employee Perform List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        
                        <li class="breadcrumb-item active"><a href="<?= base_url().'employee_perform' ?>"> Employee Perform </a></li>
						
                    </ol>
                </div>
            </div>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header p-2">
							<ul class="nav nav-pills">
								<a href="<?= base_url().'employee_perform' ?>" class="btn btn-info btn-sm" style="margin-left: 900px;"><i class="fa fa-plus"></i> New</a>
							</ul>
						</div>
						<div class="card-body">
							<div class="tab-content">
								<div class="tab-pane active" id="timeline">
									<div class="row">
									
										<div class="col-md-12 col-sm-12 col-12">
										<input type="hidden" name="row_id" id="row_id" />
											<div class="table-responsive">
												<table class="table table-bordered" id="DataTable" width="100%">
													<thead>
														<tr>
															<th width="5%"> S.No  </th>
															<th width="12%"> Employee Name </th>
													
															<th width="12%"> Designation </th>
															<th width="12%"> Department </th>
															<th width="15%"> Date of Review </th>
															<th width="10%"> Review period </th>
															<th width="10%"> Line Manager</th>
															<th width="10%"> Overall Rating </th>					
															<th width="20%"> Action </th>
															
														</tr>
													</thead>
				

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
$(document).ready(function(){
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