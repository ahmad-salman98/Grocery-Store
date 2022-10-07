<?php

require_once './connection.php';
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



// var_dump($order_details2);

// print_r($order_details3);






?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ecommerce</title>
  <link rel="stylesheet" href="./profile/profile.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
  <div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
      <div class="col-md-3 border-right">
        <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
          <span class="font-weight-bold"><?php echo $result->name; ?></span>
          <span class="text-black-50"><?php echo $result->email; ?></span>
          <button id="logout" class="btn btn-danger border px-3 p-1  mt-3"><i class="fa fa-plus"></i>&nbsp;Logout</span></button>
        </div>
      </div>
      <div class="col-md-5 border-right">
        <!-- <div class="profile" style=''> -->
        <div class="p-3 py-5">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="text-right">Profile Settings</h4>

          </div>
          <form method="post">
            <div class="row mt-2">
              <div class="col-md-12"><label class="labels">Name</label><input name="name" type="text" class="form-control" placeholder="Full Name" value="<?php echo $result->name; ?>"></div>
            </div>
            <div class="row mt-3">
              <div class="col-md-12"><label class="labels">Email ID</label><input name="email" type="text" class="form-control" placeholder="Add Email" value="<?php echo $result->email; ?>" required></div>
              <div class="col-md-12"><label class="labels">Phone</label><input name="phone" type="tel" class="form-control" placeholder="Add Phone Number" value="<?php echo $result->phone; ?>" required></div>
              <div class="col-md-12"><label class="labels">Address</label><input name="address" type="text" class="form-control" placeholder="AddAddress" value="<?php echo $result->address; ?>" required></div>
              <div class="col-md-12"><label class="labels">Password</label><input name="password" type="password" class="form-control" placeholder="Edit Password" value="<?php echo $result->pass; ?>" required></div>
            </div>
            <div class="mt-5 text-center">
              <button class="btn btn-success border px-3 p-1" name="submit" type="submit"><i class="fa fa-plus"></i>&nbsp;Update Profile</span></button>
            </div>

        </div>

        <input type="hidden" name="id" value="<?php echo $result->id ?>">
        </form>

      </div>



      <div class="col-md-4">
        <div class="p-3 py-5">
          <div class="d-flex justify-content-between align-items-center experience">
            <h4>Previous Orders</h4>
          </div>

          <br>


          <table class="table">
            <thead class="table-dark">
              <tr>
                <th>Order ID</th>
                <th>Amount</th>
                <th>Date</th>
                <th>view details</th>
              </tr>
            </thead>


            <tbody>

              <?php
              foreach ($orders as $order) {
                $order_id = $order['id'];
                $id = $order['id'];
                $payment = $order['payment'];
                $date = $order['currentdate'];
                echo "<tr>";
                echo "   <td>$id</td>";
                echo "   <td>  $payment</td>";
                echo "   <td> $date</td>";
              ?>
                <td> <a type='button' class='btn btn-primary' href='./view_details.php?order_id=<?php echo $order_id ?>'>View Details</a></td>";
              <?php

                echo " </tr>";
              }
              ?>
            </tbody>
          </table>
        </div>



        </table>
      </div>
    </div>



    <?php
    if (isset($_POST["update"])) {
      $name = $_POST["name"];
      $email = $_POST["email"];
      $address = $_POST["address"];
      $phone = $_POST["phone"];
      $password = $_POST["password"];
      $id = $_POST["id"];


      $sql = "UPDATE users SET name=:name ,email=:email , address=:address , phone=:phone ,pass=:password   WHERE id=$id";
      echo "<meta http-equiv='refresh' content='0'>";

      // Prepare statement
      $stmt = $conn->prepare($sql);

      //bindparam//
      $stmt->bindParam(':name', $name, PDO::PARAM_STR);
      $stmt->bindParam(':email', $email, PDO::PARAM_STR);
      $stmt->bindParam(':address', $address, PDO::PARAM_STR);
      $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
      $stmt->bindParam(':password', $password, PDO::PARAM_STR);
      // $stmt->bindParam(':id',$id, PDO::PARAM_STR);

      // execute the query
      $stmt->execute();
    }

    ?>


  </div>



  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="./signup/js/app.logout.js"></script>
</body>

</html>