<?php 
	$id = !empty($_GET['id']) ? $_GET['id'] : 0;
	mysqli_query($conn,"DELETE FROM posts_tags WHERE post_id = $id");
	$query = "DELETE FROM posts WHERE id = $id";
	mysqli_query($conn,$query);
	header('location: index.php?m=posts');
 ?>