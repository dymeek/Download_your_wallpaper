<?php

require 'database.php';
require 'lib/functions.php';

$id = $_GET['id'];

$user = get_users_by_id($id);

$err_msg = '';
if(isset($_REQUEST['update'])){
    $id = $_REQUEST['id'];
    $login = $_REQUEST['update_login'];
    $password = $_REQUEST['password'];
    $new_password = $_REQUEST['new_password'];


    if($_REQUEST['update_login'] == "" ||  $_REQUEST['new_password'] == ""){
        $err_msg = 'Wszystkie pola muszą być uzupełnione!';
    } else if($_REQUEST['password'] == $_REQUEST['new_password']){
        $err_msg = 'Hasła nie mogą być takie same';
    }else {
        $sql = "UPDATE users SET login = :update_login, password = :new_password WHERE id = :id";

        $result = $db->prepare($sql);
        $result->bindParam('update_login', $login);
        $result->bindParam('new_password', $new_password);        
        $result->bindParam('id', $id);

        $result->execute();

        unset($result);
    }
} 
?>

<?php require 'layout/header_log.php'; ?>
<div class="container">
        <h2 class="text-center">Edytuj dane użytkownika!</h2>
        <?php foreach($user as $user) { ?>
        <form action="" method="POST">
            
            <div class="mb-3">
                <label class="form-label">Login:</label>
                <input class="form-control" type="text" name="update_login" id="update_login"
                value="<?php if(isset($user['login'])) { echo $user['login']; } ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Password:</label>
                <input class="form-control" type="password" name="password" id="password"
                value="<?php if(isset($user['password'])) { echo $user['password']; } ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Nowe hasło:</label>
                <input class="form-control" type="password" name="new_password" id="new_password">
            </div>
            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
            <input class="btn btn-success" type="submit" name="update" value="Update">          
            <p class="text-danger"><?php echo $err_msg; ?></p>
            
            
        </form>
        <?php } ?>
    </div>

    <?php require 'layout/footer.php'; ?>