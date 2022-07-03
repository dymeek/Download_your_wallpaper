<?php

require 'database.php';
require 'lib/functions.php';
$categories = get_category();

//dodowanie elemnetu do tablicy
$err_msg = '';
if(isset($_POST['submit'])){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $new_category = $_POST['new_category'];
        if(empty($_POST['new_category'])){
            $err_msg = "Pole kategorii musi być wypłenione";
        }else {

            $sql ="INSERT INTO categories (category_id, category) VALUES (NULL, :new_category)";
            $stmt = $db->prepare($sql);
            $stmt->bindParam('new_category', $new_category);
            $stmt->execute(); 

        }  
    } 
}



?>

<?php require 'layout/header_log.php'; ?>


<div class="container">        
<h2 class="text-center">Dodaj nową kategorię</h2>
        <form action="" method="post">
            <div class="mb-3">
            <label class="form-label">Nazwa kategorii:</label>
            <input class="form-control" type="text" name="new_category" >
            </div>
            <input class="btn btn-primary m-3 ps-5 pe-5" type="submit" name="submit" value="Dodaj">
            <div class="form status text-danger">
                <?php echo $err_msg; ?>
            </div>
        </form>
    </div>

<div class="container">
    <div class="table-responsive">
    <h2 class="text-center">Lista dostępnych kategorii</h2>
            <table class="table table-bordered">
                <thead>
                <tr>
                <th scope="col" class="text-center">ID</th>
                <th scope="col" class="text-center">Kategoria</th>
                </tr>
                <tr>
            <?php foreach($categories as $category) { ?>             
                <th scope="row" class="text-center"><?php  echo $category['category_id']; ?></th>      
                <td class="text-center"><?php echo $category['category']; ?></td>
                </tr>
                <?php } ?>           
                </thead>
            <tbody>
            </table>
    </div>
</div>


<?php require 'layout/footer.php'; ?>