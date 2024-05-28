<?php
include "config.php";
// if an user dont upload a new image, execute the if part , 
// if an user upload a new image then execute the else part
if(empty($_FILES['new-image']['name'])){
    $file_name = $_POST['old_image'];
}else{
    $error = array();

    $file_name = $_FILES['new-image']['name'];
    $file_size = $_FILES['new-image']['size'];
    $file_tmp = $_FILES['new-image']['tmp_name'];
    $file_type = $_FILES['new-image']['type'];
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

// $sql = "UPDATE post SET title = '{$_POST["post_title"]}',description = '{$_POST["postdesc"]}',category= {$_POST["category"]},post_img = '{$file_name}' WHERE post_id = {$_POST["post_id"]}";

$sql = "UPDATE post SET title = '{$_POST["post_title"]}',description = '{$_POST["postdesc"]}',category= {$_POST["category"]},post_img = '{$file_name}' WHERE post_id = {$_POST["post_id"]}";

$result = mysqli_query($conn,$sql);
if($result){
    header("Location: http://localhost/php/project_1/admin/post.php");
}else{
    echo "Query Failed";
}
?>