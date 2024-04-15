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
                    <h1>Users Access Management</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Settings</a></li>
                        <li class="breadcrumb-item active"><a href="<?= base_url().'user_account_type_master' ?>">Users Master</a></li>
                    </ol>
                </div>
            </div>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header p-2">
							<ul class="nav nav-pills">
								<li class="nav-item"><a class="nav-link active" href="#user_master" data-toggle="tab">User Master</a></li>
								<li class="nav-item"><a class="nav-link" href="#account_type_master" data-toggle="tab">Account Type Master</a></li>
							</ul>
						</div>
						<div class="card-body">
							<div class="tab-content">
								<div class="tab-pane active" id="user_master">
									<div class="row">
										<div class="col-md-12 col-sm-12 col-12 text-right">
											<button type="button" id="AddBtn" class="btn btn-info btn-sm"><i class="fa fa-plus"></i> New</button>
											<hr>
										</div>
										<div class="col-md-12 col-sm-12 col-12">
											<div class="table-responsive">
												<table class="table table-bordered" id="UserDataTable" width="100%">
													<thead>
														<tr>
															<th width="4%">S.No</th>
															<th width="11%">Full Name</th>
															<th width="11%">Username</th>
															<th width="15%">Email Address</th>
															<th width="15%">Mobile No</th>
															<th width="10%">Account Name</th>
															<th width="10%">Status</th>
															<th width="15%">Action</th>
														</tr>
													</thead>
												</table>
											</div>
										</div>
									</div>
								</div>
								<div class="tab-pane" id="account_type_master">
									<div class="row">
										<div class="col-md-12 col-sm-12 col-12">
											 <form autocomplete="OFF" id="DataForm2">
												<input type="hidden" name="account_type_row_id" id="account_type_row_id" />
												<div class="row">
													<div class="col-md-4">
														<div class="form-group">
															<label class="form-check-label">Account Type Name <span class="text-required">*</span></label>
															<input type="text" class="form-control form-control-sm" name="account_name" id="account_name" required />
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label class="form-check-label">Status <span class="text-required">*</span></label>
															<select class="form-control form-control-sm" name="account_status" id="account_status" required>
																<option value=''>-- Select Status --</option>
																<option value='Active'>Active</option>
																<option value='Inactive'>Inactive</option>
															</select>
														</div>
													</div>
													<div class="col-md-2">
														<div class="form-group">
															<label class="form-check-label">Approve Permission</label><br/>
															<input type="checkbox" name="account_permission" id="account_permission" /> Yes
														</div>
													</div>
													<div class="col-md-2" style="margin-top:22px;">
														<button type="submit" class="btn btn-success btn-sm">Submit</button>
														<button type="reset" class="btn btn-danger btn-sm" id="ResetBtn">Reset</button>
													</div>
												</div>
											</form><hr/>
										</div>
										<div class="col-md-12 col-sm-12 col-12">
											<div class="table-responsive">
												<table class="table table-bordered" id="DataTable2" width="100%">
													<thead>
														<tr>
															<th width="8%">#</th>
															<th width="30%">Account Type Name</th>
															<th width="25%">Status</th>
															<th width="25%">Approve Permission</th>
															<th width="12%">Action</th>
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
			</div>
		</div>
    </section>

</div>

