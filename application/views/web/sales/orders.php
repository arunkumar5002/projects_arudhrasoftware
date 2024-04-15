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
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Sales Order</a></li>
                    </ol>
                </div>
            </div>
			
				<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
						
								<div class="col-md-12 col-sm-12 col-12 text-right">
									<a href="<?php echo base_url() ?>sales/salesorder" class="btn btn-info btn-sm" style="margin-left: 488px;"><i class="fa fa-plus"></i> New</a>
									
									
									<a href="#" class="btn btn-info btn-sm DTTT_button DTTT_button_copy editorder"><i class="far fa-edit"></i> Edit</a>
									<a href="#" class="btn btn-info btn-sm DTTT_button DTTT_button_copy deleteorder"><i class="fas fa-trash"></i> Delete</a>
									
									<a href="#" class="btn btn-info btn-sm DTTT_button DTTT_button_copy printsalesOrder"><i class="fas fa-print"></i> Print</a>
									
								    <!-- <a class='btn btn-info btn-sm DTTT_button DTTT_button_copy pdfsalesorder' style='padding:5px 10px 5px 10px;cursor:pointer'><i class="fa fa-file-pdf-o"></i> Pdf</a> -->
									
									<a href="#" class="btn btn-info btn-sm DTTT_button DTTT_button_copy vieworder"><i class="fas fa-eye"></i> View</a>
									
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
                                                <th>Order No </th>
                                                <th>Quote No </th>
                                                <th>Order Date </th>
                                                <th>Customer </th>
                                                <th>Total </th>                                                   
                                             
                                            </tr>
                                        </thead>

                                        <tbody>
                                           <?php
										   if(isset($orders) && count($orders)){
											   $i = 1;
											   foreach($orders as $tmp){
											
										   ?>
                                           
                                            <tr class="odd pointer">
                                                <td>
                                                    <input type="radio" name='salesOrderCheck' class="tableflat orderid" id='order_<?php echo $tmp->salesorderid;?>'>
                                                </td>
                                                <td class=" " align=center><?php echo $tmp->salesordernum;?></td>
                                                <td class=" " align=center><?php echo $tmp->quoteno;?></td>
                                                <td class=" " align=center>
													<?php 
														echo date("d-m-Y",strtotime($tmp->issuedate));
													?>
												</td>
                                                
                                                
                                                <td class=" "><?php echo get_contactname($tmp->customer);?></td>
                                                
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
				 </div>

                     

                    </div>
                </div>
				 </div>


								</div>
						</div>
					</div>
				      
			

					<!-- Datatables -->
        <script src="<?php echo base_url()?>site/admin/js/datatables/js/jquery.dataTables.js"></script>
        <script src="<?php echo base_url()?>site/admin/js/datatables/tools/js/dataTables.tableTools.js"></script>
        <script>
      

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
                 
                 
                $(".printsalesOrder").click(function(){
				     if($(".orderid").is(":checked")){
						  if($(".orderid:checked").length == 1){
							  var id = $(".orderid:checked").attr("id");
							  id = id.split("_");
							  window.open("<?php echo base_url()?>reports/printSalesOrder/"+id[1], "", "width=700, height=500");
						  }else{
							  alert("Please select one Order");
						  }
					 }else{
						 alert("Please select one Order");
					 }
			   }); 
			   
			   
                $(".editorder").click(function(){
				     if($(".orderid").is(":checked")){
						  if($(".orderid:checked").length == 1){
							  var id = $(".orderid:checked").attr("id");
							  id = id.split("_");
							  window.location.href = '<?php echo base_url()?>sales/editsalesorder/'+id[1];
						  }else{
							  alert("Please select one Order");
						  }
					 }else{
						 alert("Please select one Order");
					 }
			   }); 
                $(".vieworder").click(function(){
				     if($(".orderid").is(":checked")){
						  if($(".orderid:checked").length == 1){
							  var id = $(".orderid:checked").attr("id");
							  id = id.split("_");
							  window.location.href = '<?php echo base_url()?>reports/viewSalesOrder/'+id[1];
						  }else{
							  alert("Please select one Order");
						  }
					 }else{
						 alert("Please select one Order");
					 }
			   }); 
                $(".deleteorder").click(function(){
				     if($(".orderid").is(":checked")){
						  if($(".orderid:checked").length == 1){
							  var id = $(".orderid:checked").attr("id");
							  id = id.split("_");
							  
							  e = confirm("Do you want to delete the sales order?");
							  if(e)
							  window.location.href = '<?php echo base_url()?>sales/deletesalesorder/'+id[1];
						  }else{
							  alert("Please select one Order");
						  }
					 }else{
						 alert("Please select one Order");
					 }
			   }); 
                  
               	$(".pdfsalesorder").click(function(){
				     if($(".orderid").is(":checked")){
						  if($(".orderid:checked").length == 1){
							  var id = $(".orderid:checked").attr("id");
							  id = id.split("_");
							  
							   window.location.href = '<?php echo base_url()?>reports/pdfSalesOrder/'+id[1];
							  
						  }else{
							  alert("Please select one Order");
						  }
					 }else{
						 alert("Please select one Order");
					 }
			   }); 

				$('body').keydown(function(event) {
						event.preventDefault();
						if(event.which == 113) { //F2
							window.location.href = '<?php echo base_url()?>sales/salesorder';
						}
						else if(event.which == 114) { //F3
							$(".pdfquote").trigger("click");
						}
						else if(event.which == 115) { //F4
							$(".vieworder").trigger("click");
						}
						else if(event.which == 119) { //F8
							$(".printPurchaseOrder").trigger("click");
						}
						
					});
					
            }); 
        </script>
