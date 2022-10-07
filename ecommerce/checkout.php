<?php

require_once("connection.php");
// echo $id;
// 
require_once("./headers/header-checkout.php");

if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
    if (!$user_id > 0) {
        header("Location:http://localhost/ecommerce/signup.php");
    }
} else {
    header("Location:http://localhost/ecommerce/signup.php");
}

?>


<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="./ogani-master/img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Checkout</h2>
                    <div class="breadcrumb__option">
                        <a href="./index.html">Home</a>
                        <span>Checkout</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->



<!-- php user and cart data recall from database tables   -->
<?php
require_once('./connection.php');

$stmt = $conn->query("SELECT name, email ,phone,address
    FROM users where id=$user_id");
$resultusers = $stmt->fetch(PDO::FETCH_OBJ);
// get all users info
$sql = "SELECT `cart`.`products_id`, `cart`.`quantity`, `cart`.`total`,
     `products`.`name`, `products`.`price`, `products`.`discount`
     FROM `products` 
     JOIN `cart` 
     ON products.id = cart.products_id
     where user_id=$user_id";
// Cart information sql select statement 
$stmt2 = $conn->query($sql);

// $stmt2 = $conn->query("SELECT quantity, total FROM cart WHERE cart_id=$cart_id");
$resultcart = $stmt2->fetchAll(PDO::FETCH_OBJ);

// get all users info
?>





<!-- Html Checkout form  -->
<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">
            <h4>Billing Details</h4>
            <form action="confirmation.php " method="POST">
                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <input type="hidden" name="id" value="<?php echo $user_id; ?>">

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Full Name<span>*</span></p>
                                    <input name='fullName' value="<?php echo $resultusers->name; ?>" type="text" style='color:black'>
                                </div>
                            </div>
                        </div>
                        <div class="checkout__input">
                            <p>Address<span>*</span></p>
                            <input type="text" name="address1" value="<?= $resultusers->address; ?>" placeholder="Street Address" class="checkout__input__add" style='color:black'>
                        </div>
                        <div class="checkout__input">

                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Phone<span>*</span></p>
                                    <input type="text" value="<?= $resultusers->phone; ?>" name="phone" style='color:black'>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Email<span>*</span></p>
                                    <input type="text" value="<?= $resultusers->email; ?>" name="email" style='color:black' disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Summery of the order  -->
                    <div class="col-lg-4 col-md-6">
                        <div class="checkout__order">
                            <h4>Order Details</h4>
                            <div class="checkout__order__products">Products <span>Total</span></div>
                            <ul>
                                <?php
                                $totalsum = 0;
                                foreach ($resultcart as $item) {
                                    $totalsum += ($item->price * (100 - $item->discount) / 100 * $item->quantity);

                                ?>

                                    <li> <?php echo $item->name;
                                            echo "   &nbsp   ";
                                            echo $item->price . "Jd/";
                                            echo "Unit" ?><span> </span> <span> <?php echo $item->price * (100 - $item->discount) / 100; ?>
                                        </span></li>
                                <?php  };
                                if ($totalsum > 20) {
                                    $delivery = 0;
                                } else {
                                    $delivery = 2;
                                };
                                ?>
                            </ul>
                            <div class="checkout__order__subtotal">Subtotal <span><?= $totalsum ?></span></div>
                            <div class="checkout__order__total">Total With Delivery <span><?= $totalsum + $delivery ?></span></div>
                            <input type="hidden" name="totalsum" value="<?php echo $totalsum; ?>">
                            <!-- Check out Submit button  -->
                            <form method="POST">
                                <button class="btn btn-danger" type="submit" name="place_order" value="order"> PLACE ORDER</button>
                            </form>
                            <?php if (isset($_POST['place_order'])) {
                                $_SESSION['alert'] = true;
                            }

                            ?>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>


<!-- Footer Section Begin -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="footer__copyright">
                    <div class="footer__copyright__text">
                        <p>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;<script>
                                document.write(new Date().getFullYear());
                            </script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="#">Dokkaneh</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </p>
                    </div>
                    <div class="footer__copyright__payment"><img src="img/payment-item.png" alt=""></div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Section End -->

<!-- Js Plugins -->
<script src="./ogani-master/js/jquery-3.3.1.min.js"></script>
<script src="./ogani-master/js/bootstrap.min.js"></script>
<script src="./ogani-master/js/jquery.nice-select.min.js"></script>
<script src="./ogani-master/js/jquery-ui.min.js"></script>
<script src="./ogani-master/js/jquery.slicknav.js"></script>
<script src="./ogani-master/js/mixitup.min.js"></script>
<script src="./ogani-master/js/owl.carousel.min.js"></script>
<script src="./ogani-master/js/main.js"></script>

<script src="./signup/js/app.logout.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>



</body>

</html>