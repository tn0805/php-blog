
<div class="row">
    <div class="col-md-2">
            <div class="col-md-12">
                <form action="index.php?m=posts&a=search" method="POST">
                        <div class="form-group">
                            Search: <input type="text" name="search" class="form-control" />
                        </div>
                        <button type="submit" class="btn btn-success" name="ok">Search</button>  
                </form>
            </div>
            <div class="col-md-12 float-right">
                <form action="index.php?m=posts&a=datesearch" method="POST">
                        <div class="form-group">                      
                        From:    <input type="date" class="form-control" name="from_date">
                        </div>
                        <div class="form-group">                       
                        To:    <input type="date" class="form-control" name="to_date">
                        </div>
                        <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
    </div>
    <div class="col-md-10">
    
                <table class="table table-inverse">
                    <thead>
                        <tr>
                            <th>Post name</th>
                            <th>Content</th>
                            <th>Category</th>
                            <th>Post by</th>
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
</div>



