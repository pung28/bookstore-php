<?php
session_start();
ob_start();

// Lấy controller đang làm việc
$controller = '';
if (isset($_GET['controller'])) {
    $controller = $_GET['controller'];
}

// Hàm kiểm tra đăng nhập
function checkLogin() {
    global $controller; // Đảm bảo biến $controller được sử dụng trong phạm vi hàm này

    // Nếu đang truy cập vào trang đăng nhập, không kiểm tra session để tránh vòng lặp
    if ($controller === 'staff' && isset($_GET['action']) && $_GET['action'] === 'loginProcess') {
        return;
    }

    if ($controller === 'customer' && isset($_GET['action']) && $_GET['action'] === 'loginProcess') {
        return;
    }

    if ($controller === 'staff' && !isset($_SESSION['staff_email'])) {
        header('Location: index.php?controller=staff&action=login');
        exit();
    }

    if ($controller === 'customer' && !isset($_SESSION['customer_email'])) {
        header('Location: index.php?controller=customer&action=login');
        exit();
    }
}


// Kiểm tra đang làm việc với controller nào
switch ($controller) {
    case 'home':
        include_once 'controllers/homeController.php';
        break;
    case '':
        checkLogin();
if (isset($_SESSION['staff_email'])) {
        include_once 'view/index.php';
} else {
    header('Location: index.php?controller=staff&action=login');
}
        break;
    case 'categories':
        checkLogin();
        if (isset($_SESSION['staff_email'])) {
            include_once 'controllers/categoriesController.php';
        } else {
            header('Location: index.php?controller=staff&action=login');
        }
        break;
    case 'author':
        checkLogin();
if (isset($_SESSION['staff_email'])) {
        include_once 'controllers/authorsController.php';
} else {
    header('Location: index.php?controller=staff&action=login');
}
        break;
    case 'version':
        checkLogin();
if (isset($_SESSION['staff_email'])) {
        include_once 'controllers/versionsController.php';
} else {
    header('Location: index.php?controller=staff&action=login');
}
        break;
    case 'staff':
        if (isset($_GET['action']) && $_GET['action'] === 'login') {
            include_once 'controllers/staffsController.php';
        } else {
            checkLogin();
            include_once 'controllers/staffsController.php';
        }
        break;
    case 'customer':
//if (isset($_SESSION['staff_email'])) {
        include_once 'controllers/customersController.php';
//} else {
//    header('Location: index.php?controller=staff&action=login');
//}
        break;
    case 'book':
        checkLogin();
        if (isset($_SESSION['staff_email'])) {
            include_once 'controllers/booksController.php';
        } else {
            header('Location: index.php?controller=staff&action=login');
        }
        break;
    case 'book_detail':
        checkLogin();
        if (isset($_SESSION['staff_email'])) {
            include_once 'controllers/book_detailsController.php';
        } else {
            header('Location: index.php?controller=staff&action=login');
        }
        break;
    case 'order':
        checkLogin();
        if (isset($_SESSION['staff_email'])) {
            include_once 'controllers/ordersController.php';
        } else {
            header('Location: index.php?controller=staff&action=login');
        }
        break;


}
?>
