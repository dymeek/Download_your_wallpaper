<?php

require 'lib/functions.php';
require 'database.php';

$wallpapers = get_wallpapers();


    $err_msg = '';
if(isset($_POST['submit'])){
if($_SERVER["REQUEST_METHOD"] == "POST"){   
    
    
    $file_category = $_POST['file_category'];
    $foto_name = $_POST['foto_name'];
    $file_resolution = $_POST['file_resolution'];
    $file_weight = $_POST['file_weight'];
    $upload_date = $_POST['upload_date'];    
    $description= $_POST['description'];
    $file_to_upload = $_FILES['file_to_upload']['name'];

    if(empty($file_category) || empty($foto_name) || empty($file_resolution) || empty($file_weight) || empty($upload_date) || empty($description)){
        $err_msg = "Proszę uzupełnić wszystkie pola";
    }else {   

    $tmp_dir = $_FILES['file_to_upload']['tmp_name'];

    //Lokalizacja
    $upload_dir = 'uploads/'.$file_to_upload;

    $file_extension = pathinfo($upload_dir, PATHINFO_EXTENSION);
    $file_extension = strtolower($file_extension);

    // walidacja rozszerzenia
    $valid_extensions = array('jpeg', 'jpg', 'png');  

    // $wallpaper_image = $imgExt;
    move_uploaded_file($tmp_dir, $upload_dir);

    $wallpaper_db ="INSERT INTO wallpapers (id, category, name, resolution, weight, description, date, image) VALUES (NULL, :file_category, :foto_name, :file_resolution, :file_weight, :description, :upload_date, :image)";
    $stmt = $db->prepare($wallpaper_db);
    $stmt->execute(['file_category' => $file_category, 'foto_name' => $foto_name, 'file_resolution' => $file_resolution, 'file_weight' => $file_weight, 'description' => $description, 'upload_date' => $upload_date, 'image' =>$upload_dir ]);

    }
   }
}


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

    <div class="container">
        <h2 class="text-center">Dodaj nową tapetę</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
            <label class="form-label">Kategoria:</label>
            <input class="form-control" type="text" name="file_category" id="fileCategory">
            </div>
            <div class="mb-3">
            <label class="form-label">Nazwa:</label>
            <input class="form-control" type="text" name="foto_name" id="fileName">
            </div>
            <div class="mb-3">
            <labelclass="form-label">Rozdzielczość:</label>
            <input class="form-control" type="text" name="file_resolution" id="fileResolution">
            </div>
            <div class="mb-3">
            <labelclass="form-label">Waga zdjęcia:</label>
            <input class="form-control" type="text" name="file_weight" id="fileWeight">
            </div>
            <div>
            <labelclass="form-label">Data dodania:</label>
            <input class="form-control" type="date" name="upload_date" id="uploadDate">
            </div>
            <div>
            <labelclass="form-label">Opis:</label>
            <textarea class="form-control form-control-lg" id="formFileLg" type="file" name="description"></textarea>
            </div>
            <div>
            <label class="form-label">Wybierz plik do dodania:</label>
            <input class="form-control" type="file" name="file_to_upload" id="file_to_upload">
            <input class="btn btn-primary mt-2" type="submit" name="submit" value="Dodaj">            
            <div class="form status text-danger">
                <?php echo $err_msg; ?>
            </div>
            </div>
        </form>
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