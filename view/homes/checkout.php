<!doctype html>
<html class="no-js" lang="zxx">


<!-- Mirrored from htmldemo.net/lazio/lazio/shop-fullwidth.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 17 Jun 2024 15:47:37 GMT -->
<head>
    <style>
        .category-nav__menu {
            display: none;
        }
        .category-nav__menu.open {
            display: block;
        }
        .payment-info {
            display: none;
        }
        .payment-info.hide-in-default {
            display: none;
        }

    </style>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="meta description">

    <!-- Favicons -->
    <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="assets/img/icon.png">
    <title>Lazio - Multipurpose eCommerce Bootstrap 5 Template</title>

    <!-- ************************* CSS Files ************************* -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">

    <!-- All Plugins CSS css -->
    <link rel="stylesheet" href="assets/css/plugins.css">

    <!-- style css -->
    <link rel="stylesheet" href="assets/css/main.css">

    <!-- modernizr JS
    ============================================ -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
    <!--[if lt IE 9]>
    <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


    <!-- ************************* JS Files ************************* -->

    <!-- jQuery JS -->
    <script src="assets/js/vendor/jquery.min.js" defer></script>

    <!-- Bootstrap and Popper Bundle JS -->
    <script src="assets/js/bootstrap.bundle.min.js" defer></script>

    <!-- Plugins JS -->
    <script src="assets/js/plugins.js" defer></script>

    <!-- Ajax Mail JS -->
    <script src="assets/js/ajax-mail.js" defer></script>

    <!-- Main JS -->
    <script src="assets/js/main.js" defer></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Custom JavaScript -->
    <script>
        $(document).ready(function() {
            $(document).on('change', '#province', function() {
                var province_id = $(this).val();
                if (province_id != "") {
                    $.ajax({
                        url: 'controllers/getDistricts.php',
                        method: 'GET',
                        data: {province_id: province_id},
                        success: function(data) {
                            $('#district').html('<option value="">Select District</option>');
                            var districts = JSON.parse(data);
                            $.each(districts, function(key, district) {
                                $('#district').append('<option value="'+district.id+'">'+district.name+'</option>');
                            });
                            $('#ward').html('<option value="">Select Ward</option>');
                        }
                    });
                } else {
                    $('#district').html('<option value="">Select District</option>');
                    $('#ward').html('<option value="">Select Ward</option>');
                }
            });

            $(document).on('change', '#district', function() {
                var district_id = $(this).val();
                if (district_id != "") {
                    $.ajax({
                        url: 'controllers/getWards.php',
                        method: 'GET',
                        data: {district_id: district_id},
                        success: function(data) {
                            $('#ward').html('<option value="">Select Ward</option>');
                            var wards = JSON.parse(data);
                            $.each(wards, function(key, ward) {
                                $('#ward').append('<option value="'+ward.id+'">'+ward.name+'</option>');
                            });
                        }
                    });
                } else {
                    $('#ward').html('<option value="">Select Ward</option>');
                }
            });
        });
    </script>
    <script>
        document.getElementById('payment-method').addEventListener('change', function() {
            var paymentMethod = this.value;
            document.getElementById('cash-info').style.display = paymentMethod === 'cash' ? 'block' : 'none';
            document.getElementById('paypal-info').style.display = paymentMethod === 'paypal' ? 'block' : 'none';
        });

        // Trigger change event on page load to set initial visibility
        document.getElementById('payment-method').dispatchEvent(new Event('change'));
    </script>
</head>

<body>


