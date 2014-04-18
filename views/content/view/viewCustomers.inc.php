<div class="viewTableCSS" >
	<table>
		<tr>
			<td>Serial No.</td>
			<td>Full Name</td>
			<td>NIC No.</td>
			<td>Contact No.</td>
			<td>Address</td>
			<td>Action</td>
		</tr>
		<?php
			$i = 1;
			$q = mysql_query("SELECT * FROM customers");
			while($r = mysql_fetch_array($q)){
		?>
		<tr>
			<td><?php echo $i; $i++ ?></td>
			<td><?php echo $r['customer_name']; ?></td>
			<td><?php echo $r['customer_nic']; ?></td>
			<td><?php echo $r['customer_contact']; ?></td>
			<td><?php echo $r['customer_address']; ?></td>
			<td>
				<a href="index.php?page=customers&amp;ope=update&data=<?php echo $r['customer_id']; ?>" title="Update Record" target="_self">Edit</a> | 
				<a href="index.php?page=customers&amp;ope=delete&data=<?php echo $r['customer_id']; ?>" title="Delete Record" target="_self">Delete</a>
			</td>
		</tr>
		<?php } ?>
	</table>
</div>