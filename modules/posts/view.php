<?php 
	$id = !empty($_GET['id']) ? $_GET['id'] : 0;
	$query = mysqli_query($conn, "SELECT * FROM posts WHERE id = $id");
	$post = mysqli_fetch_assoc($query);
?>

<h2 class="text-center" style="color:darkcyan"><?= $post['post_title']; ?></h2>

<div class="container">
	<p class="lead">
	  <?= $post['content']; ?>
	</p>
	<a href="index.php?m=posts&a=edit&id=<?php echo $post['id']; ?>" class="btn btn-primary">Edit</a>
    <a href="index.php?m=posts&a=delete&id=<?php echo $post['id']; ?>" class="btn btn-danger" onclick="return confirm('Delete?')" >Delete</a></td>
</div>