<?php
//Lấy hành động muốn thực hiện
$action = '';
if (isset($_GET['action'])){
    $action = $_GET['action'];
}
//Kiểm tra hành động đang thực hiện là gì
switch ($action) {
    case '':
//Lấy dữ liệu từ DB về
        include_once 'models/authorsModel.php';
//Hiển thị dữ liệu lên view
        include_once 'view/authors/index.php';
        break;
    case 'create':
//            Hiển thị ra form để thêm
        include_once 'view/authors/create.php';
        break;
    case 'store':
//            Thêm dữ liệu lên DB
        include_once 'models/authorsModel.php';
        header('Location:index.php?controller=author');
        break;
    case 'edit':
//            Lấy dữ liệu từ bản ghi
        include_once 'models/authorsModel.php';
//            HIển thị ra form để sửa
        include_once 'view/authors/edit.php';
        break;
    case 'update':
//            Sửa dữ liệu trên DB
        include_once 'models/authorsModel.php';
        header('Location:index.php?controller=author');
        break;
    case 'softDeleteAuthor':
        include_once 'models/authorsModel.php';
        header('Location:index.php?controller=author');
        break;
}
?>

