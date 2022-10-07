<!DOCTYPE html>
<html>
<?php
require_once('dbconnection.php');

require_once('includes/links.php');

$sql_order="SELECT orders.id,users.email,orders.currentdate, orders.status FROM orders JOIN users WHERE orders.user_id =users.id";

$getorderData= $conn->query($sql_order);
$orders=$getorderData->fetchAll(PDO::FETCH_OBJ);
?>

<body>


    <?php
require_once('includes/header.php');
require_once('includes/sidebar.php');

//fetch all user records
//1. database connection
//   $fetchEnrolledStudents = mysqli_query($conn,"SELECT * FROM enrollments");
?>

    <div class="main-content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-dark text-white text-centre">
                            <span>All Orders Information</span>
                            <!-- <span class="float-right">
                                <a href="addUser.php" class="btn btn-secondary btn-sm">Add User</a>
                            </span> -->
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                    <th>Email</th>
              <th>ID</th>
              <th>Date</th>
              <!-- <th>Approve</th> -->

                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
    foreach($orders as $order){
// print_r($user);
// $id=$user->id;
// echo $id;
    
    ?>
          <tr>
                  <td><?php echo $order->email; ?></td>
                  <td><a href="./retriveOrderDetails.php?id=<?php echo $order->id;  ?>"><?php echo $order->id; ?></a> </td>
                  <td><?php echo $order->currentdate; ?> </td>
                  <td> </td>
                  <td><?php
                      // Usage of if-else statement to translate the 
                      // tinyint status value into some common terms
                      // 0-Inactive
                      // 1-Active
                      if ($order->status == 1)
                        echo "Active";
                      else
                        echo "Inactive";
                      ?>
                  </td>
                  <td>
                    <?php
                    if ($order->status == 1)

                      // if a course is active i.e. status is 1 
                      // the toggle button must be able to deactivate 
                      // we echo the hyperlink to the page "deactivate.php"
                      // in order to make it look like a button
                      // we use the appropriate css
                      // red-deactivate
                      // green- activate
                      echo
                      "<a href=./deactivate.php?id=" . $order->id . " class='btn btn-danger'>Deactivate</a>";
                    else
                      echo
                      "<a href=./activate.php?id=" . $order->id . " class='btn btn-alert'>Activate</a>";
                    ?>
                </tr>

            <?php }?>
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