<?php
	include_once("../include/connect.php");
	include_once("include/head.html");
	include_once("include/header.php");
?>

		<h1>Register</h1>
		<div class="profile_edit">
			<form action="users_inserir_aux.php" method="post" name="users_editar" enctype="multipart/form-data">
				<div class="upload-container">
					<!-- Avatar -->
					<div class="avatar">
						<img id="avatar" width="200px" height="200px" style="border-radius: 100%;" src="../imgs/avatar.png">
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
						<option value="" selected>User Type</option>
						<option value="5">Admin</option>
						<option value="6">Normal</option>
						<option value="7">Premium</option>
					</select>
					
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

			include_once("../include/footer.php");
		?>