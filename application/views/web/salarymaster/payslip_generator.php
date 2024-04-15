<?php echo load_datatables(); ?>

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
                        <li class="breadcrumb-item active"><a href="<?= base_url().'leave_request_master' ?>"><?= $page_title ?></a></li>
                    </ol>
                </div>
            </div>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header p-2">
							<ul class="nav nav-pills">
								<li class="nav-item"><a class="nav-link active" href="#timeline" data-toggle="tab"> Payslip Generator</a></li>
							</ul>
						</div>
						<div class="card-body">
							<div class="tab-content">
								<div class="tab-pane active" id="timeline">
									<form id="DataForm" autocomplete="OFF">
										<div class="row">
											<div class="col-md-3 col-sm-12 col-12">
												<select class="form-control form-control-sm select2" id="search_emp_id" name="search_emp_id" required>
													<?php
														if(!empty($list_employee)){
															echo '<option value="">Select Employee</option>';
															foreach($list_employee as $row){
																echo '<option value="'.$row['employee_id'].'">'.$row['emp_id'].' - '.$row['employeename'].'</option>';
															}
														}else{
															echo '<option value="">Employee List Empty</option>';
														}
													?>
												</select>
											</div>
											<div class="col-md-3 col-sm-12 col-12">
												<select class="form-control form-control-sm select2" id="search_month" name="search_month" required>
													<?php
														if(!empty($list_month)){
															echo '<option value="">Select Month</option>';
															foreach($list_month as $row){
																echo '<option value="'.$row['attend_month_year'].'">'.$row['attend_month_year'].'</option>';
															}
														}else{
															echo '<option value="">Month List Empty</option>';
														}
													?>
												</select>
											</div>
											<div class="col-md-2 col-sm-12 col-12">
												<button type="submit" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> Preview</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					
					<div class="invoice p-3 mb-3" id="InvoiceDiv">
						<div class="row">
							<div class="col-12">
								<h4>
									<i class="fas fa-globe"></i> KMT Hospital
								</h4>
							</div>
						</div>
						<div class="row invoice-info">
							<div class="col-sm-4 invoice-col">
								To
								<address id="EmployeeDiv"></address>
							</div>
							<div class="col-sm-4 invoice-col" id="PayRollDiv">
							</div>
						</div>
						<div class="row">
							<div class="col-6 table-responsive" id="EarniningDiv">
							</div>
							<div class="col-6 table-responsive" id="DeductionDiv">
							</div>
						</div>
						<div class="row">
							<div class="col-6"></div>
							<div class="col-6">
								<div class="table-responsive">
									<table class="table">
										<tbody>
											<tr>
												<th style="width:50%">Earnings Total</th>
												<td>$250.30</td>
											</tr>
											<tr>
												<th>Deductions Total</th>
												<td>$10.34</td>
											</tr>
											<tr>
												<th>Total Payable</th>
												<td>$5.80</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="row no-print">
							<div class="col-12">
								<a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
								<button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
									<i class="fas fa-download"></i> Generate PDF
								</button>
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
	$("#InvoiceDiv").hide();
});

$("#DataForm").on('submit',(function(e){
	e.preventDefault();
	var formData = new FormData($("#DataForm")[0]);
	$.ajax({
		url: "<?= base_url().'get_payslip_details' ?>",
		type: "POST",
		data:  formData,
		dataType: "JSON",
		contentType: false,
		cache: false,
		processData:false,
		beforeSend: function() {
			$("#DataForm [type='submit']").attr('disabled', true);
		},
		success: function(data){
			if(data['status']=="Error"){
				toastr.error("Employee Salary Details Need to Verify");
			}else{
				$("#EmployeeDiv").html(data['emp_details']);
				$("#PayRollDiv").html(data['pay_details']);
				$("#EarniningDiv").html(data['ear_details']);
				$("#DeductionDiv").html(data['ded_details']);
				
				$("#InvoiceDiv").show();
			}
		},
		complete: function(data) {
			$("#DataForm [type='submit']").attr('disabled', false);
		},
	});
}));
</script>

<script type="text/javascript">
function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}
</script>