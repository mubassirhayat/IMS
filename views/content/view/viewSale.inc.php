<div class="viewTableCSS" >
	<table>
		<tr>
			<td>Serial No.</td>
			<td>Customer NIC</td>
			<td>Customer Name</td>
			<td>Sales Man</td>
			<td>Sale Date</td>
			<td>Total Amount</td>
			<td>Discount</td>
			<td>Total Amount with discount</td>
			<td>Action</td>
		</tr>
		<?php
			$i = 1;
			$q = mysql_query("SELECT * FROM sales");
			while($r = mysql_fetch_array($q)){
		?>
		<tr>
			<td><?php echo $i; $i++ ?></td>
			<td><?php echo $r['customer_nic']; ?></td>
			<td><?php echo $r['temp_customer']; ?></td>
			<td><?php echo $r['user_id']; ?></td>
			<td><?php echo date("d-m-Y", $r['sale_date']); ?></td>
			<td><?php echo $r['total_price_without_discount']; ?></td>
			<td><?php echo $r['discount']; ?></td>
			<td><?php echo $r['total_price_with_discount']; ?></td>
			<td>
				<a style="color:#666" href="index.php?page=sales&ope=update&data=<?php echo $r['sale_no'] ?>" title="Update Record" target="_self">Edit</a> | 
				<a style="color:#666" href="index.php?page=sales&ope=delete&data=<?php echo $r['sale_no'] ?>" title="Delete Record" target="_self">Delete</a>
			</td>
		</tr>
		<?php } ?>
	</table>
</div>