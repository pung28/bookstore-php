<?php
function indexBook(){
    include_once 'connect/open.php';
    $connect = open();
    $page = 1;
    if(isset($_POST['page'])){
        $page = $_POST['page'];
    }
    $recordOnePage = 4;
//    Tong so ban ghi
    $sqlCountRecord = "SELECT COUNT(*) AS count_record FROM books WHERE deletes = 0";
    $countRecord = mysqli_query($connect, $sqlCountRecord);
    foreach ($countRecord as $each){
        $countRecord = $each['count_record'];
    }
    $countPage = ceil($countRecord / $recordOnePage);
    $start = ($page - 1) * $recordOnePage;
    $sql = "SELECT books.*, categories.name AS category_name
                        , authors.name AS author_name
                            FROM books 
                INNER JOIN categories ON categories.id = books.cate_id 
                INNER JOIN authors ON authors.id = books.author_id
                WHERE books.deletes = 0
                LIMIT $start, $recordOnePage";
    $books = mysqli_query($connect, $sql);
    include_once 'connect/close.php';
    $array = array();
    $array['books'] = $books;
    $array['page'] = $countPage;
    return $array;
}

function createBook(){
    include_once 'connect/open.php';
    $sqlCategory = "SELECT * FROM categories";
    $sqlAuthor = "SELECT * FROM authors";
    $categories = mysqli_query($connect, $sqlCategory);
    $authors = mysqli_query($connect, $sqlAuthor);
    include_once 'connect/close.php';
    $array = array();
    $array['categories'] = $categories;
    $array['authors'] = $authors;
    return $array;
}

function storeBook(){
    include_once 'connect/open.php';

    // Lấy dữ liệu từ form
    $name = $_POST['name'];
    $cate_id = $_POST['cate_id'];
    $author_id = $_POST['author_id'];

    // Xử lý tập tin ảnh sách
    if(isset($_FILES["book_image"]) && $_FILES["book_image"]["name"] != "") {
        $target_dir = "uploaded/";
        $target_file = $target_dir . basename($_FILES["book_image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Kiểm tra định dạng tệp hợp lệ
        $allowed_extensions = array("jpg", "jpeg", "png", "gif", "webp");
        if(!in_array($imageFileType, $allowed_extensions)) {
            $uploadOk = 0;
            // Xử lý thông báo lỗi nếu cần
        }

        // Nếu không có lỗi, tiến hành tải lên tập tin
        if($uploadOk == 1 && move_uploaded_file($_FILES["book_image"]["tmp_name"], $target_file)) {
            $book_image = $target_file;
        } else {
            $book_image = "";
            // Xử lý thông báo lỗi nếu cần
        }
    } else {
        $book_image = "";
    }

    // Thực hiện truy vấn INSERT vào bảng books
    $sql = "INSERT INTO books (name, book_image, cate_id, author_id) 
            VALUES ('$name', '$book_image', '$cate_id', '$author_id')";
    mysqli_query($connect, $sql);

    include_once 'connect/close.php';
}

function editBook(){
    $id = $_GET['id'];
    include_once 'connect/open.php';
    $sql = "SELECT * FROM books WHERE id = '$id'";
    $books = mysqli_query($connect, $sql);
    $sqlCategories = "SELECT * FROM categories   ";
    $categories = mysqli_query($connect, $sqlCategories);
    $sqlAuthors = "SELECT * FROM authors   ";
    $authors = mysqli_query($connect, $sqlAuthors);
    include_once 'connect/close.php';
    $array = array();
    $array['categories'] = $categories;
    $array['books'] = $books;
    $array['authors'] = $authors;
    return $array;
}

function updateBook(){
    include_once 'connect/open.php';

    // Lấy dữ liệu từ form
    $id = $_POST['id'];
    $name = $_POST['name'];
    $cate_id = $_POST['cate_id'];
    $author_id = $_POST['author_id'];

    // Xử lý tập tin ảnh sách nếu có
    if(isset($_FILES["book_image"]) && $_FILES["book_image"]["name"] != "") {
        $target_dir = "uploaded/";
        $target_file = $target_dir . basename($_FILES["book_image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Kiểm tra định dạng tệp hợp lệ
        $allowed_extensions = array("jpg", "jpeg", "png", "gif", "webp");
        if(!in_array($imageFileType, $allowed_extensions)) {
            $uploadOk = 0;
            // Xử lý thông báo lỗi nếu cần
        }

        // Nếu không có lỗi, tiến hành tải lên tập tin
        if($uploadOk == 1 && move_uploaded_file($_FILES["book_image"]["tmp_name"], $target_file)) {
            $book_image = $target_file;

            // Truy vấn UPDATE với tập tin ảnh mới
            $sql = "UPDATE books SET name = '$name', book_image = '$book_image', cate_id = '$cate_id', author_id = '$author_id' WHERE id='$id'";
        } else {
            // Xử lý thông báo lỗi nếu cần
        }
    } else {
        // Trường hợp không có tập tin ảnh mới, chỉ update các thông tin khác
        $sql = "UPDATE books SET name = '$name', cate_id = '$cate_id', author_id = '$author_id' WHERE id='$id'";
    }

    mysqli_query($connect, $sql);
    include_once 'connect/close.php';
}

//function destroyProduct(){
//    $id = $_GET['id'];
//    include_once 'connect/open.php';
//    $sql = "DELETE FROM books WHERE id='$id'";
//    mysqli_query($connect,$sql);
//    include_once 'connect/close.php';
//}
function softDeleteBook(){
    $id = $_GET['id'];
    include_once 'connect/open.php';
    $connect = open();
    $sql = "UPDATE books SET deletes = 1 WHERE id = '$id'";
    mysqli_query($connect, $sql);
    include_once 'connect/close.php';

}
//Kiểm tra action hiện tại
switch ($action){
    case'':
//            Lấy dữ liệu từ DB
        $array = indexBook();
        break;

    case 'create':
        $array = createBook();
        break;

    case 'store':
        storeBook();
        break;

    case 'edit':
        $array = editBook();
        break;

    case 'update':
        updateBook();
        break;

    case 'softDeleteBook':
        softDeleteBook();
        break;
}
?>