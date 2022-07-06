<?php
require 'lib/functions.php';


$id = $_GET['id'];

$wallpaper = get_wallpaper($id); 
$categories = get_category();

// $size = getimagesize($wallpaper['name']);



?>

<?php
require 'layout/header.php';
require 'layout/nav.php';
?>

<div class="container">
    <div class="card mb-3 lg-6">
      <div class="row g-0">
        <?php foreach($wallpaper as $wallpaper) { ?> 
        <div class="col-md-4">
          <img style="width:400px; height:300px;" src="<?php echo $wallpaper['image']; ?>" class="img-fluid rounded-start" alt="<?php echo $wallpaper['category']; ?>">
          <a href="<?php echo $wallpaper['image'] ?>" download="<?php echo $wallpaper['name'];?>" class="btn btn-primary"  style="width:400px;" > Pobierz</a>
        </div>
        <div class="col-md-4">
          <div class="card-body">
            <h4 class="card-title border rounded border-dark pl-2">Kategoria: <?php echo $wallpaper['category']; ?></h4>
            <h5 class="border rounded border-dark"><?php echo $wallpaper['name']; ?></h5>
            <?php  $size = getimagesize($wallpaper['image']); 
                   $filesize = filesize($wallpaper['image']);?>
            <p class="border rounded border-dark">Parametry tapety: <br>
            <?php echo "Rozdzielczość: " . $size[0] . "x" . $size[1] . "px <br>"; ?>
            <?php echo "Waga zdjęcia: " . round($filesize / 1024) . "kb"; ?>            
            <?php 
            // zostawione dla testów - skasować potem
            // echo "Rozdzielczość: " . $wallpaper['resolution'] . " dpi." . "<br>";
            // echo "Waga zdjęcia: " . $wallpaper['weight'];
            ?><p>
            <p class="card-text border rounded border-dark"><?php echo $wallpaper['description']; ?></p>        
                      
          </div>
        </div>
        <!-- dla celów testowych do saksaowania potem!  -->
        <?php $size = getimagesize($wallpaper['image']);
        echo var_dump($size); 
        echo "<br>";
        echo $size[0] . "x" . $size[1] . "px";
        $filesize = filesize($wallpaper['image']);
        echo "<br>";
        echo $result = round($filesize / 1024) . "kb" . "<br>";
        echo var_dump($filesize);
        ?>
        <?php } ?> 
      </div>
  </div>
</div>

<?php

require 'layout/footer.php';
?>