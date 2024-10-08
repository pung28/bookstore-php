<?php
//function lấy dữ liệu từ DB về
function indexAuthor(){
    include_once 'connect/open.php';
    $sql = "SELECT * FROM authors WHERE deletes = 0";
    $authors = mysqli_query($connect,$sql);
    include_once 'connect/close.php';
    return $authors;
}

function author() {
    $id = $_GET['id'];
    include_once "connect/open.php";
    $sqlAuthor = "SELECT * FROM authors WHERE id = '$id'";
    $authors = mysqli_query($connect,$sqlCategory);
    $sqlProduct = "SELECT * FROM books WHERE author_id = '$id'";
    $products = mysqli_query($connect,$sqlProduct);
    include_once "connect/close.php";
    $array = array();
    $array['books'] = $products;
    $array['authors'] = $authors;
    return $array;
}

function storeAuthor()
{
//        Lấy dữ liệu từ form về
    $name = $_POST['name'];
    include_once 'connect/open.php';
    $sql = "INSERT INTO authors(name) VALUES ('$name')";
    mysqli_query($connect, $sql);
    include_once 'connect/close.php';
}
function editAuthor(){
//        Lấy id
    $id = $_GET['id'];
    include_once 'connect/open.php';
    $sql = "SELECT * FROM authors WHERE id = '$id'";
    $authors = mysqli_query($connect,$sql);
    include_once 'connect/close.php';
    return $authors;
}

function updateAuthor(){
    $id = $_POST['id'];
    $name = $_POST['name'];
    include_once 'connect/open.php';
    $sql = "UPDATE authors SET name = '$name' WHERE id = '$id'";
    $authors = mysqli_query($connect,$sql);
    include_once 'connect/close.php';
}

//    function destroy(){
//        $id = $_GET['id'];
//        include_once 'connect/open.php';
//        $sql = "DELETE FROM categories WHERE id = '$id'";
//        mysqli_query($connect, $sql);
//        include_once 'connect/close.php';
//    }
function softDeleteAuthor(){
    $id = $_GET['id'];
    include_once 'connect/open.php';
    $sql = "UPDATE authors SET deletes = 1 WHERE id = '$id'";
    mysqli_query($connect, $sql);
    include_once 'connect/close.php';

}

// Kiểm tra đang thực hiện hành động gì
switch ($action) {
    case'':
//        Lấy dữ liệu từ DB về
        $authors = indexAuthor();
        break;

    case 'author';
        $array = author();
        break;

    case 'store':
//        Thêm dữ liệu lên DB
        storeAuthor();
//        include_once 'models/categoriesModel.php';
//        header('Location:index.php?controller=categories');
        break;

    case 'edit':
//        Lấy bản ghi theo id
        $authors = editAuthor();
        break;

    case 'update':
//        Sửa dữ liệu trên DB theo id
        updateAuthor();
        break;

//        case 'destroy':
////  Xóa dữ liệu
//            destroy();
//            break;
    case 'softDeleteAuthor':
        // Thực hiện soft delete
        softDeleteAuthor();
            header('Location:index.php?controller=author');
        break;
}

?>