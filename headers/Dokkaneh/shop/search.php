<?php
// include('../connection.php');

$searchErr = '';
$searched_prod = '';
$check = false;
$count = '';
$sort_prod= '';

if(isset($_POST['save'])){

    if(!empty($_POST['search'])){
        // Search
        $check = true;
        $search = $_POST['search']; 
        $stmt = $conn->prepare("SELECT * FROM products WHERE name LIKE '%$search%' or price LIKE '%$search%'");
        $stmt->execute();
        $searched_prod = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $count = $stmt->rowCount();

    } else{
        $searchErr = "Product Not Found";
    }                     
}
else if(isset($_REQUEST['sort'])){
    if($_REQUEST['sort'] == 'asc'){
        $stmt = $conn->prepare("SELECT * FROM `products` ORDER BY `products`.`price` ASC;");
        $stmt->execute();
        $sort_prod = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    } else if($_REQUEST['sort'] == "desc"){

        $stmt = $conn->prepare("SELECT * FROM products ORDER BY products.price DESC;");
        $stmt->execute();
        $sort_prod = $stmt->fetchAll(PDO::FETCH_ASSOC);

    }
}