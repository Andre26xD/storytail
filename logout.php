<?php
	session_start();

	unset($_SESSION['ID']);
	unset($_SESSION['USER_NOME']);
	unset($_SESSION['EMAIL']);
	unset($_SESSION['ACCESS']);

	header("Location: index.php");
	exit;
?>