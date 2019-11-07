<?php 
    $id = !empty($_GET['id']) ? $_GET['id'] : 0;
    if (!empty($_POST['category_name'])&& isset($_POST['status'])) {
        $category_name = $_POST['category_name'];
        $status = $_POST['status'];
        $sql = "UPDATE categories SET category_name='$category_name',status='$status' WHERE id=$id ";
        if (mysqli_query($conn,$sql)) {
            header('location: index.php?m=categories');
        }else {
            echo "Category is Not Null";
        }
    }
?>

<?php 
    $query = mysqli_query($conn,"SELECT * FROM categories WHERE id=$id");
    $category = mysqli_fetch_assoc($query);
 ?>
    <h2 class="text-center" style="color:darkcyan">Edit category</h2>
    <div class="container">
        <form method="POST">
            <div class="form-group">
                <label for="exampleInputCategory1">Category name</label>
                <input type="text" class="form-control" id="exampleInputCategory1" name="category_name" placeholder="<?php echo $category['category_name']; ?>" value="<?php echo $category['category_name']; ?>">
            </div>
            <div class="form-group">
                <select name="status" class="form-control">
                    <option value="1">Show</option>
                    <option value="0">Hide</option>
                    option
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Edit</button>
        </form>
    </div>
