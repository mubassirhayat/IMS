<?php
	$data = "\"". $_GET['data'] . "\"";
	/*if(isset($_POST['update'])) {
		$fixedAssetNo = $_POST['fixedAssetNo']
		
		$query = "UPDATE m3_fixed_asset_reg SET
						fixed_asset_no = '{$fixedAssetNo}',
						fixed_asset_code = '{$fixedAssetCode}',
						part_name = '{$partName}',
						specification = '{$specification}',
						model = '{$model}',
						make = '{$make}',
						sub_units_applicable = '{$subUnitsApplicable}',
						mr_type = '{$MRType}',
						serial_no = '{$serialNo}'
					WHERE fixed_asset_no = {$data}";
		$result = mysql_query($query, $connection);
		if ($result) {
			// Success!
			mysql_select_db("sprintmms");
			redirect_to("cnt.php?grp={$select_group}&table={$select_table}&ope=1");
		}
		else {
			// Display error message.
			redirect_to("cnt.php?grp={$select_group}&table={$select_table}&ope={$select_ope}&data={$_GET['data']}&err=2");
		}
	}*/
$query = "SELECT * FROM claim_record WHERE claim_no = {$data}";
$result_set = mysql_query($query);
$row = mysql_fetch_array($result_set);
?>
<div class="InsertTableCSS" >
	<form name="claimForm" id="claimForm" method="post" action="index.php?page=claims&ope=insert">
		<table>
			<tr> 
				<td colspan="2">Claim Item</td>
			</tr>
  			<tr>
    			<td>Sale No:</td>
    			<td>
					<input readonly="true" type="text" value="<?php echo $row['sale_no'] ?>" class="textBoxStyle" name="saleNo"/>
				</td>
  			</tr>
  			<tr>
    			<td bgcolor="#FFFFFF">Claim Date:</td>
    			<td><input class="textBoxStyle" name="claimDate" type="date" value="<?php echo date('m-d-Y', $row['claim_date']); ?>" ></td>
  			</tr>
  			<tr>
    			<td>Claim Reason:</td>
    			<td><textarea class="textBoxStyle" name="claimReason" rows="8"></textarea></td>
  			</tr>
			<tr>
				<td>Claim Cleared:</td>
			    <td>
					<input class="checkboxStyle" name="cleared" type="radio" value="YES"><span>Yes</span>
					<input class="checkboxStyle" name="cleared" type="radio" value="NO"><span>No</span>
				</td>
		    </tr>
  			<tr>
  				<td colspan="2"><div align="right"><input class="buttonStyle" name="update" type="submit" value="Update"></div></td>
  			</tr>
		</table>
	</form>
</div>