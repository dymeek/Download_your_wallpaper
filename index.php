<?php
//  session_start();

require  "layout/header.php";
require "lib/functions.php";
require 'database.php';

// if (!empty($_POST['login']) && !empty($_POST['password']))
// {
//   var_dump($_POST
// }


$newest_wallpapers = get_newest_wallpapers(4);
$high_res_wallpaper = get_high_res_wallpaper(8);
$wallpapers = get_wallpapers();


?>

<div class="container">
    <h3 class="text-center mb-4">Najnowsze tapety!</h3>
    <div class="row">
        <?php
            foreach($newest_wallpapers as $wallpaper){ ?>
                <div class="col col-sm-2 col-md-4 col-lg-3">
                <div class="card" style="width: 200px; height: 150px;">
                <a href="<?php "show.php" ?>
                "><img src="<?php echo $wallpaper['image']; ?>" class="card-img-top" alt="<?php echo $wallpaper['category']; ?>" style="width: 200px; height: 150px;" ></a>
                </div>
            </div>
           <?php }
        ?>
    </div>
  </div>

  <div class="container mt-3">
    <h3 class="text-center mb-4">Tapety o największej rozdzielczości!</h3>
    <div class="row">
        <?php
            foreach($high_res_wallpaper as $wallpaper){ ?>
                <div class="col col-sm-2 col-md-4 col-lg-3">
                <div class="card" style="width: 200px; height: 150px;">
                <a href="show.php?id=<?php echo $wallpaper['id']; ?>" >
                <img src="<?php echo $wallpaper['image']; ?>" class="card-img-top" alt="<?php echo $wallpaper['category']; ?>" style="width: 200px; height: 150px;" ></a>
                </div>
            </div>
           <?php }
        ?>
    </div>
  </div>























<?php

require "layout/footer.php";

?>