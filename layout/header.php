 <?php 

session_start();
require_once 'database.php';


$err_msg = '';
if(isset($_POST['submit'])){
    echo var_dump($_POST['submit']);
    if($_POST['login'] != "" && $_POST['password'] ){
        $login = $_POST['login'];
        $password = $_POST['password'];

        $sgl = 'SELECT * FROM users WHERE login = :login AND password = :password';
        $query = $db->prepare($sql);
        $query->bindParam('login', $login);
        $query->bindParam('password', $password);
        $query->execute();
        $row = $query->rowCount();
        $fetch = $query->fetch();
        if($row > 0){
            $_SESSION['user'] =$fetch['id'];
            header('Location: add_wallpaper.php');
        }else {
            $err_msg = "Nierpawidłowy użytkownik lub hasło!"; 
        }
    }
}
 








?> 

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <meta name="keywords" content="darmowe tapety na pulpit,  free wallpapers">
    <meta name="description" content="Najlepsze tapety na pulpit">
    <meta name="author" content="Paweł Dymon">
    <title>Darmowe tapety!</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
<link rel="stylesheet" href="../css/style.css">

</head>
<body>

    <div class="container header d-flex flex-column flex-sm-row justify-content-between ">
        <div class="logo d-flex align-items-center col-12 col-sm-3 col-lg-6"><i class="bi bi-bullseye"></i>
      <h3>Super Tapeta!</h3></div>
     
        <form action="logged.php" method="POST" class="login col-12 col-sm-3 col-lg-6">
            <label>Login</label><input type="text" name="login"></label>
            <label>Hasło<input type="password" name="password"></label>
            <input type="submit" value="Zaloguj się" name="submit">
            <p class="text-danger"><?php echo $err_msg; ?></p>
        </form>
        
    </div>

