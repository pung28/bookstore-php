<?php
function indexBookDetail(){
    include_once 'connect/open.php';
    $connect = open();
    $page = 1;
    if(isset($_POST['page'])){
        $page = $_POST['page'];
    }
    $recordOnePage = 4;

    // Tổng số bản ghi
    $sqlCountRecord = "SELECT COUNT(*) AS count_record FROM book_details WHERE deletes = 0";
    $countRecord = mysqli_query($connect, $sqlCountRecord);
    foreach ($countRecord as $each){
        $countRecord = $each['count_record'];
    }
    $countPage = ceil($countRecord / $recordOnePage);
    $start = ($page - 1) * $recordOnePage;

    $sql = "SELECT book_details.*, books.name AS book_name,
            IF(book_details.part IS NULL OR book_details.part = '', books.book_image, book_details.bd_image) AS image,
            books.cate_id, books.author_id,
            versions.name AS version_name
            FROM book_details 
            INNER JOIN books ON books.id = book_details.book_id
            INNER JOIN versions ON versions.id = book_details.version_id
            WHERE book_details.deletes = 0
            ORDER BY book_details.id ASC 
            LIMIT $start, $recordOnePage";

    $book_details = mysqli_query($connect, $sql);
    $book_details_array = array();
    $hasPart = false;
    while ($row = mysqli_fetch_assoc($book_details)) {
        if (!empty($row['part'])) {
            $hasPart = true;
        }
        $book_details_array[] = $row;
    }
    include_once 'connect/close.php';

    $array = array();
    $array['book_details'] = $book_details_array;
    $array['hasPart'] = $hasPart;
    $array['page'] = $countPage;

    return $array;
}


function createBookDetail(){
    include_once 'connect/open.php';
    $sqlBooks = "SELECT * FROM books WHERE deletes = 0";
    $books = mysqli_query($connect, $sqlBooks);
    $sqlVersions = "SELECT * FROM versions";
    $versions = mysqli_query($connect, $sqlVersions);
    include_once 'connect/close.php';
    $array = array();
    $array['books'] = $books;
    $array['versions'] = $versions;
    return $array;
}

