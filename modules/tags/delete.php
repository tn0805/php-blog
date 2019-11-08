<?php 
	$id = !empty($_GET['id']) ? $_GET['id'] : 0;
	mysqli_query($conn,"DELETE FROM posts_tags WHERE tag_id = $id");
	$query = "DELETE FROM tags WHERE tag_id = $id";
	mysqli_query($conn,$query);
	header('location: index.php?m=tags');
 ?>