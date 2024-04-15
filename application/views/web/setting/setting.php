<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Settings</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><a href="<?php echo base_url() ?>Company/setting">Settings</a></li>
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
                            <form enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>Company/">
                                <input type="hidden" name="settingid" id="settingid">
                                <div class="row">
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <label for="accountname">Bank Accounts

                                            <span class="required">*</br>(for Bank Reconciliation)</span>
                                        </label>

                                        <input type="text" id="accountname" name="accountname" required="required" class="form-control" autocomplete="off">

                                    </div>


                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <label for="salary_account">Salary Advance Account<span class="required">*</span>
                                        </label>

                                        <select id="salary_account" name="salary_account" class=" form-control" required="">
                                            <option value="">--Select Currency--</option>
                                            <option value="S$">Singapore Dollar</option>
                                            <option value="$">US Dollar</option>
                                            <option value="INR">Indian Rupee</option>
                                        </select>
                                    </div>


                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <label for="cpf_contribution">CPF Contribution<span class="required">*</span>
                                        </label>

                                        <select id="cpf_contribution" name="cpf_contribution" class=" form-control" required="">
                                            <option value="">--Select Currency--</option>
                                            <option value="S$">Singapore Dollar</option>
                                            <option value="$">US Dollar</option>
                                            <option value="INR">Indian Rupee</option>
                                        </select>
                                    </div>



                                    <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-4" for="currency">Weekly Holiday<span class="required">*</span>
                                        </label>
                                        </br>

                                        <input type="radio" class="holiday" id="holiday" name="holiday" value="saturday" required="" style="margin-top:8px;margin-left:10px">saturday
                                        <input type="radio" class="holiday" id="holiday" name="holiday" value="sunday" required="" class="form-control" style="margin-top:8px;margin-left:10px">sunday
                                    </div>


                                    <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                        <label for="currency">Total Medical Leave <span class="required">*</span>
                                        </label>

                                        <input type="text" id="leave" name="leave" class="form-control" required="" autocomplete="off">

                                    </div>






















                                    <div class="form-group col-md-12">
                                        <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-4">
                                            <button type="submit" class="btn btn-success">Submit</button>
                                            <button type="reset" class="btn btn-primary">Cancel</button>
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