
<?php echo load_datatables(); ?>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row" style="margin-bottom:1.5rem!important;">
                <div class="col-sm-6">
                    <h1>Attendance Report</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
						<li class="breadcrumb-item"><a href="javascript:void(0)">HR</a></li>
						<li class="breadcrumb-item active"><a href="<?= base_url().'view_attendance_report' ?>"> Attendance Report</a></li>
                    </ol>
                </div>
            </div>
			<div class="row">
				<div class="col-12">
					<div class="card">
					
                    <div class="row">
						
<div class="col-md-4 col-sm-4 col-xs-4">	
	</div>					
<div class="col-md-4 col-sm-4 col-xs-4">		
	<input type="text" value="<?php echo $month;?>" placeholder="Attendance Month" id="attendance_month" name="attendance_month" class="datepicker form-control" style="margin-top: 29px;" required>		
	<br>		
	</div>
<div class="col-md-4 col-sm-4 col-xs-4">						
	</div>             
                       <div class="row" style="margin-bottom:10px">
                      <input type="button"  onclick="printDiv('printableArea')" value="Print" rel="noopener" target="_blank" class="btn btn-default " style="margin-left: 33px;">
					   </div>
					   <div class="row" style="margin-bottom:10px">
					    <input type="button" class='DTTT_button btn btn-default pdfAttendance' style='    margin-left: 25px;padding:5px 10px 5px 10px;cursor:pointer' href='#' value="Pdf "><i class="fa fa-file-pdf-o"></i>
                      </div>
					 
                        <div class="col-md-12 col-sm-12 col-xs-12">
						
						<div id="printableArea">
						 <div class="x_panel">
                             
                                <div class="x_content"  style="margin-left: 8px;margin-right:10px";>
								
								  <div class="clearfix"></div>
								  <style>
								  .leave{color:#fff;background-color:(255, 8, 8); }
								  .present{color:#fff;background-color:; }
								  .halfday{color:#fff;background-color:(252, 255, 8); }
								  .ml{color:#fff;background-color:rgb(7, 150, 189); }
								  .pl{color:#fff;background-color:#600808; }
								  .lop{color:#fff;background-color:rgb(189, 7, 123); }
								  .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td{
									  border: 1px solid #ddd !important;
									  padding: 10px 0px 7px 7px; line-height: 0.1; 
									 }
								  </style>
								  
								   <table id="color_indictaion" class="table table-striped responsive-utilities">
									<tr>
										<td  class="present" style="padding-bottom:10px;color:#000;" align="center" > <i style=" font-size: 18px;color: #1dd323;" class="fas fa-check" ></i> Present</td>
										<td  class="leave" style="padding-bottom:10px;color:#000;" align="center"> <i style=" font-size: 18px;color: #c7341a;" class="fas fa-times"> </i> Absent</td>
										<td  class="empty" style="padding-bottom:10px;color:#000;" align="center"><i style=" font-size: 18px;color: #c7341a;" class="fad fa-window-minimize"></i>  No record</td>
										
									</tr>   
								   </table>
								   
								    <div class="table-responsive" style="overflow-x:auto">
                                    <table id="example" class="table table-striped responsive-utilities">
                                        <thead>
                                            <tr class="headings">
                                                <td colspan="2">Date</td>
                                                <?php for($i=1;$i<=$days;$i++){ ?>
												<td><?php echo $i; ?></td>
                                                <?php } ?>
                                            </tr>
                                            <tr class="headings">
                                                <td colspan="2" style=" font-size: 13px;">Day</td>
                                                <?php for($i=1;$i<=$days;$i++){ 
												       $date=$year."-".$mon."-".$i;	
												       $d=date("D",strtotime($date));
												?>
												<td style=" font-size: 13px;"><?php echo substr($d,0,-2); ?></td>
                                                <?php } ?>
                                            </tr>
                                        </thead>

                                        <tbody>
                                          <?php $i=1; if($employee){ foreach($employee as $emp){ ?>
                                          <tr>
										  <td style=" font-size: 13px;"><?php echo $i; ?></td>
                                          <td style=" font-size: 10px;"><?php echo $emp->employeename; ?></td>										 
										 <?php for($j=1;$j<=$days;$j++){ $day=$j;
										 
										 $monthName = date('M', mktime(0, 0, 0, $mon, 10)); 
										 
										 $attend_month_year = sprintf("%02d",$day)."-".$monthName."-".$year;
										 
											      $get_emp_attendance=get_emp_attendance($emp->emp_id,$attend_month_year);
											        
													//if(!empty($get_emp_attendance)){	 
											          //foreach($get_emp_attendance as $atten){ 
													  $class = "";
															$value = "";
															
														   if(isset($get_emp_attendance->attend_status)){
														  if($get_emp_attendance->attend_status=='Present'|| $get_emp_attendance->attend_status=='WeeklyOff Present'){ $class="Present"; $value='<i style=" font-size: 10px;color: #1dd323;" class="fas fa-check" ></i>'; }
														  else if($get_emp_attendance->attend_status=='Absent'){ $class="Absent"; $value='<i style=" font-size: 10px;color: #c7341a;" class="fas fa-times" ></i>
														 ';  }
														else if($get_emp_attendance->attend_status =='½Present'){
															
														
															if($get_emp_attendance->attend_in_time >='12:00'){ $class="attend_in_time"; $value='<i style=" font-size: 10px;color: #c7341a;" class="fas fa-times" </i></br><i class="far fa-horizontal-rule"></i><i style=" font-size: 10px;color: #1dd323;" class="fas fa-check" </i>';  
														   }else if($get_emp_attendance->attend_in_time <='12:00'){ $class="attend_in_time"; $value='<i style=" font-size: 10px;color: #1dd323;" class="fas fa-check" </i></br><i class="far fa-horizontal-rule"></i><i style=" font-size: 10px;color: #c7341a;" class="fas fa-times" </i>';
														 }
													 
														 
														}
														  echo "<td class='".$class."'>".$value."</td>";  
														   } else{ echo '<td style=" font-size: 10px;">-</td>';  }
													//}  } else{ echo "<td>-</td>";  }
													
										 } ?>
										 
                                         </tr>
                                         <?php $i++; } } ?>
                                        </tbody>

                                    </table>
									</div>
                                </div>
                            </div>
							</div>
			
                        </div>

                        <br />
                        <br />
                        <br />

                    </div>
                </div>
				 </div>

    </div>
	</div>
	</section>
	</div>
<style>
.ui-datepicker-calendar {
    display: none;
    }
</style>			<!-- Datatables -->
        <script src="<?php echo base_url()?>site/admin/js/datatables/js/jquery.dataTables.js"></script>
        <script src="<?php echo base_url()?>site/admin/js/datatables/tools/js/dataTables.tableTools.js"></script>
        <script>
            $(document).ready(function () {
				
                $('input.tableflat').iCheck({
                    checkboxClass: 'icheckbox_flat-green',
                    radioClass: 'iradio_flat-green'
                });
            });

            var asInitVals = new Array();
            $(document).ready(function () {
               /* var oTable = $('#example').dataTable({
                    "oLanguage": {
                        "sSearch": "Search all columns:"
                    },
                    "aoColumnDefs": [
                        {
                            'bSortable': false,
                            'aTargets': [0]
                        }
            ],
                    'iDisplayLength': 10,
                    "sPaginationType": "full_numbers",
                    "dom": 'T<"clear">lfrtip'
                });*/
                $(".datepicker").datepicker({
		changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'mm-yy',
        onClose: function(dateText, inst) { 
            $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
            window.location.href="<?php echo base_url()?>Attendance/attendance_master/"+$("#attendance_month").val();
        }
	});
	
		
	
            }); 
            
			
			
	$(".pdfAttendance").click(function(){	
		window.location.href = '<?php echo base_url()."Attendance/pdfAttendance/".$year."/".$mon; ?>';
	 });
	   

			
        </script>
		  
<script type="text/javascript">
function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}
</script>