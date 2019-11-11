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
			$users_query = mysqli_query($conn,"SELECT * FROM users WHERE username LIKE '%$search%'");
			$num_users = mysqli_num_rows($users_query);
		}
	}
 ?>

<form action="index.php?m=posts&a=search" method="POST">
    Search: <input type="text" name="search" />
                <input type="submit" name="ok" value="Search" />
</form>
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

	<?php echo "$num_tags tags/tag return with <b>$search</b>: "; ?>
	<?php foreach ($tags_query as $tag) : ?>
		<?php 
			echo "<i>".$tag['tag_name']." </i>";
			$tag_id = $tag['tag_id'];
			$posts = mysqli_query($conn,"SELECT posts.* FROM posts_tags pt JOIN posts ON pt.post_id = posts.id WHERE pt.tag_id = $tag_id");
		?>
		<?php foreach($posts as $post): ?>
			<?php 
	            $category_id = $post['category_id'];
	            $query = mysqli_query($conn,"SELECT * FROM categories WHERE id = $category_id ");
	            $category = mysqli_fetch_assoc($query);
	            $post_id = $post['id'];
	            $tags = mysqli_query($conn,"SELECT tags.tag_id,tags.tag_name as 'tag_name' FROM posts_tags pt JOIN tags ON pt.tag_id = tags.tag_id WHERE pt.post_id = $post_id");
	            $user_id = $post['user_id'];
	         ?>
			<tr>
				<td><a href="index.php?m=posts&a=view&id=<?= $post['id']; ?>"><?= $post['post_title']; ?></a></td>
				<td>
		            <?php echo $post['content'] ?>
		        </td>
		        <td>
		            <?php echo $category['category_name'] ?>
		        </td>
		        <td>
		            <?php foreach ($tags as $tag) : ?>
		            <a href="index.php?m=tags&a=view&id=<?php echo $tag['tag_id']; ?>"><?= $tag['tag_name'] ?></a> | 
		            <?php endforeach; ?>
		        </td>
		        <td>
		        	<?php if($login['id'] == $user_id || $login['level'] == 1) : ?>
                    <a href="index.php?m=posts&a=edit&id=<?php echo $post['id']; ?>" class="btn btn-primary">Edit</a>
                    <a href="index.php?m=posts&a=delete&id=<?php echo $post['id']; ?>" class="btn btn-danger" onclick="return confirm('Delete?')" >Delete</a>
                <?php endif; ?>
                </td>
			</tr>
		<?php endforeach; ?>
	<?php endforeach; ?>	
<?php endif; ?>
<?php if($num_cats > 0 && $search != "") : ?>
	<?php echo "\n $num_cats categories/category return with <b>$search</b>: ";  ?>
	<?php foreach($cats_query as $cat) : ?>
		<?php 
			echo "<i>".$cat['category_name']." </i>";
			$cat_id = $cat['id'];
			$posts = mysqli_query($conn,"SELECT * FROM posts WHERE category_id = $cat_id");
		 ?>
		 <?php foreach($posts as $post): ?>
			<?php 
	            $post_id = $post['id'];
	            $tags = mysqli_query($conn,"SELECT tags.tag_id,tags.tag_name as 'tag_name' FROM posts_tags pt JOIN tags ON pt.tag_id = tags.tag_id WHERE pt.post_id = $post_id");
	            $user_id = $post['user_id'];
	         ?>
			<tr>
				<td><a href="index.php?m=posts&a=view&id=<?= $post['id']; ?>"><?= $post['post_title']; ?></a></td>
				<td>
		            <?php echo $post['content'] ?>
		        </td>
		        <td>
		            <?php echo $cat['category_name'] ?>
		        </td>
		        <td>
		            <?php foreach ($tags as $tag) : ?>
		            <a href="index.php?m=tags&a=view&id=<?php echo $tag['tag_id']; ?>"><?= $tag['tag_name'] ?></a> | 
		            <?php endforeach; ?>
		        </td>
		        <td>
		        	<?php if($login['id'] == $user_id || $login['level'] == 1) : ?>
                    <a href="index.php?m=posts&a=edit&id=<?php echo $post['id']; ?>" class="btn btn-primary">Edit</a>
                    <a href="index.php?m=posts&a=delete&id=<?php echo $post['id']; ?>" class="btn btn-danger" onclick="return confirm('Delete?')" >Delete</a>
                <?php endif; ?>
                </td>
			</tr>
		<?php endforeach; ?>
	<?php endforeach; ?>
<?php endif; ?>
<?php if($login['level']==1) : ?>
<?php if($num_users > 0 && $search != "") : ?>	
	<?php echo "$num_users users/user return with <b>$search</b>: "; ?>
	<?php foreach($users_query as $user) : ?>
		<?php 
			echo "<i>".$user['username']." </i>";
			$user_id = $user['id'];
			$posts = mysqli_query($conn,"SELECT * FROM posts WHERE user_id = $user_id");
		 ?>
		 <?php foreach($posts as $post): ?>
			<?php 
	            $category_id = $post['category_id'];
	            $query = mysqli_query($conn,"SELECT * FROM categories WHERE id = $category_id ");
	            $category = mysqli_fetch_assoc($query);
	            $post_id = $post['id'];
	            $tags = mysqli_query($conn,"SELECT tags.tag_id,tags.tag_name as 'tag_name' FROM posts_tags pt JOIN tags ON pt.tag_id = tags.tag_id WHERE pt.post_id = $post_id");
	         ?>
			<tr>
				<td><a href="index.php?m=posts&a=view&id=<?= $post['id']; ?>"><?= $post['post_title']; ?></a></td>
				<td>
		            <?php echo $post['content'] ?>
		        </td>
		        <td>
		            <?php echo $category['category_name'] ?>
		        </td>
		        <td>
		            <?php foreach ($tags as $tag) : ?>
		            <a href="index.php?m=tags&a=view&id=<?php echo $tag['tag_id']; ?>"><?= $tag['tag_name'] ?></a> | 
		            <?php endforeach; ?>
		        </td>
		        <td>
                    <a href="index.php?m=posts&a=edit&id=<?php echo $post['id']; ?>" class="btn btn-primary">Edit</a>
                    <a href="index.php?m=posts&a=delete&id=<?php echo $post['id']; ?>" class="btn btn-danger" onclick="return confirm('Delete?')" >Delete</a>
                </td>
			</tr>
		<?php endforeach; ?>
	<?php endforeach; ?>
<?php endif; ?>
<?php else : ?>
	<h5>No result...!!!</h5>


<?php endif; ?>	

 </tbody>
            </table>
            <a href="index.php?m=posts&a=create" class="btn btn-primary">Create</a>
            
</div>