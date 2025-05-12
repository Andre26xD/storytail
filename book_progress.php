<?php
	include_once("include/connect.php");
	
	// Recebe os dados enviados pelo AJAX
	$data = json_decode(file_get_contents("php://input"), true);
	$id_user = $data['id_user'];
	$id_book = $data['id_book'];
	$page_number = $data['page_number'];
	
	$data_hora = date('Y-m-d');
	
	// Validação básica
	if (!$id_user || !$id_book || !$page_number) {
		echo json_encode(["success" => false, "error" => "Dados inválidos"]);
		exit;
	}

	// Query para contar as paginas do livro
	$query = "SELECT COUNT(id_page) AS paginas FROM pages WHERE id_book = '$id_book'";
	$result = mysqli_query($link, $query);
	$row = mysqli_fetch_assoc($result);
	$paginas = $row['paginas'] + 1;
	
	// Progresso do livro em percentagem
	$progresso = round(($page_number / $paginas) * 100);

	// Query para verificar se o livro ja esta a ser lido pelo user logado
	$query = "SELECT * FROM book_user_read WHERE id_book = '$id_book' AND id_user = '$id_user'";
	$result = mysqli_query($link, $query);
	$row = mysqli_fetch_assoc($result);
	$progresso_atual = $row['progress'];
	
	// Se esta a ser lido, atualiza o progresso e a ultima pagina lida, senao insere um novo registo
	if (mysqli_num_rows($result) == 0)
	{
		$query = "INSERT INTO book_user_read (id_book, id_user, progress, last_page_read, read_date)
		VALUES ('$id_book', '$id_user', '$progresso', '$page_number', '$data_hora')";
		$result = mysqli_query($link, $query);
	}
	elseif ($progresso > $progresso_atual)
	{
		$query = "UPDATE book_user_read SET progress='$progresso', last_page_read='$page_number' WHERE id_book = '$id_book'";
		$result = mysqli_query($link, $query);
	}

	if ($result)
	{
		echo json_encode(["success" => true]);
	}
	else
	{
		echo json_encode(["success" => false, "error" => mysqli_error($link)]);
	}
?>