function storeBookDetail(){
    include_once 'connect/open.php';

    // Lấy dữ liệu từ form
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $publishing_year = $_POST['publishing_year'];
    $publishing_company = $_POST['publishing_company'];
    $description = $_POST['description'];
    $part = $_POST['part'];
    $book_id = $_POST['book_id'];
    $version_id = $_POST['version_id'];

    // Kiểm tra và xử lý ảnh
    if(isset($_FILES["bd_image"]) && $_FILES["bd_image"]["name"] != "") {
        $target_dir = "uploaded/";
        $target_file = $target_dir . basename($_FILES["bd_image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Kiểm tra định dạng tệp hợp lệ
        $allowed_extensions = array("jpg", "jpeg", "png", "gif", "webp");
        if(!in_array($imageFileType, $allowed_extensions)) {
            $uploadOk = 0;
            // Xử lý thông báo lỗi nếu cần
        }

        // Nếu không có lỗi, tiến hành tải lên tập tin
        if($uploadOk == 1 && move_uploaded_file($_FILES["bd_image"]["tmp_name"], $target_file)) {
            $bd_image = $target_file;
        } else {
            $bd_image = "";
            // Xử lý thông báo lỗi nếu cần
        }
    } else {
        // Lấy ảnh từ bảng books nếu không có part
        if(empty($part)) {
            $sqlBookImage = "SELECT book_image FROM books WHERE id = '$book_id'";
            $result = mysqli_query($connect, $sqlBookImage);
            $row = mysqli_fetch_assoc($result);
            $bd_image = $row['book_image'];
        } else {
            $bd_image = "";
        }
    }

    $status = ($quantity > 0) ? 'còn hàng' : 'không còn hàng';

    // Thực hiện truy vấn INSERT vào bảng book_details
    $sql = "INSERT INTO book_details (price, quantity, publishing_year, publishing_company, description, status, part, book_id, version_id, bd_image) 
            VALUES ('$price', '$quantity', '$publishing_year', '$publishing_company', '$description', '$status', '$part', '$book_id', '$version_id', '$bd_image')";
    mysqli_query($connect, $sql);

    include_once 'connect/close.php';
}


function editBookDetail() {
    $id = $_GET['id'];
    include_once 'connect/open.php';
    $sql = "SELECT book_details.*, 
                   books.name AS book_name,
                   IFNULL(book_details.part, '') AS part,
                   IF(book_details.part IS NULL OR book_details.part = '', books.book_image, book_details.bd_image) AS image,
                   books.cate_id, books.author_id,
                   versions.name AS version_name
            FROM book_details
            INNER JOIN books ON book_details.book_id = books.id
            INNER JOIN versions ON book_details.version_id = versions.id
            WHERE book_details.id = '$id'";
    $book_details = mysqli_query($connect, $sql);
    $sqlBooks = "SELECT * FROM books";
    $books = mysqli_query($connect, $sqlBooks);
    $sqlVersions = "SELECT * FROM versions";
    $versions = mysqli_query($connect, $sqlVersions);
    include_once 'connect/close.php';
    $array = array();
    $array['book_details'] = $book_details;
    $array['books'] = $books;
    $array['versions'] = $versions;
    return $array;
}

function updateBookDetail() {
    include_once 'connect/open.php';

    // Lấy dữ liệu từ form
    $id = $_POST['id'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $publishing_year = $_POST['publishing_year'];
    $publishing_company = $_POST['publishing_company'];
    $description = $_POST['description'];
    $status = $_POST['status'];
    $part = $_POST['part'];
    $book_id = $_POST['book_id'];
    $version_id = $_POST['version_id'];
    $current_image = $_POST['current_image'];

    if (isset($_FILES["bd_image"]) && $_FILES["bd_image"]["name"] != "") {
        $target_dir = "uploaded/";
        $target_file = $target_dir . basename($_FILES["bd_image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Kiểm tra định dạng tệp hợp lệ
        $allowed_extensions = array("jpg", "jpeg", "png", "gif", "webp");
        if (!in_array($imageFileType, $allowed_extensions)) {
            $uploadOk = 0;
            // Xử lý thông báo lỗi nếu cần
        }

        // Nếu không có lỗi, tiến hành tải lên tập tin
        if ($uploadOk == 1 && move_uploaded_file($_FILES["bd_image"]["tmp_name"], $target_file)) {
            $bd_image = $target_file;
        } else {
            $bd_image = $current_image;
            // Xử lý thông báo lỗi nếu cần
        }
    } else {
        $bd_image = $current_image;
    }

    // Thực hiện truy vấn UPDATE với các thông tin đã cập nhật
    $sql = "UPDATE book_details 
            SET price = '$price', quantity = '$quantity', publishing_year = '$publishing_year', 
                publishing_company = '$publishing_company', description = '$description', 
                status = '$status', part = '$part', book_id = '$book_id', version_id = '$version_id', bd_image = '$bd_image' 
            WHERE id = '$id'";
    mysqli_query($connect, $sql);

    include_once 'connect/close.php';
}



function softDeleteBookDetail(){
    $id = $_GET['id'];
    include_once 'connect/open.php';
    $sql = "UPDATE book_details SET deletes = 1 WHERE id = '$id'";
    mysqli_query($connect, $sql);
    include_once 'connect/close.php';

}

function viewBookDetail($book_id){
    include_once 'connect/open.php';
    $book_id = $_GET['book_id'];
    $page = 1;
    if(isset($_POST['page'])){
        $page = $_POST['page'];
    }
    $recordOnePage = 4;
//    Tong so ban ghi
    $sqlCountRecord = "SELECT COUNT(*) AS count_record FROM book_details  WHERE deletes = 0";
    $countRecord = mysqli_query($connect, $sqlCountRecord);
    foreach ($countRecord as $each){
        $countRecord = $each['count_record'];
    }
    $countPage = ceil($countRecord / $recordOnePage);
    $start = ($page - 1) * $recordOnePage;
    $sql = "SELECT book_details.*, books.name AS book_name,
            IF(book_details.part IS NULL OR book_details.part = '', books.book_image, book_details.bd_image) AS image,
                   books.cate_id, books.author_id,
            versions.name AS version_name
            FROM book_details 
            INNER JOIN books ON books.id = book_details.book_id
            INNER JOIN versions ON versions.id = book_details.version_id
            WHERE book_details.book_id = '$book_id' AND book_details.deletes = 0 
            LIMIT $start, $recordOnePage";
    $book_details = mysqli_query($connect, $sql);
    $book_details_array = array();
    $hasPart = false;
    while ($row = mysqli_fetch_assoc($book_details)) {
        if (!empty($row['part'])) {
            $hasPart = true;
        }
        $book_details_array[] = $row;
    }
    include_once 'connect/close.php';
    $array = array();
    $array['book_details'] = $book_details;
    $array['hasPart'] = $hasPart;
    $array['page'] = $countPage;
    return $array;
}

// Kiểm tra action hiện tại
switch ($action){
    case '':
        $array = indexBookDetail();
        break;
    case 'create':
        $array = createBookDetail();
        break;
    case 'store':
        storeBookDetail();
        break;
    case 'edit':
        $array = editBookDetail();
        break;
    case 'update':
        updateBookDetail();
        break;
    case 'softDeleteBookDetail':
        softDeleteBookDetail();
        break;
}
?>
