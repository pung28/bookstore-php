<?php
$connect = mysqli_connect('localhost', 'root', '', 'bookstore');
function open() {
    return mysqli_connect('localhost', 'root', '', 'bookstore');
}
?>