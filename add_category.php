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

if(isset($_REQUEST['delete'])){

    $id = $_REQUEST['id'];

$sql = "DELETE FROM categories WHERE category_id = :id";
$result = $db->prepare($sql);
$result->bindParam('id', $id);
$result->execute();

echo $result->rowCount() . " Wiersz usunięty<br>";

unset($result);


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

<div class="container">
    <div class="table-responsive">
    <h2 class="text-center">Lista dostępnych kategorii</h2>
        <table class="table table-bordered">
        <thead>
            <tr>
            <th scope="col">ID</th>
            <th scope="col">Data dodania</th>
            <th scope="col">Kategoria</th>
            <th scope="col">Edytuj</th>
            <th scope="col">Usuń</th>
            </tr>
            <tr>
        <?php foreach($categories as $category) { ?>        
        <th scope="row"><?php  echo $category['category_id']; ?></th>        
         <td><?php echo $category['date']; ?></td>
         <td><?php echo $category['category']; ?></td>
         <td>Edytuj</td>
         <td><form action="" method="POST"><input type="hidden" name="id" value="<?php echo $category['category_id']; ?>"><input type="submit"
         class="btn btn-danger" name="delete" value="Usuń"></form></td>
        </tr>
            <?php } ?>
        </thead>
        <tbody>

        </table>
    </div>
</div>


<?php require 'layout/footer.php'; ?>