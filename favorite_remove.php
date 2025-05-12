<?php
	include_once("include/connect.php");
	session_start();

    if (isset($_GET['id_book']))
    {
        $id_book = $_GET['id_book'];
    }

    $id_user = $_SESSION['ID'];

	$query = "DELETE FROM book_user_favorite WHERE id_book = '$id_book' AND id_user = '$id_user'";
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