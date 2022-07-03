<?php

require 'lib/functions.php';
require 'database.php';

$wallpapers = get_wallpapers();

$del_msg = '';
//usuwanie elementu z tablicy
if(isset($_REQUEST['delete'])){

    $id = $_REQUEST['id'];

    $sql = "DELETE FROM wallpapers WHERE id = :id";
    $result = $db->prepare($sql);
    $result->bindParam('id', $id);
    $result->execute();

    $del_msg = $result->rowCount() . " Wiersz usunięty<br>";

    unset($result);
}

if(isset($_REQUEST['edit'])){
    $id = $_REQUEST['id'];
    $name = $_REQUEST['name_update'];

    $sql = 'UPDATE wallpapers SET name = :name_update WHERE id = :id';
    $result = $db->prepare($sql);
    $result->bindParam('id', $id);
    $result->bindParam('name_update', $name);

    $result->execute();


    unset($result);
}

?>

<?php

require 'layout/header_log.php';

?>

<div class="container d-flex justify-content-center mb-3 mt-3">
    <a href="add_wallpaper.php"  class="btn btn-success text-center">Dodaj tapetę</a>
</div>



    <div class="container">
    <div class="table-responsive">
    <h2 class="text-center">Lista tapet</h2>
    <?php $del_msg; ?>
        <table class="table table-bordered">
        <thead>
            <tr>
            <th scope="col" class="text-center">ID</th>
            <th scope="col" class="text-center">Data dodania</th>
            <th scope="col" class="text-center">Nazwa</th>
            <th scope="col" class="text-center">Edytuj</th>
            <th scope="col" class="text-center">Usuń</th>
            </tr>
            <tr>
        <?php foreach($wallpapers as $wallpaper) { ?> 
            <form action="" method="POST">       
        <th scope="row" class="text-center"><?php  echo $wallpaper['id']; ?></th>        
         <td class="text-center"><?php echo $wallpaper['date']; ?></td>

         <td class="text-center"><input type="text" name="name_update" value="<?php echo $wallpaper['name']; ?>"></td>

         <td class="text-center"><input type="hidden" name="id" value="<?php echo $wallpaper['id']; ?>"><input type="submit" class="btn btn-success" name="edit" value="Edytuj"></form></td>

         <td class="text-center"><form action="" method="POST"><input type="hidden" name="id" value="<?php echo $wallpaper['id']; ?>"><input type="submit"
         class="btn btn-danger" name="delete" value="Usuń"></form></td>
        </tr>
            <?php } ?>
        </thead>
        <tbody>

        </table>
    </div>
</div>


<?php require 'layout/footer.php';