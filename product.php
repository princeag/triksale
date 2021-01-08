<?php
$p = 'product';
require 'configs/requires.php';
$smarty = new SmartyEngine();


$id = $_GET['id'];
$id = trim($id);

if($id == '') {
    header('Location: 404.php');
}


$obj_products = new ModelProducts(array('id'=> $id));
$product_detail =  $obj_products->getProductById();
$smarty->assign('product_detail', $product_detail);

# images
$obj_product_images = new ModelProductImages(array('product_id'=> $id));
$images = $obj_product_images->getProductImagesByProductId();
$smarty->assign('images', $images);

$smarty->assign('app_name', _AppName);
$smarty->assign('title', 'Product');
$smarty->assign('p', $p);
$smarty->display('product.tpl');
