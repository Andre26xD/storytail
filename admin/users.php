<?php
	include_once("../include/connect.php");
	include_once("include/head.html");
	include_once("include/header.php");
	
	$query = "SELECT users.*, user_type FROM users, user_types WHERE users.id_user_type = user_types.id_user_type";
	$result = mysqli_query($link, $query);
?>
	<h1>USERS</h1>
	<a href="users_inserir.php" style="width:5%; margin-left: 992px;"><img src="../imgs/icons/insert.png"><b>Register</b></a>
	<table class="tabela" cellspacing="0">
		<tr>
			<th><b>User Type</b></th>
			<th><b>First Name</b></th>
			<th><b>Last Name</b></th>
			<th><b>Username</b></th>
			<th><b>E-mail</b></th>
			<th><b>Password</b></th>
			<th><b>Photo</b></th>
			<th><b>Edit</b></th>
			<th><b>Delete</b></th>
		</tr>

		<?php
			while($row = mysqli_fetch_assoc($result)) {
		?>
	
		<tr>
			<td><?php echo $row['user_type']; ?></td>
			<td><?php echo $row['first_name']; ?></td>
			<td><?php echo $row['last_name']; ?></td>
			<td><?php echo $row['user_name']; ?></td>
			<td><?php echo $row['email']; ?></td>
			<td><?php echo $row['password']; ?></td>
			<td><img width="200px" height="200px" style="border-radius: 100%;" src="../upload/users/<?php echo $row['user_photo_url']; ?>"></td>
			<td><a href="users_editar.php?id_user=<?php echo $row['id_user']; ?>"><img src="../imgs/icons/edit.png"><b>Edit</b></a></td>
			<td><a href="users_eliminar.php?id_user=<?php echo $row['id_user']; ?>"><img src="../imgs/icons/delete.png"><b>Delete</b></a></td>
		</tr>
	
		<?php
			}
		?>

		</table>

		<?php
			include_once("../include/footer.php");
		?>