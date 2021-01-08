<?php
require 'configs/requires.php';

$callback = $_GET['callback'];
$today = gmdate('Y-m-d');
ini_set('error_log', 'Error_logs/'.$today.'-ajax-request-php-error.log');

if($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo 'not_allowed';
    exit;
}

if($callback == '') {
    echo 'not_allowed';
    exit;
}

session_start();
$user_id = $_SESSION['user_id'] ?? false;

if(empty($user_id)) {
    echo 'login';
    exit;
}

$obj_user_accounts = new ModelUserAccounts(array('id'=> $user_id));
$user_detail =  $obj_user_accounts->getUserAccountDetailById();

if(!$user_detail) {
    echo 'login';
    exit;
}

require_once 'configs/requires.php';

if($callback == 'getUserProducts') {
    $columns 	= $_POST['columns'];
    $draw 		= $_POST['draw'];
    $start 		= $_POST['start'];
    $length 	= $_POST['length'];
    $order 		= $_POST['order'];
    $search 	= $_POST['search']['value'];
    
    $sort_order = $order[0]['dir'];
    $sort_by = $columns[$order[0]['column']]['data'];
    
    $obj_products = new ModelProducts(array('user_id'=> $user_id));
    $recordsTotal = $obj_products->countAllUserProducts();
    
    if($search != '') {
        $where = '';
        
        foreach($columns as $key => $column) {
            if($column['searchable'] == 'true') {
                
                $where .= $column['data']." LIKE '%".$search."%'";
    
                if((count($columns)-1) > $key) {
                    $where .= ' OR ';
                }
            }	
        }

        $where = rtrim($where, 'OR ');
    
        // error_log('where: '.$where);die;
        $user_products_data = $obj_products->getAllUserProductsBySearch($where, $start, $length, $sort_by, $sort_order);
        $recordsFiltered = $user_products_data ? count($user_products_data) : 0;
    }
    else {
        $user_products_data = $obj_products->getAllUserProducts($start, $length, $sort_by, $sort_order);
        $recordsFiltered = $recordsTotal;
    }
    
    $datatble_data = array('draw'=> $draw, 'data'=> $user_products_data, 'recordsFiltered'=> $recordsFiltered, 'recordsTotal'=> $recordsTotal);
    
    echo json_encode($datatble_data);
    exit;
}
else if($callback == 'delete_img') {
    $product_id = $_REQUEST['product_id'];
    $image_name = $_REQUEST['image_name'];

    $image_name = trim($image_name);

    if(empty($image_name) || empty($product_id)) {
        echo json_encode(array('err'=> 'Something went wrong.'));
        exit;
    }

    $obj_products = new ModelProducts(array('id'=> $product_id, 'user_id'=> $user_id));
    $product_details =  $obj_products->getProductByIdNUserId();
    error_log('product_details: '.var_export($product_details, true));

    if(!$product_details) {
        echo json_encode(array('err'=> 'Something went wrong.'));
        exit;
    }

    $obj_product_images = new ModelProductImages(array('product_id'=> $product_id, 'image_name'=> $image_name));
    $image = $obj_product_images->getProductImagesByProductIdNImageName();
    error_log('image: '.var_export($image, true));

    if(!$image) {
        echo json_encode(array('err'=> 'Something went wrong.'));
        exit;
    }

    # delete image
    $obj_product_images->id = $image;
    $image = $obj_product_images->deleteImageById();
    error_log('image: '.var_export($image, true));

    if(!$image) {
        echo json_encode(array('err'=> 'Something went wrong.'));
        exit;
    }

    echo json_encode(array('notice'=> 'Deleted successfully.'));
    exit;
}
else {
    echo 'not_allowed';
}

exit;