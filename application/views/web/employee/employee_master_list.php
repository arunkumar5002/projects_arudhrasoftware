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
               <h1>Employee List</h1>
             </div>
             <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                 <li class="breadcrumb-item"><a href="#">Home</a></li>
                 <li class="breadcrumb-item active"><a href="<?php echo base_url() ?>UserManagement/user_master_list">EmployeeMasterList</a></li>
               </ol>
             </div>
           </div>
         </div><!-- /.container-fluid -->
       </section>

       <?php if ($message = $this->session->flashdata("message")) { ?>

         <div class="alert alert-success alert-dismissible">
           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
           <h5><i class="icon fas fa-check"></i> Message !</h5>
           <?php echo $message; ?>
         </div>

       <?php } ?>

       <?php if ($message = $this->session->flashdata("delete_message")) { ?>

         <div class="alert alert-warning alert-dismissible">
           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
           <h5><i class="icon fas fa-check"></i> Message !</h5>
           <?php echo $message; ?>
         </div>

       <?php } ?>

       <!-- Main content -->
       <section class="content">
         <div class="container-fluid">
           <div class="row">
             <div class="col-12">

               <div class="card">
                 <div class="card-header">
                   <h3 class="card-title"> Employee Master</h3>
                 </div>
                 <!-- /.card-header -->
                 <div class="card-body">
                   <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                     <div class="row">
                       <div class=" col-md-12">
                         <div class="dt-buttons btn-group flex-wrap">
                           <button class="btn btn-info" style="background-color:#32B9E7;"> <a href="<?php echo base_url() ?>Hr/employee_master" style="color:white"><i class="fa fa-plus"></i> New </a> </button>
                           </br>
                         </div>

                         <div class="dt-buttons btn-group flex-wrap">
                           <button class="btn btn-info viewemployee" style="background-color:#32B9E7;"> <a href="<?php echo base_url() ?>Hr/view_employee" style="color:white"><i class="fas fa-eye"></i></i> View </a> </button>
                           </br>
                         </div>


                         <div class="dt-buttons btn-group flex-wrap">
                           <button class="btn btn-info editemployee" style="background-color:#32B9E7;"> <a href="<?php echo base_url() ?>Hr/edit_employee" style="color:white"><i class="far fa-edit"></i> Edit </a> </button>
                           </br>
                         </div>

                         <div class="dt-buttons btn-group flex-wrap">
                           <button class="btn btn-info deleteemployee" style="background-color:#32B9E7;"> <a href="<?php echo base_url() ?>Hr/delete_employee" style="color:white"><i class="fa fa-trash"></i> Delete </a> </button>



                         </div>
                       </div>


                     </div>
                   </div>
                   </br>
                   </br>
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
                       <table id="example1" class="table table-bordered table-striped" style="margin-top:30px">
                         <thead>
                           <tr>
                             <th> </th>
                             <th> S.No </th>
                             <th> Employee Id </th>
                             <th> Employee Name</th>
                             <th> Email </th>
                             <th> Mobile </th>
                             <th> Department </th>
                             <th> Designation </th>


                           </tr>
                         </thead>
                         <tbody>

                           <?php

                            $i = 1;

                            foreach ($keys as $val) {

                            ?>


                             <tr>
                               <td><input type="checkbox" name="employeeCheck" id="employee_<?php echo $val->employee_id; ?>" class="tableflat employees" onClick="myFunction()"></td>
                               <?php echo "<td>" . $i++ . "</td>"; ?>
                               <?php echo "<td>" . $val->emp_id . "</td>"; ?>
                               <?php echo "<td>" . $val->employeename . "</td>"; ?>
                               <?php echo "<td>" . $val->email . "</td>"; ?>
                               <?php echo "<td>" . $val->mobile . "</td>"; ?>
                               <?php echo "<td>" . $val->department . "</td>"; ?>
                               <?php echo "<td>" . $val->designation . "</td>"; ?>


                             </tr>

                           <?php } ?>

                         </tbody>
                       </table>
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






   <!-- jQuery -->

   <!-- Bootstrap 4 -->
   <script src="<?php echo base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
   <!-- DataTables  & Plugins -->
   <script src="<?php echo base_url() ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
   <script src="<?php echo base_url() ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>


   <script>
     $(function() {
       $("#example1").DataTable();

     });
   </script>

   <script>
     $(document).ready(function() {
       $(".editemployee").click(function() {
         if ($(".employees").is(":checked")) {
           if ($(".employees:checked").length == 1) {
             var employee_id = $(".employees:checked").attr("id");
             employee_id = employee_id.split("_");

             window.location.href = "<?php echo base_url() ?>hr/edit_employee/" + employee_id[1];
           } else {
             alert("Select Only  One Employee");
           }
         } else {
           alert("Please select One Employee");
         }
         return false;
       });



       $(".deleteemployee").click(function() {
         if ($(".employees").is(":checked")) {
           if ($(".employees:checked").length == 1) {
             var employee_id = $(".employees:checked").attr("id");
             employee_id = employee_id.split("_");
             e = confirm("Do you want to delete the employee?");
             if (e)
               window.location.href = "<?php echo base_url() ?>hr/delete_employee/" + employee_id[1];
           } else {
             alert("Please select one Employee");
           }
         } else {
           alert("Please select one Employee");
         }
         return false;
       });

       $(".viewemployee").click(function() {
         if ($(".employees").is(":checked")) {
           if ($(".employees:checked").length == 1) {
             var employee_id = $(".employees:checked").attr("id");
             employee_id = employee_id.split("_");

             window.location.href = "<?php echo base_url() ?>hr/view_employee/" + employee_id[1];
           } else {
             alert("Please select one Employee");
           }
         } else {
           alert("Please select one Employee");
         }
         return false;
       });


       new PNotify({
         title: 'Company Master',
         text: 'Company Created Successfuly',
         type: 'success'
       });



     });
   </script>