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
        include_once 'models/book_detailsModel.php';
//            Hiển thị ra view
        include_once 'view/book_details/index.php';
        break;
    case 'create':
//            Lấy toàn bộ
        include_once 'models/book_detailsModel.php';
//            HIển thị form thêm
        include_once 'view/book_details/create.php';
        break;
    case 'store':
//            Lưu dữ liệu lên DB
        include_once 'models/book_detailsModel.php';
//            Quay về trang danh sách
        header('Location:index.php?controller=book_detail');
        break;

    case 'edit':
//            Lấy thông tin bản ghi hiện tại
        include_once 'models/book_detailsModel.php';
//            Hiển thị ra form sửa
        include_once 'view/book_details/edit.php';
        break;
    case 'update':
        include_once 'models/book_detailsModel.php';
        header('Location:index.php?controller=book_detail');
        break;

    case 'softDeleteBookDetail':
        include_once 'models/book_detailsModel.php';
        header('Location:index.php?controller=book_detail');
        break;

    case 'view':
        // Lấy chi tiết sách từ DB
        include_once 'models/book_detailsModel.php';
        if (isset($_GET['book_id'])) {
            $book_id = $_GET['book_id'];
            $array = viewBookDetail($book_id);
        } else {
            $array = [];
        }
        // Hiển thị ra view chi tiết
        include_once 'view/book_details/view.php';
        break;

}

?>