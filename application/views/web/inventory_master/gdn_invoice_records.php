		<?php
		if(isset($records) && !empty($records)){
			$i = 1;
			foreach($records as $tmp){
		?>
		
		<div class="form-group">
		<div class="row">
		  <div class="col-md-1 w-100">
			<?php echo $i;?>
		  </div>
		  
		     <div class="col-md-2" align='center'>
				<input type="text" name='itemcode[]' class="form-control-sm w-100" value='<?php echo $tmp->item?>' readonly>
				<input type="hidden" name='itemcode[]' class="form-control col-md-8 col-xs-8" value='<?php echo $tmp->itemcode?>' readonly>
			</div>	
			<div class="col-md-3" align='center'>
				<input type="text" name='itemname[]' class="form-control-sm w-100" value='<?php echo $tmp->itemname?>' readonly>
			</div>		
			
			<div class="col-md-2">
				<input type="text" name="unitprice[]"  id='unitprice_<?php echo $i;?>' style='text-align: right;' readonly class="unitprice form-control-sm w-100" onkeypress="return isNumberKeyPeriod(event)" value='<?php echo $tmp->unitprice?>'>
			</div>
			<div class="col-md-2 ">
				<input type="text" name='quantity[]' readonly id='quantity_<?php echo $i;?>' style='text-align: right;' class="quantity form-control-sm w-100" onkeypress="return isNumberKeyPeriod(event)" value='<?php echo $tmp->quantity?>'>
			</div>
			
			
			<div class="col-md-2">
				<input type="number" name="dispatched[]" id='dispatched_<?php echo $i;?>' min="0" style='text-align: right;' class="dispatched form-control-sm w-100" onkeypress="return isNumberKey(event)" value='<?php echo get_dispatched_item($tmp->invoiceid,$tmp->itemcode);?>'>
			</div>			
			</div>
		</div>
		
		<?php
			$i++;
			}
		}
		?>
