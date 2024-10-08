<?php
function Book(){
    include_once "connect/open.php";
    $connect = open();

    $search = '';
    if (isset($_POST['search'])){
        $search = $_POST['search'];
    }

    // Câu truy vấn lấy sách theo yêu cầu
    $sqlBooks = "SELECT books.id, books.name, books.cate_id, books.author_id, 
                        IF(book_details.part IS NULL OR book_details.part = '', books.book_image, book_details.bd_image) AS image, 
                        book_details.price, book_details.part, book_details.id AS book_detail_id
                 FROM books 
                 INNER JOIN book_details ON books.id = book_details.book_id 
                 WHERE books.name LIKE '%$search%' 
                 AND books.deletes = 0 
                 AND book_details.deletes = 0
                 AND (book_details.part IS NOT NULL AND book_details.part <> '' 
                      OR NOT EXISTS (SELECT 1 FROM book_details bd WHERE bd.book_id = books.id AND bd.part IS NOT NULL AND bd.part <> ''))
                 ORDER BY book_details.id DESC 
                 LIMIT 9";

    $books = mysqli_query($connect, $sqlBooks);
    $sqlCategories = "SELECT * FROM categories";
    $categories = mysqli_query($connect, $sqlCategories);
    include_once "connect/close.php";

    $array = array();
    $array['books'] = $books;
    $array['categories'] = $categories;
    $array['search'] = $search;
    return $array;
}


function all_book() {
    include_once "connect/open.php";
    $connect = open();

    $page = 1;
    if (isset($_POST['page'])) {
        $page = $_POST['page'];
    }
    $recordOnePage = 12;

    // Tổng số bản ghi
    $sqlCountRecord = "SELECT COUNT(*) AS count_record 
                       FROM books 
                       INNER JOIN book_details ON books.id = book_details.book_id 
                       WHERE books.deletes = 0 AND book_details.deletes = 0 
                       AND (book_details.part IS NOT NULL AND book_details.part <> '' 
                            OR NOT EXISTS (SELECT 1 FROM book_details bd WHERE bd.book_id = books.id AND bd.part IS NOT NULL AND bd.part <> ''))";
    $countRecord = mysqli_query($connect, $sqlCountRecord);
    $each = mysqli_fetch_assoc($countRecord);
    $countRecord = $each['count_record'];
    $countPage = ceil($countRecord / $recordOnePage);
    $start = ($page - 1) * $recordOnePage;

    $search = '';
    if (isset($_POST['search'])) {
        $search = $_POST['search'];
    }

    // Câu truy vấn lấy sách theo yêu cầu
    $sqlBooks = "SELECT books.id, books.name, books.cate_id, books.author_id, 
                        IF(book_details.part IS NULL OR book_details.part = '', books.book_image, book_details.bd_image) AS image, 
                        book_details.price, book_details.part, book_details.id AS book_detail_id
                 FROM books 
                 INNER JOIN book_details ON books.id = book_details.book_id 
                 WHERE books.name LIKE '%$search%' 
                 AND books.deletes = 0 
                 AND book_details.deletes = 0
                 AND (book_details.part IS NOT NULL AND book_details.part <> '' 
                      OR NOT EXISTS (SELECT 1 FROM book_details bd WHERE bd.book_id = books.id AND bd.part IS NOT NULL AND bd.part <> ''))
                 LIMIT $start, $recordOnePage";

    $books = mysqli_query($connect, $sqlBooks);
    $sqlCategories = "SELECT * FROM categories";
    $categories = mysqli_query($connect, $sqlCategories);
    include_once "connect/close.php";

    $array = array();
    $array['books'] = $books;
    $array['categories'] = $categories;
    $array['search'] = $search;
    $array['page'] = $countPage;
    return $array;
}


