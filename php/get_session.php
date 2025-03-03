<?php
include 'conn_db.php';
error_reporting(0);
session_start();

$login=$_SESSION['login'];
$name=$_SESSION['name'];
$auth=$_SESSION['auth'];

function path($username){
    $sql="SELECT photo FROM users WHERE username='{$username}'";
    $arr = select_mysqli($sql);
    return $arr[0][0];
}

$path=path($name);

$re=[$login,$name,$auth,$path];
print_r(json_encode($re));

?>