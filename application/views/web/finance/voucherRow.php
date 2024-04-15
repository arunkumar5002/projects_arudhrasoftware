		<div class="form-group">
        <div class="row">		
			<div class="col-md-1 rowid" align='center'>
				<?php echo $row;?>
			</div>		
			<div class="col-md-4">
				<input type="text" name="accountname[]" id="accountname_<?php echo $row; ?>" class="tabp accountname form-control form-control-sm">
			</div>
			<div class="col-md-2">
				<input type="text" id='debit_<?php echo $row; ?>' name="debit[]" style='text-align: right;' onkeypress="return isNumberKeyPeriod(event)" class="tabp debit form-control form-control-sm" value='0'>
			</div>
			<div class="col-md-2">
				<input type="text" id='credit_<?php echo $row; ?>' name="credit[]" style='text-align: right;' onkeypress="return isNumberKeyPeriod(event)" class="tabp credit form-control form-control-sm" value='0'>
			</div>
			<div class="col-md-2">
				<input type="text" name="reference[]" class="tabp reference form-control form-control-sm">
			</div>
			<div class="col-md-1" align='center'>
				<a style='cursor:pointer;padding:0px 0px' class="delRow btn btn-warning">Delete</a>
			</div>	
		</div>
		</div>
