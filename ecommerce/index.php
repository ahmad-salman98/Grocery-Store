<?php
require("connection.php");
require_once("./headers/header-home.php");
if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
    echo $user_id;
} else {
    $user_id = 0;
}

// define categories

$sql = "SELECT * FROM categories ";
$stmt = $conn->query($sql);
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);


//define products

$sql = "SELECT * FROM products ";
$stmt = $conn->query($sql);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);



?>
<!-- CODE shop  -->

<!-- Hero Section End -->

<!-- Categories Section Begin -->

<!-- CODE categories  -->
<section class="categories">
    <div class="container">
        <div class="row">
            <div class="categories__slider owl-carousel">

                <?php
                foreach ($categories as $category) {
                    $name = $category['name'];
                    $image = $category['image'];
                    $id = $category['id'];

                    echo " <div class='col-lg-3'>
                        <div class='categories__item set-bg' data-setbg='$image'>
                            <h5><a href='http://localhost/ecommerce/shop.php? id=$id'>$name</a></h5>
                        </div>
                    </div>";
                }
                ?>


            </div>
        </div>
    </div>
</section>
<!-- Categories Section End -->

<!-- Featured Section Begin -->
<section class="featured spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Featured Product</h2>
                </div>
                <div class="featured__controls">

                    <!-- Filter CODE -->
                    <ul>
                        <li class="active" data-filter=".Fruit">Fruits</li>
                        <li data-filter=".Snacks">Snacks</li>
                        <li data-filter=".Meat">Fresh Meat</li>
                        <li data-filter=".Vegetables">Vegetables</li>
                        <li data-filter=".Bakery">Bakery</li>
                    </ul>
                </div>
            </div>
        </div>



        <div class="row featured__filter">
            <?php
            foreach ($products as $product) {
                $name = $product['name'];
                $image = $product['image'];
                $price = $product['price'];
                $id = $product['id'];
                $catId = $product['category_id'];
                $sql = "SELECT * FROM categories where id = $catId";
                $stmt = $conn->query($sql);
                $cat = $stmt->fetch(PDO::FETCH_ASSOC);
                $catName = $cat['name'];



                echo " <div class='col-lg-3 col-md-4 col-sm-6 mix $catName '>
                    <div class='featured__item'>
                        <div class='featured__item__pic set-bg' data-setbg='$image'>
                            <ul class='featured__item__pic__hover'>
                                <li><a href='http://localhost/ecommerce/addtocart.php?id=$id'><i class='fa fa-shopping-cart'></i></a></li>
                            </ul>
                        </div>

                        <div class='featured__item__text'>
                            <h6><a href='http://localhost/ecommerce/shop-details.php?id=$id'>$name</a></h6>
                            <h5>$price Jd</h5>
                        </div>
                    </div>
                </div>";
            }

            ?>


        </div>
    </div>
</section>
<!-- Featured Section End -->

<!-- Banner Begin -->
<div class="banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="banner__pic">
                    <img src="./ogani-master/img/banner/banner-1.jpg" alt="">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="banner__pic">
                    <img src="./ogani-master/img/banner/banner-2.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Banner End -->

