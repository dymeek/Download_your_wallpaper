<?php

$categories = get_category();

?>

<div class="container d-flex justify-content-center menu-logout" >
    <ul class="nav"> 
        <li class="nav-item">
            <a class="nav-link"href="index.php">Strona główna</a>
        </li>
        <?php foreach($categories as $category) { ?>
        <li class="nav-item">
            <a class="nav-link" href="show_category.php?category=<?php echo $category['category'];?>"><?php echo $category['category']; ?></a>
        </li>
        <?php } ?>
    </ul>
</div>