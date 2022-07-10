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
            // $addDate = $_POST['addDate'];

            if(empty($userLogin) || empty($passOne) ){
                    $err_msg = "Wszystkie pola muszą być uzupełnione";
            }else {
                if(strlen($userLogin) >= 20 || !preg_match("/^[a-zA-Z-'\s]+$/", $userLogin)){
                    $err_msg = "Podaj prawidłowy login";
                }else if($passOne !== $passTwo) {
                    $err_msg = "Podane hasła muszą być identyczne";
                }else {

                    $sql ="INSERT INTO users (id, login, password) VALUES (NULL, :userLogin, :passOne)";
                    $stmt = $db->prepare($sql);
                    $stmt->execute(['userLogin' => $userLogin, 'passOne' => $passOne]); 

                    $err_msg = "Użytkownik został dodany";
                    $userLogin = "";
                    $passOne = "";    
                    $passTwo = "";
                    
                }
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
                <input class="btn btn-primary m-3 ps-5 pe-5" type="submit" name="submit" value="Dodaj">
            <div class="form status text-danger">
                <?php echo $err_msg; ?>
            </div>
        </form>
    </div>
   

<?php require 'layout/footer.php'; ?>
