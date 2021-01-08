<?php
$p = 'add_product';
require 'configs/requires.php';
$smarty = new SmartyEngine();

$id = $_GET['id'] ?? false;

session_start();
$user_id = $_SESSION['user_id'] ?? false;

if(empty($user_id)) {
    header('Location: login.php');
}

$obj_user_accounts = new ModelUserAccounts(array('id'=> $user_id));
$user_detail =  $obj_user_accounts->getUserAccountDetailById();

if(!$user_detail) {
    header('Location: login.php');
}

#get product categories
$obj_product_categories = new ModelProductCategories();
$categories =  $obj_product_categories->getProductCategories();
$smarty->assign('categories', $categories);

# get product details
if($id != '') {
    $obj_products = new ModelProducts(array('id'=> $id, 'user_id'=> $user_id));
    $product_details =  $obj_products->getProductByIdNUserId();

    if(!$product_details) {
        header('Location: 404.php');
    }

    # images
    $obj_product_images = new ModelProductImages(array('product_id'=> $id));
    $images = $obj_product_images->getProductImagesByProductId();
    // var_export($images);die;
}

$smarty->assign('product_details', $product_details ?? false);
$smarty->assign('images', $images ?? false);
$smarty->assign('user_name', $user_detail['name']);
$smarty->assign('user_id', $user_detail['id']);
$smarty->assign('app_name', _AppName);
$smarty->assign('title', 'Add Product');
$smarty->assign('p', $p);
$smarty->display('add_product.tpl');
