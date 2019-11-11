<?php 
    $id = !empty($_GET['id']) ? $_GET['id'] : 0;
    if (!empty($_POST['tag_name'])) {
        $tag_name = $_POST['tag_name'];
        $sql = "UPDATE tags SET tag_name='$tag_name' WHERE tag_id=$id ";
        if (!empty($_POST['post_id'])) {
            $post_ids = $_POST['post_id'];
            foreach ($post_ids as $post_id) {
                $post = mysqli_query($conn,"INSERT INTO posts_tags(post_id,tag_id) VALUES ('$post_id','$id')");
            }
        }
        if (mysqli_query($conn,$sql)) {
            header('location: index.php?m=tags');
        }else {
            echo "Category is Not Null";
        }
    }
?>
<?php 
    $query = mysqli_query($conn,"SELECT * FROM tags WHERE tag_id = $id");
    $tag = mysqli_fetch_assoc($query);
 ?>
    <h2 class="text-center" style="color:darkcyan">Edit Tags</h2>
    <div class="container">
        <form method="POST">
            <div class="form-group">
                <label for="exampleInputTag1">Tag name</label>
                <input type="text" class="form-control" id="exampleInputTag1" name="tag_name" placeholder="<?= $tag['tag_name'] ?>" value="<?= $tag['tag_name'] ?>">
            </div>
            <div class="form-group">
                <label class="col-sm-2">Posts</label>
                <div class="col-sm-10">
                <?php foreach ($posts as $post) : ?>
                    <div class="radio">
                        <label>
                            <input type="checkbox" name="post_id[]" id="gridRadios1" value="<?= $post['id'] ?>">
                            <?= $post['post_title'] ?>
                        </label>
                    </div>
                <?php endforeach; ?>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
            <a href="index.php?m=tags" class="btn btn-danger" onclick="return confirm('Cancel?')">Cancel</a>
        </form>
    </div>