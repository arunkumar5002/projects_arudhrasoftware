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
                        <li class="breadcrumb-item active"><a href="<?php echo base_url() ?>purchase/purchasequote">Purchase Quote List</a></li>
                    </ol>
                </div>
            </div>
			<div class="row">
				<div class="col-12">
					<div class="card">
						
						<div class="card-body">
						 <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method='post' action="<?php echo base_url()?>web/addcontact">
										<input type=hidden name='contactid' id='contactid'>
										<div class="row">
										<div class="col-md-12">
										<div class="form-group">
												<label class="form-check-label" for="customername">Contact Type <span class="required">*</span>
                                                  </label></br>
													<?php
											if(isset($contacttype) && !empty($contacttype)){
												foreach($contacttype as $tmp){
													
											?>
                                           
                                               <input type="radio" class="contacttype" required style="margin-left:110px;" name="contacttype" value='<?php echo $tmp->typeid ?>'> <?php echo $tmp->contacttype?>
                                            
											<?php
											
												}
											}
											?>
												</div>
											</div>
										
										
                                       <div class="row"></div><br></br>
									   
										<div class="col-md-3">
												<div class="form-group">
													<label class="form-check-label">Company Name<span class="text-required">*</span></label>
													<input type="text" style='text-align: right;' id="customername" name="customername" class="form-control form-control-sm">
												</div>
										</div>
										
										<div class="col-md-3">
												<div class="form-group">
													<label class="form-check-label">Website <span class="text-required">*</span></label>
													<input type="text" style='text-align: right;' id="website" name="website"  class="form-control form-control-sm">
												</div>
										</div>
										
										<div class="col-md-3 vendordiv">
												<div class="form-group">
													<label class="form-check-label">Name of the Bank <span class="text-required">*</span></label>
													<input type="text" style='text-align: right;' id="bankname" name="bankname"  class="form-control form-control-sm">
												</div>
										</div>
										
										<div class="col-md-3 vendordiv">
												<div class="form-group">
													<label class="form-check-label">Account Number <span class="text-required">*</span></label>
													<input type="text" style='text-align: right;' id="accountnumber" name="accountnumber"  class="form-control form-control-sm">
												</div>
										</div>
										
										<div class="col-md-3">
												<div class="form-group">
													<label class="form-check-label">Address 1 <span class="text-required">*</span></label>
													<input type="text" style='text-align: right;' id="address1" name="address1"  class="form-control form-control-sm">
												</div>
										</div>
										
										
										<div class="col-md-3">
												<div class="form-group">
													<label class="form-check-label">VAT Registration  <span class="text-required">*</span></label>
													<input type="text" style='text-align: right;' id="gstregistration" name="gstregistration"  class="form-control form-control-sm">
												</div>
										</div>
										
										<div class="col-md-3">
												<div class="form-group">
													<label class="form-check-label">Address 2<span class="text-required">*</span></label>
													<input type="text" style='text-align: right;' id="address2" name="address2"  class="form-control form-control-sm">
												</div>
										</div>
										
										<div class="col-md-3">
												<div class="form-group">
													<label class="form-check-label">Currency<span class="text-required">*</span></label>
													<select id="currency" name="currency" class="form-control form-control-sm" required>
													<option value=''>--Select Currency--</option>
													<option value='Singapore Dollar'>Singapore Dollar</option>
													<option value='bahrain currency'>bahrain currency</option>
													<option value='Singapore Dollar'>Singapore Dollar</option>
													<option value='indian currency'>indian currency</option>
													<option value='Euro'>Euro</option>
													<option value='Pound sterling'>Pound sterling</option>
													<option value='
