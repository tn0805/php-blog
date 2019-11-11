
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
                    <?php foreach ($posts as $post) : ?>
                        <?php 
                            $category_id = $post['category_id'];
                            $query = mysqli_query($conn,"SELECT * FROM categories WHERE id = $category_id ");
                            $category = mysqli_fetch_assoc($query);
                            $post_id = $post['id'];
                            $tags = mysqli_query($conn,"SELECT tags.tag_id,tags.tag_name as 'tag_name' FROM posts_tags pt JOIN tags ON pt.tag_id = tags.tag_id WHERE pt.post_id = $post_id");
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
                                <?php foreach ($tags as $tag) : ?>
                                <a href="index.php?m=tags&a=view&id=<?php echo $tag['tag_id']; ?>"><?= $tag['tag_name'] ?></a> | 
                                <?php endforeach; ?>
                            </td>
                            <td>
                                <a href="index.php?m=posts&a=edit&id=<?php echo $post['id']; ?>" class="btn btn-primary">Edit</a>
                                <a href="index.php?m=posts&a=delete&id=<?php echo $post['id']; ?>" class="btn btn-danger" onclick="return confirm('Delete?')" >Delete</a>
                            </td>
                        </tr>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <a href="index.php?m=posts&a=create" class="btn btn-primary">Create</a>
            
</div>
