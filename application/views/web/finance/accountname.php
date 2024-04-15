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
                        <li class="breadcrumb-item"><a href="<?php echo base_url()?>web/accountsname">Accountsname</a></li>
                        
                    </ol>
                </div>
            </div>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-md-12 col-sm-12 col-12 text-right">
								<button type="button" id="AddBtn2" class="btn btn-info btn-sm newacname"><i class="fa fa-plus"></i> New</button>
								
								<button type="button" id="AddBtn2" class="btn btn-info btn-sm editacname"><i class="fas fa-edit"></i> Edit</button>
								
								<button type="button" id="" class="btn btn-info btn-sm deleteacname"><i class="fas fa-trash"></i> Delete</button>
								
								<button type="button" id="" class="btn btn-info btn-sm changestatus"><i class="fas fa-info-circle"></i> Change Status</button>
								
								 <a href="<?php echo base_url()?>web/account_subcategory" class="btn btn-info btn-sm"><i class="fas fa-check-circle"></i> Create Subcategory</a>
								</div> 
								
								
								<div class="col-md-12 col-sm-12 col-12"><hr/>
									<div class="table-responsive">
										<table id="example" class="table table-striped responsive-utilities jambo_table" width="100%">
                                        <thead>
                                            <tr class="headings">
                                                <th>
                                                   
                                                </th>
                                                <th>S.No</th>
                                                <th width="15%;">Main Group </th>
                                                <th>Category </th>
                                                <th>Sub Category </th>
                                                <th>A/C Name </th> 
                                                <th>Status </th>
                                               
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                           <?php
										   if(isset($accountnames) && count($accountnames)){
											   $i = 1;
											   foreach($accountnames as $tmp){
											
										   ?>
                                           
                                            <tr class="odd pointer">
                                                <td>
                                                    <input type="radio" name='acCheck' class="tableflat acname" id='acname_<?php echo $tmp->accountid;?>'>
                                                </td>
                                                <td class=" "><?php echo $i++;?></td>
                                                
                                                <td class=" "><?php echo get_maingroup($tmp->groupid);?>
                                                <td class=" "><?php echo get_categoryname($tmp->categoryid);?>
                                                </td>
                                                
												<td class=" "><?php echo get_subcategoryname($tmp->subcategoryid);?>
												<td class=" "><?php echo $tmp->accountname;?>
                                                <td class=" ">
												<?php
if ($tmp->status == 0) {
    echo "<span class='badge badge-success'>Active</span>";
}else if($tmp->status == 1) {
    echo "<span class='badge badge-danger'>Inactive</span>";
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
    </section>
</div>
			
<!---Add1-->

<div class="modal fade show" id="FormModal1" aria-modal="true" role="dialog">
	<div class="modal-dialog modal-lg">
		<form id="vendorDataForm" autocomplete="OFF">
			<input type="hidden" name="row_id" id="row_id" />
			<div class="modal-content">
				<div class="modal-header">
					<h4 id="FormModalHeading">Create A/C Name</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
					
						<div class="col-md-4">
						<div class="form-group">
						<label class="form-check-label">Main Group <span class="text-required">*</span></label>
						<select class='form-control form-control-sm' name='maingroup' id='maingroup'>
												<?php
												if(isset($maingroup) && !empty($maingroup)){
													echo "<option value=''>--Select--</option>";
													foreach($maingroup as $tmp){
														echo "<option value='".$tmp->groupid."'>$tmp->groupname</option>";
													}
												}
												?>
												</select>
						</div>
						</div>
						
						
						<div class="col-md-4">
						<div class="form-group">
						<label class="form-check-label">Main Category <span class="text-required">*</span></label>
						<select class='form-control form-control-sm' name='category' id='category'>
												
												</select>
						</div>
						</div>
						
						
						<div class="col-md-4">
						<div class="form-group">
						<label class="form-check-label">Category <span class="text-required">*</span></label>
						<select class='form-control form-control-sm' name='subcategory' id='subcategory'>
												
												</select>
						</div>
						</div>
						
						
						
						<div class="col-md-4">
						<div class="form-group">
						<label class="form-check-label">Sub Category <span class="text-required">*</span></label>
						<select class='form-control form-control-sm' name='subsubcategory' id='subsubcategory'>
												
												</select>
						</div>
						</div>
						
						
						<div class="col-md-2">
						<div class="form-group">
						<a href="<?php echo base_url()?>web/account_subcategory" class="btn btn-primary btn-sm" style="margin-top: 23px;
                        margin-left: 10px;">+ Add</a>
						</div>
						</div>
						
						
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-check-label">A/C Name <span class="text-required">*</span></label>
								<input type=text class='form-control form-control-sm' name='acname' id='acname' style="text-transform: capitalize;">
							</div>
						</div>
						
						
						
					</div>
				</div>
				<div class="modal-footer" style="text-align:left !important;">
					<button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-sm" style="align-center" id='saveac'>Save</button>
				</div>
			</div>
		</form>
	</div>
</div>


<!---Add2-->

<script>
$("#AddBtn2").click(function(){
	
$("#FormModal1").modal('show');

});

</script>

    <input type=hidden id='editsubcategory'>
	<input type=hidden id='editsubsubcategory'>
	<input type=hidden id='accountid'>
	
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
                
            }); 
			$(document).ready(function () {				
               $(".DTTT_container").hide();
			   
			   $(".editacname").click(function(){
				     $("#accountid").val('');
				     if($(".acname").is(":checked")){
						  if($(".acname:checked").length == 1){
							  var id = $(".acname:checked").attr("id");
							  id = id.split("_");
							 
							    $.ajax({
								  url: "<?php echo base_url();?>web/get_accountname",
								  type:"POST",	
								  dataType: "json",
								  data: {
									accountid: id[1]
								  },
								  success: function( data ) {
									$("#maingroup").val(data.groupid);
																  
									  $.ajax({
										  url: "<?php echo base_url();?>web/get_category",
										  type:"POST",	  
										  data: {
											maingroup: data.groupid
										  },
										  success: function( temp ) {
											 $("#category").html(temp);
											 $("#category").val(data.categoryid);
											 $("#category").trigger("change");
											 $("#acname").val(data.accountname);
											 $("#accountid").val(data.accountid);											
										  }
									  });
									 $(".newacname").trigger("click");
									 $("#editsubcategory").val(data.subcategoryid);
									 $("#editsubsubcategory").val(data.subsubcategoryid);
									 $("#acname").val(data.accountname);
									 $("#maingroup").val(data.groupid);
									 
								  }
								  
								});
						  }else{
							  alert("Please select one Account");
						  }
					 }else{
						 alert("Please select one Account");
					 }
			   });
			   
			   $(".changestatus").click(function(){
				     if($(".acname").is(":checked")){
						  if($(".acname:checked").length == 1){
							  var id = $(".acname:checked").attr("id");
							  id = id.split("_");
							  e = confirm("Do you want to change the status?");
							  if(e)
							  window.location.href = "<?php echo base_url()?>web/accountstatus/"+id[1];
						  }else{
							  alert("Please select one Account");
						  }
					 }else{
						 alert("Please select one Account");
					 }
			   });
			   
			   $(".deleteacname").click(function(){
				     if($(".acname").is(":checked")){
						  if($(".acname:checked").length == 1){
							  var id = $(".acname:checked").attr("id");
							  id = id.split("_");
							  e = confirm("Do you want to delete the Account Name?");
							  if(e)
							  window.location.href = "<?php echo base_url()?>web/deleteaccount/"+id[1];
						  }else{
							  alert("Please select one Account");
						  }
					 }else{
						 alert("Please select one Account");
					 }
			   });
			   
			   
			
			  
			   $("#maingroup").change(function(){
				   $.ajax({
					  url: "<?php echo base_url();?>web/get_category",
					  type:"POST",	  
					  data: {
						maingroup: $(this).val()
					  },
					  success: function( data ) {
						 $("#category").html(data);
						 $("#category").trigger("change");
					  }
					});
			   });
			   
			   $("#category").change(function(){				  
				   $.ajax({
					  url: "<?php echo base_url();?>web/get_subcategory",
					  type:"POST",	  
					  data: {
						category: $(this).val()
					  },
					  success: function( data ) {
						 if(data){
							$("#subcategory").removeAttr("disabled");
							$("#subcategory").html(data);
							
							$("#subsubcategory").removeAttr("disabled");
							if($("#editsubcategory").val()){
								$("#subcategory").val($("#editsubcategory").val());
							}
							$("#editsubcategory").val('');
							$("#subcategory").trigger("change");
						 }
						 else{
							 $("#subcategory").html(data);
							 $("#subsubcategory").html(data);
							 $("#subcategory").attr("disabled","true");
							 $("#subsubcategory").attr("disabled","true");
						 }
						 
					  }
					});
			   });
			   
			   $("#subcategory").change(function(){				  
				   $.ajax({
					  url: "<?php echo base_url();?>web/get_subsubcategory",
					  type:"POST",	  
					  data: {
						subcategory: $(this).val()
					  },
					  success: function( data ) {
						 if(data){
							$("#subsubcategory").removeAttr("disabled");
							$("#subsubcategory").html(data);
							
							if($("#editsubsubcategory").val()){
								$("#subsubcategory").val($("#editsubsubcategory").val());
							}
						 }
						 else{
							 $("#subsubcategory").html(data);
							 $("#subsubcategory").attr("disabled","true");
						 }
					  }
					});
			   });
			   
			   $("#saveac").click(function(){
				   $.ajax({
					  url: "<?php echo base_url();?>web/addaccountname",
					  type:"POST",	 
					  dataType: "json",
					  data: {
						accountid:$("#accountid").val(),  
						maingroup: $("#maingroup").val(),
						category: $("#category").val(),
						subcategory: $("#subcategory").val(),
						subsubcategory: $("#subsubcategory").val(),
						acname: $("#acname").val()
					  },
					  success: function( data ) {
						  if(data.success == "Error"){
							  toastr.error(data['msg']);
							  $("#acname").val("");
						  }else{
							   toastr.success(data['msg']);
							   $("#FormModal1").modal('hide');
                                // Reload the page after a short delay (1000 milliseconds)
								setTimeout(function() {
									location.reload();
								}, 1000);								   
						  }
					  }
					});
			   });
			   
			   $("#mergeacc").click(function(){
				   $.ajax({
					  url: "<?php echo base_url();?>web/merge_account",
					  type:"POST",	 
					  dataType: "json",
					  data: {
						fromaccount:$("#fromaccount").val(),
						toaccount:$("#toaccount").val()						
					  },
					  success: function( data ) {
						  if(data.success == true){
							  alert("Accounts Merged");
							 window.location.href='<?php echo base_url()?>web/accountname'; 
						  }else{
							 
						  }
					  }
					});
			   });
			   
					$('body').keydown(function(event) {
						if(event.which == 113) { //F2
							$(".newacname").trigger("click");
						}
						else if(event.which == 115) { //F4
							$(".editacname").trigger("click");
						}
						else if(event.which == 119) { //F8
							$(".changestatus").trigger("click");
						}
						else if(event.which == 120) { //F9
							$(".deleteacname").trigger("click");
						}
					});
			   
			   
			   $(".newacname").click(function(){
				    $("#maingroup").val("");
				    $("#category").html("");
				    $("#subcategory").html("");
				    $("#subsubcategory").html("");
				    $("#acname").val("");
			   });
			   
            });
			
			
        </script>
