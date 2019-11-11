<?php 
	$posts = mysqli_query($conn,"SELECT * FROM posts ORDER BY month_view DESC")


 ?>




<h2 class="text-center" style="color:darkcyan">Top Views Month</h2>


<div class="container">

            <table class="table table-inverse">
                <thead>
                    <tr>
                        <th>Post name</th>
                        <th>Content</th>
                        <th>Category</th>
                        <th>Post by</th>
                        <th>Tags</th>
                        <th>Month View</th>
                        <th>Total view</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($posts as $post) : ?>
                        <?php 
                            $category_id = $post['category_id'];
                            $query = mysqli_query($conn,"SELECT * FROM categories WHERE id = $category_id ");
                            $category = mysqli_fetch_assoc($query);
                            $post_id = $post['id'];
                            $tags = mysqli_query($conn,"SELECT tags.tag_id,tags.tag_name as 'tag_name' FROM posts_tags pt JOIN tags ON pt.tag_id = tags.tag_id WHERE pt.post_id = $post_id");
                            $user_id = $post['user_id'];
                            $qr = mysqli_query($conn,"SELECT * FROM users WHERE id=$user_id");
                            $user = mysqli_fetch_assoc($qr);
                         ?>
                    <?php if($category['status'] == 1) : ?>
                        <tr>
                            <td>
                                <a href="index.php?m=posts&a=view&id=<?php echo $post['id']; ?>"><?php echo $post['post_title']; ?></a>
                            </td>
                            <td>
                                <?php echo $post['content'] ?>
                            </td>
                            <td>
                                <?php echo $category['category_name'] ?>
                            </td>
                            <td>
                                <?php echo $user['username']; ?>
                            </td>
                            <td>
                                <?php foreach ($tags as $tag) : ?>
                                <a href="index.php?m=tags&a=view&id=<?php echo $tag['tag_id']; ?>"><?= $tag['tag_name'] ?></a> | 
                                <?php endforeach; ?>
                            </td>
                            <td><?= $post['month_view'] ?></td>
                            <td><?= $post['viewcount'] ?></td>
                            <td>
                            	<?php if($login['id'] == $user_id || $login['level'] == 1) : ?>
                                <a href="index.php?m=posts&a=edit&id=<?php echo $post['id']; ?>" class="btn btn-primary">Edit</a>
                                <a href="index.php?m=posts&a=delete&id=<?php echo $post['id']; ?>" class="btn btn-danger" onclick="return confirm('Delete?')" >Delete</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <a href="index.php?m=posts&a=create" class="btn btn-primary">Create</a>
            
</div>