<?php
	$nome = $_POST["nome"];
	$apelido = $_POST["apelido"];
	$username = $_POST["username"];
	$email = $_POST["email"];
	$password = $_POST["password"];
	
	include_once("include/connect.php");
	
	if (isset ($_POST['submit']))
	{
		$id_user = $_GET['id_user'];
		
		$data_hora = date('Y-m-d H:i:s');
		$foto = basename($_FILES["foto"]["name"]);

		if ($foto != "")
		{
			$target_file = "upload/users/" . $foto;

			if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file))
			{			
				$query = "UPDATE users SET first_name='$nome', last_name='$apelido', user_name='$username', email='$email', password='$password', user_photo_url='$foto', updated_at='$data_hora' WHERE id_user='$id_user'";
				$result = mysqli_query($link, $query);
			}
		}
		else
		{
			$query = "UPDATE users SET first_name='$nome', last_name='$apelido', user_name='$username', email='$email', password='$password', updated_at='$data_hora' WHERE id_user='$id_user'";
			$result = mysqli_query($link, $query);
		}
		
		if ($result)
		{
			header("Location: perfil.php?sucesso=1&id_user=".$id_user);
			exit;
		}
	}
?>