<?php echo load_datatables(); ?>
<style>
#FormModalHeading{
	margin-bottom:-5px;
}
.btn-ttm {
    margin-left: 10px;
}

input[type=checkbox], input[type=radio] {

margin-left: 20px;
</style>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row" style="margin-bottom:1.5rem!important;">
                <div class="col-sm-6">
                    <h1>Sales Invoice</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Settings</a></li>
                      
                    </ol>
                </div>
            </div>
			<div class="row">
			<div class="col-12">
	        <div class="card">
						<div class="card-body">
                  
                          
								<div class="col-md-12 col-sm-12 col-12 text-right">
								 
								 <a class='btn btn-info btn-sm DTTT_button DTTT_button_copy newvoucher' style='padding:5px 10px 5px 10px;cursor:pointer' href='<?php echo base_url()?>sales/salesinvoice'><i class="fa fa-plus"></i> New </a> 
								 <a class='btn btn-info btn-sm DTTT_button DTTT_button_copy editinvoice' style='padding:5px 10px 5px 10px;cursor:pointer' href='#'><i class="far fa-edit"></i> Edit</a>
								 
								 <a class='btn btn-info btn-sm DTTT_button DTTT_button_copy deleteinvoice' style='padding:5px 10px 5px 10px;cursor:pointer' href='#'><i class="fa fa-trash"></i> Delete</a> 
								 
								 <a class='btn btn-info btn-sm DTTT_button DTTT_button_copy viewinvoice' style='padding:5px 10px 5px 10px;cursor:pointer' href='#'><i class="far fa-eye"></i> View </a> 
								 
								 <a class='btn btn-info btn-sm btn btn-info btn-sm DTTT_button DTTT_button_copy printPurchaseOrder' style='padding:5px 10px 5px 10px;cursor:pointer' href='#'><i class="fa fa-print"></i> Print </a> 
								 
								 <!-- <a class='btn btn-info btn-sm DTTT_button DTTT_button_copy pdfquote' style='padding:5px 10px 5px 10px;cursor:pointer' href='#'><i class="fa fa-file-pdf"></i>  Pdf </a> -->
								 
								 <a class='btn btn-info btn-sm payQuick' style='padding:5px 10px 5px 10px;cursor:pointer'><i class="ion ion-cash"></i> Register Payment</a>
								 
								  <hr/>
								  </div>
								<br>
							
								  <div class="clearfix"></div>
                                    <table id="example" class="table table-striped responsive-utilities jambo_table">
                                        <thead>
                                            <tr class="headings">
                                                <th>
                                                   
                                                </th>
                                                <th>Invoice No </th>
                                                <th>Invoice Date </th>
                                                <th>Customer </th>
                                                <th>Invoice Amount </th>                                          
                                                                                  
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
                                                    <input type="radio" name='salesInvoiceCheck' class="tableflat invoiceid" id='invoice_<?php echo $tmp->salesinvoiceid;?>'>
                                                </td>
                                                <td class=" " align=center><?php echo $tmp->invoicenumber;?></td>
                                                <td class=" " align=center>
													<?php 
														echo date("d-m-Y",strtotime($tmp->invoicedate));
													?>
												</td>
                                                
                                                
                                                <td class=" "><?php echo get_contactname($tmp->customerid);?></td>
                                                
												 <td class=" "><?php echo number_format($tmp->totalamount,2);?></td>
                                                
                                              
                                                <td class=" "><?php echo number_format($tmp->totalamount - get_sales_invoice_paid($tmp->salesinvoiceid),2,".",",");?></td>
                                                <td class=" ">
													<?php 
													if($tmp->totalamount - get_sales_invoice_paid($tmp->salesinvoiceid)){
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
                 
                   
                $(".printPurchaseOrder").click(function(){
				     if($(".invoiceid").is(":checked")){
						  if($(".invoiceid:checked").length == 1){
							  var id = $(".invoiceid:checked").attr("id");
							  id = id.split("_");
							  window.open("<?php echo base_url()?>reports/printSalesInvoice/"+id[1], "", "width=700, height=500");
						  }else{
							  alert("Please select one Order");
						  }
					 }else{
						 alert("Please select one Order");
					 }
			   }); 
			   
			   
                $(".viewinvoice").click(function(){
				     if($(".invoiceid").is(":checked")){
						  if($(".invoiceid:checked").length == 1){
							  var id = $(".invoiceid:checked").attr("id");
							  id = id.split("_");
							 
							  window.location.href = '<?php echo base_url()?>reports/viewSalesInvoice/'+id[1];
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
							 
							  window.location.href = '<?php echo base_url()?>sales/editsalesinvoice/'+id[1];
						  }else{
							  alert("Please select one Invoice");
						  }
					 }else{
						 alert("Please select one Invoice");
					 }
			   }); 
                $(".deleteinvoice").click(function(){
				     if($(".invoiceid").is(":checked")){
						  if($(".invoiceid:checked").length == 1){
							  var id = $(".invoiceid:checked").attr("id");
							  id = id.split("_");
							  e = confirm("Do you want to delete the sales invoice?");
							  if(e)
							  window.location.href = '<?php echo base_url()?>sales/deletesalesinvoice/'+id[1];
						  }else{
							  alert("Please select one Invoice");
						  }
					 }else{
						 alert("Please select one Invoice");
					 }
			   });

                $(".payQuick").click(function(){
				     if($(".invoiceid").is(":checked")){
						  if($(".invoiceid:checked").length == 1){
							  var id = $(".invoiceid:checked").attr("id");
							  id = id.split("_");
							  
							   window.location.href = '<?php echo base_url()?>accounts/salesvoucher/0/0/0/'+id[1];
							  
						  }else{
							  alert("Please select one Invoice");
						  }
					 }else{
						 alert("Please select one Invoice");
					 }
			   }); 			   
                  
				  
				  $(".pdfquote").click(function(){		
						
				      if($(".invoiceid").is(":checked")){
						  if($(".invoiceid:checked").length == 1){
							  var id = $(".invoiceid:checked").attr("id");
							  id = id.split("_");
							  
							   window.location.href = '<?php echo base_url()?>reports/pdfSalesInvoice/'+id[1];
							  
						  }else{
							  alert("Please select one Invoice");
						  }
					 }else{
						 alert("Please select one Invoice");
					 } 
			   }); 
			   
			  
				  
					$('body').keydown(function(event) {
						event.preventDefault();
						if(event.which == 113) { //F2
							window.location.href = '<?php echo base_url()?>sales/salesinvoice';
						}
						else if(event.which == 114) { //F3
							$(".pdfquote").trigger("click");
						}
						else if(event.which == 115) { //F4
							$(".viewinvoice").trigger("click");
						}
						else if(event.which == 119) { //F9
							$(".printPurchaseOrder").trigger("click");
						}
						
					});
					
					
            }); 
        </script>
