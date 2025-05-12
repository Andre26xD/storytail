<?php
	include_once("include/connect.php");

	$username = $_POST['username'];
	$password = $_POST['password'];
	
	$query = "SELECT * FROM users WHERE id_user_type != 5";
	$result = mysqli_query($link, $query);
	
	while ($row = mysqli_fetch_assoc($result))
	{	
		if ($row['user_name'] == $username && $row['password'] == $password) {
			session_start();
			
			$_SESSION['ID'] = $row['id_user'];
			$_SESSION['USER_NOME'] = $row['user_name'];			
			$_SESSION['EMAIL'] = $row['email'];
			$_SESSION['ACCESS'] = $row['id_user_type'];
			
			header("Location: index.php");
			exit;
		}
	}

	header("Location: login.php?erro=1");
	exit;
?>