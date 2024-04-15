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
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Purchasequote</a></li>
                    </ol>
                </div>
            </div>
			
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							
								<div class="col-md-12 text-right">
									<a href="<?php echo base_url()?>sales/salesquote" class="btn btn-info btn-sm newquote" style="margin-left: 488px;"><i class="fa fa-plus"></i>  New</a>
									
									<a href="#" class="btn btn-info btn-sm DTTT_button DTTT_button_copy editquote"><i class="far fa-edit"></i> Edit </a>
									
									<a href="#" class="btn btn-info btn-sm DTTT_button DTTT_button_copy deletequote"><i class="fas fa-trash"></i> Delete </a>
									
									<a href="#" class="btn btn-info btn-sm DTTT_button DTTT_button_copy viewquote"><i class="far fa-eye"></i>  View </a>
									
									<a href="#" class="btn btn-info btn-sm DTTT_button DTTT_button_copy printQuotation"><i class="fas fa-print"></i> Print</a>
									
									<!-- <a href="#" class="btn btn-info btn-sm DTTT_button DTTT_button_copy pdfquote"><i class="far fa-file"></i>  Pdf </a> -->
									
									<hr/>
								</div>
			                   
                                    <table id="example" class="table table-striped responsive-utilities jambo_table">
                                        <thead>
                                            <tr class="headings">
                                                <th>   
                                                </th>
                                                <th>Quote Ref No </th>
                                                <th>Quote Date </th>
                                                <th>Customer </th>
												<th>Amount</th>
												
                                            </tr>
                                        </thead>

                                        <tbody>
                                           <?php
										   if(isset($quotations) && count($quotations)){
											   $i = 1;
											   foreach($quotations as $tmp){
											
										   ?>
                                           
                                            <tr class="odd pointer">
                                                <td>
                                                    <input type="radio" name='salesQuoteCheck' class="tableflat quoteid" id='quote_<?php echo $tmp->salesquoteid;?>'>
                                                </td>
                                                <td class=" "><?php echo $tmp->quotenumber;?></td>
                                                <td class=" " >
													<?php 
														echo date("d-m-Y",strtotime($tmp->quotedate));
													?>
												</td>
                                                
                                                
                                                <td class=" "><?php echo get_contactname($tmp->customerid);?></td>
												<td class=" "><?php echo $tmp->totalamount;?></td>
                                                
												
                                               
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
                        "Search": "Search all columns:"
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
			   
			    $(".editquote").click(function(){
				     if($(".quoteid").is(":checked")){
						  if($(".quoteid:checked").length == 1){
							  var id = $(".quoteid:checked").attr("id");
							  id = id.split("_");
							  
							   window.location.href = '<?php echo base_url()?>sales/editsalesquote/'+id[1];
							  
						  }else{
							  alert("Please select one Quotation");
						  }
					 }else{
						 alert("Please select one Quotation");
					 }
			   }); 
			    $(".deletequote").click(function(){
				     if($(".quoteid").is(":checked")){
						  if($(".quoteid:checked").length == 1){
							  var id = $(".quoteid:checked").attr("id");
							  id = id.split("_");
							  e = confirm("Do you want to delete the quote?");
							  
							  if(e)
							   window.location.href = '<?php echo base_url()?>sales/deletesalesquote/'+id[1];
							  
						  }else{
							  alert("Please select one Quotation");
						  }
					 }else{
						 alert("Please select one Quotation");
					 }
			   }); 


			    $(".pdfquote").click(function(){
				     if($(".quoteid").is(":checked")){
						  if($(".quoteid:checked").length == 1){
							  var id = $(".quoteid:checked").attr("id");
							  id = id.split("_");
							  
							   window.location.href = '<?php echo base_url()?>sales/pdfsaleQuote/'+id[1];
							  
						  }else{
							  alert("Please select one Quotation");
						  }
					 }else{
						 alert("Please select one Quotation");
					 }
			   }); 
			   
                $(".printQuotation").click(function(){
				     if($(".quoteid").is(":checked")){
						  if($(".quoteid:checked").length == 1){
							  var id = $(".quoteid:checked").attr("id");
							  id = id.split("_");
							 
							   window.open("<?php echo base_url()?>sales/printQuotation/"+id[1], "", "width=700, height=500");  
						  }else{
							  alert("Please select one Quotation");
						  }
					 }else{
						 alert("Please select one Quotation");
					 }
			   }); 
			   
			   $(".viewquote").click(function(){
				     if($(".quoteid").is(":checked")){
						  if($(".quoteid:checked").length == 1){
							  var id = $(".quoteid:checked").attr("id");
							  id = id.split("_");
							   window.location.href = '<?php echo base_url()?>sales/viewSalesQuote/'+id[1];
						  }else{
							  alert("Please select one Quotation");
						  }
					 }else{
						 alert("Please select one Quotation");
					 }
			   }); 
                 



					$('body').keydown(function(event) {
						event.preventDefault();
						if(event.which == 113) { //F2
							window.location.href = '<?php echo base_url()?>sales/salesquote';
						}
						else if(event.which == 114) { //F3
							$(".pdfquote").trigger("click");
						}
						else if(event.which == 115) { //F4
							$(".viewquote").trigger("click");
						}
						
						else if(event.which == 119) { //F8
							$(".printQuotation").trigger("click");
						}
					});
					
            }); 
        </script>



