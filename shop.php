<?php
require("connection.php");
require('./shop/search.php');
// if (!isset($_SESSION)) {
//     session_start();
// }

// Fetch categories
$sql = "SELECT * FROM categories";
$stmt = $conn->query($sql);
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

//fetch products

$sql = "SELECT * FROM products";
$stmt = $conn->query($sql);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php
require_once("connection.php");
session_start();
if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
} else {
    $user_id = 0;
}

// _______ cart info  start

$sql = "SELECT * FROM cart where user_id=$user_id";
$stmt = $conn->query($sql);
$cart_summary = $stmt->fetchAll(PDO::FETCH_ASSOC);
$cart_total = 0;
$cart_count = 0;
foreach ($cart_summary as $item) {
    $cart_total += $item['total'];
    $cart_count++;
}

// _______ cart info  end


// user info start
$sql2 = "SELECT * FROM users where id=$user_id";
$stmt = $conn->query($sql2);
$user_info = $stmt->fetch(PDO::FETCH_ASSOC);

// user info end'

// Categories info start 
$sql2 = "SELECT * FROM categories";
$stmt = $conn->query($sql2);
$categories_ifo = $stmt->fetchAll(PDO::FETCH_ASSOC);

//Categories info end 


?>





<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dokkaneh Market</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="./ogani-master/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="./ogani-master/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="./ogani-master/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="./ogani-master/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="./ogani-master/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="./ogani-master/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="./ogani-master/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="./ogani-master/css/style.css" type="text/css">
    <script src="https://kit.fontawesome.com/0a9ca5a95a.js" crossorigin="anonymous"></script>




    <!-- // dropdown style -->

    <style>
        .dropbtn {
            color: black;
            padding: 5px 10px;
            font-size: 16px;
            border: none;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #ddd;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown:hover .dropbtn {
            background-color: inherit;
        }
    </style>

</head>

