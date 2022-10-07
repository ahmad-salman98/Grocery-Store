<?php
require("connection.php");
$order_id = $_GET['order_id'];

session_start();

$id = $_SESSION['id'];


$sql = "SELECT * FROM users where id=$id";

$stmt = $conn->query($sql);

$result = $stmt->fetch(PDO::FETCH_OBJ);

$sql2 = "SELECT * FROM orders where user_id = $id ";
$stmt2 = $conn->query($sql2);
$orders = $stmt2->fetchAll(PDO::FETCH_ASSOC);
// print_r($result2);

$sql3 = "SELECT * FROM order_items JOIN orders ON order_items.order_id = orders.id";
$result3 = $conn->query($sql3);
$order_details = $result3->fetchAll(PDO::FETCH_OBJ);
// print_r($order_details);

$sql4 = "SELECT DISTINCT * FROM order_items  JOIN products ON order_items.order_id = products.id";
$result4 = $conn->query($sql4);
$order_details2 = $result4->fetchAll(PDO::FETCH_OBJ);

$order_details3 = array_merge($order_details, $order_details2);


$sql5 = "SELECT order_id, product_id, SUM(quantity) AS sum_quantity FROM order_items GROUP BY order_id,product_id ";
$stmt = $conn->query($sql5);
$orders_quantity = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<table>
    <tr>
        <th>Image</th>
        <th>Name</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Total</th>
    </tr>

    <?php


    foreach ($orders_quantity as $order) {
        if ($order['order_id'] == $order_id) {
            $product_id = $order['product_id'];
            $quantity = $order['sum_quantity'];

            $sql = "  SELECT * FROM products where id = $product_id";
            $stmt = $conn->query($sql);
            $product = $stmt->fetch(PDO::FETCH_ASSOC);

            $name = $product['name'];
            $image = $product['image'];
            $price = $product['price'];
            $discount = $product['discount'];
            $total = $quantity * ($price * (100 - $price) / 100);
    ?>
            <tr>
                <td><img width="100px" height="100px" style=' width:110px, height:110px' src=' <?php echo $image ?>'> </td>
                <td> <?php echo $name ?></td>
                <td> <?php echo $price ?></td>
                <td> <?php echo $quantity ?></td>
            </tr>
        <?php
        }
        ?>
</table>
<?php
    }
