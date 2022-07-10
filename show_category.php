<?php

// require 'database.php';
require 'lib/functions.php';
require 'layout/header.php';
require 'layout/nav.php';

// $category = $_GET['category'];

$category = $_GET['category'];

$categories = get_category();
$wallpaper_by_category = get_wallpaper_by_category($category);

?>



<div class="container">
    <h3 class="text-center mb-4">Tapety z kategorii: <?php echo $category ?> </h3>
    <div class="row">
        <?php
            foreach($wallpaper_by_category as $wallpaper){ ?>
                <div class="col col-sm-2 col-md-4 col-lg-3">
                <div class="card mt-2 img_wrapper">
                <a href="show.php?id=<?php echo $wallpaper['id']; ?>">
                <img src="<?php echo $wallpaper['image']; ?>" class="card-img-top" alt="<?php echo $wallpaper['category']; ?>"></a>
                </div>
            </div>
           <?php }
        ?>
    </div>
  </div>


<?php 
require 'layout/footer.php';
?>