function detail() {
    $id = $_GET['id'];
    include_once "connect/open.php";
    $connect = open();

    $sqlBook_details = "
        SELECT books.id AS book_id, books.name, authors.name AS author_name,
               IF(book_details.part IS NULL OR book_details.part = '', books.book_image, book_details.bd_image) AS image,
               books.book_image, books.cate_id, books.author_id,
               book_details.id AS book_detail_id, book_details.bd_image, book_details.price, book_details.quantity,
               book_details.publishing_year, book_details.publishing_company, book_details.description, 
               book_details.status, book_details.part, book_details.deletes, book_details.book_id, 
               book_details.version_id, versions.name AS version_name
        FROM books
        INNER JOIN book_details ON books.id = book_details.book_id
        INNER JOIN authors ON books.author_id = authors.id
        INNER JOIN versions ON book_details.version_id = versions.id
        WHERE book_details.id = '$id' AND book_details.deletes = 0
    ";

    $book_details = mysqli_query($connect, $sqlBook_details);
    $sqlCategories = "SELECT * FROM categories";
    $categories = mysqli_query($connect,$sqlCategories);
    include_once "connect/close.php";
    $array = array();
    $array['book_details'] = $book_details;
    $array['categories'] = $categories;
    return $array;
}


function add_to_cart(){
    $book_detail_id = $_GET['id'];
    if (isset($_SESSION['cart'])){
        if (isset($_SESSION['cart'][$book_detail_id])){
            $_SESSION['cart'][$book_detail_id]++;
        } else {
            $_SESSION['cart'][$book_detail_id] = 1;
        }
    } else {
        $_SESSION['cart'] = array();
        $_SESSION['cart'][$book_detail_id] = 1;
    }
}

function view_cart() {
    $cart = array();
    $temp = array();
    $array = array();
    include_once 'connect/open.php';
    $connect = open();
    $sub = 0;
    $sqlCustomer = "SELECT * FROM customers";
    $customers = mysqli_query($connect, $sqlCustomer);
    $sqlCategories = "SELECT * FROM categories";
    $category = mysqli_query($connect, $sqlCategories);


    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $book_detail_id => $amount) {
            $sqlNameAndPrice = "SELECT books.name, 
         IF(book_details.part IS NULL OR book_details.part = '', books.book_image, book_details.bd_image) AS image, 
       book_details.price, book_details.quantity, book_details.part
                                FROM books 
                                INNER JOIN book_details ON books.id = book_details.book_id 
                                WHERE book_details.id = '$book_detail_id'";
            $NameAndPrice = mysqli_query($connect, $sqlNameAndPrice);
            foreach ($NameAndPrice as $each) {
                $temp[$book_detail_id]['name'] = $each['name'];
                $temp[$book_detail_id]['image'] = $each['image'];
                $temp[$book_detail_id]['price'] = $each['price'];
                $temp[$book_detail_id]['part'] = $each['part'];
                $temp[$book_detail_id]['amount'] = $amount;
                $temp[$book_detail_id]['quantity'] = $each['quantity']; // Thêm số lượng có sẵn
                $temp[$book_detail_id]['subtotal'] = $temp[$book_detail_id]['price'] * $temp[$book_detail_id]['amount'];
                $temp[$book_detail_id]['total'] = $sub += $temp[$book_detail_id]['subtotal'];
            }
        }
    }

    include_once 'connect/close.php';
    $cart['books'] = $temp;
    $cart['customers'] = $customers;
    $cart['category'] = $category;
    return $cart;
}


function update_cart()
{
    $items = $_POST['amount'];
    foreach ($items as $product_id => $amount) {
        if ($amount < 0) {
            echo '';
        } else {
            $_SESSION['cart'][$product_id] = $amount;
        }
    }
}

function delete_one_book_in_cart(){
    $book_detail_id = $_GET ['id'];
    unset($_SESSION['cart'][$book_detail_id]);
}

function delete_cart(){
    unset($_SESSION['cart']);
    $_SESSION['cart'] = array();
}

