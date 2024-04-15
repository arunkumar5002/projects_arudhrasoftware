 <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/fontawesome-free/css/all.min.css">

<style>
.leave{color:#fff;background-color:(255, 8, 8); }
.present{color:#000;background-color:#fff; }
.halfday{color:#fff;background-color:(252, 169, 0); }
.ml{color:#fff;background-color:rgb(7, 150, 189); }
.pl{color:#fff;background-color:#600808; }
.lop{color:#fff;background-color:rgb(189, 7, 123); }
}
body{font-size:10px !important; }
</style>
<img style="margin-left: 2%;
    height: 40px;
    width: fit-content;"  src="<?php echo base_url(logo());?>" alt="AdminLTELogo">
							</ul>
<table width="100%" style="width:700px;margin-top:20px;">
 <tr><td align="center" style="font-size:8px;"><?php $year_mon=$year."-".$mon; echo "Attendance Report - ".date("M Y",strtotime($year_mon)); ?></td></tr>
</table>

<div class="clearfix" style="margin-top:20px;"  ></div>

								   

<table border="1">
                                        <thead>
                                            <tr>
                                                <td colspan="3">Date</td>
                                                <?php for($i=1;$i<=$days;$i++){ ?>
												<td align="center" valign="middle"><?php echo $i; ?></td>
                                                <?php } ?>
                                            </tr>
                                            <tr>
                                                <td colspan="3">Day</td>
                                                <?php for($i=1;$i<=$days;$i++){ 
												       $date=$year."-".$mon."-".$i;	
												       $d=date("D",strtotime($date));
												?>
												<td align="center" valign="middle"><?php echo substr($d,0,-2); ?></td>
                                                <?php } ?>
                                            </tr>
                                        </thead>

                                        <tbody>
                                          <?php $i=1; if($employee){ foreach($employee as $emp){ ?>
                                          <tr>
										  <td colspan="1" style="text-align:center;" ><?php echo $i; ?></td>
                                          <td colspan="2" style="height:15px; margin-left:4px;"><?php echo $emp->employeename; ?></td>										 
										 <?php for($j=1;$j<=$days;$j++){ $day=$j;
										 
										  $monthName = date('M', mktime(0, 0, 0, $mon, 10)); 
										 
										 $attend_month_year = sprintf("%02d",$day)."-".$monthName."-".$year;
										 
											      $get_emp_attendance=get_emp_attendance($emp->emp_id,$attend_month_year);
											         
													 $class = "";
															$value = "";
															
														   if(isset($get_emp_attendance->attend_status)){
														  if($get_emp_attendance->attend_status=='Present'|| $get_emp_attendance->attend_status=='WeeklyOff Present'){
															  $path = base_url().'assets/tick.png';
															  $class="Present";
														     $value='<img src="'.$path.'" alt="AdminLTELogo" height="5px" width="5px" style="padding:5px;">'; 
															  }
															else if($get_emp_attendance->attend_status=='Absent'){
															$path = base_url().'assets/cross.png';
																$class="Absent";
																$value='<img src="'.$path.'" lt="AdminLTELogo" height="5px" width="5px" style="padding:5px">';
															}
														else if($get_emp_attendance->attend_status =='½Present'){
															
														
															if($get_emp_attendance->attend_in_time >='12:00'){ 
															$path1 = base_url().'assets/tick.png';
															$path2 = base_url().'assets/cross.png';
															$class="attend_in_time";
															$value='<img src="'.$path2.'" alt="AdminLTELogo" height="5px" width="5px" style="padding:5px"><img src="'.$path1.'" alt="AdminLTELogo" height="5px" width="5px" style="padding:5px">';  
														   }else if($get_emp_attendance->attend_in_time <='12:00'){
															   $path1 = base_url().'assets/tick.png';
															   $path2 = base_url().'assets/cross.png';
															   $class="attend_in_time"; 
															  $value='<img src="'.$path1.'" alt="AdminLTELogo" height="5px" width="5px" style="padding:5px"><img src="'.$path2.'" alt="AdminLTELogo" height="5px" width="5px" style="padding:5px">';
														 }
													 
														 
														}
														  echo "<td class='".$class."'>".$value."</td>";  
														   } else{ echo '<td style=" font-size: 10px;">-</td>';  }
													
										 } ?>
										 
                                         </tr>
                                         <?php $i++; } } ?>
                                        </tbody>

                                    </table>
