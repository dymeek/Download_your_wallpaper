<?php 

require "database.php";
require 'lib/functions.php';
$users = get_users();


$err_msg = '';

    $del_msg = '';
    //usuwanie elementu z tablicy
    if(isset($_REQUEST['delete'])){

        $id = $_REQUEST['id'];

        $sql = "DELETE FROM users WHERE id = :id";
        $result = $db->prepare($sql);
        $result->bindParam('id', $id);
        $result->execute();

        $del_msg = $result->rowCount() . " Wiersz usunięty<br>";

        unset($result);

    }

    //edycja elementu
    $ed_msg = "";
    if(isset($_REQUEST['edit'])){
        $id = $_REQUEST['id'];
        $login = $_REQUEST['login_update'];

        $sql = "UPDATE users SET login = :login WHERE id = :id";

        $result = $db->prepare($sql);
        $result->bindParam('login', $login);
        $result->bindParam('id', $id);
        $result->execute();

        $ed_msg = $result->rowCount() . " Wiersz uaktualniony!<br>";

        unset($result);   

}

?> 
 

<?php 

require 'layout/header_log.php';
?>

<div class="container d-flex justify-content-center mb-3 mt-3">
    <a href="add_new_user.php"  class="btn btn-success text-center">Dodaj użytkownika</a>
</div>

    <div class="container">
    <h2 class="text-center">Lista użytkowników</h2>    
    <?php $del_msg; ?>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                <th scope="col" class="text-center">ID</th>
                <th scope="col" class="text-center">Data dodania</th>
                <th scope="col" class="text-center">Kategoria</th>
                <th scope="col" class="text-center">Edytuj</th>
                <th scope="col" class="text-center">Usuń</th>
                </tr>
                <tr>
                <?php foreach($users as $user) { ?>      
                <form action="" method="POST">
                <th scope="row" class="text-center"><?php  echo $user['id']; ?></th>        
                <td class="text-center"><?php echo $user['date']; ?></td>
                <td class="text-center"><input type="text" name="login_update" value="<?php echo $user['login']; ?>"></td>         
                <td class="text-center"><input type="hidden" name="id" value="<?php echo $user['id']; ?>"><input type="submit"
                class="btn btn-success" name="edit" value="Edytuj"></form></td>         
                <td class="text-center"><form action="" method="POST"><input type="hidden" name="id" value="<?php echo $user['id']; ?>"><input type="submit"
                class="btn btn-danger" name="delete" value="Usuń"></form></td>
                </tr>
                    <?php } ?>
            </thead>
        <tbody>

        </table>
    </div>
</div>

<?php require 'layout/footer.php'; ?>
