<?php 
    $from = date("Y-m-01");
    $to = date("Y-m-d");
    if (isset($_REQUEST['submit'])) {
        $from = !empty($_POST['from_date']) ? $_POST['from_date'] : $from;
        $to = !empty($_POST['to_date']) ? $_POST['to_date'] : $to;
        $count_views = mysqli_query($conn,"SELECT * FROM count_views WHERE date_view BETWEEN '$from' AND '$to' ORDER BY date_view DESC,view_per_day DESC LIMIT 10");
    }else{
        $count_views = mysqli_query($conn,"SELECT * FROM count_views WHERE date_view BETWEEN '$from' AND '$to' ORDER BY date_view DESC,view_per_day DESC LIMIT 10");
    }
    

 ?>



<div class="row">
    
    <div class="col-md-8">
    <h2 class="text-center" style="color:darkcyan">Top Views Month</h2>
    <form action="index.php?m=main&a=stat" method="POST">                      
            From:    <input type="date" name="from_date" value="<?= $from ?>">                       
            To:    <input type="date" name="to_date" value="<?= $to ?>">
            <button type="submit" class="btn btn-secondary btn-sm" name="submit">Submit</button>
    </form>
    
    
                <table class="table table-inverse bg-dark text-light table-striped">
                    <thead>
                        <tr>
                            <th>Post title</th>
                            <th>Content</th>
                            <th>Category</th>
                            <th>Post by</th>
                            <th>Tags</th>
                            <th>View per day</th>
                            <th>Date view</th>
                            <th>Total</th>
                            <th>Alldays had viewed</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($count_views as $count_view) : ?>
                            <?php 
                                $post_id = $count_view['post_id'];
                                $posts = mysqli_query($conn,"SELECT * FROM posts WHERE id = $post_id");
                                $post = mysqli_fetch_assoc($posts);
                                $category_id = $post['category_id'];
                                $query = mysqli_query($conn,"SELECT * FROM categories WHERE id = $category_id ");
                                $category = mysqli_fetch_assoc($query);
                                
                                $tags = mysqli_query($conn,"SELECT tags.tag_id,tags.tag_name as 'tag_name' FROM posts_tags pt JOIN tags ON pt.tag_id = tags.tag_id WHERE pt.post_id = $post_id");
                                $user_id = $post['user_id'];
                                $qr = mysqli_query($conn,"SELECT * FROM users WHERE id=$user_id");
                                $user = mysqli_fetch_assoc($qr);
                                $views = mysqli_query($conn,"SELECT SUM(view_per_day) as total_days_view FROM count_views WHERE post_id = $post_id AND date_view BETWEEN '$from' AND '$to' ");
                                $total_days_view = mysqli_fetch_assoc($views);
                                $view_dates = mysqli_query($conn,"SELECT post_id, GROUP_CONCAT(DISTINCT date_view) view_date FROM count_views WHERE post_id = $post_id");
                                $view_date = mysqli_fetch_assoc($view_dates);
                             ?>
                        <?php if($category['status'] == 1) : ?>
                            <tr>
                                <td>
                                    <a href="index.php?m=posts&a=view&id=<?= $post['id']; ?>" class="text-light"><?= $post['post_title']; ?></a>
                                </td>
                                <td>
                                    <?= $post['content'] ?>
                                </td>
                                <td>
                                    <?= $category['category_name'] ?>
                                </td>
                                <td>
                                    <?= $user['username']; ?>
                                </td>
                                <td>
                                    <?php foreach ($tags as $tag) : ?>
                                    <a href="index.php?m=tags&a=view&id=<?= $tag['tag_id']; ?>" class="text-light"><?= $tag['tag_name'] ?></a> | 
                                    <?php endforeach; ?>
                                </td>
                                <td><?= $count_view['view_per_day'] ?></td>
                                <td><?= $count_view['date_view'] ?></td>
                                <td><?= $total_days_view['total_days_view'] ?></td>
                                <td><?= $view_date['view_date'] ?></td>
                            </tr>
                        <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
    
                
    </div>






    <div class="col-md-4">
    <h2 class="text-center" style="color:darkcyan">User Ranking</h2>
    <div style="height: 33px"></div>
    
        <table class="table table-inverse table-hover bg-light">
            <thead class="thead-dark">
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Total view</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $users = mysqli_query($conn,"SELECT * FROM users ORDER BY total_view DESC LIMIT 10");
                foreach($users as $user) : 
                    ?>
                <tr>
                    <td><?= $user['username'] ?></td>
                    <td><?= $user['email'] ?></td>
                    <td><?= $user['total_view'] ?></td>         
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>