<?php

require 'lib/functions.php';
require 'database.php';

$wallpapers = get_wallpapers();
$category = get_category();


    $err_msg = '';
if(isset($_POST['submit'])){
if($_SERVER["REQUEST_METHOD"] == "POST"){   
     
    
    $file_category = $_POST['file_category']; 
    $foto_name = $_POST['foto_name'];    
    $description= $_POST['description'];
    $file_to_upload = $_FILES['file_to_upload']['name'];

    if(empty($foto_name) || empty($description) || empty($file_category)){
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


    $wallpaper_db ="INSERT INTO wallpapers (id, category, name, width, height, weight, description, image) VALUES (NULL, :file_category, :foto_name, :width, :height, :file_weight, :description, :image)";
    $stmt = $db->prepare($wallpaper_db);
    $stmt->execute(['file_category' => $file_category, 'foto_name' => $foto_name, 'width' => $width, 'height' => $height, 'file_weight' => $res, 'description' => $description, 'image' => $upload_dir ]);

    }
   }
}

?>

<?php

require 'layout/header_log.php';

?>

    <div class="container">
        <h2 class="text-center">Dodaj nową tapetę</h2>
        <form action="" method="POST" enctype="multipart/form-data" class="form">
            <div class="mb-3">
                <label class="form-label" for="file_category">Kategoria:</label>                
                <select name="file_category" id="file_category" class="form-select">
                    <option selected disabled>--- Wybierz kategorię ---</option>
                    <?php foreach($category as $category) { ?>
                    <option value="<?php echo $category['category']; ?>"><?php echo $category['category'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Nazwa:</label>
                <input class="form-control" type="text" name="foto_name" id="fileName">
            </div>
            <div>
                <label class="form-label">Opis:</label>
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