<?php 
	$id = !empty($_GET['id']) ? $_GET['id'] : 0;
	$posts = mysqli_query($conn,"SELECT *  FROM posts WHERE category_id = $id");
	$cates = mysqli_query($conn,"SELECT * FROM categories WHERE id = $id");
	$cate = mysqli_fetch_assoc($cates);
 ?>

<h2 class="text-center" style="color:darkcyan"><?= $cate['category_name'] ?></h2>

		<div class="container">
			<ul class="list-group">
				<?php foreach($posts as $post) : ?>
					<li class="list-group-item"><a href="index.php?m=posts&a=view&id=<?php echo $post['id']; ?>"><?= $post['post_title'] ?></a></li>
				<?php endforeach; ?>
			</ul>
		</div>