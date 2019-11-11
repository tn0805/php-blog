<?php  
    $id = $login['id'];
    $query = mysqli_query($conn,"SELECT * FROM users WHERE id = $id");
    $adminInfo = mysqli_fetch_assoc($query);
    $userId = !empty($_GET['id']) ? $_GET['id'] : 0;
    $userQr = mysqli_query($conn,"SELECT * FROM users WHERE id = $userId");
    $userInfo = mysqli_fetch_assoc($userQr);
    if (!empty($_POST['username']) && !empty($_POST['admin_password']) && !empty($_POST['password'])) {
        $username = $_POST['username'];
        $admin_password = md5($_POST['admin_password']);
        $password = md5($_POST['password']);
        if ($admin_password == $adminInfo['password']) {
            $sql = "UPDATE users SET username='$username',password='$password' WHERE id = $userId ";
            if (mysqli_query($conn,$sql)) {
                header('location: index.php?m=users');
            }else {
                echo "Somethings went wrong";
            }
        }else{
            echo "Wrong password!!!";
        }
    }
?>


    <h2 class="text-center" style="color:darkcyan">Edit user account</h2>
    <div class="container">
        <form method="POST">
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" placeholder="<?= $userInfo['email'] ?>" disabled>
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputUsername1">Username</label>
                <input type="text" class="form-control" id="exampleInputUsername1" name="username" placeholder="<?= $userInfo['username'] ?>" >
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">New Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="New Password">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword">Admin Password</label>
                <input type="password" class="form-control" id="exampleInputPassword" name="admin_password" placeholder="Admin Password">
            </div>
            <button type="submit" class="btn btn-primary">Edit</button>
        </form>
    </div>

