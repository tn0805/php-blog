<?php 
$id = !empty($_GET['id']) ? $_GET['id'] : 0;
    if (isset($_POST['post_title'])&& isset($_POST['content']) && isset($_POST['category_id'])) {
        $post_title = $_POST['post_title'];
        $content = $_POST['content'];
        $category_id = $_POST['category_id'];
        $user_id = $_POST['user_id'];
        $sql = "UPDATE posts SET post_title = '$post_title', content = '$content', category_id = '$category_id',user_id = '$user_id' WHERE id = $id ";
        if (!empty($_POST['tag_id'])) {
            $tag_ids = $_POST['tag_id'];
            foreach ($tag_ids as $tag_id) {
                    $tags = mysqli_query($conn,"INSERT INTO posts_tags(post_id,tag_id) VALUES ('$id','$tag_id')");
            }
        }
        if (mysqli_query($conn,$sql)) {
            header('location: index.php?m=posts');
        }else {
            echo "Missed somethings";
        }
    }
?>

    <?php 
    $query = mysqli_query($conn, "SELECT * FROM posts WHERE id = $id");
    $post = mysqli_fetch_assoc($query);
     ?>
    <h2 class="text-center" style="color:darkcyan">Edit post</h2>
    <div class="container">
        <form method="POST">
            <div class="form-group">
                <label for="exampleInputPost1">Post title</label>
                <input type="text" class="form-control" id="exampleInputPost1" name="post_title" placeholder="<?php echo $post['post_title'] ?>" value="<?php echo $post['post_title'] ?>">
            </div>
            <div class="form-group">
              <label for="comment">Content:</label>
              <textarea class="form-control" rows="5" id="comment" name="content"><?= $post['content'] ?>   
             </textarea>
            </div>
            <div class="form-group">
                <select name="category_id" class="form-control">
                <?php foreach ($categories as $category) : ?>
                    <?php if($category['status'] == 1) : ?>
                        <option value="<?php echo $category['id'] ?>"><?php echo $category['category_name'] ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
                    Choose Category
                </select>
            </div>
            <div class="form-group">
                <label class="col-sm-2">Tags</label>
                <div class="col-sm-10">
                <?php foreach ($tags as $tag) : ?>
                    <div class="radio">
                        <label>
                            <input type="checkbox" name="tag_id[]" id="gridRadios1" value="<?= $tag['tag_id'] ?>">
                            <?= $tag['tag_name'] ?>
                        </label>
                    </div>
                <?php endforeach; ?>
                </div>
            </div>
            <div class="form-group">
                <input type="hidden" name="user_id" value="<?php echo $login['id']; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Edit</button>
            <a href="index.php?m=posts" class="btn btn-danger" onclick="return confirm('Cancel?')">Cancel</a>
        </form>
    </div>
