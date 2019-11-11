<?php 
    if (isset($_POST['post_title'])&& isset($_POST['content']) && isset($_POST['category_id'])) {
        $post_title = $_POST['post_title'];
        $content = $_POST['content'];
        $category_id = $_POST['category_id'];
        $user_id = $_POST['user_id'];
        $sql = "INSERT INTO posts(post_title,content,category_id,user_id) VALUES ('$post_title','$content','$category_id',$user_id)";
        if (mysqli_query($conn,$sql)) {
            header('location: index.php?m=posts');
        }else {
            echo "Missed somethings";
        }
    }
?>


    <h2 class="text-center" style="color:darkcyan">Create post</h2>
    <div class="container">
        <form method="POST">
            <div class="form-group">
                <label for="exampleInputPost1">Post title</label>
                <input type="text" class="form-control" id="exampleInputPost1" name="post_title" placeholder="Post title">
            </div>
            <div class="form-group">
              <label for="comment">Content:</label>
              <textarea class="form-control" rows="5" id="comment" name="content">
                  
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
                <input type="hidden" name="user_id" value="<?php echo $login['id']; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
