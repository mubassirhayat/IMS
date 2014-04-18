<?php
	if(!isset($_GET['data'])) {
		header("Location: index.php?page=users&ope=view");
	} 
	$data = "\"" . $_GET['data'] . "\"";
	
	$query = "DELETE FROM users WHERE user_name = {$data} LIMIT 1";
	$result = mysql_query($query);
	if(mysql_affected_rows() == 1) {
		header("Location: index.php?page=users&ope=view");
	} else {
		echo mysql_error();
	}
?>