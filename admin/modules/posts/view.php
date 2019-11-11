<?php 
	$id = !empty($_GET['id']) ? $_GET['id'] : 0;
	$query = mysqli_query($conn, "SELECT * FROM posts WHERE id = $id");
	$post = mysqli_fetch_assoc($query);
	$tags = mysqli_query($conn,"SELECT tags.tag_id,tags.tag_name as 'tag_name' FROM posts_tags pt JOIN tags ON pt.tag_id = tags.tag_id WHERE pt.post_id = $id");
	$user_id = $post['user_id'];
// viewcount
	$session_name ='post_'.$id;
	if (!isset($_SESSION[$session_name])) {
		$_SESSION[$session_name] = null;
	}
	$check_view = $_SESSION[$session_name];
	if (!$check_view) {
		$_SESSION[$session_name] = 1;
		$qr = "UPDATE posts SET viewcount=viewcount+1 WHERE id = $id";
		mysqli_query($conn,$qr);
		mysqli_query($conn, "UPDATE posts SET month_view = month_view+1 WHERE id = $id");
	}
 ?>
<h2 class="text-center" style="color:darkcyan"><?= $post['post_title']; ?></h2>

<div class="container">
	<p><small>Posted in <b><?= $post['created_at'] ?></b>.</small><?php if(!empty($post['updated_at'])) : ?>
	<small>Updated at <b><?= $post['updated_at'] ?></b></small>
	<?php endif; ?>
	 </p>
	<p class="lead">
	  <?= $post['content']; ?>
	</p>
	<div>Tags: <?php foreach ($tags as $tag) : ?>
		<a href="index.php?m=tags&a=view&id=<?php echo $tag['tag_id']; ?>"><?= $tag['tag_name'] ?></a>, 
<?php endforeach; ?>
                                             	
    </div>
    <?php if($login['id'] == $user_id || $login['level'] == 1) : ?>
	<a href="index.php?m=posts&a=edit&id=<?php echo $post['id']; ?>" class="btn btn-primary">Edit</a>
    <a href="index.php?m=posts&a=delete&id=<?php echo $post['id']; ?>" class="btn btn-danger" onclick="return confirm('Delete?')" >Delete</a></td>
<?php endif; ?>
</div>