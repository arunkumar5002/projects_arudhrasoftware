 		
	<!--- start   --->					
				
     <div class="container-fluid">
		<div class="invoice p-3 mb-3" id="InvoiceDiv">
		<div class="row">
		<div class="col-md-12" style="display:flex;">
		 <input type="button" onclick="printDiv('printableArea')" value="Print " rel="noopener" target="_blank" class="btn btn-default" style="margin-left:86%;margin-right: 11px;">
		 
		 <input type="button" class='DTTT_button btn btn-default pdfAttendance'  value="Pdf " ><i class="fa fa-file-pdf-o"></i>
		</div>
		</div>
      <section class="content">
	  <div id="printableArea">
          <div class="container-fluid">
              <div class="row">
                  <div class="col-12">

                      <div class="container mt-5 mb-5">
                          <div class="row">
                              <div class="col-md-12" style="border:2px solid black;">
                                  <div class="text-center lh-1 mb-2">
                                      <h3 class="fw-bold" style="border-bottom:2px solid black;"><b>ILIUM composite</b></h3>
                                      <h4 class="fw-bold" style="border-bottom:2px solid black;"><b>Salary Slip for <h5> <address id="monthyear"><?php echo $data->month_year;?></address> <h5> </b></h4>
                                  </div>
                                  <br>
								  
								  
								  <div class="row invoice-info" style="display:flex;">
							     <div class="col-sm-6 invoice-col">
								   <address id="EmployeeDiv"><?php echo $data->emp_details;?></address>
							     </div>
							     <div class="col-sm-6 invoice-col" id="PayRollDiv" ><?php echo $data->pay_details ;?>
							     </div>
						          </div>


                                      
                                      <table class="mt-4 table table-bordered" style="margin-top:30px;">
                                          <thead class="bg-dark text-white">
                                              <tr>
                                                  <th scope="col">Earnings</th>
                                                  <th scope="col">Amount</th>
                                                  <th scope="col">Deductions</th>
                                                  <th scope="col">Amount</th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                              <tr>
                                                  <th scope="row">Basic Salary</th>
												   <th scope="row" id="basicsalary"><?php echo $data->basic_salary;?> </th>
												     <td scope="row" >SIO </td>
                                                  <td scope="row" id="sio"><?php echo $data->sio;?></td>
                                                  
                                              </tr>
                                             <!--    <tr>
                                                  <th scope="row">House Rent Allowances</th>
                                                  <td>000</td>
                                                  <td>LIMRA</td>
                                                  <td scope="row" id="limra"></td>
                                              </tr>  -->
                                             <!--    <tr>
                                                  <th scope="row">Conveyance Allowances</th>
                                                  <td>000 </td>
                                                  <td>Professional Tax</td>
                                                  <td>000</td>
                                              </tr>  -->
                                           <!--   <tr>
                                                  <th scope="row">Medical Allowances</th>
                                                  <td>000 </td>
                                                  <td>000</td>
                                                  <td></td>
                                              </tr>  -->
                                         
                                              <tr class="border-top">
                                                  <th scope="row">Gross Salary</th>
                                                  <td><b>1000</b></td>
                                                  <td>Total Deductions</td>
                                                  <td><b>000</b></td>
                                              </tr>
                                          </tbody>

                                      </table>
                               
                                  <div class="row" style="display: inline;">
                                      <div class="col-md-4"> <br> <span class="fw-bold"><b style="font-size:20px;">Net Pay : 1000</b></span> </div>
                                      <div class=" col-md-8">
                                          <div class="d-flex flex-column"> <span><b>Amount In Words : Fifty Three Thousand Five Hundred</b></span> </div>
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
  </div>
  </div>
  </div>
  
  <!--- end  -->

  
