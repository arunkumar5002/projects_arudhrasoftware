<div class="content-wrapper">
<link rel="stylesheet" href="http://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>closing stock</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><a href="<?php echo base_url() ?>Accounts/new_closing_stock">closing stock</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>


    <div class="right_col" style=" padding: 20px;" role="main">
        <div class="" style="background-color: white;
    padding: 14px;">

            <div class="page-title">
                <div class="title_left">

                </div>

            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">

                        <div class="x_content">
                            <br>
                            <form enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>Accounts/">
                                <input type="hidden" name="companyid" id="companyid">
                                <div class="row" style="margin-left:70px;">
                                <div class="col-md-4">
									<div class="form-group">
									<label class="form-check-label"> <b> Date </b><span class="required">*</span></label>
									<input type="text" class="form-control form-control-sm datepicker" name="date" id="date"/>
								</div>
						       </div>



                               <div class="col-md-4">
								<div class="form-group">
									<label class="form-check-label"> <b> Closing Stock </b><span class="required">*</span></label>
									<input type="text" class="form-control form-control-sm" name="stock" id="stock"/>
								</div>
						       </div>
                               </div>							   
							   
							     <div class="row" style="margin-left:600px;">
                                    <div class="form-group">
                                        <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-4">
                                            <button type="submit" class="btn btn-success btn-sm">Submit</button>
                                            <button type="reset" class="btn btn-primary btn-sm">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


