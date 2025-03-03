<?php
include 'conn_db.php';

$user=$_POST['registerUsername'];
$pwd=$_POST['registerPassword'];

$insql = "INSERT INTO users (username, password, authority) VALUES ('$user', '$pwd', 'normal');";
$re=alter_mysqli($insql);
if($re){
    header('Location: http://192.168.100.128/project/login.html?success-register');
    exit();
}


?>