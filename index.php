<?php
//  session_start();

require_once "layout/header.php";
require "lib/functions.php";
$wallpapers = get_wallpapers();
// require_once 'database.php';

?>
  <div class="container">
    <h3 class="text-center mb-4">Najnowsze tapety!</h3>
    <div class="row">
        <?php
            foreach($wallpapers as $wallpaper){ ?>
                <div class="col col-sm-2 col-md-4 col-lg-3">
                <div class="card" style="width: 200px; height: 150px;">
                <a href="<?php "show.php" ?>
                "><img src="/images/<?php echo $wallpaper['image']; ?>" class="card-img-top" alt="<?php echo $wallpaper['category']; ?>" style="width: 200px; height: 150px;" ></a>
                </div>
            </div>
           <?php }
        ?>
    </div>
  </div>


 <!-- przygotowanie elemnetu do show.php - dane tapety będą pobierane za pomoc id z bazy danych -->
<div class="container">
    <div class="card mb-3 lg-6">
    <div class="row g-0">
      <?php foreach($wallpapers as $wallpaper) { ?>
      <div class="col-md-4">
        <img style="width:400px; height:300px;" src="/images/<?php echo $wallpaper['image']; ?>" class="img-fluid rounded-start" alt="<?php echo $wallpaper['category']; ?>">
        <button class="btn btn-primary" style="width:400px;">Pobierz</button>
      </div>
      <div class="col-md-4">
        <div class="card-body">
          <h4 class="card-title border rounded border-dark pl-2">Kategoria: <?php echo $wallpaper['category']; ?></h4>
          <h5 class="border rounded border-dark"><?php echo $wallpaper['name']; ?></h5>
          <p class="border rounded border-dark">Parametry tapety: <br>
          <?php echo "Rozdzielczość: " . $wallpaper['resolution'] . "<br>";
          echo "Waga zdjęcia: " . $wallpaper['weight'];
          ?><p>
          <p class="card-text border rounded border-dark"><?php echo $wallpaper['description']; ?></p>          
        </div>
      </div>
     <?php } ?>
    </div>
  </div>
</div>





















<?php

require "layout/footer.php";

?>