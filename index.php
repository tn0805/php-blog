<?php 
    include 'config/connect.php';
    session_start();
    if (!isset($_SESSION['login'])) {
        header('location: login.php');
    }
    $login = $_SESSION['login'];
 ?>
<?php 
                    $categories = mysqli_query($conn,"SELECT * FROM categories");
                    $posts = mysqli_query($conn,"SELECT * FROM posts");
                    $tags = mysqli_query($conn,"SELECT * FROM tags");
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Page title</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <ul class="navbar-nav">
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php?m=categories">Category</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php?m=posts">Post</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php?m=tags">Tags</a>
            </li>
        </ul>
        <ul class="navbar-nav navbar-expand ml-auto">
            <li class="nav-item"><a class="nav-link" href="index.php?m=users">Hi <?php echo $login['username']; ?></a></li>
            <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>     
        </ul>
    </nav>
    <div style="height: 60px"></div>

            <?php 
                $m = !empty($_GET['m']) ? $_GET['m'] : 'main';
                $a = !empty($_GET['a']) ? $_GET['a'] : 'index';
                $file = 'modules/'.$m.'/'.$a.'.php';
                if (file_exists($file)) {
                    include $file;
                }else{
                    echo "Module <b>$file</b> không tòn tại";
                }
            ?>
</body>

</html>