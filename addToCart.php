<?php
require_once("connection.php");
session_start();
if (isset($_SESSION['id'])) {
  $user_id = $_SESSION['id'];
} else {
  $user_id = 0;
}

if (isset($_GET['id'])) {
  if (isset($_GET['quantity'])) {
    $quantity = $_GET['quantity'];
  } else {
    $quantity = 1;
  }


  // global $conn;
  $id = $_GET['id'];
  $sql = "SELECT * FROM products WHERE id = $id";
  $stmt = $conn->query($sql);
  $item = $stmt->fetch(PDO::FETCH_ASSOC);
  $total = $item['price'] * $quantity;

  $sql2 = "INSERT INTO cart ( user_id, products_id , quantity, total)
  VALUES ($user_id,$id, $quantity, $total)";
  $conn->exec($sql2);
  
  header("Location:http://localhost/ecommerce/shop.php");
}

if (isset($_POST['updateCart'])) {
  $sql = "SELECT * FROM cart where user_id = $user_id";
  $stmt = $conn->query($sql);
  $cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);


  foreach ($cart_items as $item) {

    $cart_id = $item['cart_id'];
    $quantity = $_POST["quantity_$cart_id"];
    $price = $_POST["price_$cart_id"];
    $new_total = $_POST["new_total_$cart_id"];
    $sql = "UPDATE cart SET quantity=$quantity, total = $new_total WHERE cart_id = $cart_id";
    $conn->query($sql);
  }

  header("Location:shoping-cart.php");
}
if (isset($_GET["delete"])) {
  $item_id = $_GET["delete"];
  $sql = "DELETE FROM cart WHERE cart_id = $item_id";
  $conn->exec($sql);
  header("Location:shoping-cart.php");
}


if (isset($_GET['logout'])) {
  session_destroy();
  header("Location:http://localhost/ecommerce/index.php");
}
