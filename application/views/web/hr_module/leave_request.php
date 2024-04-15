<?php echo load_datatables(); ?>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<style>
#FormModalHeading{
	margin-bottom:-5px;
}
</style>

<style>
	a span{
		color:black;
	}
	.info-box-number{
		font-size: 18px;
		text-align: right;
	}
</style>


<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row" style="margin-bottom:1.5rem!important;">
                <div class="col-sm-6">
                    <h1><?= $page_title ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active"><a href="<?= base_url().'leave_request_master' ?>"><?= $page_title ?></a></li>
                    </ol>
                </div>
            </div>
			
			<!-- employee leave request list start-->
			
		<section class="content-header">
		<div class="container-fluid">
			<div class="row">
			
			        <?php
						$user_id =$this->session->userdata("user_id");
						
						$total_leave = 0;
						foreach($list_leave_category as $row){ 
								$records = get_employee_leave_details($user_id, $row['id']);
								
								foreach($records as $record){
									if($record->request_leave_type == 1){
										//single
										$total_leave = $total_leave + 1;
									}else{
										//multiple
										
										$start_date = $record->request_start_date." 00:00:00";
										$end_date = $record->request_end_date." 23:59:59";

										$start_datetime = new DateTime($start_date);
										$end_datetime = new DateTime($end_date);

										$interval = $start_datetime->diff($end_datetime);

										$days_between = $interval->days;

										$total_leave = $total_leave + $days_between  + 1;										
									}
								}
								
					?>
					<div class="col-md-3 col-sm-6 col-12">
						<div class="info-box">
							<div class="info-box-content">
								<span class="info-box-text" style="font-size:20px;color:#009FBD;"><b><?php echo  $row['category_name']  ?> </b></span>
								<span class="info-box-number" style="font-size:20px;color:#009FBD;"> <?php echo $total_leave;?> /<?php echo  $row['category_value']  ?> </span>
							</div>
						</div>
					</a>
				</div>
											

			<?php 								
			$total_leave = 0;
			}
										
									?>
			
			</div>
			</div>
			</div>

			
			<!-- employee leave request  list end-->
			
			<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-md-12 col-sm-12 col-12 text-right">
									<button type="button" id="AddBtn" class="btn btn-info btn-sm"><i class="fa fa-plus"></i> New</button>
									<hr/>
								</div>
								<div class="col-md-12 col-sm-12 col-12">
									<div class="table-responsive">
										<table class="table table-bordered" id="DataTable" width="100%">
											<thead>
												<tr>
													<th width="8%">#</th>
													<th width="15%">Leave Category</th>
													<th width="15%">Leave Type</th>
													<th width="15%">Start Date</th>
													<th width="15%">End Date</th>
													<th width="12%">Action</th>
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
    </section>
	
</div>

<?php
	$emp_id 	= "";
	$emp_con 	= "";
	$emp_class 	= "select2";
	if($this->session->userdata('user_emp')==1){
		$emp_id 	= $this->session->userdata('user_id');
		$emp_con 	= "readonly";
		$emp_class 	= "";
	}
?>