<!-- Latest Product Section Begin -->
<section class="latest-product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="latest-product__text">
                    <h4>New Arrivals</h4>
                    <div class="latest-product__slider owl-carousel">

                        <?php
                        $sql = "SELECT * FROM products order by id DESC";
                        $stmt = $conn->query($sql);
                        $latestProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        $count = 0;
                        $length = count($latestProducts);
                        // code img
                        while ($length >= 3) {
                            echo " <div class='latest-prdouct__slider__item'>";
                            for ($i = 0; $i < 3; $i++) {
                                $item = $latestProducts[$count];
                                $itemName = $item['name'];
                                $itemPrice = $item['price'];
                                $id = $item['id'];
                                $image = $item['image'];
                                echo
                                " <a href='http://localhost/addtocart.php?id=$id' class='latest-product__item'>
                                    <div class='latest-product__item__pic'>
                                        <img src='$image' style = 'width:110px; height:110px;'>
                                    </div>
                                    <div class='latest-product__item__text'>
                                        <h6>$itemName</h6>
                                        <span>$itemPrice jd</span>
                                    </div>
                                </a>";
                                $count++;
                                $length--;
                            }
                            echo "</div>";
                        }

                        ?>
                    </div>
                </div>
            </div>


            <div class="col-lg-4 col-md-6">
                <div class="latest-product__text">
                    <h4>Today's Offers</h4>
                    <div class="latest-product__slider owl-carousel">

                        <?php

                        // select sale products 
                        $sql = "SELECT * FROM products where discount>0";
                        $stmt = $conn->query($sql);
                        $discountProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        $count = 0;
                        // code img
                        $groups = count($discountProducts);
                        while ($groups > 2) {
                            global $catId;
                            echo "<div class='product__discount__item '>";
                            for ($i = 0; $i < 3; $i++) {
                                $itemCount = $discountProducts[$count];
                                $item = $itemCount['name'];
                                $discount = $itemCount['discount'];
                                $itemPrice = $itemCount['price'];
                                $id = $itemCount['id'];
                                $newPrice = (float) $itemPrice  * (100 - $discount) / 100;
                                $catId = $itemCount['category_id'];
                                $cat = '';
                                $image = $itemCount['image'];
                                foreach ($categories as $category) {
                                    if ($category['id'] == $catId)
                                        $cat = $category['name'];
                                }

                                echo "  <div class='d-flex mb-3'>
                                    <div class='product__discount__item__pic set-bg '
                                    style='width:110px; height:110px;'  data-setbg='$image'>
                                            <div class='product__discount__percent' style='transform: scale(.7);' >-$discount%</div>
                                            <ul class='product__item__pic__hover'>
                                                <li><a href='http://localhost/ecommerce/addtocart.php?id=$id'><i class='fa fa-shopping-cart'></i></a></li>
                                            </ul>
                                        </div>
                                        <div class='product__discount__item__text ms-4'>
                                            <span>$cat</span>
                                            <h5><a href='#'>$item</a></h5>
                                            <div class='product__item__price'>$newPrice jd <span>$itemPrice jd</span></div>
                                        </div>
                                        
                                    </div>";
                                $groups--;
                                $count++;
                            }
                            echo "</div>";
                        }

                        ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="latest-product__text">
                    <h4>Stay Healthy</h4>
                    <div class="latest-product__slider owl-carousel">

                        <?php
                        $catId = 0;
                        foreach ($categories as $category) {
                            if ($category['name'] == 'Vegetables')
                                $catId = $category['id'];
                        }


                        $sql = "SELECT * FROM products where category_id = $catId ";
                        $stmt = $conn->query($sql);
                        $fruits = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        $count = 0;
                        $groups = count($fruits);

                        // code img
                        for ($cols = $groups; $cols > 3; $cols -= 3) {
                            echo " <div class='latest-prdouct__slider__item'>";
                            for ($i = 0; $i < 3; $i++) {
                                $itemName = $fruits[$count]['name'];
                                $itemPrice = $fruits[$count]['price'];
                                $id = $fruits[$count]['id'];
                                $image = $fruits[$count]['image'];
                                echo
                                " <a href='http://localhost/ecommerce/addtocart.php?id=$id' class='latest-product__item'>
                                    <div class='latest-product__item__pic'>
                                        <img style = 'width:110px; height:110px;' src='$image'>
                                        
                                    </div>
                                    
                                    <div class='latest-product__item__text'>
                                        <h6>$itemName</h6>
                                        <span>$itemPrice jd</span>
                                    </div>
                                </a>";
                                $count++;
                            }
                            echo "</div>";
                        }
                        ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- Latest Product Section End -->



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