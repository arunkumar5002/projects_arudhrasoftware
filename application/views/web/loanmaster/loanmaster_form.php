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
                    <h1><?= $page_title ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">HR</a></li>
                        <li class="breadcrumb-item active"><a href="<?= base_url().'loan_master' ?>"><?= $page_title ?></a></li>
                    </ol>
                </div>
            </div>
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
													<th width="8%">S.No</th>
													<th width="12%">Loan Date</th>
													<th width="12%">Emp Name</th>
													<th width="10%">Loan Amount <b>[BD]</b></th>
													<th width="10%">Installment Month</th>
													<th width="10%">EMI Amount <b>[BD]</b></th>
													<th width="10%">Balance Amount <b>[BD]</b></th>
													<th width="10%">Status</th>
													<th width="20%">Action</th>
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
					<h4 id="FormModalHeading"></h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label class="form-check-label">Employee Name</label>
								<select class="form-control form-control-sm select2" required="" name="employee_id" id="employee_id">
									<option value="">-- Select Employee --</option>
									<?php
										foreach($employees as $key => $value){
											echo "<option value=".$value->employee_id." data-crp='".$value->crp_number."' data-desi='".$value->designation_name."' data-pre='".$value->date_of_request."'>".$value->employeename." </option>";
										}
									?>
                                </select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="form-check-label">CPR</label>
								<input type="text" class="form-control form-control-sm" name="crp_number" id="crp_number"  />
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="form-check-label">Designation</label>
								<input type="text" class="form-control form-control-sm" name="designation_name" id="designation_name"  />
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="form-check-label">Monthly Salary</label>
								<input type="text" class="form-control form-control-sm" name="monthly_salery" id="monthly_salery"  />
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="form-check-label">EMI Date</label>
								<input type="text" class="form-control form-control-sm datepicker" name="date_of_request" id="date_of_request"  />
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="form-check-label">Loan Amount</label>
								<input type="text" class="form-control form-control-sm loanamount" name="loan_amount"  id="loan_amount"  />
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="form-check-label">Installment Month</label>
								<input type="text" class="form-control form-control-sm loanamount" name="installment_month" id="installment_month"  />
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="form-check-label">EMI</label>
								<input type="text" class="form-control form-control-sm" name="emi" id="emi" readonly />
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="form-check-label">Accounts Feedback</label>
								<input type="text" class="form-control form-control-sm" name="accounts_feedback" id="accounts_feedback" />
							</div>
						</div>
                        <div class="col-md-4">
							<div class="form-group">
								<label class="form-check-label">Previous Loan Date</label>
								<input type="text" class="form-control form-control-sm" name="previous_loan_date" id="previous_loan_date" readonly  />
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="form-check-label">Status</label>
								<select class="form-control form-control-sm" name="loan_status" id="department_status" required>
									<option value=''>-- Select Status --</option>
									<option value='Active'>Active</option>
									<option value='Inactive'>Inactive</option>
								</select>
							</div>
						</div>
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
		"order": [[ 1, "DESC" ]],
		'ajax': {
			'url':	"<?= base_url().'list_loan_master' ?>",
			'type':	"POST"
		},
		"columnDefs": [{
			"targets": [0,8],
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
		url: "<?= base_url().'add_edit_loan_master' ?>",
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
			url: "<?= base_url().'delete_loan_master' ?>",
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
	$('#employee_id').val($(this).attr('data-empid')).trigger('change');
	$('#crp_number').val($(this).attr('data-crp'));
	$('#designation_name').val($(this).attr('data-design'));
	$('#monthly_salery').val($(this).attr('data-month'));
	$('#date_of_request').val($(this).attr('data-date'));
	$('#loan_amount').val($(this).attr('data-loan'));
	$('#installment_month').val($(this).attr('data-amount'));
	$('#emi').val($(this).attr('data-accounts'));
	$('#accounts_feedback').val($(this).attr('data-feed'));
	$('#loan_status').val($(this).attr('data-status'));
	
	
	$("#FormModalHeading").html('Edit Loan Request');
	$("#DataForm [type='submit']").html('Update');
	$("#FormModal").modal('show');
});

function clear_data_form(){
	$('#row_id').val('');
	$('#employee_id').val('').trigger('change');
	$("#FormModalHeading").html('Add Loan Request');
	$("#DataForm [type='submit']").html('Submit');
	$("#DataForm").trigger('reset');
}

$(function() {
        $(".datepicker").datepicker({
            showOtherMonths: true,
            selectOtherMonths: true
        });
    });
</script>

<script>

 
$(document).on("keyup",".loanamount",function(){
	
	var loanamount = $("#loan_amount").val();
	var installment_month = $("#installment_month").val();
	
	if(loanamount > 0 && installment_month > 0){
		$("#emi").val((loanamount/installment_month).toFixed());
	}else{
		$("#emi").val("");
	}
	
});


 $("#employee_id").change(function(){
	var id = $(this).val();
	if(id!=""){
		$("#crp_number").val($(this).find(':selected').data('crp'));
	}else{
		$("#crp_number").val('');
	}
});

$("#employee_id").change(function(){
	var id = $(this).val();
	if(id!=""){
		$("#designation_name").val($(this).find(':selected').data('desi'));
	}else{
		$("#designation_name").val('');
	}
});

$("#employee_id").change(function(){
	var id = $(this).val();
	if(id!=""){
		$("#previous_loan_date").val($(this).find(':selected').data('pre'));
	}else{
		$("#previous_loan_date").val('');
	}
});



</script>
