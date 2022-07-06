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
    $query = 'SELECT * FROM wallpapers ORDER BY height DESC ';
    if($limit !== 0){
        $query = $query . ' LIMIT ' . $limit;
    }

    $wallpaper_fetch = $db->query($query);
    $high_res_wallpaper = $wallpaper_fetch->fetchAll();    

    return $high_res_wallpaper;
}

function get_category() {
    require 'database.php';
    $query = 'SELECT * FROM categories';

    $categories = $db->query($query);
    $category = $categories->fetchAll();

    return $category;

}

function get_wallpaper_by_category($category) {
    require 'database.php';
    $query = 'SELECT * FROM wallpapers, categories WHERE wallpapers.category = categories.category AND categories.category = ';
    if($query !== 0){
        $query = $query . ' "' . $category . '"';
    }
    

    $categories = $db->query($query);
    $wallpapers_by_category = $categories->fetchAll();


    return $wallpapers_by_category;
}

function get_users() {
    require 'database.php';   

    $users = $db->query('SELECT * FROM users');
    $user = $users->fetchAll();

    return $user;

}

