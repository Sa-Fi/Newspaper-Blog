<?php
include "config.php";
$cat_id = $_GET['cid'];
$sql = "DELETE FROM category where category_id = {$cat_id}";
if(mysqli_query($conn,$sql)){
    header("Location: http://localhost/php/project_1/admin/category.php");
}

?>