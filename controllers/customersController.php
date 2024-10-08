<?php
//Lấy hành động muốn thực hiện
$action = '';
if (isset($_GET['action'])){
    $action = $_GET['action'];
}

function checkPermission($requiredRole) {
    if (!isset($_SESSION['role']) || $_SESSION['role'] != $requiredRole) {
        // Nếu người dùng không có quyền admin, hiển thị thông báo lỗi hoặc chuyển hướng
        echo "Bạn không có quyền thực hiện hành động này.";
        exit();
    }
}
//Kiểm tra hành động đang thực hiện là gì
switch ($action) {
    case 'login':
//        Hiển thị ra form login
        include_once 'view/homes/login.php';
        break;
    case 'loginProcess':
        include_once 'models/customersModel.php';
        if($test == 0){
            header('Location:index.php?controller=customer&action=login');
        } elseif($test == 1) {
            header('Location:index.php?controller=home');
        }
        break;
    case 'logout':
        include_once 'models/customersModel.php';
        header('Location:index.php?controller=home');
        break;
    case 'signup':
        include_once "view/homes/register.php";
        break;
    case 'registerProcess':
        include_once "models/customersModel.php";
        header('Location:index.php?controller=customer&action=login');
        break;
    case '':
//Lấy dữ liệu từ DB về
        include_once 'models/customersModel.php';
//Hiển thị dữ liệu lên view
        include_once 'view/customers/index.php';
        break;
    case 'create':
//            Hiển thị ra form để thêm
        include_once 'view/customers/create.php';
        break;
    case 'store':
//            Thêm dữ liệu lên DB
        include_once 'models/customersModel.php';
        header('Location:index.php?controller=customer');
        break;
    case 'edit':
//            Lấy dữ liệu từ bản ghi
        include_once 'models/customersModel.php';
//            HIển thị ra form để sửa
        include_once 'view/customers/edit.php';
        break;
    case 'update':
//            Sửa dữ liệu trên DB
        include_once 'models/customersModel.php';
        header('Location:index.php?controller=customer');
        break;
    case 'softDeleteCustomer':
        checkPermission('admin');
        include_once 'models/customersModel.php';
        header('Location:index.php?controller=customer');
        break;
}
?>

