<?php
	include_once("include/connect.php");
    session_start();

    if (isset($_GET['id_book']))
    {
        $id_book = $_GET['id_book'];
    }

    $id_user = $_SESSION['ID'];

    $rating = $_GET['estrela'];
	
	$query = "UPDATE book_user_read SET rating='$rating' WHERE id_book='$id_book' AND id_user='$id_user'";
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