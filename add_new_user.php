<?php 

require "database.php";
require 'lib/functions.php';
$users = get_users();


$err_msg = '';

    //dodowanie elementów do tablicy
    if(isset($_POST['submit'])){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $userLogin = $_POST['userLogin'];
            $passOne = $_POST['passOne'];    
            $passTwo = $_POST['passTwo'];
            $addDate = $_POST['addDate'];

            if(empty($userLogin) || empty($passOne) || empty($addDate) ){
                    $err_msg = "Wszystkie pola muszą być uzupełnione";
            }else {
                if(strlen($userLogin) >= 20 || !preg_match("/^[a-zA-Z-'\s]+$/", $userLogin)){
                    $err_msg = "Podaj prawidłowy login";
                }else if($passOne !== $passTwo) {
                    $err_msg = "Podane hasła muszą być identyczne";
                }else {

                    $sql ="INSERT INTO users (id, login, password, date) VALUES (NULL, :userLogin, :passOne, :addDate)";
                    $stmt = $db->prepare($sql);
                    $stmt->execute(['userLogin' => $userLogin, 'passOne' => $passOne, 'addDate' => $addDate]); 

                    $err_msg = "Użytkownik został dodany";
                    $userLogin = "";
                    $passOne = "";    
                    $passTwo = "";
                    $addDate = "";
                }
            }
        }
    }

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

    <div class="container">
        <h2 class="text-center">Dodaj nowego użytkownika</h2>
        <form action="" method="post">
            <div class="mb-3">
                <label class="form-label">Nazwa użytkownika:</label>
                <input class="form-control" type="text" name="userLogin" id="userLogin" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST') echo $userLogin; ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Hasło:</label>
                <input class="form-control" type="password" name="passOne" id="passOne" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST') echo $passOne; ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Powtórz hasło:</label>
                <input class="form-control" type="password" name="passTwo" id="passTwo" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST') echo $passTwo; ?>">
            </div>
            <div>
                <labelclass="form-label">Data dodania:</label>
                <input class="form-control" type="date" name="addDate" id="addDate">
            </div>
                <input class="btn btn-primary m-3 ps-5 pe-5" type="submit" name="submit" value="Dodaj">
            <div class="form status text-danger">
                <?php echo $err_msg; ?>
            </div>
        </form>
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
