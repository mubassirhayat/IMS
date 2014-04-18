<div class="viewTableCSS" >
	<table>
		<tr>
			<td>Serial No.</td>
			<td>Sale No</td>
			<td>Claim Date</td>
			<td>Claim Reason</td>
			<td>Claim Cleared</td>
			<td>Action</td>
		</tr>
		<?php
			$i = 1;
			$q = mysql_query("SELECT * FROM claim_record");
			while($r = mysql_fetch_array($q)){
		?>
		<tr>
			<td><?php echo $i; $i++ ?></td>
			<td><?php echo $r['sale_no']; ?></td>
			<td><?php echo date('d-m-Y', $r['claim_date']); ?></td>
			<td><?php echo $r['claim_reason']; ?></td>
			<td><?php if($r['claim_cleared'] == 1){echo "YES";} else echo "NO" ?></td>
			<td>
				<a style="color:#666" href="index.php?page=claims&ope=update&data=<?php echo $r['claim_no']; ?>" title="Update Record" target="_self">Edit</a> | 
				<a style="color:#666" href="index.php?page=claims&ope=delete&data=<?php echo $r['claim_no']; ?>" title="Delete Record" target="_self">Delete</a>
			</td>
		</tr>
		<?php } ?>
	</table>
</div>