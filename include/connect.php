<?php
	$link = mysqli_connect("localhost", "root", "", "storytail");
	
	if (!$link) 
	{
		die (mysqli_error($link));
		exit;
	}
?>