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

      $query = "UPDATE categories SET cat_title = '{$cat_title_update}' WHERE id = {$cat_id}";

      $update_query = mysqli_query($connection, $query);

      if(!$update_query){
        die("Query Failed" . mysqli_error($connection));
      }
    }                                                    
  ?>
  </div>    
  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="submit_update" value="Update Category">
  </div>
</form>