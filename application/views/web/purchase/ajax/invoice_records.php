		<?php
		if(isset($records) && !empty($records)){
			$i = 1;
			foreach($records as $tmp){
		?>
		<div class="form-group">
         <div class="row">		
			<div class="col-md-2" align='center'>
				<input type="text" name='itemcodedis[]' class="form-control form-control-sm w-100" value='<?php echo $tmp->item?>' readonly>
				<input type="hidden" name='itemcode[]' class="form-control form-control-sm" value='<?php echo $tmp->itemid?>' readonly>
			</div>	

           <div class="col-md-3" align='center'>
				<input type="text" name='itemname[]' id='itemname_<?php echo $i;?>' style='text-align: right;' class="form-control form-control-sm w-100" value='<?php echo $tmp->itemname?>' readonly>
			</div>				
			
			
			<div class="col-md-2">
				<input type="text" name='quantity[]' readonly id='quantity_<?php echo $i;?>' style='text-align: right;' class="quantity form-control form-control-sm w-100" onkeypress="return isNumberKeyPeriod(event)" value='<?php echo $tmp->received?>'>
			</div>
			<div class="col-md-2">
				<input type="text" name="unitprice[]"  id='unitprice_<?php echo $i;?>' style='text-align: right;' readonly class="w-100 unitprice form-control form-control-sm" onkeypress="return isNumberKeyPeriod(event)" value='<?php echo $tmp->unitprice?>'>
			</div>
			
			<div class="col-md-2">
				<input type="text" name="amount[]" id='amount_<?php echo $i;?>' style='text-align: right;' readonly class="totalamount form-control form-control-sm w-100" onkeypress="return isNumberKeyPeriod(event)" value='<?php echo $tmp->received * $tmp->unitprice?>'>
			</div>			
			<div class="col-md-1">
			&nbsp;
		  </div>
		  </div>
		</div>
		
		<?php
			$i++;
			}
		}
		?>
	