<div class="modal fade show" id="FormModal" aria-modal="true" role="dialog">
	<div class="modal-dialog modal-lg">
		<form id="DataForm1" autocomplete="OFF">
			<input type="hidden" name="user_row_id" id="user_row_id" />
			<div class="modal-content">
				<div class="modal-header">
					<h4 id="FormModalHeading"></h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label class="form-check-label">First Name <span class="text-required">*</span></label>
								<input type="text" class="form-control form-control-sm" name="firstname" id="firstname" required />
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="form-check-label">Last Name <span class="text-required">*</span></label>
								<input type="text" class="form-control form-control-sm" name="lastname" id="lastname" required />
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="form-check-label">Username <span class="text-required">*</span></label>
								<input type="text" class="form-control form-control-sm" name="username" id="username" required />
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="form-check-label">Email Address <span class="text-required">*</span></label>
								<input type="email" class="form-control form-control-sm" name="email" id="email" required />
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="form-check-label">Mobile No <span class="text-required">*</span></label>
								<input type="text" class="form-control form-control-sm" name="mobile" id="mobile" required />
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="form-check-label">User Account Type <span class="text-required">*</span></label>
								<select class="form-control form-control-sm" name="user_role" id="user_role">
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="form-check-label">Password <span class="text-required" id="password_div">*</span></label>
								<input type="password" class="form-control form-control-sm" name="password" id="password" required />
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="form-check-label">Confirm Password <span class="text-required" id="confirm_password_div">*</span></label>
								<input type="password" class="form-control form-control-sm" name="confirm_password" id="confirm_password" required />
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="form-check-label">Status <span class="text-required">*</span></label>
								<select class="form-control form-control-sm" name="status" id="status" required>
									<option value=''>-- Select Status --</option>
									<option value='1'>Active</option>
									<option value='0'>Inactive</option>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer" style="text-align:left !important;">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-success">Submit</button>
					<button type="reset" class="btn btn-danger">Reset</button>
				</div>
			</div>
		</form>
	</div>
</div>

<div class="modal fade show" id="permissionmodel" aria-modal="true" role="dialog">
<div class="modal-dialog modal-lg">

			<form id="DataForm3" autocomplete="OFF" method="post" action="<?= base_url().'add_edit_permission' ?>">
			<input type="hidden" name="row_id" id="row_id" />
			<div class="modal-content">
				<div class="modal-header">
					<h4 id="ModalHeading"></h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">

					<div class="table">
					<table width="100%">
					<thead>
					<tr>
					   <th>S.No</th>
					   <th>Menu Name</th>
					   <th>Permission</th>
					</tr>
					</thead>
					<tbody>

					<?php
					$menus = menu_module();
					foreach($menus as $menu){
					?>

						<tr>
						<td><?php echo $menu['menu_order'];?></td>
						<td>
							<input type="hidden" name="menu_id[]" value="<?= $menu['id'] ?>" />
							<input style="margin-right:10px" type="checkbox" name="menu[]" value="<?php echo $menu['id'];?>" class="select selectAll" id="selectAll_<?php echo $menu['id'];?>"><?php echo $menu['menu_name'];?>
						</td>
						<td>

						<input type="checkbox" class="select selectAll_<?php echo $menu['id'];?>" id="selectAll_1" name="menu_permission_add[<?php echo $menu['id'];?>]" value="1"><span class="btn-ttm badge badge-success">Add
						</span>
						<input type="checkbox" class="select selectAll_<?php echo $menu['id'];?>" id="selectAll_2" name="menu_permission_edit[<?php echo $menu['id'];?>]" value="1"><span class="btn-ttm badge badge-secondary">Edit
						</span>
						<input type="checkbox" class="select selectAll_<?php echo $menu['id'];?>" id="selectAll_3" name="menu_permission_delete[<?php echo $menu['id'];?>]" value="1"><span class="btn-ttm badge badge-danger">Delete
						</span>
						<input type="checkbox" class="select selectAll_<?php echo $menu['id'];?>" id="selectAll_4" name="menu_permission_view[<?php echo $menu['id'];?>]" value="1"><span class="btn-ttm badge badge-warning ">View
						</span>
						<input type="checkbox" class="select selectAll_<?php echo $menu['id'];?>" id="selectAll_5" name="menu_permission_download[<?php echo $menu['id'];?>]" value="1"><span class="btn-ttm badge badge-primary ">Download
						</span>
						</td>

						</tr>


					<?php } ?>

					</tbody>
					</table>
					</div>

					</div>
					<div class="row" style="display: contents;">
                <div class="modal-footer" style="text-align:left !important;">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-success">Submit</button>
					<button type="reset" class="btn btn-danger">Reset</button>
				</div>

					</div>
				</div>
				</div>
			</div>

		</form>
	</div>
</div>



