<?php
	include_once("../include/connect.php");
	include_once("include/head.html");
	include_once("include/header.php");

	if (isset($_GET['id_activity']))
	{
		$id_activity = $_GET['id_activity'];		
		
		$query = "SELECT activities.title AS activity_title, activities.description, books.title AS book_title FROM activities, activity_images, activity_book, books WHERE activities.id_activity = activity_images.id_activity AND activities.id_activity = activity_book.id_activity AND activity_book.id_book = books.id_book AND activities.id_activity = '$id_activity'";
		$result = mysqli_query($link, $query);
		$row = mysqli_fetch_assoc($result);
	}
?>
	
	<h1>Edit Activity</h1>
		<div class="profile_edit">
			<form action="atividades_editar_aux.php?id_activity=<?php echo $_GET['id_activity']; ?>" method="post" name="atividades_inserir" enctype="multipart/form-data">
				<label for="titulo">Title</label>
				<input type="text" id="titulo" name="titulo" value="<?php echo $row['activity_title']; ?>" required>

				<label for="descricao">Description</label>
				<textarea id="descricao" name="descricao" rows="4" required><?php echo $row['description']; ?></textarea>
				
				<label for="livro">Book</label>
				<select id="livro" name="livro" required>
					<option value="">Book</option>
					<?php
						$query = "SELECT * FROM books";
						$result = mysqli_query($link, $query);
						
						while ($row2 = mysqli_fetch_assoc($result)) {
							if ($row['book_title'] == $row2['title'])
							{
								echo '<option value="' . $row2['id_book'] . '" selected>' . $row2['title'] . '</option>';
							}
							else
							{
								echo '<option value="' . $row2['id_book'] . '">' . $row2['title'] . '</option>';
							}
						}
					?>
				</select>
				
				<input type="submit" id="submit" name="submit" class="submit-btn" value="Edit">
			</form>
		</div>
		
		<?php
			if (isset($_GET['erro']))
			{
				echo "<br><span>Erro ao editar atividade</span>";
			}
			
			if (isset($_GET['sucesso']))	
			{
		?>
		
		<script>
			alert("Atividade editada com sucesso!!!");
		</script>
		
		<?php
			}

			include_once("../include/footer.php");
		?>