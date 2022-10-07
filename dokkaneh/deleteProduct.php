<?php
require_once './dbconnection.php';

$id = $_REQUEST["id"];

try
{
$sql = "DELETE FROM products where id = :id";
$query = $conn->prepare($sql);
$query->bindParam(":id", $id, PDO::PARAM_STR);
$query->execute();


header("Location: products.php");
}
catch(PDOException $e){

    $sql_orderitems = "DELETE FROM order_items where product_id = :id";
    $stmt2 = $conn->prepare($sql_orderitems);
    $stmt2->bindParam(":id",$id , PDO::PARAM_STR);
    $stmt2->execute(); 
    // header("Location: admin.php");
    echo 'erooooooooooooorr'. $e->getMessage();


}
?>