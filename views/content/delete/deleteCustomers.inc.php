<?php
	if(!isset($_GET['data'])) {
		header("Location: index.php?page=customers&ope=view");
	} 
	$data = "\"" . $_GET['data'] . "\"";
	
	$query = "DELETE FROM customers WHERE customer_id = {$data} LIMIT 1";
	$result = mysql_query($query);
	if(mysql_affected_rows() == 1) {
		header("Location: index.php?page=customers&ope=view");
	} else {
		echo mysql_error();
	}
?>