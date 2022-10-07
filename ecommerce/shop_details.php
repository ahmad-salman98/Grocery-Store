<?php

require_once("connection.php");
$id = $_GET['id'];
// $id = 3;
$sql = "SELECT * FROM products WHERE id=$id";
$stmt = $conn->query($sql);
$products = $stmt->fetch(PDO::FETCH_OBJ);
$array = json_decode(json_encode($products), true);

//  print_r($array);

$category = $array["category_id"];


$sql2 = "SELECT * FROM products WHERE category_id= $category";
$q = $conn->query($sql2);

$something = $q->fetchAll(PDO::FETCH_ASSOC);

require_once("./headers/header-checkout.php");


?>








<!-- Product Details Section Begin -->
<section class="product-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="product__details__pic">
                    <div class="product__details__pic__item">
                        <img class="product__details__pic__item--large" src="<?php
                                                                                echo $products->image;
                                                                                ?>" alt="">
                    </div>

                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="product__details__text">
                    <h3><?php
                        echo $products->name;
                        ?></h3>
                    <div class="product__details__rating">

                    </div>
                    <div class="product__details__price"> JD<?php
                                                            echo $products->price;
                                                            ?></div>
                    <form action="addToCart.php" method="GET">
                        <div class="product__details__quantity">
                            <div class="quantity">
                                <div class="pro-qty">
                                    <input name="quantity" type="text" value="1">
                                </div>
                            </div>
                        </div>
                        <button class="primary-btn" type="submit" name="id" value="<?php echo $id ?>">ADD TO CART</button>

                    </form>
                    <ul>
                        <li><b>Availability</b> <span>In Stock</span></li>
                        <li><b>Shipping</b> <span>01 day shipping. </span></li>


                    </ul>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="product__details__tab">



                </div>
            </div>
        </div>
    </div>
</section>
<!-- Product Details Section End -->

<!-- Related Product Section Begin -->
<section class="related-product">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title related__product__title">
                    <h2>Related Product</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <?php
            // foreach ($something as  $row){ 
            $counter = 0;
            $count = count($something);
            while ($counter < 4 && $count > 0) {


            ?>

                <div class="col-lg-3 col-md-4 col-sm-6">

                    <div class="product__item">
                        <div class="containers">
                            <div class="product__item__pic set-bg" data-setbg="<?php echo $something[$counter]['image']; ?>">
                                </a>

                            </div>

                        </div>
                        <div class="product__item__text">
                            <a name="id" href="?id=<?php echo $something[$counter]['id']; ?>">
                                <h5 name="name"><?php echo $something[$counter]['name']; ?></h5>
                                <h6 name="price"><?php echo $something[$counter]['price']; ?> JD</h6>
                            </a>
                        </div>
                    </div>



                </div>

            <?php $counter++;
                $count--;
            }  ?>
        </div>
    </div>
</section>
<!-- Related Product Section End -->

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
<<script src="./ogani-master/js/jquery-3.3.1.min.js">
    </script>
    <script src="./ogani-master/js/bootstrap.min.js"></script>
    <script src="./ogani-master/js/jquery.nice-select.min.js"></script>
    <script src="./ogani-master/js/jquery-ui.min.js"></script>
    <script src="./ogani-master/js/jquery.slicknav.js"></script>
    <script src="./ogani-master/js/mixitup.min.js"></script>
    <script src="./ogani-master/js/owl.carousel.min.js"></script>
    <script src="./ogani-master/js/main.js"></script>

    <script src="./signup/js/app.logout.js"></script>



    </body>

    </html>