<script>
//User Master
$(document).ready(function(){
	$('#UserDataTable').DataTable({
		'processing': true,
		'serverSide': true,
		'serverMethod': 'post',
		"order": [[ 1, "asc" ]],
		'ajax': {
			'url':	"<?= base_url().'list_users' ?>",
			'type':	"POST"
		},
		"columnDefs": [{
			"targets": [0,7],
			"orderable": false
		}]
	});

	$('#DataTable2').DataTable({
		'processing': true,
		'serverSide': true,
		'serverMethod': 'post',
		"order": [[ 1, "asc" ]],
		'ajax': {
			'url':	"<?= base_url().'list_user_account_type_category' ?>",
			'type':	"POST"
		},
		"columnDefs": [{
			"targets": [0,4],
			"orderable": false
		}]
	});

	user_account_dropdown();
});

$("#AddBtn").click(function(){
	clear_user_form();

	$("#password").prop("required",true);
	$("#confirm_password").prop("required",true);

	$("#password_div").show();
	$("#confirm_password_div").show();

	$("#FormModal").modal('show');
});

$("#DataForm1").on('submit',(function(e){
	e.preventDefault();
	var formData = new FormData($("#DataForm1")[0]);
	$.ajax({
		url: "<?= base_url().'add_edit_users' ?>",
		type: "POST",
		data:  formData,
		dataType: "JSON",
		contentType: false,
		cache: false,
		processData:false,
		beforeSend: function() {
			$("#DataForm1 [type='submit']").attr('disabled', true);
		},
		success: function(data)
		{
			if(data['status']=="Error"){
				toastr.error(data['msg']);
			}else{
				clear_user_form();
				$("#FormModal").modal('hide');
				$('#UserDataTable').DataTable().ajax.reload(null, false);
				toastr.success(data['msg']);
			}
		},
		complete: function(data) {
			$("#DataForm1 [type='submit']").attr('disabled', false);
		},
	});
}));

$(document).on("click",".edit_user",function(){
	$('#user_row_id').val($(this).attr('data-id'));
	$('#firstname').val($(this).attr('data-firstname'));
	$('#lastname').val($(this).attr('data-lastname'));
	$('#username').val($(this).attr('data-username'));
	$('#email').val($(this).attr('data-email'));
	$('#mobile').val($(this).attr('data-mobile'));
	$('#user_role').val($(this).attr('data-user_role'));
	$('#status').val($(this).attr('data-status'));

	$("#password").prop("required",false);
	$("#confirm_password").prop("required",false);

	$("#password_div").hide();
	$("#confirm_password_div").hide();

	$("#FormModalHeading").html('Add Edit');
	$("#FormModal").modal('show');
	$("#DataForm1 [type='submit']").html('Update');
});

$(document).on("click",".delete_user",function(){
	var val = confirm("Are You Sure to Delete !!!");
	if(val==true){
		$.ajax({
			url: "<?= base_url().'delete_user_category' ?>",
			type: "POST",
			data:  { keys : $(this).attr('data-id') },
			dataType: "JSON",
			success: function(data)
			{
				if(data['status']=="Warning"){
					toastr.warning(data['msg']);
				}else{
					toastr.info(data['msg']);
					user_account_dropdown();
					$('#UserDataTable').DataTable().ajax.reload(null, false);
				}
			}
		});
	}
});


function clear_user_form(){
	$("#FormModalHeading").html('Add User');
	$("#DataForm1 [type='submit']").html('Submit');
	$("#DataForm1").trigger('reset');
	$('#user_row_id').val('');
}

//User Account Type Master
$("#ResetBtn").click(function(){
	clear_data_form();
});

$("#DataForm2").on('submit',(function(e){
	e.preventDefault();
	var formData = new FormData($("#DataForm2")[0]);
	$.ajax({
		url: "<?= base_url().'add_edit_user_account_type_category' ?>",
		type: "POST",
		data:  formData,
		dataType: "JSON",
		contentType: false,
		cache: false,
		processData:false,
		beforeSend: function() {
			$("#DataForm2 [type='submit']").attr('disabled', true);
		},
		success: function(data)
		{
			if(data['status']=="Error"){
				toastr.error(data['msg']);
			}else{
				clear_data_form();
				user_account_dropdown();
				$('#DataTable2').DataTable().ajax.reload(null, false);
				toastr.success(data['msg']);
			}
		},
		complete: function(data) {
			$("#DataForm2 [type='submit']").attr('disabled', false);
		},
	});
}));