function checkout() {
    include_once 'connect/open.php';
    $connect = open();

    // Lấy thông tin giỏ hàng từ session
    $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();

    // Lấy thông tin danh mục
    $sqlCategories = "SELECT * FROM categories";
    $categories = mysqli_query($connect, $sqlCategories);
    $sqlPayments = "SELECT * FROM payments";
    $payments = mysqli_query($connect, $sqlPayments);
    // Tính tổng tiền của giỏ hàng
    $total = 0;
    $items = array();
    foreach ($cart as $book_detail_id => $amount) {
        $sqlBookDetails = "SELECT books.name, 
            IF(book_details.part IS NULL OR book_details.part = '', books.book_image, book_details.bd_image) AS image, 
            book_details.price, book_details.part
            FROM books 
            INNER JOIN book_details ON books.id = book_details.book_id 
            WHERE book_details.id = '$book_detail_id'";
        $result = mysqli_query($connect, $sqlBookDetails);
        $book = mysqli_fetch_assoc($result);
        $book['amount'] = $amount;
        $book['subtotal'] = $book['price'] * $amount;
        $total += $book['subtotal'];
        $items[] = $book;
    }

    // Lấy thông tin khách hàng nếu đã đăng nhập
    $customer = null;
    if (isset($_SESSION['customer_id'])) {
        $customer_id = $_SESSION['customer_id'];
        $sqlCustomer = "SELECT * FROM customers WHERE id = '$customer_id'";
        $resultCustomer = mysqli_query($connect, $sqlCustomer);
        $customer = mysqli_fetch_assoc($resultCustomer);
    }

    include_once 'connect/close.php';

    $array = array();
    $array['categories'] = $categories;
    $array['payments'] = $payments;
    $array['items'] = $items;
    $array['total'] = $total;
    $array['customer'] = $customer;

    return $array;
}


function add_order() {
    if (!isset($_SESSION['customer_id'])) {
        // Nếu chưa đăng nhập, chuyển hướng đến trang đăng nhập hoặc hiển thị thông báo lỗi
        header('Location: index.php?controller=customer&action=login'); // Hoặc echo một thông báo lỗi
        exit();
    }

    $customer_id = $_SESSION['customer_id'];
    $date = date('Y-m-d');
    $status = 0; // Đơn hàng mới
    $total = 0;
    $staff_id = isset($_SESSION['staff_id']) ? $_SESSION['staff_id'] : null; // Nếu có staff_id trong session
    $payment_id = $_POST['payment-method']; // Lấy payment_id từ form checkout
    $ward_id = $_POST['ward']; // Lấy ward_id từ form checkout

    $cart = $_SESSION['cart'];

    include_once 'connect/open.php';
    $connect = open();

    // Tính tổng tiền của đơn hàng
    foreach ($cart as $book_detail_id => $amount) {
        $sqlBookDetails = "SELECT price FROM book_details WHERE id = '$book_detail_id'";
        $result = mysqli_query($connect, $sqlBookDetails);
        $book_detail = mysqli_fetch_assoc($result);
        $total += $book_detail['price'] * $amount;
    }

    // Thêm đơn hàng vào bảng orders
    $sqlAddOrder = "INSERT INTO orders(date, status, total, customer_id, staff_id, payment_id, ward_id) 
                    VALUES ('$date', '$status', '$total', '$customer_id', '$staff_id', '$payment_id', '$ward_id')";
    mysqli_query($connect, $sqlAddOrder);

    // Lấy ID của đơn hàng vừa thêm
    $order_id = mysqli_insert_id($connect);

    // Thêm chi tiết đơn hàng vào bảng order_details
    foreach ($cart as $book_detail_id => $amount) {
        $sqlBookDetails = "SELECT price FROM book_details WHERE id = '$book_detail_id'";
        $result = mysqli_query($connect, $sqlBookDetails);
        $book_detail = mysqli_fetch_assoc($result);
        $price = $book_detail['price'];

        $sqlAddOrderDetails = "INSERT INTO order_details(order_id, bkdetail_id, amount, price) 
                               VALUES ('$order_id', '$book_detail_id', '$amount', '$price')";
        mysqli_query($connect, $sqlAddOrderDetails);
    }

    include_once 'connect/close.php';

    // Xóa giỏ hàng sau khi đặt hàng thành công
    unset($_SESSION['cart']);
    $_SESSION['cart'] = array();
}


