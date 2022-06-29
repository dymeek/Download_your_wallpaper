<?php

require 'database.php';
require 'lib/functions.php';
$categories = get_category();

$err_msg = '';
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $new_category = $_POST['new_category'];
    if(empty($_POST['new_category'])){
        $err_msg = "Pole kategorii musi być wypłenione";
    }else {

        $sql ="INSERT INTO categories (category_id, category) VALUES (NULL, :new_category)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam('new_category', $new_category);
        $stmt->execute(); 

    }

    
}


?>

<?php require 'layout/header_log.php'; ?>


<div class="container">        
<h2 class="text-center">Dodaj nową kategorię</h2>
        <form action="" method="post">
            <div class="mb-3">
            <label class="form-label">Nazwa kategorii:</label>
            <input class="form-control" type="text" name="new_category" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST') echo $new_category; ?>">
            </div>
            <input class="btn btn-primary m-3 ps-5 pe-5" type="submit" name="submitOne" value="Dodaj">
            <div class="form status text-danger">
                <?php echo $err_msg; ?>
            </div>
        </form>
    </div>


    <h2 class="text-center">Lista dostępnych kategorii!</h2>
<div class="container d-flex justify-content-start" >
    <ul class="nav d-flex flex-column"> 
        <?php foreach($categories as $category) { ?>
        <li class="nav-item">
            <?php echo $category['category']; ?></li>
        <?php } ?>
    </ul>
</div>

<?php require 'layout/footer.php'; ?>