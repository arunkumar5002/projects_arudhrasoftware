<div class='row'></div>
<div class="form-group">
      <div class="row">	
	  
			<div class="col-md-2" align='center'>
				<select class='form-control form-control-sm itemcode tabp w-100' name='itemcode[]' id='itemcode_<?php echo $rowid;?>'>
					<option value=''>Choose..</option>
					<?php
					if(!empty($itemmaster)){
						foreach($itemmaster as $tmp){
							echo "<option value='$tmp->itemid'>$tmp->itemcode</option>";
						}
					}
					?>
				</select>
			</div>	
			
            <div class="col-md-3" align='center'>
				<input type="text" class='form-control form-control-sm itemname tabp w-100' name='itemname[]' id='itemname_<?php echo $rowid;?>'>
			</div>
            			
			<div class="col-md-3" align='center'>
				<input type="text" class='form-control form-control-sm description tabp w-100' name='description[]' id='description_<?php echo $rowid;?>'>
			</div>
			
			<div class="col-md-1" align='center'>
				<input type=text class='form-control form-control-sm unitprice w-100' name='unitprice[]' readonly id='unitprice_<?php echo $rowid;?>' value='0' style='text-align: right;'>
			</div>
						
			<div class="col-md-1" align='center'>
				<input type=text class='form-control form-control-sm quantity w-100' name='quantity[]' id='quantity_<?php echo $rowid;?>' value='0' style='text-align: right;'>
			</div>
			
			<div class="col-md-1" align='center'>
				<input type=text class='form-control form-control-sm totalprice w-100' name='totalprice[]' id='totalprice_<?php echo $rowid;?>' value='0' style='text-align: right;' readonly>
				
			</div>
			
            <div class="col-md-1" align='center'>
                (<a style="cursor:pointer;" class='removeRow'>Remove</a>)
             </div>			
			
			</div>
		</div>
