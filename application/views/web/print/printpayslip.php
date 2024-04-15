<body onLoad="myFunction()">

<div style='border:1px solid black; width:700px;' >
<?php if(isset($companydeta) && !empty($companydeta)){ ?>
<table width='700px;' >
	<tr>
		<td width='100%' align='center'>
				<label style='font-weight:bold; font-size:22px;' ><?php echo $companydeta->companyname; ?></label>		
		</td>
	</tr>
	<tr>
		<td width='100%' align='center'>
				<label style='font-weight:bold; font-size:18px;' ><?php echo $companydeta->address; ?></label>	
		</td>
	</tr>
	<tr>
		<td width='100%' align='center'>
				<label ><b>Tel : </b><?php echo $companydeta->contact; ?> <b>E-mail : </b><?php echo $companydeta->email; ?></label>	
		</td>
	</tr>
	<tr>
		<td width='100%'>
				<hr>
		</td>
	
	</tr>
	<tr>
		<td width='100%' align='center'><label style='font-weight:bold; font-size:18px;' >Pay Slip</label></td>
	</tr>
</table>
<?php } ?>

<div class='clearfix' style='margin-top:20px;'  ></div>

<table width='700px;'  >
	<tr>
		<td width='20%' >Employee Name</td>
		<td width='40%' ><?php echo ucfirst($employeesdeta->employeename); ?> </td>
		<td width='10%' >Month</td>
		<td width='30%' ><?php if(isset($salreport->month) && !empty($salreport->month)){ 
		$salmonth = explode("-",$salreport->month);
		echo date('M',strtotime($salmonth[0])).'-'.$salmonth[1]; 
		} ?></td>
		
	</tr>
	<tr>
		<!--<td width='20%' >NRIC</td>
		<td width='40%' >S7370441C</td>-->
		<td width='20%' >Designation</td>
		<td width='40%' ><?php echo ucfirst($employeesdeta->designation); ?> </td>
		<td width='10%' >Mode</td>
		<td width='30%' ><?php 
			$mode = array('1'=>'Cash','2'=>'Bank','3'=>'Cheque');
		echo $mode[$employeesdeta->paymentmode]; ?> </td>
		
	</tr>
	<!--<tr>
		<td width='20%' >Designation</td>
		<td width='40%' ><?php echo $employeesdeta->designation; ?> </td>
		<td width='10%' ></td>
		<td width='30%' ></td>
		
	</tr>-->
</table>
<div class='clearfix' style='margin-top:20px;'  ></div>
<table width='700px;' >
	<tr>
		<td colspan='4'	width='100%'><hr></td>
			
	</tr>
	<tr>
		<td colspan='2'	width='50%' align='center'><b>MISCELLANEOUS DETAILS</b></td>
		<td colspan='2' width='50%' align='center'><b>ATTENDANCE DETAILS</b></td>				
	</tr>
	<tr>
		<td colspan='4'	width='100%'><hr></td>			
	</tr>
	<tr>
		<td width='25%' >Employer CPF</td>
		<td width='25%' ><?php echo $salreport->employercpf; ?></td>
		<td width='25%' >Days Worked :</td>
		<td width='25%' ><?php 
		 if(isset($salreport->month) && !empty($salreport->month)){ 
		$salmonth = explode("-",$salreport->month);
		$numberdays = cal_days_in_month(CAL_GREGORIAN, $salmonth[0], $salmonth[1]);
		echo $workeddays = $numberdays - $salreport->leavedays;
		}
		
		?></td>
		
	</tr>
	<tr>
		<td width='25%' >Employee CPF</td>
		<td width='25%' ><?php echo $salreport->employeecpf; ?></td>
		<td width='25%' >Unpaid Days :</td>
		<td width='25%' ><?php if(isset($salreport) && ($salreport->leavedays != 0)){ echo $salreport->leavedays; } else { echo 'NIL'; } ?></td>
		
	</tr>
