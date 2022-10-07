<?php
require("connection.php");
require('./shop/search.php');
require_once("./headers/header-shop.php");


?>


<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-5">
                <div class="sidebar">
                    <div class="sidebar__item">
                        <h4>Categories</h4>
                        <ul>
                            <?php
                            // Fetch categories
                            $sql = "SELECT * FROM categories";
                            $stmt = $conn->query($sql);
                            $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            ?>
                            <li data-filter=".<?php echo ($cat_id) ?>"><a href="http://localhost/ecommerce/shop.php">Show All</a></li>

                            <?php
                            foreach ($categories as $category) {
                                // $cat_name = $categories[$cat_id]['name'];
                                $cat_name = $category['name'];
                                $cat_id = $category['id'];
                            ?>
                                <li data-filter=".<?php echo ($cat_id) ?>"><a href="http://localhost/ecommerce/shop.php?id=<?php echo ($cat_id) ?>"><?php echo ($cat_name) ?></a></li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>

                    <div class="sidebar__item">
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
                                        <h6> <a href='shop_details.php?id=$id'>$itemName</a></h6>
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
                </div>
            </div>
            <div class="col-lg-9 col-md-7">
                <div class="filter__item">
                    <div class="row">
                        <div class="col-lg-4 col-md-5">
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="filter__found">
                                <h6><span><?php echo ($count) ?></span> Products found</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                require("connection.php");

                //fetch products

                $sql = "SELECT * FROM products";
                $stmt = $conn->query($sql);
                $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

                ?>

                <!---- Products Grid ----->

                <div class="row featured__filter">
                    <?php
                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];
                        $sql = "SELECT * FROM products WHERE category_id=$id";
                        $stmt = $conn->query($sql);
                        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        $check = false;
                        $count = $stmt->rowCount();
                    }
                    if ($check) {
                        foreach ($searched_prod as $product) {
                            $name = $product['name'];
                            $image = $product['image'];
                            $price = $product['price'];
                            $id = $product['id'];
                            $cat_id = $product['category_id'];
                            // $cat_name = $categories[$cat_id]['name'];
                    ?>
                            <div class='col-lg-4 col-md-6 col-sm-6 '>

                                <div class=' featured__item'>
                                    <div class='featured__item__pic set-bg' data-setbg='<?php echo $product['image']; ?>'>

                                        <ul class='featured__item__pic__hover'>
                                            <li><a href="http://localhost/ecommerce/addtocart.php?id=<?php echo $product['id']; ?>"><i class='fa fa-shopping-cart'></i></a></li>
                                        </ul>
                                    </div>
                                    <div class='featured__item__text'>
                                        <h6><a href='shop_details.php?p_id=<?php echo $product['id']; ?>'><?php echo $product['name']; ?></a></h6>
                                        <h5><?php echo $product['price']; ?> JD</h5>
                                    </div>
                                </div>
                                <input type="hidden"></input>
                            </div>

                        <?php
                        }
                    } else {
                        foreach ($products as $product) {
                            $name = $product['name'];
                            $image = $product['image'];
                            $price = $product['price'];
                            $id = $product['id'];
                            $cat_id = $product['category_id'];
                            // $cat_name = $categories[$cat_id]['name'];
                        ?>
                            <div class='col-lg-4 col-md-6 col-sm-6 '>

                                <div class=' featured__item'>
                                    <div class='featured__item__pic set-bg' data-setbg='<?php echo $product['image']; ?>'>

                                        <ul class='featured__item__pic__hover'>
                                            <li><a href="http://localhost/ecommerce/addtocart.php?id=<?php echo $product['id']; ?>"><i class='fa fa-shopping-cart'></i></a></li>
                                        </ul>
                                    </div>
                                    <div class='featured__item__text'>
                                        <h6><a href='shop_details.php?p_id=<?php echo $product['id']; ?>'><?php echo $product['name']; ?></a></h6>
                                        <h5><?php echo $product['price']; ?> JD</h5>
                                    </div>
                                </div>
                                <input type="hidden"></input>
                            </div>

                    <?php   }
                    }
                    //  $limit = 10;
                    //  $stmt = $conn->prepare("SELECT * FROM products");
                    //  $stmt->execute();
                    //  $pCount = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    // //  echo($pCount);
                    // $total_results = $stmt->rowCount();
                    // $total_pages = ceil($total_results/$limit);
                    // if(!isset($_GET['pge'])){
                    //     $page = 1;
                    // } else{
                    //     $page = $_GET['page'];
                    // }

                    // $start = ($page-1)*$limit;

                    // $stmt = $conn->prepare("SELECT * FROM products ORDER BY id DESC LIMIT $start, $limit");
                    // $stmt->execute();

                    // $results = $stmt->fetchAll();
                    // $conn = null;

                    // $no = $page > 1 ? $start+1 : 1;

                    ?>

                    <!-- <div class="product__pagination">
                        <a href="#">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#"><i class="fa fa-long-arrow-right"></i></a>
                    </div> -->
                </div>
            </div>
        </div>
</section>
<!-- Product Section End -->

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

</body>

</html>