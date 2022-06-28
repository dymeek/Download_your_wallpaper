<?php
require './database.php';

function get_wallpapers() {
    require './database.php';

    $wallpaper_fetch = $db->query('SELECT * FROM wallpapers');
    $wallpapers = $wallpaper_fetch->fetchAll();
    // $wallpapersJson = file_get_contents('data/wallpapers.json');
    // $wallpapers = json_decode($wallpapersJson, true);

    return $wallpapers;

}

function get_wallpaper($id) {
    require 'database.php';
    
    $query = 'SELECT * FROM wallpapers WHERE id = ';
    if($query !== 0) {
        $query = $query . $id;

    }
    $wallpaper_fetch = $db->query($query);
    $wallpaper = $wallpaper_fetch->fetchAll();

    return $wallpaper;

}

function get_newest_wallpapers($limit) {
    require 'database.php';

    $query = 'SELECT * FROM wallpapers ORDER BY date DESC ';
    if($query !== 0){
        $query = $query . " LIMIT " . $limit;
    }

    $wallpaper_fetch  =$db->query($query);
    $newest_wallpapers = $wallpaper_fetch->fetchAll();

    return $newest_wallpapers;
}

function get_high_res_wallpaper($limit){
    require 'database.php';
    $query = 'SELECT * FROM wallpapers ORDER BY resolution DESC ';
    if($limit !== 0){
        $query = $query . ' LIMIT ' . $limit;
    }

    $wallpaper_fetch = $db->query($query);
    $high_res_wallpaper = $wallpaper_fetch->fetchAll();

    return $high_res_wallpaper;
}