<div class="modal fade show" id="FormModal" aria-modal="true" role="dialog">
	<div class="modal-dialog modal-lg">
		<form id="DataForm" autocomplete="OFF">
			<input type="hidden" name="row_id" id="row_id" />
			<div class="modal-content">
				<div class="modal-header">
					<h4 id="FormModalHeading"></h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label class="form-check-label">Employee</label>
								<select class="form-control form-control-sm <?= $emp_class ?>" name="request_emp_id" id="request_emp_id" <?= $emp_con ?> required>
									<?php
										if(!empty($list_employee)){
											echo '<option value="">Select Employee</option>';
											foreach($list_employee as $row){
												$temp = ($emp_id==$row['employee_id'])?'selected':'';
												echo '<option value="'.$row['employee_id'].'" '.$temp.'>'.$row['employeename'].'</option>';
											}
										}else{
											echo '<option value="">Employee List Empty</option>';
										}
									?>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="form-check-label">Leave Category</label>
								<select class="form-control form-control-sm" name="request_leave_category" id="request_leave_category" required>
									<?php
										if(!empty($list_leave_category)){
											echo '<option value="">Select Leave Category</option>';
											foreach($list_leave_category as $row){
												echo '<option value="'.$row['id'].'">'.$row['category_name'].'</option>';
											}
										}else{
											echo '<option value="">Leave Category List Empty</option>';
										}
									?>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="form-check-label">Duration</label><br/>
								<input type="radio" name="request_leave_type" value="1" checked /> Single &nbsp;&nbsp;
								<input type="radio" name="request_leave_type" value="2" /> Multiple
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="form-check-label">Start Date</label>
								<input type="text" class="form-control form-control-sm datepicker" name="request_start_date" id="request_start_date" required />
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="form-check-label">End Date</label>
								<input type="text" class="form-control form-control-sm datepicker" name="request_end_date" id="request_end_date" required />
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="form-check-label">Attachment [jpg|jpeg|png|webp]</label>
								<input type="file" class="form-control form-control-sm" name="request_attachment" id="request_attachment" />
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label class="form-check-label">Reason</label>
								<textarea class="form-control form-control-sm" name="request_reason" rows="4" id="request_reason"></textarea>
							</div>
						</div>
						<div class="col-md-4" id="AttachmentDiv"></div>
					</div>
				</div>
				<div class="modal-footer" style="text-align:left !important;">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-success">Submit</button>
					<button type="reset" class="btn btn-danger">Reset</button>
				</div>
			</div>
		</form>
	</div>
</div>



<script>
$(document).ready(function(){
	$('#DataTable').DataTable({
		'processing': true,
		'serverSide': true,
		'serverMethod': 'post',
		"order": [[ 4, "desc" ]],
		'ajax': {
			'url':	"<?= base_url().'list_leave_request' ?>",
			'type':	"POST"
		},
		"columnDefs": [{ 
			"targets": [0,5],
			"orderable": false
		}]
	});
});

$("#AddBtn").click(function(){
	clear_data_form();
	$("#FormModal").modal('show');
});

$("#ResetBtn").click(function(){
	clear_data_form();
});

$("#DataForm").on('submit',(function(e){
	e.preventDefault();
	var formData = new FormData($("#DataForm")[0]);
	$.ajax({
		url: "<?= base_url().'add_edit_leave_request' ?>",
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
				$('#DataTable').DataTable().ajax.reload(null, false);
				toastr.success(data['msg']);
				$("#FormModal").modal('hide');
			}
		},
		complete: function(data) {
			$("#DataForm [type='submit']").attr('disabled', false);
		},
	});
}));

$(document).on("click",".delete_data",function(){
	var val = confirm("Are You Sure to Delete !!!");
	if(val==true){
		$.ajax({
			url: "<?= base_url().'delete_leave_request' ?>",
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
	$('#row_id').val($(this).attr('data-id'));
	$('#request_emp_id').val($(this).attr('data-emp'));
	$('#request_leave_category').val($(this).attr('data-category'));
	$('#request_start_date').val($(this).attr('data-start'));
	$('#request_end_date').val($(this).attr('data-end'));
	$('#request_reason').val($(this).attr('data-reason'));
	
	if($(this).attr('data-type')==1){
		$("#request_leave_type").prop("checked",true);
	}else{
		$("#request_leave_type").prop("checked",true);
	}
	
	if($(this).attr('data-img')!=""){
		$("#AttachmentDiv").html($(this).attr('data-img'));
	}
	
	$("#FormModalHeading").html('Edit Leave Request');
	$("#DataForm [type='submit']").html('Update');
	$("#FormModal").modal('show');
});

function clear_data_form(){
	$('#row_id').val('');
	$("#AttachmentDiv").empty();
	
	$("#FormModalHeading").html('Add Leave Request');
	$("#DataForm [type='submit']").html('Submit');
	$("#DataForm").trigger('reset');
}
</script>