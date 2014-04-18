<?php
	//Insert Here
	$errors = array();
	$success = array();
	
	if(isset($_POST['insert'])){
		$saleNo = $_POST['saleNo'];
		$claimDate = strtotime($_POST['claimDate']);
		$claimReason = $_POST['claimReason'];
		$cleared = NULL;
		if(isset($_POST['cleared'])){
			if($_POST['cleared'] == 'YES'){
				$cleared = 1;
			} else if($_POST['cleared'] == 'NO'){
				$cleared = 0;
			} else {
				$cleared = 0;
			}	
		}
		
		$query = "INSERT INTO claim_record (
					sale_no, claim_date, claim_reason, claim_cleared
				) VALUES (
					'{$saleNo}', '{$claimDate}', '{$claimReason}', '{$cleared}'
				)";
		$result = mysql_query($query);
		if ($result) {
			// Success!
			echo "Item Successfully Added To Store";
			//redirect_to("../../../cnt.php?grp={$select_group}&table={$select_table}&ope={$select_ope}&suc=1");
		}
		
	}
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
					<select class="textBoxStyle" name="saleNo">
						<option value="000">---Select---</option>
						<?php
							$q = mysql_query("SELECT * FROM sales");
							while($r = mysql_fetch_array($q)){
						?>
						<option value="<?php echo $r['sale_no']; ?>"><?php echo $r['sale_no']; ?></option>	
						<?php } ?>
					</select>
				</td>
  			</tr>
  			<tr>
    			<td>Claim Date:</td>
    			<td><input class="textBoxStyle" name="claimDate" type="date" onfocus="now();"></td>
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
  				<td colspan="2"><div align="right"><input class="buttonStyle" name="insert" type="submit" value="Insert"></div></td>
  			</tr>
		</table>
	</form>
</div>