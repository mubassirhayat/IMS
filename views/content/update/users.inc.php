<?php
	//Insert Here
	$errors = array();
	$success = array();
	
	if(isset($_POST['insert'])){
		$user_name = substr($_POST['user_name'], 0, 64);
		$password = NULL;
		
		if($_POST['password'] == $_POST['re_password']){
			$password = substr($_POST['password'], 0, 64);
		} else {
			die( "Password does not match");
		}
		$email = substr($_POST['email'], 0, 64);
		$contact = $_POST['contact'];
		$address = $_POST['address'];
		$role = $_POST['role'];
		
		function get_salt($length) {     
			$options = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789./';
			$salt = '';
			for ($i = 0; $i <= $length; $i++) {
				$options = str_shuffle ( $options );
				$salt .= $options [rand ( 0, 63 )];
			}
			return $salt;
		}
		$max_salt = CRYPT_SALT_LENGTH;
		$hashing_algorithm = '$2a$10$';
		$salt = get_salt ( $max_salt );
		$password_hash = crypt($password, $hashing_algorithm . $salt);
		
		$check_username = mysql_num_rows(mysql_query("SELECT user_name FROM users WHERE user_name = '{$user_name}'"));
		if($check_username > 0){
			die("User Name already Taken");
		}
		else {
			$query = "INSERT INTO users (
					user_name, user_password_hash, user_email, user_role, user_contact, user_address
				) VALUES (
					'{$user_name}', '{$password_hash}', '{$email}', '{$role}', '{$contact}', '{$address}'
				)";
			$result = mysql_query($query);
			if ($result) {
				// Success!
				echo "Item Successfully Added To Store";
				//redirect_to("../../../cnt.php?grp={$select_group}&table={$select_table}&ope={$select_ope}&suc=1");
			}			
		}

	}
?>
<div class="InsertTableCSS" >
	<form name="claim" method="post" action="">
		<table>
		  <tr>
			<td colspan="2">Create New User</td>
		  </tr>
		  <tr>
			<td>Username:</td>
			<td><input class="textBoxStyle" name="user_name" type="text"></td>
		  </tr>
		  <tr>
			<td>Password:</td>
			<td><input class="textBoxStyle" name="password" type="password"></td>
		  </tr>
		  <tr>
			<td>Retype Password:</td>
			<td><input class="textBoxStyle" name="re_password" type="password"></td>
		  </tr>
		  <tr>
			<td>Email:</td>
			<td><input class="textBoxStyle" name="email" type="email"></td>
		  </tr>
		  <tr>
			<td>Designation:</td>
			<td>
				<input class="checkboxStyle" name="role" type="radio" value="admin"><span>Administrator</span>
	    		<input class="checkboxStyle" name="role" type="radio" value="salesman"><span>Sales Man</span>
	    		<input class="checkboxStyle" name="role" type="radio" value="stockman"><span>Stock Manager</span>
			</td>
		  </tr>
		  <tr>
			<td>Contact:</td>
			<td><input class="textBoxStyle" name="contact" type="text"></td>
		  </tr>
		  <tr>
			<td>Address:</td>
			<td><textarea class="textBoxStyle" name="address" rows="7"></textarea></td>
		  </tr>
		  <tr>
			<td colspan="2"><div align="right"><input class="buttonStyle" name="insert" type="submit" value="Insert"></div></td>
		  </tr>
		</table>
	</form>
</div>