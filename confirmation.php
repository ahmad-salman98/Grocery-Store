<?php
session_start();
$user_id = $_SESSION['id'];

require_once 'connection.php';
$id = $_POST['id'];
$name = $_POST['fullName'];
$phone = $_POST['phone'];
$address = $_POST['address1'];

$sql = "UPDATE users 
      SET phone=:phone,address=:address 
      WHERE id=$id";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
$stmt->bindParam(':address', $address, PDO::PARAM_STR);
//   $stmt->bindParam(':id',$user->id,PDO::PARAM_STR);

$stmt->execute();
// header("location: admin.php");



$total = $_POST['totalsum'];

$sql = "INSERT INTO orders( `payment`, `user_id`) VALUES ($total,$id)";
$stmt = $conn->prepare($sql);
$stmt->execute();


$sql = "SELECT `cart`.`products_id`, `cart`.`quantity`, `cart`.`total`,
`products`.`name`, `products`.`price`, `products`.`discount`
FROM `products` 
JOIN `cart` 
ON products.id = cart.products_id
where user_id=$user_id";
// Cart information sql select statement 
$stmt2 = $conn->query($sql);

$resultcart = $stmt2->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT id FROM orders ORDER BY id DESC LIMIT 1";
$stmt2 = $conn->query($sql);
$order_id = $stmt2->fetch(PDO::FETCH_ASSOC);

$orderid = $order_id['id'];
foreach ($resultcart as $key) {
  $quantity = $key['quantity'];
  $product_id = $key['products_id'];

  $sql2 = "INSERT INTO `order_items`(`order_id`, `product_id`, `quantity`) VALUES ($orderid,$product_id,$quantity)";
  $conn->query($sql2);
}









// $sql_cart = "SELECT DiSTINCT `cart.*, orders.id FROM `cart` , `orders` WHERE cart.user_id= $user_id";
// $stmt2 = $conn->query($sql_cart);
// $result = $stmt2->fetchAll(PDO::FETCH_ASSOC);



//   // $result = json_decode(json_encode($resault_cart), true);
// var_dump($result);
//   $order_id = $result['id'];
//   $quantity = $result['quantity'];
//   $product_id = $result['products_id'];
//   $sql = "INSERT INTO `order_items`(`order_id`, `product_id`, `quantity`) VALUES ($order_id,$product_id,'$quantity')";
//   $stmt = $conn->prepare($sql);
//   $stmt->execute();


$sql = "DELETE FROM cart where user_id=$user_id";
$stmt = $conn->prepare($sql);
$stmt->execute();



header("location:index.php");
