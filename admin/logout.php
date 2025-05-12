<?php
	session_start();

	unset($_SESSION['ID_ADMIN']);
	unset($_SESSION['USER_NOME_ADMIN']);
	unset($_SESSION['EMAIL_ADMIN']);
	
	header("Location: login.php");
	exit;
?>