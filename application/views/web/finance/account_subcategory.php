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
						<form method="post" action="<?php echo base_url()?>web/save_account_subcategory">
							<div class="row">
						<div class="col-md-3">
						<div class="form-group">
						<label class="form-check-label">Main Group <span class="text-required">*</span></label>
						<select class='form-control form-control-sm' disabled name='maingroup' id='maingroup'>
								<?php
								if(isset($maingroup) && !empty($maingroup)){
									foreach($maingroup as $tmp){
										if($tmp->groupid == 1)
											echo "<option selected value='".$tmp->groupid."'>$tmp->groupname</option>";
										else
											echo "<option value='".$tmp->groupid."'>$tmp->groupname</option>";
									}
								}
								?>
								</select>
						</div>
						</div>
						
						
						<div class="col-md-3">
						<div class="form-group">
						<label class="form-check-label">Main Category <span class="text-required">*</span></label>
						<select class='form-control form-control-sm' name='category_new' id='category_new' required>

								</select>
						</div>
						</div>
						
						
						<div class="col-md-3">
						<div class="form-group">
						<label class="form-check-label">Category <span class="text-required">*</span></label>
						<select class='form-control form-control-sm' name='subcategory_new' id='subcategory_new' required>

							</select>
						</div>
						</div>
						
						
						
						<div class="col-md-3">
						<div class="form-group">
						<label class="form-check-label">Sub Category <span class="text-required">*</span></label>
						<input type=text class='form-control form-control-sm' name='subsubcategory' id='subsubcategory' required>
						</div>
						</div>
						
						
						<div class="col-md-12">
						<div class="modal-footer" style="text-align:left !important;">
					    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
						<a href="<?php echo base_url()?>web/accountname" class="btn btn-info btn-sm">Cancel</a>
				        </div>
					    </div>
						
								
								
								<div class="col-md-12 col-sm-12 col-12"><hr/>
									<div class="table-responsive">
										
										
									</div>
								</div>
							</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			
			
<!-- second box start-->

			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
						<div class="row">
						<div class="col-md-12 text-right">
					<button type="button" id="" class="btn btn-info btn-sm editcat"><i class="fas fa-edit"></i> Edit</button>
					</div>
								<div class="col-md-12 col-sm-12 col-12"><hr/>
									<div class="table-responsive">
								  <table id="example" class="table table-striped responsive-utilities jambo_table">
                                        <thead>
                                            <tr class="headings">
                                                <th>
                                                   
                                                </th>
                                                <th>S.No </th>
                                                <th>Main Category </th>
                                                <th>Category </th>
                                                <th>Subcategory </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                           <?php
										   if(isset($subsubcategory) && count($subsubcategory)){
											   $i = 1;
											   foreach($subsubcategory as $tmp){
											
										   ?>
                                           
                                            <tr class="odd pointer">
                                                <td>
                                                    <input type="radio" class="tableflat subsubcategory" name='yearCheck' id='sub_<?php echo $tmp->subsubcategoryid;?>'>
                                                </td>
                                                
                                                
                                                <td class=" "><?php echo $i++;?> </td>
                                                <td class=" "><?php echo $tmp->categoryname;?> </td>
                                                <td class=" "><?php echo $tmp->subcategoryname;?> </td>
                                                <td class=" "><?php echo $tmp->subsubcategoryname;?> </td>
											
                                                
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


<script>
	   $("#AddBtn2").click(function(){
$("#FormModal1").modal('show');

});

</script>
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
               
					$.ajax({
					  url: "<?php echo base_url();?>web/get_category",
					  type:"POST",	  
					  data: {
						maingroup: 1
					  },
					  success: function( data ) {
						 $("#category_new").html(data);	
						 $("#category_new").trigger("change");					
					  }
					});
			  
			   $("#category_new").change(function(){				  
				   $.ajax({
					  url: "<?php echo base_url();?>web/get_subcategory",
					  type:"POST",	  
					  data: {
						category: $(this).val()
					  },
					  success: function( data ) {
						 if(data){
							$("#subcategory_new").removeAttr("disabled");
							$("#subcategory_new").html(data);
							
						 }
						 else{
							 $("#subcategory_new").html(data);
							 $("#subcategory_new").attr("disabled","true");
						 }
					  }
					});
			   });
			   
			   <?php
			        if($this->session->flashdata('subcategory')){
			      ?>
						new PNotify({
							title: 'Account Name Subcategory',
							text: '<?php echo $this->session->flashdata('subcategory');?>',
							type: 'success'
						});
				  <?php 
					}
				  ?>
			   
			   
				$(document).on("click",".editcat",function(){
					
						var id = $(".subsubcategory:checked").prop("id");
						id = id.split("_");
						
						$.ajax({
						  url: "<?php echo base_url();?>web/get_subsubcategory_record",
						  type:"POST",	
						  dataType: "json",  
						  data: {
							subsubcategory: id[1]
						  },
						  success: function( data ) {
							$("#category_new").val(data.categoryid);	
							$("#category_new").trigger("change");		
							$("#subcategory_new").val(data.subcategoryid);			
							//alert(data.subsubcategoryid);			
							$("#subsubcategory").val(data.subsubcategoryname);			
						  }
						});
				});
			   
			   
            });
			
        </script>

		