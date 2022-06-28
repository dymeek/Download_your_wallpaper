<?php

 session_start();
 
 require 'database.php';

 $err_msg = '';

 if(isset($_POST['submit'])){
    $login = $_POST['login'];
    $pass = $_POST['password'];

    if(empty($_POST['login']) || empty($_POST['password'])){
        $err_msg = "Wszystkie pola są wymagane";
    }else {
        $query = "SELECT * FROM users WHERE login = :login AND passwrod = :password";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':login', $login);
        $stmt->bindParam(':password', $pass);
        $stmt->execute();

        $result = $stmt->fetchAll();    
    }


 }

//  if (!empty($_POST['login']) && !empty($_POST['password']))
// {
//   var_dump($_POST);
// }



//  if(!isset($_SESSION['logged_id'])){

//      if(isset($_POST['login'])){

//         //pobieranie danych z pola logowania
//         $login = filter_input(INPUT_POST, 'login');
//         $password = filter_input(INPUT_POST, 'password');

//         //zapytanie do bazy danych i próba wyszukania użytkownika
//         $userQuery = $db->prepare("SELECT id, password FROM users WHERE login = :login");
//         $userQuery->bindValue(':login', $login, PDO::PARAM_STR);
//         $userQuery->execute();    

//         $user = $userQuery->fetch();

//         //sprawdzanie zgodności hasła i przypisywanie id użytkowniak do sesji
//         if($user && password_verify($password, $user['password'])){
//             $_SESSION['logged_id'] = $user['id'];
//             unset($_SESSION['bad_attempt']);
//         }else {
//             $_SESSION['bad_attempt'] = true;
//             header('Location: index.php');
//             exit();
//         }

//     }else {
//          header('Location: index.php');
//          exit();
//      }

//     }




?>