<?php echo load_datatables(); ?>

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
							<div class="row">
									<div class="col-md-12 col-sm-12 col-12 text-right">
											<button type="button" id="AddBtn" class="btn btn-info btn-sm"><i class="fa fa-plus"></i> New</button>
											
											<hr>
										</div>
								<div class="col-md-12 col-sm-12 col-12">
									<div class="table-responsive">
										<table class="table table-bordered" id="DataTable" width="100%">
											<thead>
												<tr>
													<th width="5%">S.No</th>
													<th width="15%">Item Name</th>
													<th width="10%">Price</th>
													<th width="10%">Quantity</th>
													<th width="10%">Unit</th>
													<th width="13%">Brand</th>
													<th width="10%">Location</th>
													<th width="10%">Status</th> 
													<th width="15%">Action</th>        
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


    <div class="modal fade show" id="FormModal" aria-modal="true" role="dialog">
	<div class="modal-dialog modal-lg">
		<form id="DataForm" autocomplete="OFF">
			<input type="hidden" name="row_id" id="row_id" />
			<div class="modal-content">
				<div class="modal-header">
					<h4 id="FormModalHeading"> Item Master </h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true" style="font-size:20px;color:#D71313;">Close</span>
					</button>
				</div>
     	<div class="modal-body">
					              <div class="row">
											<div class="col-md-3">
												<div class="form-group">
													<label class="form-check-label">Item Code  <span class="text-required">*</span></label>
													<input type="text" class="form-control form-control-sm" name="itemcode" id="itemcode"  />
												</div>
											</div>
											
											<div class="col-md-3">
												<div class="form-group">
													<label class="form-check-label">Item Name <span class="text-required">*</span></label>
													<input type="text" class="form-control form-control-sm" name="itemname" id="itemname"  />
												</div>
											</div>
											
											<div class="col-md-3">
												<div class="form-group">
													<label class="form-check-label">Category <span class="text-required">*</span></label>
													<input type="text" class="form-control form-control-sm" name="category" id="category"  />
												</div>
											</div>
											
											<div class="col-md-3">
												<div class="form-group">
													<label class="form-check-label">Sub Category  <span class="text-required">*</span></label>
													<input type="text" class="form-control form-control-sm" name="subcategory" id="subcategory"  />
												</div>
											</div>
											
											<div class="col-md-3">
												<div class="form-group">
													<label class="form-check-label">Brand <span class="text-required">*</span></label>
													<input type="text" class="form-control form-control-sm" name="brand" id="brand"  />
												</div>
											</div>
											
											<div class="col-md-3">
												<div class="form-group">
													<label class="form-check-label">Cost Price <span class="text-required">*</span></label>
													<input type="text" class="form-control form-control-sm" name="costprice" id="costprice"  />
												</div>
											</div>
											
											<div class="col-md-3">
												<div class="form-group">
													<label class="form-check-label">GST Percentage<span class="text-required">*</span></label>
													<input type="text" class="form-control form-control-sm" name="gst" id="gst"  />
												</div>
											</div>
											
											<div class="col-md-3">
												<div class="form-group">
													<label class="form-check-label">HSN Code<span class="text-required">*</span></label>
													<input type="text" class="form-control form-control-sm" name="hsn_code" id="hsn_code"  />
												</div>
											</div>
											
											<div class="col-md-3">
												<div class="form-group">
													<label class="form-check-label">Selling Price<span class="text-required">*</span></label>
													<input type="text" class="form-control form-control-sm" name="price" id="price"  />
												</div>
											</div>
											
											<div class="col-md-3">
												<div class="form-group">
													<label class="form-check-label">Product Origin<span class="text-required">*</span></label>
													<select class="form-control form-control-sm" name="product_origin" id="product_origin" required>
																<option value=''>-- Select Status --</option>
																<option value='Bahrain'>Bahrain</option>
																<option value='France'>France</option>
																<option value='Japan'>Japan</option>
																<option value='India'>India</option>
																<option value='USA'>USA</option>
																<option value='Singapore'>Singapore</option>
																<option value='Europe'>Europe</option>
															</select>
												</div>
											</div>
											
											<div class="col-md-3">
												<div class="form-group">
													<label class="form-check-label">Quantity<span class="text-required">*</span></label>
													<input type="text" class="form-control form-control-sm" name="quantity" id="quantity"  />
												</div>
											</div>
											
											<div class="col-md-3">
												<div class="form-group">
													<label class="form-check-label">Unit<span class="text-required">*</span></label>
													<input type="text" class="form-control form-control-sm" name="unit" id="unit"  />
												</div>
											</div>
											
											<div class="col-md-3">
												<div class="form-group">
													<label class="form-check-label">Product Location<span class="text-required">*</span></label>
													<input type="text" class="form-control form-control-sm" name="location" id="location"  />
												</div>
											</div>
													
											<div class="col-md-3">
												<div class="form-group">
													<label class="form-check-label">Tax<span class="text-required">*</span></label>
													<input type="text" class="form-control form-control-sm" name="tax" id="tax"  />
												</div>
											</div>
											
											<div class="col-md-3">
												<div class="form-group">
													<label class="form-check-label">Minimum Reorder Qty<span class="text-required">*</span></label>
													<input type="text" class="form-control form-control-sm" name="min_reorder" id="min_reorder"  />
												</div>
											</div>
											
											
											<div class="col-md-3">
												<div class="form-group">
													<label class="form-check-label">Account Name<span class="text-required">*</span></label>
													<select class='form-control form-control-sm tabp' name='accountname' id='accountname' required>
													<option value=''>Choose..</option>
													<?php
													if(!empty($accountnames)){
														foreach($accountnames as $tmp){
															if(isset($item) && $item->accountname == $tmp->accountid) 
																echo "<option value='$tmp->accountid' selected>$tmp->accountname</option>";
															else
																echo "<option value='$tmp->accountid'>$tmp->accountname</option>";
														}
													}
													?>
												</select>
												</div>
											</div>
													<div class="col-md-3">
														<div class="form-group">
															<label class="form-check-label">Status <span class="text-required">*</span></label>
															<select class="form-control form-control-sm" name="status" id="status" required>
																<option value=''>-- Select Status --</option>
																<option value='0'>Active</option>
																<option value='1'>Inactive</option>
															</select>
														</div>
													</div>
													
													<div class="col-md-3">
														<div class="form-group">
															<label class="form-check-label">Item Type <span class="text-required">*</span></label>
															<select class="form-control form-control-sm" name="item_type" id="item_type" required>
																<option value=''>-- Select Status --</option>
																<option value='1'>Purchase</option>
																<option value='2'>Sales</option>
																<option value='3'>Both</option>
															</select>
														</div>
													</div>
													
										</div>
										<hr>
                                    <div class="form-group">
                                        <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-4">
                                            <button type="submit" class="btn btn-success btn-sm">Submit</button>
					                        <button type="reset" class="btn btn-danger btn-sm">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>


                    </div>
                </div>
    
        

