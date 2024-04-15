 <head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>AdminLTE 3 | DataTables</title>

   <!-- Google Font: Source Sans Pro -->
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
   <!-- Font Awesome -->
   <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/fontawesome-free/css/all.min.css">
   <!-- DataTables -->
   <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
   <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
   <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
   <!-- Theme style -->
   <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/adminlte.min.css">
 </head>

 <body class="hold-transition sidebar-mini">
   <div class="wrapper">


     <!-- Content Wrapper. Contains page content -->
     <div class="content-wrapper">
       <!-- Content Header (Page header) -->
       <section class="content-header">
         <div class="container-fluid">
           <div class="row mb-2">
             <div class="col-sm-6">
               <h1>Company Master</h1>
             </div>
             <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                 <li class="breadcrumb-item"><a href="#">Home</a></li>
                 <li class="breadcrumb-item active"><a href="<?php echo base_url() ?>Company/company_master_list">CompanyMasterList</a></li>
               </ol>
             </div>
           </div>
         </div><!-- /.container-fluid -->
       </section>
	   <div class="container-fluid"> 
<?php if ($this->session->flashdata('message')): ?>
    <div class="alert alert-success message" style="z-index: 11111;position: absolute;right: 15px;">
        <?php echo $this->session->flashdata('message'); ?>
    </div>
	<script type="text/javascript">
        setTimeout(function(){
            $('.message').fadeOut('fast');
        }, 5000);
    </script>
<?php endif; ?>
			  
       <!-- Main content -->
       <section class="content">
         <div class="container-fluid">
           <div class="row">
             <div class="col-12">
               <div class="card">
                 <!-- /.card-header -->
                 <div class="card-body">
                   <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
				   <div class="row">
                       <div class="col-sm-12" style="justify-content: flex-end;
    display: flex;
    gap: 5px;
}" >
                         <div class="dt-buttons btn-group flex-wrap">
                           <button class="btn btn-info btn-sm" style="background-color:#32B9E7;"> <a href="<?php echo base_url() ?>Company/company_master" style="color:white"><i class="fa fa-plus"></i> New </a> </button>
                         </div>
						
						 <div class="dt-buttons btn-group flex-wrap">
						 <button class="btn btn-info editemployee btn-sm" style="background-color:#32B9E7;"><i class="far fa-edit"></i>  Edit  </button>
							
							</div>
				  
							<div class="dt-buttons btn-group flex-wrap">
							<button class="btn btn-info deleteemployee btn-sm" aria-hidden="true" data-dismiss="alert" style="background-color:#32B9E7;"><i class="fa fa-trash"></i>  Delete  </button>
						      
						
						  </div>
						    
						     
						  <div class="dt-buttons btn-group flex-wrap">
						  
                          <button class="btn btn-info changestatus btn-sm" style="background-color:#32B9E7;"><i class="fas fa-toggle-on"></i>  Status  </button>
                         </div>
						 <div class="dt-buttons btn-group flex-wrap">
                           <button class="btn btn-info viewcompany btn-sm" style="background-color:#32B9E7;"><i class="fas fa-eye"></i>  View  </button>
                         </div>
                       </div>
                      
                     </div>
					  <div class="card-header">
                 </div>
                   </div>
				   <br>
                   <div class="row">
                     <div class="col-sm-12">
                       <tr>
                         <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending"> </th>
                         <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending"> </th>
                         <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending"> </th>
                         <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending"> </th>
                         <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"> </th>
                       </tr>
                       </thead>
					   <div class="table-responsive">
                       <table class="table table-bordered table-striped" id="example1">
                  <thead>
                    <tr>
					   <th>  </th>
                   
					  <th>Company Logo</th>
                      <th> Company Name </th>
					  <th> Email </th>
					  <th> Landline </th>
					   <th> Status </th>
					 
                    </tr>
                  </thead>
                 <tbody>
				
		<?php
		    $i = 1;
			
	      foreach($key as $val){
			  
		    echo "<tr>";
			 echo "<td><input type='radio' id='company_$val->company_id' name='company' class='employees'  onclick='myFunction()'></td>";
		
	        echo "<td><img width='70px' src='".base_url('site/uploads/').$val->logo."'>  </td>";
			echo "<td>".$val->name."</td>";
		    echo "<td>".$val->email."</td>";
			
            echo "<td>".$val->landline."</td>";
		 
				echo "<td>";
			 if($val->status == 0){
			      echo "<span style='color:green'>Active </span>";
		  }else{
              echo "<span style='color:red'>InActive </span>";
		  }
		  echo"</td>";	
			
			 
			
			 
			echo "</tr>";
					?>

					
				  <?php } ?>
				  </table>
				     </div>
                     </div>
                     <!-- /.card-body -->
                   </div>

                 </div>
               </div>
               <!-- /.col -->
             </div>
             <!-- /.row -->
           </div>
           <!-- /.container-fluid -->
       </section>
       <!-- /.content -->
     </div>

   </div>

