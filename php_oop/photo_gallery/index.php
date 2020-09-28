<?php include("includes/header.php"); ?>
<?php 
    $page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
    $items_per_page = 4;
    $total_items = Photo::count_all();

    $paginate = new Paginate($page, $items_per_page, $total_items);

    $sql = "SELECT * FROM photos LIMIT {$items_per_page} OFFSET {$paginate->offset()}";
    $photos = Photo::submit_query($sql);


?>


        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-12">
                <div class="thumbnails row">
                <?php foreach($photos as $photo): ?> 
                        <div class="col-xs-6 col-md-3">
                            <a href="photo.php?id=<?php echo $photo->id; ?>" class="thumbnail">
                                <img class="img-responsive home-page-photo" src="admin/<?php echo $photo->photo_path(); ?>" alt="">
                            </a>
                        </div>
                <?php endforeach; ?>   
                </div>
            
          
         

            </div>




            <!-- Blog Sidebar Widgets Column -->
            <!-- <div class="col-md-4">



        </div> -->
        <!-- /.row -->

        <?php include("includes/footer.php"); ?>
