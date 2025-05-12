<?php
	include_once("include/head.html");
?>

	<h1>Login</h1>
	<div class="login-container">
		<form class="login-form" method="post" action="validar.php">
			<label for="username">Username</label>
			<input type="text" id="username" name="username" required>

			<label for="password">Password</label>
			<input type="password" id="password" name="password" required>

			<div class="register-link">
				<a href="#">Register here</a>
			</div>

			<input type="submit" id="submit" name="submit" class="submit-btn" value="Submit">
			<?php
				if (isset($_GET['erro']))
				{
					echo "<br><br><span style='color: red;'>Incorret username or password</span>";
				}
			?>
		</form>
	</div>

	<?php
		include_once("../include/footer.php");
	?>