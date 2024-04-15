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
                        <li class="breadcrumb-item"><a href="<?php echo base_url()?>Accounts/suppliervouchers"> Customer Payments</a></li>
                        
                    </ol>
                </div>
            </div>
			
			
			
				<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
						 <form method='post' >
                    <script src="<?php echo base_url()?>site/admin/js/input_mask/jquery.inputmask.js"></script>
					<script>
						$(document).ready(function () {
							$(":input").inputmask();
						});
					</script>
                     <div class="row">
						 
							<div class='col-md-4'>
								<input type='text' class='form-control form-control-sm' placeholder='Voucher Number' name='voucherno'>
							</div>
							<div class='col-md-4'>
								<input type='text' class='form-control form-control-sm' placeholder='From Voucher Date' data-inputmask="'mask': '99.99.9999'" name='startdate' >
							</div>
							<div class='col-md-4'>
								<input type='text' class='form-control form-control-sm' placeholder='To Voucher Date' data-inputmask="'mask': '99.99.9999'" name='enddate'>
							</div>
						
					</div>
					<br>
                     <div class="row">
						 
						 <input type='hidden' value='2' id='vouchertype' name='vouchertype' />
								
								<!--<div class='col-md-4'>
									<select class='form-control' placeholder='Voucher Type' name='vouchertype'>
									<option value=''>Voucher Type</option>
									<option value='1'>Payment</option>
									<option value='2'>Receipt</option>
									<option value='3'>Journal</option>
									<option value='4'>Contra</option>
								</select> 
							</div>-->
							<div class='col-md-4'>
								<input type='text' class='form-control form-control-sm' name='debit' placeholder='Debit' onkeypress="return isNumberKeyPeriod(event)">
							</div>
							<div class='col-md-4'>
								<input type='text' class='form-control form-control-sm' name='credit' placeholder='Credit' onkeypress="return isNumberKeyPeriod(event)">
							</div>
						
					</div>
					<br>
					<div class='row'>
						<div class="col-md-12 col-sm-12 col-xs-12" align='center'>
							<input type='submit' value='Search' style="align-center" class='btn btn-primary btn-sm'>
						</div>					
					</div>
					</form>
						</div>
					</div>
				</div>
			</div>
			
			<!-- 2nd start -->
			
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-md-12 text-right">
																
								 <a class='btn btn-info btn-sm DTTT_button DTTT_button_copy newvoucher' href='<?= base_url().'purchasevoucher' ?>'><i class="fa fa-plus"></i> New </a> 
								
								 <a class='btn btn-info btn-sm DTTT_button DTTT_button_copy printvoucher'><i class="fas fa-print"></i> Print</a> 
								 
								 <a class='btn btn-info btn-sm DTTT_button DTTT_button_copy editvoucher'><i class="fas fa-edit"></i> Edit</a> 
								 
								 <a class='btn btn-info btn-sm DTTT_button DTTT_button_copy deletevoucher'><i class="fas fa-trash"></i> Delete</a>
								
								
								</div> 
								
								<div class="col-md-12 col-sm-12 col-12"><hr/>
									<div class="table-responsive">
										 <table id="example" class="table table-striped responsive-utilities jambo_table">
                                        <thead>
                                            <tr class="headings">
                                                <th> </th>
                                                <th>V.No </th>
                                                <th>V.Type </th>
                                                <th>V.Date </th>
                                                <th>Details </th>       
                                                <th>Total Debit(<?php echo get_currency() ?>) </th>       
                                                <th>Total Credit(<?php echo get_currency() ?>) </th>
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
			
