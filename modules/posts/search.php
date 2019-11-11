<?php 
	if (isset($_REQUEST['ok'])) {
		$search = addslashes($_POST['search']);
		if (empty($search)) {
			echo "Text somethings plz...!!";
		}else{
			$tags_query = mysqli_query($conn,"SELECT * FROM tags WHERE tag_name LIKE '%$search%'");
			$num_tags = mysqli_num_rows($tags_query);
			$cats_query = mysqli_query($conn,"SELECT * FROM categories WHERE category_name LIKE '%$search%'");
			$num_cats = mysqli_num_rows($cats_query);
			$users_query = mysqli_query($conn,"SELECT * FROM tags WHERE tag_name LIKE '%$search%'");
			$num_tags = mysqli_num_rows($tags_query);
			if ($num_tags > 0 && $search != "") {
				echo "$num_tags tags return with <b>$search</b>";
			}elseif ($num_cats > 0 && $search != "" ) {
				echo "$num_cats return with <b>$search</b>";
				return $cats_query;
				print_r($cats_query);
			}else{
				echo "No result..!!";
			}
		}
	}
 ?>

<div class="container">

    <table class="table table-inverse">
        <thead>
            <tr>
                <th>Post name</th>
                <th>Content</th>
                <th>Category</th>
                <th>Tags</th>
            </tr>
        </thead>
        <tbody>

<?php if ($num_tags > 0 && $search != "") : ?>
<?php foreach ($tags_query as $tag) : ?>
	<?php 
		$tag_id = $tag['tag_id'];
		$posts = mysqli_query($conn,"SELECT posts.id,posts.post_title as post_title FROM posts_tags pt JOIN posts ON pt.post_id = posts.id WHERE pt.tag_id = $tag_id");
	?>
	<?php foreach($posts as $post): ?>
	<tr>
		<td><a href="index.php?m=posts&a=view&id=<?= $post['id']; ?>"><?= $post['post_title']; ?></a></td>
	</tr>
<?php endforeach; ?>
<?php endforeach; ?>	

<?php elseif($num_cats > 0 && $search != "") : ?>


<?php else : ?>	


<?php endif; ?>	

 </tbody>
            </table>
            <a href="index.php?m=posts&a=create" class="btn btn-primary">Create</a>
            
</div>