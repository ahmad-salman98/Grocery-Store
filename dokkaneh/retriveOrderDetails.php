<?php
require_once('includes/links.php');
require_once('includes/header.php');
require_once('includes/sidebar.php');
require_once 'dbconnection.php';


 $id = $_GET['id'];
    $sql = " SELECT orders.*, order_items.*
    FROM orders
    LEFT JOIN  order_items
    ON  order_items.order_id =orders.id
    where order_items.order_id=$id";
    $stmt = $conn->query($sql);
    // var_dump($stmt);
    $orderdetails = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // var_dump($orderdetails);

// if (isset($_GET['id'])) {
   
// } else {
//     echo "Somthing went wrong";
//     // orderitems

// }

?>

<!DOCTYPE html>
<html lang="en">



<body>

<div class="main-content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-dark text-white text-centre">
                            <span>Order Details</span>
                            
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                    <th >user ID</th>
                    <th >Order ID</th>
                    <th >quantity</th>
                    <th >payment</th>
                    <th >status</th>

                    <th >Date Of Order</th>

                                    </tr>
                                </thead>
                                <tbody>
       
                                <?php foreach ($orderdetails as $order) { ?>
  <tr>
                    <th scope="row"><?= $order['user_id'] ?></th>

                    <td><?= $order['order_id'] ?></td>
                    <td><?= $order['quantity'] ?></td>
                    <td><?= $order['payment'] ?></td>
                    <td><?php
                        if ($order['status'] == 1) {
                            echo 'Not Confirmed';
                        } else {
                            echo 'Confirmed';
                        } ?></td>
                    <td><?= $order['currentdate'] ?></td>
                </tr>
          
        <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </div>


        </div>

    </div>
    <!-- All our code. write here   -->


    <script src="jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/8b42dcad4f.js" crossorigin="anonymous"></script>
    <script src="https://cdn.lordicon.com/pzdvqjsp.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8"
        crossorigin="anonymous"></script>
</body>

</html>