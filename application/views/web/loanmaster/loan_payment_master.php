<?php echo load_datatables(); ?>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
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
								<div class="col-md-6 col-sm-12 col-12">
									<h5>Employee Details</h5>
									<table>
										<tbody>
											<tr>
												<th width="50%">Employee Name</th>
												<td>: <?= $employee_details->employeename ?></td>
											</tr>
											<tr>
												<th>Employee ID</th>
												<td>: <?= $employee_details->emp_id ?></td>
											</tr>
											<tr>
												<th>Mobile Number</th>
												<td>: <?= $employee_details->mobile ?></td>
											</tr>
											<tr>
												<th>Email Address</th>
												<td>: <?= $employee_details->email ?></td>
											</tr>
											<tr>
												<th>Department</th>
												<td>: <?= $emp_department->department_name ?></td>
											</tr>
											<tr>
												<th>Designation</th>
												<td>: <?= $emp_designation->designation_name ?></td>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="col-md-6 col-sm-12 col-12">
									<h5>Loan Details</h5>
									<table>
										<tbody>
											<tr>
												<th width="70%">Loan Amount</th>
												<td>: <b>BD</b> <?= number_format($loan_details->loan_amount) ?></td>
											</tr>
											<tr>
												<th>Installment Month</th>
												<td>: <?= $loan_details->installment_month ?></td>
											</tr>
											<tr>
												<th>EMI Date</th>
												<td>: <?= $loan_details->date_of_request ?></td>
											</tr>
											<tr>
												<th>EMI Amount</th>
												<td>: <b>BD</b> <?= number_format($loan_details->emi) ?></td>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="col-md-12 col-sm-12 col-12"><hr/>
									<form id="DataForm" autocomplete="OFF">
										<input type="hidden" name="payment_loan_id" value="<?= $loan_details->id ?>" />
										<div class="row">
											<div class="col-md-3">
												<div class="form-group">
													<label class="form-check-label">Loan Balance Amount</label>
													<input type="text" class="form-control form-control-sm text-right" name="payment_balance_amount_txt" id="payment_balance_amount_txt" value="<?= number_format($loan_details->loan_balance_amount) ?>" readonly />
													<input type="hidden" name="payment_balance_amount" id="payment_balance_amount" value="<?= $loan_details->loan_balance_amount ?>" />
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label class="form-check-label">Payment Date</label>
													<input type="text" class="form-control form-control-sm datepicker" name="payment_date" required />
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label class="form-check-label">Payment Amount</label>
													<input type="text" class="form-control form-control-sm text-right" onkeypress='return Validate(event);' name="payment_amount" required />
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label class="form-check-label">Payment Method</label>
													<select class="form-control form-control-sm" name="payment_method" required >
														<option value="">-- Select Payment Method --</option>
														<option value="Bank Transfer">Bank Transfer</option>
														<option value="Cash">Cash</option>
														<option value="UPI">UPI</option>
														<option value="Salary Detection">Salary Detection</option>
													</select>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label class="form-check-label">Payment Details</label>
													<input type="text" class="form-control form-control-sm" name="payment_details" />
												</div>
											</div>
											<div class="col-md-12">
												<button class="btn btn-success btn-sm" type="submit">Submit</button>
												<button class="btn btn-danger btn-sm" type="button" id="ResetBtn">Reset</button>
											</div>
										</div>
									</form>
								</div>
								<div class="col-md-12 col-sm-12 col-12"><hr/>
									<div class="table-responsive">
										<table class="table table-bordered" id="DataTable" width="100%">
											<thead>
												<tr>
													<th width="5%">S.No</th>
													<th width="10%">Paid Date</th>
													<th width="15%">Paid Amount</th>
													<th width="15%">Paid Method</th>
													<th width="55%">Paid Details</th>
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

<script>
$(document).ready(function(){
	$('#DataTable').DataTable({
		'processing': true,
		'serverSide': true,
		'serverMethod': 'post',
		"order": [[ 1, "desc" ]],
		'ajax': {
			'url':	"<?= base_url().'list_loan_details' ?>",
			'type':	"POST",
			'data': function (d) {
				d.loan_id = <?= $loan_details->id ?>
			},
		},
		"columnDefs": [{ 
			"targets": [0],
			"orderable": false
		}]
	});
});

$("#DataForm").on('submit',(function(e){
	e.preventDefault();
	var formData = new FormData($("#DataForm")[0]);
	$.ajax({
		url: "<?= base_url().'add_edit_loan_payment' ?>",
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
				
				$("#payment_balance_amount_txt").val(data['balance']);
				$("#payment_balance_amount").val(data['balance']);
				reset_form();
				$('#DataTable').DataTable().ajax.reload(null, false);
			}
		},
		complete: function(data) {
			$("#DataForm [type='submit']").attr('disabled', false);
		},
	});
}));

$("#ResetBtn").click(function(){
	reset_form();
});

function reset_form(){
	$("#payment_date").val('');
	$("#payment_amount").val('');
	$("#payment_method").val('');
	$("#payment_details").val('');
}
</script>