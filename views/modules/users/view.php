<?php 
	$id = !empty($_GET['id']) ? $_GET['id'] : 0;
	$posts = mysqli_query($conn,"SELECT *  FROM posts WHERE user_id = $id");
	$users = mysqli_query($conn,"SELECT * FROM users WHERE id = $id");
	$user = mysqli_fetch_assoc($users);
 ?>

<h2 class="text-center" style="color:darkcyan"><?= $user['username'] ?></h2>

		<div class="container">
			<ul class="list-group">
				<?php foreach($posts as $post) : ?>
					<li class="list-group-item"><a href="index.php?m=posts&a=view&id=<?php echo $post['id']; ?>"><?= $post['post_title'] ?></a></li>
				<?php endforeach; ?>
			</ul>
		</div>