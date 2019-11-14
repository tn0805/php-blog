

            <div class="container">
                
                        <table class="table table-inverse">
                            <thead>
                                <tr>
                                    <th>Category name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($categories as $category) : ?>
                                <tr>
                                    <td>
                                        <a href="index.php?m=categories&a=view&id=<?= $category['id'] ?>">
                                            <?php 
                                                if ($category['status'] == 1) {
                                                    echo $category['category_name'];
                                                }
                                            ?>
                                        </a>                                      
                                    </td>
                                    
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        
            </div>
