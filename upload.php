<?php
$dest_folder = 'uploads/product_images/';   //2
$today = gmdate('Y-m-d');
ini_set('error_log', 'Error_logs/'.$today.'-upload-php-error.log');

if (!empty($_FILES)) {
  error_log(var_export($_FILES, true));
    $tempFile = $_FILES['product_images']['tmp_name'];
    $file_name = $_FILES['product_images']['name'];
    $ext = pathinfo($file_name, PATHINFO_EXTENSION);

    if(filesize($tempFile) > 5000000){
      echo json_encode(array('err'=> 'Image img size exceeded, Max Size is 5MB.'));
      exit;
    }

    # supported profile img
    $supported_profile_img = ['png', 'jpg'];
    if(!in_array($ext, $supported_profile_img)) {
        echo json_encode(array('err'=> 'Product image is not supported.'));
        exit;
    }

    $only_name = pathinfo($file_name, PATHINFO_FILENAME);
    error_log($only_name);
    $random_name = $only_name.'-'.time();
    $new_file_name = $random_name.'.'.$ext;
    $targetFile =  $dest_folder. $new_file_name;  //5

    if (move_uploaded_file($tempFile, $targetFile)) {
        echo json_encode(array('notice'=> 'Image uploaded.', 'name'=> $new_file_name));;
    }
    else{
      echo json_encode(array('err'=> 'Product image cannot uploaded.'));
      exit;
    }
}