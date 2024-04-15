<?php echo load_datatables(); ?>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

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
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Purchase Invoice</a></li>
                    </ol>
                </div>
            </div>
			
				<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
						
								<div class="col-md-12 text-right">
									<a href="<?php echo base_url() ?>Purchase/purchase_invoice" class="btn btn-info btn-sm" ><i class="fa fa-plus"></i> New</a>
									
									<a href="#" class="btn btn-info btn-sm DTTT_button DTTT_button_copy viewinvoice"><i class="fas fa-eye"></i> View</a>
									
									<a class='btn btn-info btn-sm editinvoice' href='#'><i class="far fa-edit"></i> Edit</a>
									
									<a href="#" class="btn btn-info btn-sm deleteinvoice"><i class="fas fa-trash"></i> Delete</a>
									
								    <a href="#" class="btn btn-info btn-sm printinvoice"><i class="fas fa-print"></i> Print</a>
									
									<a class='btn btn-info btn-sm payQuick'><i class="ion ion-cash"></i> Register Payment</a>
									
								  <hr/>
								</div>
					<div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                    </div>
                    <div class="row">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                              
                                <div class="x_content">
								 <div style='height:29px;float:left;margin-bottom:1em'>
							 
								
								 </div>
                                       <table id="example" class="table table-striped responsive-utilities jambo_table">
                                        <thead>
                                            <tr class="headings">
                                                <th>
                                                   
                                                </th>
                                                <th>Invoice No </th>
                                                <th>Invoice Date </th>
                                                <th>Supplier </th>
                                                <th>Invoice Amount </th>             
                                                <th>Paid Amount </th>              
                                                <th>Balance Amount </th>
                                                <th>Status </th>   
                                            </tr>
                                        </thead>

                                        <tbody>
                                           <?php
										   if(isset($invoices) && count($invoices)){
											   $i = 1;
											   foreach($invoices as $tmp){
											
										   ?>
                                            <tr class="odd pointer">
                                                <td>
                                                    <input type="radio" name='purchaseInvoiceCheck' class="tableflat invoiceid" id='invoice_<?php echo $tmp->purchaseinvoiceid;?>'>
                                                </td>
                                                <td class=" " align=left><?php echo $tmp->invoicenumber;?></td>
                                                <td class=" " align=left>
													<?php 
														echo date("d-m-Y",strtotime($tmp->invoicedate));
													?>
												</td>
                                                
                                                
                                                <td class=" " align=left><?php echo get_contactname($tmp->customerid);?></td>
                                                
												<td class=" " align=right><?php echo number_format($tmp->totalamount,2);?></td>
												
												
												
												<td class=" " align=right><?php echo number_format(get_purchase_invoice_paid($tmp->purchaseinvoiceid),2);?></td>
												<td class=" " align="right"><?php echo number_format($tmp->totalamount - get_purchase_invoice_paid($tmp->purchaseinvoiceid),2,".",",");?></td>
												<td class=" ">
													<?php 
													if($tmp->totalamount - get_purchase_invoice_paid($tmp->purchaseinvoiceid)){
														echo "Open";
													}else{
														echo "Closed";
													}
													?>
												</td>
												
												
												
												
                                            </tr>
                                           <?php
										   	   
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


								</div>
						</div>
					</div>
				</div>
			</div>
			      
			
			
			
			
			
			
			
			
			
			
			
	
    </section>
</div>

	
				<!-- Datatables -->
        <script src="<?php echo base_url()?>site/admin/js/datatables/js/jquery.dataTables.js"></script>
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
                    "oLanguage": {
                        "sSearch": "Search all columns:"
                    },
                    "aoColumnDefs": [
                        {
                            'bSortable': false,
                            'aTargets': [0]
                        }
				],
                    'iDisplayLength': 10,
                    "sPaginationType": "full_numbers",
                    "dom": 'T<"clear">lfrtip'
                }); 
                 $(".DTTT_container").hide();              
                 
                 
                $(".viewinvoice").click(function(){
				     if($(".invoiceid").is(":checked")){
						  if($(".invoiceid:checked").length == 1){
							  var id = $(".invoiceid:checked").attr("id");
							  id = id.split("_");
							 
							   window.location.href = '<?php echo base_url()?>Reports/viewPurchaseInvoice/'+id[1];
						  }else{
							  alert("Please select one Invoice");
						  }
					 }else{
						 alert("Please select one Invoice");
					 }
			   }); 
                $(".editinvoice").click(function(){
				     if($(".invoiceid").is(":checked")){
						  if($(".invoiceid:checked").length == 1){
							  var id = $(".invoiceid:checked").attr("id");
							  id = id.split("_");
							 
							   window.location.href = '<?php echo base_url()?>purchase/editPurchaseInvoice/'+id[1];
						  }else{
							  alert("Please select one Invoice");
						  }
					 }else{
						 alert("Please select one Invoice");
					 }
			   }); 
			  
			             
                $(".printinvoice").click(function(){
				     if($(".invoiceid").is(":checked")){
						  if($(".invoiceid:checked").length == 1){
							  var id = $(".invoiceid:checked").attr("id");
							  id = id.split("_");
							  window.open("<?php echo base_url()?>Reports/printinvoice/"+id[1], "", "width=700, height=500, scrollbars=yes");
						  }else{
							  alert("Please select one invoice");
						  }
					 }else{
						 alert("Please select one invoice");
					 }
			   }); 
			
            }); 
			
			$(".payQuick").click(function(){
				     if($(".invoiceid").is(":checked")){
						  if($(".invoiceid:checked").length == 1){
							  var id = $(".invoiceid:checked").attr("id");
							  id = id.split("_");
							  
							   window.location.href = '<?php echo base_url()?>Accounts/purchasevoucher/0/0/0/'+id[1];
							  
						  }else{
							  alert("Please select one Invoice");
						  }
					 }else{
						 alert("Please select one Invoice");
					 }
			   });
        </script>


