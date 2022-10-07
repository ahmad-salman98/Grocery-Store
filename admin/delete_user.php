<?php
require_once './dbConnection.php';

$id = $_REQUEST["id"];

// echo $id;

// $sql_fetchOrderItems="SELECT * FROM orders Where user_id = $id";
// $getData=$conn->query($sql_fetchOrderItems);
// $order_id=$getData->fetchAll(PDO::FETCH_OBJ);

// print_r($order_id);

try{
  
   

    

    $sql = "DELETE FROM users where id = :id";
$query = $conn->prepare($sql);
$query->bindParam(":id", $id, PDO::PARAM_STR);
$query->execute();




   
    
 
header("Location: admin.php");

}
catch(PDOException $e){ 

   
    $sql_fetchOrderItems="SELECT * FROM orders Where user_id = $id";
    $getData=$conn->query($sql_fetchOrderItems);
    $order_id=$getData->fetch(PDO::FETCH_OBJ);


     $sql_orderitems = "DELETE FROM order_items where order_id = :id";
    $stmt2 = $conn->prepare($sql_orderitems);
    $stmt2->bindParam(":id",$order_id->id , PDO::PARAM_STR);
    $stmt2->execute(); 
    
   $sql_order = "DELETE FROM orders where user_id = :id";
    $stmt = $conn->prepare($sql_order);
    $stmt->bindParam(":id", $id, PDO::PARAM_STR);
    $stmt->execute();

    // header("Location: admin.php");
// echo 'erooooooooooooorr'. $e->getMessage();
}
?>