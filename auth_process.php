<?php
require_once 'configs/requires.php';
$today = gmdate('Y-m-d');
ini_set('error_log', 'Error_logs/'.$today.'-auth_processs-php-error.log');

if($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('Location: 404.php');
}

error_log(var_export($_REQUEST, true));
error_log(var_export($_FILES, true));

$callback = $_GET['callback'];
session_start();

if($callback === 'register') {
    $email          = $_REQUEST['email'];
    $name           = $_REQUEST['name'];
    $mobile         = $_REQUEST['mobile'];
    $password       = $_REQUEST['password'];
    $profile        = $_FILES['profile'] ?? false;
    $date           = gmdate('Y-m-d H:i:s');
    
    $email      = trim($email);
    $name       = trim($name);
    $mobile     = trim($mobile);
    $password   = trim($password);
    
    if(empty($email) || empty($name) || empty($mobile) || empty($password)) {
        echo json_encode(array('err'=> 'Fields are required'));
        exit;
    }
    
    # validate email
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(array('err'=> 'Email is invalid'));
        exit;
    }
    
    if(!empty($$profile)) {
        # check profile img
        if(!is_uploaded_file($profile['tmp_name'])) {
            echo json_encode(array('err'=> 'Profile img is not uploded'));
            exit;
        }
        
        # supported profile img
        $supported_profile_img = ['png', 'jpg'];
        $profile_ext = pathinfo($profile['name'], PATHINFO_EXTENSION);
        if(!in_array($profile_ext, $supported_profile_img)) {
            echo json_encode(array('err'=> 'Profile img is not supported'));
            exit;
        }
        
        $profile_dest_folder = 'uploads/profiles/';
        $profile_new_name = md5($profile['name'].$date);
        $profile_new_name .= '.'.$profile_ext;
        
        if(!move_uploaded_file($profile['tmp_name'], $profile_dest_folder.$profile_new_name)) {
            echo json_encode(array('err'=> 'Profile img cannot uploaded'));
            exit;
        }
    }
    
    # encrypt password
    $enc_password = password_hash($password, PASSWORD_BCRYPT);
    
    $obj_user_accounts = new ModelUserAccounts(array('name'=> $name, 'email'=> $email, 'mobile'=> $mobile, 'password'=> $enc_password, 'profile'=> $profile_new_name ?? NULL, 'date_add'=> $date));
    $user_account_detail = $obj_user_accounts->getUserAccountDetailByEmail();
    
    if($user_account_detail) {
        echo json_encode(array('err'=> 'A Account is already registered with given email.'));
        exit;
    }
    
    $user_id =  $obj_user_accounts->addUserAccount();
    
    if(!$user_id) {
        echo json_encode(array('err'=> 'Something went wrong'));
        exit;
    }
    
    echo json_encode(array('notice'=> 'Account created successfully'));
    exit;
}
else if($callback === 'login') {
    $email          = $_REQUEST['email'];
    $password       = $_REQUEST['password'];
    $date           = gmdate('Y-m-d H:i:s');
    
    $email      = trim($email);
    $password   = trim($password);
    
    if(empty($email) || empty($password)) {
        echo json_encode(array('err'=> 'Fields are required'));
        exit;
    }
    
    # validate email
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(array('err'=> 'Email is invalid'));
        exit;
    }
    
    $obj_user_accounts = new ModelUserAccounts(array('email'=> $email));
    $user_account_detail = $obj_user_accounts->getUserAccountDetailByEmail();
    
    if(!$user_account_detail) {
        echo json_encode(array('err'=> 'Account is not registered.'));
        exit;
    }

    # encrypt password
    $enc_password = password_verify($password, $user_account_detail['password']);
    
    if(!$enc_password) {
        echo json_encode(array('err'=> 'Email or password does not match.'));
        exit;
    }
    
    echo json_encode(array('notice'=> 'Account login successfully'));
    $_SESSION['user_id'] = $user_account_detail['id'];
    exit;
}
else {
    header('Location: 404.php');
}