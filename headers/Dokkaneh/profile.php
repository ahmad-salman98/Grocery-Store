<?php 

require_once './connection.php'; 

$id= $_GET['id'];

$sql = "SELECT * FROM users where id=$id" ;  

$stmt=$conn->query($sql);

$result = $stmt->fetch(PDO::FETCH_OBJ);                                                                                                                

$sql2 = "SELECT * FROM orders where user_id = 1" ;  

$stmt2=$conn->query($sql2);

$result2 = $stmt2->fetchAll(PDO::FETCH_OBJ); 
// print_r($result2);




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/a48380e5b0.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./profile.css">
    <style>
        
    </style>
</head>

<body>
    <h1>Profile</h1>
    <hr>
    <div class="profile" style=''>
        <ul class='buttons' style=''>
            <li class='profile_info' id='profile_button'>Profile</li>
            <li class='user_orders' id='orders_button'>Orders</li>
        </ul>
        <ul class="test" id="info" style='width:70%;'>
            <li class="profile_label"> 
            <div>Username</div>
            <div><?php echo $result->name;?></div>
            </li>
            <li class="profile_label">
            <div>Email</div>
            <div><?php echo $result->email;?></div>
            </li>
            <li class="profile_label">
            <div>Address</div>
            <div><?php echo $result->address;?></div>
            </li>
            <li class="profile_label"> 
            <div>Phone</div>
            <div><?php echo $result->phone;?></div>
            </li>
            <br>
            <!-- Button trigger modal -->
            <button type="button" data-bs-target="#exampleModal" data-bs-toggle="modal"
            class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Update
            </button>
        </ul>
        <table>
            <tr>
                <th>Order ID</th>
                <th>Payment</th>
                <th>User ID</th>
                <th>Current Date</th>
          </tr>
          
            <?php foreach ($result2 as $order) {?>
                <tr>
                 <td><?php echo $order->id?></td>
                 <td><?php echo $order->payment?></td>
                 <td><?php echo $order->user_id?></td>
                 <td><?php echo $order->currentdate?></td>
                </tr>
           <?php }?>
        
        </table>
    </div>
    <!-- Modal -->
    <
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel">Profile</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    
                    <div class="modal-body">
        
        <form  method="post">
                        <div class="input-group">
                            <label class="label">Username</label>
                            <input autocomplete="off" name="name" id="Email" class="input" type="text" value= "<?php echo $result->name?>">
                            
                        </div>
                        <br>
                        <div class="input-group">
                            <label class="label">Email </label>
                            <input autocomplete="off" name="email" id="Email" class="input" type="text" value= "<?php echo $result->email?>">
                            
                        </div>
                        <br>
                        <div class="input-group">
                            <label class="label">Address</label>
                            <input autocomplete="off" name="address" id="Email" class="input" type="text" value= "<?php echo $result->address?>">
                            
                        </div>
                        <br>
                        <div class="input-group">
                            <label class="label">Phone</label>
                            <input autocomplete="off" name="phone" id="Email" class="input" type="text" value= "<?php echo $result->phone?>">
                            
                        </div>
                        <br>

                        <div class="input-group">
                            <label class="label">password</label>
                            <input autocomplete="off" name="password" id="Email" class="input" type="password" value= "<?php echo $result->pass?>">
                            
                        </div>
                        <br>
                        <div class="button">
                            <input autocomplete="off" name="submit" id="buttons" type="submit" >
                            
                        </div>
                               <input type="hidden" name="id"   value="<?php echo $result->id?>">
                       
                        </form>

                    </div>
                </div>
            </div>
        </div>

   

    <?php
    if(isset($_POST["submit"])) {
        $name= $_POST["name"];
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
$stmt->bindParam(':name',$name, PDO::PARAM_STR);
$stmt->bindParam(':email',$email, PDO::PARAM_STR);
$stmt->bindParam(':address',$address, PDO::PARAM_STR);
$stmt->bindParam(':phone',$phone, PDO::PARAM_STR);
$stmt->bindParam(':password',$password, PDO::PARAM_STR);
// $stmt->bindParam(':id',$id, PDO::PARAM_STR);
  

  // execute the query
   $stmt->execute();
   
   
   

    }
    ?>

    

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
        <script>
            const profileButton = document.getElementById('profile_button');
            const info = document.getElementById('info');
            const ordersButton = document.getElementById('orders_button');
            const ordersTable = document.querySelector('table');

            profileButton.addEventListener('click', ()=>{
                info.style.display='block';
                ordersTable.style.display='none';
                profileButton.style.fontWeight='bold';
                ordersButton.style.fontWeight='normal';
            });
            ordersButton.addEventListener('click', ()=>{
                ordersTable.style.display='block';
                info.style.display='none';
                ordersButton.style.fontWeight='bold';
                profileButton.style.fontWeight='normal';
            })
        </script>
</body>

</html>
