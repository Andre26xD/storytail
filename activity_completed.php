<?php
	include_once("include/connect.php");
	session_start();

    if (isset($_GET['id_activity_book']) && isset($_GET['id_book']))
    {
        $id_activity_book = $_GET['id_activity_book'];
        $id_book = $_GET['id_book'];
    }

    $id_user = $_SESSION['ID'];

	$query = "INSERT INTO activity_book_user (id_activity_book, id_user, progress)
	VALUES ('$id_activity_book', '$id_user', 1)";
	$result = mysqli_query($link, $query);
	
	if ($result)
	{
		header("Location: livro.php?sucesso=1&id_book=" . $id_book);
	}
	else
	{
		header("Location: livro.php?erro=1&id_book=" . $id_book);
	}
?>