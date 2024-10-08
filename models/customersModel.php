<?php
//function lấy dữ liệu từ DB về
function loginProcess(){

    $email = $_POST['email'];
    $password = $_POST['password'];
    include_once 'connect/open.php';
    $connect = open();
    $sql = "SELECT *, COUNT(*) AS count_customer FROM customers WHERE email = '$email' AND password = '$password'";
    $customers = mysqli_query($connect, $sql);
    foreach ($customers as $customer){
        if ($customer['count_customer'] == 0){
//            login sai
            return 0;
        } else {
//            login đúng
            $_SESSION['customer_email'] = $customer['email'];
            $_SESSION ['customer_id'] = $customer['id'];
            $_SESSION ['customer_name'] = $customer['name'];
            $_SESSION ['customer_phone'] = $customer['phone'];
            return 1;
        }
    }
    include_once 'connect/close.php';
}
function logout(){
    unset($_SESSION['customer_email']);
    unset($_SESSION['customer_id']);
    unset($_SESSION['customer_name']);
    unset($_SESSION['customer_phone']);

}

function index(){
    include_once 'connect/open.php';
    $connect = open();
    $sql = "SELECT customers.id, customers.name, customers.email, customers.password, customers.phone, customers.address,
       wards.id AS ward_id, wards.name AS ward_name, 
                   districts.id AS district_id, districts.name AS district_name, 
                   provinces.id AS province_id, provinces.name AS province_name
            FROM customers
            INNER JOIN wards ON customers.ward_id = wards.id
            INNER JOIN districts ON wards.district_id = districts.id
            INNER JOIN provinces ON districts.province_id = provinces.id
            WHERE  deletes = 0";
    $customersQuery = mysqli_query($connect, $sql);
    $customers = [];
    while($row = mysqli_fetch_assoc($customersQuery)) {
        $customers[] = $row;
    }
    include_once 'connect/close.php';
    return $customers;
}

function store()
{
//        Lấy dữ liệu từ form về
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $ward_id = $_POST['ward'];
    include_once 'connect/open.php';
    $connect = open();
    $sql = "INSERT INTO customers(name, password, email, phone, address, ward_id) VALUES ('$name', '$password', '$email', '$phone', '$address' , '$ward_id')";
    mysqli_query($connect, $sql);
    include_once 'connect/close.php';
}
function editCustomer(){
    $id = $_GET['id'];
    include_once 'connect/open.php';
    $connect = open();
    $sql = "SELECT customers.*, 
                   wards.id AS ward_id, wards.name AS ward_name, 
                   districts.id AS district_id, districts.name AS district_name, 
                   provinces.id AS province_id, provinces.name AS province_name
            FROM customers  
            INNER JOIN wards ON customers.ward_id = wards.id
            INNER JOIN districts ON wards.district_id = districts.id
            INNER JOIN provinces ON districts.province_id = provinces.id
            WHERE customers.id = '$id'";
    $customers = mysqli_query($connect,$sql);
//    $customers = mysqli_fetch_assoc($customersQuery);
    include_once 'connect/close.php';
    return $customers;
}

function updateCustomer(){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $ward_id = $_POST['ward_id'];
    include_once 'connect/open.php';
    $connect = open();
    $sql = "UPDATE customers SET name = '$name', email = '$email', password ='$password', phone = '$phone', address = '$address' ,ward_id = '$ward_id' WHERE id = '$id'";
    $customers = mysqli_query($connect,$sql);
    include_once 'connect/close.php';
}

function destroy(){
    $id = $_GET['id'];
    include_once 'connect/open.php';
    $sql = "DELETE FROM customers WHERE id = '$id'";
    mysqli_query($connect, $sql);
    include_once 'connect/close.php';
}

function softDeleteCustomer(){
    $id = $_GET['id'];
    include_once 'connect/open.php';
    $sql = "UPDATE customers SET deletes = 1 WHERE id = '$id'";
    mysqli_query($connect, $sql);
    include_once 'connect/close.php';

}


// Kiểm tra đang thực hiện hành động gì
switch ($action) {

    case 'loginProcess':
        $test = loginProcess();
        break;
    case'logout':
        logout();
        break;
    case 'registerProcess':
        store();
        break;
    case'':
//        Lấy dữ liệu từ DB về
        $customers = index();
        break;

    case 'store':
//        Thêm dữ liệu lên DB
        store();
//        include_once 'models/categoriesModel.php';
//        header('Location:index.php?controller=categories');
        break;

    case 'edit':
//        Lấy bản ghi theo id
        $customers = editCustomer();
        break;

    case 'update':
//        Sửa dữ liệu trên DB theo id
        updateCustomer();
        break;

    case 'softDeleteCustomer':
//  Xóa dữ liệu
        softDeleteCustomer();
        break;
}

?>