<?php
	if(!isset($_GET['data'])) {
		header("Location: index.php?page=claims&ope=view");
	}
	$data = "\"" . $_GET['data'] . "\"";
	
	$query = "DELETE FROM claim_record WHERE claim_no = {$data} LIMIT 1";
	$result = mysql_query($query);
	if(mysql_affected_rows() == 1) {
		header("Location: index.php?page=claims&ope=view");
	} else {
		echo mysql_error();
	}
?>