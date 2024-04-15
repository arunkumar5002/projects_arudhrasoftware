<div class="content-wrapper">


 <html lang="en">
 <head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
 </head>
  
  
  <div class="container mt-3">

  
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
   New Loan
  </button>
</div>

<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title"> New Loan Master </h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
	  <form method="POST" action="<?php echo base_url()?>company/" enctype="multipart/form-data">
	  
	   <div class="row">
	   <div class="col-md-6 col-sm-6 col-xs-6">
                                <label  for="bank_accounts">Bank Accounts <span
                                        class="required">*</span>
                                </label>
                               
                                    <select id="bank_accounts" name="bank_accounts" class=" form-control"
                                        required="">
                                        <option value="">--Select --</option>
                                        <option value=""> </option>
                                        <option value=""> </option>
                                        <option value=""> </option>
                                    </select>
                                </div>
	  
	  
	  
	  
	    <div class="col-md-6 col-sm-6 col-xs-6">
                                <label  for="employee">Employee <span
                                        class="required">*</span>
                                </label>
                               
                                    <select id="employee" name="employee" class=" form-control"
                                        required="">
                                        <option value="">--Select employee--</option>
                                        <option value=""> </option>
                                        <option value="" </option>
                                        <option value=""> </option>
                                    </select>
                                </div>
	  
	
	  
	 
    <div class="mb-3">
    <label class="form-label">Loan Date:</label>
    <input type="text" class="form-control" id="datepicker"  placeholder="Enter Date" name="date">
    </div>
  
     <div class="mb-3">
    <label class="form-label">Loan Amount :</label>
    <input type="text" class="form-control"  placeholder="Enter ammount" name="ammount">
	</div>
    </div>
	
	 <div class="mb-3">
    <label class="form-label">Loan Installments:</label>
    <input type="text" class="form-control"  placeholder="Enter installments" name="installments">
    </div>
	
	 

      <!-- Modal footer -->
      <div class="modal-footer">
	  
	    <div class="form-group">
            <button id="submitBtn" type="submit" class="btn btn-primary submit-button">Submit</button>
		</form>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
</div>
</div>




<script>
  $( function() {
    $( "#datepicker" ).datepicker({
      showOtherMonths: true,
      selectOtherMonths: true
    });
  } );
  </script>



 <!-- /.Tax Master -->

</br>
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

               <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"> Tax Master</h3>
              </div>
			  <div class="dt-buttons btn-group flex-wrap">     
          

              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Tax Code</th>
                    <th>Description</th>
                    <th>Percentage</th>
					  <th>Status</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
				     
					<td> </td>
					<td> </td>
                    <td> </td>
					<td> </td>
                    <td> </td>
					<td> </td>
                 
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
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








