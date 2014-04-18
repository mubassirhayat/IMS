<?php
	//Insert Here
	$errors = array();
	$success = array();
	
	if(isset($_POST['insert'])){
		$fullName = $_POST['fullName'];
		$NICNo = $_POST['NICNo'];
		$contact = $_POST['contact'];
		$address = $_POST['address'];
		
		$query = "INSERT INTO customers (
					customer_nic, customer_name, customer_contact, customer_address
				) VALUES (
					'{$NICNo}', '{$fullName}', '{$contact}', '{$address}'
				)";
		$result = mysql_query($query);
		if ($result) {
			// Success!
			echo "Item Successfully Added To Store";
			//redirect_to("../../../cnt.php?grp={$select_group}&table={$select_table}&ope={$select_ope}&suc=1");
		}
		
	}
?>
<div class="InsertTableCSS" >
<form name="customers" method="post" action="">
	<table >
		<tr> 
			<td colspan="2">Add New Customer</td>
		</tr>
		<tr>
			<td>Full Name:</td>
			<td><input class="textBoxStyle" name="fullName" type="text"></td>
		</tr>
		<tr>
			<td>NIC No:</td>
			<td><input class="textBoxStyle" name="NICNo" type="text"></td>
		</tr>
		<tr>
			<td>Contact:</td>
			<td><input class="textBoxStyle" name="contact" type="text"></td>
		</tr>
		<tr>
			<td>Address:</td>
			<td><textarea class="textBoxStyle" name="address" rows="7"></textarea></td>
		</tr>
		<tr>
			<td colspan="2"><div align="right"><input class="buttonStyle" name="insert" type="submit" value="Insert"></div></td>
		</tr>
	</table>
</form>
</div>
								