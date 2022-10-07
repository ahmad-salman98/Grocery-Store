<?php
require_once 'connection.php';

$sql_user = "SELECT * FROM users";
$sql_product = "SELECT * FROM products";
$sql_order = "SELECT orders.id,users.email,orders.currentdate FROM orders JOIN users WHERE orders.user_id =users.id";
$categ_name_sql = "SELECT * FROM categories ";
$getDataCat = $conn->query($categ_name_sql);
$category = $getDataCat->fetchAll(PDO::FETCH_OBJ);


$getUserData = $conn->query($sql_user);
$getProductData = $conn->query($sql_product);
$getOrderData = $conn->query($sql_order);
$users = $getUserData->fetchAll(PDO::FETCH_OBJ);
$products = $getProductData->fetchAll(PDO::FETCH_OBJ);
$orders = $getOrderData->fetchAll(PDO::FETCH_OBJ);

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="./admin/styleAdmin.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <style>
    .add-User-container {
      width: 680px;
      margin: 0 auto;
    }

    form {
      margin: 100px;
    }

    .input-field {
      position: relative;
      width: 250px;
      height: 44px;
      line-height: 44px;
      margin-top: 70px;
      /* margin-right: 10px; */

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
  <title>Admin Dashboard</title>
</head>

<body>
  <header></header>
  <main>
    <nav class="sidebar bg-dark close">
      <header>
        <div class="image-text">

          <div class="text logo-text">
            <span class="name">Admin Dashboard</span>
          </div>
        </div>

        <!-- <i class='bx bx-chevron-right toggle'></i> -->
        <i class="fa-solid fa-chevron-right toggle"></i>
      </header>

      <div class="menu-bar">
        <div class="menu">


          <ul class="menu-links">
            <li class="nav-link users-link">

              <i class='fa-solid fa-users icon'></i>
              <span class="text nav-text">Users</span>
              </a>
            </li>

            <li class="nav-link product-link">

              <i class="fa-solid fa-fish icon"></i>
              <span class="text nav-text">Products</span>
              </a>
            </li>

            <li class="nav-link order-link">

              <i class="fa-solid fa-box icon"></i>
              <span class="text nav-text">Orders</span>
              </a>
            </li>

            <button class="btn btn-danger mx-auto px-auto mt-3 rounded-4" id="logout">logout</button>
            <!-- Page Preloder -->
            <div id="preloder">
              <div class="loader"></div>
            </div>

          </ul>
        </div>


      </div>

    </nav>

    <section class="home ">
      <!-- <div class="text">Dashboard Sidebar</div> -->

      <section id="user" class="tab-content ">

        <h1>All Users Information</h1>
        <!-- <a href="./add_user.php"> -->

        <button type="button" class="icon-btn add-btn" data-bs-toggle="modal" data-bs-target="#adduser">

          <div class="add-icon"></div>
          <div class="btn-txt">Add User</div>
        </button></a>
        <!--for demo wrap-->

        <!-- Modal -->
        <div class="modal fade" id="adduser" tabindex="-1" aria-labelledby="adduserLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="add-User-container">
              <div class="row add-User-Form">

                <div class="card-panel">

                  <div class="row">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="adduserLabel">New User</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form id="formLogon1" class="col s12 m12 l12" method="post">
                          <div class="row">
                            <div class="input-field col s6">
                              <input type="text" name="fname" id="fname" autocomplete="off" required>
                              <label for="fname">First Name</label>

                            </div>

                            <div class="input-field col s6">
                              <input type="text" name="lname" id="lname" autocomplete="off" required>
                              <label for="lname">Last Name</label>

                            </div>
                          </div>
                          <div class="row">
                            <div class="input-field col s6">
                              <input type="email" name="email" id="email" autocomplete="off" required>
                              <label for="email">Email</label>

                            </div>


                          </div>


                          <div class="row">
                            <div class="input-field col s6">
                              <input type="password" name="password" autocomplete="off" id="pwd" required>
                              <label for="password">Password</label>

                            </div>

                            <div class="input-field col s6">
                              <input type="password" name="passwordRep" autocomplete="off" id="pwdRep" required>
                              <label for="passwordRep">Repeate Password</label>

                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="add_user" class="btn btn-primary">Save changes</button>
                          </div>
                        </form>
                      </div>

                    </div>
                  </div>



                </div>

              </div>
            </div>
          </div>
        </div>
        <?php

        if (isset($_POST['add_user'])) {
          // echo 'ggggggggggggggggggg';
          $name = $_POST['fname'];
          $email = $_POST['email'];

          $pwd = $_POST['password'];


          $sql = "INSERT INTO users (name, email ,pass) VALUES (:name,:email,:pwd)";

          $stmt = $conn->prepare($sql);
          $stmt->bindParam(':name', $name, PDO::PARAM_STR);
          $stmt->bindParam(':email', $email, PDO::PARAM_STR);
          // $stmt->bindParam(':phone',$phone,PDO::PARAM_STR);
          $stmt->bindParam(':pwd', $pwd, PDO::PARAM_STR);
          // $stmt->bindParam(':address',$address,PDO::PARAM_STR);
          //   $stmt->bindParam(':id',$user->id,PDO::PARAM_STR);

          $stmt->execute();
          // header("location: admin.php");

        }

        ?>
        <div class="tbl-header">
          <table cellpadding="0" cellspacing="0">
            <thead>
              <tr>
                <th>Email</th>
                <th>Edit</th>
                <th>Delete</th>

              </tr>
            </thead>
          </table>
        </div>
        <div class="tbl-content">
          <table cellpadding="0" cellspacing="0">
            <tbody>
              <?php
              foreach ($users as $user) {
                // print_r($user);
                $id = $user->id;
                // echo $id;

              ?>
                <tr>
                  <td><?php echo $user->email; ?></td>
                  <td>
                    <!-- <a href="update_user.php?id=<?php echo $user->id; ?>">   -->
                    <i class="fa-solid fa-user-pen" data-bs-toggle="modal" data-bs-target="#editUser"></i>
                  </td>
                  <td>
                    <a href="delete_user.php?id=<?php echo $user->id; ?>">
                      <!-- <i class="fa-sharp fa-solid fa-trash"></i> -->
                      <lord-icon src="https://cdn.lordicon.com/jmkrnisz.json" trigger="hover" colors="primary:#c71f16" state="hover-empty" style="width:32px;height:32px">
                      </lord-icon>
                    </a>
                  </td>

                </tr>


                <!-- Modal -->
                <div class="modal fade" id="editUser" tabindex="-1" aria-labelledby="editUserLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="add-User-container">
                      <div class="row add-User-Form">

                        <div class="card-panel">

                          <div class="row">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h1 class="modal-title fs-5" id="editUserLabel">Update User</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <form id="formLogon2" method="post" class="col s12 m12 l12">
                                  <div class="row">
                                    <div class="input-field col s6">
                                      <input type="text" name="fname" id="fname2" value="<?php echo $user->name; ?>" required>
                                      <label for="fname">First Name</label>

                                    </div>

                                  </div>
                                  <div class="row">
                                    <div class="input-field col s6">
                                      <input type="email" name="email" value="<?php echo $user->email; ?>" id="email2" required>
                                      <label for="email">Email</label>

                                    </div>


                                  </div>

                                  <div class="row">
                                    <div class="input-field col s6">
                                      <input type="text" name="address" id="address2" value="<?php echo $user->address; ?>" required>
                                      <label for="address">Address</label>

                                    </div>
                                    <div class="input-field col s6">
                                      <input type="text" name="phone" id="phone2" value="<?php echo $user->phone; ?>" required>
                                      <label for="phone">Phone</label>

                                    </div>

                                  </div>
                                  <div class="row">
                                    <div class="input-field col s6">
                                      <input type="password" name="password" id="pwd2" required>
                                      <label for="password">Password</label>

                                    </div>


                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="update_user" class="btn btn-primary">Save changes</button>
                                  </div>
                                </form>
                              </div>

                            </div>
                          </div>



                        </div>

                      </div>
                    </div>
                  </div>
                </div>
        </div>
      <?php


                if (isset($_POST['update_user'])) {
                  // echo 'ggggggggggggggggggg';
                  $name = $_POST['name'];
                  $email = $_POST['email'];
                  $phone = $_POST['phone'];
                  $address = $_POST['address'];
                  $pwd = $_POST['password'];

                  $sql = "UPDATE users 
    SET name=:name,email=:email,phone=:phone,pass=:pass,address=:address 
    WHERE id=$id";

                  $stmt = $conn->prepare($sql);
                  $stmt->bindParam(':name', $name, PDO::PARAM_STR);
                  $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                  $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
                  $stmt->bindParam(':address', $address, PDO::PARAM_STR);
                  $stmt->bindParam(':pass', $pwd, PDO::PARAM_STR);
                  //   $stmt->bindParam(':id',$user->id,PDO::PARAM_STR);

                  $stmt->execute();
                  // header("location: admin.php");

                }
              }
      ?>
      </tbody>
      </table>
      </div>
      </section>

      <section id="product" class="tab-content">
        <h1>All Products Information</h1>
        <!-- <a href="./add_product.php"> -->
        <button class="icon-btn add-btn" data-bs-toggle="modal" data-bs-target="#addProduct">
          <div class="add-icon"></div>
          <div class="btn-txt">Add Product</div>
        </button></a>
        <!--for demo wrap-->
        <!-- Modal -->
        <div class="modal fade" id="addProduct" tabindex="-1" aria-labelledby="addProductLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="add-User-container">
              <div class="row add-User-Form">

                <div class="card-panel">

                  <div class="row">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="addProductLabel">New Product</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form id="formLogon3" class="col s12 m12 l12" method="post">
                          <div class="row">
                            <div class="input-field col s6">
                              <input type="text" name="name" id="name3" autocomplete="off" required>
                              <label for="name">Product Name</label>

                            </div>

                            <div class="input-field col s6">
                              <input type="text" name="price" id="price3" autocomplete="off" required>
                              <label for="price">Product Price</label>

                            </div>
                          </div>
                          <div class="row">
                            <div class="input-field col s6">
                              <input name="image" type="file" class="textInput">
                              <label for="email">Product Image</label>

                            </div>


                          </div>


                          <div class="row">
                            <div class="input-field col s6">
                              <input type="text" name="discount" autocomplete="off" id="discount3" required>
                              <label for="discount">Product Discount</label>

                            </div>

                            <div class="input-field col s6">

                              <label class=" label">
                                Product Category:
                                <span class="textInputWrapper">
                                  <select name="category">
                                    <?php
                                    foreach ($category as $name) {
                                    ?>
                                      <option value="<?php echo $name->name; ?>
"></option>
                                    <?php } ?>

                                  </select>

                                </span>

                              </label>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="add_product" class="btn btn-primary">Save changes</button>
                          </div>
                        </form>
                      </div>

                    </div>
                  </div>



                </div>

              </div>
            </div>
          </div>
        </div>
        <div class="tbl-header">
          <table cellpadding="0" cellspacing="0">
            <thead>
              <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Categories</th>
                <th>Discount</th>
                <th>Edit</th>
                <th>Delete</th>

              </tr>
            </thead>
          </table>
        </div>
        <div class="tbl-content">
          <table cellpadding="0" cellspacing="0">
            <tbody>
              <?php
              $categorie = "SELECT categories.name,categories.id FROM categories JOIN products
             WHERE  products.category_id= categories.id";
              $getCatData = $conn->query($categorie);
              $categName = $getCatData->fetchAll(PDO::FETCH_OBJ);
              // print_r($categName);
              $categoryName = '';
              foreach ($products as $product) {
                foreach ($categName as $category) {
                  if ($product->category_id == $category->id)
                    $categoryName = $category->name;
                }


              ?>
                <tr>
                  <td><img id="product-img" src="<?php echo $product->image; ?>" width="50px" height="50px" alt="product"></td>
                  <td><?php echo $product->name; ?></td>
                  <td><?php echo $product->price; ?></td>
                  <td><?php echo $categoryName; ?></td>

                  <td><?php echo $product->discount; ?></td>
                  <td>

                    <i class="fa-sharp fa-solid fa-pen-to-square" data-bs-toggle="modal" data-bs-target="#editProduct"></i>
                  </td>
                  <td>
                    <a href="delete_product.php?id=<?php echo $product->id; ?>">
                      <lord-icon src="https://cdn.lordicon.com/jmkrnisz.json" trigger="hover" colors="primary:#c71f16" state="hover-empty" style="width:32px;height:32px">
                      </lord-icon>
                  </td>


                </tr>
              <?php


                if (isset($_POST['update_user'])) {
                  // echo 'ggggggggggggggggggg';
                  $name = $_POST['name'];
                  $discount = $_POST['discount'];
                  $image = $_POST['image'];
                  $price = $_POST['price'];

                  $sql = "UPDATE products 
  SET name=:name,discount=:discount,image=:image,price=:price 
  WHERE id=$id";

                  $stmt = $conn->prepare($sql);
                  $stmt->bindParam(':name', $name, PDO::PARAM_STR);
                  $stmt->bindParam(':discount', $discount, PDO::PARAM_STR);
                  $stmt->bindParam(':image', $image, PDO::PARAM_STR);
                  $stmt->bindParam(':price', $price, PDO::PARAM_STR);
                  //   $stmt->bindParam(':id',$user->id,PDO::PARAM_STR);

                  $stmt->execute();
                  // header("location: admin.php");

                }
              } ?>
            </tbody>
          </table>
        </div>
      </section>
      <!-- Modal -->
      <div class="modal fade" id="editProduct" tabindex="-1" aria-labelledby="editProductLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="add-User-container">
            <div class="row add-User-Form">

              <div class="card-panel">

                <div class="row">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="editProductLabel">Update Product</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form id="4" class="col s12 m12 l12" method="post">
                        <div class="row">
                          <div class="input-field col s6">
                            <input type="text" name="name" id="name4" value="<?php echo $product->name; ?>" autocomplete="off" required>
                            <label for="name">Product Name</label>

                          </div>

                          <div class="input-field col s6">
                            <input type="text" name="price" id="price4" value="<?php echo $product->price; ?>" autocomplete="off" required>
                            <label for="price">Product Price</label>

                          </div>
                        </div>
                        <div class="row">
                          <div class="input-field col s6">
                            <input name="image" type="file" value="<?php echo $product->image; ?>" class="textInput">
                            <label for="email">Product Image</label>

                          </div>


                        </div>


                        <div class="row">
                          <div class="input-field col s6">
                            <input type="text" name="discount" autocomplete="off" value="<?php echo $product->discount; ?>" id="discount4" required>
                            <label for="discount">Product Discount</label>

                          </div>

                          <div class="input-field col s6">

                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="submit" name="update_user" class="btn btn-primary">Save changes</button>
                        </div>
                      </form>
                    </div>

                  </div>
                </div>



              </div>

            </div>
          </div>
        </div>
      </div>

      <section id="orders" class="tab-content">
        <h1>All Order Information</h1>

        <!--for demo wrap-->

        <div class="tbl-header">
          <table cellpadding="0" cellspacing="0">
            <thead>
              <tr>
                <th>Email</th>
                <th>ID</th>
                <th>Date</th>
                <th>Approve</th>

              </tr>
            </thead>
          </table>
        </div>
        <div class="tbl-content">
          <table cellpadding="0" cellspacing="0">
            <tbody>
              <?php
              foreach ($orders as $order) {


              ?>
                <tr>
                  <td><?php echo $order->email; ?></td>
                  <td><?php echo $order->id; ?> </td>
                  <td><?php echo $order->currentdate; ?> </td>
                  <td><i class="fa-solid fa-circle-check"></i></td>

                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </section>
    </section>

  </main>
  <footer></footer>

  <!-- ///////////////////// SCRIPTS ///////////////////// -->
  <script src="./admin/dashboardJs.js"> </script>
  <script src="https://cdn.lordicon.com/pzdvqjsp.js"></script>
  <script src="./signup/js/app.logout.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/8b42dcad4f.js" crossorigin="anonymous"></script>
</body>

</html>

<?php


?>