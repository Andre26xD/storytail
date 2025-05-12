<?php
	include_once("../include/connect.php");
	include_once("include/head.html");
	include_once("include/header.php");

	$query = "SELECT activities.title AS activity_title, activities.description, activity_images.image_url, books.title AS book_title, activities.id_activity FROM activities, activity_images, activity_book, books WHERE activities.id_activity = activity_images.id_activity AND activities.id_activity = activity_book.id_activity AND activity_book.id_book = books.id_book";
	$result = mysqli_query($link, $query);
?>
	<h1>ACtivities</h1>
	<a href="atividades_inserir.php" style="width:5%; margin-left: 992px;"><img src="../imgs/icons/insert.png"><b>Insert</b></a>
	<table class="tabela" cellspacing="0">
		<tr>
			<th><b>Title</b></th>
			<th><b>Description</b></th>
			<th><b>Book</b></th>
			<th><b>Edit</b></th>
			<th><b>Delete</b></th>
		</tr>
	
	<?php
		while($row = mysqli_fetch_assoc($result)) {
	?>
	
		<tr>
			<td><?php echo $row['activity_title']; ?></td>
			<td><?php echo $row['description']; ?></td>
			<td><?php echo $row['book_title']; ?></td>
			<td><a href="atividades_editar.php?id_activity=<?php echo $row['id_activity'] ; ?>"><img src="../imgs/icons/edit.png"><b>Edit</b></a></td>
			<td><a href="atividades_eliminar.php?id_activity=<?php echo $row['id_activity'] ; ?>"><img src="../imgs/icons/delete.png"><b>Delete</b></a></td>
		</tr>
		
		<?php
			}
		?>

		</table>

		<?php
			include_once("../include/footer.php");
		?>