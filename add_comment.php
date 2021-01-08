<?php
require_once 'configs/requires.php';
$today = gmdate('Y-m-d');
ini_set('error_log', 'Error_logs/'.$today.'-add_comment-php-error.log');

if($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('Location: 404.php');
}

$name          = $_REQUEST['name'];
$product_id    = $_REQUEST['product_id'];
$email         = $_REQUEST['email'];
$comment       = $_REQUEST['comment'];
$date          = gmdate('Y-m-d H:i:s');

$name       = trim($name);
$product_id      = trim($product_id);
$email      = trim($email);
$comment     = trim($comment);

if(empty($name) || empty($email) || empty($product_id) || empty($comment)) {
    echo json_encode(array('err'=> 'Fields are required'));
    exit;
}

# validate email
if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(array('err'=> 'Email is invalid'));
    exit;
}

$obj_product_comments = new ModelProductComments(array('product_id'=> $product_id, 'name'=> $name, 'email'=> $email, 'comment'=> $comment, 'date_add'=> $date));
$id = $obj_product_comments->addProductComment();

if(!$id) {
    echo json_encode(array('err'=> 'Something went wrong.'));
    exit;
}

echo json_encode(array('notice'=> 'Comment Added successfully'));
exit;