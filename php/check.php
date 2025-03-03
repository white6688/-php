<?php
include 'conn_db.php';
$user=$_REQUEST['registerUsername'];
$sql="select * from users where username='$user'";
$check=select_mysqli($sql);
if($check){
    echo 'exists user';
    die();
}




?>