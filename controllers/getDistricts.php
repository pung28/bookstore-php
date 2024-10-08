<?php
include_once '../connect/open.php';
$connect = open();
if (isset($_GET['province_id'])) {
    $province_id = $_GET['province_id'];
    $sql = "SELECT id, name FROM districts WHERE province_id = $province_id";
    $result = mysqli_query($connect, $sql);
    $districts = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $districts[] = $row;
    }
    echo json_encode($districts);
}

include_once '../connect/close.php';
?>
