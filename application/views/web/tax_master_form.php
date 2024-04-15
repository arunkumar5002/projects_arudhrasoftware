<div class="content-wrapper">


 <html lang="en">
 <head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
 </head>
  
 
    <div class="right_col" style=" padding: 20px;" role="main">
        <div class="" style="background-color: white;
    padding: 14px;">

            <div class="page-title">
                <div class="title_left">
                    <h3>Tax Master</h3>
                </div>

            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">

                        <div class="x_content">
                            <br>
                           <form method="POST" action="<?php echo base_url()?>company/" enctype="multipart/form-data">
	  
	  <div class="row">
    <div class="col-md-6">
    <label class="form-label">Tax Code:</label>
    <input type="text" class="form-control"  placeholder="Enter Tax_code" name="tax_code">
    </div>
  
     <div class="col-md-6">
    <label class="form-label">Description:</label>
    <input type="text" class="form-control"  placeholder="Enter discription" name="discription">
	</div>
   
	
	 <div class="col-md-6">
    <label class="form-label">Percentage:</label>
    <input type="text" class="form-control"  placeholder="Enter percentage" name="percentage">
    </div>
	</div>
	
	 </br>
     <div class="row">
     <div class="form-group col-md-12"> 
                                <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-4">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <button type="reset" class="btn btn-primary">Cancel</button>
                                </div>
                            </div>
							</div>
		</form>




                                   
                                </div>
                            </form>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>