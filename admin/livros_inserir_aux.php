<?php
	$titulo = $_POST["titulo"];
	$descricao = $_POST["descricao"];
	$tempo = $_POST["tempo"];
	$idade = $_POST["idade"];
	$nivel = $_POST["nivel"];
	$autor = $_POST["autor"];
	
	include_once("../include/connect.php");
	
	if (isset ($_POST['submit']))
	{
		$path = "../upload/livros/" . $titulo;
		
		if (!is_dir($path)) {
			mkdir($path);
		}
		
		$capa = basename($_FILES["capa"]["name"]);
		$audio = basename($_FILES["audio"]["name"]);
		$video = basename($_FILES["video"]["name"]);

		$data_hora = date('Y-m-d H:i:s');
		
		$target_file = $path . '/' . $capa;
		$target_file2 = $path . '/' . $audio;
		$target_file3 = $path . '/' . $video;

		if (move_uploaded_file($_FILES["capa"]["tmp_name"], $target_file))
		{			
			$query = "INSERT INTO books (title, description, cover_url, read_time, audio_url, id_age_group, is_active, access_level, created_at, updated_at) 
			VALUES ('$titulo', '$descricao', '$capa', '$tempo', '$audio', '$idade', 1, '$nivel', '$data_hora', '$data_hora')";
			$result = mysqli_query($link, $query);
			$id_livro = mysqli_insert_id($link);
			
			$query = "INSERT INTO videos (id_book, title, video_url, created_at, updated_at) VALUES ('$id_livro','$video','$video','$data_hora', '$data_hora')";
			$result = mysqli_query($link, $query);
			
			$query = "INSERT INTO author_book (id_author, id_book) 
			VALUES ('$autor', '$id_livro')";
			$result = mysqli_query($link, $query);
			
			for ($i = 0; $i < count($_FILES['paginas']['name']); $i++) {
				$pagina = basename($_FILES['paginas']['name'][$i]);
				
				$target_file = "../upload/livros/" . $titulo . '/' . $pagina;
				
				if (move_uploaded_file($_FILES["paginas"]["tmp_name"][$i], $target_file))
				{
					$query = "INSERT INTO pages (id_book, page_image_url, page_index, created_at, updated_at) 
					VALUES ('$id_livro', '$pagina', '$i', '$data_hora', '$data_hora')";
					$result = mysqli_query($link, $query);
				}
			}
		}
		
		echo (mysqli_error($link));

		if ($result)
		{
			echo 1;
			header("Location: livros_inserir.php?sucesso=1");
			exit;
		}
		/*else
		{
			header("Location: livros_inserir.php?erro=1");
			exit;
		}*/
	}
?>