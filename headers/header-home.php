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


                            <?php
                            foreach ($categories_ifo as $cat) {
                                $name = $cat['name'];
                                $id = $cat['id'];
                                echo "<li><a href='http://localhost/ecommerce/shop.php?id=$id'> $name </a></li>";
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="search.php" method="post">
                                <div class="hero__search__categories">
                                    All Categories
                                    <span class="arrow_carrot-down"></span>

                                </div>
                                <input type="text" placeholder="What do yo u need?">
                                <button type="submit" class="site-btn">SEARCH</button>
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