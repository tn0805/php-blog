<?php 
    $month = date('m');
    $year = date('Y');    
    if (isset($_REQUEST['submit'])) {
        $month = !empty($_POST['month_filter']) ? $_POST['month_filter'] : $month;
        $year = !empty($_POST['year_filter']) ? $_POST['year_filter'] : $year;
        $count_views = mysqli_query($conn,"SELECT * FROM count_views WHERE month = $month AND year = $year ORDER BY view_per_month DESC LIMIT 10");
    }else{
        $count_views = mysqli_query($conn,"SELECT * FROM count_views WHERE month = $month AND year = $year ORDER BY view_per_month DESC LIMIT 10");
    }
    

 ?>



<div class="row">
    
    <div class="col-md-6">
    <h2 class="text-center" style="color:darkcyan">Top Views Month</h2>
    <form action="index.php?m=main&a=stat" method="POST">
            <label for="month">Month:</label>
            <select id="month" name="month_filter">
              <?php 
                for ($i=1; $i <= 12 ; $i++) { 
                    if ($i == $month) {
                        echo "<option value=\"$i\""." selected>" . $i . "</option> ";
                    }else{
                        echo "<option value=\"$i\"".">" . $i . "</option> ";
                    }
                }
               ?>
            </select>
            <label for="year">Year:</label>
            <select id="year" name="year_filter">
            <?php
                foreach (range(1999, date('Y')) as $value) {
                    if ($value == $year) {
                        echo "<option value=\"$value\""." selected>" . $value . "</option > ";
                    }else{
                        echo "<option value=\"$value\"".">" . $value . "</option > ";
                    }
                }
            ?>
            </select>
        <button type="submit" name="submit" class="btn btn-secondary btn-sm">Submit</button>
    </form>
    
    
                <table class="table table-inverse table-hover bg-light">
                    <thead>
                        <tr>
                            <th>Post title</th>
                            <th>Content</th>
                            <th>Category</th>
                            <th>Post by</th>
                            <th>Tags</th>
                            <th>Month View</th>
                            <th>Total view</th>
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
                             ?>
                        <?php if($category['status'] == 1) : ?>
                            <tr>
                                <td>
                                    <a href="index.php?m=posts&a=view&id=<?php echo $post['id']; ?>"><?php echo $post['post_title']; ?></a>
                                </td>
                                <td>
                                    <?php echo $post['content'] ?>
                                </td>
                                <td>
                                    <?php echo $category['category_name'] ?>
                                </td>
                                <td>
                                    <?php echo $user['username']; ?>
                                </td>
                                <td>
                                    <?php foreach ($tags as $tag) : ?>
                                    <a href="index.php?m=tags&a=view&id=<?php echo $tag['tag_id']; ?>"><?= $tag['tag_name'] ?></a> | 
                                    <?php endforeach; ?>
                                </td>
                                <td><?= $count_view['view_per_month'] ?></td>
                                <td><?= $count_view['total_views'] ?></td>
                            </tr>
                        <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
    
                
    </div>
    
    
    
    
    
    
    <div class="col-md-6 bg-light">
    <h2 class="text-center" style="color:darkcyan">User Ranking</h2>
    
    
        <table class="table table-inverse table-hover">
            <thead>
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