<?php
//function lấy dữ liệu từ DB về
function indexCategories(){
    include_once 'connect/open.php';
    $sql = "SELECT * FROM categories WHERE deletes = 0";
    $categories = mysqli_query($connect,$sql);
    include_once 'connect/close.php';
    return $categories;
}

function category() {
    include_once "connect/open.php";
    $connect = open();
    $page = 1;
    if(isset($_POST['page'])){
        $page = $_POST['page'];
    }
    $recordOnePage = 12;

    // Kiểm tra và lấy giá trị id của category
    $cate_id = '';
    if (isset($_GET['id'])) {
        $cate_id = $_GET['id'];
    }

    // Tổng số bản ghi
    $sqlCountRecord = "SELECT COUNT(*) AS count_record 
                       FROM books 
                       INNER JOIN book_details ON books.id = book_details.book_id 
                       WHERE books.cate_id = '$cate_id' AND books.deletes = 0 AND book_details.deletes = 0";
    $countRecord = mysqli_query($connect, $sqlCountRecord);
    foreach ($countRecord as $each) {
        $countRecord = $each['count_record'];
    }
    $countPage = ceil($countRecord / $recordOnePage);
    $start = ($page - 1) * $recordOnePage;

    $search = '';
    if (isset($_POST['search'])){
        $search = $_POST['search'];
    }

    // Truy vấn danh sách sách theo category và tìm kiếm
    $sqlBooks = "SELECT books.id, books.name, books.cate_id, books.author_id, 
                         IF(book_details.part IS NULL OR book_details.part = '', books.book_image, book_details.bd_image) AS image,  book_details.id AS book_detail_id, book_details.price, book_details.part 
                 FROM books 
                 INNER JOIN book_details ON books.id = book_details.book_id 
                 WHERE books.cate_id = '$cate_id' AND books.name LIKE '%$search%' AND books.deletes = 0 AND book_details.deletes = 0 
                 LIMIT $start, $recordOnePage";
    $books = mysqli_query($connect,$sqlBooks);

    // Truy vấn danh sách category
    $sqlCategories = "SELECT * FROM categories";
    $categories = mysqli_query($connect,$sqlCategories);

    include_once "connect/close.php";

    $array = array();
    $array['books'] = $books;
    $array['categories'] = $categories;
    $array['search'] = $search;
    $array['page'] = $countPage;

    return $array;
}


function storeCategories()
{
//        Lấy dữ liệu từ form về
    $name = $_POST['name'];
    include_once 'connect/open.php';
    $sql = "INSERT INTO categories(name) VALUES ('$name')";
    mysqli_query($connect, $sql);
    include_once 'connect/close.php';
}
    function editCategories(){
//        Lấy id
        $id = $_GET['id'];
        include_once 'connect/open.php';
        $sql = "SELECT * FROM categories WHERE id = '$id'";
        $categories = mysqli_query($connect,$sql);
        include_once 'connect/close.php';
        return $categories;
    }

    function updateCategories(){
        $id = $_POST['id'];
        $name = $_POST['name'];
        include_once 'connect/open.php';
        $sql = "UPDATE categories SET name = '$name' WHERE id = '$id'";
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
    function softDeleteCategory(){
        $id = $_GET['id'];
        include_once 'connect/open.php';
        $sql = "UPDATE categories SET deletes = 1 WHERE id = '$id'";
        mysqli_query($connect, $sql);
        include_once 'connect/close.php';

    }

// Kiểm tra đang thực hiện hành động gì
    switch ($action) {
        case'':
//        Lấy dữ liệu từ DB về
            $categories = indexCategories();
            break;

        case 'category';
            $array = category();
            break;

        case 'store':
//        Thêm dữ liệu lên DB
            storeCategories();
//        include_once 'models/categoriesModel.php';
//        header('Location:index.php?controller=categories');
            break;

        case 'edit':
//        Lấy bản ghi theo id
            $categories = editCategories();
            break;

        case 'update':
//        Sửa dữ liệu trên DB theo id
            updateCategories();
            break;

//        case 'destroy':
////  Xóa dữ liệu
//            destroy();
//            break;
        case 'softDeleteCategory':
            // Thực hiện soft delete
            softDeleteCategory();
//            header('Location:index.php?controller=categories');
            break;
    }

    ?>