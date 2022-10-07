
<?php

require_once './dbConnection.php';



?>


<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="../admin/styleAdmin.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
<style> 

  form {
        margin: 100px;
      }
      .input-field {
        position: relative;
        width: 250px;
        height: 44px;
        line-height: 44px;
        margin-top: 70px;
    
      }
      label {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        color: #d3d3d3;
        transition: 0.2s all;
        cursor: text;
      }
      input {
        width: 100%;
        border: 0;
        outline: 0;
        padding: 0.5rem 0;
        border-bottom: 2px solid #d3d3d3;
        box-shadow: none;
        color: #111;
      }
      input:invalid {
        outline: 0;
        /* color: #ff2300;
          border-color: #ff2300; */
      }
      input:focus,
      input:valid {
        border-color: #00dd22;
      }
      input:focus~label,
      input:valid~label {
        font-size: 14px;
        top: -24px;
        color: #00dd22;
      }

</style>
    <title>Add User</title>
</head>
<body>
   
<div class="add-User-container">
  <div class="row add-User-Form">

   <div class="card-panel">

  <div class="row">
   
      <form  id="formLogon" class="col s12 m12 l12">
   <div class="row">
                    <div class="input-field col s6"   >
                        <input type="text" name="fname" id="fname" autocomplete="off" required> 
                        <label for="fname">First Name</label>

                    </div>
                  
                    <div class="input-field col s6"   >
                        <input type="text" name="lname" id="lname" autocomplete="off" required> 
                        <label for="lname">Last Name</label>

                    </div> 
                </div>
                <div class="row">
                    <div class="input-field col s6"   >
                        <input type="email" name="email" id="email"autocomplete="off" required> 
                        <label for="email">Email</label>

                    </div>
                  
                    
                </div>

               
                <div class="row">
                    <div class="input-field col s6"   >
                        <input type="password" name="password"autocomplete="off"  id="pwd" required> 
                        <label for="password">Password</label>

                    </div>
                  
                    <div class="input-field col s6"   >
                        <input type="password" name="passwordRep" autocomplete="off" id="pwdRep" required> 
                        <label for="passwordRep">Repeate Password</label>

                    </div> 
                </div>
              
            </form>      </div>
    
      </div>
   </div>
            
          
              
  </div>

</div>
    




<!-- 
<div class="add-User-container">
  <div class="row add-User-Form">

   <div class="card-panel">
<h4 class="header2">
                New User
            </h4>
  <div class="row">
            <form  id="formLogon" class="col s12 m12 l12">
   <div class="row">
                    <div class="input-field col s6"   >
                        <input type="text" name="fname" id="fname" required> 
                        <label for="fname">First Name</label>

                    </div>
                  
                    <div class="input-field col s6"   >
                        <input type="text" name="lname" id="lname" required> 
                        <label for="lname">Last Name</label>

                    </div> 
                </div>
                <div class="row">
                    <div class="input-field col s6"   >
                        <input type="email" name="email" id="email" required> 
                        <label for="email">Email</label>

                    </div>
                  
                    
                </div>

                <div class="row">
                    <div class="input-field col s6"   >
                        <input type="text" name="address" id="address"> 
                        <label for="address">Address</label>

                    </div>
                  
                    <div class="input-field col s6"   >
                        <input type="text" name="phone" id="phone"> 
                        <label for="phone">Phone Number</label>

                    </div> 
                </div>
                
                <div class="row">
                    <div class="input-field col s6"   >
                        <input type="password" name="password" id="pwd" required> 
                        <label for="fname">Password</label>

                    </div>
                  
                    <div class="input-field col s6"   >
                        <input type="password" name="passwordRep" id="pwdRep" required> 
                        <label for="lname">Repeate Password</label>

                    </div> 
                </div>
              
            </form>
            
            </div>
   </div>
            
          
              
  </div>

</div> -->
      
<!-- ///////////////////// SCRIPTS ///////////////////// -->
<script src="./dashboardJs.js"> </script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/8b42dcad4f.js" crossorigin="anonymous"></script>
</body>
</html>
<?php 

if(isset($_POST['add_user']))
{
    // echo 'ggggggggggggggggggg';
  $name=$_POST['name'];
  $email=$_POST['email'];
  $phone=$_POST['phone'];
  $address=$_POST['address'];
  $pwd=$_POST['pwd'];


  $sql="INSERT INTO users (name, email, phone ,pass,address) VALUES (:name,:email,:phone,:pwd,:address)";
 
  $stmt=$conn->prepare($sql);
  $stmt->bindParam(':name',$name,PDO::PARAM_STR);
  $stmt->bindParam(':email',$email,PDO::PARAM_STR);
  $stmt->bindParam(':phone',$phone,PDO::PARAM_STR);
  $stmt->bindParam(':pwd',$pwd,PDO::PARAM_STR);
  $stmt->bindParam(':address',$address,PDO::PARAM_STR);
//   $stmt->bindParam(':id',$user->id,PDO::PARAM_STR);

  $stmt->execute();
  header("location: admin.php");

}

?>