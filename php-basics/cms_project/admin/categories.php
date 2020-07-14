<?php include "includes/header.php"; ?>

    <div id="wrapper">

      <?php include "includes/navigation.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            <small>Author</small>
                        </h1>
                        <div class="col-xs-6">
                        <?php
                            if(isset($_POST['submit'])){
                                $cat_title = $_POST["cat_title"];
                                if($cat_title == "" || empty($cat_title)){
                                    echo "This field should not be empty";
                                } else {
                                    $query = "INSERT INTO categories(cat_title) ";
                                    $query .= "VALUES('$cat_title')";
                                    
                                    $create_category = mysqli_query($connection, $query);
                                    
                                    if(!$create_category){
                                        die('Query Failed' .  mysqli_error($connection));
                                    }
                                }
                            }
                        ?>

                            <form action="" method="POST">
                                <div class="form-group">
                                    <label for="cat_title">Add Category</label>
                                    <input type="text" class="form-control" name="cat_title" id="cat_title">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                                </div>
                            </form>
                            <form action="" method="POST">
                                <div class="form-group">
                                    <label for="update_cat_title"> Update Category</label>
                                    <?php
                                    if(isset($_GET['edit'])){
                                      $cat_id_edit = $_GET["edit"];

                                      $query = "SELECT * FROM categories WHERE id = $cat_id_edit";
                                      $get_edit_categories = mysqli_query($connection, $query);
      
                                      while($row = mysqli_fetch_assoc($get_edit_categories)){
                                          $cat_id = $row["id"];
                                          $cat_title = $row["cat_title"];
                                          ?>
                                          <input value="<?php if(isset($cat_title)) echo $cat_title; ?>" type="text" class="form-control" name="cat_title">

                                      <?php }
                                    }?>
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="submit" value="Add Update">
                                </div>
                            </form>
                        </div>
                        <div class="col-xs-6">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category Title</th>
                                    </tr>
                                </thead>
                                <tbody>

                                <?php // Get Categories
                                $query = "SELECT * FROM categories";
                                $select_catagories = mysqli_query($connection, $query);

                                while($row = mysqli_fetch_assoc($select_catagories)){
                                    $cat_id = $row["id"];
                                    $cat_title = $row["cat_title"];
                                    
                                    echo "<tr>";
                                    echo "<td>{$cat_id}</td>";
                                    echo "<td>{$cat_title}</td>";
                                    echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
                                    echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
                                    echo "</tr>";
                                } ?>

                                <?php // Delete Query
                                    if(isset($_GET['delete'])){
                                        $cat_id_delete = $_GET["delete"];
                                        
                                    $query = "DELETE FROM categories WHERE id = {$cat_id_delete}";
                                    
                                    $delete_query = mysqli_query($connection, $query);

                                    header("Location: categories.php");
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include "includes/footer.php"; ?>