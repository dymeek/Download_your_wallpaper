<?php

require 'database.php';
require 'lib/functions.php';
$categories = get_category();

//usuwanie elementu z tablicy
$del_msg = '';
if(isset($_REQUEST['delete'])){

    $id = $_REQUEST['id'];

    $sql = "DELETE FROM categories WHERE category_id = :id";
    $result = $db->prepare($sql);
    $result->bindParam('id', $id);
    $result->execute();

    $del_msg = $result->rowCount() . " Wiersz usunięty<br>";

    unset($result);

}

//edycja elementu
$ed_msg = "";
if(isset($_REQUEST['edit'])){
    $id = $_REQUEST['id'];
    $category = $_REQUEST['category_update'];
    $sql = "UPDATE categories SET category = :category WHERE category_id = :id";

    $result = $db->prepare($sql);
    $result->bindParam('category', $category);
    $result->bindParam('id', $id);
    $result->execute();

    $ed_msg = $result->rowCount() . " Wiersz uaktualniony!<br>";

    unset($result);   

}

?>

<?php require 'layout/header_log.php'; ?>

<div class="container d-flex justify-content-center mb-3 mt-3">
    <a href="add_category.php"  class="btn btn-success text-center">Dodaj kategorię</a>
</div>

<div class="container">
    <div class="table-responsive">
    <h2 class="text-center">Lista dostępnych kategorii</h2>
    <?php echo $del_msg; ?>
    <?php echo $ed_msg; ?>
        <table class="table table-bordered">
        <thead>
            <tr>
            <th scope="col" class="text-center">ID</th>
            <th scope="col" class="text-center">Data dodania</th>
            <th scope="col" class="text-center">Kategoria</th>
            <th scope="col" class="text-center">Edytuj</th>
            <th scope="col" class="text-center">Usuń</th>
            </tr>
            <tr>
        <?php foreach($categories as $category) { ?>      
            <form action="add_category.php" method="POST">
            <th scope="row" class="text-center"><?php  echo $category['category_id']; ?></th>        
            <td class="text-center"><?php echo $category['date']; ?></td>
            <td class="text-center"><input type="text" name="category_update" value="<?php echo $category['category']; ?>"></td>
            <td class="text-center"><input type="hidden" name="id" value="<?php echo $category['category_id']; ?>"><input type="submit" class="btn btn-success" name="edit" value="Edytuj"></form></td>
            <td class="text-center"><form action="" method="POST"><input type="hidden" name="id" value="<?php echo $category['category_id'];?>"><input type="submit"
            class="btn btn-danger" name="delete" value="Usuń"></form></td>
            </tr>
        <?php } ?>            
        </thead>
        <tbody>

        </table>
    </div>
</div>


<?php require 'layout/footer.php'; ?>