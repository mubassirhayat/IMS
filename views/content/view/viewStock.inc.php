<div class="viewTableCSS" >
	<table>
		<tr>
			<td>Item No</td>
			<td>Item Name</td>
			<td>Quantity</td>
			<td>Date Added</td>
			<td>Category</td>
			<td>Manufacturer</td>
			<td>Guarantee/Warranty</td>
			<td>Universal Product Code</td>
			<td>Expiry date</td>
			<td>Purchase Price</td>
			<td>Sale Price</td>
			<td>Action</td>
		</tr>
		<?php
			$q = mysql_query("SELECT * FROM stock");
			while($r = mysql_fetch_array($q)){
		?>
		<tr>
			<td><?php echo $r['item_no']; ?></td>
			<td><?php echo $r['item_name']; ?></td>
			<td><?php echo $r['item_quantity']; ?></td>
			<td><?php echo date('d-m-Y', $r['date_item_added']); ?></td>
			<?php $getCat = mysql_fetch_array(mysql_query("SELECT * FROM item_category WHERE category_id = {$r['category_id']}")); ?>
			<td><?php echo $getCat['item_category']; ?></td>
			<td><?php echo $r['item_manufacturer']; ?></td>
			<td><?php if(!empty($r['item_g_w_check'])){echo $r['item_g_w_check'];} else{ echo "No Guarantee or Warranty";} ?></td>
			<td><?php echo $r['item_upc']; ?></td>
			<td><?php echo date('d-m-Y', $r['item_expiry_date']); ?></td>
			<td><?php echo $r['item_purchase_price']; ?></td>
			<td><?php echo $r['item_sale_price']; ?></td>
			<td>
				<a style="color:#666" href="index.php?page=stock&ope=update&data=<?php echo $r['item_no']; ?>" title="Update Record" target="_self">Edit</a> | 
				<a style="color:#666" href="index.php?page=stock&ope=delete&data=<?php echo $r['item_no']; ?>" title="Delete Record" target="_self">Delete</a>
			</td>
		</tr>
		<?php } ?>
	</table>
</div>