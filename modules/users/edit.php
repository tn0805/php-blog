<?php  
    $id = $login['id'];
    $query = mysqli_query($conn,"SELECT * FROM users WHERE id = $id");
    $userInfo = mysqli_fetch_assoc($query);

    if (!empty($_POST['email']) && !empty($_POST['old_password']) && !empty($_POST['password'])) {
        $email = $_POST['email'];
        $old_password = md5($_POST['old_password']);
        $password = md5($_POST['password']);
        $sql = "UPDATE users SET email='$email',password='$password' WHERE id = $id AND password = '$old_password' ";
        if (mysqli_query($conn,$sql)) {
            header('location: logout.php');
        }else {
            echo "Somethings went wrong";
        }
    }
?>


    <h2 class="text-center" style="color:darkcyan">Edit your own account</h2>
    <div class="container">
        <form method="POST">
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" placeholder="<?= $userInfo['email'] ?>">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputUsername1">Username</label>
                <input type="text" class="form-control" id="exampleInputUsername1" name="username" placeholder="<?= $userInfo['username'] ?>" disabled>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword">Old Password</label>
                <input type="password" class="form-control" id="exampleInputPassword" name="old_password" placeholder="Old Password">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">New Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="New Password">
            </div>
            <button type="submit" class="btn btn-primary">Edit</button>
        </form>
    </div>

