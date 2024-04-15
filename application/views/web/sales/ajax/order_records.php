		<?php
		if(isset($records) && !empty($records)){
			$i = 1;
			foreach($records as $tmp){
		?>
		
		<div class="form-group">	
		  <div class="row">
			<div class="col-md-2" align='center'>
				<input type="text" name='itemcodedis[]' class="form-control form-control-sm" value='<?php echo $tmp->item?>' readonly>
				<input type="hidden" name='itemcode[]' class="form-control form-control-sm" value='<?php echo $tmp->itemcode?>' readonly>
			</div>

            <div class="col-md-2" align='center'>
				<input type="text" name='itemname[]' class="form-control form-control-sm" value='<?php echo $tmp->itemname?>' readonly>
			</div>				
			
			<div class="col-md-3">
				<input type="text" name='description[]' class="description form-control form-control-sm w-100" value='<?php echo $tmp->description?>' readonly>
			</div>
			<div class="col-md-1">
				<input type="text" name='quantity[]' id='quantity_<?php echo $i;?>' style='text-align: right;' class="quantity form-control form-control-sm w-100" onkeypress="return isNumberKeyPeriod(event)" value='0'>
			</div>
			<div class="col-md-1">
				<input type="text" name="unitprice[]"  id='unitprice_<?php echo $i;?>' style='text-align: right;' readonly class="unitprice form-control form-control-sm w-100" onkeypress="return isNumberKeyPeriod(event)" value='<?php echo $tmp->unitprice?>'>
			</div>
			<div class="col-md-1">
				<input type="text" name="unit[]"  id='unit_<?php echo $i;?>' style='text-align: right;' readonly class="unit form-control form-control-sm w-100" onkeypress="return isNumberKeyPeriod(event)" value='<?php echo $tmp->unit?>'>
			</div>
			<div class="col-md-1">
				<input type="text" name="amount[]" id='amount_<?php echo $i;?>' style='text-align: right;' readonly class="amount form-control form-control-sm w-100" onkeypress="return isNumberKeyPeriod(event)" value='0'>
			</div>			
			</div>
		</div>
		
		<?php
			$i++;
			}
		}
		?>
