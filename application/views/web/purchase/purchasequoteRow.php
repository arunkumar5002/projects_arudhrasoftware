
    <div class="form-group">
		<div class="row">	
			<div class="col-md-2" align='center'>
			  <select name="itemcode[]" id='itemcode_<?php echo $rowid;?>' class="itemcode form-control form-control-sm w-100">
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
			
			<div class="col-md-3">
				<input type="text" name='itemname[]' class="itemname form-control form-control-sm w-100" id='itemname_<?php echo $rowid;?>' value=''>
			</div>
			
			<div class="col-md-3">
				<input type="text" name='description[]' class="description form-control form-control-sm w-100" id='description_<?php echo $rowid;?>' value=''>
			</div>
			<div class="col-md-1">
				<input type="text" name="quantity[]"  id='quantity_<?php echo $rowid;?>' style='text-align: right;'  class="quantity w-100 form-control form-control-sm" value='0'>
			</div>
			<div class="col-md-1">
				<input type="text" name="unitprice[]"  id='unitprice_<?php echo $rowid;?>' style='text-align: right;'  class="unitprice w-100 form-control form-control-sm" value='0'>
			</div>
			
			<div class="col-md-1">
				<input type="text" name="amount[]" id='amount_<?php echo $rowid;?>' style='text-align: right;' readonly class="w-100 amount form-control form-control-sm"  value='0'>
			</div>	
             <div class="col-md-1">
             <a style='cursor:pointer;padding:0px 0px' class="delrow btn btn-warning">Del</a>	
			</div>			 
			
		</div> 
		</div>


	