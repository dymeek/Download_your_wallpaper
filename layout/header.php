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
    <div class="container headeer d-flex flex-column flex-sm-row justify-content-between ">
        <div class="logo d-flex align-items-center col-12 col-sm-3 col-lg-6"><i class="bi bi-bullseye"></i>
      <h3>Super Tapeta!</h3></div>
        <form action="logged.php" method="$_POST" class="login col-12 col-sm-3 col-lg-6">
            <input type="text" name="login">
            <input type="text" name="password">
            <input type="submit" value="Zaloguj się">
        </form>
    </div>
    <div class="container">
<ul class="nav">
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="#">Przyroda</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Miasto</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Sport</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Film</a>
  </li>
</ul>
</div>
