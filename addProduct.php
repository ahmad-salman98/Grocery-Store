<!DOCTYPE html>
<html>

<body>
    <!-- All our code. write here   -->

    <!-- sidebar here -->
    <?php
require_once('includes/links.php');
require_once('includes/header.php');
require_once('includes/sidebar.php');

// submit user data to database
// 1 db connection
require_once('dbconnection.php');

$sql = "SELECT * FROM categories ";
$getData = $conn->query($sql);
$category = $getData->fetchAll(PDO::FETCH_OBJ);

?>

    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-dark text-white text-center">
                            <span>Products</span>
                        </div>
                        <div class="card-body">
                            <form  method="post" enctype='multipart/form-data'>

                                <div class="row">

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="name" class="form-control" name="name">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="image">Image</label>
                                            <input type="file" name="image" id="imageFile" accept="image/png,image/jpg ,image/jpeg" />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input type="price" class="form-control" name="price">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="category">Category</label>
                                        <select name="category">
                                            <?php
foreach ($category as $name) {
?>
                                            <option value="<?php echo $name->name; ?>"><?php echo $name->name; ?></option>
                                            <?php
}?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="discount">Discount</label>
                                        <input type="discount" class="form-control" name="discount">
                                    </div>
                                </div>
                                <div class="row col-lg-3">
                                    <button type="submit" class="btn btn-success" name="addProduct">submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <script src="jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/8b42dcad4f.js" crossorigin="anonymous"></script>

    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>

</html>

<?php 

if(isset($_POST['addProduct']))
{
    $catName=$_POST['category'] ;
    $sql2 = "SELECT id FROM categories Where name='$catName' ";
$getData2 = $conn->query($sql2);
$categoryId = $getData2->fetch(PDO::FETCH_OBJ);
print_r($categoryId);
  $name=$_POST['name'];
  $discount=$_POST['discount'];
  
//   $image=$_POST['image'];
  $price=$_POST['price'];

  $image_name = $_FILES['image']['name'];
  $target_dir = "images/";
  $target_file = $target_dir . basename($_FILES["image"]["name"]);

  // Select file type
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  // Valid file extensions
  $extensions_arr = array("jpg","jpeg","png","gif");

  // Check extension
  if( in_array($imageFileType,$extensions_arr) ){
     // Upload file
     if(move_uploaded_file($_FILES['image']['tmp_name'],$target_dir.$image_name)){
        // Insert record
        // $query = "insert into images(name) values('".$name."')";
        // mysqli_query($con,$query);
  
  
//    $sql5="INSERT INTO products (name,discount,category_id ,image,price)
//   VALUES (name=:name,discount=:discount,category_id=:category_id ,image=:image,price=:price) 
//   ";
 
//   $stmt=$conn->prepare($sql5);
//   $stmt->bindParam(':name',$name,PDO::PARAM_STR);
//   $stmt->bindParam(':discount',$discount,PDO::PARAM_STR);
//   $stmt->bindParam(':category_id',$categoryId->id,PDO::PARAM_STR);
//   $stmt->bindParam(':image',$name,PDO::PARAM_STR);
//   $stmt->bindParam(':price',$price,PDO::PARAM_STR);
// //   $stmt->bindParam(':id',$user->id,PDO::PARAM_STR);

//   $stmt->execute();

$sql5="INSERT INTO products (name,discount,category_id ,image,price)
  VALUES ('$name',$discount,$categoryId->id,'$image_name',$price ) 
  ";
  $stmt=$conn->query($sql5);
    }

  }
  

 
//   header("location: products.php");

}

?>