Kuwaiti Dinar'>
Kuwaiti Dinar</option>
													
												</select>
												</div>
										</div>
										
                                        <div class="col-md-3">
												<div class="form-group">
													<label class="form-check-label">Phone<span class="text-required">*</span></label>
													<input type="text" style='text-align: right;' id="phone" name="phone"  class="form-control form-control-sm">
												</div>
										</div>
										
										 <div class="col-md-3">
												<div class="form-group">
													<label class="form-check-label">Contact Person<span class="text-required">*</span></label>
													<input type="text" style='text-align: right;' id="notes" name="notes"  class="form-control form-control-sm">
												</div>
										</div>
										
										
										 <div class="col-md-3">
												<div class="form-group">
													<label class="form-check-label">Email<span class="text-required">*</span></label>
													<input type="text" style='text-align: right;' id="email" name="email"  class="form-control form-control-sm">
												</div>
										</div>
										
                                       <div class="col-md-3">
												<div class="form-group">
													<label class="form-check-label">Account Name<span class="text-required">*</span></label>
													<select class='form-control form-control-sm' name='accountname' id='accountname' required>
													<option value=''>Choose..</option>
													<?php
												if(isset($accountnames) && !empty($accountnames)){
													foreach($accountnames as $tmp){
														echo "<option value='".$tmp->accountid."'>$tmp->accountname</option>";
													}
												}
												?>
												</select>
												</div>
											</div>
											
											<hr/>
											<div class="form-group" style="margin-top:50px;">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-success btn-sm">Submit</button>
												<button type="reset" class="btn btn-primary btn-sm">Cancel</button>
                                            </div>
                                        </div>
                                      </div>
                                    </form>         
				</div>
				
				
				<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							
								<div class="col-md-12 text-right">
									
									<a href="#" class="btn btn-info btn-sm DTTT_button DTTT_button_copy editcontact"><i class="far fa-edit"></i> Edit </a>
									
									<a class='btn btn-info btn-sm DTTT_button DTTT_button_copy changestatus' style='padding:5px 10px 5px 10px;cursor:pointer'>Change Status</a> 
									
									<a href="#" class="btn btn-info btn-sm DTTT_button DTTT_button_copy deletecontact"><i class="fas fa-trash"></i> Delete </a>
									
									<hr/>
								</div>
			                   
                                    <table id="example" class="table table-striped responsive-utilities jambo_table">
                                        <thead>
                                            <tr class="headings">
                                                 <th>
                                                </th>
                                                <th>S.No</th>
                                                <th>Type</th>
                                                <th>Customer Name</th>
                                                <th>Email</th>          
                                                <th>Phone</th>         
                                                <th>A/C Name</th>        
                                                <th>Status</th> 
                                            </tr>
                                        </thead>

                                        <tbody>
                                           <?php
										   if(isset($contacts) && count($contacts)){
											   $i = 1;
											   foreach($contacts as $tmp){
											
										   ?>
                                           
                                            <tr class="odd pointer">
                                                <td>
                                                    <input type="radio" name='contactCheck' class="tableflat contacts" id='contact_<?php echo $tmp->contactid;?>'>
                                                </td>
                                                <td class=" "><?php echo $i++;?></td>
                                                
                                                <td class=" "><?php echo get_contacttype($tmp->contacttype);?>
                                                <td class=" "><?php echo $tmp->customername;?>
                                                </td>
                                                
												<td class=" "><?php echo $tmp->email;?>
												<td class=" "><?php echo $tmp->phone;?>
												<td class=" "><?php echo get_accountname($tmp->accountname);?>
                                                <td class=" ">
												<?php
												if($tmp->status == 0)
													echo "Active";
												else if($tmp->status == 1)
													echo "Inactive";
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


    <!------------------------------------->	
	
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
			   
			   $(".editcontact").click(function(){
				     if($(".contacts").is(":checked")){
						  if($(".contacts:checked").length == 1){
							  var id = $(".contacts:checked").attr("id");
							  id = id.split("_");
							    $.ajax({
								  url: "<?php echo base_url();?>web/get_contactdetails",
								  dataType: "json",
								  type:"POST",	  
								  data: {
									contactid: id[1]
								  },
								  success: function( data ) {
									   $(".vendordiv").hide();
									  $.each(data,function(id,value){
										  if(id == 'contacttype'){
											  if(value == 2){
												  $(".vendordiv").show();
											  }
										  }else{
											$("#"+id).val(value);
										  }
										  
									  });
									  $('input:radio[name="contacttype"]').filter('[value='+data.contacttype+']').prop('checked', true);
								  }
								});
						  }else{
							  alert("Please select one contact");
						  }
					 }else{
						 alert("Please select one contact");
					 }
			   });
			   
			   
			   
			   $(".changestatus").click(function(){
				     if($(".contacts").is(":checked")){
						  if($(".contacts:checked").length == 1){
							  var id = $(".contacts:checked").attr("id");
							  id = id.split("_");
							  window.location.href = "<?php echo base_url()?>web/contactstatus/"+id[1];
						  }else{
							  alert("Please select one user");
						  }
					 }else{
						 alert("Please select one user");
					 }
			   });
			   
			   $(".deletecontact").click(function(){
				     if($(".contacts").is(":checked")){
						  if($(".contacts:checked").length == 1){
							  var id = $(".contacts:checked").attr("id");
							  id = id.split("_");
							  window.location.href = "<?php echo base_url()?>web/deletecontact/"+id[1];
						  }else{
							  alert("Please select one user");
						  }
					 }else{
						 alert("Please select one user");
					 }
			   });
            });
			
			
        </script>
		
		<script type='text/javascript'>
		  $(document).ready(function () {
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
							if($("#editsubcategory").val()){
								$("#subcategory").val($("#editsubcategory").val());
							}
							$("#editsubcategory").val('');
						 }
						 else{
							 $("#subcategory").html(data);
							 $("#subcategory").attr("disabled","true");
						 }
					  }
					});
			   });
			   
			   
			     $("#newaccountname").click(function(){
					 
					 $("#acname").val('');
					 $("#subcategory").val('');
					 $("#category").val('');
					 $("#maingroup").val('');
					 
				 });
				 
			     $("#saveac").click(function(){
				   $.ajax({
					  url: "<?php echo base_url();?>web/addcontactaccountname",
					  type:"POST",	 
					  dataType: "json",
					  data: {
						//accountid:$("#accountid").val(),  
						maingroup: $("#maingroup").val(),
						category: $("#category").val(),
						subcategory: $("#subcategory").val(),
						acname: $("#acname").val()
					  },
					  success: function( data ) {
						  if(data.success == true){
							
							 $('#accountname').append('<option selected="selected" value="'+data.acc_id+'">'+data.accountname+'</option>');
							   $("#closeclick").click();
							 
						  }else{
							  alert("Account Name Exists");
							  $("#acname").val("");
						  }
					  }
					});
			   });
			   
			   
			    $('body').keydown(function(event) {
						 if(event.which == 115) { //F4
							$(".editcontact").trigger("click");
						}
						else if(event.which == 119) { //F8
							$(".changestatus").trigger("click");
						}
						else if(event.which == 120) { //F9
							$(".deletecontact").trigger("click");
						}
					});
					
					
					$(".vendordiv").hide();
					$(".contacttype").change(function(){
						if($(this).val() == 2){
							$(".vendordiv").show();
						}else{
							$(".vendordiv").hide();
						}
					});
			});
			   
		</script>
