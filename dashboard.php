<?php
$p = 'dashboard';
require 'configs/requires.php';
$smarty = new SmartyEngine();

$email = $_GET['email'] ?? false;

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

$smarty->assign('user_name', $user_detail['name']);
$smarty->assign('user_id', $user_detail['id']);
$smarty->assign('app_name', _AppName);
$smarty->assign('title', 'Admin Dashboard');
$smarty->assign('p', $p);
$smarty->display('dashboard.tpl');
