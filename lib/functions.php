<?php
require './database.php';

/**
 * This is a function which get all wallpaper and  details from database
 * 
 * function has no paramaters
 * @return  array details of wallpapers
 * @author P.D
 */

function get_wallpapers() {
    require './database.php';

    $wallpaper_fetch = $db->query('SELECT * FROM wallpapers');
    $wallpapers = $wallpaper_fetch->fetchAll();

    return $wallpapers;

}

/**
 * This is a function which get wallpaper and details by id from database
 * 
 * @param int $id first parameter
 * @return array details of wallpapers
 * @author P.D
 */

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

/**
 * This is a function which get wallpapers from database by date of upload to database
 * 
 * @param int $limit first parameter
 * @return array list of wallpapers limited by $limit
 * @author P.D
 */

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

/**
 * This is a function which get wallpapers from database by reslution
 * 
 * @param int $limit first parameter
 * @return array list of wallpaper limited by $limit
 * @author P.D
 */

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

/**
 * This is a function which get list of categories from database
 * 
 * function has no parameteres
 * @return array list of categories
 * @author P.D
 */

function get_category() {
    require 'database.php';
    $query = 'SELECT * FROM categories';

    $categories = $db->query($query);
    $category = $categories->fetchAll();

    return $category;

}
/**
 * This is a function which get category from database
 * 
 * @param string $category
 * @return  array category specified by $category
 * @author P.D
 */

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

/**
 * This is a function which get list of users from database
 * 
 * function has no paramaters
 * @return array list of users
 * @author P.D
 */

function get_users() {
    require 'database.php';   

    $users = $db->query('SELECT * FROM users');
    $user = $users->fetchAll();

    return $user;

}

/**
 * This is a function which get user from database by $id
 * 
 * @param int $id
 * @return array specified user by $id
 * @author P.D
 */

function get_users_by_id($id) {
    require 'database.php';
    
    $query = 'SELECT * FROM users WHERE id = ';
    if($query !== 0) {
        $query = $query . $id;

    }
    $user_fetch = $db->query($query);
    $user = $user_fetch->fetchAll();

    return $user;

}

