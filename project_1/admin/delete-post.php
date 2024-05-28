<?php
include "config.php";
$post_id = $_GET['id'];
$cat_id = $_GET['catid'];

$sql1 = "SELECT * FROM post WHERE post_id = {$post_id}";
$result = mysqli_query($conn,$sql1);
$row = mysqli_fetch_assoc($result);
// to check what kind of data are stored in row variable
// echo "<pre>";
// print_r($row);
// echo "<pre>";
// die();


unlink("upload" .$row['post_img']);// by using unlink we can delete any file from folder, here first variable is path , and second variable is data


$sql = "DELETE FROM post WHERE post_id = {$post_id};";
$sql .= "UPDATE category SET post = post -1 WHERE category_id = {$cat_id}";
if(mysqli_multi_query($conn,$sql)){
    header("Location: http://localhost/php/project_1/admin/post.php");
}else{
    echo "Query Failed";
}


?>