$(document).on("click",".delete_data",function(){
	var val = confirm("Are You Sure to Delete !!!");
	if(val==true){
		$.ajax({
			url: "<?= base_url().'delete_user_account_type_category' ?>",
			type: "POST",
			data:  { keys : $(this).attr('data-id') },
			dataType: "JSON",
			success: function(data)
			{
				if(data['status']=="Warning"){
					toastr.warning(data['msg']);
				}else{
					toastr.info(data['msg']);
					user_account_dropdown();
					$('#DataTable2').DataTable().ajax.reload(null, false);
				}
			}
		});
	}
});

$(document).on("click",".edit_data",function(){
	$("#DataForm2 [type='submit']").html('Update');
	$('#account_type_row_id').val($(this).attr('data-id'));
	$('#account_name').val($(this).attr('data-name'));
	$('#account_status').val($(this).attr('data-status'));

	if($(this).attr('data-permission')==1){
		$("#account_permission").prop("checked",true);
	}else{
		$("#account_permission").prop("checked",false);
	}

	window.scroll({top: 0, behavior: "smooth"})
});

function clear_data_form(){
	$('#account_type_row_id').val('');
	$("#DataForm2 [type='submit']").html('Submit');
	$("#DataForm2").trigger('reset');
}

function user_account_dropdown(){
	$("#user_role").empty();

	$.ajax({
		url: "<?= base_url().'get_user_account_type_list' ?>",
		success: function(data){
			$("#user_role").append(data);
		}
	});

	

}

/*
$("#selectAll").click(function() {
  $("input[type=checkbox]").prop("checked", $(this).prop("checked"));
});

$("input[type=checkbox]").click(function() {
  if (!$(this).prop("checked")) {
    $("#selectAll").prop("checked", false);
  }
});*/



$(document).on("change",".selectAll",function(){

	id = $(this).attr("id");

	if($(this).is(":checked")){
		$("."+id).prop("checked",true);
	}else{
		$("."+id).prop("checked",false);
	}

});


$(document).on("click",".pass_user",function(){
			$("#ModalHeading").html('All Modules');
			
			$("#permissionmodel input[type=checkbox]").prop("checked",false);

			id = $(this).data("id");
			$("#row_id").val(id);	
			
			$.ajax({
				url: "<?= base_url().'check_permission' ?>",
				type: "POST",
				data:  {
					id: id
				},
				dataType: "JSON",
				success: function(data)
				{
					
					if(data.length){
						//edit permission
						
						$.each(data,function(id, val){
							
							
							if(val.menu_permission_add == 1){								
								$("input[name='menu_permission_add["+val.menu_id+"]']").prop("checked",true);
							}
							if(val.menu_permission_edit == 1){								
								$("input[name='menu_permission_edit["+val.menu_id+"]']").prop("checked",true);
							}
							if(val.menu_permission_delete == 1){								
								$("input[name='menu_permission_delete["+val.menu_id+"]']").prop("checked",true);
							}
							
							if(val.menu_permission_view == 1){								
								$("input[name='menu_permission_view["+val.menu_id+"]']").prop("checked",true);
							}
							
							if(val.menu_permission_download == 1){								
								$("input[name='menu_permission_download["+val.menu_id+"]']").prop("checked",true);
							}
							
							
							
						});
						
						
						$("#permissionmodel").modal('show');
						
					}else{
						
						$("#permissionmodel").modal('show');
						
					}
					
					
					
				}				
			});
				

	});


$("#").on('submit',(function(e){
	e.preventDefault();
	var formData = new FormData($("#DataForm3")[0]);
	$.ajax({
		url: "<?= base_url().'add_edit_permission' ?>",
		type: "POST",
		data:  formData,
		dataType: "JSON",
		contentType: false,
		cache: false,
		processData:false,
		beforeSend: function() {
			$("#DataForm3 [type='submit']").attr('disabled', true);
		},
		success: function(data)
		{
			if(data['status']=="Error"){
				toastr.error(data['msg']);
			}else{
				clear_user_form();
				$("#FormModal").modal('hide');

				toastr.success(data['msg']);
			}
		},
		complete: function(data) {
			$("#DataForm3 [type='submit']").attr('disabled', false);
		},
	});
}));
</script>
