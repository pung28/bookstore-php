<?php
//Lấy hành động muốn thực hiện
$action = '';
if (isset($_GET['action'])){
    $action = $_GET['action'];
}
switch ($action){
    case '':
        include_once 'models/homesModel.php';
        include_once 'view/homes/home.php';
        break;
        case 'all_book':
        include_once 'models/homesModel.php';
        include_once 'view/homes/all_book.php';
        break;

    case 'category':
        include_once "models/categoriesModel.php";
        include_once "view/homes/category.php";
        break;

    case 'detail':
        include_once "models/homesModel.php";
        include_once "view/homes/productdetail.php";
        break;

    case 'add_to_cart' :
        include_once  "models/homesModel.php";
        header('location:index.php?controller=home&action=view_cart');
        break;
    case 'view_cart' :
        include_once  "models/homesModel.php";
        include_once  "view/homes/cart.php";
        break;
    case 'update_cart':
        include "models/homesModel.php";
        header('Location:index.php?controller=home&action=view_cart');
        break;

    case 'delete_one_book_in_cart':
        include_once 'models/homesModel.php';
        header('Location:index.php?controller=home&action=view_cart');
        break;

    case 'delete_cart':
        include_once 'models/homesModel.php';
        header('Location:index.php?controller=home&action=view_cart');
        break;

    case 'checkout':
        include_once 'models/homesModel.php';
        include_once 'view/homes/checkout.php';
        break;

    case 'add_order':
        include_once 'models/homesModel.php';
        header('Location:index.php?controller=home&action=success');
        break;



    case 'delete_invoice':
        include "models/homesModel.php";
        if($test == 0){
            header('Location:index.php?controller=home&action=cart_history');
        }else{
            header('Location:index.php?controller=home&action=cart_history');
        }
        break;
    case 'success':
        include "view/homes/success.php";
        break;
    case 'detail_cart':
        include_once "models/homesModel.php";
        include_once "view/homes/detail_cart.php";
        break;

    case 'cart_history':
        include_once "models/homesModel.php";
        include_once "view/homes/cart_history.php";
        break;

}