</div>





   <!-- Bootstrap 4 -->
   <script src="<?php echo base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
   <!-- DataTables  & Plugins -->
   <script src="<?php echo base_url() ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
   <script src="<?php echo base_url() ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
   <script src="<?php echo base_url() ?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
   <script src="<?php echo base_url() ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
   <script src="<?php echo base_url() ?>assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
   <script src="<?php echo base_url() ?>assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
   <script src="<?php echo base_url() ?>assets/plugins/jszip/jszip.min.js"></script>
   <script src="<?php echo base_url() ?>assets/plugins/pdfmake/pdfmake.min.js"></script>
   <script src="<?php echo base_url() ?>assets/plugins/pdfmake/vfs_fonts.js"></script>
   <script src="<?php echo base_url() ?>assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
   <script src="<?php echo base_url() ?>assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
   <script src="<?php echo base_url() ?>assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
   <!-- AdminLTE App -->
   <script src="<?php echo base_url() ?>assets/dist/js/adminlte.min.js"></script>
  
   <!-- Page specific script -->
   <script>
     $(function() {
       $("#example1").DataTable();

     });
   </script>
   
   
   <script>
    $(document).ready(function () {
    $(".editemployee").click(function(){
				     if($(".employees").is(":checked")){
						  if($(".employees:checked").length == 1){
							  var company_id = $(".employees:checked").attr("id");
							  company_id = company_id.split("_");
							 
							  window.location.href = "<?php echo base_url() ?>Company/company_edit/"+company_id[1];
						  }else{
							  alert("Please select one Employee");
						  }
					 }else{
						 alert("Please select  Employee");
					 }
					 return false;
			   });
			   
			   
			   
			   
			  $(".deleteemployee").click(function(){
				     if($(".employees").is(":checked")){
						  if($(".employees:checked").length == 1){
							  var company_id = $(".employees:checked").attr("id");
							  company_id = company_id.split("_");
							  e = confirm("Do you want to delete the employee?");
							  if(e)
							  window.location.href = "<?php echo base_url()?>company/delete_companymaster/"+company_id[1];
						  }else{
							  alert("Please select one Employee");
						  }
					 }else{
						 alert("Please select one Employee");
					 }
					  return false;
			   }); 
			
			     
    $(".viewcompany").click(function(){
				     if($(".employees").is(":checked")){
						  if($(".employees:checked").length == 1){
							  var company_id = $(".employees:checked").attr("id");
							  company_id = company_id.split("_");
							 
							  window.location.href = "<?php echo base_url() ?>Company/company_view/"+company_id[1];
						  }else{
							  alert("Please select one company");
						  }
					 }else{
						 alert("Please select  company");
					 }
					 return false;
			   });
			   
			   
	 $(".changestatus").click(function(){
				     if($(".employees").is(":checked")){
						  if($(".employees:checked").length == 1){
							  var company_id = $(".employees:checked").attr("id");
							  company_id = company_id.split("_");
							  e = confirm("Do you want to change the Status?");
							  if(e)
							  window.location.href = "<?php echo base_url()?>company/status_companymaster/"+company_id[1];
						  }else{
							  alert("Please select one Company");
						  }
					 }else{
						 alert("Please select one Company");
					 }
			   });
			   
			
	});
			   
   </script>
   
