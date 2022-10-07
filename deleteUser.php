<?php
require_once './dbconnection.php';

$id = $_GET["id"];

// echo $id;

// $sql_fetchOrderItems="SELECT * FROM orders Where user_id = $id";
// $getData=$conn->query($sql_fetchOrderItems);
// $order_id=$getData->fetchAll(PDO::FETCH_OBJ);

// print_r($order_id);
   
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
    

    $sql = "DELETE FROM users where id = :id";
$query = $conn->prepare($sql);
$query->bindParam(":id", $id, PDO::PARAM_STR);
$query->execute();




   
    
 
header("Location:users.php");
// try{
  


// }
// catch(PDOException $e){ 

   
   

//     // header("Location: admin.php");
// // echo 'erooooooooooooorr'. $e->getMessage();
// }
?>