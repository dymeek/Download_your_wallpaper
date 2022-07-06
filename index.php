<?php

session_start();
if(isset($_POST['submit'])){
    // $login = $_POST['login'];
    // $password = $_POST['password'];

    if(empty($_POST['login']) || empty($_POST['password'])){
        echo 'wszystkie pola są wymagane';
    }else {
        $sql = 'SELECE * FROM users WHERE login = :login AND password = :password';

        $query = $db->prepare($sql);
        $query->bindParam('login', $login);
        $query->bindParam('password', $password);
        $quert->execute(
            array (
            'login' => $_POST['login'],
            'password' => $_POST['password']
            )
        );

        $count = $query->rowCount();
        if($count > 0){
            $_SESSION['username'] = $_POST['login'];
            header('Location: login.php');
        }else {
            echo "Podano złe hasło lub login!";
        }
    }
}

require 'lib/functions.php';
require 'database.php';
require  "layout/header.php";
require 'layout/nav.php';

$categories = get_category();
$newest_wallpapers = get_newest_wallpapers(8);
$high_res_wallpaper = get_high_res_wallpaper(8);
$wallpapers = get_wallpapers();

?>

<div class="container">
    <h3 class="text-center mb-4">Najnowsze tapety!</h3>
    <div class="row">
        <?php
            foreach($newest_wallpapers as $wallpaper){ ?>
                <div class="col col-sm-2 col-md-4 col-lg-3 mb-1">
                <div class="card" style="width: 200px; height: 150px;">
                <a href="show.php?id=<?php echo $wallpaper['id']; ?>">
                <img src="<?php echo $wallpaper['image']; ?>" class="card-img-top" alt="<?php echo $wallpaper['category']; ?>" style="width: 200px; height: 150px;" ></a>
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
                <div class="col col-sm-2 col-md-4 col-lg-3 mb-1">
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