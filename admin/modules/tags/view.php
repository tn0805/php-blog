<?php 
	$id = !empty($_GET['id']) ? $_GET['id'] : 0;
	$posts = mysqli_query($conn,"SELECT posts.id,posts.post_title as post_title FROM posts_tags pt JOIN posts ON pt.post_id = posts.id WHERE pt.tag_id = $id");
 ?>



		<div class="container">
			<ul class="list-group">
				<?php foreach($posts as $post) : ?>
					<li class="list-group-item"><a href="index.php?m=posts&a=view&id=<?php echo $post['id']; ?>"><?= $post['post_title'] ?></a></li>
				<?php endforeach; ?>
			</ul>
		</div>