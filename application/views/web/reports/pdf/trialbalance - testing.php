

            <div class="right_col" role="main">
                <div class="">
                                        
                       <table width='72%' align=center border= 1 >
							<tr>
								<th></th>
								<th align=center ><h2 align=center><span align=center >&nbsp;&nbsp;&nbsp;&nbsp;<u><?php echo get_defaultcompany()?></u></span></h2></th>
								<th></th>
							</tr>
							<tr>
							<th></th>
							<th></th>
							<th></th>
							</tr>
							<tr>
								<th></th>								
								<th><h3 ><u>Trial Balance as on <span style='color:green'><?php echo get_defaultyear_end()?></u></span></h3></th>
								<th></th>
							</tr>
                        </table>
				
                    <div class="clearfix"></div>

                    <div class="">
						<?php
						if(!empty($trial)){
						?>
						<table width='100%' align=center border= 1 >
							<tr  align=center style="margin-bottom:0px">
								<th align=center width='80%'><h4 align=center >Particulars</h4></th>
								<th align=center width='10%'><h4 align=center >Debit (<?php echo get_currency() ?>)</h4></th>
								<th align=center width='10%' ><h4 align=center >Credit (<?php echo get_currency() ?>)</h4></th>
							</tr>
							<tr>
								<th></th>
								<th></th>
								<th></th>
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
									echo "<td></td>";
									echo "<td></td>";
									echo "<td></td>";
								echo "</tr>";
								
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

	
	
	