<?php
	include_once("../include/connect.php");
	include_once("include/head.html");
	include_once("include/header.php");
	
	if (isset($_GET['id_user']))
	{
		$id_user = $_GET['id_user'];		
	
		$query = "SELECT * FROM users WHERE id_user = '$id_user'";
		$result = mysqli_query($link, $query);
		$row = mysqli_fetch_assoc($result);
	}
?>

		<h1>Edit User</h1>
		<div class="profile_edit">
			<form action="users_editar_aux.php?<?php echo "id_user=" . $_GET['id_user']; ?>" method="post" name="users_editar" enctype="multipart/form-data">
				<div class="upload-container">
					<!-- Avatar -->
					<div class="avatar">
						<img id="avatar" width="200px" height="200px" style="border-radius: 100%;" src="../upload/users/<?php echo $row['user_photo_url']; ?>">
					</div>
					<!-- Botão de upload -->
					<label for="foto" class="upload-button">
						<span class="icon">+</span> new picture
					</label>
					<input type="file" id="foto" name="foto" value="" accept="image/*">
				</div>
				<div class ="form-container">
					<label for="tipo">User Type</label>
					<select id="tipo" name="tipo" required>
						<option value="">User Type</option>
						<option value="5" <?php if ($row['id_user_type'] == 5) echo "selected"; ?>>Admin</option>
						<option value="6" <?php if ($row['id_user_type'] == 6) echo "selected"; ?>>Normal</option>
						<option value="7" <?php if ($row['id_user_type'] == 7) echo "selected"; ?>>Premium</option>
					</select>
					
					<label for="nome">First Name</label>
					<input type="text" id="nome" name="nome" value="<?php echo $row['first_name']; ?>" required>

					<label for="apelido">Last Name</label>
					<input type="text" id="apelido" name="apelido" value="<?php echo $row['last_name']; ?>" required>

					<label for="username">Username</label>
					<input type="text" id="username" name="username" value="<?php echo $row['user_name']; ?>" required>

					<label for="email">Email</label>
					<input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" required>

					<label for="password">Password</label>
					<input type="password" id="password" name="password" value="<?php echo $row['password']; ?>" required>

					<input type="submit" id="submit" name="submit" class="submit-btn" value="Submit">
				</div>
			</form>
		</div>

		<script>
			// Referência ao input de upload e ao avatar
			const foto = document.getElementById('foto');
			const avatar = document.getElementById('avatar');

			// Adiciona um listener para detectar mudanças no campo de upload
			foto.addEventListener('change', function(event) {
			const file = event.target.files[0]; // Obtém o arquivo selecionado

			if (file) {
				const reader = new FileReader(); // Cria um leitor de arquivos

				// Quando a leitura estiver concluída, altera a imagem do avatar
				reader.onload = function(e) {
					avatar.src = e.target.result; // Define o URL da imagem no avatar
				};

				reader.readAsDataURL(file); // Lê o arquivo como uma URL base64
			}
			});
		</script>
	
		<?php
			if (isset($_GET['erro']))
			{
				echo "<br><span>Erro ao editar utilizador</span>";
			}
			
			if (isset($_GET['sucesso']))	
			{
		?>
		
		<script>
			alert("Utilizador editado com sucesso!!!");
		</script>
		
		<?php
			}

			include_once("../include/footer.php");
		?>