<!---Add1-->


   <style>
		td:nth-child(6n+1) { text-align: right }
		td:nth-child(7n+1) { text-align: right }
	</style>
					<!-- Datatables 
        <script src="<?php echo base_url()?>site/admin/js/datatables/js/jquery.dataTables.js"></script>-->
          <script src="<?php echo base_url()?>site/admin/js/jquery.dataTables.js"></script>
        <script src="<?php echo base_url()?>site/admin/js/datatables/tools/js/dataTables.tableTools.js"></script>
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
			"url": "<?php echo base_url() ?>web/ajaxpurchaseinvoice",
			"type": "POST",
			<?php if(isset($search) && !empty($search)){?>
			"data":{
				<?php if(isset($search['startdate'])){ echo "startdate: '$search[startdate]',";}?>
				<?php if(isset($search['enddate'])){ echo "enddate: '$search[enddate]',";}?>
				<?php if(isset($search['vouchertype'])){ echo "vouchertype: '$search[vouchertype]',";}?>
				<?php if(isset($search['voucherno'])){ echo "voucherno: '$search[voucherno]',";}?>
				<?php if(isset($search['debit'])){ echo "debit: '$search[debit]',";}?>
				<?php if(isset($search['credit'])){ echo "credit: '$search[credit]',";}?>
			 },
			 <?php } ?>
		},
		"columns": [
			{ "data": "check" },
			{ "data": "voucher_no" },
			{ "data": "voucher_type" },
			{ "data": "voucher_date" },
			{ "data": "entry" },
			{ "data": "total_debit" },
			{ "data": "total_credit" }
		]
                }); 
                 $(".DTTT_container").hide();       
                 
                 
                 $("#searchVoucher").click(function(){
					 $.ajax({
						dataType: 'json',
						method: "POST",
						data:{
							draw: '1',
							start: '0',
							length: '5'
						},
						url: "<?php echo base_url() ?>web/ajax",
						success: function (msg){
							var json = jQuery.parseJSON(msg.d);
							fnCallback(json);
							$("#example").show();
						}
					});
				});       
                 
               $(".editvoucher").click(function(){
				     if($(".voucherid").is(":checked")){
						  if($(".voucherid:checked").length == 1){
							  var id = $(".voucherid:checked").attr("id");
							  id = id.split("_");
							 
							  window.location.href = "<?php echo base_url()?>Accounts/purchasevoucher/"+id[1];  
						  }else{
							  alert("Please select one Voucher");
						  }
					 }else{
						 alert("Please select one Voucher");
					 }
			   }); 
			   
                $(".deletevoucher").click(function(){
				     if($(".voucherid").is(":checked")){
							var blkstr = [];
							$(".voucherid:checked").each(function(){
								var id = $(this).attr("id");
								id = id.split("_");
								 blkstr.push(id[1]);
							});
							  ids = blkstr.join("_");
							  
							  e = confirm("Do you want to delete the Sales vouchers?");
							  if(e)
							  window.location.href = "<?php echo base_url()?>accounts/purchasedeleteVoucher/"+ids;  
						
					 }else{
						 alert("Please select one Voucher");
					 }
			   }); 
			   
			   $(".printvoucher").click(function(){
				     if($(".voucherid").is(":checked")){
						  if($(".voucherid:checked").length == 1){
							  var id = $(".voucherid:checked").attr("id");
							  id = id.split("_");
							  window.open("<?php echo base_url()?>reports/printVoucher/"+id[1], "", "width=700, height=500");
							  
						  }else{
							  alert("Please select one Voucher");
						  }
					 }else{
						 alert("Please select one Voucher");
					 }
			   }); 
			   

			       $(".pdfvoucher").click(function(){
				     if($(".voucherid").is(":checked")){
						  if($(".voucherid:checked").length == 1){
							  var id = $(".voucherid:checked").attr("id");
							  id = id.split("_");
							   window.location.href = "<?php echo base_url()?>reports/pdfvoucher/"+id[1];  
						
						  }else{
							  alert("Please select one Voucher");
						  }
					 }else{
						 alert("Please select one Voucher");
					 }
			   }); 

			   <?php
			        if($this->session->flashdata('voucher_created')){
			      ?>
						new PNotify({
							title: 'Voucher',
							text: '<?php echo $this->session->flashdata('voucher_created');?>',
							type: 'success'
						});
				  <?php 
					}
				  ?>
				  
				  
				  $('body').keydown(function(event) {
						if(event.which == 113) { //F2
							window.location.href = '<?php echo base_url()?>accounts/salesvoucher';
						}
						else if(event.which == 115) { //F4
							$(".printvoucher").trigger("click");
						}
						else if(event.which == 119) { //F8
							$(".editvoucher").trigger("click");
						}
						else if(event.which == 120) { //F9
							$(".deletevoucher").trigger("click");
						}else if(event.which == 112) { //F9
							$(".pdfvoucher").trigger("click");
						}
					});
                  
            }); 
        </script>