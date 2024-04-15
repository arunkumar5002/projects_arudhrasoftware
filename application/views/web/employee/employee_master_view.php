<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">


    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Employee View</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><a href="<?php echo base_url() ?>UserManagement/user_master_list">Employee View</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>



    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Employee Details </h3>
                        </div>


                        <div class="clearfix"></div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">

                                    <div class="x_content" style="margin-left: 120.5px;">
                                        <br>


                                        <div class="row">
                                            <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                                <label for="emp_id">Employee Id
                                                    <span class="required">*</span>
                                                </label>
                                                <div>
                                                    <?php echo isset($view) ? $view->emp_id : ''; ?>
                                                </div>
                                            </div>


                                            <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                                <label for="email">Email <span class="required">*</span>
                                                </label>
                                                <div>
                                                    <?php echo isset($view) ? $view->email : ''; ?>
                                                </div>


                                            </div>

                                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                <label for="employeename"> Employee Name

                                                </label>
                                                <div>
                                                    <?php echo isset($view) ? $view->employeename : ''; ?>

                                                </div>

                                            </div>



                                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                <label for="employee_status"> Employee Status

                                                </label>
                                                <div>
                                                    <?php echo isset($view) ? $view->employee_status : ''; ?>
                                                </div>



                                            </div>


                                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                <label for="contract_type"> Contract Type

                                                </label>
                                                <div>
                                                    <?php echo isset($view) ? $view->contract_type : ''; ?>
                                                </div>


                                            </div>



                                            <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                                <label for="department">Department

                                                </label>
                                                <div>
                                                    <?php echo isset($view) ? $view->department : ''; ?>
                                                </div>

                                            </div>


                                            <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                                <label for="designation">Designation

                                                </label>
                                                <div>
                                                    <?php echo isset($view) ? $view->designation : ''; ?>
                                                </div>


                                            </div>



                                            <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                                <label for="mobile"> Mobile
                                                    <span class="required">*</span>
                                                </label>
                                                <div>
                                                    <?php echo isset($view) ? $view->mobile : ''; ?>
                                                </div>


                                            </div>


                                            <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                                <label for="emergency_numer"> Emergency Number

                                                </label>
                                                <div>
                                                    <?php echo isset($view) ? $view->emergency_number : ''; ?>
                                                </div>


                                            </div>


                                            <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                                <label for="date"> DOB

                                                </label>
                                                <div>
                                                    <?php echo isset($view) ? $view->birthdate : ''; ?>
                                                </div>


                                            </div>





                                            <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                                <label for="spousename"> Spouse Name

                                                </label>
                                                <div>
                                                    <?php echo isset($view) ? $view->spousename : ''; ?>
                                                </div>


                                            </div>



                                            <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                                <label for="employedDate"> Employed Date

                                                </label>
                                                <div>
                                                    <?php echo isset($view) ? $view->employedDate : ''; ?>
                                                </div>


                                            </div>


                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                <div class="form-group">
                                                    <label for="address" class="control-label ">Address</label>
                                                    <div>
                                                        <?php echo isset($view) ? $view->address : ''; ?>
                                                    </div>


                                                </div>
                                            </div>



                                            <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                                <label class="control-label col-md-4 col-sm-4 col-xs-4" for="currency">Gender Type
                                                </label>

                                                <div>
                                                    <?php echo isset($view) ? $view->gender : ''; ?>
                                                </div>



                                            </div>




                                            <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                                <label for="image"> Employee Image

                                                </label></br>


                                                <img src="<?php echo base_url() . 'site/uploads/' . $view->image; ?>" width="25%">
                                                <p><a href="<?php echo base_url() . 'site/uploads/' . $view->image; ?>" download>Download</a></p>
                                            </div>




                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                <label for="file_name"> Certificates

                                                </label>
                                                <div class="row">
                                                    <?php

                                                    foreach ($image as $val) {

                                                    ?>

                                                        <div>
                                                            <?php
                                                            if (strpos($val->file_name, '.pdf')) {
                                                            ?>
                                                                <img class="animation__shake" src="<?php echo base_url(pdf()); ?>" alt="AdminLTELogo" height="128" width="128"></br>
                                                                <a href="<?php echo base_url() . 'site/uploads/images/' . $val->file_name; ?>" download> Download</a>

                                                                <p><?php echo $val->original_filename; ?></p>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <img src="<?php echo base_url() . 'site/uploads/images/' . $val->file_name; ?>" height="128" width="128"> </br><a href="<?php echo base_url() . 'site/uploads/images/' . $val->file_name; ?>" download> Download</a>
                                                            <?php
                                                            }
                                                            ?>

                                                        </div>


                                                    <?php } ?>
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
        </div>
    </section>


    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Passport Details </h3>
                        </div>
                        <div class="page-title">
                            <div class="title_left">
                                <h3> </h3>
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
                                                <label for="passport_name">Name in Passport
                                                    <span class="required">*</span>
                                                </label>
                                                <div>
                                                    <?php echo isset($view) ? $view->passport_name : ''; ?>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                                <label for="passport_number">Passport Number
                                                    <span class="required">*</span>
                                                </label>
                                                <div>
                                                    <?php echo isset($view) ? $view->passport_number : ''; ?>
                                                </div>
                                            </div>


                                            <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                                <label for="passport_issue_date">Date of Issue
                                                    <span class="required">*</span>
                                                </label>
                                                <div>
                                                    <?php echo isset($view) ? $view->passport_issue_date : ''; ?>
                                                </div>
                                            </div>


                                            <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                                <label for="passport_issue_place">Place of Issue
                                                    <span class="required">*</span>
                                                </label>
                                                <div>
                                                    <?php echo isset($view) ? $view->passport_issue_place : ''; ?>
                                                </div>
                                            </div>



                                            <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                                <label for="passport_expiry_date">Date of Expiry
                                                    <span class="required">*</span>
                                                </label>
                                                <div>
                                                    <?php echo isset($view) ? $view->passport_expiry_date : ''; ?>
                                                </div>
                                            </div>


                                            <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                                <label for="passport_file"> Passport Document
                                                    <span class="required">*</span>
                                                </label>
                                                <div>

                                                    <img src="<?php echo base_url() . 'site/uploads/' . $view->passport_file; ?>" width="25%">
                                                </div>
                                                <p><a href="<?php echo base_url() . 'site/uploads/' . $view->passport_file; ?>" download>Download</a></p>
                                            </div>






                                            </br>

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


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">RESIDENT PERMIT DETAILS </h3>
                        </div>
                        <div class="page-title">
                            <div class="title_left">
                                <h3> </h3>
                            </div>

                        </div>
                        <div class="clearfix"></div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">

                                    <div class="x_content" style="margin-left: 120.5px;">
                                        <br>


                                        <div class="row">


                                            <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                                <label for="rp_number"> RP Number
                                                    <span class="required">*</span>
                                                </label>
                                                <div>
                                                    <?php echo isset($view) ? $view->rp_number : ''; ?>
                                                </div>
                                            </div>




                                            <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                                <label for="rp_issue_date">Date of Issue
                                                    <span class="required">*</span>
                                                </label>
                                                <div>
                                                    <?php echo isset($view) ? $view->rp_issue_date : ''; ?>
                                                </div>
                                            </div>



                                            <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                                <label for="rp_expiry_date">Date of Expiry
                                                    <span class="required">*</span>
                                                </label>
                                                <div>
                                                    <?php echo isset($view) ? $view->rp_expiry_date : ''; ?>
                                                </div>
                                            </div>


                                            <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                                <label for="rp_file"> RP Document
                                                    <span class="required">*</span>
                                                </label>
                                                <div>
                                                    <img src="<?php echo base_url() . 'site/uploads/' . $view->rp_file; ?>" width="25%">
                                                </div>
                                                <p><a href="<?php echo base_url() . 'site/uploads/' . $view->rp_file; ?>" download>Download</a></p>
                                            </div>





                                            </br>
                                            <div class="col-md-12">

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

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"> CRP Details </h3>
                        </div>

                        <div class="page-title">
                            <div class="title_left">
                                <h3> </h3>
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
                                                <label for="crp_name">Name as per ID
                                                    <span class="required">*</span>
                                                </label>
                                                <div>
                                                    <?php echo isset($view) ? $view->crp_name : ''; ?>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                                <label for="crp_number"> CRP Number
                                                    <span class="required">*</span>
                                                </label>
                                                <div>
                                                    <?php echo isset($view) ? $view->crp_number : ''; ?>
                                                </div>
                                            </div>


                                            <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                                <label for="crp_issue_date">Date of Issue
                                                    <span class="required">*</span>
                                                </label>
                                                <div>
                                                    <?php echo isset($view) ? $view->crp_issue_date : ''; ?>
                                                </div>
                                            </div>



                                            <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                                <label for="crp_expiry_date">Date of Expiry
                                                    <span class="required">*</span>
                                                </label>
                                                <div>
                                                    <?php echo isset($view) ? $view->crp_expiry_date : ''; ?>
                                                </div>
                                            </div>



                                            </br>

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



    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Bank Details </h3>
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
                                                <label for="bank_account_name">Account Name
                                                    <span class="required">*</span>
                                                </label>
                                                <div>
                                                    <?php echo isset($view) ? $view->bank_account_name : ''; ?>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                                <label for="bank_iban"> IBAN Number
                                                    <span class="required">*</span>
                                                </label>
                                                <div>
                                                    <?php echo isset($view) ? $view->bank_iban : ''; ?>
                                                </div>
                                            </div>


                                            <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                                <label for="bank_swift_code"> SWIFT CODE
                                                    <span class="required">*</span>
                                                </label>
                                                <div>
                                                    <?php echo isset($view) ? $view->bank_swift_code : ''; ?>
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



    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Salary </h3>
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
                                                <label for="basic_salary"> Basic Salary
                                                    <span class="required">*</span>
                                                </label>
                                                <div>
                                                    <?php echo isset($view) ? $view->basic_salary : ''; ?>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                                <label for="other_allowance"> Other Allowance
                                                    <span class="required">*</span>
                                                </label>
                                                <div>
                                                    <?php echo isset($view) ? $view->other_allowance : ''; ?>
                                                </div>
                                            </div>


                                            <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                                <label for="sio"> SIO
                                                    <span class="required">*</span>
                                                </label>
                                                <div>
                                                    <?php echo isset($view) ? $view->sio : ''; ?>
                                                </div>
                                            </div>


                                            <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                                <label for="lmra_fee"> IMRA Fee
                                                    <span class="required">*</span>
                                                </label>
                                                <div>
                                                    <?php echo isset($view) ? $view->lmra_fee : ''; ?>
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
</div>
</div>