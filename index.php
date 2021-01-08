<?php
$p = 'index';
require 'configs/requires.php';
$smarty = new SmartyEngine();

$obj_products = new ModelProducts();
$product_details =  $obj_products->getProducts();

$smarty->assign('product_details', $product_details);
$smarty->assign('app_name', _AppName);
$smarty->assign('title', 'Home');
$smarty->assign('p', $p);
$smarty->display('index.tpl');
