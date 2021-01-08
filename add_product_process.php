<?php
require_once 'configs/requires.php';
$today = gmdate('Y-m-d');
ini_set('error_log', 'Error_logs/'.$today.'-add-product-process-php-error.log');

if($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('Location: 404.php');
}

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

error_log(var_export($_REQUEST, true));
error_log(var_export($_FILES, true));

$id          = $_REQUEST['id'] ?? false;
$name        = $_REQUEST['name'];
$description = $_REQUEST['description'];
$price       = $_REQUEST['price'];
$quantity    = $_REQUEST['quantity'];
$category_id = $_REQUEST['category'];
$images      = $_REQUEST['images'] ?? false;
$date        = gmdate('Y-m-d H:i:s');

$name       = trim($name);
$description= trim($description);
$price      = trim($price);
$quantity   = trim($quantity);
$category_id   = trim($category_id);

if(empty($name) || empty($description) || empty($price) || empty($quantity) || empty($category_id)) {
    echo json_encode(array('err'=> 'Fields are required'));
    exit;
}

# validate cat3gory
$obj_product_categories = new ModelProductCategories();
$categories =  $obj_product_categories->getProductCategories();

if(!in_array($category_id, array_keys($categories))) {
    echo json_encode(array('err'=> 'Category is invalid'));
    exit;
}

$obj_products = new ModelProducts(array('id'=> $id, 'user_id'=> $user_id, 'name'=> $name, 'description'=> $description, 'price'=> $price, 'quantity'=> $quantity, 'category_id'=> $category_id, 'date_add'=> $date, 'date_upd'=> $date));
$product_details = false;

if(!empty($id)) {
    $product_details =  $obj_products->getProductByIdNUserId();

    if(!$product_details) {
        echo json_encode(array('err'=> 'Product not found'));
        exit;
    }
}

if($product_details) {
    $updated = $obj_products->updateProduct();
    error_log('updated: '.var_export($updated, true));

    #add product images
    $obj_product_images = new ModelProductImages(array('product_id'=> $id, 'date_add'=> $date));
    $image_added = $obj_product_images->addProductImages($images);
    error_log('image_added: '.$image_added);
}
else {
    $new_id = $obj_products->addProduct();
    error_log('new_id: '.var_export($new_id, true));

    #add product images
    $obj_product_images = new ModelProductImages(array('product_id'=> $new_id, 'date_add'=> $date));
    $image_added = $obj_product_images->addProductImages($images);
    error_log('image_added: '.$image_added);
}

if($product_details && $updated) {
    echo json_encode(array('notice'=> 'Product Updated successfully'));
}
else if(!$id && $new_id) {
    echo json_encode(array('notice'=> 'Product created successfully'));
}
else {
    echo json_encode(array('err'=> 'Something went wrong'));
}

exit;