<!-- Main Wrapper Start Here -->
<div class="wrapper bg--zircon-light color-scheme-3">
    <!-- Header Area Start Here -->
    <header class="header header-1">
        <div class="header-top header-1--top">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 text-lg-start text-center">
                        <!-- Contact Info Start -->
                        <ul class="contact-info contact-info--1">
                            <li class="contact-info__list"><i class="fa fa-envelope-open"></i><a href="mailto:demo@example.com">KBookstore@gmail.com</a></li>
                            <li class="contact-info__list"><i class="fa fa-phone"></i><a href="#">+84 523 608 504</a></li>
                        </ul>
                        <!-- Contact Info End -->
                    </div>
                    <div class="col-lg-6 text-end">
                        <!-- Header Top Nav Start -->
                        <div class="header-top__nav header-top__nav--1 d-flex justify-content-lg-end justify-content-center">
                            <div class="user-info header-top__nav--item">
                                <div class="dropdown header-top__dropdown">
                                    <a class="dropdown-toggle" id="userID" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Tài khoản
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="userID">
                                        <a class="dropdown-item" href="#">Tài khoản</a>
                                        <a class="dropdown-item" href="#">Thủ tục thanh toán</a>
                                        <?php
                                        if (isset($_SESSION['customer_id'])) {
                                            // Người dùng đã đăng nhập, hiển thị liên kết đăng xuất
                                            echo '<a class="dropdown-item" href="index.php?controller=customer&action=logout">Đăng xuất</a>';
                                        } else {
                                            // Người dùng chưa đăng nhập, hiển thị liên kết đăng nhập
                                            echo '<a class="dropdown-item" href="index.php?controller=customer&action=login">Đăng nhập</a>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="currency-selector header-top__nav--item">
                                <div class="dropdown header-top__dropdown">

                                    <a class="dropdown-toggle" id="currencyID" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span>Tiền tệ: </span>
                                        VND
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="currencyID">
                                        <a class="dropdown-item" href="#">VND</a>
                                        <a class="dropdown-item" href="#">USD</a>
                                    </div>
                                </div>
                            </div>
                            <div class="language-selector header-top__nav--item">
                                <div class="dropdown header-top__dropdown">
                                    <a class="dropdown-toggle" id="languageID" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span>Ngôn ngữ: </span>
                                        <img src="assets/img/header/1.png" alt="Tiếng Việt"> Tiếng Việt
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="languageID">
                                        <a class="dropdown-item" href="#"><img src="assets/img/header/1.png" alt="Tiếng Việt"> Tiếng Việt</a>
                                        <a class="dropdown-item" href="#"><img src="assets/img/header/2.png" alt="English"> Tiếng Anh</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Header Top Nav End -->
                    </div>
                </div>
            </div>
        </div>
        <div class="header-middle header-1--middle brand-bg-2 d-flex align-items-center">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-3 tex-xl-left text-center">
                        <!-- Logo Start -->
                        <a href="index.php?controller=home" class="logo-box">
                            <img src="assets/img/logo/logo-white.png" alt="logo">
                        </a>
                        <!-- Logo End -->
                    </div>
                    <div class="col-xl-5 col-lg-7 d-none d-lg-block">
                        <nav class="main-navigation">
                            <!-- Mainmenu Start -->
                            <ul class="mainmenu">


                            </ul>
                            </li>
                            </ul>
                            <!-- Mainmenu End -->
                        </nav>
                    </div>
                    <div class="col-xl-4 col-lg-5">
                        <!-- Search Form Start -->
                        <form action="#" class="search-form search-form--1">
                            <div class="search-form__group search-form__group--select">
                                <select name="category" id="searchCategory" class="search-form__select">
                                    <option value="all">Tất cả danh mục</option>
                                    <optgroup label="Các loại tiểu thuyết">
                                        <option>Kinh dị - Trinh thám</option>
                                        <option>Văn học hiện đại</option>
                                        <option>Văn học kinh điển</option>
                                        <option>Fantasy</option>
                                        <option>Lightnovel</option>
                                        <option>Boxset</option>
                                        <option>Manga - Comic </option>
                                        <option>Sách thiếu nhi</option>

                                    </optgroup>

                                </select>
                            </div>
                            <input type="text" class="search-form__input" placeholder="Nhập tìm kiếm của bạn...">
                            <button class="search-form__submit hover-scheme-2">
                                <i class="fa fa-search"></i>
                            </button>
                        </form>
                        <!-- Search Form End -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 d-flex d-lg-none">
                        <!-- Main Mobile Menu Start -->
                        <div class="mobile-menu"></div>
                        <!-- Main Mobile Menu End -->
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom header-1--bottom">
            <div class="container">
                <div class="row custom-row align-items-end">
                    <div class="col-lg-3">
                        <!-- Category Nav Start -->
                        <div class="category-nav">
                            <h2 class="category-nav__title tertiary-bg" id="js-cat-nav-title"><i class="fa fa-bars"></i> <span>Danh mục</span></h2>

                            <ul class="category-nav__menu" id="js-cat-nav">
                                <?php foreach ($array['categories'] as $cate) { ?>

                                    <li class="category-nav__menu__item ">
                                        <a href="index.php?controller=home&action=category&id=<?=$cate['id']?>"><?=$cate['name']?></i> </a>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </div>
                        <!-- Category Nav End -->
                        <div class="category-mobile-menu"></div>
                    </div>
                    <div class="col-lg-8 col-md-10">
                        <div class="corporate corporate--1">
                            <div class="corporate__single">
                                <div class="corporate__icon">
                                    <i class="fa fa-refresh"></i>
                                </div>
                                <div class="corporate__content">
                                    <h3 class="corporate__title">Free Return</h3>
                                    <p class="corporate__text">Miến phí đổi trả trong 7 ngày</p>
                                </div>
                            </div>
                            <div class="corporate__single">
                                <div class="corporate__icon">
                                    <i class="fa fa-paper-plane-o"></i>
                                </div>
                                <div class="corporate__content">
                                    <h3 class="corporate__title">FREE SHIPPING</h3>
                                    <p class="corporate__text">Miễn phí ship dưới 5 km</p>
                                </div>
                            </div>
                            <div class="corporate__single">
                                <div class="corporate__icon">
                                    <i class="fa fa-support"></i>
                                </div>
                                <div class="corporate__content">
                                    <h3 class="corporate__title">SUPPORT 24/7</h3>
                                    <p class="corporate__text">Chúng tôi hỗ trợ từ 8h - 17h</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1 col-md-2 align-self-start">
                        <!-- Header Cart Start -->
                        <div class="mini-cart mini-cart--1">
                            <a class="mini-cart__dropdown-toggle" id="cartDropdown">
                                <i class="fa fa-shopping-bag mini-cart__icon"></i>
                                <sub class="mini-cart__count">0</sub>
                            </a>
                            <div class="mini-cart__dropdown-menu">
                                <div class="mini-cart__content">
                                    <div class="mini-cart__item">
                                        <div class="mini-cart__item--single">
                                            <div class="mini-cart__item--image">
                                                <img src="assets/img/products/Book 15.jpg" alt="product">
                                            </div>
                                            <div class="mini-cart__item--content">
                                                <h4><a href="single-product.html">7 viên ngọc rồng</a> </h4>
                                                <p>Số lượng: 1</p>
                                                <p>100.000 VND</p>
                                            </div>
                                            <a class="mini-cart__item--remove" href="#"><i class="fa fa-times"></i></a>
                                        </div>
                                    </div>
                                    <div class="mini-cart__total">
                                        <h4>
                                            <span class="mini-cart__total--title">Tổng</span>
                                            <span class="mini-cart__total--ammount">0.00 VND</span>
                                        </h4>
                                    </div>
                                    <div class="mini-cart__btn">
                                        <a href="cart.html" class="btn btn-small btn-icon btn-style-1 color-1"> Giỏ hàng <i class="fa fa-angle-right"></i></a>
                                        <a href="checkout.html" class="btn btn-small btn-icon btn-style-1 color-1">Thanh toán <i class="fa fa-angle-right"></i></a>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- Header Cart End -->
                    </div>
                </div>
            </div>
        </div>

    </header>
    <!-- Header Area End Here -->
    <!-- Main Wrapper Start -->

    <div class="main-content-wrapper">
        <div class="checkout-area pt--40 pb--80 pt-sm--30 pb-sm--60">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- User Action Start -->
                        <div class="user-actions">
                            <div class="row">
                                <div class="col-12">
                                    <div class="user-actions__single user-actions__login">

                                        <div id="checkout_login" class="bg--white user-actions__form hide-in-default">
                                            <div class="checkout-login__info">
                                                <p class="checkout-login__text">
                                                    If you have shopped with us before, please enter your details in the boxes below. If you are a new customer, please proceed to the Billing & Shipping section.
                                                </p>
                                                <form class="form quick-login-form">
                                                    <div class="form__group">
                                                        <label class="form__label" for="login_email">Username Or Email <sup>*</sup></label>
                                                        <input type="email" name="login_email" id="login_email" class="form__input">
                                                    </div>
                                                    <div class="form__group">
                                                        <label class="form__label" for="login_password">Password <sup>*</sup></label>
                                                        <input type="password" name="login_password" id="login_password" class="form__input">
                                                    </div>
                                                    <div class="form__group d-flex align-items-center">
                                                        <button type="submit" class="btn btn-5 btn-style-1 color-1">Login</button>
                                                        <div class="form__checkbox--group ml--20">
                                                            <input type="checkbox" name="sessionStore" id="sessionStore" class="form__checkbox">
                                                            <label for="sessionStore" class="form__checkbox--label">Remember me</label>
                                                        </div>
                                                    </div>
                                                    <a href="#" class="forgot-pass">Forgot your password?</a>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="user-actions__single user-actions__coupon">

                                        <div id="coupon_info" class="user-actions__form user-actions--coupon bg--white hide-in-default">
                                            <form action="#" class="form form--cart">
                                                <div class="form__group d-flex">
                                                    <input type="text" name="coupon" id="coupon" class="form__input mr--40" placeholder="Coupon Code">
                                                    <button type="submit" class="btn btn-5 btn-style-1 color-1">Apply Coupon</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- User Action End -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <!-- Checkout Area Start -->
                        <div class="checkout-wrapper bg--white">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout-title">
                                        <h2>Chi tiết thanh toán</h2>
                                    </div>
                                    <div class="checkout-form">
                                        <form method="post" action="index.php?controller=home&action=add_order">
                                            <div class="row mb--30">
                                                <label for="billing_fname" class="form__label">Họ và tên <span></span></label>
                                                <?php if (isset($_SESSION['customer_id'])): ?>
                                                    <input type="text" name="billing_fname" id="billing_fname" style="width: 97.5%; margin-left: 6px" class="form__input" value="<?= htmlspecialchars($_SESSION['customer_name']); ?>" readonly>
                                                <?php else: ?>
                                                    <input type="text" name="billing_fname" id="billing_fname"  style="width: 97.5%; margin-left: 6px" class="form__input">
                                                <?php endif; ?>
                                            </div>
                                            <div class="row mb--30">
                                                <div class="form__group col-12">
                                                    <label for="billing_company" class="form__label">Địa chỉ</label>
                                                    <input type="text" name="billing_company" id="billing_company" class="form__input">
                                                </div>
                                            </div>
                                            <div class="row mb--30">
                                                <div class="form__group col-12">
                                                    <label for="province" class="form__label">Tỉnh</label>
                                                    <select name="province" id="province" class="form__input">
                                                        <option value="">Select Province</option>
                                                        <?php
                                                        include_once 'connect/open.php';
                                                        $connect = open();
                                                        $sql = "SELECT id, name FROM provinces";
                                                        $result = mysqli_query($connect, $sql);
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                                                        }
                                                        include_once 'connect/close.php';
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb--30">
                                                <div class="form__group col-12">
                                                    <label for="district" class="form__label">Huyện</label>
                                                    <select name="district" class="form__input" id="district">
                                                        <option value="">Select District</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb--30">
                                                <div class="form__group col-12">
                                                    <label for="ward" class="form__label"><span>Phường</span></label>
                                                    <select name="ward" class="form__input" id="ward">
                                                        <option value="">Select Ward</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb--30">
                                                <?php if (isset($_SESSION['customer_id'])): ?>
                                                    <div class="form__group col-md-6 mb-sm--30">
                                                        <label for="billing_phone" class="form__label">Số điện thoại</label>
                                                        <input type="text" name="billing_phone" id="billing_phone" value="0<?= htmlspecialchars($_SESSION['customer_phone']); ?>" class="form__input">
                                                    </div>
                                                    <div class="form__group col-md-6">
                                                        <label for="billing_email" class="form__label">Email <span>*</span></label>
                                                        <input type="email" name="billing_email" id="billing_email" value="<?= htmlspecialchars($_SESSION['customer_email']); ?> " class="form__input">
                                                    </div>
                                                <?php else: ?>
                                                    <div class="form__group col-md-6 mb-sm--30">
                                                        <label for="billing_phone" class="form__label">Số điện thoại</label>
                                                        <input type="text" name="billing_phone" id="billing_phone" class="form__input">
                                                    </div>
                                                    <div class="form__group col-md-6">
                                                        <label for="billing_email" class="form__label">Email  <span>*</span></label>
                                                        <input type="email" name="billing_email" id="billing_email" class="form__input">
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="row">
                                                <div class="form__group col-12">
                                                    <label for="orderNotes" class="form__label">Ghi chú</label>
                                                    <textarea class="form__input form__input--textarea" id="orderNotes" name="orderNotes" placeholder=""></textarea>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mt-md--30">
                                    <div class="order-details">
                                        <h3 class="heading-tertiary">Đơn hàng của bạn</h3>
                                        <div class="order-table table-content table-responsive mb--30">
                                            <table class="table">
                                                <thead>
                                                <?php foreach ($array['items'] as $item) { ?>
                                                    <tr>
                                                        <th> <?= $item['name']?>  <?php if (!empty($item['part'])) { ?>
                                                                - <?= htmlspecialchars($item['part']) ?></span>
                                                            <?php } ?></th>
                                                        <th>  <?= $formattedNum = number_format($item['subtotal'], 0, ',', '.'); ?> VND</th>
                                                    </tr>
                                                <?php } ?>
                                                </thead>
                                                <tfoot>
                                                <tr class="order-total">
                                                    <th>Tổng tiền cần thanh toán</th>
                                                    <td><span class="order-total-ammount">
                                                <?php echo number_format($array['total'], 0, ',', '.') . ' VND' ?></span></td>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <div class="checkout-payment">
                                            <div class="payment-group" style="margin-bottom: 20px;">
                                                <label for="payment-method" style="font-size: 18px; margin-bottom: 10px; display: block;">Chọn phương thức thanh toán:</label>
                                                <select name="payment-method" id="payment-method" class="form-control" style="width: 100%; height: 40px; font-size: 16px;">
                                                    <?php foreach ($array['payments'] as $payment) { ?>
                                                        <option value="<?php echo $payment['id']; ?>"><?php echo $payment['name']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="payment-group">
                                                <button type="submit" class="btn btn-6 btn-style-2">Đặt hàng</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
    </div>

    <!-- Main content wrapper end -->


        <footer class="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row pt--40 pb--40">
                <div class="col-md-4 mb-sm--30">
                    <div class="method-box">
                        <div class="method-box__icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="method-box__content">
                            <h4>+84 523 608 504</h4>
                            <p>Đường dây hỗ trợ miễn phí!</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-sm--30">
                    <div class="method-box">
                        <div class="method-box__icon">
                            <i class="fa fa-envelope-o"></i>
                        </div>
                        <div class="method-box__content">
                            <h4>KBookstore@gmail.com</h4>
                            <p>Hỗ trợ đặt hàng!</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="method-box">
                        <div class="method-box__icon">
                            <i class="fa fa-clock-o"></i>
                        </div>
                        <div class="method-box__content">
                            <h4>Thứ 2 - Chủ nhật / 8:00 - 18:00</h4>
                            <p>Ngày/Giờ làm việc!</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <hr class="line">
                </div>
            </div>
            <div class="row pt--40 pb--40">
                <div class="col-lg-8 mb-md--30">
                    <div class="row">
                        <div class="col-md-4 mb-sm--30">
                            <div class="footer-widget">
                                <h3 class="widget-title">LIÊN HỆ CHÚNG TÔI</h3>
                                <ul class="widget-menu">
                                    <li><a href="#">Cửa hàng</a></li>
                                    <li><a href="#">Phiếu quà tặng</a></li>
                                    <li><a href="#">Chi nhánh</a></li>
                                    <li><a href="wishlist.html">Danh sách yêu thích</a></li>
                                    <li><a href="my-account.html">Lịch sử đơn hàng</a></li>
                                    <li><a href="my-account.html">Theo dõi đơn hàng của bạn</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-4 mb-sm--30">
                            <div class="footer-widget">

                                <h3 class="widget-title">DỊCH VỤ KHÁCH HÀNG</h3>
                                <ul class="widget-menu">
                                    <li><a href="contact.html">Liên hệ</a></li>
                                    <li><a href="#">Hoàn trả</a></li>
                                    <li><a href="my-account.html">Lịch sử đơn hàng</a></li>
                                    <li><a href="#">Chi nhánh</a></li>
                                    <li><a href="my-account.html">Tài khoản</a></li>
                                    <li><a href="#">Hủy đăng kí thông báo</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="footer-widget">
                                <h3 class="widget-title">THÔNG TIN</h3>
                                <ul class="widget-menu">
                                    <li><a href="about-us.html">Về chúng tôi</a></li>
                                    <li><a href="my-account.html">Thông tin giao hàng</a></li>
                                    <li><a href="privacy.html">Chính sách bảo mật</a></li>
                                    <li><a href="terms-and-conditions.html">Điều khoản và điều kiện</a></li>
                                    <li><a href="#">Sự bảo đảm</a></li>
                                    <li><a href="faq.html">FAQ</a></li>
                                    <li><a href="login-register.html">Đăng nhập</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="footer-widget mb--40">
                        <h3 class="widget-title">TẢI APP</h3>
                        <div class="app-btn-group">
                            <a href="#" class="app-btn apple-btn">App store</a>
                            <a href="#" class="app-btn gplay-btn">Play store</a>
                        </div>

                    </div>
                    <div class="footer-widget social-widget">
                        <h3 class="widget-title">THEO DÕI CHÚNG TÔI</h3>
                        <ul class="social social-2">
                            <li class="social__item">
                                <a class="social__link"  href="https://facebook.com/" target="_blank" rel="noopener"  data-bs-toggle="tooltip" data-bs-placement="top" title="facebook">
                                    <i class="fa fa-facebook"></i>
                                </a>
                            </li>
                            <li class="social__item">
                                <a class="social__link"  href="https://twitter.com/" target="_blank" rel="noopener"  data-bs-toggle="tooltip" data-bs-placement="top" title="twitter">
                                    <i class="fa fa-twitter"></i>
                                </a>
                            </li>
                            <li class="social__item">
                                <a class="social__link"  href="https://pinterest.com/" target="_blank" rel="noopener"  data-bs-toggle="tooltip" data-bs-placement="top" title="pinterest">
                                    <i class="fa fa-pinterest"></i>
                                </a>
                            </li>
                            <li class="social__item">
                                <a class="social__link"  href="https://linkedin.com/" target="_blank" rel="noopener"  data-bs-toggle="tooltip" data-bs-placement="top" title="linkedin">
                                    <i class="fa fa-linkedin"></i>
                                </a>
                            </li>
                            <li class="social__item">
                                <a class="social__link"  href="https://vimeo.com/" target="_blank" rel="noopener"  data-bs-toggle="tooltip" data-bs-placement="top" title="vimeo">
                                    <i class="fa fa-vimeo"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <hr class="line">
                </div>
            </div>
            <div class="row pt--40 pb--40">
                <div class="col-12 text-center">
                    <a href="index.php?controller=home" class="footer-logo">
                        <img src="assets/img/logo/logo-black.png" alt="logo">
                    </a>
                </div>
            </div>
            <div class="row pb--30">
                <div class="col-12 text-center">
                    <ul class="footer-menu">
                        <li><a href="index.php?controller=home">Trang chủ</a></li>
                        <li><a href="blog.html">Blog</a></li>
                        <li><a href="contact.html">Liên hệ</a></li>
                        <li><a href="my-account.html">Tài khoản</a></li>
                        <li><a href="checkout.html">Thanh toán</a></li>
                        <li><a href="cart.html">Giỏ hàng</a></li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <hr class="line">
                </div>
            </div>
            <div class="row pt--40 pb--40">
                <div class="col-md-6 text-md-start text-center mb-sm--30">
                    <!-- Copyright Text Start -->
                    <p class="copyright-text">&copy; KBookstore 2024 Made With <i class="fa fa-heart"></i> BY <a href="">US</a></p>
                    <!-- Copyright Text End -->
                </div>
                <div class="col-md-6 text-md-end text-center">
                    <img src="assets/img/icons/payment-icon.png" alt="payment">
                </div>
            </div>
        </div>
    </div>
    <div class="subscription-area tertiary-bg">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-5 mb-sm--30">
                    <div class="subscription-text">
                        <div class="subscription-text__icon">
                            <i class="fa fa-envelope-open color--white"></i>
                        </div>
                        <div class="subscription-text__right">
                            <h3 class="color--white">Bản tin</h3>
                            <p class="color--white">Đăng ký nhận bản tin của chúng tôi để nhận được thông tin cập nhật từ chúng tôi</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <form class="newsletter-form validate"  action="https://devitems.us11.list-manage.com/subscribe/post?u=6bbb9b6f5827bd842d9640c82&amp;id=05d85f18ef" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" target="_blank" novalidate="">
                        <input type="email" class="newsletter-form__input" id="email" placeholder="Điền gmail của bạn...">
                        <input type="submit" value="Đăng kí" class="newsletter-form__submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
</footer>


<!-- Scroll To Top -->

<a class="scroll-to-top" href="#"><i class="fa fa-angle-up"></i></a>

<!-- Modal -->
<div class="modal fade product-modal" id="productModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="row">
                    <div class="col-md-5">
                        <div class="tab-content product-thumb-large">
                            <div id="thumb1" class="tab-pane active show fade">
                                <img src="assets/img/products/electronics-15-540x600.jpg" alt="product thumb">
                            </div>
                            <div id="thumb2" class="tab-pane fade">
                                <img src="assets/img/products/furniture-14.jpg" alt="product thumb">
                            </div>
                            <div id="thumb3" class="tab-pane fade">
                                <img src="assets/img/products/furniture-17.jpg" alt="product thumb">
                            </div>
                            <div id="thumb4" class="tab-pane fade">
                                <img src="assets/img/products/furniture-7.jpg" alt="product thumb">
                            </div>
                            <div id="thumb5" class="tab-pane fade">
                                <img src="assets/img/products/electronics-15-540x600.jpg" alt="product thumb">
                            </div>
                            <div id="thumb6" class="tab-pane fade">
                                <img src="assets/img/products/furniture-14.jpg" alt="product thumb">
                            </div>
                            <div id="thumb7" class="tab-pane fade">
                                <img src="assets/img/products/furniture-17.jpg" alt="product thumb">
                            </div>
                            <div id="thumb8" class="tab-pane fade">
                                <img src="assets/img/products/furniture-7.jpg" alt="product thumb">
                            </div>
                        </div>
                        <div class="product-thumbnail">
                            <div class="thumb-menu owl-carousel" id="thumbmenu">
                                <div class="thumb-menu-item">
                                    <a href="#thumb1" data-bs-toggle="tab" class="nav-link active">
                                        <img src="assets/img/products/electronics-15-150x167.jpg" alt="product thumb">
                                    </a>
                                </div>
                                <div class="thumb-menu-item">
                                    <a href="#thumb2" data-bs-toggle="tab" class="nav-link">
                                        <img src="assets/img/products/furniture-14-150x167.jpg" alt="product thumb">
                                    </a>
                                </div>
                                <div class="thumb-menu-item">
                                    <a href="#thumb3" data-bs-toggle="tab" class="nav-link">
                                        <img src="assets/img/products/furniture-17-150x167.jpg" alt="product thumb">
                                    </a>
                                </div>
                                <div class="thumb-menu-item">
                                    <a href="#thumb4" data-bs-toggle="tab" class="nav-link">
                                        <img src="assets/img/products/furniture-7-150x167.jpg" alt="product thumb">
                                    </a>
                                </div>
                                <div class="thumb-menu-item">
                                    <a href="#thumb5" data-bs-toggle="tab" class="nav-link active">
                                        <img src="assets/img/products/electronics-15-150x167.jpg" alt="product thumb">
                                    </a>
                                </div>
                                <div class="thumb-menu-item">
                                    <a href="#thumb6" data-bs-toggle="tab" class="nav-link">
                                        <img src="assets/img/products/furniture-14-150x167.jpg" alt="product thumb">
                                    </a>
                                </div>
                                <div class="thumb-menu-item">
                                    <a href="#thumb7" data-bs-toggle="tab" class="nav-link">
                                        <img src="assets/img/products/furniture-17-150x167.jpg" alt="product thumb">
                                    </a>
                                </div>
                                <div class="thumb-menu-item">
                                    <a href="#thumb8" data-bs-toggle="tab" class="nav-link">
                                        <img src="assets/img/products/furniture-7-150x167.jpg" alt="product thumb">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="modal-box product">
                            <h3 class="product-title">Volutpat ut</h3>
                            <div class="product-price">
                                <span class="regular-price">$100.50</span>
                                <span class="sale-price">$98.98</span>
                            </div>
                            <a class="product-link" href="single-product.html">See all featurs</a>
                            <p class="product-availability">200 In Stock</p>
                            <div class="product-action-wrapper">
                                <div class="quantity">
                                    <input type="number" class="quantity-input" name="qty" id="qty" value="1" min="1">
                                </div>
                                <button type="button" class="btn btn-style-1 add-to-cart color-3">
                                    Add To Cart
                                </button>
                            </div>
                            <p class="product-desc">Long printed dress with thin adjustable straps. V-neckline and wiring under the bust with ruffles at the bottom of the dress.</p>
                            <div class="social-share">
                                <h4>Share This Product</h4>
                                <ul class="social boxed-social">
                                    <li class="social__item"><a href="#" class="social__link facebook"><i class="fa fa-facebook"></i></a></li>
                                    <li class="social__item"><a href="#" class="social__link twitter"><i class="fa fa-twitter"></i></a></li>
                                    <li class="social__item"><a href="#" class="social__link google-plus"><i class="fa fa-google-plus"></i></a></li>
                                    <li class="social__item"><a href="#" class="social__link pinterest"><i class="fa fa-pinterest"></i></a></li>
                                    <li class="social__item"><a href="#" class="social__link linkedin"><i class="fa fa-linkedin"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Main Wrapper End Here -->

</body>


<!-- Mirrored from htmldemo.net/lazio/lazio/shop-fullwidth.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 17 Jun 2024 15:47:37 GMT -->
</html>