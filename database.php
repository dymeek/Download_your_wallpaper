<?php

$config = require "config.php";


try{
    //połączenie z bazą danych - $db - database
    $db = new PDO ("mysql:host={$config['host']};dbname{$config['database']};charset=utf8",$config['user'],$config['password']);
    
    // ,     [PDO::ATTR_EMULATE_PREPARES => false,PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


} catch(PDOException $error) {
    echo $error->getMessage();
    exit('Database error');
}