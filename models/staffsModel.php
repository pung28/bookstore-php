<?php

function loginProcess(){
    $email = $_POST['email'];
    $password = $_POST['password'];
    include_once 'connect/open.php';
    $sql = "SELECT *, COUNT(*) AS count_staff FROM staffs WHERE email = '$email' AND password = '$password'";
    $staffs = mysqli_query($connect, $sql);
    foreach ($staffs as $staff){
        if ($staff['count_staff'] == 0){
            return 0;
        } else {
//            login đúng
            $_SESSION['staff_email'] = $staff['email'];
            $_SESSION ['staff_id'] = $staff['id'];
            $_SESSION['name'] = $staff['name'];
            $_SESSION['role'] = $staff['role'];
            return 1;
        }
    }
    include_once 'connect/close.php';
}
function logout(){
    unset($_SESSION['staff_email']);
    unset($_SESSION['staff_id']);
    unset($_SESSION['staff_name']);
    unset($_SESSION['staff_role']);
}

//function lấy dữ liệu từ DB về
function index(){
    include_once 'connect/open.php';
    $sql = "SELECT * FROM staffs WHERE deletes = 0";
    $staffs = mysqli_query($connect,$sql);
    include_once 'connect/close.php';
    return $staffs;
}

function storeStaff()
{

    // Kiểm tra xem có dữ liệu từ form gửi đi không
        // Lấy dữ liệu từ form về
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $role = $_POST['role'];

        include_once 'connect/open.php';
        $sql = "INSERT INTO staffs (name, email, phone, password, role) VALUES ('$name', '$email', '$phone', '$password', '$role')";
        mysqli_query($connect, $sql);
        include_once 'connect/close.php';
}

function editStaff(){
    $id = $_GET['id'];
    include_once 'connect/open.php';
    $sql = "SELECT * FROM staffs WHERE id = '$id'";
    $staffs = mysqli_query($connect,$sql);
    include_once 'connect/close.php';
    return $staffs;
}

function updateStaff(){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    include_once 'connect/open.php';
    $sql = "UPDATE staffs SET name = '$name', email = '$email', phone = '$phone', password = '$password', role = '$role' WHERE id = '$id'";
    $staffs = mysqli_query($connect,$sql);
    include_once 'connect/close.php';
}

function softDeleteStaff(){
    $id = $_GET['id'];
    include_once 'connect/open.php';
    $sql = "UPDATE staffs SET deletes = 1 WHERE id = '$id'";
    mysqli_query($connect, $sql);
    include_once 'connect/close.php';

}


// Kiểm tra đang thực hiện hành động gì
switch ($action) {
    case 'loginProcess':
        $test = loginProcess();
        break;
    case'':
//        Lấy dữ liệu từ DB về
        $staffs = index();
        break;
    case'logout':
        logout();
        break;
    case 'store':
//        Thêm dữ liệu lên DB
        storeStaff();
        break;

    case 'edit':
//        Lấy bản ghi theo id
        $staffs = editStaff();
        break;

    case 'update':
//        Sửa dữ liệu trên DB theo id
        updateStaff();
        break;

    case 'softDeleteStaff':
//  Xóa dữ liệu
        softDeleteStaff();
        break;
}

?>