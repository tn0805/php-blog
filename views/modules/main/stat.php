<?php 
    $from = date("Y-m-01");
    $to = date("Y-m-d",strtotime("+1 day"));
    if (isset($_REQUEST['submit'])) {
        $from = !empty($_POST['from_date']) ? $_POST['from_date'] : $from;
        $to = !empty($_POST['to_date']) ? $_POST['to_date'] : $to;
        $views_count = mysqli_query($conn,"SELECT post_id,DATE(view_time) as view_times, COUNT(post_id) AS total_view FROM views_count WHERE view_time BETWEEN '$from' AND '$to' GROUP BY post_id ORDER BY total_view DESC");
    }else{
        $views_count = mysqli_query($conn,"SELECT post_id,DATE(view_time) as view_times, COUNT(post_id) AS total_view FROM views_count WHERE view_time BETWEEN '$from' AND '$to' GROUP BY post_id ORDER BY total_view DESC");
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
                            <th>View day</th>
                            <th>Total View</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($views_count as $value) : ?>
                            <?php 
                                $post_id = $value['post_id'];
                                $posts = mysqli_query($conn,"SELECT * FROM posts WHERE id = $post_id");
                                $post = mysqli_fetch_assoc($posts);

                                $category_id = $post['category_id'];
                                $query = mysqli_query($conn,"SELECT * FROM categories WHERE id = $category_id ");
                                $category = mysqli_fetch_assoc($query);
                                
                                $tags = mysqli_query($conn,"SELECT tags.tag_id,tags.tag_name as 'tag_name' FROM posts_tags pt JOIN tags ON pt.tag_id = tags.tag_id WHERE pt.post_id = $post_id");

                                $user_id = $post['user_id'];
                                $qr = mysqli_query($conn,"SELECT * FROM users WHERE id=$user_id");
                                $user = mysqli_fetch_assoc($qr);
                                
                                // $total_query = mysqli_query($conn,"SELECT COUNT(post_id) as counted FROM views_count WHERE post_id = $post_id AND view_time BETWEEN '$from' AND '$to' ");
                                // $total_view = 0;
                                // foreach ($total_query as $total) {
                                //     $total_view = $total['counted'];
                                // }
                                $total_view = $value['total_view'];
                             ?>
                        <?php if($category['status'] == 1) : ?>
                            <tr>
                                <td>
                                    <a href="index.php?m=posts&a=view&id=<?= $post_id; ?>" class="text-light"><?= $post['post_title']; ?></a>
                                </td>
                                <td>
                                    <?= $post['content'] ?>
                                </td>
                                <td>
                                    <a href="index.php?m=categories&a=view&id=<?= $category['id'] ?>" class="text-light"><?= $category['category_name'] ?></a>
                                </td>
                                <td>
                                    <a href="index.php?m=users&a=view&id=<?= $user['id'] ?>" class="text-light"><?= $user['username']; ?></a>
                                </td>
                                <td>
                                    <?php foreach ($tags as $tag) : ?>
                                    <a href="index.php?m=tags&a=view&id=<?= $tag['tag_id']; ?>" class="text-light"><?= $tag['tag_name'] ?></a> | 
                                    <?php endforeach; ?>
                                </td>
                                <td><?= $value['view_times'] ?></td>
                                <td><?= $total_view ?></td>
                            </tr>
                        <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
    
                
    </div>


<?php 
    foreach ($users as $user) {
        $total_view = 0;
        $user_id = $user['id'];
        $posts = mysqli_query($conn,"SELECT id FROM posts WHERE user_id = $user_id");
        foreach ($posts as $post) {
            $post_id = $post['id'];
            $totals = mysqli_query($conn,"SELECT COUNT(post_id) as counted FROM views_count WHERE post_id = $post_id AND view_time BETWEEN '$from' AND '$to'");
            $total = mysqli_fetch_assoc($totals);
            $total_view += $total['counted'];
        }
        mysqli_query($conn,"UPDATE users SET total_view = $total_view WHERE id = $user_id");
    }
 ?>



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