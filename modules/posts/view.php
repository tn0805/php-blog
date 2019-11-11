<?php 
	$id = !empty($_GET['id']) ? $_GET['id'] : 0;
	$query = mysqli_query($conn, "SELECT * FROM posts WHERE id = $id");
	$post = mysqli_fetch_assoc($query);


     $tags = mysqli_query($conn,"SELECT tags.tag_id,tags.tag_name as 'tag_name' FROM posts_tags pt JOIN tags ON pt.tag_id = tags.tag_id WHERE pt.post_id = $id");
 ?>
<h2 class="text-center" style="color:darkcyan"><?= $post['post_title']; ?></h2>

<div class="container">
	<p class="lead">
	  <?= $post['content']; ?>
	</p>
	<div>Tags: <?php foreach ($tags as $tag) : ?>
		<a href="index.php?m=tags&a=view&id=<?php echo $tag['tag_id']; ?>"><?= $tag['tag_name'] ?></a>, 
<?php endforeach; ?>
                                             	
    </div>
	<a href="index.php?m=posts&a=edit&id=<?php echo $post['id']; ?>" class="btn btn-primary">Edit</a>
    <a href="index.php?m=posts&a=delete&id=<?php echo $post['id']; ?>" class="btn btn-danger" onclick="return confirm('Delete?')" >Delete</a></td>
</div>