<?php echo load_datatables(); ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row" style="margin-bottom:1.5rem!important;">
                <div class="col-sm-6">
                    <h1> Payroll</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Settings</a></li>
                        <li class="breadcrumb-item active"><a href="<?= base_url() . '' ?>"> Payroll</a></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#earninings" data-toggle="tab">SALARY DETAILS </a></li>
                                <li class="nav-item"><a class="nav-link" href="#deductions" data-toggle="tab"> SALARY SUMMARY</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="earninings">
                                    <div class="row">
                                        <div class="col-12">
                                                <div class="table-responsive" style="overflow-x:auto">
                                                    <table class="table table-bordered table-striped dataTable dtr-inline" style="border-width:4px;">
                                                        <thead>
                                                            <tr style="background-color: darkgrey;">
                                                                <th colspan="6">EMPLOYEE DETAILS</th>
                                                                <th colspan="<?= count($earnings_details)+1 ?>">EARNINGS</th>
                                                                <th colspan="<?= count($deductions_details)+1 ?>">DEDUCTIONS</th>
																<th>&nbsp;</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>SNo</td>
                                                                <td>Emp ID</td>
                                                                <td>Employee Name</td>
                                                                <td>Department</td>
                                                                <td>Designation</td>
                                                                <td>Basic Salary</td>
                                                                <!--<td>Present</td>
                                                                <td>Absent</td>
                                                                <td>Slip Month</td>-->
                                                                <?php
																	if(!empty($earnings_details)){
																		foreach($earnings_details as $row){
																			echo '<td>'.$row['earninings_name'].'</td>';
																		}
																		echo '<td>Total Earnings</td>';
																	}
																
																	if(!empty($deductions_details)){
																		foreach($deductions_details as $row){
																			echo '<td>'.$row['deductions_name'].'</td>';
																		}
																		echo '<td>Total Deductions</td>';
																	}
																?>
                                                                <td>Net Pay</td>
                                                            </tr>
															<?php
																if(!empty($salary_slip_details)){
																	$i=1;
																	foreach($salary_slip_details as $row){
																		$emp_details = get_employee_details($row['slip_emp_id']);
																		echo "<tr>";
																			echo "<td>".$i."</td>";
																			echo "<td>".$emp_details->emp_id."</td>";
																			echo "<td>".$emp_details->employeename."</td>";
																			echo "<td>".$emp_details->department_name."</td>";
																			echo "<td>".$emp_details->designation_name."</td>";
																			echo "<td>".$emp_details->basic_salary."</td>";
																			// echo "<td></td>";
																			// echo "<td></td>";
																			//echo "<td>".$row['slip_month']."</td>";
																			
																			$total_earn = 0;
																			$earnings_details = $this->db->select('*')->where('slip_id',$row['id'])->where('details_type','1')->order_by('details_type','asc')->get('tbl_salary_details')->result_array();
																			foreach($earnings_details as $ear){
																				echo "<td class='text-right'>".number_format($ear['details_amount'])."</td>";
																				$total_earn+= $ear['details_amount'];
																			}
																			echo "<td class='text-right'>".number_format($total_earn)."</td>";
																			
																			$total_dedu = 0;
																			$deductions_details = $this->db->select('*')->where('slip_id',$row['id'])->where('details_type','2')->order_by('details_type','asc')->get('tbl_salary_details')->result_array();
																			foreach($deductions_details as $ded){
																				echo "<td class='text-right'>".number_format($ded['details_amount'])."</td>";
																				$total_dedu+= $ded['details_amount'];
																			}
																			echo "<td class='text-right'>".number_format($total_dedu)."</td>";
																			echo "<td class='text-right'>".number_format($total_earn - $total_dedu)."</td>";
																		echo "</tr>";
																		$i++;
																	}
																}else{
																	$rows = 9 + count($earnings_details) + count($deductions_details);
																	echo "<tr>";
																		echo "<td colspan='".$rows."'>No More Records</td>";
																	echo "</tr>";
																}
															?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="deductions">
                                    <div class="row">


                                        <div class="card" style="    min-width: 100%">
                                            <div class="card-header">
                                                <h3 class="card-title"> Payroll</h3>
                                                <div class="card-tools">
                                                    <div class="input-group input-group-sm" style="width: 150px;">
                                                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                                                        <div class="input-group-append">
                                                            <button type="submit" class="btn btn-default">
                                                                <i class="fas fa-search"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <table class="table table-striped dataTable dtr-inline">
                                                <thead>
                                                    <tr style="background-color: darkgrey;">
                                                        <th>Department </th>
                                                        <th> HC </th>
                                                        <th>BASIC </th>
                                                        <th>HRA </th>
                                                        <th>OTHER </th>
                                                        <th>O.T </th>
                                                        <th>Total </th>
                                                        <th>Loan </th>
                                                        <th>Other Ded </th>
                                                        <th>TOT DED</th>
                                                        <th>Net Pay</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <tr>
                                                        <td>Production </td>
                                                        <td>4 </td>
                                                        <td>2,200.00</td>
                                                        <td>660.00 </td>
                                                        <td> - </td>
                                                        <td>45.83 </td>
                                                        <td>2,905.83 </td>
                                                        <td>80.00 </td>
                                                        <td>- </td>
                                                        <td>80.00 </td>
                                                        <td>####### </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Sales </td>
                                                        <td>2 </td>
                                                        <td>750.00 </td>
                                                        <td>225.00 </td>
                                                        <td>50.00 </td>
                                                        <td>- </td>
                                                        <td>1,025.00 </td>
                                                        <td>30.00 </td>
                                                        <td>- </td>
                                                        <td>30.00 </td>
                                                        <td>995.00 </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Accounts </td>
                                                        <td>2 </td>
                                                        <td>750.00 </td>
                                                        <td>225.00 </td>
                                                        <td>50.00 </td>
                                                        <td>- </td>
                                                        <td>1,025.00 </td>
                                                        <td>30 </td>
                                                        <td>- </td>
                                                        <td>-30.00</td>
                                                        <td>935.00 </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Admin</td>
                                                        <td>2</td>
                                                        <td>900.00</td>
                                                        <td>270.00</td>
                                                        <td>- </td>
                                                        <td>18.75 </td>
                                                        <td>1,188.75</td>
                                                        <td>100.00 </td>
                                                        <td>- </td>
                                                        <td>100.00</td>
                                                        <td>##### </td>
                                                    </tr>
                                                    <tr style="background-color: darkgrey;">
                                                        <td> </td>
                                                        <th> 10 </th>
                                                        <th>4600 </th>
                                                        <th>1380</th>
                                                        <th>100 </th>
                                                        <th>64.583 </th>
                                                        <th>6144.583 </th>
                                                        <th>240</th>
                                                        <th>0</th>
                                                        <th>240</th>
                                                        <th>5904.58</th>
                                                    </tr>
                                                </tbody>
                                            </table>

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

</div>