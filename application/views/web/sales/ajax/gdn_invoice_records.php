		<?php
		if(isset($records) && !empty($records)){
			$i = 1;
			foreach($records as $tmp){
		?>
		
		<div class="form-group">	
		  <div class="col-md-1 col-sm-1 col-xs-1" style='padding-top:8px;text-align:center'>
			<?php echo $i;?>
		  </div>
			<div class="col-md-4 col-sm-4 col-xs-4" align='center'>
				<input type="text" name='itemnamedis[]' class="form-control col-md-8 col-xs-8" value='<?php echo $tmp->item?>' readonly>
				<input type="hidden" name='itemname[]' class="form-control col-md-8 col-xs-8" value='<?php echo $tmp->itemname?>' readonly>
			</div>		
			
			<div class="col-md-2 col-sm-2 col-xs-2">
				<input type="text" name="unitprice[]"  id='unitprice_<?php echo $i;?>' style='text-align: right;' readonly class="unitprice form-control col-md-8 col-xs-8" onkeypress="return isNumberKeyPeriod(event)" value='<?php echo $tmp->unitprice?>'>
			</div>
			<div class="col-md-2 col-sm-2 col-xs-2">
				<input type="text" name='quantity[]' readonly id='quantity_<?php echo $i;?>' style='text-align: right;' class="quantity form-control col-md-8 col-xs-8" onkeypress="return isNumberKeyPeriod(event)" value='<?php echo $tmp->quantity?>'>
			</div>
			
			
			<div class="col-md-2 col-sm-2 col-xs-2">
				<input type="number" name="dispatched[]" id='dispatched_<?php echo $i;?>' min="0" style='text-align: right;' class="dispatched form-control col-md-8 col-xs-8" onkeypress="return isNumberKey(event)" value='<?php echo get_dispatched_item($tmp->invoiceid,$tmp->itemname);?>'>
			</div>			
			<div class="col-md-1 col-sm-1 col-xs-1">
			&nbsp;
		  </div>
		</div>
		
		<?php
			$i++;
			}
		}
		?>