<style>
.modal-backdrop {
  z-index: -1;
}
</style>

<script>

$(document).ready(function(){
	$('#DataTable').DataTable({
		'processing': true,
		'serverSide': true,
		'serverMethod': 'post',
		"order": [[ 1, "asc" ]],
		'ajax': {
			'url':	"<?= base_url().'list_item_master' ?>",
			'type':	"POST"
		},
		"columnDefs": [{
			"targets": [0,3],
			"orderable": false
		}]
	});
	
});

$("#AddBtn").click(function(){

	$("#FormModal").modal('show');
});

	$("#ResetBtn").click(function() {
		clear_data_form();
	});

	$("#DataForm").on('submit', (function(e) {
		e.preventDefault();
		var formData = new FormData($("#DataForm")[0]);
		$.ajax({
			url: "<?= base_url() .'add_item' ?>",
			type: "POST",
			data: formData,
			dataType: "JSON",
			contentType: false,
			cache: false,
			processData: false,
			beforeSend: function() {
				$("#DataForm [type='submit']").attr('disabled', true);
			},
			success: function(data) {
				if (data['status'] == "Error") {
					toastr.error(data['msg']);
				} else {
					clear_data_form();
					
				$("#FormModal").modal('hide');
					$('#DataTable').DataTable().ajax.reload(null, false);
					toastr.success(data['msg']);
				}
			},
			complete: function(data) {
				$("#DataForm [type='submit']").attr('disabled', false);
			},
		});
	}));

	$(document).on("click",".edit_data",function(){
	$("#DataForm [type='submit']").html('Update');
	$('#row_id').val($(this).attr('data-id'));
	$('#itemcode').val($(this).attr('data-code'));
	$('#itemname').val($(this).attr('data-name'));
	$('#category').val($(this).attr('data-cat'));
	$('#subcategory').val($(this).attr('data-sub'));
	$('#gst').val($(this).attr('data-gst'));
	$('#hsn_code').val($(this).attr('data-hsn_code'));
	$('#brand').val($(this).attr('data-brd'));
	$('#costprice').val($(this).attr('data-cost'));
	$('#price').val($(this).attr('data-pri'));
	$('#unit').val($(this).attr('data-unit'));
	$('#quantity').val($(this).attr('data-qua'));
	$('#product_origin').val($(this).attr('data-product'));
	$('#location').val($(this).attr('data-loc'));
	$('#tax').val($(this).attr('data-taxx'));
	$('#min_reorder').val($(this).attr('data-min'));
	$('#accountname').val($(this).attr('data-acc'));

	$('#status').val($(this).attr('data-sta'));
	$('#item_type').val($(this).attr('data-item_type'));
	
	$("#FormModal").modal('show');
	
	window.scroll({top: 0, behavior: "smooth"})
});


	function clear_data_form() {
		$('#row_id').val('');
		$("#DataForm [type='submit']").html('Submit');
		$("#DataForm").trigger('reset');
	}



$(document).on("click",".delete_data",function(){
	var val = confirm("Are You Sure to Delete !!!");
	if(val==true){
		$.ajax({
			url: "<?= base_url().'delete_item_master' ?>",
			type: "POST",
			data:  { keys : $(this).attr('data-id') },
			dataType: "JSON",
			success: function(data)
			{
				if(data['status']=="Warning"){
					toastr.warning(data['msg']);
				}else{
					toastr.info(data['msg']);
					$('#DataTable').DataTable().ajax.reload(null, false);
				}
			}
		});
	}
});


</script>







