<?php
$action ='';
if(isset($_GET['action'])){
    $action =$_GET['action'];
}

function checkPermission($requiredRole) {
    if (!isset($_SESSION['role']) || $_SESSION['role'] != $requiredRole) {
        // Nếu người dùng không có quyền admin, hiển thị thông báo lỗi hoặc chuyển hướng
        echo "Bạn không có quyền thực hiện hành động này.";
        exit();
    }
}

switch ($action){
    case '':
        include_once "models/ordersModel.php";
        include_once "view/staffs/orders.php";
        break;
    case 'order_detail':
        include_once "models/ordersModel.php";
        include_once "view/staffs/order_details.php";
        break;
    case 'approval':
        include_once "models/ordersModel.php";
        header('Location:index.php?controller=order');
        echo "<script> alert('Product has been inserted sucessfully');</script>";
        break;
    case 'disapproval':
        include_once "models/ordersModel.php";
        header('Location:index.php?controller=bill');
        break;
    case 'softDeleteOrder':
        checkPermission('admin');
        include_once "models/ordersModel.php";
        header('Location:index.php?controller=order');
        break;

}
?>