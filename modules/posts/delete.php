<?php 
	$id = !empty($_GET['id']) ? $_GET['id'] : 0;
	$query = "DELETE FROM posts WHERE id = $id";
	mysqli_query($conn,$query);
	header('location: index.php?m=posts');
 ?>