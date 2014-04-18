<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sale Receipt</title>
</head>
<style>

/*CSS for View Tables*/
.viewTableCSS {
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
.viewTableCSS table{
	width:auto;
	height:auto;
	margin-left:auto;
	margin-right:auto;
	padding:0px;

}
.viewTableCSS tr:last-child td:last-child {
	-moz-border-radius-bottomright:16px;
	-webkit-border-bottom-right-radius:16px;
	border-bottom-right-radius:16px;
}
.viewTableCSS table tr:first-child td:first-child {
	-moz-border-radius-topleft:16px;
	-webkit-border-top-left-radius:16px;
	border-top-left-radius:16px;
}
.viewTableCSS table tr:first-child td:last-child {
	-moz-border-radius-topright:16px;
	-webkit-border-top-right-radius:16px;
	border-top-right-radius:16px;
}
.viewTableCSS tr:last-child td:first-child{
	-moz-border-radius-bottomleft:16px;
	-webkit-border-bottom-left-radius:16px;
	border-bottom-left-radius:16px;
}
.viewTableCSS tr:hover td{
	background-color:#ffffff;
}
.viewTableCSS td{
	vertical-align:middle;
	border:1px solid #000000;
	border-width:0px 1px 1px 0px;
	text-align:left;
	padding:3px;
	font-size:12px;
	font-family: Verdana, Geneva, sans-serif;
	line-height:1.7;
	font-weight: 600;
	color:#000000;
}
.viewTableCSS tr:last-child td{
	border-width:0px 1px 0px 0px;
}
.viewTableCSS tr td:last-child{
	border-width:0px 0px 1px 0px;
}
.viewTableCSS tr:last-child td:last-child{
	border-width:0px 0px 0px 0px;
}
.viewTableCSS tr:first-child td{
	background:-o-linear-gradient(bottom, #7f7f7f 5%, #cccccc 100%);	
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #7f7f7f), color-stop(1, #cccccc) );
	background:-moz-linear-gradient( center top, #7f7f7f 5%, #cccccc 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#7f7f7f", endColorstr="#cccccc");	
	background: -o-linear-gradient(top,#7f7f7f,cccccc);
	background-color:#7f7f7f;
	border:0px solid #000000;
	text-align:center;
	border-width:0px 0px 1px 1px;
	font-size:15px;
	font-family:Arial;
	font-weight:bold;
	color:#ffffff;
}
.viewTableCSS tr:first-child:hover td{
	background:-o-linear-gradient(bottom, #7f7f7f 5%, #cccccc 100%);	
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #7f7f7f), color-stop(1, #cccccc) );
	background:-moz-linear-gradient( center top, #7f7f7f 5%, #cccccc 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#7f7f7f", endColorstr="#cccccc");	
	background: -o-linear-gradient(top,#7f7f7f,cccccc);
	background-color:#7f7f7f;
}
.viewTableCSS tr:first-child td:first-child{
	border-width:0px 0px 1px 0px;
}
.viewTableCSS tr:first-child td:last-child{
	border-width:0px 0px 1px 0px;
}
</style>
<body>
<div class="viewTableCSS">
<table style="width:100%; border:#999" cellpadding="0" cellspacing="0">
	<tr>
		<td colspan="3"><h1 align="center">EMMA</h1></td>
	</tr>
	<tr>
		<td>Sales Man: <div style="clear:both; text-align:right"><?php echo $_GET['user']; ?></div></td>
		<?php if(isset($_GET['nic'])){ ?>
		<td>Customer's NIC: <div style="clear:both; text-align:right"><?php echo $_GET['nic']; ?></div></td>
		<?php } ?>
		<td>Customer's Name: <div style="clear:both; text-align:right"><?php echo $_GET['cName']; ?></div></td>
	</tr>
	<tr>
		<td colspan="3">Date: <?php echo $_GET['sDate']; ?></td>
	</tr>
	<tr>
		<td colspan="2"><div align="center">Items</div></td>
		<td><div align="center">Price</div></td>
	</tr>
	<?php
		$items = explode(',', $_GET['ITEMS']);
	?>
	<tr>
		<td colspan="2">
		<div style="padding-left: 100px;">
			<?php
				mysql_connect('localhost', 'root', '');
				mysql_select_db('uniprojectims') or die(mysql_error());
				foreach($items as $i){
					$q = mysql_fetch_array(mysql_query("SELECT * FROM stock WHERE item_no='$i'"));
					echo $q['item_name'] . "<br />";
				}
			?>
		</div>
		</td>
		<td>
		<?php
			foreach($items as $i){
				$q = mysql_fetch_array(mysql_query("SELECT * FROM stock WHERE item_no='$i'"));
				echo $q['item_sale_price'] . "<br />";
			}
		?>
		</td>
	</tr>
	<tr>
		<td>Total Amount: <div style="clear:both; text-align:right">Rs. <?php echo $_GET['tPND']; ?></div></td>
		<td>Discount: <div style="clear:both; text-align:right"><?php echo $_GET['dscnt']; ?>%</div></td>
		<td>Total Amount after Dsicount: <div style="clear:both; text-align:right">Rs. <?php echo $_GET['tPWD']; ?></div></td>
	</tr>
</table>
<input name="print" type="button" value="Print" onclick="window.print();" />
</div>
</body>
</html>