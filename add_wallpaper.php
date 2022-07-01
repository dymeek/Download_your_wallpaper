<?php

require 'lib/functions.php';
require 'database.php';

$wallpapers = get_wallpapers();

// if(isset($_POST['submit'])){
    $err_msg = '';
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
            <input class="btn btn-primary" type="submit" name="submit" value="Dodaj">            
            <div class="form status text-danger">
                <?php echo $err_msg; ?>
            </div>
            </div>
        </form>
    </div>

    <div class="container">
    <div class="table-responsive">
    <h2 class="text-center">Lista tapet</h2>
        <table class="table table-bordered">
        <thead>
            <tr>
            <th scope="col">ID</th>
            <th scope="col">Data dodania</th>
            <th scope="col">Nazwa</th>
            <th scope="col">Edytuj</th>
            <th scope="col">Usuń</th>
            </tr>
            <tr>
        <?php foreach($wallpapers as $wallpaper) { ?>        
        <th scope="row"><?php  echo $wallpaper['id']; ?></th>        
         <td><?php echo $wallpaper['date']; ?></td>
         <td><?php echo $wallpaper['name']; ?></td>
         <td>Edytuj</td>
         <td>Usuń</td>
        </tr>
            <?php } ?>
        </thead>
        <tbody>

        </table>
    </div>
</div>
<?php require 'layout/footer.php';