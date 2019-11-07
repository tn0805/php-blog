

            <div class="container">
                
                        <table class="table table-inverse">
                            <thead>
                                <tr>
                                    <th>Category name</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($categories as $category) : ?>
                                <tr>
                                    <td><?php echo $category['category_name'] ?></td>
                                    <td><?php 
                                        if ($category['status'] == 1) {
                                            echo "<a class=\"btn btn-primary btn-sm\" style=\"color:#fff\">Show</a>";
                                        }else{
                                            echo "<a class=\"btn btn-danger btn-sm\" style=\"color:#fff\">Hidden</a>";
                                        }
                                     ?></td>
                                     <td><a href="index.php?m=categories&a=edit&id=<?php echo $category['id']; ?>" class="btn btn-primary">Edit</a>
                                        <a href="index.php?m=categories&a=delete&id=<?php echo $category['id']; ?>" class="btn btn-danger" onclick="return confirm('Delete?')" >Delete</a></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <a href="index.php?m=categories&a=create" class="btn btn-primary">Create</a>
                        
            </div>
