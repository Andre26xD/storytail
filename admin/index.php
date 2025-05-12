<?php
	session_start();

	if(!isset($_SESSION['ID_ADMIN']))
	{
		header("Location: login.php");
		exit;
	}
	else
	{
		include_once("include/head.html");
		include_once("include/header.php");
	}
?>

<h1>Welcome to Control Panel</h1>

<div>
	<img style="width:100%;" src="../imgs/Floresta.jpg">
</div>

<?php
	include_once("../include/footer.php");
?>