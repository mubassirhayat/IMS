<?php
	mysql_connect("localhost", "root", "");
	mysql_select_db("uniprojectims");	
	$stock = NULL;
	$sales = NULL;
	$claims = NULL;
	$users = NULL;
	$customers = NULL;
	if(isset($_SESSION['user_role'])){
		if($_SESSION['user_role'] == "admin"){
			$stock = true;
			$sales = true;
			$claims = true;
			$users = true;
			$customers = true;
		} else if($_SESSION['user_role'] == "salesman"){
			$stock = false;
			$sales = true;
			$claims = true;
			$users = false;
			$customers = true;
		} else if($_SESSION['user_role'] == "stockman"){
			$stock = true;
			$sales = false;
			$claims = false;
			$users = false;
			$customers = false;
		}
?>
<div class="contentHTML">
	<div class="contentHeader">
		<a href="index.php"><div>Inventory </div><div>Management </div><div>System</div></a>
	</div>
	<div class="contentBody">
		<div class="subnav">
			<?php if(isset($stock) && $stock == true){ ?>
			<h1>Stock</h1>
			<ul>
				<li><a href="index.php?page=stock&ope=view">View Stock</a></li>
				<li><a href="index.php?page=stock&ope=insert">Insert New Item</a></li>
			</ul><br>
			<?php } ?>
			<?php if(isset($sales) && $sales == true){ ?>
			<h1>Sales</h1>
			<ul>
				<li><a href="index.php?page=sales&ope=view">View all Sales</a></li>
				<li><a href="index.php?page=sales&ope=insert">New Sale</a></li>
			</ul><br>
			<?php } ?>
			<?php if(isset($claims) && $claims == true){ ?>
			<h1>Claims</h1>
			<ul>
				<li><a href="index.php?page=claims&ope=view">View Claims</a></li>
				<li><a href="index.php?page=claims&ope=insert">Claim an Item</a></li>
			</ul><br>
			<?php } ?>
			<?php if(isset($users) && $users == true){ ?>
			<h1>Users</h1>
			<ul>
				<li><a href="index.php?page=users&ope=view">View all Users</a></li>
				<li><a href="index.php?page=users&ope=insert">Create new Account</a></li>
			</ul><br>
			<?php } ?>
			<?php if(isset($customers) && $customers == true){ ?>
			<h1>Customers</h1>
			<ul>
				<li><a href="index.php?page=customers&ope=view">View all Registered Customers</a></li>
				<li><a href="index.php?page=customers&ope=insert">Add new Customer</a></li>
			</ul><br>
			<?php } ?>

		</div>
		<div class="mainContent">
			<div class="padded">
				<p>
					<?php
						if(isset($_GET['page'])){
							if($_GET['page'] == 'stock'){
								if($_GET['ope'] == 'view'){
									include("views/content/view/viewStock.inc.php");
								} else if($_GET['ope'] == 'insert'){
									include("views/content/insert/stock.inc.php");
								} else if($_GET['ope'] == 'update'){
									include("views/content/update/stock.inc.php");
								} else if($_GET['ope'] == 'delete'){
									include("views/content/delete/deleteStock.inc.php");
								}
							} else if($_GET['page'] == 'sales'){
								if($_GET['ope'] == 'view'){
									include("views/content/view/viewSale.inc.php");
								} else if($_GET['ope'] == 'insert'){
									include("views/content/insert/sale.inc.php");
								} else if($_GET['ope'] == 'update'){
									include("views/content/update/sale.inc.php");
								} else if($_GET['ope'] == 'delete'){
									include("views/content/delete/deleteSale.inc.php");
								}
							} else if($_GET['page'] == 'claims'){
								if($_GET['ope'] == 'view'){
									include("views/content/view/viewClaim.inc.php");
								} else if($_GET['ope'] == 'insert'){
									include("views/content/insert/claim.inc.php");
								} else if($_GET['ope'] == 'update'){
									include("views/content/update/claim.inc.php");
								} else if($_GET['ope'] == 'delete'){
									include("views/content/delete/deleteClaim.inc.php");
								}
							} else if($_GET['page'] == 'users'){
								if($_GET['ope'] == 'view'){
									include("views/content/view/viewUsers.inc.php");
								} else if($_GET['ope'] == 'insert'){
									include("views/content/insert/users.inc.php");
								} else if($_GET['ope'] == 'update'){
									include("views/content/update/users.inc.php");
								} else if($_GET['ope'] == 'delete'){
									include("views/content/delete/deleteUsers.inc.php");
								}
							} else if($_GET['page'] == 'customers'){
								if($_GET['ope'] == 'view'){
									include("views/content/view/viewCustomers.inc.php");
								} else if($_GET['ope'] == 'insert'){
									include("views/content/insert/customers.inc.php");
								} else if($_GET['ope'] == 'update'){
									include("views/content/update/updateCustomers.inc.php");
								} else if($_GET['ope'] == 'delete'){
									include("views/content/delete/deleteCustomers.inc.php");
								}
							} 
						}
					?>
				</p>
			</div>
		</div>
	</div>
</div>
<?php } ?>