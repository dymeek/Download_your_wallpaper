<?php 

require "database.php";
require 'lib/functions.php';
$users = get_users();

// koniecznie dodać sprawdzenie warunków -> czy istnieje taki użytkownik i czy hasła się nie różnią 
$err_msg = '';

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

                $sql ="INSERT INTO users (id, login, password, data) VALUES (NULL, :userLogin, :passOne, :addDate)";
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
            <input class="btn btn-primary m-3 ps-5 pe-5" type="submit" name="submitOne" value="Dodaj">
            <div class="form status text-danger">
                <?php echo $err_msg; ?>
            </div>
        </form>
    </div>

    <div class="container">
    <h2 class="text-center">Lista użytkowników</h2>
    <div class="table-responsive">
        <table class="table table-bordered">
        <thead>
            <tr>
            <th scope="col">ID</th>
            <th scope="col">Data dodania</th>
            <th scope="col">Kategoria</th>
            <th scope="col">Edytuj</th>
            <th scope="col">Usuń</th>
            </tr>
            <tr>
        <?php foreach($users as $user) { ?>        
        <th scope="row"><?php  echo $user['id']; ?></th>        
         <td><?php echo $user['date']; ?></td>
         <td><?php echo $user['login']; ?></td>
         <td>Edytuj</td>
         <td>Usuń</td>
        </tr>
            <?php } ?>
        </thead>
        <tbody>

        </table>
    </div>
</div>

<?php require 'layout/footer.php'; ?>
