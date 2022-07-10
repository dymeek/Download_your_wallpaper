<?php
require 'lib/functions.php';


$id = $_GET['id'];

$wallpaper = get_wallpaper($id); 
$categories = get_category();

foreach($wallpaper as $wallpapers){
  $title = $wallpapers['name'];
  $description = $wallpapers['description'];
}
 
 ?>

<?php
require 'layout/header.php';
require 'layout/nav.php';
?>

<div class="container ">
    <div class="card mb-3 lg-6 show_details">
      <div class="row ">
        <?php foreach($wallpaper as $wallpaper) { ?>                  
        <div class="col-md-4 img_wrapper_show">
          <img style="width:400px; height:300px;" src="<?php echo $wallpaper['image']; ?>" class="img-fluid rounded-start" alt="<?php echo $wallpaper['category']; ?>">
          <a href="<?php echo $wallpaper['image'] ?>" download="<?php echo $wallpaper['name'];?>" class="btn btn-primary"  style="width:400px;" > Pobierz</a>
        </div>
        <div class="col-md-4">
          <div class="card-body">
            <h4 class="card-title border rounded border-dark pl-2 show">Kategoria: <?php echo $wallpaper['category']; ?></h4>
            <h5 class="border rounded border-dark show">Nazwa: <?php echo $wallpaper['name']; ?></h5>
            <p class="border rounded border-dark">Parametry tapety: <br>
            <?php echo "Rozdzielczość: " . $wallpaper['width'] . "x" . $wallpaper['height'] . "px <br>"; ?>
            <?php echo "Waga zdjęcia: " . $wallpaper['weight']; ?>            
            <?php 
            ?><p>
            <p class="card-text border rounded border-dark"><?php echo $wallpaper['description']; ?></p>                      
          </div>
        </div>
        <?php } ?> 
      </div>
  </div>
</div>


<?php

echo '<title>' . $wallpaper['name'] . '</title>';
require 'layout/footer.php';
?>