
<div class="form-group">
<div class="row">	
			<div class="col-md-2" align='center'>
				<select class='form-control form-control-sm itemcode w-100 tabp' name='itemcode[]' id='itemcode_<?php echo $rowid;?>'>
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
            <div class="col-md-2 text-center">
			<input type=text class='form-control form-control-sm itemname tabp w-100' name='itemname[]' id='itemname_<?php echo $rowid;?>' value="">
			</div>				
			<div class="col-md-3" align='center'>
				<input type=text class='form-control form-control-sm description w-100 tabp' name='description[]' id='description_<?php echo $rowid;?>'>
			</div>
			<div class="col-md-1 text-center">
					<input type=text class='form-control form-control-sm quantity tabp w-100' style='text-align: right;' name='quantity[]' id='quantity_<?php echo $rowid;?>' value='0'>
			</div>
			
			<div class="col-md-1" align='center'>
				<input type=text class='form-control form-control-sm w-100 unitprice' name='unitprice[]' readonly id='unitprice_<?php echo $rowid;?>' value='0' style='text-align: right;'>
			</div>
			<div class="col-md-1" align='center'>
				<input type=text class='form-control form-control-sm w-100 unit' name='unit[]' readonly id='unit_<?php echo $rowid;?>' value='0' style='text-align: right;'>
			</div>
						
			<div class="col-md-1">
				<input type="text" name="amount[]" id='amount_<?php echo $rowid;?>' style='text-align: right;' readonly class="w-100 amount form-control form-control-sm" value='0'>
			</div>
			
			<div class="col-md-1 text-center">
			<a style='cursor:pointer;padding:0px 0px' class="delrow btn btn-warning">Del</a>
			
		</div>
		</div>
		</div>
