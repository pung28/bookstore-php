<?php
//Lấy hành động hiện tại
$action = '';
if(isset($_GET['action'])){
    $action = $_GET['action'];
}
//    Kiểm tra hành động hiện tại
switch ($action){
    case '':
//            Lấy dữ liệu từ DB
        include_once 'models/booksModel.php';
//            Hiển thị ra view
        include_once 'view/books/index.php';
        break;
    case 'create':
//            Lấy toàn bộ
        include_once 'models/booksModel.php';
//            HIển thị form thêm
        include_once 'view/books/create.php';
        break;
    case 'store':
//            Lưu dữ liệu lên DB
        include_once 'models/booksModel.php';
//            Quay về trang danh sách
        header('Location:index.php?controller=book');
        break;

    case 'edit':
//            Lấy thông tin bản ghi hiện tại
        include_once 'models/booksModel.php';
//            Hiển thị ra form sửa
        include_once 'view/books/edit.php';
        break;
    case 'update':
        include_once 'models/booksModel.php';
        header('Location:index.php?controller=book');
        break;

    case 'softDeleteBook':
        include_once 'models/booksModel.php';
        header('Location:index.php?controller=book');
        break;

}

?>