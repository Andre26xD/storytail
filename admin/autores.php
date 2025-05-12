<?php
	include_once("../include/connect.php");
	include_once("include/head.html");
	include_once("include/header.php");

	$query = "SELECT * FROM authors";
	$result = mysqli_query($link, $query);
?>
	<h1>AUTHORS</h1>
	<a href="autores_inserir.php" style="width:5%; margin-left: 992px;"><img src="../imgs/icons/insert.png"><b>Insert</b></a>
	<table class="tabela" cellspacing="0">
		<tr>
			<th><b>First Name</b></th>
			<th><b>Last Name</b></th>
			<th><b>Description</b></th>
			<th><b>Photo</b></th>
			<th><b>Nationality</b></th>
			<th><b>Edit</b></th>
			<th><b>Delete</b></th>
		</tr>
	
		<?php
			while($row = mysqli_fetch_assoc($result)) {
		?>
	
		<tr>
			<td><?php echo $row['first_name']; ?></td>
			<td><?php echo $row['last_name']; ?></td>
			<td><?php echo $row['description']; ?></td>
			<td><img width="200px" height="200px" style="border-radius: 100%;" src="../upload/autores/<?php echo $row['author_photo_url']; ?>"></td>
			<td><?php echo $row['nationality']; ?></td>
			<td><a href="autores_editar.php?id_author=<?php echo $row['id_author']; ?>"><img src="../imgs/icons/edit.png"><b>Edit</b></a></td>
			<td><a href="autores_eliminar.php?id_author=<?php echo $row['id_author']; ?>"><img src="../imgs/icons/delete.png"><b>Delete</b></a></td>
		</tr>
	
		<?php
			}
		?>

		</table>

		<?php
			include_once("../include/footer.php");
		?>