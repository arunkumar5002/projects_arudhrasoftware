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
                        <li class="breadcrumb-item active"><a href="<?= base_url().'leave_request_master' ?>"><?= $page_title ?></a></li>
                    </ol>
                </div>
            </div>
			
			
				<!-- employee list start
			
		<section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-3 col-sm-6 col-12">
						<div class="info-box">
							<div class="info-box-content">
								<span class="info-box-text" style="font-size:20px;color:#009FBD;"><b>Today Presents</b></span>
								<span class="info-box-number" style="font-size:20px;color:#009FBD;">12 / 30</span>
							</div>
						</div>
					</a>
				</div>
				<div class="col-md-3 col-sm-6 col-12">
						<div class="info-box">
							<div class="info-box-content">
								<span class="info-box-text" style="font-size:20px;color:#D27685;"><b>Planned Leaves</b></span>
								<span class="info-box-number"  style="font-size:20px;color:#D27685;">8  - Today</span> 
							</div>
						</div>
					</a>
				</div>
				<div class="col-md-3 col-sm-6 col-12">
						<div class="info-box">
							<div class="info-box-content">
								<span class="info-box-text" style="font-size:20px;color:#A9907E;"><b>Unplanned Leaves</b></span>
								<span class="info-box-number" style="font-size:20px;color:#A9907E;">0  - Today</span>
							</div>
						</div>
					</a>
				</div>
				
				
								
				<div class="col-md-3 col-sm-6 col-12">
						<div class="info-box">
							<div class="info-box-content">
								<span class="info-box-text" style="font-size:20px;color:#AA77FF;"><b>Pending Requests</b></span>
								<span class="info-box-number" style="font-size:20px;color:#AA77FF;"></span>
							</div>
						</div>
					</a>
				</div>
				
			</div>
			</div>
			</div>
			
			
			 employee list end-->
			
			
			
			
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered" id="DataTable" width="100%">
									<thead>
										<tr>
											<th width="8%">#</th>
											<th width="20%">Employee Name</th>
											<th width="15%">Leave Category</th>
											<th width="15%">No of Leave Days</th>
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
    </section>
	
</div>

<script>
$(document).ready(function(){
	$('#DataTable').DataTable({
		'processing': true,
		'serverSide': true,
		'serverMethod': 'post',
		"order": [[ 5, "desc" ]],
		'ajax': {
			'url':	"<?= base_url().'list_leave_approve' ?>",
			'type':	"POST"
		},
		"columnDefs": [{ 
			"targets": [0,6],
			"orderable": false
		}]
	});
});

$(document).on("click",".leave_approve_request",function(){
	var val = confirm("Are You Sure to Approve Leave Request");
	if(val==true){
		$.ajax({
			url: "<?= base_url().'approve_leave_request' ?>",
			type: "POST",
			data:  { keys : $(this).attr('data-id') },
			dataType: "JSON",
			success: function(data)
			{
				if(data['status']=="Error"){
					toastr.warning(data['msg']);
				}else{
					toastr.info(data['msg']);
					$('#DataTable').DataTable().ajax.reload(null, false);
				}
			}
		});
	}
});

$(document).on("click",".leave_reject_request",function(){
	var val = confirm("Are You Sure to Reject Leave Request");
	if(val==true){
		$.ajax({
			url: "<?= base_url().'reject_leave_request' ?>",
			type: "POST",
			data:  { keys : $(this).attr('data-id') },
			dataType: "JSON",
			success: function(data)
			{
				if(data['status']=="Error"){
					toastr.warning(data['msg']);
				}else{
					toastr.info(data['msg']);
					$('#DataTable').DataTable().ajax.reload(null, false);
				}
			}
		});
	}
});
</script>