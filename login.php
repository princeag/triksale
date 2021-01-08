<?php
$p = 'login';
require 'configs/requires.php';
$smarty = new SmartyEngine();
$smarty->assign('app_name', _AppName);
$smarty->assign('title', 'Create Account');
$smarty->assign('p', $p);
$smarty->display('login.tpl');
