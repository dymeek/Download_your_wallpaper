<?php

function get_wallpapers() {
    $wallpapersJson = file_get_contents('data/wallpapers.json');
    $wallpapers = json_decode($wallpapersJson, true);

    return $wallpapers;

}