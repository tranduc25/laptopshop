<?php
require_once('./models/brand.php');
require_once('./models/cate.php');
require_once('./models/products.php');
require_once('./models/slider.php');
require_once('./models/order.php');
session_start();
//get title for head
$_SESSION['title'] = 'Shop Laptop';
$actual_link = $_SERVER['PHP_SELF'];
switch ($actual_link) {
  case '/localhost/shoplaptop/index.php':
    $_SESSION['title'] = 'Shop Laptop';
    break;
  case '/shoplaptop/shop.php':
    $_SESSION['title'] = 'Tất cả Sản Phẩm';
    break;
  case '/shoplaptop/cart.php':
    $_SESSION['title'] = 'Giỏ Hàng Của Bạn';
    break;
  case '/shoplaptop/checkout.php':
    $_SESSION['title'] = 'Check out';
    break;
  case '/shoplaptop/single-product.php':
    $_SESSION['title'] = 'Chi tiết Sản Phẩm';
    break;
  case '/shoplaptop/checkout.php':
    $_SESSION['title'] = 'Check out';
    break;
  case '/shoplaptop/category.php':
    $_SESSION['title'] = 'Danh mục Sản Phẩm';
    break;
  case '/shoplaptop/brand.php':
    $_SESSION['title'] = 'Thương hiệu';
    break;
  case '/shoplaptop/orders.php':
    $_SESSION['title'] = 'Danh Sách Đơn Hàng';
    break;
  default:
    $_SESSION['title'] = 'Shop Laptop';
    break;
}

// user logout
if (isset($_SESSION['user_login']) && $_SESSION['user_login'] == '') {
  header('Location:login.php');
}
if (isset($_GET['logout']) && $_GET['logout'] == true) {
  $_SESSION['user_login'] = '';
  $_SESSION['user_id'] = '';
  $_SESSION['cart'] = array();
  header('Location:login.php');
}
// if (isset($_GET['search'])) {
//   header('Location:http://localhost/laptopcu/search.php');
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $_SESSION['title'] ?></title>

  <!-- Google Fonts -->
  <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>

  <!-- Bootstrap -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="css/owl.carousel.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/responsive.css">
  <link rel="icon" href="faicon.png">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <!-- <link rel="stylesheet" type="text/css" href="login.css"> -->

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>