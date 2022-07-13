<?php

require 'database.php';
require 'lib/functions.php';

$id = $_GET['id'];

$wallpaper = get_wallpaper($id); 
$category = get_category();

if(isset($_REQUEST['update'])){
    $id = $_REQUEST['id'];
    $category = $_REQUEST['file_category'];
    $name = $_REQUEST['update_name'];
    $description = $_REQUEST['update_description'];

    if($_REQUEST['file_category'] == "" ||  $_REQUEST['update_name'] == ""){
        echo 'Wszystkie pola muszą być uzupełnione!';
    } else {
        $sql = "UPDATE wallpapers SET category = :file_category, name = :update_name, description = :update_description WHERE id = :id";

        $result = $db->prepare($sql);
        $result->bindParam('file_category', $category);
        $result->bindParam('update_name', $name);
        $result->bindParam('update_description', $description);
        $result->bindParam('id', $id);

        $result->execute();

        unset($result);
    }
} 
?>

<?php require 'layout/header_log.php'; ?>
<div class="container">
        <h2 class="text-center">Edytuj dane tapety!</h2>
        <?php foreach($wallpaper as $wallpaper) { ?>
        <form action="wallpapers.php" method="POST">            
            <div class="mb-3">
                <label class="form-label">Kategoria:</label>
                <select name="file_category" id="file_category" class="form-select">
                    <option selected disabled>--- Wybierz kategorię ---</option>
                    <?php foreach($category as $category) { ?>
                    <option value="<?php echo $category['category']; ?>"><?php echo $category['category'] ?></option>
                    <?php } ?>
                </select>
                <!-- <input class="form-control" type="text" name="update_category" id="update_category"
                value="<?php if(isset($wallpaper['category'])) { echo $wallpaper['category']; } ?>"> -->
            </div>

            <div class="mb-3">
                <label class="form-label">Nazwa:</label>
                <input class="form-control" type="text" name="update_name" id="update_name"
                value="<?php if(isset($wallpaper['name'])) { echo $wallpaper['name']; } ?>">
            </div>
            <div>
                <label class="form-label">Opis:</label>
                <textarea class="form-control form-control-lg" id="update_description" type="file" name="update_description" 
                ><?php if(isset($wallpaper['description'])) { echo $wallpaper['description']; } ?></textarea>
            </div>
            <input type="hidden" name="id" value="<?php echo $wallpaper['id']; ?>">
            <input class="btn btn-success" type="submit" name="update" value="Update">           

            
            
        </form>
        <?php } ?>
    </div>

    <?php require 'layout/footer.php'; ?>