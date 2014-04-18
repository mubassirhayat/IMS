<?php
	if(!isset($_GET['data'])) {
		header("Location: index.php?page=sales&ope=view");
	}
	$data = "\"" . $_GET['data'] . "\"";
	
	$query = "DELETE FROM sales WHERE sale_no = {$data} LIMIT 1";
	$result = mysql_query($query);
	if(mysql_affected_rows() == 1) {
		header("Location: index.php?page=sales&ope=view");
	} else {
		echo mysql_error();
	}
?>