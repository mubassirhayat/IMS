<div class="viewTableCSS" >
	<table>
		<tr>
			<td>Serial No.</td>
			<td>User Name</td>
			<td>E-Mail</td>
			<td>Contact</td>
			<td>Address</td>
			<td>Action</td>
		</tr>
		<?php
			$i = 1;
			$q = mysql_query("SELECT user_name, user_email, user_contact, user_address FROM users");
			while($r = mysql_fetch_array($q)){
		?>
		<tr>
			<td><?php echo $i; $i++; ?></td>
			<td><?php echo $r['user_name']; ?></td>
			<td><?php echo $r['user_email']; ?></td>
			<td><?php echo $r['user_contact']; ?></td>
			<td><?php echo $r['user_address']; ?></td>
			<td>
				<a style="color:#666" href="index.php?page=users&ope=update&data=<?php echo $r['user_name']; ?>" title="Update Record" target="_self">Edit</a> | 
				<a style="color:#666" href="index.php?page=users&ope=delete&data=<?php echo $r['user_name']; ?>" title="Delete Record" target="_self">Delete</a>
			</td>
		</tr>
		<?php } ?>
	</table>
</div>