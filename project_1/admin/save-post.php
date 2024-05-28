<?php

if(isset($_FILES['fileToUpload'])){
    $error = array();

    $file_name = $_FILES['fileToUpload']['name'];
    $file_size = $_FILES['fileToUpload']['size'];
    $file_tmp = $_FILES['fileToUpload']['tmp_name'];
    $file_type = $_FILES['fileToUpload']['type'];
    $file_ext = end(explode('.',$file_name));
    $extensions = array("jpeg","jpg","png");
//in array func basically used for searching a value in the array , so it requies two parameter first one is searching value and the second value is array which it will be search
    if(in_array($file_ext,$extensions)===false){
        $error[] = "This extension file is not allowed.please choose a jpg or png file";
    }
    if($file_size > 2097152){
        $error[] = "File size must be two mb or lower";
    }
    if(empty($error) == true){
        move_uploaded_file($file_tmp,"upload/" .$file_name);
    }else{
        print_r($error);
        die();
    }
}

include "config.php";
session_start();
$title = mysqli_real_escape_string($conn,$_POST['post_title']);
$description = mysqli_real_escape_string($conn,$_POST['postdesc']);
$category = mysqli_real_escape_string($conn,$_POST['category']);
$date = date("d , M , Y");
$author = $_SESSION['user_id'];

$sql = "INSERT INTO post(title,description,category,post_date,author,post_img) VALUES ('{$title}','{$description}','{$category}','{$date}','{$author}','{$file_name}');";

$sql .= "UPDATE category SET post= post+1 WHERE category_id = {$category}";

if(mysqli_multi_query($conn,$sql)){
    header("Location: http://localhost/php/project_1/admin/post.php");
}else{
    echo '<div class="alert alert-danger">Query Failed</div>';
}
?>