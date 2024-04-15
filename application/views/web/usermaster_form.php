



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <?php if (isset($record)) {?>
          <p class="m-0 text-dark">
 </p>
        <?php } else {?>
           <p class="m-0 text-dark">
 </p>
        <?php }?>
      </div><!-- /.col -->
      <div class="col-sm-6">
       <!--  <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Edit Banner</li>
        </ol> -->
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
    <!-- /.content-header -->

<!-- Main content -->
<section class="content">
<div class="container-fluid">

<div class="row">
  <div class="col-md-12">
 
 
     
    <form action="<?php echo base_url()?>admin/save_service" method="post" id="question" enctype="multipart/form-data">

    <div class="card card-primary">

      <div class="card-header">
       
          <p class="card-title">Create User
 </p>
          <input type="hidden" name="service_id" value="" >
      

        
        <!-- /.card-tools -->
      </div>
      <!-- /.card-header -->
      <div class="card-body">
       
		

		
		<div class="row">
          <div class="col-md-6">
          <div class="form-group">
            <label> Employee Name  :</label>
           <input type="text" name="employee_name" class="form-control"  autocomplete="off" placeholder=" Employee_name *"  value="<?php echo isset($ghfyhfyhe)?$ghfyhfyhe->price:''?>"">
		<span class="error" id="price_err" style="color:red"> </span>
          </div>
          </div>

		
		
	
          <div class="col-md-6">
          <div class="form-group">
            <label> Email  :</label>
           <input type="text" name="email" class="form-control"  autocomplete="off" placeholder=" Email *"  value="<?php echo isset($ghfyhfyhe)?$ghfyhfyhe->price:''?>"">
		<span class="error" id="price_err" style="color:red"> </span>
          </div>
          </div>
  
	
          <div class="col-md-6">
          <div class="form-group">
            <label> Contact No  :</label>
           <input type="text" name="contact_no" class="form-control" autocomplete="off" placeholder=" Contact_no *"  value="<?php echo isset($ghfyhfyhe)?$ghfyhfyhe->price:''?>"">
		<span class="error" id="price_err" style="color:red"> </span>
          </div>
          </div>
       
	
          <div class="col-md-6">
          <div class="form-group">
            <label> Designation  :</label>
           <input type="text" name="designation" class="form-control" autocomplete="off" placeholder=" Designation *"  value="<?php echo isset($ghfyhfyhe)?$ghfyhfyhe->price:''?>"">
		<span class="error" id="price_err" style="color:red"> </span>
          </div>
          </div>
    
		
		
          <div class="col-md-6">
          <div class="form-group">
            <label> User Name  :</label>
           <input type="text" name="username" class="form-control" autocomplete="off" placeholder=" Username *"  value="<?php echo isset($ghfyhfyhe)?$ghfyhfyhe->price:''?>"">
		<span class="error" id="price_err" style="color:red"> </span>
          </div>
          </div>

		
		
          <div class="col-md-6">
          <div class="form-group">
            <label> Password  :</label>
         <input type="text" name="Password" class="form-control"  autocomplete="off" placeholder=" Password *"  value="<?php echo isset($ghfyhfyhe)?$ghfyhfyhe->price:''?>"">
		<span class="error" id="price_err" style="color:red"> </span>
          </div>
          </div>
		  </div>
		  <div class = "row"><div class="col-md-12"><h3 class="text-center">MODULES</h3></div>
		  </div>

                      <!-- checkbox -->
					    <div class = "row">
                       <div class="col-md-4">
					    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" id="customCheckbox1" value="option1">
                          <label for="customCheckbox1" class="custom-control-label">Reports </label>
                        </div>
						</div></div>
						<div class="col-md-4">
					    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" id="customCheckbox2" value="option2">
                          <label for="customCheckbox1" class="custom-control-label">Finance </label>
                        </div>
						</div></div>
						<div class="col-md-4">
					    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" id="customCheckbox3" value="option3">
                          <label for="customCheckbox1" class="custom-control-label">Bank Reconciliation </label>
                        </div>
						</div></div>
						<div class="col-md-4">
					    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" id="customCheckbox4" value="option4">
                          <label for="customCheckbox1" class="custom-control-label">Aging Schedule </label>
                        </div>
						</div></div>
						<div class="col-md-4">
					    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" id="customCheckbox5" value="option5">
                          <label for="customCheckbox1" class="custom-control-label">HR</label>
                        </div>
						</div></div>
						<div class="col-md-4">
					    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" id="customCheckbox6" value="option6">
                          <label for="customCheckbox1" class="custom-control-label">Purchase </label>
                        </div>
						</div></div>
						<div class="col-md-4">
					    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" id="customCheckbox7" value="option7">
                          <label for="customCheckbox1" class="custom-control-label">Sales </label>
                        </div>
						</div></div>
                        
                       
                       
                      </div>
                    </div>
  
		</div>
	    
		  <div class="card-footer">
        <button type="submit" name="submitform" id="submitform" class="btn btn-primary" style="float: left;background-color:33B9E7;">Submit</button>
      
        <button type="cancel" name="cancel" id="submitform" class="btn btn-primary" style="float: left; margin-left:5px;">Cancel</button>
      </div>
		        </div>
				
			  </div>
          </div>
          </div>
        
		 



   
      <!-- /.card-body -->
     
   </form>
    <!-- /.card -->
  


<!-- /.container-fluid -->
</section>

<!-- /.content-wrapper -->


