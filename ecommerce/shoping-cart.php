<?php require_once("connection.php");


require_once("header.php");

?>



<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="./ogani-master/img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Shopping Cart</h2>
                    <div class="breadcrumb__option">
                        <a href="./index.html">Home</a>
                        <span>Shopping Cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shoping Cart Section Begin -->
<section class="shoping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th class="shoping__product">Products</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php

                            $sql = "SELECT * FROM products
                                INNER JOIN cart ON products.id = cart.products_id;";
                            $stmt = $conn->query($sql);
                            $cart_product = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($cart_product as $item) {
                                $product_name = $item['name'];
                                $product_image = $item['image'];
                                $product_price = $item['price'] * (100 - $item['discount']) / 100;
                                $product_quantity = $item['quantity'];
                                $total = $product_quantity * $product_price;
                                $cart_id = $item['cart_id'];
                                if ($item['user_id'] == $user_id) {

                                    echo "<form action='addtocart.php' method='POST'>";

                                    echo " <tr>
                                        <td class='shoping__cart__item'>
                                            <img style='width:110px; height: 110px;' src='$product_image'>
                                            <h5>$product_name</h5>
                                        </td>
                                        <td class='shoping__cart__price'>
                                            $product_price jd

                                            <input name='price_$cart_id' type='hidden' value='$product_price'>

                                        </td>
                                        <td class='shoping__cart__quantity'>
                                            <div class='quantity'>
                                                <div class='pro-qty'>
                                                    <input name='quantity_$cart_id' type='text' value='$product_quantity'>
                                                    <input name='user_id' type='hidden' value='$user_id'>
                                                    <input name='new_total_$cart_id' type='hidden' value='$total'>
                                                </div>
                                            </div>
                                        </td>
                                        <td class='shoping__cart__total'>
                                            $total
                                        </td>
                                        <td class='shoping__cart__item__close'>
                                            <a href='http://localhost/ecommerce/addtocart.php?delete=$cart_id'><span class='icon_close' style='color:red'></span></a>
                                        </td>
                                    </tr> ";
                                }
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__btns">
                    <a href="shop.php" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                    <button class="primary-btn cart-btn cart-btn-right" name="updateCart" type="submit" value="update">
                        <span class="icon_loading"></span> Update Cart</button>

                </div>
            </div>
            </form>



            <?php


            $sql = "SELECT * FROM cart where user_id=$user_id";
            $stmt = $conn->query($sql);
            $cart_summary = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $totalsum = 0;
            $shipping = 2;
            foreach ($cart_summary as $item) {
                $totalsum += $item['total'];
                if ($totalsum > 20)
                    $shipping = 0;
            }

            ?>
            <div class="col-lg-6 offset-3">
                <div class="shoping__checkout">
                    <h5>Cart Total</h5>
                    <ul>
                        <li>Subtotal <span> <?php echo $totalsum .  " JD" ?> </span></li>
                        <li>Total <span><?php echo $totalsum + $shipping . " JD" ?> </span></li>
                    </ul>
                    <a href="http://localhost/ecommerce/checkout.php?user_id=<?php echo $user_id ?>" class="primary-btn">PROCEED TO CHECKOUT</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shoping Cart Section End -->

<!-- Footer Section Begin -->
<footer class="footer spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="footer__about">
                    <div class="footer__about__logo">
                        <a href="./index.html"><img src="img/logo.png" alt=""></a>
                    </div>
                    <ul>
                        <li>Address: 60-49 Road 11378 New York</li>
                        <li>Phone: +65 11.188.888</li>
                        <li>Email: hello@colorlib.com</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                <div class="footer__widget">
                    <h6>Useful Links</h6>
                    <ul>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">About Our Shop</a></li>
                        <li><a href="#">Secure Shopping</a></li>
                        <li><a href="#">Delivery infomation</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Our Sitemap</a></li>
                    </ul>
                    <ul>
                        <li><a href="#">Who We Are</a></li>
                        <li><a href="#">Our Services</a></li>
                        <li><a href="#">Projects</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="#">Innovation</a></li>
                        <li><a href="#">Testimonials</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="footer__widget">
                    <h6>Join Our Newsletter Now</h6>
                    <p>Get E-mail updates about our latest shop and special offers.</p>
                    <form action="#">
                        <input type="text" placeholder="Enter your mail">
                        <button type="submit" class="site-btn">Subscribe</button>
                    </form>
                    <div class="footer__widget__social">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-instagram"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-pinterest"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="footer__copyright">
                    <div class="footer__copyright__text">
                        <p>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;<script>
                                document.write(new Date().getFullYear());
                            </script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
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