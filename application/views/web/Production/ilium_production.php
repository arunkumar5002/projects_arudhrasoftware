<?php echo load_datatables(); ?>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">


<style>
  table {
    border-collapse: collapse;
    width: 100%;
  }

  th, td {
    border: 1px solid black;
    padding: 8px;
    text-align: left;
  }

  th {
    background-color: #f2f2f2;
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
                        
                        <li class="breadcrumb-item active"><a href="<?= base_url().'ilium_production' ?>">Production</a></li>
                    </ol>
                </div>
            </div>
			
			<div class="row">
				<div class="card-body">
					<div class="tab-content" style="background-color:#79E0EE;height:50px;">
					
					<input type="checkbox" name="Customer" style="margin-left: 40px;
    margin-top: 18px;">
					<span> Customer </span>
					
					
					
					<input type="checkbox" name="order" style="margin-left: 40px;
    margin-top: 18px;">
					<span> Order </span>
					
					
					
					<input type="checkbox" name="product" style="margin-left: 40px;
    margin-top: 18px;">
					<span> Product </span>
					
					
					
					<input type="checkbox" name="device" style="margin-left: 40px;
    margin-top: 18px;">
					<span> Device Setting </span>
					
					
					</div>
				</div>
			</div>
					
					
					
					
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header p-2">
							<ul class="nav nav-pills" style="font-size:11px;">
								<li class="nav-item"><a class="nav-link active" href="#employee_details" id="nav_employee_details" data-toggle="tab">Orders</a></li>
								<li class="nav-item"><a class="nav-link" href="#passport_details" id="nav_passport_details" data-toggle="tab">Prod</br>Pre Check </a></li>
								<li class="nav-item"><a class="nav-link" href="#resident_permit_details" id="nav_resident_permit_details" data-toggle="tab">Scheduler</a></li>
								<li class="nav-item"><a class="nav-link" href="#cpr_details" id="nav_cpr_details" data-toggle="tab">Stoppage Log</a></li>
								<li class="nav-item"><a class="nav-link" href="#bank_details" id="nav_bank_details" data-toggle="tab">Let's Roll</a></li>
								<li class="nav-item"><a class="nav-link" href="#salary_details" id="nav_salary_details" data-toggle="tab">QA-Stage 1</br>Ver-2</a></li>
								<li class="nav-item"><a class="nav-link" href="#certificate_details" id="nav_certificate_details" data-toggle="tab">QA-Stage 1 </a></li>
								<li class="nav-item"><a class="nav-link" href="#production_log" id="nav_resident_permit_details" data-toggle="tab">Prod Log  </a></li>
								<li class="nav-item"><a class="nav-link" href="#roll_defects" id="nav_cpr_details" data-toggle="tab">Roll Defects </a></li>
								<li class="nav-item"><a class="nav-link" href="#production_schedule" id="nav_bank_details" data-toggle="tab">Prod Schedule </a></li>
								<li class="nav-item"><a class="nav-link" href="#pallet_list" id="nav_salary_details" data-toggle="tab">Pallet List</a></li>
								<li class="nav-item"><a class="nav-link" href="#old_stock" id="nav_certificate_details" data-toggle="tab">Old Stock</a></li>
							</ul>
						</div>
						<div class="card-body">
							<div class="tab-content">
								<div class="tab-pane active" id="employee_details">
								
								
								
								
								
								</div>
								<div class="tab-pane" id="passport_details">
									    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-3">
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Order Details</h3>
       
                </div>
              </div>
              <div class="card-body">
                    
  <form>
    <div>
      <label for="textbox1">Customer :</label></br>
      <input type="text" class="form-control" id="textbox1" name="textbox1">
    </div>
    <div >
      <label for="textbox2">Order No:</label></br>
      <input type="text" class="form-control" id="textbox2" name="textbox2">
    </div>
    <div >
      <label for="textbox3">Line Item:</label></br>
      <input type="text" class="form-control" id="textbox3" name="textbox3">
    </div>
    <div >
      <label for="textbox4">Order Status:</label></br>
      <input type="text" class="form-control" id="textbox4" name="textbox4">
    </div>
    <div >
      <label for="textbox5">Ilium Ref:</label></br>
      <input type="text" class="form-control" id="textbox5" name="textbox5">
    </div>
    <div >
      <label for="textbox6">ART Code:</label></br>
      <input type="text" class="form-control" id="textbox6" name="textbox6">
    </div></br>
	<div >
      <label for="textbox6">Bar Code:</label></br>
      <input type="text" class="form-control" id="textbox6" name="textbox6" style="height:50px;">
    </div>
    
  </form>
                 
              </div>
            </div>
            <!-- /.card -->

    
            <!-- /.card -->
          </div>
          <!-- /.col-md-6 -->
          <div class="col-lg-4">
            <div class="card">
              <div class="card-header border-0">
               
                  <h3 class="card-title">Product Details</h3>
				    </div>
				<p></p>
				 <div class="d-flex justify-content-between">
				 <div class="container">
				 <div class="row">
				 <div class="col-6">
				 
				  <form>
    <div>
      <label for="textbox1">Vel :</label></br>
      <input type="text" class="form-control" id="textbox1" name="textbox1">
    </div>
    <div>
      <label for="textbox2">Fixation:</label></br>
      <input type="text" class="form-control" id="textbox2" name="textbox2">
    </div>
    <div>
      <label for="textbox3">Layer 1:</label></br>
      <input type="text" class="form-control" id="textbox3" name="textbox3">
    </div>
    <div>
      <label for="textbox4">Layer 2:</label></br>
      <input type="text" class="form-control" id="textbox4" name="textbox4">
    </div>
    <div>
      <label for="textbox5">Core:</label></br>
      <input type="text" class="form-control" id="textbox5" name="textbox5">
    </div>
    <div>
      <label for="textbox6">Layer 3:</label></br>
      <input type="text" class="form-control" id="textbox6" name="textbox6">
    </div>
	 <div>
      <label for="textbox6">Layer 4:</label></br>
      <input type="text" class="form-control" id="textbox6" name="textbox6">
    </div>
	<div>
      <label for="textbox6">Fixation:</label></br>
      <input type="text" class="form-control" id="textbox6" name="textbox6">
    </div>
	<div >
      <label for="textbox6">Total (g/m2):</label></br>
      <input type="text" class="form-control" id="textbox6" name="textbox6" style="height:50px;">
    </div><br/>
    
  </form>
  
  </div>
   <div class="col-6">
              
               
                       
  <form>
    <div>
      <label for="textbox1">Product ID :</label></br>
      <input type="text" class="form-control" id="textbox1" name="textbox1">
    </div>
    <div>
      <label for="textbox2">Subset ID:</label></br>
      <input type="text" class="form-control" id="textbox2" name="textbox2">
    </div>
    <div>
      <label for="textbox3">Diameter:</label></br>
      <input type="text" class="form-control" id="textbox3" name="textbox3">
    </div>
    <div>
      <label for="textbox4">Width:</label></br>
      <input type="text" class="form-control" id="textbox4" name="textbox4">
    </div>
    <div>
      <label for="textbox5">Length:</label></br>
      <input type="text" class="form-control" id="textbox5" name="textbox5">
    </div>
    <div>
      <label for="textbox6">Weight:</label></br>
      <input type="text"  class="form-control" id="textbox6" name="textbox6">
    </div>
	 <div>
      <label for="textbox5">Type:</label></br>
      <input type="text" class="form-control" id="textbox5" name="textbox5">
    </div>
    <div>
      <label for="textbox6">Tube :</label></br>
      <input type="text" class="form-control" id="textbox6" name="textbox6">
    </div>
    
  </form>
                 
              </div>
		
                </div>
				</div>
				</div>
            
             
			 
			 
            </div>
			</div>
            <!-- /.card -->
			<div class="col-lg-4">
<div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Order confirmation</h3>
       
                </div>
              </div>
             			 <div class="d-flex justify-content-between">
				 <div class="container">
				 <div class="row">
				 <div class="col-6">
				 
				  <form>
    <div>
      <label for="textbox1">Gross weight :</label></br>
      <input type="number" class="form-control" id="textbox1" name="textbox1">
    </div>
	&nbsp&nbsp
    <div>
	
      &nbsp&nbsp<label for="textbox2">Rolls/pallet:</label>
	  &nbsp&nbsp
	  &nbsp&nbsp
    </div>
    <div>
     <input type="checkbox" name="" id="">
    </div>
    <div>
      
      <input type="number" class="form-control" id="textbox1" name="textbox1">
	  <label for="textbox1">Control:</label></br>
    </div>
    <div>
	   <input type="checkbox"  name="" id="">
      <label for="textbox5">Product:</label></br>
      
    </div>
    <div>
	   <input type="checkbox"  name="" id="">
      <label for="textbox6"> Device Settings:</label></br>
      
    </div>
	 <div>
      <button class="btn btn-info" type="submit">Line Settings <i class="fas fa-cogs"></i></button>&nbsp;&nbsp;
    </div>
	</br>
    
  </form>
  
  </div>
   <div class="col-6">
              
               
                       
  <form>
    <div>
	   <input type="checkbox" name="" id="">
       <label for="textbox2">Pallet Offset:</label></br>
      <input type="number" class="form-control" id="textbox2" name="textbox2">
    </div>
    <div>
      &nbsp&nbsp
      <input type="text" id="textbox2" class="form-control" name="textbox2">
    </div>
    <div>
      <label for="textbox3">QA Notification:</label></br>
     
    </div>
    <div>
      
      <input type="number" id="textbox2" class="form-control" name="textbox2">
	  <label for="textbox2">Cohesion:</label></br>
    </div>
    <div>
     <button class="btn btn-info" type="submit"> Production Order&nbsp; <i class="fas fa-sync-alt"></i></button>
    </div>
    
    
  </form>
                 
              </div>
		
                </div>
				</div>
				</div>
            
            </div>
			</div>
       
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
           		
									
								
								<div class="tab-pane" id="cpr_details">
									
									
									
									
								</div>
								<div class="tab-pane" id="bank_details">
									
									
									
									
								</div>
								<div class="tab-pane" id="salary_details">
									
									
									
									
								</div>
								<div class="tab-pane" id="certificate_details">
									
									
									
									
									
									
									
									
								</div>
								
								
								<div class="tab-pane" id="production_log">
								
									<h4> Pallet List </h4> 
									<div class="row">
									<div class="col-md-12" style="margin-left: 676px;">
									<span> Log Count: </span>
									<input type="text" name="log" id=""> 
									</div>
									</div>
									<div class="row">
									<button class="btn btn-info" type="submit">Add New Log  &nbsp; <i class="fas fa-database"></i></button>&nbsp;&nbsp;
									<button class="btn btn-info" type="submit"> Refresh  &nbsp; <i class="fas fa-sync-alt"></i></button>
									</div>
									
									<div class="row">
									<table style="margin-top:40px;">
  <thead>
    <tr>
      <th> ID </th>
      <th> Date and Time </th>
      <th> Name </th>
      <th> Surname </th>
      <th> Production Order </th>
	  <th> Data </th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>1</td>
      <td>2023-05-23 10:00 AM</td>
      <td>John</td>
      <td>Doe</td>
      <td>12345</td>
	  <td> hello </td>
    </tr>
    <tr>
      <td>2</td>
      <td>2023-05-23 11:30 AM</td>
      <td>Jane</td>
      <td>Smith</td>
      <td>67890</td>
	  <td> hello </td>
    </tr>
   
  </tbody>
</table>
</div>

									
									
								</div>
								<div class="tab-pane" id="roll_defects">
									
									
									
									
								</div>
								<div class="tab-pane" id="production_schedule">
									
									
									
									
								</div>
								<div class="tab-pane" id="pallet_list">
									
									
									
									
								</div>
								<div class="tab-pane" id="old_stock">
									
									
									
									
									
									
									
									
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
		
			<input type="hidden" name="user_row_id" id="user_row_id" />
			<div class="modal-content">
				<div class="modal-header">
					<h4 id="FormModalHeading">Contribution</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
					<div class="col-md-6">
									
						
							<div class="form-group">
								<label class="form-check-label">Employee <span class="text-required">*</span></label>
								<select class="form-control form-control-sm emp" name="" id="emp" required>
									
									
								</select>
							</div>
						</div>
					
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-check-label">Employer Contribution <span class="text-required">*</span><span class="text-required" id="employ"></span></label>
								<input type="number" class="form-control form-control-sm value-1" name="employer" id="amount" required />
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-check-label">Employee Contribution  <span class="text-required">*</span><span class="text-required" id="contibution"></span></label>
								<input type="number" class="form-control form-control-sm value-2" name="employee" id="rate" required />
							</div>
						</div>
							<div class="col-md-6">
							<div class="form-group">
								<label class="form-check-label">Total SIO Contribution  <span class="text-required">*</span></label>
								<input type="text" class="form-control form-control-sm result" name="" id="totalPercentage" required />
							</div>
						</div>
				
					</div>
				</div>
				<div class="modal-footer" style="text-align:left !important;">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-success" id="sub">Submit</button>
					<button type="reset" class="btn btn-danger">Reset</button>
				</div>
			</div>
		
	</div>
</div>
