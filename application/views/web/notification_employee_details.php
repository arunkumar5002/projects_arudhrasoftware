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
                        <li class="breadcrumb-item active"><a href=""><?= $page_title ?></a></li>
                    </ol>
                </div>
            </div>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered" id="DataTable" width="100%">
									<thead>
										<tr>
											<th width="8%">#</th>
											<th width="10%">Employee ID</th>
											<th width="20%">Employee Name</th>
											<th width="15%">Expiry Document Name</th>
											<th width="15%">Expiry Date</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$i=1;
											$result = get_employee_passport_notification();
											if(!empty($result)){
												foreach($result as $row){
													echo '<tr>';
														echo '<td>'.$i.'</td>';
														echo '<td>'.$row['emp_id'].'</td>';
														echo '<td>'.$row['employeename'].'</td>';
														echo '<td>Passport Document</td>';
														echo '<td>'.date('d-m-Y',strtotime($row['passport_expiry_date'])).'</td>';
													echo '</tr>';
													$i++;
												}
											}
											
											$result = get_employee_rp_notification();
											if(!empty($result)){
												foreach($result as $row){
													echo '<tr>';
														echo '<td>'.$i.'</td>';
														echo '<td>'.$row['emp_id'].'</td>';
														echo '<td>'.$row['employeename'].'</td>';
														echo '<td>RP Document</td>';
														echo '<td>'.date('d-m-Y',strtotime($row['rp_expiry_date'])).'</td>';
													echo '</tr>';
													$i++;
												}
											}
											
											$result = get_employee_crp_notification();
											if(!empty($result)){
												foreach($result as $row){
													echo '<tr>';
														echo '<td>'.$i.'</td>';
														echo '<td>'.$row['emp_id'].'</td>';
														echo '<td>'.$row['employeename'].'</td>';
														echo '<td>CRP Document</td>';
														echo '<td>'.date('d-m-Y',strtotime($row['crp_expiry_date'])).'</td>';
													echo '</tr>';
													$i++;
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
    </section>
	
</div>

<script>
$(document).ready(function(){
	$('#DataTable').DataTable();
});
</script>