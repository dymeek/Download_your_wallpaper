 <?php 


  session_start();

//  if(isset($_SESSION['logged_id'])){
//    header('Location: logged.php');
//    exit();
//  }

?> 

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            <input type="submit" value="Zaloguj się" name="sumbit">

        </form>
    </div>

