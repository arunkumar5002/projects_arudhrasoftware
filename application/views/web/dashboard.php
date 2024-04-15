<?php echo load_datatables(); ?>
<div class="content-wrapper">
    <section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Dashboard</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
						<li class="breadcrumb-item active">Dashboard</li>
					</ol>
				</div>
			</div>
		</div>
    </section>
	 <style>
						.tile-stats .count{
							  font-size: 24px;
							  font-weight:bold !important;		
color:#fff;							  
						}
						.tile-stats .txt{
							  margin-left:10px;
							  font-weight:bold !important;							  
							  font-size: 18px;color:#fff;
						}
						.tile-stats .icon i {
							    font-size: 44px;
							    vertical-align: top !important;
							    margin-left: 8px;
								margin-top: 3px;color:#fff;
						}
						.headings th {
							
							font-size:13px;
						}
                        </style>

    <section class="content" style="padding: 0px 30px 0px 30px;">
		<div class="container-fluid">
			<?php if($this->session->userdata('user_emp')==1){ ?>
			<?php }else{ ?>
			<div class="row">
				<div class="col-lg-3 col-6">
					<div class="small-box bg-danger">
						<div class="inner">
							<h3><?php echo get_total_payables();?></h3>
							<p>Total Payables</p>
						</div>
						  <div class="icon"><i class="ion ion-cash"></i></div>
						  <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<div class="col-lg-3 col-6">
					<div class="small-box bg-success">
						<div class="inner">
							<h3><?php echo get_total_receivables();?></h3>
							<p>Total Receivables</p>
						</div>
						<div class="icon"><i class="ion ion-cash"></i></div>
						<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<div class="col-lg-3 col-6">
					<div class="small-box bg-warning">
						<div class="inner">
							<h3><?php echo get_employees_count();?></h3><p>Employee</p>
						</div>
						<div class="icon"><i class="ion ion-person-add"></i></div>
						<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<div class="col-lg-3 col-6">
					<div class="small-box bg-info">
						<div class="inner">
							<h3>65</h3>
							<p>Loan Request</p>
						</div>
						<div class="icon"><i class="ion ion-pie-graph"></i></div>
						<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
			</div>
			<?php } ?>
        </div>
    </section>
	
	<div class="container" style="padding: 0px 20px 0px 20px;">
	
	<div class="col-md-12">
        <div class="x_panel">
        <div class="x_title">
        <h3>Purchase - Sales Comparison</h3>
                                    
        <div class="clearfix"></div>
        </div>
        <div class="x_content">
        <canvas id="canvas_bar" width="900" height="250"></canvas>
        </div>
        </div>
    </div>
	
	<h3>Invoice Payments</h3>
                    <div class="col-md-12" style="margin-bottom:20px;">
                            <div class="x_panel">
                                <div class="x_content">
								  <div class="clearfix"></div>
                                    <table id="example" class="table table-striped responsive-utilities jambo_table">
                                        <thead>
                                            <tr class="headings" style="background-color:#17A2B8;color:white;">
                                                <th>S.No </th>
                                                <th>Date</th>        
                                                <th>Customer Name </th>
                                                <th>Invoice No </th>            
                                                <th>Inv Amt </th>
                                                <th>Paid Amt </th>
                                                <th>Pending Amt </th>
                                                <th>Status </th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
					</div>
	
</div>
<script>
	
	var barChartData = {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug",  "Sep",  "Oct",  "Nov",  "Dec"],
            datasets: [
                {
                    fillColor: "#26B99A", //rgba(220,220,220,0.5)
                    strokeColor: "#26B99A", //rgba(220,220,220,0.8)
                    highlightFill: "#36CAAB", //rgba(220,220,220,0.75)
                    highlightStroke: "#36CAAB", //rgba(220,220,220,1)
                    data: [<?php echo $purchase; ?>]
            },
                {
                    fillColor: "#03586A", //rgba(151,187,205,0.5)
                    strokeColor: "#03586A", //rgba(151,187,205,0.8)
                    highlightFill: "#066477", //rgba(151,187,205,0.75)
                    highlightStroke: "#066477", //rgba(151,187,205,1)
                    data: [<?php echo $sales; ?>]
            }
        ],
        }
	 $(document).ready(function () {
            new Chart($("#canvas_bar").get(0).getContext("2d")).Bar(barChartData, {
                tooltipFillColor: "rgba(51, 51, 51, 0.55)",
                barDatasetSpacing: 12,
                barValueSpacing: 5
            });
        });
</script>

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
                        "bFilter": false,
                    "aoColumnDefs": [
                        {
                            'bSortable': false,
                            'aTargets': [0]
                        }
				],
                    'iDisplayLength': 10,
                    "sPaginationType": "full_numbers",
                    
                    "dom": 'T<"clear">lfrtip',
                    "processing": true,
		"serverSide": true,
		"ajax": {
			"url": "<?php echo base_url() ?>web/ajaxsalesinvoicedetails",
			"type": "POST",
		
		},
		"columns": [
			{ "data": "check" },
			{ "data": "invoice_date" },			
			{ "data": "customername" },
			{ "data": "invoice_no" },
			{ "data": "invoice_amt" },
			{ "data": "paid_amt" },
			{ "data": "pending_amt" },
			{ "data": "status" }
		]
                }); 
                 $(".DTTT_container").hide();       
                 
                 
            }); 
        </script>

        