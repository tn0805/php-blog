<?php 
    if (!empty($_POST['tag_name'])) {
        $tag_name = $_POST['tag_name'];
        $post_id = '';
        if (isset($_POST['post_id'])) {
            $post_id_arr = $_POST['post_id'];
            $post_id = implode(",", $post_id_arr);
        }
        $sql = "INSERT INTO tags(tag_name) VALUES ('$tag_name')";
        if (mysqli_query($conn,$sql)) {
            header('location: index.php?m=tags');
        }else {
            echo "tags is Not Null";
        }
    }
?>


    <h2 class="text-center" style="color:darkcyan">Create Tags</h2>
    <div class="container">
        <form method="POST">
            <div class="form-group">
                <label for="exampleInputTag1">Tag name</label>
                <input type="text" class="form-control" id="exampleInputTag1" name="tag_name" placeholder="Tag name">
            </div>
           
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>




