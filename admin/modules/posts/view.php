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
		$month = date('m');
		$year = date('y');
		$condition = mysqli_query($conn,"SELECT * FROM count_views WHERE month = $month AND post_id = $id AND year = $year");
		if (mysqli_num_rows($condition) == 1) {
			mysqli_query($conn, "UPDATE count_views SET view_per_month = view_per_month+1 WHERE post_id = $id AND month = $month AND year = $year");
		}else{
			mysqli_query($conn,"INSERT INTO count_views(post_id,month,year) VALUES ($id,$month,$year)");
			mysqli_query($conn, "UPDATE count_views SET view_per_month = view_per_month+1 WHERE post_id = $id AND month = $month AND year = $year");
		}
		$total = 0;
		$post_views = mysqli_query($conn,"SELECT view_per_month FROM count_views WHERE post_id = $id AND month = $month AND year = $year");
		foreach ($post_views as $view) {
			$per_month = $view['view_per_month'];
			$total += $per_month;
		}
		mysqli_query($conn,"UPDATE count_views SET total_views=$total WHERE post_id = $id");
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
<?php 
	foreach ($users as $user) {
        $total_view = 0;
        $user_id = $user['id'];
        $posts = mysqli_query($conn,"SELECT id FROM posts WHERE user_id = $user_id");
        foreach ($posts as $post) {
            $post_id = $post['id'];
            $totals = mysqli_query($conn,"SELECT total_views FROM count_views WHERE post_id = $post_id");
            $total = mysqli_fetch_assoc($totals);
            $total_view += $total['total_views'];
        }
        mysqli_query($conn,"UPDATE users SET total_view = $total_view WHERE id = $user_id");
    }
 ?>