<?php  
    if (isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $level = $_POST['level'];
        $sql = "INSERT INTO users(email,username,password,level) VALUES ('$email','$username','$password',$level)";
        if (mysqli_query($conn,$sql)) {
            header('location: index.php?m=users');
        }else {
            echo "Somethings went wrong";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <h2 class="text-center" style="color:darkcyan">Create user account</h2>
    <div class="container">
        <form method="POST">
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputUsername1">Username</label>
                <input type="text" class="form-control" id="exampleInputUsername1" name="username" placeholder="Username">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password">
            </div>
            <div class="form-group">
                <select name="level" class="form-control">
                    <option value="1">Admin</option>
                    <option value="0" selected>User</option>
                    option
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
</body>

</html>