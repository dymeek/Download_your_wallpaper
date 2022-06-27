<?php

require 'database.php';

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

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel administratora - wgraj plik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
<link rel="stylesheet" href="../css/style.css">
</head>
<body>

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
</body>
</html>