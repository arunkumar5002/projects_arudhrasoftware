     <?php
		if(isset($records) && !empty($records)){
			$i = 1;
			foreach($records as $tmp){
		?>
	<div class="form-group">
   <div class="row">	
			<div class="col-md-2" align='center'>
				<input type="text" name='itemcodedis[]' class="form-control form-control-sm w-100" value='<?php echo $tmp->item?>' readonly>
				<input type="hidden" name='itemcode[]' class="form-control form-control-sm w-100" value='<?php echo $tmp->itemcode?>' readonly>
			</div>	

           <div class="col-md-3" align='center'>
				<input type="test" name='itemname[]' class="form-control form-control-sm w-100" value='<?php echo $tmp->itemname?>'>
			</div>				
			
			<div class="col-md-3 text-center">
				<input type="text" name='description[]' class="description form-control form-control-sm w-100" value='<?php echo $tmp->description?>'>
			</div>
			<div class="col-md-1">
				<input type="text" name='quantity[]'  id='quantity_<?php echo $i;?>' style='text-align: right;' class="quantity form-control form-control-sm w-100" onkeypress="return isNumberKeyPeriod(event)" value='<?php echo $tmp->quantity?>'>
			</div>
			<div class="col-md-1 text-center">
				<input type="text" name="unitprice[]"  id='unitprice_<?php echo $i;?>' style='text-align: right;' readonly class="unitprice w-100 form-control form-control-sm" onkeypress="return isNumberKeyPeriod(event)" value='<?php echo $tmp->unitprice?>'>
			</div>
			
			<div class="col-md-1 text-center">
				<input type="text" name="amount[]" id='amount_<?php echo $i;?>' style='text-align: right;' readonly class="w-100 amount form-control form-control-sm" onkeypress="return isNumberKeyPeriod(event)" value='<?php echo $tmp->amount?>'>
			</div>			
			</div>
		</div>
			<?php
			$i++;
			}
		}
		?>