<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">


    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Company View </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><a href="<?php echo base_url() ?>Company/company_master_list">CompanyMaster</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <?php

    $i = 1;

    foreach ($view as $val) {

    ?>
    <?php } ?>

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Company View </h3>
                        </div>
                        <div class="page-title">
                            <div class="title_left">
                                <h3></h3>
                            </div>

                        </div>
                        <div class="clearfix"></div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">

                                    <div class="x_content" style="margin-left: 120.5px;">
                                        <br>


                                      <div class="row">
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <label for="companyname" >Company Name
                                            <span class="required">* </span>
                                        </label>
										<div>
                                           <?php echo isset($view) ? $view->name : ''; ?></div>        
                                       <span id="name_error" style="color:red;"></span>
                                    </div>
									
									      <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                        <label for="email">Email <span class="required">* </span>
                                        </label>
										<div>
                                       <?php echo isset($view) ? $view->email : ''; ?></div>
                                        
                                            <span id="email_error" style="color:red;"></span>
                                    </div>
									
									 <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                        <label for="fax">Landline <span class="required">* </span>
                                        </label>
                                            <div> <?php echo isset($view) ? $view->landline : ''; ?></div>
                                       
                                        <span id="landline_error" style="color:red;"></span>
                                    </div>
									
									
                                    <div class="form-group col-md-6">
                                        <label for="contact">Contact <span class="required">* </span></label>
                                        <div>
										<?php echo isset($view) ? $view->mobile : ''; ?></div>
                                             <span id="contact_error" style="color:red;"></span>
                                    </div>
									
                                    <div class="form-group col-md-6">
                                        <label for="currency">Address
                                             <span class="required">* </span>
                                        </label>

                                         <div><?php echo isset($view) ? $view->address : ''; ?></div>
                                         <span id="street_error" style="color:red;"></span>
                                    </div>


                                    <div class="form-group col-md-6">
                                        <label for="locality">
                                            Locality<span class="required">* </span>
                                        </label>
                                          <div>  <?php echo isset($view) ? $view->locality : ''; ?></div>

                                             <span id="locality_error" style="color:red;"></span>
                                    </div>
									
									  <div class="form-group col-md-6">
                                        <label for="currency">Pincode
                                             <span class="required">* </span>
                                        </label>
                                         <div> <?php echo isset($view) ? $view->pincode : ''; ?></div>
                                        
                                          <span id="pincode_error" style="color:red;"></span>
                                    </div>
                                       
									<div class="form-group col-lg-6">
                                        <label for="companyname">Website
                                            <span class="required">* </span>
                                        </label>


                                       <div>  <a href="https://<?php echo $view->website;?>"><?php echo isset($view) ? $view->website : ''; ?></a></div>
									   
                                    </div>



                                    <div class="form-group col-md-6">
                                        <label for="fax">Company Logo <span class="required"></span>
                                        </label>
                                        <div class="col-md-8" style="margin-top:8px">

                                      <img src="<?php echo base_url().'site/uploads/'.$view->logo;?>" width="35%"> 
							   
                                            

                                            
                                        </div>
										

                                    </div>
									</div>
                                    </div>


                                    </br>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </section>
	</div>