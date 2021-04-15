<?php 

$ch=$_REQUEST['find'];

if($ch=='Card')
{ ?>
	<div class="col-sm-6">
	    <div class="form-group">
	        <label>Bank Name *</label>
	        <input type="text" name="bank_name" class="form-control" required>
	    </div>
	</div>
<?php }

if($ch=='Cheque')
{ ?>
	<div class="col-sm-6">
	    <div class="form-group">
	        <label>Bank Name *</label>
	        <input type="text" name="bank_name" class="form-control" required>
	    </div>
	</div>
	<div class="col-sm-6">
	    <div class="form-group">
	        <label>Cheque No. *</label>
	        <input type="text" name="cheque_no" class="form-control" required>
	    </div>
	</div>
	<div class="col-sm-6">
	    <div class="form-group">
	        <label>Cheque Date *</label>
	        <input type="date" name="cheque_date" class="form-control" required>
	    </div>
	</div>
<?php }

?>



