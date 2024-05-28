<?php
// //Restrict the normal user to go into other page except post page
// if($_SERVER['user_role']==0){
//     header("Location: Location: http://localhost/php/project_1/admin/post.php");
// }
$userid = $_GET['id'];
include "config.php";
$sql = "DELETE FROM USER where user_id = {$userid}";
$result = mysqli_query($conn,$sql) or die("Query Failed");
if(mysqli_query($conn,$sql)){
            header("Location: http://localhost/php/project_1/admin/users.php");
}else{
    echo "<p style='color:red;text-align:center;margin: 10px 0;>Cannot Delete the User</p>";

}

?>