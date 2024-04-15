 <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        
                       <div class="title_left" style='width:100%;text-align:center;'>
						<u><p>
							<h3><span style='color:green'><?php echo get_defaultcompany()?></span></h3>
						</p>

                        <p style='margin-bottom:5px;'>
							<h3 style='font-size:21px !important'>Trial Balance as on <span style='color:green'><?php echo get_defaultyear_end()?></span></h3>
						</p>

						<p>
							<h2></h2>
						</p></u>
						
						
						
                        </div>
						 
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">
						<?php
						if(!empty($trial)){
						?>
						<table width='72%' align=center border= 1 >
							<tr  style="margin-bottom:0px">
								<th  width='60%'><h4 align=center >Particulars</h4></th>
								<th  width='20%'><h4 align=center >Debit (<?php echo get_currency() ?>)</h4></th>
								<th  ><h4 align=center >Credit (<?php echo get_currency() ?>)</h4></th>
							</tr>
						<?php
								
							foreach($trial as $tmp){
						?>
						
								
							<tr style="margin-bottom:0px">
							
									<td><h5 style='margin-left:5px;' ><?php echo get_accountname($tmp->accountname); ?></h5></td>
									<td><h5 align='right' style='margin-right:5px;' >
									<?php
									if($tmp->debit > $tmp->credit){
										$debit[] = $val = $tmp->debit - $tmp->credit;
										echo toDollar($val);
									}else{
										$debit[] = 0;
										echo "-";
									}
									?></h5>
									</td>
									<td><h5 align='right' style='margin-right:5px;' >
									<?php
									if($tmp->debit < $tmp->credit){
										$credit[] = $val = $tmp->credit - $tmp->debit;
										echo toDollar($val);
									}else{
										$credit[] = 0;
										echo "-";
									}
									?></h5>
									</td>
								</tr> 
						<?php
							}
							echo "<tr>";
								echo "<td align=left><h4 style='margin-left:5px;' >Total</h4></td>";								
								echo "<td align=right><h4 style='margin-right:5px;' >".toDollar(array_sum($debit))."</h4></td>";								
								echo "<td align=right><h4 style='margin-right:5px;' >".toDollar(array_sum($credit))."</h4></td>";								
							echo "</tr>";
							
							echo "</table>";
						}
						
						?>
						
                    </div>
                </div>
				 </div>

    </div>

	
	
	