<script>
	window.onload = function() {
		var d = new Date().getTime();
		document.getElementById("tid").value = d;
	};
</script>
<div class="container" >
    <div class="row">
      <div class="col-md-12">
		<form method="post" name="customerData">
		<table width="40%" height="100" border='1' align="center">
			<table width="40%" height="100"  align="center" class="table" style="border:1px solid blue;">
				<center><h2 style="color:green;">CCavenue Payment Gateway Integration In PHP</h2></center>
				
				<tr>
					<td>TID	:</td><td><input type="text" name="tid" id="tid" readonly /></td>
				</tr>
				<tr>
					<td>Merchant Id	:</td><td><input type="text" name="merchant_id" value="<?php echo $this->config->item("merchant_id");?>"/></td>
				</tr>
				<tr>
					<td>Order Id	:</td><td><input type="text" name="order_id" value="123654789"/></td>
				</tr>
				<tr>
					<td>Amount	:</td><td><input type="text" name="amount" value="1.00"/></td>
				</tr>
				<tr>
					<td>Currency	:</td><td><input type="text" name="currency" value="INR"/></td>
				</tr>
				<tr>
					<td>Redirect URL	:</td><td><input type="text" name="redirect_url" value="<?php echo base_url('success');?>"/></td>
				</tr>
			 	<tr>
			 		<td>Cancel URL	:</td><td><input type="text" name="cancel_url" value="<?php echo base_url('paymenttest');?>"/></td>
			 	</tr>
			 	<tr>
					<td>Language	:</td><td><input type="text" name="language" value="EN"/></td>
				</tr>
		     	
		        <tr>
		        	<td colspan="2">Shipping information(optional)</td>
		        </tr>
		        <tr>
		        	<td>Shipping Name	:</td><td><input type="text" name="delivery_name" value="Sample"/></td>
		        </tr>
		        <tr>
		        	<td>Shipping Address	:</td><td><input type="text" name="delivery_address" value="Hyderabad"/></td>
		        </tr>
		        <tr>
		        	<td>shipping City	:</td><td><input type="text" name="delivery_city" value="Hyderabad"/></td>
		        </tr>
		        <tr>
		        	<td>shipping State	:</td><td><input type="text" name="delivery_state" value="Andhra"/></td>
		        </tr>
		        <tr>
		        	<td>shipping Zip	:</td><td><input type="text" name="delivery_zip" value="500081"/></td>
		        </tr>
		        <tr>
		        	<td>shipping Country	:</td><td><input type="text" name="delivery_country" value="India"/></td>
		        </tr>
		        <tr>
		        	<td>Shipping Tel	:</td><td><input type="text" name="delivery_tel" value="9490398046"/></td>
		        </tr>
		        <tr>
		        	<td></td><td><INPUT TYPE="submit" name="CheckOut" value="CheckOut"></td>
		        </tr>
	      	</table>
	      </form>
	    </div>
	</div>
</INPUT>