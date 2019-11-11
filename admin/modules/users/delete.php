<?php 
	$id = !empty($_GET['id']) ? $_GET['id'] : 0;
	mysqli_query($conn,"DELETE FROM users WHERE id = $id");
	header('location: index.php?m=users');
 ?>