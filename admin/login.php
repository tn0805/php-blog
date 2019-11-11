<?php 
include '../config/connect.php'; 
session_start();

    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password' ";
        $query = mysqli_query($conn,$sql);
        if (mysqli_num_rows($query) == 1 ) {
            $user = mysqli_fetch_assoc($query);
            $_SESSION['login'] = $user;
            header('location: index.php');
        }else{
            echo "Wrong email or password";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <h2 class="text-center" style="color:darkcyan">Login</h2>
    <div class="container">
        <form method="POST">
            <div class="form-group">
                <label for="exampleInputusername1">Username</label>
                <input type="text" class="form-control" id="exampleInputusername1" name="username" placeholder="Username">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</body>

</html>