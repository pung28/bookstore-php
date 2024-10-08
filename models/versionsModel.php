<?php
//function lấy dữ liệu từ DB về
function index(){
    include_once 'connect/open.php';
    $sql = "SELECT * FROM versions WHERE deletes = 0";
    $versions = mysqli_query($connect,$sql);
    include_once 'connect/close.php';
    return $versions;
}

function version() {
    $id = $_GET['id'];
    include_once "connect/open.php";
    $sqlVersions = "SELECT * FROM versions WHERE id = '$id'";
    $versions = mysqli_query($connect,$sqlVersions);
    $sqlBook_details = "SELECT * FROM book_details WHERE version_id = '$id'";
    $book_details = mysqli_query($connect,$sqlBook_details);
    include_once "connect/close.php";
    $array = array();
    $array['versions'] = $versions;
    $array['book_details'] = $book_details;
    return $array;
}

function store()
{
//        Lấy dữ liệu từ form về
    $name = $_POST['name'];
    include_once 'connect/open.php';
    $sql = "INSERT INTO versions(name) VALUES ('$name')";
    mysqli_query($connect, $sql);
    include_once 'connect/close.php';
}
function edit(){
//        Lấy id
    $id = $_GET['id'];
    include_once 'connect/open.php';
    $sql = "SELECT * FROM versions WHERE id = '$id'";
    $versions = mysqli_query($connect,$sql);
    include_once 'connect/close.php';
    return $versions;
}

function update(){
    $id = $_POST['id'];
    $name = $_POST['name'];
    include_once 'connect/open.php';
    $sql = "UPDATE versions SET name = '$name' WHERE id = '$id'";
    $categories = mysqli_query($connect,$sql);
    include_once 'connect/close.php';
}

//    function destroy(){
//        $id = $_GET['id'];
//        include_once 'connect/open.php';
//        $sql = "DELETE FROM categories WHERE id = '$id'";
//        mysqli_query($connect, $sql);
//        include_once 'connect/close.php';
//    }
function softDeleteVersion(){
    $id = $_GET['id'];
    include_once 'connect/open.php';
    $sql = "UPDATE versions SET deletes = 1 WHERE id = '$id'";
    mysqli_query($connect, $sql);
    include_once 'connect/close.php';

}

// Kiểm tra đang thực hiện hành động gì
switch ($action) {
    case'':
//        Lấy dữ liệu từ DB về
        $versions = index();
        break;

    case 'category';
        $array = version();
        break;

    case 'store':
//        Thêm dữ liệu lên DB
        store();
//        include_once 'models/categoriesModel.php';
//        header('Location:index.php?controller=categories');
        break;

    case 'edit':
//        Lấy bản ghi theo id
        $versions = edit();
        break;

    case 'update':
//        Sửa dữ liệu trên DB theo id
        update();
        break;

//        case 'destroy':
////  Xóa dữ liệu
//            destroy();
//            break;
    case 'softDeleteVersion':
        // Thực hiện soft delete
        softDeleteVersion();
//            header('Location:index.php?controller=categories');
        break;
}

?>