<?php

require 'config.php';


try{
    //połączenie z bazą danych - $db - database
    $db = new PDO("mysql:host=$host;dbname=$database", $user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


} catch(PDOException $error) {
     echo $error->getMessage();
    exit('Database error');
}