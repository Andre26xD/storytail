<?php
	include_once("include/connect.php");
	session_start();

    if (isset($_GET['id_book']))
    {
        $id_book = $_GET['id_book'];
    }

    $id_user = $_SESSION['ID'];
	
	$query = "INSERT INTO book_user_favorite (id_book, id_user)
	VALUES ('$id_book', '$id_user')";
	$result = mysqli_query($link, $query);
	
	if ($result)
	{
		header("Location: livro.php?id_book=" . $id_book);
	}
	else
	{
		header("Location: livro.php?id_book=" . $id_book);
	}
?>