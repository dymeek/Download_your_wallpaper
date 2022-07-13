 <?php 

?> 

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <meta name="keywords" content="darmowe tapety na pulpit,  free wallpapers">
    <meta name="description" content=<?php if(isset($description)){
        echo $description;
    }else {
        "Najlepsze tapety na pulpit";
    }?>>
    <meta name="author" content="Paweł Dymon">
    <title><?php if(isset($title)) 
    {echo $title;
    }else echo "Darmowe Tapety"; ?></title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet"> 
<link rel="stylesheet" href="../css/style.css">

</head>
<body class="d-flex flex-column min-vh-100">

    <div class="container header d-flex flex-column flex-sm-row justify-content-between ">
    
        <a href="index.php" class="container">
            <div class="container header d-flex flex-column flex-sm-row justify-content-start ">
                <div class="logo d-flex align-items-center col-12 col-sm-3">
                    <i class="bi bi-bullseye"></i>
                    <h3>Super Tapeta!</h3>
                </div>
            </div>            
        </a>
     

         <form action="login.php" method="POST" class="login col-12 col-sm-3 col-lg-9 d-flex flex-column flex-lg-row justify-content-center justify-content-lg-end">
            <div class="d-flex flex-column flex-lg-row ml-auto">
            <label id="label-input">Login<input type="text" name="login" id="input-label"></label>       
            <label id="label-input">Hasło<input type="password" name="password" id="input-label"></label>
            </div>
            <div class="ml-1">
            <input type="submit" value="Zaloguj się" name="submit" id="submit-login">
            </div>
            
        </form>   
        
    </div>

