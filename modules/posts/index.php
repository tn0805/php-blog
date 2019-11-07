

            <div class="container">
                <?php 
                    $posts = mysqli_query($conn,"SELECT * FROM posts");

                 ?>
                        <table class="table table-inverse">
                            <thead>
                                <tr>
                                    <th>Post name</th>
                                    <th>Content</th>
                                    <th>Category</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($posts as $post) : ?>
                                    <?php 
                                        $category_id = $post['category_id'];
                                        $query = mysqli_query($conn,"SELECT * FROM categories WHERE id = $category_id ");
                                        $category = mysqli_fetch_assoc($query);
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
                                            <a href="index.php?m=posts&a=edit&id=<?php echo $post['id']; ?>" class="btn btn-primary">Edit</a>
                                            <a href="index.php?m=posts&a=delete&id=<?php echo $post['id']; ?>" class="btn btn-danger" onclick="return confirm('Delete?')" >Delete</a>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <a href="index.php?m=posts&a=create" class="btn btn-primary fixed">Create</a>
                        
            </div>
