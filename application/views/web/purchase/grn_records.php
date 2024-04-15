	<?php
		if(isset($records) && !empty($records)){
			$i = 1;
			foreach($records as $tmp){
		?>
		
		<div class="form-group">
           <div class="row">		
			<div class="col-md-2" align='center'>
				<input type="text" name='itemcode[]' class="form-control form-control-sm w-100" value='<?php echo $tmp->item?>' readonly>
			</div>	

            <div class="col-md-3" align='center'>
				<input type="text" name='itemname[]' class="itemname form-control form-control-sm w-100" value='<?php echo $tmp->itemname?>' readonly>
			</div>				
			
			<div class="col-md-3">
				<input type="text" name='description[]' class="description form-control form-control-sm w-100" value='<?php echo $tmp->description?>' readonly>
			</div>
			<div class="col-md-1">
				<input type="text" name='quantity[]' readonly id='quantity_<?php echo $i;?>' style='text-align: right;' class="quantity form-control form-control-sm w-100" onkeypress="return isNumberKeyPeriod(event)" value='<?php echo $tmp->quantity?>'>
			</div>
			<div class="col-md-1">
				<input type="text" name="received[]"  id='received_<?php echo $i;?>' style='text-align: right;' class="received form-control form-control-sm w-100" onkeypress="return isNumberKeyPeriod(event)" value='0'>
			</div>
			
			<div class="col-md-2">
				<input type="text" name="difference[]" id='difference_<?php echo $i;?>' style='text-align: right;' readonly class="difference form-control form-control-sm w-100" onkeypress="return isNumberKeyPeriod(event)" value='<?php echo $tmp->quantity?>'>
			</div>			
			</div>
		</div>
		
		<?php
			$i++;
			}
		}
		?>
