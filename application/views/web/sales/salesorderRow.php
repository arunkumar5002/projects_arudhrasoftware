
	<?php if(!isset($orderrecords)) { ?>
	<div class="form-group">
        <div class="row">	
			<div class="col-md-2" align='center'>
				<select name="itemcode[]" id='itemcode_<?php echo $rowid ?>' class="itemcode form-control form-control-sm w-100">
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
				<input type="text" name='itemname[]' id='itemname_<?php echo $rowid ?>' class="itemname form-control form-control-sm w-100" value='' style="margin-right: 0px; width:80%;">
			</div>			
			
			<div class="col-md-3 text-center">
				<input type="text" name='description[]' class="description form-control form-control-sm w-100" value='' style="margin-right: 0px; width:80%;">
			</div>
			<div class="col-md-1 text-center ">
				<input type="text" name='quantity[]'  id='quantity_<?php echo $rowid ?>' style='text-align: right;' class="quantity form-control form-control-sm w-100"  value='0'>
			</div>
			<div class="col-md-1 text-center">
				<input type="text" name="unitprice[]"  id='unitprice_<?php echo $rowid ?>' style='text-align: right;' readonly class="unitprice w-100 form-control form-control-sm" onkeypress="return isNumberKeyPeriod(event)" value='0'>
			</div>
			<div class="col-md-1 text-center">
				<input type="text" name="unit[]"  id='unit_<?php echo $rowid ?>' style='text-align: right;' readonly class="unit w-100 form-control form-control-sm" onkeypress="return isNumberKeyPeriod(event)" value='0'>
			</div>
			<div class="col-md-1 text-center">
				<input type="text" name="amount[]" id='amount_<?php echo $rowid ?>' style='text-align: right;' readonly class="w-100 amount form-control form-control-sm" onkeypress="return isNumberKeyPeriod(event)" value='0'>
			</div>			
			<div class="col-md-1 text-center">
			<a style='cursor:pointer;padding:0px 0px' class="delrow btn btn-warning">Del</a>
			</div>
		</div>
		</div>
				<?php }else { 
		foreach($orderrecords as $temp){	
		?>
			
			
			<div class="form-group">
             <div class="row">			
			<div class="col-md-2" align='center'>
					<select name="itemcode[]" id='itemcode_1' class="itemcode form-control-sm w-100">
						<option value=''>Choose..</option>
						<?php
						if(!empty($itemmaster)){
							foreach($itemmaster as $tmp){
								if($tmp->itemid == $temp->itemcode)
								echo "<option selected value='$tmp->itemid'>$tmp->itemcode</option>";
								else
								echo "<option value='$tmp->itemid'>$tmp->itemcode</option>";
							}
						}
						?>
					</select>
				</div>	

               <div class="col-md-2 text-center">
				<input type="text" name='itemname[]' id='itemname_1' class="itemname form-control-sm w-100" value='<?php echo isset($temp)?$temp->itemname:'';?>' style="margin-right: 0px; width:80%;">
			   </div>				
				
				<div class="col-md-3 text-center">
					<input type="text" name='description[]' class="description form-control-sm w-100" value="<?php echo isset($temp)?$temp->description:'';?>" style="margin-right: 0px; width:80%;">
				</div>
				<div class="col-md-1 text-center">
					<input type="text" name='quantity[]'  id='quantity_1' style='text-align: right;' class="quantity form-control-sm w-100" onkeypress="return isNumberKeyPeriod(event)" value="<?php echo isset($temp)?$temp->quantity:'';?>">
				</div>
				<div class="col-md-1 text-center">
					<input type="text" name="unitprice[]"  id='unitprice_1' style='text-align: right;' readonly class="unitprice w-100 form-control-sm" onkeypress="return isNumberKeyPeriod(event)" value="<?php echo isset($temp)?$temp->unitprice:'';?>">
				</div>
				<div class="col-md-1 text-center">
					<input type="text" name="unit[]"  id='unit_1' style='text-align: right;' readonly class="unit w-100 form-control-sm" onkeypress="return isNumberKeyPeriod(event)" value="<?php echo isset($temp)?$temp->unit:'';?>">
				</div>		
				
			<div class="col-md-1 text-center">
					<input type="text" name="amount[]" id='amount_1' style='text-align: right;' readonly class="w-100 amount form-control-sm" onkeypress="return isNumberKeyPeriod(event)" value="<?php echo isset($temp)?$temp->amount:'';?>">
				</div>			
			<div class="col-md-1 text-center">
			<a style='cursor:pointer;padding:0px 0px' class="delrow btn btn-warning">Del</a>
			</div>
			</div>
			</div>
	<?php } ?>			
		<?php } ?>	