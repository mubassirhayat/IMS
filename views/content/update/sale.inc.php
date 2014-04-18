<?php
	//Insert Here
	$errors = array();
	$success = array();
	
	if(isset($_POST['insert'])){
		$nic = $_POST['nic'];
		$custName = $_POST['custName'];
		$userId = $_POST['userId'];
		$saleDate = strtotime($_POST['saleDate']);
		$tPriceNoDisc = $_POST['tPriceNoDisc'];
		$discount = $_POST['discount'];
		$tPriceAfterD = $_POST['tPriceAfterD'];
		$GWExpiry = strtotime($_POST['GWExpiry']);

		$query = "INSERT INTO sales (
					customer_nic, temp_customer, user_id, sale_date, total_price_without_discount, discount, total_price_with_discount, g_w_expiry_date
				) VALUES (
					'{$nic}', '{$custName}', '{$userId}', '{$saleDate}', '{$tPriceNoDisc}', '{$discount}', '{$tPriceAfterD}', '{$GWExpiry}'
				)";
		$result = mysql_query($query) or die(mysql_error());
		if ($result) {
			// Success!
			echo "Item Successfully Added To Store";
		}
		
	}
?>
<style>
 .message_success {
        border:1px solid #58BA36;
        border-radius: 5px;
        background-color: #E9F9E5;
        padding:6px 8px; 
        color:#58BA36;
        font-size:11px;
        margin-bottom: 10px;
    }
    
    .message_error {
        border:1px solid #C83E16;
        border-radius: 5px;
        background-color: #F9E5E6;
        padding:6px 8px; 
        color:#C83E16;
        font-size:11px;
        -webkit-box-shadow: 0 2px 3px rgba(62,120,170,0.25);
        -moz-box-shadow:    0 2px 3px rgba(62,120,170,0.25);
        box-shadow:         0 2px 3px rgba(62,120,170,0.25);
        margin-bottom: 10px;
    }    
</style>
<?php
if (!empty($errors)) {
	foreach ($login->errors as $error) {
		echo '<div class="message_error">'.$error.'</div>';                
	}
}
if (!empty($success)) {
	foreach ($login->errors as $error) {
		echo '<div class="message_success">'.$success.'</div>';                
	}
}
?>
<script type="text/javascript">
	function getSlip(url ,title, w, h){
		var left = (screen.width/2)-(w/2);
		var top = (screen.height/2)-(h/2);
		var targetWin = window.open (url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
		targetWin.focus();
	}
	function callPopulate(var1, var2){
		var getURL = "index.php?page=<?php echo $_GET['page']; ?>&ope=<?php echo $_GET['ope']; ?>&" + var2 + "=";
		window.open(getURL + escape(var1), '_self')
	}
</script>
<div class="InsertTableCSS" >
<form name="sale" method="post" action="">
<table width="auto" align="center" border="0">
  <tr>
    <td colspan="2">Insert New Sale:</td>
  </tr>
  <tr>
    <td>Customer NIC (For registered):</td>
    <td>
		<select class="textBoxStyle" name="nic" id="nic" onchange="if(this.value != '000'){callPopulate(this.value, 'nic');}">
			<option value="000" <?php if(!isset($_GET['nic'])){echo "selected=\"selected\"";}?>>---Select---</option>
			<?php
				$q = mysql_query("SELECT * FROM customers");
				while($r  = mysql_fetch_array($q)){
			?>
					<option <?php if(isset($_GET['nic']) && $_GET['nic'] == $r['customer_nic']){echo "selected=\"selected\"";} ?> value="<?php echo $r['customer_nic']; ?>"><?php echo $r['customer_nic']; ?></option>
			<?php
				}
			?>
		</select>
	</td>
  </tr>
  <tr>
    <td>Customer Name:</td>
	<?php
		if(isset($_GET['nic'])){
			$q2 = mysql_fetch_array(mysql_query("SELECT * FROM customers WHERE customer_nic = '{$_GET['nic']}'"));
		}
	?>
    <td><input class="textBoxStyle" name="custName" id="custName" value="<?php if(isset($_GET['nic'])){echo $q2['customer_name'];} ?>" type="text"></td>
  </tr>
  <tr>
    <td>User Id:</td>
    <td><input readonly="true" class="textBoxStyle" name="userId" id="userId" type="text" value="<?php echo $_SESSION['user_name'];?>"></td>
  </tr>
  <tr>
    <td>Sale Date:</td>
    <td><input class="textBoxStyle" name="saleDate" id="saleDate" type="date"></td>
  </tr>
  <tr>
    <td>Total Price (In Rs.):</td>
    <td><input class="textBoxStyle" name="tPriceNoDisc" id="tPriceNoDisc" type="number"></td>
  </tr>
  <tr>
    <td>Discount (In Percent):</td>
    <td><input class="textBoxStyle" name="discount" id="discount" type="number"></td>
  </tr>
  <tr>
    <td>Total Price After Discount (In Rs.):</td>
    <td>
		<script type="text/javascript">
			function multiply()
			{
			   var textValue1 = document.getElementById('tPriceNoDisc').value;
			   var textValue2 = document.getElementById('discount').value;
			   document.getElementById('tPriceAfterD').value = textValue1 - (textValue2/100)*textValue1;
			}
		</script>
    	<input class="textBoxStyle" name="tPriceAfterD" id="tPriceAfterD" type="number" onfocus="multiply();"/>
    </td>
  </tr>
  <tr>
  	<td>Guarantee/Warranty Expiry</td>
	<td><input class="textBoxStyle" name="GWExpiry" id="GWExpiry" type="date" /></td>
  </tr>
  <tr>
  	<td colspan="2" align="right"><div align="right"><input class="buttonStyle" name="insert" onclick="urllll();" type="button" value="Insert"></div></td>
  </tr>
</table>
</form>
</div>
<script>
	function urllll() {
		var nic = document.getElementById('nic').value;
		var custName = document.getElementById('custName').value;		
		var userId = document.getElementById('userId').value;		
		var saleDate = document.getElementById('saleDate').value;
		var tPriceNoDisc = document.getElementById('tPriceNoDisc').value;
		var discount = document.getElementById('discount').value;
		var tPriceAfterD = document.getElementById('tPriceAfterD').value;
		
		getSlip('views/content/insert/sale_recipet.inc.php?nic='+nic+'&cName='+custName+'&user='+userId+'&sDate='+saleDate+'&tPND='+tPriceNoDisc+'&dscnt='+discount+'&tPWD='+tPriceAfterD, 'Sale Recipt',770,470);
	}
</script>