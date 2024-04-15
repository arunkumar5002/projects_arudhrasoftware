<?php echo load_datatables(); ?>
<style>
#FormModalHeading{
	margin-bottom:-5px;
}
.btn-ttm {
    margin-left: 10px;
}

input[type=checkbox], input[type=radio] {

    margin-left: 20px;
</style>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row" style="margin-bottom:1.5rem!important;">
                <div class="col-sm-6">
                    <h1>Credit Note List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Settings</a></li>
                      
                    </ol>
                </div>
            </div>
			<div class="row">
			<div class="col-12">
	        <div class="card">
						<div class="card-body">
                  
                          
								<div class="col-md-12 col-sm-12 col-12 text-right">
								 
								 <a class='btn btn-info btn-sm DTTT_button DTTT_button_copy newvoucher' style='padding:5px 10px 5px 10px;cursor:pointer' href='<?= base_url() .'createcreditnote'?>'><i class="fa fa-plus"></i> New </a> 
								 
								 <button type="button" id="" class="btn btn-info btn-sm printcreditnote"><i class="fas fa-print"></i> Print</button>
								
								  <hr/>
								  </div>
								<br>
							
								  <div class="clearfix"></div>
                                    <table id="example1" class="table table-striped responsive-utilities jambo_table">
                                        <thead>
                                            <tr class="headings">
                                                <th>
                                                   
                                                </th>
											    <th>S.No </th>
                                                <th>Against Invoiceno</th>
                                                <th>Credit Date </th>
                                                <th>Issue To</th>
                                                <th>Invoice Amount</th>     
                                                <th>Amount</th>                    
                                                
                                            </tr>
                                        </thead>
										<tbody>
                                           <?php
										   if(isset($creditnote) && count($creditnote)){
											   $i = 1;
											   foreach($creditnote as $tmp){
											
										   ?>
                                           
                                            <tr class="odd pointer">
                                                <td>
                                                 <input type="radio" name='salesInvoiceCheck' class="tableflat credit_id" id='credit_<?php echo $tmp->credit_id;?>'>
                                                </td>
												<td class=" " align=center><?php echo $i++;?></td>
												<td class=" " align=center><?php echo $tmp->against_invoice_no;?></td>
												<td class=" " align=left>
													<?php 
														echo date("d-m-Y",strtotime($tmp->credit_date));
													?>
												</td>
                                                <td class=" " align=left><?php echo $tmp->issue_to;?></td>
                                                
                                                <td class=" " align=left><?php echo $tmp->invamt;?></td>
                                                
												<td class=" "><?php echo number_format($tmp->amount,2);?></td>
                                                
                                            </tr>
                                           <?php
										   	   
											   }
										   }
										   ?>
                                            
                                        </tbody>

                                    </table>
                                  </div>
                             </div>
                        </div>
               </div>
		</div>
    </section>

</div>
			<!-- Datatables -->
       
        <script>
     $(function() {
       $("#example1").DataTable();

     });
	 
	 $(".printcreditnote").click(function(){
				     if($(".credit_id").is(":checked")){
						  if($(".credit_id:checked").length == 1){
							  var id = $(".credit_id:checked").attr("id");
							  id = id.split("_");
							  window.open("<?php echo base_url()?>reports/printcreditnote/"+id[1], "", "width=700, height=500");
							  
						  }else{
							  alert("Please select one Voucher");
						  }
					 }else{
						 alert("Please select one Voucher");
					 }
			   }); 
   </script>
   
