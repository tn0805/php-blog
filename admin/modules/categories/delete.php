<?php 
	$id = !empty($_GET['id']) ? $_GET['id'] : 0;
	$query = "DELETE FROM categories WHERE id = $id";
	mysqli_query($conn,$query);
	header('location: index.php?m=categories');
 ?>