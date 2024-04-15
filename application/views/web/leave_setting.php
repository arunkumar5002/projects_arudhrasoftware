
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
	<script src="js/addons/rating.js"></script>

<?php echo load_datatables(); ?>

<style>
#FormModalHeading{
	margin-bottom:-5px;
}
</style>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row" style="margin-bottom:1.5rem!important;">
                <div class="col-sm-6">
                   
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">HR</a></li>
                        
                    </ol>
                </div>
            </div>
			<div class="row">
		
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-md-12 col-sm-12 col-12 text-right">
									<button type="button" id="AddBtn" class="btn btn-info btn-sm AddBtn"><i class="fa fa-plus "></i> New</button>
									<hr/>
								</div>
								<div class="col-md-12 col-sm-12 col-12">
									<div class="table-responsive">
										<table class="table table-bordered" id="DataTable" width="100%">
											<thead>
												<tr>
													<th width="8%">S.No</th>
													<th width="15%">Name</th>
													<th width="15%">Rate Type </th>
													<th width="13%">Rate </th>
													<th width="13%">Hour </th>
													<th width="13%">Amount </th>
													<th width="10%">Status</th>
													<th width="15">Action</th>
															
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
    </section>
</div>

<div class="modal fade show" id="FormModal" aria-modal="true" role="dialog">
	<div class="modal-dialog modal-lg">
		<form id="DataForm" autocomplete="OFF">
			<input type="hidden" name="row_id" id="row_id" />
			<div class="modal-content">
				<div class="modal-header">
					<h4 id="FormModalHeading">Add Over Time</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<h4>  </h4>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label class="form-check-label"><b>Employee Name</b></label>
								<select class="form-control form-control-sm select2" required="" name="employee_id" id="employee_id">
									<option value="">-- Select Employee --</option>
									<?php
										foreach($employees as $key => $value){
											echo "<option value=".$value->employee_id.">".$value->employeename." </option>";
										}
									?>
                                </select>
							</div>
						</div>
							<div class="col-md-4">
							<div class="form-group">
								<label class="form-check-label"> <b> Rate Type </b></label>
				<select class="form-control form-control-sm" name="rate_type" id="	rate_type" >
									<option value=''>-- Select Type --</option>
									<option value='Public Holiday 1.5x'>Public Holiday 1.5x</option>
									<option value='Rest Day OT 2.0x'>Rest Day OT 2.0x</option>
									<option value='Normal OT 1.5x'>Normal OT 1.5x</option>
									
								</select>
							</div>
						</div>
						
						<div class="col-md-4">
							<div class="form-group">
							<label  class="form-check-label"> <b>Rate </b>
                                   <span class="required">*</span>
                                </label>
                                    <input type="text" name="rate" id="rate" class="form-control form-control-sm rated"
                                         required="" autocomplete="off">
							</div>
						</div>
						
							<div class="col-md-4">
							<div class="form-group">
							<label for="" class="form-check-label"> <b>Total OT Hours </b>
                                   <span class="required">*</span>
                                </label>
                                    <input type="text" id="total_hours" name="total_hours" class="form-control form-control-sm rated"
                                         required="" autocomplete="off">
							</div>
						</div>
						
						
							<div class="col-md-4">
							<div class="form-group">
							<label for="" class="form-check-label"> <b>Total OT Amount </b>
                                   <span class="required">*</span>
                                </label>
                                    <input type="text" id="amount" name="amount" class="form-control form-control-sm "
                                         required="" autocomplete="off">
							</div>
						</div>
						
								<div class="col-md-4">
							<div class="form-group">
								<label class="form-check-label"> <b> Status </b></label>
				<select class="form-control form-control-sm" name="ot_status" id="	ot_status" required>
									<option value=''>-- Select Status --</option>
									<option value='Active'>Active</option>
									<option value='Inactive'>Inactive</option>
								</select>
							</div>
						</div>	
			
					</div>
				</div>
				<div class="modal-footer" style="text-align:left !important;">
					<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close </button>
					<button type="submit" class="btn btn-success btn-sm">Submit</button>
					<button type="reset" class="btn btn-danger btn-sm">Reset</button>
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
		"order": [[ 1, "ASC" ]],
		'ajax': {
			'url':	"<?= base_url().'list_leave_setting' ?>",
			'type':	"POST"
		},
		"columnDefs": [{
			"targets": [0,5],
			"orderable": false
		}]
	});
});


$(".AddBtn").click(function(){

	$("#FormModal").modal('show');
});

$("#ResetBtn").click(function(){
	clear_data_form();
});

$("#DataForm").on('submit',(function(e){
	e.preventDefault();
	var formData = new FormData($("#DataForm")[0]);
	$.ajax({
		url: "<?= base_url().'add_edit_leave_setting' ?>",
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
			url: "<?= base_url().'delete_leave_setting' ?>",
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
	$('#row_id').val($(this).attr('data-id'));
	$('#employee_id').val($(this).attr('data-empid'))
	$('#rate_type').val($(this).attr('data-type'));
	$('#rate').val($(this).attr('data-rat'));
	$('#total_hours').val($(this).attr('data-total'));
	$('#amount').val($(this).attr('data-amt'));

	$('#ot_status').val($(this).attr('data-status'));
	
	window.scroll({top: 0, behavior: "smooth"})
});

function clear_data_form(){
	$('#row_id').val('');
	$("#DataForm [type='submit']").html('Submit');
	$("#DataForm").trigger('reset');
}


</script>
<script>

 
/*$(document).on("keyup",".rated",function(){
	
	var rated = $("#rate").val();
	var total_hours = $("#total_hours").val();
	
	if(rated > 0 && total_hours > 0){
		$("#amount").val((rated/total_hours).toFixed());
	}else{
		$("#amount").val("");
	}
	
});*/

</script>