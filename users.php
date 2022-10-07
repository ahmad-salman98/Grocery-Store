<!DOCTYPE html>
<html>
<?php
require_once('dbconnection.php');

require_once('includes/links.php');

$sql_user="SELECT * FROM users";

$getUserData= $conn->query($sql_user);
$users=$getUserData->fetchAll(PDO::FETCH_OBJ);
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
                            <span>All Users Information</span>
                            <span class="float-right">
                                <a href="addUser.php" class="btn btn-secondary btn-sm">Add User</a>
                            </span>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Email</th>
                                        <th>Name</th>
                                        <th>Edit</th>
                                        <th>Delete</th>

                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
    foreach($users as $user){
// print_r($user);
$id=$user->id;
// echo $id;
    
    ?>
          <tr>
          <td><?php echo $user->email;?></td>
             
              <td><?php echo $user->name;?></td>
              <td>
                <a href="update_user.php?id=<?php echo $id;?>">  
              <i class="fa-solid fa-user-pen" ></i></a> </td>
              <td>
              <a href="deleteUser.php?id=<?php echo $user->id;?>">  
              <!-- <i class="fa-sharp fa-solid fa-trash"></i> -->
              <lord-icon
    src="https://cdn.lordicon.com/jmkrnisz.json"
    trigger="hover"
    colors="primary:#c71f16"
    state="hover-empty"
    style="width:32px;height:32px">
</lord-icon>
            </a></td>
            
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