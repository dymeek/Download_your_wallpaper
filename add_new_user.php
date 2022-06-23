<?php

require "database.php";

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
        <h2 class="text-center">Dodaj nowego użytkownika</h2>
        <form action="#" method="post">
            <div class="mb-3">
            <label class="form-label">Nazwa użytkownika:</label>
            <input class="form-control" type="text" name="userLogin" id="userLogin">
            </div>
            <div class="mb-3">
            <label class="form-label">Hasło:</label>
            <input class="form-control" type="password" name="passOne" id="passOne">
            </div>
            <div class="mb-3">
            <label class="form-label">Powtórz hasło:</label>
            <input class="form-control" type="password" name="passTwo" id="passTwo">
            </div>
            <div>
            <labelclass="form-label">Data dodania:</label>
            <input class="form-control" type="date" name="addDate" id="addDate">
            </div>
            <input class="btn btn-primary" type="submit" name="submitOne" value="Dodaj">
        </form>
    </div>
</body>
</html>

 <?php 
// koniecznie dodać sprawdzenie warunków -> czy istnieje taki użytkownik i czy hasła się nie różnią 
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $userLogin = $_POST['userLogin'];
    $passOne = $_POST['passOne'];
    $passTwo = $_POST['passTwo'];
    $addDate = $_POST['addDate'];

    $sql ="INSERT INTO users (id, login, password, data) VALUES (NULL, :userLogin, :passOne, :addDate)";

    $stmt = $db->prepare($sql);
    $stmt->execute(['userLogin' => $userLogin, 'passOne' => $passOne, 'addDate' => $addDate]);

}


// if(isset($_POST['submitOne'])){ 
// }


?> 