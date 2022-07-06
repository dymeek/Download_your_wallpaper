<?php

require 'lib/functions.php';
require 'database.php';

$wallpapers = get_wallpapers();


    $err_msg = '';
if(isset($_POST['submit'])){
if($_SERVER["REQUEST_METHOD"] == "POST"){   
    
    
    $file_category = $_POST['file_category'];
    $foto_name = $_POST['foto_name'];
    $upload_date = $_POST['upload_date'];    
    $description= $_POST['description'];
    $file_to_upload = $_FILES['file_to_upload']['name'];

    // if(empty($file_category) || empty($foto_name) || empty($file_resolution) || empty($file_weight) || empty($upload_date) || empty($description))

    if(empty($file_category) || empty($foto_name) || empty($upload_date) || empty($description)){
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

    //pobieranie z dodawanego zdjęcia szerokości/wysokości i rozmiaru zdjęcia
    $size = getimagesize($upload_dir);    
    $width = $size[0];
    $height  = $size[1];    
    $filesize = filesize($upload_dir);
    $res = round($filesize / 1024) . "kb";


    $wallpaper_db ="INSERT INTO wallpapers (id, category, name, width, height, weight, description, date, image) VALUES (NULL, :file_category, :foto_name, :width, :height, :file_weight, :description, :upload_date, :image)";
    $stmt = $db->prepare($wallpaper_db);
    $stmt->execute(['file_category' => $file_category, 'foto_name' => $foto_name, 'width' => $width, 'height' => $height, 'file_weight' => $res, 'description' => $description, 'upload_date' => $upload_date, 'image' => $upload_dir ]);

    }
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



<?php require 'layout/footer.php';