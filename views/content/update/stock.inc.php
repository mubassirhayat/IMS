<?php
	//Insert Here
	$errors = array();
	$success = array();
	
	if(isset($_POST['insert'])){
		$itemName = $_POST['itemName'];
		$quantity = $_POST['quantity'];
		$dateAdded = strtotime($_POST['dateAdded']);
		$categoryId = $_POST['categoryId'];
		$manufacturer = $_POST['manufacturer'];
		$upc = $_POST['upc'];
		$expiryDate = strtotime($_POST['expiryDate']);
		$purchasePrice = $_POST['purchasePrice'];
		$salePrice = $_POST['salePrice'];
		$gwc = NULL;
		if(isset($_POST['gwc'])){
			if($_POST['gwc'] == 'w'){
				$gwc = "Guarantee";
			} else if($_POST['gwc'] == 'g'){
				$gwc = "Warranty";
			} else {
				$gwc = "";
			}
		} else {
			$gwc = "";
		}
		$query = "INSERT INTO stock (
					item_name, item_quantity, date_item_added, category_id, item_manufacturer, item_g_w_check, item_upc, item_expiry_date, item_purchase_price, item_sale_price
				) VALUES (
					'{$itemName}', {$quantity}, {$dateAdded}, {$categoryId}, '{$manufacturer}', '{$gwc}', '{$upc}', {$expiryDate}, {$purchasePrice}, {$salePrice}
				)";
		$result = mysql_query($query);
		if ($result) {
			// Success!
			echo "Item Successfully Added To Store";
			//redirect_to("../../../cnt.php?grp={$select_group}&table={$select_table}&ope={$select_ope}&suc=1");
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
<script type="application/javascript">
	function popUP(url ,title, w, h) {
		var left = (screen.width/2)-(w/2);
		var top = (screen.height/2)-(h/2);
		var targetWin = window.open (url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
		targetWin.focus();
	}
	function urllll() {
		popUP('views/content/category.inc.php', 'New Category',400,400);
	}
</script>
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
<div class="InsertTableCSS" >
<form name="stock" method="post" action="">
<table>
  <tr>
    <td colspan="2">Add New Item to the Stock:</td>
  </tr>
  <tr>
    <td>Item Name:</td>
    <td><input class="textBoxStyle" name="itemName" type="text"></td>
  </tr>
  <tr>
    <td>Quantity:</td>
    <td><input class="textBoxStyle" name="quantity" type="number"></td>
  </tr>
  <tr>
    <td>Date Added:</td>
    <td><input class="textBoxStyle" name="dateAdded" type="date"></td>
  </tr>
  <tr>
    <td>Category:</td>
    <td>
		<select class="textBoxStyle" name="categoryId" >
			<option value="000">---Select---</option>
			<?php
				$query = mysql_query("SELECT * FROM item_category");
				while($r = mysql_fetch_array($query)){ 
					echo "<option value=\"". $r['category_id'] . "\">" . $r['item_category'] . "</option>";
				}
			?>
		</select>
		<a href="#" onclick="urllll()"><div style=" display:inline; color:#333;">Add New Category</div></a>
	</td>
  </tr>
  <tr>
    <td>Manufacturer:</td>
    <td><input class="textBoxStyle" name="manufacturer" type="text"></td>
  </tr>
  <tr>
    <td>Universal Product Code:</td>
    <td><input class="textBoxStyle" name="upc" type="text"></td>
  </tr>
  <tr>
    <td>Expiry Date:</td>
    <td><input class="textBoxStyle" name="expiryDate" type="date"></td>
  </tr>
  <tr>
    <td>Purchase Price (In Rs.):</td>
    <td><input class="textBoxStyle" name="purchasePrice" type="number"></td>
  </tr>
  <tr>
    <td>Sale Price (In Rs.):</td>
    <td><input class="textBoxStyle" name="salePrice" type="number"></td>
  </tr>
  <tr>
    <td colspan="2">
    	<div align="center">
			<input class="checkboxStyle" name="gwc" type="radio" value="g"><span>Guarantee</span>
    		<input class="checkboxStyle" name="gwc" type="radio" value="w"><span>Warranty</span>
		</div>
    </td>
  </tr>
  <tr>
  	<td colspan="2" align="right"><div align="right"><input class="buttonStyle" name="insert" type="submit" value="Insert"></div></td>
  </tr>
</table>
</form>
</div>