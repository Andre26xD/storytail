<?php
	include_once("../include/connect.php");

	if (isset($_GET['id_user']))
	{
		$id_user = $_GET['id_user'];
		
		$query = "SELECT user_photo_url FROM users WHERE id_user = '$id_user'";
		$result = mysqli_query($link, $query);
		$row = mysqli_fetch_assoc($result);
		
		$path = "../upload/users/" . $row['user_photo_url'];
		unlink ($path);
		
		$query = "DELETE FROM users WHERE id_user = '$id_user'";
		mysqli_query($link, $query);

		mysqli_close($link);
		
		header("Location: users.php");
	}
?>