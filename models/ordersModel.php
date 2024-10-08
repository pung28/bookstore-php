<?php

function read(){
    include_once "connect/open.php";
    $page = 1;
    if(isset($_POST['page'])){
        $page = $_POST['page'];
    }
    $recordOnePage = 4;
//    Tong so ban ghi
    $sqlCountRecord = "SELECT COUNT(*) AS count_record FROM orders";
    $countRecord = mysqli_query($connect, $sqlCountRecord);
    foreach ($countRecord as $each){
        $countRecord = $each['count_record'];
    }
    $countPage = ceil($countRecord / $recordOnePage);
    $start = ($page - 1) * $recordOnePage;
    $sql = "SELECT * FROM orders WHERE deletes = 0 ORDER BY id DESC LIMIT $start, $recordOnePage " ;
    $ordersResult = mysqli_query($connect, $sql);

    $orders = [];
    if ($ordersResult) {
        while ($row = mysqli_fetch_assoc($ordersResult)) {
            $orders[] = $row;
        }
    }
    $customers = [];
    $sqlCustomers = "SELECT customers.id, customers.name, customers.phone FROM customers";
    $resultCustomers = mysqli_query($connect, $sqlCustomers);
    if ($resultCustomers) {
        while ($row = mysqli_fetch_assoc($resultCustomers)) {
            $customers[] = $row;
        }
    }
    $sqlPayments = "SELECT * FROM payments";
    $payments = mysqli_query($connect, $sqlPayments);
    include_once "connect/close.php";
    $array = array();
    $array['orders'] = $orders;
    $array['customers'] = $customers;
    $array['payments'] = $payments;
    $array['page'] = $countPage;
    return $array;
}

//function order_detail() {
//    $order_id = $_GET['id'];
//    include_once "connect/open.php";
//    $sql = "SELECT * FROM order_details WHERE order_id = '$order_id'";
//    $order_details = mysqli_query($connect, $sql);
//    $sqlproduct = "SELECT book_details.id, books.name, books.product_image FROM books";
//    $products = mysqli_query($connect, $sqlproduct);
//    include_once "connect/close.php";
//    $array =array();
//    $array['bill_details'] = $bill_details;
//    $array['books'] = $products;
//    return $array;
//}

function order_detail() {
    $order_id = $_GET['id'];
    include_once "connect/open.php";
    $connect = open();
    // Truy vấn kết hợp dữ liệu từ bảng order_details, book_details, và books
    $sql = "
        SELECT 
            order_details.order_id, 
            order_details.bkdetail_id, 
            order_details.total, 
            order_details.amount,
            book_details.price, 
            book_details.quantity, 
            book_details.part,
            books.name, 
            CASE 
                WHEN book_details.part IS NOT NULL THEN book_details.bd_image
                ELSE books.book_image
            END AS image
        FROM 
            order_details
        INNER JOIN 
            book_details ON order_details.bkdetail_id = book_details.id
        INNER JOIN 
            books ON book_details.book_id = books.id
        WHERE 
            order_details.order_id = '$order_id'
    ";

    $result = mysqli_query($connect, $sql);
    $order_details = mysqli_fetch_all($result, MYSQLI_ASSOC);

    include_once "connect/close.php";
    return $order_details;
}

function approval()
{
    $bill_id = $_GET['id'];
    include_once "connect/open.php";
    $sql = "SELECT bills.status FROM bills WHERE id = '$bill_id'";
    $bills = mysqli_query($connect, $sql);
    foreach ($bills as $value) {
        if ($value['status'] == 1) {
            $sqlupdate2 = "UPDATE bills SET status = 0 WHERE id = '$bill_id'";
            $update2 = mysqli_query($connect, $sqlupdate2);
            echo "<script>alert('Thông báo hiển thị!');</script>";

        }
        include_once "connect/close.php";
    }
}
function disapproval() {
    $bill_id = $_GET['id'];
    include_once "connect/open.php";
    $sql = "SELECT bills.status FROM bills WHERE id = '$bill_id'";
    $bills = mysqli_query($connect, $sql);
    foreach ($bills as $value){
        if($value['status'] == 0){
            $sqlupdate2 = "UPDATE bills SET status = 1 WHERE id = '$bill_id'";
            $update2 = mysqli_query($connect, $sqlupdate2);
        }
    }
    include_once "connect/close.php";
}

//function destroy(){
//    $bill_id = $_GET['bill_id'];
//    include_once "connect/open.php";
//    $sqlDetail = "SELECT bill_details.bill_id FROM bill_details";
//    $details = mysqli_query($connect, $sqlDetail);
//    foreach ($details as $detail){
//        $detail_id = $detail['id'];
//        if($detail_id == $bill_id){
//            header('Location:index.php?controller=bill');
//        }elseif ($detail_id != $bill_id){
//            $sql = "DELETE FROM bills WHERE bill_id = '$bill_id'";
//            mysqli_query($connect, $sql);
//        }
//    }
//
//    include_once "connect/close.php";
//}
function softDeleteOrder(){
    $id = $_GET['id'];
    include_once 'connect/open.php';
    $sql = "UPDATE orders SET deletes = 1 WHERE id = '$id'";
    mysqli_query($connect, $sql);
    include_once 'connect/close.php';

}

switch ($action){
    case '':
        $array = read();
        break;
    // case 'create':
    //     $array = create();
    //     break;
    case 'store':
        store();
        break;
    case 'order_detail':
        $array = order_detail();
        break;
    case 'approval':
        approval();
        break;
    case 'disapproval':
        disapproval();
        break;
    case 'softDeleteOrder':
        softDeleteOrder();
        break;
}
?>