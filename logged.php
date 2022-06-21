<?php

 session_start();
 
 require_once 'database.php';

 if(!isset($_SESSION['logged_id'])){

     if(isset($_POST['login'])){

        //pobieranie danych z pola logowania
        $login = filter_input(INPUT_POST, 'login');
        $password = filter_input(INPUT_POST, 'password');

        //zapytanie do bazy danych i próba wyszukania użytkownika
        $userQuery = $db->prepare('SELECT id, password FROM users WHERE login = :login');
        $userQuery->bindValue(':login', $login, PDO::PARAM_STR);
        $userQuery->execute();    

        //  echo $login . " " . $password;

        $user = $userQuery->fetch();

        if($user && password_verify($password, $user['password'])){
            $_SESSION['logged_id'] = $user['id'];
            unset($_SESSION['bad_attempt']);
        }else {
            $_SESSION['bad_attempt'] = true;
            header('Location: index.php');
            exit();
        }

    }else {
         header('Location: index.php');
         exit();
     }

    }




?>