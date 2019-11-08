<?php 
    if (!empty($_POST['category_name'])&& isset($_POST['status'])) {
        $category_name = $_POST['category_name'];
        $status = $_POST['status'];
        $sql = "INSERT INTO categories(category_name,status) VALUES ('$category_name','$status')";
        if (mysqli_query($conn,$sql)) {
            header('location: index.php?m=categories');
        }else {
            echo "Category is Not Null";
        }
    }
?>


    <h2 class="text-center" style="color:darkcyan">Create category</h2>
    <div class="container">
        <form method="POST">
            <div class="form-group">
                <label for="exampleInputCategory1">Category name</label>
                <input type="text" class="form-control" id="exampleInputCategory1" name="category_name" placeholder="Category name">
            </div>
            <div class="form-group">
                <select name="status" class="form-control">
                    <option value="1">Show</option>
                    <option value="0">Hide</option>
                    option
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