<body>

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="http://localhost/ecommerce/index.php" style="text-decoration:none ; color:black">Dokkaneh </a>
        </div>
        <div class="humberger__menu__cart">
            <ul>
                <li><a href="#"><i class="fa fa-shopping-bag"></i> <span><?php echo $cart_count ?></span></a></li>
            </ul>
            <div class="header__cart__price">item: <span><?php echo $cart_count ?> Jd</span></div>
        </div>
        <div class="humberger__menu__widget">
            <div class="header__top__right__auth">
                <?php
                if ($user_id == 0) {
                    echo " <a href='http://localhost/ecommerce/signup.php'<i class='fa-solid fa-arrow-right-to-bracket'></i> Login</a>";
                }
                ?>


            </div>
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="active"><a href="http://localhost/ecommerce/index.php">Home</a></li>
                <li><a href="http://localhost/ecommerce/shop.php">Shop</a></li>
                <li><a href="http://localhost/ecommerce/shoping-cart.php">Shopping Cart</a></li>
                </li>
                <li><a href="http://localhost/ecommerce/contact.php">Contact</a></li>
            </ul>

            <?php
            if ($user_id != 0) {
                $user_name = $user_info['name'];
                echo " <li><a href='#'>$user_name</a>";
                echo "<ul class='header__menu__dropdown'>
                        <li><a href='http://localhost/ecommerce/shop.php'>View profile</a></li>
                        <li><a href='http://localhost/ecommerce/addtocart.php?logout=true'>logout</a></li>
                    </ul>";
            }

            ?>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="humberger__menu__contact">
            <ul>
                <a href="mailto:support@dokkaneh.com">
                    <li><i class="fa fa-envelope"></i> support@dokkaneh.com</li>
                </a>
                <li>Free Shipping for all Order of 20 Jd</li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="header__top__left">
                            <ul>
                                <a href="mailto:support@dokkaneh.com">
                                    <li><i class="fa fa-envelope"></i> support@dokkaneh.com</li>
                                </a>
                                <li> </li>
                                <li style="margin-left:5 rem;">Free Shipping for all Order of 20 Jd</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="header__top__right">
                            <div class="header__top__right__auth">
                                <?php
                                if ($user_id == 0) {
                                    echo " <a href='http://localhost/ecommerce/signup.php'<i class='fa-solid fa-arrow-right-to-bracket'></i> Login</a>";
                                } else {
                                ?>
                                    <div class="dropdown">
                                        <button class="dropbtn"><?php echo $user_name . " " ?><i class="fa-solid fa-angle-down"></i> </button>
                                        <div class="dropdown-content">
                                            <a style="text-align:left" href="http://localhost/ecommerce/profile.php">View profile</a>
                                            <a style="text-align:left" href="http://localhost/ecommerce/addtocart.php?logout=true">logout</a>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <h3> <a href="http://localhost/ecommerce/index.php" style="text-decoration:none ; color:black;">Dokkaneh </a></h3>
                    </div>
                </div>

                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li><a href="http://localhost/ecommerce/index.php">Home</a></li>
                            <li><a href="http://localhost/ecommerce/shop.php">Shop</a></li>
                            <li><a href="http://localhost/ecommerce/shoping-cart.php">Shopping Cart</a></li>
                            </li>
                            <li><a href="http://localhost/ecommerce/contact.php">Contact</a></li>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart">
                        <ul>
                            <li><a href="http://localhost/ecommerce/shoping-cart.php"><i class="fa fa-shopping-bag"></i> <span><?php echo $cart_count ?></span></a></li>
                        </ul>
                        <div class="header__cart__price">Cart total : <span><?php echo " " . $cart_total . " " ?></span> Jd</div>
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    <section class="hero hero-normal">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>All departments</span>
                        </div>
                        <ul>
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
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form method="post" action="">
                                <!-- <div class="hero__search__categories">
                                    All Categories
                                    <span class="arrow_carrot-down"></span>
                                </div> -->
                                <input type="text" name="search" placeholder="What do yo u need?">
                                <button type="submit" name="save" class="site-btn">SEARCH</button>
                            </form>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>0778086352</h5>
                                <span>support 24/7 time</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Product Section Begin -->
    <section class="product spad" style="padding-top: 0px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <div class="sidebar__item">
                            <h4>Categories</h4>
                            <ul>
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
                                        " <a style='text-decoration:none; color:black;' href='http://localhost/addtocart.php?id=$id' class='latest-product__item'>
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
                <div class="col-lg-9 col-md-7">
                    <div class="filter__item">
                        <div class="row">
                            <div class="col-lg-4 col-md-5">
                                <div class="filter__sort btn-group">
                                    <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        Sort Price By
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="http://localhost/ecommerce/shop.php?sort=asc">Low-to-High</a></li>
                                        <li><a class="dropdown-item" href="http://localhost/ecommerce/shop.php?sort=desc">High-to-Low</a></li>
                                    </ul>
                                </div>



                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="filter__found">
                                    <h6><span></span> Products found</h6>
                                </div>
                            </div>

                        </div>
                    </div>
                    <?php
                    require("connection.php");

                    ?>

                    <!---- Products Grid ----->

                    <div class="row featured__filter">
                        <?php
                        if (isset($_GET['id'])) {
                            foreach ($products as $product)
                                $id = $_GET['id'];
                            $sql = "SELECT * FROM products WHERE category_id=$id";
                            $stmt = $conn->query($sql);
                            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            // $check = false;
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
                                            <h6><a href='shop_details.php?id=<?php echo $product['id']; ?>'><?php echo $product['name']; ?></a></h6>
                                            <h5><?php echo $product['price']; ?> JD</h5>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                        } else if (isset($_REQUEST['sort'])) {
                            foreach ($sort_prod as $product) {
                                $name = $product['name'];
                                $image = $product['image'];
                                $price = $product['price'];
                                $id = $product['id'];
                                $cat_id = $product['category_id'];
                            ?>
                                <div class='col-lg-4 col-md-6 col-sm-6 '>
                                    <div class=' featured__item'>
                                        <div class='featured__item__pic set-bg' data-setbg='<?php echo $product['image']; ?>'>

                                            <ul class='featured__item__pic__hover'>
                                                <li><a href="http://localhost/ecommerce/addtocart.php?id=<?php echo $product['id']; ?>"><i class='fa fa-shopping-cart'></i></a></li>
                                            </ul>
                                        </div>
                                        <div class='featured__item__text'>
                                            <h6><a href='shop_details.php?id=<?php echo $product['id']; ?>'><?php echo $product['name']; ?></a></h6>
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
                                            <h6><a href='shop_details.php?id=<?php echo $product['id']; ?>'><?php echo $product['name']; ?></a></h6>
                                            <h5><?php echo $product['price']; ?> JD</h5>
                                        </div>
                                    </div>
                                    <input type="hidden" value="<?php echo ($cat_id) ?>"></input>
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
    <script src="./signup/js/app.logout.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

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