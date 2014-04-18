<?php
	//Insert Here
	if(isset($_POST['insert'])){
		$nic = $_POST['nic'];
		$custName = $_POST['custName'];
		$userId = $_POST['userId'];
		$selectedIR = $_POST['selectedIR'];
		$saleDate = strtotime($_POST['saleDate']);
		$tPriceNoDisc = $_POST['tPriceNoDisc'];
		$discount = $_POST['discount'];
		$tPriceAfterD = $_POST['tPriceAfterD'];

		$query = "INSERT INTO sales (
					customer_nic, temp_customer, user_id, items_sold, sale_date, total_price_without_discount, discount, total_price_with_discount
				) VALUES (
					'{$nic}', '{$custName}', '{$userId}', '{$selectedIR}', '{$saleDate}', '{$tPriceNoDisc}', '{$discount}', '{$tPriceAfterD}'
				)";
		$result = mysql_query($query) or die(mysql_error());
		if ($result) {
			// Success!
			$allItems = explode(',', $selectedIR);
			foreach($allItems as $item){
				$getItem = mysql_fetch_array(mysql_query("SELECT * FROM stock WHERE item_no = '{$item}'"));
				$newQuantity = $getItem['item_quantity'] - 1;
				$updateQ = mysql_query("UPDATE stock SET
											item_quantity = '{$newQuantity}'
										WHERE item_no = $item") or die(mysql_error());
			}
			echo "Item Successfully Added To Store";
			header("Location: index.php?page=sales&ope=insert");
		}
	}
	elseif(isset($_POST['getItems'])){
			//
	}
?>
<script>
	function urllll() {
		var nic = document.getElementById('nic').value;
		var custName = document.getElementById('custName').value;		
		var userId = document.getElementById('userId').value;		
		var saleDate = document.getElementById('saleDate').value;
		var tPriceNoDisc = document.getElementById('tPriceNoDisc').value;
		var discount = document.getElementById('discount').value;
		var tPriceAfterD = document.getElementById('tPriceAfterD').value;
		var selectedIR = document.getElementById('selectedIR').value;
		
		getSlip('views/content/insert/sale_recipet.inc.php?nic='+nic+'&cName='+custName+'&user='+userId+'&sDate='+saleDate+'&tPND='+tPriceNoDisc+'&dscnt='+discount+'&tPWD='+tPriceAfterD+'&ITEMS='+selectedIR, 'Sale Recipt',770,470);
	}
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
    <td>Select Items</td>
    <td>
		<select class="textBoxStyle" name="itemsB" id="itemsB">
			<?php
				$query = mysql_query("SELECT * FROM stock");
				while($r2 = mysql_fetch_array($query)){ 
					echo "<option value=\"". $r2['item_no'] . "\">" . $r2['item_name'] . "</option>";
				}
			?>
		</select>
		<input name="getItems" id="getItems" type="submit" value="Include Selected Items" class="buttonStyle" />
	</td>
  </tr>
  <tr>
  	<td>Items Selected:</td>
  	<td>
		<?php 
			if(isset($_POST['getItems'])) {
				$a = $_POST['selectedI'];
				$b = $_POST['selectedIR'];
				$tprice = $_POST['tPriceNoDisc'];
				$q2 = mysql_fetch_array(mysql_query("SELECT * FROM stock WHERE item_no = '{$_POST['itemsB']}'"));
				if(empty($a) || $a == ""){
					$a .= 'Item: ' . $q2['item_name'] . "<br />Sale Price: " . $q2['item_sale_price'] . "<br />";
					$tprice = $q2['item_sale_price'];
					$b .= $q2['item_no'];
				}
				else if(!empty($a)){
					$a .=  'Item: ' . $q2['item_name'] . "<br />Sale Price: " . $q2['item_sale_price'] . "<br />";
					$tprice += $q2['item_sale_price'];
					$b .= ',' . $q2['item_no'];
				}
				echo $a;
			} else {echo "Please Select Item(s)";}
		?>
		<input name="selectedI" id="selectedI" type="hidden" value="<?php if(isset($_POST['getItems'])) { echo $a; } else{}?>" />
		<input name="selectedIR" id="selectedIR" type="hidden" value="<?php if(isset($_POST['getItems'])) { echo $b; } else{}?>" />
	</td>
  </tr>
  <tr>
    <td>Sale Date:</td>
    <td><input class="textBoxStyle" name="saleDate" id="saleDate" type="date"></td>
  </tr>
  <tr>
    <td>Total Price (In Rs.):</td>
    <td><input class="textBoxStyle" name="tPriceNoDisc" id="tPriceNoDisc" value="<?php if(isset($_POST['getItems'])) { echo $tprice; }?>" type="number"></td>
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
  	<td colspan="2" align="right"><div align="right"><input class="buttonStyle" name="insert" type="submit" onclick="urllll();" value="Insert"></div></td>
  </tr>
</table>
</form>
</div>