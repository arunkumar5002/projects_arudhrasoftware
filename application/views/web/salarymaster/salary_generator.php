<div class="content-wrapper">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.js"></script>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>
  <link rel="stylesheet" type="text/css" media="screen" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/base/jquery-ui.css">

  <style>
    .ui-datepicker-calendar {
      display: none;
    }
  </style>

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1> Salary Master</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active"><a href="<?php echo base_url() ?>Hr/salary_master"> salary Master</a></li>
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
              <form enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>Hr/saveloanmaster">

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="bank_accounts">Bank Accounts * <span class="required"></span>
                      </label>

                      <select id="bank_accounts" name="bank_accounts" class=" form-control" required="">
                        <option value="">--UOB Bank Account--</option>
                      </select>
                    </div>
                  </div>




                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-4 col-sm-4 col-xs-4" for="currency">
                        Salary Type*<span class="required">*</span>
                      </label>
                      </br>

                      <input type="radio" class="gst" id="salary" name="salary" value="1" required="" style="margin-top:8px;margin-left:10px">Fixed
                      <input type="radio" class="gst" id="salary" name="salary" value="2" required="" class="form-control" style="margin-top:8px;margin-left:10px">Variable
                    </div>
                  </div>


                  <div class="col-md-6">
                    <div class="form-group">

                      <label> Salary Month* </label>
                      <input type="text" id="startDate" name="startDate" class=" form-control date-picker " required="" autocomplete="off">

                    </div>
                  </div>











                </div>
            </div>







            <div class="col-md-6">
              <div class="form-group">

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
<script type="text/javascript">
  $(function() {
    $('.date-picker').datepicker({
      changeMonth: true,
      changeYear: true,
      showButtonPanel: true,
      dateFormat: 'MM yy',
      onClose: function(dateText, inst) {
        $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
      }
    });
  });
</script>