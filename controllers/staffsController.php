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
    case '':
//Lấy dữ liệu từ DB về
        include_once 'models/staffsModel.php';
//Hiển thị dữ liệu lên view
        include_once 'view/staffs/index.php';
        break;
    case 'login':
//        Hiển thị ra form login
        if(isset($_SESSION['email'])){
            header('Location:index.php');
        } else {
            include_once 'view/staffs/login.php';
        }
        break;
    case 'loginProcess':
        include_once 'models/staffsModel.php';
        if($test == 0){
            header('Location:index.php?controller=staff&action=login');
        } elseif($test == 1) {
            header('Location:index.php');
        }
        break;
    case 'logout':
        include_once 'models/staffsModel.php';
        header('Location:index.php?controller=staff&action=login');
        break;
    case 'create':
        checkPermission('admin');
//            Hiển thị ra form để thêm
        include_once 'view/staffs/create.php';
        break;
    case 'store':
        checkPermission('admin');
//            Thêm dữ liệu lên DB
        include_once 'models/staffsModel.php';
        header('Location:index.php?controller=staff');
        break;
    case 'edit':
        checkPermission('admin');
//            Lấy dữ liệu từ bản ghi
        include_once 'models/staffsModel.php';
//            HIển thị ra form để sửa
        include_once 'view/staffs/edit.php';
        break;
    case 'update':
        checkPermission('admin');
//            Sửa dữ liệu trên DB
        include_once 'models/staffsModel.php';
        header('Location:index.php?controller=staff');
        break;
    case 'softDeleteStaff':
        checkPermission('admin');
        include_once 'models/staffsModel.php';
        header('Location:index.php?controller=staff');
        break;
}
?>

