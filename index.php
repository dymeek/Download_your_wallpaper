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
                <div class="card" style="width: 200px;" style="height: 150px;">
                <a href="<?php 
                if($wallpaper['category'] == "city"){
                   "city.php";
                }else if($wallpaper['category'] == "sport") {
                    "sport.php";
                }else if($wallpaper['category' == "nature"]){
                    "nature.php";
                }else {
                    "entertainmetn.php";
                }
                
                ?>
                "><img src="/images/<?php echo $wallpaper['image']; ?>" class="card-img-top" alt="<?php echo $wallpaper['category']; ?>" ></a>
                </div>
            </div>
           <?php }
        ?>
    </div>
  </div>






















<?php

require "layout/footer.php";

?>