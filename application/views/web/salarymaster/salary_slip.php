<?php echo load_datatables(); ?>

	<div class="content-wrapper">
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
                  <div class="col-sm-6">
                      <h1> Salary Slip</h1>
                  </div>
                  <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="#">Home</a></li>
                          <li class="breadcrumb-item active">Salary Slip</a></li>
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
							<div class="col-md-12" style="text-align:right;">
								<input type="button" onclick="printDiv('printableArea')" value="Print" target="_blank" class="btn btn-default"> 
								<input type="button" class='DTTT_button btn btn-default pdfAttendance'  value="Pdf" ><i class="fa fa-file-pdf-o"></i> 
								<br/><br/>
							</div>
						</div>
						<div id="printableArea">
							<div class="container-fluid">
								<div class="row">
									<div class="col-md-12" style="border:2px solid black;">
										<div class="text-center lh-1 mb-2">
											<h3 class="fw-bold" style="border-bottom:2px solid black; padding-top:5px; padding-bottom:8px;"><b>KMT Hospital</b></h3>
											<h4 class="fw-bold" style="border-bottom:2px solid black; padding-top:5px; padding-bottom:8px;"><b>Salary Slip for <h5> <address id="monthyear"></address> <h5> </b></h4>
											
										</div>
									
						
								<div class="row">
									<div class="col-sm-6 invoice-col">
										<address id="EmployeeDiv"  name="employee_div"></address>
									</div>
									<div class="col-sm-6 invoice-col" id="PayRollDiv" name="employee_div"></div>
									<div class="col-sm-6">
										<table class="mt-4 table table-bordered">
											<thead class="bg-dark text-white">
												<tr>
													<th scope="col">Earnings</th>
													<th scope="col">Amount</th>
												</tr>
											</thead>
											<tbody id="EarniningDiv"></tbody>
											<tbody>
												<tr class="border-top">
													<th>Total Gross Salary</th>
													<td class='text-right'><b id="TotalEarnining">1000</b></td>
												</tr>
											</tbody>
										</table>
									</div>
									<div class="col-sm-6">
										<table class="mt-4 table table-bordered">
											<thead class="bg-dark text-white">
												<tr>
													<th scope="col">Deduction</th>
													<th scope="col">Amount</th>
												</tr>
											</thead>
											<tbody id="DeductionDiv"></tbody>
											<tbody>
												<tr class="border-top">
													<th>Total Deduction Salary</th>
													<td class='text-right'><b id="TotalDeduction">1000</b></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
								<div class="row" style="display: inline;">
									<div class="col-md-4">
										<span class="fw-bold"><temp style="font-size:20px;">Net Pay : <b id="TotalGross"></b></temp></span>
									</div>
									<div class="col-md-8">
										<div class="d-flex flex-column"><span>Amount In Words : <b id="TotalWords"></b></span> </div>
									</div>
									</div>
									</div><br/>
									<div class="col-md-12 text-right mt-4">
										<button class="btn btn-success" id="GeneratePayslip" type="button">Submit</button>
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
	$("#InvoiceDiv").hide();
});

$("#DataForm").on('submit',(function(e){
	e.preventDefault();
	var formData = new FormData($("#DataForm")[0]);
	$.ajax({
		url: "<?= base_url().'get_salary_slip' ?>",
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
				
				$("#TotalEarnining").html(data['tot_earn']);
				$("#TotalDeduction").html(data['tot_dedt']);
				$("#TotalGross").html(data['tot_gross']);
				$("#TotalWords").html(data['tot_words']);
				
				$("#monthyear").html(data['month_year']);
				$("#basicsalary").html(data['basic_salary']);
				$("#sio").html(data['sio']);
				$("#limra").html(data['limra']);
				
				$("#InvoiceDiv").show();
				$("#submit").show();
			}
		},
		complete: function(data) {
			$("#DataForm [type='submit']").attr('disabled', false);
		},
	});
}));

$("#GeneratePayslip").click(function(){
	$.ajax({
		url: "<?= base_url().'update_salary_slip' ?>",
		type: "POST",
		data:  { keys1 : $("#search_emp_id").val() , keys2 : $("#search_month").val() },
		dataType: "JSON",
		beforeSend: function() {
			$("#GeneratePayslip").attr('disabled', true);
		},
		success: function(data){
			if(data['status']=="Error"){
				toastr.warning(data['msg']);
			}else{
				toastr.info(data['msg']);
			}
		},
		complete: function(data) {
			$("#GeneratePayslip").attr('disabled', false);
		},
	});
});


$(".pdfAttendance").click(function(){	
		window.location.href = '<?php echo base_url()?>'+"Hr/pdf_salary_slip/"+ $('#search_emp_id').val()+"/" + $('#search_month').val();
	 });
	   
	   
$(".savesalary").click(function(){	
		window.location.href = '<?php echo base_url()?>'+"Hr/add_salary_slip_form/"+ $('#search_emp_id').val()+"/" + $('#search_month').val();
	 });
	   
	   
	   
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
