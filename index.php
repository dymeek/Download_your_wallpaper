<?php
//  session_start();

require_once "layout/header.php";
require "lib/functions.php";
$wallpapers = get_wallpapers();
// require_once 'database.php';

?>
  <div class="container">
    <div class="row">
        <?php
            foreach($wallpapers as $wallpaper){ ?>
                <div class="col col-sm-2 col-md-4 col-lg-3">
                <div class="card" style="width: 200px; height: 150px;">
                <a href="<?php "show.php"; ?>
                "><img src="/images/<?php echo $wallpaper['image']; ?>" class="card-img-top" alt="<?php echo $wallpaper['category']; ?>" style="width: 200px; height: 150px;" ></a>
                </div>
            </div>
           <?php }
        ?>
    </div>
  </div>






















<?php

require "layout/footer.php";

?>