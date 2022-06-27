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