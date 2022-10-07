<!DOCTYPE html>
<html>
<?php
require_once('includes/links.php');
?>

<body>


    <?php
require_once('includes/header.php');
require_once('includes/sidebar.php');

//Submit user data to database
//1. db connection
require_once('dbconnection.php');

?>

    <div class="main-content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-dark text-white text-centre">
                            <span>Add User</span>
                        </div>
                        <div class="card-body">
                            <form action="addUser.php" method="post">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="fname">First Name</label>
                                            <input type="text" class="form-control" name="fname" id="">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="lname">Last Name</label>
                                            <input type="text" class="form-control" name="lname" id="">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="phone">Phone<small>(optional)</small></label>
                                            <input type="tel" class="form-control" name="phone" id="">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" name="email" id="">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="phone">Address<small>(optional)</small></label>
                                            <input type="tel" class="form-control" name="address" id="">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 pt-4">
                                        <div class="form-group">
                                            <label for="phone">Role<small>(optional)</small></label>
                                            <select name="role" id="">
                                            <option value="admin">admin</option>
                                            <option value="user" >user</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="pwd">Password</label>
                                            <input type="password" class="form-control" name="pwd" id="">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="pwd-confirm">Confirm Password</label>
                                            <input type="password" class="form-control" name="pwd-confirm" id="">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <button type="submit" name="add_user"
                                                class="btn btn-success">Submit</button>
                                        </div>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>


            </div>


        </div>

    </div>
    <!-- All our code. write here   -->
    <?php 

if(isset($_POST['add_user']))
{
  $name=$_POST['fname'].' '.$_POST['lname'];
  $email=$_POST['email'];
if(!empty($_POST['phone']))
{ $phone=$_POST['phone'];
} 
else{
    $phone='0770700820';   
}
if(empty($_POST['address']))
{$address=$_POST['address'];
} 
else{
    $address='zarqa';
}
$role=$_POST['role'];
  $pwd=$_POST['pwd'];


  $sql="INSERT INTO users (name, email,phone ,pass,address,role)
   VALUES (:name,:email,:phone,:pwd,:address,:role)";
 
  $stmt=$conn->prepare($sql);
  $stmt->bindParam(':name',$name,PDO::PARAM_STR);
  $stmt->bindParam(':email',$email,PDO::PARAM_STR);
  $stmt->bindParam(':phone',$phone,PDO::PARAM_STR);
  $stmt->bindParam(':pwd',$pwd,PDO::PARAM_STR);
  $stmt->bindParam(':address',$address,PDO::PARAM_STR);
  $stmt->bindParam(':role',$role,PDO::PARAM_STR);
//   $stmt->bindParam(':id',$user->id,PDO::PARAM_STR);

  $stmt->execute();
  // header("location: admin.php");

}

?>



    <script src="jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/8b42dcad4f.js" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8"
        crossorigin="anonymous"></script>
</body>

</html>