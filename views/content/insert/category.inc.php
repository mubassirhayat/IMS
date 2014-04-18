<?php
	mysql_connect("localhost", "root", "");
	mysql_select_db("uniprojectims");
	if(isset($_POST['insert'])){
		$catName = $_POST['catName'];
		$query = "INSERT INTO item_category (
					item_category
				) VALUES (
					'{$catName}'
				)";
		$result = mysql_query($query);
		if ($result) {
			// Success!
			echo "New Category Added";
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
		<title>Inventory Management System</title>      
    </head>
		<style>
		.InsertTableCSS {
			width:auto;
			-moz-border-radius-bottomleft:16px;
			-webkit-border-bottom-left-radius:16px;
			border-bottom-left-radius:16px;
			-moz-border-radius-bottomright:16px;
			-webkit-border-bottom-right-radius:16px;
			border-bottom-right-radius:16px;
			-moz-border-radius-topright:16px;
			-webkit-border-top-right-radius:16px;
			border-top-right-radius:16px;
			-moz-border-radius-topleft:16px;
			-webkit-border-top-left-radius:16px;
			border-top-left-radius:16px;
		}
		.InsertTableCSS table{
			width:auto;
			height:auto;
			margin:0px;
			padding:0px;
		
		}
		.InsertTableCSS tr:last-child td:last-child {
			-moz-border-radius-bottomright:16px;
			-webkit-border-bottom-right-radius:16px;
			border-bottom-right-radius:16px;
		}
		.InsertTableCSS table tr:first-child td:first-child {
			-moz-border-radius-topleft:16px;
			-webkit-border-top-left-radius:16px;
			border-top-left-radius:16px;
		}
		.InsertTableCSS table tr:first-child td:last-child {
			-moz-border-radius-topright:16px;
			-webkit-border-top-right-radius:16px;
			border-top-right-radius:16px;
		}
		.InsertTableCSS tr:last-child td:first-child{
			-moz-border-radius-bottomleft:16px;
			-webkit-border-bottom-left-radius:16px;
			border-bottom-left-radius:16px;
		}
		.InsertTableCSS tr:hover td{
			background-color:#ffffff;
		}
		.InsertTableCSS td{
			vertical-align:middle;
			background-color:#e5e5e5;
			border:1px solid #000000;
			border-width:0px 1px 1px 0px;
			text-align:left;
			padding:7px;
			font-size:14px;
			font-family: Verdana, Geneva, sans-serif;
			font-weight: 600;
			color:#000000;
		}
		.InsertTableCSS tr:last-child td{
			border-width:0px 1px 0px 0px;
		}
		.InsertTableCSS tr td:last-child{
			border-width:0px 0px 1px 0px;
		}
		.InsertTableCSS tr:last-child td:last-child{
			border-width:0px 0px 0px 0px;
		}
		.InsertTableCSS tr:first-child td{
			background:-o-linear-gradient(bottom, #7f7f7f 5%, #cccccc 100%);	
			background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #7f7f7f), color-stop(1, #cccccc) );
			background:-moz-linear-gradient( center top, #7f7f7f 5%, #cccccc 100% );
			filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#7f7f7f", endColorstr="#cccccc");	
			background: -o-linear-gradient(top,#7f7f7f,cccccc);
			background-color:#7f7f7f;
			border:0px solid #000000;
			text-align:center;
			border-width:0px 0px 1px 1px;
			font-size:20px;
			font-family:Arial;
			font-weight:bold;
			color:#ffffff;
		}
		.InsertTableCSS tr:first-child:hover td{
			background:-o-linear-gradient(bottom, #7f7f7f 5%, #cccccc 100%);	
			background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #7f7f7f), color-stop(1, #cccccc) );
			background:-moz-linear-gradient( center top, #7f7f7f 5%, #cccccc 100% );
			filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#7f7f7f", endColorstr="#cccccc");	
			background: -o-linear-gradient(top,#7f7f7f,cccccc);
			background-color:#7f7f7f;
		}
		.InsertTableCSS tr:first-child td:first-child{
			border-width:0px 0px 1px 0px;
		}
		.InsertTableCSS tr:first-child td:last-child{
			border-width:0px 0px 1px 0px;
		}
		.textBoxStyle{
			border:1px solid #85c2de;
			box-shadow: 0 3px 0 #ccc, 0 -1px #fff inset;
			width:200px;
			padding:6px;
			-webkit-border-radius:7px;
			-moz-border-radius:7px;
			font-size:11px;
			font-weight:bold;
			color: #333;
		}
		.buttonStyle{
			background-image: url(../img/gradient1.png);
			border:1px solid #85c2de;
			padding:6px;
			-webkit-border-radius:7px;
			-moz-border-radius:7px;
			font-size:13px;
			font-weight:bold;
			color: #333;
		}
		.buttonStyle:hover{
			background-image: url(../img/gradient1_hover.png);
			border:1px solid #85c2de;
			padding:6px;
			-webkit-border-radius:7px;
			-moz-border-radius:7px;
			font-size:13px;
			font-weight:bold;
			color: #333;
		}
		.checkboxStyle {
			-webkit-appearance: none;
			background-color: #fafafa;
			border: 1px solid #cacece;
			box-shadow: 0 3px 0 #ccc, 0 -1px #fff inset;
			padding: 9px;
			border-radius: 3px;
			display: inline-block;
			position: relative;
		}
		.checkboxStyle:active, .checkboxStyle:checked:active {
			box-shadow: 0 3px 0 #ccc, 0 -1px #fff inset;
		}
		 
		.checkboxStyle:checked {
			background-color: #e9ecff;
			border: 2px solid #adb8c0;
			box-shadow: 0 3px 0 #ccc, 0 -1px #fff inset;
			color: #99a1f7;
		}
		select {
			padding:3px;
			margin: 0;
			-webkit-border-radius:4px;
			-moz-border-radius:4px;
			border-radius:4px;
			-webkit-box-shadow: 0 3px 0 #ccc, 0 -1px #fff inset;
			-moz-box-shadow: 0 3px 0 #ccc, 0 -1px #fff inset;
			box-shadow: 0 3px 0 #ccc, 0 -1px #fff inset;
			background: #f8f8f8;
			color:#888;
			border:none;
			outline:none;
			display: inline-block;
			-webkit-appearance:none;
			-moz-appearance:none;
			appearance:none;
			cursor:pointer;
		}
		</style>
    <body>
		<div class="InsertTableCSS">
			<form name="customers" method="post" action="">
			<table>
				<tr> 
					<td colspan="2">Add New Category</td>
				</tr>
				<tr>
					<td>Category Name:</td>
					<td><input class="textBoxStyle" name="catName" type="text"></td>
				</tr>
				<tr>
					<td colspan="2"><div align="right"><input class="buttonStyle" name="insert" type="submit" value="Insert"></div></td>
				</tr>
			</table>
			</form>
		</div>
	</body>
</html>