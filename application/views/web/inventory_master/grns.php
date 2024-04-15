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
									<a href="<?php echo base_url() ?>Accounts/grn" class="btn btn-info btn-sm" style="margin-left: 488px;"><i class="fa fa-plus"></i> New</a>
									
									<a href="#" class="btn btn-info btn-sm DTTT_button DTTT_button_copy editgrn"><i class="far fa-edit"></i> Edit </a>
									
									<a href="#" class="btn btn-info btn-sm DTTT_button DTTT_button_copy deletegrn"><i class="fas fa-trash"></i> Delete </a>
									
									<a href="#" class="btn btn-info btn-sm DTTT_button DTTT_button_copy viewgrn"><i class="far fa-eye"></i>  View </a>
									
									<hr/>
								</div>
			                   
                                    <table id="example" class="table table-striped responsive-utilities jambo_table">
                                        <thead>
                                            <tr class="headings">
											       <th>  </th>
                                                    <th> GRN No </th>
													<th>Order No </th>
													<th>GRN Date</th>
													<th>Supplier </th>
													<th> Total Quantity </th>
													<th>Total Difference </th>
													<th>Authorized By</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                           <?php
										   if(isset($grns) && count($grns)){
											   $i = 1;
											   foreach($grns as $tmp){
											
										   ?>
                                           
                                            <tr class="odd pointer">
                                                <td>
                                                    <input type="radio" name='purchaseGrnCheck' class="tableflat grnid" id='grn_<?php echo $tmp->grnid;?>'>
                                                </td>
                                                <td class=" " align=left><?php echo $tmp->grnnumber;?></td>
                                                <td class=" " align=left><?php echo $tmp->purchaseordernum;?></td>
                                                <td class=" " align=left>
													<?php 
														echo date("d-m-Y",strtotime($tmp->issuedate));
													?>
												</td>
                                                
                                                
                                                <td class=" " align=left><?php echo get_contactname($tmp->supplierid);?></td>
                                                
												<td class=" " align=left><?php echo $tmp->totalquantity;?></td>
												<td class=" " align=left><?php echo $tmp->totaldifference;?></td>
												<td class=" " align=left><?php echo $tmp->receivedby?$tmp->receivedby:"-";?></td>
                                               
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
                 
                 
                $(".editvoucher").click(function(){
				     if($(".voucherid").is(":checked")){
						  if($(".voucherid:checked").length == 1){
							  var id = $(".voucherid:checked").attr("id");
							  id = id.split("_");
							 
							  window.location.href = "<?php echo base_url()?>accounts/voucher/"+id[1];  
						  }else{
							  alert("Please select one Voucher");
						  }
					 }else{
						 alert("Please select one Voucher");
					 }
			   }); 
			   
                $(".viewgrn").click(function(){
				     if($(".grnid").is(":checked")){
						  if($(".grnid:checked").length == 1){
							  var id = $(".grnid:checked").attr("id");
							  id = id.split("_");
							 
							 window.location.href = '<?php echo base_url()?>Accounts/viewGrn/'+id[1];
						  }else{
							  alert("Please select one GRN");
						  }
					 }else{
						 alert("Please select one GRN");
					 }
			   }); 
                  
                $(".editgrn").click(function(){
				     if($(".grnid").is(":checked")){
						  if($(".grnid:checked").length == 1){
							  var id = $(".grnid:checked").attr("id");
							  id = id.split("_");
							 
							 window.location.href = '<?php echo base_url()?>Accounts/editgrn/'+id[1];
						  }else{
							  alert("Please select one GRN");
						  }
					 }else{
						 alert("Please select one GRN");
					 }
			   }); 
			   
			   
                $(".deletegrn").click(function(){
				     if($(".grnid").is(":checked")){
						  if($(".grnid:checked").length == 1){
							  var id = $(".grnid:checked").attr("id");
							  id = id.split("_");
							 
							 window.location.href = '<?php echo base_url()?>Accounts/deletegrn/'+id[1];
						  }else{
							  alert("Please select one GRN");
						  }
					 }else{
						 alert("Please select one GRN");
					 }
			   }); 
                  
            }); 
        </script>




