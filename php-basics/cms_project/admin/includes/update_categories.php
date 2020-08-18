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

  <?php 
    if(isset($_POST['submit_update'])){
      $cat_title_update = $_POST["cat_title"];

      $stmt = mysqli_prepare($connection, "UPDATE categories SET cat_title = ? WHERE id = ?");
      mysqli_stmt_bind_param($stmt, 'si', $cat_title_update, $cat_id);
      mysqli_stmt_execute($stmt);

      if(!$stmt){
        die("Query Failed" . mysqli_error($connection));
      }

      mysqli_stmt_close($stmt);
      redirect('./categories.php');
    }                                                    
  ?>
  </div>    
  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="submit_update" value="Update Category">
  </div>
</form>