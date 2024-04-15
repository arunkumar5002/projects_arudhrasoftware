		<?php
		if(isset($records) && !empty($records)){
			$i = 1;
			foreach($records as $tmp){
		?>
		
		<div class="form-group">	
			<div class="col-md-3 col-sm-3 col-xs-3" align='center'>
				<input type="text" name='itemname[]' class="form-control col-md-8 col-xs-8" value='<?php echo $tmp->item?>' readonly>
			</div>		
			
			<div class="col-md-3 col-sm-3 col-xs-3">
				<input type="text" name='description[]' class="description form-control col-md-8 col-xs-8" value='<?php echo $tmp->description?>' readonly>
			</div>
			<div class="col-md-2 col-sm-2 col-xs-2">
				<input type="text" name='quantity[]' readonly id='quantity_<?php echo $i;?>' style='text-align: right;' class="quantity form-control col-md-8 col-xs-8" onkeypress="return isNumberKeyPeriod(event)" value='<?php echo $tmp->quantity?>'>
			</div>
			<div class="col-md-2 col-sm-2 col-xs-2">
				<input type="text" name="received[]"  id='received_<?php echo $i;?>' style='text-align: right;' class="received form-control col-md-8 col-xs-8" onkeypress="return isNumberKeyPeriod(event)" value='0'>
			</div>
			
			<div class="col-md-2 col-sm-2 col-xs-2">
				<input type="text" name="difference[]" id='difference_<?php echo $i;?>' style='text-align: right;' readonly class="difference form-control col-md-8 col-xs-8" onkeypress="return isNumberKeyPeriod(event)" value='<?php echo $tmp->quantity?>'>
			</div>			
			
		</div>
		
		<?php
			$i++;
			}
		}
		?>
