<!DOCTYPE html>
<html>
<?php
   require_once('includes/links.php');
?>
<body>

	<?php
      require_once('includes/header.php');
      require_once('includes/sidebar.php');

      //Fetch students racords using WHERE CLAUSE
      require_once('dbconnection.php');


    $id=$_GET["id"];// get id from url always use _get


$sql="SELECT * FROM users WHERE id=$id";

$getData= $conn->query($sql);
$user=$getData->fetch(PDO::FETCH_OBJ);

// print_r($user);
    ?>  
	

   
	
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-dark text-white text-centre">
                            <span>Update User</span>
                        </div>
                        <div class="card-body">
                            <form  method="post">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="name">First Name</label>
                                            <input type="text" class="form-control" name="name" value="<?php echo $user->name;?>"   >
                                        </div>
                                    </div>

                                    
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="phone">Phone<small>(optional)</small></label>
                                            <input type="tel" class="form-control" name="phone" value="<?php echo $user->phone;?>"  >
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" name="email" value="<?php echo $user->email;?>"   >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="phone">Address<small>(optional)</small></label>
                                            <input type="tel" class="form-control" name="address" value="<?php echo $user->address;?>"   >
                                        </div>
                                    </div>

                                    <div class="col-lg-6 pt-4">
                                        <div class="form-group">
                                            <label for="phone">Role<small>(optional)</small></label>
                                            <select name="role" >
                                            <option value="<?php echo $user->role;?>" selected='true' disabled></option>
                                            <option value="user" >user</option>
                                            <option value="admin" >admin</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="pwd">Password</label>
                                            <input type="password" class="form-control" name="pwd" >
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="pwd-confirm">Confirm Password</label>
                                            <input type="password" class="form-control" name="pwd-confirm" >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <button type="submit" name="update_user"
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

    if(isset($_POST['update_user']))
  {
      // echo 'ggggggggggggggggggg';
  try { $name=$_POST['name'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $address=$_POST['address'];
    $pwd=$_POST['pwd'];
  
    $sql="UPDATE users 
    SET name=:name,email=:email,phone=:phone,pass=:pass,address=:address 
    WHERE id=$id";
   
    $stmt=$conn->prepare($sql);
    $stmt->bindParam(':name',$name,PDO::PARAM_STR);
    $stmt->bindParam(':email',$email,PDO::PARAM_STR);
    $stmt->bindParam(':phone',$phone,PDO::PARAM_STR);
    $stmt->bindParam(':address',$address,PDO::PARAM_STR);
    $stmt->bindParam(':pass',$pwd,PDO::PARAM_STR);
  //   $stmt->bindParam(':id',$user->id,PDO::PARAM_STR);
  
    $stmt->execute();
    // header("location: users.php");}
  }
 catch(PDOException $e){
        echo $e->getMessage();
      }
          }
  
 
     
       ?>
	
<script src="jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/8b42dcad4f.js" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>
</html>