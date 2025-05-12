<?php
	include_once("include/head.html");
	include_once("include/head_normal.html");
?>

		<h1>Register</h1>
		<div class="profile_edit">
			<form action="registar_aux.php" method="post" name="register" enctype="multipart/form-data">
				<div class="upload-container">
					<!-- Avatar -->
					<div class="avatar">
						<img id="avatar" width="200px" height="200px" style="border-radius: 100%;" src="imgs/avatar.png">
					</div>
					<!-- Botão de upload -->
					<label for="foto" class="upload-button">
						<span class="icon">+</span> new picture
					</label>
					<input type="file" id="foto" name="foto" value="" accept="image/*">
				</div>

				<div class ="form-container">
					<label for="nome">First Name</label>
					<input type="text" id="nome" name="nome" value="" required>

					<label for="apelido">Last Name</label>
					<input type="text" id="apelido" name="apelido" value="" required>

					<label for="username">Username</label>
					<input type="text" id="username" name="username" value="" required>

					<label for="email">Email</label>
					<input type="email" id="email" name="email" value="" required>

					<label for="password">Password</label>
					<input type="password" id="password" name="password" value="" required>
				
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
				echo "<br><span>Erro ao registar utilizador</span>";
			}
			
			if (isset($_GET['sucesso']))	
			{
		?>
		
		<script>
			alert("Utilizador registado com sucesso!!!");
		</script>
		
		<?php
			}

			include_once("include/footer.php");
		?>