</table>
<div class='clearfix' style='margin-top:40px;'  ></div>
<table width='700px;'  >
	<tr>
		<td colspan='6'	width='100%'><hr></td>			
	</tr>
	<tr>
		<td colspan='2'	width='33%' align='left' ><b>&nbsp; EARNINGS</b></td>
		<td colspan='2' width='33%' align='left' ><b>DEDUCTIONS</b></td>				
		<td colspan='2' width='33%' align='left' ><b>COMPANY CONTRIBUTION</b></td>				
	</tr>
	<tr>
		<td colspan='6'	width='100%'><hr></td>			
	</tr>
	<tr>
		<td width='16%' >Basic Pay</td>
		<td width='17%' align="right" calss><?php if(isset($employeesdeta->salarytype) && !empty($employeesdeta->salarytype) && ($employeesdeta->salarytype == 1) ){ echo $earns[] = $employeesdeta->salary; } else { echo $earns[] = $salreport->basicrate * $salreport->workedhours; } ?> &nbsp;&nbsp;&nbsp; </td>
		<td width='16%' >Employee CPF</td>
		<td width='17%'align="right" ><?php echo $salreport->employeecpf; ?>&nbsp;&nbsp;&nbsp; </td>
		<td width='16%' >Employer CPF</td>
		<td width='17%' align="right" ><?php echo $salreport->employercpf; ?> &nbsp;&nbsp;&nbsp; </td>		
	</tr>
	<tr>
		<td width='16%' >Overtime</td>
		<td width='17%' align="right" ><?php
			
		if(isset($employeesdeta->salarytype) && !empty($employeesdeta->salarytype) && ($employeesdeta->salarytype == 2) ){
			
			
			$basicrate = $salreport->basicrate;
			$ottime = $salreport->othours;
			$ottype = '';
			if(isset($salreport->overtimetype) && !empty($salreport->overtimetype) && ($salreport->overtimetype == 1))	
				$ottype = 1.5;			
			else if(isset($salreport->overtimetype) && !empty($salreport->overtimetype) && ($salreport->overtimetype == 2))
				$ottype = 1.5;	
			
			echo $earns[] =  $overamount = $basicrate * $ottime * $ottype;
			
			
			
			} else { 
			echo $earns[] = '0.00'; 
			
			} 



		?> &nbsp;&nbsp;&nbsp;</td>
		<td width='16%' >Salary Advance</td>
		<td width='17%' align="right" ><?php echo $salreport->otheradvance;  ?>&nbsp;&nbsp;&nbsp; </td>
		<td width='16%' ></td>
		<td width='17%' ></td>	
		<!--<td width='23%' >CDAC</td>
		<td width='10%' align="right" >- &nbsp;&nbsp;&nbsp;</td>
		<td width='23%' >SDL</td>
		<td width='10%' align="right" >- &nbsp;&nbsp;&nbsp;</td>-->		
	</tr>
	<tr>
		<td width='16%' >Allowance</td>
		<td width='17%' align="right" ><?php echo $earns[] = $salreport->allowance; ?> &nbsp;&nbsp;&nbsp;</td>
		<!--<td width='23%' >MBMF</td>
		<td width='10%' align="right" >- &nbsp;&nbsp;&nbsp;</td>
		<td width='23%' >FWL</td>
		<td width='10%' align="right" >- &nbsp;&nbsp;&nbsp;</td>	-->
		<td width='16%' >Loan</td>
		<td width='17%' align="right" ><?php echo $salreport->loan;  ?>&nbsp;&nbsp;&nbsp;</td>
		<td width='16%' ></td>
		<td width='17%' ></td>	
	</tr>
	<!--<tr>
		<td width='23%' >Bonus</td>
		<td width='10%' align="right" >- &nbsp;&nbsp;&nbsp;</td>
		<td width='23%' >SINDA</td>
		<td width='10%'align="right"  >- &nbsp;&nbsp;&nbsp;</td>
		<td width='23%' ></td>
		<td width='10%' ></td>		
	</tr>-->
	<!--<tr>
		<td width='23%' >MC Reim</td>
		<td width='10%'align="right"  >- &nbsp;&nbsp;&nbsp;</td>
		<td width='23%' >Salary Advance</td>
		<td width='10%' align="right" ><?php echo $salreport->otheradvance;  ?>&nbsp;&nbsp;&nbsp; </td>
		<td width='23%' ></td>
		<td width='10%' ></td>		
	</tr>-->
	<!--<tr>
		<td width='23%' >TPT Reim</td>
		<td width='10%' align="right" >- &nbsp;&nbsp;&nbsp;</td>
		<td width='23%' >Loan</td>
		<td width='10%' align="right" ><?php echo $salreport->loan;  ?>&nbsp;&nbsp;&nbsp;</td>
		<td width='23%' ></td>
		<td width='10%' ></td>		
	</tr> -->
	<!--<tr>
		<td width='23%' >Arrears</td>
		<td width='10%' align="right" >- &nbsp;&nbsp;&nbsp;</td>
		<td width='23%' >Rent/Ticket</td>
		<td width='10%' align="right" >- &nbsp;&nbsp;&nbsp;</td>
		<td width='23%' ></td>
		<td width='10%' ></td>		
	</tr>
	<tr>
		<td width='23%' >Leave Encashment</td>
		<td width='10%' align="right" >- &nbsp;&nbsp;&nbsp;</td>
		<td width='23%' >NS Claim</td>
		<td width='10%' align="right" >- &nbsp;&nbsp;&nbsp;</td>
		<td width='23%' ></td>
		<td width='10%' ></td>		
	</tr>
	<tr>
		<td width='23%' >Notice Pay</td>
		<td width='10%'align="right"  >- &nbsp;&nbsp;&nbsp;</td>
		<td width='23%' >Unpaid Days</td>
		<td width='10%'align="right"  >- &nbsp;&nbsp;&nbsp;</td>
		<td width='23%' ></td>
		<td width='10%' ></td>		
	</tr> -->
	<tr>
		<td colspan='6'	width='100%'><hr></td>			
	</tr>
</table>

<div class='clearfix' style='margin-top:20px;'  ></div>

<table width='700px;'>
	
	<tr>
		<td width='18%' ><b>Total Earnings :</b></td>
		<td width='15%' align='right' ><b><?php echo number_format(array_sum($earns),2,'.',''); ?>&nbsp;&nbsp;&nbsp;</b></td>
		<td width='18%' ><b>Total Deductions :</b></td>
		<td width='15%' align='right' ><b><?php echo $salreport->deductions; ?>&nbsp;&nbsp;&nbsp;</b></td>
		<td width='18%' ><b>Net Pay :</b></td>
		<td width='15%' align='right' ><b><?php echo $salreport->payable; ?>&nbsp;&nbsp;&nbsp;</b></td>		
	</tr>
</table>
</div>
<div class='clearfix' style='margin-top:30px;'  ></div>

<table width='700px;' >
	
	<tr>
		<td width='28%' ><hr></td>
		<td width='5%' ></td>
		<td width='28%' ><hr></td>
		<td width='5%' ></td>
		<td width='28%' ><hr></td>
		<td width='5%' ></td>		
	</tr>
	<tr>
		<td width='28%' align='center' >Approved by</td>
		<td width='5%' ></td>
		<td width='28%' align='center' >Company Chop</td>
		<td width='5%' ></td>
		<td width='28%' align='center' >Received by</td>
		<td width='5%' ></td>		
	</tr>
</table>



</body>
<script>
function myFunction() {
    window.print();
}
</script>


