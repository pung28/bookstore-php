<?php
include_once '../connect/open.php';
$connect = open();
if (isset($_GET['district_id'])) {
    $district_id = $_GET['district_id'];
    $sql = "SELECT id, name FROM wards WHERE district_id = $district_id";
    $result = mysqli_query($connect, $sql);
    $wards = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $wards[] = $row;
    }
    echo json_encode($wards);
}

include_once '../connect/close.php';
?>
