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
                       
                    </ol>
                </div>
            </div>
			
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							
								<div class="col-md-12 text-right">
									<a href="<?php echo base_url()?>Accounts/newgdn" class="btn btn-info btn-sm newvoucher" style="margin-left: 488px;"><i class="fa fa-plus"></i> New</a>
									
									<!-- <a href="#" class="btn btn-info btn-sm DTTT_button DTTT_button_copy editgdn"><i class="far fa-edit"></i> Edit </a>
									
									<a href="#" class="btn btn-info btn-sm DTTT_button DTTT_button_copy viewgdn"><i class="far fa-eye"></i>  View </a>
									
									<a href="#" class="btn btn-info btn-sm DTTT_button DTTT_button_copy deletegdn"><i class="fas fa-trash"></i> Delete </a> -->
									
									<hr/>
								</div>
			                   
                                    <table id="example" class="table table-striped responsive-utilities jambo_table">
                                        <thead>
                                            <tr class="headings">
                                                <th>   
                                                </th>
                                                <th>GDS No </th>
                                                <th>Invoice No </th>
                                                <th>GDS Date </th>
                                                <th>Supplier </th>
                                                <th>Total Quantity </th>      
                                                <th>Total Dispatched </th> 
                                            </tr>
                                        </thead>

                                       <tbody>
                                           <?php
										   if(isset($gdn_list) && count($gdn_list)){
											   $i = 1;
											   foreach($gdn_list as $tmp){
											
										   ?>
                                           
                                            <tr class="odd pointer">
                                                <td>
                                                    <input type="radio" name='purchasegdnCheck' class="tableflat gdnid" id='gdn_<?php echo $tmp->gdnid;?>'>
                                                </td>
                                                <td class=" " align=left><?php echo $tmp->gdnnumber;?></td>
                                                <td class=" " align=left><?php echo $tmp->salesinvoiceid;?></td>
                                                <td class=" " align=left>
													<?php 
														echo date("d-m-Y",strtotime($tmp->issuedate));
													?>
												</td>
                                                
                                                
                                                <td class=" " align=left><?php echo get_contactname($tmp->customerid);?></td>
                                                
												<td class=" " align=left><?php echo $tmp->totalquantity;?></td>
												<td class=" " align=left><?php echo $tmp->totaldispatched;?></td>
                                               
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
                 
                $(".viewgdn").click(function(){
				     if($(".gdnid").is(":checked")){
						  if($(".gdnid:checked").length == 1){
							  var id = $(".gdnid:checked").attr("id");
							  id = id.split("_");
							 
							 window.location.href = '<?php echo base_url()?>reports/viewgdn/'+id[1];
						  }else{
							  alert("Please select one GDN");
						  }
					 }else{
						 alert("Please select one GDN");
					 }
			   }); 
                  
                $(".editgdn").click(function(){
				     if($(".gdnid").is(":checked")){
						  if($(".gdnid:checked").length == 1){
							  var id = $(".gdnid:checked").attr("id");
							  id = id.split("_");
							 
							 window.location.href = '<?php echo base_url()?>sales/editgdn/'+id[1];
						  }else{
							  alert("Please select one GDN");
						  }
					 }else{
						 alert("Please select one GDN");
					 }
			   }); 
                $(".deletegdn").click(function(){
				     if($(".gdnid").is(":checked")){
						  if($(".gdnid:checked").length == 1){
							  var id = $(".gdnid:checked").attr("id");
							  id = id.split("_");
							 
							 window.location.href = '<?php echo base_url()?>sales/deletegdn/'+id[1];
						  }else{
							  alert("Please select one GDN");
						  }
					 }else{
						 alert("Please select one GDN");
					 }
			   }); 
                  
            }); 
        </script>