function cart_history() {
    $customer_id = $_SESSION['customer_id'];
    include_once "connect/open.php";
    $page = 1;
    if(isset($_POST['page'])){
        $page = $_POST['page'];
    }
    $recordOnePage = 5;
//    Tong so ban ghi
    $sqlCountRecord = "SELECT COUNT(*) AS count_record FROM books";
    $countRecord = mysqli_query($connect, $sqlCountRecord);
    foreach ($countRecord as $each){
        $countRecord = $each['count_record'];
    }
    $countPage = ceil($countRecord / $recordOnePage);
    $start = ($page - 1) * $recordOnePage;
    $sqlBill = "SELECT * FROM bill_details
                       INNER JOIN books ON bill_details.product_id = books.id
                       INNER JOIN bills ON bill_details.bill_id = bills.id WHERE customer_id = '$customer_id'ORDER BY bills.id DESC LIMIT $start, $recordOnePage";
    $bills = mysqli_query($connect, $sqlBill);
    $sqlCate = "SELECT * FROM categories";
    $cate = mysqli_query($connect, $sqlCate);
    include_once "connect/close.php";
    $array = array();
    $array['bills'] = $bills;
    $array['categories'] = $cate;
    $array['page'] = $countPage;
    return $array;

}

function delete_invoice() {
    $product_id = $_GET['id'];
    $bill_status = $_GET['status'];
    if($bill_status == 0){
        include_once "connect/open.php";
        $sqlDetail = "UPDATE bill_details SET status_detail = 1 WHERE product_id = '$product_id'";
        $detail = mysqli_query($connect, $sqlDetail);
        include_once "connect/close.php";
        return 0;
    }else{
        return 1;

    }
}
function ViewOrderDetail(){
    $bill_id = $_GET['ID'];
    include_once "connect/open.php";
    $sql = "SELECT * FROM bill_details WHERE bill_id = '$bill_id'";
    $bill_details = mysqli_query($connect, $sql);
    $sqlproduct = "SELECT books.id, books.name, books.product_image FROM books";
    $products = mysqli_query($connect, $sqlproduct);
    include_once "connect/close.php";
    $array['bill_details'] = $bill_details;
    $array['books']= $products;
    return $array;


}

function viewOrder(){
    include_once "connect/open.php";
    $customer_id = $_SESSION['customer_id'];
    $page = 1;
    if(isset($_POST['page'])){
        $page = $_POST['page'];
    }
    $recordOnePage = 4;
//    Tong so ban ghi
    $sqlCountRecord = "SELECT COUNT(*) AS count_record FROM bills WHERE `customer_id` = '$customer_id'";
    $countRecord = mysqli_query($connect, $sqlCountRecord);
    foreach ($countRecord as $each){
        $countRecord = $each['count_record'];
    }
    $countPage = ceil($countRecord / $recordOnePage);
    $start = ($page - 1) * $recordOnePage;
    $sql = "SELECT * FROM `bills` WHERE `customer_id` = '$customer_id' LIMIT $start, $recordOnePage";
    $bill = mysqli_query($connect, $sql);
    include_once "connect/close.php";
    $array['bills'] = $bill;
    $array['page'] = $countPage;
    return $array;

}
switch ($action) {
    case '';
        $array = Book();
        break;

    case 'all_book';
        $array = all_book();
        break;

    case 'detail':
        $array = detail();
        break;

    case 'category':
        $books = category();
        break;
    case 'add_to_cart':
        add_to_cart();
        break;

    case 'view_cart':
        $cart = view_cart();
        break;

    case 'update_cart':
        update_cart();
        break;

    case 'delete_one_book_in_cart':
        delete_one_book_in_cart();
        break;

    case 'delete_cart':
        delete_cart();
        break;

    case 'checkout':
        $array = checkout();
        break;

    case 'add_order':
        add_order();
        break;

    case 'delete_invoice':
        $test = delete_invoice();
        break;

    case 'detail_cart':
        $array = ViewOrderDetail();
        break;

    case 'cart_history':
        $array = viewOrder();
        break;
}
?>