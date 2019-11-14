<?php 
	$id = !empty($_GET['id']) ? $_GET['id'] : 0;
	$query = mysqli_query($conn, "SELECT * FROM posts WHERE id = $id");
	$post = mysqli_fetch_assoc($query);
	$tags = mysqli_query($conn,"SELECT tags.tag_id,tags.tag_name as 'tag_name' FROM posts_tags pt JOIN tags ON pt.tag_id = tags.tag_id WHERE pt.post_id = $id");
	$user_id = $post['user_id'];
// viewcount
	$session_name ='post_'.$id;
	if (!isset($_SESSION[$session_name])) {
		$_SESSION[$session_name] = 1;
		$view_time = date("Y-m-d H:i:s");
		mysqli_query($conn,"INSERT INTO views_count(post_id,view_time,ss_id) VALUES ($id,'$view_time','$ss_id')");
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
		<a href="index.php?m=tags&a=view&id=<?= $tag['tag_id']; ?>"><?= $tag['tag_name'] ?></a>, 
<?php endforeach; ?>
                                             	
    </div>
</div>
