		
		<?php
		if(isset($records) && !empty($records)){
			$i = 1;
			foreach($records as $tmp){
		?>
		
		<div class="form-group mb-0">
<div class='row'>		
		  <div class="col-md-1" style="text-align:center">
			<?php echo $i;?>
		  </div>
			<div class="col-md-3" align='center'>
				<input type="text" name='itemcodedis[]' class="form-control form-control-sm w-100" value='<?php echo $tmp->item?>' readonly>
				<input type="hidden" name='itemcode[]' class="form-control form-control-sm w-100" value='<?php echo $tmp->itemcode?>' readonly>
			</div>	

            <div class="col-md-4" align='center'>
				<input type="text" name='itemname[]' class="form-control form-control-sm w-100" value='<?php echo $tmp->itemname?>' readonly>
				
			</div>				
			
			<div class="col-md-1">
				<input type="text" name="unitprice[]"  id='unitprice_<?php echo $i;?>' style='text-align: right;' readonly class="form-control form-control-sm unitprice w-100" onkeypress="return isNumberKeyPeriod(event)" value='<?php echo $tmp->unitprice?>'>
			</div>
			<div class="col-md-1">
				<input type="text" name='quantity[]' readonly id='quantity_<?php echo $i;?>' style='text-align: right;' class="form-control form-control-sm quantity w-100" onkeypress="return isNumberKeyPeriod(event)" value='<?php echo $tmp->quantity?>'>
			</div>
			
			
			<div class="col-md-1">
				<input type="text" name="amount[]" id='amount_<?php echo $i;?>' style='text-align: right;' readonly class='form-control form-control-sm amount w-100' onkeypress="return isNumberKeyPeriod(event)" value='<?php echo $tmp->amount?>'>
			</div>			
			<div class="col-md-1 ">
			&nbsp;
		  </div>
		</div>
		</div>
		
		<br>
		<?php
			$i++;
			}
		}
		?>




