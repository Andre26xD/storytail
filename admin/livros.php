<?php
	include_once("../include/connect.php");
	include_once("include/head.html");
	include_once("include/header.php");

	$query = "SELECT books.*, age_group, authors.* FROM books, age_groups, author_book, authors WHERE books.id_age_group = age_groups.id_age_group AND author_book.id_book = books.id_book AND author_book.id_author = authors.id_author";
	$result = mysqli_query($link, $query);
?>
	<h1>BOOKS</h1>
	<a href="livros_inserir.php" style="width:5%; margin-left: 992px;"><img src="../imgs/icons/insert.png"><b>Insert</b></a>
	<table class="tabela" cellspacing="0">
		<tr>
			<th><b>Title</b></th>
			<th><b>Description</b></th>
			<th><b>Author</b></th>
			<th><b>Read Time</b></th>
			<th><b>Age Group</b></th>
			<th><b>Active</b></th>
			<th><b>Access Level</b></th>
			<th><b>Edit</b></th>
			<th><b>Delete</b></th>
		</tr>
	
		<?php
			while($row = mysqli_fetch_assoc($result)) {
		?>

		<tr>
			<td><?php echo $row['title']; ?></td>
			<td><?php echo $row['description']; ?></td>
			<td><?php echo $row['first_name']; ?> <?php echo $row['last_name']; ?></td>
			<td><?php echo $row['read_time']; ?> minutos</td>
			<td><?php echo $row['age_group']; ?> years</td>
			<td><?php echo $row['is_active']; ?></td>
			<td><?php echo $row['access_level']; ?></td>
			<td><a href="livros_editar.php?id_book=<?php echo $row['id_book']; ?>"><img src="../imgs/icons/edit.png"><b>Edit</b></a></td>
			<td><a href="livros_eliminar.php?id_book=<?php echo $row['id_book']; ?>"><img src="../imgs/icons/delete.png"><b>Delete</b></a></td>
		</tr>
	
		<?php
			}
		?>

		</table>

		<?php
			include_once("../include/footer.php");
		?>